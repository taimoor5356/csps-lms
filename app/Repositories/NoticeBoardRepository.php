<?php

namespace App\Repositories;

use App\Interfaces\NoticeBoardRepositoryInterface;
use App\Models\NoticeBoard;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class NoticeBoardRepository implements NoticeBoardRepositoryInterface
{
    public function showTableData($data, $trashed)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('notice', function ($row) {
                return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $row->notice . '</h6>
                        </div>
                    </div>
                ';
            })
            ->addColumn('day_time', function ($row) {
                return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $row->day . ' | ' . $row->time . '</h6>
                        </div>
                    </div>
                ';
            })
            ->addColumn('role', function ($row) {
                return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $row->role . '</h6>
                        </div>
                    </div>
                ';
            })
            ->addColumn('user_name', function ($row) {
                if (isset($row->user)) {
                    return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->user->name . '</h6>
                            </div>
                        </div>
                    ';
                }
            })
            ->addColumn('action', function ($row) use ($trashed) {
                $btn = '';
                if ($trashed == null) {
                    $btn .= '';
                    if (Auth::user()->hasRole(['admin', 'student', 'front_desk_admin'])) {
                        $btn .= '<a href="notice-board/' . $row->id . '/delete" data-no-id="' . $row->id . '" class="mx-1 btn btn-danger bg-danger p-1 delete-no" title="Delete"><i class="fa fa-trash-o"></i></a>';
                    }
                } else {
                    $btn .= '
                        <a href="' . $row->id . '/restore" data-no-id="' . $row->id . '" class="btn btn-success bg-success p-1" title="Restore"><i class="fa fa-undo"></i></a>';
                    $btn .= '
                        <a href="' . $row->id . '/delete" data-no-id="' . $row->id . '" class="btn btn-danger bg-danger p-1 delete-no" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>
                    ';
                }
                return $btn;
            })
            ->rawColumns(['notice', 'day_time', 'role', 'user_name', 'action'])
            ->make(true);
    }

    public function index($request)
    {
        try {
            $notice_boardDetail = NoticeBoard::with('user')->get();
            return $this->showTableData($notice_boardDetail, $trashed = null);
        } catch (\Exception $e) {
            return redirect()->back()->withError('Something went wrong');
        }
    }

    public function create()
    {
    }

    public function show($id)
    {
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $request = (object)$request;
            if (Auth::user()->hasRole(['admin', 'student', 'front_desk_admin'])) {
                $notice = new NoticeBoard();
                $notice->notice = $request->notice;
                $notice->day = $request->day;
                $notice->time = $request->time;
                $notice->role = $request->role;
                $notice->user_id = $request->user_id;
                $notice->save();
            } else {
                return redirect()->back()->withError('You do not have permissions');
            }
            DB::commit();
            return redirect()->back()->withSuccess('Data saved successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withError('Something went wrong');
            return response()->json(['status' => false, 'msg' => 'Something went wrong']);
        }
    }

    public function edit($id)
    {
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            
            DB::commit();
            return redirect()->back()->withSuccess('Updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withError('Something went wrong');
            return response()->json(['status' => false, 'msg' => 'Something went wrong']);
        }
    }

    public function destroy($id)
    {
        try {
            if (Auth::user()->hasRole(['admin', 'student'])) {
                $notice = NoticeBoard::find($id);
                if ($notice) {
                    $notice->delete();
                    return redirect()->back()->withSuccess('Deleted Successfully');
                } else {
                    return redirect()->back()->withError('Not found');
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->withError('Something went wrong');
        }
    }

    public function trashed($request)
    {
    }

    public function restore($id)
    {
    }

    public function getFulfilledNoticeBoards()
    {
    }
}
