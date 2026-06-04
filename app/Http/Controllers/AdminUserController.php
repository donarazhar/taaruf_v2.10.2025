<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        $user = Auth::guard('user')->user()->email;
        $datauser = DB::table('users')->where('email', $user)->first();
        
        $admins = DB::table('users')->orderBy('name', 'asc')->get();
        
        return view('dashboardadmin.masteradmin.index', compact('datauser', 'admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string|in:admin,murobi',
        ]);

        try {
            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            return redirect()->back()->with('success', 'Admin baru berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambah admin.');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|string|in:admin,murobi',
        ]);

        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'updated_at' => now()
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            DB::table('users')->where('id', $request->id)->update($data);

            return redirect()->back()->with('success', 'Data admin berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui admin.');
        }
    }

    public function destroy($id)
    {
        try {
            // Prevent deleting the currently logged-in admin
            $currentUser = Auth::guard('user')->user();
            if ($currentUser->id == $id) {
                return redirect()->back()->with('warning', 'Anda tidak dapat menghapus akun Anda sendiri.');
            }

            DB::table('users')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Admin berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus admin.');
        }
    }
}
