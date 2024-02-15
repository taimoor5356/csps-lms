<?php

namespace App\Repositories;

use App\Interfaces\FacultyRepositoryInterface;
use App\Models\Instructor;
use Carbon\Carbon;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class FacultyRepository implements FacultyRepositoryInterface 
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
                        <a href="lectures/'.$row->id.'/show" class="btn btn-success bg-success p-1 -view-student-detail" data-student-id="'. $row->id .'" title="View" data-toggle="modal" data-bs-target="#modal-default"><i class="fa fa-eye"></i></a>
                        <a href="lectures/'. $row->id .'/edit" data-student-id="'. $row->id .'" class="btn btn-primary bg-primary p-1" title="Edit"><i class="fa fa-pencil"></i></a>';
                    if (Auth::user()->can('student_delete')) {
                        $btn .='<a href="lectures/'. $row->id .'/delete" data-student-id="'. $row->id .'" class="mx-1 btn btn-danger bg-danger p-1 delete-student" title="Delete"><i class="fa fa-trash-o"></i></a>';
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
            $facultyDetail = Instructor::with('user')->get();
            if (Auth::user()->hasRole('instructor')) {
                $facultyDetail = Instructor::with('user')->where('user_id', Auth::user()->id)->get();
            }
            return $this->showTableData($facultyDetail, $trashed = null);
        } catch (\Exception $e) {
            return redirect()->back()->withError('Something went wrong');
        }
    }

    public function create()
    {
        
    }

    public function show($id) 
    {
        $faculty = Instructor::with('user')->where('id', $id)->first();
        if (isset($faculty)) {
            return $faculty;
        }
    }

    public function store($request) 
    {
        try {
            DB::beginTransaction();
            $request = (object)$request;
            // if ($request->hasFile('photo')) {
            //     $file = time().'.'.$request->photo->extension();
            //     $directory = public_path('assets/img/lectures/');
            //     $imageUpload = $this->uploadImage($request->photo, $file, $directory);
            //     if ($imageUpload->status == false) {
            //         return response()->json(['status' => false, 'msg' => 'Max 500kb file size']);
            //     }
            // } else {
            //     return response()->json(['status' => false, 'msg' => 'Picture required']);
            // }
            $defaultPassword = '12345678';
            if ($request->visitor == 'true') {
                $user = User::where('id', $request->user_id)->first();
                if (isset($user)) {
                    $user->name = $request->name;
                    if ($user->email != $request->email) {
                        $user->email = $request->email;
                    }
                    $user->gender = $request->gender;
                    $user->password = Hash::make($defaultPassword);
                    $user->role_id = Role::where('name', 'teacher')->first()->id;
                    // $user->registration_date = Carbon::now();
                    $user->approved_status = 1;
                    $user->save();
                }
            } else {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'password' => Hash::make($defaultPassword),
                    'role_id' => Role::where('name', 'teacher')->first()->id,
                    'registration_date' => Carbon::now(),
                    'approved_status' => 0,
                    // 'photo' => $file
                ]);
            }
            $faculty = Instructor::create([
                'user_id' => $user->id,
                'batch_no' => $request->batch_no,
                'reg_no' => $request->reg_no,
                'roll_no' => $request->roll_no,
                'applied_for' => $request->applied_for,
                'father_name' => $request->father_name,
                'father_occupation' => $request->father_occupation,
                'dob' => $request->dob,
                'cnic' => $request->cnic,
                'domicile' => $request->domicile,
                'student_occupation' => $request->student_occupation,
                'degree' => $request->degree,
                'major_subjects' => $request->major_subjects,
                'cgpa' => $request->cgpa,
                'board_university' => $request->board_university,
                'distinction' => $request->disctinction,
                'address' => $request->address,
                'contact_res' => $request->contact_res,
                'cell_no' => $request->cell_no,
                'year' => $request->year,
                'class_type' => $request->class_type,
                'fee_type' => $request->fee_type,
                'mock_exam_evaluation' => $request->mock_exam_evaluation,
                'installment' => $request->installment,
                'discount' => $request->discount,
                'total_fee' => $request->total_fee,
                'due_date' => $request->due_date,
                'freeze' => $request->freeze,
                'leave' => $request->leave,
                'fee_refund' => $request->fee_refund ? '1' : '0',
                'notification_sent' => $request->notification_sent ? '1' : '0',
                'challan_generated' => $request->challan_generated ? '1' : '0',
                'fee_submit_date' => $request->fee_submit_date
            ]);
            $user->assignRole(3);
            $subject = 'Login Details';
            if (Mail::to($request->email)->send(new \App\Mail\Mail($subject))) {
                $faculty->notification = $request->notification ? $request->notification : '0';
            }
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Data Saved Successfully']);
        } catch (\Exception $e) {
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
            $faculty = Instructor::with('user')->where('id', $id)->first();
            if (isset($faculty)) {
                $faculty->applied_for = $request->applied_for;
                $faculty->batch_no = $request->batch_no;
                $faculty->reg_no = $request->reg_no;
                $faculty->user->name = $request->name;
                $faculty->user->email = $request->email;
                $faculty->user->password = Hash::make($request->password);
                if ($request->hasFile('photo')) {
                    if ($request->file('photo')->getSize() > 500000) {
                        return redirect()->back()->with('error', 'Max 500KB photo size allowed');
                    }
                    $file = time().'.'.$request->photo->extension();
                    $request->photo->move(public_path('assets/img/lectures/'), $file);
                    $faculty->user->photo = $file;
                }
                $faculty->father_name = $request->father_name;
                $faculty->father_occupation = $request->father_occupation;
                $faculty->dob = $request->dob;
                $faculty->cnic = $request->cnic;
                $faculty->domicile = $request->domicile;
                $faculty->student_occupation = $request->student_occupation;
                $faculty->address = $request->address;
                $faculty->contact_res = $request->contact_res;
                $faculty->cell_no = $request->cell_no;
                $faculty->roll_no = $request->roll_no;
                $faculty->degree = $request->degree;
                $faculty->major_subjects = $request->major_subjects;
                $faculty->cgpa = $request->cgpa;
                $faculty->board_university = $request->board_university;
                $faculty->distinction = $request->distinction;
                $faculty->save();
                $faculty->user->save();
                $faculty->user->assignRole($request->role);
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
            $faculty = Instructor::with('user')->where('id', $id)->first();
            if (isset($faculty)) {
                if (isset($faculty->user)) {
                    $faculty->user->delete();
                    $faculty->delete();
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
        $trashedLectures = Instructor::with(['user' => fn($q) => $q->onlyTrashed()])->onlyTrashed()->get();
        try {
            return $this->showTableData($trashedLectures, $trashed = 'trashed');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function restore($id)
    {
        try {
            $trashedStudent = Instructor::with(['user' => fn($q) => $q->onlyTrashed()])->where('id', $id)->onlyTrashed()->first();
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

    public function getFulfilledFaculty() 
    {
        return Instructor::where('is_fulfilled', true);
    }
}
