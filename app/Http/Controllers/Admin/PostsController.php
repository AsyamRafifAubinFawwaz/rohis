<?php

namespace App\Http\Controllers\Admin;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->posts()->latest()->get();

        return view('admin.posts.index', compact('posts'));
    }

    public function doCreate(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title']);
        $data['status'] = 'pending';
        $data['approved_by'] = null;
        $data['approved_at'] = null;

        Posts::create($data);

        return redirect()->route('admin.posts.index')->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function doUpdate(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $post = auth()->user()->posts()->findOrFail($request->id);
        $data['slug'] = Str::slug($data['title']);
        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }
}
