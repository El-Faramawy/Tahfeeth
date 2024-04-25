<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotes extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function lesson_subject(){
        return $this->belongsTo(LessonSubject::class);
    }
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
