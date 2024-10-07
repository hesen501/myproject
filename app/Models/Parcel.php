<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $ticket_number
 * @property int $branch_id
 * @property int $warehouse_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Parcel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Parcel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Parcel query()
 * @method static \Illuminate\Database\Eloquent\Builder|Parcel whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parcel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parcel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parcel whereTicketNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parcel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parcel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parcel whereWarehouseId($value)
 * @mixin \Eloquent
 */
class Parcel extends Model
{
    use HasFactory;
}
