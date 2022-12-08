<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Merk;
use App\Models\ModelB;
use App\Models\Warna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Controller_Model extends Controller
{

    public function index()
    {
        //
        return view('modelB');
    }

    public function filterBarang($id)
    {
        $barang = new Barang();
        $tipe = Request()->input('tipe');
        $kate = Request()->input('kate');
        $match = '';
        if ($kate != 0 && $tipe != 0) {
            $match = ['barangs.id_barangIven' => $tipe, 'barang_iven.id_jenisIven' => $kate];
        } else if ($kate == 0 && $tipe > 0) {
            $match = ['barangs.id_barangIven' => $tipe];
        } else if ($tipe == 0 && $kate > 0) {
            $match = ['barang_iven.id_jenisIven' => $kate];
        } else if ($tipe == 0 && $kate == 0) {
            $barang = DB::table('barangs')
                ->join('barang_iven', 'barang_iven.id_barangIven', '=', 'barangs.id_barangIven')
                ->join('jenis_iventaris', 'barang_iven.id_jenisIven', '=', 'jenis_iventaris.id_jenisIven')
                ->join('tbl_model', 'tbl_model.id', '=', 'barangs.id_model')
                ->join('tbl_merk', 'tbl_merk.id', '=', 'barangs.id_merk')
                ->join('tbl_warna', 'tbl_warna.id', '=', 'barangs.id_warna')
                ->select('barangs.*', 'barang_iven.nama_barang as tipe', 'tbl_model.model', 'tbl_merk.merk', 'tbl_warna.warna', 'jenis_iventaris.jenis_iventaris as kategori')
                ->get();
        }

        if ($match != '') {
            $barang = DB::table('barangs')
                ->join('barang_iven', 'barang_iven.id_barangIven', '=', 'barangs.id_barangIven')
                ->join('jenis_iventaris', 'barang_iven.id_jenisIven', '=', 'jenis_iventaris.id_jenisIven')
                ->join('tbl_model', 'tbl_model.id', '=', 'barangs.id_model')
                ->join('tbl_merk', 'tbl_merk.id', '=', 'barangs.id_merk')
                ->join('tbl_warna', 'tbl_warna.id', '=', 'barangs.id_warna')
                ->select('barangs.*', 'barang_iven.nama_barang as tipe', 'tbl_model.model', 'tbl_merk.merk', 'tbl_warna.warna', 'jenis_iventaris.jenis_iventaris as kategori')
                ->where($match)
                ->get();
        }



        return response()->json($barang);
    }

    public function loadModel($id)
    {
        $model = ModelB::get();
        return response()->json($model);
    }

    public function loadMerk($id)
    {
        $merk = DB::table('tbl_merk')->get();
        return response()->json($merk);
    }

    public function loadWarna($id)
    {
        $warna = DB::table('tbl_warna')->get();
        return response()->json($warna);
    }

    public function barangIn(Request $request)
    {
        $barang = new Barang();
        $barang->nama = $request->input('barang');
        $barang->ukuran = $request->input('ukuran');
        $barang->id_model = $request->input('model');
        $barang->id_merk = $request->input('merk');
        $barang->id_warna = $request->input('warna');
        $barang->id_barangIven = $request->input('kategori');
        $barang->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function modelIn(Request $request)
    {
        $model = new ModelB();
        $model->model = $request->input('model');
        $model->kode_model = $request->input('kode');
        $model->id_penambah = $request->input('ids');
        $model->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function merkIn(Request $request)
    {
        $merk = new Merk();
        $merk->merk = $request->input('merk');
        $merk->kode_merk = $request->input('kode');
        $merk->id_penambah = $request->input('ids');
        $merk->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function warnaIn(Request $request)
    {
        $warna = new Warna();
        $warna->warna = $request->input('warna');
        $warna->id_penambah = $request->input('ids');
        $warna->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function update(Request $request, $id)
    {
        $model = new ModelB();
        $getmodel = Request()->input('model');
        $rules = [
            'model' => 'required|unique:tbl_model,model',
        ];

        $text = [
            'model.unique' => 'Model (' . $getmodel . ') Sudah Ada'
        ];

        $validator = Validator::make(Request()->all(), $rules, $text);

        if ($validator->fails()) {
            return back()->with('warning', $text['model.unique'])->withInput();
        } else {
            $model->model = Request()->input('model');
            $model->where('id', $id)->update([
                'model' => Request()->input('model'),
            ]);

            return back()->with('success', 'Data Berhasil Dirubah!');
        }
    }

    public function barangGet($id)
    {
        $barang = DB::table('barangs')->where('id', $id)->first();
        return response()->json($barang);
    }

    public function loadEditModel($id)
    {
        $model = DB::table('tbl_model')->where('id', $id)->first();
        return response()->json($model);
    }

    public function loadEditMerk($id)
    {
        $merk = DB::table('tbl_merk')->where('id', $id)->first();
        return response()->json($merk);
    }

    public function loadEditWarna($id)
    {
        $warna = DB::table('tbl_warna')->where('id', $id)->first();
        return response()->json($warna);
    }

    public function barangEdit($id)
    {
        $barang = new Barang();
        $barang->where('id', $id)->update([
            'nama' => Request()->input('barang'),
            'id_barangIven' => Request()->input('kategori'),
            'id_model' => Request()->input('model'),
            'id_merk' => Request()->input('merk'),
            'id_warna' => Request()->input('warna'),
            'ukuran' => Request()->input('ukuran'),
        ]);
        return response()->json(['success' => 'Data Berhasil Diubah!']);
    }

    public function modelEdit($id)
    {
        $model = new ModelB();
        $model->where('id', $id)->update([
            'model' => Request()->input('model'),
            'kode_model' => Request()->input('kode'),
            'id_penambah' => Request()->input('ids')
        ]);
        return response()->json(['success' => 'Data Berhasil Diubah!']);
    }

    public function merkEdit($id)
    {
        $merk = new Merk();
        $merk->where('id', $id)->update([
            'merk' => Request()->input('merk'),
            'kode_merk' => Request()->input('kode'),
            'id_penambah' => Request()->input('ids')
        ]);
        return response()->json(['success' => 'Data Berhasil Diubah!']);
    }

    public function warnaEdit($id)
    {
        $warna = new Warna();
        $warna->where('id', $id)->update([
            'warna' => Request()->input('warna'),
            'id_penambah' => Request()->input('ids')
        ]);
        return response()->json(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroyBarang($id)
    {
        //
        $barang = new Barang();
        $barang->where('id', $id)->delete();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function destroyModel($id)
    {
        //
        $model = new ModelB();
        $model->where('id', $id)->delete();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function destroyMerk($id)
    {
        //
        $merk = new Merk();
        $merk->where('id', $id)->delete();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function destroyWarna($id)
    {
        //
        $Warna = new Warna();
        $Warna->where('id', $id)->delete();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }
}
