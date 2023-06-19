@php 
    $allCourses = $courses->get();
    $compulsoryCourses = $courses->where('category', 'compulsory')->get();
    $studentSelectedCourses = json_decode($student->selected_subjects);
    if (is_null($studentSelectedCourses)) {
        $studentSelectedCourses = [];
    }
@endphp

<div class="subjects-list border border-default rounded" style="max-height: 320px; overflow: auto;">
    <div id="all-subjects-view-list" class="@isset($student) @if(($student->subject_type == 'all') || ($student->subject_type == 'selected')) @else d-none @endif @else d-none @endisset">
        @isset($student)
            @if(($student->subject_type == 'all') || ($student->subject_type == 'selected'))
                @foreach ($allCourses as $aCourse)
                    <span class="col-3">
                        <input type="checkbox" name="selected_subjects[]" value="{{$aCourse->id}}" @if(in_array($aCourse->id, $studentSelectedCourses)) checked @endif> {{$aCourse->name}}
                    </span>
                @endforeach
            @else
                @foreach ($allCourses as $aCourse)
                    <span class="col-3">
                        <input type="checkbox" name="selected_subjects[]" value="{{$aCourse->id}}"> {{$aCourse->name}}
                    </span>
                @endforeach
            @endif
        @else
            @foreach ($allCourses as $aCourse)
                <span class="col-3">
                    <input type="checkbox" name="selected_subjects[]" value="{{$aCourse->id}}"> {{$aCourse->name}}
                </span>
            @endforeach
        @endisset
    </div>
    <div id="compulsory-subjects-view-list" class="@isset($student) @if(($student->subject_type == 'compulsory')) @else d-none @endif @else d-none @endisset">
        @isset($student)
            @if(($student->subject_type == 'compulsory'))
                @foreach ($compulsoryCourses as $cCourse)
                    <span class="col-3">
                        <input type="checkbox" name="selected_subjects[]" value="{{$cCourse->id}}" @if(in_array($cCourse->id, $studentSelectedCourses)) checked @endif> {{$cCourse->name}}
                    </span>
                @endforeach
            @else
                @foreach ($compulsoryCourses as $cCourse)
                    <span class="col-3">
                        <input type="checkbox" name="selected_subjects[]" value="{{$cCourse->id}}"> {{$cCourse->name}}
                    </span>
                @endforeach
            @endif
        @else
            @foreach ($compulsoryCourses as $cCourse)
                <span class="col-3">
                    <input type="checkbox" name="selected_subjects[]" value="{{$cCourse->id}}"> {{$cCourse->name}}
                </span>
            @endforeach
        @endisset
    </div>
</div>