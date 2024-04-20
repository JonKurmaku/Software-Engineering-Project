<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SignUpControllers\LecturerController;
use App\Http\Controllers\SignUpControllers\StudentController;

use App\Http\Controllers\Auth\LogInControllers\LecturerLogInController;
use App\Http\Controllers\Auth\LogInControllers\StudentLogInController;
use App\Http\Controllers\Auth\LogInControllers\AdminLogInController;

use App\Http\Controllers\Auth\ProfileControllers\StudentProfileController;
use App\Http\Controllers\Auth\ProfileControllers\LecturerProfileController;
use App\Http\Controllers\Auth\ProfileControllers\AdminProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// routes/web.php

//Test Database Connection

Route::get('/test-database-connection', function () {
    try {
        DB::connection()->getPdo();
        echo "Connected successfully to the database!";
    } catch (\Exception $e) {
        die("Could not connect to the database. Error: " . $e->getMessage());
    }
});

//Routes
Route::get('/', function () {
    return view('MainPage/MainPage');
});

Route::get('/StudentLogin', function () {
    return view('LoginFolder/StudentLogin');
});

Route::get('/LecturerLogin', function () {
    return view('LoginFolder/LecturerLogin');
});

Route::get('/AdminLogin', function () {
    return view('LoginFolder/AdminLogin');
});

Route::get('/LecturerSignUp', function () {
    return view('SignUpFolder/LecturerSignIn');
});

Route::get('/StudentSignUp', function () {
    return view('SignUpFolder/StudentSignIn');
});


//Route::group(['middleware' => 'refreshPageCache'], function () {

Route::get('/lecturer/dashboard', function () {
    return view('/Dashboards/Lecturer/dashboardLecturer'); 
})->name('/lecturer/dashboard');


Route::get('/student/dashboard', function () {
    return view('/Dashboards/Student/dashboardStd'); 
})->name('/student/dashboard');

Route::get('/admin/dashboard', function () {
    return view('/Dashboards/Admin/dashboardAdmin'); 
})->name('/admin/dashboard');

//});

Route::get('/student/dashboard/courseSelection', function () {
    return view('/Dashboards/Student/CourseSelection/courseSelection'); 
})->name('/student/dashboard/courseSelection');

Route::get('/student/dashboard/feedback', function () {
    return view('/Dashboards/Student/FeedbackPage/feedbackPage'); 
})->name('/student/dashboard/feedback');

Route::get('/student/dashboard/grades', function () {
    return view('/Dashboards/Student/Grades/grades'); 
})->name('/student/dashboard/grades');

/*
Route::get('/lecturer/dashboard/courses', function () {
    return view('/Dashboards/Lecturer/coursePage'); 
})->name('/lecturer/dashboard/courses');
*/

Route::get('/admin/dashboard/activity', function () {
    return view('/Dashboards/Admin/AdminLogs/userActivityLog'); 
})->name('/admin/dashboard/activity');


Route::get('/admin/dashboard/server-logs', function () {
    return view('/Dashboards/Admin/AdminLogs/serverLog'); 
})->name('/admin/dashboard/server-logs');


//Request Routes

Route::post('lecturers', [LecturerController::class, 'store'])->name('lecturer.store');
Route::post('students', [StudentController::class, 'store'])->name('student.store');



/*

Route::get('lecturer/login', [LecturerLogInController::class, 'showLoginForm'])->name('lecturer.login');
Route::post('lecturer/login', [LecturerLogInController::class, 'login'])->name('lecturer.login.submit');
    
Route::get('student/login', [StudentLogInController::class, 'showLoginForm'])->name('student.login');
Route::post('student/login', [StudentLogInController::class, 'login'])->name('student.login.submit');
    
    
Route::get('admin/login', [AdminLogInController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLogInController::class, 'login'])->name('admin.login.submit');

});

*/
Route::get('lecturer/login', [LecturerLogInController::class, 'showLoginForm'])->name('lecturer.login');
Route::post('lecturer/login', [LecturerLogInController::class, 'login'])->name('lecturer.login.submit');

Route::get('student/login', [StudentLogInController::class, 'showLoginForm'])->name('student.login');
Route::post('student/login', [StudentLogInController::class, 'login'])->name('student.login.submit');


Route::get('admin/login', [AdminLogInController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLogInController::class, 'login'])->name('admin.login.submit');


//LogOut routes
Route::get('student/logout', [StudentLogInController::class, 'logout'])->name('student.logout');
Route::get('lecturer/logout', [LecturerLogInController::class, 'logout'])->name('lecturer.logout');
Route::get('admin/logout', [AdminLogInController::class, 'logout'])->name('admin.logout');


//Edit Profile Routes
Route::put('/student/dashboard', [StudentProfileController::class, 'update']);
Route::put('/lecturer/dashboard', [LecturerProfileController::class, 'update']);


Route::middleware(['auth:lecturer'])->group(function () {
    Route::get('/lecturer/dashboard/courses', [LecturerProfileController::class, 'showCourses'])->name('lecturer.courses');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard/activity', [AdminProfileController::class, 'userActivity'])->name('admin.dashboard.activity');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard/server-logs', [AdminProfileController::class, 'serverLog'])->name('admin.dashboard.server-logs');
});

Route::post('/lecturer/dashboard/add-courses', [LecturerProfileController::class, 'addCourses']);

Route::delete('/lecturer/dashboard/courses/{course_id}', [LecturerProfileController::class, 'deleteCourse'])->name('lecturer.courses.delete');