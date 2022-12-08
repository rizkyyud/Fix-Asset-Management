<?php

namespace App\Http\Controllers;

use App\Models\DokLokasi;
use App\Models\DokSubLokasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Lokasi;
use App\Models\Pemilik;
use App\Models\subLokasi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Contracts\DataTable;
use DataTables;

class Controller_Lokasi extends Controller
{

    public function index()
    {
        return view('lokasi');
    }

    // Lokasi Function
    public function loadLokasi($id)
    {
        $lokasi = DB::table('lokasi')->get();
        return response()->json($lokasi);
    }

    public function cekEditLok($id)
    {
        $cek = DB::table('lokasi')->where('id_lokasi', '!=', $id)->get();
        return response()->json($cek);
    }

    public function loadDokLokasi($id)
    {
        $lokasi = DB::table('dok_lokasi')->where('id_lokasi', $id)->get();
        return response()->json($lokasi);
    }

    public function lokasiIn(Request $request)
    {
        $lokasi = new Lokasi;
        $lokasi->nama_lokasi = $request->input('lokasi');
        $lokasi->alamat_lokasi = $request->input('alamat');
        $lokasi->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function loadEditLokasi($id)
    {
        $lokasi = DB::table('lokasi')->where('id_lokasi', $id)->first();
        return response()->json($lokasi);
    }

    public function editLokasi($id)
    {
        $lokasi = new Lokasi();
        $lokasi->where('id_lokasi', $id)->update([
            'nama_lokasi' => Request()->input('lokasi'),
            'alamat_lokasi' => Request()->input('alamat')
        ]);

        return response()->json(['success' => 'Data Berhasil Diubah!']);
    }

    public function storeMedia(Request $request)
    {
        $path = public_path('images/Lokasi/');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $lokasi = $request->input('ids');

        // $cekId = lokasi::orderBy('id_lokasi', 'desc')->take(1)->pluck('id_lokasi')->first();
        $ext = strtolower($file->getClientOriginalExtension());
        $name = trim($file->getClientOriginalName());
        $fix = "/images/Lokasi/" . $name;
        $file->move($path, $name);
        $dok = new DokLokasi();
        $dok->id_lokasi = $lokasi;
        $dok->nama_file = $name;
        $dok->path = $fix;
        $dok->save();
        return response()->json(['success' => 'Data Telah Tersimpan!']);
    }

    public function destroyLokasi($id)
    {
        //
        $lokasi = new Lokasi;
        $dokLok = new DokLokasi();
        $name = DB::table('dok_lokasi')->where('id', $id)->pluck('nama_file')->first();
        if ($name) {
            $path = public_path('images/Lokasi/');
            $filename = $path . $name;
            unlink($filename);
        }
        $dokLok->where('id_lokasi', $id)->delete();
        $lokasi->where('id_lokasi', $id)->delete();
        return response()->json(['success' => 'Data Telah Tehapus!']);
    }

    public function destroyDokLok($id)
    {
        //
        $lokasi = new DokLokasi();
        $name = DB::table('dok_lokasi')->where('id', $id)->pluck('nama_file')->first();
        if ($name) {
            $path = public_path('images/Lokasi/');
            $filename = $path . $name;
            unlink($filename);
        }
        $lokasi->where('id', $id)->delete();
        return response()->json(['success' => 'Data Telah Tehapus!']);
    }
    // End Function Lokasi


    // Sub Lokasi Function
    public function loadSubL($id)
    {
        $subL = DB::table('sub_lokasi')
            ->join('lokasi', 'lokasi.id_lokasi', '=', 'sub_lokasi.id_lokasi')
            ->select('sub_lokasi.*', 'lokasi.nama_lokasi')
            ->get();
        return response()->json($subL);
    }

    public function cekEditSub($id)
    {
        $cek = DB::table('sub_lokasi')->where('id_subL', '!=', $id)->get();
        return response()->json($cek);
    }

    public function sublokasiIn(Request $request)
    {
        $subL = new subLokasi();
        $subL->nama_subL = $request->input('subL');
        $subL->id_lokasi = $request->input('lokasi');
        $subL->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function loadDokSubL($id)
    {
        $subL = DB::table('dok_sub_lokasi')->where('id_subL', $id)->get();
        return response()->json($subL);
    }

    public function storeMediaSub(Request $request)
    {
        $path = public_path('images/Sub Lokasi/');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $subL = $request->input('ids');

        // $cekId = lokasi::orderBy('id_lokasi', 'desc')->take(1)->pluck('id_lokasi')->first();
        $ext = strtolower($file->getClientOriginalExtension());
        $name = trim($file->getClientOriginalName());
        $fix = "/images/Sub Lokasi/" . $name;
        $file->move($path, $name);
        $dok = new DokSubLokasi();
        $dok->id_subL = $subL;
        $dok->nama_file = $name;
        $dok->path = $fix;
        $dok->save();
        return response()->json(['success' => 'Data Telah Tersimpan!']);
    }

    public function loadEditSubL($id)
    {
        $subL = DB::table('sub_lokasi')->where('id_subL', $id)->first();
        return response()->json($subL);
    }

    public function getSubLokasi($id)
    {
        $subL = DB::table('sub_lokasi')->where('id_lokasi', $id)->get();
        return response()->json($subL);
    }

    public function editSubL($id)
    {
        $subL = new subLokasi();
        $lokasi = new Lokasi();
        $used = Request()->input('lokasi');
        $subL->where('id_subL', $id)->update([
            'nama_subL' => Request()->input('subL'),
            'id_lokasi' => Request()->input('lokasi'),
        ]);
        return response()->json(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroySubL($id)
    {
        $subL = new subLokasi();
        $dokLok = new DokSubLokasi();
        $name = DB::table('dok_sub_lokasi')->where('id', $id)->pluck('nama_file')->first();
        if ($name) {
            $path = public_path('images/Lokasi/');
            $filename = $path . $name;
            unlink($filename);
        }
        $dokLok->where('id_subL', $id)->delete();
        $subL->where('id_subL', $id)->delete();
        return response()->json(['success' => 'Data Telah Tehapus!']);
    }

    public function destroyDokSubL($id)
    {
        //
        $lokasi = new DokSubLokasi();
        $name = DB::table('dok_sub_lokasi')->where('id', $id)->pluck('nama_file')->first();
        if ($name) {
            $path = public_path('images/Lokasi/');
            $filename = $path . $name;
            unlink($filename);
        }
        $lokasi->where('id', $id)->delete();
        return response()->json(['success' => 'Data Telah Tehapus!']);
    }
    // End Function Sub Lokasi


    // Kategori Function
    public function loadKategori($id)
    {
        $kategori = DB::table('kategori')->get();
        return response()->json($kategori);
    }

    public function kateIn(Request $request)
    {
        $kategori = new Kategori();
        $kategori->nama_kategori = $request->input('kategori');
        $kategori->uniqe_kode = strtoupper($request->input('kode'));
        $kategori->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function loadEditKategori($id)
    {
        $kategori = DB::table('kategori')->where('id_kategori', $id)->first();
        return response()->json($kategori);
    }

    public function editKategori($id)
    {
        $kategori = new Kategori();
        $kategori->where('id_kategori', $id)->update([
            'nama_kategori' => Request()->input('kategori'),
            'uniqe_kode' => strtoupper(Request()->input('kode')),
        ]);
        return response()->json(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroyKategori($id)
    {
        $kategori = new Kategori();
        $kategori->where('id_kategori', $id)->delete();
        return response()->json(['success' => 'Data Telah Tehapus!']);
    }

    // Pemilik Function
    public function loadPemilik($id)
    {
        $pemilik = DB::table('pemilik')->get();
        return response()->json($pemilik);
    }

    public function pemilikIn(Request $request)
    {
        $pemilik = new Pemilik();
        $pemilik->nama_pemilik = $request->input('pemilik');
        $pemilik->status = $request->input('status');
        $pemilik->nohp = $request->input('nomor');
        $pemilik->alamat = $request->input('alamat');
        $pemilik->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function loadEditPemilik($id)
    {
        $Pemilik = DB::table('pemilik')->where('id_pemilik', $id)->first();
        return response()->json($Pemilik);
    }

    public function editPemilik($id)
    {
        $Pemilik = new Pemilik();
        $Pemilik->where('id_pemilik', $id)->update([
            'nama_pemilik' => Request()->input('pemilik'),
            'status' => Request()->input('status'),
            'alamat' => Request()->input('alamat'),
            'nohp' => Request()->input('nomor'),
        ]);
        return response()->json(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroyPemilik($id)
    {
        $pemilik = new Pemilik();
        $pemilik->where('id_pemilik', $id)->delete();
        return response()->json(['success' => 'Data Telah Tehapus!']);
    }
}
