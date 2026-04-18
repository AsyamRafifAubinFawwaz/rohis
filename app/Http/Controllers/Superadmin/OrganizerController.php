<?php

namespace App\Http\Controllers\Superadmin;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Models\organizer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class OrganizerController extends Controller
{
    public function index(Request $request): View
    {
        $keywords = $request->keywords;
        $status_data = $request->status_data ?? 'aktif';
        $currentYear = (string) now()->year;
        $periode = $request->periode ?? $currentYear;

        // Ambil semua periode unik dari database (termasuk yang terhapus)
        $periodeList = organizer::withTrashed()
            ->distinct()
            ->orderBy('periode', 'desc')
            ->pluck('periode');

        // Pastikan tahun sekarang ada di list meskipun belum ada data
        if (! $periodeList->contains($currentYear)) {
            $periodeList = $periodeList->prepend($currentYear);
        }

        $organizers = organizer::query()
            ->when($keywords, function ($query, $keywords) {
                return $query->where('name', 'like', '%'.$keywords.'%')
                    ->orWhere('jabatan', 'like', '%'.$keywords.'%');
            })
            ->when($status_data, function ($query, $status_data) {
                if ($status_data === 'aktif') {
                    return $query->whereNull('deleted_at');
                } elseif ($status_data === 'nonaktif') {
                    return $query->onlyTrashed();
                }

                return $query;
            })
            ->where('periode', $periode)
            ->latest()
            ->paginate(12);

        $page = ['title' => 'Struktur Organisasi'];

        return view('_superadmin.organizer.index', compact(
            'organizers',
            'keywords',
            'status_data',
            'periode',
            'periodeList',
            'page'
        ));
    }

    public function add(): View
    {
        $page = ['title' => 'Struktur Organisasi'];
        $jabatanList = ['Pembina', 'Ketua', 'Wakil Ketua', 'Sekretaris 1', 'Sekretaris 2', 'Bendahara', 'Anggota'];

        return view('_superadmin.organizer.add', compact('page', 'jabatanList'));
    }

    public function doCreate(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'in:Pembina,Ketua,Wakil Ketua,Sekretaris 1,Sekretaris 2,Bendahara,Anggota'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'periode' => ['required', 'string', 'max:255'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('organizers', 'public');
        }

        organizer::create($data);

        return redirect()->route('superadmin.organizer.index')->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function update($id): View
    {
        $organizer = organizer::findOrFail($id);
        $page = ['title' => 'Struktur Organisasi'];
        $jabatanList = ['Pembina', 'Ketua', 'Wakil Ketua', 'Sekretaris 1', 'Sekretaris 2', 'Bendahara', 'Anggota'];

        return view('_superadmin.organizer.update', compact('organizer', 'page', 'jabatanList'));
    }

    public function doUpdate(Request $request, $id): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'in:Pembina,Ketua,Wakil Ketua,Sekretaris 1,Sekretaris 2,Bendahara,Anggota'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'periode' => ['required', 'string', 'max:255'],
        ]);

        $organizer = organizer::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($organizer->image) {
                Storage::disk('public')->delete($organizer->image);
            }
            $data['image'] = $request->file('image')->store('organizers', 'public');
        }

        $organizer->update($data);

        return redirect()->route('superadmin.organizer.index')->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }

    public function delete($id): RedirectResponse
    {
        $organizer = organizer::findOrFail($id);
        $organizer->delete();

        return redirect()->route('superadmin.organizer.index')->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
    }

    public function restore($id): RedirectResponse
    {
        $organizer = organizer::withTrashed()->findOrFail($id);
        $organizer->restore();

        return redirect()->route('superadmin.organizer.index', ['status_data' => 'nonaktif'])->with('success', ResponseConst::SUCCESS_MESSAGE_RESTORED);
    }

    public function forceDelete($id): RedirectResponse
    {
        $organizer = organizer::withTrashed()->findOrFail($id);

        if ($organizer->image) {
            Storage::disk('public')->delete($organizer->image);
        }

        $organizer->forceDelete();

        return redirect()->route('superadmin.organizer.index', ['status_data' => 'nonaktif'])->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
    }
}
