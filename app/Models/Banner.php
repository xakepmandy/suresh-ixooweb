<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Banner extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'link',
        'status',
        'slug',
        'description'
    ];



     protected static function boot()
    {
        parent::boot();

        // Handle creating
        static::creating(function ($banner) {
            $slug = \Str::slug($banner->title);
            $original = $slug;
            $i = 1;

            while (Banner::where('slug', $slug)->exists()) {
                $slug = $original . '-' . $i++;
            }

            $banner->slug = $slug;
        });

        // Handle updating
        static::updating(function ($banner) {
            $slug = \Str::slug($banner->title);
            $original = $slug;
            $i = 1;

            while (Banner::where('slug', $slug)->where('id', '!=', $banner->id)->exists()) {
                $slug = $original . '-' . $i++;
            }

            $banner->slug = $slug;
        });
    }



    public function getStatusAttribute()
    {
        return $this->attributes['status'] === 'active' ? 'Active' : 'Inactive';
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? url('uploads/bannerimages/' . $this->image) : null;
    }
    public function getLinkAttribute()
    {
        return $this->attributes['link'] ? url($this->attributes['link']) : null;
    }
}
