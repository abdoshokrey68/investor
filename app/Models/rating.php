<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class rating extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'user_rate', 'rate'];

    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user_rate () {
        return $this->belongsTo(User::class, 'user_rate');
    }
}
