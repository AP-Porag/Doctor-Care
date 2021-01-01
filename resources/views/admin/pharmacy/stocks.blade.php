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
                            <table class="table table-bordered dataTable table-striped table-hover" id="dataTable"
                                   width="100%" cellspacing="0"
                                   Medicine="grid" aria-describedby="dataTable_info">
                                <thead>
                                <tr Medicine="row">
                                    <th class="sorting_asc text-center" tabindex="0" aria-controls="dataTable"
                                        rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending">Sl
                                    </th>
                                    <th class="sorting text-center text-capitalize" tabindex="0"
                                        aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Office: activate to sort column ascending">
                                        Category
                                    </th>
                                    <th class="sorting text-center text-capitalize" tabindex="0"
                                        aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Office: activate to sort column ascending">
                                        Company
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
                                        Price
                                    </th>
                                    <th rowspan="1" colspan="1" class="text-center">Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($medicines as $key=>$medicine)
                                    <tr Medicine="row" class="odd">
                                        <td class="sorting_1 text-center">{{$loop->index+1}}</td>
                                        <td class="sorting_1 text-capitalize">{{$medicine->category->name}}</td>
                                        <td class="sorting_1 text-capitalize">{{$medicine->company->name}}</td>
                                        <td class="text-capitalize">
                                            {{$medicine->generic->name}}
                                        </td>
                                        <td class="sorting_1 text-capitalize">{{$medicine->name}}</td>
                                        <td class="sorting_1 text-capitalize">
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
                                                $present_stock_box = $present_stock/100;
                                            @endphp
                                            <h6 class="{{$present_stock_box < '2' ? 'text-danger' : ''}}">{{$present_stock_box < '1' ? 'Below One Box' : $present_stock_box}}</h6>
                                        </td>
                                        <td class="sorting_1 text-capitalize">
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
                                            <h6 class="{{$present_stock < '100' ? 'text-danger' : ''}}">{{$present_stock}}</h6>
                                        </td>
                                        <td class="sorting_1 text-capitalize">{{$medicine->price}}</td>
                                        <td>
                                            <div class="btn-group d-flex justify-content-center">
                                                <a href="{{route('purchaseRequest',$medicine->id)}}"
                                                   class="btn btn-sm btn-outline-info mr-3"><i
                                                        class="fa fa-plus-circle mr-3"></i>Add To PR</a>
                                                <button type="button" class="btn btn-sm btn-outline-success"
                                                        data-toggle="modal"
                                                        data-target="#addStockModal{{$medicine->id}}">
                                                    <i class="fa fa-store mr-3"></i>Add Stock
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!--Add stock Modal -->
                                    <div class="modal fade" id="addStockModal{{$medicine->id}}" tabindex="-1"
                                         role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-capitalize text-primary" id="exampleModalLabel">Add Stock</h5>
                                                    <button type="button" class="close btn-outline-danger" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form">
                                                        <form action="{{route('addStock')}}" method="post">
                                                            <div class="form-row">
                                                                @csrf
                                                                @method('post')
                                                                <div class="col-md-8">
                                                                    <label for="medicine_id">Medicine</label>
                                                                    <input type="text" value="{{$medicine->name}}"
                                                                           class="form-control" disabled readonly
                                                                           id="medicine_id">
                                                                    <input type="text" value="{{$medicine->id}}"
                                                                           name="medicine_id" class="form-control @error('medicine_id') is-invalid @enderror"
                                                                           hidden readonly>
                                                                    @error('medicine_id')
                                                                    <div class="invalid-feedback">
                                                                        <strong>Warning! </strong>
                                                                        <p>{{$message}}</p>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="quantity">Quantity</label>
                                                                    <input type="number" value="" name="quantity"
                                                                           class="form-control @error('quantity') is-invalid @enderror" id="quantity">
                                                                    @error('quantity')
                                                                    <div class="invalid-feedback">
                                                                        <strong>Warning! </strong>
                                                                        <p>{{$message}}</p>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-4 card-footer">
                                                                <div class="col-md-12 text-right">
                                                                    <button type="submit" class="btn btn-block btn-sm btn-outline-success">Save
                                                                        Stock
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="dataTable_info" Medicine="status" aria-live="polite">
                                Showing 51
                                to 57 of 57 entries
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            {{$medicines->links()}}
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
