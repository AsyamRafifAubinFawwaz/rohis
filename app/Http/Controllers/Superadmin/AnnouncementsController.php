<?php

namespace App\Http\Controllers\Superadmin;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Models\Announcements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementsController extends Controller
{
    public function index(Request $request)
    {
        $keywords = $request->keywords;
        $status_data = $request->status_data ?? 'aktif';

        $announcements = Announcements::query()
            ->when($keywords, function ($query, $keywords) {
                return $query->where('title', 'like', '%'.$keywords.'%');
            })
            ->when($status_data, function ($query, $status_data) {
                if ($status_data == 'aktif') {
                    return $query->whereNull('deleted_at');
                } elseif ($status_data == 'nonaktif') {
                    return $query->onlyTrashed();
                }

                return $query;
            })
            ->with('creator')
            ->latest()
            ->paginate(12);

        $page = ['title' => 'Pengumuman'];

        return view('_superadmin.announcements.index', compact('announcements', 'keywords', 'status_data', 'page'));
    }

    public function add()
    {
        $page = ['title' => 'Pengumuman'];

        return view('_superadmin.announcements.add', compact('page'));
    }

    public function detail($id)
    {
        $announcement = Announcements::withTrashed()->findOrFail($id);
        $page = ['title' => 'Detail Pengumuman'];

        return view('_superadmin.announcements.detail', compact('announcement', 'page'));
    }

    public function doCreate(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'expires_at' => 'required|date',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('announcements', 'public');
        }

        $data['created_by'] = auth()->id();

        Announcements::create($data);

        return redirect()->route('superadmin.announcements.index')->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function update($id)
    {
        $announcement = Announcements::findOrFail($id);
        $page = ['title' => 'Pengumuman'];

        return view('_superadmin.announcements.update', compact('announcement', 'page'));
    }

    public function doUpdate(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'expires_at' => 'required|date',
        ]);

        $announcement = Announcements::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($announcement->image) {
                Storage::disk('public')->delete($announcement->image);
            }
            $data['image'] = $request->file('image')->store('announcements', 'public');
        }

        $announcement->update($data);

        return redirect()->route('superadmin.announcements.index')->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }

    public function delete($id)
    {
        $announcement = Announcements::findOrFail($id);
        $announcement->delete();

        return redirect()->route('superadmin.announcements.index')->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
    }

    public function restore($id)
    {
        $announcement = Announcements::withTrashed()->findOrFail($id);
        $announcement->restore();

        return redirect()->route('superadmin.announcements.index', ['status_data' => 'nonaktif'])->with('success', ResponseConst::SUCCESS_MESSAGE_RESTORED);
    }

    public function forceDelete($id)
    {
        $announcement = Announcements::withTrashed()->findOrFail($id);

        if ($announcement->image) {
            Storage::disk('public')->delete($announcement->image);
        }

        $announcement->forceDelete();

        return redirect()->route('superadmin.announcements.index', ['status_data' => 'nonaktif'])->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
    }
}
