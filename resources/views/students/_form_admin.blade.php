<div class="row">
    @php
        $sterik = '<span class="text-danger">*</span>';
    @endphp
	<div class="col-4">
		<div class="text-danger text-sm">Mandatory({!!$sterik!!})</div>
	</div>
	<div class="col-5">
		<div class="alert-messages w-50 ms-auto text-center">
			<div class="toast bg-success" id="notification" role="alert" aria-live="assertive" aria-atomic="true">
				<div class="toast-header text-bold text-white py-0 bg-success border-bottom border-white"> <span class="success-header"></span>
					<div class="close-toast-msg ms-auto text-end cursor-pointer"> X </div>
				</div>
				<div class="toast-body text-white text-bold"></div>
			</div>
		</div>
	</div>
	<div class="col-3">
		<label for="batch_starting_date" class="form-control-label">Batch Starting Date {!!$sterik!!}</label>
		<input @if (Auth::user()->hasRole('student')) disabled @endif class="form-control batch_starting_date" id="batch_starting_date" name="batch_starting_date" type="date" value="@isset($student){{ $student->batch_starting_date }}@endisset" onfocus="focused(this)" onfocusout="defocused(this)" required> </div>
</div>
<hr class="horizontal dark">
<p class="text-uppercase text-sm">Student Profile</p>
<div class="row"> 
    @if (Auth::user()->hasRole('admin'))
	<!------------------------------------------------------------------------------------------------------------------------------------>
	<!---------------------------------------------------------- Admin Starts ------------------------------------------------------------>
	<!------------------------------------------------------------------------------------------------------------------------------------>
	<div class="admin-form row m-0 p-0">
        <!-- Name -->
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="name" class="form-control-label">Name {!!$sterik!!}</label>
                <input class="form-control name" id="name"
                    name="name" type="text"
                    value="@isset($student->user){{$student->user->name}}@endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Student Name" required>
            </div>
        </div>
        <!-- Cell No -->
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="cell-no" class="form-control-label">Cell No {!!$sterik!!}</label>
                <input class="form-control cell-no" id="cell-no"
                    name="cell_no" type="number"
                    value="@isset($student)0{{$student->cell_no}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Cell No" required>
            </div>
        </div>
        <!-- Gender -->
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="gender" class="form-control-label">Gender {!!$sterik!!}</label>
                <select class="form-control gender" name="gender"
                    id="gender" required>
                    <option value="" selected>Select Gender</option>
                    <option value="M" @isset($student->user) @if($student->user->gender == 'M') selected @endisset @endisset>Male</option>
                    <option value="F" @isset($student->user) @if($student->user->gender == 'F') selected @endisset @endisset>Female</option>
                </select>
            </div>
        </div>
        <!-- CSS/PMS Year -->
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="css-pms-yr" class="form-control-label">CSS/PMS Year {!!$sterik!!}</label>
                <select @if (Auth::user()->hasRole('student')) readonly @endif class="form-control css-pms-yr" name="year"
                    id="css-pms-yr" required>
                    <option value="" selected>Select CSS/PMS Year</option>
                    @foreach ($registeredYears as $year)
                        <option value="{{$year->id}}" @isset($student) @if($student->year == $year->id) selected @endisset @endisset>{{$year->registered_year}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- Batch No -->
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="batch-no" class="form-control-label">Batch No {!!$sterik!!}</label>
                @php
					$batches = [];
					if (isset($student)) {
                    	$batches = \App\Models\RegisteredBatch::where('registered_year_id', $student->year)->get();
					}
                @endphp
                <select @if (Auth::user()->hasRole('student')) readonly @endif class="form-control batch-no" name="batch_no"
                    id="batch-no" required>
                    <option value="" selected>Select Batch No</option>
                    @foreach ($batches as $batch)
                        <option value="{{$batch->id}}" @isset($batch) @if($batch->id == $student->batch_no) selected @endif @endisset>{{$batch->batch}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- Reg No -->
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="reg-no" class="form-control-label">Reg No {!!$sterik!!}</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control reg-no" id="reg-no"
                    name="reg_no" type="text"
                    value="@isset($student->user){{$student->reg_no}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Registration No" required>
            </div>
        </div>
        <!-- Roll No -->
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="roll_no" class="form-control-label">Roll No {!!$sterik!!}</label>
                <input type="hidden" id="reg-no1" value="">
                <input type="hidden" id="reg-no2" value="">
                <input type="hidden" id="reg-no3" value="">
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control roll_no" readonly id="roll-no"
                    name="roll_no" type="text"
                    value="@isset($student){{$student->roll_no}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" required>
            </div>
        </div>
        <!-- Email -->
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="email" class="form-control-label">Email {!!$sterik!!}</label>
                <input class="form-control email" id="email"
                    name="email" type="email"
                    value="@isset($student->user){{$student->user->email}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Email Address" required>
            </div>
        </div>
        <!-- Campus/Online -->
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="class-type" class="form-control-label">Campus/Online {!!$sterik!!}</label>
                <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control class-type" name="class_type"
                    id="class-type" required>
                    <option value="" selected>Select Campus/Online</option>
                    <option value="campus" @isset($student) @if($student->class_type == 'campus') selected @endisset @endisset>On Campus</option>
                    <option value="online" @isset($student) @if($student->class_type == 'online') selected @endisset @endisset>Online</option>
                </select>
            </div>
        </div>
        <hr class="horizontal dark">
        <!-- Set Applying For -->
        <div class="col-md-3 set-applying-for">
            <div class="form-group mb-3">
                <label for="set-applyingFor" class="form-control-label">Applying For {!!$sterik!!}</label>
                <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control set-applyingFor"
                    name="applied_for" id="set-applyingFor">
                    <option value="" selected>Select Applying For</option>
                    <option value="written" @isset($student) @if($student->applied_for == 'written') selected @endisset @endisset>Written Exam</option>
                    <option value="interview" @isset($student) @if($student->applied_for == 'interview') selected @endisset @endisset>Interview</option>
                    <option value="examination" @isset($student) @if($student->applied_for == 'examination') selected @endisset @endisset>Examination Type</option>
                </select>
            </div>
        </div>
        <!-- Interview Type -->
        <div class="col-md-3 applying-for-type-interview">
            <div class="form-group mb-3">
                <label for="interview-type" class="form-control-label">Interview Type</label>
                <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control interview_type"
                    name="interview_type" id="interview_type">
                    <option value="" selected>Select Interview Type</option>
                    <option value="classes" @isset($student) @if($student->interview_type == 'classes') selected @endisset @endisset>Classes</option>
                    <option value="mock_interviews" @isset($student) @if($student->interview_type == 'mock_interviews') selected @endisset @endisset>Mock Interviews</option>
                </select>
            </div>
        </div>
        <!-- Examination Type -->
        <div class="col-md-3 applying-for-type-examination">
            <div class="form-group mb-3">
                <label for="examination_type" class="form-control-label">Examination</label>
                <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control examination_type"
                    name="examination_type" id="examination_type">
                    <option value="" selected>Select Exam type</option>
                    <option value="mock_exam" @isset($student) @if($student->examination_type == 'mock_exam') selected @endisset @endisset>Mock Exam</option>
                    <option value="test_series" @isset($student) @if($student->examination_type == 'test_series') selected @endisset @endisset>Test Series</option>
                    <option value="evaluation" @isset($student) @if($student->examination_type == 'evaluation') selected @endisset @endisset>Evaluation</option>
                </select>
            </div>
        </div>
        <!-- Offset -->
        <div class="offset-3">
        </div>
        <!-- Subject Type -->
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="subject-type" class="form-control-label">Subject Type</label>
                <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control set-subject-type"
                    name="subject_type" id="subject-type">
                    <option value="" selected>Select Subject Type</option>
                    <option value="all" @isset($student) @if($student->subject_type == 'all') selected @endisset @endisset>ALL</option>
                    <option value="compulsory" @isset($student) @if($student->subject_type == 'compulsory') selected @endisset @endisset>Compulsory</option>
                    <option value="selected" @isset($student) @if($student->subject_type == 'selected') selected @endisset @endisset>Selected</option>
                </select>
            </div>
        </div>
        <!-- Subject Selection -->
        <div class="col-md-9 mb-3">
            <label for="subjects-list">Select Subject</label>
            <div class="subjects-list border border-default rounded" style="max-height: 320px; overflow: auto;">

                <div id="all-subjects-view-list" class="@isset($student) @else d-none @endisset">
                    <span class="px-2 my-0">
                        <input type="checkbox" name="selected_subjects[]"> All Subjects 1
                    </span>
                    <span class="px-2 my-0">
                        <input type="checkbox" name="selected_subjects[]"> All Subjects 2
                    </span>
                    <span class="px-2 my-0">
                        <input type="checkbox" name="selected_subjects[]"> All Subjects 3
                    </span>
                    <span class="px-2 my-0">
                        <input type="checkbox" name="selected_subjects[]"> All Subjects 4
                    </span>
                </div>
                <div id="compulsory-subjects-view-list" class="@isset($student) @else d-none @endisset">
                    <span class="px-2 my-0">
                        <input type="checkbox" name="selected_subjects[]"> Compulsory Subjects 1
                    </span>
                    <span class="px-2 my-0">
                        <input type="checkbox" name="selected_subjects[]"> Compulsory Subjects 2
                    </span>
                    <span class="px-2 my-0">
                        <input type="checkbox" name="selected_subjects[]"> Compulsory Subjects 3
                    </span>
                    <span class="px-2 my-0">
                        <input type="checkbox" name="selected_subjects[]"> Compulsory Subjects 4
                    </span>
                </div>
            </div>
        </div>
        <hr class="horizontal dark">
        <!-- Installment -->
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="installment" class="form-control-label">Installment</label>
                <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control installment"
                    name="installment" id="installment">
                    <option value="" selected>Installment</option>
                    <option value="first" @isset($student) @if($student->installment == 'first') selected @endisset @endisset>1st</option>
                    <option value="second" @isset($student) @if($student->installment == 'second') selected @endisset @endisset>2nd</option>
                    <option value="third" @isset($student) @if($student->installment == 'third') selected @endisset @endisset>3rd</option>
                </select>
            </div>
        </div>
        <!-- Discount -->
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="discount" class="form-control-label">Discount</label>
                <input type="text" name="discount" id="discount" @if (Auth::user()->hasRole('student')) readonly @endif class="form-control" value="@isset($student){{$student->discount}}@endisset" placeholder="Enter Amount of Discount">
            </div>
        </div>
        <!-- Discount Reason -->
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="discount-reason" class="form-control-label">Discount Reason</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control discount-reason" id="discount-reason"
                    name="discount_reason" type="text"
                    value="@isset($student){{$student->discount_reason}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Discount Reason">
            </div>
        </div>
        <!-- Total Paid Fee -->
		<div class="col-md-3">
			<div class="form-group mb-3">
				<label for="paid-fee" class="form-control-label">Total Paid Fee <small>(Total paid till now)</small> </label>
				<input disabled class="form-control" type="text" value="@isset($student){{ $student->total_paid }}@endisset" onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Total paid till now" minlength="4" min="1000"> </div>
		</div>
        <!-- Total Fee -->
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="total-fee" class="form-control-label">Total Fee {!!$sterik!!}</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control total-fee" id="total-fee"
                    name="total_fee" type="number"
                    value="@isset($student){{$student->total_fee}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Total Fee" required>
            </div>
        </div>
        <!-- Paying Fee -->
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="paying-fee" class="form-control-label">Paying Fee (Currently paying fee) {!!$sterik!!}</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control paying-fee" id="paying-fee"
                    name="paid" type="number"
                    value="0"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="" required minlength="0" min="0">
            </div>
        </div>
        <!-- Remaining -->
		<div class="col-md-3">
			<div class="form-group mb-3">
				<label for="remaining-amount" class="form-control-label">Remaining Dues</label>
				<input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control remaining-amount" id="remaining-amount" type="text" value="@isset($student){{ $student->total_fee - $student->discount - $student->total_paid }}@endisset" readonly onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Discount Reason"> </div>
		</div>
        <!-- Due Date -->
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="due_date" class="form-control-label">Due Date {!!$sterik!!}</label>
                <input @if (Auth::user()->hasRole('student')) disabled @endif class="form-control due_date" id="due_date"
                    name="due_date" type="date"
                    value="@isset($student){{$student->due_date}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" required>
            </div>
        </div>
        <!-- Freeze -->
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="freeze" class="form-control-label">Freeze (After full payment)</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control freeze" id="freeze"
                    name="freeze" type="date"
                    value="@isset($student){{$student->freeze}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
        </div>
        <!-- Left -->
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="left" class="form-control-label">Left</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control left" id="left"
                    name="left" type="date"
                    value="@isset($student){{$student->left}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
        </div>
        <!-- Payment Transfer Mode -->
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="payment-transfer-mode" class="form-control-label">Payment Transfer Mode {!!$sterik!!}</label>
                <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control payment-transfer-mode" name="payment_transfer_mode"
                    id="payment-transfer-mode" required>
                    <option value="" selected>Select Payment Mode</option>
                    <option value="cash" @isset($student) @if ($student->payment_transfer_mode == "cash") selected @else @endif @endisset>Cash</option>
                    <option value="bank" @isset($student) @if ($student->payment_transfer_mode == "bank") selected @else @endif @endisset>Bank</option>
                    <option value="easypaisa" @isset($student) @if ($student->payment_transfer_mode == "easypaisa") selected @else @endif @endisset>Easy Paisa</option>
                </select>
            </div>
        </div>
        <!-- Payment Date -->
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="fee_submit_date" class="form-control-label">Payment Date {!!$sterik!!}</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control fee_submit_date" id="fee_submit_date"
                    name="fee_submit_date" type="date"
                    value="@isset($student){{$student->fee_submit_date}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" required>
            </div>
        </div>
        <!-- Generate Challan -->
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="generate-challan" class="form-control-label">Generate Challan {!!$sterik!!}</label>
                <br />
                <input @isset($student) @if($student->challan_generated == '1') checked @endif @endisset type="checkbox" name="challan_generated" id="generate-challan" class="generate-challan mx-2" value="1" required>
            </div>
        </div>
        <!-- Challan Number -->
        <div class="col-md-3">
            <div class="custom-control custom-radio">
                <label for="challan_number" class="form-control-label">Challan Number</label>
                <br />
                <input readonly type="text" name="challan_number" id="challan_number" class="challan_number form-control" value="@isset($student){{$student->challan_number}}@endisset">
            </div>
        </div>
        <!-- Receipt Number -->
        <div class="col-md-3">
            <div class="custom-control custom-radio">
                <label for="receipt_number" class="form-control-label">Receipt Number</label>
                <br />
                <input @isset($student) readonly @endisset type="text" name="receipt_number" id="receipt_number" class="receipt_number form-control" value="@isset($student){{$student->receipt_number}}@endisset" placeholder="Enter Receipt Number" required>
            </div>
        </div>
        <!-- Fee Refund -->
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label class="custom-control-label m-0 p-0" for="fee-refund">Fee Refund</label>
                <br>
                <input @if (Auth::user()->hasRole('student')) readonly @endif name="fee_refund"
                    class="custom-control-input fee-refund" value="refunded" id="fee-refund" type="checkbox" @isset($student) @if($student->fee_refund == '1') checked @endisset @endisset>
            </div>
        </div>
        <!-- Send Fee Notification -->
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label class="custom-control-label" for="send-fee-notification">Send Fee Notification {!!$sterik!!}</label>
                <br>
                <input @if (Auth::user()->hasRole('student')) disabled @endif name="notification_sent"
                    class="custom-control-input send-fee-notification mx-2" value="1" id="send-fee-notification" type="checkbox" @isset($student) @if($student->notification_sent == '1') checked @endisset @endisset required>
            </div>
        </div>
    </div>
	<!------------------------------------------------------------------------------------------------------------------------------------>
	<!---------------------------------------------------------- Admin Ends -------------------------------------------------------------->
	<!------------------------------------------------------------------------------------------------------------------------------------>
    @endif </div>
<hr class="horizontal dark">