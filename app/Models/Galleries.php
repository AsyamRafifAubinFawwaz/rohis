<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galleries extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'image',
        'activity_id',
        'uploaded_by',
        'created_by'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function activity()
    {
        return $this->belongsTo(Activities::class, 'activity_id');
    }
}
