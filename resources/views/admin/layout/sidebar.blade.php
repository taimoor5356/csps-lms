<aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 ps"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 text-center" href="#" target="_blank">
            <img src="{{ asset('public/assets/img/csps-logo.png') }}" class="navbar-brand-img" alt="main_logo">
            {{-- <span class="ms-3 font-weight-bold">CSPs</span> --}}
        </a>
    </div>
    <hr class="horizontal dark mt-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        @role('admin')
        <ul class="navbar-nav">
            <!-- Menu -->
            @can('menu_view')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('create-menus') ? 'active' : '' }}" href="{{ url('create-menus') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bars text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Menus</span>
                </a>
            </li>
            @endcan
            <!-- Dashboard -->
            {{-- @can('dashboard_view') --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            {{-- @endcan --}}
            <!-- Front Office -->
            @can('admission_view')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#front_office" class="nav-link collapsed" aria-controls="front_office"
                    role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-building-o text-success text-sm opacity-10"></i>
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
            </li>
            @endcan
            <!-- Enrollments -->
            @can('enrollment_view')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#enrollment" class="nav-link collapsed" aria-controls="enrollment"
                    role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Enrollment</span>
                </a>
                <div class="collapse" id="enrollment" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('enrollments') }}">
                                <i class="fa fa-minus text-dark opacity-10"></i>Enroll History
                            </a>
                            <a class="nav-link " href="{{ route('enroll-student.create') }}">
                                <i class="fa fa-minus text-dark opacity-10"></i>Enroll a Student
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan
            <!-- Courses -->
            @can('courses_view')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#courses" class="nav-link collapsed" aria-controls="courses"
                    role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-book text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Courses</span>
                </a>
                <div class="collapse" id="courses" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('courses') }}">
                                <i class="fa fa-minus text-dark opacity-10"></i>Manage Courses
                            </a>
                            <a class="nav-link " href="#">
                                <i class="fa fa-minus text-dark opacity-10"></i>Add New Course
                            </a>
                            <a class="nav-link " href="#">
                                <i class="fa fa-minus text-dark opacity-10"></i>Course Category
                            </a>
                            <a class="nav-link " href="#">
                                <i class="fa fa-minus text-dark opacity-10"></i>Coupons
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan
            <!-- Revenue -->
            @can('expenses_view')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#revenue" class="nav-link collapsed" aria-controls="revenue"
                    role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-money text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Revenue</span>
                </a>
                <div class="collapse" id="revenue" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link " href="#">
                                <i class="fa fa-minus text-dark opacity-10"></i>Collect Fee
                            </a>
                            <a class="nav-link " href="#">
                                <i class="fa fa-minus text-dark opacity-10"></i>Search Fee Payment
                            </a>
                            <a class="nav-link " href="#">
                                <i class="fa fa-minus text-dark opacity-10"></i>Overdue Fees
                            </a>
                            <a class="nav-link " href="#">
                                <i class="fa fa-minus text-dark opacity-10"></i>Fee Reminder
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan
            <!-- Reports -->
            @can('reports_view')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#reports" class="nav-link collapsed" aria-controls="reports"
                    role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-file-text text-secondary text-sm opacity-10"></i>
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
            </li>
            @endcan
            <!-- Expenses -->
            @can('expenses_view')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#expenses" class="nav-link collapsed" aria-controls="expenses"
                    role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-money text-danger text-sm opacity-10"></i>
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
            </li>
            @endcan
            <!-- Attendance -->
            @can('attendance_view')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#attendance" class="nav-link collapsed" aria-controls="attendance"
                    role="button" aria-expanded="false">
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
            </li>
            @endcan
            <!-- Weekly Class Schedule -->
            @can('attendance_view')
            <li class="nav-item">
                <a class="nav-link " href="/profile.html">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-clock-o text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Weekly Class Schedule</span>
                </a>
            </li>
            @endcan
            <!-- Inventory -->
            @can('inventory_view')
            <li class="nav-item">
                <a class="nav-link " href="/profile.html">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-database text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Inventory</span>
                </a>
            </li>
            @endcan
            <!-- Communication -->
            @can('communication_view')
            <li class="nav-item">
                <a class="nav-link " href="/profile.html">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-broadcast-tower text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Communication</span>
                </a>
            </li>
            @endcan
            <!-- Users -->
            @can('users_view')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#users"
                    class="nav-link collapsed {{ (request()->is('students') ? 'active' : request()->is('students/create')) ? 'active' : '' }}"
                    aria-controls="users" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-users text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
                <div class="collapse {{ (request()->is('students') ? 'show' : request()->is('students/create')) ? 'show' : '' }}"
                    id="users" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('admins') }}">
                                <i class="fa fa-minus text-dark opacity-10"></i>Admins
                            </a>
                            <a class="nav-link " href="#">
                                <i class="fa fa-minus text-dark opacity-10"></i>Instructors
                            </a>
                            <a class="nav-link {{ (request()->is('students') ? 'active' : request()->is('students/create')) ? 'active' : '' }}"
                                href="{{ route('students') }}">
                                <i class="fa fa-minus text-dark opacity-10"></i>Students
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan
            <!-- Roles and Permissions -->
            @can('roles_view')
            <li class="nav-item">
                <a class="nav-link " href="{{ route('roles') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-lock text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Roles/Permissions</span>
                </a>
            </li>
            @endcan
            <!-- Feedback -->
            @can('feedback_view')
            <li class="nav-item">
                <a class="nav-link " href="/profile.html">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-comments text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Feedback</span>
                </a>
            </li>
            @endcan
            <!-- Gallery -->
            @can('gallery_view')
            <li class="nav-item">
                <a class="nav-link " href="/profile.html">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-picture-o text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Gallery</span>
                </a>
            </li>
            @endcan
            <!-- Manage CSPs -->
            @can('settings_view')
            <li class="nav-item">
                <a class="nav-link " href="/profile.html">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-cog text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Manage CSPs</span>
                </a>
            </li>
            @endcan
        </ul>
        @endrole
        @role('student')
        <ul class="navbar-nav">
            <!-- Home -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li>
            <!-- My Profile -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('students') ? 'active' : '' }}" href="{{ url('students') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-circle-08 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <!-- Academic -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#academic" class="nav-link collapsed" aria-controls="academic"
                    role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-graduation-cap text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Academic</span>
                </a>
                <div class="collapse" id="academic" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('enrollments') }}">
                                <i class="fa fa-minus text-dark opacity-10"></i>Subjects
                            </a>
                            <a class="nav-link " href="#">
                                <i class="fa fa-minus text-dark opacity-10"></i>My Lecture
                            </a>
                            <a class="nav-link " href="#">
                                <i class="fa fa-minus text-dark opacity-10"></i>E-Library
                            </a>
                            <a class="nav-link " href="#">
                                <i class="fa fa-minus text-dark opacity-10"></i>Faculty
                            </a>
                            <a class="nav-link " href="#">
                                <i class="fa fa-minus text-dark opacity-10"></i>Batch
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Evaluation -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#evaluation" class="nav-link collapsed" aria-controls="evaluation"
                    role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-check text-danger text-sm opacity-10"></i>
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
            </li>
            <!-- Feedback -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('feedback') ? 'active' : '' }}" href="{{ url('feedback') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-comments text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Feedback</span>
                </a>
            </li>
            <!-- Alumni -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('alumni') ? 'active' : '' }}" href="{{ url('alumni') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-graduation-cap text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Alumni</span>
                </a>
            </li>
            <!-- Publication -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('publication') ? 'active' : '' }}" href="{{ url('publication') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-newspaper-o text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Publication</span>
                </a>
            </li>
            <!-- Complaint -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('complaint') ? 'active' : '' }}" href="{{ url('complaint') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-comment-o text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Complaint</span>
                </a>
            </li>
        </ul>
        @endrole
    </div>
</aside>
