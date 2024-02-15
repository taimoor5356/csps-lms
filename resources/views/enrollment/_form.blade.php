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
        <div class=" col-md-4">
            <div class="form-group">
                <label for="student_id" class="form-control-label">Select Student *</label>
                <select class="form-control" name="student_id" id="student_id">
                    <option value="0" selected>Select Student</option>
                    @foreach ($students as $key => $student)
                        @isset($student->user)
                            @if (Auth::user()->hasRole('student'))
                                <option value="{{ $student->user->id }}">{{ $student->user->name }}</option>
                            @else
                                <option value="{{ $student->user->id }}">{{ $student->user->name }}</option>
                            @endif
                        @endisset
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="name" class="form-control-label">Select Course *</label>
                <select class="form-control" name="course_id" id="course_id">
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
        <div class="col-md-4">
            <div class="form-group">
                <label for="teacher_id" class="form-control-label">Select Teacher *</label>
                <select class="form-control" name="teacher_id" id="teacher_id">
                    <option value="0" selected disabled>Select Teacher</option>
                </select>
            </div>
        </div>
    </div>
<div class="row">
    <!-- <div class=" col-md-4">
        <div class="form-group">
            <label for="shift" class="form-control-label">Select Shift *</label>
            <br>
            <input class="shift mx-1" id="first_shift" name="first_shift" type="checkbox" @isset($course) @if(\App\Models\CourseShift::where('course_id', $course->id)->where('shift_id', 1)->exists()) checked @endif @endisset
                value="1" onfocus="focused(this)"
                onfocusout="defocused(this)"> First Shift
                <br>
        <div class="form-group">
            <label for="day" class="form-control-label">Select Days *</label>
            <br>
            @foreach(\App\Models\Day::get() as $day)
            <input class="day mx-1" name="first_shift_day[]" type="checkbox" @isset($course) @if(\App\Models\CourseShift::where('course_id', $course->id)->where('shift_id', 1)->where('day_id', $day->id)->exists()) checked @endif @endisset
                value="{{$day->id}}" onfocus="focused(this)"
                onfocusout="defocused(this)"> {{$day->name}}
                <br>
            @endforeach
        </div>
        </div>
    </div>
    <div class="offset-4 col-md-4">
        <label for="shift" class="form-control-label">Select Shift *</label>
        <br>
        <input class="shift mx-1" id="second_shift" name="second_shift" type="checkbox" @isset($course) @if(\App\Models\CourseShift::where('course_id', $course->id)->where('shift_id', 2)->exists()) checked @endif @endisset
            value="2" onfocus="focused(this)"
            onfocusout="defocused(this)"> Second Shift
            <br>
        <div class="form-group">
            <label for="day" class="form-control-label">Select Days *</label>
            <br>
            @foreach(\App\Models\Day::get() as $day)
            <input class="day mx-1" name="second_shift_day[]" type="checkbox" @isset($course) @if(\App\Models\CourseShift::where('course_id', $course->id)->where('shift_id', 2)->where('day_id', $day->id)->exists()) checked @endif @endisset
                value="{{$day->id}}" onfocus="focused(this)"
                onfocusout="defocused(this)"> {{$day->name}}
                <br>
            @endforeach
        </div>
    </div> -->
</div>
<hr class="horizontal dark">
