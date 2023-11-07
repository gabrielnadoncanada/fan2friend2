<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Celebrity extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    const PLACEHOLDER_IMAGE_URL = 'https://demofilament.test/placeholder.png';

    protected $casts = [
        'featured' => 'boolean',
        'is_visible' => 'boolean',
        'published_at' => 'date',
        'variations' => 'array',
        'scheduleRules' => 'array',
    ];

    public function weeklySchedules()
    {
        return $this->hasMany(WeeklySchedule::class);
    }

    public function overrideDates()
    {
        return $this->hasMany(OverrideDate::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }


    public function getCategoryAttribute()
    {
        return $this->categories->first();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_celebrity', 'celebrity_id', 'category_id')->withTimestamps();
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function getImagesAttribute()
    {
        $celebrityImages = $this->getMedia('celebrity-images');

        if ($celebrityImages->count() > 0) {
            return $celebrityImages->map(fn($image) => $image->getUrl());
        }

        return [self::PLACEHOLDER_IMAGE_URL];
    }

    public function getImageAttribute()
    {
        $featuredImage = $this->getMedia('celebrity-featured-image')->first();
        if ($featuredImage) {
            return $featuredImage->getUrl();
        }

        return self::PLACEHOLDER_IMAGE_URL;
    }
}
