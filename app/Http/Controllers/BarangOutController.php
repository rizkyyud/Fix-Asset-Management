<?php

namespace App\Http\Controllers;

use App\Models\BarangOut;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('barangOut');
    }

    public function getLabel($id)
    {
        $label = DB::table('barang_label')->where('status', 'Ready')->get();
        return response()->json($label);
    }

    public function getBarangOut($id)
    {
        $Bo = DB::table('pindah_barang')
            // ->where('pindah_barang.id_formAsset', $id)
            // ->join('assets', 'assets.id_assets', '=', 'pindah_barang.id_formAsset')
            // ->join('sub_assets', 'sub_assets.id', '=', 'barang_keluar.id_Subasset')
            ->select('pindah_barang.*')
            ->get();
        return response()->json($Bo);
    }

    public function getAsset($id)
    {
        $all = DB::table('assets')
            ->join('lokasi', 'lokasi.id_lokasi', '=', 'assets.id_lokasi')
            ->join('sub_lokasi', 'sub_lokasi.id_subL', '=', 'assets.id_subLokasi')
            ->join('kategori', 'kategori.id_kategori', '=', 'assets.id_kategori')
            ->select('assets.*', 'lokasi.nama_lokasi', 'sub_lokasi.nama_subL', 'kategori.nama_kategori')->where('kategori.nama_kategori', '!=', 'Gudang')
            ->get();
        return response()->json($all);
    }

    public function setBarangOut(Request $request)
    {

        $label = new Label();
        $kode = $request->input('label');
        $assets = $request->input('assets');
        $sub = $request->input('sub');
        $gudang = $request->input('gudang');
        $id = $request->input('ids');
        // $panjangAsset = count($assets);
        // for($i =0;$i<$kode)

        for ($j = 0; $j < count($kode[0]); $j++) {
            $barangOut = new BarangOut();
            $kodeOrd = $kode[0][$j];
            $label->where('kode_label', $kodeOrd)->update([
                'status' => 'Use',
                'id_lokasi' => $assets,
                'id_subAsset' => $sub,
                'valid' => 0,
            ]);
            $barangOut->kode_label = $kodeOrd;
            $barangOut->id_fromAsset = $gudang;
            $barangOut->id_fromSub = 0;
            $barangOut->id_toAsset = $assets;
            $barangOut->id_toSub = $sub;
            $barangOut->status = "Waiting";
            $barangOut->id_pemindah = $id;
            $barangOut->id_penerima = 0;
            $barangOut->save();
        }
        return response()->json($kode);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangOut  $barangOut
     * @return \Illuminate\Http\Response
     */
    public function show(BarangOut $barangOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangOut  $barangOut
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangOut $barangOut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangOut  $barangOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangOut $barangOut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangOut  $barangOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(BarangOut $barangOut)
    {
        //
    }
}
