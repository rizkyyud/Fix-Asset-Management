<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Controller_Label extends Controller
{
    //
    public function index()
    {
        //
        // $store = Storage::get();
        // $label = Label::get();
        // dd($orders);

        return view('labelBarang');
    }

    public function labelLoad($id)
    {
        $label = DB::table('barang_label')
            ->join('orders', 'orders.id', '=', 'barang_label.id_orders')
            ->join('barangs', 'barangs.id', '=', 'orders.id_barang')
            ->join('assets', 'assets.id_assets', '=', 'barang_label.id_lokasi')
            // ->join('lokasi', 'lokasi.id_lokasi', '=', 'assets.id_lokasi')
            // ->join('sub_assets', 'sub_assets.id', '=', 'barang_label.id_subAsset')
            // ->join('kategori', 'kategori.id_kategori', '=', 'assets.id_kategori')
            ->select('barang_label.*', 'orders.kode', 'assets.nama_assets','barangs.nama')
            ->get();
        return response()->json($label);
    }
}
