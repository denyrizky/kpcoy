<?php

namespace App\Http\Controllers\kelola;
use App\det_barang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BarangMaster;
use App\Transaksi;
use DB;

class trx_kelola_barangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $trx = Transaksi::latest()->get();
            $data = det_barang::latest()->get();
            $show = BarangMaster::latest()->get();
            return view('det_trx_barang.index', compact('show','data','trx'));
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

        // print_r($request->all());

        $input = $request->all();

        $kodeTrx = $input['kode_trx'];
        $statTrx = $input['stat_trx'];

        $idBarang = $input['idbarang'];
        $hargaBarang = $input['hargaBarang'];
        $qtyBarang = $input['qtyBarang'];
        $jmlhHarga = $input['jmlhHarga'];

        $hargaTotal = 0;

        foreach($idBarang as $key => $id){
            $hargaTotal += $jmlhHarga[$key];
        }
        

        // QUERY
        $trx = new Transaksi();

         $trx->kode_trx = $kodeTrx;
         $trx->status = $statTrx;
         $trx->harga_total = $hargaTotal;

         $trx->save();

         $trxID = $trx->id_trx_barang;


         foreach($idBarang as $key => $id){
            $data = array(
                'ID' => $id,
                'harga' => $hargaBarang[$key],
                'qtyBarang' => $qtyBarang[$key],
                'jmlhBarang' => $jmlhHarga[$key]
            );

            $det = new det_barang();

            $det->id_trx_barang = $trxID;
            $det->id_barang = $id;
            $det->qty = $qtyBarang[$key];
            $det->harga = $hargaBarang[$key];

            $det->save();

            $check = BarangMaster::findOrFail($id);

            if(!empty($check)){
                // echo $check->nama_barang;
                // echo "<br/>";

                if($statTrx == 1){ //1 = Data Masuk

                    BarangMaster::where('id_barang', $id)
                    ->update(['stok' => $check->stok + $qtyBarang[$key]]);

                }else{ //2 = Data Keluar

                    BarangMaster::where('id_barang', $id)
                    ->update(['stok' => $check->stok - $qtyBarang[$key]]);

                }

            }



        }


         
        // END FOREACH QUERY

        // $master = BarangMaster::latest()->get();
        // $data = new det_barang();

        //  $data->id_trx_barang = $request->id_trx_barang;
        //  $data->id_barang = $request->id_barang;
        //  $data->qty = $request->qty;
        //  $data->harga = $request->harga;
        //  $data->save();

         return response()->json(['status' => 200, 'message' => 'Success', 'data' => ''], 200);
    }

    public function getDetail($id){
        
        $getData = DB::table('det_trx_barang_fix')
        ->join('master_barang', 'det_trx_barang_fix.id_barang', '=', 'master_barang.id_barang')
        ->select('det_trx_barang_fix.*', 'master_barang.kode_barang', 'master_barang.nama_barang')
        ->where('det_trx_barang_fix.id_trx_barang', $id)
        ->get();

        echo json_encode($getData);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Transaksi::findOrFail($id);

 
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
        $master = BarangMaster::latest()->get();
        $data = new det_barang();

         $data->id_trx_barang = $request->id_trx_barang;
         $data->id_barang = $request->id_barang;
         $data->qty = $request->qty;
         $data->harga = $request->harga;
         $data->save();

         return response()->json(['status' => 200, 'message' => 'Success', 'data' => $data], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Transaksi::findOrFail($id);
        
        if(!empty($del)){
            $det = DB::table("det_trx_barang_fix")->where("id_trx_barang", $id)->get();
            $statTrx = $del->status;



            foreach($det as $val){

                $check = BarangMaster::findOrFail($val->id_barang);

                // print_r($val);
                // echo "<br/>";
                if($statTrx == 1){ //1 = Data Masuk

                    BarangMaster::where('id_barang', $val->id_barang)
                    ->update(['stok' => $check->stok - $val->qty]);

                }else{ //2 = Data Keluar

                    BarangMaster::where('id_barang', $val->id_barang)
                    ->update(['stok' => $check->stok + $val->qty]);

                }

                DB::table('det_trx_barang_fix')->where('id_trx_barang', $id)->where('id_barang', $val->id_barang)->delete();
            
            }

            $del->delete();

        }


    }
}
