<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pemilik;
use Illuminate\Support\Facades\Validator;

class Controller_Pemilik extends Controller
{

    public function index()
    {
        return view('pemilik');
    }

    public function cekEdit($id)
    {
        $Pemilik = DB::table('pemilik')->where('id_pemilik', '!=', $id)->get();
        return response()->json($Pemilik);
    }
}
