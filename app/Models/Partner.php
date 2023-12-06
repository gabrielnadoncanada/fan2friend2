<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Partner extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
    ];

    public function celebrities()
    {
        $this->hasMany(Celebrity::class);
    }

    public function getImageAttribute()
    {
        $featuredImage = $this->getMedia('partner-featured-image')->first();
        if ($featuredImage) {
            return $featuredImage->getUrl();
        }
    }
}
