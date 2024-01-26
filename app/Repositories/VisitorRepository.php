<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Visitor;
use App\Models\RegisteredYear;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Interfaces\VisitorRepositoryInterface;

class VisitorRepository implements VisitorRepositoryInterface 
{
    // showTableData for index() and trashed()
    public function showTableData($request, $data, $trashed)
    {
        $searchValue = $request->search['value'];
        // Apply global search
        if (!empty($searchValue)) {
            $data = $data->where(function ($query) use ($searchValue) {
                $query->whereHas('user', function ($subQuery) use ($searchValue) {
                    $subQuery->where('name', 'LIKE', "%$searchValue%")
                        ->orWhere('email', 'LIKE', "%$searchValue%");
                })
                ->orWhere('degree', 'LIKE', "%$searchValue%")
                ->orWhere('domicile', 'LIKE', "%$searchValue%")
                ->orWhere('cell_no', 'LIKE', "%$searchValue%");
            });
        }
        $totalRecords = $data->count(); // Get the total number of records for pagination
        $visitors = $data->skip($request->start)
            ->take($request->length)
            ->get();
        return DataTables::of($visitors)
            ->addIndexColumn()
            ->addColumn('date', function ($row) {
                if ($row) {
                    return Carbon::parse($row->created_at)->format('Y-m-d');
                } else {
                    return '';
                }
            })
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
                            <h6 class="mb-0 text-sm text-capitalize">' . $row->user->name . '</h6>
                            <p class="text-sm text-secondary mb-0 text-lowercase">' . $row->user->email . '</p>
                        </div>
                    </div>
                    ';
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('class_type', function ($row) {
                if ($row) {
                    return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm text-capitalize">' . $row->class_type . '</h6>
                        </div>
                    </div>
                    ';
                } else {
                    return 'No Data';
                }
            })
            ->addColumn('domicile', function ($row) {
                return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm text-capitalize">' . $row->domicile . '</h6>
                        </div>
                    </div>
                ';
            })
            ->addColumn('applied_for', function ($row) {
                return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm text-uppercase">' . $row->applied_for . '</h6>
                        </div>
                    </div>
                ';
            })
            ->addColumn('degree_university', function ($row) {
                return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm text-capitalize">' . $row->degree . '</h6>
                        </div>
                    </div>
                ';
            })
            ->addColumn('cell_no', function ($row) {
                return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm text-capitalize">' . $row->cell_no . '</h6>
                        </div>
                    </div>
                ';
            })
            ->addColumn('action', function ($row) use ($trashed) {
                $btn = '';
                if ($trashed == null) {
                    $btn .= '<a href="#" class="btn btn-success bg-success p-1 view-visitor-detail" data-visitor-id="'. $row->id .'" title="View" data-toggle="modal" data-bs-target="#modal-default"><i class="fa fa-eye"></i></a>
                        <a href="visitors/'. $row->id .'/edit" data-visitor-id="'. $row->id .'" class="btn btn-primary bg-primary p-1" title="Edit"><i class="fa fa-pencil"></i></a>';
                        if (Auth::user()->can('visitor_delete')) {
                            $btn .= '<a href="'. $row->id .'/delete" data-visitor-id="'. $row->id .'" class="mx-1 btn btn-danger bg-danger p-1 delete-visitor" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>';
                        }
                } else {
                    $btn .= '<a href="'. $row->id .'/restore" data-visitor-id="'. $row->id .'" class="btn btn-success bg-success p-1" title="Restore"><i class="fa fa-undo"></i></a>';
                    if (Auth::user()->can('visitor_delete')) {
                        $btn .= '<a href="'. $row->id .'/delete" data-visitor-id="'. $row->id .'" class="mx-1 btn btn-danger bg-danger p-1 delete-visitor" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>';
                    }
                }
                return $btn;
            })
            ->rawColumns(['image', 'name_email', 'fathername_occupation', 'domicile', 'cell_no', 'dob_cnic', 'degree_university', 'subject_cgpa', 'action', 'applied_for', 'class_type'])
            ->setTotalRecords($totalRecords)
            ->setFilteredRecords($totalRecords) // For simplicity, same as totalRecords
            ->skipPaging()
            ->make(true);
    }

    public function index($request) 
    {
        try {
            $visitorsDetail = Visitor::withoutGlobalScopes()->with('user')->orderBy('id', 'desc');
            if (Auth::user()->hasRole('visitor')) {
                $visitorsDetail = Visitor::withoutGlobalScopes()->with('user')->where('user_id', Auth::user()->id)->orderBy('id', 'desc');
            }
            return $this->showTableData($request, $visitorsDetail, $trashed = null);
        } catch (\Exception $e) {
            return redirect()->back()->withError('Something went wrong');
        }
    }

    public function create()
    {
        //
    }

    public function store($request) 
    {
        $request = (object)$request;
        $classType = '';
        if (!empty($request->class_type)) {
            $classType = $request->class_type;
        }
        try {
            DB::beginTransaction();
            if ( $classType == '' || $request->applied_for == '' || $request->name == '' || $request->gender == '' || $request->cell_no == '' || $request->degree == '' || $request->domicile == '') {
                return response()->json(['status' => false, 'msg' => 'All fields required']);
            }
            if (!preg_match('/^[A-Za-z ]+$/', $request->name)) {
                return response()->json(['status' => false, 'msg' => 'Name cannot be in number format']);
            }
            if (ctype_alpha($request->cell_no)) {
                return response()->json(['status' => false, 'msg' => 'Contact number cannot be in alphabet format']);
            }
            if (!preg_match('/^[A-Za-z ]+$/', $request->degree)) {
                return response()->json(['status' => false, 'msg' => 'Qualification cannot be in number format']);
            }
            if (strlen($request->cell_no) > 9 || strlen($request->cell_no) < 9) {
                return response()->json(['status' => false, 'msg' => 'Only nine digits contact number is allowed']);
            }
            $defaultPassword = '876543210';
            $user = User::create([
                'name' => $request->name,
                'email' => strtolower(substr($request->name, 0, 1).rand(1, 1000).'@examplecsps.com'),
                'gender' => $request->gender,
                'password' => Hash::make($defaultPassword),
                'role_id' => 5,
                'registration_date' => Carbon::now(),
                'approved_status' => 0,
                // 'photo' => $file
            ]);
            $visitor = Visitor::create([
                'user_id' => $user->id,
                'class_type' => $classType,
                'applied_for' => $request->applied_for,
                'domicile' => $request->domicile,
                'degree' => $request->degree,
                'cell_no' => '03'.$request->cell_no,
                'date' => $request->date,
            ]);
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Data Saved Successfully']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function show($id) 
    {
        //
        try {
            $student = Visitor::with('user.student')->where('id', $id)->first();
            if (isset($student)) {
                return response()->json(['status' => true, 'visitor' => $student, 'msg' => 'Successfull']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => 'Unexpected Error Occured']);
        }
    }

    public function edit($id)
    {
        try {
            $courses = Course::query();
            $student = Visitor::with('user')->where('id', $id)->first();
            if (isset($student)) {
                if ($student->user->approved_status == 1) {
                    return redirect()->back()->with('error', 'User already approved Go check in Student detail page');
                }
                $user_id = $student->user_id;
                $registeredYears = RegisteredYear::where('status', '1')->get();
                return view('visitors.edit', compact('student', 'id', 'user_id', 'registeredYears', 'courses'));
            } else {
                return redirect()->back()->with('error', 'User doesnot exists');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function update($request, $id) 
    {
        //
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
}
