<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function faqs(Request $request){
        $data = Faq::all();
        return apiResponse($data);
    }

}
