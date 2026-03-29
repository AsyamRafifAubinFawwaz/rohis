<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
     public function index(): void
    {
        // $profiles = Profiles::all();
        // return view('superadmin.profiles.index', compact('profiles'));
    }

    public function add(): void
    {
        //
    }

    public function doCreate(Request $request): void
    {
        $data = $request->validate([
            'type' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Profiles::create($data);

        // return back()->with(ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function update(): void
    {
        //
    }

    public function doUpdate(Request $request): void
    {
        $data = $request->validate([
            'id' => 'required|exists:profiles,id',
            'type' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // $profile = Profiles::findOrFail($data['id']);
        // $profile->update($data);

        // return back()->with(ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }

  
}
