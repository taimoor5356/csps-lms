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
<div class="container">
    <div class="row">
        <div class=" col-md-6">
            <div class="form-group">
                <label for="fee" class="form-control-label">Select Student *</label>
                <select class="form-control js-example-theme-single" name="user_id" id="user_id">
                    <option value="0" disabled selected>Select Student</option>
                    @foreach ($students as $key => $student)
                        @isset($student->user)
                            @if (Auth::user()->hasRole('student'))
                                <option selected value="{{ $student->user->id }}">{{ $student->user->name }}</option>
                            @else
                                <option value="{{ $student->user->id }}">{{ $student->user->name }}</option>
                            @endif
                        @endisset
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="form-control-label">Select Course *</label>
                <select class="form-control js-example-theme-single" name="course_id" id="course_id">
                    <option value="0" selected disabled>Select Courses</option>
                    @foreach ($courses as $key => $course)
                        @isset($course)
                            @if (!Auth::user()->enrolled_courses->contains('course_id', $course->id))
                                <option value="{{ $course->id }}">{{ $course->name }} ({{$course->category}})</option>
                            @endif
                        @endisset
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<hr class="horizontal dark">
