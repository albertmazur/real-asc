<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'reason',
        'comment_id'
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
