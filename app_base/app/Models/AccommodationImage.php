<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'thumb',
        'src',
        'sort_order',
        'enabled'
    ];
}
