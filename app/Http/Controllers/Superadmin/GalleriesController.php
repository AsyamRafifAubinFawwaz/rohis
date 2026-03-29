<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Galleries;
use Illuminate\Http\Request;

class GalleriesController extends Controller
{
    /**
     * Superadmin dapat mengelola semua gallery dari semua user
     */
   public function index()
    {
        $galleries = Galleries::latest()->get();
    }

    public function add()
    {

    }

    public function doCreate(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'activity_id' => 'required|exists:activities,id',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('galleries', 'public');
        }
        $data['uploaded_by'] = auth()->id();
        $data['created_by'] = auth()->id();
        Galleries::create($data);

    }

    public function update()
    {
        //
    }

    public function doUpdate(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:galleries,id',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'activity_id' => 'required|exists:activities,id',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('galleries', 'public');
        }

        $gallery = Galleries::findOrFail($data['id']);
        $gallery->update($data);
    }

    public function delete()
    {
        $gallery = Galleries::findOrFail(request()->id);
        $gallery->delete();
        return redirect()->back()->with('success', 'Gallery deleted successfully.');
    }
}
