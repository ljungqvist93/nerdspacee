<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Fact extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'slug',
        'length',
        'sources',
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function getCoverImageAttribute()
    {
        return $this->images->first();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}