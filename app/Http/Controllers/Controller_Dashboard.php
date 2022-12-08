<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class Controller_Dashboard extends Controller
{
    //
    public function index()
    {
        //
        if (!session()->get('cekL')) {
            return redirect('/')->with('warning', "Anda Tidak Terdaftar");
        } else {
            return view('dashboard/adminHome');
        }
    }
}
