<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\ContactMail; 

class UserController extends Controller
{
    public function users()
    {
        $users = User::where('role', 'user')->get(); 
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        // Logic to show user creation form
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
       
        $password =  Str::random(8);
        
        $request->validate([
            'name'=> 'required|string|max:255',
            'email'=> 'required|email|unique:users,email',
            'phone'=> 'required|string|max:15',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($password);
        $user->status = $request->status;

        if ($request->hasFile('profile_image')) {
            $uploadPath = public_path('uploads/profile_images');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $imageName);
            $user->profile_image = $imageName;
        }
        $user->save();
        // Send welcome email
        $data=[

        'email' => $user->email,
        'subject' => "Welcome to Our Platform",
        'message' => "Your account has been created successfully.\n\nYour login credentials are:\nEmail: " . $user->email . "\nPassword: " . $password,
        ];
        // Send email using Mailable class
        \Mail::to($user->email)->send(new ContactMail($data));

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function editUser($id)
    {
        // Logic to show user edit form
        $user = User::findOrFail($id);
        
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        // Logic to update user data
        $request->validate([
            'name'=> 'required|string|max:255',
            'email'=> 'required|email|unique:users,email,'.$id,
            'phone'=> 'required|string|max:15',
        ]);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = $request->status; 
        if ($request->hasFile('profile_image')) {
            $uploadPath = public_path('uploads/profile_images');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $imageName);
            $user->profile_image = $imageName;
        }else {
            $user->profile_image = $user->profile_image; 
        }
        $user->save();
        $data=[

        'email' => $user->email,
        'subject' => "Update to Your Account",
        'message' => "Your account has been updated successfully. \n\n If you have any questions, please contact us.",
        ];
        
        \Mail::to($user->email)->send(new ContactMail($data));

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        // Logic to delete a user
        $user = User::findOrFail($id);
        if ($user->profile_image && file_exists(public_path('uploads/profile_images/' . $user->profile_image))) {
            unlink(public_path('uploads/profile_images/' . $user->profile_image));
        }
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');


    }

    public function statusUser(Request $request)
    {
        // Logic to toggle user status (active/inactive)
        $user = User::findOrFail($request->id);
        $user->status = !$user->status;
        $user->save();
        return response()->json(['success' => true, 'message' => 'User status updated successfully.']);
    }
}
