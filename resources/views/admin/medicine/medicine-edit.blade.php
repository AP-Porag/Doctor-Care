@extends('layouts.admin')

@section('module')
    Permission
@endsection

@section('before-path')
    Permission-List
@endsection

@section('title')
    Update Permission
@endsection

@section('breadcumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item text-capitalize"><a
                    href="{{route('permission.index')}}">@yield('before-path')</a></li>
            <li class="breadcrumb-item active text-capitalize" aria-current="page">@yield('title')</li>
        </ol>
    </nav>
@endsection
@section('style')
    <style>

    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">{{--Add new permission --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-end">
                    <a href="{{route('permission.index')}}" class="btn btn-sm btn-outline-primary"><i
                            class="fa fa-list"></i>@yield('before-path')</a>
                </div>
                <div class="card-body">
                    <div class="form">
                        <form action="{{route('permission.update',$permission->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="text-capitalize">Name</label>
                                        <input type="text" name="name"
                                               class="form-control @error('name') is-invalid @enderror" id="name"
                                               placeholder="Enter Permission name" value="{{ $permission->name,old('name') }}">
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
                                        <label for="permission_group" class="text-capitalize">Permission Group</label>
                                        <select class="custom-select mr-sm-2 @error('permission_group') is-invalid @enderror" id="permission_group" name="permission_group">
                                            <option selected disabled>--Select permission group--</option>
                                            @foreach($groups as $group)
                                                <option value="{{$group->id,old('permission_group')}}"
                                                        @if ($permission->group_id == $group->id) selected @endif>
                                                {{$group->name}}

                                            @endforeach
                                        </select>
                                        @error('permission_group')
                                        <div class="invalid-feedback">
                                            <strong>Warning! </strong>{{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save @yield('module')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6"> {{--Add new permission group and list table --}}
            <div class="row">
                <div class="col-md-8">{{--permission group list table --}}
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h4 class="text-capitalize text-primary">Permission Groups</h4>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Group Name</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($groups as $key=>$group)
                                    <tr>
                                        <th scope="row">{{$loop->index+1}}</th>
                                        <td class="text-capitalize">{{$group->name}}</td>
                                        <td>-----</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-end">
                            <h6 class="text-primary text-capitalize">Add new permission Group</h6>
                        </div>
                        <div class="card-body">
                            <div class="form">
                                <form action="{{route('store_group')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="group" class="text-capitalize">Group Name</label>
                                        <input type="text" name="group"
                                               class="form-control @error('group') is-invalid @enderror"
                                               id="group"
                                               placeholder="Enter group name" value="{{ old('group') }}">
                                        @error('group')
                                        <div class="invalid-feedback">
                                            <strong>Warning! </strong>
                                            <p>{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary text-capitalize">Save group
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>{{--Add new permission group --}}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
