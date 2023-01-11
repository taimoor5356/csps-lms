<?php

namespace App\Repositories;

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
use App\Interfaces\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface 
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
                            <img src="' . $url . '/public/assets/img/students/' . $row->user->photo . '" class="avatar avatar-lg"
                                alt="user1">
                        </div>
                    </div>
                    ';
                } else {
                    return '    
                    <div class="d-flex px-2 py-1">
                        <div>
                            <img src="' . $url . '/public/assets/img/students/" class="avatar avatar-lg"
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
            ->addColumn('fathername_occupation', function ($row) {
                return '
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">' . $row->father_name . '</h6>
                        <p class="text-sm text-secondary mb-0">' . $row->father_occupation . '</p>
                    </div>
                </div>
                ';
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
            ->addColumn('domicile', function ($row) {
                return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $row->domicile . '</h6>
                        </div>
                    </div>
                ';
            })
            ->addColumn('degree_university', function ($row) {
                return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $row->degree . '</h6>
                            <p class="text-sm text-secondary mb-0">' . $row->board_university . '</p>
                        </div>
                    </div>
                ';
            })
            ->addColumn('subject_cgpa', function ($row) {
                $val = '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $row->major_subjects . '</h6>
                            <p class="text-sm text-secondary mb-0">';
                            if ($row->cgpa < 4) {
                                $val .= number_format($row->cgpa, 2) . 'GGPA';
                            } else if ($row->cgpa > 40) {
                                $val .= number_format($row->cgpa, 2) . '%';
                            }
                    $val .= '</p>
                        </div>
                    </div>
                ';
                return $val;
            })
            ->addColumn('distinction', function ($row) {
                return $row->distinction;
            })
            ->addColumn('action', function ($row) use ($trashed) {
                $btn = '';
                if ($trashed == null) {
                    $btn .= '
                        <a href="students/'.$row->id.'/show" class="btn btn-success bg-success p-1 -view-student-detail" data-student-id="'. $row->id .'" title="View" data-toggle="modal" data-target="#modal-default"><i class="fa fa-eye"></i></a>
                        <a href="students/'. $row->id .'/edit" data-student-id="'. $row->id .'" class="btn btn-primary bg-primary p-1" title="Edit"><i class="fa fa-pencil"></i></a>';
                    if (Auth::user()->can('student_delete')) {
                        $btn .='<a href="students/'. $row->id .'/delete" data-student-id="'. $row->id .'" class="mx-1 btn btn-danger bg-danger p-1 delete-student" title="Delete"><i class="fa fa-trash-o"></i></a>';
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
            ->rawColumns(['image', 'name_email', 'fathername_occupation', 'domicile', 'dob_cnic', 'degree_university', 'subject_cgpa', 'action'])
            ->make(true);
    }

    public function index($request) 
    {
        try {
            $studentsDetail = Student::with('user')->get();
            if (Auth::user()->hasRole('student')) {
                $studentsDetail = Student::with('user')->where('user_id', Auth::user()->id)->get();
            }
            return $this->showTableData($studentsDetail, $trashed = null);
        } catch (\Exception $e) {
            return redirect()->back()->withError('Something went wrong');
        }
    }

    public function create()
    {
        
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
            // if ($request->hasFile('photo')) {
            //     $file = time().'.'.$request->photo->extension();
            //     $directory = public_path('assets/img/students/');
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
                    $user->role_id = 3;
                    $user->approval_date = Carbon::now();
                    $user->approved_status = 1;
                    $user->save();
                }
            } else {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'password' => Hash::make($defaultPassword),
                    'role_id' => 3,
                    'registration_date' => Carbon::now(),
                    'approval_date' => Carbon::now(),
                    'approved_status' => 1,
                    // 'photo' => $file
                ]);
            }
            if (Auth::user()->hasRole('admin')) {
                $student = Student::create([
                    'user_id' => $user->id,
                    'contact_no' => $request->contact_no,
                    'reg_no' => $request->reg_no,
                    'year' => $request->year,
                    'batch_no' => $request->batch_no,
                    'roll_no' => $request->roll_no,
                    'class_type' => $request->class_type,
                    'applied_for' => $request->applied_for,
                    'fee_type' => $request->fee_type,
                    'installment' => $request->installment,
                    'discount' => $request->discount,
                    'total_fee' => $request->total_fee,
                    'due_date' => $request->due_date,
                    'freeze' => $request->freeze,
                    'leave' => $request->leave,
                    'fee_refund' => isset($request->fee_refund) ? '1' : '0',
                    'notification_sent' => isset($request->notification_sent) ? '1' : '0',
                    'challan_generated' => isset($request->challan_generated) ? '1' : '0',
                    'fee_submit_date' => $request->fee_submit_date,
                ]);
            } else if (Auth::user()->hasRole('student')) {
                $student = Student::create([
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
                    // 'fee_type' => $request->fee_type,
                    'mock_exam_evaluation' => $request->mock_exam_evaluation,
                    // 'installment' => $request->installment,
                    // 'discount' => $request->discount,
                    // 'total_fee' => $request->total_fee,
                    // 'due_date' => $request->due_date,
                    // 'freeze' => $request->freeze,
                    // 'leave' => $request->leave,
                    // 'fee_refund' => $request->fee_refund ? '1' : '0',
                    // 'notification_sent' => $request->notification_sent ? '1' : '0',
                    // 'challan_generated' => $request->challan_generated ? '1' : '0',
                    // 'fee_submit_date' => $request->fee_submit_date
                ]);
            }
            $user->assignRole(3);
            $subject = 'Login Details';
            if (Mail::to($request->email)->send(new \App\Mail\Mail($subject))) {
                $student->email_notification_sent = 1;
                $student->save();
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
                    $request->photo->move(public_path('assets/img/students/'), $file);
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
        $trashedStudents = Student::with(['user' => fn($q) => $q->onlyTrashed()])->onlyTrashed()->get();
        try {
            return $this->showTableData($trashedStudents, $trashed = 'trashed');
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

    public function getFulfilledStudents() 
    {
        return Student::where('is_fulfilled', true);
    }
}
