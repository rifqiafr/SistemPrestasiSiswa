<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'rank_grade',
        'competition_level',
        'organizer',
        'event_date',
        'description',
        'mentor_name',
        'is_featured',
        'status',
        'created_by',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_featured' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'achievement_participants')
                    ->withTimestamps();
    }

    public function media(): HasMany
    {
        return $this->hasMany(AchievementMedia::class);
    }

    public function coverMedia()
    {
        return $this->hasOne(AchievementMedia::class)->where('is_cover', true);
    }

    public function photos()
    {
        return $this->hasMany(AchievementMedia::class)->where('file_type', 'photo');
    }

    public function certificates()
    {
        return $this->hasMany(AchievementMedia::class)->where('file_type', 'certificate');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
