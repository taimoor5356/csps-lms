<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
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
            ->addColumn('name', function ($row) {
                return '
                <div class="">
                    <div class="">
                        <h6 class="mb-0 text-sm">' . ucwords($row->name) . '</h6>
                    </div>
                </div>
            ';
            })
            ->addColumn('action', function ($row) use ($trashed) {
                $btn = '';
                if ($trashed == null) {
                    $btn .= '
                        <a href="#" class="btn btn-success bg-success p-1 view-role-detail" data-role-id="'. $row->id .'" title="View Permissions" data-toggle="modal" data-target="#modal-default"><i class="fa fa-key"></i></a>
                        <a href="roles/'. $row->id .'/edit" data-role-id="'. $row->id .'" target="_blank" class="btn btn-primary bg-primary p-1" title="Edit role"><i class="fa fa-pencil"></i></a>
                        <a href="roles/'. $row->id .'/delete" data-role-id="'. $row->id .'" class="btn btn-danger bg-danger p-1 delete-role" title="Delete"><i class="fa fa-trash-o"></i></a>
                    ';
                } else {
                    $btn .= '
                        <a href="'. $row->id .'/restore" data-role-id="'. $row->id .'" class="btn btn-success bg-success p-1" title="Restore"><i class="fa fa-undo"></i></a>
                        <a href="'. $row->id .'/delete" data-role-id="'. $row->id .'" class="btn btn-danger bg-danger p-1 delete-role" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>
                    ';
                }
                return $btn;
            })
            ->rawColumns(['image', 'name', 'fee', 'action'])
            ->make(true);
    }
    
    // showTableData for Index and Trashed
    public function index(Request $request)
    {
        //
        try {
            $roles = Role::get();
            if ($request->ajax()) {
                return $this->showTableData($roles, $trashed = null);
            }
            $modules = Permission::select('module')->groupBy('module')->get();
            $permissions = Permission::get();
            return view('roles.index', compact('permissions', 'modules'));
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
        return view('roles.create');
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
            $roles = Role::create([
                'name' => strtolower($request->name),
                'guard_name' => 'web',
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Successfully Saved');
        } catch (\Throwable $th) {
            dd($th);
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
        $permissions = DB::table('role_has_permissions')->where('role_id', $id)->pluck('permission_id')->all();
        return $permissions;
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
        dd('Under Construction');
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
        dd('Under Construction');
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
        dd('Under Construction');
    }

    public function assignRoleToModel(Request $request)
    {
        $user = User::find($request->id);
        $user->assignRole($request->role);
    }

    public function assignPermissionToRole(Request $request)
    {
        try {
            DB::beginTransaction();
            $role = Role::find($request->input('role_id'));
            $allPermissions = Permission::get();
            if ($request->input('role_id') != 1) {
                $permissions = $request->input('permissions');
                $role->revokePermissionTo($allPermissions);
                $role->syncPermissions($permissions);
            } else {
                // $role->syncPermissions($allPermissions);
                
                $permissions = $request->input('permissions');
                $role->revokePermissionTo($allPermissions);
                $role->syncPermissions($permissions);
            }
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Updated Successfully']);
        } catch (\Exception $e) {
            return response()->json(['status', false, 'message' => 'Something went wrong']);
        }
    }
}
