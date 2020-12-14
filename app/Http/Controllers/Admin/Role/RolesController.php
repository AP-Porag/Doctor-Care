<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('created_at','DESC')->paginate(5);
        return response(view('admin.roles.roles',compact('roles')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions_all = Permission::all();
        $permissionsGroup = User::getPermissionGroups();
        return response(view('admin.roles.role-create',compact('permissions_all','permissionsGroup')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request,[
            'name'=>'required|min:3|unique:roles',
            'permissions'=>'required',
        ]);
        //inserting data
        $role = Role::create([
            'name'=>$request->name,
        ]);
        $permission = $request->input('permissions');

        //assign permission
        if (!empty($permission)){
            $role->syncPermissions($permission);
        }

        Session::flash('success','Role Added Successfully !');
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
        $role = Role::findById($id);
        $permissions_all = Permission::all();
        $permissionsGroup = User::getPermissionGroups();
        return response(view('admin.roles.role-edit',compact('role','permissions_all','permissionsGroup')));
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
        //validation
//        $this->validate($request,[
//            'name'=>'required|min:3|unique:roles',
//            //'permissions'=>'required',
//        ]);
        //updating data
        $role = Role::findById($id);
        $role->name = $request->name;
        $role->save();

        $permission = $request->input('permissions');
        //assign permission
        if (!empty($permission)){
            $role->syncPermissions($permission);
        }
        Session::flash('success','Role Updated Successfully !');
        return back();
    }
    public static function softDelete(int $id)
    {
        $role = Role::findOrFail($id)->delete();

        Session::flash('success','Role Inactivated Successfully !');
        return back();
    }
    public static function inactive()
    {
        $trashed_roles = Role::onlyTrashed()->orderBy('created_at', 'DESC')->paginate(5);
        return response()->view('admin.roles.trashed-roles', compact('trashed_roles'));
    }
    public static function restore(int $id)
    {
        Role::onlyTrashed()->findOrFail($id)->restore();

        Session::flash('success','Role Activated Again !');
        return back();
    }
    public static function forceDelete(int $id)
    {
        Role::onlyTrashed()->findOrFail($id)->forceDelete();

        Session::flash('success','Role Deleted Successfully !');
        return back();
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
