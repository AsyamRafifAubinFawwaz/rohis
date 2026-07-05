<?php

namespace App\Http\Controllers\Superadmin;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Traits\UploadsImage;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    use UploadsImage;

    public function index(Request $request)
    {
        $keywords    = $request->keywords;
        $status      = $request->status;
        $status_data = $request->status_data ?? 'aktif';

        $activities = Activities::query()
            ->when($keywords, function ($query, $keywords) {
                return $query->where(function ($q) use ($keywords) {
                    $q->where('title', 'like', '%'.$keywords.'%')
                      ->orWhere('location', 'like', '%'.$keywords.'%');
                });
            })
            ->when($status, function ($query, $status) {
                $now = \Carbon\Carbon::now();
                if ($status === 'upcoming') {
                    return $query->where(function ($q) use ($now) {
                        $q->where('event_start', '>', $now)
                          ->orWhereNull('event_start');
                    });
                } elseif ($status === 'ongoing') {
                    return $query->where('event_start', '<=', $now)
                                 ->where(function($q) use ($now) {
                                     $q->where('event_end', '>=', $now)
                                       ->orWhere(function($q2) use ($now) {
                                           $q2->whereNull('event_end')
                                              ->whereRaw('DATE_ADD(event_start, INTERVAL 1 DAY) >= ?', [$now]);
                                       });
                                 });
                } elseif ($status === 'done') {
                    return $query->where(function($q) use ($now) {
                        $q->where('event_end', '<', $now)
                          ->orWhere(function($q2) use ($now) {
                              $q2->whereNull('event_end')
                                 ->whereRaw('DATE_ADD(event_start, INTERVAL 1 DAY) < ?', [$now]);
                          });
                    });
                }
                return $query;
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
            ->paginate(12);  // Proportional to grid columns (3)

        $statuses = [
            'upcoming' => 'Upcoming',
            'ongoing'  => 'Ongoing',
            'done'     => 'Done',
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
        $page     = ['title' => 'Detail Kegiatan'];

        return view('_superadmin.activities.detail', compact('activity', 'page'));
    }

    public function doCreate(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'location'    => 'nullable|string|max:255',
            'start_date'  => 'nullable|date_format:Y-m-d',
            'start_time'  => 'nullable|date_format:H:i',
            'end_date'    => 'nullable|date_format:Y-m-d',
            'end_time'    => 'nullable|date_format:H:i',
            'poster'      => 'nullable|image|max:5120',
        ], [
            'poster.image'   => 'File poster harus berupa gambar (JPG, PNG, GIF, WebP, atau SVG).',
            'poster.max'     => 'Ukuran poster tidak boleh lebih dari 5 MB.',
            'title.required' => 'Judul kegiatan wajib diisi.',
        ]);

        $data = $request->only(['title', 'description', 'location']);

        if ($request->start_date) {
            $data['event_start'] = $request->start_date.' '.($request->start_time ?? '00:00').':00';
        }

        if ($request->end_date) {
            $data['event_end'] = $request->end_date.' '.($request->end_time ?? '23:59').':00';
        }

        if ($request->hasFile('poster')) {
            $data['poster'] = $this->uploadAsWebp($request->file('poster'), 'posters');
        }

        $data['created_by'] = auth()->id();

        Activities::create($data);

        return redirect()->route('superadmin.activities.index')->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function update($id)
    {
        $activity = Activities::findOrFail($id);
        $page     = ['title' => 'Kegiatan'];

        return view('_superadmin.activities.update', compact('activity', 'page'));
    }

    public function doUpdate(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'start_date'  => 'required|date_format:Y-m-d',
            'start_time'  => 'required|date_format:H:i',
            'end_date'    => 'required|date_format:Y-m-d',
            'end_time'    => 'required|date_format:H:i',
            'poster'      => 'nullable|image|max:5120',
        ], [
            'poster.image'         => 'File poster harus berupa gambar (JPG, PNG, GIF, WebP, atau SVG).',
            'poster.max'           => 'Ukuran poster tidak boleh lebih dari 5 MB.',
            'title.required'       => 'Judul kegiatan wajib diisi.',
            'description.required' => 'Deskripsi kegiatan wajib diisi.',
            'location.required'    => 'Lokasi kegiatan wajib diisi.',
            'start_date.required'  => 'Tanggal mulai wajib diisi.',
            'start_time.required'  => 'Waktu mulai wajib diisi.',
            'end_date.required'    => 'Tanggal selesai wajib diisi.',
            'end_time.required'    => 'Waktu selesai wajib diisi.',
        ]);

        $activity = Activities::findOrFail($id);

        $data                = $request->only(['title', 'description', 'location']);
        $data['event_start'] = $request->start_date.' '.$request->start_time.':00';
        $data['event_end']   = $request->end_date.' '.$request->end_time.':00';

        if ($request->hasFile('poster')) {
            $data['poster'] = $this->uploadAsWebp($request->file('poster'), 'posters');
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
