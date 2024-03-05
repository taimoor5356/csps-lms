<?php

namespace App\Http\Controllers;

use App\Interfaces\RevisionClassesRepositoryInterface;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\RevisionClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevisionClassController extends Controller
{
    private RevisionClassesRepositoryInterface $revisionClassRepository;

    public function __construct(RevisionClassesRepositoryInterface $revisionClassRepository)
    {
        $this->revisionClassRepository = $revisionClassRepository;
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
            $groupedRevisionClasses = RevisionClass::with('course')->whereIn('course_id', $enrolledCoursesIds)->groupBy('day')->orderBy('day')->get();
        } else {
            $groupedRevisionClasses = RevisionClass::with('course')->groupBy('day')->orderBy('day')->get();
        }
        $courses = Course::get();
        return view('revision_classes.index', compact('groupedRevisionClasses', 'courses'));
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
        return view('revision_classes.create', compact('courses'));
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
        return $this->revisionClassRepository->store($request->all());
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
        $data = $this->revisionClassRepository->show($id);
        return view('revision_classes.show')->with($data);
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
        return $this->revisionClassRepository->edit($id);
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
        return $this->revisionClassRepository->update($request, $id);
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
