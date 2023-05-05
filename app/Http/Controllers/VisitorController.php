<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Interfaces\VisitorRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VisitorController extends Controller
{
    private $visitorRepository;

    public function __construct(VisitorRepositoryInterface $visitorRepository)
    {
        $this->visitorRepository = $visitorRepository;
    }

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
                            <img src="' . $url . '/public/assets/img/visitors/' . $row->user->photo . '" class="avatar avatar-lg"
                                alt="user1">
                        </div>
                    </div>
                    ';
                } else {
                    return '    
                    <div class="d-flex px-2 py-1">
                        <div>
                            <img src="' . $url . '/public/assets/img/visitors/" class="avatar avatar-lg"
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
            ->rawColumns(['image', 'name_email', 'fathername_occupation', 'domicile', 'cell_no', 'dob_cnic', 'degree_university', 'subject_cgpa', 'action', 'applied_for', 'class_type'])
            ->make(true);
    }
    // showTableData for Index and Trashed

    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            return $this->visitorRepository->index($request);
        }
        return view('visitors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('visitors.create');
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
        return $this->visitorRepository->store($request->all());
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
        return $this->visitorRepository->show($id);
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
            $visitor = Visitor::with('user')->where('id', $id)->first();
            if ($visitor->user->approved_status == 1) {
                return redirect()->back()->with('error', 'User already approved Go check in Visitor detail page');
            }
            if (isset($visitor)) {
                $user_id = $visitor->user_id;
                return view('visitors.edit', compact('visitor', 'id', 'user_id'));
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
        return $this->visitorRepository->destroy($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashed(Request $request)
    {
        //
        if ($request->ajax()) {
            return $this->visitorRepository->trashed($request);
        }
        return view('visitors.trashed');
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
        return $this->visitorRepository->restore($id);
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
        return $this->visitorRepository->permanentDelete($id);
    }
}
