<?php

namespace App\Http\Controllers\Admin\Lab;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Lab;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labs = Lab::orderBy('created_at','DESC')->paginate(5);
        return response(view('admin.labs.labs',compact('labs')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(view('admin.labs.lab-create'));
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
            'name'=>'required|unique:labs,name|min:3',
            'price'=>'required',
            'commission'=>'required',
            'template'=>'required',
        ]);
        $test = Lab::create([
            'name'=>$request->name,
            'advice'=>$request->advice,
            'price'=>$request->price,
            'commission'=>$request->commission,
            'template'=>$request->template,
        ]);

        if ($test){
            Session::flash('success','Test Added Successfully !');
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

    //Extra Route for this module

    public function makeLabReport()
    {
        $doctors = User::role('doctor')->get();
        $patients = User::role('patient')->get();
        $tests = Lab::all();
        return response(view('admin.labs.make-lab-report',compact('doctors','tests','patients')));

    }
    public function findTemplate(Request $request){

        //return'it will get price if its id match with product id';
        return$p=Lab::where('id',$request->id)->first();

        return response()->json($p);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveLabReport(Request $request)
    {

        $this->validate($request,[
            'patient_name'=>'required',
            'test_name'=>'required',
            'lab_report'=>'required',
        ]);
        $report = Document::create([
            'patient_id'=>$request->patient_name,
            'prepared_by'=>$request->lab_technician_name,
            'verifier_doctor_id'=>$request->verifier_doctor,
            'test_id'=>$request->test_name,
            'lab_report'=>$request->lab_report,
        ]);

        if ($report){
            Session::flash('success','Report Added Successfully !');
        }
        return back();
    }

    public function allLabReports()
    {
        $documents = Document::orderBy('created_at','DESC')->paginate(5);
        return response(view('admin.labs.all-lab-report-view',compact('documents')));
    }
}
