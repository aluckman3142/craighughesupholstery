<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeforeAfter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'before_src',
        'after_src',
        'sort_order',
        'enabled'
    ];
}
