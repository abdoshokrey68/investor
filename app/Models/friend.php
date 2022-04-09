<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class friend extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','friend_id','date','status'];

    public function user () {
        return $this->belongsTo(User::class, 'friend_id');
    }


    // public function user() {
    //     return $this->hasMany(User::class, 'user_id');
    // }

}
