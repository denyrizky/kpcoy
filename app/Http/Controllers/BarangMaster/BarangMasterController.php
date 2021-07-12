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
         $master->kode_barang = $request->kode_barang;
         $master->nama_barang = $request->nama_barang;
         $master->stok = $request->stok;
         $master->harga = $request->harga;
         $master->harga_satuan = $request->harga_satuan;
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
        $data = BarangMaster::findOrFail($id);

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

        $master = BarangMaster::findOrFail($id);
        $master->kode_barang = $request->kode_barang;
        $master->nama_barang = $request->nama_barang;
        $master->stok = $request->stok;
        $master->harga = $request->harga;
        $master->harga_satuan = $request->harga_satuan;

        $master->save();
       
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
