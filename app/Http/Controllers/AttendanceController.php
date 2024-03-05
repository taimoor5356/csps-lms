<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\StudentLectureSchedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTableData($request, $data, $trashed, $userType = null)
    {
        try {
            $searchValue = $request->search['value'];
            // Apply global search
            if (!empty($searchValue)) {
            }
            if (!empty($request->course_id)) {
                $data = $data->whereHas('enrolled_courses', function($q) use ($request) {
                    $q->where('course_id', '=', $request->course_id);
                });
            }
            if (!empty($request->date_from)) {
                $data = $data->whereDate('created_at', '>=', $request->date_from);
            }
            if (!empty($request->date_to)) {
                $data = $data->whereDate('created_at', '<=', $request->date_to);
            }
            if (!empty($request->batch_id)) {
                $data = $data->whereHas('student.batch', function($q) use ($request) {
                    $q->where('id', '=', $request->batch_id);
                });
            }
            $totalRecords = $data->count(); // Get the total number of records for pagination
            $users = $data->skip($request->start)
                ->take($request->length);
            return DataTables::of($users->get())
                ->addIndexColumn()
                ->editColumn('date_time', function ($row) {
                    return Carbon::parse($row->created_at)->format('Y-m-d h:i:s A');
                })
                ->editColumn('name', function ($row) {
                    if (Auth::user()->hasRole('student')) {
                        if (isset($row->user)) {
                            return $row->user->name;
                        } else {
                            return '';
                        }
                    }
                    if (isset($row->user)) {
                        return $row->user->name;
                    } else {
                        return $row->name;
                    }
                })
                ->editColumn('reg_number', function ($row) use ($userType) {
                    if (Auth::user()->hasRole('student')) {
                        if (isset($row->user->student)) {
                            return $row->user->student->roll_no;
                        } else {
                            return '';
                        }
                    }
                    if ($userType == 'students') {
                        if (isset($row->user->student)) {
                            return $row->user->student->roll_no;
                        } else {
                            return $row->student->roll_no;
                        }
                    }
                })
                ->editColumn('batch_no', function ($row) use ($userType){
                    if (Auth::user()->hasRole('student')) {
                        if (isset($row->user->student)) {
                            return $row->user->student->batch->batch;
                        } else {
                            return '';
                        }
                    }
                    if ($userType == 'students') {
                        if (isset($row->user->student)) {
                            return $row->user->student->batch->batch;
                        } else {
                            return $row->student->batch->batch;
                        }
                    }
                })
                ->editColumn('attendance', function ($row) {
                    if (Auth::user()->hasRole('student')) {
                        if (isset($row->user->student)) {
                            return $row->attendance;
                        } else {
                            return '';
                        }
                    }
                    $attendance = Attendance::whereDate('created_at', Carbon::now())->where('user_id', $row->id)->where('attendance', 'present')->first();
                    return isset($attendance) ? $attendance->attendance : 'Absent';
                })
                ->editColumn('course', function ($row) {
                    if (Auth::user()->hasRole('student')) {
                        if (isset($row->course)) {
                            return $row->course->name;
                        } else {
                            return '';
                        }
                    }
                    $html = '<select class="form-control course_id"><option value="" selected disabled>Select Course</option>';
                    if ($row->enrolled_courses) {
                        foreach ($row->enrolled_courses as $key => $course) {
                            $html .= '<option value="'.$course->course->id.'">'.$course->course->name.'</option>';
                        }
                    } else if ($row->user->enrolled_courses) {
                        foreach ($row->user->enrolled_courses as $key => $course) {
                            $html .= '<option value="'.$course->course->id.'">'.$course->course->name.'</option>';
                        }
                    }
                    $html .= '</select>';
                    return $html;
                })
                ->editColumn('action', function ($row) use ($trashed, $userType) {
                    $btn = '';
                    if ($trashed == null) {
                        if ($userType == 'students') {
                            if (isset($row->student) || isset($row->teacher)) {
                                $btn .= '
                                <button class="mark-attendance btn btn-success my-2 p-1 bg-success" data-batch-id="'.(isset($row->student) ? $row->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="present" data-user-id="' . $row->id . '" title="Present">Present</button> | 
                                <button class="mark-attendance btn btn-danger my-2 p-1 bg-danger" data-batch-id="'.(isset($row->student) ? $row->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="absent" data-user-id="' . $row->id . '" title="Absent">Absent</button> | 
                                <button class="mark-attendance btn btn-warning my-2 p-1 bg-warning" data-batch-id="'.(isset($row->student) ? $row->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="late" data-user-id="' . $row->id . '" title="Late">Late</button> | 
                                <button class="mark-attendance btn btn-dark my-2 p-1 bg-dark" data-batch-id="'.(isset($row->student) ? $row->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="half_day" data-user-id="' . $row->id . '" title="Half Day">Half Day</button> | 
                                <button class="mark-attendance btn btn-primary my-2 p-1 bg-primary" data-batch-id="'.(isset($row->student) ? $row->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="leave" data-user-id="' . $row->id . '" title="Leave">Leave</button> | 
                                <a href="'.route('attendances', ['students', $row->id]).'" class="btn btn-secondary my-2 p-1 bg-secondary" title="View All Attendance">View All</a>';
                            }
                            if (isset($row->user->student)) {
                                $btn .= '
                                <button class="mark-attendance btn btn-success my-2 p-1 bg-success" data-batch-id="'.(isset($row->user->student) ? $row->user->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="present" data-user-id="' . $row->id . '" title="Present">Present</button> | 
                                <button class="mark-attendance btn btn-danger my-2 p-1 bg-danger" data-batch-id="'.(isset($row->user->student) ? $row->user->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="absent" data-user-id="' . $row->id . '" title="Absent">Absent</button> | 
                                <button class="mark-attendance btn btn-warning my-2 p-1 bg-warning" data-batch-id="'.(isset($row->user->student) ? $row->user->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="late" data-user-id="' . $row->id . '" title="Late">Late</button> | 
                                <button class="mark-attendance btn btn-dark my-2 p-1 bg-dark" data-batch-id="'.(isset($row->user->student) ? $row->user->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="half_day" data-user-id="' . $row->id . '" title="Half Day">Half Day</button> | 
                                <button class="mark-attendance btn btn-primary my-2 p-1 bg-primary" data-batch-id="'.(isset($row->user->student) ? $row->user->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="leave" data-user-id="' . $row->id . '" title="Leave">Leave</button> | 
                                <a href="'.route('attendances', ['students', $row->id]).'" class="btn btn-secondary my-2 p-1 bg-secondary" title="View All Attendance">View All</a>';
                            }
                        } else if ($userType == 'teachers') {
                            if (isset($row->student) || isset($row->teacher)) {
                                $btn .= '
                                <button class="mark-attendance btn btn-success my-2 p-1 bg-success" data-batch-id="'.(isset($row->student) ? $row->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="present" data-user-id="' . $row->id . '" title="Present">Present</button> | 
                                <button class="mark-attendance btn btn-danger my-2 p-1 bg-danger" data-batch-id="'.(isset($row->student) ? $row->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="absent" data-user-id="' . $row->id . '" title="Absent">Absent</button> | 
                                <button class="mark-attendance btn btn-warning my-2 p-1 bg-warning" data-batch-id="'.(isset($row->student) ? $row->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="late" data-user-id="' . $row->id . '" title="Late">Late</button> | 
                                <button class="mark-attendance btn btn-dark my-2 p-1 bg-dark" data-batch-id="'.(isset($row->student) ? $row->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="half_day" data-user-id="' . $row->id . '" title="Half Day">Half Day</button> | 
                                <button class="mark-attendance btn btn-primary my-2 p-1 bg-primary" data-batch-id="'.(isset($row->student) ? $row->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="leave" data-user-id="' . $row->id . '" title="Leave">Leave</button> | 
                                <a href="'.route('attendances', ['students', $row->id]).'" class="btn btn-secondary my-2 p-1 bg-secondary" title="View All Attendance">View All</a>';
                            }
                            if (isset($row->user->teacher)) {
                                $btn .= '
                                <button class="mark-attendance btn btn-success my-2 p-1 bg-success" data-batch-id="'.(isset($row->user->teacher) ? $row->user->teacher->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="present" data-user-id="' . $row->id . '" title="Present">Present</button> | 
                                <button class="mark-attendance btn btn-danger my-2 p-1 bg-danger" data-batch-id="'.(isset($row->user->teacher) ? $row->user->teacher->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="absent" data-user-id="' . $row->id . '" title="Absent">Absent</button> | 
                                <button class="mark-attendance btn btn-warning my-2 p-1 bg-warning" data-batch-id="'.(isset($row->user->teacher) ? $row->user->teacher->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="late" data-user-id="' . $row->id . '" title="Late">Late</button> | 
                                <button class="mark-attendance btn btn-dark my-2 p-1 bg-dark" data-batch-id="'.(isset($row->user->teacher) ? $row->user->teacher->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="half_day" data-user-id="' . $row->id . '" title="Half Day">Half Day</button> | 
                                <button class="mark-attendance btn btn-primary my-2 p-1 bg-primary" data-batch-id="'.(isset($row->user->teacher) ? $row->user->teacher->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="leave" data-user-id="' . $row->id . '" title="Leave">Leave</button> | 
                                <a href="'.route('attendances', ['students', $row->id]).'" class="btn btn-secondary my-2 p-1 bg-secondary" title="View All Attendance">View All</a>';
                            }
                        }
                    }
                    return $btn;
                })
                ->rawColumns(['course', 'action'])
                ->setTotalRecords($totalRecords)
                ->setFilteredRecords($totalRecords) // For simplicity, same as totalRecords
                ->skipPaging()
                ->make(true);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $userType = null, $userId = null)
    {
        //
        try {
            if ($request->ajax()) {
                $user = User::withoutGlobalScopes()->orderBy('created_at', 'desc');
                if (Auth::user()->hasRole('teacher')) {
                    $studentIds = StudentLectureSchedule::with('course', 'student', 'teacher')->TeacherStudent(Auth::user()->id, $studentId = null, $courseId = null, 'teacher_students')->pluck('student_id');
                    $attendance = $user->with('student', 'enrolled_courses.course', 'attendance')->whereIn('id', $studentIds);
                } else if (Auth::user()->hasRole('student')) {
                    if (!is_null($userId)) {
                        $user = $user->where('id', $userId);
                    }
                    $attendance = Attendance::with('user.student.batch', 'course', 'batch')->where('user_id', Auth::user()->id);
                } else {
                    if ($userType == 'students') {
                        if (!is_null($userId)) {
                            $user = $user->where('id', $userId);
                            $attendance = Attendance::with('user.student.batch', 'user.enrolled_courses.course', 'user.attendance')->where('user_id', $userId);
                        } else {
                            $attendance = $user->with('student.batch', 'enrolled_courses.course', 'attendance')->where('role_id', 3);
                        }
                    } else if ($userType == 'teachers') {
                        if (!is_null($userId)) {
                            $user = $user->where('id', $userId);
                            $attendance = Attendance::with('user.teacher.batch', 'user.enrolled_courses.course', 'user.attendance')->where('user_id', $userId);
                        } else {
                            $attendance = $user->with('teacher', 'attendance')->where('role_id', 2);
                        }
                    } else if ($userType == 'staff') {
                        if (!is_null($userId)) {
                            $user = $user->where('id', $userId);
                        }
                        $attendance = $user->with('attendance')->whereNotIn('role_id', [1,2,3,4]);
                    }
                }
                return $this->showTableData($request, $attendance, $trashed = null, $userType);
            }
            if ($userType == 'students') {
                return view('attendance.students', compact('userId', 'userType'));
            } else if ($userType == 'teachers') {
                return view('attendance.teachers', compact('userId', 'userType'));
            } else if ($userType == 'staff') {
                return view('attendance.office_staff', compact('userId', 'userType'));
            }
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
    public function create()
    {
        //
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

    public function teacherStudentAttendance(Request $request)
    {
        return view('attendance.teachers_student');
    }

    public function markAttendance(Request $request)
    {
        try {
            $attendance = new Attendance();
            if (empty($request->user_id) || empty($request->course_id) || empty($request->batch_id) || empty($request->attendance)) {
                return response()->json([
                    'status' => false,
                    'msg' => 'All fields are required'
                ]);
            }
            if (Attendance::where('user_id', $request->user_id)->where('course_id', $request->course_id)->whereDate('created_at', Carbon::now())->exists()) {
                return response()->json([
                    'status' => false,
                    'msg' => 'Today\'s attendance for this course is already marked. Contact your administrator to update.'
                ]);
            }
            $attendance->user_id = $request->user_id;
            $attendance->course_id = $request->course_id;
            $attendance->batch_id = $request->batch_id;
            $attendance->attendance = $request->attendance;
            $attendance->save();
            return response()->json([
                'status' => true,
                'msg' => 'Attendance marked successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong'
            ]);
        }
    }
}
