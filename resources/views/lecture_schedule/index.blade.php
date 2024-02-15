@extends('layout.app')
@section('content')
@section('style')
    <!-- Styling Here -->
    <style>

    </style>
    <!-- Styling Here -->
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-light" href="javascript:;">CSPs</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><span class="text-light">Lecture
                    Schedule</span></li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Lecture Schedules</h6>
    </nav>
@endsection
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h6>Lecture Schedule (@isset($lecture){{$lecture->lecture_name}}@endisset)</h6>
                    <div class="alert-messages w-50 ms-auto text-center">
                        <div class="toast bg-success" id="notification" role="alert" aria-live="assertive"
                            aria-atomic="true">
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
                        {{-- @role('admin') --}}
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-lecture-schedule"><i
                                class="fa fa-plus"></i> Add New</button>
                        {{-- @endrole --}}
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @include('lecture_schedule._table')
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
        <div class="modal fade" id="add-new-lecture-schedule" tabindex="-1" role="dialog" aria-labelledby="add-new-lecture-schedule"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form id="lecture-schedule-form" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Lecture Schedule Details</h6>
                            <button type="button" class="close-modal btn btn-danger" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- Date -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="day" class="form-control-label">Select Day</label>
                                        <input class="form-control day" id="day" name="day" type="date"
                                            value="@isset($student->user){{ $student->user->name }}@endisset"
                                            onfocus="focused(this)" onfocusout="defocused(this)"
                                            placeholder="Student Name" required>
                                    </div>
                                </div>
                                <!-- Time -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="time" class="form-control-label">Select Time</label>
                                        <input class="form-control time" id="time" name="time" type="time"
                                            value="@isset($student->user){{ $student->user->name }}@endisset"
                                            onfocus="focused(this)" onfocusout="defocused(this)"
                                            placeholder="Student Name" required>
                                    </div>
                                </div>
                                <!-- Submit -->
                                <div class="col-md-12">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="close-modal btn btn-success  ml-auto"
                                data-bs-dismiss="modal" value="Save">
                            <button type="button" class="close-modal btn btn-danger  ml-auto"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
            $('.toast .toast-body').html("{{ session('success') }}");
            $('.toast').toast('show');
        @elseif (session('error'))
            $('.toast .success-header').html('Error');
            $('.toast .toast-header').addClass('bg-danger');
            $('.toast .toast-body').addClass('bg-danger');
            $('.toast .toast-body').html("{{ session('error') }}");
            $('.toast').toast('show');
        @endif

        // Data Table Starts

        var table = $('.data-table').DataTable({
            responsive: true,
            processing: true,
            stateSave: true,
            // serverSide: true,
            bDestroy: true,
            scrollX: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('lecture_schedules', [$lecture->id]) }}"
            },
            columns: [{
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'time_from',
                    name: 'time_from'
                },
                {
                    data: 'time_to',
                    name: 'time_to'
                },
                {
                    data: 'monday_lecture',
                    name: 'monday_lecture'
                },
                {
                    data: 'tuesday_lecture',
                    name: 'tuesday_lecture'
                },
                {
                    data: 'wednesday_lecture',
                    name: 'wednesday_lecture'
                },
                {
                    data: 'thursday_lecture',
                    name: 'thursday_lecture'
                },
                {
                    data: 'friday_lecture',
                    name: 'friday_lecture'
                },
                {
                    data: 'saturday_lecture',
                    name: 'saturday_lecture'
                },
                {
                    data: 'sunday_lecture',
                    name: 'sunday_lecture'
                },
                {
                    data: 'actions',
                    name: 'actions'
                },
            ],
            initComplete: function(settings, json) {
                $('body').find('.dataTables_scrollBody').addClass("custom-scrollbar");
                $('body').find('.dataTables_paginate.paging_simple_numbers').addClass(
                    "custom-pagination");
                $('body').find('.dataTables_wrapper .custom-pagination .paginate_button').addClass(
                    "text-color");
            }
        });

        // Data Table Ends
    });
</script>
<!-- Scripting Here -->
@endsection
