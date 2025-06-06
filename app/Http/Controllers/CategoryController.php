<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
       
       
        $categories = Category::all();

        return view('admin.category.index', compact('categories'));
       
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function storeCategory(Request $request)
    {
        
        
        $data = $request->validate([
            'category_name' => 'required|string|max:255',
            'status' => 'required',
            ], [
            'category_name.required' => 'Category name is required.',
            'status.required' => 'Please select a status.',
        ]);

        $category = new Category();
        $category->name = $request->category_name;
        $category->status = $request->status;
        $category->save();
    
        return redirect()->route('admin.category')->with('success', 'Category created successfully.');
    }
    public function editCategory($id)
    {
        
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }
    public function updateCategory(Request $request, $id)
    {
        // Logic to update an existing category
          $data = $request->validate([
            'category_name' => 'required|string|max:255',
            'status' => 'required',
            ], [
            'category_name.required' => 'Category name is required.',
            'status.required' => 'Please select a status.',
        ]);


        // Find the category and update it
        $category = Category::findOrFail($id);
        $category->name = $request->category_name;
        $category->status = $request->status;
        $category->update();

        return redirect()->route('admin.category')->with('success', 'Category updated successfully.');
    }
    public function deleteCategory($id)
    {
        // Logic to delete a category
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.category')->with('success', 'Category deleted successfully.');
    }
    public function statusCategory(Request $request)
    
    {
        $category = Category::findOrFail($request->id);
        $category->status = !$category->status;
        $category->save();

       return response()->json([
            'message' => 'Category status updated successfully.'
        ]);
    }

}
