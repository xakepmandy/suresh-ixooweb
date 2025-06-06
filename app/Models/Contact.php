<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'inquiry',
        'file',
        'company',
        'status',
        'message'
    ];

   
public function getStatusAttribute()
{
    $value = $this->attributes['status'];
    return $value === 'pending' ? 'Pending' : 'Resolved';
}


  
public function getImageUrlAttribute()
{
    $file = $this->attributes['file'] ?? null;

    if (!$file) {
        return null;
    }

    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (in_array($extension, $imageExtensions)) {
        return Storage::url('contact_files/' . $file);
    }
    return null;
}
    
}
