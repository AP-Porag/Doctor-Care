<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\Models\Doctor;
use App\Models\Education;
use App\Models\Speciality;
use Illuminate\Support\Facades\Session;
use Image;
use App\User;
use App\Models\Phone;
use App\Models\Profile;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = User::role('doctor')->orderBy('created_at', 'DESC')->paginate(5);
        return response()->view('admin.doctors.doctors', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('admin.doctors.doctor-create');
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
            'email'=>'email',
            'phone'=>'required',
            'fees'=>'required',

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
        $joining_date = $request->joining_date;
        $blood_group = $request->blood_group;
        $gender = $request->gender;
        $allocated_room = $request->room;
        $fees = $request->fees;
        $speciality = $request->speciality;
        $degree = $request->degree;
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
            $user->syncRoles('doctor');
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
        //saving doctors in doctor table
        if ($user){
            Doctor::create([
                'user_id'=>$user->id,
            'blood_group'=>$blood_group,
                'gender'=>$gender,
            'allocated_room'=>$allocated_room,
            'fees'=>$fees,
                'joining_date'=>$joining_date,

            ]);
        }
//        //saving education in Appointments table for appointment
        if ($user){
            $education = Education::create([
                'user_id'=>$user->id,
                'degree'=>$degree,
            ]);
        }
//        //saving speciality fees data in doctorFees table
        if ($user){
            $speciality = Speciality::create([
                'user_id'=>$user->id,
                'speciality'=>$speciality,
            ]);
        }

//        //saving patient address data in addresses table
        if ($user){
            $doctor_address = Address::create([
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

        Session::flash('success','Doctor Added Successfully !');
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
    public function edit(User $doctor)
    {
        return response()->view('admin.doctors.doctors-edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id)->first();
        if ($request->has('name')) {
            $user->name = $request->name;
            $user->save();
        }


        if ($request->has('phone')) {
            $user->phone = $request->phone;
            $user->save();
        }
        if ($request->has('address')) {
            $address = Address::where('user_id', $id)->first();
            $address->address = $request->address;
            $address->save();
        }
//        if ($request->has('phone')) {
//            $user->phone = $request->phone;
//            $user->save();
//        }
//        if ($request->has('address')) {
//            $address = Address::where('user_id', $doctor)->get();
//            $address->city = $request->address;
//            $address->update();
//        }


        //updating logo
        if ($request->has('profile_picture')) {
            $profile = Profile::where('user_id', $id)->first();
            $image = $request->profile_picture;
            $image_new_name = time() . '.' . $image->getClientOriginalExtension();

            Image::make($request->profile_picture)
                ->resize(300, 200)
                ->save(base_path('public/storage/profile_picture/' . $image_new_name));
            $profile->profile_picture = '/storage/profile_picture/' . $image_new_name;
            $profile->save();
        }

        Session::flash('success','Doctor Updated Successfully !');
        return redirect(route('doctor.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //soft delete
    public function softDelete($id)
    {
        $supplier = User::findOrFail($id)->delete();
        $profile_picture = Profile::where('user_id', $id)->delete();
        $address = Address::where('user_id', $id)->delete();

        Session::flash('success','Doctor Inactivated Successfully !');
        return back();
    }

    //show trashed data
    public function inactive()
    {
        $trashed_doctors = User::onlyTrashed()->orderBy('created_at', 'DESC')->paginate(5);
        return response()->view('admin.doctors.trashed-doctors', compact('trashed_doctors'));
    }

    //restore soft deleted data
    public function restore($id)
    {
        User::onlyTrashed()->findOrFail($id)->restore();

        Session::flash('success','Doctor Active Again !');
        return back();
    }
    //force deleted data of
    public function forceDelete($id)
    {
        User::onlyTrashed()->findOrFail($id)->forceDelete();

        Session::flash('success','Doctor Deleted Successfully !');
        return back();
    }



    public function destroy($id)
    {
        //
    }
}
