<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'pgn', 
        'startingMove',
        'study_id',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function study()
    {
        return $this->belongsTo(Study::class, 'study_id');
    }
}
