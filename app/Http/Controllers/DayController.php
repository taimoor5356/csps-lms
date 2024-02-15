<?php

namespace App\Http\Controllers;

use App\Models\CourseShift;
use App\Models\Day;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DayController extends Controller
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
            $days = $data->skip($request->start)
                ->take($request->length);
            return DataTables::of($days->get())
                ->addIndexColumn()
                ->editColumn('id', function ($row) {
                    return ($row->id);
                })
                ->editColumn('name', function ($row) {
                    return ucfirst($row->name);
                })
                ->editColumn('action', function ($row) use ($trashed) {
                    $btn = '';
                    if ($trashed == null) {
                        $url = route('day.course_shifts', [$row->id]);
                        $btn .= '
                        <a href="'.$url.'" class="btn btn-success bg-success p-1" data-student-id="' . $row->id . '" title="View"><i class="fa fa-eye"></i></a>';
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
        $days = Day::orderBy('id', 'ASC');
        if ($request->ajax()) {
            return $this->showTableData($request, $days, $trashed = null);
        }
        return view('days.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shiftsDataTable($request, $dayShifts, $trashed)
    {
        try {
            $searchValue = $request->search['value'];
            // Apply global search
            if (!empty($searchValue)) {
            }
            $totalRecords = $dayShifts->count(); // Get the total number of records for pagination
            $days = $dayShifts->skip($request->start)
                ->take($request->length);
            return DataTables::of($days->get())
                ->addIndexColumn()
                ->editColumn('course', function ($row) {
                    return isset($row->course) ? $row->course->name : '';
                })
                ->editColumn('shift_name', function ($row) {
                    return isset($row->shift) ? ucfirst($row->shift->shift_name) . " (" . $row->shift->shift_time_from . " - " . $row->shift->shift_time_to . ")" : '';
                })
                ->editColumn('action', function ($row) use ($trashed) {
                    $btn = '';
                    if ($trashed == null) {
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function courseShifts(Request $request, $id)
    {
        //
        try {
            $dayShifts = CourseShift::with('shift', 'course')->where('day_id', $id)->orderBy('created_at', 'ASC');
            if ($request->ajax()) {
                return $this->shiftsDataTable($request, $dayShifts, $trashed = null);
            }
            $day = Day::find($id);
            return view('shifts.courses', compact('id', 'day'));
        } catch (\Exception $e) {
            //throw $th;
            dd($e);
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
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function show(Day $day)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function edit(Day $day)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Day $day)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function destroy(Day $day)
    {
        //
    }
}
