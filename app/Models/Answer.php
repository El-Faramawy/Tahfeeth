<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    public function additions(){
        return $this->hasMany(Addition::class,'addition_category_id');
    }
}
