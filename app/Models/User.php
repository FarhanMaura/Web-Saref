<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Order;
use App\Models\Review;
use App\Models\ReviewReply;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';
    const ROLE_MAIN_ADMIN = 'main_admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the orders for the user.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the reviews for the user.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the review replies for the user.
     */
    public function reviewReplies()
    {
        return $this->hasMany(ReviewReply::class);
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_MAIN_ADMIN]);
    }

    /**
     * Check if user is main admin
     */
    public function isMainAdmin()
    {
        return $this->role === self::ROLE_MAIN_ADMIN;
    }

    /**
     * Check if user can manage users
     */
    public function canManageUsers()
    {
        return $this->isMainAdmin();
    }

    /**
     * Get role badge color
     */
    public function getRoleBadgeColor()
    {
        return match($this->role) {
            self::ROLE_MAIN_ADMIN => 'bg-purple-100 text-purple-800',
            self::ROLE_ADMIN => 'bg-blue-100 text-blue-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Get role display name
     */
    public function getRoleDisplayName()
    {
        return match($this->role) {
            self::ROLE_MAIN_ADMIN => 'Main Admin',
            self::ROLE_ADMIN => 'Admin',
            default => 'User'
        };
    }

    /**
     * Get user's phone number formatted
     */
    public function getFormattedPhone()
    {
        if (!$this->phone) {
            return 'Belum diisi';
        }

        // Format phone number if it starts with 62 or 0
        $phone = $this->phone;
        if (str_starts_with($phone, '62')) {
            $phone = '+' . $phone;
        } elseif (str_starts_with($phone, '0')) {
            $phone = '+62' . substr($phone, 1);
        }

        return $phone;
    }
}
