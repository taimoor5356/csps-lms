<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
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
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }

    public function seminarDates(Request $request)
    {
        $seminarSettings = Setting::first();
        return view('settings.seminar_dates', compact('seminarSettings'));
    }

    public function updateSettings(Request $request)
    {
        $setting = Setting::where('id', 1)->first();
        if (isset($setting)) {
        } else {
            $setting = new Setting();
        }
        $setting->type =  '';
        $setting->online_description =  $request->online_description;
        $setting->oncampus_description =  $request->oncampus_description;
        $setting->online_date_time =  $request->online_date_time;
        $setting->oncampus_date_time =  $request->oncampus_date_time;
        $setting->save();
        return redirect()->back()->with('success', 'Updated Successfully');
    }
}
