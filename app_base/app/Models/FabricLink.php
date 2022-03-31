<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FabricLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'link',
        'sort_order',
        'enabled'
    ];
}
