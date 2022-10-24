<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\StudentServicesRepository;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;

class StudentServicesController extends Controller
{
    use ImageUpload;
    private StudentServicesRepository $studentServicesRepository;

    public function __construct(StudentServicesRepository $studentServicesRepository)
    {
        $this->studentServicesRepository = $studentServicesRepository;
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
            return $this->studentServicesRepository->index($request);
        }
        return view('admin.student_services.index');
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
        return $this->studentServicesRepository->store($request->all());
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
        $student = $this->studentServicesRepository->show($id);
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
        return $this->studentServicesRepository->update($request, $id);
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
        return $this->studentServicesRepository->destroy($id);
    }

    /**
     * Show Trashed.
     *
     */
    public function trashed(Request $request)
    {
        //
        if ($request->ajax()) {
            return $this->studentServicesRepository->trashed($request);
        }
        return view('admin.students.trashed');
    }

    public function restore($id)
    {
        return $this->studentServicesRepository->restore($id);
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
