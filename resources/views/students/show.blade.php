@extends('layout.app')
@section('content')
@section('style')
    <!-- Styling Here -->
    <style>
        .student-photo {
            border-radius: 50%;
        }
        p {
            margin: 3px 0px 8px 0px !important;
        }
    </style>
    <!-- Styling Here -->
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-light" href="javascript:;">CSPs</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><span class="text-light">Students</span>
            </li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Student Profile</h6>
    </nav>
@endsection
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                </div>
                <div class="card-body pt-0 pb-2">
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <a class="navbar-brand m-0 text-center" href="#" target="_blank">
                                <img src="{{URL::to('/')}}/public/assets/img/students/@isset($student){{ $student->user->photo }}@endisset" height="100" width="100" class="student-photo" alt="student-photo">
                            </a>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias officiis sint omnis at dolores accusantium ullam </p>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias officiis sint omnis at dolores accusantium ullam </p>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias officiis sint omnis at dolores accusantium ullam </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-center">
                    <a class="navbar-brand m-0 text-center" href="#" target="_blank">
                        <img src="{{URL::to('/')}}/public/assets/img/students/@isset($student){{ $student->user->photo }}@endisset" height="100" width="100" class="student-photo" alt="student-photo">
                    </a>
                </div>
                <div class="card-body pt-0 pb-2">
                    <hr>
                    <p class="text-center">
                        @isset($student){{ !is_null($student->user->name) ? $student->user->name : '#name'}}@endisset
                    </p>
                    <hr>
                    <p class="text-center">
                        @isset($student){{ !is_null($student->roll_no) ? $student->roll_no : '#roll-no'}}@endisset
                    </p>
                    <hr>
                    <p class="text-center">
                        
                        @isset($student){{ !is_null($student->cnic) ? $student->cnic : '#cnic'}}@endisset
                    </p>
                    <hr>
                    <p class="text-center">
                        
                        @isset($student)0{{ !is_null($student->cell_no) ? $student->cell_no : '#mobile'}}@endisset
                    </p>
                    <hr>
                    <p class="text-center">
                        
                        @isset($student){{ !is_null($student->class_type) ? $student->class_type : '#on-campus/on-line'}}@endisset
                    </p>
                    <hr>
                    <p class="text-center">
                        
                        @isset($student){{ !is_null($student->batch_no) ? $student->batch->batch : '#batch'}}@endisset
                    </p>
                    <hr>
                    <p class="text-center">
                        
                        @isset($student){{ !is_null($student->created_at->format('d/m/Y')) ? $student->created_at->format('d/m/Y') : '#admission-date'}}@endisset
                    </p>
                    <hr>
                    <p class="text-center">
                        Fee Status: 
                        @isset($student)
                            @if(((($student->total_fee) - ($student->discount)) - ($student->total_paid)) == 0)
                                <span class="bg-success p-2 rounded text-white">Clear</span>
                            @else 
                                <span class="bg-danger p-2 rounded text-white">Not Clear</span>
                            @endif
                        @endisset
                    </p>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                </div>
                <div class="card-body pt-0 pb-2">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="personal-info-tab" data-bs-toggle="tab" data-bs-target="#personal-info"
                                type="button" role="tab" aria-controls="personal-info" aria-selected="true">Personal Info</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="subjects-tab" data-bs-toggle="tab" data-bs-target="#subjects"
                                type="button" role="tab" aria-controls="subjects"
                                aria-selected="false">Subjects</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="fees-tab" data-bs-toggle="tab" data-bs-target="#fees"
                                type="button" role="tab" aria-controls="fees"
                                aria-selected="false">Fees</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="lectures-tab" data-bs-toggle="tab" data-bs-target="#lectures"
                                type="button" role="tab" aria-controls="lectures"
                                aria-selected="false">Lectures</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="results-tab" data-bs-toggle="tab" data-bs-target="#results"
                                type="button" role="tab" aria-controls="results"
                                aria-selected="false">Results</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
                            Personal Info
                        </div>
                        <div class="tab-pane fade" id="subjects" role="tabpanel" aria-labelledby="subjects-tab">
                            <div class="row my-2">
                                <h6>Compulsory Subjects</h6>
                                <hr>
                                @foreach ($compulsorySubjects as $cSubject)
                                    <p><span  class="@isset($student) @if(in_array($cSubject->id, json_decode($student->selected_subjects))) text-dark @else text-light @endif @endisset">{{$cSubject->name}}</span><span style="float: right">{{$cSubject->marks}} marks</span></p>
                                @endforeach
                                <h6>Optional Subjects</h6>
                                <hr>
                                @foreach ($optionalSubjects as $oSubject)
                                    <p><span  class="@isset($student) @if(in_array($oSubject->id, json_decode($student->selected_subjects))) text-dark @else text-light @endif @endisset">{{$oSubject->name}}</span><span style="float: right">{{$oSubject->marks}} marks</span></p>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="fees" role="tabpanel" aria-labelledby="fees-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <th class="text-center">Challan#</th>
                                        <th class="text-center">Installments</th>
                                        <th class="text-center">Payable</th>
                                        <th class="text-center">Paid</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Payment Mode</th>
                                    </thead>
                                    <tbody>
                                        @php $paid = 0; @endphp
                                        @foreach ($student->fee_plan as $student_fee)
                                            <tr>
                                                <td class="text-center">{{$student->challan_number}}</td>
                                                <td class="text-center">{{$student_fee->installment}}</td>
                                                <td class="text-center">{{$student_fee->total_fee}}</td>
                                                <td class="text-center">{{$student_fee->paid}}</td>
                                                <td class="text-center">
                                                    Due Date: {{$student_fee->due_date}}
                                                    <br>
                                                    Paid Date: {{$student_fee->created_at->format('Y-m-d')}}
                                                </td>
                                                <td class="text-center">
                                                    @php
                                                        $paid += $student_fee->paid;
                                                    @endphp
                                                    @if ($paid == 0)
                                                        <span class="text-white bg-danger p-2">UNPAID</span>
                                                    @endif
                                                    @if ($paid < $student_fee->total_fee && $paid > 0)
                                                        <span class="text-white bg-primary p-2">PARTIALLY PAID</span>
                                                    @endif
                                                    @if ($paid >= $student_fee->total_fee)
                                                        <span class="text-white bg-success p-2">FULLY PAID</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{$student_fee->payment_transfer_mode}}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-center font-weight-bold" colspan="2">Total Paid</td>
                                            <td class="text-center font-weight-bold"></td>
                                            <td class="text-center font-weight-bold">{{$paid}}</td>
                                            <td colspan="3"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center font-weight-bold" colspan="2">Remaining</td>
                                            <td class="text-center font-weight-bold"></td>
                                            <td class="text-center font-weight-bold">{{$student->total_fee-$paid}}</td>
                                            <td colspan="3"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="lectures" role="tabpanel" aria-labelledby="lectures-tab">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 bg-white border border-light text-primary my-2 py-1" style="border-radius: 5px">
                                <div class="row p-1">
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        English Essay
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        Muhammad Shahnawaz Khan
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        30/09/2022
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        <span class="border border-danger p-1 text-danger">Up Comming</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 bg-white border border-light text-primary my-2 py-1" style="border-radius: 5px">
                                <div class="row p-1">
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        English Essay
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        Muhammad Shahnawaz Khan
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        30/09/2022
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        <span class="border border-danger p-1 text-danger">Up Comming</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 bg-white border border-light text-primary my-2 py-1" style="border-radius: 5px">
                                <div class="row p-1">
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        English Essay
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        Muhammad Shahnawaz Khan
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        30/09/2022
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        <span class="border border-danger p-1 text-danger">Up Comming</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 bg-white border border-light text-primary my-2 py-1" style="border-radius: 5px">
                                <div class="row p-1">
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        English Essay
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        Muhammad Shahnawaz Khan
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        30/09/2022
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        <span class="border border-danger p-1 text-danger">Up Comming</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 bg-white border border-light text-primary my-2 py-1" style="border-radius: 5px">
                                <div class="row p-1">
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        English Essay
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        Muhammad Shahnawaz Khan
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        30/09/2022
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        <span class="border border-success p-1 text-success">Completed</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 bg-white border border-light text-primary my-2 py-1" style="border-radius: 5px">
                                <div class="row p-1">
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        English Essay
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        Muhammad Shahnawaz Khan
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        30/09/2022
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        <span class="border border-danger p-1 text-danger">Up Comming</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 bg-white border border-light text-primary my-2 py-1" style="border-radius: 5px">
                                <div class="row p-1">
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        English Essay
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        Muhammad Shahnawaz Khan
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        30/09/2022
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                        <span class="border border-success p-1 text-success">Completed</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="results" role="tabpanel" aria-labelledby="results-tab">
                            <div class="row my-2">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 my-3">
                                    <div class="card">
                                        <div class="card-header">
                                            Assignment# 1
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Current Affairs</h5>
                                            <p class="card-text">Content</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 my-3">
                                    <div class="card">
                                        <div class="card-header">
                                            Assignment# 2
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Precis & Composition</h5>
                                            <p class="card-text">Content</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 my-3">
                                    <div class="card">
                                        <div class="card-header">
                                            Assignment# 3
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">English Essay</h5>
                                            <p class="card-text">Content</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 my-3">
                                    <div class="card">
                                        <div class="card-header">
                                            Assignment# 4
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Pakistan Affairs</h5>
                                            <p class="card-text">Content</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_js')
<!-- Scripting Here -->
<!-- Scripting Here -->
@endsection
