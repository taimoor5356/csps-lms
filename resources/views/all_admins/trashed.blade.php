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
            <li class="breadcrumb-item text-sm text-white" aria-current="page"><a href="{{ route('students') }}"
                    class="text-white">Students</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><span
                    class="text-light">Add New</span></li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Students</h6>
    </nav>
@endsection
<div class="container-fluid py-4">
    <div class="row">
    <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h6>All Admins</h6>
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
                        <a href="{{ route('create.admin') }}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Add New</a>
                        <a href="{{ route('trashed.admins') }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> Trashed</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @include('all_admins._table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
@endsection
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
    });
        // Data Table Starts
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            scrollX: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('trashed.admins') }}"
            },
            columns: [
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
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'dob_cnic',
                    name: 'dob_cnic'
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

        // Open Delete admin Modal
        $(document).on('click', '.delete-admin', function(e) {
            e.preventDefault();
            var adminId = $(this).attr('data-admin-id');
            Swal.fire({
                title: 'Are you sure to delete permanently?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(adminId + '/permanent-delete', {_token: '{{ csrf_token() }}'}, function(responseData) {
                        if (responseData.status == true) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: responseData.msg,
                                icon: 'success',
                                timer: 4500,
                                showCancelButton: false,
                                showConfirmButton: false,
                            });
                            table.draw(false);
                        } else {
                            Swal.fire({
                                title: 'Alert!',
                                text: responseData.msg,
                                icon: 'warning',
                                timer: 4500,
                                showCancelButton: false,
                                showConfirmButton: false,
                            });
                        }
                    });
                }
            });
        });
        // Ends Open Delete admin Modal
</script>
<!-- Scripting Here -->
@endsection