<?php

namespace App\Http\Controllers;

use App\Models\TeacherLectureSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TeacherLectureScheduleController extends Controller
{
    public function teacherCourseDetails(Request $request, $courseId, $userId)
    {
        try {
            $teacherLectureSchedule = TeacherLectureSchedule::with('course_shift.shift')->where('teacher_id', $userId)->where('course_id', $courseId)->get();
            dd($teacherLectureSchedule);
            if ($request->ajax()) {
                return DataTables::of($teacherLectureSchedule)
            ->addIndexColumn()
            ->addColumn('shift', function ($row) {
                if (isset($row->user)) {
                    return '
                    <div class="">
                        <div class="">
                            <h6 class="mb-0 text-sm">' . $row->user->name . '</h6>
                        </div>
                    </div>
                    ';
                } else {
                    return '';
                }
            })
            ->addColumn('action', function ($row) use ($trashed) {
                $btn = '';
                if (Auth::user()->hasanyrole('admin|manager')) {
                    if ($trashed == null) {
                        if ($row->user->hasRole('teacher')) {
                            $lectureDetailsURL = route('teacher_lecture_details', [$row->course_id, $row->user_id]);
                            $btn .= '
                                <a href="'.$lectureDetailsURL.'" data-enrollment-id="' . $row->id . '" class="btn btn-success bg-success p-1" title="Completed"><i class="fa fa-eye"></i></a>
                            ';
                            $updateLectureScheduleStatusURL = route('update_lecture_schedule_status', [$row->course_id, $row->user_id]);
                            $btn .= '
                                <a href="'.$updateLectureScheduleStatusURL.'" data-enrollment-id="' . $row->id . '" class="btn btn-success bg-success p-1" title="Completed"><i class="fa fa-check"></i></a>
                            ';
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
            ->rawColumns(['image', 'user_name', 'course_name', 'status', 'category', 'fee', 'marks', 'action'])
            ->make(true);
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
    
    public function updateStatus($courseId, $userId)
    {
        try {
            TeacherLectureSchedule::where('teacher_id', $userId)->where('course_id', $courseId)->update([
                'status' => 'completed'
            ]);
            return redirect()->back()->with('success', 'Updated successfully');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\TeacherLectureSchedule  $teacherLectureSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(TeacherLectureSchedule $teacherLectureSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeacherLectureSchedule  $teacherLectureSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherLectureSchedule $teacherLectureSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeacherLectureSchedule  $teacherLectureSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherLectureSchedule $teacherLectureSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeacherLectureSchedule  $teacherLectureSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherLectureSchedule $teacherLectureSchedule)
    {
        //
    }
}
