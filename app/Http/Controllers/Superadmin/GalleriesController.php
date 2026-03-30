<?php

namespace App\Http\Controllers\Superadmin;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Models\Galleries;
use Illuminate\Http\Request;

class GalleriesController extends Controller
{
    /**
     * Superadmin dapat mengelola semua gallery dari semua user
     */
    public function index()
    {
        $page = ['title' => 'Galeri Foto'];
        $galleries = Galleries::with(['activity', 'creator'])->latest()->paginate(12);

        return view('_superadmin.gallery.index', compact('galleries', 'page'));
    }

    public function add()
    {
        $page = ['title' => 'Galeri Foto'];
        $activities = Activities::latest()->get();

        return view('_superadmin.gallery.add', compact('page', 'activities'));
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
        Galleries::create($data);

        return redirect()->route('superadmin.galleries.index')->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function update($id)
    {
        $page = ['title' => 'Galeri Foto'];
        $gallery = Galleries::findOrFail($id);
        $activities = Activities::latest()->get();

        return view('_superadmin.gallery.update', compact('gallery', 'activities', 'page'));
    }

    public function doUpdate(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'activity_id' => 'required|exists:activities,id',
        ]);

        $gallery = Galleries::findOrFail($id);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('galleries', 'public');
        }

        $gallery->update($data);

        return redirect()->route('superadmin.galleries.index')->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }

    public function delete($id)
    {
        $gallery = Galleries::findOrFail($id);
        $gallery->delete();

        return redirect()->back()->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
    }
}
