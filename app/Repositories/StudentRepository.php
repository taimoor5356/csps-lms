<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\FeePlan;
use App\Models\Student;
use Illuminate\Support\Str;
use App\Models\RegisteredYear;
use App\Models\RegisteredNumber;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Null_;
use App\Interfaces\StudentRepositoryInterface;
use App\Models\StudentLectureSchedule;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Events\UserRegistered;
use App\Jobs\SendRegistrationEmail;

class StudentRepository implements StudentRepositoryInterface 
{
    public function showTableData($request, $data, $trashed)
    {
        if (!empty($request->alumni_data)) {
            $data = $data->whereYear('created_at', Carbon::now()->subYears(1))->where('exam_status', 'passed');
        }
        return DataTables::of($data->get())
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
                    $enrollmentsUrl = route('enrollments.students', [$row->user_id]);
                    $attendancesUrl = route('attendances', ['students', $row->user_id]);
                    $passedStatusUrl = route('exam_passed_status', [$row->id]);
                    $assignmentsUrl = route('assignments', ['students', $row->id]);
                    $btn = '';
                if ($trashed == null) {
                    $btn .= '<a href="students/'.$row->id.'/show" class="btn btn-primary bg-primary p-1 view-visitor-detail" data-visitor-id="'. $row->id .'" title="View" data-toggle="modal" data-bs-target="#modal-default"><i class="fa fa-eye"></i></a>
                        <a href="students/'. $row->id .'/edit" data-visitor-id="'. $row->id .'" class="btn btn-primary bg-primary p-1" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="'.$enrollmentsUrl.'" data-visitor-id="'. $row->id .'" class="btn btn-primary bg-primary p-1" title="View Enrolled Courses"><i class="fa fa-book"></i></a>
                        <a href="'.$attendancesUrl.'" data-visitor-id="'. $row->id .'" class="btn btn-primary bg-primary p-1" title="View Attendance"><i class="fa fa-clock"></i></a>
                        <a href="'.$assignmentsUrl.'" data-visitor-id="'. $row->id .'" class="btn btn-primary bg-primary p-1" title="View Assignments"><i class="fa fa-file"></i></a>
                        ';
                        if ((!Auth::user()->hasRole('student')) && (!Auth::user()->hasRole('teacher'))) {
                            $btn .='<a href="'.$passedStatusUrl.'" data-visitor-id="'. $row->id .'" class="btn btn-primary bg-primary p-1" title="Edit"><i class="fa fa-check"></i></a> ';
                        }
                        if (Auth::user()->can('student_delete')) {
                            $btn .= ' <a href="students/'. $row->id .'/delete" data-student-id="'. $row->id .'" class="btn btn-danger bg-danger p-1 delete-student" title="Delete"><i class="fa fa-trash-o"></i></a>';
                        }
                } else {
                    $btn .= '<a href="'. $row->id .'/restore" data-visitor-id="'. $row->id .'" class="btn btn-success bg-success p-1" title="Restore"><i class="fa fa-undo"></i></a>';
                    if (Auth::user()->can('visitor_delete')) {
                        $btn .= '<a href="'. $row->id .'/delete" data-visitor-id="'. $row->id .'" class="mx-1 btn btn-danger bg-danger p-1 delete-visitor" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>';
                    }
                }
                } else {
                    // $btn .= '
                    //     <a href="'. $row->id .'/restore" data-student-id="'. $row->id .'" class="btn btn-success bg-success px-2 py-1" title="Restore"><i class="fa fa-undo"></i></a>';
                    // $btn .='
                    //     <a href="'. $row->id .'/delete" data-student-id="'. $row->id .'" class="btn btn-danger bg-danger px-2 py-1 delete-student" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>
                    // ';
                }
                $btn .='';
                return $btn;
            })
            ->rawColumns(['image', 'name_email', 'fathername_occupation', 'domicile', 'dob_cnic', 'degree_university', 'subject_cgpa', 'action'])
            ->make(true);
    }

    public function index($request) 
    {
        try {
            $studentsDetail = Student::with('user');
            if (Auth::user()->hasRole('student')) {
                $studentsDetail = Student::with('user')->where('user_id', Auth::user()->id);
            }
            return $this->showTableData($request, $studentsDetail, $trashed = null);
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
        $compulsorySubjects = Course::where('category', 'compulsory')->get();
        $optionalSubjects = Course::where('category', 'optional')->get();
        $studentSelectedSubjects = StudentLectureSchedule::where('student_id', $student->user_id)->pluck('course_id');
        if (isset($student)) {
            return ['student' => $student, 'compulsorySubjects' => $compulsorySubjects, 'optionalSubjects' => $optionalSubjects, 'studentSelectedSubjects' => $studentSelectedSubjects];
        }
    }

    public function store($request) 
    {
        try {
            DB::beginTransaction();
            $request = (object)$request;
            $userRegistrationNumber = RegisteredNumber::where('registered_batch_id', '=', $request->batch_no)->where('registration_number', '=', $request->reg_no)->first();
            $defaultPassword = '12345678';
            if (Auth::user()->hasRole('admin')) {
                if ($request->visitor == 'true') {
                    $user = User::where('id', $request->user_id)->first();
                    if (isset($user)) {
                        $user->name = $request->name;
                        if ($user->email != $request->email) {
                            $user->email = $request->email;
                        }
                        $user->gender = $request->gender;
                        $user->password = Hash::make($defaultPassword);
                        $user->role_id = Role::where('name', 'student')->first()->id;
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
                        'role_id' => Role::where('name', 'student')->first()->id,
                        'registration_date' => Carbon::now(),
                        'approval_date' => Carbon::now(),
                        'approved_status' => 1,
                    ]);
                }
                if (isset($userRegistrationNumber)) {
                    return response()->json([
                        'status' => false,
                        'msg' => 'Batch and Registration number already exists',
                    ]);
                } else {
                    $userRegistrationNumberStore = RegisteredNumber::create([
                        'user_id' => $user->id,
                        'registered_batch_id' => $request->batch_no,
                        'registration_number' => $request->reg_no
                    ]);
                }
                if ($request->total_fee < $request->paid) {
                    return response()->json(['status' => false, 'msg' => 'Total fee cannot be less than paid fee']);
                }
                $selectedSubjects = NULL;
                if (isset($request->selected_subjects)) {
                    $selectedSubjects = $request->selected_subjects;
                }
                $student = Student::create([
                    'user_id' => $user->id,
                    'batch_starting_date' => $request->batch_starting_date,
                    'cell_no' => $request->cell_no,
                    'year' => $request->year,
                    'batch_no' => $request->batch_no,
                    'roll_no' => $request->roll_no,
                    'reg_no' => $request->reg_no,
                    //
                    'class_type' => $request->class_type,
                    'applied_for' => $request->applied_for,
                    'subject_type' => $request->subject_type,
                    'selected_subjects' => json_encode($selectedSubjects),
                    'interview_type' => !is_null($request->interview_type) ? $request->interview_type : NULL,
                    'examination_type' => !is_null($request->examination_type) ? $request->examination_type : NULL,
                    'installment' => $request->installment,
                    'discount' => $request->discount,
                    'discount_reason' => $request->discount_reason,
                    'paid' => $request->paid,
                    'total_fee' => $request->total_fee,
                    'total_paid' => $request->paid,
                    'due_date' => $request->due_date,
                    'freeze' => $request->freeze,
                    'left' => $request->left,
                    'payment_transfer_mode' => $request->payment_transfer_mode,
                    'fee_submit_date' => $request->fee_submit_date,
                    'challan_generated' => !empty($request->challan_generated) ? $request->challan_generated : null,
                    'challan_number' => !empty($request->challan_generated) ? $user->id.Str::random(12).$user->id : null,
                    'receipt_number' => $request->receipt_number,
                    'fee_refund' => isset($request->fee_refund) ? '1' : '0',
                    'notification_sent' => isset($request->notification_sent) ? '1' : '0',
                    // 'optional_subjects' => $request->optional_subjects,
                ]);
                if ($request->paid > 0) {
                    $paidFee = FeePlan::where('student_id', $student->id)->get()->last();
                    $feePlan = $this->feePlan($student);
                    if (isset($paidFee)) {
                        $alreadyPaid = $paidFee->total_paid;
                    } else {
                        $alreadyPaid = 0;
                    }
                    $feePlan->total_paid = $alreadyPaid + $request->paid;
                    $feePlan->save();
                }
                $user->assignRole(3);
                $subject = 'Login Details';
                // if (Mail::to($request->email)->send(new \App\Mail\Mail($subject))) {
                //     $student->email_notification_sent = 1;
                //     $student->save();
                // }
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Data Saved Successfully']);
            } else {
                return response()->json(['status' => false, 'msg' => 'You donot have permission to perform this action']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            if ($e->getCode() == 23000 && str_contains($e->getMessage(), 'Duplicate entry')) {
                $pattern = "/Duplicate entry '.*' for key '(.*?)'/";
                preg_match($pattern, $e->getMessage(), $matches);
                $columnName = $matches[1];
                $columnName = str_replace('_', ' ', $columnName);
                $columnName = ucfirst($columnName);
                return response()->json(['status' => false, 'msg' => "Duplicate entry for $columnName"]);
            } else {
                dd($e);
                return response()->json(['status' => false, 'msg' => "Something went wrong"]);
            }
        }
    }

    public function feePlan($data)
    {
        $feePlan = FeePlan::create([
            'user_id' => $data->user_id, // student user_id
            'student_id' => $data->id, // student id
            'fee_type' => $data->fee_type,
            'installment' => $data->installment,
            'discount' => $data->discount,
            'discount_reason' => $data->discount_reason,
            'total_fee' => $data->total_fee,
            'paid' => $data->paid,
            'due_date' => $data->due_date,
            'freeze' => $data->freeze,
            'left' => $data->left,
            'fee_refund' => isset($data->fee_refund) ? '1' : '0',
            'fee_notification' => isset($data->notification_sent) ? '1' : '0',
            'challan_generated' => $data->challan_generated,
            'challan_number' => $data->challan_number,
            'payment_transfer_mode' => $data->payment_transfer_mode
        ]);
        return $feePlan;
    }

    public function edit($id)
    {
        try {
            $student = Student::with('user', 'registered_batch')->where('id', $id)->first();
            if (isset($student)) {
                $courses = Course::query();
                $registeredYears = RegisteredYear::where('status', '1')->get();
                return view('students.edit', compact('student', 'id', 'registeredYears', 'courses'));
            } else {
                return redirect()->back()->with('error', 'User doesnot exists');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function update($request, $id) 
    {
        try {
            DB::beginTransaction();
            $student = Student::with('user')->where('id', $id)->first();
            if (isset($student)) {
                $selectedSubjects = NULL;
                if (isset($request->selected_subjects)) {
                    $selectedSubjects = $request->selected_subjects;
                }
                $student->user->name = $request->name;
                $student->user->email = $request->email;
                $student->user->gender = $request->gender;
                $student->user->role_id = 3;
                $studentTotalPaidFee = $student->total_paid;
                $fullyPaid = 0;
                if (Auth::user()->hasRole('admin')) {
                    if (($request->total_fee - $request->discount) < $request->paid) {
                        return response()->json(['status' => false, 'msg' => 'Total fee cannot be less than paid fee']);
                    }
                    if ($student->total_paid == ($request->total_fee - $request->discount)) {
                        $fullyPaid = 1;
                        // return response()->json(['status' => false, 'msg' => 'Already fully paid']);
                    } 
                    $student->total_fee = $request->total_fee;
                    $student->paid = $studentTotalPaidFee + $request->paid;
                    $student->total_paid = $studentTotalPaidFee + $request->paid;
                    $studentTotalPaidAmount = $studentTotalPaidFee + $request->paid;
                    if (($request->total_fee - $request->discount) < $studentTotalPaidAmount) {
                        return response()->json(['status' => false, 'msg' => 'Please check paid fee section']);
                    }
                    $student->batch_no = $request->batch_no;
                    $student->roll_no = $request->roll_no;
                    $student->reg_no = $request->reg_no;
                    $student->cell_no = $request->cell_no;
                    $student->year = $request->year;
                    $student->fee_type = $request->fee_type;
                    $student->installment = $request->installment;
                    $student->discount = $request->discount;
                    $student->discount_reason = $request->discount_reason;
                    $student->payment_transfer_mode = $request->payment_transfer_mode;
                    $student->due_date = $request->due_date;
                    $student->freeze = $request->freeze;
                    $student->left = $request->left;
                    $student->fee_refund = $request->fee_refund;
                    $student->notification_sent = $request->notification_sent;
                    $student->challan_generated = $request->challan_generated;
                    $student->challan_number = $request->challan_number;
                    $student->fee_submit_date = $request->fee_submit_date;
                    $student->applied_for = $request->applied_for;
                    $student->subject_type = $request->subject_type;
                    $student->selected_subjects = null;
                    $student->selected_subjects = json_encode($selectedSubjects);
                    $student->written_exam_type = !is_null($request->written_exam_type) ? $request->written_exam_type : null;
                    $student->interview_type = !is_null($request->interview_type) ? $request->interview_type : null;
                    $student->examination_type = !is_null($request->examination_type) ? $request->examination_type : null;
                    $student->receipt_number = $request->receipt_number;
                    $paidFee = FeePlan::where('student_id', $student->id)->get()->last();
                    if ($fullyPaid == 0) {
                        $request->user_id = $student->user->id;
                        $request->id = $student->id; // student id
                        if ($request->paid > 0) {
                            $feePlan = $this->feePlan($request);
                            if (isset($alreadyPaid)) {
                                $alreadyPaid = $paidFee->total_paid;
                            } else {
                                $alreadyPaid = 0;
                            }
                            $feePlan->total_paid = $alreadyPaid + $request->paid;
                            $feePlan->save();
                        }
                    }
                }
                if (Auth::user()->hasRole('student')) {
                    // $student->user->password = Hash::make($request->password);
                    if ($request->hasFile('photo')) {
                        if ($request->file('photo')->getSize() > 500000) {
                            // return redirect()->back()->with('error', 'Max 500KB photo size allowed');
                            return response()->json(['status' => false, 'msg' => 'Max 500KB photo size allowed']);
                        }
                        $file = time().'.'.$request->photo->extension();
                        $request->photo->move(public_path('assets/img/students/'), $file);
                        $student->user->photo = $file;
                    }
                    $student->form_updated = 'true';
                    $student->father_name = $request->father_name;
                    $student->father_occupation = $request->father_occupation;
                    $student->dob = $request->dob;
                    $student->cnic = $request->cnic;
                    $student->written_result_fpsc_serial_no = $request->written_result_fpsc_serial_no;
                    $student->written_fpsc_roll_no = $request->written_fpsc_roll_no;
                    $student->domicile = $request->domicile;
                    $student->written_exam_preparation_from_csps = $request->written_exam_preparation_from_csps;
                    $student->interview_applied_for = $request->applied_for;
                    $student->student_occupation = $request->distinction;
                    $student->address = $request->address;
                    $student->whatsapp_group_number = $request->whatsapp_group_number;
                    $student->selected_mock_interview = $request->selected_mock_interview;
                    $student->mock_interview_date_time = $request->mock_interview_date_time;
                    $student->cell_no = $request->cell_no;
                    $student->contact_res = $request->contact_res;
                    $student->degree = $request->degree;
                    $student->major_subjects = $request->major_subjects;
                    $student->cgpa = $request->cgpa;
                    $student->board_university = $request->board_university;
                    $student->distinction = $request->distinction;
                    // $student->optional_subjects = $request->optional_subjects;
                    $student->rules_and_regulation = !is_null($request->rules_and_regulation) ? $request->rules_and_regulation : '0';
                    $student->declaration = !is_null($request->declaration) ? $request->declaration : '0';
                    $student->mock_interview_rules_regulations = !is_null($request->mock_interview_rules_regulations) ? $request->mock_interview_rules_regulations : '0';
                }
                $student->save();
                $student->user->save();
                $student->user->assignRole('student');
                SendRegistrationEmail::dispatch($student->user);
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'User doesnot exist']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            if ($e->getCode() == 23000 && str_contains($e->getMessage(), 'Duplicate entry')) {
                $pattern = "/Duplicate entry '.*' for key '(.*?)'/";
                preg_match($pattern, $e->getMessage(), $matches);
                $columnName = $matches[1];
                $columnName = str_replace('_', ' ', $columnName);
                $columnName = ucfirst($columnName);
                return response()->json(['status' => false, 'msg' => "Duplicate entry for $columnName"]);
            } else {
                dd('3');
                return response()->json(['status' => false, 'msg' => "Something went wrong"]);
            }
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
