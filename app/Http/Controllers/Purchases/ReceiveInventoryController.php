<?php

namespace App\Http\Controllers\Purchases;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchases\ErpReceiveInventory;
use App\Models\erp_purchase_order;
use App\Models\tblproduct_stockavailability;
use DB;
class ReceiveInventoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('purchases.receive-inventory');
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
        if(empty(ErpReceiveInventory::where('invoice_number', $request->invoice_number)->first())){
            $data = $request->except(['pending_po', 'product_id', 'pogross_price', 'ponet_amount']);
            $data['company_id'] = session('company_id');
            ErpReceiveInventory::create($data);
            $product = tblproduct_stockavailability::where('product_id', $request->product_id)->first();
            if(empty($product)){
                tblproduct_stockavailability::create([
                    'product_id'=> $request->product_id,
                    'stock_in_hand' => $request->received_qty
                ]);
            }else{
                $total_product = $product['stock_in_hand'] + $request->received_qty;
                tblproduct_stockavailability::where('product_id', $request->product_id)->update([
                    'stock_in_hand' => $total_product
                ]);
            }
            $status = $request->remaining_quantity == 0 ? 1 : 0; 
            $po = erp_purchase_order::where('id', $request->po_id)->first();
            $po->received_qty = $po->received_qty  + $request->received_qty;
            $po->po_status = $status;
            $po->save();
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
        return DB::select('SELECT ri.*, po.po_number FROM (SELECT * FROM erp_receive_inventories WHERE company_id='.$arr['company_id'].') AS ri JOIN(SELECT id, po_number FROM erp_purchase_orders) AS po ON po.id = ri.po_id LIMIT '.$arr['offset'].', '.$arr['limit'].'');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ri_data = DB::select('SELECT ri.*, po.po_number, po.po_status, po.quantity FROM (SELECT * FROM erp_receive_inventories WHERE id='.$id.')AS ri JOIN(SELECT id, po_number, po_status, quantity FROM erp_purchase_orders) AS po ON po.id = ri.po_id');
        return response()->json([
            'status' => true,
            'data' => $ri_data[0]
        ]);
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
        $ri = ErpReceiveInventory::where('id', $id)->first();
        $po = erp_purchase_order::where('id', $ri->po_id)->first();
        $po->received_qty = $po->received_qty - $ri->received_qty;
        $po->save();

        $stock = tblproduct_stockavailability::where('product_id', $po->product_id)->first();
        $stock->stock_in_hand = $stock->stock_in_hand - $ri->received_qty;
        $stock->save();
        
        ErpReceiveInventory::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Receive Inventory Delete Permanently'
        ]);
    }
}
