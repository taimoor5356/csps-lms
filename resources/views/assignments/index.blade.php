@extends('layout.app')
@section('content')
@section('style')
<style>
    /* --- Styling Here --- */
    /* --- Styling Here --- */
</style>
@endsection
@section('breadcrumbs')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="text-light" href="javascript:;">CSPs</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page"><span class="text-light">Assignments</span>
        </li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Assignments</h6>
</nav>
@endsection
<div class="container-fluid py-4">
    <div class="row">
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col-3">
                            <select name="subject" id="subject" class="form-control subject" placeholder="Subject">
                                <option value="" disabled selected>Select Subject</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <select name="batch" id="batch" class="form-control batch" placeholder="Batch">
                                <option value="" disabled selected>Select Batch</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <select name="time" id="time" class="form-control time" placeholder="Time">
                                <option value="" disabled selected>Due Date</option>
                            </select>
                        </div>
                        <div class="col-3 d-flex justify-content-end">
                            <button class="btn btn-primary create-new-assignment" data-bs-toggle="modal" data-bs-target="#new-assignment">Create New Assignment</button>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-12">
                            @include('assignments._table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- Section Modal -->
@section('modal')
<div class="row">
    <div class="col-md-4">
        <form action="{{route('assignments.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="new-assignment" tabindex="-1" role="dialog" aria-labelledby="new-assignment" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title text-dark" id="modal-title-default">Add New Assignment</h6>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="student_id">Select Student</label>
                                    <select name="student_id" id="student_id" class="form-control">
                                        <option value="" selected disabled>Select Student</option>
                                        @php 
                                            if(Auth::user()->hasRole('student')) {
                                                $students = \App\Models\User::where('role_id', 3)->where('id', Auth::user()->id)->get();
                                            } else {
                                                $students = \App\Models\User::where('role_id', 3)->get();
                                            }
                                        @endphp
                                        @foreach($students as $student)
                                        <option value="{{$student->id}}" @if(Auth::user()->hasRole('student')) ? selected : '' @endif>{{$student->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="course_id">Select Course</label>
                                    <select name="course_id" id="course_id" class="form-control">
                                        <option value="" selected disabled>Select Course</option>
                                        @php 
                                            if(Auth::user()->hasRole('student')) {
                                                $studentCourses = \App\Models\StudentLectureSchedule::where('student_id', Auth::user()->id)->pluck('course_id');
                                                $courses = \App\Models\Course::whereIn('id', $studentCourses)->get();
                                            } else {
                                                $courses = \App\Models\Course::get();
                                            }
                                        @endphp
                                        @foreach($courses as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="teacher_id">Select Teacher</label>
                                    <select name="teacher_id" id="teacher_id" class="form-control">
                                        <option value="" selected disabled>Select Teacher</option>
                                        @php 
                                            if(Auth::user()->hasRole('student')) {
                                                $studentCourses = \App\Models\StudentLectureSchedule::where('student_id', Auth::user()->id)->pluck('course_id');
                                                $teacherCourses = \App\Models\TeacherLectureSchedule::whereIn('course_id', $studentCourses)->pluck('teacher_id');
                                                $teachers = \App\Models\Teacher::with('user')->whereIn('user_id', $teacherCourses)->get();
                                            } else {
                                                $teachers = \App\Models\Teacher::with('user')->get();
                                            }
                                        @endphp
                                        @foreach($teachers as $teacher)
                                        <option value="{{$teacher->user_id}}">{{$teacher->user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="image">Upload Assignment</label>
                                    <input type="file" name="image" class="form-control" id="image">
                                </div>
                                <div class="col-md-4">
                                    <label for="short_msg">Short Message</label>
                                    <input type="text" name="short_msg" class="form-control" id="short_msg" placeholder="Enter short message">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-start">
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
<!-- Section Modal -->
@section('page_js')
<script>
    $(document).ready(function() {
        @if(session('success'))
        $('.toast .success-header').html('Success');
        $('.toast .toast-header').addClass('bg-success');
        $('.toast .toast-body').addClass('bg-success');
        $('.toast .toast-body').html("{{session('success')}}");
        $('.toast').toast('show');
        @elseif(session('error'))
        $('.toast .success-header').html('Error');
        $('.toast .toast-header').addClass('bg-danger');
        $('.toast .toast-body').addClass('bg-danger');
        $('.toast .toast-body').html("{{session('error')}}");
        $('.toast').toast('show');
        @endif
        // Data Table Starts
        var table = $('.data-table').DataTable({
            responsive: true,
            processing: true,
            // stateSave: true,
            serverSide: true,
            bDestroy: true,
            scrollX: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('assignments') }}",
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'course_name',
                    name: 'course_name'
                },
                {
                    data: 'batch_no',
                    name: 'batch_no'
                },
                {
                    data: 'assignment',
                    name: 'assignment'
                },
                {
                    data: 'date_time',
                    name: 'date_time'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                @role('admin') {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                @endrole
            ],
            initComplete: function(settings, json) {
                $('body').find('.dataTables_scrollBody').addClass("custom-scrollbar");
                $('body').find('.dataTables_paginate.paging_simple_numbers').addClass(
                    "custom-pagination");
                $('body').find('.dataTables_wrapper .custom-pagination .paginate_button').addClass(
                    "text-color");
            }
        });
    });
</script>
@endsection