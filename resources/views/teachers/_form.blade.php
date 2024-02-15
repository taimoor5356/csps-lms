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
<p class="text-uppercase text-sm">Teacher Profile</p>
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
                    value="@isset($teacher->user) {{ $teacher->user->name }} @endisset" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Teacher Name">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="contact_no" class="form-control-label">Contact No *</label>
                <input class="form-control contact_no" id="contact_no"
                    name="contact_no" type="number"
                    value="@isset($teacher->user)0{{$teacher->cell_no}}@endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Contact No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="gender" class="form-control-label">Gender *</label>
                <select class="form-control gender" name="gender"
                    id="gender">
                    <option value="" disabled selected>Select Gender</option>
                    <option value="M" @isset($teacher->user) @if($teacher->user->gender == 'M') selected @endisset @endisset>Male</option>
                    <option value="F" @isset($teacher->user) @if($teacher->user->gender == 'F') selected @endisset @endisset>Female</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="email" class="form-control-label">Email *</label>
                <input class="form-control email" id="email"
                    name="email" type="email"
                    value="@isset($teacher->user) {{ $teacher->user->email }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Email Address">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="reg_no" class="form-control-label">Reg No *</label>
                <input @if (Auth::user()->hasRole('teacher')) readonly @endif class="form-control reg_no" id="reg-no"
                    name="reg_no" type="text"
                    value="@isset($teacher->user) {{ $teacher->reg_no }} @endisset"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Registration No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="batch_no" class="form-control-label">Batch No *</label>
                <select @if (Auth::user()->hasRole('teacher')) disabled @endif class="form-control batch_no" name="batch_no"
                    id="batch-no">
                    <option value="" disabled selected>Select Batch No</option>
                    <option value="80" @isset($teacher) @if($teacher->batch_no == '80') selected @endisset @endisset>80</option>
                    <option value="81" @isset($teacher) @if($teacher->batch_no == '81') selected @endisset @endisset>81</option>
                    <option value="82" @isset($teacher) @if($teacher->batch_no == '82') selected @endisset @endisset>82</option>
                    <option value="83" @isset($teacher) @if($teacher->batch_no == '83') selected @endisset @endisset>83</option>
                    <option value="84" @isset($teacher) @if($teacher->batch_no == '84') selected @endisset @endisset>84</option>
                    <option value="85" @isset($teacher) @if($teacher->batch_no == '85') selected @endisset @endisset>85</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="class-type" class="form-control-label">Campus/Online *</label>
                <select @if (Auth::user()->hasRole('teacher')) disabled @endif class="form-control class-type" name="class_type"
                    id="class-type">
                    <option value="" disabled selected>Select Campus/Online</option>
                    <option value="campus" @isset($teacher) @if($teacher->class_type == 'campus') selected @endisset @endisset>On Campus</option>
                    <option value="online" @isset($teacher) @if($teacher->class_type == 'online') selected @endisset @endisset>Online</option>
                </select>
            </div>
        </div>
        <hr class="horizontal dark">
    </div>
    <!------------------------------------------------------------------------------------------------------------------------------------>
    <!---------------------------------------------------------- Admin Ends -------------------------------------------------------------->
    <!------------------------------------------------------------------------------------------------------------------------------------>
    @endif
</div>
