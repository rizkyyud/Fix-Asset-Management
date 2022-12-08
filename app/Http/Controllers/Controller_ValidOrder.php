<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\barangIven;
use App\Models\jenisIventaris;
use App\Models\Vendors;
use App\Models\Orders;
use App\Models\BarangIn;
use App\Models\Assets;
use App\Models\Keranjang;
use App\Models\Merk;
use App\Models\ModelB;
use App\Models\ValidOrder;
use App\Models\vOrder;
use App\Models\Warna;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Controller_ValidOrder extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $barang = barangIven::get();
        $vendors = Vendors::get();
        $jenis = jenisIventaris::get();
        $cart = Keranjang::get();
        $model = ModelB::get();
        $merk = Merk::get();
        $warna = Warna::get();
        $validOrder = ValidOrder::get();
        $orders = Orders::orderBy('id_orders', 'DESC')->get();
        // $all = DB::table('keranjang')
        //     ->join('order_list', 'order_list.id_cart', '=', 'keranjang.id_cart')
        //     ->join('pesanan', 'keranjang.id_cart', '=', 'pesanan.id_cart')
        //     ->select('keranjang.*', 'pesanan.*', 'order_list.*')
        //     ->get();
        $tes = DB::table('keranjang')
            // ->join('vorder', 'keranjang.id_cart', '=', 'vorder.id_cart')
            // ->join('pesanan', 'keranjang.id_cart', '=', 'pesanan.id_cart')
            ->join('vOrder', 'vOrder.id_cart', '=', 'keranjang.id_cart')
            ->select('keranjang.*', 'vOrder.*')
            ->get();
        return view('validOrder', [
            'barang' => $barang,
            'jenis' => $jenis,
            'orders' => $orders,
            'vendors' => $vendors,
            'cart' => $cart,
            'validO' => $tes,
            'model' => $model,
            'merk' => $merk,
            'warna' => $warna,
        ]);
    }

    public function approve($id)
    {
        $triger = 0;
        $orders = new Orders;
        $cart = new Keranjang();
        $list = Request()->get('items');
        $namas = Request()->get('namas');
        $ids = Request()->get('ids');
        $divisi = Request()->get('divisi');
        foreach ($list as  $item) {
            $orders->where('id_orders', $item)->update([
                'status' => "Approve",
                'keterangan' => null
            ]);
        }
        $set = DB::table('pesanan')->where('id_cart', $id)->get();
        foreach ($set as $cekList) {
            if ($cekList->status == "Request" || $cekList->status == "Revisi") {
                $triger = 1;
            }
        }
        if ($triger == 0) {
            $cart->where('id_cart', $id)->update([
                'status' => "Validate",
            ]);
        }

        $valid = new ValidOrder();
        $valid->where('id_cart', $id)->update([
            'id_validator' => $ids,
            'nama_valid' => $namas,
            'divisi_valid' => $divisi,
        ]);

        return response()->json(['success' => 'Validation updated successfully']);
    }

    public function reject($id)
    {
        $triger = 2;
        $orders = new Orders;
        $cart = new Keranjang();
        $list = Request()->get('items');
        // $match = ['id_cart' => $id, 'status' => 'Request'];
        $alasan = Request()->get('alasan');
        $namas = Request()->get('namas');
        $ids = Request()->get('ids');
        $divisi = Request()->get('divisi');
        foreach ($list as  $item) {
            $orders->where('id_orders', $item)->update([
                'status' => "Reject",
                'keterangan' => $alasan
            ]);
        }
        $set = DB::table('pesanan')->where('id_cart', $id)->get();
        foreach ($set as $cekList) {
            if ($cekList->status == "Waiting" || $cekList->status == "Request" || $cekList->status == "Revisi") {
                $triger = 1;
            } else {
                $triger == 0;
            }
        }
        if ($triger == 0) {
            $cart->where('id_cart', $id)->update([
                'status' => "Validate",
            ]);
        }
        $valid = new ValidOrder();
        $valid->where('id_cart', $id)->update([
            'id_validator' => $ids,
            'nama_valid' => $namas,
            'divisi_valid' => $divisi,
        ]);
        return response()->json(['success' => 'Data Berhasil Dirubah!']);
    }
    public function cancel($id)
    {
        $namas = Request()->get('namas');
        $ids = Request()->get('ids');
        $divisi = Request()->get('divisi');
        $orders = new Orders;
        $cart = new Keranjang();
        $list = Request()->get('items');
        foreach ($list as  $item) {
            $orders->where('id_orders', $item)->update([
                'status' => "Revisi",
            ]);
        }
        $cart->where('id_cart', $id)->update([
            'status' => "Revisi",
        ]);
        // $orders->where('id_cart', $id)->update([
        //     'status' => "Request",
        // ]);
        $valid = new ValidOrder();
        $valid->where('id_cart', $id)->update([
            'id_validator' => $ids,
            'nama_valid' => $namas,
            'divisi_valid' => $divisi,
        ]);
        return response()->json(['success' => 'Data Berhasil Dirubah!']);
    }
}
