<?php

namespace App\Http\Controllers;

use App\Models\barangIven;
use App\Models\jenisIventaris;
use App\Models\KlasB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Controller_KlasB extends Controller
{
    //
    public function index()
    {
        //
        return view('KlasifikasiB');
    }

    public function loadKlsB($id)
    {
        $klasifikasi = DB::table('klasifikasi_b')->get();
        return response()->json($klasifikasi);
    }

    public function jenisLoad($id)
    {
        $all = DB::table('jenis_iventaris')
            ->select('jenis_iventaris.*')
            ->get();
        return response()->json($all);
    }

    public function barangLoad($id)
    {
        $all = DB::table('barang_iven')
            ->join('jenis_iventaris', 'jenis_iventaris.id_jenisIven', '=', 'barang_iven.id_jenisIven')
            ->select('barang_iven.*', 'jenis_iventaris.jenis_iventaris')
            ->get();
        return response()->json($all);
    }

    public function cek_Kategori($id)
    {
        $all = DB::table('barang_iven')
            ->Where('barang_iven.id_barangIven','!=',$id)
            ->join('jenis_iventaris', 'jenis_iventaris.id_jenisIven', '=', 'barang_iven.id_jenisIven')
            ->select('barang_iven.*', 'jenis_iventaris.jenis_iventaris')
            ->get();
        return response()->json($all);
    }

    public function loadBarang($id)
    {
        $all = DB::table('barangs')
            ->join('barang_iven', 'barang_iven.id_barangIven', '=', 'barangs.id_barangIven')
            ->join('jenis_iventaris', 'barang_iven.id_jenisIven', '=', 'jenis_iventaris.id_jenisIven')
            ->join('tbl_model', 'tbl_model.id', '=', 'barangs.id_model')
            ->join('tbl_merk', 'tbl_merk.id', '=', 'barangs.id_merk')
            ->join('tbl_warna', 'tbl_warna.id', '=', 'barangs.id_warna')
            ->select('barangs.*', 'barang_iven.nama_barang as kategori', 'tbl_model.model', 'tbl_merk.merk', 'tbl_warna.warna', 'jenis_iventaris.jenis_iventaris as klasifikasi')
            ->get();
        return response()->json($all);
    }

    public function jenisDrop($id)
    {
        $jenis = DB::table('jenis_iventaris')->get();
        return response()->json($jenis);
    }

    public function loadEditJ($id)
    {
        $jenis = DB::table('jenis_iventaris')->where('id_jenisIven', $id)->first();
        return response()->json($jenis);
    }

    public function loadEditKls($id)
    {
        $klas = DB::table('klasifikasi_b')->where('id', $id)->first();
        return response()->json($klas);
    }

    public function loadEditBarang($id)
    {
        $barang = DB::table('barang_iven')->where('id_barangIven', $id)->first();
        return response()->json($barang);
    }

    public function storeKlasB(Request $request)
    {
        $klasB = new KlasB;
        $klasB->klasifikasi = $request->input('kelasB');
        $klasB->label = $request->input('label');
        $klasB->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function storeJenis(Request $request)
    {
        $jenis = new jenisIventaris();
        $jenis->jenis_iventaris = $request->input('jenis');
        $jenis->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function storeBarang(Request $request)
    {
        $barang = new barangIven();
        $barang->nama_barang = $request->input('tipe');
        $barang->id_jenisIven = $request->input('jenis');
        $barang->satuan = $request->input('satuan');
        $barang->kode_barang = $request->input('kode');
        $barang->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function editKls($id)
    {
        $klasB = new KlasB();
        $klasB->where('id', $id)->update([
            'klasifikasi' => Request()->input('kelasB'),
            'label' => Request()->input('label'),
        ]);
        return response()->json(['success' => 'Data Berhasil Diubah!']);
    }

    public function jenisE($id)
    {
        $jenis = new jenisIventaris();
        $jenis->where('id_jenisIven', $id)->update([
            'jenis_iventaris' => Request()->input('jenis'),
        ]);
        return response()->json(['success' => 'Data Berhasil Diubah!']);
    }

    public function editBarang($id)
    {
        $barang = new barangIven();
        $barang->where('id_barangIven', $id)->update([
            'nama_barang' => Request()->input('barang'),
            'id_jenisIven' => Request()->input('jenis'),
            'kode_barang' => Request()->input('kode'),
            'satuan' => Request()->input('satuan'),
        ]);
        return response()->json(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroyKls($id)
    {
        //
        $klasB = new KlasB();
        $klasB->where('id', $id)->delete();
        return response()->json(['success' => 'Data Telah Tehapus!']);
    }

    public function destroyJenis($id)
    {
        //
        $jenis = new jenisIventaris();
        $jenis->where('id_jenisIven', $id)->delete();
        return response()->json(['success' => 'Data Telah Tehapus!']);
    }

    public function destroyBarang($id)
    {
        //
        $barang = new barangIven();
        $barang->where('id_barangIven', $id)->delete();
        return response()->json(['success' => 'Data Telah Tehapus!']);
    }
}
