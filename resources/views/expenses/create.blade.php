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
    @include('layout.breadcrumb', ['institute_name' => 'CSPs', 'tab_name' => 'Revenue', 'page_title' => 'Expenses'])
@endsection
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h6>Add New</h6>
                    <div class="header-buttons ms-auto text-end">
                        <a href="{{ route('expenses') }}" class="btn btn-primary"><i class="fa fa-eye"></i> View
                            All</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="expense-form">
                        @csrf
                        @role('admin')
                            @include('expenses._form')
                        @endrole
                        <div class="row">
                            <div class="col-12 sm-auto text-center">
                                <button class="btn btn-success px-4" type="submit" id="save">
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
        
        $(document).on('submit', '#expense-form', function(e) {
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
                $.ajax({
                    type: 'POST',
                    url: "{{ route('store.expense') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status == true) {
                            $('.toast .toast-header').removeClass('bg-danger');
                            $('.toast .toast-header').removeClass('bg-danger');
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
                            $('.toast .toast-header').removeClass('bg-success');
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
    });
</script>
<!-- Scripting Here -->
@endsection
