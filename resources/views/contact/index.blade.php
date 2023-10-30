@extends('layout.app')
@section('content')
@section('style')
    <!-- Styling Here -->
    <style>
        .download-center-modal-card {
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

        .download-center-modal-card-body {
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
        ul li {
            list-style: none;
        }
    </style>
    <!-- Styling Here -->
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-light" href="javascript:;">CSPs</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><span
                    class="text-light">Follow Us</span></li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Follow Us</h6>
    </nav>
@endsection
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-center">
                    <center><h2>Follow Us</h2>
                    <div class="alert-messages w-50 ms-auto text-center">
                        <div class="toast bg-success" id="notification" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header text-bold text-white py-0 bg-success border-bottom border-white">
                                <span class="success-header"></span>
                                <div class="close-toast-msg ms-auto text-end cursor-pointer">
                                    X
                                </div>
                            </div>
                            <div class="toast-body text-white text-bold">
                                
                            </div>
                        </div>
                    </div></center>
                </div>
                <hr>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <ul class="">
                                <li><a href="https://www.youtube.com/c/CivilServicesPreparatorySchoolforCSSPMSAcademy"><h3><i class="fa fa-youtube text-danger"></i> &nbsp; Services Preparatory School-CSPs</h3></li></a>
                                <li><a href="https://www.facebook.com/CSPsAcademy"><h3><i class="fa fa-facebook text-primary"></i> &nbsp;&nbsp;&nbsp; CSPs Academy</h3></li></a>
                                <li><a href="https://www.instagram.com/cspsacademy/"><h3><i class="fa fa-instagram text-danger"></i> &nbsp;&nbsp; cspsacademy</h3></li></a>
                                <li><a href="https://www.csps.com.pk/"><h3><i class="fa fa-globe text-info"></i> &nbsp;&nbsp; www.csps.com.pk</h3></li></a>
                                <li><a href="https://www.tiktok.com/@csps_academy"><h3><i class="fa fa-tiktok text-dark"></i> &nbsp;&nbsp; csps_academy</h3></li></a>
                                <li><a href="https://twitter.com/CSPSAcademy"><h3><i class="fa fa-twitter text-info"></i> &nbsp; cspsacademy</h3></li></a>
                                <li><a href="csps.css@gmail.com"><h3><i class="fa fa-envelope text-secondary"></i> &nbsp; csps.css@gmail.com</h3></li></a>
                                <li><a href="https://api.whatsapp.com/send/?phone=923165701593&text&type=phone_number&app_absent=0"><h3><i class="fa fa-whatsapp text-success"></i> &nbsp; +92-3165701593</h3></li></a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- Section Modal -->
@section('modal')

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
            $('.toast .toast-body').html("{{session('success')}}");
            $('.toast').toast('show');
        @elseif(session('error'))
            $('.toast .success-header').html('Error');
            $('.toast .toast-header').addClass('bg-danger');
            $('.toast .toast-body').addClass('bg-danger');
            $('.toast .toast-body').html("{{session('error')}}");
            $('.toast').toast('show');
        @endif
    });
</script>
<!-- Scripting Here -->
@endsection
