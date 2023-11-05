<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Celebrity extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * @var string
     */
    protected $table = 'celebrities';

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'featured' => 'boolean',
        'is_visible' => 'boolean',
        'published_at' => 'date',
        'schedules' => 'array',
        'variations' => 'array',
    ];

    public function getCategoryAttribute()
    {
        return $this->categories->first();
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
        return $this->getMedia('celebrity-images')->map(fn($image) => $image->getUrl());
    }

    public function getImageAttribute()
    {
        return $this->getMedia('celebrity-featured-image')->first()->getUrl();
    }
}
