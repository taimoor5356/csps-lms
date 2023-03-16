@extends('admin.layout.login_app')
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
<div class="container-fluid bg-primary position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <!-- Navbar -->
            <nav class="navbar bg-primary navbar-expand-lg top-0 z-index-3 mt-2 py-2 start-0 end-0">
                <div class="container-fluid justify-content-center">
                    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 p-0 text-white"
                        href="https://www.csps.com.pk">
                        <img src="{{ asset('public/assets/img/csps-logo.png') }}" height="65" width="70"
                            class="navbar-brand-img logo-img bg-white p-1" alt="main_logo"> <span
                            style="font-size: 25px">CSPs - Civil Services Preparatory School</span>
                    </a>
                </div>
            </nav>
            <hr class="horizontal dark">
            <!-- End Navbar -->
        </div>
    </div>
</div>
<main class="main-content">
    <section>
        <div class="page-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12 h-100 mt-4">
                        <div class="card card-plain bg-white h-100">
                            <div class="card-header mb-0 pb-0">
                                <h4 class="font-weight-bolder">Sign In</h4>
                                <p class="mb-0">Enter your email and password to sign in</p>
                            </div>
                            <div class="card-body mt-1 pt-1 h-100">
                                <form role="form" method="POST" action="{{ route('login') }}">
                                  @csrf
                                    <div class="mb-3">
                                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Email"
                                            aria-label="Email">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="password" class="form-control form-control-lg"
                                            placeholder="Password" aria-label="Password">
                                    </div>
                                    <div class="form-check form-switch mb-2 pb-0">
                                        <input class="form-check-input" type="checkbox" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                    <div class="text-center mt-3 pt-0">
                                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mb-0">Sign
                                            in</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 mt-0 pb-0">
                                <p class="text-sm mx-auto">
                                    New User?
                                    <a href="{{ route('create.visitor') }}" class="text-primary text-gradient font-weight-bold">Click Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-xs-12 mt-4" style="position: relative;">
                        <div class="card card-plain bg-white mb-4">
                            <div class="card-header pb-0">
                                <h4 class="font-weight-bolder">Notification</h4>
                            </div>
                            <div class="card-body pt-0">
                                <p class="font-weight-bolder pb-0 mb-0 text-dark">- Free On-Campus CSS/PMS 2024 Seminar on April 2nd, 2023 at 3:00pm</p>
                                <p class="font-weight-bolder pb-0 mb-0 text-dark">- CSS/PMS 2022 Screening test in October, 2023,
                                    2022</p>
                                <p class="font-weight-bolder pb-0 mb-0 text-dark">- Written CSS/PMS-2022 Exam in Feb, 2024
                                </p>
                            </div>
                        </div>
                        <div class="d-none d-md-block" style="border-radius: 50px">
                            <div class="container-fluid" style="position: absolute; bottom: 0px; width: 100%">
                                <div class="content">
                                    <div class="site-section bg-left-half">
                                        <div class="container-fluid lowl-2-style card card-plain">
                                            <div class="owl-carousel owl-2">
                                                <div class="media-29101">
                                                    <a href="#">
                                                      <img src="{{asset('public/assets/img/dashboard_slider/3.jpg')}}" alt="Image"
                                                            class="img-fluid"></a>
                                                </div>
                                                <div class="media-29101">
                                                    <a href="#"><img src="{{asset('public/assets/img/dashboard_slider/3.jpg')}}" alt="Image"
                                                            class="img-fluid"></a>
                                                </div>
                                                <div class="media-29101">
                                                    <a href="#"><img src="{{asset('public/assets/img/dashboard_slider/3.jpg')}}" alt="Image"
                                                            class="img-fluid"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="horizontal dark">
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
                    <a href="https://www.youtube.com/c/CivilServicesPreparatorySchoolforCSSPMSAcademy" class="text-white"><i class="fa fa-youtube"></i></a>
                  </div>
                  <div class="col-2 text-center" style="width: 7% !important">
                    <a href="https://www.tiktok.com/@csps_academy" class="text-white"><i class="fa fa-tiktok"></i></a>
                  </div>
                  <div class="col-2 text-center" style="width: 7% !important">
                    <a href="https://api.whatsapp.com/send/?phone=923165701593&text&type=phone_number&app_absent=0" class="text-white"><i class="fa fa-whatsapp"></i></a>
                  </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>
@endsection
@section('page_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
    crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ti-icons@0.1.2/css/themify-icons.css">
<script src="{{asset('public/carousel-12/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('public/carousel-12/js/main.js')}}"></script>
@endsection
