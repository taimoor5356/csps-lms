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
<p class="text-uppercase text-sm">Course Details</p>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="name" class="form-control-label">Course Name *</label>
            <input class="form-control name" id="name" name="name" type="text"
                value="@isset($course) {{ $course->name }} @endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Course Name">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="name" class="form-control-label">Course Category *</label>
            <select class="form-control category" name="category"
                    id="category">
                    <option value="" selected disabled>Select Course Category</option>
                    <option value="compulsory" @isset($course) @if($course->category == 'compulsory') selected @endif @endisset>Compulsory</option>
                    <option value="optional" @isset($course) @if($course->category == 'optional') selected @endif @endisset>Optional</option>
                </select>
        </div>
    </div>
    <div class=" col-md-4">
        <div class="form-group">
            <label for="fee" class="form-control-label">Fee *</label>
            <input class="form-control fee" id="fee" name="fee" type="number"
                value="@isset($course){{$course->fee}}@endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter Fee">
        </div>
    </div>
    <div class=" col-md-4">
        <div class="form-group">
            <label for="marks" class="form-control-label">Marks *</label>
            <input class="form-control marks" id="marks" name="marks" type="number"
                value="@isset($course){{$course->marks}}@endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter Marks">
        </div>
    </div>
    <div class="col-sm-4">
        <label for="image" class="form-control-label">Course Image *</label>
        <input type="file" name="image"
            onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
            class="form-control">
        <div class="row img-preview">
            <div class="col-md-3 my-2">
                <img class="rounded"
                    src="@isset($course) {{ asset('public/assets/img/courses/' . $course->image . '') }}@else{{ asset('public/assets/img/user-profile.jpg') }} @endisset"
                    alt="Product Image" id="image" width="100" height="100">
            </div>
        </div>
    </div>
</div>
<!-- <div class="row">
    <div class=" col-md-4">
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
    </div>
</div> -->
</div>
<hr class="horizontal dark">
