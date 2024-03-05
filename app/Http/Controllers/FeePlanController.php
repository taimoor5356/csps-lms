<?php

namespace App\Http\Controllers;

use App\Models\FeePlan;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class FeePlanController extends Controller
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
            $feePlan = $data->skip($request->start)
                ->take($request->length);
            return DataTables::of($feePlan->get())
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
                ->editColumn('student_name', function ($row) {
                    if (isset($row->user) || isset($row->student)) {
                        return $row->user->name;
                    } else {
                        return 'No Data';
                    }
                })
                ->editColumn('phone', function ($row) {
                    if (isset($row->user) || isset($row->student)) {
                        return '0'.$row->student->cell_no;
                    } else {
                        return 'No Data';
                    }
                })
                ->editColumn('fee_total', function ($row) {
                    if (isset($row)) {
                        return "Rs ".number_format(intval($row->total_fee))."/-";
                    } else {
                        return 'No Data';
                    }
                })
                ->editColumn('discount', function ($row) {
                    if (isset($row)) {
                        return "Rs ".number_format(intval($row->discount))."/-";
                    } else {
                        return 'No Data';
                    }
                })
                ->editColumn('fee_paid', function ($row) {
                    if (isset($row)) {
                        return "Rs ".number_format(intval($row->total_paid_sum))."/-";
                    } else {
                        return 'No Data';
                    }
                })
                ->editColumn('fee_remaining', function ($row) {
                    if (isset($row)) {
                        return "Rs ".number_format(intval($row->total_fee) - intval($row->discount) - intval($row->total_paid_sum))."/-";
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
                        } else if ((intval($row->total_fee) - intval($row->discount)) < $row->student->total_paid) {
                            $btn .= '
                                <a href="'.$url.'" class="btn btn-primary bg-primary p-1">Collect</a>';
                        } else {
                            $btn .= '
                                <a href="#" class="btn btn-success bg-success p-1">Fully Paid</a>';
                        }
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
            $feePlan = FeePlan::withoutGlobalScopes()->with('user', 'student')
            ->groupBy('student_id')
            ->select('*', DB::raw('SUM(paid) as total_paid_sum'))
            ->orderBy('created_at', 'desc');
            if ($request->ajax()) {
                return $this->showTableData($request, $feePlan, $trashed = null);
            }
            return view('revenue.index');
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
     * @param  \App\Models\FeePlan  $feePlan
     * @return \Illuminate\Http\Response
     */
    public function show(FeePlan $feePlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeePlan  $feePlan
     * @return \Illuminate\Http\Response
     */
    public function edit(FeePlan $feePlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FeePlan  $feePlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeePlan $feePlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeePlan  $feePlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeePlan $feePlan)
    {
        //
    }

    public function sendFeeReminder(Request $request, $studentId)
    {
        try {
            $student = Student::where('id', $studentId)->first();
            if (isset($student)) {
                $student->fee_reminder = 1;
                $student->save();
                return response()->json([
                    'status' => true,
                    'msg' => 'Reminder sent successfully'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => 'User not found'
                ]);
            }
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong'
            ]);
        }
    }
}
