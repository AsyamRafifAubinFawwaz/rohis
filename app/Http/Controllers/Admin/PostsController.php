<?php

namespace App\Http\Controllers\Admin;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Posts;
use App\Traits\UploadsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    use UploadsImage;

    public function index(Request $request)
    {
        $keywords = $request->keywords;
        $status = $request->status;
        $category_id = $request->category_id;

        $data = auth()->user()->posts()
            ->when($keywords, function ($query, $keywords) {
                return $query->where('title', 'like', '%'.$keywords.'%');
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
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
        $page = ['title' => 'Postingan Saya'];

        return view('_admin.posts.index', compact('data', 'keywords', 'status', 'category_id', 'statuses', 'categories', 'page'));
    }

    public function add()
    {
        $categories = Categories::all();
        $page = ['title' => 'Postingan'];

        return view('_admin.posts.add', compact('page', 'categories'));
    }

    public function doCreate(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|max:5120',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
        ], [
            'thumbnail.image' => 'File gambar harus berupa gambar (JPG, PNG, GIF, WebP, atau SVG).',
            'thumbnail.max' => 'Ukuran gambar tidak boleh lebih dari 5 MB.',
            'title.required' => 'Judul postingan wajib diisi.',
            'content.required' => 'Konten postingan wajib diisi.',
            'category_ids.required' => 'Pilih minimal satu kategori.',
        ]);

        $data['slug'] = Str::slug($data['slug'] ?? $data['title']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->uploadAsWebp($request->file('thumbnail'), 'thumbnails');
        }

        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        $post = Posts::create($data);

        if ($request->has('category_ids')) {
            $post->categories()->sync($request->category_ids);
        }

        return redirect()->route('admin.posts.index')->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function detail($id)
    {
        $post = auth()->user()->posts()->with('categories')->findOrFail($id);
        $page = ['title' => 'Detail Postingan'];

        return view('_admin.posts.detail', compact('post', 'page'));
    }

    public function update($id)
    {
        $post = auth()->user()->posts()->with('categories')->findOrFail($id);
        $categories = Categories::all();
        $page = ['title' => 'Postingan'];

        return view('_admin.posts.update', compact('post', 'page', 'categories'));
    }

    public function doUpdate(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug,'.$request->id,
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|max:5120',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
        ], [
            'thumbnail.image' => 'File gambar harus berupa gambar (JPG, PNG, GIF, WebP, atau SVG).',
            'thumbnail.max' => 'Ukuran gambar tidak boleh lebih dari 5 MB.',
            'title.required' => 'Judul postingan wajib diisi.',
            'content.required' => 'Konten postingan wajib diisi.',
            'category_ids.required' => 'Pilih minimal satu kategori.',
        ]);

        $post = auth()->user()->posts()->findOrFail($request->id);
        $data['status'] = 'pending';
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
        }

        return redirect()->route('admin.posts.index')->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }

    public function delete($id)
    {
        $post = auth()->user()->posts()->findOrFail($id);
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
    }
}
