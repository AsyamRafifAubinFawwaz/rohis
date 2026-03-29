<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Announcements;
use Illuminate\Http\Request;

class AnnouncementsController extends Controller
{
    /**
     * Superadmin dapat melakukan CRUD pada announcements
     */
    public function index(): void
    {
        $announcements = Announcements::latest()->get();
        // return view('superadmin.announcements.index', compact('announcements'));
    }

    public function add(): void
    {
        //
    }

    public function doCreate(Request $request): void
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'expires_at' => 'required|date',
        ]);

        $data['created_by'] = auth()->id();

        Announcements::create($data);

        // return back()->with(ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function update(): void
    {
        //
    }

    public function doUpdate(Request $request): void
    {
        $data = $request->validate([
            'id' => 'required|exists:announcements,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'expires_at' => 'required|date',
        ]);

        $announcement = Announcements::findOrFail($data['id']);
    }

    public function delete(): void
    {
        $announcement = Announcements::findOrFail(request()->id);
        $announcement->delete();

        // return back()->with(ResponseConst::SUCCESS_MESSAGE_DELETED);
    }
}
