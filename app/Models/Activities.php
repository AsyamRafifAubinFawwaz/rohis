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
        'description',
        'location',
        'event_date',
        'poster',
        'created_by',
    ];

    /**
     * Hitung status otomatis berdasarkan event_date.
     * - upcoming : tanggal belum tiba
     * - ongoing  : hari H pelaksanaan
     * - done     : tanggal sudah lewat
     */
    public function getStatusAttribute(): string
    {
        if (! $this->event_date) {
            return 'upcoming';
        }

        $today = Carbon::today();
        $eventDate = Carbon::parse($this->event_date)->startOfDay();

        if ($today->lt($eventDate)) {
            return 'upcoming';
        }

        if ($today->eq($eventDate)) {
            return 'ongoing';
        }

        return 'done';
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
