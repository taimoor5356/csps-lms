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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><span class="text-light">Dashboard</span>
            </li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Admin Dashboard</h6>
    </nav>
@endsection
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-sm-3">
            <div class="card">
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
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Students</p>
                                <h5 class="font-weight-bolder">
                                    1500
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+55%</span>
                                    This Month
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="fa fa-graduation-cap text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Enrollments</p>
                                <h5 class="font-weight-bolder">
                                    1500
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+50%</span>
                                    This Month
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="fa fa-id-card text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Lessons</p>
                                <h5 class="font-weight-bolder">
                                    1500
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">45%</span>
                                    This Month
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="fa fa-bookmark text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Courses</p>
                                <h5 class="font-weight-bolder">
                                    1500
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+5%</span>
                                    This Month
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="fa fa-book text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="card h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Sales overview</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">4% more</span> in 2021
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-carousel h-100 p-0">
                <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                    <div class="carousel-inner border-radius-lg h-100">
                        <div class="carousel-item h-100 active"
                            style="background-image: url('{{ asset('public/assets/img/dashboard_slider/1.png') }}./'); background-size: cover;">
                            <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <i class="ni ni-camera-compact text-dark opacity-10"></i>
                                </div>
                                <h5 class="text-white mb-1">Get started with CSPs</h5>
                                <p>There’s nothing I really wanted to do in life that I wasn’t able to get good at.</p>
                            </div>
                        </div>
                        <div class="carousel-item h-100"
                            style="background-image: url({{ asset('public/assets/img/dashboard_slider/2.jpg') }}); background-size: cover;">
                            <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                                </div>
                                <h5 class="text-white mb-1">Faster way to create web pages</h5>
                                <p>That’s my skill. I’m not really specifically talented at anything except for the
                                    ability to learn.</p>
                            </div>
                        </div>
                        <div class="carousel-item h-100"
                            style="background-image: url('{{ asset('public/assets/img/dashboard_slider/3.jpg') }}./'); background-size: cover;">
                            <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <i class="ni ni-trophy text-dark opacity-10"></i>
                                </div>
                                <h5 class="text-white mb-1">Share with us your design tips!</h5>
                                <p>Don’t be afraid to be wrong because you can’t learn anything from a compliment.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev w-5 me-3" type="button"
                        data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next w-5 me-3" type="button"
                        data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@section('page_js')
    <script>
        // Scripts Here
        var ctx1 = document.getElementById("chart-line").getContext("2d");
        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
        gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#5e72e4",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
        // Scripts Here
    </script>
@endsection
@endsection