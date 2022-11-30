<?php

use App\Http\Controllers\Admin\AcademicController;
use App\Models\User;
use App\Models\Student;
use App\Models\Interview;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LectureController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InterviewController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\NoticeBoardController;
use App\Http\Controllers\Admin\SuggestionsController;
use App\Http\Controllers\Admin\ZoomClassesController;
use App\Http\Controllers\Admin\ExaminationsController;
use App\Http\Controllers\Admin\TeacherReviewController;
use App\Http\Controllers\Admin\DownloadCenterController;
use App\Http\Controllers\Admin\LessonPlanController;
use App\Http\Controllers\Admin\StudentServicesController;

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
});
// visitor Routes
Route::prefix('visitor')->group(function () {
    Route::get('', [VisitorController::class, 'index'])->name('visitors');
    Route::get('/{id}/show', [VisitorController::class, 'show'])->name('show.visitor');
    Route::get('/create', [VisitorController::class, 'create'])->name('create.visitor');
    Route::post('/store', [VisitorController::class, 'store'])->name('store.visitor');
    Route::get('/{id}/edit', [VisitorController::class, 'edit'])->name('edit.visitor');
    Route::post('/{id}/update', [VisitorController::class, 'update'])->name('update.visitor');
    Route::post('/{id}/delete', [VisitorController::class, 'destroy'])->name('delete.visitor');
    Route::get('/trashed', [VisitorController::class, 'trashed'])->name('trashed.visitor');
    Route::get('/{id}/restore', [VisitorController::class, 'restore'])->name('restore.visitor');
    Route::post('/{id}/permanent-delete', [VisitorController::class, 'permanentDelete'])->name('permanent_delete.visitor');
});
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
        Route::get('', [RoleController::class, 'index'])->name('roles')->middleware('can:roles_view');
        Route::get('/{id}/show', [RoleController::class, 'show'])->name('show.role');
        Route::get('/create', [RoleController::class, 'create'])->name('create.role');
        Route::post('/store', [RoleController::class, 'store'])->name('store.role');
        Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('edit.role');
        Route::post('/{id}/update', [RoleController::class, 'update'])->name('update.role');
        Route::post('/{id}/delete', [RoleController::class, 'destroy'])->name('delete.role');
        Route::post('/assign-permission-to-role', [RoleController::class, 'assignPermissionToRole'])->name('assign_permission_to_role');
    });
    // admins Routes
    Route::group(['prefix' =>'admins', 'middleware' => ['role:admin']], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
        Route::get('/all', [AdminController::class, 'index'])->name('admins');
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
    // teacher Routes
    Route::group(['prefix' =>'teachers', 'middleware' => ['role:teacher']], function () {
        Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('teacher_dashboard');
        Route::get('/teacher', [TeacherController::class, 'index'])->name('teachers');
        Route::get('/{id}/show', [TeacherController::class, 'show'])->name('show.teacher');
        Route::get('/create', [TeacherController::class, 'create'])->name('create.teacher');
        Route::post('/store', [TeacherController::class, 'store'])->name('store.teacher');
        Route::get('/{id}/edit', [TeacherController::class, 'edit'])->name('edit.teacher');
        Route::post('/{id}/update', [TeacherController::class, 'update'])->name('update.teacher');
        Route::post('/{id}/delete', [TeacherController::class, 'destroy'])->name('delete.teacher');
        Route::get('/trashed', [TeacherController::class, 'trashed'])->name('trashed.teachers');
        Route::get('/{id}/restore', [TeacherController::class, 'restore'])->name('restore.teacher');
        Route::post('/{id}/permanent-delete', [TeacherController::class, 'permanentDelete'])->name('permanent_delete.teacher');
        Route::get('/students/attendance', [AttendanceController::class, 'teacherStudentAttendance'])->name('teachers_student_attendance');
        Route::get('/examination', [ExaminationsController::class, 'teacherExaminations'])->name('teacher_examinations');
        Route::get('/lesson-plan', [LessonPlanController::class, 'teachersLessonPlan'])->name('teachers_lesson_plan');
        Route::get('/academics', [AcademicController::class, 'teachersAcademics'])->name('teachers_academics');
        Route::get('/download-center', [DownloadCenterController::class, 'teacherDownloadCenter'])->name('teachers_download_center');
        Route::get('/assignments', [AssignmentController::class, 'teacherAssignment'])->name('teachers_assignment');
        Route::get('/zoom-class', [ZoomClassesController::class, 'teacherZoomClass'])->name('teachers_zoom_class');
    });
    // student Routes
    Route::group(['prefix' =>'students', 'middleware' => ['role:student']], function () {
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
    // lectures Routes
    Route::prefix('lectures')->group(function () {
        Route::get('', [LectureController::class, 'index'])->name('lectures');
        Route::get('/{id}/show', [LectureController::class, 'show'])->name('show.lecture');
        Route::get('/create', [LectureController::class, 'create'])->name('create.lecture');
        Route::post('/store', [LectureController::class, 'store'])->name('store.lecture');
        Route::get('/{id}/edit', [LectureController::class, 'edit'])->name('edit.lecture');
        Route::post('/{id}/update', [LectureController::class, 'update'])->name('update.lecture');
        Route::post('/{id}/delete', [LectureController::class, 'destroy'])->name('delete.lecture');
        Route::get('/trashed', [LectureController::class, 'trashed'])->name('trashed.lectures');
        Route::get('/{id}/restore', [LectureController::class, 'restore'])->name('restore.lecture');
        Route::post('/{id}/permanent-delete', [LectureController::class, 'permanentDelete'])->name('permanent_delete.lecture');
        // Route::get('/{id}/enrolled-courses', [LectureController::class, 'enrolledCourses'])->name('lecture.enrolled.courses');
    });
    // notice board Routes
    Route::prefix('notice-board')->group(function () {
        Route::get('', [NoticeBoardController::class, 'index'])->name('notice_board');
        Route::get('/{id}/show', [NoticeBoardController::class, 'show'])->name('show.notice_board');
        Route::get('/create', [NoticeBoardController::class, 'create'])->name('create.notice_board');
        Route::post('/store', [NoticeBoardController::class, 'store'])->name('store.notice_board');
        Route::get('/{id}/edit', [NoticeBoardController::class, 'edit'])->name('edit.notice_board');
        Route::post('/{id}/update', [NoticeBoardController::class, 'update'])->name('update.notice_board');
        Route::post('/{id}/delete', [NoticeBoardController::class, 'destroy'])->name('delete.notice_board');
        Route::get('/trashed', [NoticeBoardController::class, 'trashed'])->name('trashed.notice_board');
        Route::get('/{id}/restore', [NoticeBoardController::class, 'restore'])->name('restore.notice_board');
        Route::post('/{id}/permanent-delete', [NoticeBoardController::class, 'permanentDelete'])->name('permanent_delete.notice_board');
    });
    // student services Routes
    Route::prefix('student-services')->group(function () {
        Route::get('', [StudentServicesController::class, 'index'])->name('student_services');
        Route::get('/{id}/show', [StudentServicesController::class, 'show'])->name('show.student_services');
        Route::get('/create', [StudentServicesController::class, 'create'])->name('create.student_services');
        Route::post('/store', [StudentServicesController::class, 'store'])->name('store.student_services');
        Route::get('/{id}/edit', [StudentServicesController::class, 'edit'])->name('edit.student_services');
        Route::post('/{id}/update', [StudentServicesController::class, 'update'])->name('update.student_services');
        Route::post('/{id}/delete', [StudentServicesController::class, 'destroy'])->name('delete.student_services');
        Route::get('/trashed', [StudentServicesController::class, 'trashed'])->name('trashed.student_services');
        Route::get('/{id}/restore', [StudentServicesController::class, 'restore'])->name('restore.student_services');
        Route::post('/{id}/permanent-delete', [StudentServicesController::class, 'permanentDelete'])->name('permanent_delete.student_services');
    });
    // examination Routes
    Route::prefix('examinations')->group(function () {
        Route::get('', [ExaminationsController::class, 'index'])->name('examinations');
        Route::get('/{id}/show', [ExaminationsController::class, 'show'])->name('show.examinations');
        Route::get('/create', [ExaminationsController::class, 'create'])->name('create.examinations');
        Route::post('/store', [ExaminationsController::class, 'store'])->name('store.examinations');
        Route::get('/{id}/edit', [ExaminationsController::class, 'edit'])->name('edit.examinations');
        Route::post('/{id}/update', [ExaminationsController::class, 'update'])->name('update.examinations');
        Route::post('/{id}/delete', [ExaminationsController::class, 'destroy'])->name('delete.examinations');
        Route::get('/trashed', [ExaminationsController::class, 'trashed'])->name('trashed.examinations');
        Route::get('/{id}/restore', [ExaminationsController::class, 'restore'])->name('restore.examinations');
        Route::post('/{id}/permanent-delete', [ExaminationsController::class, 'permanentDelete'])->name('permanent_delete.examinations');
    });
    // zoom classes Routes
    Route::prefix('zoom-classes')->group(function () {
        Route::get('', [ZoomClassesController::class, 'index'])->name('zoom_classes');
        Route::get('/{id}/show', [ZoomClassesController::class, 'show'])->name('show.zoom_classes');
        Route::get('/create', [ZoomClassesController::class, 'create'])->name('create.zoom_classes');
        Route::post('/store', [ZoomClassesController::class, 'store'])->name('store.zoom_classes');
        Route::get('/{id}/edit', [ZoomClassesController::class, 'edit'])->name('edit.zoom_classes');
        Route::post('/{id}/update', [ZoomClassesController::class, 'update'])->name('update.zoom_classes');
        Route::post('/{id}/delete', [ZoomClassesController::class, 'destroy'])->name('delete.zoom_classes');
        Route::get('/trashed', [ZoomClassesController::class, 'trashed'])->name('trashed.zoom_classes');
        Route::get('/{id}/restore', [ZoomClassesController::class, 'restore'])->name('restore.zoom_classes');
        Route::post('/{id}/permanent-delete', [ZoomClassesController::class, 'permanentDelete'])->name('permanent_delete.zoom_classes');
    });
    // download center Routes
    Route::prefix('download-center')->group(function () {
        Route::get('', [DownloadCenterController::class, 'index'])->name('download_center');
        Route::get('/{id}/show', [DownloadCenterController::class, 'show'])->name('show.download_center');
        Route::get('/create', [DownloadCenterController::class, 'create'])->name('create.download_center');
        Route::post('/store', [DownloadCenterController::class, 'store'])->name('store.download_center');
        Route::get('/{id}/edit', [DownloadCenterController::class, 'edit'])->name('edit.download_center');
        Route::post('/{id}/update', [DownloadCenterController::class, 'update'])->name('update.download_center');
        Route::post('/{id}/delete', [DownloadCenterController::class, 'destroy'])->name('delete.download_center');
        Route::get('/trashed', [DownloadCenterController::class, 'trashed'])->name('trashed.download_center');
        Route::get('/{id}/restore', [DownloadCenterController::class, 'restore'])->name('restore.download_center');
        Route::post('/{id}/permanent-delete', [DownloadCenterController::class, 'permanentDelete'])->name('permanent_delete.download_center');
    });
    // attendance
    Route::prefix('attendance')->group(function() {
    });
    // alumni Routes
    Route::prefix('alumni')->group(function () {
        Route::get('', [AlumniController::class, 'index'])->name('alumni');
        Route::get('/{id}/show', [AlumniController::class, 'show'])->name('show.alumni');
        Route::get('/create', [AlumniController::class, 'create'])->name('create.alumni');
        Route::post('/store', [AlumniController::class, 'store'])->name('store.alumni');
        Route::get('/{id}/edit', [AlumniController::class, 'edit'])->name('edit.alumni');
        Route::post('/{id}/update', [AlumniController::class, 'update'])->name('update.alumni');
        Route::post('/{id}/delete', [AlumniController::class, 'destroy'])->name('delete.alumni');
        Route::get('/trashed', [AlumniController::class, 'trashed'])->name('trashed.alumni');
        Route::get('/{id}/restore', [AlumniController::class, 'restore'])->name('restore.alumni');
        Route::post('/{id}/permanent-delete', [AlumniController::class, 'permanentDelete'])->name('permanent_delete.alumni');
    });
    // teacher review Routes
    Route::prefix('teacher-review')->group(function () {
        Route::get('', [TeacherReviewController::class, 'index'])->name('teacher_review');
        Route::get('/{id}/show', [TeacherReviewController::class, 'show'])->name('show.teacher_review');
        Route::get('/create', [TeacherReviewController::class, 'create'])->name('create.teacher_review');
        Route::post('/store', [TeacherReviewController::class, 'store'])->name('store.teacher_review');
        Route::get('/{id}/edit', [TeacherReviewController::class, 'edit'])->name('edit.teacher_review');
        Route::post('/{id}/update', [TeacherReviewController::class, 'update'])->name('update.teacher_review');
        Route::post('/{id}/delete', [TeacherReviewController::class, 'destroy'])->name('delete.teacher_review');
        Route::get('/trashed', [TeacherReviewController::class, 'trashed'])->name('trashed.teacher_review');
        Route::get('/{id}/restore', [TeacherReviewController::class, 'restore'])->name('restore.teacher_review');
        Route::post('/{id}/permanent-delete', [TeacherReviewController::class, 'permanentDelete'])->name('permanent_delete.teacher_review');
    });
    // suggestions Routes
    Route::prefix('suggestions')->group(function () {
        Route::get('', [SuggestionsController::class, 'index'])->name('suggestions');
        Route::get('/{id}/show', [SuggestionsController::class, 'show'])->name('show.suggestions');
        Route::get('/create', [SuggestionsController::class, 'create'])->name('create.suggestions');
        Route::post('/store', [SuggestionsController::class, 'store'])->name('store.suggestions');
        Route::get('/{id}/edit', [SuggestionsController::class, 'edit'])->name('edit.suggestions');
        Route::post('/{id}/update', [SuggestionsController::class, 'update'])->name('update.suggestions');
        Route::post('/{id}/delete', [SuggestionsController::class, 'destroy'])->name('delete.suggestions');
        Route::get('/trashed', [SuggestionsController::class, 'trashed'])->name('trashed.suggestions');
        Route::get('/{id}/restore', [SuggestionsController::class, 'restore'])->name('restore.suggestions');
        Route::post('/{id}/permanent-delete', [SuggestionsController::class, 'permanentDelete'])->name('permanent_delete.suggestions');
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
    // interview details
    Route::prefix('interview')->group(function() {
        Route::get('/students', [InterviewController::class, 'index'])->name('interview.students');
        Route::get('/student/{id}/show', [InterviewController::class, 'show'])->name('show.interview');
        Route::get('/student/create', [InterviewController::class, 'create'])->name('create.interview');
        Route::post('/student/store', [InterviewController::class, 'store'])->name('store.interview');
    });
});