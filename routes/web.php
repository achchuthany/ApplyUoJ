<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth','verified']], function () {

    Route::get('/home',[
        'uses' => 'App\Http\Controllers\HomeController@index',
        'as' => 'home'
    ]);
    //student
    Route::get('/admin/students',[
        'uses' => 'App\Http\Controllers\StudentController@index',
        'as' => 'admin.students.index'
    ]);

    Route::get('/admin/students/upload',[
        'uses' => 'App\Http\Controllers\StudentController@upload',
        'as' => 'admin.students.upload'
    ]);
    Route::post('/admin/students/upload/check',[
        'uses' => 'App\Http\Controllers\StudentController@parseImport',
        'as' => 'admin.students.upload.check'
    ]);
    Route::get('/admin/students/upload/check/{pid}/{aid}/{id}',[
        'uses' => 'App\Http\Controllers\StudentController@uploadPreview',
        'as' => 'admin.students.upload.view'
    ]);
    Route::post('/admin/students/upload/process',[
        'uses' => 'App\Http\Controllers\StudentController@processImport',
        'as' => 'admin.students.upload.process'
    ]);

    Route::get('/admin/students/upload/completed',[
        'uses' => 'App\Http\Controllers\StudentController@processCompleted',
        'as' => 'admin.students.upload.completed'
    ]);


    //Faculty

    Route::get('/admin/faculties',[
        'uses' => 'App\Http\Controllers\FacultyController@index',
        'as' => 'admin.faculties.index'
    ]);
    Route::get('/admin/faculties/add',[
        'uses' => 'App\Http\Controllers\FacultyController@add',
        'as' => 'admin.faculties.add',
    ]);
    Route::post('/admin/faculties/edit/process',[
        'uses' => 'App\Http\Controllers\FacultyController@addEditProcess',
        'as' => 'admin.faculties.process',
    ]);
    Route::get('/admin/faculties/edit/{id}',[
        'uses' => 'App\Http\Controllers\FacultyController@edit',
        'as' => 'admin.faculties.edit',
    ]);
    Route::get('/admin/faculties/delete/{id}',[
        'uses' => 'App\Http\Controllers\FacultyController@delete',
        'as' => 'admin.faculties.delete',
    ]);



//programme
    Route::get('/admin/programmes',[
        'uses' => 'App\Http\Controllers\ProgrammeController@index',
        'as' => 'admin.programmes.index'
    ]);
    Route::get('/admin/programmes/add',[
        'uses' => 'App\Http\Controllers\ProgrammeController@add',
        'as' => 'admin.programmes.add'
    ]);
    Route::get('/admin/programmes/edit/{id}',[
        'uses' => 'App\Http\Controllers\ProgrammeController@edit',
        'as' => 'admin.programmes.edit'
    ]);
    Route::post('/admin/programmes/edit/process',[
        'uses' => 'App\Http\Controllers\ProgrammeController@addEditProcess',
        'as' => 'admin.programmes.process'
    ]);
    Route::get('/admin/programmes/delete/{id}',[
        'uses' => 'App\Http\Controllers\ProgrammeController@delete',
        'as' => 'admin.programmes.delete',
    ]);


//Academic Years
    Route::get('/admin/academic-years',[
        'uses' => 'App\Http\Controllers\AcademicYearController@index',
        'as' => 'admin.academic.years.index'
    ]);
    Route::get('/admin/academic-years/add',[
        'uses' => 'App\Http\Controllers\AcademicYearController@add',
        'as' => 'admin.academic.years.add'
    ]);
    Route::get('/admin/academic-years/edit/{id}',[
        'uses' => 'App\Http\Controllers\AcademicYearController@edit',
        'as' => 'admin.academic.years.edit'
    ]);
    Route::post('/admin/academic-years/edit/process',[
        'uses' => 'App\Http\Controllers\AcademicYearController@addEditProcess',
        'as' => 'admin.academic.years.process'
    ]);
    Route::get('/admin/academic-years/delete/{id}',[
        'uses' => 'App\Http\Controllers\AcademicYearController@delete',
        'as' => 'admin.academic.years.delete',
    ]);


    //Application Registrations
    Route::get('/admin/application/registrations',[
        'uses' => 'App\Http\Controllers\ApplicationRegistrationController@index',
        'as' => 'admin.application.registrations.index'
    ]);
    Route::get('/admin/application/registrations/add',[
        'uses' => 'App\Http\Controllers\ApplicationRegistrationController@add',
        'as' => 'admin.application.registrations.add'
    ]);
    Route::get('/admin/application/registrations/edit/{id}',[
        'uses' => 'App\Http\Controllers\ApplicationRegistrationController@edit',
        'as' => 'admin.application.registrations.edit'
    ]);
    Route::post('/admin/application/registrations/edit/process',[
        'uses' => 'App\Http\Controllers\ApplicationRegistrationController@addEditProcess',
        'as' => 'admin.application.registrations.process'
    ]);
    Route::get('/admin/application/registrations/delete/{id}',[
        'uses' => 'App\Http\Controllers\ApplicationRegistrationController@delete',
        'as' => 'admin.application.registrations.delete',
    ]);


});
