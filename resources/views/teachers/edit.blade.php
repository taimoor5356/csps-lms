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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-light" href="javascript:;">CSPs</a></li>
            <li class="breadcrumb-item text-sm text-white" aria-current="page"><a href="{{ route('teachers') }}"
                    class="text-white">Teachers</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><span
                    class="text-light">Edit</span></li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Teachers</h6>
    </nav>
@endsection
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h6>Edit teacher Information</h6>
                    <div class="header-buttons ms-auto text-end">
                        <a href="{{ route('teachers') }}" class="btn btn-primary"><i class="fa fa-eye"></i> View
                            All</a>
                    </div>
                </div>
                <div class="card-body">
                    @role('admin')
                    <form id="admin-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('teachers._form')
                        <input type="hidden" name="teacher_id" id="teacher-id" value="{{ $id }}">
                        <div class="row">
                            <div class="col-12 sm-auto text-center">
                                <button class="btn btn-success px-4" type="submit">
                                    <i class="fa fa-save"></i> Save &nbsp;<div class="loader mt-1 d-none" style="float: right"></div>
                                </button>
                            </div>
                        </div>
                    </form>
                    @endrole
                    @role('teacher')
                    <form id="teacher-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('teachers._form')
                        <input type="hidden" name="teacher_id" id="teacher-id" value="{{ $id }}">
                        <div class="row">
                            <div class="col-12 sm-auto text-center">
                                <button class="btn btn-success px-4" type="submit">
                                    <i class="fa fa-save"></i> Save &nbsp;<div class="loader mt-1 d-none" style="float: right"></div>
                                </button>
                            </div>
                        </div>
                    </form>
                    @endrole
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
@endsection
@section('page_js')
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
        
        $(document).on('submit', '#admin-form, #teacher-form', function(e) {
            e.preventDefault();
            $('#save').prop('disabled', true);
            $('.loader').removeClass('d-none');
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            setTimeout(() => {
                var id = $('#teacher-id').val();
                var url = '{{ route("update.teacher", ":id") }}';
                url = url.replace(':id', id);
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status == true) {
                            $('.toast .toast-header').removeClass('bg-danger');
                            $('.toast .toast-header').removeClass('bg-success');
                            $('.toast .toast-body').removeClass('bg-danger');
                            $('.toast .success-header').html('Success');
                            $('.toast .toast-header').addClass('bg-success');
                            $('.toast .toast-body').addClass('bg-success');
                            $('.toast .toast-body').html(response.msg);
                            $('.toast').toast('show');
                            $('#save').prop('disabled', false);
                            $('.loader').addClass('d-none');
                        } else if (response.status == false) {
                            $('.toast .toast-header').removeClass('bg-success');
                            $('.toast .toast-header').removeClass('bg-danger');
                            $('.toast .toast-body').removeClass('bg-success');
                            $('.toast .success-header').html('Error');
                            $('.toast .toast-header').addClass('bg-danger');
                            $('.toast .toast-body').addClass('bg-danger');
                            $('.toast .toast-body').html(response.msg);
                            $('.toast').toast('show');
                            $('#save').prop('disabled', false);
                            $('.loader').addClass('d-none');
                        } else {
                            $('#save').prop('disabled', false);
                            $('.loader').addClass('d-none');
                        }
                    }
                });
            }, 1000);
        });
        
        $(document).on('click', '#add-education', function () {
            if ($('.new-education-row').length >= 4) {
                return false;
            } else {
                $('.education-information').append(`
                    <div class="row new-education-row border border-light m-1">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="degree" class="form-control-label">Degree *</label>
                                <input @if (Auth::user()->hasRole('teacher')) @endif class="form-control degree" id="degree"
                                    name="degree" type="text"
                                    value="@isset($teacher->user) {{ $teacher->degree }} @endisset"
                                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Degree Name">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="major_subjects" class="form-control-label">Major Subjects *</label>
                                <input @if (Auth::user()->hasRole('teacher')) @endif class="form-control major_subjects"
                                    id="major_subjects" name="major_subjects" type="text"
                                    value="@isset($teacher->user) {{ $teacher->major_subjects }} @endisset"
                                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Major Subject">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cgpa" class="form-control-label">CGPA/%age *</label>
                                <input @if (Auth::user()->hasRole('teacher')) @endif class="form-control cgpa" id="cgpa"
                                    name="cgpa" min="0.1" max="100.00" step="0.1" type="number"
                                    value="@isset($teacher->user) {{ $teacher->cgpa }} @endisset" onfocus="focused(this)"
                                    onfocusout="defocused(this)" placeholder="Enter CGPA/%age">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="board_university" class="form-control-label">Board/University *</label>
                                <input @if (Auth::user()->hasRole('teacher')) @endif class="form-control board_university"
                                    id="board_university" name="board_university" type="text"
                                    value="@isset($teacher->user) {{ $teacher->board_university }} @endisset"
                                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Board/University">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="distinction" class="form-control-label">Profession *</label>
                                <input @if (Auth::user()->hasRole('teacher')) @endif class="form-control distinction"
                                    id="distinction" name="distinction" type="text"
                                    value="@isset($teacher->user) {{ $teacher->distinction }} @endisset"
                                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter Profesion">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="distinction" class="form-control-label">Remove</label>
                                <button type="button" class="btn btn-danger form-control remove-education-row">-</button>
                            </div>
                        </div>
                    </div>
            `);
            }
        });
        $(document).on('click', '.remove-education-row', function () {
            $(this).closest('.new-education-row').remove();
        });
    });
</script>
<!-- Scripting Here -->
@endsection
