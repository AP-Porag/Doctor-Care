@extends('layouts.admin')

@section('module')
    Patient
@endsection

@section('before-path')
    Dashboard
@endsection

@section('title')
    Patient-List
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
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
            <div class="d-flex justify-content-between">
                <a href="{{route('patient.create')}}" class="btn btn-sm btn-outline-primary text-capitalize mr-3"><i class="fa fa-plus-circle"></i> Add new @yield('module')</a>
                <a href="{{route('inactive')}}" class="btn btn-sm btn-outline-danger text-capitalize"><i class="fa fa-ban"></i> In-Active @yield('module')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="dataTable_length"><label>Show <select
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
                                    <th class="sorting_asc text-center" tabindex="0" aria-controls="dataTable" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending">Patient ID
                                    </th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Position: activate to sort column ascending">
                                        Name
                                    </th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Office: activate to sort column ascending">
                                        Phone
                                    </th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Age: activate to sort column ascending">Dew Balance
                                    </th>
                                    <th rowspan="1" colspan="1" class="text-center">Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($patients as $key=>$patient)
                                <tr role="row" class="odd">
                                    <td class="sorting_1 text-center">{{$patients->firstItem() + $key}}</td>
                                    <td class="sorting_1 text-center">{{$patient->id}}</td>
                                    <td class="sorting_1 text-center">{{$patient->name}}</td>
                                    <td class="sorting_1 text-center">{{$patient->phone}}</td>
                                    <td class="sorting_1 text-center">
                                        @php
                                        $amount = 0;
                                        @endphp
                                        @foreach($patient->dews as $dew)
                                            @php
                                            $dew = $dew->amount;
                                            $amount =+ $dew;
                                            @endphp
                                        @endforeach
                                        {{$amount}}
                                    </td>
                                    <td>
                                        <div class="btn-group d-flex justify-content-center">
                                            <a href="{{route('patient.show',$patient->id)}}" class="btn btn-sm btn-outline-info mr-3"><i class="fa fa-eye"></i></a>
                                            <a href="{{route('patient.edit',$patient->id)}}" class="btn btn-sm btn-outline-warning mr-3"><i class="fa fa-edit"></i></a>
                                            <a href="{{route('patient_soft_delete',$patient->id)}}" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>
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
                            {{$patients->links()}}
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
