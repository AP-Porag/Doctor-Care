<?php

namespace App\Http\Controllers\Admin\Appointment;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Appointment;
use App\Models\Dew;
use App\Models\DoctorFees;
use App\Models\Free;
use App\Models\Paid;
use App\Models\Patient;
use App\Models\Phone;
use App\Models\Profile;
use App\Models\Status;
use App\Models\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
     * Display the specified doctors appointments.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function appointments($id)
    {
        $appointments = Appointment::where('doctor_id',$id)->whereDate('date', '=', Carbon::today()->toDateString())->orderBy('created_at','DESC')->paginate(10);
        return response(view('admin.appointments.doctor-appointments',compact('appointments')));
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addPatientView()
    {
        $doctors = User::role('doctor')->get();
        $types = Type::all();
        return response(view('admin.appointments.add-patients',compact('doctors','types')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePatient(Request $request)
    {
        $this->validate($request,[

            'name'=>'required|min:3',
            'email'=>'email',
            'phone'=>'required',
            'fees'=>'required'

        ]);

        //data table saving direction && database field name

        //        user table -> email,name,phone //
        //model_has_role table -> user_id && patient role as id in role_id field //
        //        phones table -> contact //
        //        patient table -> user_id,gender,birth_date,blood_group //
        //        appointment table -> doctor as status requested //
        //saving patient fees data in doctorFees table //
        //        address table -> village,sub_district,city,district,division,country//
        //        profile table -> photo//

        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $contact = $request->contact;
        $birth_date = $request->birth_date;
        $blood_group = $request->blood_group;
        $gender = $request->gender;
        $doctor_id = $request->doctor;
        $date = $request->date;
        $status_id = 5;
        $amount = $request->fees;
        $service_id = 1;
        $type_id = $request->payment_type;
        $village = $request->village;
        $sub_district = $request->sub_district;
        $city = $request->city;
        $district= $request->district;
        $division= $request->division;
        $country= $request->country;
        $image = $request->photo;

        //saving users and assign role
        if ($name || $email || $phone){
            $user = User::create([
                'name'=>$name,
                'email'=>$email,
                'phone'=>$phone,
            ]);
            $user->syncRoles('patient');
        }
        //saving contact in phones table

        if ($user){
            if ($contact){
                Phone::create([
                    'user_id'=>$user->id,
                    'phone'=>$request->contact,
                ]);

            }
        }
        //saving patient in patients table
        if ($user){
            Patient::create([
                'user_id'=>$user->id,
                'gender'=>$gender,
                'birth_date'=>$birth_date,
                'blood_group'=>$blood_group,
            ]);
        }
//        //saving patient in Appointments table for appointment
        if ($user){
            if ($doctor_id || $date){
                $appointment = Appointment::create([
                    'user_id'=>$user->id,
                    'name'=>$name,
                    'contact'=>$phone,
                    'doctor_id'=>$doctor_id,
                    'date'=>$date,
                    'status_id'=>$status_id,
                ]);
            }
        }
//        //saving patient fees data in doctorFees table
        if ($user && $appointment){
            if ($service_id || $amount){
                $doctor_fees = DoctorFees::create([
                    'patient_id'=>$user->id,
                    'appointment_id'=>$appointment->id,
                    'doctor_id'=>$doctor_id,
                    'service_id'=>$service_id,
                    'amount'=>$amount,
                    'type_id'=>$type_id,
                ]);
            }
        }
        //        //saving patient fees data in doctorFees table
        if ($user && $amount){
            if ($type_id == 3){
                $dew = Dew::create([
                    'patient_id'=>$user->id,
                    'amount'=>$amount,
                ]);
            }elseif ($type_id == 4){
                $free = Free::create([
                    'patient_id'=>$user->id,
                    'amount'=>$amount,
                ]);
            }else{
                $paid = Paid::create([
                    'patient_id'=>$user->id,
                    'amount'=>$amount,
                ]);
            }
        }
//        //saving patient address data in addresses table
        if ($user){
            $patient_address = Address::create([

                'user_id'=>$user->id,
                'village'=>$village,
                'sub_district'=>$sub_district,
                'city'=>$city,
                'district'=>$district,
                'division'=>$division,
                'country'=>$country,
            ]);
        }
//        //saving patient picture in profile table
        if ($user){
            $patient_picture = Profile::create([
                'user_id'=>$user->id
            ]);
            if ($patient_picture && $image){
                $image_new_name = time() . '.' . $image->getClientOriginalExtension();

                Image::make($request->photo)
                    ->resize(300, 200)
                    ->save(base_path('public/storage/patient/' . $image_new_name));
                $patient_picture->profile_picture = '/storage/patient/' . $image_new_name;
                $patient_picture->save();
            }
        }

        Session::flash('success','Patient Added Successfully !');
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
