<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Page;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function show($slug)
{
    $subcat = Subcategory::where('slug', $slug)->where('status', 1)->firstOrFail();
    $page = Page::where('sub_category_id', $subcat->id)->where('status', 1)->firstOrFail();

    return view('front.pages', compact('page'));
}


   
}
