<?php

namespace App\Http\Controllers;

use App\Models\PembayaranVilla;
use App\Models\Penyewaan;
use App\Models\userSewa;
use App\Models\ReservasiVilla;
use App\Models\viaVilla;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Penyewaan');
    }


    public function addReservasi()
    {
    }

    public function store(Request $request)
    {
        //
        // $kode = $request->input('kode');
        // $villa = $request->input('villa');
        // $match = ['kode_reservasi' => $kode, 'id_villa' => $villa];
        // $list = DB::table('reservasi_villa')->where($match)->get();
        // if ($list) {
        //     $res = 0;
        //     return response()->json($res);
        // } else {
        $reservasi = new ReservasiVilla();
        $reservasi->kode_reservasi = $request->input('kode');
        $reservasi->check_in = $request->input('checkIn');
        $reservasi->check_out = $request->input('checkOut');
        $reservasi->id_villa = $request->input('villa');
        $reservasi->id_penyewa = $request->input('penyewa');
        $reservasi->diskon = $request->input('diskon');
        $reservasi->tagihan = $request->input('harga');
        $reservasi->status = $request->input('status');
        $reservasi->first_pay = $request->input('first_pay');
        $reservasi->lunas = $request->input('lunas');
        $reservasi->via = $request->input('via');
        $reservasi->via_pay = $request->input('viaPay');
        $reservasi->tgl_bayar = $request->input('tgl');
        $reservasi->save();
        $res = 1;
        return response()->json($res);
        // }
    }

    public function edit(Request $request)
    {
        $reservasi = new ReservasiVilla();
        $kode = $request->input('kode');
        $reservasi->where('kode_reservasi', $kode)->update([
            'check_in' =>  $request->input('checkIn'),
            'check_out' =>  $request->input('checkOut'),
            'id_villa' =>  $request->input('villa'),
            'id_penyewa' =>  $request->input('penyewa'),
            'diskon' =>  $request->input('diskon'),
            'tagihan' =>  $request->input('harga'),
            'status' =>  $request->input('status'),
            'first_pay' =>  $request->input('first_pay'),
            'lunas' =>  $request->input('lunas'),
            'via' =>  $request->input('via'),
            'via_pay' =>  $request->input('viaPay'),
            'tgl_bayar' =>  $request->input('tgl'),
        ]);
        $res = 1;
        return response()->json($res);
    }

    public function addPenyewa(Request $request)
    {
        $newUser = new userSewa();
        $newUser->nama = $request->input('nama');
        $newUser->alamat = $request->input('alamat');
        $newUser->email = $request->input('email');
        $newUser->kontak = $request->input('kontak');
        $newUser->username = $request->input('username');
        $newUser->password = $request->input('password');
        $newUser->save();

        return response()->json(['success' => 'Penyewa Telah Ditambahkan!']);
    }

    public function addVia(Request $request)
    {
        $via = new viaVilla();
        $via->keterangan = $request->input('Keterangan');
        $via->save();
        return response()->json(['success' => 'Via Telah Ditambahkan!']);
    }

    public function editPenyewa(Request $request)
    {

        $newUser = new userSewa();
        $id = $request->input('id');
        $username = Request()->input('username');
        $nama = Request()->input('nama');
        $alamat = Request()->input('alamat');
        $kontak = Request()->input('kontak');
        $email = Request()->input('email');

        $cekUser = DB::table('user_sewas')->where('id', '!=', $id)->get();
        foreach ($cekUser as $data) {
            if ($data->username == $username) {
                return response()->json(['success' => 'Username Sudah Digunakan!']);
            } else {
                $newUser->where('id', $id)->update([
                    'nama' =>  $nama,
                    'alamat' =>  $alamat,
                    'email' =>  $email,
                    'kontak' => $kontak,
                    'username' =>  $username,
                    'password' =>  Request()->input('password'),
                ]);
                return response()->json(['success' => 'Data Berhasil Diubah!']);
            }
        }
    }

    public function editVia($id)
    {
        $via = new viaVilla();
        $ket = Request()->input('ket');

        $cekUser = DB::table('via_villa')->where('id', '!=', $id)->get();
        foreach ($cekUser as $data) {
            if ($data->keterangan == $ket) {
                return response()->json(['success' => 'Keterangan Sudah Ada!']);
            } else {
                $via->where('id', $id)->update([
                    'keterangan' =>  $ket,
                ]);
                return response()->json(['success' => 'Data Berhasil Diubah!']);
            }
        }
    }

    public function getPenyewa($id)
    {
        $list = DB::table('user_sewas')->get();
        return response()->json($list);
    }

    public function getPenyewaID($id)
    {
        $list = DB::table('user_sewas')
            ->where('id', $id)
            ->get();
        return response()->json($list);
    }

    public function getReservasi($id)
    {
        $list = DB::table('reservasi_villa')
            ->join('user_sewas', 'user_sewas.id', '=', 'reservasi_villa.id_penyewa')
            ->join('assets', 'assets.id_assets', '=', 'reservasi_villa.id_villa')
            ->select('reservasi_villa.*', 'assets.nama_assets as asset', 'user_sewas.nama')
            ->get();
        return response()->json($list);
    }

    public function getViaById($id)
    {
        $list = DB::table('via_villa')
            ->where('id', $id)
            ->get();
        return response()->json($list);
    }

    public function getViaAll($id)
    {
        $list = DB::table('via_villa')
            ->get();
        return response()->json($list);
    }

    public function getDataReserv(Request $request)
    {
        $awal = $request->input('Awal');
        $akhir = $request->input('Akhir');
        $list = DB::table('reservasi_villa')
            ->whereBetween('reservasi_villa.check_in', [$awal, $akhir])
            ->join('user_sewas', 'user_sewas.id', '=', 'reservasi_villa.id_penyewa')
            ->join('assets', 'assets.id_assets', '=', 'reservasi_villa.id_villa')
            ->select('reservasi_villa.*', 'assets.nama_assets as asset', 'user_sewas.nama')
            ->get();

        return response()->json($list);
        // }
    }

    public function getDataCicil(Request $request)
    {
        $kode = $request->input('kodes');
        
        $total = DB::table('pembayaran_villa')
        ->where('kode_reservasi','=',$kode)
        // ->get();
        ->sum('nominal');
        return response()->json($total);
        //
    }

    public function getReservById($id)
    {
        $list = DB::table('reservasi_villa')
            ->where('kode_reservasi', $id)
            ->join('via_bayar', 'via_bayar.id', '=', 'reservasi_villa.via_pay')
            ->select('reservasi_villa.*', 'via_bayar.keterangan as pay')
            ->get();
        return response()->json($list);
    }

    public function getHarga($id)
    {
        $list = DB::table('harga_sewaGdg')->where('id_assets', $id)
            ->join('session_sewas', 'session_sewas.id', '=', 'harga_sewaGdg.id_session')
            ->select('harga_sewaGdg.*', 'session_sewas.tanggal_awal', 'session_sewas.tanggal_akhir', 'session_sewas.session')
            ->get();
        $checkIn = Request()->input('checkIn');
        $checkOut = Request()->input('checkOut');
        $period = new DatePeriod(
            new DateTime($checkIn),
            new DateInterval('P1D'),
            new DateTime($checkOut)
        );

        $allday = [];
        // $getAll = [];
        $harga = 0;

        foreach ($period as $date) {
            $day =  $date->format("Y-m-d");
            array_push($allday, $day);
        }

        function isWeekend($date)
        {
            $timestamp = strtotime($date);
            $day = date('D', $timestamp);

            return ($day == "Sat");
        }

        function getHarga1($list, $session)
        {
            foreach ($list as $data) {
                if ($data->session == $session) {
                    return $data->harga;
                }
            }
        }

        // $countDay = 0;
        $dataHarga = [];
        for ($i = 0; $i < count($allday); $i++) {
            // $array = getHarga1($list, $allday[$i], $countDay);

            foreach ($list as $data) {
                $rentDate = date($allday[$i]);
                $rentDate = date('Y-m-d', strtotime($allday[$i]));
                $array = [];

                $EVENT_DATE_BEGAIN = date('Y-m-d', strtotime($data->tanggal_awal));
                $EVENT_DATE_END = date('Y-m-d', strtotime($data->tanggal_akhir));

                if (($rentDate >= $EVENT_DATE_BEGAIN) && ($rentDate <= $EVENT_DATE_END)) {
                    // $counter = 1;
                    $array = array("Seasson" => $data->session, "Harga" => $data->harga, "Tanggal" => $allday[$i]);
                } else {
                    if (isWeekend($allday[$i])) {
                        $harga = getHarga1($list, 'Weekend');
                        $array = array("Seasson" => "Weekend", "Harga" => $harga, "Tanggal" => $allday[$i]);
                    } else {
                        $harga = getHarga1($list, 'Weekday');
                        $array = array("Seasson" => "Weekday", "Harga" => $harga, "Tanggal" => $allday[$i]);
                    }
                }
            }

            array_push($dataHarga, $array);
        }
        return response()->json($dataHarga);
    }

    public function cekKetersediaan($id)
    {
        $checkIn = Request()->input('checkIn');
        $checkOut = Request()->input('checkOut');

        $cek = DB::table('reservasi_villa')->where('id_villa', $id)
            ->get();

        $period = new DatePeriod(
            new DateTime($checkIn),
            new DateInterval('P1D'),
            new DateTime($checkOut)
        );

        $counter = 0;
        foreach ($period as $date) {
            $day =  $date->format("Y-m-d");

            foreach ($cek as $data) {
                $rentDate = date($day);
                $rentDate = date('Y-m-d', strtotime($day));
                $array = [];

                $EVENT_DATE_BEGAIN = date('Y-m-d', strtotime($data->check_in));
                $EVENT_DATE_END = date('Y-m-d', strtotime($data->check_out));

                if (($rentDate >= $EVENT_DATE_BEGAIN) && ($rentDate < $EVENT_DATE_END)) {
                    $counter = 1;
                    // $array = array("Seasson" => $data->session, "Harga" => $data->harga, "Tanggal" => $allday[$i]);
                }
            }
        }
        return $counter;
    }

    public function cekKetEdit($id)
    {
        $checkIn = Request()->input('checkIn');
        $checkOut = Request()->input('checkOut');
        $kode = Request()->input('kodeR');
        $cek = DB::table('reservasi_villa')
            ->where('id_villa', $id)
            ->where('kode_reservasi', '!=', $kode)
            ->get();


        $period = new DatePeriod(
            new DateTime($checkIn),
            new DateInterval('P1D'),
            new DateTime($checkOut)
        );

        $counter = 0;
        foreach ($period as $date) {
            $day =  $date->format("Y-m-d");

            foreach ($cek as $data) {
                $rentDate = date($day);
                $rentDate = date('Y-m-d', strtotime($day));
                $array = [];

                $EVENT_DATE_BEGAIN = date('Y-m-d', strtotime($data->check_in));
                $EVENT_DATE_END = date('Y-m-d', strtotime($data->check_out));

                if (($rentDate >= $EVENT_DATE_BEGAIN) && ($rentDate < $EVENT_DATE_END)) {
                    $counter = 1;
                    // $array = array("Seasson" => $data->session, "Harga" => $data->harga, "Tanggal" => $allday[$i]);
                }
            }
        }
        return $counter;
    }

    public function getSeason($id)
    {
        $list = DB::table('session_sewas')->get();
        return response()->json($list);
    }

    public function show(Penyewaan $penyewaan)
    {
        //
    }

    public function delReservasi($id)
    {
        $penyewa = new ReservasiVilla();
        $penyewa->where('kode_reservasi', $id)->delete();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function delPenyewa($id)
    {
        $penyewa = new userSewa();
        $penyewa->where('id', $id)->delete();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function delVia($id)
    {
        $penyewa = new viaVilla();
        $penyewa->where('id', $id)->delete();
        return response()->json(['success' => 'Data Telah Disimpan!']);
    }

    public function delCicil($id)
    {
        $cicil = new PembayaranVilla();
        $reserv = new ReservasiVilla();
        $kode = Request()->input('kode');
        $cicil->where('id', $id)->delete();
        $lunas = 0;
        $reserv->where('kode_reservasi', $kode)->update([
            'lunas' =>  0,
            // 'status' = >
        ]);
        return response()->json(['success' => 'Data Telah Dihapus!']);
    }

    public function getCicilRe($id)
    {
        $list = DB::table('pembayaran_villa')
            ->where('kode_reservasi', $id)
            ->join('via_bayar', 'via_bayar.id', '=', 'pembayaran_villa.via_pay')
            ->select('pembayaran_villa.*', 'via_bayar.keterangan as pay')
            ->get();
        return response()->json($list);
    }

    public function addCicilVil(Request $request)
    {
        $cicil = new PembayaranVilla();
        $reserv = new ReservasiVilla();
        $tgl = $request->input('tgl');
        $id = $request->input('kode');
        $via = $request->input('viaPay');
        $match = ['kode_reservasi' => $id];
        $cekUser = DB::table('pembayaran_villa')->where($match)->get();
        // foreach ($cekUser as $data) {
        //     if ($data->kode_reservasi == $id) {
        //         if ($data->tanggal_bayar != $tgl) {
                    
        //         }
        //     } else {
        //         return response()->json(['success' => 'Keterangan Sudah Ada!']);
        //     }
        // }

        $cicil->kode_reservasi = $id;
        $cicil->nominal = $request->input('nominal');
        $cicil->tanggal_bayar = $tgl;
        $cicil->via_pay = $via;
        $cicil->status_bayar = $request->input('status');
        $cicil->save();


        $lunas = Request()->input('status');
        $reserv->where('kode_reservasi', $id)->update([
            'lunas' =>  $lunas,
            // 'status' = >
        ]);
        return response()->json(['success' => 'Data Berhasil Diubah!']);

    }

    public function getSisa(Request $request)
    {
        $id = $request->input('kode');
        $list = DB::table('pembayaran_villa')
            ->where('kode_reservasi', $id)
            ->sum('nominal');

        $dp = DB::table('reservasi_villa')
            ->where('kode_reservasi', $id)
            ->sum('first_pay');

        $tagihan = DB::table('reservasi_villa')
            ->where('kode_reservasi', $id)
            ->sum('tagihan');

        $sudah = $dp + $list;
        $total = $tagihan - $sudah;

        return response()->json($total);
    }

    public function getVillaReport($id)
    {
        $list = DB::table('harga_sewaGdg')
            ->join('assets', 'assets.id_assets', '=', 'harga_sewaGdg.id_assets')
            ->select('assets.id_assets', 'assets.nama_assets as asset')
            ->groupBy('assets.id_assets,assets.nama_assets as asset')
            ->get();
        return response()->json($list);
    }
}
