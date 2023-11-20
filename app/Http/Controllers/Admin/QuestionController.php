<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view('Admin.Question.index', compact('questions'));
    }

    public function store(Request $request)
    {
        if (isset($request->questions)) {
            Question::query()->delete();
            foreach ($request->questions as $question) {
                if ($question != null) {
                    Question::create([
                        'question' => $question
                    ]);
                }
            }
        }

        return response()->json(['messages' => ['تم التعديل بنجاح'], 'success' => 'true']);
    }
}
