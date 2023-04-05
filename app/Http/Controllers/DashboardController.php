<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $authUserId = Auth::user()->id;
        $user = User::where('id', $authUserId)->first();
        if (isset($user)) {
            if ($user->approved_status == 1) {
                $data['totalStudents'] = Student::count();
                $data['totalStudentEnrolled'] = Enrollment::groupBy('user_id')->count();
                $data['totalCourses'] = Course::count();
                if (Auth::user()->hasRole('admin')) {
                    return redirect()->route('admin_dashboard');
                }
                if (Auth::user()->hasRole('teacher')) {
                    return redirect()->route('teacher_dashboard');
                }
                if (Auth::user()->hasRole('student')) {
                    return redirect()->route('student_dashboard');
                }
                // return view('dashboard.index')->with($data);
            } else {
                return redirect()->route('logout');
            }
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
}
