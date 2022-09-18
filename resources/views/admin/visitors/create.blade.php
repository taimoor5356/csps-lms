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
<div class="container-fluid bg-primary position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <!-- Navbar -->
            <nav class="navbar bg-primary navbar-expand-lg top-0 z-index-3 mt-2 py-2 start-0 end-0">
                <div class="container-fluid justify-content-center">
                    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 p-0 text-white"
                        href="https://www.csps.com.pk">
                        <img src="{{ asset('public/assets/img/csps-logo.png') }}" height="80" width="85"
                            class="navbar-brand-img logo-img bg-white p-1" alt="main_logo">
                    </a>
                    <h4 class="text-white" style="font-size: 25px; font-weight: bold">CSPs - Civil Services Preparatory School<p style="font-size: 14px" class="text-center text-success">Pakistan Renowed CSS and PMS Preparatory Institure</p></h4>
                </div>
            </nav>
            <hr class="horizontal dark">
            <!-- End Navbar -->
        </div>
    </div>
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <h5>Register for CSS and PMS free Seminar</h5>
                            <p>Do you want to Register?</p>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 d-flex justify-content-end">
                            <button type="button" class="btn btn-primary">Download Prospectus</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="visitor-form">
                        @csrf
                        @include('admin.visitors._form')
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
        $(document).on('submit', '#visitor-form', function(e) {
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
                    url: "{{ route('store.visitor') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('#save').prop('disabled', false);
                        $('.loader').addClass('d-none');
                        if (response.status == true) {
                            $('.toast .toast-header').removeClass('bg-danger');
                            $('.toast .toast-header').removeClass('bg-danger');
                            $('.toast .toast-body').removeClass('bg-danger');
                            $('.toast .success-header').html('Success');
                            $('.toast .toast-header').addClass('bg-success');
                            $('.toast .toast-body').addClass('bg-success');
                            $('.toast .toast-body').html(response.msg);
                            $('.toast').toast('show');
                            setTimeout(function () {
                                window.location.href = "{{ route('login') }}";
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
