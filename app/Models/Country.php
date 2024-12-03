<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'iso_code',
        'currency_id',
        'weight_id',
        'length_id',
        'commission',
        'status',
    ];

    public function tariffs(): HasMany
    {
        return $this->hasMany(Tariff::class);
    }

    public function warehouses(): HasMany
    {
        return $this->hasMany(Warehouse::class);
    }
}
