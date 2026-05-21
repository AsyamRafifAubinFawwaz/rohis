<?php

namespace App\Http\Controllers\Superadmin;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Models\Profiles;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfilesController extends Controller
{
    public function index(): View
    {
        $profiles = Profiles::all();
        $page = ['title' => 'Profil Organisasi'];

        return view('_superadmin.profiles.index', compact('profiles', 'page'));
    }

    public function add(): View
    {
        $types = ['about', 'vision', 'mission', 'structure'];
        $existingTypes = Profiles::pluck('type')->toArray();
        $availableTypes = array_diff($types, $existingTypes);

        $page = ['title' => 'Tambah Profil'];

        return view('_superadmin.profiles.add', compact('page', 'availableTypes'));
    }

    public function doCreate(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'type' => 'required|string|in:about,vision,mission,structure|unique:profiles,type',
            'content' => 'required|string',
        ]);

        Profiles::create($data);

        return redirect()->route('superadmin.profiles.index')->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function update(string $id): View
    {
        $profile = Profiles::findOrFail($id);
        $page = ['title' => 'Edit Profil'];

        return view('_superadmin.profiles.update', compact('profile', 'page'));
    }

    public function doUpdate(Request $request, string $id): RedirectResponse
    {
        $data = $request->validate([
            'content' => 'required|string',
        ]);

        $profile = Profiles::findOrFail($id);
        $profile->update($data);

        return redirect()->route('superadmin.profiles.index')->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }
}
