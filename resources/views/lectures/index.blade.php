@extends('layout.app')
@section('content')
@section('style')
    <!-- Styling Here -->
    <style>
        .lecture-modal-card {
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

        .lecture-modal-card-body {
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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-light" href="javascript:;">CSPs</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><span class="text-light">Lectures</span>
            </li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Lectures</h6>
    </nav>
@endsection
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h6>All Lectures (@isset($courses){{$courses->first()->name}}@endisset)</h6>
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
                        @role ('admin')
                            <button type="button" class="btn btn-primary" data-bs-target="#add-course-lecture-modal"
                            data-bs-toggle="modal"><i class="fa fa-plus"></i> Add New</button>
                            <button type="button" class="btn btn-primary" data-bs-target="#add-course-lecture-modal"
                            data-bs-toggle="modal"><i class="fa fa-plus"></i> Schedules</button>
                        @endrole
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @include('lectures._table')
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
        <div class="modal fade" id="add-course-lecture-modal" tabindex="-1" role="dialog" aria-labelledby="add-course-lecture-modal"
            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <form id="lecture-form" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Add New</h6>
                            <button type="button" class="close-modal btn btn-danger" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="lecture_name">Lecture Name</label>
                                    <input type="text" class="form-control" name="lecture_name" id="lecture_name" placeholder="Enter Lecture Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="lecture_name">Select Day</label>
                                    <select class="form-control" name="day" id="day">
                                        <option value="monday">Monday</option>
                                        <option value="tuesday">Tuesday</option>
                                        <option value="wednesday">Wednesday</option>
                                        <option value="thursday">Thursday</option>
                                        <option value="friday">Friday</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="time_from">Time From</label>
                                    <input type="time" class="form-control" name="time_from" id="time_from" placeholder="Enter Time From">
                                </div>
                                <div class="col-md-4">
                                    <label for="time_to">Time To</label>
                                    <input type="time" class="form-control" name="time_to" id="time_to" placeholder="Enter Time To">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success px-4 text-white" type="submit" id="save" data-bs-dismiss="modal">
                                <i class="fa fa-save"></i> Save &nbsp;<div class="loader mt-1 d-none" style="float: right"></div>
                            </button>
                            <button type="button" class="close-modal btn btn-danger ml-auto" data-bs-dismiss="modal"
                               >Close</button>
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
                url: "{{route('lectures', [$courseId])}}",
            },
            columns: [
                {
                    data: 'lecture_name',
                    name: 'lecture_name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
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

        $(document).on('submit', '#lecture-form', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('store_lecture_schedules', [$courses->first()->id])}}",
                method: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    if (response.status == true) {
                        alertMessage(response.msg, 'bg-danger', 'Success', 'bg-success');
                        button(false, 'btn-success', 'btn-danger');
                        $('.loader').addClass('d-none');
                    } else if (response.status == false) {
                        alertMessage(response.msg, 'bg-danger', 'Error', 'bg-danger');
                        button(false, 'btn-success', 'btn-danger');
                        $('.loader').addClass('d-none');
                    } else {
                        alertMessage(response.msg, 'bg-danger', 'Error', 'bg-danger');
                        button(false, 'btn-success', 'btn-danger');
                        $('.loader').addClass('d-none');
                    }
                }
            });
            // window.location.reload();
        });
    });
</script>
<!-- Scripting Here -->
@include('students.page_js')
@endsection
