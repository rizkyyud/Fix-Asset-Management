<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use Illuminate\Http\Request;
use App\Models\barangIn;
use App\Models\barangIven;
use App\Models\jenisIventaris;
use App\Models\Storage;
use App\Models\Vendors;
use App\Models\Orders;
use App\Models\Label;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class Controller_BarangIn extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('barangIn');
    }

    public function create()
    {
        //
    }

    public function loadJs($id)
    {
        //
        $all = DB::table('barang_in')
            ->join('orders', 'barang_in.id_orders', '=', 'orders.id')
            ->join('barangs', 'barangs.id', '=', 'orders.id_barang')
            ->join('list_pesanan', 'list_pesanan.id', '=', 'orders.id_cart')
            ->join('IventoryId', 'IventoryId.Id', '=', 'list_pesanan.id_pemilik')
            ->select('barang_in.*', 'orders.kode as kode_order','IventoryId.Keterangan as nama','barangs.nama as nama_barang','orders.jumlah')
            ->where('barang_in.status', '=', 'Waiting')
            ->get();
        return response()->json($all);
    }

    public function historiLoad($id)
    {
        //
        $all = DB::table('barang_in')
            ->join('orders', 'barang_in.id_orders', '=', 'orders.id')
            ->select('barang_in.*', 'orders.kode as kode_order')->where('barang_in.status', '=', 'Stored')
            ->get();
        return response()->json($all);
    }

    // public function getGudang($id)
    // {
    //     //
    //     $all = DB::table('assets')
    //         ->join('kategori', 'assets.id_kategori', '=', 'kategori.id_kategori')
    //         ->join('lokasi', 'assets.id_lokasi', '=', 'lokasi.id_lokasi')
    //         ->select('assets.*', 'lokasi.nama_lokasi')->where('kategori.nama_kategori', '=', 'Gudang')
    //         ->get();
    //     return response()->json($all);
    // }

    public function detailOrd($id)
    {
        //
        $all = DB::table('pesanan')->where('id_orders', $id)
            ->join('keranjang', 'keranjang.id_cart', '=', 'pesanan.id_cart')
            ->join('order_list', 'order_list.id_cart', '=', 'pesanan.id_cart')
            ->join('vOrder', 'vOrder.id_cart', '=', 'pesanan.id_cart')
            ->join('barang_iven', 'barang_iven.id_barangIven', '=', 'pesanan.id_barangIven')
            ->join('vendors', 'vendors.id_vendor', '=', 'pesanan.id_vendor')
            ->select('pesanan.*', 'keranjang.nama_pemesan', 'order_list.nama_cek', 'vOrder.nama_valid', 'barang_iven.nama_barang', 'vendors.nama_vendor')
            ->first();
        return response()->json($all);
    }

    public function loadKode($id)
    {
        $kode = DB::table('orders')->where('orders.id', $id)
            ->join('barangs', 'barangs.id', '=', 'orders.id_barang')
            ->select('barangs.*', 'orders.id_assets', 'orders.id_sub')
            ->get();
        return response()->json($kode);
    }

    public function loadAssets($id)
    {
        $all = DB::table('assets')
            ->join('lokasi', 'lokasi.id_lokasi', '=', 'assets.id_lokasi')
            ->join('sub_lokasi', 'sub_lokasi.id_subL', '=', 'assets.id_subLokasi')
            ->join('kategori', 'kategori.id_kategori', '=', 'assets.id_kategori')
            ->select('assets.*', 'lokasi.nama_lokasi', 'sub_lokasi.nama_subL', 'kategori.nama_kategori')->where('kategori.id_kategori', '=', '9')
            ->get();
        return response()->json($all);
    }
    public function store(Request $request)
    {
        //

    }

    public static function kode($kode)
    {
        $now = Carbon::now();
        $bln = $now->month;
        $year = $now->year;
        $count = Storage::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $bln)
            ->count();
        $thnBulan = $now->year . $bln;
        $nomor = ($count + 1);
        $format = null;

        if ($count < 9 && $count >= 0) {
            $format = '0000' . $nomor;
        } else if ($count < 99 && $count >= 10) {
            $format = '000' . $nomor;
        } else if ($count < 999 && $count >= 100) {
            $format = '00' . $nomor;
        } else if ($count < 9999 && $count >= 1000) {
            $format = '0' . $nomor;
        } else {
            $format = $nomor;
        }
        $kode_order = $thnBulan . "/" .  $format;
        return $kode_order;
    }

    public function label($jlh, $kode)
    {
        $nomor = DB::table('labels')->where('kode_label', 'like', '%' . $kode . '%')->count();
        $label = array();

        for ($i = 0; $i < $jlh; $i++) {
            $nomor++;
            if ($nomor <= 9 && $nomor >= 0) {
                $format = '00' . $nomor;
            } else if ($nomor <= 99 && $nomor >= 10) {
                $format = '0' . $nomor;
            } else {
                $format = $nomor;
            }
            $labeling = $kode  . $format;
            array_push($label, $labeling);
        }

        return $label;
    }

    public function insertBarang(Request $request)
    {
        // $store = new Storage();
        $id = $request->input('orders');
        $lokasi = $request->input('asset');
        $kode = $request->input('kode');
        $kondisi = $request->input('kondisi');
        $sub = $request->input('sub');
        $pelabel = $request->input('ids');
        $barangIn = new barangIn();
        // $orders = new Order();

        if($kondisi == 0){
            $lokasi = $request->input('gudang');
            $sub = 0;
        }

        // $idBarang = DB::table('pesanan')->where('id_orders', $id)->pluck('id_barangIven')->first();
        // $stok = DB::table('orders')->where('id_orders', $id)->pluck('jumlah')->first();
        // $kode_barang = DB::table('barang_iven')->where('id_barangIven', $idBarang)->pluck('kode_barang')->first();
        // $jenis = DB::table('barang_iven')->where('id_barangIven', $idBarang)->pluck('id_jenisIven')->first();
        // $klas = DB::table('jenis_iventaris')->where('id_jenisIven', $jenis)->pluck('id_klasB')->first();
        $getOrd = Order::Where('id', $id)->first();

        // $kodeInv = "INV/" . $this->kode($kode);

        $label = $this->label($getOrd->jumlah, $kode);
        // $store->id_orders = $id;
        // $store->kode_iventori = $kode;
        // $store->stok = $getOrd->jumlah;
        // $store->sisa = $stok;
        // $store->save();

        // $idIven = DB::table('storage')->where('id_orders', $id)->pluck('id')->first();


        for ($i = 0; $i < count($label); $i++) {
            $labeling = new Label();
            $labeling->kode_label = $label[$i];
            // $labeling->id_storage = $idIven;
            $labeling->id_lokasi = $lokasi;
            $labeling->id_subAsset = $sub;
            // $labeling->id_pesanan = $id;
            $labeling->jlh = 1;
            $labeling->valid = 1;
            $labeling->id_orders = $id;
            $labeling->status = "Ready";
            $labeling->id_pelabel = $pelabel;
            $labeling->save();
        }

        // $orders->where('id', $id)->update([
        //     'status' => "9",
        // ]);

        $barangIn->where('id_orders', $id)->update([
            'status' => "Stored",
        ]);

        return response()->json(['success' => 'Barang Telah Disimpan!']);
    }

    public function gudangIn(Request $request)
    {
        $store = new Storage();
        // $store->id_orders = $id;
        // $store->kode_iventori = "sadadsa";
        // $store->id_orders = $request->input('orders');
        // $store->status = $request->input('lokasi');
        $store->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function iventaris($id)
    {
        $model = DB::table('pesanan')->where('id_orders', $id)->pluck('model')->first();
        $merk = DB::table('pesanan')->where('id_orders', $id)->pluck('merk')->first();
        $warna = DB::table('pesanan')->where('id_orders', $id)->pluck('warna')->first();
    }

    public function getBarangIn($id)
    {

        $jenis = DB::table('pesanan')->where('id_orders', $id)->pluck('id_jenisIven')->first();
        $data = DB::table('vendors')->where('jenis', 'like', "%" . $jenis . "%")->get();
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
