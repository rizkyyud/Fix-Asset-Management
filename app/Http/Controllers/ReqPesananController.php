<?php

namespace App\Http\Controllers;

use App\Models\listPesan;
use App\Models\Order;
use App\Models\Pembelian;
use App\Models\ReqPesan;
use App\Models\ReqPesanan;
use App\Models\ValidOrd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReqPesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('list_pesanan');
    }

    public function show()
    {

        $list = DB::table('req_pesanans')->where('status', '!=', 'Validate')
            ->Where('status', '!=', 'Pembelian')
            ->join('list_pesanan', 'list_pesanan.id', '=', 'req_pesanans.id_cart')
            ->join('IventoryId', 'IventoryId.Id', '=', 'list_pesanan.id_pemilik')
            ->select('list_pesanan.*', 'IventoryId.Keterangan as nama', 'req_pesanans.created_at as tanggal')
            ->get();
        return response()->json($list);
    }

    public function history($id)
    {

        $list = DB::table('req_pesanans')->where('status', '=', 'Validate')
            ->join('list_pesanan', 'list_pesanan.id', '=', 'req_pesanans.id_cart')
            ->join('IventoryId', 'IventoryId.Id', '=', 'list_pesanan.id_pemilik')
            ->select('list_pesanan.*', 'IventoryId.Keterangan as nama', 'req_pesanans.created_at as tanggal')
            ->get();
        return response()->json($list);
    }

    public function historyByPas($id)
    {

        $list = DB::table('req_pesanans')
            ->orWhere('status', '=', 'Pembelian')
            ->join('list_pesanan', 'list_pesanan.id', '=', 'req_pesanans.id_cart')
            ->join('IventoryId', 'IventoryId.Id', '=', 'list_pesanan.id_pemilik')
            ->select('list_pesanan.*', 'IventoryId.Keterangan as nama', 'req_pesanans.created_at as tanggal')
            ->get();
        return response()->json($list);
    }

    public function getItem($id)
    {
        $item = DB::table('orders')->where('id', $id)->first();
        return response()->json($item);
    }

    public function cekUp($id)
    {
        $order = new Order();
        $order->where('id', $id)->update([
            'id_vendor' => Request()->input('vendor'),
            'harga' => Request()->input('harga'),
            'cekData' => '2',
            'status' => 'Verified'
        ]);

        // $id_cart = $order->where('id', $id)->pluck('id_cart')->first();
        $id_cart = DB::table('orders')->where('id', $id)->pluck('id_cart')->first();
        $triger = 0;
        $cek = DB::table('orders')->where('id_cart', $id_cart)->get();
        foreach ($cek as $cekList) {
            if ($cekList->cekData == 1) {
                $triger = 1;
            }
        }
        if ($triger == 0) {
            $list = new listPesan();
            $list->where('id', $id_cart)->update(
                [
                    'status' => 'Verified'
                ]
            );
        }
        return response()->json(['success' => 'Data Berhasil Di Verifikasi!']);
    }

    public function reqValidasi($id)
    {
        $reqPesan = new ReqPesanan();
        $reqPesan->where('id_cart', $id)->update([
            'id_checker' => Request()->input('ids')
        ]);


        // $id_cart = DB::table('req_pesanans')->where('id', $id)->pluck('id_cart')->first();
        $list = new listPesan();
        $list->where('id', $id)->update(
            [
                'status' => 'Menunggu Validasi'
            ]
        );

        $validOrd = new ValidOrd();
        $validOrd->id_cart = $id;
        $validOrd->id_validator = 0;
        $validOrd->save();
        return response()->json(['success' => 'Data Berhasil Masuk Antrian Validasi!']);
    }

    public function beli($id)
    {
        $orders = new Order();
        $beli = new Pembelian();
        $cart = new listPesan();

        $match = ['id_cart' => $id, 'status' => 'Approve'];
        $fix = DB::table('orders')->where($match)->get();
        foreach ($fix as $cek) {

            $beli->id_orders = $cek->id;
            $beli->save();

            $orders->where('id', $cek->id)->update([
                'status' => "Pembelian",
            ]);

            $cart->where('id', $id)->update([
                'status' => "Pembelian",
            ]);
        }
        return response()->json(['success' => 'Sudah Tercatat di Pembelian!']);
    }
}
