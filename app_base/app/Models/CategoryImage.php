<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'description',
        'thumb',
        'src',
        'sort_order',
        'enabled'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
