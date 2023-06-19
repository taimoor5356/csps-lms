@extends('layout.app')
@section('content')
@section('style')
    <!-- Styling Here -->
    <style>
        .role-modal-card {
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

        .role-modal-card-body {
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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><span class="text-light">Roles</span>
            </li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Roles</h6>
    </nav>
@endsection
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h6>All Roles</h6>
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
                        <a href="{{ route('create.role') }}" class="btn btn-primary" target="_blank"><i
                                class="fa fa-plus"></i> Add New</a>
                        <a href="#" class="btn btn-danger"><i class="fa fa-trash-o"></i> Trashed</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @include('roles._table')
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
        <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Role has Permissions</h6>
                        <button type="button" class="close-modal btn btn-danger" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="permissions-form">
                        <div class="modal-body">
                            <div class="main-body">
                                <div class="row">
                                    @foreach ($modules as $key => $module)
                                        <div class="col-md-4">
                                            <h6 class="text-uppercase">
                                                {{ $module->module }}
                                            </h6>
                                            @foreach ($permissions as $key => $permission)
                                                @if ($module->module == $permission->module)
                                                    <p class="text-capitalize">
                                                        <input type="checkbox" name="permissions[]"
                                                            value="{{ $permission->id }}"
                                                            class="role-has-permission permission-id">
                                                        {{ str_replace('_', ' ', $permission->name) }}
                                                    </p>
                                                @endif
                                            @endforeach
                                            <hr>
                                        </div>
                                    @endforeach
                                    <input type="hidden" class="role-id" name="role_id">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success form-submit close-modal">Save</button>
                            <button type="button" class="close-modal btn btn-danger "
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
        // Toast Message
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
        // Toast Message

        // Data Table Starts
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            scrollX: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('roles') }}"
            },
            columns: [{
                    data: 'name',
                    name: 'name'
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

        // Open Modal to View Information && Set Role ID to Modal
        $(document).on('click', '.view-role-detail', function() {
            var _this = $(this);
            var roleId = _this.attr('data-role-id');
            $('.role-id').val('');
            $('.role-id').val(roleId);
            $.get('roles/' + roleId + '/show', function(response) {
                $('.permission-id').prop('checked', false);
                $('.permission-id').each(function() {
                    let _this = $(this);
                    if(checkPermissionExists(_this.val(), response) == _this.val())
                    {
                        _this.prop('checked', true);
                    }
                });
                $('.dataTables_processing').css('display', 'block');
            });
            setTimeout(() => {
                $('#modal-default').modal('show').fadeIn();
                $('.dataTables_processing').css('display', 'none');
            }, 500);
        });
        // Ends Open Modal to View Information

        // Close Modal
        $(document).on('click', '.close-modal', function() {
            $('#modal-default').modal('hide');
        });
        // Close Modal

        // Open Delete role Modal
        $(document).on('click', '.delete-role', function(e) {
            e.preventDefault();
            var roleId = $(this).attr('data-role-id');
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('roles/' + roleId + '/delete', {
                        _token: '{{ csrf_token() }}'
                    }, function() {});
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'role has been deleted.',
                        icon: 'success',
                        timer: 4500,
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                    table.draw(false);
                }
            });
        });
        // Ends Open Delete role Modal

        // Submit permission form
        $(document).on('click', '.form-submit', function() {
            var roleId = $('.role-id').val();
            var _this_permissions = $('.permission-id');
            var permissions = [];
            _this_permissions.each(function() {
                let _this = $(this);
                if (_this.is(':checked')) {
                    permissions.push(_this.val());
                }
            });
            $.ajax({
                url: "{{ route('assign_permission_to_role') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    role_id: roleId,
                    permissions: permissions
                },
                success:function(response) {
                    if (response.status == true) {
                        $('.toast .toast-header').removeClass('bg-danger');
                        $('.toast .toast-body').removeClass('bg-danger');
                        $('.toast .success-header').html('Success');
                        $('.toast .toast-header').addClass('bg-success');
                        $('.toast .toast-body').addClass('bg-success');
                        $('.toast .toast-body').html(response.message);
                        $('.toast').toast('show');
                    } else {
                        $('.toast .toast-header').removeClass('bg-success');
                        $('.toast .toast-body').removeClass('bg-success');
                        $('.toast .success-header').html('Error');
                        $('.toast .toast-header').addClass('bg-danger');
                        $('.toast .toast-body').addClass('bg-danger');
                        $('.toast .toast-body').html(response.message);
                        $('.toast').toast('show');
                    }
                }
            });
        });
        // Submit permission form
    });
    function checkPermissionExists(permission, permissions) {
        var permissionId = 0;
        for (var i = 0; i < permissions.length; i++) {
            var permissions_Id = permissions[i];
            if (permissions_Id == permission) {
                permissionId = permissions_Id;
                break;
            }
        }
        return permissionId;
    }
</script>
<!-- Scripting Here -->
@endsection
