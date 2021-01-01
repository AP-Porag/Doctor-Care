@extends('layouts.admin')

@section('module')
    Prescription
@endsection

@section('before-path')
    Prescription-List
@endsection

@section('title')
    Add new Prescription
@endsection

@section('breadcumb')
    <nav aria-Prescriptionel="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item text-capitalize"><a
                    href="{{route('prescription.index')}}">@yield('before-path')</a></li>
            <li class="breadcrumb-item active text-capitalize" aria-current="page">@yield('title')</li>
        </ol>
    </nav>
@endsection
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <style>

    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-end">
                    <a href="{{route('prescription.index')}}" class="btn btn-sm btn-outline-primary"><i
                            class="fa fa-list"></i>@yield('before-path')</a>
                </div>
                <div class="card-body">
                    <div class="form">
                        <form action="{{route('prescription.store')}}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="patient_id"> Patient</label>
                                        <div class="form-group">
                                            <select name="patient_id" id="patient_id" class="custom-select text-capitalize">
                                                <option value="" selected disabled>--Select Patient--</option>
                                                @foreach($patients as $patient)
                                                    <option value="{{$patient->id}}"
                                                            class="form-control text-capitalize">{{$patient->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('patient_id')
                                            <div class="invalid-feedback">
                                                <strong>Warning! </strong>
                                                <p>{{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="doctor">Doctor</label>
                                        <input type="text" name="doctor_id" value="{{Auth::user()->id}}" class="form-control" id="doctor" readonly hidden>
                                        <input type="text" value="{{Auth::user()->name}}" class="form-control" id="doctor" readonly disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="history" class="control-label text-capitalize">History</label>
                                        <textarea name="history" id="history" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="symptom" class="control-label text-capitalize">Symptom</label>
                                        <textarea name="symptom" id="symptom" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label class="control-label" for="my_select1_disabled"> Medicine</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <select class="form-control m-bot15 medicinee"
                                                        id="my_select1_disabled" value="" multiple=""
                                                        tabindex="-1" aria-hidden="true">
                                                    @foreach($medicines as $medicine)
                                                        <option value="{{$medicine->id}}"
                                                                class="form-control text-capitalize">{{$medicine->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('medicine')
                                                <div class="invalid-feedback">
                                                    <strong>Warning! </strong>
                                                    <p>{{$message}}</p>
                                                </div>
                                                @enderror
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 medicine">

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="investigation">Investigation</label>
                                        <div class="form-group">
                                            <select name="investigation[]" id="investigation"
                                                    class="custom-select text-capitalize" multiple>
                                                @foreach($labs as $lab)
                                                    <option value="{{$lab->id}}"
                                                            class="form-control text-capitalize">{{$lab->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('investigation')
                                            <div class="invalid-feedback">
                                                <strong>Warning! </strong>
                                                <p>{{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="advice" class="control-label text-capitalize">Advice</label>
                                        <textarea name="advice" id="advice" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save @yield('module')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('admin/js/ckeditor/ckeditor.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        // CKEDITOR.replace('template', {
        //     uiColor: '#9AB8F3',
        //     height: 500,
        // });
        CKEDITOR.replace('history', {
            uiColor: '#9AB8F3',
        });
        CKEDITOR.replace('symptom', {
            uiColor: '#9AB8F3',
        });
        CKEDITOR.replace('advice', {
            uiColor: '#9AB8F3',
        });
        $(document).ready(function () {
            $('#my_select1_disabled').select2();
        });
        $(document).ready(function () {
            $('#investigation').select2();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.medicinee').change(function () {
                var count = 0;
                var selected = $('#my_select1_disabled').find('option:selected');
                var unselected = $('#my_select1_disabled').find('option:not(:selected)');
                selected.attr('data-selected', '1');
                $.each(unselected, function (index, value1) {
                    if ($(this).attr('data-selected') == '1') {
                        var value = $(this).val();
                        var res = value.split("*");
                        var id = res[0];
                        $('#med_selected_section-' + id).remove();

                    }
                });

                $.each($('select.medicinee option:selected'), function () {
                    var value = $(this).val();
                    var name = $(this).text();
                    var res = value.split("*");
                    var id = res[0];
                    var med_id = value;
                    var med_name = name;

                    if ($('#med_id-' + id).length) {

                    } else {
                        $(".medicine").append('<section class="form-row med_selected card-body text-dark mb-4" id="med_selected_section-' + med_id + '" style="background: #9AB8F3">\
                        <div class=col-md-2>\n\
                            <div class="form-group">\n\
                                <label for= "med_id"> Medicine </label>\n\
                                <input class="form-control" name="med_id[]" value="' + med_name + '"\n\
                                        placeholder="" required id="med_id">\n\
                                <input type="hidden" class="medi_div form-control"\n\
                                       id="med_id-' + id + '"\n\
                                       name="medicine[]" value="' + med_id + '" placeholder=""\n\
                                       required>\n\
                            </div>\n\
                        </div>\n\
                        <div class=col-md-2>\n\
                            <div class="form-group">\n\
                                <label for="med_category"> Category </label>\n\
                                <select id="med_category" name="med_category[]" class="form-control">\n\
                                    @foreach($categories as $category)\n\
                                    <option value="{{$category->id}}">{{$category->name}}</option>\n\
                                    @endforeach\n\
                                </select>\n\
                            </div>\n\
                        </div>\n\
                        <div class=col-md-2>\n\
                            <div class="form-group">\n\
                                <label for="dosage">Dosage</label>\n\
                                <input class="form-control" name="dosage[]"\n\
                                       value="" placeholder="100 mg" id="dosage" required>\n\
                            </div>\n\
                        </div>\n\
                        <div class=col-md-2>\n\
                            <div class="form-group">\n\
                                <label for="frequency">Frequency</label>\n\
                                <input class="form-control"\n\
                                       id="frequency" name="frequency[]"\n\
                                       value="" placeholder="1 + 0 + 1" required>\n\
                            </div>\n\
                        </div>\n\
                        <div class=col-md-2>\n\
                            <div class="form-group">\n\
                                <label for="days">Days</label>\n\
                                <input class="form-control"\n\
                                       id="days" name="days[]"\n\
                                       value="" placeholder="7 days" required>\n\
                            </div>\n\
                        </div>\n\
                        <div class=col-md-2>\n\
                            <div class="form-group">\n\
                                <label for="instruction">Instruction</label>\n\
                                <input class="form-control"\n\
                                       id="instruction"\n\
                                       name="instruction[]" value=""\n\
                                       placeholder="After Food" required>\n\
                            </div>\n\
                        </div>\n\
                    </section>\n\
                    ');

                    }
                });

                $(document).on('click', '.delete', function(){
                    var product_id = $(this).attr("id");

                });
            });
        });


    </script>

@endsection
