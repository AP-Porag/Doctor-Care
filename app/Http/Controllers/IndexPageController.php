<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class IndexPageController extends Controller
{
    public function index()
    {
        $doctors = User::role('doctor')->orderBy('created_at', 'DESC')->get();
        return view('frontend.index',compact('doctors'));
    }

    //taking appointment from website
    public function takingAppointment(Request $request)
    {
        $role = '5';
        $this->validate($request,[
            'name'=>'required|min:3',
            'phone'=>'required',
            'email'=>'required',
            'doctor'=>'required',
            'date'=>'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();


        if ($user){

            $user->assignRole($role);

            $appointment = Appointment::create([
                'name'=>$request->name,
                'contact'=>$request->phone,
                'doctor_id'=>$request->doctor,
                'date'=>$request->date,
                'user_id'=>$user->id,
            ]);

            $remarks = $request->remark;
            if ($remarks){
                $appointment->remarks = $remarks;
                $appointment->save();
            }
        }
        if ($appointment){
            Session::flash('success','Appointment Added Successfully !');
        }
        return back();
    }
}
