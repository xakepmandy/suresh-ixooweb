<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Banner;
use App\Models\Team;
use App\Models\Page;
use App\Models\Seo;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index()
    {
        $users = User::where('role', 'user')->get()->count();
        $pagestotalViews = Page::sum('page_view_count');
        $blogstotalViews = Blog::sum('blog_view_count');
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('login')->withErrors(['access' => 'You do not have access to this page.']);
        }
        
    return view('admin.dashboard', compact('users','blogstotalViews', 'pagestotalViews'));
       
    }

    public function getMonthlyUserStats()
        {
           
            $userStats = User::select(
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('COUNT(*) as total')
                )
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->pluck('total', 'month');

            // सभी महीनों को 0 से initialize करें
            $monthlyData = array_fill(1, 12, 0);

            foreach ($userStats as $month => $count) {
                if ($month >= 1 && $month <= 12) { // ✅ Only valid months
            $monthlyData[$month] = $count;
        }

            }

            return response()->json(array_values($monthlyData)); // return as [Jan => 120, Feb => 200, ...]
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
