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
                <!-- <div class="card-header bg-transparent">
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
                            <a href="#" class="btn btn-primary">Create New Assignment</a>
                        </div>
                    </div>
                    <hr>
                </div> -->
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
                @role('admin')
                {
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
@endsection