<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\barangIven;
use App\Models\Vendors;
use App\Models\jenisIventaris;
use App\Models\Assets;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Storage;

class Controller_Gudang extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $store = Storage::get();
        $orders = Orders::get();
        $barang = barangIven::get();
        $vendors = Vendors::get();
        $label = Label::get();
        // dd($orders);

        return view('gudang', [
            'storage' => $store,
            'orders' => $orders,
            'barang' => $barang,
            'vendors' => $vendors,
            'jenis' => $barang,
            'labels' => $label,
        ]);
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

    public function getLabel($id)
    {
        $label = DB::table('barang_label')->where('id_gudang', $id)->get();
        return response()->json($label);
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
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
