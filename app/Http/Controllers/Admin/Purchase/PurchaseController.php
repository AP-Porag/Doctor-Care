<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\PurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        return $request->all();
        $medicine_id = $request->medicine_id;
        $buying_price = $request->price;
        $quantity = $request->quantity;
        $company_id = $request->company_id;


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

    //Extra method start
    public function purchaseRequest($id)
    {
     $medicine = $id;
        $purchase_requests = PurchaseRequest::find($id);

        if ($purchase_requests != null){
            Session::flash('success','! Purchase Request Made All-ready !');
            return back();
        }else{
            $purchase_request_new = PurchaseRequest::create([
                'medicine_id'=>$medicine,
            ]);

            if ($purchase_request_new){
                Session::flash('success','Item Added For Purchase Request Successfully');
            }
            return back();
        }



    }
    public function purchaseRequestView()
    {
        $medicines = PurchaseRequest::with('medicine')->orderBy('created_at','DESC')->paginate(10);
        return response(view('admin.pharmacy.purchase-request',compact('medicines')));
    }
    public function createView(Request $request)
    {

        $request_medicines = $request->medicines;
        $medicines = Medicine::whereIn('id', $request_medicines)->get();

        return response(view('admin.pharmacy.purchase-order',compact('medicines')));
    }

    public function purchaseRequestForceDelete($id)
    {
        $delete_pr = PurchaseRequest::findOrFail($id)->forceDelete();

        if ($delete_pr){
            Session::flash('success','Purchase Request Deleted Successfully !');
        }
        return back();
    }

}
