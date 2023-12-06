<?php

namespace App\Models;

use App\Traits\Search;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Celebrity extends Model implements HasMedia
{
    use HasFactory;
    use Search;
    use InteractsWithMedia;

    protected $fillable = [
        'first_name',
        'last_name',
        'description',
        'images',
        'featured_image',
        'user_id',
        'slug',
        'is_featured',
    ];

    protected $searchable = [
        'first_name',
        'last_name',
        'description',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'date',
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
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

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }


    public function getImagesAttribute()
    {
        $celebrityImages = $this->getMedia('celebrity-images');

        if ($celebrityImages->count() > 0) {
            return $celebrityImages->map(fn($image) => $image->getUrl());
        }

        return collect();
    }

    public function getImageAttribute()
    {
        $featuredImage = $this->getMedia('celebrity-featured-image')->first();
        if ($featuredImage) {
            return $featuredImage->getUrl();
        }
    }

    public function scheduleRules()
    {
        return $this->hasMany(ScheduleRule::class);
    }

    public function scheduleRuleExceptions()
    {
        return $this->hasMany(ScheduleRuleException::class);
    }

}
