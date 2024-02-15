<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LessonPlan;
use Illuminate\Http\Request;

class LessonPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTableData($request, $data, $trashed)
    {
        try {
            $searchValue = $request->search['value'];
            // Apply global search
            if (!empty($searchValue)) {
            }
            $totalRecords = $data->count(); // Get the total number of records for pagination
            $courseLessons = $data->skip($request->start)
                ->take($request->length);
            return DataTables::of($courseLessons->get())
                ->addIndexColumn()
                ->editColumn('name', function ($row) {
                    return $row->name;
                })
                ->editColumn('description', function ($row) {
                    return $row->description;
                })
                ->editColumn('invoice_number', function ($row) {
                    return $row->invoice_number;
                })
                ->editColumn('date', function ($row) {
                    return Carbon::parse($row->created_at)->format('Y-m-d');
                })
                ->editColumn('expense_head', function ($row) {
                    return $row->expense_head;
                })
                ->editColumn('amount', function ($row) {
                    return $row->amount;
                })
                ->editColumn('action', function ($row) use ($trashed) {
                    $btn = '';
                    if ($trashed == null) {
                        // $btn .= '
                        // <a href="expenses/' . $row->id . '/show" class="btn btn-success bg-success p-1" data-student-id="' . $row->id . '" title="View"><i class="fa fa-eye"></i></a>
                        // <a href="expenses/' . $row->id . '/edit" data-student-id="' . $row->id . '" class="btn btn-primary bg-primary p-1" title="Edit"><i class="fa fa-pencil"></i></a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->setTotalRecords($totalRecords)
                ->setFilteredRecords($totalRecords) // For simplicity, same as totalRecords
                ->skipPaging()
                ->make(true);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        try {
            $lessonPlan = LessonPlan::withoutGlobalScopes()
                ->orderBy('created_at', 'desc');
            if ($request->ajax()) {
                return $this->showTableData($request, $lessonPlan, $trashed = null);
            }
            return view('lesson_plan.index');
        } catch (\Exception $e) {
            dd($e);
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
    public function show(Request $request, $courseId)
    {
        //
        // 964336
        try {
            $courseLectures = LessonPlan::withoutGlobalScopes()->where('course_id', $courseId)
                ->orderBy('created_at', 'desc');
                dd($courseLectures->get());
            if ($request->ajax()) {
                return $this->showTableData($request, $courseLectures, $trashed = null);
            }
            return view('lesson_plan.index');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withError('Something went wrong');
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
        dd($id);
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
        dd($id);
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

    public function teachersLessonPlan(Request $request)
    {
        return view('lesson_plan.teacher');
    }
}
