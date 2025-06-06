<?php

namespace App\Http\Controllers;
use App\Models\Blog;    
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blogs()
    {
        $blogs = Blog::all();

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->status = $request->status;

        if ($request->hasFile('image')) {
            $uploadPath = public_path('uploads/blogimages');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $imageName);
            $blog->image = $imageName;
        }

        $blog->save();
        return redirect()->route('admin.blogs')->with('success', 'Blog post created successfully.');
    }

    public function edit($id)
    {
       
        $blog = Blog::findOrFail($id);
       
         return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $blog = Blog::findOrFail($id);
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->status = $request->status;
        if ($request->hasFile('image')) {
            $uploadPath = public_path('uploads/blogimages');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $imageName);
            $blog->image = 'uploads/blogimages/' . $imageName;
        }else {
            $blog->image = $blog->image;
        }
        $blog->save();
        return redirect()->route('admin.blogs')->with('success', 'Blog post updated successfully.');
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->image && file_exists(public_path('uploads/blogimages/'.$blog->image))) {
            unlink(public_path($blog->image));
        }
        $blog->delete();
        return redirect()->route('admin.blogs')->with('success', 'Blog post deleted successfully.');
    }
    public function status(Request $request)
    {
        
        $blog = Blog::findOrFail($request->id);
        $blog->status = !$blog->status; 
        $blog->save();
        return response()->json([
            'message' => 'Blog status updated successfully.',
        ]);
    }

  
}
