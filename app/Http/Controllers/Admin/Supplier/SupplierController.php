<?php

namespace App\Http\Controllers\Admin\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Suppliers::orderBy('created_at','DESC')->paginate(5);
        return response()->view('admin.suppliers.suppliers',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('admin.suppliers.suppliers-create');
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
            'name'=>'required|unique:suppliers,name|min:3',
            'phone'=>'required|unique:suppliers,phone|min:10'
        ]);
        $supplier = Suppliers::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'sr_name' => $request->sr_name,
            'phone' => $request->phone,
            'logo' => '/storage/no-images/nologo.png',
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suppliers  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Suppliers $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suppliers  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Suppliers $supplier)
    {
        return response()->view('admin.suppliers.suppliers-edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suppliers  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Suppliers $supplier)
    {
        //validation

        $this->validate($request,[
            'name'=>'required|min:3',
            'phone'=>'required|min:10',
            'sr_name'=>'required|min:3'
        ]);

        //updating information

        $supplier -> name = $request->name;
        $supplier -> slug = str::slug($request->name,'-');
        $supplier -> sr_name = $request->sr_name;
        $supplier -> phone = $request->phone;
        $supplier -> save();

        //updating logo
        if ($request->has('logo')) {

            $image = $request->logo;
            $image_new_name = time().'.'.$image->getClientOriginalExtension();

            $supplier->logo = Image::make('public/foo.jpg')
                ->resize(300, 200)
                ->save('/storage/logos/'.$image_new_name);
            //Image::make($image)->save('/storage/logos/'.$image_new_name);


//            $image->move('storage/item/logos/',$image_new_name);
//            $supplier->thumbnail = '/storage/logos/'.$image_new_name;
//            $supplier->save();

            //$supplier->logo = '/storage/logos/nologo.png';
            //$supplier->save();
        }
        return redirect(route('supplier.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suppliers  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suppliers $supplier)
    {
        //
    }
}