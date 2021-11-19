<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }
    public function answer()
    {
        return $this->belongsTo('App\Models\Answer');
    }
}
