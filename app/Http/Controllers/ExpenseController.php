<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
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
            $expenses = Expense::withoutGlobalScopes()
                ->orderBy('created_at', 'desc');
            if ($request->ajax()) {
                return $this->showTableData($request, $expenses, $trashed = null);
            }
            return view('expenses.index');
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
        return view('expenses.create');
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
        try {
            $expense = new Expense();
            $expense->name = $request->name;
            $expense->expense_head = $request->expense_head;
            $expense->date = $request->date;
            $expense->invoice_number = $request->invoice_number;
            $expense->description = $request->description;
            $expense->amount = $request->amount;
            if ($request->hasFile('file')) {
                if ($request->file('file')->getSize() > 500000) {
                    // return redirect()->back()->with('error', 'Max 500KB file size allowed');
                    return response()->json(['status' => false, 'msg' => 'Max 500KB file size allowed']);
                }
                $file = time() . '.' . $request->file->extension();
                $request->file->move(public_path('assets/img/expenses/'), $file);
                $expense->file = $file;
            }
            $expense->save();
            return response()->json([
                'status' => true,
                'msg' => 'Expense saved successfully'
            ]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function trashed(Expense $expense)
    {
        //
    }
}
