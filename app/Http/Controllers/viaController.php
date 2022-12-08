<?php

namespace App\Http\Controllers;

use App\Models\viaBayar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class viaController extends Controller
{
    public function index()
    {
        return view('via');
    }

    public function addVia(Request $request)
    {
        $via = new viaBayar();
        $via->keterangan = $request->input('Keterangan');
        $via->save();
        return response()->json(['success' => 'Via Telah Ditambahkan!']);
    }

    public function editVia($id)
    {
        $via = new viaBayar();
        $ket = Request()->input('ket');

        $cekUser = DB::table('via_bayar')->where('id', '!=', $id)->get();
        foreach ($cekUser as $data) {
            if ($data->keterangan == $$ket) {
                return response()->json(['success' => 'Keterangan Sudah Ada!']);
            } else {
                $via->where('id', $id)->update([
                    'keterangan' =>  $ket,
                ]);
                return response()->json(['success' => 'Data Berhasil Diubah!']);
            }
        }
    }

    public function getViaById($id)
    {
        $list = DB::table('via_bayar')
            ->where('id', $id)
            ->get();
        return response()->json($list);
    }

    public function getViaAll($id)
    {
        $list = DB::table('via_bayar')
            ->get();
        return response()->json($list);
    }

    public function delVia($id)
    {
        $penyewa = new viaBayar();
        $penyewa->where('id', $id)->delete();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }
}
