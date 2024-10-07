<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;


class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'parent_id'
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class ,'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class ,'parent_id');
    }



    public function setTitle($locale, $title): void
    {
        $this->translations()->updateOrCreate(
            ['locale' => $locale],
            ['title' => $title]
        );
    }

    public function getTitle($locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        $translation = $this->translations()->where('locale' ,$locale)->first();
        return $translation ? $translation->title : null;
    }
}
