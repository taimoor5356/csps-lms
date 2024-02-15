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
    public function showTableData($request, $data, $trashed)
    {
        try {
            $searchValue = $request->search['value'];
            // Apply global search
            if (!empty($searchValue)) {
            }
            $totalRecords = $data->count(); // Get the total number of records for pagination
            $feePlan = $data->skip($request->start)
                ->take($request->length);
            return DataTables::of($feePlan->get())
                ->addIndexColumn()
                ->editColumn('name', function ($row) {
                    if (isset($row)) {
                        return $row->name;
                    }
                })
                ->editColumn('reg_number', function ($row) {
                    if (isset($row->student)) {
                        return $row->student->roll_no;
                    }
                })
                ->editColumn('batch_no', function ($row) {
                    if (isset($row->student)) {
                        return $row->student->batch_no;
                    }
                })
                ->editColumn('attendance', function ($row) {
                    $attendance = Attendance::whereDate('created_at', Carbon::now())->where('user_id', $row->id)->where('attendance', 'present')->first();
                    return isset($attendance) ? $attendance->attendance : 'Absent';
                })
                ->editColumn('course', function ($row) {
                    return '<select class="form-control"><option></option></select>';
                })
                ->editColumn('action', function ($row) use ($trashed) {
                    $btn = '';
                    if ($trashed == null) {
                        $btn .= '
                        <button class="mark-attendance btn btn-success my-2 p-1 bg-success" data-batch-id="'.(isset($row->student) ? $row->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="present" data-user-id="' . $row->id . '" title="Present">Present</button> | 
                        <button class="mark-attendance btn btn-danger my-2 p-1 bg-danger" data-batch-id="'.(isset($row->student) ? $row->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="absent" data-user-id="' . $row->id . '" title="Absent">Absent</button> | 
                        <button class="mark-attendance btn btn-warning my-2 p-1 bg-warning" data-batch-id="'.(isset($row->student) ? $row->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="late" data-user-id="' . $row->id . '" title="Late">Late</button> | 
                        <button class="mark-attendance btn btn-dark my-2 p-1 bg-dark" data-batch-id="'.(isset($row->student) ? $row->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="half_day" data-user-id="' . $row->id . '" title="Half Day">Half Day</button> | 
                        <button class="mark-attendance btn btn-primary my-2 p-1 bg-primary" data-batch-id="'.(isset($row->student) ? $row->student->batch_no : (isset($row->teacher) ? $row->teacher->batch_no : 0)).'" data-attendance="leave" data-user-id="' . $row->id . '" title="Leave">Leave</button>';
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
                if (Auth::user()->hasRole('admin')) {
                    if ($userType == 'students') {
                        if (!is_null($userId)) {
                            $user = $user->where('id', $userId);
                        }
                        $attendance = $user->with('student', 'attendance')->where('role_id', 3);
                    } else if ($userType == 'teachers') {
                        if (!is_null($userId)) {
                            $user = $user->where('id', $userId);
                        }
                        $attendance = $user->with('teacher', 'attendance')->where('role_id', 2);
                    } else if ($userType == 'staff') {
                        if (!is_null($userId)) {
                            $user = $user->where('id', $userId);
                        }
                        $attendance = $user->with('attendance')->whereNotIn('role_id', [1,2,3,4]);
                    }
                } else if (Auth::user()->hasRole('teacher')) {
                    $studentIds = StudentLectureSchedule::with('course', 'student', 'teacher')->TeacherStudent(Auth::user()->id, $studentId = null, $courseId = null, 'teacher_students')->pluck('student_id');
                    $attendance = $user->whereIn('id', $studentIds);
                } else if (Auth::user()->hasRole('student')) {

                }
                return $this->showTableData($request, $attendance, $trashed = null);
            }
            if ($userType == 'students') {
                return view('attendance.students', compact('userId'));
            } else if ($userType == 'teachers') {
                return view('attendance.teachers', compact('userId'));
            } else if ($userType == 'staff') {
                return view('attendance.office_staff', compact('userId'));
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
