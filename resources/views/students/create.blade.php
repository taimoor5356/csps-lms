@extends('layout.app')
@section('content')
@section('style')
<link href="{{ asset('public/assets/css/select2.min.css') }}" rel="stylesheet" />
<!-- Styling Here -->
<style>
    .fee-font {
        font-size: 11px;
    }
</style>
<!-- Styling Here -->
@endsection
@section('breadcrumbs')
    @include('layout.breadcrumb', ['tab_name' => 'Users', 'page_title' => 'Add New'])
@endsection
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h6>Add New</h6>
                    <div class="header-buttons ms-auto text-end">
                        <a href="{{ route('students') }}" class="btn btn-primary"><i class="fa fa-eye"></i> View
                            All</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="student-form">
                        @csrf
                        @role('admin')
                            @include('students._form_admin')
                            <input type="hidden" name="visitor" value="false">
                        @endrole
                        <div class="row">
                            <div class="col-12 sm-auto text-center">
                                <button class="btn btn-success px-4 text-white" type="submit" id="save">
                                    <i class="fa fa-save"></i> Save &nbsp;<div class="loader mt-1 d-none" style="float: right"></div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
@endsection
@section('page_js')
<script src="{{ asset('public/assets/js/select2.min.js') }}"></script>
<!-- Scripting Here -->
@include('layout.roll_no')
<script>
    $(document).ready(function() {
        $(document).on('submit', '#student-form', function(e) {
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
                $.ajax({
                    type: 'POST',
                    url: "{{ route('store.student') }}",
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
