<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\NoticeBoardRepositoryInterface;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;

class NoticeBoardController extends Controller
{
    use ImageUpload;
    private NoticeBoardRepositoryInterface $noticeBoardRepository;

    public function __construct(NoticeBoardRepositoryInterface $noticeBoardRepository)
    {
        $this->noticeBoardRepository = $noticeBoardRepository;
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
            return $this->noticeBoardRepository->index($request);
        }
        return view('admin.notice_board.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.notice_board.create');
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
        return $this->noticeBoardRepository->store($request->all());
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
        $student = $this->noticeBoardRepository->show($id);
        return view('admin.notice_board.show', compact('student'));
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
                return view('admin.notice_board.edit', compact('student', 'id', 'roles'));
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
        return $this->noticeBoardRepository->update($request, $id);
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
        return $this->noticeBoardRepository->destroy($id);
    }

    /**
     * Show Trashed.
     *
     */
    public function trashed(Request $request)
    {
        //
        if ($request->ajax()) {
            return $this->noticeBoardRepository->trashed($request);
        }
        return view('admin.notice_board.trashed');
    }

    public function restore($id)
    {
        return $this->noticeBoardRepository->restore($id);
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
