<div class="row">
    <div class="col-6">
        <div class="text-danger text-sm">Mandatory(*)</div>
    </div>
    <div class="col-6">
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
    </div>
</div>
<hr class="horizontal dark">
<p class="text-uppercase text-sm">Student Profile</p>
<div class="row">
    @if (Auth::user()->hasRole('admin'))
    <!------------------------------------------------------------------------------------------------------------------------------------>
    <!---------------------------------------------------------- Admin Starts ------------------------------------------------------------>
    <!------------------------------------------------------------------------------------------------------------------------------------>
    <div class="admin-form row">
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="name" class="form-control-label">Name *</label>
                <input class="form-control name" id="name"
                    name="name" type="text"
                    value="@isset($student->user){{$student->user->name}}@endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Student Name">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="email" class="form-control-label">Email *</label>
                <input class="form-control email" id="email"
                    name="email" type="email"
                    value="@isset($student->user) {{ $student->user->email }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Email Address">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="gender" class="form-control-label">Gender *</label>
                <select class="form-control gender" name="gender"
                    id="gender">
                    <option value="" disabled selected>Select Gender</option>
                    <option value="M" @isset($student->user) @if($student->user->gender == 'M') selected @endisset @endisset>Male</option>
                    <option value="F" @isset($student->user) @if($student->user->gender == 'F') selected @endisset @endisset>Female</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="contact_no" class="form-control-label">Contact No *</label>
                <input class="form-control contact_no" id="contact_no"
                    name="contact_no" type="number"
                    value="@isset($student->user)0{{$student->contact_res}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Contact No">
            </div>
        </div>
        {{-- <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="batch" class="form-control-label">Batch *</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control batch" id="batch"
                    name="batch" type="text"
                    value="@isset($student->user) {{ $student->batch }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Batch">
            </div>
        </div> --}}
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="css_pms_yr" class="form-control-label">CSS/PMS Year *</label>
                <select @if (Auth::user()->hasRole('student')) readonly @endif class="form-control css-pms-yr" name="year"
                    id="css-pms-yr">
                    <option value="" selected>Select CSS/PMS Year</option>
                    @foreach ($registeredYears as $year)
                        <option value="{{$year->id}}" @isset($student) @if($student->year == $year->id) selected @endisset @endisset>{{$year->registered_year}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="batch_no" class="form-control-label">Batch No *</label>
                <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control batch_no" name="batch_no"
                    id="batch-no">
                    @php
                        $batches = \App\Models\RegisteredBatch::where('registered_year_id', $student->year)->get();
                    @endphp
                    <option value="" disabled selected>Select Batch No</option>
                    @foreach ($batches as $batch)
                        <option value="{{$batch->id}}" @isset($student) @if($student->batch_no == $batch->id) selected @endif @endisset>{{$batch->batch}}</option>
                    @endforeach
                    {{-- <option value="80" @isset($student) @if($student->batch_no == '80') selected @endisset @endisset>80</option>
                    <option value="81" @isset($student) @if($student->batch_no == '81') selected @endisset @endisset>81</option>
                    <option value="82" @isset($student) @if($student->batch_no == '82') selected @endisset @endisset>82</option>
                    <option value="83" @isset($student) @if($student->batch_no == '83') selected @endisset @endisset>83</option>
                    <option value="84" @isset($student) @if($student->batch_no == '84') selected @endisset @endisset>84</option>
                    <option value="85" @isset($student) @if($student->batch_no == '85') selected @endisset @endisset>85</option> --}}
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="reg_no" class="form-control-label">Reg No *</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control reg_no" id="reg-no"
                    name="reg_no" type="text"
                    value="@isset($student->user){{$student->reg_no }}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Registration No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="roll_no" class="form-control-label">Roll No *</label>
                <input type="hidden" id="reg-no1" value="">
                <input type="hidden" id="reg-no2" value="">
                <input type="hidden" id="reg-no3" value="">
                <input readonly class="form-control roll_no" id="roll-no"
                    name="roll_no" type="text"
                    value="@isset($student->user){{$student->roll_no}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="class-type" class="form-control-label">Campus/Online *</label>
                <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control class-type" name="class_type"
                    id="class-type">
                    <option value="" disabled selected>Select Campus/Online</option>
                    <option value="campus" @isset($student) @if($student->class_type == 'campus') selected @endisset @endisset>On Campus</option>
                    <option value="online" @isset($student) @if($student->class_type == 'online') selected @endisset @endisset>Online</option>
                </select>
            </div>
        </div>
        <hr class="horizontal dark">
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="applied_for" class="form-control-label">Applying For *</label>
                <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control applied_for"
                    name="applied_for" id="applied_for">
                    <option value="" selected>Applying For</option>
                    <option value="written" @isset($student) @if($student->applied_for == 'written') selected @endisset @endisset>Written Exam</option>
                    <option value="interview" @isset($student) @if($student->applied_for == 'interview') selected @endisset @endisset>Interview</option>
                </select>
            </div>
        </div>
        <div class="col-md-3 @if(is_null($student->written_exam_type)) d-none @endif" id="written-exam-type">
            <div class="form-group mb-3">
                <label for="applied_for" class="form-control-label">Written Exam Type *</label>
                <input type="text" name="written_exam_type" class="form-control" placeholder="English Essay, Compulsory etc" value="{{$student->written_exam_type}}">
            </div>
        </div>
        <div class="col-md-3 @if(is_null($student->interview_type)) d-none @endif" id="interview-type">
            <div class="form-group mb-3">
                <label for="interview-type" class="form-control-label">Interview Type *</label>
                <input type="text" name="interview_type" class="form-control interview_type" placeholder="Class, Mock type etc" value="{{$student->interview_type}}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="examination_type" class="form-control-label">Examination *</label>
                <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control examination_type"
                    name="examination_type" id="examination_type">
                    <option value="" selected>Select Exam type</option>
                    <option value="1" @isset($student) @if($student->examination_type == '1') selected @endisset @endisset>Mock Exam</option>
                    <option value="2" @isset($student) @if($student->examination_type == '2') selected @endisset @endisset>Test Series</option>
                    <option value="3" @isset($student) @if($student->examination_type == '3') selected @endisset @endisset>Evaluation</option>
                </select>
            </div>
        </div>
        <hr class="horizontal dark">
        <!-- Fee Type -->
        <div class="col-md-2">
            <div class="custom-control checkbox mb-3">
                <label class="custom-control-label m-0 p-0" for="fee-type-all">ALL</label>
                <br>
                <input @if (Auth::user()->hasRole('student')) disabled @endif name="fee_type"
                    class="custom-control-input fee-type-all fee_type" value="all" id="fee-type-all" data-fee="80000" type="radio" @isset($student) @if($student->fee_type == 'all') checked @endisset @endisset>
                <br>
                <small class="mt-0 fee-font">fee 80,000/-</small>
            </div>
        </div>
        <div class="col-md-2">
            <div class="custom-control checkbox mb-3">
                <label class="custom-control-label m-0 p-0" for="fee-type-compulsory">Compulsory</label>
                <br>
                <input @if (Auth::user()->hasRole('student')) disabled @endif name="fee_type"
                    class="custom-control-input fee-type-compulsory fee_type" value="compulsory" data-fee="55000" id="fee-type-compulsory" type="radio" @isset($student) @if($student->fee_type == 'compulsory') checked @endisset @endisset>
                <br>
                <small class="mt-0 fee-font">fee 55,000/-</small>
            </div>
        </div>
        <div class="col-md-2">
            <div class="custom-control checkbox mb-3">
                <label class="custom-control-label m-0 p-0" for="fee-type-custom">Custom</label>
                <br>
                <input @if (Auth::user()->hasRole('student')) disabled @endif name="fee_type"
                    class="custom-control-input fee-type-custom fee_type" value="custom" data-fee="0" id="fee-type-custom" type="radio" @isset($student) @if($student->fee_type == 'custom') checked @endisset @endisset>
                <br>
                <small class="mt-0 fee-font">Refer to pick All subjects</small>
            </div>
        </div>
        <div class="col-md-2">
            <div class="custom-control custom-radio mb-3">
                <label class="custom-control-label m-0 p-0" for="mock-exam">Mock Exams</label>
                <br>
                <input @if (Auth::user()->hasRole('student')) disabled @endif name="fee_type"
                    class="custom-control-input exam-mock fee_type" value="mock" data-fee="0" id="mock-exam" type="radio" @isset($student) @if($student->fee_type == 'mock') checked @endisset @endisset>
            </div>
        </div>
        <div class="col-md-2">
            <div class="custom-control custom-radio mb-3">
                <label class="custom-control-label m-0 p-0" for="evaluation">Evaluation</label>
                <br>
                <input @if (Auth::user()->hasRole('student')) disabled @endif name="fee_type"
                    class="custom-control-input evaluation fee_type" value="evaluation" data-fee="0" id="evaluation" type="radio" @isset($student) @if($student->fee_type == 'evaluation') checked @endisset @endisset>
            </div>
        </div>
        <div class="col-md-2">
            <div class="custom-control custom-radio mb-3">
                <label class="custom-control-label m-0 p-0" for="interview">Interview</label>
                <br>
                <input @if (Auth::user()->hasRole('student')) disabled @endif name="fee_type"
                    class="custom-control-input interview fee_type" value="interview" data-fee="0" id="interview" type="radio" @isset($student) @if($student->fee_type == 'interview') checked @endisset @endisset>
            </div>
        </div>

        <hr class="horizontal dark">

        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="installment" class="form-control-label">Installment *</label>
                <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control installment"
                    name="installment" id="installment">
                    <option value="" disabled selected>Installment</option>
                    <option value="first" @isset($student) @if($student->installment == 'first') selected @endisset @endisset>1st</option>
                    <option value="second" @isset($student) @if($student->installment == 'second') selected @endisset @endisset>2nd</option>
                    <option value="third" @isset($student) @if($student->installment == 'third') selected @endisset @endisset>3rd</option>
                    <option value="fourth" @isset($student) @if($student->installment == 'fourth') selected @endisset @endisset>4th</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="total-fee" class="form-control-label">Total Fee *</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control total-fee" id="total-fee"
                    name="total_fee" type="number"
                    value="@isset($student){{$student->total_fee}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Total Fee" required minlength="4" min="1000">
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="discount" class="form-control-label">Discount *</label>
                <input type="text" name="discount" id="discount" @if (Auth::user()->hasRole('student')) readonly @endif class="form-control" value="@isset($student){{$student->discount}}@endisset" placeholder="Enter Amount of Discount">
            </div>
        </div>
        {{-- <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="discount" class="form-control-label">Discount *</label>
                <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control discount" name="discount"
                    id="discount">
                    <option value="0" selected>Discount</option>
                    <option value="2.5" @isset($student) @if($student->discount == '2.5') selected @endisset @endisset>2.5%</option>
                    <option value="5.0" @isset($student) @if($student->discount == '5.0') selected @endisset @endisset>5.0%</option>
                    <option value="7.5" @isset($student) @if($student->discount == '7.5') selected @endisset @endisset>7.5%</option>
                    <option value="10" @isset($student) @if($student->discount == '10') selected @endisset @endisset>10.0%</option>
                    <option value="100" @isset($student) @if($student->discount == '100') selected @endisset @endisset>100.0%</option>
                </select>
            </div>
        </div> --}}
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="discount-reason" class="form-control-label">Discount Reason *</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control discount-reason" id="discount-reason"
                    name="discount_reason" type="text"
                    value="@isset($student){{$student->discount_reason}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Discount Reason" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="paid-fee" class="form-control-label">Total Paid Fee * <small>(Total paid till now)</small></label>
                <input disabled class="form-control" type="text"
                    value="@isset($student){{$student->total_paid}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Total paid till now" required minlength="4" min="1000">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="remaining-amount" class="form-control-label">Remaining *</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control remaining-amount" id="remaining-amount" type="text"
                    value="@isset($student){{($student->total_fee - $student->discount) - $student->total_paid}}@endisset"
                    readonly onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Discount Reason" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="paid-fee" class="form-control-label">Paying Fee * <small>(Currently paying fee)</small></label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control paid-fee" id="paid-fee"
                    name="paid" type="number"
                    value="0"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter current paying fee" required minlength="0" min="0">
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="due_date" class="form-control-label">Due Date *</label>
                <input @if (Auth::user()->hasRole('student')) disabled @endif class="form-control date" id="due_date"
                    name="due_date" type="date"
                    value="@isset($student){{$student->due_date}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="freeze" class="form-control-label">Freeze *</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control freeze" id="freeze"
                    name="freeze" type="date"
                    value="@isset($student->user){{$student->freeze}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="leave" class="form-control-label">Leave *</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control leave" id="leave"
                    name="leave" type="date"
                    value="@isset($student->user){{$student->leave}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label class="custom-control-label m-0 p-0" for="fee-refund">Fee Refund (50% only)</label>
                <br>
                <input @if (Auth::user()->hasRole('student')) readonly @endif name="fee_refund"
                    class="custom-control-input fee-refund" value="1" id="fee-refund" type="checkbox" @isset($student) @if($student->fee_refund == '1') checked @endisset @endisset>
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label class="custom-control-label m-0 p-0" for="send-fee-notification">Send Fee Notification</label>
                <br>
                <input @if (Auth::user()->hasRole('student')) disabled @endif name="notification_sent"
                    class="custom-control-input send-fee-notification" value="1" id="send-fee-notification" type="checkbox" @isset($student) @if($student->notification_sent == '1') checked @endisset @endisset>
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="generate-challan" class="form-control-label">Challan Number *</label>
                <input type="text" class="generate-challan form-control" id="generate-challan" name="challan_number" placeholder="Enter Challan Number" value="@isset($student){{$student->challan_number}}@endisset" required>
                {{-- <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control generate-challan" name="challan_generated"
                    id="generate-challan">
                    <option value="" selected>Select Challan</option>
                    <option value="2.5" @isset($student) @if($student->challan_generated == '2.5') selected @endisset @endisset>2.5%</option>
                    <option value="5.0" @isset($student) @if($student->challan_generated == '5.0') selected @endisset @endisset>5.0%</option>
                    <option value="7.5" @isset($student) @if($student->challan_generated == '7.5') selected @endisset @endisset>7.5%</option>
                    <option value="10" @isset($student) @if($student->challan_generated == '10') selected @endisset @endisset>10.0%</option>
                    <option value="100" @isset($student) @if($student->challan_generated == '100') selected @endisset @endisset>100.0%</option>
                </select> --}}
                {{-- <button type="button" class="btn btn-primary generate-challan w-100" value="1" id="generate-challan" name="challan_generated">Generate Challan</button> --}}
                {{-- <br />
                <input type="checkbox" name="challan_generated" id="generate-challan" class="generate-challan mx-2" value="1"> --}}
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="payment-transfer-mode" class="form-control-label">Payment Transfer Mode *</label>
                <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control payment-transfer-mode" name="payment_transfer_mode"
                    id="payment-transfer-mode" required>
                    <option value="" selected>Select Payment Mode</option>
                    <option value="cheque" @if($student->payment_transfer_mode == 'cheque') selected @endif>Cheque</option>
                    <option value="bank" @if($student->payment_transfer_mode == 'bank') selected @endif>Bank</option>
                    <option value="easypaisa" @if($student->payment_transfer_mode == 'easypaisa') selected @endif>Easy Paisa</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="fee_submit_date" class="form-control-label">Date *</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control fee_submit_date" id="fee_submit_date"
                    name="fee_submit_date" type="date"
                    value="@isset($student->user){{$student->fee_submit_date}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
        </div>
    </div>
    <!------------------------------------------------------------------------------------------------------------------------------------>
    <!---------------------------------------------------------- Admin Ends -------------------------------------------------------------->
    <!------------------------------------------------------------------------------------------------------------------------------------>
    @endif
</div>
<hr class="horizontal dark">
