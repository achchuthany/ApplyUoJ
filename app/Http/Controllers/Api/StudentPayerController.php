<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enroll;
use App\Models\Programme;
use Illuminate\Http\Request;

class StudentPayerController extends Controller
{
    public function index(Request $request)
    {
        $payer_id = $request->query('id');
        if (!$payer_id) {
            return response()->json(['message' => 'Payer ID is missing'], 404);
        }
        if (strlen($payer_id) != 7) {
            return response()->json(['message' => 'Payer ID length is incorrect'], 400);
        }

        $year = '20'.substr($payer_id, 0, 2);
        $programme_id = substr($payer_id, 2, 2);
        $enroll_number = substr($payer_id, 4, 3);

        $programme = Programme::where('id', $programme_id)->first();
        if (!$programme) {
            return response()->json(['message' => 'Programme not found!'], 404);
        }

        $registration_number = $year.'/'.$programme->abbreviation.'/'.$enroll_number;

        $enroll = Enroll::where('reg_no', $registration_number)->with('student')->first();

        if (!$enroll) {
            return response()->json(['message' => 'Student not found!'], 404);
        }

        return response()->json([
            'student'=>[
                'registration_no' => $enroll->reg_no,
                'name' => $enroll->student->name_initials,
                'programme' => $enroll->programme->name
            ]
        ]);
    }
}
