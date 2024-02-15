@extends('layout.app')
@section('content')
@section('style')
    <style>
        /* --- Styling Here --- */
        /* --- Styling Here --- */
    </style>
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-light" href="javascript:;">CSPs</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><span class="text-light">Academics</span>
            </li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Academics</h6>
    </nav>
@endsection
<div class="container-fluid py-4">
    <div class="row">
    </div>
</div>
@section('page_js')
    <script>
        $(document).ready(function (){
            $('.data-table').DataTable({
                pageLength : 5,
                lengthMenu: [[5], [5]]
            });
            $('.time-table').DataTable({
                pageLength : 5,
                lengthMenu: [[5], [5]]
            });
        });
    </script>
@endsection
@endsection
