<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'title',
        'slug',
        'short_desc',
        'long_desc',
        'button_text',
        'button_path',
        'image_path',
        'sort_order',
        'enabled'
    ];

    public function images()
    {
        return $this->hasMany(CategoryImage::class, 'category_id', 'id');
    }

    public function inUse(): bool
    {
        if (count($this->images) > 0) {
            return true;
        }
        return false;
    }
}
