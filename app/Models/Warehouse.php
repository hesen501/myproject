<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property int $country_id
 * @property int $city_id
 * @property int $region_id
 * @property string $phone
 * @property string $address
 * @property string $tc_identity
 * @property int $flights_weekly
 * @property string $default_website
 * @property float $weight_limit
 * @property string $currency_id
 * @property int $print_label
 * @property int $parcelling
 * @property int $auto_print
 * @property int $packaging
 * @property string $fake_invoice
 * @property int $show_label
 * @property int $show_invoice
 * @property string $neighborhood
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\City $city
 * @property-read \App\Models\Country $country
 * @property-read \App\Models\Region $region
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereAutoPrint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereDefaultWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereFakeInvoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereFlightsWeekly($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereNeighborhood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse wherePackaging($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereParcelling($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse wherePrintLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereShowInvoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereShowLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereTcIdentity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereWeightLimit($value)
 * @mixin \Eloquent
 */
class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'country_id',
        'city_id',
        'region_id',
        'phone',
        'address',
        'tc_identity',
        'flights_weekly',
        'default_website',
        'weight_limit',
        'currency_id',
        'print_label',
        'parcelling',
        'fake_invoice',
        'auto_print',
        'packaging',
        'show_label',
        'fake_invoice',
        'show_invoice',
        'neighborhood',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}
