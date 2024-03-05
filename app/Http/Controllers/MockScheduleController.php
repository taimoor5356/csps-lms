<?php

namespace App\Http\Controllers;

use App\Interfaces\MockScheduleRepositoryInterface;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\MockSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MockScheduleController extends Controller
{
    private MockScheduleRepositoryInterface $mockScheduleRepository;

    public function __construct(MockScheduleRepositoryInterface $mockScheduleRepository)
    {
        $this->mockScheduleRepository = $mockScheduleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if (Auth::user()->hasRole('student') || Auth::user()->hasRole('teacher')) {
            $enrolledCoursesIds = Enrollment::where('user_id', Auth::user()->id)->distinct('course_id')->pluck('course_id');
            $groupedMockSchedule = MockSchedule::with('course')->whereIn('course_id', $enrolledCoursesIds)->groupBy('day')->orderBy('day')->get();
        } else {
            $groupedMockSchedule = MockSchedule::with('course')->groupBy('day')->orderBy('day')->get();
        }
        $courses = Course::get();
        return view('mock_schedule.index', compact('groupedMockSchedule', 'courses'));
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
        return view('mock_schedule.create', compact('courses'));
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
        return $this->mockScheduleRepository->store($request->all());
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
        $data = $this->mockScheduleRepository->show($id);
        return view('mock_schedule.show')->with($data);
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
        return $this->mockScheduleRepository->edit($id);
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
        return $this->mockScheduleRepository->update($request, $id);
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
