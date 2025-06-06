<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seo;
use App\Models\Page;

class SeoController extends Controller
{
    public function index($id)
    {
        $page = Page::find($id);
        $seo = Seo::where('page_id', $id)->get();
        return view('admin.seo.index', compact('seo', 'page'));
    }

    public function create($id)
    {
        $page = Page::find($id);
        return view('admin.seo.create', compact('page'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'seo_title' => 'required|string|max:255',
            'seo_description' => 'required|string|max:500',
            'seo_keywords' => 'required|string|max:255',
            'seo_url' => 'required|url',
            'seo_language' => 'required|string|max:10',
            'seo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $page = new Seo();
        $page->seo_title = $request->seo_title;
        $page->seo_description = $request->seo_description;
        $page->seo_keywords = $request->seo_keywords;
        $page->seo_url = $request->seo_url;
        $page->seo_language = $request->seo_language;
        $page->page_id = $request->page_id;
        if ($request->hasFile('seo_image')) {
            $image = $request->file('seo_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/seo_images'), $imageName);
            $page->seo_image = $imageName;
        }
        $page->save();
        return redirect()->route('admin.pages')->with('success', 'SEO data created successfully.');
    }

    public function edit($id)
    {
       
        $seoData = Seo::findOrFail($id);
        return view('admin.seo.edit', compact('seoData'));
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'seo_title' => 'required|string|max:255',
            'seo_description' => 'required|string|max:500',
            'seo_keywords' => 'required|string|max:255',
            'seo_url' => 'required|url',
            'seo_language' => 'required|string|max:10',
            'seo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $seo = Seo::findOrFail($id);
        $seo->seo_title = $request->seo_title;
        $seo->seo_description = $request->seo_description;
        $seo->seo_keywords = $request->seo_keywords;
        $seo->seo_url = $request->seo_url;
        $seo->seo_language = $request->seo_language;
        if ($request->hasFile('seo_image')) {
            $image = $request->file('seo_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/seo_images'), $imageName);
            $seo->seo_image = $imageName;
        }else {
            $seo->seo_image = $seo->seo_image; 
        }
        $seo->page_id = $request->page_id;
        $seo->save();
        return redirect()->route('admin.pages')->with('success', 'SEO data updated successfully.');
    }

    public function delete($id)
    {
        
        $seo = Seo::findOrFail($id);
        if ($seo->seo_image) {
            $imagePath = public_path('uploads/seo_images/' . $seo->seo_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $seo->delete();
        return redirect()->route('admin.pages')->with('success', 'SEO data deleted successfully.');
    }
}
