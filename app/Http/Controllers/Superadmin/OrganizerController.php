<?php

namespace App\Http\Controllers\Superadmin;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Models\organizer;
use Illuminate\Http\RedirectResponse;
use App\Traits\UploadsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class OrganizerController extends Controller
{
    use UploadsImage;

    public function index(Request $request): View
    {
        $keywords       = $request->keywords;
        $status_data    = $request->status_data ?? 'aktif';
        $currentYear    = (int) now()->year;
        $defaultPeriode = $currentYear . '-' . ($currentYear + 1);
        $rawPeriode     = $request->has('periode') ? $request->periode : $defaultPeriode;
        $periode        = ($rawPeriode === 'semua') ? null : $rawPeriode;
        $jabatan        = $request->jabatan;

        $jabatanList = ['Pembina', 'Ketua', 'Wakil Ketua', 'Sekretaris 1', 'Sekretaris 2', 'Bendahara', 'Anggota'];

          // Ambil semua periode unik dari database (termasuk yang terhapus)
        $periodeList = organizer::withTrashed()
            ->distinct()
            ->orderBy('periode', 'desc')
            ->pluck('periode');

          // Pastikan default periode ada di list meskipun belum ada data
        if (! $periodeList->contains($defaultPeriode)) {
            $periodeList = $periodeList->prepend($defaultPeriode);
        }

          // Tambahkan periode dari generated options yang belum ada di database
        $generatedOptions = collect($this->generatePeriodeOptions())->pluck('value');
        $periodeList      = $periodeList->merge($generatedOptions)->unique()->sortDesc()->values();

        $organizers = organizer::query()
            ->when($keywords, function ($query, $keywords) {
                return $query->where('name', 'like', '%' . $keywords . '%')
                    ->orWhere('jabatan', 'like', '%' . $keywords . '%');
            })
            ->when($jabatan, function ($query, $jabatan) {
                return $query->where('jabatan', $jabatan);
            })
            ->when($status_data, function ($query, $status_data) {
                if ($status_data === 'aktif') {
                    return $query->whereNull('deleted_at');
                } elseif ($status_data === 'nonaktif') {
                    return $query->onlyTrashed();
                }

                return $query;
            })
            ->when($periode, function ($query, $periode) {
                return $query->where('periode', $periode);
            })
            ->orderByRaw("FIELD(jabatan, 'Pembina', 'Ketua', 'Wakil Ketua', 'Sekretaris 1', 'Sekretaris 2', 'Bendahara', 'Koordinator Bidang', 'Media', 'Anggota')")
            ->orderBy('name')
            ->paginate(12);

        $page = ['title' => 'Struktur Organisasi'];

        return view('_superadmin.organizer.index', compact(
            'organizers',
            'keywords',
            'jabatan',
            'jabatanList',
            'status_data',
            'periode',
            'periodeList',
            'defaultPeriode',
            'page'
        ));
    }

    public function add(): View
    {
        $page           = ['title' => 'Struktur Organisasi'];
        $jabatanList    = ['Pembina', 'Ketua', 'Wakil Ketua', 'Sekretaris 1', 'Sekretaris 2', 'Bendahara', 'Anggota'];
        $periodeOptions = $this->generatePeriodeOptions();

        return view('_superadmin.organizer.add', compact('page', 'jabatanList', 'periodeOptions'));
    }

    public function doCreate(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'in:Pembina,Ketua,Wakil Ketua,Sekretaris 1,Sekretaris 2,Bendahara,Media,Anggota'],
            'image'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'periode' => ['required', 'string', 'max:255'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadAsWebp($request->file('image'), 'organizers');
        }

        organizer::create($data);

        return redirect()->route('superadmin.organizer.index')->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function update($id): View
    {
        $organizer      = organizer::findOrFail($id);
        $page           = ['title' => 'Struktur Organisasi'];
        $jabatanList    = ['Pembina', 'Ketua', 'Wakil Ketua', 'Sekretaris 1', 'Sekretaris 2', 'Bendahara', 'Anggota'];
        $periodeOptions = $this->generatePeriodeOptions();

        return view('_superadmin.organizer.update', compact('organizer', 'page', 'jabatanList', 'periodeOptions'));
    }

    public function doUpdate(Request $request, $id): RedirectResponse
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'in:Pembina,Ketua,Wakil Ketua,Sekretaris 1,Sekretaris 2,Bendahara,Anggota'],
            'image'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'periode' => ['required', 'string', 'max:255'],
        ]);

        $organizer = organizer::findOrFail($id);

        unset($data['image']);
        if ($request->hasFile('image')) {
            if ($organizer->image) {
                Storage::disk('public')->delete($organizer->image);
            }
            $data['image'] = $this->uploadAsWebp($request->file('image'), 'organizers');
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

      /**
     * Generate periode options in "YYYY-YYYY" format.
     *
     * @return array<int, array{value: string, label: string}>
     */
    private function generatePeriodeOptions(): array
    {
        $currentYear = (int) now()->year;
        $startYear   = 2020;
        $endYear     = $currentYear + 1;
        $options     = [];

          // 1-year span periods (e.g. 2025-2026)
        for ($year = $endYear; $year >= $startYear; $year--) {
            $options[] = [
                'value' => $year . '-' . ($year + 1),
                'label' => $year . '-' . ($year + 1) . ' (1 Periode)',
            ];
        }

          // 2-year span periods (e.g. 2025-2027)
        for ($year = $endYear; $year >= $startYear; $year--) {
            $options[] = [
                'value' => $year . '-' . ($year + 2),
                'label' => $year . '-' . ($year + 2) . ' (2 Periode)',
            ];
        }

        return $options;
    }
}
