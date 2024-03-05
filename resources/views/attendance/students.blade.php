@extends('layout.app')
@section('content')
@section('style')
    <!-- Styling Here -->
    <style>
        .student-modal-card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .student-modal-card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm>.col,
        .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }

        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }

        .h-100 {
            height: 100% !important;
        }

        .shadow-none {
            box-shadow: none !important;
        }
        .child-table>tr>td {
            border: 1px solid lightgrey;
        }
    </style>
    <!-- Styling Here -->
@endsection
@section('breadcrumbs')
    @include('layout.breadcrumb', ['institute_name' => 'CSPs', 'tab_name' => 'Users', 'page_title' => 'Students Attendance']);
@endsection
<!-- Section Body -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h6>Students Attendance</h6>
                    <div class="alert-messages w-50 ms-auto text-center">
                        <div class="toast bg-success" id="notification" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header text-bold text-white py-0 bg-success border-bottom border-white">
                                <span class="success-header"></span>
                                <div class="close-toast-msg ms-auto text-end cursor-pointer">
                                    X
                                </div>
                            </div>
                            <div class="toast-body text-white text-bold">
                                
                            </div>
                        </div>
                    </div>
                    <div class="header-buttons ms-auto text-end">
                        @can('attendance_create')
                        <a href="{{ route('attendances', ['teachers']) }}" class="btn btn-primary">Teachers</a>
                        <a href="{{ route('attendances', ['staff']) }}" class="btn btn-primary">Staff</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @can('attendance_create')
                    <div class="row px-3">
                        <div class="col-md-3">
                            <label for="course_id">Select Course</label>
                            <select name="course_id" class="form-control" id="course_id">
                                <option value="" selected>Select Course</option>
                                @php  
                                    $courses = \App\Models\Course::query();
                                    if (!empty($userId)) {
                                        $studentEnrolledCourseIds = \App\Models\Enrollment::where('user_id', $userId)->pluck('course_id');
                                        $courses = $courses->whereIn('id', $studentEnrolledCourseIds);
                                    }
                                    $courses = $courses->get();
                                @endphp
                                @foreach ($courses as $course)
                                    <option value="{{$course->id}}">{{$course->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="batch_id">Select Batch</label>
                            <select name="batch_id" class="form-control" id="batch_id">
                                <option value="" selected>Select Batch</option>
                                @php  
                                    $batches = \App\Models\RegisteredBatch::query()->with('registeredYear');
                                    $batches = $batches->get();
                                @endphp
                                @foreach ($batches as $batch)
                                    <option value="{{$batch->id}}">{{$batch->batch}} ({{$batch->registeredYear->registered_year}})</option>
                                @endforeach
                            </select>
                        </div>
                        @if(!empty($userId))
                        <div class="col-md-3">
                            <label for="date_from">Date From</label>
                            <input type="date" class="form-control" name="date_from" id="date_from">
                        </div>
                        <div class="col-md-3">
                            <label for="date_to">Date to</label>
                            <input type="date" class="form-control" name="date_to" id="date_to">
                        </div>
                        @endif
                    </div>
                    <hr>
                    @endcan
                    <div class="row">
                        <div class="col-12">
                    <small class="mx-3 text-danger">* Scroll right if unable to see Actions</small>
                    @include('attendance._table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Section Body -->
@endsection
<!-- Section Modal -->
@section('modal')

@endsection
<!-- Section Modal -->
@section('page_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Scripting Here -->
<script>
    $(document).ready(function() {
        @if (session('success'))
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
                url: "{{ route('attendances', ['students', $userId]) }}",
                data: function (d) {
                    d.course_id = $('#course_id').val();
                    d.date_from = $('#date_from').val();
                    d.date_to = $('#date_to').val();
                    d.batch_id = $('#batch_id').val();
                }
            },
            columns: [
                @if(!empty($userId))
                {
                    data: 'date_time',
                    name: 'date_time'
                },
                @endif
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'reg_number',
                    name: 'reg_number'
                },
                {
                    data: 'batch_no',
                    name: 'batch_no'
                },
                @role('teacher')
                {
                    data: 'attendance',
                    name: 'attendance'
                },
                @endrole
                {
                    data: 'course',
                    name: 'course'
                },
                @can('attendance_create')
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                @endcan
            ],
            initComplete: function(settings, json) {
                $('body').find('.dataTables_scrollBody').addClass("custom-scrollbar");
                $('body').find('.dataTables_paginate.paging_simple_numbers').addClass(
                    "custom-pagination");
                $('body').find('.dataTables_wrapper .custom-pagination .paginate_button').addClass(
                    "text-color");
            }
        });
        // // Data Table Ends

        $(document).on('click', '.mark-attendance', function() {
            var _this = $(this);
            var userId = _this.attr('data-user-id');
            var attendance = _this.attr('data-attendance');
            var batchId = _this.attr('data-batch-id');
            var courseId = _this.closest('tr').find('.course_id').val();
            if (courseId == null || courseId == '') {
                alert('Course ID is required');
                return false;
            }
            var url = "{{route('mark_attendance')}}";
            var data = {
                '_token':'{{csrf_token()}}',
                'user_id':userId,
                'batch_id':batchId,
                'attendance':attendance,
                'course_id':courseId,
            };
            $.post(url, data, function(response) {
                if (response.status == true) {
                    table.draw(false);
                    alert(response.msg);
                } else if (response.status == false) {
                    alert(response.msg);
                }
            });
        });

        $(document).on('change', '#course_id, #date_from, #date_to, #batch_id', function () {
            var _this = $(this);
            table.draw(false);
        });
    });
</script>
@include('attendance._js')
<!-- Scripting Here -->
@endsection