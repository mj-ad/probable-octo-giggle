<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'description',
        'url',
        'image_url',
        'source_id',
        'author',
        'published_at'
    ];

    function source()
    {
        return $this->belongsTo(Source::class);
    }
}
