<?php

namespace App\Http\Controllers\Admin\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Suppliers::orderBy('created_at', 'DESC')->paginate(5);
        return response()->view('admin.suppliers.suppliers', compact('suppliers'));
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
        $this->validate($request, [
            'name' => 'required|unique:suppliers,name|min:3',
            'phone' => 'required|unique:suppliers,phone|min:10'
        ]);
        $supplier = Suppliers::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'sr_name' => $request->sr_name,
            'phone' => $request->phone,
            'logo' => '/storage/no-image/nologo.png',
        ]);

        //Insert logo
        if ($request->has('logo')) {

            $image = $request->logo;
            $image_new_name = time() . '.' . $image->getClientOriginalExtension();

            Image::make($request->logo)
                ->resize(300, 200)
                ->save(base_path('public/storage/logos/' . $image_new_name));
            $supplier->logo = '/storage/logos/' . $image_new_name;
            $supplier->update();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suppliers  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Suppliers $supplier)
    {
        return response()->view('admin.suppliers.suppliers-show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suppliers  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Suppliers $supplier)
    {
        return response()->view('admin.suppliers.suppliers-edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suppliers  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suppliers $supplier)
    {
        //validation

        $this->validate($request, [
            'name' => 'required|min:3',
            'phone' => 'required|min:10',
            'sr_name' => 'required|min:3'
        ]);

        //updating information

        $supplier->name = $request->name;
        $supplier->slug = str::slug($request->name, '-');
        $supplier->sr_name = $request->sr_name;
        $supplier->phone = $request->phone;
        $supplier->save();

        //updating logo
        if ($request->has('logo')) {

            $image = $request->logo;
            $image_new_name = time() . '.' . $image->getClientOriginalExtension();

            Image::make($request->logo)
                ->resize(300, 200)
                ->save(base_path('public/storage/logos/' . $image_new_name));
            $supplier->logo = '/storage/logos/' . $image_new_name;
            $supplier->save();
        }
        return redirect(route('supplier.index'));
    }

    //trashed suppliers
    public function inactive()
    {
        $trashed_suppliers = Suppliers::onlyTrashed()->orderBy('created_at', 'DESC')->paginate(5);
        return response()->view('admin.suppliers.trashed-suppliers', compact('trashed_suppliers'));
    }

    public function restore($id)
    {
        Suppliers::onlyTrashed()->findOrFail($id)->restore();
        return back();
    }

    //soft delete
    public function softDelete($id)
    {
        $supplier = Suppliers::findOrFail($id)->delete();
        return back();
    }

    //hard delete
    public function forceDelete($id)
    {
        Suppliers::onlyTrashed()->findOrFail($id)->forceDelete();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suppliers  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suppliers  $supplier)
    {
    }
}
