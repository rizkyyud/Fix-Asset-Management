<?php

namespace App\Http\Controllers;

use App\Models\BarangIn;
use App\Models\barangIven;
use App\Models\listPesan;
use App\Models\Merk;
use App\Models\ModelB;
use App\Models\Order;
use App\Models\Orders;
use App\Models\Pembelian;
use App\Models\ReqPesanan;
use App\Models\ValidOrd;
use App\Models\Vendors;
use App\Models\Warna;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Controller_Pembelian extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pembelianB');
    }

    public function loadPembelian()
    {
        $pembelian = DB::table('pembelian')
            ->join('orders', 'orders.id', '=', 'pembelian.id_orders')
            ->join('barangs', 'barangs.id', '=', 'orders.id_barang')
            ->join('list_pesanan', 'list_pesanan.id', '=', 'orders.id_cart')
            ->join('IventoryId', 'IventoryId.Id', '=', 'list_pesanan.id_pemilik')
            ->select('pembelian.*', 'orders.kode','barangs.nama as nama_barang','IventoryId.Keterangan as nama','orders.jumlah','orders.harga','orders.id as orderId','orders.status')
            ->get();
        return response()->json($pembelian);
    }

    public function detailPembelian()
    {
        $pembelian = DB::table('pembelian_rekap')->get();
        return response()->json($pembelian);
    }

    public static function kode()
    {
        $now = Carbon::now();
        $bln = $now->month;
        $year = $now->year;
        $count = listPesan::orderBy('id', 'desc')
            ->pluck('id')
            ->first();
        $thnBulan = $now->year . $bln;
        $nomor = ($count + 1);
        $format = null;

        if ($count <= 9 && $count >= 0) {
            $format = '000' . $nomor;
        } else if ($count <= 99 && $count >= 10) {
            $format = '00' . $nomor;
        } else if ($count <= 999 && $count >= 100) {
            $format = '0' . $nomor;
        } else {
            $format = $nomor;
        }
        $kode_order = 'CRT/' . $thnBulan . '/' . $format;
        return $kode_order;
    }

    public static function kode_order()
    {
        $now = Carbon::now();
        $bln = $now->month;
        $year = $now->year;
        $count = Order::orderBy('id', 'desc')
            ->pluck('id')
            ->first();
        $thnBulan = $now->year . $bln;
        $nomor = ($count + 1);
        $format = null;

        if ($count <= 9 && $count >= 0) {
            $format = '000' . $nomor;
        } else if ($count <= 99 && $count >= 10) {
            $format = '00' . $nomor;
        } else if ($count <= 999 && $count >= 100) {
            $format = '0' . $nomor;
        } else {
            $format = $nomor;
        }
        $kode_order = 'ORD/' . $thnBulan . '/' . $format;
        return $kode_order;
    }

    public function addItem(Request $request)
    {
        // $id_cart = DB::table('cart')->order_by('id', 'desc')->pluck('id')->first();
        $kode_order = $this->kode_order();
        $pesan = new Order();
        $pesan->id_barang = $request->input('barang');
        $pesan->jumlah = $request->input('jumlah');
        $pesan->alasan = $request->input('alasan');
        $pesan->harga = $request->input('harga');
        $pesan->id_assets = $request->input('asset');
        $pesan->id_sub = $request->input('sub');
        $pesan->id_cart = 0;
        $pesan->cekData = 99;
        $pesan->kode = $kode_order;
        $pesan->id_vendor = $request->input('vendor');
        $pesan->id_pemilik = $request->input('ids');
        $pesan->tgl_beli = $request->input('tglBeli');

        $pesan->status = "List Pembelian";
        $pesan->save();

        return response()->json(['success' => 'Barang Telah Ditambahkan Kedalam List']);
    }

    public function listPenambahan($id)
    {
        $match = ['orders.cekData' => '99', 'id_pemilik' => $id];
        $pembelian = DB::table('orders')->where($match)
            ->join('barangs', 'barangs.id', '=', 'orders.id_barang')
            ->select('orders.*', 'barangs.nama as nama_barang')
            ->get();
        return response()->json($pembelian);
    }

    public function reqPesanan(Request $request)
    {
        $kode = $this->kode();
        $id = Request()->input('ids');

        $list = new listPesan();
        $list->id_pemilik = $id;
        $list->kode = $kode;
        $list->status = "Pembelian";
        $list->save();

        // $id_cart = DB::table('cart')->order_by('id', 'desc')->pluck('id')->first();
        $id_cart = DB::table('list_pesanan')->orderByDesc('id')->pluck('id')->first();
        $beli = new Pembelian();
        $barangIn = new BarangIn();

        $req = new ReqPesanan();
        $req->id_cart = $id_cart;
        $req->id_checker = $id;
        $req->save();

        $valid = new ValidOrd();
        $valid->id_cart = $id_cart;
        $valid->id_validator = $id;
        $valid->save();

        $pesan = new Order();

        $match = ['orders.cekData' => '99', 'orders.id_pemilik' => $id];
        $getBarang = Order::Where($match)->get();

        for ($i = 0; $i < count($getBarang); $i++) {
            

            $beli->id_orders = $getBarang[$i]->id;
            $beli->save();

            $barangIn->id_orders = $getBarang[$i]->id;
            $barangIn->status = 'Waiting';
            $barangIn->save();
        }

        $pesan->where([

            ['orders.cekData', '=', '99'],

            ['orders.id_pemilik', '=', $id]

        ])->update([
            'id_cart' => $id_cart,
            'cekData' => 8,
            'status' => 'Pembelian',
            
        ]);

        return response()->json(['success' => 'Pesanan Telah Masuk Pembelian, Silhakan Cek List Pembelian!']);
    }
}
