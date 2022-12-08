<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\Sewa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Controller_Sewa extends Controller
{
    //
    public function index()
    {
        $sewa = Sewa::get();
        $asset = Assets::get();
        $gedung = DB::table('sewa_gedung')->get();
        return view('sewa', [
            'sewa' => $sewa,
            'assets' => $asset,
        ]);
    }

    public function listSewa($id)
    {
        // $ids = Request()->get('ids');
        $list = DB::table('sewa')->where('id_penyewa', $id)->get();
        return response()->json($list);
    }



    public function getGedung($id)
    {
        $item = DB::table('sewa_gedung')->where('id_sewa', $id)->get();
        return response()->json($item);
    }

    public function add($id)
    {
        // Pembuatan Kode Order Otomatis
        $kode = $this->kode();
        //Tutup Kode Order
        $nama = Request()->input('namas');
        $divisi = Request()->input('divisi');

        // dd($request->all());
        $sewa = new Sewa();
        $sewa->id_penyewa = $id;
        $sewa->kode_sewa = $kode;
        $sewa->divisi_penyewa = $divisi;
        $sewa->nama_penyewa = $nama;
        $sewa->status = "List";
        $sewa->save();
        return back()->with('success', 'Keranjang Berhasil Ditambah!');
    }

    public static function kode()
    {
        $now = Carbon::now();
        $bln = $now->month;
        $year = $now->year;
        $count = Sewa::whereYear('created_at', '=', $year)
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
        $kode_order = 'RNT/' . $thnBulan . '/' . $format;
        return $kode_order;
    }
}
