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
    <div class="col-md-3">
        <div class="form-group mb-3">
            <label for="name" class="form-control-label">Name *</label>
            <input class="form-control name" id="name"
                name="name" type="text"
                value="@isset($student->user) {{ $student->user->name }} @endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter Student Name">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="father_name" class="form-control-label">Father Name *</label>
            <input class="form-control father_name" id="father_name" name="father_name" type="text"
                value="@isset($student->user){{ $student->father_name }}@endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter Student's Father Name" >
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-3">
            <label for="email" class="form-control-label">Email *</label>
            <input class="form-control email" id="email"
                name="email" type="email"
                value="@isset($student->user) {{ $student->user->email }} @endisset"
                onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter Email Address">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="password" class="form-control-label">Password *</label>
            <input class="form-control password" id="password" name="password" type="password"
                value="" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter Password" >
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="father_occupation" class="form-control-label">Father Occupation *</label>
            <input class="form-control father_occupation" id="father_occupation" name="father_occupation" type="text"
                value="@isset($student->user){{ $student->father_occupation }}@endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter Student's Father's Occupation" >
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="dob" class="form-control-label">Date of Birth *</label>
            <input class="form-control dob" id="dob" name="dob" type="date"
                value="@isset($student->user){{ $student->dob }}@endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter Date of Birth" >
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="cnic" class="form-control-label">CNIC *</label>
            <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control cnic" id="cnic" name="cnic" step="0.01" type="number"
                value="@isset($student->user){{ $student->cnic }}@endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter CNIC Number" >
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="domicile" class="form-control-label">Domicile *</label>
            <input class="form-control domicile" id="domicile" name="domicile" type="text"
                value="@isset($student->user){{ $student->domicile }}@endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter Domicile Name" >
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="student_occupation" class="form-control-label">Student Occupation *</label>
            <input class="form-control student_occupation" id="student_occupation" name="student_occupation" type="text"
                value="@isset($student->user){{ $student->student_occupation }}@endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter Student Occupation" >
        </div>
    </div>
    <div class="col-sm-3">
        <label for="photo" class="form-control-label">Profile Picture *</label>
        <input type="file" name="photo" onchange="document.getElementById('photo').src = window.URL.createObjectURL(this.files[0])" class="form-control">
        <div class="row img-preview">
            <div class="col-md-3 my-2">
                <img class="rounded" src="@isset($student->user)@if($student->user->photo != ''){{asset('public/assets/img/students/'.$student->user->photo.'')}}@else{{asset('public/assets/img/students/user-profile.jpg')}}@endif @else{{asset('public/assets/img/students/user-profile.jpg')}}@endisset" alt="Profile Picture" id="photo" width="100" height="100">
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-3">
            <label for="contact_no" class="form-control-label">Contact No *</label>
            <input class="form-control contact_no" id="contact_no"
                name="contact_no" type="number"
                value="@isset($student->user) {{ $student->user->contact_no }} @endisset"
                onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter Contact No">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-3">
            <label for="gender" class="form-control-label">Gender *</label>
            <select class="form-control gender" name="gender"
                id="gender">
                <option value="" disabled selected>Select Gender</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-3">
            <label for="reg_no" class="form-control-label">Reg No *</label>
            <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control reg_no" id="reg_no"
                name="reg_no" type="text"
                value="@isset($student->user) {{ $student->reg_no }} @endisset"
                onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter Registration No">
        </div>
    </div>
    {{-- <div class="col-md-3">
        <div class="form-group mb-3">
            <label for="batch" class="form-control-label">Batch *</label>
            <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control batch" id="batch"
                name="batch" type="text"
                value="@isset($student->user) {{ $student->batch }} @endisset"
                onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter Batch">
        </div>
    </div> --}}
    <div class="col-md-3">
        <div class="form-group mb-3">
            <label for="css_pms_yr" class="form-control-label">CSS/PMS Year *</label>
            <select @if (Auth::user()->hasRole('student')) readonly @endif class="form-control css_pms_yr" name="year"
                id="css_pms_yr">
                <option value="" disabled selected>Select CSS/PMS Year</option>
                <option value="css_2024">CSS 2024</option>
                <option value="pms_2024">PMS 2024</option>
                <option value="css_2025" disabled>CSS 2025</option>
                <option value="pms_2025" disabled>PMS 2025</option>
                <option value="css_2026" disabled>CSS 2026</option>
                <option value="pms_2026" disabled>PMS 2026</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-3">
            <label for="batch_no" class="form-control-label">Batch No *</label>
            <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control batch_no" name="batch_no"
                id="batch_no">
                <option value="" disabled selected>Select Batch No</option>
                <option value="80">80</option>
                <option value="81">81</option>
                <option value="82">82</option>
                <option value="83">83</option>
                <option value="84">84</option>
                <option value="85">85</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-3">
            <label for="class-type" class="form-control-label">Campus/Online *</label>
            <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control class-type" name="class_type"
                id="class-type">
                <option value="" disabled selected>Select Campus/Online</option>
                <option value="campus">Campus</option>
                <option value="online">Online</option>
            </select>
        </div>
    </div>
</div>
<hr class="horizontal dark">
<p class="text-uppercase text-sm">Registration Details</p>
<div class="row">
    <div class="col-md-3">
        <div class="form-group mb-3">
            <label for="applied_for" class="form-control-label">Applying For *</label>
            <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control applied_for"
                name="applied_for" id="applied_for">
                <option value="" disabled selected>Applying For</option>
                <option value="written">Written Exam</option>
                <option value="interview">Interview</option>
            </select>
        </div>
    </div>
    <!-- Fee Type -->
    <div class="col-md-3">
        <div class="custom-control checkbox mb-3">
            <label class="custom-control-label m-0 p-0" for="fee-type-all">ALL</label>
            <br>
            <input @if (Auth::user()->hasRole('student')) disabled @endif name="fee_type"
                class="custom-control-input fee-type-all" value="all" id="fee-type-all" type="radio">
            <br>
            <small class="mt-0">fee 80,000/-</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="custom-control checkbox mb-3">
            <label class="custom-control-label m-0 p-0" for="fee-type-compulsory">Compulsory</label>
            <br>
            <input @if (Auth::user()->hasRole('student')) disabled @endif name="fee_type"
                class="custom-control-input fee-type-compulsory" value="compulsory" id="fee-type-compulsory" type="radio">
            <br>
            <small class="mt-0">fee 55,000/-</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="custom-control checkbox mb-3">
            <label class="custom-control-label m-0 p-0" for="fee-type-custom">Custom</label>
            <br>
            <input @if (Auth::user()->hasRole('student')) disabled @endif name="fee_type"
                class="custom-control-input fee-type-custom" value="custom" id="fee-type-custom" type="radio">
            <br>
            <small class="mt-0">Refer to pick All subjects</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="custom-control custom-radio mb-3">
            <label class="custom-control-label m-0 p-0" for="mock-exam">Mock Exams</label>
            <br>
            <input @if (Auth::user()->hasRole('student')) disabled @endif name="mock_exam_evaluation"
                class="custom-control-input exam-mock" value="mock" id="mock-exam" type="radio">
        </div>
    </div>
    <div class="col-md-3">
        <div class="custom-control custom-radio mb-3">
            <label class="custom-control-label m-0 p-0" for="evaluation">Evaluation</label>
            <br>
            <input @if (Auth::user()->hasRole('student')) disabled @endif name="mock_exam_evaluation"
                class="custom-control-input evaluation" value="evaluation" id="evaluation" type="radio">
        </div>
    </div>
    <div class="col-md-3">
        <div class="custom-control custom-radio mb-3">
            <label for="installment" class="form-control-label">Installment *</label>
            <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control installment"
                name="installment" id="installment">
                <option value="" disabled selected>Installment</option>
                <option value="first">1st</option>
                <option value="second">2nd</option>
                <option value="third">3rd</option>
                <option value="fourth">4th</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="custom-control custom-radio mb-3">
            <label for="discount" class="form-control-label">Discount *</label>
            <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control discount" name="discount"
                id="discount">
                <option value="" disabled selected>Discount</option>
                <option value="2.5">2.5%</option>
                <option value="5.0">5.0%</option>
                <option value="7.5">7.5%</option>
                <option value="10">10.0%</option>
                <option value="100">100.0%</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-3">
            <label for="total-fee" class="form-control-label">Total Fee *</label>
            <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control total-fee" id="total-fee"
                name="total_fee" type="number"
                value="@isset($student->user) {{ $student->user->total_fee }} @endisset"
                onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter Total Fee">
        </div>
    </div>
    <div class="col-md-3">
        <div class="custom-control custom-radio mb-3">
            <label for="due_date" class="form-control-label">Due Date *</label>
            <input @if (Auth::user()->hasRole('student')) disabled @endif class="form-control date" id="due_date"
                name="due_date" type="date"
                value="@isset($student->user) {{ $student->user->due_date }} @endisset"
                onfocus="focused(this)" onfocusout="defocused(this)">
        </div>
    </div>
    <div class="col-md-3">
        <div class="custom-control custom-radio mb-3">
            <label for="freeze" class="form-control-label">Freeze *</label>
            <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control freeze" id="freeze"
                name="freeze" type="date"
                value="@isset($student->user) {{ $student->user->freeze }} @endisset"
                onfocus="focused(this)" onfocusout="defocused(this)">
        </div>
    </div>
    <div class="col-md-3">
        <div class="custom-control custom-radio mb-3">
            <label for="leave" class="form-control-label">Leave *</label>
            <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control leave" id="leave"
                name="leave" type="date"
                value="@isset($student->user) {{ $student->user->leave }} @endisset"
                onfocus="focused(this)" onfocusout="defocused(this)">
        </div>
    </div>
    <div class="col-md-3">
        <div class="custom-control custom-radio mb-3">
            <label class="custom-control-label m-0 p-0" for="fee-refund">Fee Refund (50% only)</label>
            <br>
            <input @if (Auth::user()->hasRole('student')) readonly @endif name="fee_refund"
                class="custom-control-input fee-refund" disabled value="refunded" id="fee-refund" type="checkbox">
        </div>
    </div>
    <div class="col-md-3">
        <div class="custom-control custom-radio mb-3">
            <label class="custom-control-label m-0 p-0" for="send-fee-notification">Send Fee Notification</label>
            <br>
            <input @if (Auth::user()->hasRole('student')) disabled @endif name="notification_sent"
                class="custom-control-input send-fee-notification" value="1" id="send-fee-notification" type="checkbox">
        </div>
    </div>
    <div class="col-md-3">
        <div class="custom-control custom-radio mb-3">
            <label for="generate-challan" class="form-control-label">Generate Challan *</label>
            <button type="button" class="btn btn-primary generate-challan" disabled value="1" id="generate-challan" name="challan_generated">Generate Challan</button>
        </div>
    </div>
</div>
<hr class="horizontal dark">
{{-- <p class="text-uppercase text-sm">Address</p>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="address" class="form-control-label">Address *</label>
            <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control address" id="address"
                name="address" type="text"
                value="@isset($student->user) {{ $student->address }} @endisset"
                onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter Address">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="contact_res" class="form-control-label">Contact (Res) *</label>
            <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control contact_res"
                id="contact_res" name="contact_res" step="0.01" type="number"
                value="@isset($student->user) {{ $student->contact_res }} @endisset"
                onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter Contact (Res)">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="cell_no" class="form-control-label">Cell *</label>
            <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control cell_no" id="cell_no"
                name="cell_no" step="0.01" type="number"
                value="@isset($student->user) {{ $student->cell_no }} @endisset"
                onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter Cell No">
        </div>
    </div>
</div>
<hr class="horizontal dark">
<p class="text-uppercase text-sm">Qualification</p>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="degree" class="form-control-label">Bachelor Degree *</label>
            <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control degree" id="degree"
                name="degree" type="text"
                value="@isset($student->user) {{ $student->degree }} @endisset"
                onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter Degree Name">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="major_subjects" class="form-control-label">Major Subjects *</label>
            <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control major_subjects"
                id="major_subjects" name="major_subjects" type="text"
                value="@isset($student->user) {{ $student->major_subjects }} @endisset"
                onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter Major Subject Name">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="cgpa" class="form-control-label">CGPA/%age *</label>
            <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control cgpa" id="cgpa"
                name="cgpa" min="0.1" max="100.00" step="0.1" type="number"
                value="@isset($student->user) {{ $student->cgpa }} @endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter CGPA/%age">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="board_university" class="form-control-label">Board/University *</label>
            <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control board_university"
                id="board_university" name="board_university" type="text"
                value="@isset($student->user) {{ $student->board_university }} @endisset"
                onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter Board/University Name">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="distinction" class="form-control-label">Distinction *</label>
            <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control distinction"
                id="distinction" name="distinction" type="text"
                value="@isset($student->user) {{ $student->distinction }} @endisset"
                onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter Distinction">
        </div>
    </div>
    @if (!Auth::user()->hasRole('student'))
        <div class="col-md-3">
            <div class="form-group">
                <label for="name" class="form-control-label">Role</label>
                <select @if (Auth::user()->hasRole('student')) readonly @endif class="form-control" name="role"
                    id="role">
                    <option value="" disabled selected>Select Role</option>
                    @foreach ($roles as $key => $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif
</div>
<hr class="horizontal dark"> --}}
