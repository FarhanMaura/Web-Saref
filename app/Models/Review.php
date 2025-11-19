<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'rating',
        'comment',
        'is_visible'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get the replies for the review.
     */
    public function replies()
    {
        return $this->hasMany(ReviewReply::class);
    }

    /**
     * Get the visible replies for the review.
     */
    public function visibleReplies()
    {
        return $this->hasMany(ReviewReply::class)->visible();
    }

    /**
     * Check if review has any replies.
     */
    public function hasReplies()
    {
        return $this->replies()->count() > 0;
    }

    /**
     * Get the latest reply for the review.
     */
    public function latestReply()
    {
        return $this->hasOne(ReviewReply::class)->latest();
    }
}
