<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 ps" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 text-center" href="#">
            <img src="{{ asset('public/assets/img/csps-logo.png') }}" class="navbar-brand-img" alt="main_logo">
            {{-- <span class="ms-3 font-weight-bold">CSPs</span> --}}
        </a>
    </div>
    <hr class="horizontal dark mt-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <!-- URL Variables Starts-->
        <!-- Admin -->
        @php
        // Front Office
        $frontOffice = request()->is('visitors') || request()->is('daily-report');
        $communicate = request()->is('notice-board');
        $faculty = request()->is('teachers') || request()->is('enrollments/teachers') || request()->is('teachers/create');
        $alumni = request()->is('alumni');


        // Dashboard
        $dashboard = request()->is('admins/dashboard');
        // Users
        $admins = request()->is('admins') || request()->is('admins/create');
        $teachers = request()->is('teachers') || request()->is('teachers/create');
        $students = request()->is('students') || request()->is('students/create');
        $visitors = request()->is('visitors') || request()->is('visitors/create');
        $interviews = request()->is('interviews/students') || request()->is('interviews/create');
        // Accounts
        $accounts = '';
        // Enrollment
        $enrollment = request()->is('enrollments/enroll/teachers') || request()->is('enrollments/enroll/students') || request()->is('enrollments/students') || request()->is('enrollments/teachers') || request()->is('days') || request()->is('shifts');
        // Courses
        $courses = request()->is('courses') || request()->is('lessons');
        // Revenue
        $revenue = request()->is('revenue/fee-collection') || request()->is('expenses');
        // Reports
        $reports = '';
        // Expenses
        $expenses = '';
        // Attendance
        $attendance = (request()->is('attendance/students')) || request()->is('attendance/teachers') || (request()->is('attendance/staff'));
        // Weekly Class Schedule
        $weeklyClassSchedule = '';
        // Inventory
        $inventory = (request()->is('inventory')) || request()->is('inventory/add');
        // Roles and Permissions
        $rolesAndPermissions = request()->is('roles');
        // Settings
        $settings = request()->is('settings');

        
        $studentDashboard = request()->is('students/dashboard');
        // Users
        $studentProfile = request()->is('students') || request()->is('students/' . Request::route()->id . '/edit') || request()->is('students/' . Request::route()->id . '/show');
        $studentSubjects = request()->is('enrollments') || request()->is('enrollments/enroll-student');
        $studentLectureSchedule = request()->is('lectures');
        $studentNoticeBoard = request()->is('notice-board') || request()->is('visitors/create');
        $studentServices = request()->is('student-services') || request()->is('interviews/create');
        $studentExamination = request()->is('examinations') || request()->is('interviews/create');
        $studentZoomClasses = request()->is('zoom-classes') || request()->is('interviews/create');
        $studentDownloadCenter = request()->is('download-center') || request()->is('interviews/create');
        $studentTeacher = request()->is('teachers') || request()->is('interviews/create');
        $studentAlumni = request()->is('alumni') || request()->is('interviews/create');
        $studentTeacherReview = request()->is('teacher-review') || request()->is('interviews/create');
        $studentSuggestions = request()->is('suggestions') || request()->is('interviews/create');
        $studentAssignment = request()->is('assignments');
        @endphp
        <!-- Admin -->
        <!-- URL Variables Ends-->

        <ul class="navbar-nav">
            <!-- 1. Front Desk Officer -->
            @role('front_desk_admin')
                <!-- Front Office -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#users" class="nav-link collapsed {{ $frontOffice ? 'active' : '' }}" aria-controls="users" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus {{ $frontOffice ? 'text-white' : 'text-primary' }} text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Front Office</span>
                    </a>
                    <div class="collapse {{ $frontOffice ? 'show' : '' }}" id="users" style="">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('visitors')) ? 'active' : '' }}" href="{{route('visitors')}}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Admission Inquiry
                                </a>
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Daily Report
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Communicate -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#communicate" class="nav-link collapsed {{ $communicate ? 'active' : '' }}" aria-controls="communicate" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus {{ $communicate ? 'text-white' : 'text-primary' }} text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Communicate</span>
                    </a>
                    <div class="collapse {{ $communicate ? 'show' : '' }}" id="communicate" style="">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('notice-board')) ? 'active' : '' }}" href="{{route('notice_board')}}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Notice Board
                                </a>
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Send WhatsApp
                                </a>
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Send Email
                                </a>
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Send SMS
                                </a>
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Email / SMS Log
                                </a>
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Phone Call Log
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Faculty -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#faculty" class="nav-link collapsed {{ $faculty ? 'active' : '' }}" aria-controls="faculty" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus {{ $faculty ? 'text-white' : 'text-primary' }} text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Faculty</span>
                    </a>
                    <div class="collapse {{ $faculty ? 'show' : '' }}" id="faculty" style="">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('teachers')) || (request()->is('enrollments/teachers')) || (request()->is('teachers/create')) ? 'active' : '' }}" href="{{route('teachers')}}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Faculty
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Alumni -->
                <li class="nav-item">
                    <a class="nav-link {{ $studentDashboard ? 'active text-white' : '' }}" href="{{ route('alumni') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary {{ $studentDashboard ? 'text-white' : '' }} text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Alumni</span>
                    </a>
                </li>
            @endrole

            <!-- 2. Student -->
            @role('student')
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link {{ $studentDashboard ? 'active text-white' : '' }}" href="{{ route('dashboard') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary {{ $studentDashboard ? 'text-white' : '' }} text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <!-- My Profile -->
                <li class="nav-item">
                    <a class="nav-link {{ $students || $studentProfile ? 'active' : '' }}" href="{{ route('students') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary {{ $studentProfile ? 'text-white' : '' }} text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <!-- Lecture Schedule -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('enrollments.students', [Auth::user()->id]) }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary {{ $studentAssignment ? 'text-white' : '' }} text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Lecture Schedule</span>
                    </a>
                </li>
                <!-- Examination -->
                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Examination</span>
                    </a>
                </li>
                <!-- Mock Schedule -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('mock_schedule') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Mock Schedule</span>
                    </a>
                </li>
                <!-- Zoom Classes -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('zoom_classes') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Zoom Classes</span>
                    </a>
                </li>
                <!-- Syllabus -->
                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Syllabus</span>
                    </a>
                </li>
                <!-- Download Center -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('download_center') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Download Center</span>
                    </a>
                </li>
                <!-- Notice Board -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('notice_board') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Notice Board</span>
                    </a>
                </li>
                <!-- Revision Classes -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('revision_classes') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Revision Classes</span>
                    </a>
                </li>
                <!-- Faculty -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('enrollments.students', [Auth::user()->id]) }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Faculty</span>
                    </a>
                </li>
                <!-- Alumni -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('alumni') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Alumni</span>
                    </a>
                </li>
                <!-- Teacher Review -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('teacher_review') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Teacher Review</span>
                    </a>
                </li>
                <!-- Suggestions -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('suggestions') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Suggestions</span>
                    </a>
                </li>
                <!-- Contact Us -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('contact_us') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Contact Us</span>
                    </a>
                </li>
            @endrole

            <!-- 3. Teacher -->
            @role('teacher')
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('teachers') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <!-- Profile -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('teachers') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <!-- Lecture Schedule -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('enrollments.teachers', [Auth::user()->id]) }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary {{ $studentAssignment ? 'text-white' : '' }} text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Lecture Schedule</span>
                    </a>
                </li>
                <!-- Lesson Plan -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#lesson_plan" class="nav-link collapsed" aria-controls="lesson_plan" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Lesson Plan</span>
                    </a>
                    <div class="collapse" id="lesson_plan">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Manage Lesson Plan
                                </a>
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Manage Syllabus Status
                                </a>
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Report in Graph %
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Zoom Classes -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('zoom_classes') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Zoom Classes</span>
                    </a>
                </li>
                <!-- Examination -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#examination" class="nav-link collapsed" aria-controls="examination" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Examination</span>
                    </a>
                    <div class="collapse" id="examination">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('mock_schedule') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Mock Exams
                                </a>
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Evaluation
                                </a>
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Test Series
                                </a>
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Class Mock
                                </a>
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Assignment
                                </a>
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>MPT
                                </a>
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Quiz
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Download Center -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('download_center') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Download Center</span>
                    </a>
                </li>
            @endrole

            <!-- 4. Class Attendant -->
            @role('class_attendant_admin')
                <!-- Attendance -->
                <li class="nav-item">
                    <a class="nav-link" href="{{route('attendances', ['students'])}}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Attendance</span>
                    </a>
                </li>
                <!-- Zoom Classes -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('zoom_classes') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Zoom Classes</span>
                    </a>
                </li>
                <!-- Communicate -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#communicate" class="nav-link collapsed" aria-controls="communicate" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Communicate</span>
                    </a>
                    <div class="collapse" id="communicate">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('notice_board') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Notice Board
                                </a>
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Send WhatsApp
                                </a>
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Send Email
                                </a>
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Send SMS
                                </a>
                                <a class="nav-link" href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Email/SMS Log
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Fee Record -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#fee_record" class="nav-link collapsed" aria-controls="fee_record" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Fee Record</span>
                    </a>
                    <div class="collapse" id="fee_record">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('fee_collection') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Search Fee Payment
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Search Due Fee
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Student Information -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Students Information</span>
                    </a>
                </li>
                <!-- Batch Details -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#batch_details" class="nav-link collapsed" aria-controls="batch_details" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Batch Details</span>
                    </a>
                    <div class="collapse" id="batch_details">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Completion Graph
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Shifted Students
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Left Students
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Reports
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Examination -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#examination" class="nav-link collapsed" aria-controls="examination" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Examination</span>
                    </a>
                    <div class="collapse" id="examination">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Mock Exams
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Evaluation
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Test Series
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Class Mock
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Assignment
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>MPT
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Quiz
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Lesson Plan -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#lesson_plan" class="nav-link collapsed" aria-controls="lesson_plan" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Lesson Plan</span>
                    </a>
                    <div class="collapse" id="lesson_plan">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Manage Lesson Plan
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Manage Syllabus Status
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Report in Graph %
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Download Center -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Download Center</span>
                    </a>
                </li>
                <!-- Report -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Reports</span>
                    </a>
                </li>
                <!-- Faculty -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Faculty</span>
                    </a>
                </li>
                <!-- Apply Leave -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Apply Leave</span>
                    </a>
                </li>
            @endrole

            <!-- 5. Examination Officer -->
            @role('exams_admin')
                <!-- Quick Links -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#examination" class="nav-link collapsed" aria-controls="examination" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Examination</span>
                    </a>
                    <div class="collapse" id="examination">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Mock Exams
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Evaluation
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Test Series
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Class Mock
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Assignment
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>MPT
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Quiz
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Student Information -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Student Information</span>
                    </a>
                </li>
                <!-- Download Center -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Download Center</span>
                    </a>
                </li>
                <!-- Faculty -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Faculty</span>
                    </a>
                </li>
                <!-- Apply Leave -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Apply Leave</span>
                    </a>
                </li>
                <!-- Reports -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Reports</span>
                    </a>
                </li>
            @endrole

            <!-- 6. Social Media Person -->
            @role('social_media_admin')
                <!-- Handler Name -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#handler_name" class="nav-link collapsed" aria-controls="handler_name" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Handler Name</span>
                    </a>
                    <div class="collapse" id="handler_name">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Platform Name
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Tasks
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Events
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Reports
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Apply Leave -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Apply Leave</span>
                    </a>
                </li>
            @endrole

            <!-- 7. Accountant -->
            @role('accounts_admin')
                <!-- Quick Links -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Quick Links</span>
                    </a>
                </li>
                <!-- Front Office -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#front_office" class="nav-link collapsed" aria-controls="front_office" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Front Office</span>
                    </a>
                    <div class="collapse" id="front_office">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Admission Login
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Admission Inquiry
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Visitor Book
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Phone Call Log
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Fee Collection -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#fee_collection" class="nav-link collapsed" aria-controls="fee_collection" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Fee Collection</span>
                    </a>
                    <div class="collapse" id="fee_collection">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Collect Fee
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Books & Other Payments
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Search Fee Payment
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Search Due Fee
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Fee Master
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Fee Types
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Fee Discount
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Fee Carryforward
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Fee Reminder
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Student Information -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Students Information</span>
                    </a>
                </li>
                <!-- Batch Details -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#batch_details" class="nav-link collapsed" aria-controls="batch_details" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Batch Details</span>
                    </a>
                    <div class="collapse" id="batch_details">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Completion Graph
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Shifted Students
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Left Students
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Reports
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Attendance -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Attendance</span>
                    </a>
                </li>
                <!-- Examination -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#examination" class="nav-link collapsed" aria-controls="examination" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Examination</span>
                    </a>
                    <div class="collapse" id="examination">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Mock Exams
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Evaluation
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Test Series
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Class Mock
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Assignment
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>MPT
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Quiz
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Income -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Income</span>
                    </a>
                </li>
                <!-- Expenses -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Expenses</span>
                    </a>
                </li>
                <!-- Lesson Plan -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#lesson_plan" class="nav-link collapsed" aria-controls="lesson_plan" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Lesson Plan</span>
                    </a>
                    <div class="collapse" id="lesson_plan">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Manage Lesson Plan
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Manage Syllabus Status
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Report in Graph %
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Human Resource -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#human_resource" class="nav-link collapsed" aria-controls="human_resource" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Human Resource</span>
                    </a>
                    <div class="collapse" id="human_resource">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Staff Directors
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Staff Attendance
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Approve Reject Request
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Apply Leave
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Leave Types
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Communicate -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#communicate" class="nav-link collapsed" aria-controls="communicate" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Communicate</span>
                    </a>
                    <div class="collapse" id="communicate">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Notice Board
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Send WhatsApp
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Send Email
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Send SMS
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Email/SMS Log
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Inventory -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#inventory" class="nav-link collapsed" aria-controls="inventory" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Inventory</span>
                    </a>
                    <div class="collapse" id="inventory">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Issue Item
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Add Item
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Item Category
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Item Supplier
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Library -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Library</span>
                    </a>
                </li>
                <!-- Faculty -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Faculty</span>
                    </a>
                </li>
                <!-- Alumni -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Alumni</span>
                    </a>
                </li>
                <!-- Report -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Reports</span>
                    </a>
                </li>
            @endrole
            
            <!-- 8. Admin -->
            @role('admin')
                <!-- Quick Links -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Quick Links</span>
                    </a>
                </li>
                <!-- Front Office -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#front_office" class="nav-link collapsed" aria-controls="front_office" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Front Office</span>
                    </a>
                    <div class="collapse" id="front_office">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Admission Login
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Admission Inquiry
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Visitor Book
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Phone Call Log
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Student Information -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Students Information</span>
                    </a>
                </li>
                <!-- Batch Details -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#batch_details" class="nav-link collapsed" aria-controls="batch_details" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Batch Details</span>
                    </a>
                    <div class="collapse" id="batch_details">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Completion Graph
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Shifted Students
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Left Students
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Reports
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Zoom Classes -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Zoom Classes</span>
                    </a>
                </li>
                <!-- Attendance -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Attendance</span>
                    </a>
                </li>
                <!-- Examination -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#examination" class="nav-link collapsed" aria-controls="examination" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Examination</span>
                    </a>
                    <div class="collapse" id="examination">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Mock Exams
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Evaluation
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Test Series
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Class Mock
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Assignment
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>MPT
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Quiz
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Academic -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#academic" class="nav-link collapsed" aria-controls="academic" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Academic</span>
                    </a>
                    <div class="collapse" id="academic">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Class Timetable
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Teacher Timetable
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Assign Class Teacher
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Assign Class Attendant
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Assign Examination
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Assign Social Media tasks
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Lesson Plan -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#lesson_plan" class="nav-link collapsed" aria-controls="lesson_plan" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Lesson Plan</span>
                    </a>
                    <div class="collapse" id="lesson_plan">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Manage Lesson Plan
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Manage Syllabus Status
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Report in Graph %
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Human Resource -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#human_resource" class="nav-link collapsed" aria-controls="human_resource" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Human Resource</span>
                    </a>
                    <div class="collapse" id="human_resource">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Staff Directors
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Staff Attendance
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Approve Reject Request
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Apply Leave
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Teacher/Staff Rating
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Communicate -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#communicate" class="nav-link collapsed" aria-controls="communicate" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Communicate</span>
                    </a>
                    <div class="collapse" id="communicate">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Notice Board
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Send WhatsApp
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Send Email
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Send SMS
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Email/SMS Log
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Social Media -->
                <li class="nav-item">
                    <a   a data-bs-toggle="collapse" href="#social_media" class="nav-link collapsed" aria-controls="social_media" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-2"> Social Media</span>
                    </a>
                    <div class="collapse" id="social_media">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Handler Name
                                </a>
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Platform Name
                                </a>
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Tasks
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Events
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Reports
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Download Center -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Download Center</span>
                    </a>
                </li>
                <!-- Library -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Library</span>
                    </a>
                </li>
                <!-- Faculty -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Faculty</span>
                    </a>
                </li>
                <!-- List of Qualifiers -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Qualifiers</span>
                    </a>
                </li>
                <!-- Alumni -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Alumni</span>
                    </a>
                </li>
                <!-- Report -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text">Reports</span>
                    </a>
                </li>
                <!-- Roles and Permissions -->
                <li class="nav-item">
                    <a class="nav-link {{ $rolesAndPermissions ? 'active' : '' }} " href="{{ route('roles') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus {{ $rolesAndPermissions ? 'text-white' : 'text-primary' }} text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Roles/Permissions</span>
                    </a>
                </li>
            @endrole








            @role('no_user')
                <!-- Menu -->
                @can('menu_view')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('create-menus') ? 'active' : '' }}" href="{{ route('create-menus') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Menus</span>
                    </a>
                </li>
                @endcan
                <!-- Dashboard -->
                {{-- @can('dashboard_view') --}}
                <li class="nav-item">
                    <a class="nav-link {{ $dashboard ? 'active' : '' }}" href="{{ route('admin_dashboard') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                {{-- @endcan --}}
                <!-- Users -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#users" class="nav-link collapsed {{ $admins || $teachers || $students || $visitors || $interviews || $attendance ? 'active' : '' }}" aria-controls="users" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus {{ $admins || $teachers || $students || $visitors || $interviews || $attendance ? 'text-white' : 'text-primary' }} text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Users</span>
                    </a>
                    <div class="collapse {{ $admins || $teachers || $students || $visitors || $interviews || $attendance ? 'show' : '' }}" id="users" style="">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                @can('admin_view')
                                <a class="nav-link" href="{{ route('admins') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Office Staff
                                </a>
                                @endcan
                                @can('teacher_view')
                                <a class="nav-link" href="{{ route('teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Teacher
                                </a>
                                @endcan
                                @can('student_view')
                                <a class="nav-link" href="{{ route('students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Students
                                </a>
                                @endcan
                                @can('users_view')
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Admission Inquiry
                                </a>
                                <a class="nav-link {{ (request()->is('visitors') ? 'active' : request()->is('visitor/create')) ? 'active' : '' }}" href="{{ route('visitors') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Visitors
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Phone Call Log
                                </a>
                                <a class="nav-link" href="">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Daily Report
                                </a>
                                @endcan
                                @can('interview_view')
                                <a class="nav-link {{ (request()->is('interviews/students') ? 'active' : request()->is('interview/create')) ? 'active' : '' }}" href="{{ route('interview.students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Interviews
                                </a>
                                @endcan
                                @can('attendance_view')
                                <a class="nav-link {{ (request()->is('attendance/students') || request()->is('attendance/teachers') || request()->is('attendance/staff')) ? 'active' : '' }}" href="{{ route('attendances', ['students']) }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Attendance
                                </a>
                                @endcan
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Revenue -->
                @can('revenue_view')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#revenue" class="nav-link collapsed {{ $revenue ? 'active' : '' }}" aria-controls="revenue" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus {{ $revenue ? 'text-white' : 'text-primary' }} text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Revenue</span>
                    </a>
                    <div class="collapse {{ $revenue ? 'show' : '' }}" id="revenue" style="">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                @can('revenue_view')
                                <a class="nav-link {{ (request()->is('revenue/fee-collection') ? 'active' : '') }}" href="{{route('fee_collection')}}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Fee Collection
                                </a>
                                @endcan
                                @can('revenue_view')
                                <a class="nav-link {{ (request()->is('expenses') ? 'active' : '') }}" href="{{route('expenses')}}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Expenses
                                </a>
                                @endcan
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan
                <!-- Front Office -->
                @can('admission_view')
                {{-- <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#front_office" class="nav-link collapsed"
                                aria-controls="front_office" role="button" aria-expanded="false">
                                <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                    <i class="fa fa-minus-o text-primary text-sm opacity-10"></i>
                                </div>
                                <span class="nav-link-text ms-1">Front Office</span>
                            </a>
                            <div class="collapse" id="front_office" style="">
                                <ul class="nav ms-4">
                                    <li class="nav-item ">
                                        @can('admission_view')
                                        <a class="nav-link " href="#">
                                            <i class="fa fa-minus text-dark opacity-10"></i>Addmission Enquiry
                                        </a>
                                        @endcan
                                        @can('admission_view')
                                        <a class="nav-link " href="#">
                                            <i class="fa fa-minus text-dark opacity-10"></i>Visitor Book
                                        </a>
                                        @endcan
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                @endcan
                <!-- Enrollments -->
                @can('student_view')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#enrollment" class="nav-link collapsed {{ $enrollment ? 'active' : '' }}" aria-controls="enrollment" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-credit-card {{ $enrollment ? 'text-white' : 'text-primary' }} text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Enrollment</span>
                    </a>
                    <div class="collapse {{ $enrollment ? 'show' : '' }}" id="enrollment" style="">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                @can('student_view')
                                <a class="nav-link {{ ((request()->is('enrollments/students') || request()->is('enrollments/enroll/students')) ? 'active' : '') }}" href="{{ route('enrollments.students') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Students
                                </a>
                                @endcan
                                @can('teacher_view')
                                <a class="nav-link {{ ((request()->is('enrollments/teachers') || request()->is('enrollments/enroll/teachers')) ? 'active' : '') }}" href="{{ route('enrollments.teachers') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Teachers
                                </a>
                                @endcan
                                @can('enrollment_view')
                                @endcan
                                <!-- <a class="nav-link {{ (request()->is('days') ? 'active' : '') }}" href="{{ route('days') }}">
                                            <i class="fa fa-minus text-dark opacity-10"></i>Days
                                        </a>
                                        <a class="nav-link {{ (request()->is('shifts') ? 'active' : '') }}" href="{{ route('shifts') }}">
                                            <i class="fa fa-minus text-dark opacity-10"></i>Shifts
                                        </a> -->
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan
                <!-- Courses -->
                @can('courses_view')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#courses" class="nav-link collapsed {{ $courses ? 'active' : '' }}" aria-controls="courses" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus {{ $courses ? 'text-white' : 'text-primary' }} text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Courses</span>
                    </a>
                    <div class="collapse {{ $courses ? 'show' : '' }}" id="courses" style="">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('courses') ? 'active' : '') }}" href="{{ route('courses') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Manage Courses
                                </a>
                                <!-- <a class="nav-link {{ (request()->is('lessons') ? 'active' : '') }}" href="{{route('lesson_plans')}}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Lesson Plans
                                </a> -->
                                @can('assignment_view')
                                <a class="nav-link" href="{{route('assignments')}}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Assignments
                                </a>
                                @endcan
                                {{-- <a class="nav-link " href="#">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Course Category
                                </a> --}}
                                {{-- <a class="nav-link " href="#">
                                            <i class="fa fa-minus text-dark opacity-10"></i>Coupons
                                        </a> --}}
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan
                <!-- Reports -->
                @can('reports_view')
                {{-- <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#reports" class="nav-link collapsed" aria-controls="reports"
                                role="button" aria-expanded="false">
                                <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                    <i class="fa fa-minus-text text-primary text-sm opacity-10"></i>
                                </div>
                                <span class="nav-link-text ms-1">Reports</span>
                            </a>
                            <div class="collapse" id="reports" style="">
                                <ul class="nav ms-4">
                                    <li class="nav-item ">
                                        <a class="nav-link " href="#">
                                            <i class="fa fa-minus text-dark opacity-10"></i>Admin Revenue
                                        </a>
                                        <a class="nav-link " href="#">
                                            <i class="fa fa-minus text-dark opacity-10"></i>Instructor Revenue
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                @endcan
                <!-- Expenses -->
                @can('expenses_view')
                {{-- <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#expenses" class="nav-link collapsed" aria-controls="expenses"
                                role="button" aria-expanded="false">
                                <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                    <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                                </div>
                                <span class="nav-link-text ms-1">Expenses</span>
                            </a>
                            <div class="collapse" id="expenses" style="">
                                <ul class="nav ms-4">
                                    <li class="nav-item ">
                                        <a class="nav-link " href="#">
                                            <i class="fa fa-minus text-dark opacity-10"></i>Add Expense
                                        </a>
                                        <a class="nav-link " href="#">
                                            <i class="fa fa-minus text-dark opacity-10"></i>Manage Expense
                                        </a>
                                        <a class="nav-link " href="#">
                                            <i class="fa fa-minus text-dark opacity-10"></i>Add New Head
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                @endcan
                <!-- Attendance -->
                @can('attendance_view')
                {{-- <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#attendance" class="nav-link collapsed"
                                aria-controls="attendance" role="button" aria-expanded="false">
                                <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                    <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                                </div>
                                <span class="nav-link-text ms-1">Attendance</span>
                            </a>
                            <div class="collapse" id="attendance" style="">
                                <ul class="nav ms-4">
                                    <li class="nav-item ">
                                        <a class="nav-link " href="#">
                                            <i class="fa fa-minus text-dark opacity-10"></i>Update Attendance
                                        </a>
                                        <a class="nav-link " href="#">
                                            <i class="fa fa-minus text-dark opacity-10"></i>Attendance by date
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                @endcan
                <!-- Weekly Class Schedule -->
                @can('attendance_view')
                {{-- <li class="nav-item">
                            <a class="nav-link " href="/profile.html">
                                <div
                                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="fa fa-minus-o text-primary text-sm opacity-10"></i>
                                </div>
                                <span class="nav-link-text ms-1">Weekly Class Schedule</span>
                            </a>
                        </li> --}}
                @endcan
                <!-- Inventory -->
                @can('inventory_view')
                <li class="nav-item">
                    <a class="nav-link " href="{{route('inventory')}}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Inventory</span>
                    </a>
                </li>
                @endcan
                <!-- Communication -->
                @can('communication_view')
                {{-- <li class="nav-item">
                            <a class="nav-link " href="/profile.html">
                                <div
                                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-broadcast-tower text-primary text-sm opacity-10"></i>
                                </div>
                                <span class="nav-link-text ms-1">Communication</span>
                            </a>
                        </li> --}}
                @endcan
                <!-- Roles and Permissions -->
                @can('roles_view')
                <li class="nav-item">
                    <a class="nav-link {{ $rolesAndPermissions ? 'active' : '' }} " href="{{ route('roles') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus {{ $rolesAndPermissions ? 'text-white' : 'text-primary' }} text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Roles/Permissions</span>
                    </a>
                </li>
                @endcan
                <!-- Feedback -->
                @can('feedback_view')
                <li class="nav-item">
                    <a class="nav-link " href="/profile.html">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-comments text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Feedback</span>
                    </a>
                </li>
                @endcan
                <!-- Gallery -->
                @can('gallery_view')
                <li class="nav-item">
                    <a class="nav-link " href="/profile.html">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus-o text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Gallery</span>
                    </a>
                </li>
                @endcan
                <!-- Manage CSPs -->
                <li class="nav-item mb-4">
                    <a data-bs-toggle="collapse" href="#setting" class="nav-link collapsed" aria-controls="setting" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Settings</span>
                    </a>
                    <div class="collapse" id="setting" style="">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('settings.seminar_dates') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Seminar Dates Setting
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('registered_years') }}">
                                    <i class="fa fa-minus text-dark opacity-10"></i>Registration Setting
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Home -->
                @can('teacher_view')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('teachers/dashboard') ? 'active' : '' }}" href="{{ route('teachers/dashboard') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Home</span>
                    </a>
                </li>
                @endcan
                <!-- My Attendance -->
                @can('teacher_view')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('teachers/students/attendance') ? 'active' : '' }}" href="{{ route('attendances', ['teachers']) }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-time-alarm text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Attendance</span>
                    </a>
                </li>
                @endcan
                @can('student_view')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('teachers/students/attendance') ? 'active' : '' }}" href="{{ route('attendances', ['students']) }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-time-alarm text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Attendance</span>
                    </a>
                </li>
                @endcan
                <!-- Examination -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('teachers/examination') ? 'active' : '' }}" href="{{ route('teachers/examination') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-paper-diploma text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Examination</span>
                    </a>
                </li>
                <!-- Lesson Plan -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('enrollments/teachers') ? 'active' : '' }}" href="{{ route('enrollments/teachers') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-ruler-pencil text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Lesson Plan</span>
                    </a>
                </li>
                <!-- Academics -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('teachers/academics') ? 'active' : '' }}" href="{{ route('teachers/academics') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-hat-3 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Academics</span>
                    </a>
                </li>
                <!-- Download Center -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('download_center') ? 'active' : '' }}" href="{{ route('download_center') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-cloud-download-95 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Download Center</span>
                    </a>
                </li>
                <!-- Assignment -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('assignments/teachers') ? 'active' : '' }}" href="{{ route('assignments', ['teachers']) }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Assignment</span>
                    </a>
                </li>
                <!-- Zoom Class -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('zoom_classes') ? 'active' : '' }}" href="{{ route('zoom_classes') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-camera-compact text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Zoom Class</span>
                    </a>
                </li>
                <!-- URL Variables Starts-->
                <!-- Admin -->
                <!-- URLs Ends-->
            @endrole
        </ul>
    </div>
</aside>