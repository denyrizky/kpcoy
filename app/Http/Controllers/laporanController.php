<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\det_barang;
use App\BarangMaster;
use DB;
class laporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('trx_barang_fix')
        ->join('det_trx_barang_fix','trx_barang_fix.id_trx_barang','=','det_trx_barang_fix.id_trx_barang')
        ->join('master_barang','master_barang.id_barang','=','det_trx_barang_fix.id_barang')
        ->select('trx_barang_fix.status','trx_barang_fix.kode_trx'
        ,'trx_barang_fix.harga_total','trx_barang_fix.created_at','trx_barang_fix.id_trx_barang','master_barang.nama_barang')
        ->distinct('id_trx_barang')
        ->get();
        // $trx = Transaksi::latest()->get();
        // $data = det_barang::latest()->get();
        // $show = BarangMaster::latest()->get();
        return view('laporan.index', compact('data'));
    }
    public function cetak($tglawal,$tglakhir,$status)
    {
        $cetak = DB::table('det_trx_barang_fix')
        ->join('trx_barang_fix','trx_barang_fix.id_trx_barang','=','det_trx_barang_fix.id_trx_barang')
        ->join('master_barang','det_trx_barang_fix.id_barang','=','master_barang.id_barang')
        ->select('trx_barang_fix.status','trx_barang_fix.kode_trx'
        ,'trx_barang_fix.harga_total','trx_barang_fix.created_at','det_trx_barang_fix.qty'
        ,'det_trx_barang_fix.harga','master_barang.nama_barang','trx_barang_fix.id_trx_barang' 
        ,)
        ->where('trx_barang_fix.created_at', '>=', date('Y-m-d', strtotime($tglawal)))
        ->where('trx_barang_fix.created_at', '<=' , date('Y-m-d', strtotime($tglakhir)))
        ->where('trx_barang_fix.status', '=' , ($status))
        ->distinct()
        ->get();
        
        // $cetak = det_barang::with('trx_barang_fix')->whereBetween('created_at',[$tglawal,$tglakhir])->get();
        return view ('laporan.cetak',compact('cetak'));

        // $cetak = DB::table('det_trx_barang_fix')->whereBetween('created_at',[$tglawal, $tglakhir])->get();
        // return view("laporan.cetak", compact('cetak'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
