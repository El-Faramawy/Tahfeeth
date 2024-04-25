<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function lessons(){
        $data = Lesson::orderBy('number')->get();
        return apiResponse($data);
    }

}
