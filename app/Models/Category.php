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

    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var array<string, string>
     */
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
        return $this->getMedia('category-featured-image')->first()->getUrl();
    }
}
