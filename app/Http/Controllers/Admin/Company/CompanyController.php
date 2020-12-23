<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('created_at', 'DESC')->paginate(5);
        return response()->view('admin.company.companies', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('admin.company.company-create');
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
            'name' => 'required|unique:companies,name|min:3',
            'phone' => 'required|unique:companies,phone|min:10'
        ]);
        $company = Company::create([
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
            $company->logo = '/storage/logos/' . $image_new_name;
            $company->update();
        }

        Session::flash('success','Company Added Successfully !');
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
        $company = Company::findOrFail($id)->get();
        return response()->view('admin.company.company-show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id)->get();
        return response()->view('admin.company.company-edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //validation

        $this->validate($request, [
            'name' => 'required|min:3',
            'phone' => 'required|min:10',
            'sr_name' => 'required|min:3'
        ]);

        //updating information

        $company->name = $request->name;
        $company->slug = str::slug($request->name, '-');
        $company->sr_name = $request->sr_name;
        $company->phone = $request->phone;
        $company->save();

        //updating logo
        if ($request->has('logo')) {

            $image = $request->logo;
            $image_new_name = time() . '.' . $image->getClientOriginalExtension();

            Image::make($request->logo)
                ->resize(300, 200)
                ->save(base_path('public/storage/logos/' . $image_new_name));
            $company->logo = '/storage/logos/' . $image_new_name;
            $company->save();
        }

        Session::flash('success','Company Updated Successfully !');

        return redirect(route('company.index'));
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

    //trashed companies
    public function inactive()
    {
        $trashed_companies = Company::onlyTrashed()->orderBy('created_at', 'DESC')->paginate(5);
        return response()->view('admin.company.trashed-companies', compact('trashed_companies'));
    }

    public function restore($id)
    {
        Company::onlyTrashed()->findOrFail($id)->restore();

        Session::flash('success','Company Activated Again !');
        return back();
    }

    //soft delete
    public function softDelete($id)
    {
        $companyF = Company::findOrFail($id)->delete();

        Session::flash('success','Company Inactivated Successfully !');
        return back();
    }

    //hard delete
    public function forceDelete($id)
    {
        Company::onlyTrashed()->findOrFail($id)->forceDelete();

        Session::flash('success','Company Deleted Successfully !');
        return back();
    }
}
