<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $news_id
 * @property string $locale
 * @property string $title
 * @property string $description
 * @property string $slogan
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|NewsTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsTranslation whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsTranslation whereNewsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsTranslation whereSlogan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsTranslation whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsTranslation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NewsTranslation extends Model
{
    use HasFactory;
}
