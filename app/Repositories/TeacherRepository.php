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
use Spatie\Permission\Models\Role;

class TeacherRepository implements TeacherRepositoryInterface 
{
    public function showTableData($request, $data, $trashed)
    {
        $searchValue = $request->search['value'];
        // Apply global search
        if (!empty($searchValue)) {
            $data = $data->where(function ($query) use ($searchValue) {
                $query->whereHas('user', function ($subQuery) use ($searchValue) {
                    $subQuery->where('name', 'LIKE', "%$searchValue%")
                        ->orWhere('email', 'LIKE', "%$searchValue%");
                });
            });
        }
        $totalRecords = $data->count(); // Get the total number of records for pagination
        $teachers = $data->skip($request->start)
            ->take($request->length)
            ->get();
        return DataTables::of($teachers)
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
                        <h6 class="mb-0 text-sm">' . (!empty($row->dob) ? (Carbon::parse($row->dob)->format('M d,Y')) : '') . '</h6>
                        <p class="text-sm text-secondary mb-0">' . $row->cnic . '</p>
                    </div>
                </div>
                ';
            })
            ->addColumn('action', function ($row) use ($trashed) {
                $btn = '';
                if ($trashed == null) {
                    $enrollmentsUrl = route('enrollments.teachers', [$row->user_id]);
                    $attendancesUrl = route('attendances', ['teachers', $row->user_id]);
                    $btn .='
                    <a href="#" class="btn btn-secondary bg-secondary px-2 py-1" title="More" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bars"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right border border-default">
                        <!-- Your dropdown menu items go here -->
                        <a class="dropdown-item" href="teachers/'.$row->id.'/show">View Detail</a>
                        <a class="dropdown-item" href="teachers/'. $row->id .'/edit">Edit</a>
                        <a class="dropdown-item" href="'.$enrollmentsUrl.'">View Enrolled Courses</a>
                        <a class="dropdown-item" href="'.$attendancesUrl.'">View Attendance</a>';
                    if (Auth::user()->can('teacher_delete')) {
                        $btn .='<a class="dropdown-item bg-danger text-white" href="teachers/'. $row->id .'/delete">Delete</a>';
                    }
                } else {
                    // $btn .= '
                    //     <a href="'. $row->id .'/restore" data-student-id="'. $row->id .'" class="btn btn-success bg-success px-2 py-1" title="Restore"><i class="fa fa-undo"></i></a>';
                    // $btn .='
                    //     <a href="'. $row->id .'/delete" data-student-id="'. $row->id .'" class="btn btn-danger bg-danger px-2 py-1 delete-student" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>
                    // ';
                }
                $btn .='</div>';
                return $btn;
            })
            ->rawColumns(['image', 'name_email', 'dob_cnic', 'action'])
            ->setTotalRecords($totalRecords)
            ->setFilteredRecords($totalRecords) // For simplicity, same as totalRecords
            ->skipPaging()
            ->make(true);
    }

    public function index($request) 
    {
        try {
            $teacherDetail = Teacher::withoutGlobalScopes()->with('user');
            if (Auth::user()->hasRole('teacher')) {
                $teacherDetail = Teacher::withoutGlobalScopes()->with('user')->where('user_id', Auth::user()->id);
            }
            return $this->showTableData($request, $teacherDetail, $trashed = null);
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
                'role_id' => Role::where('name', 'teacher')->first()->id,
                'registration_date' => Carbon::now(),
                'approved_status' => 0,
                // 'photo' => $file
            ]);
            $teacher = Teacher::create([
                'user_id' => $user->id,
                'batch_no' => $request->batch_no,
                'reg_no' => $request->reg_no,
                'cell_no' => $request->contact_no,
                'class_type' => $request->class_type
            ]);
            $user->assignRole(2);
            // $subject = 'Login Details';
            // if (Mail::to($request->email)->send(new \App\Mail\Mail($subject))) {
            //     $teacher->notification = $request->notification ? $request->notification : '0';
            // }
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
            $request = (object)$request;
            DB::beginTransaction();
            $teacher = Teacher::with('user')->where('id', $id)->first();
            if (isset($teacher)) {
                $teacher->class_type = $request->class_type;
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
                $teacher->contact_res = $request->contact_res;
                $teacher->cell_no = $request->cell_no;
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
            dd($e);
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
