<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $table =  'quiz_attempts';
    protected $fillable = [
        'id','user_id','quiz_id','total_correct','total_wrong','result'
    ];
    protected $timestamps = [
        'created_At','updated_At'
    ];

    public function quizes()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
