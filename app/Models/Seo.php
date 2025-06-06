<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $fillable = [
        'page_id',
        'blog_id',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_image',
        'seo_url',
        'seo_language'
    ,
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
    public function getSeoImageUrlAttribute()
    {
        return $this->seo_image ? url('uploads/seo_images/' . $this->seo_image) : null;
    }
    
}
