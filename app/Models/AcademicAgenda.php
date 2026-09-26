<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AcademicAgenda extends Model
{
    protected $fillable = [
        'title',
        'event_date',
        'time',
        'location',
        'status',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Scope only active agendas.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getDayAttribute(): string
    {
        return $this->event_date ? $this->event_date->format('d') : '01';
    }

    public function getMonthAttribute(): string
    {
        return $this->event_date ? strtoupper($this->event_date->translatedFormat('M')) : 'JAN';
    }

    public function getYearAttribute(): string
    {
        return $this->event_date ? $this->event_date->format('Y') : date('Y');
    }
}
