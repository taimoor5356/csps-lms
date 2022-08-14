<?php

use App\Http\Controllers\Admin\AdminController;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\RoleController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();
Route::get('/logout', function() {
    Auth::logout();
    return redirect('login');
})->name('login');
Route::get('/signup', function() {
    return redirect('register');
})->name('signup');
// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function() {
    // dashboard Route
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/set-user-id', function() {
        $users = User::get();
        foreach ($users as $key => $user) {
            $student = Student::where('id', $user->id)->first();
            if (isset($student)) {
                $student->user_id = $user->id;
                $student->save();
            }
        }
        return 'Done';
    });
    // roles and permissions
    Route::prefix('roles')->group(function() {
        Route::get('', [RoleController::class, 'index'])->name('roles');
        Route::get('/{id}/show', [RoleController::class, 'show'])->name('show.role');
        Route::get('/create', [RoleController::class, 'create'])->name('create.role');
        Route::post('/store', [RoleController::class, 'store'])->name('store.role');
        Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('edit.role');
        Route::post('/{id}/update', [RoleController::class, 'update'])->name('update.role');
        Route::post('/{id}/delete', [RoleController::class, 'destroy'])->name('delete.role');
        Route::post('/assign-permission-to-role', [RoleController::class, 'assignPermissionToRole'])->name('assign_permission_to_role');
    });
    // admins Routes
    Route::prefix('admins')->group(function () {
        Route::get('', [AdminController::class, 'index'])->name('admins');
        Route::get('/{id}/show', [AdminController::class, 'show'])->name('show.admin');
        Route::get('/create', [AdminController::class, 'create'])->name('create.admin');
        Route::post('/store', [AdminController::class, 'store'])->name('store.admin');
        Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit.admin');
        Route::post('/{id}/update', [AdminController::class, 'update'])->name('update.admin');
        Route::post('/{id}/delete', [AdminController::class, 'destroy'])->name('delete.admin');
        Route::get('/trashed', [AdminController::class, 'trashed'])->name('trashed.admins');
        Route::get('/{id}/restore', [AdminController::class, 'restore'])->name('restore.admin');
        Route::post('/{id}/permanent-delete', [AdminController::class, 'permanentDelete'])->name('permanent_delete.admin');
    });
    // student Routes
    Route::prefix('students')->group(function () {
        Route::get('', [StudentController::class, 'index'])->name('students');
        Route::get('/{id}/show', [StudentController::class, 'show'])->name('show.student');
        Route::get('/create', [StudentController::class, 'create'])->name('create.student');
        Route::post('/store', [StudentController::class, 'store'])->name('store.student');
        Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('edit.student');
        Route::post('/{id}/update', [StudentController::class, 'update'])->name('update.student');
        Route::post('/{id}/delete', [StudentController::class, 'destroy'])->name('delete.student');
        Route::get('/trashed', [StudentController::class, 'trashed'])->name('trashed.students');
        Route::get('/{id}/restore', [StudentController::class, 'restore'])->name('restore.student');
        Route::post('/{id}/permanent-delete', [StudentController::class, 'permanentDelete'])->name('permanent_delete.student');
        // Route::get('/{id}/enrolled-courses', [StudentController::class, 'enrolledCourses'])->name('student.enrolled.courses');
    });
    // courses Routes
    Route::prefix('courses')->group(function () {
        Route::get('', [CourseController::class, 'index'])->name('courses');
        Route::get('/{id}/show', [CourseController::class, 'show'])->name('show.course');
        Route::get('/create', [CourseController::class, 'create'])->name('create.course');
        Route::post('/store', [CourseController::class, 'store'])->name('store.course');
        Route::get('/{id}/edit', [CourseController::class, 'edit'])->name('edit.course');
        Route::post('/{id}/update', [CourseController::class, 'update'])->name('update.course');
        Route::post('/{id}/delete', [CourseController::class, 'destroy'])->name('delete.course');
        Route::get('/trashed', [CourseController::class, 'trashed'])->name('trashed.courses');
        Route::get('/{id}/restore', [CourseController::class, 'restore'])->name('restore.course');
        Route::post('/{id}/permanent-delete', [CourseController::class, 'permanentDelete'])->name('permanent_delete.course');
    });
    // enrollment Routes
    Route::prefix('enrollments')->group(function () {
        Route::get('', [EnrollmentController::class, 'index'])->name('enrollments');
        Route::get('/enroll-student', [EnrollmentController::class, 'create'])->name('enroll-student.create');
        Route::post('/enrollment-save', [EnrollmentController::class, 'store'])->name('enrollment.save');
        Route::post('/trashed', [EnrollmentController::class, 'store'])->name('trashed.enrollments');
    });
    // reports Routes
    Route::prefix('reports')->group(function () {
    });
    // feedback Routes
    Route::prefix('feedbacks')->group(function () {
    });
    // gallery Routes
    Route::prefix('gallery')->group(function () {
    });
    // expenses Routes
    Route::prefix('expenses')->group(function () {
    });
    // setting Routes
    Route::prefix('settings')->group(function () {
    });
});