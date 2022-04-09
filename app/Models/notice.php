<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notice extends Model
{
    use HasFactory;

    protected $fillable = ['des_ar', 'des_en','date','show','user_id','manage_id','project_id'];

    public function user () {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
