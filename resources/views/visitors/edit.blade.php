@extends('layout.app')
@section('content')
@section('style')
    <!-- Styling Here -->
    <style>
        /* #notification {
                position: absolute;
                top: 5px;
                left: 35%;
            } */
        .fee-font {
            font-size: 11px;
        }

        .loader {
            border: 2px solid #f3f3f3;
            border-radius: 50%;
            border-top: 2px solid transparent;
            width: 15px;
            height: 15px;
            -webkit-animation: spin 1s linear infinite;
            /* Safari */
            animation: spin 1s linear infinite;
        }
    </style>
    <!-- Styling Here -->
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-light" href="javascript:;">CSPs</a></li>
            <li class="breadcrumb-item text-sm text-white" aria-current="page"><a href="{{ route('students') }}"
                    class="text-white">Students</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><span class="text-light">Edit</span>
            </li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Students</h6>
    </nav>
@endsection
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h6>Edit Visitor Information (Student Approval Form)</h6>
                    <div class="header-buttons ms-auto text-end">
                        <a href="{{ route('students') }}" class="btn btn-primary"><i class="fa fa-eye"></i> View
                            All</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="visitor-form">
                        @csrf
                        @include('students._form_student')
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <input type="hidden" name="visitor" value="true">
                        <div class="row">
                            <div class="col-12 sm-auto text-center">
                                <button class="btn btn-success px-4 text-white" id="save" type="submit">
                                    <i class="fa fa-save"></i> Save &nbsp;<div class="loader mt-1 d-none"
                                        style="float: right"></div>
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
<!-- Scripting Here -->
@include('layout.roll_no')
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
        $(document).on('submit', '#visitor-form', function(e) {
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
            }, 1000);
        });
        $(document).on('click', '#add-education', function() {
            if ($('.new-education-row').length >= 4) {
                return false;
            } else {
                $('.education-information').append(`
                    <div class="row new-education-row border border-light m-1">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="degree" class="form-control-label">Degree *</label>
                                <input @if (Auth::user()->hasRole('student'))  @endif class="form-control degree" id="degree"
                                    name="degree" type="text"
                                    value="@isset($student->user) {{ $student->degree }} @endisset"
                                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Degree Name">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="major_subjects" class="form-control-label">Major Subjects *</label>
                                <input @if (Auth::user()->hasRole('student'))  @endif class="form-control major_subjects"
                                    id="major_subjects" name="major_subjects" type="text"
                                    value="@isset($student->user) {{ $student->major_subjects }} @endisset"
                                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Major Subject">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cgpa" class="form-control-label">CGPA/%age *</label>
                                <input @if (Auth::user()->hasRole('student'))  @endif class="form-control cgpa" id="cgpa"
                                    name="cgpa" min="0.1" max="100.00" step="0.1" type="number"
                                    value="@isset($student->user) {{ $student->cgpa }} @endisset" onfocus="focused(this)"
                                    onfocusout="defocused(this)" placeholder="Enter CGPA/%age">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="board_university" class="form-control-label">Board/University *</label>
                                <input @if (Auth::user()->hasRole('student'))  @endif class="form-control board_university"
                                    id="board_university" name="board_university" type="text"
                                    value="@isset($student->user) {{ $student->board_university }} @endisset"
                                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Board/University">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="distinction" class="form-control-label">Profession *</label>
                                <input @if (Auth::user()->hasRole('student'))  @endif class="form-control distinction"
                                    id="distinction" name="distinction" type="text"
                                    value="@isset($student->user) {{ $student->distinction }} @endisset"
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
        $(document).on('click', '.remove-education-row', function() {
            $(this).closest('.new-education-row').remove();
        });
    });
    function alertMessage(message, removeclass, header, addclass) {
        $('.toast .toast-header').removeClass(removeclass);
        $('.toast .toast-header').removeClass(removeclass);
        $('.toast .toast-body').removeClass(removeclass);
        $('.toast .success-header').html(header);
        $('.toast .toast-header').addClass(addclass);
        $('.toast .toast-body').addClass(addclass);
        $('.toast .toast-body').html(message);
        $('.toast').toast('show');
    }
    function button(status, addclass, removeclass) {
        $('#save').prop('disabled', status);
        $('#save').removeClass(removeclass);
        $('#save').addClass(addclass);
    }
</script>
<!-- Scripting Here -->
@endsection