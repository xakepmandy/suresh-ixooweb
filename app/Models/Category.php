<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'status',
        'image',
    ];

 
      protected static function boot()
    {
        parent::boot();

         static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

      static::updating(function ($category) {
            $slug = Str::slug($category->name);
            $original = $slug;
            $i = 1;

            // Ignore current record by ID
            while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                $slug = $original . '-' . $i++;
            }

            $category->slug = $slug;
        });

        static::creating(function ($category) {
            $slug = Str::slug($category->name);
            $original = $slug;
            $i = 1;
            
            while (Category::where('slug', $slug)->exists()) {
                $slug = $original . '-' . $i++;
            }

            $category->slug = $slug;
        });
    }


    public function subcategories() {
    return $this->hasMany(Subcategory::class);
}

}
