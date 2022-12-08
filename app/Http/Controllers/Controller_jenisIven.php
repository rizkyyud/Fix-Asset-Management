<?php

namespace App\Http\Controllers;

use App\Models\jenisIventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Controller_jenisIven extends Controller
{

    public function index()
    {
        $jenis_iven = jenisIventaris::get();
        return view('jenisIven', ['jenisIven' => $jenis_iven]);
    }

    public function store(Request $request)
    {
        $jenisIven = new jenisIventaris();
        $getJenis = $request->input('jenis');
        $rules = [
            'jenis' => 'required|unique:jenis_iventaris,jenis_iventaris',
        ];

        $text = [
            'jenis.unique' => 'Jenis Iventaris (' . $getJenis . ') Sudah Ada'
        ];

        $validator = Validator::make($request->all(), $rules, $text);

        if ($validator->fails()) {
            // Alert::warning('Warning Title', $text);
            return back()->with('warning', $text['jenis.unique'])->withInput();
        } else {
            $jenisIven->jenis_iventaris = $request->input('jenis');
            $jenisIven->save();
            return redirect('jenisIven')->with('success', 'Data Berhasil Disimpan!');
        }
    }

    public function update(Request $request, $id)
    {
        $jenisIven = new jenisIventaris;
        $getjenis = Request()->input('jenis');
        $rules = [
            'jenis' => 'required|unique:jenis_iventaris,jenis_iventaris',
        ];

        $text = [
            'jenis.unique' => 'Jenis Iventaris (' . $getjenis . ') Sudah Ada'
        ];

        $validator = Validator::make(Request()->all(), $rules, $text);

        if ($validator->fails()) {
            // Alert::warning('Warning Title', $text);
            return back()->with('warning', $text['jenis.unique'])->withInput();
        } else {
            $jenisIven->jenis_iventaris = Request()->input('jenis');
            $jenisIven->where('id_jenisIven', $id)->update([
                'jenis_iventaris' => Request()->input('jenis'),
            ]);

            return redirect('jenisIven')->with('success', 'Data Berhasil Dirubah!');
        }
    }

    public function destroy($id)
    {
        //
        $jenis = new jenisIventaris();
        $jenis->where('id_jenisIven', $id)->delete();
        return redirect('jenisIven')->with('success', 'Data Berhasil Dihapus!');
    }
}
