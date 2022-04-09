<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\rating;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'bio',
        'status',
        'country',
        'rating',
        'coins',
        'image',
        'phone',
        'belongs_to',
        'sub',
        'followers',
        'friends_id',
        'online_status',
        'email',
        'password',
        'google_id',
        'fb_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function projects()
    {
        return $this->hasMany(project::class, 'user_id');
    }

    public function followers()
    {
        return $this->hasMany(\App\Models\follower::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\comment::class, 'user_id');
    }

    public function notices()
    {
        return $this->hasMany(\App\Models\notice::class, 'user_id');
    }

    public function friends()
    {
        return $this->hasMany(friend::class, 'friend_id');
    }

    public function ratings()
    {
        return $this->hasMany(rating::class, 'user_id');
    }

    public function user_rate()
    {
        return $this->hasMany(rating::class, 'user_rate');
    }
}
