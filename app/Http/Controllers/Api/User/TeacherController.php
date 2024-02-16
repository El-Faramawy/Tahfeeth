<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class TeacherController extends Controller
{
    public function userTeachers()
    {
        $user = User::where('id',user_api()->id())->first();
        $teachers = $user->group?->teachers;
        return apiResponse($teachers);
    }

}
