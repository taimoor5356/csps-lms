<?php

namespace App\Repositories;

use App\Models\RegisteredYear;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\RegisteredYearsRepositoryInterface;
use App\Interfaces\RegisteredBatchesRepositoryInterface;

class RegisteredYearsRepository implements RegisteredYearsRepositoryInterface
{
    private RegisteredBatchesRepositoryInterface $registeredBatchesRepository;

    public function __construct(RegisteredBatchesRepositoryInterface $registeredBatchesRepository)
    {
        $this->registeredBatchesRepository = $registeredBatchesRepository;
    }
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
                        <button data-bs-toggle="modal" data-year-batches='.$row->registeredBatches.' data-year-value="'.$row->registered_year.'" data-year-status="'.$row->status.'" data-bs-target="#update-year" data-year-id="' . $row->id . '" class="btn btn-primary bg-primary p-1 year-update" title="Edit"><i class="fa fa-pencil"></i></button>';
                    if (Auth::user()->can('year_delete')) {
                        $btn .= '<a href="registered-years/' . $row->id . '/delete" data-year-id="' . $row->id . '" class="mx-1 btn btn-danger bg-danger p-1 delete-year" title="Delete"><i class="fa fa-trash-o"></i></a>';
                    }
                } else {
                    $btn .= '
                        <a href="' . $row->id . '/restore" data-year-id="' . $row->id . '" class="btn btn-success bg-success p-1" title="Restore"><i class="fa fa-undo"></i></a>';
                    $btn .= '
                        <a href="' . $row->id . '/delete" data-year-id="' . $row->id . '" class="btn btn-danger bg-danger p-1 delete-year" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>
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
            $request = (object)$request;
            $saveRegisteredYear = RegisteredYear::create([
                'registered_year' => $request->registered_year,
                'status' => !is_null($request->status) ? '1' : '0'
            ]);
            $saveRegisteredYear['registered_year_id'] = $saveRegisteredYear->id;
            $saveRegisteredYear['batch'] = $request->batch;
            $batches = $this->registeredBatchesRepository->store($saveRegisteredYear);
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
            $request = (object)$request;
            $registeredYear = RegisteredYear::where('id', $request->registered_year_id)->first();
            if (isset($registeredYear)) {
                $registeredYear->registered_year = $request->registered_year;
                $registeredYear->status = !is_null($request->status) ? '1' : '0';
                $saveRegisteredYear = $registeredYear->save();
                $registeredYear['registered_year_id'] = $request->registered_year_id;
                $registeredYear['batch'] = $request->batch;
                $batches = $this->registeredBatchesRepository->update($registeredYear);
                DB::commit();
                return redirect()->back()->withSuccess('Data saved successfully');
            } else {
                return redirect()->back()->withError('Year not found');
            }
        } catch (\Exception $e) {
            dd($e);
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
