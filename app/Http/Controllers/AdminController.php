<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard');
    }
   
    public function login(Request $request)
    {
       $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
        ]);

        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }
    }


    public function profile()
    {
        $user = auth()->user();
        return view('admin.Signforms.profile', compact('user'));
    }
    public function profileUpdate(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->hasFile('profile_image')) {
            $request->validate([
                'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], [
                'profile_image.image' => 'Profile image must be an image file.',
                'profile_image.mimes' => 'Profile image must be a file of type: jpeg, png, jpg, gif, svg.',
                'profile_image.max' => 'Profile image must not be greater than 2MB.',
            ]);

            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('images'), $imageName);
            $user->profile_image = $imageName;
        }
        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }
    public function changePassword()
    {
        return view('admin.Signforms.changepassword');
    }
    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Current password is required.',
            'new_password.required' => 'New password is required.',
            'new_password.min' => 'New password must be at least 6 characters.',
            'new_password.confirmed' => 'New password confirmation does not match.',
        ]);

        if (!password_verify($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Password updated successfully.');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
