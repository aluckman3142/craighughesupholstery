<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpholsteryClassEnquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'project_description',
        'width',
        'height',
        'depth',
        'start_date',
        'end_date',
        'days_required',
        'image',
        'type',
        'status',
    ];
}
