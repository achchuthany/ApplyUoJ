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

Route::get('/apply', function () {
    return view('welcome');
})->name('welcome');

Route::get('/info',[
    'uses' => 'App\Http\Controllers\HomeController@info',
    'as' => 'info'
]);

Auth::routes();
Auth::routes(['verify' => true]);

Route::post('/user/reset',[
    'uses' => 'App\Http\Controllers\UserController@reset',
    'as' => 'user.reset',
]);

Route::group(['middleware' => ['auth','verified','roles']], function () {
    //index
    Route::get('/',[
        'uses' => 'App\Http\Controllers\HomeController@index',
        'as' => 'index',
        'roles' => ['Admin','Student','Dean','Welfare','Library']
    ]);
    //home
    Route::get('/home',[
        'uses' => 'App\Http\Controllers\HomeController@index',
        'as' => 'home',
        'roles' => ['Admin','Student','Dean','Welfare','Library']
    ]);
    Route::get('registration/student/image/{name}',[
        'uses' => 'App\Http\Controllers\RegistrationController@getImageFile',
        'as' => 'student.registration.image',
        'roles' => ['Admin','Student','Dean','Welfare']
    ]);

    //Admin Home Page
    Route::get('/home/data/{aid}',[
        'uses' => 'App\Http\Controllers\HomeController@graphData',
        'as' => 'home.data',
        'roles' => ['Admin','Welfare']
    ]);
    //student
    Route::get('/admin/students',[
        'uses' => 'App\Http\Controllers\StudentController@index',
        'as' => 'admin.students.index',
        'roles' => ['Admin','Dean','Welfare']
    ]);
    Route::get('/admin/students/add',[
        'uses' => 'App\Http\Controllers\StudentController@add',
        'as' => 'admin.students.add',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/students/edit/{sid}',[
        'uses' => 'App\Http\Controllers\StudentController@edit',
        'as' => 'admin.students.edit',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/students/addEditProcess',[
        'uses' => 'App\Http\Controllers\StudentController@addEditProcess',
        'as' => 'admin.students.addEditProcess',
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
        'roles' => ['Admin','Dean','Welfare']
    ]);

    Route::get('/admin/students/cat/{status}',[
        'uses' => 'App\Http\Controllers\StudentController@pending',
        'as' => 'admin.students.pending',
        'roles' => ['Admin','Dean','Welfare']
    ]);


    Route::get('/admin/students/enroll/profile/{id}',[
        'uses' => 'App\Http\Controllers\StudentController@profile',
        'as' => 'admin.students.enroll.profile',
        'roles' => ['Admin','Dean','Welfare']
    ]);
    Route::post('/admin/students/enroll/profile/action/{eid}/{status}',[
        'uses' => 'App\Http\Controllers\StudentController@acceptRequest',
        'as' => 'admin.students.enroll.profile.action',
        'roles' => ['Admin']
    ]);

    Route::get('/admin/students/search/{pid}/{aid}/{status}',[
        'uses' => 'App\Http\Controllers\StudentController@students',
        'as' => 'admin.students.program.academic',
        'roles' => ['Admin','Dean','Welfare']
    ]);
    Route::get('/admin/students/search',[
        'uses' => 'App\Http\Controllers\StudentController@search',
        'as' => 'admin.students.search',
        'roles' => ['Admin','Dean','Welfare']
    ]);
    Route::post('/admin/students/search/list',[
        'uses' => 'App\Http\Controllers\StudentController@searchStudentsList',
        'as' => 'admin.students.search.list',
        'roles' => ['Admin','Dean','Welfare']
    ]);
    Route::get('/admin/students/delete',[
        'uses' => 'App\Http\Controllers\StudentController@delete',
        'as' => 'admin.students.delete.index',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/students/delete/process',[
        'uses' => 'App\Http\Controllers\StudentController@deleteProcess',
        'as' => 'admin.students.delete.process',
        'roles' => ['Admin']
    ]);

    Route::get('/admin/students/identity',[
        'uses' => 'App\Http\Controllers\StudentController@identity',
        'as' => 'admin.students.identity',
        'roles' => ['Admin','Dean','Welfare','Library']
    ]);
    Route::get('/admin/students/identity/{pid}/{aid}',[
        'uses' => 'App\Http\Controllers\StudentController@identitySearch',
        'as' => 'admin.students.identity.search',
        'roles' => ['Admin','Dean','Welfare','Library']
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

    //Enroll Data
    Route::get('/admin/enroll/assign/reg/{pid}/{aid}',[
        'uses' => 'App\Http\Controllers\EnrollController@assignRegistrationNoIndex',
        'as' => 'admin.enroll.assign.reg.index',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/enroll/assign/reg/{pid}/{aid}/process',[
        'uses' => 'App\Http\Controllers\EnrollController@assignRegistrationNoProcess',
        'as' => 'admin.enroll.assign.reg.process',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/enroll/clear/reg/{pid}/{aid}',[
        'uses' => 'App\Http\Controllers\EnrollController@clearRegistrationNoIndex',
        'as' => 'admin.enroll.clear.reg.index',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/enroll/assign/reg/{pid}/{aid}/delete',[
        'uses' => 'App\Http\Controllers\EnrollController@assignRegistrationNoDelete',
        'as' => 'admin.enroll.assign.reg.delete',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/enroll/change/{id}',[
        'uses' => 'App\Http\Controllers\EnrollController@changeCourseStudy',
        'as' => 'admin.enroll.change.course',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/enroll/change/process/{id}',[
        'uses' => 'App\Http\Controllers\EnrollController@changeCourseStudyProcess',
        'as' => 'admin.enroll.change.course.process',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/enroll/change/get/reg/{pid}/{aid}',[
        'uses' => 'App\Http\Controllers\EnrollController@getRegNo',
        'as' => 'admin.enroll.change.get.reg',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/enroll/change/reg/{id}',[
        'uses' => 'App\Http\Controllers\EnrollController@changeReg',
        'as' => 'admin.enroll.change.reg',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/enroll/change/reg/process/{id}',[
        'uses' => 'App\Http\Controllers\EnrollController@changeRegProcess',
        'as' => 'admin.enroll.change.reg.process',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/enroll/confirmation/{app_id}',[
        'uses' => 'App\Http\Controllers\EnrollController@confirmation',
        'as' => 'admin.enroll.confirmation',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/enroll/confirmation/process/{app_id}',[
        'uses' => 'App\Http\Controllers\EnrollController@confirmationProcess',
        'as' => 'admin.enroll.confirmation.process',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/enroll/dropout/{enroll_id}',[
        'uses' => 'App\Http\Controllers\EnrollController@dropout',
        'as' => 'admin.enroll.dropout',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/enroll/dropout/{enroll_id}',[
        'uses' => 'App\Http\Controllers\EnrollController@dropoutProcess',
        'as' => 'admin.enroll.dropout.process',
        'roles' => ['Admin']
    ]);

    Route::get('/admin/enroll/assign/index/{pid}/{aid}',[
        'uses' => 'App\Http\Controllers\EnrollController@assignIndexNumber',
        'as' => 'admin.enroll.assign.index.number',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/enroll/assign/index/{pid}/{aid}/process',[
        'uses' => 'App\Http\Controllers\EnrollController@assignIndexProcess',
        'as' => 'admin.enroll.assign.index.process',
        'roles' => ['Admin']
    ]);

    //Users
    Route::get('/admin/users',[
        'uses' => 'App\Http\Controllers\UserController@index',
        'as' => 'users.index',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/users/add',[
        'uses' => 'App\Http\Controllers\UserController@add',
        'as' => 'users.add',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/users/edit/{id}',[
        'uses' => 'App\Http\Controllers\UserController@edit',
        'as' => 'users.edit',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/users/edit/process',[
        'uses' => 'App\Http\Controllers\UserController@addEditProcess',
        'as' => 'users.process',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::get('/admin/users/delete/{id}',[
        'uses' => 'App\Http\Controllers\UserController@delete',
        'as' => 'users.delete',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);

    Route::get('/admin/user/profile',[
        'uses' => 'App\Http\Controllers\UserController@profile',
        'as' => 'user.profile',
        'middleware' => 'roles',
        'roles' => ['Admin','Student']
    ]);
    Route::post('/admin/user/roles',[
        'uses' => 'App\Http\Controllers\UserController@roles',
        'as' => 'users.roles',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);

//CHECK MAIL
    Route::get('/mailable/1', function () {
        $student = App\Models\Student::first();
        $enroll = $student->enrolls()->first();
        $ref_no = $enroll->getRefNo();
        return new App\Mail\RegistrationConfirmationMail($enroll->programme->name,$student->full_name,$ref_no);
    });
    Route::get('/mailable/2', function () {
        $student = App\Models\Student::first();
        $enroll = $student->enrolls()->first();
        return new App\Mail\EnrolmentConfirmationMail($enroll);
    });
    Route::get('/mailable/3', function () {
        $enroll = App\Models\Enroll::first();
        return new App\Mail\EnrolmentAcceptMail($enroll,"Please check your online application. There is a problem with your online application, you need to modify your application again. These are the problem with your application:  Identity Card Image not fully uploaded ");
    });

    //download all stdents perosnal data form

    Route::get('/registration/download/PersonalData/{pid}/{aid}/{status}',[
        'uses' => 'App\Http\Controllers\RegistrationController@downloadPersonalDataByCourse',
        'as' => 'student.registration.download.PersonalData.all',
        'roles' => ['Admin']
    ]);
    Route::get('/registration/download/{eid}/LetterOfEnrolment',[
        'uses' => 'App\Http\Controllers\RegistrationController@downloadLetterOfEnrolment',
        'as' => 'student.registration.download.LetterOfEnrolment',
        'roles' => ['Admin']
    ]);
    Route::get('/registration/download/LetterOfEnrolment/{pid}/{aid}/{status}',[
        'uses' => 'App\Http\Controllers\RegistrationController@downloadLetterOfEnrolmentByCourse',
        'as' => 'student.registration.download.LetterOfEnrolmentByCourse',
        'roles' => ['Admin']
    ]);

    //Faculty Dashboard for Dean
    Route::get('/home/faculty',[
        'uses' => 'App\Http\Controllers\HomeFacultyController@index',
        'as' => 'home.faculty',
        'middleware' => 'roles',
        'roles' => ['Dean']
    ]);
    Route::post('/home/faculty',[
        'uses' => 'App\Http\Controllers\HomeFacultyController@indexSearch',
        'as' => 'home.faculty.search',
        'middleware' => 'roles',
        'roles' => ['Dean']
    ]);

    //RACE Analytics
    Route::get('/admin/analytics/race',[
        'uses' => 'App\Http\Controllers\AnalyticController@raceIndex',
        'as' => 'admin.analytics.race',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/analytics/getRaceData',[
        'uses' => 'App\Http\Controllers\AnalyticController@getRaceData',
        'as' => 'admin.analytics.getRaceData',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);

    //GENDER ANALYST
    Route::get('/admin/analytics/gender',[
        'uses' => 'App\Http\Controllers\AnalyticController@genderIndex',
        'as' => 'admin.analytics.gender',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/analytics/getGenderData',[
        'uses' => 'App\Http\Controllers\AnalyticController@getGenderData',
        'as' => 'admin.analytics.getGenderData',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);

    //DISTRICT
    Route::get('/admin/analytics/district',[
        'uses' => 'App\Http\Controllers\AnalyticController@districtIndex',
        'as' => 'admin.analytics.district',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/analytics/getDistrictData',[
        'uses' => 'App\Http\Controllers\AnalyticController@getDistrictData',
        'as' => 'admin.analytics.getDistrictData',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);


});

//Student
Route::group(['middleware' => ['auth','verified','roles'],'roles' => ['Student']], function () {
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
    Route::get('/registration/6',[
        'uses' => 'App\Http\Controllers\RegistrationController@photograph',
        'as' => 'student.photograph',
    ]);
    Route::get('/registration/7',[
        'uses' => 'App\Http\Controllers\RegistrationController@documents',
        'as' => 'student.documents',
    ]);
    Route::get('/registration/8',[
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
    Route::get('/registration/profile',[
        'uses' => 'App\Http\Controllers\StudentController@student_profile',
        'as' => 'student.profile',
    ]);
    Route::get('/registration/download/{eid}/PersonalData',[
        'uses' => 'App\Http\Controllers\RegistrationController@downloadPersonalData',
        'as' => 'student.registration.download.PersonalData',
        'roles' => ['Student','Admin']
    ]);
    Route::get('/registration/download/{eid}/IdentityCardData',[
        'uses' => 'App\Http\Controllers\RegistrationController@downloadIdentityCardData',
        'as' => 'student.registration.download.IdentityCardData',
        'roles' => ['Student','Admin']
    ]);
    Route::get('/registration/download/{eid}/DegreeDeclarationData',[
        'uses' => 'App\Http\Controllers\RegistrationController@downloadDegreeDeclarationData',
        'as' => 'student.registration.download.DegreeDeclarationData',
        'roles' => ['Student','Admin']
    ]);
    Route::get('/registration/download/{eid}/NonSubmissionDocumentsData',[
        'uses' => 'App\Http\Controllers\RegistrationController@downloadNonSubmissionDocumentsData',
        'as' => 'student.registration.download.NonSubmissionDocumentsData',
        'roles' => ['Student','Admin']
    ]);
    Route::post('registration/student/imageUpload',[
        'uses' => 'App\Http\Controllers\RegistrationController@imageUploadPost',
        'as' => 'student.registration.image.upload',
        'roles' => ['Student','Admin']
    ]);

    Route::post('registration/student/uploadProfileImage',[
        'uses' => 'App\Http\Controllers\RegistrationController@uploadProfileImage',
        'as' => 'student.registration.image.upload.profile',
        'roles' => ['Student','Admin']
    ]);


});

