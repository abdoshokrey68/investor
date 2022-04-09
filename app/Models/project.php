<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\follower;
use Illuminate\Database\Eloquent\SoftDeletes;

class project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'des', 'date', 'tags', 'image', 'status', 'min_price', 'user_id', 'deleted_at '];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function followers()
    {
        return $this->belongsTo(follower::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\comment::class, 'project_id');
    }

    public static function search($value)
    {
        return static::where('des', 'LIKE', '%' . $value . '%');
    }
}
