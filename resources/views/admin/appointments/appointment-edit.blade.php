@extends('layouts.admin')

@section('module')
    Appointment
@endsection

@section('before-path')
    Appointment-List
@endsection

@section('title')
    Update Appointment
@endsection

@section('breadcumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item text-capitalize"><a href="{{route('appointment.index')}}">@yield('before-path')</a></li>
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
            <a href="{{route('appointment.index')}}" class="btn btn-sm btn-outline-primary"><i
                    class="fa fa-list"></i>@yield('before-path')</a>
        </div>
        <div class="card-body">
            <div class="form">
                <form action="{{route('appointment.update',$appointment->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="text-capitalize">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                       placeholder="Enter Patient name" value="{{$appointment->name, old('name') }}">
                                @error('name')
                                <div class="invalid-feedback mt-1">
                                    <strong>Warning! </strong> <span>{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone" class="text-capitalize">Phone</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                       placeholder="Enter Patient phone" value="{{$appointment->contact, old('phone') }}">
                                @error('phone')
                                <div class="invalid-feedback mt-1">
                                    <strong>Warning! </strong> <span>{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="doctor" class="text-capitalize">doctor</label>
                                <select class="custom-select mr-sm-2 @error('doctor') is-invalid @enderror" id="doctor" name="doctor">
                                    <option selected disabled>--Select Doctor--</option>
                                    @foreach($doctors as $doctor)
                                        <option class="text-capitalize" value="{{$doctor->id ,old('doctor')}}}}"
                                                @if ($appointment->doctor_id == $doctor->id) selected @endif>{{$doctor->name}}</option>
                                    @endforeach
                                </select>
                                @error('doctor')
                                <div class="invalid-feedback mt-1">
                                    <strong>Warning! </strong> <span>{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="appointment_date" class="text-capitalize">Appointment Date</label>
                                <input type="date" name="appointment_date" class="form-control @error('appointment_date') is-invalid @enderror" id="appointment_date"
                                       placeholder="Enter Appointment date"
                                value="{{$appointment->date, old('appointment_date') }}">
                                @error('appointment_date')
                                <div class="invalid-feedback mt-1">
                                    <strong>Warning! </strong> <span>{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="remarks" class="text-capitalize">Remarks</label>
                                <input type="text" name="remarks" class="form-control @error('appointment_date') is-invalid @enderror" id="remarks"
                                       placeholder="Have Any Remarks ... " value="{{$appointment->remarks, old('remarks') }}">
                                @error('remarks')
                                <div class="invalid-feedback mt-1">
                                    <strong>Warning! </strong> <span>{{$message}}</span>
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
@endsection

@section('script')
    <script>

    </script>
@endsection
