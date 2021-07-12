<?php

namespace App\Http\Controllers\BarangKeluar;

use App\BKeluar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $commodities = BKeluar::latest()->get();

        return view('barangkeluar.index', compact('commodities'));
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
        $commodities = new BKeluar();
       // $commodities->school_operational_assistance_id = 0;
        //$commodities->commodity_location_id = 0;
        $commodities->item_code = $request->item_code;
        $commodities->name = $request->name;
        // $commodities-
       // $commodities->brand = "-";
       // $commodities->material = "-";
        $commodities->created_at = date_format(date_create($request->created_at),"d-m-Y");
        //$commodities->condition = 0;
        $commodities->quantity = $request->quantity;
        $commodities->price = $request->price;
        $commodities->price_per_item = $request->price_per_item;
       // $commodities->note = "-";
        $commodities->save();

        return response()->json(['status' => 200, 'message' => 'Success', 'data' => $commodities], 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // return $id;
        // exit;
        $commodity = BKeluar::findOrFail($id);

        // print_r($commodity);
        // exit; 

        // echo $commodity;
        // exit;

        $data = [
            // 'school_operational_assistance_id' => $commodity->school_operational_assistance->name,
            // 'commodity_location_id' => $commodity->commodity_location->name,
            'Kode_Barang' => $commodity['Kode_Barang'],
            'Nama_Barang' => $commodity['Nama_Barang'],
            //'brand' => $commodity->brand,
            //'material' => $commodity->material,
            // $commodity->date_of_purchase
            'created_at' => $commodity['created_at'],
            //'condition' => $commodity->condition,
            'Qty' => $commodity['Qty'],
            'Harga' => $commodity['Harga'],
            'Harga_Satuan' => $commodity['Harga_Satuan'],
            //'note' => $commodity->note,
        ];

        return response()->json(['status' => 200, 'message' => 'Success', 'data' => $data], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commodity = BKeluar::findOrFail($id);

        $data = [
            // 'school_operational_assistance_id' => $commodity->school_operational_assistance_id,
            // 'commodity_location_id' => $commodity->commodity_location_id,
            'Kode_Barang' => $commodity->item_code,
            'Nama_Barang' => $commodity->name,
            //'brand' => $commodity->brand,
            //'material' => $commodity->material,
            'created_at' => date_format(date_create($commodity->date_of_purchase),"Y-m-d"),
            //'condition' => $commodity->condition,
            'Qty' => $commodity->quantity,
            'Harga' => $commodity->price,
            'Harga_Satuan' => $commodity->price_per_item,
            //'note' => $commodity->note,
        ];

        return response()->json(['status' => 200, 'message' => 'Success', 'data' => $data], 200);
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
