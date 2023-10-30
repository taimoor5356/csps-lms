<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\MockScheduleRepositoryInterface;
use App\Models\Course;
use App\Models\MockSchedule;

class MockScheduleRepository implements MockScheduleRepositoryInterface
{
    public function showTableData($data, $trashed)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('days', function ($row) {
                if ($row->user) {
                    return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"></h6>
                            <p class="text-sm text-secondary mb-0"></p>
                        </div>
                    </div>
                    ';
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('course', function ($row) {
                if ($row->user) {
                    return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"></h6>
                            <p class="text-sm text-secondary mb-0"></p>
                        </div>
                    </div>
                    ';
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('schedule_to', function ($row) {
                if ($row->user) {
                    return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"></h6>
                            <p class="text-sm text-secondary mb-0"></p>
                        </div>
                    </div>
                    ';
                } else {
                    return 'No Data';
                }
            })
            ->rawColumns(['days', 'schedule_from', 'schedule_to'])
            ->make(true);
    }

    public function index($request)
    {
        try {
            $mockSchedule = MockSchedule::groupBy('day')->get();
            return $mockSchedule;
            return $this->showTableData($mockSchedule, $trashed = null);
        } catch (\Exception $e) {
            return redirect()->back()->withError('Something went wrong');
        }
    }

    public function create()
    {
        //
    }

    public function show($id)
    {
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $request = (object)$request;
            $day = $request->day;
            $day = Carbon::parse($day)->format('Y-m-d');
            $prevMockSchedule = MockSchedule::query();
            $courseLimit = $prevMockSchedule->where('day', $day);
            if (!$courseLimit->where('course_limit', 2)->exists()) {
                // if (Auth::user()->hasRole('admin')) {
                    $prevMockSchedule = MockSchedule::where('day', $day);

                    $mockSchedule = new MockSchedule();
                    $mockSchedule->day = $day;
                    $mockSchedule->course_id = $request->course_id;
                    $mockSchedule->time = $request->time;
                    $mockSchedule->course_limit = !is_null($prevMockSchedule->first()) ? $prevMockSchedule->first()->course_limit + 1 : 1;
                    $mockSchedule->created_by = '1';
                    $mockSchedule->save();
                    DB::commit();
                    return redirect()->back()->withSuccess('Data Saved Successfully');
                    return response()->json(['status' => true, 'msg' => 'Data Saved Successfully']);
                // } else {
                    // return response()->json(['status' => false, 'msg' => 'You donot have permission to perform this action']);
                // }
            } else {
                return redirect()->back()->withError('Already scheduled 2 courses');
                return response()->json([
                    'status' => false,
                    'msg' => 'Limit exceeded'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withError('Something went wrong');
            dd($e);
            return redirect()->back()->withError('Something went wrong');
            // DB::rollback();
            // if ($e->getCode() == 23000 && str_contains($e->getMessage(), 'Duplicate entry')) {
            //     $pattern = "/Duplicate entry '.*' for key '(.*?)'/";
            //     preg_match($pattern, $e->getMessage(), $matches);
            //     $columnName = $matches[1];
            //     $columnName = str_replace('_', ' ', $columnName);
            //     $columnName = ucfirst($columnName);
            //     return response()->json(['status' => false, 'msg' => "Duplicate entry for $columnName"]);
            // } else {
            //     dd($e);
            //     return response()->json(['status' => false, 'msg' => "Something went wrong"]);
            // }
        }
    }

    public function edit($id)
    {
    }

    public function update($request, $id)
    {
    }

    public function destroy($id)
    {
    }

    public function trashed($request)
    {
    }

    public function restore($id)
    {
    }

    public function getFulfilledStudents()
    {
    }
}
