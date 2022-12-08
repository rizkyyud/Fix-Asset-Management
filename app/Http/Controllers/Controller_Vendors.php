<?php

namespace App\Http\Controllers;

use App\Models\barangIven;
use App\Models\Vendors;
use App\Models\jenisIventaris;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Controller_Vendors extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $vendors = Vendors::get();
        $jenis = jenisIventaris::get();
        return view('vendors', [
            'jenis' => $jenis
        ]);
    }

    public function loadVendors($id)
    {
        $model = Vendors::get();
        return response()->json($model);
    }

    public function store(Request $request)
    {
        $vendor = new Vendors();
        // $jenis = $request->input('jenis');
        $vendor->nama_vendor = $request->input('vendor');
        $vendor->alamat_vendor = $request->input('alamat');
        $vendor->contact_person = $request->input('kontak');
        $vendor->no_hp = json_encode($request->input('nomor'));
        $vendor->jenis = json_encode($request->input('jenis'));
        $vendor->save();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function getVendor($id)
    {
        $vendor = DB::table('vendors')->where('id_vendor', $id)->first();
        return response()->json($vendor);
    }

    public function cekVendor($id)
    {
        $cek = DB::table('vendors')->where('id_vendor', '!=', $id)->get();
        return response()->json($cek);
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
        //
        $vendors = new Vendors;
        $jenis = json_encode(Request()->input('jenis'));
        $hp = json_encode(Request()->input('nomor'));
        $vendors->nama_vendors = Request()->input('nama');
        $vendors->where('id_vendor', $id)->update([
            'nama_vendor' => Request()->input('vendor'),
            'alamat_vendor' => Request()->input('alamat'),
            'contact_person' => Request()->input('kontak'),
            'jenis' => $jenis,
            'no_hp' => $hp,
        ]);
        return response()->json(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = new Vendors();
        $vendor->where('id_vendor', $id)->delete();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }
}
