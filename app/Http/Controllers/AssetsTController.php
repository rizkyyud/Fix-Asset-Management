<?php

namespace App\Http\Controllers;

use App\Models\assetsT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssetsTController extends Controller
{
    //
    public function index()
    {
        //
        return view('assetTransport');
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
        $assetsT = new AssetsT();
        $assetsT->nama_transport = $request->input('assets');
        $assetsT->jns_transports = $request->input('jenis');
        $assetsT->pemilik = $request->input('pemili');
        $assetsT->model = $request->input('model');
        $assetsT->merk = $request->input('merk');
        $assetsT->warna = $request->input('warna');
        $assetsT->nomor_plat = $request->input('nopol');
        $assetsT->nilai = $request->input('nilai');
        $assetsT->kode = $request->input('kode');
        $assetsT->nama_supir = $request->input('supir');
        $assetsT->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jnsTransport  $jnsTransport
     * @return \Illuminate\Http\Response
     */
    public function show(assetsT $jnsTransport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jnsTransport  $jnsTransport
     * @return \Illuminate\Http\Response
     */
    public function edit(assetsT $assetsT)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\assetsT  $assetsT
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, assetsT $assetsT)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\assetsT  $assetsT
     * @return \Illuminate\Http\Response
     */
    public function destroy(assetsT $assetsT)
    {
        //
    }

    public function getAssetsT()
    {
        $assetsT = DB::table('assets_t')
            ->get();
        return response()->json($assetsT);
    }

    public function getAssetsTByID($id)
    {
        $assetsT = DB::table('assets_t')
            ->where('id', $id)
            ->first();
        return response()->json($assetsT);
    }
}
