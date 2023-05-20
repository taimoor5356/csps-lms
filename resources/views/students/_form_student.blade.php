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
    <div class="col-3">
        <label for="batch_starting_date" class="form-control-label">Batch Starting Date {!!$sterik!!}</label>
        <input @if (Auth::user()->hasRole('student')) disabled @endif class="form-control batch_starting_date" id="batch_starting_date"
            name="batch_starting_date" type="date" value="@isset($student){{ $student->batch_starting_date }}@endisset"
            onfocus="focused(this)" onfocusout="defocused(this)" required>
    </div>
</div>
<hr class="horizontal dark">
<p class="text-uppercase text-sm">Student Profile</p>
<div class="row">
    @if (Auth::user()->hasRole('admin'))
    <!-- Visitor Edit Form For Student Approval -->
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
        <!-- Contact No -->
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="contact-no" class="form-control-label">Contact No {!!$sterik!!}</label>
                <input class="form-control contact-no" id="contact-no"
                    name="contact_no" type="number"
                    value="@isset($student->user){{$student->cell_no}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Contact No" required>
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
                    $batches = \App\Models\RegisteredBatch::where('registered_year_id', $student->year)->get();
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
        <p>Applying For</p>
        <!-- Written Exam Type -->
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="applied_for" class="form-control-label">Written Exam Type {!!$sterik!!}</label>
                <input type="text" name="written_exam_type" class="form-control" placeholder="English Essay, Compulsory etc" required>
            </div>
        </div>
        <!-- Interview Type -->
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="interview-type" class="form-control-label">Interview Type {!!$sterik!!}</label>
                <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control interview_type"
                    name="interview_type" id="interview_type" required>
                    <option value="" selected>Select Interview Type</option>
                    <option value="classes" @isset($student) @if($student->interview_type == 'classes') selected @endisset @endisset>Classes</option>
                    <option value="mock_interviews" @isset($student) @if($student->interview_type == 'mock_interviews') selected @endisset @endisset>Mock Interviews</option>
                </select>
            </div>
        </div>
        <!-- Examination Type -->
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="examination_type" class="form-control-label">Examination {!!$sterik!!}</label>
                <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control examination_type"
                    name="examination_type" id="examination_type" required>
                    <option value="" selected>Select Exam type</option>
                    <option value="mock_exam" @isset($student) @if($student->examination_type == 'mock_exam') selected @endisset @endisset>Mock Exam</option>
                    <option value="test_series" @isset($student) @if($student->examination_type == 'test_series') selected @endisset @endisset>Test Series</option>
                    <option value="evaluation" @isset($student) @if($student->examination_type == 'evaluation') selected @endisset @endisset>Evaluation</option>
                </select>
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
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="" required minlength="4" min="1000">
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control paid-fee" id="paid-fee"
                    name="paid" type="hidden"
                    value="0" required minlength="4" min="1000">
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
                    value="@isset($student->user){{$student->user->freeze}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
        </div>
        <!-- Left -->
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="leave" class="form-control-label">Left</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control leave" id="leave"
                    name="leave" type="date"
                    value="@isset($student->user){{$student->user->leave}}@endisset"
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
                    <option value="cash">Cash</option>
                    <option value="bank">Bank</option>
                    <option value="easypaisa">Easy Paisa</option>
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
                <input type="checkbox" name="challan_generated" id="generate-challan" class="generate-challan mx-2" value="1" required>
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
                <label class="custom-control-label m-0 p-0" for="send-fee-notification">Send Fee Notification {!!$sterik!!}</label>
                <br>
                <input @if (Auth::user()->hasRole('student')) disabled @endif name="notification_sent"
                    class="custom-control-input send-fee-notification" value="1" id="send-fee-notification" type="checkbox" @isset($student) @if($student->notification_sent == '1') checked @endisset @endisset required>
            </div>
        </div>
    </div>
    <!------------------------------------------------------------------------------------------------------------------------------------>
    <!---------------------------------------------------------- Admin Ends -------------------------------------------------------------->
    <!------------------------------------------------------------------------------------------------------------------------------------>
    @endif
    @if (Auth::user()->hasRole('student'))
    <!------------------------------------------------------------------------------------------------------------------------------------>
    <!---------------------------------------------------------- Student Starts ---------------------------------------------------------->
    <!------------------------------------------------------------------------------------------------------------------------------------>
    <div class="student-form row">
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="name" class="form-control-label">Name {!!$sterik!!}</label>
                <input class="form-control name" id="name"
                    name="name" type="text"
                    value="@isset($student->user){{$student->user->name}}@endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Student Name">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="gender" class="form-control-label">Gender {!!$sterik!!}</label>
                <select class="form-control gender" name="gender"
                    id="gender">
                    <option value="" selected>Select Gender</option>
                    <option value="M" @isset($student->user)@if($student->user->gender == 'M') selected @endif @endisset>Male</option>
                    <option value="F" @isset($student->user)@if($student->user->gender == 'F') selected @endif @endisset>Female</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <label for="photo" class="form-control-label">Student Photograph {!!$sterik!!}</label>
            <input type="file" name="photo" onchange="document.getElementById('photo').src = window.URL.createObjectURL(this.files[0])" class="form-control">
            <div class="row img-preview">
                <div class="col-md-3 my-2">
                    <img class="rounded" src="@isset($student->user)@if($student->user->photo != ''){{asset('public/assets/img/students/'.$student->user->photo.'')}}@else{{asset('public/assets/img/students/user-profile.jpg')}}@endif @else{{asset('public/assets/img/students/user-profile.jpg')}}@endisset" alt="Profile Picture" id="photo" width="100" height="100">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <label for="challan" class="form-control-label">Fee Challan {!!$sterik!!}</label>
            <input type="file" name="challan" onchange="document.getElementById('challan').src = window.URL.createObjectURL(this.files[0])" class="form-control">
            <div class="row img-preview">
                <div class="col-md-3 my-2">
                    <img class="rounded border border-dark" src="@isset($student->user)@if($student->user->challan != ''){{asset('public/assets/img/students/challan.png')}}@else{{asset('public/assets/img/students/challan.png')}}@endif @else{{asset('public/assets/img/students/challan.png')}}@endisset" alt="Fee Challan" id="challan" width="100" height="100">
                </div>
            </div>
        </div>

        <hr class="horizontal dark">

        <div class="col-md-3">
            <div class="form-group">
                <label for="father_name" class="form-control-label">Father Name {!!$sterik!!}</label>
                <input class="form-control father_name" id="father_name" name="father_name" type="text"
                    value="@isset($student->user){{ $student->father_name }}@endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Father Name" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="dob" class="form-control-label">Date of Birth {!!$sterik!!}</label>
                <input class="form-control dob" id="dob" name="dob" type="date"
                    value="@isset($student->user){{ $student->dob }}@endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Date of Birth" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="roll_no" class="form-control-label">Roll No {!!$sterik!!}</label>
                <input readonly class="form-control roll_no" id="roll_no"
                    name="roll_no" type="text"
                    value="@isset($student->user){{$student->roll_no}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Registration No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="cnic" class="form-control-label">CNIC {!!$sterik!!}</label>
                <input @if (!Auth::user()->hasRole('student')) readonly @endif class="form-control cnic" id="cnic" name="cnic" step="1" type="number"
                    value="@isset($student->user){{ $student->cnic }}@endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="CNIC Number" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="father_occupation" class="form-control-label">Father's Occupation {!!$sterik!!}</label>
                <input class="form-control father_occupation" id="father_occupation" name="father_occupation" type="text"
                    value="@isset($student->user){{ $student->father_occupation }}@endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Father's Occupation" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="domicile" class="form-control-label">Domicile {!!$sterik!!}</label>
                <input class="form-control domicile" id="domicile" name="domicile" type="text"
                    value="@isset($student->user){{ $student->domicile }}@endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Domicile Name" >
            </div>
        </div>

        <hr class="horizontal dark">

        <div class="education-information">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="degree" class="form-control-label">Degree {!!$sterik!!}</label>
                        <input @if (Auth::user()->hasRole('student')) @endif class="form-control degree" id="degree"
                            name="degree" type="text"
                            value="@isset($student->user){{$student->degree}}@endisset"
                            onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Degree Name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="major_subjects" class="form-control-label">Major Subjects {!!$sterik!!}</label>
                        <input @if (Auth::user()->hasRole('student')) @endif class="form-control major_subjects"
                            id="major_subjects" name="major_subjects" type="text"
                            value="@isset($student->user){{$student->major_subjects}}@endisset"
                            onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Major Subject">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cgpa" class="form-control-label">CGPA/%age {!!$sterik!!}</label>
                        <input @if (Auth::user()->hasRole('student')) @endif class="form-control cgpa" id="cgpa"
                            name="cgpa" min="0.1" max="100.00" step="0.1" type="number"
                            value="@isset($student->user){{$student->cgpa}}@endisset" onfocus="focused(this)"
                            onfocusout="defocused(this)" placeholder="CGPA/%age">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="board_university" class="form-control-label">Board/University {!!$sterik!!}</label>
                        <input @if (Auth::user()->hasRole('student')) @endif class="form-control board_university"
                            id="board_university" name="board_university" type="text"
                            value="@isset($student->user){{$student->board_university}}@endisset"
                            onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Board/University">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="distinction" class="form-control-label">Profession {!!$sterik!!}</label>
                        <input @if (Auth::user()->hasRole('student')) @endif class="form-control distinction"
                            id="distinction" name="distinction" type="text"
                            value="@isset($student->user){{$student->distinction}}@endisset"
                            onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Profesion">
                    </div>
                </div>
            </div>
        </div>

        <hr class="horizontal dark my-3">

        <div class="col-md-3">
            <div class="form-group">
                <label for="address" class="form-control-label">Address {!!$sterik!!}</label>
                <input class="form-control address" id="address" name="address" type="text"
                    value="@isset($student->user){{ $student->address }}@endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Student Occupation" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="email" class="form-control-label">Email {!!$sterik!!}</label>
                <input class="form-control email" id="email"
                    name="email" type="email"
                    value="@isset($student->user){{$student->user->email}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Email Address">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="contact-no" class="form-control-label">Contact No {!!$sterik!!}</label>
                <input class="form-control contact-no" id="contact-no"
                    name="cell_no" type="number"
                    value="@isset($student)0{{$student->cell_no}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Contact No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="em-contact-no" class="form-control-label">Emergency Contact No {!!$sterik!!}</label>
                <input class="form-control em-contact-no" id="em-contact-no"
                    name="em_contact_no" type="number"
                    value="@isset($student->user){{$student->user->em_contact_no}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Emergency Contact No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="optional_subjects" class="form-control-label">Optional Subject {!!$sterik!!}</label>
                <select class="form-control optional_subjects" name="optional_subjects"
                    id="optional_subjects">
                    <option value="" selected>Select Subject</option>
                    <option value="1">Sub 1</option>
                    <option value="2">Sub 2</option>
                </select>
            </div>
        </div>
    </div>

    <hr class="horizontal dark my-3">
    
    <div class="row">
        <div class="col-md-6">
            <small>Rules and Regulation <input type="checkbox" name="rules_and_regulation" value="1"></small>
            <p style="font-size: 10px">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Alias eaque nesciunt facilis quisquam pariatur consectetur ad. Ipsam, minus culpa odit voluptatibus, voluptate rerum, cupiditate voluptates quos molestiae ullam vero hic.</p>
        </div>
        <div class="col-md-6">
            <small>Declaration <input type="checkbox" name="declaration" value="1"></small>
            <p style="font-size: 10px">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Alias eaque nesciunt facilis quisquam pariatur consectetur ad. Ipsam, minus culpa odit voluptatibus, voluptate rerum, cupiditate voluptates quos molestiae ullam vero hic.</p>
        </div>
    </div>
    <!------------------------------------------------------------------------------------------------------------------------------------>
    <!---------------------------------------------------------- Student Ends ------------------------------------------------------------>
    <!------------------------------------------------------------------------------------------------------------------------------------>
    @endif
</div>
<hr class="horizontal dark">
