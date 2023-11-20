<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\PhotoTrait;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use App\Models\Question;

class TrackController extends Controller
{
    use PhotoTrait;

    //===========================================
    public function change_track(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'track' => 'required|in:beginner,high_level'
        ], [
            'track.required' => 'المسار مطلوب',
            'track.in' => 'المسار خطأ'
        ]);
        if ($validator->fails()) {
            return apiResponse(null, $validator->errors()->first(), '422');
        }
        $user = user_api()->user();
        $user->update(['track' => $request->track]);
        return apiResponse(['user' => $user]);
    }

    //===========================================
    public function store_records(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'records' => 'required|array'
        ], [
            'records.required' => 'التسجيلات مطلوبة',
        ]);
        if ($validator->fails()) {
            return apiResponse(null, $validator->errors()->first(), '422');
        }

        foreach ($request->records as $record) {
            Test::create([
                'user_id' => user_api()->id(),
                'record' => $this->saveImage($record, 'Uploads/Records'),
            ]);
        }
        $user = User::where('id', user_api()->id())->with('tests')->first();
        return apiResponse(['user' => $user]);
    }
    //===========================================
    public function questions(Request $request)
    {
        $questions = Question::all();
        return apiResponse($questions);
    }

}
