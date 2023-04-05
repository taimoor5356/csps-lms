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
                <img class="rounded" src="@isset($student)@if($student->profile_pic != ''){{asset('public/assets/img/students/'.$student->profile_pic.'')}}@else{{asset('public/assets/img/students/user-profile.jpg')}}@endif @else{{asset('public/assets/img/students/user-profile.jpg')}}@endisset" alt="Profile Picture" id="profile-pic" width="100" height="100">
            </div>
        </div>
    </div>
    <div class="admin-form row">
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="name" class="form-control-label">Name *</label>
                <input class="form-control name" id="name"
                    name="name" type="text"
                    value="@isset($student) {{ $student->name }} @endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Student Name">
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
                <label for="degree" class="form-control-label">Father Name *</label>
                <input @if (Auth::user()->hasRole('student')) @endif class="form-control degree" id="degree"
                    name="degree" type="text"
                    value="@isset($student) {{ $student->degree }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Degree Name">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="contact_no" class="form-control-label">CNIC *</label>
                <input class="form-control contact_no" id="contact_no"
                    name="contact_no" type="number"
                    value="@isset($visitor->user) {{ $visitor->user->contact_no }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Contact No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="contact_no" class="form-control-label">Contact No *</label>
                <input class="form-control contact_no" id="contact_no"
                    name="contact_no" type="number"
                    value="@isset($visitor->user) {{ $visitor->user->contact_no }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Contact No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="email" class="form-control-label">Email *</label>
                <input class="form-control email" id="email"
                    name="email" type="email"
                    value="@isset($visitor->user) {{ $visitor->user->email }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Email Address">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="degree" class="form-control-label">Degree *</label>
                <input @if (Auth::user()->hasRole('student')) @endif class="form-control degree" id="degree"
                    name="degree" type="text"
                    value="@isset($student) {{ $student->degree }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Degree Name">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="contact_no" class="form-control-label">Reg No *</label>
                <input class="form-control contact_no" id="contact_no"
                    name="contact_no" type="text"
                    value="@isset($visitor->user) {{ $visitor->user->contact_no }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Contact No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="contact_no" class="form-control-label">Written Result Serial No *</label>
                <input class="form-control contact_no" id="contact_no"
                    name="contact_no" type="number"
                    value="@isset($visitor->user) {{ $visitor->user->contact_no }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Contact No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="contact_no" class="form-control-label">Written Exam Preparation from CSPs *</label>
                <input class="form-control contact_no" id="contact_no"
                    name="contact_no" type="number"
                    value="@isset($visitor->user) {{ $visitor->user->contact_no }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Contact No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="contact_no" class="form-control-label">Mock Interview Date *</label>
                <input class="form-control contact_no" id="contact_no"
                    name="contact_no" type="date"
                    value="@isset($visitor->user) {{ $visitor->user->contact_no }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Contact No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="contact_no" class="form-control-label">Mock Interview Time *</label>
                <input class="form-control contact_no" id="contact_no"
                    name="contact_no" type="date"
                    value="@isset($visitor->user) {{ $visitor->user->contact_no }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Contact No">
            </div>
        </div>
        <hr class="horizontal dark">
        <div class="col-md-3 offset-6">
            <div class="form-group mb-3">
                <button type="button" class="btn btn-primary">Download Performa</button>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <button type="button" class="btn btn-primary">Upload Performa</button>
            </div>
        </div>
    </div>
</div>
<hr class="horizontal dark">
