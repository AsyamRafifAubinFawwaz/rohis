<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostsCategories extends Model
{
    protected $fillable = [
        'post_id',
        'category_id',
    ];

    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
