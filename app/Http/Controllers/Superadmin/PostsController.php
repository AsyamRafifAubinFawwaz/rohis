<?php

namespace App\Http\Controllers\Superadmin;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Posts;
use App\Traits\UploadsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    use UploadsImage;

    public function index(Request $request)
    {
        $keywords = $request->keywords;
        $status = $request->status;
        $category_id = $request->category_id;
        $status_data = $request->status_data ?? 'aktif';

        $data = Posts::query()
            ->when($keywords, function ($query, $keywords) {
                return $query->where('title', 'like', '%'.$keywords.'%');
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($status_data, function ($query, $status_data) {
                if ($status_data == 'aktif') {
                    return $query->active();
                } elseif ($status_data == 'nonaktif') {
                    return $query->trash();
                }

                return $query;
            })
            ->when($category_id, function ($query, $category_id) {
                return $query->whereHas('categories', function ($q) use ($category_id) {
                    $q->where('categories.id', $category_id);
                });
            })
            ->with('categories')
            ->latest()
            ->paginate(10);

        $statuses = [
            'published' => 'Published',
            'pending' => 'Pending',
            'rejected' => 'Rejected',
            'draft' => 'Draft',
        ];

        $categories = Categories::all();
        $page = ['title' => 'Postingan'];

        return view('_superadmin.post.index', compact('data', 'keywords', 'status', 'category_id', 'status_data', 'statuses', 'categories', 'page'));
    }

    public function add()
    {
        $categories = Categories::all();
        $page = ['title' => 'Postingan'];

        return view('_superadmin.post.add', compact('page', 'categories'));
    }

    public function doCreate(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|max:5120',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
        ], [
            'thumbnail.image' => 'File gambar harus berupa gambar (JPG, PNG, GIF, WebP, atau SVG).',
            'thumbnail.max' => 'Ukuran gambar tidak boleh lebih dari 5 MB.',
            'title.required' => 'Judul postingan wajib diisi.',
            'content.required' => 'Konten postingan wajib diisi.',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        } else {
            $data['slug'] = Str::slug($data['slug']);
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->uploadAsWebp($request->file('thumbnail'), 'thumbnails');
        }

        $data['user_id'] = auth()->id();
        $post = Posts::create($data);

        if ($request->has('category_ids')) {
            $post->categories()->sync($request->category_ids);
        }

        return redirect()->route('superadmin.posts.index')->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function detail($id)
    {
        $post = Posts::withTrashed()->findOrFail($id);
        $page = ['title' => 'Detail Postingan'];

        return view('_superadmin.post.detail', compact('post', 'page'));
    }

    public function update($id)
    {
        $post = Posts::with('categories')->findOrFail($id);
        $categories = Categories::all();
        $page = ['title' => 'Postingan'];

        return view('_superadmin.post.update', compact('post', 'page', 'categories'));
    }

    public function doUpdate(Request $request, $id)
    {
        $post = Posts::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug,'.$post->id,
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|max:5120',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
        ], [
            'thumbnail.image' => 'File gambar harus berupa gambar (JPG, PNG, GIF, WebP, atau SVG).',
            'thumbnail.max' => 'Ukuran gambar tidak boleh lebih dari 5 MB.',
            'title.required' => 'Judul postingan wajib diisi.',
            'content.required' => 'Konten postingan wajib diisi.',
        ]);

        $data['slug'] = Str::slug($data['slug'] ?? $data['title']);

        unset($data['thumbnail']);
        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }
            $data['thumbnail'] = $this->uploadAsWebp($request->file('thumbnail'), 'thumbnails');
        }

        $post->update($data);

        if ($request->has('category_ids')) {
            $post->categories()->sync($request->category_ids);
        } else {
            $post->categories()->detach();
        }

        return redirect()->route('superadmin.posts.index')
            ->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }

    public function delete($id)
    {
        $post = Posts::findOrFail($id);
        $post->update([
            'status' => 'draft',
            'approved_by' => null,
            'approved_at' => null,
        ]);
        $post->delete();

        return redirect()->route('superadmin.posts.index')->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
    }

    public function restore($id)
    {
        $post = Posts::onlyTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->route('superadmin.posts.index')->with('success', ResponseConst::SUCCESS_MESSAGE_RESTORED);
    }

    public function trash()
    {
        $posts = Posts::onlyTrashed()->get();

        return view('_superadmin.post.trash', compact('posts'));
    }

    public function forceDelete($id)
    {
        $post = Posts::onlyTrashed()->findOrFail($id);
        $post->forceDelete();

        return redirect()->route('superadmin.posts.index')->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED_PERMANENTLY);
    }

    public function approve($id)
    {
        $post = Posts::findOrFail($id);
        $post->update([
            'status' => 'published',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()->route('superadmin.posts.index')->with('success', ResponseConst::SUCCESS_MESSAGE_APPROVED);
    }

    public function reject($id)
    {
        $post = Posts::findOrFail($id);
        $post->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()->route('superadmin.posts.index')->with('success', ResponseConst::SUCCESS_MESSAGE_REJECTED);
    }

    public function draft($id)
    {
        $post = Posts::findOrFail($id);
        $post->update([
            'status' => 'draft',
            'approved_by' => null,
            'approved_at' => null,
        ]);

        return redirect()->route('superadmin.posts.index')->with('success', ResponseConst::SUCCESS_MESSAGE_DRAFT);
    }
}
