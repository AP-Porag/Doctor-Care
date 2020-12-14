@extends('layouts.admin')

@section('module')
    Role
@endsection

@section('before-path')
    Role-List
@endsection

@section('title')
    Update Role
@endsection

@section('breadcumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item text-capitalize"><a href="{{route('role.index')}}">@yield('before-path')</a></li>
            <li class="breadcrumb-item active text-capitalize" aria-current="page">@yield('title')</li>
        </ol>
    </nav>
@endsection
@section('style')
    <style>

    </style>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-end">
            <a href="{{route('role.index')}}" class="btn btn-sm btn-outline-primary"><i
                    class="fa fa-list"></i>@yield('before-path')</a>
        </div>
        <div class="card-body">
            <div class="form">
                <form action="{{route('role.update',$role->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="text-capitalize">Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                       placeholder="Enter Role name" value="{{ $role->name,old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    <strong>Warning! </strong>
                                    <p>{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="d-flex">
                                    <label for="permissions" class="text-capitalize">Permissions</label>
                                    <div class="form-check ml-5">
                                        <input type="checkbox" class="form-check-input" id="permissionAll" value="" {{\App\User::roleHasPermissions($role,$permissions_all) ? 'checked' : ''}}>
                                        <label for="permissionAll" class="text-capitalize form-check-label">All</label>
                                    </div>
                                </div>
                                <div class="card p-3" id="permissions">
                                    @foreach($permissionsGroup as $group)
                                        @php
                                            $permissions = \Spatie\Permission\Models\Permission::where('group_id',$group->group_id)->get();
                                        @endphp
                                        <div class="form-row border-bottom">
                                            <div class="col-md-4">
                                                <div class="form-check ml-5">
                                                    <input type="checkbox" class="form-check-input"
                                                           id="permissiongroup{{$group->group_id}}"
                                                           value="{{$group->group_id}}"
                                                           onclick="checkPermissionByGroup('permission{{$group->group_id}}',this)" {{\App\User::roleHasPermissions($role,$permissions_all) ? 'checked' : ''}}>
                                                    <label for="permission{{$group->group_id}}"
                                                           class="text-capitalize form-check-label">{{$group->group_id}}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-8 permission{{$group->group_id}}">
                                                @foreach($permissions as $permission)
                                                    <div class="form-check">
                                                        <input type="checkbox" name="permissions[]"
                                                               {{$role->hasPermissionTo($permission->name) ? 'checked' : ''}}
                                                               class="form-check-input"
                                                               id="permission-{{$permission->id}}"
                                                               value="{{$permission->id,old('permissions[]')}}"
                                                        onclick="checkSinglePermission('permission{{$group->group_id}}','permissiongroup{{$group->group_id}}','{{count($permissions)}}')">
                                                        <label for="permission-{{$permission->id}}"
                                                               class="text-capitalize form-check-label">{{$permission->name}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('permissions')
                                <div class="invalid-feedback">
                                    <strong>Warning! </strong>
                                    <p>{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update @yield('module')</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#permissionAll').click(function () {
            if ($(this).is(':checked')) {
                //Checked all the permission checkbox
                $('input[type=checkbox]').prop('checked', true)
            } else {
                //Un-Checked all the permission checkbox
                $('input[type=checkbox]').prop('checked', false)
            }
        });

        function checkPermissionByGroup(className, checkThis) {

            const groupIDName = $("#" + checkThis.id);
            const classCheckbox = $('.' + className + ' input');

            if (groupIDName.is(':checked')) {
                //Checked all the permission checkbox
                classCheckbox.prop('checked', true)
            } else {
                //Un-Checked all the permission checkbox
                classCheckbox.prop('checked', false)
            }
            allChecked();

        }
        function checkSinglePermission(groupClassName,groupID,countTotalPermission){

            const classCheckBox = $('.'+groupClassName+' input');
            const groupIDCheckBox = $('#'+groupID);

            if ($('.'+groupClassName+' input:checked').length == countTotalPermission){
                groupIDCheckBox.prop('checked',true);
            }else {
                groupIDCheckBox.prop('checked',false);
            }
            allChecked();
        }
        function allChecked(){
            const countPermissions = {{count($permissions_all)}};
            const countPermissionGroups = {{count($permissionsGroup)}};
            const checkedCheckbox = $('input[type="checkbox"]:checked').length;

            //console.log(checkedCheckbox);
            //console.log(countPermissions);
            //console.log(countPermissions + countPermissionGroups);

            if (checkedCheckbox >= countPermissions + countPermissionGroups){
                $('#permissionAll').prop('checked',true);
            }else {
                $('#permissionAll').prop('checked',false);
            }
        }
    </script>
@endsection
