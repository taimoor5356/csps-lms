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
        <ul class="navbar-nav">
            <!-- Menu -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('create-menus') ? 'active' : '' }}" href="{{ url('create-menus') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bars text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Menus</span>
                </a>
            </li>
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <!-- Front Office -->
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
            <!-- Enrollments -->
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
            <!-- Courses -->
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
            <!-- Revenue -->
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
            <!-- Reports -->
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
            <!-- Expenses -->
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
            <!-- Attendance -->
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
            <!-- Weekly Class Schedule -->
            <li class="nav-item">
                <a class="nav-link " href="/profile.html">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-clock-o text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Weekly Class Schedule</span>
                </a>
            </li>
            <!-- Inventory -->
            <li class="nav-item">
                <a class="nav-link " href="/profile.html">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-database text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Inventory</span>
                </a>
            </li>
            <!-- Communication -->
            <li class="nav-item">
                <a class="nav-link " href="/profile.html">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-broadcast-tower text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Communication</span>
                </a>
            </li>
            <!-- Users -->
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
                            <a class="nav-link " href="#">
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
            <!-- Roles and Permissions -->
            <li class="nav-item">
                <a class="nav-link " href="{{ route('roles') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-lock text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Roles/Permissions</span>
                </a>
            </li>
            <!-- Feedback -->
            <li class="nav-item">
                <a class="nav-link " href="/profile.html">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-comments text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Feedback</span>
                </a>
            </li>
            <!-- Gallery -->
            <li class="nav-item">
                <a class="nav-link " href="/profile.html">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-picture-o text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Gallery</span>
                </a>
            </li>
            <!-- Manage CSPs -->
            <li class="nav-item">
                <a class="nav-link " href="/profile.html">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-cog text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Manage CSPs</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
