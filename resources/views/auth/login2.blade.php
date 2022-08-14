@extends('admin.layout.login_app')
@section('content')
@section('style')
    <style>
        .bg-gray-100 {
            background-color: #1e73be !important;
        }

        .main-content,
        section {
            background-color: #1e73be;
        }

        .logo-img {
            border-radius: 50%;
            height: 70px;
        }

        .logo-container {
            position: relative;
        }

        .vertical-center {
            margin: 0;
            position: absolute;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .logo-text {
            font-weight: bold;
            font-size: 25px;
        }

        hr.horizontal.dark {
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1), rgba(255, 255, 255, 0)) !important;
        }

        .login-social-icons li {
            margin: 10px 30px;
            list-style: none;
            font-size: 20px;
        }
    </style>
@endsection
<main class="main-content">
  <section>
    <div class="page-header mt-4">
        <div class="container">
            <div class="row">
                <div class="row">
                  <div class="col-12">
                      <div class="col-12 d-flex justify-content-center logo-container">
                          <div class="vertical-container">
                              <img src="{{ asset('public/assets/img/csps-logo.png') }}" class="navbar-brand-img logo-img bg-white p-1" alt="main_logo">
                              <span class="logo-text text-white">Civil Services Preparatory School-CSPs</span>
                          </div>
                      </div>
                      <hr class="horizontal dark my-4">
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-0">
                    <div class="card card-plain bg-white">
                        <div class="card-header pb-0 text-start">
                            <h4 class="font-weight-bolder">Sign In</h4>
                            <span class="mb-0 text-sm">Enter your email and password to sign in</span>
                        </div>
                        <div class="card-body">
                            <form role="form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-2">
                                    <input type="email" name="email" class="form-control form-control-lg"
                                        placeholder="Email" aria-label="Email" required>
                                </div>
                                <div class="mb-0">
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        placeholder="Password" aria-label="Password" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-lg btn-primary btn-lg w-100 mt-2 mb-0">Sign in</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-4 text-sm mx-auto">
                                Don't have an account?
                                <a href="{{ route('signup') }}" class="text-primary text-gradient font-weight-bold">Sign
                                    up</a>
                            </p>
                        </div>
                    </div>
                  </div>
                  <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 card pt-4 pb-1 px-4">
                      <div class="d-flex flex-column justify-content-center overflow-hidden">
                        <h4 class="text-dark font-weight-bolder position-relative">Notification</h4>
                        <h6 class="tex">- Free On-Campus CSS-2023 Seminar on 17th August, 2022 at 05:30PM</h6>
                        <h6 class="tex">- CSS Screening test 2013 in October, 2022</h6>
                        <h6 class="tex">- Written CSS-2013 Exam in Feb, 2023</p>
                      </div>
                    </div>
                    <hr class="horizontal dark my-3">
                    <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 card-carousel overflow-hidden bg-primary">
                        <div id="carouselExampleCaptions" class="carousel slide bg-primary" data-bs-ride="carousel">
                            <div class="carousel-inner border-radius-lg bg-primary">
                              <div class="carousel-item active h-100">
                                <div class="row">
                                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-4">
                                    <img src="{{ asset('public/assets/img/dashboard_slider/3.jpg') }}" alt="" class="img-fluid rounded">
                                  </div>
                                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-4">
                                    <img src="{{ asset('public/assets/img/dashboard_slider/3.jpg') }}" alt="" class="img-fluid rounded">
                                  </div>
                                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-4">
                                    <img src="{{ asset('public/assets/img/dashboard_slider/3.jpg') }}" alt="" class="img-fluid rounded">
                                  </div>
                                </div>
                              </div>
                              <div class="carousel-item h-100">
                                <div class="row">
                                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-4">
                                    <img src="{{ asset('public/assets/img/dashboard_slider/3.jpg') }}" alt="" class="img-fluid rounded">
                                  </div>
                                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-4">
                                    <img src="{{ asset('public/assets/img/dashboard_slider/3.jpg') }}" alt="" class="img-fluid rounded">
                                  </div>
                                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-4">
                                    <img src="{{ asset('public/assets/img/dashboard_slider/3.jpg') }}" alt="" class="img-fluid rounded">
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative h-75 border-radius-lg d-flex flex-column justify-content-center overflow-hidden">
                      <span class="mask"></span>
                    </div>
                  </div>
                </div>
            </div>
            <hr class="horizontal dark my-4">
        </div>
    </div>
    <div class="container">
      
      <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <ul class="d-inline-flex text-white login-social-icons">
                <li>
                    <a href="#" class="text-white"><i class="fa fa-whatsapp"></i></a>
                </li>
                <li>
                    <a href="https://www.facebook.com/CSPsAcademy" class="text-white"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                    <a href="https://www.instagram.com/cspsacademy" class="text-white"><i class="fa fa-instagram"></i></a>
                </li>
                <li>
                    <a href="https://twitter.com/CSPSAcademy" class="text-white"><i class="fa fa-twitter"></i></a>
                </li>
                <li>
                    <a href="https://www.youtube.com/c/CivilServicesPreparatorySchoolforCSSPMSAcademy" class="text-white"><i class="fa fa-youtube"></i></a>
                </li>
                <li>
                    <a href="https://t.me/cspsacademy" class="text-white"><i class="fa fa-telegram"></i></a>
                </li>
            </ul>
        </div>
    </div>
    </div>
  </section>
</main>
@endsection
@section('page_js')
@endsection
