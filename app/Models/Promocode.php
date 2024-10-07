<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property int $country_id
 * @property float $discount
 * @property float $balance_limit
 * @property int $use_limit
 * @property int $currency_id
 * @property int $status
 * @property int $delete_deactives
 * @property string $start_date
 * @property string $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Promocode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Promocode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Promocode query()
 * @method static \Illuminate\Database\Eloquent\Builder|Promocode whereBalanceLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promocode whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promocode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promocode whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promocode whereDeleteDeactives($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promocode whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promocode whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promocode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promocode whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promocode whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promocode whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promocode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promocode whereUseLimit($value)
 * @mixin \Eloquent
 */
class Promocode extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'country_id',
        'discount',
        'balance_limit',
        'currency_id',
        'use_limit',
        'delete_deactives',
        'start_date',
        'end_date',
        'status',
    ];
}
