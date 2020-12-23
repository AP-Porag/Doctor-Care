<?php

namespace App\Http\Controllers\Admin\Medicine;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Generic;
use App\Models\Medicine;
use App\Models\Unit;
use Carbon\Traits\Units;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicines = Medicine::orderBy('created_at','DESC')->paginate(10);
        return response(view('admin.medicine.medicines',compact('medicines')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $generics = Generic::all();
        $companies = Company::all();
        $categories = Category::all();
        $units = Unit::all();
        return response(view('admin.medicine.medicine-create',compact('generics','companies','categories','units')));
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
//        {
//            "_token": "n9G9jl00bkVOOD9oOXjzTSc23uiQz1WKBOuFIV32",
//"name": "Abbot Lynn",
//"generic_name": "6",
//"company": "7",
//"category": "4",
//"unit": "1",
//"price": "1000"
//}

        $this->validate($request,[
            'name'=>'required|unique:medicines,name|min:3',
            'generic_name'=>'required',
            'company'=>'required',
            'category'=>'required',
            'unit'=>'required',
            'price'=>'required',
        ]);

        $medicine = Medicine::create([
            'name'=>$request->name,
            'generic_id'=>$request->generic_name,
            'company_id'=>$request->company,
            'category_id'=>$request->category,
            'unit_id'=>$request->unit,
            'price'=>$request->price,
        ]);

        if ($medicine){
            Session::flash('success','Medicine Added Successfully !');
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

    //group CRUD

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_generic(Request $request)
    {

        //data validation
        $this->validate($request,[
            'generic'=>'required'
        ]);

        //save request data
        $generic = Generic::create([
            'name'=>$request->generic,
        ]);

        //sending success massage to session
        if ($generic){
            Session::flash('success','Medicin Generic Name Added Successfully !');
        }

        return back();
    }
}
