<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Interfaces\LectureRepositoryInterface;
use App\Models\Lecture;
use App\Models\StudentLectureSchedule;
use App\Models\TeacherLectureSchedule;

class LectureRepository implements LectureRepositoryInterface 
{
    public function showTableData($data, $trashed)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('course_name', function ($row) {
                if (Auth::user()->hasRole('admin')) {
                    if ($row->course) {
                        return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->course->name . '</h6>
                            </div>
                        </div>
                        ';
                    } else {
                        return 'No Data';
                    }
                } else if (Auth::user()->hasRole('teacher')) {
                    if ($row->lecture->course) {
                        return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->lecture->course->name . '</h6>
                            </div>
                        </div>
                        ';
                    } else {
                        return 'No Data';
                    }
                } else if (Auth::user()->hasRole('student')) {
                    if ($row->lecture->course) {
                        return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->lecture->course->name . '</h6>
                            </div>
                        </div>
                        ';
                    } else {
                        return 'No Data';
                    }
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('lecturer_name', function ($row) {
                if (Auth::user()->hasRole('admin')) {
                    if (isset($row->teachers->teacher)) {
                        return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->teachers->teacher->user->name . '</h6>
                            </div>
                        </div>
                        ';
                    } else {
                        return 'No Data';
                    }
                } else if (Auth::user()->hasRole('teacher')) {
                    if (isset($row->lecture->teachers->teacher)) {
                        return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->lecture->teachers->teacher->user->name . '</h6>
                            </div>
                        </div>
                        ';
                    } else {
                        return 'No Data';
                    }
                } else if (Auth::user()->hasRole('student')) {
                    if (isset($row->lecture->teachers->teacher)) {
                        return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->lecture->teachers->teacher->user->name . '</h6>
                            </div>
                        </div>
                        ';
                    } else {
                        return 'No Data';
                    }
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('student_name', function ($row) {
                if (Auth::user()->hasRole('admin')) {
                    if (count($row->students) > 0) {
                        $html = '';
                        for ($i = 0; $i < 3; $i++) {
                            if (isset($row->students[$i])) {
                                $html .= '
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">' . $row->students[$i]->student->user->name . '...</h6>
                                    </div>
                                </div>
                                ';
                                break;
                            } else {
                                return 'No Data';
                            }
                        }
                        return $html;
                    } else {
                        return 'No Data';
                    }
                } else if (Auth::user()->hasRole('teacher')) {
                    if (!empty($row->student->user)) {
                        return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->student->user->name . '</h6>
                            </div>
                        </div>
                        ';
                    } else {
                        return 'No Data';
                    }
                } else if (Auth::user()->hasRole('student')) {
                    if (!empty($row->student->user)) {
                        return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->student->user->name . '</h6>
                            </div>
                        </div>
                        ';
                    } else {
                        return 'No Data';
                    }
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('starting_date', function ($row) {
                if (Auth::user()->hasRole('admin')) {
                    return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->start_date . '</h6>
                            </div>
                        </div>
                    ';
                } else if (Auth::user()->hasRole('teacher')) {
                    return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->lecture->start_date . '</h6>
                            </div>
                        </div>
                    ';
                } else if (Auth::user()->hasRole('student')) {
                    return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->lecture->start_date . '</h6>
                            </div>
                        </div>
                    ';
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('ending_date', function ($row) {
                if (Auth::user()->hasRole('admin')) {
                    return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->end_date . '</h6>
                            </div>
                        </div>
                    ';
                } else if (Auth::user()->hasRole('teacher')) {
                    return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->lecture->end_date . '</h6>
                            </div>
                        </div>
                    ';
                } else if (Auth::user()->hasRole('student')) {
                    return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->lecture->end_date . '</h6>
                            </div>
                        </div>
                    ';
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('action', function ($row) use ($trashed) {
                $btn = '';
                if ($trashed == null) {
                    $btn .= '
                        <a href="lectures/'.$row->id.'/show" class="btn btn-success bg-success p-1 -view-student-detail" data-student-id="'. $row->id .'" title="View" data-toggle="modal" data-bs-target="#modal-default"><i class="fa fa-eye"></i></a>
                        <a href="lectures/'. $row->id .'/edit" data-student-id="'. $row->id .'" class="btn btn-primary bg-primary p-1" title="Edit"><i class="fa fa-pencil"></i></a>';
                    if (Auth::user()->can('student_delete')) {
                        $btn .='<a href="lectures/'. $row->id .'/delete" data-student-id="'. $row->id .'" class="mx-1 btn btn-danger bg-danger p-1 delete-student" title="Delete"><i class="fa fa-trash-o"></i></a>';
                    }
                } else {
                    $btn .= '
                        <a href="'. $row->id .'/restore" data-student-id="'. $row->id .'" class="btn btn-success bg-success p-1" title="Restore"><i class="fa fa-undo"></i></a>';
                    $btn .='
                        <a href="'. $row->id .'/delete" data-student-id="'. $row->id .'" class="btn btn-danger bg-danger p-1 delete-student" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>
                    ';
                }
                return $btn;
            })
            ->rawColumns(['course_name', 'lecturer_name', 'student_name', 'starting_date', 'ending_date', 'action'])
            ->make(true);
    }

    public function index($request) 
    {
        try {
            $lecturesDetail = Lecture::with('course', 'teachers.teacher.user', 'students.student.user')->get();
            if (Auth::user()->hasRole('teacher')) {
                // $lecturesDetail = TeacherLectureSchedule::with('lecture.course', 'lecture.teachers.teacher.user', 'student.user')->where('teacher_id', Auth::user()->id)->get();
            }
            if (Auth::user()->hasRole('student')) {
                $lecturesDetail = StudentLectureSchedule::with('lecture.course', 'lecture.teachers.teacher.user', 'student.user')->where('student_id', Auth::user()->student->id)->get();
            }
            return $this->showTableData($lecturesDetail, $trashed = null);
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withError('Something went wrong');
        }
    }

    public function create()
    {
        
    }

    public function show($id) 
    {
        $lecture = Lecture::with('course', 'teachers', 'students')->where('id', $id)->first();
        return view('lectures.show', compact('lecture', 'id'));
    }

    public function store($request) 
    {
        try {
            DB::beginTransaction();
            $request = (object)$request;
            $lecture = Lecture::create([
                'course_id' => $request->course_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Data Saved Successfully']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => 'Something went wrong']);
        }
    }

    public function edit($id)
    {
        return 'Edit page';
    }

    public function update($request, $id) 
    {
        try {
            $request = (object)$request;
            if (!empty($request->teacher_id)) {
                TeacherLectureSchedule::create([
                    'teacher_id' => $request->teacher_id,
                    'lecture_id' => $id,
                    'assigned_date' => Carbon::now()->format('Y-m-d')
                ]);
            }
            if (!empty($request->user_id)) {
                if (!StudentLectureSchedule::where('student_id', $request->user_id)->where('lecture_id', $id)->exists()) {
                    StudentLectureSchedule::create([
                        'student_id' => $request->user_id,
                        'lecture_id' => $id,
                        'assigned_date' => Carbon::now()->format('Y-m-d')
                    ]);
                }
            }
            return response()->json([
                'status' => true,
                'msg' => 'Successfully updated'
            ]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong'
            ]);
        }
    }

    public function destroy($id) 
    {
        try {
            $student = Student::with('user')->where('id', $id)->first();
            if (isset($student)) {
                if (isset($student->user)) {
                    $student->user->delete();
                    $student->delete();
                    return redirect()->back()->with('success', 'Deleted Successfully');
                }
            } else {
                return redirect()->back()->with('error', 'User doesnot exists');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function trashed($request)
    {
        $trashedLectures = Student::with(['user' => fn($q) => $q->onlyTrashed()])->onlyTrashed()->get();
        try {
            return $this->showTableData($trashedLectures, $trashed = 'trashed');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function restore($id)
    {
        try {
            $trashedStudent = Student::with(['user' => fn($q) => $q->onlyTrashed()])->where('id', $id)->onlyTrashed()->first();
            if (isset($trashedStudent)) {
                $trashedStudent->user->restore();
                $trashedStudent->restore();
                return redirect()->back()->with('success', 'Student data Restored');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function getFulfilledLectures() 
    {
        return Student::where('is_fulfilled', true);
    }

    public function fetchTeachers(Request $request)
    {
        
    }

    public function fetchStudents($request)
    {
        $request = (object)$request;
        $students = StudentLectureSchedule::with('student.user')->where('lecture_id', $request->lecture_id)->get();
        
        return DataTables::of($students)
            ->addIndexColumn()
            ->addColumn('student_name', function ($row) {
                if (Auth::user()->hasRole('admin')) {
                    if (!empty($row->student->user)) {
                        return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->student->user->name . '</h6>
                            </div>
                        </div>
                        ';
                    } else {
                        return 'No Data';
                    }
                } else if (Auth::user()->hasRole('teacher')) {
                    if (!empty($row->student->user)) {
                        return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->student->user->name . '</h6>
                            </div>
                        </div>
                        ';
                    } else {
                        return 'No Data';
                    }
                } else if (Auth::user()->hasRole('student')) {
                    if (!empty($row->student->user)) {
                        return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->student->user->name . '</h6>
                            </div>
                        </div>
                        ';
                    } else {
                        return 'No Data';
                    }
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('roll_no', function ($row) {
                if (Auth::user()->hasRole('admin')) {
                    if (!empty($row->student->user)) {
                        return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->student->roll_no . '</h6>
                            </div>
                        </div>
                        ';
                    } else {
                        return 'No Data';
                    }
                } else if (Auth::user()->hasRole('teacher')) {
                    if (!empty($row->student->user)) {
                        return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->student->roll_no . '</h6>
                            </div>
                        </div>
                        ';
                    } else {
                        return 'No Data';
                    }
                } else if (Auth::user()->hasRole('student')) {
                    if (!empty($row->student->user)) {
                        return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->student->roll_no . '</h6>
                            </div>
                        </div>
                        ';
                    } else {
                        return 'No Data';
                    }
                } else {
                    return 'No Data';
                }
            })
            ->rawColumns(['student_name', 'roll_no'])
            ->make(true);
    }
}
