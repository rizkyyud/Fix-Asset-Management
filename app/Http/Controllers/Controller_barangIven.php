<?php

namespace App\Http\Controllers;

use App\Models\barangIven;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Controller_barangIven extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $barangIven = barangIven::with('Jenis')->get();
        $jenis = DB::table('jenis_iventaris')->get();
        return view('barangIven', [
            'barangIven' => $barangIven,
            'jenis' => $jenis
        ]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $barang = new barangIven();
        $getBarang = $request->input('nama');
        $rules = [
            'nama' => 'required|unique:barang_iven,nama_barang',
        ];

        $text = [
            'nama.unique' => 'Sub Lokasi (' . $getBarang . ') Sudah Ada'
        ];

        $validator = Validator::make($request->all(), $rules, $text);

        if ($validator->fails()) {
            // Alert::warning('Warning Title', $text);
            return back()->with('warning', $text['nama.unique'])->withInput();
        } else {
            $barang->id_jenisIven = $request->input('jenis');
            $barang->nama_barang = $request->input('nama');
            $barang->kode_barang = $request->input('kode');
            $barang->satuan = $request->input('satuan');
            $barang->label = Request()->input('label');
            $barang->save();
            return redirect('barangIven')->with('success', 'Data Berhasil Disimpan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barang = new barangIven();
        $getBarang = $request->input('nama');
        $rules = [
            'nama' => 'required|unique:barang_iven,nama_barang',
            'kode_barang' => 'required|3'
        ];

        $text = [
            'nama.unique' => 'Sub Lokasi (' . $getBarang . ') Sudah Ada',
            'kode_barang' => 'Kode Barang Tidak Boleh Lebih dari 3'
        ];

        $validator = Validator::make($request->all(), $rules, $text);

        if ($validator->fails()) {
            // Alert::warning('Warning Title', $text);
            return back()->with('warning', $text['nama.unique'])->withInput();
        } else {
            $barang->nama_barang = Request()->input('nama');
            $barang->where('id_barangIven', $id)->update([
                'nama_barang' => Request()->input('nama'),
                'id_jenisIven' => Request()->input('jenis'),
                'kode_barang' => Request()->input('kode')
            ]);

            return redirect('barangIven')->with('success', 'Data Berhasil Dirubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $barang = new barangIven();
        $barang->where('id_barangIven', $id)->delete();
        return redirect('barangIven')->with('success', 'Data Berhasil Dihapus!');
    }
}
