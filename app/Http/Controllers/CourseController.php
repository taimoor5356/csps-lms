<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Course;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Models\CourseShift;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Teacher;

class CourseController extends Controller
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
                return '    
                <div class="">
                    <div>
                        <img src="' . $url . '/public/assets/img/courses/' . $row->image . '" class="avatar avatar-lg"
                            alt="Course">
                    </div>
                </div>
            ';
            })
            ->addColumn('name', function ($row) {
                return '
                <div class="">
                    <div class="">
                        <h6 class="mb-0 text-sm">' . $row->name . '</h6>
                    </div>
                </div>
            ';
            })
            ->addColumn('category', function ($row) {
                return '
                <div class="">
                    <div class="">
                        <h6 class="mb-0 text-sm">' . $row->category . '</h6>
                    </div>
                </div>
            ';
            })
            ->addColumn('total_students', function ($row) {
                $userIds = Student::query()->pluck('user_id');
                $enrollments = Enrollment::whereIn('user_id', $userIds)->where('course_id', $row->id)->count();
                return '<div class="bg-light rounded text-dark p-2 text-center">'.$enrollments.'</div>';
            })
            ->addColumn('total_teachers', function ($row) {
                $userIds = Teacher::query()->pluck('user_id');
                $enrollments = Enrollment::whereIn('user_id', $userIds)->where('course_id', $row->id)->count();
                return '<div class="bg-light rounded text-dark p-2 text-center">'.$enrollments.'</div>';
            })
            ->addColumn('fee', function ($row) {
                return '
                    <div class="">
                        <div class="">
                            <h6 class="mb-0 text-sm">' . $row->fee . '</h6>
                        </div>
                    </div>
                ';
            })
            ->addColumn('marks', function ($row) {
                return '
                    <div class="">
                        <div class="">
                            <h6 class="mb-0 text-sm">' . $row->marks . ' marks</h6>
                        </div>
                    </div>
                ';
            })
            ->addColumn('action', function ($row) use ($trashed) {
                $btn = '';
                $url = route('lectures', [$row->id]);
                if ($trashed == null) {
                    $btn .= '
                        <a href="'.$url.'" class="btn btn-success bg-success p-1 view-course-detail" data-course-id="'. $row->id .'" title="View" data-toggle="modal" data-bs-target="#modal-default"><i class="fa fa-eye"></i></a>
                        <a href="courses/'. $row->id .'/edit" data-course-id="'. $row->id .'" class="btn btn-primary bg-primary p-1" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="courses/'. $row->id .'/delete" data-course-id="'. $row->id .'" class="btn btn-danger bg-danger p-1 delete-course" title="Delete"><i class="fa fa-trash-o"></i></a>
                    ';
                } else {
                    $btn .= '
                        <a href="'. $row->id .'/restore" data-course-id="'. $row->id .'" class="btn btn-success bg-success p-1" title="Restore"><i class="fa fa-undo"></i></a>
                        <a href="'. $row->id .'/delete" data-course-id="'. $row->id .'" class="btn btn-danger bg-danger p-1 delete-course" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>
                    ';
                }
                return $btn;
            })
            ->rawColumns(['image', 'name', 'category', 'total_students', 'total_teachers', 'fee', 'marks', 'action'])
            ->make(true);
    }
    
    // showTableData for Index and Trashed
    public function index(Request $request)
    {
        //
        try {
            $coursesDetail = Course::get();
            if ($request->ajax()) {
                return $this->showTableData($coursesDetail, $trashed = null);
            }
            return view('courses.index');
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
        return view('courses.create');
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
            if ($request->hasFile('image')) {
                if ($request->file('image')->getSize() > 500000) {
                    return redirect()->back()->with('error', 'Max 500KB image size allowed');
                }
                $file = time().'.'.$request->image->extension();
                $request->image->move(public_path('assets/img/courses/'), $file);
            } else {
                return redirect()->back()->with('error', 'Image Required');
            }
            $course = Course::create([
                'image' => $file,
                'name' => $request->name,
                'category' => $request->category,
                'fee' => $request->fee,
                'marks' => $request->marks,
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Updated Successfully');
            $courseShiftDays = new CourseShift();
            $firstShifts = $request->first_shift;
            $firstShiftDays = $request->first_shift_day;
            for ($i=0; $i < count($firstShiftDays); $i++) { 
                $courseShiftDays->course_id = $course->id;
                $courseShiftDays->shift_id = $firstShifts;
                $courseShiftDays->day_id = $firstShiftDays[$i];
                $courseShiftDays->save();
            }
            $secondShifts = $request->second_shift;
            $secondShiftDays = $request->second_shift_day;
            for ($j=0; $j < count($secondShiftDays); $j++) { 
                $courseShiftDays->course_id = $course->id;
                $courseShiftDays->shift_id = $secondShifts;
                $courseShiftDays->day_id = $secondShiftDays[$j];
                $courseShiftDays->save();
            }
            DB::commit();
            return redirect()->back()->with('success', 'Successfully Saved');
        } catch (\Throwable $th) {
            dd($th);
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
        $course = Course::where('id', $id)->first();
        if (isset($course)) {
            return $course;
        }
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
        try {
            $course = Course::where('id', $id)->first();
            if (isset($course)) {
                return view('courses.edit', compact('course', 'id'));
            } else {
                return redirect()->back()->with('error', 'Course doesnot exists');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
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
        try {
            DB::beginTransaction();
            $course = Course::where('id', $id)->first();
            if (isset($course)) {
                if ($request->hasFile('image')) {
                    if ($request->file('image')->getSize() > 500000) {
                        return redirect()->back()->with('error', 'Max 500KB image size allowed');
                    }
                    $file = time().'.'.$request->image->extension();
                    $request->image->move(public_path('assets/img/courses/'), $file);
                    $course->image = $file;
                }
                $course->name = $request->name;
                $course->category = $request->category;
                $course->fee = $request->fee;
                $course->marks = $request->marks;
                $course->save();
                DB::commit();
                return redirect()->back()->with('success', 'Updated Successfully');
                $courseId = $course->id;
                if (!empty($request->first_shift)) {
                    $firstShiftDays = $request->first_shift_day;
                    foreach ($firstShiftDays as $key => $value) { 
                        $firstShiftDataExists = CourseShift::where('course_id', $courseId)->where('shift_id', 1)->where('day_id', $value)->exists();
                        $firstShift = $request->first_shift;
                        if ($firstShiftDataExists) {
                            CourseShift::where('course_id', $courseId)->where('shift_id', 1)->where('day_id', $value)->update([
                                'course_id' => $courseId,
                                'shift_id' => $firstShift,
                                'day_id' => $value,
                            ]);
                        } else {
                            CourseShift::create([
                                'course_id' => $courseId,
                                'shift_id' => $firstShift,
                                'day_id' => $value,
                            ]);
                        }
                    }
                }
                if (!empty($request->second_shift)) 
                    $secondShiftDays = $request->second_shift_day;{
                    foreach ($secondShiftDays as $key => $secondValue) { 
                        $secondShiftDataExists = CourseShift::where('course_id', $courseId)->where('shift_id', 2)->where('day_id', $secondValue)->exists();
                        $secondShift = $request->second_shift;
                        if ($secondShiftDataExists) {
                            CourseShift::where('course_id', $courseId)->where('shift_id', 2)->where('day_id', $secondValue)->update([
                                'course_id' => $courseId,
                                'shift_id' => $secondShift,
                                'day_id' => $secondValue,
                            ]);
                        } else {
                            CourseShift::create([
                                'course_id' => $courseId,
                                'shift_id' => $secondShift,
                                'day_id' => $secondValue,
                            ]);
                        }
                    }
                }
                DB::commit();
                return redirect()->back()->with('success', 'Updated Successfully');
            } else {
                return redirect()->back()->with('error', 'Course doesnot exists');
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Something went wrong');
        }
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
        try {
            $course = Course::where('id', $id)->first();
            if (isset($course)) {
                $course->delete();
                return redirect()->back()->with('success', 'Deleted Successfully');
            } else {
                return redirect()->back()->with('error', 'Course doesnot exists');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Show Trashed.
     *
     */
    public function trashed(Request $request)
    {
        //
        $trashedCourses = Course::onlyTrashed()->get();
        try {
            if ($request->ajax()) {
                return $this->showTableData($trashedCourses, $trashed = 'trashed');
            }
            return view('courses.trashed');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function restore($id)
    {
        try {
            $trashedCourse = Course::onlyTrashed()->first();
            if (isset($trashedCourse)) {
                $trashedCourse->restore();
                return redirect()->back()->with('success', 'Course data Restored');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Permanentally Delete.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permanentDelete(Request $request, $id)
    {
        //
    }
}
