<?php

namespace App\Http\Controllers\Superadmin;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Models\Programs;
use Illuminate\Http\RedirectResponse;
use App\Traits\UploadsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProgramsController extends Controller
{
    use UploadsImage;

    /**
     * Display a listing of the programs.
     */
    public function index(Request $request): View
    {
        $keywords = $request->keywords;
        $status_data = $request->status_data ?? 'aktif';

        $programs = Programs::query()
            ->when($keywords, function ($query, $keywords) {
                return $query->where('name', 'like', '%'.$keywords.'%')
                    ->orWhere('description', 'like', '%'.$keywords.'%');
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

        $page = ['title' => 'Program Kerja'];

        return view('_superadmin.programs.index', compact('programs', 'keywords', 'status_data', 'page'));
    }

    /**
     * Show the form for creating a new program.
     */
    public function add(): View
    {
        $page = ['title' => 'Tambah Program'];

        return view('_superadmin.programs.add', compact('page'));
    }

    /**
     * Display the specified program.
     */
    public function detail(string $id): View
    {
        $program = Programs::withTrashed()->findOrFail($id);
        $page = ['title' => 'Detail Program'];

        return view('_superadmin.programs.detail', compact('program', 'page'));
    }

    /**
     * Store a newly created program in storage.
     */
    public function doCreate(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadAsWebp($request->file('image'), 'programs');
        }

        $data['created_by'] = auth()->id();

        Programs::create($data);

        return redirect()->route('superadmin.programs.index')->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    /**
     * Show the form for editing the specified program.
     */
    public function update(string $id): View
    {
        $program = Programs::findOrFail($id);
        $page = ['title' => 'Edit Program'];

        return view('_superadmin.programs.update', compact('program', 'page'));
    }

    /**
     * Update the specified program in storage.
     */
    public function doUpdate(Request $request, string $id): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $program = Programs::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($program->image) {
                Storage::disk('public')->delete($program->image);
            }
            $data['image'] = $this->uploadAsWebp($request->file('image'), 'programs');
        }

        $program->update($data);

        return redirect()->route('superadmin.programs.index')->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }

    /**
     * Remove the specified program from storage (soft delete).
     */
    public function delete(string $id): RedirectResponse
    {
        $program = Programs::findOrFail($id);
        $program->delete();

        return redirect()->route('superadmin.programs.index')->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
    }

    /**
     * Restore the specified soft-deleted program.
     */
    public function restore(string $id): RedirectResponse
    {
        $program = Programs::withTrashed()->findOrFail($id);
        $program->restore();

        return redirect()->route('superadmin.programs.index', ['status_data' => 'nonaktif'])->with('success', ResponseConst::SUCCESS_MESSAGE_RESTORED);
    }

    /**
     * Permanently remove the specified program from storage.
     */
    public function forceDelete(string $id): RedirectResponse
    {
        $program = Programs::withTrashed()->findOrFail($id);

        if ($program->image) {
            Storage::disk('public')->delete($program->image);
        }

        $program->forceDelete();

        return redirect()->route('superadmin.programs.index', ['status_data' => 'nonaktif'])->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
    }
}
