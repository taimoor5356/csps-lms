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
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard(Request $request)
    {
        return view('dashboard.index');
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
                    $btn .= '
                        <a href="#" class="btn btn-success bg-success p-1 view-admin-detail" data-admin-id="'. $row->id .'" title="View" data-toggle="modal" data-target="#modal-default"><i class="fa fa-eye"></i></a>
                        <a href="admins/'. $row->id .'/edit" data-admin-id="'. $row->id .'" target="_blank" class="btn btn-primary bg-primary p-1" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="admins/'. $row->id .'/delete" data-admin-id="'. $row->id .'" class="btn btn-danger bg-danger p-1 delete-admin" title="Delete"><i class="fa fa-trash-o"></i></a>
                    ';
                } else {
                    $btn .= '
                        <a href="'. $row->id .'/restore" data-admin-id="'. $row->id .'" class="btn btn-success bg-success p-1" title="Restore"><i class="fa fa-undo"></i></a>
                        <a href="'. $row->id .'/delete" data-admin-id="'. $row->id .'" class="btn btn-danger bg-danger p-1 delete-admin" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>
                    ';
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
            } else {
                // return redirect()->back()->with('error', 'Profile Photo Required');
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role,
                'registration_date' => Carbon::now()->format('Y-m-d'),
                'approved_status' => 0,
                'photo' => $file
            ]);
            $admin = Admin::create([
                'user_id' => $user->id,
                'batch_no' => $request->batch_no,
                'reg_no' => $request->reg_no,
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
            return redirect()->back()->with('success', 'Successfully Saved');
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
        $admin = Admin::with('user')->where('id', $id)->first();
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
            $admin = Admin::with('user')->where('id', $id)->first();
            if (isset($admin)) {
                return view('all_admins.edit', compact('admin', 'id'));
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
                $admin->applied_for = $request->applied_for;
                $admin->batch_no = $request->batch_no;
                $admin->reg_no = $request->reg_no;
                $admin->user->name = $request->name;
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
                $admin->father_occupation = $request->father_occupation;
                $admin->dob = $request->dob;
                $admin->cnic = $request->cnic;
                $admin->domicile = $request->domicile;
                $admin->admin_occupation = $request->admin_occupation;
                $admin->address = $request->address;
                $admin->contact_res = $request->contact_res;
                $admin->cell_no = $request->cell_no;
                $admin->degree = $request->degree;
                $admin->major_subjects = $request->major_subjects;
                $admin->cgpa = $request->cgpa;
                $admin->board_university = $request->board_university;
                $admin->distinction = $request->distinction;
                $admin->save();
                $admin->user->save();
                $admin->user->assignRole(3);
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
            $admin = Admin::with('user')->where('id', $id)->first();
            if (isset($admin)) {
                if (isset($admin->user)) {
                    $admin->user->delete();
                    $admin->delete();
                    return redirect()->back()->with('success', 'Deleted Successfully');
                }
            } else {
                return redirect()->back()->with('error', 'User doesnot exists');
            }
        } catch (\Exception $e) {
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
        $trashedadmins = User::with(['admin' => fn($q) => $q->onlyTrashed()])->onlyTrashed()->get();
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
    }
}
