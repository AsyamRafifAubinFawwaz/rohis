<?php

namespace App\Http\Controllers\Superadmin;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Models\Activities;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function index(Request $request)
    {
        $keywords = $request->keywords;
        $status = $request->status;
        $status_data = $request->status_data ?? 'aktif';

        $activities = Activities::query()
            ->when($keywords, function ($query, $keywords) {
                return $query->where('title', 'like', '%'.$keywords.'%')
                    ->orWhere('location', 'like', '%'.$keywords.'%');
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
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
            ->paginate(12); // Proportional to grid columns (3)

        $statuses = [
            'upcoming' => 'Upcoming',
            'ongoing' => 'Ongoing',
            'done' => 'Done',
        ];

        $page = ['title' => 'Kegiatan'];

        return view('_superadmin.activities.index', compact('activities', 'keywords', 'status', 'status_data', 'statuses', 'page'));
    }

    public function add()
    {
        $page = ['title' => 'Kegiatan'];

        return view('_superadmin.activities.add', compact('page'));
    }

    public function detail($id)
    {
        $activity = Activities::withTrashed()->findOrFail($id);
        $page = ['title' => 'Detail Kegiatan'];

        return view('_superadmin.activities.detail', compact('activity', 'page'));
    }

    public function doCreate(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'event_date' => 'nullable|date',
            'poster' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $data['created_by'] = auth()->id();

        Activities::create($data);

        return redirect()->route('superadmin.activities.index')->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function update($id)
    {
        $activity = Activities::findOrFail($id);
        $page = ['title' => 'Kegiatan'];

        return view('_superadmin.activities.update', compact('activity', 'page'));
    }

    public function doUpdate(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date',
            'poster' => 'nullable|image|max:2048',
        ]);

        $activity = Activities::findOrFail($id);

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $activity->update($data);

        return redirect()->route('superadmin.activities.index')->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }

    public function delete($id)
    {
        $activity = Activities::findOrFail($id);
        $activity->delete();

        return redirect()->route('superadmin.activities.index')->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
    }

    public function restore($id)
    {
        $activity = Activities::withTrashed()->findOrFail($id);
        $activity->restore();

        return redirect()->route('superadmin.activities.index', ['status_data' => 'nonaktif'])->with('success', ResponseConst::SUCCESS_MESSAGE_RESTORED);
    }

    public function forceDelete($id)
    {
        $activity = Activities::withTrashed()->findOrFail($id);
        $activity->forceDelete();

        return redirect()->route('superadmin.activities.index', ['status_data' => 'nonaktif'])->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
    }
}
