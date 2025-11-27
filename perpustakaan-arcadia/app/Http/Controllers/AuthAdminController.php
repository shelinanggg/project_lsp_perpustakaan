<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthAdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user_admin' => 'required',
            'pass_admin' => 'required'
        ]);

        $admin = Admin::where('user_admin', $request->user_admin)->first();

        if ($admin && Hash::check($request->pass_admin, $admin->pass_admin)) {
            session(['admin_id' => $admin->id_admin]);
            session(['admin_name' => $admin->nama_admin]);
            
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Username atau password salah!');
    }

    public function logout()
    {
        session()->forget(['admin_id', 'admin_name']);
        return redirect()->route('admin.login');
    }
}