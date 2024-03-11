<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
          
    ];

    public function owner() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'study_users');
    }
    
    public function chapters() {
        return $this->hasMany(Chapter::class, 'study_id');
    }
}

