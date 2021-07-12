<?php

namespace App\Http\Controllers\BarangMaster;

use App\BarangMaster;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarangMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master = BarangMaster::latest()->get();

        return view('BarangMaster.index', compact('master'));
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
        $master = new BarangMaster();
         $master->kode_barang = $request->item_code;
         $master->nama_barang = $request->name;
         $master->stok = $request->quantity;
         $master->harga = $request->price;
         $master->harga_satuan = $request->price_per_item;
         $master->save();
 
         return response()->json(['status' => 200, 'message' => 'Success', 'data' => $master], 200);
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
        $commodity = BarangMaster::findOrFail($id);

        // print_r($commodity);
        // exit; 

        // echo $commodity;
        // exit;

        $data = [
            'id_barang' => $commodity['id_barang'],
            'kode_barang' => $commodity['kode_barang'],
            'nama_barang' => $commodity['nama_barang'],
            'stok' => $commodity['stok'],
            'created_at' => $commodity['created_at'],
            'updated_at' => $commodity['updated_at'],
            'stok' => $commodity['stok'],
            'harga' => $commodity['harga'],
            'harga_satuan' => $commodity['harga_satuan'],
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
        $master = BarangMaster::findOrFail($id);



        $data = [

            'kode_barang' => $master['kode_barang'],
            'nama_barang' => $master['nama_barang'],
            'stok' => $master['stok'],
            'created_at' => $master['created_at'],
            'updated_at' => $master['updated_at'],
            'stok' => $master['stok'],
            'harga' => $master['harga'],
            'harga_satuan' => $master['harga_satuan'],
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
    public function update($id, Request $request, BarangMaster $master)
    {

        //  $request->validate([
        //     'kode_barang' => 'required',
        //     'nama_barang' => 'required',
        //     'stok' => 'required',
        //     'harga' => 'required',
        //     'harga_satuan' => 'required',
        // ]);
        $master = BarangMaster::where('id_barang', $request->get('id'))
        ->update([
            'kode_barang' => $request->get('item_code_edit'),
            'nama_barang' => $request->get('name_edit'),
            'stok' => $request->get('quantity_edit'),
            'harga' => $request->get('price_edit'),
            'harga_satuan' => $request->get('price_per_item_edit'),

        ]);
        // $post = $request->all();

        // // echo ;
        // // exit;

        // // echo $id;
        // $master->findOrFail($id); // WHERE / cari data berdasarkan ID 
        // // print_r($request->all());

        // $master->kode_barang = $post['item_code_edit'];
        // $master->nama_barang = $post['name_edit'];
        // $master->stok = $post['quantity_edit'];
        // $master->harga = $post['price_edit'];
        // $master->harga_satuan = $post['price_per_item_edit'];

        // // SET setiap field berdasarkan inputan data

        // $master->save(); // Execute Query
        return response()->json(['status' => 200, 'message' => 'Success'], 200);

        // cari aja di dokumentasi Laravel, namanya DB Eloquent (CRUD, JOIN, ETC)
        // PAHAM? paham disini nya da kata kao tea kopas kopas semua jadi dikira ga usah pake cara lain :'u
        // kan kata saya ge copas ada seni nya yamaap
        // ceuk si Musa mah 'SENI NGOKOP'kela ngke iye di presentasiken ke aya komentar iye :'v
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BarangMaster::findOrFail($id)->delete();

        return response()->json(['status' => 200, 'message' => 'Success'], 200);
    }
}
