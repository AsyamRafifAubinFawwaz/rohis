<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Posts;
use App\Models\PostsCategories;
use Illuminate\Http\Request;

class PostsCategoriesController extends Controller
{
    public function index()
    {
        $postsCategories = PostsCategories::with(['post', 'category'])->get();
        // return view('superadmin.posts_categories.index', compact('postsCategories'));
    }

    public function add()
    {
        $posts = Posts::all();
        $categories = Categories::all();
        // return view('superadmin.posts_categories.create', compact('posts', 'categories'));
    }

    public function doCreate(Request $request)
    {
        $data = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'category_id' => 'required|exists:categories,id',
        ]);
        PostsCategories::create($data);
        // return back()->with(ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function edit()
    {
        $postsCategories = PostsCategories::with(['post', 'category'])->get();
        $posts = Posts::all();
        $categories = Categories::all();
        // return view('superadmin.posts_categories.edit', compact('postsCategories', 'posts', 'categories'));
    }

    public function doUpdate(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:posts_categories,id',
            'post_id' => 'required|exists:posts,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $postsCategory = PostsCategories::findOrFail($data['id']);
        $postsCategory->update($data);

        // return back()->with(ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }
    public function delete(Request $request)
    {
      $postsCategory = PostsCategories::findOrFail($request->id);
      $postsCategory->delete();

        // return back()->with(ResponseConst::SUCCESS_MESSAGE_DELETED);
    }
}
