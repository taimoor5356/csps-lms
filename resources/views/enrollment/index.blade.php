@extends('layout.app')
@section('content')
@section('style')
    <!-- Styling Here -->
    <style>
        .course-modal-card {
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

        .course-modal-card-body {
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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><span
                    class="text-light">Courses</span></li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Courses</h6>
    </nav>
@endsection
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h6>All Courses</h6>
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
                        <a href="{{ route('enrollment.create', ['students']) }}" class="btn btn-primary" target="_blank"><i class="fa fa-plus"></i> Students</a>
                        <a href="{{ route('enrollment.create', ['teachers']) }}" class="btn btn-primary" target="_blank"><i class="fa fa-plus"></i> Teachers</a>
                        @can('enrollment_delete')
                        <!-- <a href="{{ route('trashed.enrollments') }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> Trashed</a> -->
                        @endcan
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @include('enrollment._table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- Section Modal -->
@section('modal')
<!-- MODALS -->
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
            processing: true,
            serverSide: true,
            bDestroy: true,
            scrollX: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('enrollments') }}"
            },
            columns: [
                {
                    data: 'image',
                    name: 'image',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'user_name',
                    name: 'user_name'
                },
                {
                    data: 'course_name',
                    name: 'course_name'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'fee',
                    name: 'fee'
                },
                {
                    data: 'marks',
                    name: 'marks'
                },
                {
                    data: 'date',
                    name: 'date'
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
            },
            'order': [
                [1, 'asc']
            ],
        });
        // Data Table Ends

        // Open Modal to View Information
        $(document).on('click', '.view-course-detail', function() {
            var _this = $(this);
            var courseId = _this.attr('data-course-id');
            $.get('courses/' + courseId + '/show', function(data) {
            });
            $('#modal-default').modal('show');
        });
        // Ends Open Modal to View Information

        // Close Modal
        $(document).on('click', '.close-modal', function() {
            $('#modal-default').modal('hide');
        });
        // Close Modal

        // Open Delete course Modal
        $(document).on('click', '.delete-course', function(e) {
            e.preventDefault();
            var courseId = $(this).attr('data-course-id');
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('courses/' + courseId + '/delete', {_token: '{{ csrf_token() }}'},function() {
                    });
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'course has been deleted.',
                        icon: 'success',
                        timer: 4500,
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                    table.draw(false);
                }
            });
        });
        // Ends Open Delete course Modal
    });
</script>
<!-- Scripting Here -->
@endsection
