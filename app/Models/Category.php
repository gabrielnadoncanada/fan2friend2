<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    const PLACEHOLDER_IMAGE_URL = 'https://demofilament.test/placeholder.png';

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    protected $fillable = [
        'slug',
        'status',
        'notes',
    ];

    public function celebrities(): BelongsToMany
    {
        return $this->belongsToMany(Celebrity::class, 'category_celebrity', 'category_id', 'celebrity_id');
    }

    public function getImageAttribute()
    {
        $featuredImage = $this->getMedia('category-featured-image')->first();
        if ($featuredImage) {
            return $featuredImage->getUrl();
        }

        return self::PLACEHOLDER_IMAGE_URL;
    }
}
