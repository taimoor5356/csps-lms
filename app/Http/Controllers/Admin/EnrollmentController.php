<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
                            <img src="' . $url . '/public/assets/img/courses/' . $row->course->image . '" class="avatar avatar-lg"
                                alt="Course">
                        </div>
                    </div>
                    ';
                } else {
                    return '';
                }
            })
            ->addColumn('student_name', function ($row) {
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
            ->addColumn('name', function ($row) {
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
            ->addColumn('action', function ($row) use ($trashed) {
                $btn = '';
                if (Auth::user()->hasanyrole('admin|manager')) {
                    if ($trashed == null) {
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
            ->rawColumns(['image', 'student_name', 'name', 'fee', 'action'])
            ->make(true);
    }

    public function index(Request $request)
    {
        //
        try {
            $enrollments = Enrollment::get();
            if (Auth::user()->hasRole('student')) {
                $enrollments = Enrollment::where('user_id', Auth::user()->id)->get();
            }
            if ($request->ajax()) {
                return $this->showTableData($enrollments, $trashed = null);
            }
            return view('admin.enrollment.index');
        } catch (\Throwable $th) {
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
        $students = Student::with('user')->get();
        $courses = Course::get();
        return view('admin.enrollment.create', compact('students', 'courses'));
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
            $enrollment->user_id = $request->user_id;
            $enrollment->course_id = $request->course_id;
            $enrollment->enrolled_date = Carbon::now()->format('Y-m-d');
            if (Enrollment::where('user_id', $request->user_id)->where('course_id', $request->course_id)->exists()) {
                return redirect()->back()->with('error', 'Already Enrolled');
            } else {
                $enrollment->save();
            }
            DB::commit();
            return redirect()->back()->withInput()->with('success', 'Data Saved Successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong');
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
}
