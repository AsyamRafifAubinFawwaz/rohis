<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

class Activities extends Model
{
    use HasRichText, SoftDeletes;

    protected $richTextAttributes = [
        'description',
    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'event_start',
        'event_end',
        'poster',
        'created_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($activity) {
            if (empty($activity->slug)) {
                $activity->slug = \Illuminate\Support\Str::slug($activity->title);
            }
        });
    }

    protected function casts(): array
    {
        return [
            'event_start' => 'datetime',
            'event_end' => 'datetime',
        ];
    }

    /**
     * Hitung status otomatis berdasarkan event_start dan event_end.
     * - upcoming : sekarang < event_start
     * - ongoing  : event_start ≤ sekarang ≤ event_end
     * - done     : sekarang > event_end
     */
    public function getStatusAttribute(): string
    {
        if (! $this->event_start) {
            return 'upcoming';
        }

        $now = Carbon::now();
        $start = Carbon::parse($this->event_start);
        $end = $this->event_end ? Carbon::parse($this->event_end) : $start->copy()->addDay();

        if ($now->lt($start)) {
            return 'upcoming';
        }

        if ($now->lte($end)) {
            return 'ongoing';
        }

        return 'done';
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function galleries()
    {
        return $this->hasMany(Galleries::class, 'activity_id');
    }
}
