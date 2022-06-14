<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // showTableData for index() and trashed()
    public function showTableData($data, $trashed)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('image', function ($row) {
                $url = URL::to('/');
                return '    
                <div class="d-flex px-2 py-1">
                    <div>
                        <img src="' . $url . '/public/assets/img/students/' . $row->photo . '" class="avatar avatar-lg"
                            alt="user1">
                    </div>
                </div>
            ';
            })
            ->addColumn('name_email', function ($row) {
                return '
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">' . $row->name . '</h6>
                        <p class="text-sm text-secondary mb-0">' . $row->email . '</p>
                    </div>
                </div>
            ';
            })
            ->addColumn('fathername_occupation', function ($row) {
                if (isset($row->student)) {
                    return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $row->student->father_name . '</h6>
                            <p class="text-sm text-secondary mb-0">' . $row->student->father_occupation . '</p>
                        </div>
                    </div>
                    ';
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('dob_cnic', function ($row) {
                if (isset($row->student)) {
                    return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . Carbon::parse($row->student->dob)->format('M d,Y') . '</h6>
                            <p class="text-sm text-secondary mb-0">' . $row->student->cnic . '</p>
                        </div>
                    </div>
                    ';
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('domicile', function ($row) {
                if (isset($row->student)) {
                    return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->student->domicile . '</h6>
                            </div>
                        </div>
                    ';
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('degree_university', function ($row) {
                if (isset($row->student)) {
                    return '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->student->degree . '</h6>
                                <p class="text-sm text-secondary mb-0">' . $row->student->board_university . '</p>
                            </div>
                        </div>
                    ';
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('subject_cgpa', function ($row) {
                if (isset($row->student)) {
                    $val = '
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->student->major_subjects . '</h6>
                                <p class="text-sm text-secondary mb-0">';
                                if ($row->student->cgpa < 4) {
                                    $val .= number_format($row->student->cgpa, 2) . 'GGPA';
                                } else if ($row->student->cgpa > 40) {
                                    $val .= number_format($row->student->cgpa, 2) . '%';
                                }
                        $val .= '</p>
                            </div>
                        </div>
                    ';
                    return $val;
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('distinction', function ($row) {
                if (isset($row->student)) {
                    return $row->student->distinction;
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('action', function ($row) use ($trashed) {
                if (isset($row->student)) {
                    $btn = '';
                    if ($trashed == null) {
                        $btn .= '
                            <a href="#" class="btn btn-success bg-success p-1 view-student-detail" data-student-id="'. $row->student->id .'" title="View" data-toggle="modal" data-target="#modal-default"><i class="fa fa-eye"></i></a>
                            <a href="students/'. $row->student->id .'/edit" data-student-id="'. $row->student->id .'" target="_blank" class="btn btn-primary bg-primary p-1" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="students/'. $row->student->id .'/delete" data-student-id="'. $row->student->id .'" class="btn btn-danger bg-danger p-1 delete-student" title="Delete"><i class="fa fa-trash-o"></i></a>
                        ';
                    } else {
                        $btn .= '
                            <a href="'. $row->student->id .'/restore" data-student-id="'. $row->student->id .'" class="btn btn-success bg-success p-1" title="Restore"><i class="fa fa-undo"></i></a>
                            <a href="'. $row->student->id .'/delete" data-student-id="'. $row->student->id .'" class="btn btn-danger bg-danger p-1 delete-student" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>
                        ';
                    }
                } else {
                    $btn = '';
                    $btn .= '
                        <a href="#" class="btn btn-primary bg-success p-1 view-student-detail" title="View" data-toggle="modal" data-target="#modal-default"><i class="fa fa-eye"></i></a>
                        <a href="#" class="btn btn-primary bg-primary p-1" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="#" class="btn btn-primary bg-danger p-1" title="Delete"><i class="fa fa-trash-o"></i></a>
                    ';
                }
                return $btn;
            })
            ->rawColumns(['image', 'name_email', 'fathername_occupation', 'domicile', 'dob_cnic', 'degree_university', 'subject_cgpa', 'action'])
            ->make(true);
    }
    // showTableData for Index and Trashed

    public function index(Request $request)
    {
        //
        try {
            $studentsDetail = User::with('student')->get();
            if ($request->ajax()) {
                return $this->showTableData($studentsDetail, $trashed = null);
            }
            return view('admin.students.index');
        } catch (\Throwable $th) {
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
        return view('admin.students.create');
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
            DB::beginTransaction();
            if ($request->hasFile('photo')) {
                if ($request->file('photo')->getSize() > 500000) {
                    return redirect()->back()->with('error', 'Max 500KB photo size allowed');
                }
                $file = time().'.'.$request->photo->extension();
                $request->photo->move(public_path('assets/img/students/'), $file);
            } else {
                return redirect()->with('error', 'Profile Photo Required');
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => '3',
                'registration_date' => Carbon::now()->format('d-m-Y'),
                'approved_status' => 0,
                'photo' => $file
            ]);
            $student = Student::create([
                'user_id' => $user->id,
                'batch_no' => $request->batch_no,
                'reg_no' => $request->reg_no,
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
                'cell_no' => $request->cell_no
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Successfully Saved');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $student = Student::with('user')->where('id', $id)->first();
        if (isset($student)) {
            return $student;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try {
            $student = Student::with('user')->where('id', $id)->first();
            if (isset($student)) {
                return view('admin.students.edit', compact('student', 'id'));
            } else {
                return redirect()->back()->with('error', 'User doesnot exists');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
                $student->degree = $request->degree;
                $student->major_subjects = $request->major_subjects;
                $student->cgpa = $request->cgpa;
                $student->board_university = $request->board_university;
                $student->distinction = $request->distinction;
                $student->save();
                $student->user->save();
                DB::commit();
                return redirect()->back()->with('success', 'Updated Successfully');
            } else {
                return redirect()->back()->with('error', 'User doesnot exists');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Show Trashed.
     *
     */
    public function trashed(Request $request)
    {
        //
        $trashedStudents = User::with(['student' => fn($q) => $q->onlyTrashed()])->onlyTrashed()->get();
        try {
            if ($request->ajax()) {
                return $this->showTableData($trashedStudents, $trashed = 'trashed');
            }
            return view('admin.students.trashed');
        } catch (\Throwable $th) {
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
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Permanentally Delete.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permanentDelete(Request $request, $id)
    {
        //
    }
}
