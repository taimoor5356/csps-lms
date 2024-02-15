<?php

namespace App\Http\Controllers;

use App\Interfaces\LectureScheduleRepositoryInterface;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\LectureSchedule;
use App\Models\StudentLectureSchedule;
use App\Models\TeacherLectureSchedule;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LectureScheduleController extends Controller
{
    private LectureScheduleRepositoryInterface $lectureScheduleRepository;

    public function __construct(LectureScheduleRepositoryInterface $lectureScheduleRepository)
    {
        $this->lectureScheduleRepository = $lectureScheduleRepository;
    }

    public function showTableData($data, $trashed)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('days', function ($row) {
                if ($row) {
                    return $row->day;
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('time_from', function ($row) {
                if ($row) {
                    return $row->time_from;
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('time_to', function ($row) {
                if ($row) {
                    return $row->time_to;
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('actions', function ($row) use ($trashed) {
                $btn = '';
                if ($trashed == null) {
                    $url = route("teacher_lecture_schedules", [$row->id]);
                    $btn .= '
                        <a href="'.$url.'" class="btn btn-success bg-success p-1 -view-student-detail" data-student-id="'. $row->id .'" title="View" data-toggle="modal" data-bs-target="#modal-default"><i class="fa fa-eye"></i></a>
                        <a href="lectures/'. $row->id .'/edit" data-student-id="'. $row->id .'" class="btn btn-primary bg-primary p-1" title="Edit"><i class="fa fa-pencil"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['days', 'time_from', 'time_to', 'actions'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        //
        $lecture = Lecture::where('id', $id)->first();
        if ($request->ajax()) {
            $lectureSchedules = LectureSchedule::where('lecture_id', $id)->get();
            return $this->showTableData($lectureSchedules, $trashed = null);
        }
        $courses = Course::get();
        return view('lecture_schedule.index', compact('lecture', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $courses = Course::query();
        return view('lecture_schedule.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $courseId)
    {
        //
        return $this->lectureScheduleRepository->store($request->all(), $courseId);
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
        return $this->lectureScheduleRepository->show($id);
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
        return $this->lectureScheduleRepository->edit($id);
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
        return $this->lectureScheduleRepository->update($request, $id);
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

    public function showTableDataTeacherLectureSchedules($data, $trashed)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('days', function ($row) {
                if ($row) {
                    return $row->day;
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('time_from', function ($row) {
                if ($row) {
                    return $row->time_from;
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('time_to', function ($row) {
                if ($row) {
                    return $row->time_to;
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('actions', function ($row) use ($trashed) {
                $btn = '';
                if ($trashed == null) {
                    $url = route("teacher_lecture_schedules", [$row->id]);
                    $btn .= '
                        <a href="'.$url.'" class="btn btn-success bg-success p-1 -view-student-detail" data-student-id="'. $row->id .'" title="View" data-toggle="modal" data-bs-target="#modal-default"><i class="fa fa-eye"></i></a>
                        <a href="lectures/'. $row->id .'/edit" data-student-id="'. $row->id .'" class="btn btn-primary bg-primary p-1" title="Edit"><i class="fa fa-pencil"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['days', 'time_from', 'time_to', 'actions'])
            ->make(true);
    }

    public function teacherLectureSchedules(Request $request, $lectureScheduleId)
    {
        try {
            $teacherLectureSchedules = TeacherLectureSchedule::with('students_lecture_schedule', 'teacher')->where('lecture_schedule_id', $lectureScheduleId);
            return view('lecture_schedule.teacher', compact('teacherLectureSchedules'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function studentLectureSchedules(Request $request, $teacherId)
    {
        try {
            $teacherLectureSchedules = StudentLectureSchedule::with('student.user')->where('teacher_lecture_schedule_id', $teacherId)->get();
            return $this->showTableDataStudentLectureSchedules($teacherLectureSchedules, $trashed = null);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function showTableDataStudentLectureSchedules($data, $trashed)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('student_name', function ($row) {
                if ($row->student->user) {
                    return $row->student->user->name;
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('actions', function ($row) use ($trashed) {
                $btn = '';
                if ($trashed == null) {
                    $url = route("teacher_lecture_schedules", [$row->id]);
                    $btn .= '
                        <a href="'.$url.'" class="btn btn-success bg-success p-1 -view-student-detail" data-student-id="'. $row->id .'" title="View" data-toggle="modal" data-bs-target="#modal-default"><i class="fa fa-eye"></i></a>
                        <a href="lectures/'. $row->id .'/edit" data-student-id="'. $row->id .'" class="btn btn-primary bg-primary p-1" title="Edit"><i class="fa fa-pencil"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['days', 'time_from', 'time_to', 'actions'])
            ->make(true);
    }
}
