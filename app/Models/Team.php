<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class Team extends Model
{
    
    protected $fillable = [
        'name',
        'email',
        'phone',
        'position',
        'image',
        'bio',
        'social_links',
        'status',
        'slug'
    ];

 protected static function boot()
    {
        parent::boot();

        // Handle creating
        static::creating(function ($team) {
            $slug = \Str::slug($team->name);
            $original = $slug;
            $i = 1;

            while (Team::where('slug', $slug)->exists()) {
                $slug = $original . '-' . $i++;
            }

            $team->slug = $slug;
        });

        // Handle updating
        static::updating(function ($team) {
            $slug = \Str::slug($team->name);
            $original = $slug;
            $i = 1;

            while (Team::where('slug', $slug)->where('id', '!=', $team->id)->exists()) {
                $slug = $original . '-' . $i++;
            }

            $team->slug = $slug;
        });
    } 


    public function getStatusAttribute()
    {
        return $this->attributes['status'] === 'active' ? 'Active' : 'Inactive';
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? url('uploads/team/' . $this->image) : null;
    }
}
