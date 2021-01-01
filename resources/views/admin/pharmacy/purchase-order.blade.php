@extends('layouts.admin')

@section('module')
    Create Purchase Order
@endsection

@section('before-path')
    Dashboard
@endsection

@section('title')
    Purchase Request
@endsection

@section('breadcumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-capitalize"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active text-capitalize" aria-current="page">@yield('title')</li>
            <li class="breadcrumb-item active text-capitalize" aria-current="page">Create Purchase Order</li>
        </ol>
    </nav>
@endsection

@section('style')
    <style>

    </style>
@endsection

@section('content')
    <div class="content">
        <form action="{{route('purchase.store')}}" method="post">
            @csrf
            @method('post')
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                            <div class="d-flex justify-content-between">
                                <a href="{{route('medicine.create')}}"
                                   class="btn btn-sm btn-outline-primary text-capitalize mr-3"><i
                                        class="fa fa-plus-circle"></i> Add new @yield('module')</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach($medicines as $key=>$medicine)
                                <div class="form-row">
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="" class="text-capitalize">ID</label>
                                            <input type="text" value="{{$medicine->id}}" class="form-control border-0" disabled readonly>
                                            <input type="text" value="{{$medicine->id}}" name="medicine_id[]" class="form-control border-0" readonly hidden>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="" class="text-capitalize">name</label>
                                            <input type="text" value="{{$medicine->name}}" class="form-control border-0" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="" class="text-capitalize">Category</label>
                                            <input type="text" value="{{$medicine->category->name}}" class="form-control border-0" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="" class="text-capitalize">Generic name</label>
                                            <input type="text" value="{{$medicine->generic->name}}" class="form-control border-0" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            @php
                                                $total_stock = 0;
                                                $total_sell = 0;
                                                foreach ($medicine->stocks as $stock){
                                                    $total_stock +=$stock->quantity;
                                                }
                                                foreach ($medicine->sells as $sell){
                                                    $total_sell +=$sell->quantity;
                                                }
                                                $present_stock = $total_stock-$total_sell;
                                            @endphp
                                            <label for="" class="text-capitalize">Stock</label>
                                            <input type="text" value="{{$present_stock}}" class="form-control border-0" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            @php
                                                $total_sells = \App\Models\SoldMedicine::where('medicine_id',$medicine->id)->get();
                                                $total_sell_count = $total_sells->count();
                                                $total_quantity = 0;
                                                $average = 0;

                                                    foreach ($total_sells as $sell){
                                                        $total_quantity += $sell->quantity;
                                                    }
                                                    if($total_quantity != 0 && $total_sell_count !=0)
                                                     $average = $total_quantity/$total_sell_count;
                                                    else
                                                    $average = 0;
                                            @endphp
                                            <label for="" class="text-capitalize">Sell/Day</label>
                                            <input type="text" value="{{ceil($average)}}" class="form-control border-0" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="" class="text-capitalize">Price</label>
                                            <input type="text" value="{{$medicine->price}}" class="form-control" name="price[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="" class="text-capitalize">Quantity</label>
                                            <input type="text" value="" class="form-control" name="quantity[]">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Company Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-6 offset-3">
                                    <div class="card-img">
                                        <img src="{{$medicine->company->logo}}" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="text-capitalize">name</label>
                                        <input type="text" value="{{$medicine->company->name}}" class="form-control border-0" disabled readonly>
                                        <input type="text" value="{{$medicine->company->id}}" name="company_id" class="form-control border-0" hidden readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="text-capitalize">Sells Representative Name</label>
                                        <input type="text" value="{{$medicine->company->sr_name}}" class="form-control border-0" disabled readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="text-capitalize">Phone</label>
                                        <input type="text" value="{{$medicine->company->phone}}" class="form-control border-0" disabled readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary">Save Purchase Request</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
