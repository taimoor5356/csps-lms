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
<p class="text-uppercase text-sm">Enrollment Details</p>
    <div class="row">
        <div class=" col-md-6">
            <div class="form-group">
                <label for="fee" class="form-control-label">Select Teacher *</label>
                <select class="form-control" name="teacher_id" id="teacher_id">
                    <option value="" selected>Select Teacher</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{$teacher->id}}">{{$teacher->user->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="form-control-label">Select Student *</label>
                <select class="form-control" name="user_id" id="user_id">
                    <option value="0" selected disabled>Select Student</option>
                    @foreach ($students as $student)
                        <option value="{{$student->user_id}}">{{$student->user->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
<hr class="horizontal dark">