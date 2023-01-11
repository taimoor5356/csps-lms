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
                    value="@isset($student->user) {{ $student->user->name }} @endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Student Name">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="contact_no" class="form-control-label">Contact No *</label>
                <input class="form-control contact_no" id="contact_no"
                    name="contact_no" type="number"
                    value="@isset($student->user) {{ $student->cell_no }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Contact No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="gender" class="form-control-label">Gender *</label>
                <select class="form-control gender" name="gender"
                    id="gender">
                    <option value="" selected>Select Gender</option>
                    <option value="M" @isset($student->user) @if($student->user->gender == 'M') selected @endisset @endisset>Male</option>
                    <option value="F" @isset($student->user) @if($student->user->gender == 'F') selected @endisset @endisset>Female</option>
                </select>
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
                <label for="reg_no" class="form-control-label">Reg No *</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control reg_no" id="reg-no"
                    name="reg_no" type="text"
                    value="@isset($student->user) {{ $student->reg_no }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Registration No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="css_pms_yr" class="form-control-label">CSS/PMS Year *</label>
                <select @if (Auth::user()->hasRole('student')) readonly @endif class="form-control css_pms_yr" name="year"
                    id="css-pms-yr">
                    <option value="" selected>Select CSS/PMS Year</option>
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
                    id="batch-no">
                    <option value="" selected>Select Batch No</option>
                    <option value="80" @isset($student) @if($student->batch_no == '80') selected @endisset @endisset>80</option>
                    <option value="81" @isset($student) @if($student->batch_no == '81') selected @endisset @endisset>81</option>
                    <option value="82" @isset($student) @if($student->batch_no == '82') selected @endisset @endisset>82</option>
                    <option value="83" @isset($student) @if($student->batch_no == '83') selected @endisset @endisset>83</option>
                    <option value="84" @isset($student) @if($student->batch_no == '84') selected @endisset @endisset>84</option>
                    <option value="85" @isset($student) @if($student->batch_no == '85') selected @endisset @endisset>85</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="roll_no" class="form-control-label">Roll No *</label>
                <input type="hidden" id="reg-no1" value="">
                <input type="hidden" id="reg-no2" value="">
                <input type="hidden" id="reg-no3" value="">
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control roll_no" readonly id="roll-no"
                    name="roll_no" type="text"
                    value=""
                    onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="class-type" class="form-control-label">Campus/Online *</label>
                <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control class-type" name="class_type"
                    id="class-type">
                    <option value="" selected>Select Campus/Online</option>
                    <option value="campus" @isset($student) @if($student->class_type == 'campus') selected @endisset @endisset>On Campus</option>
                    <option value="online" @isset($student) @if($student->class_type == 'online') selected @endisset @endisset>Online</option>
                </select>
            </div>
        </div>
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
                    class="custom-control-input exam-mock fee_type" value="mock" data-fee="0" id="mock-exam" type="radio" @isset($student) @if($student->mock_exam_evaluation == 'mock') checked @endisset @endisset>
            </div>
        </div>
        <div class="col-md-2">
            <div class="custom-control custom-radio mb-3">
                <label class="custom-control-label m-0 p-0" for="evaluation">Evaluation</label>
                <br>
                <input @if (Auth::user()->hasRole('student')) disabled @endif name="fee_type"
                    class="custom-control-input evaluation fee_type" value="evaluation" data-fee="0" id="evaluation" type="radio" @isset($student) @if($student->mock_exam_evaluation == 'evaluation') checked @endisset @endisset>
            </div>
        </div>
        <div class="col-md-2">
            <div class="custom-control custom-radio mb-3">
                <label class="custom-control-label m-0 p-0" for="interview">Interview</label>
                <br>
                <input @if (Auth::user()->hasRole('student')) disabled @endif name="fee_type"
                    class="custom-control-input interview fee_type" value="interview" data-fee="0" id="interview" type="radio" @isset($student) @if($student->mock_exam_evaluation == 'interview') checked @endisset @endisset>
            </div>
        </div>

        <hr class="horizontal dark">

        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="installment" class="form-control-label">Installment *</label>
                <select @if (Auth::user()->hasRole('student')) disabled @endif class="form-control installment"
                    name="installment" id="installment">
                    <option value="" selected>Installment</option>
                    <option value="first" @isset($student) @if($student->installment == 'first') selected @endisset @endisset>1st</option>
                    <option value="second" @isset($student) @if($student->installment == 'second') selected @endisset @endisset>2nd</option>
                    <option value="third" @isset($student) @if($student->installment == 'third') selected @endisset @endisset>3rd</option>
                    <option value="fourth" @isset($student) @if($student->installment == 'fourth') selected @endisset @endisset>4th</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
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
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="total-fee" class="form-control-label">Total Fee *</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control total-fee" id="total-fee"
                    name="total_fee" type="number"
                    value="@isset($student) {{ $student->total_fee }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Total Fee">
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="due_date" class="form-control-label">Due Date *</label>
                <input @if (Auth::user()->hasRole('student')) disabled @endif class="form-control date" id="due_date"
                    name="due_date" type="date"
                    value="@isset($student) {{ $student->due_date }} @endisset"
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
                    class="custom-control-input fee-refund" value="refunded" id="fee-refund" type="checkbox" @isset($student) @if($student->fee_refund == '1') checked @endisset @endisset>
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
                <label for="generate-challan" class="form-control-label">Generate Challan *</label>
                <button type="button" class="btn btn-primary generate-challan w-100" value="1" id="generate-challan" name="challan_generated">Generate Challan</button>
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-control custom-radio mb-3">
                <label for="fee_submit_date" class="form-control-label">Date *</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control fee_submit_date" id="fee_submit_date"
                    name="fee_submit_date" type="date"
                    value="@isset($student) {{ $student->fee_submit_date }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)">
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
                <label for="name" class="form-control-label">Name *</label>
                <input class="form-control name" id="name"
                    name="name" type="text"
                    value="@isset($student->user) {{ $student->user->name }} @endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Student Name">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="gender" class="form-control-label">Gender *</label>
                <select class="form-control gender" name="gender"
                    id="gender">
                    <option value="" selected>Select Gender</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <label for="photo" class="form-control-label">Student Photograph *</label>
            <input type="file" name="photo" onchange="document.getElementById('photo').src = window.URL.createObjectURL(this.files[0])" class="form-control">
            <div class="row img-preview">
                <div class="col-md-3 my-2">
                    <img class="rounded" src="@isset($student->user)@if($student->user->photo != ''){{asset('public/assets/img/students/'.$student->user->photo.'')}}@else{{asset('public/assets/img/students/user-profile.jpg')}}@endif @else{{asset('public/assets/img/students/user-profile.jpg')}}@endisset" alt="Profile Picture" id="photo" width="100" height="100">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <label for="challan" class="form-control-label">Fee Challan *</label>
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
                <label for="father_name" class="form-control-label">Father Name *</label>
                <input class="form-control father_name" id="father_name" name="father_name" type="text"
                    value="@isset($student->user){{ $student->father_name }}@endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Father Name" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="dob" class="form-control-label">Date of Birth *</label>
                <input class="form-control dob" id="dob" name="dob" type="date"
                    value="@isset($student->user){{ $student->dob }}@endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Date of Birth" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="roll_no" class="form-control-label">Roll No *</label>
                <input @if (Auth::user()->hasRole('student')) @endif class="form-control roll_no" id="roll_no"
                    name="roll_no" type="text"
                    value="@isset($student->user) {{ $student->roll_no }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Registration No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="cnic" class="form-control-label">CNIC *</label>
                <input @if (Auth::user()->hasRole('student')) readonly @endif class="form-control cnic" id="cnic" name="cnic" step="0.01" type="number"
                    value="@isset($student->user){{ $student->cnic }}@endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="CNIC Number" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="father_occupation" class="form-control-label">Father's Occupation *</label>
                <input class="form-control father_occupation" id="father_occupation" name="father_occupation" type="text"
                    value="@isset($student->user){{ $student->father_occupation }}@endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Father's Occupation" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="domicile" class="form-control-label">Domicile *</label>
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
                        <label for="degree" class="form-control-label">Degree *</label>
                        <input @if (Auth::user()->hasRole('student')) @endif class="form-control degree" id="degree"
                            name="degree" type="text"
                            value="@isset($student->user) {{ $student->degree }} @endisset"
                            onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Degree Name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="major_subjects" class="form-control-label">Major Subjects *</label>
                        <input @if (Auth::user()->hasRole('student')) @endif class="form-control major_subjects"
                            id="major_subjects" name="major_subjects" type="text"
                            value="@isset($student->user) {{ $student->major_subjects }} @endisset"
                            onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Major Subject">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cgpa" class="form-control-label">CGPA/%age *</label>
                        <input @if (Auth::user()->hasRole('student')) @endif class="form-control cgpa" id="cgpa"
                            name="cgpa" min="0.1" max="100.00" step="0.1" type="number"
                            value="@isset($student->user) {{ $student->cgpa }} @endisset" onfocus="focused(this)"
                            onfocusout="defocused(this)" placeholder="CGPA/%age">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="board_university" class="form-control-label">Board/University *</label>
                        <input @if (Auth::user()->hasRole('student')) @endif class="form-control board_university"
                            id="board_university" name="board_university" type="text"
                            value="@isset($student->user) {{ $student->board_university }} @endisset"
                            onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Board/University">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="distinction" class="form-control-label">Profession *</label>
                        <input @if (Auth::user()->hasRole('student')) @endif class="form-control distinction"
                            id="distinction" name="distinction" type="text"
                            value="@isset($student->user) {{ $student->distinction }} @endisset"
                            onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Profesion">
                    </div>
                </div>
                {{-- <div class="col-md-1">
                    <div class="form-group">
                        <label for="add-education" class="form-control-label">Add</label>
                        <button type="button" id="add-education" class="btn btn-primary form-control">+</button>
                    </div>
                </div> --}}
            </div>
        </div>

        <hr class="horizontal dark my-3">

        <div class="col-md-3">
            <div class="form-group">
                <label for="address" class="form-control-label">Address *</label>
                <input class="form-control address" id="address" name="address" type="text"
                    value="@isset($student->user){{ $student->address }}@endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Student Occupation" >
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
                <label for="contact_no" class="form-control-label">Contact No *</label>
                <input class="form-control contact_no" id="contact_no"
                    name="contact_no" type="number"
                    value="@isset($student->user) {{ $student->user->contact_no }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Contact No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="em_contact_no" class="form-control-label">Emergency Contact No *</label>
                <input class="form-control em_contact_no" id="em_contact_no"
                    name="em_contact_no" type="number"
                    value="@isset($student->user) {{ $student->user->em_contact_no }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Emergency Contact No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="optional_subjects" class="form-control-label">Optional Subject *</label>
                <select class="form-control optional_subjects" name="optional_subjects"
                    id="optional_subjects">
                    <option value="" selected>Select Subject</option>
                    <option value="1">Sub 1</option>
                    <option value="2">Sub 2</option>
                </select>
            </div>
        </div>
        {{-- <div class="col-md-3">
            <div class="form-group">
                <label for="password" class="form-control-label">Password *</label>
                <input class="form-control password" id="password" name="password" type="password"
                    value="" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Password" >
            </div>
        </div> --}}
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