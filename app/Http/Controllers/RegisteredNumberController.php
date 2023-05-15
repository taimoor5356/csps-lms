<?php

namespace App\Http\Controllers;

use App\Models\RegisteredBatch;
use App\Models\RegisteredNumber;
use Illuminate\Http\Request;

class RegisteredNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('settings.registration_setting');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $registeredNumber = RegisteredNumber::where('registered_batch_id', $id)->get()->last();
        if (isset($registeredNumber)) {
            dd($registeredNumber->registration_number);
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

    public function fetchBatchNumbers(Request $request)
    {
        $batchNos = RegisteredBatch::where('registered_year_id', $request->year_id)->orderBy('id', 'DESC')->limit(15)->get();
        return response()->json([
            'status' => true,
            'batch_nos' => $batchNos
        ]);
    }

    public function fetchLastRegistrationNumber(Request $request)
    {
        $registrationNumber = RegisteredNumber::where('registered_batch_id', $request->batch_id)->get()->last();
        if (isset($registrationNumber)) {
            $nextNumber = $registrationNumber->registration_number + 1;
        } else {
            $nextNumber = 1;
        }
        $registrationNumberWithZeros = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        return response()->json([
            'status' => true,
            'registration_number' => $registrationNumberWithZeros
        ]);
    }
}
