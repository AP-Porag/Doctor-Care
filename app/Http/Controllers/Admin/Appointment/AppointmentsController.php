<?php

namespace App\Http\Controllers\Admin\Appointment;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Status;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::orderBy('created_at','DESC')->paginate(10);
        return response(view('admin.appointments.appointments',compact('appointments')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = User::role('doctor')->get();
        return response(view('admin.appointments.appointment-create',compact('doctors')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'name'=>'required|min:3',
            'phone'=>'required',
            'doctor'=>'required',
            'appointment_date'=>'required',
        ]);

        $appointment = Appointment::create([
            'name'=>$request->name,
            'contact'=>$request->phone,
            'doctor_id'=>$request->doctor,
            'date'=>$request->appointment_date,
        ]);

        $remarks = $request->remarks;
        if ($remarks){
            $appointment->remarks = $remarks;
            $appointment->save();
        }

        if ($appointment){
            Session::flash('success','Appointment Added Successfully !');
        }
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
        $appointment = Appointment::findOrFail($id);

        $doctors = User::role('doctor')->get();
        return response(view('admin.appointments.appointment-edit',compact('appointment','doctors')));
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
        $this->validate($request,[
            'name'=>'required|min:3',
            'phone'=>'required',
            'doctor'=>'required',
            'appointment_date'=>'required',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->name = $request->name;
        $appointment->contact = $request->phone;
        $appointment->doctor_id = $request->doctor;
        $appointment->date = $request->appointment_date;
        $appointment->save();


        $remarks = $request->remarks;
        if ($remarks){
            $appointment->remarks = $remarks;
            $appointment->save();
        }

        if ($appointment){
            Session::flash('success','Appointment Updated Successfully !');
        }
        return back();
    }

    //extra operations start here
    public static function softDelete(int $id)
    {
        $appointment = Appointment::findOrFail($id)->delete();

        Session::flash('success','Appointment Inactivated Successfully !');
        return back();
    }
    public static function inactive()
    {
        $trashed_appointments = Appointment::onlyTrashed()->orderBy('created_at', 'DESC')->paginate(5);
        return response()->view('admin.appointments.trashed-appointments', compact('trashed_appointments'));
    }
    public static function restore(int $id)
    {
        Appointment::onlyTrashed()->findOrFail($id)->restore();

        Session::flash('success','Appointment Activated Again !');
        return back();
    }
    public static function forceDelete(int $id)
    {
        Appointment::onlyTrashed()->findOrFail($id)->forceDelete();

        Session::flash('success','Appointment Deleted Successfully !');
        return back();
    }

    public function confirmation(int $id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment){
            $appointment->status_id = 2;
            $appointment->save();
        }

        Session::flash('success','Appointment Confirmed !');
        return back();
    }

    public function paymentView(int $id)
    {

    }
    //extra operations end here
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
