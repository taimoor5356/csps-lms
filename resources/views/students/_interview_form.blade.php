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
<p class="text-uppercase text-sm">Student's Profile</p>
<div class="row">
    <div class="col-sm-3 offset-9">
        <label for="photo" class="form-control-label">Student Photograph *</label>
        <input type="file" name="photo" onchange="document.getElementById('profile_pic').src = window.URL.createObjectURL(this.files[0])" class="form-control">
        <div class="row img-preview">
            <div class="col-md-3 my-2">
                <img class="rounded" src="@isset($student->user)@if($student->user->photo != ''){{asset('public/assets/img/students/'.$student->user->photo.'')}}@else{{asset('public/assets/img/students/user-profile.jpg')}}@endif @else{{asset('public/assets/img/students/user-profile.jpg')}}@endisset" alt="Profile Picture" id="profile_pic" width="100" height="100">
            </div>
        </div>
    </div>
    <div class="admin-form row">
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="name" class="form-control-label">Name</label>
                <input class="form-control name" id="name"
                    name="name" type="text"
                    value="@isset($student){{$student->user->name}}@endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Student Name">
            </div>
        </div>
        <!-- Email -->
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="email" class="form-control-label">Email</label>
                <input class="form-control email" id="email"
                    name="email" type="email"
                    value="@isset($student->user){{$student->user->email}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Email Address" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="gender" class="form-control-label">Gender *</label>
                <select class="form-control gender" name="gender"
                    id="gender">
                    <option value="" disabled selected>Select Gender</option>
                    <option value="M" @isset($student) @if($student->user->gender == 'M') selected @endif @endisset>Male</option>
                    <option value="F" @isset($student) @if($student->user->gender == 'F') selected @endif @endisset>Female</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="father_name" class="form-control-label">Father Name *</label>
                <input @if (Auth::user()->hasRole('student')) @endif class="form-control father_name" id="father_name"
                    name="father_name" type="text"
                    value="@isset($student){{$student->father_name}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Father Name">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="cnic" class="form-control-label">CNIC *</label>
                <input class="form-control cnic" id="cnic"
                    name="cnic" type="number"
                    value="@isset($student){{$student->cnic}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="CNIC Number">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="" class="form-control-label">Registration Number</label>
                <input class="form-control " id="" type="text" readonly
                    value="@isset($student){{$student->roll_no}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="written_result_fpsc_serial_no" class="form-control-label">Written Result Serial Number *</label>
                <input class="form-control written_result_fpsc_serial_no" id="written_result_fpsc_serial_no"
                    name="written_result_fpsc_serial_no" type="text"
                    value="@isset($student){{$student->written_result_fpsc_serial_no}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="FPSC Serial Number">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="written_fpsc_roll_no" class="form-control-label">Roll Number *</label>
                <input class="form-control written_fpsc_roll_no" id="written_fpsc_roll_no"
                    name="written_fpsc_roll_no" type="text"
                    value="@isset($student){{$student->written_fpsc_roll_no}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="FPSC Roll Number">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="domicile" class="form-control-label">Domicile *</label>
                <select name="domicile" id="domicile" class="form-control">
                    <option value="">Select Domicile</option>
                    <option value="punjab" @isset($student) @if($student->domicile == 'punjab') selected @endif @endisset>Punjab</option>
                    <option value="kpk" @isset($student) @if($student->domicile == 'kpk') selected @endif @endisset>KPK</option>
                    <option value="sindh" @isset($student) @if($student->domicile == 'sindh') selected @endif @endisset>SINDH</option>
                    <option value="balochistan" @isset($student) @if($student->domicile == 'balochistan') selected @endif @endisset>Balochistan</option>
                    <option value="ict" @isset($student) @if($student->domicile == 'ict') selected @endif @endisset>ICT</option>
                    <option value="ajk" @isset($student) @if($student->domicile == 'ajk') selected @endif @endisset>AJK</option>
                    <option value="gb" @isset($student) @if($student->domicile == 'gb') selected @endif @endisset>GB</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="written_exam_preparation_from_csps" class="form-control-label">Written Exam Preparation from CSPs *</label>
                <select name="written_exam_preparation_from_csps" id="written_exam_preparation_from_csps" class="form-control">
                    <option value="">Select</option>
                    <option value="no" @isset($student) @if($student->written_exam_preparation_from_csps == 'no') selected @endif @endisset>No</option>
                    <option value="yes" @isset($student) @if($student->written_exam_preparation_from_csps == 'yes') selected @endif @endisset>Yes</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="applied_for" class="form-control-label">Applying for *</label>
                <select name="applied_for" id="applied_for" class="form-control">
                    <option value="">Select applying for</option>
                    <option value="full_interview_preparation" @isset($student) @if($student->interview_applied_for == 'full_interview_preparation') selected @endif @endisset>Full Interview Preparation</option>
                    <option value="mock_interview" @isset($student) @if($student->interview_applied_for == 'mock_interview') selected @endif @endisset>Mock Interview</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="whatsapp-group-number" class="form-control-label">Join Whatsapp Group</label>
                <input class="form-control whatsapp-group-number" id="whatsapp-group-number"
                    name="whatsapp_group_number" type="text"
                    value="https://api.whatsapp.com/send/?phone=923165701593&text&type=phone_number&app_absent=0"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Cell No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="selected_mock_interview" class="form-control-label">Select Mock Interview *</label>
                <select name="selected_mock_interview" id="selected_mock_interview" class="form-control">
                    <option value="">Select mock interview type</option>
                    <option value="1" @isset($student) @if($student->selected_mock_interview == '1') selected @endif @endisset>1</option>
                    <option value="2" @isset($student) @if($student->selected_mock_interview == '2') selected @endif @endisset>2</option>
                    <option value="3" @isset($student) @if($student->selected_mock_interview == '3') selected @endif @endisset>3</option>
                    <option value="customized" @isset($student) @if($student->selected_mock_interview == 'customized') selected @endif @endisset>customized</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="mock_interview_date_time" class="form-control-label">Mock Interview Date/Time *</label>
                <input class="form-control mock_interview_date_time" id="mock_interview_date_time"
                    name="mock_interview_date_time" type="datetime-local" value="@isset($student){{$student->mock_interview_date_time}}@endisset">
            </div>
        </div>
        <div class="col-md-3 offset-3">
            <div class="form-group mb-3">
                <label for="upload-performa">Fill and Upload Performa *</label>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload-performa-modal">Upload Performa</button>
            </div>
        </div>
        <hr class="horizontal dark">
        <div class="col-md-12">
            <input @isset($student) @if($student->mock_interview_rules_regulations == '1') checked @endif @endisset type="checkbox" name="mock_interview_rules_regulations" id="mock_interview_rules_regulations" value="1"> All the rules and regulations will follow and policies of institution are acceptable
        </div>
    </div>
</div>
<hr class="horizontal dark">
