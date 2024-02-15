@extends('layout.app')
@section('content')
@section('style')
<!-- Styling Here -->
<style>
    #notification {
        position: absolute;
        top: 5px;
        left: 35%;
    }
</style>
<!-- Styling Here -->
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-light" href="javascript:;">CSPs</a></li>
            <li class="breadcrumb-item text-sm text-white" aria-current="page"><a href="#"
                    class="text-white">Enrollment</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><span
                    class="text-light">Enroll Teacher</span></li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Enrollment</h6>
    </nav>
@endsection
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h6>Enroll Teacher</h6>
                    <div class="header-buttons ms-auto text-end">
                        <a href="#" class="btn btn-primary"><i class="fa fa-eye"></i> View
                            All</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('enrollment.save') }}" method="POST">
                        @csrf
                        @include('enrollment._form_teacher')
                        <div class="row">
                            <div class="col-12 sm-auto text-center">
                                <button class="btn btn-success px-4" type="submit">
                                    <i class="fa fa-save"></i> Save
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

        // filter out the courses related to student
        $(document).on('change', '#user_id', function() {
            var _this = $(this);
            $.ajax({
                url: "{{ route('fetch_user_courses') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    user_id: _this.val()
                },
                success: function(response) {
                    var html = '<option value="0" selected>Select Course</option>';
                    response.data.forEach(element => {
                        html += `
                            <option value="`+element.id+`">`+element.name+`</option>
                        `;
                    });
                    $('#course_id').html(html);
                }
            });
        });
    });
</script>
<!-- Scripting Here -->
@endsection
