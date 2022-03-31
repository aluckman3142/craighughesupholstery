<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'button_text',
        'button_path',
        'image_path',
        'sort_order',
        'enabled'
    ];
}
