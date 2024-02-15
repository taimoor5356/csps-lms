<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\LectureScheduleRepositoryInterface;
use App\Models\Course;
use App\Models\Lecture;
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
        return view('lecture_schedule.index');
    }

    public function store($request, $courseId)
    {
        DB::beginTransaction();
        try {
            $request = (object)$request;
            $lecture = new Lecture();
            $lecture->course_id = $courseId;
            $lecture->lecture_name = $request->lecture_name;
            $lecture->save();
            $prevLectureSchedule = new LectureSchedule();
            $prevLectureSchedule->lecture_id = $lecture->id;
            $prevLectureSchedule->day = $request->day;
            $prevLectureSchedule->time_from = $request->time_from;
            $prevLectureSchedule->time_to = $request->time_to;
            $prevLectureSchedule->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'msg' => 'Lecture added successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong'
            ]);
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
