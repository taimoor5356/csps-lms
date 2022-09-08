<!--
=========================================================
* CSPs Dashboard 2 - v2.0.2
=========================================================

* Product Page: https://www.creative-tim.com/product/CSPs-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('public/assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('public/assets/img/csps-logo.png') }}">
  <title>
    CSPs
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('public/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Bootstrap -->
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('public/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('public/assets/font-awesome/css/font-awesome.min.css')}}">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('public/assets/css/argon-dashboard.css?v=2.0.2') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    .min-height-300 {
      background-color: #1e73be;
    }
    ::-webkit-scrollbar {
        width: 5px;
    }
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px !important;
        height: 8px !important;
        background-color: #fff !important;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        border-radius: 0px !important;
        -webkit-box-shadow: inset 0 0 2px rgba(0,0,0,.3);
        background-color: #1e73be;
    }
    .data-table>tbody>tr {
        border: 1px solid rgb(226, 226, 226);
    }
    #notification {
        position: fixed;
        top: 5px;
        left: 40%;
    }
    .ps .ps__rail-y {
      width: 5px !important;
    }
    .ps .ps__rail-y:hover {
      width: 5px !important;
    }
    .ps__rail-y.ps--clicking.ps__thumb-y {
      background-color: #1e73be !important;
      width: 5px !important;
    }
    .ps__thumb-y {
      background-color: #1e73be !important;
      width: 5px !important;
    }
    .ps__rail-y:hover>.ps__thumb-y {
      background-color: #1e73be !important;
      width: 5px !important;
    }
    .loader {
        border: 2px solid #f3f3f3;
        border-radius: 50%;
        border-top: 2px solid transparent;
        width: 15px;
        height: 15px;
        -webkit-animation: spin 1s linear infinite; /* Safari */
        animation: spin 1s linear infinite;
    }
    /* Safari */
    @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
    }
    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }
  </style>
  @yield('style')
</head>
<body class="g-sidenav-show bg-primary">
  <div class="min-height-300 position-absolute bg-primary w-100"></div>
  {{-- @include('admin.layout.sidebar') --}}
  <main class="main-content position-relative bg-primary border-radius-lg ">
    <!-- Navbar -->
    {{-- @include('admin.layout.header') --}}
    <!-- End Navbar -->
    @yield('content')
    @include('admin.layout.footer')
  </main>
  @include('admin.layout.configure')
  @yield('modal')
  <!--   Core JS Files   -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="{{ asset('public/assets/js/core/popper.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  {{-- <script src="{{ asset('public/assets/js/core/bootstrap.min.js') }}"></script> --}}
  <script src="{{ asset('public/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('public/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('public/assets/js/plugins/chartjs.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    $(document).ready(function () {
      $(document).on('click', '.close-toast-msg', function () {
        $('.toast').toast('hide');
      });
      $('.js-example-theme-single').select2({
        placeholder: 'Select Courses',
        theme: 'classic',
        maximumSelectionLength: 5,
        allowClear: true,
      });
      $('.js-example-theme-multiple').select2({
        placeholder: 'Select Student',
        theme: 'classic',
      });
    });
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('public/assets/js/argon-dashboard.min.js?v=2.0.2') }}"></script>
  @yield('page_js')
</body>
</html>