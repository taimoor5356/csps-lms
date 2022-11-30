<?php

namespace App\Repositories;

use App\Interfaces\TeacherRepositoryInterface;
use App\Models\Teacher;
use Carbon\Carbon;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class TeacherRepository implements TeacherRepositoryInterface 
{
    public function showTableData($data, $trashed)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('image', function ($row) {
                $url = URL::to('/');
                if ($row->user) {
                    return '    
                    <div class="d-flex px-2 py-1">
                        <div>
                            <img src="' . $url . '/public/assets/img/lectures/' . $row->user->photo . '" class="avatar avatar-lg"
                                alt="user1">
                        </div>
                    </div>
                    ';
                } else {
                    return '    
                    <div class="d-flex px-2 py-1">
                        <div>
                            <img src="' . $url . '/public/assets/img/lectures/" class="avatar avatar-lg"
                                alt="user1">
                        </div>
                    </div>
                    ';
                }
            })
            ->addColumn('name_email', function ($row) {
                if ($row->user) {
                    return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $row->user->name . '</h6>
                            <p class="text-sm text-secondary mb-0">' . $row->user->email . '</p>
                        </div>
                    </div>
                    ';
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('dob_cnic', function ($row) {
                return '
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">' . Carbon::parse($row->dob)->format('M d,Y') . '</h6>
                        <p class="text-sm text-secondary mb-0">' . $row->cnic . '</p>
                    </div>
                </div>
                ';
            })
            ->addColumn('action', function ($row) use ($trashed) {
                $btn = '';
                if ($trashed == null) {
                    $btn .= '
                        <a href="teachers/'.$row->id.'/show" class="btn btn-success bg-success p-1 -view-student-detail" data-student-id="'. $row->id .'" title="View" data-toggle="modal" data-target="#modal-default"><i class="fa fa-eye"></i></a>
                        <a href="teachers/'. $row->id .'/edit" data-student-id="'. $row->id .'" class="btn btn-primary bg-primary p-1" title="Edit"><i class="fa fa-pencil"></i></a>';
                    if (Auth::user()->can('student_delete')) {
                        $btn .='<a href="teachers/'. $row->id .'/delete" data-student-id="'. $row->id .'" class="mx-1 btn btn-danger bg-danger p-1 delete-student" title="Delete"><i class="fa fa-trash-o"></i></a>';
                    }
                } else {
                    $btn .= '
                        <a href="'. $row->id .'/restore" data-student-id="'. $row->id .'" class="btn btn-success bg-success p-1" title="Restore"><i class="fa fa-undo"></i></a>';
                    $btn .='
                        <a href="'. $row->id .'/delete" data-student-id="'. $row->id .'" class="btn btn-danger bg-danger p-1 delete-student" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>
                    ';
                }
                return $btn;
            })
            ->rawColumns(['image', 'name_email', 'dob_cnic', 'action'])
            ->make(true);
    }

    public function index($request) 
    {
        try {
            $teacherDetail = Teacher::with('user')->get();
            if (Auth::user()->hasRole('teacher')) {
                $teacherDetail = Teacher::with('user')->where('user_id', Auth::user()->id)->get();
            }
            return $this->showTableData($teacherDetail, $trashed = null);
        } catch (\Exception $e) {
            return redirect()->back()->withError('Something went wrong');
        }
    }

    public function create()
    {
        
    }

    public function show($id) 
    {
        $teacher = Teacher::with('user')->where('id', $id)->first();
        if (isset($teacher)) {
            return $teacher;
        }
    }

    public function store($request) 
    {
        try {
            DB::beginTransaction();
            $request = (object)$request;
            $defaultPassword = '12345678';
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'password' => Hash::make($defaultPassword),
                'role_id' => 2,
                'registration_date' => Carbon::now(),
                'approved_status' => 0,
                // 'photo' => $file
            ]);
            $teacher = Teacher::create([
                'user_id' => $user->id,
                'batch_no' => $request->batch_no,
                'reg_no' => $request->reg_no,
                'contact_res' => $request->contact_no
            ]);
            $user->assignRole(2);
            $subject = 'Login Details';
            if (Mail::to($request->email)->send(new \App\Mail\Mail($subject))) {
                $teacher->notification = $request->notification ? $request->notification : '0';
            }
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Data Saved Successfully']);
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
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
            $teacher = Teacher::with('user')->where('id', $id)->first();
            if (isset($teacher)) {
                $teacher->applied_for = $request->applied_for;
                $teacher->batch_no = $request->batch_no;
                $teacher->reg_no = $request->reg_no;
                $teacher->user->name = $request->name;
                $teacher->user->email = $request->email;
                $teacher->user->password = Hash::make($request->password);
                if ($request->hasFile('photo')) {
                    if ($request->file('photo')->getSize() > 500000) {
                        return redirect()->back()->with('error', 'Max 500KB photo size allowed');
                    }
                    $file = time().'.'.$request->photo->extension();
                    $request->photo->move(public_path('assets/img/lectures/'), $file);
                    $teacher->user->photo = $file;
                }
                $teacher->father_name = $request->father_name;
                $teacher->father_occupation = $request->father_occupation;
                $teacher->dob = $request->dob;
                $teacher->cnic = $request->cnic;
                $teacher->domicile = $request->domicile;
                $teacher->student_occupation = $request->student_occupation;
                $teacher->address = $request->address;
                $teacher->contact_res = $request->contact_res;
                $teacher->cell_no = $request->cell_no;
                $teacher->roll_no = $request->roll_no;
                $teacher->degree = $request->degree;
                $teacher->major_subjects = $request->major_subjects;
                $teacher->cgpa = $request->cgpa;
                $teacher->board_university = $request->board_university;
                $teacher->distinction = $request->distinction;
                $teacher->save();
                $teacher->user->save();
                $teacher->user->assignRole($request->role);
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
            $teacher = Teacher::with('user')->where('id', $id)->first();
            if (isset($teacher)) {
                if (isset($teacher->user)) {
                    $teacher->user->delete();
                    $teacher->delete();
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
        $trashedLectures = Teacher::with(['user' => fn($q) => $q->onlyTrashed()])->onlyTrashed()->get();
        try {
            return $this->showTableData($trashedLectures, $trashed = 'trashed');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function restore($id)
    {
        try {
            $trashedStudent = Teacher::with(['user' => fn($q) => $q->onlyTrashed()])->where('id', $id)->onlyTrashed()->first();
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

    public function getFulfilledTeacher() 
    {
        return Teacher::where('is_fulfilled', true);
    }
}
