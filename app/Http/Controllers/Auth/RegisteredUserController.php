<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('Admin.auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'user_type' => ['required', Rule::in(['customer', 'restaurant_owner', 'admin', 'moderator'])],
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile image upload
        $profileImagePath = null;
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'profile_image' => $profileImagePath,
            'user_type' => $request->user_type,
            'status' => 'active', // Default status
        ]);

        // Assign role based on user_type
        $user->assignRole($request->user_type);

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on role
        return $this->redirectBasedOnRole($user);
    }

    /**
     * Redirect user based on their role
     */
    protected function redirectBasedOnRole($user)
    {
        dd($user);
        if ($user->hasRole('admin')) {
            return redirect()->route('second', ['dashboards', 'index']);
        } elseif ($user->hasRole('moderator')) {
            return redirect()->route('second', ['dashboards', 'index']); // or moderator dashboard
        } elseif ($user->hasRole('restaurant_owner')) {
            return redirect()->route('second', ['dashboards', 'index']); // or restaurant dashboard
        } else {
            return redirect()->route('second', ['dashboards', 'index']); // or customer dashboard
        }
    }
}
