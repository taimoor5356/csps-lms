<?php

namespace App\Repositories;

use App\Models\RegisteredYear;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\RegisteredBatchesRepositoryInterface;
use App\Models\RegisteredBatch;

class RegisteredBatchesRepository implements RegisteredBatchesRepositoryInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTableData($data, $trashed)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('years', function ($row) {
                return $row->registered_year;
            })
            ->addColumn('batches', function ($row) {
                $batches = array_map(function ($batch) {
                    return $batch['batch'];
                }, $row->registeredBatches->toArray());
                return $batches;
            })
            ->addColumn('action', function ($row) use ($trashed) {
                $btn = '';
                if ($trashed == null) {
                    $btn .= '
                        <a href="registered-years/' . $row->id . '/show" class="btn btn-success bg-success p-1 -view-student-detail" data-student-id="' . $row->id . '" title="View" data-toggle="modal" data-target="#modal-default"><i class="fa fa-eye"></i></a>
                        <a href="registered-years/' . $row->id . '/edit" data-student-id="' . $row->id . '" class="btn btn-primary bg-primary p-1" title="Edit"><i class="fa fa-pencil"></i></a>';
                    if (Auth::user()->can('student_delete')) {
                        $btn .= '<a href="registered-years/' . $row->id . '/delete" data-student-id="' . $row->id . '" class="mx-1 btn btn-danger bg-danger p-1 delete-student" title="Delete"><i class="fa fa-trash-o"></i></a>';
                    }
                } else {
                    $btn .= '
                        <a href="' . $row->id . '/restore" data-student-id="' . $row->id . '" class="btn btn-success bg-success p-1" title="Restore"><i class="fa fa-undo"></i></a>';
                    $btn .= '
                        <a href="' . $row->id . '/delete" data-student-id="' . $row->id . '" class="btn btn-danger bg-danger p-1 delete-student" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>
                    ';
                }
                return $btn;
            })
            ->rawColumns(['years', 'batches', 'action'])
            ->make(true);
    }

    public function index($request)
    {
        //
        try {
            $registeredYears = RegisteredYear::with('registeredBatches')->get();
            return $this->showTableData($registeredYears, $trashed = null);
        } catch (\Exception $e) {
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
    public function store($request)
    {
        //
        try {
            DB::beginTransaction();
            $batches = $request->batch;
            foreach ($batches as $key => $batch) {
                $saveRegisteredBatch = RegisteredBatch::create([
                    'registered_year_id' => $request->registered_year_id,
                    'batch' => !is_null($batch) ? $batch : null
                ]);
            }
            DB::commit();
            return redirect()->back()->withSuccess('Data saved successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withError('Something went wrong');
        }
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
    public function update($request)
    {
        //
        try {
            DB::beginTransaction();
            $batches = $request->batch;
            foreach ($batches as $key => $batch) {
                $registeredBatch = RegisteredBatch::where('registered_year_id', $request->registered_year_id)->where('batch', $batch)->exists();
                if (!$registeredBatch) {
                    $saveRegisteredBatch = RegisteredBatch::create([
                        'registered_year_id' => $request->registered_year_id,
                        'batch' => !is_null($batch) ? $batch : null
                    ]);
                }
            }
            DB::commit();
            return redirect()->back()->withSuccess('Data saved successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withError('Something went wrong');
        }
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
