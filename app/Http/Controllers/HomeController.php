<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //    public function index()
    //    {
    //        return view('home');
    //    }
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('patient')) {

            $appointments = Appointment::where('user_id',$user->id)->get();
            return view('frontend.my-account',compact('appointments','user'));
            //return view('layouts.app');
        } else {
            return view('admin.index');
        }
        //return view('admin.index');
    }
}
