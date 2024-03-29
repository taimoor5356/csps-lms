<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Models\CourseShift;
use App\Models\LectureSchedule;
use App\Models\StudentLectureSchedule;
use App\Models\Teacher;
use App\Models\TeacherLectureSchedule;
use App\Models\User;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    // showTableData for index() and trashed()
    public function showTableData($data, $trashed)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('image', function ($row) {
                $url = URL::to('/');
                if (isset($row->course)) {
                    return '    
                    <div class="">
                        <div>
                            <img src="' . $url . '/public/assets/img/courses/' . $row->course->image . '" class="avatar avatar-xl"
                                alt="Course">
                        </div>
                    </div>
                    ';
                } else {
                    return '';
                }
            })
            ->addColumn('student_name', function ($row) {
                if (isset($row->student)) {
                    return '
                    <div class="">
                        <div class="">
                            <h6 class="mb-0 text-sm">' . $row->student->name . '</h6>
                        </div>
                    </div>
                    ';
                } else {
                    return '';
                }
            })
            ->addColumn('teacher_name', function ($row) {
                if (isset($row->teacher)) {
                    $teacherLectureScheduleURL = route('enrollments.teachers', [$row->teacher->id]);
                    return '<a href="'.$teacherLectureScheduleURL.'" class="mb-0 text-primary">' . $row->teacher->name . '</a>';
                } else {
                    return '';
                }
            })
            ->addColumn('course_name', function ($row) {
                if (isset($row->course)) {
                    return '
                    <div class="">
                        <div class="">
                            <h6 class="mb-0 text-sm">' . $row->course->name . '</h6>
                        </div>
                    </div>
                    ';
                } else {
                    return '';
                }
            })
            ->addColumn('time', function ($row) {
                if (!empty($row->time_from) && !empty($row->time_to)) {
                    return '
                    <div class="">
                        <div class="">
                            <h6 class="mb-0 text-sm">'.(isset($row->day) ? ucfirst($row->day->name) : '').' | ' . Carbon::parse($row->time_from)->format('h:i A') . ' - ' . Carbon::parse($row->time_to)->format('h:i A') . '</h6>
                        </div>
                    </div>
                    ';
                } else {
                    return '';
                }
            })
            ->addColumn('status', function ($row) {
                if (isset($row)) {
                    if ($row->status == 'completed') {
                        return '
                        <div class="">
                            <div class="">
                                <h6 class="text-sm text-capitalize bg-success text-white rounded text-center p-1">' . $row->status . '</h6>
                            </div>
                        </div>
                        ';
                    }
                    return '
                    <div class="">
                        <div class="">
                            <h6 class="text-sm text-capitalize bg-danger text-white rounded text-center p-1">' . $row->status . '</h6>
                        </div>
                    </div>
                    ';
                } else {
                    return '
                    <div class="">
                        <div class="">
                            <h6 class="text-sm text-capitalize bg-danger text-white rounded text-center p-1">Incomplete</h6>
                        </div>
                    </div>
                    ';
                }
            })
            ->addColumn('category', function ($row) {
                if (isset($row->course)) {
                    return '
                    <div class="">
                        <div class="">
                            <h6 class="mb-0 text-sm">' . $row->course->category . '</h6>
                        </div>
                    </div>
                    ';
                } else {
                    return '';
                }
            })
            ->addColumn('fee', function ($row) {
                if (isset($row->course)) {
                    return '
                    <div class="">
                        <div class="">
                            <h6 class="mb-0 text-sm">' . $row->course->fee . '</h6>
                        </div>
                    </div>
                    ';
                } else {
                    return '';
                }
            })
            ->addColumn('marks', function ($row) {
                if (isset($row->course)) {
                    return '
                    <div class="">
                        <div class="">
                            <h6 class="mb-0 text-sm">' . $row->course->marks . ' marks</h6>
                        </div>
                    </div>
                    ';
                } else {
                    return '';
                }
            })
            ->addColumn('date', function ($row) {
                if (isset($row)) {
                    return ($row->status == 'completed') ? $row->updated_at->format('Y-m-d') : '<h6 class="text-sm text-capitalize bg-danger text-white rounded text-center p-1">Not completed</h6>';
                } else {
                    return '<h6 class="text-sm text-capitalize bg-danger text-white rounded text-center p-1">Not completed</h6>';
                }
            })
            ->addColumn('action', function ($row) use ($trashed) {
                $btn = '';
                if (Auth::user()->hasanyrole('admin|manager')) {
                    if ($trashed == null) {
                        if (isset($row->user) && $row->user->hasRole('teacher')) {
                            // $lectureDetailsURL = route('teacher_lecture_details', [$row->course_id, $row->user_id]);
                            // $btn .= '
                            //     <a href="'.$lectureDetailsURL.'" data-enrollment-id="' . $row->id . '" class="btn btn-success bg-success p-1" title="Completed"><i class="fa fa-eye"></i></a>
                            // ';
                            $updateLectureScheduleStatusURL = route('update_lecture_schedule_status', [$row->course_id, $row->user_id]);
                            if ($row->teacher_lecture_schedule) {
                                if ($row->teacher_lecture_schedule->status == 'incomplete') {
                                    $btn .= '
                                        <a href="'.$updateLectureScheduleStatusURL.'" data-enrollment-id="' . $row->id . '" class="btn btn-success bg-success p-1" title="Completed"><i class="fa fa-check"></i></a>
                                    ';
                                }
                            }
                        }
                        $btn .= '
                            <a href="enrollments/' . $row->id . '/delete" data-enrollment-id="' . $row->id . '" class="btn btn-danger bg-danger p-1 delete-enrollment" title="Delete"><i class="fa fa-trash-o"></i></a>
                        ';
                    } else {
                        $btn .= '
                            <a href="' . $row->id . '/restore" data-enrollment-id="' . $row->id . '" class="btn btn-success bg-success p-1" title="Restore"><i class="fa fa-undo"></i></a>
                            <a href="' . $row->id . '/delete" data-enrollment-id="' . $row->id . '" class="btn btn-danger bg-danger p-1 delete-enrollment" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>
                        ';
                    }
                }
                return $btn;
            })
            ->rawColumns(['image', 'student_name', 'teacher_name', 'course_name', 'status', 'time', 'category', 'fee', 'marks', 'date', 'action'])
            ->make(true);
    }

    public function students(Request $request, $userId = null)
    {
        //
        try {
            if (!is_null($userId)) {
                $studentUserIds = Student::where('user_id', $userId)->pluck('user_id');
            } else {
                $studentUserIds = Student::query()->pluck('user_id');
            }
            $studentEnrollments = StudentLectureSchedule::with('course', 'student', 'teacher')->whereIn('student_id', $studentUserIds)->get();
            if (Auth::user()->hasRole('student')) {
                $studentEnrollments = StudentLectureSchedule::with('course', 'student', 'teacher')->where('student_id', Auth::user()->id)->get();
            }
            if ($request->ajax()) {
                return $this->showTableData($studentEnrollments, $trashed = null);
            }
            return view('enrollment.students', compact('userId'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withError('Something went wrong');
        }
    }

    public function teachers(Request $request, $userId = null)
    {
        //
        try {
            if (!is_null($userId)) {
                $teacherUserIds = Teacher::where('user_id', $userId)->pluck('user_id');
            } else {
                $teacherUserIds = Teacher::query()->pluck('user_id');
            }
            $teacherEnrollments = TeacherLectureSchedule::with('course', 'teacher', 'day')->groupBy('course_id', 'teacher_id')->whereIn('teacher_id', $teacherUserIds)->get();
            if (Auth::user()->hasRole('teacher')) {
                $teacherEnrollments = TeacherLectureSchedule::with('course', 'teacher', 'day')->groupBy('course_id', 'teacher_id')->where('teacher_id', Auth::user()->id)->get();
            }
            if ($request->ajax()) {
                return $this->showTableData($teacherEnrollments, $trashed = null);
            }
            return view('enrollment.teachers', compact('userId'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withError('Something went wrong');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type = null)
    {
        //
        $students = Student::with('user')->get();
        $teachers = Teacher::with('user')->get();
        if (Auth::user()->hasRole('student')) {
            $students = Student::where('user_id', Auth::user()->id)->get();
        }
        if (Auth::user()->hasRole('teacher')) {
            $teachers = Teacher::where('user_id', Auth::user()->id)->get();
        }
        $courses = Course::get();
        if ($type == 'students') {
            return view('enrollment.create', compact('students', 'teachers', 'courses'));
        }
        if ($type == 'teachers') {
            return view('enrollment.create_teacher', compact('students', 'teachers', 'courses'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            DB::beginTransaction();
            $enrollment = new Enrollment();
            $enrollment->user_id = !empty($request->user_id) ? $request->user_id : $request->student_id;
            $userType = User::where('id', !empty($request->user_id) ? $request->user_id : $request->student_id)->first();
            $enrollment->course_id = $request->course_id;
            $enrollment->enrolled_date = Carbon::now()->format('Y-m-d');
            $userId = !empty($request->user_id) ? $request->user_id : $request->student_id;
            $courseId = $request->course_id;
            $firstShiftDays = $request->first_shift_day;
            $secondShiftDays = $request->second_shift_day;
            if (Enrollment::where('user_id', !empty($request->user_id) ? $request->user_id : $request->student_id)->where('course_id', $request->course_id)->exists()) {
                // return redirect()->back()->with('error', 'Already Enrolled');
            } else {
                $enrollment->save();
            }

            if ($userType->hasRole('student')) {
                $checkCourses = StudentLectureSchedule::where('student_id', $request->student_id)->where('course_id', $request->course_id);
                if (!$checkCourses->exists()) {
                    StudentLectureSchedule::create([
                        'student_id' => $request->student_id,
                        'course_id' => $request->course_id,
                        'teacher_id' => $request->teacher_id
                    ]);
                    // $checkCourses->forceDelete();
                }
                $checkLectureScheduleCourses = LectureSchedule::where('student_id', $request->student_id)->where('course_id', $request->course_id);
                if (!$checkLectureScheduleCourses->exists()) {
                    LectureSchedule::create([
                        'student_id' => $request->student_id,
                        'course_id' => $request->course_id,
                        'teacher_id' => $request->teacher_id,
                        'time_from' => $request->time_from,
                        'time_to' => $request->time_to
                    ]);
                    // $checkCourses->forceDelete();
                }
            }
            
            if ($userType->hasRole('teacher')) {
                if (TeacherLectureSchedule::where('day_id', $request->day_id)->where('time_from', $request->time_from)->where('time_to', $request->time_to)->exists()) {
                    return redirect()->back()->with('error', 'Time slot already booked for this teacher');
                }
                $checkCourses = TeacherLectureSchedule::where('teacher_id', $request->user_id)->where('course_id', $request->course_id);
                if (!$checkCourses->exists()) {
                    TeacherLectureSchedule::create([
                        'teacher_id' => $request->user_id,
                        'course_id' => $request->course_id,
                        'time_from' => $request->time_from,
                        'time_to' => $request->time_to,
                        'day_id' => $request->day_id
                    ]);
                    // $checkCourses->forceDelete();
                }
                $checkLectureScheduleCourses = LectureSchedule::where('teacher_id', $request->user_id)->where('course_id', $request->course_id);
                if (!$checkLectureScheduleCourses->exists()) {
                    LectureSchedule::create([
                        'student_id' => $request->student_id,
                        'course_id' => $request->course_id,
                        'teacher_id' => $request->user_id,
                        'time_from' => $request->time_from,
                        'time_to' => $request->time_to,
                        'day_id' => $request->day_id
                    ]);
                    // $checkCourses->forceDelete();
                }
            }
            DB::commit();
            return redirect()->back()->withInput()->with('success', 'Data Saved Successfully');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function courseShifts($userId, $courseId, $shiftId, $dayIds, $userType)
    {
        $courseShift = CourseShift::where('course_id', $courseId)->where('shift_id', $shiftId)->whereIn('day_id', $dayIds)->get();
        if ($userType == 'student') {
            $studentLectureSchedule = StudentLectureSchedule::query();
            foreach ($courseShift as $key => $value) {
                $studentLectureSchedule->create([
                    'student_id' => $userId,
                    'course_shift_id' => $value->id,
                    'course_id' => $value->course_id,
                ]);
            }
        } else if ($userType == 'teacher') {
            $teacherLectureSchedule = TeacherLectureSchedule::query();
            foreach ($courseShift as $key => $value) {
                $teacherLectureSchedule->create([
                    'teacher_id' => $userId,
                    'course_shift_id' => $value->id,
                    'course_id' => $value->course_id,
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function fetchUserCourses(Request $request)
    {
        try {
            if (Auth::user()->hasRole('student') || Auth::user()->hasRole('teacher')) {
                $enrolledCoursesIds = Enrollment::where('user_id', Auth::user()->id)->pluck('course_id');
                $courses = Course::whereIn('id', $enrolledCoursesIds)->get();
            } else {
                $courses = Course::get();
            }
            return response()->json([
                'status' => true,
                'data' => $courses,
                'msg' => 'Successfull'
            ]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'status' => false,
                'data' => [],
                'msg' => 'Error'
            ]);
        }
    }

    public function fetchCourseTeachers(Request $request)
    {
        try {
            if (Auth::user()->hasRole('admin')) {
                $teacherIds = Teacher::query()->pluck('user_id');
                $enrolledTeachers = TeacherLectureSchedule::with('teacher')->where('course_id', $request->course_id)->whereIn('teacher_id', $teacherIds)->get();
            } else {
                $enrolledTeachers = Teacher::get();
            }
            return response()->json([
                'status' => true,
                'data' => $enrolledTeachers,
                'msg' => 'Successfull'
            ]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'status' => false,
                'data' => [],
                'msg' => 'Error'
            ]);
        }
    }
}
