<?php

namespace App\Http\Controllers\Admin\Sale;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Check;
use App\Models\Medicine;
use App\Models\Method;
use App\Models\Sale;
use App\Models\SoldMedicine;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use \Milon\Barcode\DNS1D;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::orderBy('created_at','DESC')->paginate(10);
        return response(view('admin.pharmacy.sales',compact('sales')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $methods = Method::all();
        return response(view('admin.pharmacy.sale-create', compact('types', 'methods')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user()->id;
        $medicines = $request->medicine;
        $quantity = $request->quantity;
        $price = $request->price;
        $sub_total = $request->subtotal;
        $discount = $request->discount;
        $discount_percentage = $request->discount_percentage;
        $gross_total = $request->gross;
        $payable_amount = $request->payable_amount;
        $type = $request->type;
        $method = $request->payment_method;
        $bank_name = $request->bank_name;
        $check_number = $request->check_number;
        $account_number = $request->account_number;
        $card_name = $request->card_name;
        $card_holder_name = $request->card_holder_name;
        $card_number = $request->card_number;
        $expire_date = $request->expire_date;
        $CVV = $request->CVV;

        if ($quantity) {

            $total_quantity = array_sum($quantity);
        }
        $sale = Sale::create([
            'invoice' => 'invoice',
            'total_quantity' => $total_quantity,
            'sub_total' => $sub_total,
            'discount' => $discount,
            'discount_percentage' => $discount_percentage,
            'gross_total' => $gross_total,
            'payable_amount' => $payable_amount,
            'type_id' => $type,
            'method_id' => $method,
            'user_id'=>$user
        ]);

        if ($sale) {
            $sale->invoice = 'i-' . date('Ymd') . '-' . $sale->id;
            $sale->save();
        }

        //data save in sold medicine
        if ($sale) {
            foreach ($medicines as $key=>$medicine) {
                $sold_medicine = SoldMedicine::create([
                    'sale_id' => $sale->id,
                    'medicine_id' => $medicine,
                    'quantity' => $quantity[$key],
                    'price' => $price[$key]
                ]);
            }
        }
        //saving information if request has check
        if ($method == 2) {
            $check = Check::create([
                'sale_id' => $sale->id,
                'bank_name' => $bank_name,
                'check_number' => $check_number,
                'account_number' => $account_number,
            ]);
        } elseif ($method == 3) {
            //saving information if request has card
            $card = Card::create([
                'sale_id' => $sale->id,
                'card_name' => $card_name,
                'card_holder_name' => $card_holder_name,
                'card_number' => $card_number,
                'expire_date' => $expire_date,
                'CVV' => $CVV,
            ]);
        }
        Session::flash('success', 'Sale data Added Successfully !');
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //searching || filtering route
    public function search(Request $request)
    {
        //return $data = Medicine::all();
        //return 'OK';
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = Medicine::where('name', 'like', '%' . $query . '%')
                    ->orWhere('price', 'like', '%' . $query . '%')
                    ->orderBy('created_at', 'desc')
                    ->get();

            } else {
                $data = Medicine::orderBy('created_at', 'desc')->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
//                foreach ($data as $row) {
//                    $output .= '
//        <li class="list-group-item">
//                                                <ul class="list-inline d-flex justify-content-between" style="width: 100%;" id="list-wrapper">
//                                                    <li class="list-inline-item">' . $row->name . '</li>
//                                                    <li class="list-inline-item">' . $row->generic->name . '</li>
//                                                    <li class="list-inline-item">' . $row->company->name . '</li>
//                                                    <li class="list-inline-item">' . $row->category->name . '</li>
//                                                    <li class="list-inline-item">' . $row->price . '</li>
//                                                    <li class="list-inline-item"><label class="checkbox">
//                                                            <input type="checkbox" value="' . $row->id . '"/>
//                                                            <span class="warning"></span>
//                                                        </label></li>
//                                                </ul>
//<input class="hobbies" type="checkbox" value="' . $row->id . '"/>
//                <span class="warning"></span>
//                                            </li>
//        ';
//                }
                foreach ($data as $row) {
                    $total_stock = 0;
                    $total_sell = 0;
                    foreach ($row->stocks as $stock){
                        $total_stock +=$stock->quantity;
                    }
                    foreach ($row->sells as $sell){
                        $total_sell +=$sell->quantity;
                    }
                    $present_stock = $total_stock-$total_sell;
                    $output .= '
        <tr>
         <td>' . $row->name . '</td>
         <td>' . $row->generic->name . '</td>
         <td>' . $row->company->name . '</td>
         <td>' . $row->category->name . '</td>
         <td>' . $row->price . '</td>
         <td>
          '.$present_stock .'
          </td>
         <td>
             <label class="checkbox">
<input type="checkbox" class="select_item" data-item_id="' . $row->id . '" data-category="' . $row->category->name . '" data-generic="' . $row->generic->name . '" data-company="' . $row->company->name . '" data-item_name="' . $row->name . '" data-item_stock="'.$present_stock.'" data-item_price="' . $row->price . '" value="' . $row->id . '">
<span class="warning"></span>
             </label>
         </td>
        </tr>
        ';
                }
            } else {
                $output = '
       <tr>
        <td align="center" colspan="7" class="alert alert-danger">No Data Found</td>
       </tr>
       ';
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total_row
            );

            echo json_encode($data);
        }
    }
    public function stock()
    {
        $medicines = Medicine::orderBy('created_at','DESC')->paginate(10);
        return response(view('admin.pharmacy.stocks',compact('medicines')));
    }
}
