<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = [
        'category_id', 'quiz_id','no_awnsers', 'question_title', 'question_status','question_description'
    ];
    public $timestapms = [
        'created_At', 'update_At'
    ];

    public function catagory()
    {
        return $this->belongsTo(Catagory::class, 'category_id', 'id');
    }

    public function quizes()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }
    public function awnsers()
    {
        return $this->hasMany(Awnser::class, 'question_id', 'id');
    }
}
