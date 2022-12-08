<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Assets;
use App\Models\BarangOut;
use App\Models\DokAsset;
use App\Models\DokSubAsset;
use App\Models\Lokasi;
use App\Models\Pemilik;
use App\Models\Kategori;
use App\Models\Label;
use App\Models\subAssets;
use App\Models\subLokasi;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class Controller_Assets extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('assetsB');
    }

    public function loadAssets($id)
    {
        //
        $assetsB = DB::table('assets')
            ->join('lokasi', 'lokasi.id_lokasi', '=', 'assets.id_lokasi')
            ->join('sub_lokasi', 'sub_lokasi.id_subL', '=', 'assets.id_subLokasi')
            ->select('assets.*', 'lokasi.nama_lokasi', 'sub_lokasi.nama_subL')
            ->get();
        return response()->json($assetsB);
    }

    public function loadDokumen($id)
    {
        //
        $dok = DB::table('foto_assets')->where('id_assets', $id)
            ->get();
        return response()->json($dok);
    }

    public function cekUpAsset($id)
    {
        //
        $Bo = DB::table('pindah_barang')
            ->where('pindah_barang.id_toAsset', $id)
            ->where('pindah_barang.status', "Waiting")
            ->join('assets', 'assets.id_assets', '=', 'pindah_barang.id_fromAsset')
            // ->join('sub_assets', 'sub_assets.id', '=', 'barang_keluar.id_Subasset')
            ->select('pindah_barang.*', 'assets.nama_assets')
            ->get();
        return response()->json($Bo);
    }

    public function validBarang($id)
    {
        $barangOut = new BarangOut();
        $label = new Label();
        $ids = Request()->input('ids');
        $kodeOrd = DB::table('pindah_barang')->where('id', $id)->pluck('kode_label')->first();
        $barangOut->where('id', $id)->update([
            'status' => "Validate",
            'id_penerima' => $ids

        ]);
        $label->where('kode_label', $kodeOrd)->update([
            'status' => 'Use',
            'valid' => 1,
        ]);

        return response()->json(['success' => 'Data Berhasil Diubah!']);
    }

    public function masukBarang($id)
    {
        $kode = Request()->input('kode');
        $Bo = DB::table('pindah_barang')
            ->where('pindah_barang.kode_label', $kode)
            ->join('assets', 'assets.id_assets', '=', 'pindah_barang.id_toAsset')
            // ->join('sub_assets', 'sub_assets.id', '=', 'barang_keluar.id_tosub')
            ->select('pindah_barang.*', 'assets.nama_assets')
            ->get();
        return response()->json($Bo);
    }

    public function keluarBarang($id)
    {
        $kode = Request()->input('kode');
        $Bo = DB::table('pindah_barang')
            ->where('pindah_barang.kode_label', $kode)
            ->join('assets', 'assets.id_assets', '=', 'pindah_barang.id_fromAsset')
            // ->join('sub_assets', 'sub_assets.id', '=', 'barang_keluar.id_tosub')
            ->select('pindah_barang.*', 'assets.nama_assets')
            ->get();
        return response()->json($Bo);
    }

    public function barangMasuk($id)
    {
        // $kode = Request()->input('kode');
        $masuk = DB::table('pindah_barang')
            ->where('pindah_barang.id_toAsset', $id)
            ->join('barang_label', 'pindah_barang.kode_label', '=', 'barang_label.kode_label')
            ->join('pesanan', 'pesanan.id_orders', '=', 'barang_label.id_orders')
            ->join('barang_iven', 'barang_iven.id_barangIven', '=', 'pesanan.id_barangIven')
            ->join('assets', 'assets.id_assets', '=', 'pindah_barang.id_toAsset')
            // ->join('sub_assets', 'sub_assets.id', '=', 'barang_keluar.id_tosub')
            ->select('pindah_barang.*', 'assets.nama_assets', 'barang_iven.nama_barang')
            ->get();
        return response()->json($masuk);
    }

    public function barangKeluar($id)
    {
        // $kode = Request()->input('kode');
        $masuk = DB::table('pindah_barang')
            ->where('pindah_barang.id_fromAsset', $id)
            ->join('barang_label', 'pindah_barang.kode_label', '=', 'barang_label.kode_label')
            ->join('pesanan', 'pesanan.id_orders', '=', 'barang_label.id_orders')
            ->join('barang_iven', 'barang_iven.id_barangIven', '=', 'pesanan.id_barangIven')
            ->join('assets', 'assets.id_assets', '=', 'pindah_barang.id_fromAsset')
            // ->join('sub_assets', 'sub_assets.id', '=', 'barang_keluar.id_tosub')
            ->select('pindah_barang.*', 'assets.nama_assets', 'barang_iven.nama_barang')
            ->get();
        return response()->json($masuk);
    }

    public function pindahBarang(Request $request)
    {

        $label = new Label();
        $kode = $request->input('kode');
        $assets = $request->input('toAssets');
        $sub = $request->input('toSub');
        $from = $request->input('fromAsset');
        $fromSub = $request->input('fromSub');
        $id = $request->input('ids');
        // $panjangAsset = count($assets);
        // for($i =0;$i<$kode)


        $barangOut = new BarangOut();
        $kodeOrd = $kode;
        $label->where('kode_label', $kodeOrd)->update([
            'status' => 'Use',
            'id_lokasi' => $assets,
            'id_subAsset' => $sub,
            'valid' => 0,
        ]);

        $barangOut->kode_label = $kodeOrd;
        $barangOut->id_fromAsset = $from;
        $barangOut->id_fromSub = $fromSub;
        $barangOut->id_toAsset = $assets;
        $barangOut->id_toSub = $sub;
        $barangOut->status = "Waiting";
        $barangOut->id_pemindah = $id;
        $barangOut->id_penerima = 0;
        $barangOut->save();

        return response()->json($kode);
    }

    public function loadDetailAsset($id)
    {
        $assetsB = DB::table('assets')
            ->where('id_assets', $id)
            ->join('lokasi', 'lokasi.id_lokasi', '=', 'assets.id_lokasi')
            ->join('sub_lokasi', 'sub_lokasi.id_subL', '=', 'assets.id_subLokasi')
            ->join('kategori', 'kategori.id_kategori', '=', 'assets.id_kategori')
            ->join('pemilik', 'pemilik.id_pemilik', '=', 'assets.id_pemilik')
            ->select('assets.*', 'lokasi.nama_lokasi', 'sub_lokasi.nama_subL', 'kategori.nama_kategori', 'pemilik.nama_pemilik')
            ->first();
        return response()->json($assetsB);
    }

    public function getTime($id)
    {
        $time = DB::table('orders')
            ->where('orders.id', $id)
            ->join('pembelian', 'orders.id', '=', 'pembelian.id_orders')
            ->join('req_pesanans', 'orders.id_cart', '=', 'req_pesanans.id_cart')
            ->join('list_pesanan', 'list_pesanan.id', '=', 'orders.id_cart')
            ->join('valid_ords', 'valid_ords.id_cart', '=', 'req_pesanans.id_cart')
            ->select('valid_ords.created_at as tgl_valid', 'req_pesanans.updated_at as tgl_cek', 'pembelian.updated_at as tgl_beli', 'list_pesanan.created_at as tgl_pesan')
            ->first();
        return response()->json($time);
    }

    public function loadAssetSub($id)
    {
        $assetsB = DB::table('sub_assets')
            ->where('id', $id)
            ->join('assets', 'assets.id_assets', '=', 'sub_assets.id_assets')
            ->join('lokasi', 'lokasi.id_lokasi', '=', 'assets.id_lokasi')
            ->join('sub_lokasi', 'sub_lokasi.id_subL', '=', 'assets.id_subLokasi')
            ->select('sub_assets.*', 'assets.nama_assets', 'sub_lokasi.nama_subL', 'lokasi.nama_lokasi')
            ->first();
        return response()->json($assetsB);
    }

    public function getLabel($id)
    {
        $label = DB::table('barang_label')->where('id_lokasi', $id)
            ->where('valid', 1)
            ->join('orders', 'orders.id', '=', 'barang_label.id_orders')
            ->join('barangs', 'barangs.id', '=', 'orders.id_barang')
            ->select('barang_label.*', 'barangs.nama')
            ->get();
        return response()->json($label);
    }

    public function getSubLabel($id)
    {
        $label = DB::table('barang_label')->where('id_subAsset', $id)
            ->where('valid', 1)
            ->join('pesanan', 'pesanan.id_orders', '=', 'barang_label.id_orders')
            ->join('barang_iven', 'barang_iven.id_barangIven', '=', 'pesanan.id_barangIven')
            ->select('barang_label.*', 'barang_iven.nama_barang')
            ->get();
        return response()->json($label);
    }

    public function getRepotItem($id)
    {
        $label = DB::table('barang_label')
            ->where('id_lokasi', $id)
            ->where('valid', 1)
            ->join('pesanan', 'pesanan.id_orders', '=', 'barang_label.id_orders')
            ->join('barang_iven', 'barang_iven.id_barangIven', '=', 'pesanan.id_barangIven')
            ->select('barang_iven.nama_barang', 'barang_iven.id_barangIven', DB::raw('sum(barang_label.jlh) as total'))
            ->groupBy('barang_iven.nama_barang')
            ->groupBy('barang_iven.id_barangIven')
            ->get();
        // ->select('barang_label.*')
        // ->groupBy('barang_label.id_orders')
        // ->groupBy('barang_iven.nama_barang')
        // ->groupBy('barang_label.kode_label')

        return response()->json($label);
    }

    public function getSubItem($id)
    {
        $label = DB::table('barang_label')
            ->where('id_subAsset', $id)
            ->join('pesanan', 'pesanan.id_orders', '=', 'barang_label.id_orders')
            ->join('barang_iven', 'barang_iven.id_barangIven', '=', 'pesanan.id_barangIven')
            ->select('barang_iven.nama_barang', 'barang_iven.id_barangIven', DB::raw('sum(barang_label.jlh) as total'))
            ->groupBy('barang_iven.nama_barang')
            ->groupBy('barang_iven.id_barangIven')
            ->get();
        // ->select('barang_label.*')
        // ->groupBy('barang_label.id_orders')
        // ->groupBy('barang_iven.nama_barang')
        // ->groupBy('barang_label.kode_label')

        return response()->json($label);
    }

    public function loadSubAssets($id)
    {
        //
        $subAsset = DB::table('sub_assets')
            ->where('id_assets', $id)
            ->get();
        return response()->json($subAsset);
    }

    public function getSubAssets($id)
    {
        //
        $subAsset = DB::table('sub_assets')
            ->where('id', $id)
            ->join('assets', 'assets.id_assets', '=', 'sub_assets.id_assets')
            ->select('sub_assets.*', 'assets.nama_assets')
            ->get();
        return response()->json($subAsset);
    }

    public function Get_Sub_InAsset($id)
    {
        //
        $subAsset = DB::table('sub_assets')
            ->where('id_assets', $id)
            ->get();
        return response()->json($subAsset);
    }

    public function getAllSub($id)
    {
        //
        $subAsset = DB::table('sub_assets')
            ->join('assets', 'assets.id_assets', '=', 'sub_assets.id_assets')
            ->select('sub_assets.*', 'assets.nama_assets')
            ->get();
        return response()->json($subAsset);
    }

    public function loadSubADok($id)
    {
        //
        $subAsset = DB::table('dok_sub_asset')
            ->where('id_subAsset', $id)
            ->get();
        return response()->json($subAsset);
    }

    public function getSubL($id_lokasi)
    {
        $data = DB::table('sub_lokasi')->where('id_lokasi', $id_lokasi)->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        //
        $tes = array();
        $count = $request->input('count');
        for ($i = 1; $i <= $count; $i++) {
            $storage = storage_path('app/temp/') . $request->input("document$i");
            $public = public_path('images/Assets/');
            $name = 'Assets_' . $request->input("document$i");
            $path = $public . $name;
            array_push($tes, $name);
            File::move($storage, $path);
        }
        $assets = new Assets;
        $assets->nama_assets = $request->input('assets');
        $assets->id_lokasi = $request->input('lokasi');
        $assets->id_subLokasi = $request->input('subL');
        $assets->id_kategori = $request->input('kategori');
        $assets->id_pemilik = $request->input('pemilik');
        $assets->nilai_assets = $request->input('nilai');
        $assets->luas = $request->input('luas');
        $assets->kode_asset = $request->input('kode');
        $assets->foto = json_encode($tes);
        $assets->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function storeSubAsset(Request $request)
    {
        //
        $sub = $request->input('subAsset');
        $kode = $request->input('subKode');
        $id = $request->input('ids');
        $panjang = $request->input('panjang') + 1;

        for ($i = 0; $i < $panjang; $i++) {
            $assets = new subAssets();
            
            $match = ['nama_subAsset' => $sub[$i], 'id_assets' => $id];
            $cek = DB::table('sub_assets')->where($match)->first();
            if (!$cek) {
                $assets->nama_subAsset = $sub[$i];
                $assets->kode_sub = $kode[$i];
                $assets->id_assets = $id;
                $assets->save();
            }
            // $match = ['nama_subAsset' => $sub[$i], 'id_assets' => $id];
            // $cek = DB::table('sub_assets')->where($match)->first();
            // if (!$cek) {
                
            // }
        }

        return response()->json(['success' => 'Data Telah Tersimpan!']);
    }

    public function storeMedia(Request $request)
    {
        $path = public_path('images/Assets/');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $assets = $request->input('ids');

        // $cekId = Assets::orderBy('id_assets', 'desc')->take(1)->pluck('id_assets')->first();
        $ext = strtolower($file->getClientOriginalExtension());
        $name = trim($file->getClientOriginalName());
        $fix = "/images/Assets/" . $name;
        $file->move($path, $name);
        $dok = new DokAsset();
        $dok->id_assets = $assets;
        $dok->nama_file = $name;
        $dok->path = $fix;
        $dok->save();
        return response()->json(['success' => 'Data Telah Tersimpan!']);
    }

    public function storeMediaSub(Request $request)
    {
        $path = public_path('images/Sub Asset/');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $subAsset = $request->input('ids');

        $ext = strtolower($file->getClientOriginalExtension());
        $name = trim($file->getClientOriginalName());
        $fix = "/images/Sub Asset/" . $name;
        $file->move($path, $name);
        $dok = new DokSubAsset();
        $dok->id_subAsset = $subAsset;
        $dok->nama_file = $name;
        $dok->path = $fix;
        $dok->save();
        return response()->json(['success' => 'Data Telah Tersimpan!']);
    }

    public function update(Request $request)
    {
        //
        $assets = new Assets;
        $id = $request->input('id');
        $assets->nama_assets = Request()->input('nama');
        $assets->where('id_assets', $id)->update([
            'nama_assets' => Request()->input('assets'),
            'id_lokasi' => Request()->input('lokasi'),
            'id_subLokasi' => Request()->input('subL'),
            'id_kategori' => Request()->input('kategori'),
            'id_pemilik' => Request()->input('pemilik'),
            'luas' => Request()->input('luas'),
            'nilai_assets' => Request()->input('nilai'),
            'kode_asset' => Request()->input('kode'),
        ]);
        return response()->json(['success' => 'Data Berhasil Diubah!']);
    }

    public function updateSubAsset(Request $request,$id)
    {
        //
        $assets = new subAssets();
        $sub = $request->input('subAsset');
        $kode = $request->input('subKode');
        // $id = $request->input('ids');
        $assets->where('id', $id)->update([
            'nama_subAsset' => $sub,
            'kode_sub' => $kode,
        ]);
        
        return response()->json(['success' => 'Data Berhasil Diubah!']);
    }

    public function cekAsset($id)
    {
        $cek = DB::table('assets')->where('id_assets', '!=', $id)->get();
        return response()->json($cek);
    }

    public function destroy($id)
    {
        //
        $assets = new Assets;
        $subAsset = new subAssets();
        $dok = new DokSubAsset();
        $name = DB::table('dok_sub_asset')->where('id', $id)->pluck('nama_file')->first();
        if ($name) {
            $path = public_path('images/Sub Asset/');
            $filename = $path . $name;
            unlink($filename);
        }
        $dok->where('id', $id)->delete();
        $subAsset->where('id', $id)->delete();
        $assets->where('id_assets', $id)->delete();
        return response()->json(['success' => 'Data Telah Terhapus!']);
    }

    public function destroySub($id)
    {
        //
        $subAsset = new subAssets();
        $dok = new DokSubAsset();
        $name = DB::table('dok_sub_asset')->where('id', $id)->pluck('nama_file')->first();
        if ($name) {
            $path = public_path('images/Sub Asset/');
            $filename = $path . $name;
            unlink($filename);
        }
        $dok->where('id', $id)->delete();
        $subAsset->where('id', $id)->delete();

        return response()->json(['success' => 'Data Telah Terhapus!']);
    }

    public function destroyDok($id)
    {
        //
        $dok = new DokAsset();
        $name = DB::table('foto_assets')->where('id', $id)->pluck('nama_file')->first();
        if ($name) {
            $path = public_path('images/Assets/');
            $filename = $path . $name;
            unlink($filename);
        }
        $dok->where('id', $id)->delete();
        return response()->json(['success' => 'Data Telah Terhapus!']);
    }

    public function destroySubDok($id)
    {
        //
        $dok = new DokSubAsset();
        $name = DB::table('dok_sub_asset')->where('id', $id)->pluck('nama_file')->first();
        if ($name) {
            $path = public_path('images/Sub Asset/');
            $filename = $path . $name;
            unlink($filename);
        }
        $dok->where('id', $id)->delete();
        return response()->json(['success' => 'Data Telah Terhapus!']);
    }

    public function delfoto($name)
    {
        $path = storage_path('app/temp/');
        $filename = $path . $name;
        unlink($filename);
    }

    public function clearTemp()
    {
        // $path = storage_path('tmp/uploads/');
        // $files = Storage::allfiles('temp');
        // Storage::delete($files);
    }
}
