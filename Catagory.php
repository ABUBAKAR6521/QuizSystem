<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    protected $table = 'catagories';
    protected $fillable = [
        'catagory_name', 'catagory_status', 'created_At', 'updated_At'
    ];

    public $timestamps = [
        'create_At', 'updated_At'
    ];

    public function quizzez()
    {
        return $this->hasMany(Quiz::class, 'catagory_id', 'id');
    }
    public function questions()
    {
        return $this->hasMany(Question::class, 'category_id', 'id');
    }
    public function awnsers()
    {
        return $this->hasMany(Awnser::class, 'category_id', 'id');
    }
}
