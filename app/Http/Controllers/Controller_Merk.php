<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Controller_Merk extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $merk = Merk::get();
        return view('merk', [
            'merk' => $merk
        ]);
    }

    public function store(Request $request)
    {
        //
        $merk = new Merk;
        $getmerk = $request->input('nama');
        $rules = [
            'nama' => 'required|unique:tbl_merk,merk',
        ];

        $text = [
            'nama.unique' => 'Merk (' . $getmerk . ') Sudah Ada'
        ];

        $validator = Validator::make($request->all(), $rules, $text);

        if ($validator->fails()) {
            // Alert::warning('Warning Title', $text);
            return back()->with('warning', $text['nama.unique'])->withInput();
        } else {
            $merk->merk = $request->input('nama');
            $merk->save();
            return back()->with('success', 'Data Berhasil Disimpan!');
        }
    }

    public function update(Request $request, $id)
    {
        $merk = new Merk();
        $getmerk = Request()->input('merk');
        $rules = [
            'merk' => 'required|unique:tbl_merk,merk',
        ];

        $text = [
            'merk.unique' => 'Merk (' . $getmerk . ') Sudah Ada'
        ];

        $validator = Validator::make(Request()->all(), $rules, $text);

        if ($validator->fails()) {
            return back()->with('warning', $text['merk.unique'])->withInput();
        } else {
            $merk->merk = Request()->input('merk');
            $merk->where('id', $id)->update([
                'merk' => Request()->input('merk'),
            ]);

            return back()->with('success', 'Data Berhasil Dirubah!');
        }
    }

    public function destroy($id)
    {
        //
        $merk = new Merk();
        $merk->where('id', $id)->delete();
        return back()->with('success', 'Data Berhasil Dihapus!');
    }
}
