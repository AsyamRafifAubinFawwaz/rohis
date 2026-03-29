<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Programs;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
    /**
     * Superadmin dapat melakukan CRUD pada programs
     */
     public function index(): void
    {
        $programs = Programs::latest()->get();
        // return view('superadmin.programs.index', compact('programs'));
    }

    public function add(): void
    {
        // return view('superadmin.programs.add');
    }

    public function doCreate(Request $request): void
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,finished',
        ]);

        $data['created_by'] = auth()->id();

        Programs::create($data);

        // return back()->with(ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function update(): void
    {
        //
    }

    public function doUpdate(Request $request): void
    {
        $data = $request->validate([
            'id' => 'required|exists:programs,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,finished',
        ]);

        $program = Programs::findOrFail($data['id']);
        $program->update($data);

        // return back()->with(ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }

    public function delete(): void
    {
        $program = Programs::findOrFail(request()->id);
        $program->delete();

        // return back()->with(ResponseConst::SUCCESS_MESSAGE_DELETED);
    }
}
