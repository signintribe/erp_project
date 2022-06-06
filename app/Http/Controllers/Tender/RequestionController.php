<?php

namespace App\Http\Controllers\Tender;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ErpRequestion;
use Auth;
use DB;
class RequestionController extends Controller
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
        return view('tender.requestion');
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
        $data = $request->except(['product']);
        $data['user_id'] = Auth::user()->id;
        ErpRequestion::create($data);
        return response()->json([
            'status'=>true,
            'message'=>'Requestion Save Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($arr)
    {
        $values = json_decode($arr, true);
        //return 'SELECT req.*, product.product_name, dept.department_name, emp.first_name FROM (SELECT * FROM erp_requestions WHERE company_id = '.$values['company_id'].') AS req LEFT JOIN(SELECT id, product_name FROM tblproduct_informations)AS product ON product.id = req.product_id LEFT JOIN(SELECT id, department_name FROM tbldepartmens)AS dept ON dept.id = req.department_id LEFT JOIN (SELECT id, first_name FROM tblemployeeinformations)AS emp on emp.id = req.resource_id limit '.$values['offset'].', '.$values['limit'].'';
        $data = DB::select('SELECT req.*, product.product_name, dept.department_name, emp.first_name FROM (SELECT * FROM erp_requestions WHERE company_id = '.$values['company_id'].') AS req LEFT JOIN(SELECT id, product_name FROM tblproduct_informations)AS product ON product.id = req.product_id LEFT JOIN(SELECT id, department_name FROM tbldepartmens)AS dept ON dept.id = req.department_id LEFT JOIN (SELECT id, first_name FROM tblemployeeinformations)AS emp on emp.id = req.resource_id limit '.$values['offset'].', '.$values['limit'].'');
        return response()->json([
            'status'=>true,
            'message'=>'All Requestion',
            'data' => $data
        ]);
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
        //
    }
}
