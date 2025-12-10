<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Show admin login form
    public function showAdminLogin()
    {
        return view('auth.alogin');
    }

    // Handle admin login
    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Static credentials check
        if ($request->username === 'admin' && $request->password === 'admin123') {
            // Set admin session
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['error' => 'Invalid admin credentials'])->withInput();
    }

    // Show admin dashboard
    public function adminDashboard()
    {
        $users = \App\Models\User::all();
        $products = \App\Models\Product::all();
        $requests = \App\Models\ProductRequest::with(['user', 'product'])->get();
        return view('admin.dashboard', compact('users', 'products', 'requests'));
    }

    // Show user details
    public function showUser($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('admin.user_details', compact('user'));
    }

    // Delete product request
    public function deleteRequest($id)
    {
        $request = \App\Models\ProductRequest::findOrFail($id);
        $request->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Request deleted successfully!');
    }

    // Admin logout
    public function adminLogout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login')->with('success', 'Logged out successfully');
    }
}
