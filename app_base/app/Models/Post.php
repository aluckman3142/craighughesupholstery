<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'title',
        'slug',
        'intro_text',
        'main_text',
        'published_date',
        'published_by',
        'link',
        'enabled'
    ];

    public function images()
    {
        return $this->hasMany(PostImage::class, 'post_id', 'id');
    }
}
