<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function index()
    {
        $adminCount = User::where('roles', 'ADMIN')->count();
        $userCount = User::where('roles', 'USER')->count();

        $currentYear = Carbon::now()->year;
        $userGrowth = User::selectRaw('MONTH(created_at) as month, COUNT(*) as total')->whereYear('created_at', $currentYear)->groupBy('month')->orderBy('month')->get()->pluck('total', 'month');

        $data = [
            'users' => User::orderBy('id', 'desc')->paginate(20),
            'adminCount' => $adminCount,
            'userCount' => $userCount,
            'userGrowth' => $userGrowth,
        ];

        return view('pages.Admin.v_users.index', $data);
    }

    public function profile()
    {
        $data = [
            'edit' => User::findOrFail(auth()->user()->id),
        ];
        return view('pages.Admin.v_users.profile', $data);
    }

    public function edit($id)
    {
        return response()->json([
            'success' => true,
            'data' => User::findOrFail($id),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'roles' => 'required',
                'password' => 'required|string|min:6',
            ],
            [
                'name.required' => 'Nama harus diisi.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'roles.required' => 'Peran harus dipilih.',
                'password.required' => 'Password harus diisi.',
                'password.min' => 'Password minimal harus 6 karakter.',
            ],
        );

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->roles = $request->roles;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'roles' => 'required',
                'password' => 'nullable|string|min:6',
            ],
            [
                'name.required' => 'Nama harus diisi.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'roles.required' => 'Peran harus dipilih.',
                'password.min' => 'Password minimal harus 6 karakter.',
            ],
        );

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->roles = $request->roles;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('/users')->with('success', 'User berhasil diupdate.');
    }

    public function updateAccount(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'password' => 'nullable|string|min:6',
            ],
            [
                'name.required' => 'Nama harus diisi.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'password.min' => 'Password minimal harus 6 karakter.',
            ],
        );

        $user = User::findOrFail($id);
        $user->nama = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->back()->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
