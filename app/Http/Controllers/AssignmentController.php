<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $userType = null, $userId = null)
    {
        //
        try {
            if (Auth::user()->hasRole('student')) {
                $student = Student::where('user_id', Auth::user()->id)->first();
                if (isset($student)) {
                    $assignments = Assignment::with('student', 'teacher')->where('student_id', $student->id);
                }
            } else if (Auth::user()->hasRole('teacher')) {
                $teacher = Teacher::where('user_id', Auth::user()->id)->first();
                if (isset($teacher)) {
                    $assignments = Assignment::with('student', 'teacher')->where('student_id', $teacher->id);
                }
            } else {
                if (($userType == 'student') && (!empty($userId))) {
                    $assignments = Assignment::with('student', 'teacher')->where('student_id', $userId);
                } else if (($userType == 'teacher') && (!empty($userId))) {
                    $assignments = Assignment::with('student', 'teacher')->where('teacher_id', $userId);
                } else {
                    $assignments = Assignment::with('student', 'teacher');
                }
            }
            if ($request->ajax()) {
                $searchValue = $request->search['value'];
                // Apply global search
                if (!empty($searchValue)) {
                }
                $totalRecords = $assignments->count(); // Get the total number of records for pagination
                $data = $assignments->skip($request->start)
                    ->take($request->length);
                return DataTables::of($data->get())
                    ->addIndexColumn()
                    ->editColumn('name', function ($row) {
                        if (isset($row->student->user)) {
                            return $row->student->user->name;
                        }
                    })
                    ->editColumn('course_name', function ($row) {
                        if (isset($row->course)) {
                            return $row->course->name;
                        }
                    })
                    ->editColumn('batch_no', function ($row) {
                        if (isset($row->student->batch)) {
                            return $row->student->batch->batch;
                        }
                    })
                    ->editColumn('assignment', function ($row) {
                        $url = route('assignment.download', [$row->id]);
                        $btn = '<a href="'.$url.'"><i class="fa fa-download"></i> Download</a>';
                        return $btn;
                    })
                    ->editColumn('date_time', function ($row) {
                        return Carbon::parse($row->created_at)->format('Y-m-d H:i:s');
                    })
                    ->editColumn('status', function ($row) {
                        if ($row->status == 'checking') {
                            return '<div class="bg-warning text-white text-center rounded">'.$row->status.'</div>';
                        } else if ($row->status == 'completed') {
                            return '<div class="bg-success p-1 text-white text-center rounded">'.$row->status.'</div>';
                        } else {
                            return '<div class="bg-danger p-1 text-white text-center rounded">In complete</div>';
                        }
                    })
                    ->editColumn('action', function ($row) {
                        $completed = route('update_assignment_status', [$row->id, 'completed']);
                        $incomplete = route('update_assignment_status', [$row->id, 'incomplete']);
                        $btn = '<a href="'.$completed.'" class="btn btn-success p-1 m-1">Completed</a>
                        <a href="'.$incomplete.'" class="btn btn-danger p-1 m-1">Incomplete</a>';
                        return $btn;
                    })
                    ->rawColumns(['assignment', 'status', 'batch_no', 'action'])
                    ->setTotalRecords($totalRecords)
                    ->setFilteredRecords($totalRecords) // For simplicity, same as totalRecords
                    ->skipPaging()
                    ->make(true);
            }
            return view('assignments.index');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function downloadAssignment($id)
    {
        $assignment = Assignment::where('id', $id)->first();

        if (isset($assignment)) {
            $filePath = storage_path('files/' . $assignment->image);

            if (file_exists($filePath)) {
                $headers = [
                    'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                    'Pragma' => 'no-cache',
                    'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT',
                ];

                return response()->download($filePath, $assignment->image, $headers);
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } else {
            return redirect()->back()->with('error', 'Assignment not found');
        }
    }

    public function updateAssignmentStatus($id, $status)
    {
        try {
            $assignment = Assignment::where('id', $id)->first();
            if (isset($assignment)) {
                $assignment->status = $status;
                $assignment->save();
                return redirect()->back()->with('success', 'Assignment updated successfully');
            } else {
                return redirect()->back()->with('error', 'Assignment not found');
            }
        } catch (\Exception $e) {
            //throw $th;
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

    public function teacherAssignment(Request $request)
    {
        return view('assignments.teacher');
    }
}
