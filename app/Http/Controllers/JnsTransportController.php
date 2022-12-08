<?php

namespace App\Http\Controllers;

use App\Models\dataSupir;
use App\Models\jenisBBM;
use App\Models\jnsTransport;
use App\Models\statusSupir;
use AssetsT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JnsTransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('transport');
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
     * @param  \App\Models\jnsTransport  $jnsTransport
     * @return \Illuminate\Http\Response
     */
    public function show(jnsTransport $jnsTransport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jnsTransport  $jnsTransport
     * @return \Illuminate\Http\Response
     */
    public function edit(jnsTransport $jnsTransport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jnsTransport  $jnsTransport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jnsTransport $jnsTransport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jnsTransport  $jnsTransport
     * @return \Illuminate\Http\Response
     */
    public function destroy(jnsTransport $jnsTransport)
    {
        //
    }

    public function getJnsTrnsprt()
    {
        $assetsB = DB::table('jns_transports')
            ->get();
        return response()->json($assetsB);
    }

    public function getJnsById($id)
    {
        $assetsB = DB::table('jns_transports')
            ->where('id', $id)
            ->get();
        return response()->json($assetsB);
    }

    public function jnsKdrIn(Request $request)
    {
        $jns = $request->input('jns');
        $penumpang = $request->input('penumpang');
        $jnsIn = new jnsTransport();
        $jnsIn->jns_kendaraan = $jns;
        $jnsIn->max_penumpang = $penumpang;
        $jnsIn->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function jnsKdrEdit(Request $request)
    {
        $jns = $request->input('jns');
        $id = $request->input('id');
        $penumpang = $request->input('penumpang');
        $jnsIn = new jnsTransport();
        $jnsIn->where('id', $id)->update([
            'jns_kendaraan' => $jns,
            'max_penumpang' => $penumpang

        ]);
        return response()->json(['success' => 'Data Berhasil Dirubah!']);
    }

    public function jnsKdrDel(Request $request)
    {

        $id = $request->input('id');
        $jnsIn = new jnsTransport();
        $jnsIn->where('id', $id)->delete();
        return response()->json(['success' => 'Data Berhasil Dihapus!']);
    }

    public function supirIn(Request $request)
    {
        $supir = $request->input('supir');
        $status = $request->input('status');
        $tarif = $request->input('tarif');
        $supirIn = new dataSupir();
        $supirIn->nama_supir = $supir;
        $supirIn->status = $status;
        $supirIn->tarif = $tarif;
        $supirIn->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function statusIn(Request $request)
    {
        $status = $request->input('status');
        $statusIn = new statusSupir();
        $statusIn->status = $status;
        $statusIn->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function BBmIn(Request $request)
    {
        $jenis = $request->input('jenis');
        $harga = $request->input('harga');
        $bbm = new jenisBBM();
        $bbm->jenis_bbm = $jenis;
        $bbm->harga = $harga;
        $bbm->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function supirEdit(Request $request)
    {
        $supir = $request->input('supir');
        $id = $request->input('id');
        $status = $request->input('status');
        $tarif = $request->input('tarif');
        $supirIn = new dataSupir();
        $supirIn->where('id', $id)->update([
            'nama_supir' => $supir,
            'status' => $status,
            'tarif' => $tarif
        ]);
        return response()->json(['success' => 'Data Berhasil Dirubah!']);
    }

    public function statusEdit(Request $request)
    {
        $status = $request->input('supir');
        $id = $request->input('id');
        $statusIn = new statusSupir();
        $statusIn->where('id', $id)->update([
            'status' => $status,
        ]);
        return response()->json(['success' => 'Data Berhasil Dirubah!']);
    }

    public function bbmEdit(Request $request)
    {
        $jenis = $request->input('jenis');
        $id = $request->input('id');
        $harga = $request->input('harga');
        $bbm = new jenisBBM();
        $bbm->where('id', $id)->update([
            'jenis_bbm' => $jenis,
            'harga' => $harga
        ]);
        return response()->json(['success' => 'Data Berhasil Dirubah!']);
    }

    public function supirDel(Request $request)
    {

        $id = $request->input('id');
        $supirIn = new dataSupir();
        $supirIn->where('id', $id)->delete();
        return response()->json(['success' => 'Data Berhasil Dihapus!']);
    }

    public function statusDel(Request $request)
    {

        $id = $request->input('id');
        $status = new statusSupir();
        $status->where('id', $id)->delete();
        return response()->json(['success' => 'Data Berhasil Dihapus!']);
    }

    public function bbmDel(Request $request)
    {

        $id = $request->input('id');
        $jenis = new jenisBBM();
        $jenis->where('id', $id)->delete();
        return response()->json(['success' => 'Data Berhasil Dihapus!']);
    }

    public function getSupir()
    {
        $assetsB = DB::table('data_supirs')
            ->join('status_supir', 'status_supir.id', '=', 'data_supirs.status')
            ->select('data_supirs.*', 'status_supir.status as nama_status')
            ->get();
        return response()->json($assetsB);
    }

    public function getStatus()
    {
        $assetsB = DB::table('status_supir')
            ->get();
        return response()->json($assetsB);
    }

    public function getBBM()
    {
        $assetsB = DB::table('jenis_bbm')
            ->get();
        return response()->json($assetsB);
    }

    public function getSupirById($id)
    {
        $assetsB = DB::table('data_supirs')
            ->where('id', $id)
            ->get();
        return response()->json($assetsB);
    }

    public function getStatusById($id)
    {
        $assetsB = DB::table('status_supir')
            ->where('id', $id)
            ->get();
        return response()->json($assetsB);
    }

    public function getBBmById($id)
    {
        $assetsB = DB::table('jenis_bbm')
            ->where('id', $id)
            ->get();
        return response()->json($assetsB);
    }
}
