<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_code',
        'cwb_number',
        'weight',
        'invoice',
        'currency_id',
        'quantity',
        'description',
        'user_id',
        'shelf_id',
        'status',
        'store',
        'is_liquid',
        'has_battery',
        'has_battery',
        'print',
        'waiting_declare_date',
        'type',
        'parcel_id',
        'delivery_cost',
        'delivery_cost_azn',
        'delivery_type',
        'delivery',
        'delivery_paid',
    ];

    public function parcel(): BelongsTo
    {
        return $this->belongsTo(Parcel::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }
}
