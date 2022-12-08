<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Controller_Kategori extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('kategori');
    }

    public function cekEdit($id)
    {
        $cek = DB::table('kategori')->where('id_kategori', '!=', $id)->get();
        return response()->json($cek);
    }
}
