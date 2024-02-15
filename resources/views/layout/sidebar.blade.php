<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 ps" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 text-center" href="#" target="_blank">
            <img src="{{ asset('public/assets/img/csps-logo.png') }}" class="navbar-brand-img" alt="main_logo">
            {{-- <span class="ms-3 font-weight-bold">CSPs</span> --}}
        </a>
    </div>
    <hr class="horizontal dark mt-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <!-- URL Variables Starts-->
        <!-- Admin -->
        @php
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
        // Front Office
        $frontOffice = '';
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
        @endphp
        <!-- Admin -->
        <!-- URL Variables Ends-->

        <!-- URLs Starts-->
        @role('admin')
        <ul class="navbar-nav">
            <!-- Menu -->
            @can('menu_view')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('create-menus') ? 'active' : '' }}" href="{{ url('create-menus') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bars text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Menus</span>
                </a>
            </li>
            @endcan
            <!-- Dashboard -->
            {{-- @can('dashboard_view') --}}
            <li class="nav-item">
                <a class="nav-link {{ $dashboard ? 'active' : '' }}" href="{{ url('admins/dashboard') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            {{-- @endcan --}}
            <!-- Users -->
            @can('users_view')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#users" class="nav-link collapsed {{ $admins || $teachers || $students || $visitors || $interviews || $attendance ? 'active' : '' }}" aria-controls="users" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-users {{ $admins || $teachers || $students || $visitors || $interviews || $attendance ? 'text-white' : 'text-primary' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
                <div class="collapse {{ $admins || $teachers || $students || $visitors || $interviews || $attendance ? 'show' : '' }}" id="users" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link {{ (request()->is('admins') ? 'active' : request()->is('admins/create')) ? 'active' : '' }}" href="{{ route('admins') }}">
                                <i class="fa fa-minus text-dark opacity-10"></i>Admins
                            </a>
                            <a class="nav-link {{ (request()->is('teachers') ? 'active' : request()->is('teacher/create')) ? 'active' : '' }}" href="{{ route('teachers') }}">
                                <i class="fa fa-minus text-dark opacity-10"></i>Teacher
                            </a>
                            <a class="nav-link {{ (request()->is('students') ? 'active' : request()->is('students/create')) ? 'active' : '' }}" href="{{ route('students') }}">
                                <i class="fa fa-minus text-dark opacity-10"></i>Students
                            </a>
                            <a class="nav-link {{ (request()->is('visitors') ? 'active' : request()->is('visitor/create')) ? 'active' : '' }}" href="{{ route('visitors') }}">
                                <i class="fa fa-minus text-dark opacity-10"></i>Visitors
                            </a>
                            <a class="nav-link {{ (request()->is('interviews/students') ? 'active' : request()->is('interview/create')) ? 'active' : '' }}" href="{{ route('interview.students') }}">
                                <i class="fa fa-minus text-dark opacity-10"></i>Interviews
                            </a>
                            <a class="nav-link {{ (request()->is('attendance/students') || request()->is('attendance/teachers') || request()->is('attendance/staff')) ? 'active' : '' }}" href="{{ route('attendances', ['students']) }}">
                                <i class="fa fa-minus text-dark opacity-10"></i>Attendance
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan
            <!-- Revenue -->
            @role('admin')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#revenue" class="nav-link collapsed {{ $revenue ? 'active' : '' }}" aria-controls="revenue" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-money {{ $revenue ? 'text-white' : 'text-primary' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Revenue</span>
                </a>
                <div class="collapse {{ $revenue ? 'show' : '' }}" id="revenue" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link {{ (request()->is('revenue/fee-collection') ? 'active' : '') }}" href="{{route('fee_collection')}}">
                                <i class="fa fa-minus text-dark opacity-10"></i>Fee Collection
                            </a>
                            <a class="nav-link {{ (request()->is('expenses') ? 'active' : '') }}" href="{{route('expenses')}}">
                                <i class="fa fa-minus text-dark opacity-10"></i>Expenses
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endrole
            <!-- Front Office -->
            @can('admission_view')
            {{-- <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#front_office" class="nav-link collapsed"
                            aria-controls="front_office" role="button" aria-expanded="false">
                            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                <i class="fa fa-building-o text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Front Office</span>
                        </a>
                        <div class="collapse" id="front_office" style="">
                            <ul class="nav ms-4">
                                <li class="nav-item ">
                                    <a class="nav-link " href="#">
                                        <i class="fa fa-minus text-dark opacity-10"></i>Addmission Enquiry
                                    </a>
                                    <a class="nav-link " href="#">
                                        <i class="fa fa-minus text-dark opacity-10"></i>Visitor Book
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}
            @endcan
            <!-- Enrollments -->
            @can('enrollment_view')
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
                            <a class="nav-link {{ ((request()->is('enrollments/students') || request()->is('enrollments/enroll/students')) ? 'active' : '') }}" href="{{ route('enrollments.students') }}">
                                <i class="fa fa-minus text-dark opacity-10"></i>Students
                            </a>
                            <a class="nav-link {{ ((request()->is('enrollments/teachers') || request()->is('enrollments/enroll/teachers')) ? 'active' : '') }}" href="{{ route('enrollments.teachers') }}">
                                <i class="fa fa-minus text-dark opacity-10"></i>Teachers
                            </a>
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
                        <i class="fa fa-book {{ $courses ? 'text-white' : 'text-primary' }} text-sm opacity-10"></i>
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
                            <a class="nav-link {{ (request()->is('assignments') ? 'active' : '') }}" href="{{route('assignments')}}">
                                <i class="fa fa-minus text-dark opacity-10"></i>Assignments
                            </a>
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
                                <i class="fa fa-file-text text-primary text-sm opacity-10"></i>
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
                                <i class="fa fa-money text-primary text-sm opacity-10"></i>
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
                                <i class="fa fa-user-clock text-primary text-sm opacity-10"></i>
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
                                <i class="fa fa-clock-o text-primary text-sm opacity-10"></i>
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
                        <i class="fa fa-database text-primary text-sm opacity-10"></i>
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
                        <i class="fa fa-key
                        {{ $rolesAndPermissions ? 'text-white' : 'text-primary' }} text-sm opacity-10"></i>
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
                        <i class="fa fa-picture-o text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Gallery</span>
                </a>
            </li>
            @endcan
            <!-- Manage CSPs -->
            <li class="nav-item mb-4">
                <a data-bs-toggle="collapse" href="#setting" class="nav-link collapsed" aria-controls="setting" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-user-clock text-primary text-sm opacity-10"></i>
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
        </ul>
        @endrole
        @role('teacher')
        <ul class="navbar-nav">
            <!-- Home -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('teachers/dashboard') ? 'active' : '' }}" href="{{ url('teachers/dashboard') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li>
            <!-- My Attendance -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('teachers/students/attendance') ? 'active' : '' }}" href="{{ route('attendances', ['students']) }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-time-alarm text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Attendance</span>
                </a>
            </li>
            <!-- Examination -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('teachers/examination') ? 'active' : '' }}" href="{{ url('teachers/examination') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-paper-diploma text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Examination</span>
                </a>
            </li>
            <!-- Lesson Plan -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('enrollments/teachers') ? 'active' : '' }}" href="{{ url('enrollments/teachers') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-ruler-pencil text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Lesson Plan</span>
                </a>
            </li>
            <!-- Academics -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('teachers/academics') ? 'active' : '' }}" href="{{ url('teachers/academics') }}">
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
        </ul>
        @endrole
        <!-- URL Variables Starts-->
        <!-- Admin -->
        @php
        // Dashboard
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
        @endphp
        <!-- Admin -->
        <!-- URL Variables Ends-->
        @role('student')
        <ul class="navbar-nav">
            <!-- Home -->
            <li class="nav-item">
                <a class="nav-link {{ $studentDashboard ? 'active' : '' }}" href="{{ url('dashboard') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li>
            <!-- My Profile -->
            <li class="nav-item">
                <a class="nav-link {{ $studentProfile ? 'active' : '' }}" href="{{ url('students') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <!-- Academic -->
            {{-- <li class="nav-item">
                <a data-bs-toggle="collapse" href="#academic" class="nav-link 
                {{ 
                    $studentSubjects || $studentLectureSchedule || $studentNoticeBoard || $studentServices || $studentExamination
                    ||
                    $studentZoomClasses || $studentDownloadCenter || $studentTeacher || $studentAlumni || $studentTeacherReview ||
                    $studentSuggestions ? 'active' : '' 
                }}" aria-controls="academic"
            role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                <i class="fa fa-graduation-cap text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Academic</span>
            </a>
            <div class="collapse
                
                " id="academic" style="">
                <ul class="nav ms-4">
                    <li class="nav-item ">
                    </li>
                </ul>
            </div>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link " href="{{ route('mock_schedule') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Mock Schedule</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('revision_classes') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Revision Classes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Lecture Schedule</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('notice_board') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Notice Board</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('student_services') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Student Services</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('examinations') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Examinations</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('zoom_classes') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Zoom Classes</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('download_center') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Download Center</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('faculty') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Faculty</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('alumni') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Alumni</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('teacher_review') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Teacher Review</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('suggestions') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Suggestions</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('contact_us') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Contact Us</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                    <a class="nav-link " href="{{ route('enrollments') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-minus text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Subjects</span>

            </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Lectures</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('teachers') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Teacher</span>

                </a>
            </li> --}}
            <!-- Evaluation -->
            {{-- <li class="nav-item">
                <a data-bs-toggle="collapse" href="#evaluation" class="nav-link collapsed" aria-controls="evaluation"
                    role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-minus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Evaluation</span>
                </a>
                <div class="collapse" id="evaluation" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link " href="#">
                                <i class="fa fa-minus text-dark opacity-10"></i>Self Test
                            </a>
                            <a class="nav-link " href="#">
                                <i class="fa fa-minus text-dark opacity-10"></i>Assignments
                            </a>
                            <a class="nav-link " href="#">
                                <i class="fa fa-minus text-dark opacity-10"></i>Quiz
                            </a>
                            <a class="nav-link " href="#">
                                <i class="fa fa-minus text-dark opacity-10"></i>Exam
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            <!-- Feedback -->
            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->is('feedback') ? 'active' : '' }}" href="{{ url('feedback') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-minus text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Feedback</span>
            </a>
            </li> --}}
            <!-- Alumni -->
            {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->is('alumni') ? 'active' : '' }}" href="{{ url('alumni') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-minus text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Alumni</span>
            </a>
            </li> --}}
            <!-- Publication -->
            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->is('publication') ? 'active' : '' }}" href="{{ url('publication') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-minus text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Publication</span>
            </a>
            </li> --}}
            <!-- Complaint -->
            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->is('complaint') ? 'active' : '' }}" href="{{ url('complaint') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-minus text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Complaint</span>
            </a>
            </li> --}}
        </ul>
        @endrole
        <!-- URLs Ends-->
    </div>
</aside>