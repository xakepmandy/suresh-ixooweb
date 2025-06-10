<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Category;
use App\Models\SubCategory;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        // Logic to show the form for creating a new page
        $categories = Category::all();
        return view('admin.pages.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_hedding' => 'required|string|max:255',
            'page_title' => 'required|string|max:255',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'content' => 'required|string',
            'status' => 'required',
            'content' => 'required|string',
            'status' => 'required',
        ]);
        $page = new Page();
        $page->page_hedding = $request->page_hedding;
        $page->page_title = $request->page_title;
        $page->category_id = $request->category_id;
        $page->sub_category_id = $request->sub_category_id;
        $page->content = $request->content;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/page_images'), $imageName);
            $page->image =  $imageName;
        }
        $page->status = $request->status;
        $page->save();
        return redirect()->route('admin.pages')->with('success', 'Page created successfully.');
    }

    public function edit($id)
    {
        $page = Page::find($id);
        $categories = Category::all();
        $subcategories = SubCategory::where('category_id',$page->category_id)->get();
        return view('admin.pages.edit', compact('page', 'categories', 'subcategories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'page_hedding' => 'required|string|max:255',
            'page_title' => 'required|string|max:255',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'content' => 'required|string',
            'status' => 'required',
        ]);

        $page = Page::find($id);
        $page->page_hedding = $request->page_hedding;
        $page->page_title = $request->page_title;
        $page->category_id = $request->category_id;
        $page->sub_category_id = $request->sub_category_id;
        $page->content = $request->content;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/page_images'), $imageName);
            $page->image = $imageName;
        }else {
            $page->image = $page->image;
        }
        $page->status = $request->status;
        $page->save();
        return redirect()->route('admin.pages')->with('success', 'Page updated successfully.');
    }

    public function delete($id)
    {
        // Logic to delete a page
        $page = Page::find($id);
        if ($page->image && file_exists(public_path('uploads/blogimages/'.$page->image))) {
            unlink(public_path($page->image));
        }
        $page->delete();
        return redirect()->route('admin.pages')->with('success', 'Page deleted successfully.');
    }

    public function status(Request $request)
    {
        $page = Page::find($request->id);
        $page->status = !$page->status;
        $page->save();

        return response()->json(['message' => 'Page status updated successfully.']);
    }

    public function SubCatGet(Request $request)
    {
        $subcategories = SubCategory::where('category_id', $request->id)->get();
        
        return response()->json($subcategories);
    }
}
