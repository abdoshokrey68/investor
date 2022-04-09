<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class follower extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','followers_id'];

    public function user () {
        return $this->belongsTo(\App\Models\User::class, 'followers_id');
    }

    public function projects () {
        return $this->hasMany(\App\Models\project::class, 'user_id', 'followers_id');
    }
}
