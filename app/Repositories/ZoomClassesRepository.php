<?php

namespace App\Repositories;

use App\Interfaces\ZoomClassesRepositoryInterface;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Student;
use App\Models\ZoomClass;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ZoomClassesRepository implements ZoomClassesRepositoryInterface 
{
    public function showTableData($data, $trashed)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('course', function ($row) {
                return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $row->course->name . '</h6>
                        </div>
                    </div>
                ';
            })
            ->addColumn('day_time', function ($row) {
                return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $row->day . ' / ' . $row->time . '</h6>
                        </div>
                    </div>
                ';
            })
            ->addColumn('zoom_link', function ($row) {
                return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><a href="' . $row->link . '" class="btn btn-primary">JOIN</a></h6>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['course', 'day_time', 'zoom_link'])
            ->make(true);
    }

    public function index($request) 
    {
        try {
            $zoomLinkData = ZoomClass::with('course')->get();
            return $this->showTableData($zoomLinkData, $trashed = null);
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
        $student = Student::with('user')->where('id', $id)->first();
        if (isset($student)) {
            return $student;
        }
    }

    public function store($request) 
    {
        try {
            DB::beginTransaction();
            $request = (object)$request;
            if (Auth::user()->hasRole(['admin', 'student'])) {
                $zoomClass = new ZoomClass();
                $zoomClass->course_id = $request->course_id;
                $zoomClass->day = $request->day;
                $zoomClass->time = $request->time;
                $zoomClass->link = $request->link;
                $zoomClass->created_by = Auth::user()->id;
                $zoomClass->save();
            } else {
                return redirect()->back()->withError('You do not have permission');
            }
            DB::commit();
            return redirect()->back()->withSuccess('Data saved successfully');
            return response()->json(['status' => true, 'msg' => 'Data Saved Successfully']);
        } catch (\Exception $e) {
            dd($e);
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
            $student = Student::with('user')->where('id', $id)->first();
            if (isset($student)) {
                $student->applied_for = $request->applied_for;
                $student->batch_no = $request->batch_no;
                $student->reg_no = $request->reg_no;
                $student->user->name = $request->name;
                $student->user->email = $request->email;
                $student->user->password = Hash::make($request->password);
                if ($request->hasFile('photo')) {
                    if ($request->file('photo')->getSize() > 500000) {
                        return redirect()->back()->with('error', 'Max 500KB photo size allowed');
                    }
                    $file = time().'.'.$request->photo->extension();
                    $request->photo->move(public_path('assets/img/lectures/'), $file);
                    $student->user->photo = $file;
                }
                $student->father_name = $request->father_name;
                $student->father_occupation = $request->father_occupation;
                $student->dob = $request->dob;
                $student->cnic = $request->cnic;
                $student->domicile = $request->domicile;
                $student->student_occupation = $request->student_occupation;
                $student->address = $request->address;
                $student->contact_res = $request->contact_res;
                $student->cell_no = $request->cell_no;
                $student->roll_no = $request->roll_no;
                $student->degree = $request->degree;
                $student->major_subjects = $request->major_subjects;
                $student->cgpa = $request->cgpa;
                $student->board_university = $request->board_university;
                $student->distinction = $request->distinction;
                $student->save();
                $student->user->save();
                $student->user->assignRole($request->role);
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'User doesnot exist']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => 'Something went wrong']);
        }
    }

    public function destroy($id) 
    {
        try {
            $student = Student::with('user')->where('id', $id)->first();
            if (isset($student)) {
                if (isset($student->user)) {
                    $student->user->delete();
                    $student->delete();
                    return redirect()->back()->with('success', 'Deleted Successfully');
                }
            } else {
                return redirect()->back()->with('error', 'User doesnot exists');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function trashed($request)
    {
        $trashedLectures = Student::with(['user' => fn($q) => $q->onlyTrashed()])->onlyTrashed()->get();
        try {
            return $this->showTableData($trashedLectures, $trashed = 'trashed');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function restore($id)
    {
        try {
            $trashedStudent = Student::with(['user' => fn($q) => $q->onlyTrashed()])->where('id', $id)->onlyTrashed()->first();
            if (isset($trashedStudent)) {
                $trashedStudent->user->restore();
                $trashedStudent->restore();
                return redirect()->back()->with('success', 'Student data Restored');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function getFulfilledZoomClasses() 
    {
        return Student::where('is_fulfilled', true);
    }
}
