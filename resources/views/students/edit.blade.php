@extends('layout.app')
@section('content')
@section('style')
<!-- Styling Here -->
<style>
    .fee-font {
        font-size: 11px;
    }
</style>
<!-- Styling Here -->
@endsection
@section('breadcrumbs')
    @include('layout.breadcrumb', ['tab_name' => 'Students', 'page_title' => 'Edit'])
@endsection
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h6>Edit Student Information</h6>
                    <div class="header-buttons ms-auto text-end">
                        <a href="{{ route('students') }}" class="btn btn-primary"><i class="fa fa-eye"></i> View
                            All</a>
                    </div>
                </div>
                <div class="card-body">
                    @role('admin')
                    <form id="admin-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('students._form_admin')
                        <input type="hidden" name="student_id" id="student-id" value="{{ $id }}">
                        <div class="row">
                            <div class="col-12 sm-auto text-center">
                                <button class="btn btn-success px-4 text-white" type="submit" id="save">
                                    <i class="fa fa-save"></i> Save &nbsp;<div class="loader mt-1 d-none" style="float: right"></div>
                                </button>
                            </div>
                        </div>
                    </form>
                    @endrole
                    @role('student')
                    <form id="student-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if($student->applied_for == 'written' || $student->applied_for == 'examination')
                            @include('students._form_student')
                            <input type="hidden" name="student_id" id="student-id" value="{{ $id }}">
                            <div class="row">
                                <div class="col-12 sm-auto text-center">
                                    <button class="btn btn-success px-4 text-white" type="submit" id="save">
                                        <i class="fa fa-save"></i> Save &nbsp;<div class="loader mt-1 d-none" style="float: right"></div>
                                    </button>
                                </div>
                            </div>
                        @else
                            @include('students._interview_form')
                            <input type="hidden" name="student_id" id="student-id" value="{{ $id }}">
                            <div class="row">
                                <div class="col-12 sm-auto text-center">
                                    <button class="btn btn-success px-4 text-white" type="submit" id="save">
                                        <i class="fa fa-save"></i> Save &nbsp;<div class="loader mt-1 d-none" style="float: right"></div>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </form>
                    @endrole
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
<div class="row">
    <div class="col-md-4">
        <div class="modal fade" id="upload-performa-modal" tabindex="-1" role="dialog" aria-labelledby="upload-performa-modal"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Student Performa</h6>
                        <button type="button" class="close-modal btn btn-danger" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="main-body">
                                <div class="row gutters-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                        <button type="button" class="close-modal btn btn-danger  ml-auto"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page_js')
<!-- Scripting Here -->
@include('layout.roll_no')
<script>
    $(document).ready(function() {
        $(document).on('submit', '#admin-form, #student-form', function(e) {
            e.preventDefault();
            button(true, 'btn-danger', 'btn-success');
            $('.loader').removeClass('d-none');
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            setTimeout(() => {
                var id = $('#student-id').val();
                var url = '{{ route("update.student", ":id") }}';
                url = url.replace(':id', id);
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
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
            }, 1000);
        });
    });
</script>
@include('students.page_js')
<!-- Scripting Here -->
@endsection
