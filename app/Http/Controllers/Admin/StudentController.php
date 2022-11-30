<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Models\Enrollment;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Interfaces\StudentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    use ImageUpload;
    private StudentRepositoryInterface $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            return $this->studentRepository->index($request);
        }
        return view('admin.students.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.students.create');
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
        return $this->studentRepository->store($request->all());
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
        $student = $this->studentRepository->show($id);
        return view('admin.students.show', compact('student'));
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
            $roles = Role::get();
            $student = Student::with('user')->where('id', $id)->first();
            if (isset($student)) {
                return view('admin.students.edit', compact('student', 'id', 'roles'));
            } else {
                return redirect()->back()->with('error', 'User doesnot exists');
            }
        } catch (\Exception $e) {
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
        return $this->studentRepository->update($request, $id);
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
        return $this->studentRepository->destroy($id);
    }

    /**
     * Show Trashed.
     *
     */
    public function trashed(Request $request)
    {
        //
        if ($request->ajax()) {
            return $this->studentRepository->trashed($request);
        }
        return view('admin.students.trashed');
    }

    public function restore($id)
    {
        return $this->studentRepository->restore($id);
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

    /**
     * Show Auth Student Courses.
     *
     */
    public function enrolledCourses(Request $request, $id)
    {
        //
        try {
            $enrolledCourses = Enrollment::where('user_id', Auth::user()->id)->get();
            if ($request->ajax()) {
                return $this->showTableData($enrolledCourses, $trashed = null);
            }
            return view('admin.enrollment.index');
        } catch (\Exception $e) {
            return redirect()->back()->withError('Something went wrong');
        }
    }
}
