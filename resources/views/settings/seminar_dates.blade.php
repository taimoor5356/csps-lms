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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-light" href="javascript:;">CSPs</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><span class="text-light">Seminar Dates
                    Settings</span></li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Seminar Dates Settings</h6>
    </nav>
@endsection
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h6>Seminar Dates Settings</h6>
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
                    </div>
                </div>
                <form action="{{ route('settings.update_settings') }}" method="POST">
                    @csrf
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive mx-4">
                            <table class="table table-bordered data-table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder ps-2">
                                            Type
                                        </th>
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder ps-2">
                                            Description
                                        </th>
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder ps-2">
                                            Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($seminarSettings))
                                        <!-- On Campus -->
                                        <tr>
                                            <td>
                                                On Campus
                                            </td>
                                            <td>
                                                <textarea class="w-100 form-control" rows="2" name="oncampus_description" id="oncampus-description">{{ $seminarSettings->oncampus_description }}</textarea>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="oncampus_date_time"
                                                    value="{{ $seminarSettings->oncampus_date_time }}">
                                            </td>
                                        </tr>
                                        <!-- OnLine -->
                                        <tr>
                                            <td>
                                                OnLine
                                            </td>
                                            <td>
                                                <textarea class="w-100 form-control" rows="2" name="online_description" id="online-description">{{ $seminarSettings->online_description }}</textarea>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="online_date_time"
                                                    value="{{ $seminarSettings->online_date_time }}">
                                            </td>
                                        </tr>
                                        <tr>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="3">
                                                No Data Available
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-button d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- Section Modal -->
@section('modal')
<div class="row">

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
    });
</script>
<!-- Scripting Here -->
@endsection
