<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\FeePlan;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->hasRole('student') || Auth::user()->hasRole('teacher')) {
                return redirect()->route('logout');
            }
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard(Request $request)
    {
        //
        $totalStudents = Student::query()->count();
        $todayPresentStudents = Attendance::query()->where('attendance', 'present')->whereDate('created_at', Carbon::now())->count();
        $todayAbsentStudents = Attendance::query()->where('attendance', 'absent')->whereDate('created_at', Carbon::now())->count();
        $totalFeeAwaitingStudents = FeePlan::query()->where('paid_status', 0)->groupBy('student_id')->count();
        $monthlyFees = DB::table(DB::raw("(SELECT 1 as month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) as months"))
        ->leftJoin(DB::raw('(SELECT MONTH(created_at) as month, SUM(paid) as total_fee FROM fee_plans WHERE paid_status = 1 AND YEAR(created_at) >= 2020 GROUP BY MONTH(created_at)) as fee_data'), 'months.month', '=', 'fee_data.month')
        ->selectRaw('COALESCE(total_fee, 0) as total_fee, DATE_FORMAT(CONCAT("2022-", months.month, "-01"), "%b") as month_name')
        ->orderBy('months.month')
        ->get();
        $monthlyExpenses = DB::table(DB::raw("(SELECT 1 as month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) as months"))
                        ->leftJoin(DB::raw('(SELECT MONTH(created_at) as month, SUM(amount) as total_expenses FROM expenses GROUP BY MONTH(created_at)) as expense_data'), 'months.month', '=', 'expense_data.month')
                        ->selectRaw('COALESCE(total_expenses, 0) as total_expenses, DATE_FORMAT(CONCAT("2022-", months.month, "-01"), "%b") as month_name')
                        ->orderBy('months.month')
                        ->get();
        //
        $total_students = $totalStudents;
        $today_present_students = $todayPresentStudents;
        $today_absent_students = $todayAbsentStudents;
        $total_fee_awaiting_students = $totalFeeAwaitingStudents;
        $revenue = $monthlyFees;
        $expenses = $monthlyExpenses;
        return view('dashboard.index', compact('expenses', 'total_students', 'today_present_students', 'today_absent_students', 'total_fee_awaiting_students', 'revenue'));
    }

    // showTableData for index() and trashed()
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
                            <img src="' . $url . '/public/assets/img/admins/' . $row->user->photo . '" class="avatar avatar-lg"
                                alt="user1">
                        </div>
                    </div>
                    ';
                } else {
                    return '    
                    <div class="d-flex px-2 py-1">
                        <div>
                            <img src="' . $url . '/public/assets/img/admins/" class="avatar avatar-lg"
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
            ->addColumn('role', function ($row) {
                if (isset($row->user)) {
                    $roleName = $row->user->getRoleNames();
                    return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $roleName[0] . '</h6>
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
                    if (Auth::user()->can('admin_view')) {
                        $btn .= '
                            <a href="#" class="btn btn-success bg-success p-1 view-admin-detail" data-admin-id="'. $row->id .'" title="View" data-toggle="modal" data-bs-target="#modal-default"><i class="fa fa-eye"></i></a>';
                    }
                    if (Auth::user()->can('admin_update')) {
                        $btn .= ' <a href="admins/'. $row->id .'/edit" data-admin-id="'. $row->id .'" class="btn btn-primary bg-primary p-1" title="Edit"><i class="fa fa-pencil"></i></a>';
                    }
                    if (Auth::user()->can('admin_delete')) {
                        $btn .= ' <a href="admins/'. $row->id .'/delete" data-admin-id="'. $row->id .'" class="btn btn-danger bg-danger p-1 delete-admin" title="Delete"><i class="fa fa-trash-o"></i> </a> ';
                        if (isset($row->user)) {
                            if ($row->user->approved_status == 1) {
                                $btn .= '</a> </a> <a href="admins/'. $row->id .'/block" class="btn btn-danger bg-danger p-1" title="Block"><i class="fa fa-lock"></i></a>
                                ';
                            } else {
                                $btn .= '<a href="admins/'. $row->id .'/approve" class="btn btn-success bg-success p-1" title="Approve"><i class="fa fa-unlock"></i></a> ';
                            }
                        }
                    }
                } else {
                    if (Auth::user()->can('admin_delete')) {
                        $btn .= ' <a href="admins/'. $row->id .'/restore" data-admin-id="'. $row->id .'" class="btn btn-success bg-success p-1" title="Restore"><i class="fa fa-undo"></i></a> <a href="#" data-admin-id="'. $row->id .'" class="btn btn-danger bg-danger p-1 delete-admin" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>
                        ';
                    }
                }
                return $btn;
            })
            ->rawColumns(['image', 'name_email', 'role', 'dob_cnic', 'action'])
            ->make(true);
    }
    // showTableData for Index and Trashed

    public function index(Request $request)
    {
        //
        try {
            $adminsDetail = Admin::with('user')->get();
            if ($request->ajax()) {
                return $this->showTableData($adminsDetail, $trashed = null);
            }
            return view('all_admins.index');
        } catch (\Exception $e) {
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
        $roles = Role::get();
        return view('all_admins.create', compact('roles'));
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
            $file = 'admin-profile.png';
            if ($request->hasFile('photo')) {
                if ($request->file('photo')->getSize() > 500000) {
                    return redirect()->back()->with('error', 'Max 500KB photo size allowed');
                }
                $file = time().'.'.$request->photo->extension();
                $request->photo->move(public_path('assets/img/admins/'), $file);
            }
            $password = '12345678';
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($password),
                'role_id' => $request->role,
                'registration_date' => Carbon::now()->format('Y-m-d'),
                'approved_status' => 0,
                'photo' => $file
            ]);
            $randomString = Str::random(20, '0123456789');
            $regNo = 'csps_'.$randomString;
            if (Admin::where('reg_no', $regNo)->exists()) {
                return redirect()->back()->with('error', 'Registration number already exists');
            }
            $admin = Admin::create([
                'user_id' => $user->id,
                'batch_no' => $request->batch_no,
                'reg_no' => $regNo,
                'applied_for' => $request->applied_for,
                'father_name' => $request->father_name,
                'father_occupation' => $request->father_occupation,
                'dob' => $request->dob,
                'cnic' => $request->cnic,
                'domicile' => $request->domicile,
                'admin_occupation' => $request->admin_occupation,
                'degree' => $request->degree,
                'major_subjects' => $request->major_subjects,
                'cgpa' => $request->cgpa,
                'board_university' => $request->board_university,
                'distinction' => $request->disctinction,
                'address' => $request->address,
                'contact_res' => $request->contact_res,
                'cell_no' => $request->cell_no
            ]);
            $user->assignRole($request->role);
            DB::commit();
            return redirect()->route('admins')->with('success', 'Successfully Saved');
        } catch (\Exception $e) {
            dd($e);
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
        $admin = Admin::with(['user', 'batch'])->where('id', $id)->first();
        if (isset($admin)) {
            return $admin;
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
            $roles = Role::get();
            $admin = Admin::with('user')->where('id', $id)->first();
            if (isset($admin)) {
                return view('all_admins.edit', compact('admin', 'id', 'roles'));
            } else {
                return redirect()->back()->with('error', 'User doesnot exists');
            }
        } catch (\Exception $e) {
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
            $admin = Admin::with('user')->where('id', $id)->first();
            if (isset($admin)) {
                $admin->batch_no = $request->batch_no;
                $admin->user->name = $request->name;
                if (User::where('id', '!=', $admin->user->id)->where('email', $request->email)->exists()) {
                    return redirect()->back()->with('error', 'Email already exists');
                }
                $admin->user->email = $request->email;
                $admin->user->password = Hash::make($request->password);
                if ($request->hasFile('photo')) {
                    if ($request->file('photo')->getSize() > 500000) {
                        return redirect()->back()->with('error', 'Max 500KB photo size allowed');
                    }
                    $file = time().'.'.$request->photo->extension();
                    $request->photo->move(public_path('assets/img/admins/'), $file);
                    $admin->user->photo = $file;
                }
                $admin->father_name = $request->father_name;
                $admin->dob = $request->dob;
                $admin->cnic = $request->cnic;
                $admin->domicile = $request->domicile;
                $admin->address = $request->address;
                $admin->contact_res = $request->contact_res;
                $admin->cell_no = $request->cell_no;
                if ($admin->user->role_id != 1 && $request->role != 1) {
                    $admin->user->role_id = $request->role;
                    $admin->user->syncRoles([]);
                    $admin->user->assignRole($request->role);
                }
                $admin->save();
                $admin->user->save();
                DB::commit();
                return redirect()->back()->with('success', 'Updated Successfully');
            } else {
                return redirect()->back()->with('error', 'User doesnot exists');
            }
        } catch (\Exception $e) {
            // dd($e);
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
            if ($id != 1) {
                $admin = Admin::with('user')->where('id', $id)->first();
                if (isset($admin)) {
                    if (isset($admin->user)) {
                        $admin->user->delete();
                        $admin->delete();
                        return response()->json([
                            'status' => true,
                            'msg' => 'Deleted successfully'
                        ]);
                        // return redirect()->back()->with('success', 'Deleted Successfully');
                    }
                } else {
                    return response()->json([
                        'status' => false,
                        'msg' => 'User doesnot exists'
                    ]);
                    // return redirect()->back()->with('error', 'User doesnot exists');
                }
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => 'Cannot delete Admin'
                ]);
                // return redirect()->back()->with('error', 'Cannot delete admin');
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong'
            ]);
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
        $trashedadmins = Admin::with(['user' => fn($q) => $q->onlyTrashed()->whereNotIn('role_id', [1, 2, 3, 4])])->onlyTrashed()->get();
        try {
            if ($request->ajax()) {
                return $this->showTableData($trashedadmins, $trashed = 'trashed');
            }
            return view('all_admins.trashed');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function restore($id)
    {
        try {
            $trashedadmin = Admin::with(['user' => fn($q) => $q->onlyTrashed()])->where('id', $id)->onlyTrashed()->first();
            if (isset($trashedadmin)) {
                $trashedadmin->user->restore();
                $trashedadmin->restore();
                return redirect()->back()->with('success', 'admin data Restored');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } catch (\Exception $e) {
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
        try {
            if ($id != 1) {
                $admin = Admin::with(['user' => fn($q) => $q->onlyTrashed()->whereNotIn('role_id', [1, 2, 3, 4])])->onlyTrashed()->where('id', $id)->first();
                if (isset($admin)) {
                    if (isset($admin->user)) {
                        $admin->user->forceDelete();
                        $admin->forceDelete();
                        return response()->json([
                            'status' => true,
                            'msg' => 'Deleted successfully'
                        ]);
                        // return redirect()->back()->with('success', 'Deleted Successfully');
                    }
                } else {
                    return response()->json([
                        'status' => false,
                        'msg' => 'User doesnot exists'
                    ]);
                    // return redirect()->back()->with('error', 'User doesnot exists');
                }
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => 'Cannot delete Admin'
                ]);
                // return redirect()->back()->with('error', 'Cannot delete admin');
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong'
            ]);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function userApproval($id)
    {
        $admin = Admin::with('user')->where('id', $id)->first();
        if (isset($admin)) {
            $admin->user->approved_status = 1;
            $admin->user->save();
            return redirect()->back()->with('success', 'Updated successfully');
        }
    }

    public function userBlock(Request $request, $id)
    {
        $admin = Admin::with(['user' => fn($q) => $q->where('id', '!=', 1)])->where('id', $id)->first();
        if (isset($admin->user)) {
            if ($admin->user->id != 1) {
                $admin->user->approved_status = 0;
                $admin->user->save();
                $admin->user->force_logout = true; // Set the flag to log the user out
                return redirect()->back()->with('success', 'Updated successfully');
            } else {
                return redirect()->back()->with('error', 'Not allowed for Admin');
            }
        } else {
            return redirect()->back()->with('error', 'Not allowed for Admin');
        }
    }
}
