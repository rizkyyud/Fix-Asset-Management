<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class reportReservController extends Controller
{
    //
    public function index()
    {
        //
        return view('reportReserv');
    }

    public function getCicilan($id)
    {
        $list = DB::table('pembayaran_villa')
            ->where('pembayaran_villa.kode_reservasi', $id)
            ->sum('nominal');
        return response()->json($list);
    }

    // public function show(){

    // }

    public function filter($id)
    {
        $from = Request()->input('from');
        $to = Request()->input('to');
        // $reservIn = strtotime($reservIn);
        // $list = $checkIn;
        $from = date($from);
        $to = date($to);
        $list = DB::table('reservasi_villa')
            ->whereBetween('check_in', [$from, $to])
            ->join('user_sewas', 'user_sewas.id', '=', 'reservasi_villa.id_penyewa')
            ->join('assets', 'assets.id_assets', '=', 'reservasi_villa.id_villa')
            ->select('reservasi_villa.*', 'assets.nama_assets as asset', 'user_sewas.nama')
            ->get();

        return response()->json($list);
    }

    public function filterReserv($id)
    {
        $from = Request()->input('from');
        $to = Request()->input('to');
        // $reservIn = strtotime($reservIn);
        // $list = $checkIn;
        $from = date($from);
        $to = date($to);
        $list = DB::table('reservasi_villa')
            ->whereBetween('reservasi_villa.created_at', [$from, $to])
            ->join('user_sewas', 'user_sewas.id', '=', 'reservasi_villa.id_penyewa')
            ->join('assets', 'assets.id_assets', '=', 'reservasi_villa.id_villa')
            ->select('reservasi_villa.*', 'assets.nama_assets as asset', 'user_sewas.nama')
            ->get();

        return response()->json($list);
    }

    public function filterBayar($id)
    {
        $from = Request()->input('from');
        $to = Request()->input('to');
        // $reservIn = strtotime($reservIn);
        // $list = $checkIn;
        // $from = date($from);
        // $to = date($to);
        $list = DB::table('reservasi_villa')
            ->whereBetween('reservasi_villa.updated_at', [$from, $to])
            ->join('user_sewas', 'user_sewas.id', '=', 'reservasi_villa.id_penyewa')
            ->join('assets', 'assets.id_assets', '=', 'reservasi_villa.id_villa')
            ->select('reservasi_villa.*', 'assets.nama_assets as asset', 'user_sewas.nama')
            ->get();

        return response()->json($list);
    }

    public function filLastPay($id)
    {
        $from = Request()->input('from');
        $to = Request()->input('to');
        // $reservIn = strtotime($reservIn);
        // $list = $checkIn;
        $from = date($from);
        $to = date($to);
        $list = DB::table('reservasi_villa')
            ->whereBetween('updated_at', [$from, $to])
            ->join('user_sewas', 'user_sewas.id', '=', 'reservasi_villa.id_penyewa')
            ->join('assets', 'assets.id_assets', '=', 'reservasi_villa.id_villa')
            ->select('reservasi_villa.*', 'assets.nama_assets as asset', 'user_sewas.nama')
            ->get();

        return response()->json($list);
    }
}
