<?php

namespace App\Http\Controllers;

use App\Interfaces\LectureScheduleRepositoryInterface;
use App\Models\Course;
use App\Models\LectureSchedule;
use Illuminate\Http\Request;

class LectureScheduleController extends Controller
{
    private LectureScheduleRepositoryInterface $lectureScheduleRepository;

    public function __construct(LectureScheduleRepositoryInterface $lectureScheduleRepository)
    {
        $this->lectureScheduleRepository = $lectureScheduleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $groupedLectureSchedule = LectureSchedule::with('course')->groupBy('day')->orderBy('day')->get();
        $courses = Course::get();
        return view('lecture_schedule.index', compact('groupedLectureSchedule', 'courses'));
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
    public function store(Request $request)
    {
        //
        return $this->lectureScheduleRepository->store($request->all());
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
        $data = $this->lectureScheduleRepository->show($id);
        return view('lecture_schedule.show')->with($data);
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
}
