<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'slug',
        'title',
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
    }
}
