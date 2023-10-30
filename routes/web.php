<?php

use Illuminate\Support\Facades\Auth;
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

// visitor Route
require __DIR__.'/visitor.php';

// Setting Routes
require __DIR__.'/auth/setting.php';

Route::get('/', function () {
    return redirect('login');
});

Route::get('/logout', function() {
    Auth::logout();
    return redirect('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    // Dashboard Routes
    require __DIR__.'/auth/dashboard.php';
    
    // Admin Routes
    require __DIR__.'/auth/admin.php';
    
    // Student Routes
    require __DIR__.'/auth/student.php';
    
    // Teacher Routes
    require __DIR__.'/auth/teacher.php';

    // Visitor Routes
    require __DIR__.'/auth/visitor.php';

    // ACL Routes
    require __DIR__.'/auth/acl.php';
    
    // Interview Routes
    require __DIR__.'/auth/interview.php';
    
    // Lectures Routes
    require __DIR__.'/auth/lecture.php';

    // Notice board Routes
    require __DIR__.'/auth/notice_board.php';

    // Student services Routes
    require __DIR__.'/auth/student_service.php';

    // Examination Routes
    require __DIR__.'/auth/examination.php';

    // Zoom classes Routes
    require __DIR__.'/auth/zoom_class.php';

    // Download center Routes
    require __DIR__.'/auth/download_center.php';

    // Attendance
    require __DIR__.'/auth/attendance.php';

    // Alumni Routes
    require __DIR__.'/auth/alumni.php';

    // Teacher review Routes
    require __DIR__.'/auth/teacher_review.php';

    // Suggestions Routes
    require __DIR__.'/auth/suggestion.php';

    // Courses Routes
    require __DIR__.'/auth/course.php';

    // Enrollment Routes
    require __DIR__.'/auth/enrollment.php';

    // Reports Routes
    require __DIR__.'/auth/report.php';

    // Feedback Routes
    require __DIR__.'/auth/feedback.php';

    // Gallery Routes
    require __DIR__.'/auth/gallery.php';

    // Expenses Routes
    require __DIR__.'/auth/expense.php';

    // Registered Number Routes
    require __DIR__.'/auth/registered_numbers.php';

    // Registered Batches Routes
    require __DIR__.'/auth/registered_batches.php';

    // Registered Years Routes
    require __DIR__.'/auth/registered_years.php';

    // Mock Schedule Routes
    require __DIR__.'/auth/mock_schedule.php';

    // Revision Classes Routes
    require __DIR__.'/auth/revision_classes.php';

    // Revision Classes Routes
    require __DIR__.'/auth/lecture_schedule.php';

    // Faculty Routes
    require __DIR__.'/auth/faculty.php';

});

Route::get('/contact-us', function() {
    return view('contact.index');
})->name('contact_us');