<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\listPesan;
use App\Models\Order;
use App\Models\ReqPesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pesanan');
    }

    public function allOrd()
    {
        return view('allOrder');
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

        if ($count < 9 && $count >= 0) {
            $format = '000' . $nomor;
        } else if ($count < 99 && $count >= 10) {
            $format = '00' . $nomor;
        } else if ($count < 999 && $count >= 100) {
            $format = '0' . $nomor;
        } else {
            $format = $nomor;
        }
        $kode_order = 'ORD/' . $thnBulan . '/' . $format;
        return $kode_order;
    }

    public function itemAdd(Request $request)
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
        $pesan->kode = $kode_order;
        $pesan->cekData = 0;
        $pesan->id_vendor = $request->input('vendor');
        $pesan->id_pemilik = $request->input('ids');

        $pesan->status = "List";
        $pesan->save();

        return response()->json(['success' => 'Barang Telah Ditambahkan, Silhakan Cek Keranjang!']);
    }

    public function getWishList($id)
    {
        $ids = Request()->input('ids');

        $pesan = DB::table('orders')->where([

            ['orders.cekData', '=', '0'],

            ['orders.id_pemilik', '=', $ids]

        ])
            ->join('barangs', 'barangs.id', '=', 'orders.id_barang')
            ->select('orders.*', 'barangs.nama')
            ->get();
        return response()->json($pesan);
    }

    public function getList($id)
    {
        $ids = Request()->input('ids');
        $pesan = DB::table('list_pesanan')->where('id_pemilik', $ids)
            ->get();
        return response()->json($pesan);
    }

    public function getListAll($id)
    {
        $pesan = DB::table('list_pesanan')
            ->get();
        return response()->json($pesan);
    }

    public function show(listPesan $jnsTransport)
    {
        //
    }

    public function getCartItem($id)
    {
        $item = DB::table('orders')->where('orders.id_cart', $id)
            ->join('barangs', 'barangs.id', '=', 'orders.id_barang')
            ->select('orders.*', 'barangs.nama')
            ->get();
        return response()->json($item);
    }

    public function getTotalCost($id)
    {
        $item = DB::table('orders')->where('orders.id_cart', $id)
            ->sum('harga', '*', 'jumlah');
        return response()->json($item);
    }

    public function detailOrd($id)
    {
        $item = DB::table('orders')->where('orders.id', $id)
            ->join('vendors', 'vendors.id_vendor', '=', 'orders.id_vendor')
            ->join('assets', 'assets.id_assets', '=', 'orders.id_assets')
            // ->join('sub_assets', 'sub_assets.id', '=', 'orders.id_sub')
            ->join('barangs', 'barangs.id', '=', 'orders.id_barang')
            ->join('barang_iven', 'barang_iven.id_barangIven', '=', 'barangs.id_barangIven')
            ->join('jenis_iventaris', 'barang_iven.id_jenisIven', '=', 'jenis_iventaris.id_jenisIven')
            ->join('tbl_model', 'tbl_model.id', '=', 'barangs.id_model')
            ->join('tbl_merk', 'tbl_merk.id', '=', 'barangs.id_merk')
            ->join('tbl_warna', 'tbl_warna.id', '=', 'barangs.id_warna')
            ->join('lokasi', 'lokasi.id_lokasi', '=', 'assets.id_lokasi')
            ->join('sub_lokasi', 'sub_lokasi.id_subL', '=', 'assets.id_subLokasi')
            ->select('orders.*', 'vendors.nama_vendor', 'assets.nama_assets', 'barangs.nama', 'barangs.ukuran', 'barang_iven.nama_barang as tipe', 'tbl_model.model', 'tbl_merk.merk', 'tbl_warna.warna', 'jenis_iventaris.jenis_iventaris as kategori', 'lokasi.nama_lokasi', 'sub_lokasi.nama_subL')
            ->get();
        return response()->json($item);
    }

    public function getVendor($id)
    {
        $jenis = DB::table('orders')->where('orders.id', $id)
            ->join('barangs', 'barangs.id', '=', 'orders.id_barang')
            ->join('barang_iven', 'barang_iven.id_barangIven', '=', 'barangs.id_barangIven')
            ->pluck('barang_iven.id_jenisIven')->first();
        $item = DB::table('vendors')->where('jenis', 'like', "%" . $jenis . "%")->get();
        return response()->json($item);
    }

    public function getVendorDrp($id)
    {
        $jenis = DB::table('barangs')->where('barangs.id', $id)
            ->join('barang_iven', 'barang_iven.id_barangIven', '=', 'barangs.id_barangIven')
            ->pluck('barang_iven.id_jenisIven')->first();
        $item = DB::table('vendors')->where('jenis', 'like', "%" . $jenis . "%")->get();
        return response()->json($item);
    }


    public function getSpesifikOrd($id)
    {
        $orders = DB::table('orders')->where('id', $id)->first();
        return response()->json($orders);
    }

    public function reqPesanan(Request $request)
    {
        $kode = $this->kode();
        $id = Request()->input('ids');

        $req = new listPesan();
        $req->id_pemilik = $id;
        $req->kode = $kode;
        $req->status = "List";
        $req->save();

        // $id_cart = DB::table('cart')->order_by('id', 'desc')->pluck('id')->first();
        $id_cart = DB::table('list_pesanan')->orderByDesc('id')->pluck('id')->first();

        $req = new ReqPesanan();
        $req->id_cart = $id_cart;
        $req->id_checker = 0;
        $req->save();

        $pesan = new Order();
        $pesan->where([

            ['orders.cekData', '=', '0'],

            ['orders.id_pemilik', '=', $id]

        ])->update([
            'id_cart' => $id_cart,
            'cekData' => 1,
            'status' => 'Menunggu Pengecekan'
        ]);

        return response()->json(['success' => 'Pesanan Telah Masuk Antrian, Silhakan Cek Pesanan!']);
    }

    public function destroyWish($id)
    {
        $pesan = new Order();
        $pesan->where('id', $id)->delete();
        return response()->json(['success' => 'Barang Telah Dihapus Dari Keranjang']);
    }
}
