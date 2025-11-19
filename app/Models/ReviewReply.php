<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'review_id',
        'user_id',
        'reply_message',
        'is_visible'
    ];

    /**
     * Get the review that owns the reply.
     */
    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    /**
     * Get the user that owns the reply.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include visible replies.
     */
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }
}
