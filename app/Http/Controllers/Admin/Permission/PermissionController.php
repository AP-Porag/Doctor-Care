<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderBy('created_at','ASC')->paginate(5);
        return response(view('admin.permissions.permissions',compact('permissions')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all();
        return response(view('admin.permissions.permission-create',compact('groups')));
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
            'name'=>'required|min:3|unique:permissions,name',
            'permission_group'=>'required'
        ]);

        $permission = Permission::create([
            'name'=>$request->name,
            'group_id'=>$request->permission_group
        ]);

        if ($permission){
            Session::flash('success','Permission Added Successfully !');
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
        $permission = Permission::findById($id);
        $groups = Group::all();
        return response(view('admin.permissions.permission-edit',compact('permission','groups')));
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
        $this->validate($request,[
            'name'=>'required|min:3',
            'permission_group'=>'required'
        ]);

        $permission = Permission::findById($id);
        $permission->name = $request->name;
        $permission->group_id = $request->permission_group;
        $permission->save();

        if ($permission){
            Session::flash('success','Permission Updated Successfully !');
        }
        return back();
    }

    //extra operations start here
    public static function softDelete(int $id)
    {
        $permission = Permission::findOrFail($id)->delete();

        Session::flash('success','Permission Inactivated Successfully !');
        return back();
    }
    public static function inactive()
    {
        $trashed_permissions = Permission::onlyTrashed()->orderBy('created_at', 'DESC')->paginate(5);
        return response()->view('admin.permissions.trashed-permissions', compact('trashed_permissions'));
    }
    public static function restore(int $id)
    {
        Permission::onlyTrashed()->findOrFail($id)->restore();

        Session::flash('success','Permission Activated Again !');
        return back();
    }
    public static function forceDelete(int $id)
    {
        Permission::onlyTrashed()->findOrFail($id)->forceDelete();

        Session::flash('success','Permission Deleted Successfully !');
        return back();
    }

    //extra operations end here

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
    public function store_group(Request $request)
    {

        //data validation
        $this->validate($request,[
            'group'=>'required|min:3|unique:groups,name'
        ]);

        //save request data
        $group = Group::create([
            'name'=>$request->group,
        ]);

        //sending success massage to session
        if ($group){
            Session::flash('success','Group Added Successfully !');
        }

        return back();
    }
}
