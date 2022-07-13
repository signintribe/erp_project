<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales\ErpDespatchInventory;
use App\Models\Sales\erp_sale_order;
use App\Models\tblproduct_stockavailability;
use DB;
class DespatchInventoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sales/sales-invoice');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(empty(ErpDespatchInventory::where('invoice_number', $request->invoice_number)->first())){
            $data = $request->except(['pending_so', 'product_id', 'sogross_price', 'sonet_amount']);
            $data['company_id'] = session('company_id');
            ErpDespatchInventory::create($data);
            $product = tblproduct_stockavailability::where('product_id', $request->product_id)->first();
            if(empty($product)){
                tblproduct_stockavailability::create([
                    'product_id'=> $request->product_id,
                    'stock_in_hand' => 0
                ]);
            }else{
                $total_product = $product['stock_in_hand'] - $request->despatch_qty;
                tblproduct_stockavailability::where('product_id', $request->product_id)->update([
                    'stock_in_hand' => $total_product
                ]);
            }
            $status = $request->remaining_quantity == 0 ? 1 : 0; 
            $so = erp_sale_order::where('id', $request->so_id)->first();
            $so->despatch_qty = $so->despatch_qty  - $request->despatch_qty;
            $so->so_status = $status;
            $so->save();
            return response()->json([
                "status" => true,
                "message" => "Save Receive Inventory"
            ]);
        }else{
            return response()->json([
                "status" => false,
                "message" => "This invoice number is already exist, please use another"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($array)
    {
        $arr = json_decode($array,true);
        return DB::select('SELECT di.*, so.so_number FROM (SELECT * FROM erp_despatch_inventories WHERE company_id='.$arr['company_id'].') AS di JOIN(SELECT id, so_number FROM erp_sale_orders) AS so ON so.id = di.so_id LIMIT '.$arr['offset'].', '.$arr['limit'].'');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $di = ErpDespatchInventory::where('id', $id)->first();
        $so = erp_sale_order::where('id', $di->so_id)->first();
        $so->despatch_qty = $so->despatch_qty + $di->despatch_qty;
        $so->save();

        $stock = tblproduct_stockavailability::where('product_id', $so->product_id)->first();
        $stock->stock_in_hand = $stock->stock_in_hand + $di->despatch_qty;
        $stock->save();
        
        ErpDespatchInventory::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Despatch Inventory Delete Permanently'
        ]);
    }
}
