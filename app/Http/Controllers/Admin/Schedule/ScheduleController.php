<?php

namespace App\Http\Controllers\Admin\Schedule;

use App\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::paginate(5);
        return view('admin.schedules.schedule', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = User::role('doctor')->get();
        return view('admin.schedules.schedule-create', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required',
            'weekday' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $schedule = Schedule::create([
            'doctor_id' => $request->doctor_id,
            'weekday' => $request->weekday,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
        Session::flash('success', 'Schedule Created Successfully !');
        return back();
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

    //Soft Delete Schedule
    public function softDelete($id)
    {
        $schedules = Schedule::where('id', $id)->delete();
        Session::flash('success', 'Schedule Inactivated Successfully !');
        return back();
    }

    //Show Trashed Data
    public function inactive()
    {
        $trashed_schedules = Schedule::onlyTrashed()->orderBy('created_at', 'DESC')->paginate(5);
        return response()->view('admin.schedules.trashed-schedules', compact('trashed_schedules'));
    }

    //Restore Schedule
    public function restore($id)
    {
        Schedule::onlyTrashed()->findOrFail($id)->restore();
        Session::flash('success', 'Schedule Active Again !');
        return back();
    }

    //Force Delete Schedule
    public function forceDelete($id)
    {
        Schedule::onlyTrashed()->findOrFail($id)->forceDelete();
        Session::flash('success', 'Schedule Deleted Successfully !');
        return back();
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
