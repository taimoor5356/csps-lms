<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ShiftController extends Controller
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
            $shifts = $data->skip($request->start)
                ->take($request->length);
            return DataTables::of($shifts->get())
                ->addIndexColumn()
                ->editColumn('shift_name', function ($row) {
                    return ucfirst($row->shift_name);
                })
                ->editColumn('shift_time_from', function ($row) {
                    return $row->shift_time_from;
                })
                ->editColumn('shift_time_to', function ($row) {
                    return $row->shift_time_to;
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
        $shifts = Shift::query();
        if ($request->ajax()) {
            return $this->showTableData($request, $shifts, $trashed = null);
        }
        return view('shifts.index');
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
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shift $shift)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shift $shift)
    {
        //
    }
}
