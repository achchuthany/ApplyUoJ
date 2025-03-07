<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/up', function () {
    return response()->json(['message' => 'Public Access granted!']);
});

Route::middleware('client')->group(function () {
    Route::get('/student-payer', 'App\Http\Controllers\Api\StudentPayerController@index');
});
