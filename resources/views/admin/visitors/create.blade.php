@extends('admin.layout.visitor_app')
@section('content')
@section('style')
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

    {{-- <link rel="stylesheet" href="{{asset('public/carousel-12/fonts/icomoon/style.css')}}"> --}}

    {{-- <link rel="stylesheet" href="{{asset('public/carousel-12/css/owl.carousel.min.css')}}"> --}}

    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="{{asset('public/carousel-12/css/bootstrap.min.css')}}"> --}}

    <!-- Style -->
    {{-- <link rel="stylesheet" href="{{asset('public/carousel-12/css/style.css')}}"> --}}
    <style>
        #notification {
            position: fixed;
            top: 145px;
            left: 40%;
        }

        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }

        .logo-img {
            border-radius: 50%;
        }

        hr.horizontal.dark {
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1), rgba(255, 255, 255, 0)) !important;
        }

        .navbar {
            box-shadow: none !important;
        }

        .owl-nav {
            display: none;
        }

        .fa:hover {
            /* font-size:25px; */
            transform: scale(1.5);
        }

        .contact-input-group,
        #cell_no,
        #cell_no:focus {
            margin-left: -6px;
            border-right: 1px solid lightgray;
        }
    </style>
@endsection
{{-- @section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-light" href="javascript:;">CSPs</a></li>
            <li class="breadcrumb-item text-sm text-white" aria-current="page"><a href="{{ route('visitors') }}"
                    class="text-white">Visitors</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><span
                    class="text-light">Add New</span></li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Visitors</h6>
    </nav>
@endsection --}}
<div class="container-fluid bg-primary position-sticky z-index-sticky top-0 my-0 py-0">
    <div class="row my-0 py-0">
        <div class="col-12 my-0 py-0">
            <!-- Navbar -->
            <nav class="navbar bg-primary navbar-expand-lg top-0 z-index-3 mt-2 start-0 end-0">
                <div class="container-fluid justify-content-center">
                    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 p-0 text-white"
                        href="https://www.csps.com.pk">
                        <img src="{{ asset('public/assets/img/csps-logo.png') }}" height="80" width="85"
                            class="navbar-brand-img logo-img bg-white p-1" alt="main_logo">
                    </a>
                    <h4 class="text-white" style="font-size: 25px; font-weight: bold">CSPs - Civil Services Preparatory
                        School<p style="font-size: 14px" class="text-center text-danger font-weight-bold bg-white">
                            Pakistan Renowed CSS and PMS Preparatory Institute</p>
                    </h4>
                </div>
            </nav>
            <hr class="horizontal dark">
            <!-- End Navbar -->
        </div>
    </div>
</div>
<div class="container-fluid my-0 py-0">
    <div class="row my-0 py-0">
        <div class="col-12 my-0 py-0">
            <div class="card my-0 py-0">
                <div class="card-header my-0 py-3">
                    <div class="row my-0 py-0">
                        <div class="col-md-6 col-lg-6 col-xl-6 my-0 py-0">
                            <h5>Register for CSS and PMS free Seminar</h5>
                            <p>Do you want to Register On Campus OR Online?</p>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 d-flex justify-content-end my-0 py-0">
                            <button type="button" class="btn btn-success"
                                onclick="location.href='{{ asset('public/assets/prospectus/csps_lms_prospectus.pdf') }}'"
                                target="_blank" download>Download Prospectus</button>
                        </div>
                    </div>
                </div>
                <hr class="horizontal-dark">
                <div class="card-body my-0 py-0">
                    <form method="POST" enctype="multipart/form-data" id="visitor-form">
                        @csrf
                        @include('admin.visitors._form')
                        <div class="row mt-2">
                            <div class="col-12 sm-auto text-center">
                                <button class="btn btn-success px-4 text-white" type="submit" id="save">
                                    <i class="fa fa-save"></i> Save &nbsp;<div class="loader mt-1 d-none"
                                        style="float: right"></div>
                                </button>
                                <p>
                                    <a href="/lms/login">Login Here</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="row justify-content-center">
            <div class="col-2 text-center" style="width: 7% !important">
                <a href="https://www.csps.com.pk" class="text-white"><i class="fa fa-globe"></i></a>
            </div>
            <div class="col-2 text-center" style="width: 7% !important">
                <a href="https://www.facebook.com/CSPsAcademy" class="text-white"><i class="fa fa-facebook"></i></a>
            </div>
            <div class="col-2 text-center" style="width: 7% !important">
                <a href="https://www.instagram.com/cspsacademy" class="text-white"><i class="fa fa-instagram"></i></a>
            </div>
            <div class="col-2 text-center" style="width: 7% !important">
                <a href="https://twitter.com/CSPSAcademy" class="text-white"><i class="fa fa-twitter"></i></a>
            </div>
            <div class="col-2 text-center" style="width: 7% !important">
                <a href="https://www.youtube.com/c/CivilServicesPreparatorySchoolforCSSPMSAcademy" class="text-white"><i
                        class="fa fa-youtube"></i></a>
            </div>
            <div class="col-2 text-center" style="width: 7% !important">
                <a href="https://www.tiktok.com/@csps_academy" class="text-white"><i class="fa fa-tiktok"></i></a>
            </div>
            <div class="col-2 text-center" style="width: 7% !important">
                <a href="https://api.whatsapp.com/send/?phone=923165701593&text&type=phone_number&app_absent=0"
                    class="text-white"><i class="fa fa-whatsapp"></i></a>
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
            if ($('#name').val().length > 50) {
                $('#name-length-alert').removeClass('d-none');
                return false;
            } else {
                $('#name-length-alert').addClass('d-none');
            }
            if ($('#cell_no').val().length < 9 || $('#cell_no').val().length > 9) {
                $('#contact-length-alert').removeClass('d-none');
                return false;
            } else {
                $('#contact-length-alert').addClass('d-none');
            }
            if ($('#degree').val().length > 50) {
                $('#degree-length-alert').removeClass('d-none');
                return false;
            } else {
                $('#degree-length-alert').addClass('d-none');
            }
            $('#save').prop('disabled', true);
            $('#save').removeClass('btn-success');
            $('#save').addClass('btn-danger');
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
                    url: "{{ route('store.visitor') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
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
                            $('#save').removeClass('btn-danger');
                            $('#save').addClass('btn-success');
                            $('.loader').addClass('d-none');
                            setTimeout(function() {
                                window.location.href =
                                    "{{ route('login') }}";
                            }, 3000);
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
                            $('#save').removeClass('btn-danger');
                            $('#save').addClass('btn-success');
                            $('.loader').addClass('d-none');
                        } else {
                            $('#save').prop('disabled', false);
                            $('#save').removeClass('btn-danger');
                            $('#save').addClass('btn-success');
                            $('.loader').addClass('d-none');
                        }
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    $('.toast .toast-header').removeClass('bg-success');
                    $('.toast .toast-header').removeClass('bg-success');
                    $('.toast .toast-body').removeClass('bg-success');
                    $('.toast .success-header').html('Error');
                    $('.toast .toast-header').addClass('bg-danger');
                    $('.toast .toast-body').addClass('bg-danger');
                    $('.toast .toast-body').html('Session Expired, Login again');
                    $('.toast').toast('show');
                    $('#save').prop('disabled', false);
                    $('#save').removeClass('btn-danger');
                    $('#save').addClass('btn-success');
                    $('.loader').addClass('d-none');
                });
            }, 1000);
        });
    });
</script>
<!-- Scripting Here -->
@endsection
