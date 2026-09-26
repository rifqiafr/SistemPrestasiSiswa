<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'image_url',
        'author',
        'is_published',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'date',
        ];
    }

    /**
     * Scope only published news items.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    /**
     * Accessor for 'image' compatible with landing page views.
     */
    public function getImageAttribute(): ?string
    {
        return $this->image_url;
    }

    /**
     * Accessor for formatted date string.
     */
    public function getDateAttribute(): string
    {
        return $this->published_at ? $this->published_at->translatedFormat('d F Y') : $this->created_at->translatedFormat('d F Y');
    }
}
