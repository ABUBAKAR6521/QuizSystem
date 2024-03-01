<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Awnser extends Model
{
    protected $table = 'awnsers';
    protected $fillable = [
        'category_id','no_awnsers', 'quiz_id', 'question_id', 'status', 'title', 'is_correct', 'description'
    ];

    public $timestamps = [
        'created_At', 'updated_At'
    ];
    public function category()
    {
        return $this->belongsTo(Catagory::class, 'category_id', 'id');
    }
    public function quizes()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }
    public function questions()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
