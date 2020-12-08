<?php

namespace App\Http\Controllers\Admin\Doctor;

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
        // $suppliers = Doctor::orderBy('created_at', 'DESC')->paginate(5);
        $doctors = User::orderBy('created_at', 'DESC')->paginate(5);
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
        // $this->validate($request, [
        //     'name' => 'required|unique:suppliers,name|min:3',
        //     'phone' => 'required|unique:suppliers,phone|min:10'
        // ]);

        //Insert logo
        // if ($request->has('logo')) {

        //     $image = $request->logo;
        //     $image_new_name = time() . '.' . $image->getClientOriginalExtension();

        //     Image::make($request->logo)
        //         ->resize(300, 200)
        //         ->save(base_path('public/storage/logos/' . $image_new_name));
        //     $supplier->logo = '/storage/logos/' . $image_new_name;
        //     $supplier->update();
        // }
        // return back();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email' => $request->phone,
            'password' => bcrypt($request->password),

        ]);
        $last_id = $user->id;
        $profile_pictue = Profile::create([
            'user_id' => $last_id,
            'profile_picture' => '/storage/profile_picture/no_profile.png',
        ]);
        $address = Address::create([
            'user_id' => $last_id,
            'address' => $request->address,
        ]);

        //Insert Profile Picture
        if ($request->hasFile('profile_picture')) {

            $image = $request->profile_picture;
            $image_new_name = time() . '.' . $image->getClientOriginalExtension();

            Image::make($request->profile_picture)
                ->resize(300, 200)
                ->save(base_path('public/storage/profile_picture/' . $image_new_name));
            $profile_pictue->profile_picture = '/storage/profile_picture/' . $image_new_name;
            $profile_pictue->update();
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
    public function edit(User $doctor)
    {
        return response()->view('admin.doctors.doctors-edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $doctor =  $request->id;
        if ($request->has('name')) {
            $user->name = $request->name;
            $user->save();
        }
        if ($request->has('phone')) {
            $user->phone = $request->phone;
            $doctor->save();
        }
        if ($request->has('address')) {
            $address = Address::where('user_id', $doctor)->get();
            $address->address = $request->address;
            $address->save();
        }

        //updating logo
        if ($request->has('profile_picture')) {
            $profile = Profile::where('user_id', $doctor)->first();
            $image = $request->profile_picture;
            $image_new_name = time() . '.' . $image->getClientOriginalExtension();

            Image::make($request->profile_picture)
                ->resize(300, 200)
                ->save(base_path('public/storage/profile_picture/' . $image_new_name));
            $profile->profile_picture = '/storage/profile_picture/' . $image_new_name;
            $profile->save();
        }
        return redirect(route('doctor.index'));
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
