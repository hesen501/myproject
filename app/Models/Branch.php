<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'address',
        'phone',
        'working_hours',
        'google_iframe',
    ];
}
