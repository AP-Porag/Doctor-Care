@extends('layouts.admin')

@section('module')
    Permission
@endsection

@section('before-path')
    Dashboard
@endsection

@section('title')
    Permission-List
@endsection

@section('breadcumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active text-capitalize" aria-current="page">@yield('title')</li>
        </ol>
    </nav>
@endsection

@section('style')
    <style>

    </style>
@endsection

@section('content')

{{--    trashed Permission--}}

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-danger">In-Active @yield('module')</h6>
            <div class="d-flex justify-content-between">
                <a href="{{route('permission.create')}}" class="btn btn-sm btn-outline-primary text-capitalize mr-3"><i class="fa fa-plus-circle"></i> Add new @yield('module')</a>
                <a href="{{route('permission.index')}}" class="btn btn-sm btn-outline-success text-capitalize"><i class="fa fa-handshake mr-1"></i>Active @yield('module')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="dataTable_length"><label>Show <select>
                                        name="dataTable_length" aria-controls="dataTable"
                                        class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> entries</label></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search"
                                                                                                      class="form-control form-control-sm"
                                                                                                      placeholder=""
                                                                                                      aria-controls="dataTable"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable table-striped table-hover" id="dataTable" width="100%" cellspacing="0"
                                   role="grid" aria-describedby="dataTable_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc text-center" tabindex="0" aria-controls="dataTable" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending">Sl
                                    </th>
                                    <th class="sorting text-center text-capitalize" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Position: activate to sort column ascending">
                                        Permissions group
                                    </th>
                                    <th class="sorting_asc text-center text-capitalize" tabindex="0" aria-controls="dataTable" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending">Name
                                    </th>
                                    <th class="sorting text-center text-capitalize" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Office: activate to sort column ascending">
                                        Role Count
                                    </th>
                                    <th class="sorting text-center text-capitalize" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Office: activate to sort column ascending">
                                        user's permission via Role Count
                                    </th>
                                    <th class="sorting text-center text-capitalize" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Office: activate to sort column ascending">
                                        user's direct permission Count
                                    </th>
                                    <th rowspan="1" colspan="1" class="text-center">Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($trashed_permissions as $key=>$permission)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1 text-center">{{$loop->index+1}}</td>
                                        <td>
                                            {{$permission->group_id}}
                                        </td>
                                        <td class="sorting_1 text-capitalize">{{$permission->name}}</td>
                                        <td>
                                            {{$permission->roles->count()}}
                                        </td>
                                        <td>
                                            {{$permission->users()->count()}}
                                        </td>
                                        <td>
                                            {{$permission->users()->count()}}
                                        </td>
                                        <td>
                                            <div class="btn-group d-flex justify-content-center">
                                                <a href="{{route('restore_permission',$permission->id)}}" class="btn btn-sm btn-outline-success mr-3"><i class="fab fa-creative-commons-share"></i></a>
                                                <a href="{{route('forceDelete_permission',$permission->id)}}" class="btn btn-sm btn-outline-danger mr-3"><i class="fas fa-window-close"></i></a>
{{--                                                <form action="{{route('Permission_hard_delete',$permission->id)}}" method="get">--}}
{{--                                                    @csrf--}}
{{--                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-window-close"></i></button>--}}
{{--                                                </form>--}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 51
                                to 57 of 57 entries
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            {{$trashed_permissions->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
