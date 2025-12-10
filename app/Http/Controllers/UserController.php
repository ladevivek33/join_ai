<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show registration form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle user registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.login')->with('success', 'Registration successful! Please login.');
    }

    // Show user login form
    public function showLogin()
    {
        return view('auth.ulogin');
    }

    // Handle user login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Find user by username
        $user = User::where('username', $request->username)->first();

        // Check if user exists and password matches
        if ($user && Hash::check($request->password, $user->password)) {
            // Set user session
            session([
                'user_logged_in' => true,
                'user_id' => $user->id,
                'user_name' => $user->name,
            ]);
            return redirect()->route('user.dashboard');
        }

        return back()->withErrors(['error' => 'Invalid username or password'])->withInput();
    }

    // Show user dashboard
    // Show user dashboard
    // Show user dashboard
    public function dashboard()
    {
        $products = Product::all();
        $requests = ProductRequest::where('user_id', session('user_id'))
            ->get()
            ->keyBy('product_id');
        return view('user.dashboard', compact('products', 'requests'));
    }

    // Handle product request
    public function requestProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);

        if ($request->qty > $product->qty) {
            return response()->json([
                'success' => false,
                'message' =>
                    'Requested quantity exceeds available stock.'
            ], 400);
        }

        ProductRequest::create([
            'user_id' => session('user_id'),
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'status' => 'pending',
        ]);

        return response()->json(['success' => true, 'message' => 'Product requested successfully!']);
    }

    // User logout
    public function logout()
    {
        session()->forget(['user_logged_in', 'user_id', 'user_name']);
        return redirect()->route('user.login')->with('success', 'Logged out successfully');
    }
}
