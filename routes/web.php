<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\TeamController;

// Route::get('/', function () {
//     return view('admin.dashboard');
// });


Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('admin')->middleware('checklogin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::put('/profile/update', [AdminController::class, 'profileUpdate'])->name('admin.profile.update');

    // change password
    Route::get('/change-password', [AdminController::class, 'changePassword'])->name('admin.change.password');
    Route::put('/update-password', [AdminController::class, 'updatePassword'])->name('admin.update.password');
    //logout
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    //category
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/category/store', [CategoryController::class, 'storeCategory'])->name('admin.category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'editCategory'])->name('admin.category.edit');
    Route::put('/category/update/{id}', [CategoryController::class, 'updateCategory'])->name('admin.category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('admin.category.delete');
    Route::post('/category/status', [CategoryController::class, 'statusCategory'])->name('admin.category.toggleStatus');
// subcategory
    Route::get('/subcategory/{id}', [SubCategoryController::class, 'index'])->name('admin.subcategory');
    Route::get('/subcategory/create/{id}', [SubCategoryController::class, 'create'])->name('admin.subcategory.create');
    Route::post('/subcategory/store', [SubCategoryController::class, 'store'])->name('admin.subcategory.store');
    Route::get('/subcategory/edit/{id}', [SubCategoryController::class, 'edit'])->name('admin.subcategory.edit');
    Route::put('/subcategory/update/{id}', [SubCategoryController::class, 'update'])->name('admin.subcategory.update');
    Route::get('/subcategory/delete/{id}', [SubCategoryController::class, 'delete'])->name('admin.subcategory.delete');
    Route::post('/subcategory/status', [SubCategoryController::class, 'status'])->name('admin.subcategory.toggleStatus');
//blogs
    Route::get('/blogs', [BlogController::class, 'blogs'])->name('admin.blogs');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('admin.blogs.create');
    Route::post('/blogs/store', [BlogController::class, 'store'])->name('admin.blogs.store');
    Route::get('/blogs/edit/{id}', [BlogController::class, 'edit'])->name('admin.blogs.edit');
    Route::put('/blogs/update/{id}', [BlogController::class, 'update'])->name('admin.blogs.update');
    Route::get('/blogs/delete/{id}', [BlogController::class, 'delete'])->name('admin.blogs.delete');
    Route::post('/blogs/status', [BlogController::class, 'status'])->name('admin.blogs.toggleStatus');

//contacts
    Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts');
    Route::get('/contacts/create', [ContactController::class, 'create'])->name('admin.contacts.create');
    Route::post('/contacts/store', [ContactController::class, 'store'])->name('admin.contacts.store');
    Route::get('/contacts/view/{id}', [ContactController::class, 'show'])->name('admin.contacts.view');
    Route::get('/contacts/delete/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.delete');
    // Route::post('/contacts/status/{id}', [ContactController::class, 'statusContact'])->name('admin.contacts.status');
    Route::get('/contacts/reply/{id}', [ContactController::class, 'reply'])->name('admin.contacts.reply');
    Route::post('/contacts/reply/store', [ContactController::class, 'storeReply'])->name('admin.contacts.reply.store');

//Team
    Route::get('/team', [TeamController::class, 'index'])->name('admin.team');
    Route::get('/team/create', [TeamController::class, 'create'])->name('admin.team.create');
    Route::post('/team/store', [TeamController::class, 'store'])->name('admin.team.store');
    Route::get('/team/edit/{id}', [TeamController::class, 'edit'])->name('admin.team.edit');
    Route::put('/team/update/{id}', [TeamController::class, 'update'])->name('admin.team.update');
    Route::get('/team/delete/{id}', [TeamController::class, 'delete'])->name('admin.team.delete');
    Route::post('/team/status', [TeamController::class, 'status'])->name('admin.team.toggleStatus');
   
//Banner
    Route::get('/banner', [BannerController::class, 'index'])->name('admin.banners');
    Route::get('/banner/create', [BannerController::class, 'create'])->name('admin.banner.create');
    Route::post('/banner/store', [BannerController::class, 'store'])->name('admin.banner.store');
    Route::get('/banner/edit/{id}', [BannerController::class, 'edit'])->name('admin.banner.edit');
    Route::put('/banner/update/{id}', [BannerController::class, 'update'])->name('admin.banner.update');
    Route::get('/banner/delete/{id}', [BannerController::class, 'delete'])->name('admin.banner.delete');   
    Route::post('/banner/status', [BannerController::class, 'status'])->name('admin.banner.toggleStatus');    
    
});
// Authentication routes

route::get('admin/login', function () { return view('admin.Signforms.login'); })->name('login');
Route::post('/login', [AdminController::class, 'login'])->name('admin.login');