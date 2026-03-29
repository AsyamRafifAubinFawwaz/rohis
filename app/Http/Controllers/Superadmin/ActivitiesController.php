<?php

namespace App\Http\Controllers\Superadmin;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Models\Activities;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
 
    public function index()
    {
         $activities = Activities::latest()->paginate(10);
        return view('_superadmin.activities.index', compact('activities'));
    }

    public function add()
    {
        return view('_superadmin.activities.add');
    }

    public function doCreate(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'event_date' => 'nullable|date',
            'poster' => 'nullable|image|max:2048',
            'status' => 'required|in:upcoming,done',
        ]);

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $data['created_by'] = auth()->id();

        Activities::create($data);

       return redirect()->route('superadmin.activities.index')->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function update()
    {
        return view('_superadmin.activities.update');
    }

    public function doUpdate(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:activities,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date',
            'poster' => 'nullable|image|max:2048',
            'status' => 'required|in:upcoming,ongoing,completed',
        ]);

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $activity = Activities::findOrFail($data['id']);
        $activity->update($data);

         return redirect()->route('superadmin.activities.index')->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }

    public function delete()
    {
        $activity = Activities::findOrFail(request()->id);
        $activity->delete();

        return redirect()->route('superadmin.activities.index')->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
    }

    public function restore()
    {
        $activity = Activities::withTrashed()->findOrFail(request()->id);
        $activity->restore();

        return redirect()->route('superadmin.activities.index')->with('success', ResponseConst::SUCCESS_MESSAGE_RESTORED);
    }
}
