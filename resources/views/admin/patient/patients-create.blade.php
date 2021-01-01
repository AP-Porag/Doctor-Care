@extends('layouts.admin')

@section('module')
    Patient
@endsection

@section('before-path')
    Patient-List
@endsection

@section('title')
    Add new Patient
@endsection

@section('breadcumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item text-capitalize"><a href="{{ route('patient.index') }}">@yield('before-path')</a>
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
            <a href="{{ route('patient.index') }}" class="btn btn-sm btn-outline-primary"><i
                    class="fa fa-list"></i>@yield('before-path')</a>
        </div>
        <div class="card-body">
            <div class="form">
                <form action="{{ route('patient.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name" class="text-capitalize">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       placeholder="Enter Patient name" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback mt-1">
                                    <strong>Warning! </strong> <span>{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email" class="text-capitalize">Email</label>
                                <input type="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror" id="email"
                                       placeholder="Enter Patient email" value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback mt-1">
                                    <strong>Warning! </strong> <span>{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="phone" class="text-capitalize">Phone</label>
                                <input type="text" name="phone"
                                       class="form-control @error('phone') is-invalid @enderror" id="phone"
                                       placeholder="Enter Patient phone" value="{{ old('phone') }}">
                                @error('phone')
                                <div class="invalid-feedback mt-1">
                                    <strong>Warning! </strong> <span>{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="contact" class="text-capitalize">Alternative Phone</label>
                                <input type="text" name="contact"
                                       class="form-control @error('contact') is-invalid @enderror" id="contact"
                                       placeholder="Enter alternative phone" value="{{ old('contact') }}">
                                @error('contact')
                                <div class="invalid-feedback mt-1">
                                    <strong>Warning! </strong> <span>{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="birth_date" class="text-capitalize">Birth Date</label>
                                <input type="date" name="birth_date"
                                       class="form-control @error('birth_date') is-invalid @enderror" id="birth_date"
                                       placeholder="Enter Patient birth date" {{ old('birth_date') }}>
                                @error('birth_date')
                                <div class="invalid-feedback mt-1">
                                    <strong>Warning! </strong> <span>{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="blood_group" class="text-capitalize">Blood Group</label>
                                <select class="custom-select mr-sm-2 @error('blood_group') is-invalid @enderror"
                                        id="blood_group" name="blood_group">
                                    <option selected disabled>--Select Blood Group--</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                                @error('blood_group')
                                <div class="invalid-feedback mt-1">
                                    <strong>Warning! </strong> <span>{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="gender" class="text-capitalize">Gender</label>
                                <div class="@error('gender') is-invalid @enderror" id="gender">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="male" name="gender" class="custom-control-input"
                                               value="male">
                                        <label class="custom-control-label" for="male">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="female" name="gender" class="custom-control-input"
                                               value="female">
                                        <label class="custom-control-label" for="female">Female</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="other" name="gender" class="custom-control-input"
                                               value="other's">
                                        <label class="custom-control-label" for="other">Other's</label>
                                    </div>
                                </div>
                                @error('gender')
                                    <div class="invalid-feedback">
                                        <strong>Warning! </strong>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="date" class="text-capitalize">Appointment Date</label>
                                <input type="date" name="date"
                                       class="form-control @error('date') is-invalid @enderror" id="date"
                                       placeholder="Enter Patient Appointment date" {{ old('birth_date') }}>
                                @error('date')
                                <div class="invalid-feedback mt-1">
                                    <strong>Warning! </strong> <span>{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="doctor" class="text-capitalize">doctor</label>
                                <select class="custom-select mr-sm-2 @error('doctor') is-invalid @enderror" id="doctor"
                                        name="doctor">
                                    <option selected disabled>--Select Doctor--</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                    @endforeach
                                </select>
                                @error('doctor')
                                <div class="invalid-feedback mt-1">
                                    <strong>Warning! </strong> <span>{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="fees" class="text-capitalize">Fees</label>
                                <input type="number" name="fees"
                                       class="form-control prod_price @error('fees') is-invalid @enderror" id="fees"
                                       placeholder="Consultation Fees" value="{{ old('fees') }}" readonly>
                                @error('fees')
                                <div class="invalid-feedback mt-1">
                                    <strong>Warning! </strong> <span>{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="payment_type" class="text-capitalize">Payment Type</label>
                                <select class="custom-select mr-sm-2 @error('payment_type') is-invalid @enderror" id="payment_type"
                                        name="payment_type">
                                    <option selected disabled>--Select payment type--</option>
                                    @foreach($types as $type)
                                        <option class="text-capitalize" value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                                @error('payment_type')
                                <div class="invalid-feedback mt-1">
                                    <strong>Warning! </strong> <span>{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address" class="text-capitalize">Address</label>
                                <div class="card p-2" id="address">
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="country" class="text-capitalize">Country</label>
                                                <input type="text" name="country"
                                                       class="form-control @error('gender') is-invalid @enderror"
                                                       id="country"
                                                       placeholder="Enter country name" {{ old('country') }}>
                                                @error('country')
                                                <div class="invalid-feedback">
                                                    <strong>Warning! </strong>{{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="division" class="text-capitalize">Division</label>
                                                <input type="text" name="division"
                                                       class="form-control @error('division') is-invalid @enderror"
                                                       id="division"
                                                       placeholder="Select Division" {{ old('division') }}>
                                                @error('division')
                                                <div class="invalid-feedback">
                                                    <strong>Warning! </strong>{{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="district" class="text-capitalize">District</label>
                                                <input type="text" name="district"
                                                       class="form-control @error('district') is-invalid @enderror"
                                                       id="district"
                                                       placeholder="Select district" {{ old('district') }}>
                                                @error('district')
                                                <div class="invalid-feedback">
                                                    <strong>Warning! </strong>{{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="city" class="text-capitalize">City</label>
                                                <input type="text" name="city"
                                                       class="form-control @error('city') is-invalid @enderror"
                                                       id="city"
                                                       placeholder="Give City" {{ old('city') }}>
                                                @error('city')
                                                <div class="invalid-feedback">
                                                    <strong>Warning! </strong>{{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sub_district"
                                                       class="text-capitalize">Thana/Sub-District</label>
                                                <input type="text" name="sub_district"
                                                       class="form-control @error('sub_district') is-invalid @enderror"
                                                       id="sub_district"
                                                       placeholder="Enter Thana/Sub-District" {{ old('sub_district') }}>
                                                @error('sub_district')
                                                <div class="invalid-feedback">
                                                    <strong>Warning! </strong>{{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="village" class="text-capitalize">Village/Ward</label>
                                                <input type="text" name="village"
                                                       class="form-control @error('village') is-invalid @enderror"
                                                       id="village"
                                                       placeholder="Enter village name" {{ old('village') }}>
                                                @error('village')
                                                <div class="invalid-feedback">
                                                    <strong>Warning! </strong>{{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="logo" class="text-capitalize">Photo</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="img-thumbnail">
                                            <img src="image" alt="logo" class="img-fluid" id="preview" style="min-width: 100%;max-width: 100%;
        max-height: 179px; min-height: 179px;">
                                        </div>
                                    </div>
                                    <div class="col-md-8 align-self-end">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="photo"
                                                           class="form-control @error('photo') is-invalid @enderror"
                                                           id="photo"
                                                           placeholder="Enter Patient photo" @change="fileChange">
                                                    @error('photo')
                                                    <div class="invalid-feedback">
                                                        <strong>Warning! </strong>{{$message}}
                                                    </div>
                                                    @enderror

                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-gradient-primary text-light"
                                                        id="">Upload Logo</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>--}}
    <script>
        $('#preview').attr('src', 'http://127.0.0.1:8000/storage/no-image/upload-image.png');

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#photo").change(function () {
            readURL(this);
        });

        //doctor fees load according selected doctor
        $(document).on('change','#doctor',function () {
            var user_id=$(this).val();

            console.log('Doctor ID - '+user_id);
            $.ajax({
                type:'get',
                url:'/admin/patient/inactive/findPrice',
                data:{'user_id':user_id},
                dataType:'json',//return data will be json
                success:function(data){
                    console.log('Doctor fees - '+data.fees);

                    // here price is coloumn name in products table data.coln name
                    $('#fees').val(data.fees);

                },
                error:function(){

                }
            });


        });

    </script>
@endsection
