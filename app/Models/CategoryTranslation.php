<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CategoryTranslation extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'locale',
        'category_id'
    ];
}
