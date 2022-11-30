@extends('admin.layout.app')
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
        <h6 class="font-weight-bolder text-white mb-0">Lesson Plan</h6>
    </nav>
@endsection
<div class="container-fluid py-4">
    <div class="row mb-2">
        <div class="col-xl-3 col-sm-3 mb-xl-0 mb-4">
            <div class="card">
                <div class="alert-messages w-50 ms-auto text-center">
                    <div class="toast bg-success" id="notification" role="alert" aria-live="assertive"
                        aria-atomic="true">
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
                                </h5>
                                {{-- <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+55%</span>
                                    This Month
                                </p> --}}
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
        <div class="col-xl-3 col-sm-3 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Lectures</p>
                                <h5 class="font-weight-bolder">
                                </h5>
                                {{-- <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+50%</span>
                                    This Month
                                </p> --}}
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
        <div class="col-xl-3 col-sm-3 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Assignments</p>
                                <h5 class="font-weight-bolder">
                                    1500
                                </h5>
                                {{-- <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">45%</span>
                                    This Month
                                </p> --}}
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
        <div class="col-xl-3 col-sm-3 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Mock Papers</p>
                                <h5 class="font-weight-bolder">
                                </h5>
                                {{-- <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+5%</span>
                                    This Month
                                </p> --}}
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
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col-12">
                            Syllabus Status For English (210)
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-12">
                            <table class="table attendance-table">
                                <thead>
                                    <th class="px-0">#</th>
                                    <th class="px-0">Lesson - Topic</th>
                                    <th class="px-0">Topic Completion Date</th>
                                    <th class="px-0">Status</th>
                                    <th class="px-0">Action</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-0 py-2">1</td>
                                        <td class="px-0 py-2">
                                            <p class="text-sm" style="font-weight: bold">A Happy Child</p>
                                            <p class="text-sm">1.1 Basic Communication with child</p>
                                            <p class="text-sm">1.2 Basic Communication with child</p>
                                            <p class="text-sm">1.3 Basic Communication with child</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">-</p>
                                            <p class="text-sm" class="">05/03/2022</p>
                                            <p class="text-sm" class="">05/03/2022</p>
                                            <p class="text-sm" class="">05/03/2022</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">-</p>
                                            <p class="text-sm" class="bg-dark p-1 text-white w-75">
                                                Complete
                                            </p>
                                            <p class="text-sm" class="bg-dark p-1 text-white w-75">
                                                Complete
                                            </p>
                                            <p class="text-sm" class="bg-secondary p-1 text-white w-75">
                                                Incomplete
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm">-</p>
                                            <p class="text-sm">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" class="lesson-plan-status" value="1">
                                                    <span class="slider round"></span>
                                                </label>
                                            </p>
                                            <p class="text-sm">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" class="lesson-plan-status" value="2">
                                                    <span class="slider round"></span>
                                                </label>
                                            </p>
                                            <p class="text-sm">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" class="lesson-plan-status" value="3">
                                                    <span class="slider round"></span>
                                                </label>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0 py-2">1</td>
                                        <td class="px-0 py-2">
                                            <p class="text-sm" style="font-weight: bold">A Happy Child</p>
                                            <p class="text-sm">1.1 Basic Communication with child</p>
                                            <p class="text-sm">1.2 Basic Communication with child</p>
                                            <p class="text-sm">1.3 Basic Communication with child</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">-</p>
                                            <p class="text-sm" class="">05/03/2022</p>
                                            <p class="text-sm" class="">05/03/2022</p>
                                            <p class="text-sm" class="">05/03/2022</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">-</p>
                                            <p class="text-sm" class="bg-dark p-1 text-white w-75">
                                                Complete
                                            </p>
                                            <p class="text-sm" class="bg-dark p-1 text-white w-75">
                                                Complete
                                            </p>
                                            <p class="text-sm" class="bg-secondary p-1 text-white w-75">
                                                Incomplete
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm">-</p>
                                            <p class="text-sm">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" class="lesson-plan-status" value="1">
                                                    <span class="slider round"></span>
                                                </label>
                                            </p>
                                            <p class="text-sm">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" class="lesson-plan-status" value="2">
                                                    <span class="slider round"></span>
                                                </label>
                                            </p>
                                            <p class="text-sm">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" class="lesson-plan-status" value="3">
                                                    <span class="slider round"></span>
                                                </label>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0 py-2">1</td>
                                        <td class="px-0 py-2">
                                            <p class="text-sm" style="font-weight: bold">A Happy Child</p>
                                            <p class="text-sm">1.1 Basic Communication with child</p>
                                            <p class="text-sm">1.2 Basic Communication with child</p>
                                            <p class="text-sm">1.3 Basic Communication with child</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">-</p>
                                            <p class="text-sm" class="">05/03/2022</p>
                                            <p class="text-sm" class="">05/03/2022</p>
                                            <p class="text-sm" class="">05/03/2022</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">-</p>
                                            <p class="text-sm" class="bg-dark p-1 text-white w-75">
                                                Complete
                                            </p>
                                            <p class="text-sm" class="bg-dark p-1 text-white w-75">
                                                Complete
                                            </p>
                                            <p class="text-sm" class="bg-secondary p-1 text-white w-75">
                                                Incomplete
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm">-</p>
                                            <p class="text-sm">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" class="lesson-plan-status" value="1">
                                                    <span class="slider round"></span>
                                                </label>
                                            </p>
                                            <p class="text-sm">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" class="lesson-plan-status" value="2">
                                                    <span class="slider round"></span>
                                                </label>
                                            </p>
                                            <p class="text-sm">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" class="lesson-plan-status" value="3">
                                                    <span class="slider round"></span>
                                                </label>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0 py-2">1</td>
                                        <td class="px-0 py-2">
                                            <p class="text-sm" style="font-weight: bold">A Happy Child</p>
                                            <p class="text-sm">1.1 Basic Communication with child</p>
                                            <p class="text-sm">1.2 Basic Communication with child</p>
                                            <p class="text-sm">1.3 Basic Communication with child</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">-</p>
                                            <p class="text-sm" class="">05/03/2022</p>
                                            <p class="text-sm" class="">05/03/2022</p>
                                            <p class="text-sm" class="">05/03/2022</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">-</p>
                                            <p class="text-sm" class="bg-dark p-1 text-white w-75">
                                                Complete
                                            </p>
                                            <p class="text-sm" class="bg-dark p-1 text-white w-75">
                                                Complete
                                            </p>
                                            <p class="text-sm" class="bg-secondary p-1 text-white w-75">
                                                Incomplete
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm">-</p>
                                            <p class="text-sm">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" class="lesson-plan-status" value="1">
                                                    <span class="slider round"></span>
                                                </label>
                                            </p>
                                            <p class="text-sm">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" class="lesson-plan-status" value="2">
                                                    <span class="slider round"></span>
                                                </label>
                                            </p>
                                            <p class="text-sm">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" class="lesson-plan-status" value="3">
                                                    <span class="slider round"></span>
                                                </label>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0 py-2">1</td>
                                        <td class="px-0 py-2">
                                            <p class="text-sm" style="font-weight: bold">A Happy Child</p>
                                            <p class="text-sm">1.1 Basic Communication with child</p>
                                            <p class="text-sm">1.2 Basic Communication with child</p>
                                            <p class="text-sm">1.3 Basic Communication with child</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">-</p>
                                            <p class="text-sm" class="">05/03/2022</p>
                                            <p class="text-sm" class="">05/03/2022</p>
                                            <p class="text-sm" class="">05/03/2022</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">-</p>
                                            <p class="text-sm" class="bg-dark p-1 text-white w-75">
                                                Complete
                                            </p>
                                            <p class="text-sm" class="bg-dark p-1 text-white w-75">
                                                Complete
                                            </p>
                                            <p class="text-sm" class="bg-secondary p-1 text-white w-75">
                                                Incomplete
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm">-</p>
                                            <p class="text-sm">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" class="lesson-plan-status" value="1">
                                                    <span class="slider round"></span>
                                                </label>
                                            </p>
                                            <p class="text-sm">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" class="lesson-plan-status" value="2">
                                                    <span class="slider round"></span>
                                                </label>
                                            </p>
                                            <p class="text-sm">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" class="lesson-plan-status" value="3">
                                                    <span class="slider round"></span>
                                                </label>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0 py-2">1</td>
                                        <td class="px-0 py-2">
                                            <p class="text-sm" style="font-weight: bold">A Happy Child</p>
                                            <p class="text-sm">1.1 Basic Communication with child</p>
                                            <p class="text-sm">1.2 Basic Communication with child</p>
                                            <p class="text-sm">1.3 Basic Communication with child</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">-</p>
                                            <p class="text-sm" class="">05/03/2022</p>
                                            <p class="text-sm" class="">05/03/2022</p>
                                            <p class="text-sm" class="">05/03/2022</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">-</p>
                                            <p class="text-sm" class="bg-dark p-1 text-white w-75">
                                                Complete
                                            </p>
                                            <p class="text-sm" class="bg-dark p-1 text-white w-75">
                                                Complete
                                            </p>
                                            <p class="text-sm" class="bg-secondary p-1 text-white w-75">
                                                Incomplete
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm">-</p>
                                            <p class="text-sm">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" class="lesson-plan-status" value="1">
                                                    <span class="slider round"></span>
                                                </label>
                                            </p>
                                            <p class="text-sm">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" class="lesson-plan-status" value="2">
                                                    <span class="slider round"></span>
                                                </label>
                                            </p>
                                            <p class="text-sm">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" class="lesson-plan-status" value="3">
                                                    <span class="slider round"></span>
                                                </label>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('page_js')
    <script>
        $(document).ready(function() {
            $('.attendance-table').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5],
                    [5]
                ]
            });
            $('.time-table').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5],
                    [5]
                ]
            });
            $(document).on('change', '.lesson-plan-status', function () {
                if ($(this).is(':checked')) {
                    alert($(this).val());
                }
            });
        });
    </script>
@endsection
@endsection
