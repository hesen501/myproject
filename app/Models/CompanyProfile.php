<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'address',
        'email',
        'phone',
        'whatsapp',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'map_location'
    ];
}
