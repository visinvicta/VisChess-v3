<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'move_number',
        'user_id',
        'study_id',
        'chapter_id',
    ];
    

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
