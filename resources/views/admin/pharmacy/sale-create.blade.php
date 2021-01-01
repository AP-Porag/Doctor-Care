@extends('layouts.admin')

@section('module')
    Pharmacy
@endsection

@section('before-path')
    Pharmacy-List
@endsection

@section('title')
    Add new Pharmacy
@endsection

@section('breadcumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item text-capitalize"><a href="{{route('sale.index')}}">Sales List</a></li>
            <li class="breadcrumb-item active text-capitalize" aria-current="page">Add new Sale</li>
        </ol>
    </nav>
@endsection
@section('style')
    <style>
        @keyframes check {
            0% {
                height: 0;
                width: 0;
            }
            25% {
                height: 0;
                width: 10px;
            }
            50% {
                height: 20px;
                width: 10px;
            }
        }

        .checkbox {
            background-color: #fff;
            display: inline-block;
            height: 28px;
            margin: 0 .25em;
            width: 28px;
            border-radius: 4px;
            border: 1px solid #ccc;
            float: right
        }

        .checkbox span {
            display: block;
            height: 28px;
            position: relative;
            width: 28px;
            padding: 0
        }

        .checkbox span:after {
            -moz-transform: scaleX(-1) rotate(135deg);
            -ms-transform: scaleX(-1) rotate(135deg);
            -webkit-transform: scaleX(-1) rotate(135deg);
            transform: scaleX(-1) rotate(135deg);
            -moz-transform-origin: left top;
            -ms-transform-origin: left top;
            -webkit-transform-origin: left top;
            transform-origin: left top;
            border-right: 4px solid #fff;
            border-top: 4px solid #fff;
            content: '';
            display: block;
            height: 20px;
            left: 3px;
            position: absolute;
            top: 15px;
            width: 10px
        }

        .checkbox span:hover:after {
            border-color: #999
        }

        .checkbox input {
            display: none
        }

        .checkbox input:checked + span:after {
            -webkit-animation: check .8s;
            -moz-animation: check .8s;
            -o-animation: check .8s;
            animation: check .8s;
            border-color: #555
        }

        .checkbox input:checked + .warning:after {
            border-color: #FFC107
        }

        .table-wrapper {
            max-height: 450px;
            overflow-y: scroll;
            display: inline-block;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-end">
            <a href="{{route('sale.index')}}" class="btn btn-sm btn-outline-primary"><i class="fa fa-list"></i>Sales
                List</a>
        </div>
        <div class="card-body">
            <div class="form">
                <form action="{{route('sale.store')}}" method="post"
                      enctype="multipart/form-data" id="selling">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="card bg-gray-200 border-0">
                                <div class="card-header">
                                    Filter Medicine
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="search" id="search" class="form-control"
                                                       placeholder="Name / Generic Name / Company Name / Category Name / Price"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <div class="text d-flex justify-content-between">
                                                    <h6 class="text-capitalize text-center">Total medicines : <span
                                                            id="total_records" class="font-weight-bold"></span></h6>
                                                    <h6 class="text-capitalize text-center">Total Selected : <span
                                                            id="total_selected" class="font-weight-bold"></span></h6>
                                                </div>
                                                {{--                                                <ul class="list-group list-group-flush bg-gray-400">--}}
                                                {{--                                                    <li class="list-group-item" style="background: none;">--}}
                                                {{--                                                        <ul class="list-inline d-flex justify-content-between font-weight-bold text-dark">--}}
                                                {{--                                                            <li class="list-inline-item">Name</li>--}}
                                                {{--                                                            <li class="list-inline-item">Generic</li>--}}
                                                {{--                                                            <li class="list-inline-item">Company</li>--}}
                                                {{--                                                            <li class="list-inline-item">Category</li>--}}
                                                {{--                                                            <li class="list-inline-item">Price</li>--}}
                                                {{--                                                            <li class="list-inline-item" style="margin-left: 35px;"><label class="">--}}
                                                {{--                                                                    <input type="checkbox" disabled hidden/>--}}
                                                {{--                                                                    <span class="warning"></span>--}}
                                                {{--                                                                </label></li>--}}
                                                {{--                                                        </ul>--}}

                                                {{--                                                    </li>--}}
                                                {{--                                                </ul>--}}
                                                {{--                                                <ul class="list-group list-group-flush" id="medicine_data" style="overflow-y: scroll; height: 350px;">--}}
                                                {{--                                                    <li><input type="checkbox">check one</li>--}}
                                                {{--                                                    <li><input type="checkbox">check two</li>--}}
                                                {{--                                                </ul>--}}
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Generic</th>
                                                        <th>Company</th>
                                                        <th>Category</th>
                                                        <th>Price</th>
                                                        <th>Stock</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="list-wrapper">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-0">
                                <div id="item">
                                    {{--                                            <div class="remove mt-1 p-3" id="id-div2878"--}}
                                    {{--                                                 style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);">--}}
                                    {{--                                                <div class="text-right delete btn btn-outline-danger btn-sm">--}}
                                    {{--                                                    <i class="fa fa-window-close"></i>--}}
                                    {{--                                                </div>--}}
                                    {{--                                                <div class="name pos_element">Name: <span--}}
                                    {{--                                                        class="text-capitalize font-weight-bold text-dark">category</span>--}}
                                    {{--                                                    <span--}}
                                    {{--                                                        class="text-capitalize font-weight-bold text-dark">napa extra</span>--}}
                                    {{--                                                </div>--}}
                                    {{--                                                <div class="company pos_element">Generic name</div>--}}
                                    {{--                                                <div class="company pos_element">Company: Square</div>--}}
                                    {{--                                                <div class="price pos_element">price: <span--}}
                                    {{--                                                        class="text-capitalize font-weight-bold text-dark">35</span> /pc--}}
                                    {{--                                                </div>--}}
                                    {{--                                                <div class="current_stock pos_element">Current Stock: 1775</div>--}}
                                    {{--                                                <div class="quantity pos_element d-flex justify-content-between">--}}
                                    {{--                                                    <label for="">quantity:</label>--}}
                                    {{--                                                    <div>--}}
                                    {{--                                                        <input type="text" class="form-control" id="idinput-2878"--}}
                                    {{--                                                               name="quantity[]" value="1">--}}
                                    {{--                                                        <input type="hidden" class="remove" id="mediidinput-2878"--}}
                                    {{--                                                         >--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="card bg-gray-200 border-0">
                                        <div class="card-header text-right">
                                            <i class="btn btn-outline-warning text-capitalize" id="reset">Reset</i>
                                        </div>
                                        <div class="form-row card-body">
                                            <div class="col-md-10 offset-1">
                                                <div class="input-group">
                                                    <label class="col-form-label text-capitalize font-weight-bold mr-2"
                                                           for="subtotal">Subtotal:</label>
                                                    <input type="number" name="subtotal"
                                                           class="form-control bg-white text-dark @error('subtotal') is-invalid @enderror"
                                                           id="subtotal"
                                                           placeholder="0"
                                                           value="{{ old('subtotal') }}" readonly>
                                                    @error('subtotal')
                                                    <div class="invalid-feedback">
                                                        <strong>Warning! </strong>
                                                        <p>{{$message}}</p>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-10 offset-1 mt-3">
                                                <div class="input-group">
                                                    <label class="col-form-label text-capitalize font-weight-bold mr-2"
                                                           for="discount">Discount : </label>
                                                    <input type="text" name="discount"
                                                           class="form-control bg-white text-dark @error('discount') is-invalid @enderror"
                                                           id="discount"
                                                           placeholder="0"
                                                           value="{{ old('discount') }}">
                                                    @error('discount')
                                                    <div class="invalid-feedback">
                                                        <strong>Warning! </strong>
                                                        <p>{{$message}}</p>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-10 offset-1 mt-3">
                                                <div class="input-group">
                                                    <label class="col-form-label text-capitalize font-weight-bold mr-2"
                                                           for="discount_percentage">Discount in % : </label>
                                                    <input type="text" name="discount_percentage"
                                                           class="form-control bg-white text-dark @error('discount_percentage') is-invalid @enderror"
                                                           id="discount_percentage"
                                                           placeholder="0"
                                                           value="{{ old('discount_percentage') }}">
                                                    @error('discount_percentage')
                                                    <div class="invalid-feedback">
                                                        <strong>Warning! </strong>
                                                        <p>{{$message}}</p>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-10 offset-1 mt-3">
                                                <div class="input-group">
                                                    <label class="col-form-label text-capitalize font-weight-bold mr-2"
                                                           for="gross">gross total : </label>
                                                    <input type="number" name="gross"
                                                           class="form-control bg-white text-dark @error('gross') is-invalid @enderror"
                                                           id="gross"
                                                           placeholder="0"
                                                           value="{{ old('gross') }}" readonly>
                                                    @error('gross')
                                                    <div class="invalid-feedback">
                                                        <strong>Warning! </strong>
                                                        <p>{{$message}}</p>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-10 offset-1 mt-3">
                                                <div class="input-group">
                                                    <label class="col-form-label text-capitalize font-weight-bold mr-2"
                                                           for="payable_amount">Payable Amount : </label>
                                                    <input type="text" name="payable_amount"
                                                           class="form-control bg-white text-dark @error('payable_amount') is-invalid @enderror"
                                                           id="payable_amount"
                                                           placeholder="0"
                                                           value="{{ old('payable_amount') }}">
                                                    @error('payable_amount')
                                                    <div class="invalid-feedback">
                                                        <strong>Warning! </strong>
                                                        <p>{{$message}}</p>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <div class="card bg-gray-200 border-0">
                                        <div class="form-row card-body">
                                            <div class="col-md-10 offset-1">
                                                <label for="type">Select Payment Type</label>
                                                <div class="form-group">
                                                    <select name="type" id="type"
                                                            class="custom-select text-capitalize @error('type') is-invalid @enderror">
                                                        @foreach($types as $type)
                                                            <option value="{{$type->id}}"
                                                                    class="form-control text-capitalize">{{$type->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('type')
                                                    <div class="invalid-feedback">
                                                        <strong>Warning! </strong>
                                                        <p>{{$message}}</p>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-10 offset-1 mt-3">
                                                <label for="payment_method">Select Payment Method</label>
                                                <div class="form-group">
                                                    <select name="payment_method" id="payment_method"
                                                            class="custom-select text-capitalize @error('payment_method') is-invalid @enderror" onchange="paymentInfo()">
                                                        @foreach($methods as $method)
                                                            <option value="{{$method->id}}"
                                                                    class="form-control text-capitalize">{{$method->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('payment_method')
                                                    <div class="invalid-feedback">
                                                        <strong>Warning! </strong>
                                                        <p>{{$message}}</p>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                                If Check Selected--}}
                                <div class="col-md-12 mt-5" id="payment_info">
{{--                                    <div class="card bg-gray-200 border-0">--}}
{{--                                        <div class="card-header text-center text-primary">--}}
{{--                                            <h6 class="text-capitalize">Give Check Information</h6>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-row card-body">--}}
{{--                                            <div class="col-md-10 offset-1">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="bank" class="text-capitalize">Select Bank Name</label>--}}
{{--                                                    <input type="text" class="text-capitalize form-control @error('bank') is-invalid @enderror" name="bank" id="bank" placeholder="Give bank name">--}}
{{--                                                    @error('bank')--}}
{{--                                                    <div class="invalid-feedback">--}}
{{--                                                        <strong>Warning! </strong>--}}
{{--                                                        <p>{{$message}}</p>--}}
{{--                                                    </div>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-10 offset-1 mt-3">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="account" class="text-capitalize">Select Account number</label>--}}
{{--                                                    <input type="text" class="text-capitalize form-control @error('account') is-invalid @enderror" name="account" id="account" placeholder="Give account number">--}}
{{--                                                    @error('account')--}}
{{--                                                    <div class="invalid-feedback">--}}
{{--                                                        <strong>Warning! </strong>--}}
{{--                                                        <p>{{$message}}</p>--}}
{{--                                                    </div>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-10 offset-1 mt-3">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="check" class="text-capitalize">Select Check number</label>--}}
{{--                                                    <input type="text" class="text-capitalize form-control @error('check') is-invalid @enderror" name="check" id="check" placeholder="Give check number">--}}
{{--                                                    @error('check')--}}
{{--                                                    <div class="invalid-feedback">--}}
{{--                                                        <strong>Warning! </strong>--}}
{{--                                                        <p>{{$message}}</p>--}}
{{--                                                    </div>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                                {{--                                If Card Selected--}}
{{--                                <div class="col-md-12 mt-5" id="card_info">--}}
{{--                                    <div class="card bg-gray-200 border-0">--}}
{{--                                        <div class="card-header text-center text-primary">--}}
{{--                                            <h6 class="text-capitalize">Give Card Information</h6>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-row card-body">--}}
{{--                                            <div class="col-md-10 offset-1 text-capitalize text-center ">--}}
{{--                                                <h6 class="text-primary">Accepted Cards</h6>--}}
{{--                                                <div class="payment pad_bot">--}}
{{--                                                    <img src="{{asset('admin/img/card.png')}}" class="img-fluid" alt="accepted_card">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-10 offset-1 mt-3">--}}
{{--                                                <label for="type">Select Card Type</label>--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <select name="type" id="type"--}}
{{--                                                            class="custom-select text-capitalize @error('type') is-invalid @enderror">--}}
{{--                                                        <option value="master card" class="form-control text-capitalize">Master Card</option>--}}
{{--                                                        <option value="visa card" class="form-control text-capitalize">Visa Card</option>--}}
{{--                                                        <option value="american express" class="form-control text-capitalize">american express</option>--}}
{{--                                                    </select>--}}
{{--                                                    @error('type')--}}
{{--                                                    <div class="invalid-feedback">--}}
{{--                                                        <strong>Warning! </strong>--}}
{{--                                                        <p>{{$message}}</p>--}}
{{--                                                    </div>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-10 offset-1 mt-3">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="check" class="text-capitalize">Give card Holder Name</label>--}}
{{--                                                    <input type="text" class="text-capitalize form-control @error('check') is-invalid @enderror" name="check" id="check" placeholder="Give check number">--}}
{{--                                                    @error('check')--}}
{{--                                                    <div class="invalid-feedback">--}}
{{--                                                        <strong>Warning! </strong>--}}
{{--                                                        <p>{{$message}}</p>--}}
{{--                                                    </div>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-10 offset-1 mt-3">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="check" class="text-capitalize">Give Card Number</label>--}}
{{--                                                    <input type="text" class="text-capitalize form-control @error('check') is-invalid @enderror" name="check" id="check" placeholder="Give check number">--}}
{{--                                                    @error('check')--}}
{{--                                                    <div class="invalid-feedback">--}}
{{--                                                        <strong>Warning! </strong>--}}
{{--                                                        <p>{{$message}}</p>--}}
{{--                                                    </div>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-10 offset-1 mt-3">--}}
{{--                                                <div class="form-row">--}}
{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="check" class="text-capitalize">Expire Date</label>--}}
{{--                                                            <input type="date" class="text-capitalize form-control @error('check') is-invalid @enderror" name="check" id="check" placeholder="Give check number">--}}
{{--                                                            @error('check')--}}
{{--                                                            <div class="invalid-feedback">--}}
{{--                                                                <strong>Warning! </strong>--}}
{{--                                                                <p>{{$message}}</p>--}}
{{--                                                            </div>--}}
{{--                                                            @enderror--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="check" class="text-capitalize">CVV</label>--}}
{{--                                                            <input type="text" class="text-capitalize form-control @error('check') is-invalid @enderror" name="check" id="check" placeholder="Give check number">--}}
{{--                                                            @error('check')--}}
{{--                                                            <div class="invalid-feedback">--}}
{{--                                                                <strong>Warning! </strong>--}}
{{--                                                                <p>{{$message}}</p>--}}
{{--                                                            </div>--}}
{{--                                                            @enderror--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-0 bg-white text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

            fetch_customer_data();

            function fetch_customer_data(query = '') {
                $.ajax({
                    url: '/admin/sale/medicine/search',
                    type: 'get',
                    data: {'query': query},
                    dataType: 'json',
                    success: function (data) {
                        //$('#medicine_data').html(data.table_data);
                        $('tbody').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    }
                })
            }

            $(document).on('keyup', '#search', function () {
                var query = $(this).val();
                fetch_customer_data(query);
            });
        });

        $(document).ready(function () {
            var tot = 0;
            //check the checkbox is checked or not
            $(document).on('click', '.select_item', function () {
                var item_id = $(this).data('item_id');
                const totalSelected = $('.select_item:checked').length;
                var checked = [];
                //console.log(checked)

                //to take the item into medicine cart
                var count = 0;
                var selected = $(this).is(':checked');
                var unselected = $(this).not(':checked');
                $(this).attr('data-checked', '1');

                $.each(unselected, function (index, value1) {
                    if ($(this).attr('data-checked') == '1') {
                        var value = $(this).val();
                        var res = value.split("*");
                        var id = res[0];
                        $('#med_selected_section-' + id).remove();

                    }
                });

                //adding item into cart
                $.each($('.select_item:checked'), function () {
                    var value = $(this).val();
                    var name = $(this).data('item_name');
                    var generic = $(this).data('generic');
                    var company = $(this).data('company');
                    var category = $(this).data('category');
                    var price = $(this).data('item_price');
                    var res = value.split("*");
                    var id = res[0];
                    var med_id = value;
                    if ($('#med_id-' + id).length) {

                    } else {
                        $("#item").append('<div data-box_id="' + med_id + '" class="remove mt-1 mb-3 p-3" id="med_selected_section-' + med_id + '"\
                    style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);">\n\
                    \<div class="text-right">\n\
                        <i class="fa fa-window-close delete btn btn-outline-danger btn-sm removeDiv"></i>\n\
                </div>\n\
                        <div class="name pos_element d-flex">Name: <span\n\
                        class="text-capitalize font-weight-bold text-dark"><input class="border-0 text-dark font-weight-bold bg-white" style="min-width:auto;max-width: 100px;" readonly disabled value="' + category + '"></span>\n\
                    <span\n\
                        class="text-capitalize font-weight-bold text-dark" id="name"><input class="border-0 text-dark font-weight-bold bg-white" style="max-width: 150px;" readonly disabled name="med_id[]" value="' + name + '"\n\
                                        placeholder="" required id="med_id">\n\
                                <input type="hidden" class="medi_div form-control"\n\
                                       id="med_id-' + id + '"\n\
                                       name="medicine[]" value="' + id + '" placeholder=""\n\
                                       required>\n\</span>\n\
                </div>\n\
                <div class="company pos_element"><input class="border-0 bg-white" style="max-width: 180px;" readonly disabled value="' + generic + '"></div>\n\
                <div class="company pos_element">Company: <input class="border-0 bg-white" style="max-width: 180px;" readonly disabled value="' + company + '"></div>\n\
                <div class="price pos_element">price: <span\n\
                class="text-capitalize font-weight-bold text-dark"><input type="number" class="border-0 text-dark font-weight-bold bg-white" id="price-' + id + '" name="price[]" style="min-width:auto;max-width: 50px;" readonly value="' + price + '"></span> /pc\n\
                </div>\n\
                <div class="quantity pos_element d-flex justify-content-between">\n\
                <label for="">quantity:</label>\n\
                <div>\n\
                <input type="number" id="quantity-' + id + '" class="form-control"\n\
                name="quantity[]" value="" placeholder="0">\n\
                </div>\n\
                </div>\n\
                </div>');

                    }

                    //subtotal

                    $(document).ready(function () {
                        $('#quantity-' + id).keyup(function () {
                            var qty = 1;
                            var unit_price = 0;
                            var total = 0;
                            $.each($('.select_item:checked'), function () {
                                var value = $(this).val();
                                var res = value.split("*");
                                var id1 = res[0];
                                qty = $('#quantity-' + id1).val();
                                unit_price = $('#price-' + id1).val();
                                console.log('price' + unit_price)
                                total = total + qty * unit_price;
                            });
                            tot = total;
                            var discount = $('#discount').val();
                            var gross = tot - discount;
                            $('#subtotal').val(tot).end()
                            $('#gross').val(gross)
                        });
                    });
                    var curr_val = res[1] * $('#quantity-' + id).val();
                    tot = tot + curr_val;
                });
                //remove item by clicking cross button
                jQuery(function ($) {
                    $('.removeDiv').on('click', function () {
                        var box_id = $(this).parent().parent().data('box_id');
                        //console.log(box_id)
                        $('.select_item').prop('checked', false);
                        $(this).parent().parent().remove();
                    });
                });
                //counting selected item
                if ($(this).is(':checked')) {
                    $('#total_selected').text(totalSelected)
                } else {
                    $('#total_selected').text(totalSelected)

                }

            });
            var discount = $('#discount').val();
            //console.log(discount)
            var gross = tot - discount;
            var sub = $('#subtotal').val(tot).end()
            //console.log(sub)
            $('#gross').val(gross)
        });
        $(document).ready(function () {
            $('#discount').keyup(function () {
                var val_dis = 0;
                var amount = 0;
                var ggggg = 0;
                var discounted_percentage = 0;
                amount = $('#subtotal').val();
                val_dis = this.value;
                discounted_percentage = ((val_dis * 100) / amount).toFixed(3)
                ggggg = amount - val_dis;
                $('#gross').val(ggggg)
                $('#discount_percentage').val(discounted_percentage)
            });
        });
        $(document).ready(function () {
            $('#discount_percentage').keyup(function () {
                var val_dis = 0;
                var amount = 0;
                var ggggg = 0;
                var dec = 0;
                var discounted_amount = 0;
                amount = $('#subtotal').val();
                val_dis = this.value;
                dec = (val_dis / 100).toFixed(3); //its convert 10 into 0.10
                discounted_amount = amount * dec; // gives the value for subtract from main value
                ggggg = amount - discounted_amount;
                $('#gross').val(ggggg)
                $('#discount').val(discounted_amount)
            });
        });

        jQuery(function ($) {
            $('#reset').on('click', function () {
                $(this).closest('#selling').find("input[type=number], input[type=checkbox],input[type=date],input[type=text]").val("");
            });
        });
//payment Information box changing on depending select box option
        function paymentInfo()
        {
            var select_status=$('#payment_method').val();
            /* if select personal from select box then show my text box */

            if(select_status == '2')
            {
                $('#payment_info').empty();
                $('#payment_info').append('<div class="card bg-gray-200 border-0">\n\
                    <div class="card-header text-center text-primary">\n\
                <h6 class="text-capitalize">Give Check Information</h6>\n\
            </div>\n\
            <div class="form-row card-body">\n\
            <div class="col-md-10 offset-1">\n\
            <div class="form-group">\n\
            <label for="bank" class="text-capitalize">Select Bank Name</label>\n\
            <input type="text" class="text-capitalize form-control @error('bank') is-invalid @enderror" name="bank_name" id="bank" placeholder="Give bank name">\n\
                @error('bank')\n\
            <div class="invalid-feedback">\n\
            <strong>Warning! </strong>\n\
            <p>{{$message}}</p>\n\
            </div>\n\
                @enderror\n\
            </div>\n\
            </div>\n\
            <div class="col-md-10 offset-1 mt-3">\n\
            <div class="form-group">\n\
            <label for="account" class="text-capitalize">Select Account number</label>\n\
            <input type="text" class="text-capitalize form-control @error('account') is-invalid @enderror" name="account_number" id="account" placeholder="Give account number">\n\
                @error('account')\n\
            <div class="invalid-feedback">\n\
            <strong>Warning! </strong>\n\
            <p>{{$message}}</p>\n\
            </div>\n\
                @enderror\n\
            </div>\n\
            </div>\n\
            <div class="col-md-10 offset-1 mt-3">\n\
            <div class="form-group">\n\
            <label for="check" class="text-capitalize">Select Check number</label>\n\
            <input type="text" class="text-capitalize form-control @error('check') is-invalid @enderror" name="check_number" id="check" placeholder="Give check number">\n\
                @error('check')\n\
            <div class="invalid-feedback">\n\
            <strong>Warning! </strong>\n\
            <p>{{$message}}</p>\n\
            </div>\n\
                @enderror\n\
            </div>\n\
            </div>\n\
            </div>\n\
            </div>');// By using this id you can show your content
            }
            else if (select_status == '3')
            {
                $('#payment_info').empty();
                $('#payment_info').append('<div class="card bg-gray-200 border-0">\n\
                    <div class="card-header text-center text-primary">\n\
                <h6 class="text-capitalize">Give Card Information</h6>\n\
            </div>\n\
            <div class="form-row card-body">\n\
            <div class="col-md-10 offset-1 text-capitalize text-center ">\n\
            <h6 class="text-primary">Accepted Cards</h6>\n\
            <div class="payment pad_bot">\n\
            <img src="{{asset('admin/img/card.png')}}" class="img-fluid" alt="accepted_card">\n\
            </div>\n\
            </div>\n\
            <div class="col-md-10 offset-1 mt-3">\n\
            <label for="type">Select Card Type</label>\n\
            <div class="form-group">\n\
            <select name="card_name" id="type"\n\
            class="custom-select text-capitalize @error('card_name') is-invalid @enderror">\n\
            <option value="master card" class="form-control text-capitalize">Master Card</option>\n\
            <option value="visa card" class="form-control text-capitalize">Visa Card</option>\n\
            <option value="american express" class="form-control text-capitalize">american express</option>\n\
            </select>\n\
                @error('card_name')\n\
            <div class="invalid-feedback">\n\
            <strong>Warning! </strong>\n\
            <p>{{$message}}</p>\n\
            </div>\n\
                @enderror\n\
            </div>\n\
            </div>\n\
            <div class="col-md-10 offset-1 mt-3">\n\
            <div class="form-group">\n\
            <label for="card_holder_name" class="text-capitalize">Give card Holder Name</label>\n\
            <input type="text" class="text-capitalize form-control @error('card_holder_name') is-invalid @enderror" name="card_holder_name" id="card_holder_name" placeholder="Give card Holder Name">\n\
                @error('card_holder_name')\n\
            <div class="invalid-feedback">\n\
            <strong>Warning! </strong>\n\
            <p>{{$message}}</p>\n\
            </div>\n\
                @enderror\n\
            </div>\n\
            </div>\n\
            <div class="col-md-10 offset-1 mt-3">\n\
            <div class="form-group">\n\
            <label for="card_number" class="text-capitalize">Give Card Number</label>\n\
            <input type="text" class="text-capitalize form-control @error('card_number') is-invalid @enderror" name="card_number" id="card_number" placeholder="Give card number">\n\
                @error('card_number')\n\
            <div class="invalid-feedback">\n\
            <strong>Warning! </strong>\n\
            <p>{{$message}}</p>\n\
            </div>\n\
                @enderror\n\
            </div>\n\
            </div>\n\
            <div class="col-md-10 offset-1 mt-3">\n\
            <div class="form-row">\n\
            <div class="col-md-6">\n\
            <div class="form-group">\n\
            <label for="expire_date" class="text-capitalize">Expire Date</label>\n\
            <input type="date" class="text-capitalize form-control @error('expire_date') is-invalid @enderror" name="expire_date" id="expire_date" placeholder="Give Expire date">\n\
                @error('expire_date')\n\
            <div class="invalid-feedback">\n\
            <strong>Warning! </strong>\n\
            <p>{{$message}}</p>\n\
            </div>\n\
                @enderror\n\
            </div>\n\
            </div>\n\
            <div class="col-md-6">\n\
            <div class="form-group">\n\
            <label for="CVV" class="text-capitalize">CVV</label>\n\
            <input type="text" class="text-capitalize form-control @error('CVV') is-invalid @enderror" name="CVV" id="CVV" placeholder="Give CVV number">\n\
                @error('CVV')\n\
            <div class="invalid-feedback">\n\
            <strong>Warning! </strong>\n\
            <p>{{$message}}</p>\n\
            </div>\n\
                @enderror\n\
            </div>\n\
            </div>\n\
            </div>\n\
            </div>\n\
            </div>\n\
            </div>');// otherwise hide
            }else {
                $('#payment_info').empty();// otherwise hide
            }

        }


    </script>

@endsection
