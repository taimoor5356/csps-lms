@extends('admin.layout.login_app')
@section('content')
@section('style')
    <style>
        .bg-gray-100 {
            background-color: #5e72e4 !important;
        }

        .main-content,
        section {
            background-color: #5e72e4;
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
            font-size: 20px;
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
                              <img src="{{ asset('public/assets/img/csps-logo.png') }}"
                                  class="navbar-brand-img logo-img bg-white p-1" alt="main_logo">
                              <span class="logo-text text-white">Civil Services Preparatory School-CSPs</span>
                          </div>
                      </div>
                      <hr class="horizontal dark my-4">
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-4">
                    <div class="card card-plain bg-white">
                        <div class="card-header pb-0 text-start">
                            <h4 class="font-weight-bolder">Sign In</h4>
                            <p class="mb-0">Enter your email and password to sign in</p>
                        </div>
                        <div class="card-body">
                            <form role="form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <input type="email" name="email" class="form-control form-control-lg"
                                        placeholder="Email" aria-label="Email" required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        placeholder="Password" aria-label="Password" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-4 text-sm mx-auto">
                                Don't have an account?
                                <a href="javascript:;" class="text-primary text-gradient font-weight-bold">Sign
                                    up</a>
                            </p>
                        </div>
                    </div>
                  </div>
                  <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                    {{-- <div class="row"> --}}
                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 card pt-4 px-4">
                        <div class="d-flex flex-column justify-content-center overflow-hidden">
                          <h4 class="text-dark font-weight-bolder position-relative">Notification</h4>
                          <p class="text-xs">Free On-Campus CSS-2023 Seminar on 17th August, 2022 at 05:30PM</p>
                          <p class="text-xs">CSS Screening test 2013 in October, 2022</p>
                          <p class="text-xs">Written CSS-2013 Exam in Feb, 2023</p>
                        </div>
                      </div>
                      <hr class="horizontal dark my-4">
                      <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 card-carousel overflow-hidden pt-4 bg-primary">
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
                                  {{-- <div class="carousel-item active h-25 bg-primary">
                                    <div class="col-3 bg-primary d-flex justify-content-center">
                                      <img src="{{ asset('public/assets/img/dashboard_slider/3.jpg') }}" alt="" class="img-fluid img-thumbnail bg-primary">
                                      <img src="{{ asset('public/assets/img/dashboard_slider/3.jpg') }}" alt="" class="img-fluid img-thumbnail bg-primary">
                                      <img src="{{ asset('public/assets/img/dashboard_slider/3.jpg') }}" alt="" class="img-fluid img-thumbnail bg-primary">
                                    </div>
                                  </div>
                                  <div class="col-3 carousel-item bg-primary">
                                    <img src="{{ asset('public/assets/img/dashboard_slider/3.jpg') }}" alt="" class="img-fluid img-thumbnail">
                                  </div>
                                  <div class="col-3 carousel-item bg-primary">
                                    <img src="{{ asset('public/assets/img/dashboard_slider/3.jpg') }}" alt="" class="img-fluid img-thumbnail">
                                  </div> --}}
                              </div>
                          </div>
                      </div>
                    {{-- </div> --}}
                    <div class="position-relative h-75 border-radius-lg d-flex flex-column justify-content-center overflow-hidden">
                      <span class="mask"></span>
                    </div>
                  </div>
                </div>
            </div>
            <hr class="horizontal dark my-4">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <ul class="d-inline-flex text-white login-social-icons">
                        <li>
                            <i class="fa fa-whatsapp"></i>
                        </li>
                        <li>
                            <i class="fa fa-facebook"></i>
                        </li>
                        <li>
                            <i class="fa fa-instagram"></i>
                        </li>
                        <li>
                            <i class="fa fa-twitter"></i>
                        </li>
                        <li>
                            <i class="fa fa-youtube"></i>
                        </li>
                        <li>
                            <i class="fa fa-telegram"></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
  </section>
</main>
@endsection
@section('page_js')
@endsection
