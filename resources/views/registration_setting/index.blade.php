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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><span class="text-light">Registration
                    Setting</span></li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Registration Setting</h6>
    </nav>
@endsection
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h6>Registered Years</h6>
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
                        @role('admin')
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-year"><i
                                    class="fa fa-plus"></i> Add New</button>
                        @endrole
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @include('registration_setting._table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- Section Modal -->
@section('modal')
<div class="col-md-4">
    <div class="modal fade" id="add-new-year" tabindex="-1" role="dialog" aria-labelledby="add-new-year"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Add New Year</h6>
                    <button type="button" class="close-modal btn btn-danger" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('regsitered_year.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="registered-year">Enter Year</label>
                        <input type="text" class="form-control" name="registered_year" id="registered-year"
                            placeholder="Enter Year" required>
                        <div class="row mt-2">
                            <div class="col-md-12 col-sm-12">
                                <label for="batches">Enter Batches</label>
                                <div class="row">
                                    <div class="col-10">
                                        <input type="text" class="form-control batch" name="batch[]"
                                            placeholder="Enter Batch Number">
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="form-control btn btn-success add-row">+</button>
                                    </div>
                                </div>
                                <div class="appended-row">
                                </div>
                            </div>
                        </div>
                        <label for="registered-year">Status (Active/Inactive)</label>
                        <br>
                        <input type="checkbox" name="status" id="status" class="mx-2">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="close-modal btn btn-danger ml-auto"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Update Year Modal -->
<div class="col-md-4">
    <div class="modal fade" id="update-year" tabindex="-1" role="dialog" aria-labelledby="update-year"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Update Year</h6>
                    <button type="button" class="close-modal btn btn-danger" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('registered_year.update') }}" data-year-id="" method="POST"
                    id="update-year-data">
                    @csrf
                    <div class="modal-body">
                        <label for="registered-year">Enter Year</label>
                        <input type="text" class="form-control updated-year-name" name="registered_year"
                            id="registered-year" placeholder="Enter Year" required>
                        <div class="row mt-2">
                            <div class="col-md-12 col-sm-12">
                                <label for="batches">Enter Batches</label>
                                <div class="row first-appended-data">
                                    <div class="col-10">
                                        <input type="text" class="form-control updated-batch-number batch"
                                            name="batch[]" placeholder="Enter Batch Number">
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="form-control btn btn-success add-row">+</button>
                                    </div>
                                </div>
                                <div class="appended-row">
                                </div>
                            </div>
                        </div>
                        <label for="registered-year">Status (Active/Inactive)</label>
                        <br>
                        <input type="checkbox" name="status" id="status" class="mx-2 updated-status-check">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <input type="hidden" name="registered_year_id" id="registered-year-id" value="">
                        <button type="button" class="close-modal btn btn-danger ml-auto"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
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
        $(document).on('click', '.year-update', function() {
            var _this = $(this);
            $('.appended-row').html('');
            $('#registered-year-id').val($(this).attr('data-year-id'));
            $('.updated-year-name').val(_this.attr('data-year-value'));
            var batches = _this.attr('data-year-batches');
            var dataBatches = JSON.parse(batches);
            console.log(dataBatches);
            $('.first-appended-data').html(`
                <div class="col-10">
                    <input type="text" class="form-control updated-batch-number batch"
                        name="batch[]" placeholder="Enter Batch Number" value="`+(dataBatches.length > 0 ? dataBatches[0].batch : '')+`">
                </div>
                <div class="col-2">
                    <button type="button" class="form-control btn btn-success add-row">+</button>
                </div>
            `);
            var html = '';
            if (dataBatches.length > 0) {
                for (let index = 1; index < dataBatches.length; index++) {
                    html += `
                        <div class="row single-batch-row">
                            <div class="col-10">
                                <input type="text" class="form-control batch" name="batch[]" placeholder="Enter Batch Number" value="`+dataBatches[index].batch+`">
                            </div>
                            <div class="col-2">
                                <button type="button" class="form-control btn btn-danger delete-row">x</button>
                            </div>
                        </div>
                    `;
                }
                $('.appended-row').html(html);
            } else {
                $('.appended-row').html(html);
            }
            if (_this.attr('data-year-status') == '1') {
                $('.updated-status-check').attr('checked', true);
            } else {
                $('.updated-status-check').attr('checked', false);
            }
        });
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
                url: "{{ route('registered_years') }}"
            },
            columns: [{
                    data: 'years',
                    name: 'years'
                },
                {
                    data: 'batches',
                    name: 'batches'
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
        $(document).on('click', '.add-row', function() {
            var html = '';
            html += `
                    <div class="row single-batch-row">
                        <div class="col-10">
                            <input type="text" class="form-control batch" name="batch[]" placeholder="Enter Batch Number">
                        </div>
                        <div class="col-2">
                            <button type="button" class="form-control btn btn-danger delete-row">x</button>
                        </div>
                    </div>
                `;
            $('.appended-row').append(html);
        });
        $(document).on('click', '.delete-row', function() {
            $(this).closest('.single-batch-row').remove();
        });
    });
</script>
<!-- Scripting Here -->
@endsection
