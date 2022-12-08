<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Login;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;

class Controller_Login extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('index');
    }

    public function authenticate(Request $request)
    {
        $match = ['UserId' => $request->input('userid'), 'PASSWORD' => $request->input('pass')];
        $data = DB::table('IventoryId')->where($match)->first();
        $idU = DB::table('IventoryId')->where($match)->pluck('Id')->first();
        // $credentials = $request->validate(['UserId' => 'required', 'PASSWORD' => 'required']);
        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('dashboard');
        //     // Authentication was successful...
        // }
        $hak = DB::table('hak_akses')->where('id_user', $idU)->first();

        if ($data) {
            if ($hak) {
                $request->session()->regenerate();
                session()->put('nama', $data->Keterangan);
                session()->put('cekL', True);
                session()->put('divisi', $data->DIVISI);
                session()->put('id', $data->Id);
                session()->put('hak', $hak->hak);

                return redirect()->intended('dashboard');
            }
        }

        return back()->with('warning', "Anda Tidak Terdaftar")->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/')->with('warning', "Anda Telah Logout");
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
        //
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
    }
}
