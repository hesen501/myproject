<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


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

    public function parcels(): HasMany
    {
        return $this->hasMany(Parcel::class);
    }
}
