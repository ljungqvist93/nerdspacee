<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    protected $fillable = [
        'name',
        'fact_id',
    ];

    public function fact(): BelongsTo
    {
        return $this->belongsTo(Fact::class);
    }
}