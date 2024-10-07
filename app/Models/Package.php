<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $tracking_code
 * @property string $cwb_number
 * @property float $weight
 * @property float $invoice
 * @property string $currency_id
 * @property int $quantity
 * @property string $description
 * @property string $invoice_file
 * @property int $user_id
 * @property int|null $shelf_id
 * @property string $store
 * @property int $is_liquid
 * @property int $has_battery
 * @property int $print
 * @property int $status
 * @property int $waiting_declare_date
 * @property string $type
 * @property int|null $parcel_id
 * @property float $delivery_cost
 * @property float $delivery_cost_azn
 * @property int $warehouse_id
 * @property string $delivery_type
 * @property string $delivery
 * @property int $delivery_paid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package query()
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereCwbNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereDeliveryCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereDeliveryCostAzn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereDeliveryPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereDeliveryType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereHasBattery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereInvoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereInvoiceFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereIsLiquid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereParcelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package wherePrint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereShelfId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereStore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereTrackingCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereWaitingDeclareDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereWarehouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereWeight($value)
 * @mixin \Eloquent
 */
class Package extends Model
{
    use HasFactory;
}
