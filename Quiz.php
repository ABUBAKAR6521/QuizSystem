<?php

namespace App;

use App\Awnser;
use App\Catagory;
use App\Question;
use Illuminate\Database\Eloquent\Model;


class Quiz extends Model
{
    protected $table = 'quizez';
    protected $fillable = [
        'status', 'title', 'duration', 'no_questions', 'slug', 'description', 'catagory_id'
    ];
    public $timestamps = [
        'created_at', 'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo(Catagory::class, 'catagory_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(Awnser::class, 'quiz_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
