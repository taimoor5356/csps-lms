<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Student;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VisitorController extends Controller
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
            ->addColumn('class_type', function ($row) {
                if ($row) {
                    return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $row->class_type . '</h6>
                            <p class="text-sm text-secondary mb-0">' . $row->class_type . '</p>
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
                            <h6 class="mb-0 text-sm">' . $row->domicile . '</h6>
                        </div>
                    </div>
                ';
            })
            ->addColumn('applied_for', function ($row) {
                return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $row->applied_for . '</h6>
                        </div>
                    </div>
                ';
            })
            ->addColumn('degree_university', function ($row) {
                return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $row->degree . '</h6>
                        </div>
                    </div>
                ';
            })
            ->addColumn('cell_no', function ($row) {
                return '
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">0' . $row->cell_no . '</h6>
                        </div>
                    </div>
                ';
            })
            ->addColumn('action', function ($row) use ($trashed) {
                $btn = '';
                if ($trashed == null) {
                    $btn .= '<a href="#" class="btn btn-success bg-success p-1 view-visitor-detail" data-visitor-id="'. $row->id .'" title="View" data-toggle="modal" data-target="#modal-default"><i class="fa fa-eye"></i></a>
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
            ->rawColumns(['image', 'name_email', 'fathername_occupation', 'domicile', 'cell_no', 'dob_cnic', 'degree_university', 'subject_cgpa', 'action', 'applied_for'])
            ->make(true);
    }
    // showTableData for Index and Trashed

    public function index(Request $request)
    {
        //
        try {
            $visitorsDetail = Visitor::with('user')->get();
            if (Auth::user()->hasRole('visitor')) {
                $visitorsDetail = Visitor::with('user')->where('user_id', Auth::user()->id)->get();
            }
            if ($request->ajax()) {
                return $this->showTableData($visitorsDetail, $trashed = null);
            }
            return view('admin.visitors.index');
        } catch (\Exception $e) {
            dd($e);
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
        return view('admin.visitors.create');
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
            if ( $request->class_type == '' || $request->applied_for == '' || $request->name == '' || $request->gender == '' || $request->cell_no == '' || $request->degree == '' || $request->domicile == '') {
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
                'email' => substr($request->name, 0, 1).rand(1, 1000).'@examplecsps.com',
                'gender' => $request->gender,
                'password' => Hash::make($defaultPassword),
                'role_id' => 5,
                'registration_date' => Carbon::now(),
                'approved_status' => 0,
                // 'photo' => $file
            ]);
            $visitor = Visitor::create([
                'user_id' => $user->id,
                'class_type' => $request->class_type,
                'applied_for' => $request->applied_for,
                'domicile' => $request->domicile,
                'degree' => $request->degree,
                'cell_no' => '03'.$request->cell_no
            ]);
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Data Saved Successfully']);
        } catch (\Exception $e) {

            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
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
        try {
            $student = Visitor::with('user.student')->where('id', $id)->first();
            if (isset($student)) {
                return response()->json(['status' => true, 'visitor' => $student, 'msg' => 'Successfull']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => 'Unexpected Error Occured']);
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
            $student = Visitor::with('user')->where('id', $id)->first();
            if ($student->user->approved_status == 1) {
                return redirect()->back()->with('error', 'User already approved Go check in Student detail page');
            }
            if (isset($student)) {
                $user_id = $student->user_id;
                return view('admin.visitors.edit', compact('student', 'id', 'user_id'));
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashed($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permanentDelete($id)
    {
        //
    }
}
