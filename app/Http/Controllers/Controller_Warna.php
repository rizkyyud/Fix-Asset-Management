<?php

namespace App\Http\Controllers;

use App\Models\Warna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Controller_Warna extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $warna = Warna::get();
        return view('warna', [
            'warna' => $warna
        ]);
    }

    public function store(Request $request)
    {
        //
        $warna = new Warna;
        $getWarna = $request->input('nama');
        $rules = [
            'nama' => 'required|unique:tbl_warna,warna',
        ];

        $text = [
            'nama.unique' => 'Warna (' . $getWarna . ') Sudah Ada'
        ];

        $validator = Validator::make($request->all(), $rules, $text);

        if ($validator->fails()) {
            // Alert::warning('Warning Title', $text);
            return back()->with('warning', $text['nama.unique'])->withInput();
        } else {
            $warna->warna = $request->input('nama');
            $warna->save();
            return redirect('warna')->with('success', 'Data Berhasil Disimpan!');
        }
    }

    public function update(Request $request, $id)
    {
        $warna = new Warna();
        $getwarna = Request()->input('warna');
        $rules = [
            'warna' => 'required|unique:tbl_warna,warna',
        ];

        $text = [
            'warna.unique' => 'Warna (' . $getwarna . ') Sudah Ada'
        ];

        $validator = Validator::make(Request()->all(), $rules, $text);

        if ($validator->fails()) {
            return back()->with('warning', $text['warna.unique'])->withInput();
        } else {
            $warna->warna = Request()->input('warna');
            $warna->where('id', $id)->update([
                'warna' => Request()->input('warna'),
            ]);

            return back()->with('success', 'Data Berhasil Dirubah!');
        }
    }

    public function destroy($id)
    {
        $warna = new Warna();
        $warna->where('id', $id)->delete();
        return back()->with('success', 'Data Berhasil Dihapus!');
    }
}
