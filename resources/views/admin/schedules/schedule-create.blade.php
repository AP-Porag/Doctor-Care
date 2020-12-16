@extends('layouts.admin')

@section('module')
    Schedule
@endsection

@section('before-path')
    Schedule List
@endsection

@section('title')
    Add New Schedule
@endsection

@section('breadcumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item text-capitalize"><a href="{{ route('schedule.index') }}">@yield('before-path')</a>
            </li>
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
            <a href="{{ route('schedule.index') }}" class="btn btn-sm btn-outline-primary"><i
                    class="fa fa-list"></i>@yield('before-path')</a>
        </div>
        <div class="card-body">
            <div class="form">
                <form action="{{ route('schedule.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="doctor" class="text-capitalize">doctor</label>
                                <select class="custom-select mr-sm-2" @error('doctor_id') is-invalid @enderror
                                    id="doctor_id" name="doctor_id">
                                    <option selected disabled>--Select Doctor--</option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                    @endforeach
                                </select>
                                @error('doctor_id')
                                    <div class="invalid-feedback">
                                        <strong>Warning!{{ $message }} </strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="weekday" class="text-capitalize">Week Day</label>
                                <select class="custom-select mr-sm-2" id="weekday" name="weekday">
                                    <option selected disabled>--Select Week Day--</option>
                                    <option value="saturday">Saturday</option>
                                    <option value="sunday">Sunday</option>
                                    <option value="monday">Monday</option>
                                    <option value="tuesday">Tuesday</option>
                                    <option value="wednesday">Wednesday</option>
                                    <option value="thirsday">Thirsday</option>
                                    <option value="friday">Friday</option>
                                </select>
                                @error('weekday')
                                    <div class="alert alert-danger alert-dismissible fade show mt-1">
                                        <strong>Warning! </strong>{{ $message }}
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_time" class="text-capitalize">Start Time</label>
                                <input type="time" name="start_time" class="form-control" id="start_time">
                                @error('start_time')
                                    <div class="alert alert-danger alert-dismissible fade show mt-1">
                                        <strong>Warning! </strong>{{ $message }}
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_time" class="text-capitalize">End Time</label>
                                <input type="time" name="end_time" class="form-control" id="end_time">
                                @error('end_time')
                                    <div class="alert alert-danger alert-dismissible fade show mt-1">
                                        <strong>Warning! </strong>{{ $message }}
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
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
