<?php

namespace App\Http\Controllers;

use App\Models\hargaSewa_Gedung;
use App\Models\SessionSewa;
use App\Models\tanggalSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Controller_HargaSewa extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('harga_sewa');
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

    public function getAssets($id)
    {
        // $gdg = DB::table('harga_sewaGdg')->pluck('id_assets');
        $assets = DB::table('assets')
            ->where('nama_assets', 'like','Vil'.'%')
            ->join('harga_sewaGdg', 'assets.id_assets', '=', 'harga_sewaGdg.id_assets')
            ->select('assets.id_assets', 'assets.nama_assets')
            ->groupBy('assets.id_assets','assets.nama_assets')
            ->get();

        return response()->json($assets);
    }

    public function getVilla($id)
    {
        // $gdg = DB::table('harga_sewaGdg')->pluck('id_assets');
        $assets = DB::table('assets')
            ->where('nama_assets', 'like','Vil'.'%')
            ->select('assets.id_assets', 'assets.nama_assets')
            ->groupBy('assets.id_assets','assets.nama_assets')
            ->get();

        return response()->json($assets);
    }

    public function storeGdg(Request $request)
    {
        $harga = new hargaSewa_Gedung();
        $harga->id_assets = $request->input('vila');
        $harga->harga = $request->input('harga');
        $harga->id_session = $request->input('session');
        $harga->id_tanggal = $request->input('tanggal');
        $harga->save();

        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function loadG($id)
    {
        $all = DB::table('harga_sewaGdg')
            ->join('assets', 'assets.id_assets', '=', 'harga_sewaGdg.id_assets')
            ->join('session_sewas', 'session_sewas.id', '=', 'harga_sewaGdg.id_session')
            ->select('harga_sewaGdg.*', 'assets.nama_assets', 'session_sewas.session as season')
            ->get();

        return response()->json($all);
    }

    public function getEditSession($id)
    {
        $list = DB::table('session_sewas')->where('id', '!=', $id)->get();
        return response()->json($list);
    }

    public function addSeasson(Request $request)
    {
        $seasson = Request()->input('seasson');
        $awal = Request()->input('awal');
        $akhir = Request()->input('akhir');
        $cek = Request()->input('cek');
        if ($cek == 1) {
            $awal = "";
            $akhir = "";
        }
        $role=['session' => $seasson, 'tanggal_awal' => $awal, 'tanggal_akhir' => $akhir];
        $cekData = DB::table('session_sewas')->where($role)->first();

        if(!$cekData){
            $newSession =  new SessionSewa();
            $newSession->session = $seasson;
            $newSession->tanggal_awal = $awal;
            $newSession->tanggal_akhir = $akhir;
            $newSession->save();    
        }
        return response()->json(['success' => 'Session Telah Ditambahkan!']);
        
    }

    public function editSeason($id)
    {
        $nama = Request()->input('seasson');
        $awal = Request()->input('awal');
        $akhir = Request()->input('akhir');
        $newSession =  new SessionSewa();
        $newSession->where('id', $id)->update([
            'session' => $nama,
            'tanggal_awal' => $awal,
            'tanggal_akhir' => $akhir
        ]);

        return response()->json(['success' => 'Data Berhasil Dirubah!']);
    }

    // public function editTanggal($id)
    // {
    //     $season = Request()->input('season');
    //     $awal = Request()->input('awal');
    //     $akhir = Request()->input('akhir');
    //     $newSession =  new SessionSewa();
    //     $newSession->where('id', $id)->update([
    //         'id_session' => $season,
    //         'tanggal_awal' => $awal,
    //         'tanggal_akhir' => $akhir,
    //     ]);

    //     return back()->with('success', 'Data Berhasil Dirubah!');
    // }

    public function cekTanggal($id)
    {
        $cek = DB::table('tanggal_sessions')->where('id', '!=', $id)->get();
        return response()->json($cek);
    }

    public function getSeasson($id)
    {
        // $ids = Request()->get('ids');
        $list = DB::table('session_sewas')->get();
        return response()->json($list);
    }

    public function GET_SPECIFIC_SEASON($id)
    {
        // $ids = Request()->get('ids');
        $list = DB::table('session_sewas')->where('id', $id)->first();
        return response()->json($list);
    }

    public function GET_SPECIFIC_TANGGAL($id)
    {
        $list = DB::table('tanggal_sessions')->where('id', $id)->first();
        return response()->json($list);
    }

    public function deleteSeason($id)
    {
        $season = new SessionSewa();
        $season->where('id', $id)->delete();
        return response()->json(['success' => 'Data Telah Tehapus!']);
    }

    public function deleteSewa($id)
    {
        $data = new hargaSewa_Gedung();
        $data->where('id', $id)->delete();
        return response()->json(['success' => 'Data Telah Tehapus!']);
    }

    public function getRangeSession($id)
    {
        // $ids = Request()->get('ids');
        $list = DB::table('tanggal_sessions')->where('id_session', $id)->get();
        return response()->json($list);
    }

    public function getTanggal($id)
    {
        // $ids = Request()->get('ids');
        $list = DB::table('tanggal_sessions')
            ->join('session_sewas', 'session_sewas.id', '=', 'tanggal_sessions.id_session')
            ->select('tanggal_sessions.*', 'session_sewas.session as nama_session')
            ->get();
        return response()->json($list);
    }

    public function destroy($id)
    {
        //
        $harga = new hargaSewa_Gedung();
        $harga->where('id_assets', $id)->delete();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }
}
