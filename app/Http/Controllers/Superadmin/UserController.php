<?php

namespace App\Http\Controllers\Superadmin;

use App\Constants\ResponseConst;
use App\Constants\UserConst;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $keywords = $request->keywords;
        $access_type = $request->access_type;
        $status_data = $request->status_data ?? 'aktif';

        $data = User::query()
            ->when($keywords, function ($query, $keywords) {
                return $query->where(function ($q) use ($keywords) {
                    $q->where('name', 'like', '%'.$keywords.'%')
                        ->orWhere('email', 'like', '%'.$keywords.'%');
                });
            })
            ->when($access_type, function ($query, $access_type) {
                return $query->where('access_type', $access_type);
            })
            ->when($status_data, function ($query, $status_data) {
                if ($status_data == 'aktif') {
                    return $query->whereNull('deleted_at');
                } elseif ($status_data == 'nonaktif') {
                    return $query->onlyTrashed();
                }

                return $query;
            })
            ->latest()
            ->paginate(10);

        $roles = UserConst::getAccessTypes();
        $page = ['title' => 'Manajemen Akun'];

        return view('_superadmin.users.index', compact('data', 'keywords', 'access_type', 'status_data', 'roles', 'page'));
    }

    public function add()
    {
        $roles = UserConst::getAccessTypes();
        $page = ['title' => 'Tambah Akun'];

        return view('_superadmin.users.add', compact('roles', 'page'));
    }

    public function doCreate(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'access_type' => ['required', Rule::in([UserConst::SUPERADMIN, UserConst::ADMIN])],
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['is_active'] = true;
        $data['created_by'] = auth()->id();

        User::create($data);

        return redirect()->route('superadmin.users.index')->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function detail($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $page = ['title' => 'Detail Akun'];

        return view('_superadmin.users.detail', compact('user', 'page'));
    }

    public function update($id)
    {
        $user = User::findOrFail($id);
        $roles = UserConst::getAccessTypes();
        $page = ['title' => 'Edit Akun'];

        return view('_superadmin.users.update', compact('user', 'roles', 'page'));
    }

    public function doUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'access_type' => ['required', Rule::in([UserConst::SUPERADMIN, UserConst::ADMIN])],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $data['updated_by'] = auth()->id();
        $user->update($data);

        return redirect()->route('superadmin.users.index')->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }

    public function delete($id)
    {
        if ($id == auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user = User::findOrFail($id);
        $user->update(['deleted_by' => auth()->id()]);
        $user->delete();

        return redirect()->route('superadmin.users.index')->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
    }

    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make('password123'), // Default password or logic as needed
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('superadmin.users.index')->with('success', 'Password berhasil direset menjadi "password123"');
    }
}
