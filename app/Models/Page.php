<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'page_hedding',
        'page_title',
        'slug',
        'content',
        'image',
        'status',
    ];

      protected static function boot()
    {
        parent::boot();

        // Handle creating
        static::creating(function ($page) {
            $slug = \Str::slug($page->page_title);
            $original = $slug;
            $i = 1;

            while (Blog::where('slug', $slug)->exists()) {
                $slug = $original . '-' . $i++;
            }

            $page->slug = $slug;
        });

        // Handle updating
        static::updating(function ($page) {
            $slug = \Str::slug($page->page_title);
            $original = $slug;
            $i = 1;

            while (Blog::where('slug', $slug)->where('id', '!=', $page->id)->exists()) {
                $slug = $original . '-' . $i++;
            }

            $page->slug = $slug;
        });
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getImageUrlAttribute()
    {
        return url('uploads/page_images' . $this->image);
    }

    public function getStatusLabelAttribute()
    {
        return $this->status ? 'Active' : 'Inactive';
    }


}
