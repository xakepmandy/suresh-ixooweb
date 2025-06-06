<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        // Handle creating
        static::creating(function ($blog) {
            $slug = \Str::slug($blog->title);
            $original = $slug;
            $i = 1;

            while (Blog::where('slug', $slug)->exists()) {
                $slug = $original . '-' . $i++;
            }

            $blog->slug = $slug;
        });

        // Handle updating
        static::updating(function ($blog) {
            $slug = \Str::slug($blog->title);
            $original = $slug;
            $i = 1;

            while (Blog::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
                $slug = $original . '-' . $i++;
            }

            $blog->slug = $slug;
        });
    }

    public function getImageUrlAttribute()
    {
        return asset('/uploads/blogimages/'.$this->image);
    }
    public function getStatusLabelAttribute()
    {
        return $this->status ? 'Active' : 'Inactive';
    }
    public function getStatusClassAttribute()
    {
        return $this->status ? 'badge bg-success' : 'badge bg-danger';
    }
}
