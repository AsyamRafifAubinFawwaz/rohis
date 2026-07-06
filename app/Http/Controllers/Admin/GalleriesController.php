<?php

namespace App\Http\Controllers\Admin;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Models\Galleries;
use App\Traits\UploadsImage;
use Illuminate\Http\Request;

class GalleriesController extends Controller
{
    use UploadsImage;

    public function index(Request $request)
    {
        $keywords = $request->keywords;
        $activity_id = $request->activity_id;
        $status_data = $request->status_data ?? 'aktif';

        $galleries = auth()->user()->galleries()
            ->when($keywords, function ($query, $keywords) {
                return $query->where('title', 'like', '%'.$keywords.'%');
            })
            ->when($activity_id, function ($query, $activity_id) {
                return $query->where('activity_id', $activity_id);
            })
            ->when($status_data, function ($query, $status_data) {
                if ($status_data == 'aktif') {
                    return $query->whereNull('deleted_at');
                } elseif ($status_data == 'nonaktif') {
                    return $query->onlyTrashed();
                }

                return $query;
            })
            ->with(['activity', 'creator'])
            ->latest()
            ->paginate(12);

        $activities = Activities::latest()->get();
        $page = ['title' => 'Galeri Foto'];

        return view('_admin.galleries.index', compact('galleries', 'page', 'activities', 'keywords', 'activity_id', 'status_data'));
    }

    public function add()
    {
        $page = ['title' => 'Galeri Foto'];
        $activities = Activities::latest()->get();

        return view('_admin.galleries.add', compact('page', 'activities'));
    }

    public function doCreate(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'activity_id' => 'nullable|exists:activities,id',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadAsWebp($request->file('image'), 'galleries');
        }

        $data['uploaded_by'] = auth()->id();
        Galleries::create($data);

        return redirect()->route('admin.galleries.index')->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function update($id)
    {
        $page = ['title' => 'Galeri Foto'];
        $gallery = auth()->user()->galleries()->findOrFail($id);
        $activities = Activities::latest()->get();

        return view('_admin.galleries.update', compact('gallery', 'activities', 'page'));
    }

    public function doUpdate(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'activity_id' => 'nullable|exists:activities,id',
        ]);

        $gallery = auth()->user()->galleries()->findOrFail($id);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadAsWebp($request->file('image'), 'galleries');
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }

    public function delete($id)
    {
        $gallery = auth()->user()->galleries()->findOrFail($id);
        $gallery->delete();

        return redirect()->back()->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
    }

    public function restore($id)
    {
        $gallery = auth()->user()->galleries()->withTrashed()->findOrFail($id);
        $gallery->restore();

        return redirect()->route('admin.galleries.index', ['status_data' => 'nonaktif'])->with('success', ResponseConst::SUCCESS_MESSAGE_RESTORED);
    }

    public function forceDelete($id)
    {
        $gallery = auth()->user()->galleries()->withTrashed()->findOrFail($id);
        $gallery->forceDelete();

        return redirect()->route('admin.galleries.index', ['status_data' => 'nonaktif'])->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
    }
}
