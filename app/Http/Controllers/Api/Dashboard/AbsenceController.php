<?php

namespace App\Http\Controllers\Api\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Absence;

class AbsenceController extends Controller
{
    public function approve_absence(Request $request)
    {
        try {
            $absence_id = $request->route('absence_id');
            $absence = Absence::findOrFail($absence_id);
            $absence->approve();
            return apiResponse(null, 'تم بنجاح');
        } catch (\Exception $ex) {
            return apiResponse($ex->getCode(), $ex->getMessage(), '500');
        }
    }

    public function reject_absence(Request $request)
    {
        try {
            $absence_id = $request->route('absence_id');
            $absence = Absence::findOrFail($absence_id);
            $absence->reject();
            return apiResponse(null, 'تم بنجاح');
        } catch (\Exception $ex) {
            return apiResponse($ex->getCode(), $ex->getMessage(), '500');
        }
    }
}
