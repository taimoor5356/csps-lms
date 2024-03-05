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
                        <a href="{{ route('create.course') }}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Add New</a>
                        <a href="{{ route('trashed.courses') }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> Trashed</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @include('courses._table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- Section Modal -->
@section('modal')
{{-- <div class="row">
    <div class="col-md-4">
        <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Course Detail</h6>
                        <button type="button" class="close-modal btn btn-danger" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="main-body">
                                <div class="row gutters-sm">
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex flex-column align-items-center text-center">
                                                    <img src="" alt="Profile Pic" class="rounded-circle profile-img"
                                                        width="200">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        REGISTRATION DETAILS:
                                        <hr>
                                        <div class="card mt-3">
                                            <ul class="list-group list-group-flush">
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0">Batch No:</h6>
                                                    <span class="text-secondary batch-no"></span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0">Registration No:</h6>
                                                    <span class="text-secondary reg-no">reg-001</span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0">Applied For:</h6>
                                                    <span class="text-secondary applied-for">CSS</span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0">Domicile:</h6>
                                                    <span class="text-secondary domicile">Punjab</span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0">Degree:</h6>
                                                    <span class="text-secondary degree">BA</span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0">Subjects:</h6>
                                                    <span class="text-secondary subject">Arts</span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0">CGPA:</h6>
                                                    <span class="text-secondary cgpa">2.78</span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0">Board/University:</h6>
                                                    <span class="text-secondary board-university">The Univeristy of
                                                        Lahore, Lahore</span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0">Occupation:</h6>
                                                    <span class="text-secondary occupation">Engineer</span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0">Distinction:</h6>
                                                    <span class="text-secondary distinction">NIL</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card mb-3 course-modal-card">
                                            <div class="card-body course-modal-card-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Full Name</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary full-name">
                                                        Kenneth Valdez
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Email</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary email">
                                                        fip@jukmuh.al
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Father Name</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary father-name">
                                                        asfij nasfi
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Father Occupation</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary father-occupation">
                                                        PAF
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Date of Birth</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary dob">
                                                        Jan 01, 1996
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">CNIC</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary cnic">
                                                        374051234567892
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Phone</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary contact-res">
                                                        (239) 816-9029
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Mobile</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary cell-no">
                                                        (320) 380-4539
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Address</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary address">
                                                        Bay Area, San Francisco, CA
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <hr>
                                        SUBJECTS:
                                        <hr>
                                        <div class="row gutters-sm">
                                            <div class="col-sm-6 mb-3">
                                                <div class="card p-0 h-100">
                                                    <div class="card-body">
                                                        <h6 class="d-flex align-items-center mb-3">Compulsory Subjects
                                                        </h6>
                                                        <hr>
                                                        <small>English Essay</small>
                                                        <div class="mb-3" style="height: 5px">
                                                        </div>
                                                        <small>English Precis & Composition</small>
                                                        <div class="mb-3" style="height: 5px">
                                                        </div>
                                                        <small>General Science & Ability</small>
                                                        <div class="mb-3" style="height: 5px">
                                                        </div>
                                                        <small>Pakistan Affairs</small>
                                                        <div class="mb-3" style="height: 5px">
                                                        </div>
                                                        <small>Current Affairs</small>
                                                        <div class="mb-3" style="height: 5px">
                                                        </div>
                                                        <small>Islamic Studies</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <div class="card p-0 h-100">
                                                    <div class="card-body">
                                                        <h6 class="d-flex align-items-center mb-3">Optional Subjects
                                                        </h6>
                                                        <hr>
                                                        <small>English Essay</small>
                                                        <div class="mb-3" style="height: 5px">
                                                        </div>
                                                        <small>English Precis & Composition</small>
                                                        <div class="mb-3" style="height: 5px">
                                                        </div>
                                                        <small>General Science & Ability</small>
                                                        <div class="mb-3" style="height: 5px">
                                                        </div>
                                                        <small>Pakistan Affairs</small>
                                                        <div class="mb-3" style="height: 5px">
                                                        </div>
                                                        <small>Current Affairs</small>
                                                        <div class="mb-3" style="height: 5px">
                                                        </div>
                                                        <small>Islamic Studies</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="close-modal btn btn-danger  ml-auto"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
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
                url: "{{ route('courses') }}"
            },
            columns: [
                // {
                //     className: 'dt-control',
                //     orderable: false,
                //     data: null,
                //     defaultContent: '',
                // },
                {
                    data: 'image',
                    name: 'image',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'total_students',
                    name: 'total_students'
                },
                {
                    data: 'total_teachers',
                    name: 'total_teachers'
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

        // Open Modal to View Information
        $(document).on('click', '.view-course-detail', function() {
            var _this = $(this);
            var courseId = _this.attr('data-course-id');
            $.get('courses/' + courseId + '/show', function(data) {
                // $('span.batch-no').html(data.batch_no);
                // $('span.reg-no').html(data.reg_no);
                // $('span.applied-for').html(data.applied_for);
                // var url = '{{ asset('public/assets/img/courses/:image') }}';
                // url = url.replace(':image', data.user.photo);
                // $('img.profile-img').attr('src', url);
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
