<?php

namespace App\Models;

use App\Constants\UserConst;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

class Posts extends Model
{
    use SoftDeletes, HasRichText;

    protected $richTextAttributes = [
        'content',
    ];

    protected $fillable = [
        'title',
        'slug',
        'content',
        'thumbnail',
        'status',
        'user_id',
        'approved_by',
        'approved_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'post_categories', 'post_id', 'category_id');
    }

    /**
     * Scope for active posts (not trashed)
     */
    public function scopeActive($query): mixed
    {
        return $query->whereNull('deleted_at');
    }

    /**
     * Scope for trashed posts only
     */
    public function scopeTrash($query): mixed
    {
        return $query->onlyTrashed();
    }

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = $value ?? Auth::id();
        $role = Auth::user()?->access_type ?? UserConst::ADMIN;

        if ($role == UserConst::SUPERADMIN) {
            $this->attributes['approved_by'] = Auth::id();
            $this->attributes['approved_at'] = now();
            $this->attributes['status'] = 'published';
        } else {
            $this->attributes['status'] = 'pending';
        }
    }
}
