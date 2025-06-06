<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function index($id)
    {
        // Logic to display all subcategories
        $category = Category::find($id);
        $subcategories = SubCategory::where('category_id', $id)->with('category')->get(); 
        
        return view('admin.subcategory.index', compact('subcategories','category'));
    }

    public function create($id)
    {
        $categories = Category::where('id',$id)->first(); 
        return view('admin.subcategory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        
       $request->validate([
            'subcategory_name' => 'required|string|max:255',
            'category_id' => 'required',
            'status' => 'required|boolean',
        ], [
            'subcategory_name.required' => 'Subcategory name is required.',
            'category_id.required' => 'Category is required.',
            'status.required' => 'Status is required.',
        ]);
        $subcategory = new SubCategory();
        $subcategory->name = $request->subcategory_name;
        $subcategory->category_id = $request->category_id;
        $subcategory->status = $request->status;        

        $subcategory->save();

        return redirect()->route('admin.subcategory',$request->category_id)->with('success', 'Subcategory created successfully.');
    }

    public function edit($id)
    {
        // Logic to show the form for editing an existing subcategory
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::where('status', 1)->get(); // Fetch active categories
       
        return view('admin.subcategory.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing subcategory
        $subcategory = SubCategory::findOrFail($id);
        $request->validate([
            'subcategory_name' => 'required|string|max:255',
            'category_id' => 'required',
            'status' => 'required|boolean',
        ], [
            'subcategory_name.required' => 'Subcategory name is required.',
            'category_id.required' => 'Category is required.',
            'status.required' => 'Status is required.',
        ]);

        $subcategory->name = $request->subcategory_name;
        $subcategory->category_id = $request->category_id;
        $subcategory->status = $request->status;
        $subcategory->update();
        return redirect()->route('admin.subcategory',$request->category_id)->with('success', 'Subcategory updated successfully.');

   
    }
    public function delete($id)
    {
        
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();

        return redirect()->route('admin.subcategory',$subcategory->category_id)->with('success', 'Subcategory deleted successfully.');
    }
    public function status(Request $request)
    {
        
        $subcategory = SubCategory::findOrFail($request->id);
        $subcategory->status = !$subcategory->status; 
        $subcategory->save();

        return response()->json(['message' => 'Status updated successfully.', 'id' => $subcategory->category_id]);
    }
}
