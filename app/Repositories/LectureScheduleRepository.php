<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\LectureScheduleRepositoryInterface;
use App\Models\Course;
use App\Models\LectureSchedule;

class LectureScheduleRepository implements LectureScheduleRepositoryInterface
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
            $lectureSchedule = LectureSchedule::groupBy('day')->get();
            return $lectureSchedule;
            return $this->showTableData($lectureSchedule, $trashed = null);
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
            $prevLectureSchedule = LectureSchedule::query();
            $courseLimit = $prevLectureSchedule->where('day', $day);
            if (!$courseLimit->where('course_limit', 2)->exists()) {
                // if (Auth::user()->hasRole('admin')) {
                    $prevLectureSchedule = LectureSchedule::where('day', $day);

                    $lectureSchedule = new LectureSchedule();
                    $lectureSchedule->day = $day;
                    $lectureSchedule->course_id = $request->course_id;
                    $lectureSchedule->time = $request->time;
                    $lectureSchedule->course_limit = !is_null($prevLectureSchedule->first()) ? $prevLectureSchedule->first()->course_limit + 1 : 1;
                    $lectureSchedule->created_by = '1';
                    $lectureSchedule->save();
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
