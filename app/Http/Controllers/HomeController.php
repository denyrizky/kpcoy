<?php

namespace App\Http\Controllers;

use App\Commodity;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $commodity_count = Commodity::count();

        $commodity_condition_good_count = Commodity::where('condition', 1)->count();
        $commodity_condition_not_good_count = Commodity::where('condition', 2)->count();
        $commodity_condition_heavily_damage_count = Commodity::where('condition', 3)->count();

        $commodity_order_by_price = Commodity::orderBy('price', 'DESC')->take(5)->get();

        return view('home', compact('commodity_order_by_price', 'commodity_count', 'commodity_condition_good_count', 'commodity_condition_not_good_count', 'commodity_condition_heavily_damage_count'));
    }

    public function getChart(){

        $thisWeek = date("Y-m-d", strtotime('monday this week'));
        $endWeek = date("Y-m-d", strtotime('sunday this week'));

        $dataIn = [];
        $dataOut = [];

        $getDataThisFirstIn = DB::table('trx_barang_fix')->selectRaw('SUM(harga_total) as `hargaTot`')->where('status',1)->where('created_at', $thisWeek)->get();
        $getDataThisFirstOut = DB::table('trx_barang_fix')->selectRaw('SUM(harga_total) as `hargaTot`')->where('status',2)->where('created_at', $thisWeek)->get();

        array_push($dataIn, array(
            'week' => $thisWeek,
            'value' => (empty($getDataThisFirstIn[0]->hargaTot) ? 0 : $getDataThisFirstIn[0]->hargaTot)
        ));

        array_push($dataOut, array(
            'week' => $thisWeek,
            'value' => (empty($getDataThisFirstOut[0]->hargaTot) ? 0 : $getDataThisFirstOut[0]->hargaTot)
        ));

        for ($i=1; $i <= 5; $i++) { 
            $next = date('Y-m-d', strtotime('+'.$i.' days '.date('Y-m-d',strtotime('monday this week'))));

            $getDataThisFirstIn = DB::table('trx_barang_fix')->selectRaw('SUM(harga_total) as `hargaTot`')->where('status',1)->where('created_at', $next)->get();
            $getDataThisFirstOut = DB::table('trx_barang_fix')->selectRaw('SUM(harga_total) as `hargaTot`')->where('status',2)->where('created_at', $next)->get();

            array_push($dataIn, array(
                'week' => $next,
                'value' => (empty($getDataThisFirstIn[0]->hargaTot) ? 0 : $getDataThisFirstIn[0]->hargaTot)
            ));
    
            array_push($dataOut, array(
                'week' => $next,
                'value' => (empty($getDataThisFirstOut[0]->hargaTot) ? 0 : $getDataThisFirstOut[0]->hargaTot)
            ));
        }

        $getDataThisFirstIn = DB::table('trx_barang_fix')->selectRaw('SUM(harga_total) as `hargaTot`')->where('status',1)->where('created_at', $endWeek)->get();
        $getDataThisFirstOut = DB::table('trx_barang_fix')->selectRaw('SUM(harga_total) as `hargaTot`')->where('status',2)->where('created_at', $endWeek)->get();

        array_push($dataIn, array(
            'week' => $endWeek,
            'value' => (empty($getDataThisFirstIn[0]->hargaTot) ? 0 : $getDataThisFirstIn[0]->hargaTot)
        ));

        array_push($dataOut, array(
            'week' => $endWeek,
            'value' => (empty($getDataThisFirstOut[0]->hargaTot) ? 0 : $getDataThisFirstOut[0]->hargaTot)
        ));

        $pass = [
            'first' => $thisWeek,
            'end' => $endWeek,
            'dataIn' => $dataIn,
            'dataOut' => $dataOut
        ];

        print_r(json_encode($pass));

    }
}
