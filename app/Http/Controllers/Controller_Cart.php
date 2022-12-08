<?php

namespace App\Http\Controllers;

use App\Models\barangIven;
use App\Models\DokOrders;
use App\Models\jenisIventaris;
use App\Models\Keranjang;
use App\Models\Merk;
use App\Models\ModelB;
use App\Models\OrderAma;
use App\Models\Orders;
use App\Models\Vendors;
use App\Models\Warna;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Controller_Cart extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('keranjang');
    }

    public function getDok($id)
    {
        $dok = DB::table('dok_orders')->where('id_orders', $id)->get();
        return response()->json($dok);
    }

    public function destroyDok($id)
    {
        //        
        $dok = new DokOrders();
        $name = DB::table('dok_orders')->where('id', $id)->pluck('nama_file')->first();
        if ($name) {
            $path = public_path('images/Orders/');
            $filename = $path . $name;
            unlink($filename);
        }       
        $dok->where('id', $id)->delete();
        return response()->json(['success' => 'Data Telah Tehapus!']);
    }

    public function storeMedia(Request $request)
    {
        $path = public_path('images/Orders/');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $orders = $request->input('ids');

        // $cekId = orders::orderBy('id_orders', 'desc')->take(1)->pluck('id_orders')->first();
        $ext = strtolower($file->getClientOriginalExtension());
        $name = trim($file->getClientOriginalName());
        $fix = "/images/Orders/" . $name;
        $file->move($path, $name);
        $dok = new DokOrders();
        $dok->id_orders = $orders;
        $dok->nama_file = $name;
        $dok->path = $fix;
        $dok->save();
        return response()->json(['success' => 'Data Telah Tersimpan!']);
    }

    public function cartIn(Request $request)
    {
        $kode = $this->kode();
        //Tutup Kode Order
        $nama = Request()->input('nama');
        $id = Request()->input('id');
        $divisi = Request()->input('divisi');

        // dd($request->all());
        $cart = new Keranjang();
        $cart->id_pemesan = $id;
        $cart->kode_cart = $kode;
        $cart->divisi_pemesan = $divisi;
        $cart->nama_pemesan = $nama;
        $cart->status = "List";
        $cart->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function add($id)
    {
        // Pembuatan Kode Order Otomatis
        $kode = $this->kode();
        //Tutup Kode Order
        $nama = Request()->input('namas');
        $divisi = Request()->input('divisi');

        // dd($request->all());
        $cart = new Keranjang();
        $cart->id_pemesan = $id;
        $cart->kode_cart = $kode;
        $cart->divisi_pemesan = $divisi;
        $cart->nama_pemesan = $nama;
        $cart->status = "List";
        $cart->save();
        return back()->with('success', 'Keranjang Berhasil Ditambah!');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // // Pembuatan Kode Order Otomatis
        // $kode = $this->kode();
        // //Tutup Kode Order


        // // dd($request->all());
        // $cart = new Keranjang();
        // $cart->id_pemesan = 0;
        // $cart->kode_cart = $kode;
        // $cart->status = "Waiting";
        // $cart->save();
        // return back()->with('success', 'Keranjang Berhasil Ditambah!');
    }

    public function list($id)
    {
        // Pembuatan Kode Order Otomatis
        $kode_order = $this->kode_order();

        // dd($request->all());
        $tes = array();
        $count = Request()->input('count');
        for ($i = 1; $i <= $count; $i++) {

            $storage = storage_path('app/temp/') . Request()->input("document$i");
            $public = public_path('images/Orders/');
            $name = 'Order_' . Request()->input("document$i");
            $path = $public . $name;
            array_push($tes, $name);
            File::move($storage, $path);
        }
        $orders = new Orders;

        $orders->id_barang = Request()->input('barang');
        $orders->id_barangIven = Request()->input('kategori');
        $orders->id_vendor = Request()->input('vendor');
        $orders->id_cart = $id;
        $orders->kode_order = $kode_order;
        $orders->jlh_barang = Request()->input('jumlah');
        $orders->harga = Request()->input('harga');
        $orders->alasan_beli = Request()->input('alasan');
        $orders->model = Request()->input('model');
        $orders->merk = Request()->input('merk');
        $orders->warna = Request()->input('warna');
        $orders->ukuran = Request()->input('ukuran');
        $orders->id_tempat = Request()->input('asset');
        $orders->id_subTem = Request()->input('sub');
        $orders->status = "List";
        $orders->foto = json_encode($tes);
        $orders->save();

        return response()->json(['success' => 'Barang Telah Ditambahkan!']);
    }

    public static function ReqList($id)
    {
        $item = DB::table('pesanan')->where('id_cart', $id)->first();
        $orders = new Orders;
        $list = new OrderAma();
        // $item->status = "Request";
        if ($item) {
            $orders->where('id_cart', $id)->update([
                'status' => "Waiting",
            ]);

            $list->id_cart = $id;
            $list->save();
            // Alert::success('Success', 'Data Berhasil Dirubah!');
            return back()->with('success', 'Permintaan Telah Dikirim !');
        } else {
            return back()->with('warning', 'Keranjang Tidak Boleh Kosong !');
        }
    }

    public static function kode_order()
    {
        $now = Carbon::now();
        $bln = $now->month;
        $year = $now->year;
        $count = Orders::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $bln)
            ->count();
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

    public static function kode()
    {
        $now = Carbon::now();
        $bln = $now->month;
        $year = $now->year;
        $count = Keranjang::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $bln)
            ->count();
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
        $kode_order = 'CRT/' . $thnBulan . '/' . $format;
        return $kode_order;
    }

    public function getItems($id)
    {
        $item = DB::table('pesanan')->where('id_cart', $id)->get();
        return response()->json($item);
    }

    public function getDetail($id)
    {
        $all = DB::table('orders')->where('orders.id', $id)
            // ->join('keranjang', 'keranjang.id_cart', '=', 'pesanan.id_cart')
            ->join('barangs', 'barangs.id', '=', 'orders.id_barang')
            ->join('tbl_model','tbl_model.id', '=','barangs.id_model')
            ->join('tbl_merk','tbl_merk.id', '=','barangs.id_merk')
            ->join('tbl_warna','tbl_warna.id', '=','barangs.id_warna')
            ->join('barang_iven', 'barang_iven.id_barangIven', '=', 'barangs.id_barangIven')
            // ->join('vendors', 'vendors.id_vendor', '=', 'pesanan.id_vendor')
            ->select('orders.*', 'barangs.nama as nama_barang', 'tbl_model.model','tbl_merk.merk','tbl_warna.warna')
            ->get();
        return response()->json($all);
    }

    public function loadCart($id)
    {
        $ids = Request()->get('ids');
        $item = DB::table('keranjang')->where('id_pemesan', $ids)->get();
        return response()->json($item);
    }

    public function nama_barang($id)
    {
        $item = DB::table('barang_iven')->where('id_barangIven', $id)->pluck('nama_barang')->first();
        return response()->json($item);
    }

    public function listBarang($id)
    {
        $item = DB::table('keranjang')->where('id_cart', $id)->first();
        return response()->json($item);
    }

    public function destroy($id)
    {
        //
        $orders = new Orders();
        $cart = new Keranjang();
        $orders->where('id_cart', $id)->delete();
        $cart->where('id_cart', $id)->delete();
        return back()->with('success', 'Keranjang Berhasil Dihapus!');
    }
}
