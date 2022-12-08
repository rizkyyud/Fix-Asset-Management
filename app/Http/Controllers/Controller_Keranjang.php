<?php

namespace App\Http\Controllers;

use App\Models\barangIven;
use App\Models\jenisIventaris;
use App\Models\Keranjang;
use App\Models\Merk;
use App\Models\ModelB;
use App\Models\Orders;
use App\Models\Vendors;
use App\Models\Warna;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Controller_Keranjang extends Controller
{
    //
    public function index()
    {
        //
        $cart = Keranjang::get();
        $barang = barangIven::get();
        $vendors = Vendors::get();
        $jenis = jenisIventaris::get();
        $model = ModelB::get();
        $merk = Merk::get();
        $warna = Warna::get();
        $orders = Orders::orderBy('id_orders', 'DESC')->get();
        // dd($orders);

        return view('keranjang', [
            'cart' => $cart,
            'barang' => $barang,
            'jenis' => $jenis,
            'orders' => $orders,
            'vendors' => $vendors,
            'model' => $model,
            'merk' => $merk,
            'warna' => $warna
        ]);
    }

    function list()
    {
    }

    function add()
    {
    }

    public function store(Request $request)
    {
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
}
