<?php

namespace App\Models;

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
        'status',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
