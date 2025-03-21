<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enroll;
use App\Services\LuhnService;
use Illuminate\Http\Request;

class StudentPayerController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $payer_id = $request->query('id');

        //Validate an 8-digit number with checksum prepended
        if (!LuhnService::validatePrepend($payer_id)) {
            return response()->json(['message' => 'The provided Payer Number is not valid.'], 400);
        }

        $enroll = Enroll::where('payer_id', $payer_id)->with('student')->first();

        if (!$enroll) {
            return response()->json(['message' => 'The provided Payer Number does not exist!'], 404);
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
