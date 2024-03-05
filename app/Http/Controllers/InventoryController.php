<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $trashed = null)
    {
        //
        $inventory = Inventory::get();
        if ($request->ajax()) {
            return DataTables::of($inventory)
                ->addIndexColumn()
                ->editColumn('class', function ($row) {
                    if ($row->user) {
                        return '';
                    } else {
                        return 'No Data';
                    }
                })
                ->editColumn('batch', function ($row) {
                    if (isset($row->user) || isset($row->student)) {
                        return $row->student->batch->batch;
                    } else {
                        return 'No Data';
                    }
                })
                ->editColumn('registration_number', function ($row) {
                    if (isset($row->user) || isset($row->student)) {
                        return $row->student->roll_no;
                    } else {
                        return 'No Data';
                    }
                })
                ->editColumn('action', function ($row) use ($trashed) {
                    $btn = '';
                    if ($trashed == null) {
                        $url = route('edit.student', [$row->student_id]);
                        if ((intval($row->total_fee) - intval($row->discount)) > $row->student->total_paid) {
                            $btn .= '
                                <a href="'.$url.'" class="btn btn-primary bg-primary p-1">Collect</a>
                                <button type="button" class="btn btn-warning bg-warning p-1 send-fee-reminder" data-student-id="'.$row->student_id.'">Send Reminder</button>';
                        } else {
                            $btn .= '
                                <a href="'.$url.'" class="btn btn-primary bg-primary p-1">Collect</a>';
                        }
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->setTotalRecords($totalRecords)
                ->setFilteredRecords($totalRecords) // For simplicity, same as totalRecords
                ->skipPaging()
                ->make(true);
        }
        return view('inventory.index');
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
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
