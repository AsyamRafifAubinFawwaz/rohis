<?php

namespace App\Http\Controllers\Admin;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Models\Galleries;
use Illuminate\Http\Request;

class GalleriesController extends Controller
{
    /**
     * Admin hanya dapat upload gallery milik sendiri
     */
    public function index()
    {
        $galleries = auth()->user()->galleries()->latest()->get();

        return view('admin.galleries.index', compact('galleries'));
    }

    public function add() {}

    public function doCreate(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('galleries', 'public');
        }

        $data['user_id'] = auth()->id();

        Galleries::create($data);

        return redirect()->route('admin.galleries.index')->with(ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function delete($id) {}
}
