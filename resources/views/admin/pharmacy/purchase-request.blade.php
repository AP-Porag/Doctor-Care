@extends('layouts.admin')

@section('module')
    Medicine
@endsection

@section('before-path')
    Dashboard
@endsection

@section('title')
    Medicine-List
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
                <a href="{{route('medicine.create')}}" class="btn btn-sm btn-outline-primary text-capitalize mr-3"><i
                        class="fa fa-plus-circle"></i> Add new @yield('module')</a>
                <a href="{{route('inactive_medicine')}}" class="btn btn-sm btn-outline-danger text-capitalize"><i
                        class="fa fa-ban"></i> In-Active @yield('module')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('pr_createView')}}" method="post">
                                @csrf
                                @method('post')
                                <div class="table-responsive">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered dataTable table-striped table-hover"
                                                   id="dataTable" width="100%" cellspacing="0"
                                                   Medicine="grid" aria-describedby="dataTable_info">
                                                <thead>
                                                <tr Medicine="row">
                                                    <th class="sorting_asc text-center" tabindex="0"
                                                        aria-controls="dataTable" rowspan="1"
                                                        colspan="1" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">Sl
                                                    </th>
                                                    <th class="sorting text-center text-capitalize" tabindex="0"
                                                        aria-controls="dataTable" rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending">
                                                        Company
                                                    </th>
                                                    <th class="sorting text-center text-capitalize" tabindex="0"
                                                        aria-controls="dataTable" rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending">
                                                        Category
                                                    </th>
                                                    <th class="sorting text-center text-capitalize" tabindex="0"
                                                        aria-controls="dataTable" rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending">
                                                        Medicines group
                                                    </th>
                                                    <th class="sorting_asc text-center text-capitalize" tabindex="0"
                                                        aria-controls="dataTable" rowspan="1"
                                                        colspan="1" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">Name
                                                    </th>
                                                    <th class="sorting text-center text-capitalize" tabindex="0"
                                                        aria-controls="dataTable" rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending">
                                                        Box
                                                    </th>
                                                    <th class="sorting text-center text-capitalize" tabindex="0"
                                                        aria-controls="dataTable" rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending">
                                                        Stock
                                                    </th>
                                                    <th class="sorting text-center text-capitalize" tabindex="0"
                                                        aria-controls="dataTable" rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending">
                                                        Avg. Sell Per Day
                                                    </th>
                                                    <th class="sorting text-center text-capitalize" tabindex="0"
                                                        aria-controls="dataTable" rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending">
                                                        Buying Price
                                                    </th>
                                                    <th class="sorting text-center text-capitalize" tabindex="0"
                                                        aria-controls="dataTable" rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending">
                                                        Price
                                                    </th>
                                                    <th rowspan="1" colspan="1" class="text-center">Select
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($medicines as $key=>$medicine)

                                                    <tr Medicine="row" class="odd">
                                                        <td class="sorting_1 text-center">{{$loop->index+1}}</td>
                                                        <td class="sorting_1 text-capitalize">{{$medicine->medicine->company->name}}</td>
                                                        <td class="sorting_1 text-capitalize">{{$medicine->medicine->category->name}}</td>
                                                        <td class="text-capitalize">{{$medicine->medicine->generic->name}}</td>
                                                        <td class="sorting_1 text-capitalize">{{$medicine->medicine->name}}</td>
                                                        <td class="sorting_1 text-capitalize">
                                                            @php
                                                                $total_stock = 0;
                                                                $total_sell = 0;
                                                                foreach ($medicine->medicine->stocks as $stock){
                                                                    $total_stock +=$stock->quantity;
                                                                }
                                                                foreach ($medicine->medicine->sells as $sell){
                                                                    $total_sell +=$sell->quantity;
                                                                }
                                                                $present_stock = $total_stock-$total_sell;
                                                                $present_stock_box = $present_stock/100;
                                                            @endphp
                                                            <h6 class="{{$present_stock_box < '2' ? 'text-danger' : ''}}">{{$present_stock_box < '1' ? 'Below One Box' : $present_stock_box}}</h6>
                                                        </td>
                                                        <td class="sorting_1 text-capitalize">
                                                            @php
                                                                $total_stock = 0;
                                                                $total_sell = 0;
                                                                foreach ($medicine->medicine->stocks as $stock){
                                                                    $total_stock +=$stock->quantity;
                                                                }
                                                                foreach ($medicine->medicine->sells as $sell){
                                                                    $total_sell +=$sell->quantity;
                                                                }
                                                                $present_stock = $total_stock-$total_sell;
                                                            @endphp
                                                            <h6 class="{{$present_stock < '100' ? 'text-danger' : ''}}">{{$present_stock}}</h6>
                                                        </td>
                                                        <td class="sorting_1 text-capitalize">
                                                            @php
                                                                $total_sells = \App\Models\SoldMedicine::where('medicine_id',$medicine->medicine->id)->get();
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
                                                                <span class="font-weight-bold" style="font-size: 18px;">{{ceil($average)}}</span><span>({{$total_sell_count}})</span>
                                                        </td>
                                                        <td class="sorting_1 text-capitalize">
                                                            {{$medicine->medicine->price}}
                                                        </td>
                                                        <td class="sorting_1 text-capitalize">{{$medicine->medicine->price}}</td>
                                                        <td>
                                                            <div class="btn-group d-flex justify-content-center">
                                                                <input type="checkbox" value="{{$medicine->medicine->id}}"
                                                                       id="{{$medicine->medicine->id}}" name="medicines[]">
                                                                <a href="{{route('purchaseRequestForceDelete',$medicine->id)}}" class="btn btn-sm btn-outline-danger ml-3"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-7">
{{--                                            {{$medicines->links()}}--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-row">
                                        <div class="col-md-12 text-right">
                                            <button type="submit" class="btn btn-primary">Save Purchase Request</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
