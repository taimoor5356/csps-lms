@extends('layout.app')
@section('content')
@section('style')
<style>
    /* --- Styling Here --- */
    /* --- Styling Here --- */
</style>
@endsection
@section('breadcrumbs')
@include('layout.breadcrumb', ['tab_name' => 'Dashboard', 'page_title' => 'Admin Dashboard'])
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
                                    {{$total_students}}
                                </h5>
                                <p class="mb-0">
                                    This Month (
                                    <span class="text-success text-sm font-weight-bolder">
                                        @php $count = \App\Models\Student::whereMonth('created_at', \Carbon\Carbon::now())->count(); @endphp
                                        @if ($count < 20) <span class="text-danger">{{\App\Models\Student::whereMonth('created_at', \Carbon\Carbon::now())->count()}}</span>
                                    @endif
                                    </span>)
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
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Present Students</p>
                                <h5 class="font-weight-bolder">
                                    {{$today_present_students}}
                                </h5>
                                <p class="mb-0">
                                    This Month (
                                    <span class="text-success text-sm font-weight-bolder">
                                        @php $count = \App\Models\Student::whereMonth('created_at', \Carbon\Carbon::now())->count(); @endphp
                                        @if ($count < 20) <span class="text-danger">{{\App\Models\Student::whereMonth('created_at', \Carbon\Carbon::now())->count()}}</span>
                                    @endif
                                    </span>)
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
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Absent Students</p>
                                <h5 class="font-weight-bolder">
                                    {{$today_absent_students}}
                                </h5>
                                <p class="mb-0">
                                    This Month (
                                    <span class="text-success text-sm font-weight-bolder">
                                        @php $count = \App\Models\Student::whereMonth('created_at', \Carbon\Carbon::now())->count(); @endphp
                                        @if ($count < 20) <span class="text-danger">{{\App\Models\Student::whereMonth('created_at', \Carbon\Carbon::now())->count()}}</span>
                                    @endif
                                    </span>)
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
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Fees Awaiting</p>
                                <h5 class="font-weight-bolder">
                                    {{$total_fee_awaiting_students}}
                                </h5>
                                <p class="mb-0">
                                    This Month (
                                    <span class="text-success text-sm font-weight-bolder">
                                        @php $count = \App\Models\Student::whereMonth('created_at', \Carbon\Carbon::now())->count(); @endphp
                                        @if ($count < 20) <span class="text-danger">{{\App\Models\Student::whereMonth('created_at', \Carbon\Carbon::now())->count()}}</span>
                                    @endif
                                    </span>)
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
        <div class="col-lg-8 mb-lg-0 mb-4">
            <div class="card h-100">
                <!-- <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Registration overview</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">2% more</span> in 2023
                    </p>
                </div> -->
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="myBarChart" style="width:100%; height: 400px"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <!-- <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Registration overview</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">2% more</span> in 2023
                    </p>
                </div> -->
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="myPieChart" style="width:100%; height: 400px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card h-100">
                <!-- <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Registration overview</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">2% more</span> in 2023
                    </p>
                </div> -->
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="myMultiLinesChart" style="width:100%; height: 400px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('page_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
    var revenueData = @json($revenue);
    const barColors = "#1e73be";
    new Chart("myBarChart", {
        type: "bar",
        data: {
            labels: revenueData.map(entry => entry.month_name),
            datasets: [{
                label: 'Revenue',
                data: revenueData.map(entry => entry.total_fee),
                backgroundColor: barColors
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Monthly Revenue Chart', // Set your desired chart name here
                fontSize: 16,
                fontColor: '#333' // Set your desired font color
            }
        }
    });

    var expenses = @json($expenses);
    const beautifulColors = [
        '#3498db',
        '#2dce89',
        '#f5365c',
        '#f39c12',
        '#16a085',
        '#c0392b',
        '#1abc9c',
        '#f39c12',
        '#8e44ad',
        '#3498db',
        '#2dce89',
        '#f5365c'
    ];

    new Chart("myPieChart", {
        type: "pie",
        data: {
            labels: expenses.map(entry => entry.month_name),
            datasets: [{
                label: 'Revenue',
                data: expenses.map(entry => entry.total_expenses),
                backgroundColor: beautifulColors
            }]
        },
        options: {
            title: {
                display: true,
                text: "Expenses",
                fontSize: 16,
                fontColor: '#333' // Set your desired font color
            },
            aspectRatio: 1, // Adjust this value to control the aspect ratio
            maintainAspectRatio: true
        }
    });

    new Chart("myMultiLinesChart", {
        type: "line",
        data: {
            labels: expenses.map(entry => entry.month_name),
            datasets: [{
                label: 'Expenses',
                data: expenses.map(entry => entry.total_expenses),
                borderColor: "#f5365c",
                fill: false
            }, {
                label: 'Revenue',
                data: revenueData.map(entry => entry.total_fee),
                borderColor: "#2dce89",
                fill: false
            }]
        },
        options: {
            legend: {
                display: true
            },
            title: {
                display: true,
                text: 'Revenue VS Expenses', // Set your desired chart name here
                fontSize: 16,
                fontColor: '#333' // Set your desired font color
            }
        }
    });




    // Scripts Here
    // var ctx1 = document.getElementById("chart-line").getContext("2d");
    // var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
    // gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    // gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    // gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    // new Chart(ctx1, {
    //     type: "line",
    //     data: {
    //         labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    //         datasets: [{
    //             label: "Mobile apps",
    //             tension: 0.4,
    //             borderWidth: 0,
    //             pointRadius: 0,
    //             borderColor: "#5e72e4",
    //             backgroundColor: gradientStroke1,
    //             borderWidth: 3,
    //             fill: true,
    //             data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
    //             maxBarThickness: 6
    //         }],
    //     },
    //     options: {
    //         responsive: true,
    //         maintainAspectRatio: false,
    //         plugins: {
    //             legend: {
    //                 display: false,
    //             }
    //         },
    //         interaction: {
    //             intersect: false,
    //             mode: 'index',
    //         },
    //         scales: {
    //             y: {
    //                 grid: {
    //                     drawBorder: false,
    //                     display: true,
    //                     drawOnChartArea: true,
    //                     drawTicks: false,
    //                     borderDash: [5, 5]
    //                 },
    //                 ticks: {
    //                     display: true,
    //                     padding: 10,
    //                     color: '#fbfbfb',
    //                     font: {
    //                         size: 11,
    //                         family: "Open Sans",
    //                         style: 'normal',
    //                         lineHeight: 2
    //                     },
    //                 }
    //             },
    //             x: {
    //                 grid: {
    //                     drawBorder: false,
    //                     display: false,
    //                     drawOnChartArea: false,
    //                     drawTicks: false,
    //                     borderDash: [5, 5]
    //                 },
    //                 ticks: {
    //                     display: true,
    //                     color: '#ccc',
    //                     padding: 20,
    //                     font: {
    //                         size: 11,
    //                         family: "Open Sans",
    //                         style: 'normal',
    //                         lineHeight: 2
    //                     },
    //                 }
    //             },
    //         },
    //     },
    // });
    // Scripts Here
</script>
@endsection
@endsection