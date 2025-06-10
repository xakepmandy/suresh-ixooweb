<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class SubCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'status',
        'image',
        'category_id',
    ];

   

protected static function boot()
{
    parent::boot();

    // Handle creating
    static::creating(function ($subcategory) {
        $slug = Str::slug($subcategory->name);
        $original = $slug;
        $i = 1;

        
        while (SubCategory::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $i++;
        }

        $subcategory->slug = $slug;
    });

    // Handle updating
    static::updating(function ($subcategory) {
        $slug = Str::slug($subcategory->name);
        $original = $slug;
        $i = 1;

        while (SubCategory::where('slug', $slug)->where('id', '!=', $subcategory->id)->exists()) {
            $slug = $original . '-' . $i++;
        }

        $subcategory->slug = $slug;
    });
}

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function pages() {
    return $this->hasMany(Page::class);
}
}
