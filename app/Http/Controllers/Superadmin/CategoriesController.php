<?php

namespace App\Http\Controllers\Superadmin;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Superadmin dapat melakukan CRUD pada kategori
     */
    public function index(Request $request)
    {
        $keywords = $request->keywords;
        $data = Categories::query()
            ->when($keywords, function ($query, $keywords) {
                return $query->where('name', 'like', '%'.$keywords.'%');
            })
            ->latest()
            ->paginate(10);

        $page = [
            'title' => 'Kategori',
        ];

        return view('_superadmin.categories.index', compact('data', 'keywords', 'page'));
    }

    public function add()
    {
        return view('_superadmin.categories.add');
    }

    public function do_create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        } else {
            $data['slug'] = Str::slug($data['slug']);
        }

        Categories::create($data);

        return redirect()->back()->with(ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function update()
    {
        return view('superadmin.categories.update');
    }

    public function do_update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,'.$id,
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        } else {
            $data['slug'] = Str::slug($data['slug']);
        }

        $category = Categories::findOrFail($id);
        $category->update($data);

        return redirect()->back()->with(ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }

    public function delete($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect()->back()->with(ResponseConst::SUCCESS_MESSAGE_DELETED);
    }
}
