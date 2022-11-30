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
        <h6 class="font-weight-bolder text-white mb-0">Teacher Dashboard</h6>
    </nav>
@endsection
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-sm-3 mb-xl-0 mb-4">
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
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Students</p>
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
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Lectures</p>
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
                        <div class="col-3">
                            <select name="subject" id="subject" class="form-control subject" placeholder="Subject">
                                <option value="" disabled selected>Select Subject</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <select name="batch" id="batch" class="form-control batch" placeholder="Batch">
                                <option value="" disabled selected>Document Title</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <select name="time" id="time" class="form-control time" placeholder="Time">
                                <option value="" disabled selected>Category</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <input type="file" class="form-control" name="file" id="file">
                        </div>
                    </div>
                    <div class="row mt-2 d-flex justify-content-end">
                        <div class="col-3 d-flex justify-content-end">
                            <input type="button" class="btn btn-primary" value="Upload">
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-12">
                            <table class="table download-center-table">
                                <thead>
                                    <th class="px-0">Description</th>
                                    <th class="px-0">Book</th>
                                    <th class="px-0">Download</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-0">Introduction to Pakistan</td>
                                        <td class="px-0">Current Affairs</td>
                                        <td class="px-0"><a href="#" title="Download">Notes <i class="fa fa-download"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td class="px-0">Introduction to Pakistan</td>
                                        <td class="px-0">Current Affairs</td>
                                        <td class="px-0"><a href="#" title="Download">Books <i class="fa fa-download"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td class="px-0">Introduction to Pakistan</td>
                                        <td class="px-0">Current Affairs</td>
                                        <td class="px-0"><a href="#" title="Download">Slides <i class="fa fa-download"></i></a></td>
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
        $(document).ready(function (){
            $('.download-center-table').DataTable({
                pageLength : 5,
                lengthMenu: [[5], [5]]
            });
            $('.time-table').DataTable({
                pageLength : 5,
                lengthMenu: [[5], [5]]
            });
        });
    </script>
@endsection
@endsection
