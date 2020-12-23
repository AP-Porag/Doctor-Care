@extends('layouts.admin')

@section('module')
    Lab
@endsection

@section('before-path')
    Lab-List
@endsection

@section('title')
    Make New Report
@endsection

@section('breadcumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item text-capitalize"><a href="{{route('lab.index')}}">@yield('before-path')</a></li>
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
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-end">
                    <a href="{{route('allLabReports')}}" class="btn btn-sm btn-outline-primary"><i
                            class="fa fa-list"></i>All Report</a>
                </div>
                <div class="card-body">
                    <div class="form">
                        <form action="{{route('saveLabReport')}}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="patient_name" class="text-capitalize">Patient Name</label>
                                        <select class="custom-select mr-sm-2 @error('patient_name') is-invalid @enderror"
                                                id="patient_name"
                                                name="patient_name">
                                            <option selected disabled>--Select Patient--</option>
                                            @foreach($patients as $patient)
                                                <option value="{{$patient->id}}">{{$patient->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('patient_name')
                                        <div class="invalid-feedback mt-1">
                                            <strong>Warning! </strong> <span>{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lab_technician_name" class="text-capitalize">Lab Technician Name</label>
                                        <input type="text" name="lab_technician_name"
                                               class="form-control @error('lab_technician_name') is-invalid @enderror" id="lab_technician_name"
                                               placeholder="Enter Lab Technician Name" value="{{ Auth::user()->id }}" readonly hidden>
                                        <input class="form-control text-capitalize" type="text" value="{{Auth::user()->name}}" id="lab_technician_name" disabled readonly>
                                        @error('lab_technician_name')
                                        <div class="invalid-feedback mt-1">
                                            <strong>Warning! </strong> <span>{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="verifier_doctor" class="text-capitalize">Appoint Doctor For Verify</label>
                                        <select class="custom-select mr-sm-2 @error('verifier_doctor') is-invalid @enderror"
                                                id="verifier_doctor"
                                                name="verifier_doctor">
                                            <option selected disabled>--Select Doctor--</option>
                                            @foreach($doctors as $doctor)
                                                <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('verifier_doctor')
                                        <div class="invalid-feedback mt-1">
                                            <strong>Warning! </strong> <span>{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="test_name" class="text-capitalize">Test Name</label>
                                        <select class="custom-select mr-sm-2 @error('test_name') is-invalid @enderror"
                                                id="test_name"
                                                name="test_name">
                                            <option selected disabled>--Select Test--</option>
                                            @foreach($tests as $test)
                                                <option value="{{$test->id}}">{{$test->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('test_name')
                                        <div class="invalid-feedback mt-1">
                                            <strong>Warning! </strong> <span>{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="lab_report" class="text-capitalize">Report</label>
                                        <textarea type="text" style=" height:500px;max-height: 500px; min-height: auto;"
                                                  name="lab_report"
                                                  class="form-control @error('lab_report') is-invalid @enderror" id="lab_report"
                                                  placeholder="Select Test For Report template"
                                                  value="{{ old('lab_report') }}"></textarea>
                                        @error('lab_report')
                                        <div class="invalid-feedback mt-1">
                                            <strong>Warning! </strong> <span>{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary text-capitalize">Save report</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{asset('admin/js/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('lab_report', {
            uiColor: '#9AB8F3',
            height: 500,
        });


        //set template in CK editor
        $(document).on('change','#test_name',function () {
            var user_id=$(this).val();

            console.log('Test ID - '+user_id);
            $.ajax({
                type:'get',
                url:'/admin/lab/make-report/findTemplate',
                data:{'id':user_id},
                dataType:'json',//return data will be json
                success:function(response){
                    console.log('Test template - '+response.template);

                    var data = CKEDITOR.instances.lab_report.getData();
                    if (response.template != null) {
                        var data1 = data + response.template;
                    } else {
                        var data1 = data;
                    }
                    CKEDITOR.instances['lab_report'].setData(data1);

                },
                error:function(){

                }
            });


        });
    </script>
@endsection
