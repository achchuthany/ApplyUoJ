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

Route::group(['middleware' => ['auth','verified','roles']], function () {

    Route::get('/home',[
        'uses' => 'App\Http\Controllers\HomeController@index',
        'as' => 'home',
        'roles' => ['Admin','Student']
    ]);
    //student
    Route::get('/admin/students',[
        'uses' => 'App\Http\Controllers\StudentController@index',
        'as' => 'admin.students.index',
        'roles' => ['Admin']
    ]);

    Route::get('/admin/students/upload',[
        'uses' => 'App\Http\Controllers\StudentController@upload',
        'as' => 'admin.students.upload',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/students/upload/check',[
        'uses' => 'App\Http\Controllers\StudentController@parseImport',
        'as' => 'admin.students.upload.check',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/students/upload/check/{pid}/{aid}/{id}',[
        'uses' => 'App\Http\Controllers\StudentController@uploadPreview',
        'as' => 'admin.students.upload.view',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/students/upload/process',[
        'uses' => 'App\Http\Controllers\StudentController@processImport',
        'as' => 'admin.students.upload.process',
        'roles' => ['Admin']
    ]);

    Route::get('/admin/students/upload/completed',[
        'uses' => 'App\Http\Controllers\StudentController@processCompleted',
        'as' => 'admin.students.upload.completed',
        'roles' => ['Admin']
    ]);

    Route::get('/admin/students/all',[
        'uses' => 'App\Http\Controllers\StudentController@all',
        'as' => 'admin.students.all',
        'roles' => ['Admin']
    ]);

    Route::get('/admin/students/cat/{status}',[
        'uses' => 'App\Http\Controllers\StudentController@pending',
        'as' => 'admin.students.pending',
        'roles' => ['Admin']
    ]);


    Route::get('/admin/students/enroll/profile/{id}',[
        'uses' => 'App\Http\Controllers\StudentController@profile',
        'as' => 'admin.students.enroll.profile',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/students/edit/{id}',[
        'uses' => 'App\Http\Controllers\StudentController@edit',
        'as' => 'admin.students.edit',
        'roles' => ['Admin']
    ]);

    //Faculty

    Route::get('/admin/faculties',[
        'uses' => 'App\Http\Controllers\FacultyController@index',
        'as' => 'admin.faculties.index'
        ,'roles' => ['Admin']
    ]);
    Route::get('/admin/faculties/add',[
        'uses' => 'App\Http\Controllers\FacultyController@add',
        'as' => 'admin.faculties.add',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/faculties/edit/process',[
        'uses' => 'App\Http\Controllers\FacultyController@addEditProcess',
        'as' => 'admin.faculties.process',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/faculties/edit/{id}',[
        'uses' => 'App\Http\Controllers\FacultyController@edit',
        'as' => 'admin.faculties.edit',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/faculties/delete/{id}',[
        'uses' => 'App\Http\Controllers\FacultyController@delete',
        'as' => 'admin.faculties.delete',
        'roles' => ['Admin']
    ]);



//programme
    Route::get('/admin/programmes',[
        'uses' => 'App\Http\Controllers\ProgrammeController@index',
        'as' => 'admin.programmes.index',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/programmes/add',[
        'uses' => 'App\Http\Controllers\ProgrammeController@add',
        'as' => 'admin.programmes.add',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/programmes/edit/{id}',[
        'uses' => 'App\Http\Controllers\ProgrammeController@edit',
        'as' => 'admin.programmes.edit',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/programmes/edit/process',[
        'uses' => 'App\Http\Controllers\ProgrammeController@addEditProcess',
        'as' => 'admin.programmes.process',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/programmes/delete/{id}',[
        'uses' => 'App\Http\Controllers\ProgrammeController@delete',
        'as' => 'admin.programmes.delete',
        'roles' => ['Admin']
    ]);


//Academic Years
    Route::get('/admin/academic-years',[
        'uses' => 'App\Http\Controllers\AcademicYearController@index',
        'as' => 'admin.academic.years.index',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/academic-years/add',[
        'uses' => 'App\Http\Controllers\AcademicYearController@add',
        'as' => 'admin.academic.years.add',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/academic-years/edit/{id}',[
        'uses' => 'App\Http\Controllers\AcademicYearController@edit',
        'as' => 'admin.academic.years.edit',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/academic-years/edit/process',[
        'uses' => 'App\Http\Controllers\AcademicYearController@addEditProcess',
        'as' => 'admin.academic.years.process',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/academic-years/delete/{id}',[
        'uses' => 'App\Http\Controllers\AcademicYearController@delete',
        'as' => 'admin.academic.years.delete',
        'roles' => ['Admin']
    ]);


    //Application Registrations
    Route::get('/admin/application/registrations',[
        'uses' => 'App\Http\Controllers\ApplicationRegistrationController@index',
        'as' => 'admin.application.registrations.index',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/application/registrations/add',[
        'uses' => 'App\Http\Controllers\ApplicationRegistrationController@add',
        'as' => 'admin.application.registrations.add',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/application/registrations/edit/{id}',[
        'uses' => 'App\Http\Controllers\ApplicationRegistrationController@edit',
        'as' => 'admin.application.registrations.edit',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/application/registrations/edit/process',[
        'uses' => 'App\Http\Controllers\ApplicationRegistrationController@addEditProcess',
        'as' => 'admin.application.registrations.process',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/application/registrations/delete/{id}',[
        'uses' => 'App\Http\Controllers\ApplicationRegistrationController@delete',
        'as' => 'admin.application.registrations.delete',
        'roles' => ['Admin']
    ]);

    Route::get('/admin/pdf',[
        'uses' => 'App\Http\Controllers\HomeController@pdf',
        'as' => 'admin.pdf',
        'roles' => ['Admin']
    ]);


});

//Student
Route::group(['middleware' => ['auth','roles'],'roles' => ['Student']], function () {
    Route::get('/registration',[
        'uses' => 'App\Http\Controllers\RegistrationController@index',
        'as' => 'student.registration.index',
    ]);
    Route::get('/registration/1',[
        'uses' => 'App\Http\Controllers\RegistrationController@personal',
        'as' => 'student.personal',
    ]);
    Route::post('/registration/1/process',[
        'uses' => 'App\Http\Controllers\RegistrationController@personalProcess',
        'as' => 'student.personal.process',
    ]);
    Route::get('/registration/2',[
        'uses' => 'App\Http\Controllers\RegistrationController@address',
        'as' => 'student.address',
    ]);
    Route::post('/registration/2/process',[
        'uses' => 'App\Http\Controllers\RegistrationController@addressProcess',
        'as' => 'student.address.process',
    ]);
    Route::get('/registration/3',[
        'uses' => 'App\Http\Controllers\RegistrationController@education',
        'as' => 'student.education',
    ]);
    Route::post('/registration/3/process',[
        'uses' => 'App\Http\Controllers\RegistrationController@educationProcess',
        'as' => 'student.education.process',
    ]);
    Route::get('/registration/4',[
        'uses' => 'App\Http\Controllers\RegistrationController@citizenship',
        'as' => 'student.citizenship',
    ]);
    Route::post('/registration/4/process',[
        'uses' => 'App\Http\Controllers\RegistrationController@citizenshipProcess',
        'as' => 'student.citizenship.process',
    ]);
    Route::get('/registration/5',[
        'uses' => 'App\Http\Controllers\RegistrationController@parents',
        'as' => 'student.parents',
    ]);
    Route::post('/registration/5/process',[
        'uses' => 'App\Http\Controllers\RegistrationController@parentsProcess',
        'as' => 'student.parents.process',
    ]);
    Route::get('/registration/conform',[
        'uses' => 'App\Http\Controllers\RegistrationController@complete',
        'as' => 'student.registration.complete',
    ]);
    Route::post('/registration/conform/process',[
        'uses' => 'App\Http\Controllers\RegistrationController@completeProcess',
        'as' => 'student.registration.complete.process',
    ]);
    Route::get('/registration/completed',[
        'uses' => 'App\Http\Controllers\RegistrationController@completed',
        'as' => 'student.registration.completed',
    ]);
    Route::get('/registration/download/PersonalData',[
        'uses' => 'App\Http\Controllers\RegistrationController@downloadPersonalData',
        'as' => 'student.registration.download.PersonalData',
    ]);
});
