<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'comment',
        'status',
        'date',
        'user_id',
        'project_id'
    ];

    public function user () {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function project () {
        return $this->belongsTo(\App\Models\project::class, 'project_id');
    }
}
