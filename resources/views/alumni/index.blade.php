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
    @include('layout.breadcrumb', ['institute_name' => 'CSPs', 'tab_name' => 'Users', 'page_title' => 'Alumni'])
@endsection
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h6>Alumni</h6>
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
                        {{-- @role('admin')
                            <a href="{{ route('create.student') }}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Add New</a>
                        @endrole
                        @role('admin')
                            <a href="{{ route('trashed.students') }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> Trashed</a>
                        @endrole
                        @if (Auth::user()->hasRole('student'))
                            <a href="{{ route('enrollments') }}" class="btn btn-primary"><i class="fa fa-eye"></i> View Courses</a>
                        @endif --}}
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <small class="mx-3 text-danger">* Scroll right if unable to see Actions</small>
                    @include('alumni._table')
                </div>
            </div>
        </div>
    </div>
</div>
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
            stateSave: true,
            // serverSide: true,
            bDestroy: true,
            scrollX: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('students') }}",
                data: function (d) {
                    d.alumni_data = true;
                }
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
                    data: 'name_email',
                    name: 'name_email'
                },
                {
                    data: 'roll_no',
                    name: 'roll_no'
                },
                // {
                //     data: 'dob_cnic',
                //     name: 'dob_cnic'
                // },
                // {
                //     data: 'domicile',
                //     name: 'domicile'
                // },
                // {
                //     data: 'degree_university',
                //     name: 'degree_university'
                // },
                // {
                //     data: 'subject_cgpa',
                //     name: 'subject_cgpa'
                // },
                // {
                //     data: 'distinction',
                //     name: 'distinction'
                // },
                // {
                //     data: 'action',
                //     name: 'action',
                //     orderable: false,
                //     searchable: false
                // },
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

        // Child Row starts
        // Add event listener for opening and closing details
        $(document).on('click', 'td.dt-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
    
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });
        // Child Row ends

        // Open Modal to View Information
        $(document).on('click', '.view-student-detail', function() {
            var _this = $(this);
            var studentId = _this.attr('data-student-id');
            $.get('students/' + studentId + '/show', function(data) {
                $('span.batch-no').html(data.batch_no);
                $('span.reg-no').html(data.reg_no);
                $('span.applied-for').html(data.applied_for);
                $('span.domicile').html(data.domicile);
                $('span.degree').html(data.degree);
                $('span.subject').html(data.major_subjects);
                $('span.cgpa').html(data.cgpa);
                $('span.board-university').html(data.board_university);
                $('span.occupation').html(data.student_occupation);
                $('span.distinction').html(data.distinction);
                $('div.full-name').html(data.user.name);
                $('div.email').html(data.user.email);
                $('div.father-name').html(data.father_name);
                $('div.father-occupation').html(data.father_occupation);
                $('div.dob').html(data.dob);
                $('div.cnic').html(data.cnic);
                $('div.contact-res').html(data.contact_res);
                $('div.cell-no').html(data.cell_no);
                $('div.address').html(data.address);
                var url = '{{ asset('public/assets/img/students/:image') }}';
                url = url.replace(':image', data.user.photo);
                $('img.profile-img').attr('src', url);
            });
            $('#view-student-details').modal('show');
        });
        // Ends Open Modal to View Information

        // Close Modal
        $(document).on('click', '.close-modal', function() {
            $('#view-student-details').modal('hide');
        });
        // Close Modal

        // Open Delete Student Modal
        $(document).on('click', '.delete-student', function(e) {
            e.preventDefault();
            var studentId = $(this).attr('data-student-id');
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('students/' + studentId + '/delete', {_token: '{{ csrf_token() }}'},function() {
                    });
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Student has been deleted.',
                        icon: 'success',
                        timer: 4500,
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                    table.draw(false);
                }
            });
        });
        // Ends Open Delete Student Modal
    });
</script>
<!-- Scripting Here -->
@endsection
