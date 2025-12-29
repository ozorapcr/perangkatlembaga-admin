<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nim',
        'prodi',
        'photo_path',
        'linkedin_url',
        'github_url',
        'instagram_url',
        'twitter_url',
        'facebook_url',
    ];

    protected $appends = ['photo_url'];

    public function getPhotoUrlAttribute()
    {
        if ($this->photo_path) {
            return asset('storage/' . $this->photo_path);
        }
        
        // Default photo jika tidak ada
        return 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=774&q=80';
    }
}