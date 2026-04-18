<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class organizer extends Model
{
    use SoftDeletes;

    protected $table = 'organizer';

    protected $fillable = [
        'name',
        'jabatan',
        'image',
        'periode',
    ];
}
