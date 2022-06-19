<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
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
                        <h6 class="mb-0 text-sm">' . $row->name . '</h6>
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
            return view('admin.roles.index', compact('permissions', 'modules'));
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
        return view('admin.roles.create');
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
                'name' => $request->name,
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
}
