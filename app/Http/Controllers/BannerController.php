<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory; 

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    if ($request->hasFile('image')) {
            $uploadPath = public_path('uploads/bannerimages');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $imageName);
            
        }

        Banner::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => $imageName,
            'link' => $request->link,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.banners')->with('success', 'Banner created successfully.');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/bannerimages'), $imageName);
            $banner->image = $imageName;
        }else {
            $banner->image = $banner->image; 
        }

        $banner->title = $request->title;
        $banner->subtitle = $request->subtitle;
        $banner->link = $request->link;
        $banner->status = $request->status;
        $banner->description = $request->description;

        $banner->save();

        return redirect()->route('admin.banners')->with('success', 'Banner updated successfully.');
    }

    public function delete($id)
    {
        $banner = Banner::findOrFail($id);
        if ($banner->image) {
            $imagePath = public_path('images/' . $banner->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        Banner::destroy($banner->id);
        return redirect()->route('admin.banners')->with('success', 'Banner deleted successfully.');
    }

    public function status(Request $request)
    {
        $banner = Banner::findOrFail($request->id);
        $banner->status = $banner->status === 'Active' ? 'inactive' : 'active';
        $banner->save();
        return response()->json([
            'message' => 'Banner status updated successfully.'
        ]);
    }

}
