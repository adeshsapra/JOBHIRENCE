<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'rating', 'feedback','is_feedback'];
    protected $table = 'feedbacks';

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
