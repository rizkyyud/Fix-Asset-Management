<?php

namespace App\Http\Controllers;

use App\Models\listPesan;
use App\Models\Order;
use App\Models\ValidOrd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidOrdController extends Controller
{
    public function index()
    {
        return view('validPesanan');
    }

    public function show()
    {
        $list = DB::table('valid_ords')->where('list_pesanan.status', '!=', 'Pembelian')
            ->join('list_pesanan', 'list_pesanan.id', '=', 'valid_ords.id_cart')
            ->join('IventoryId', 'IventoryId.Id', '=', 'list_pesanan.id_pemilik')
            ->select('list_pesanan.kode', 'list_pesanan.status', 'IventoryId.Keterangan as nama', 'valid_ords.*')
            ->get();
        return response()->json($list);
    }

    public function getAllTtd($id)
    {
        $pemilik = DB::table('list_pesanan')->where('list_pesanan.id', $id)
            ->join('IventoryId', 'IventoryId.Id', '=', 'list_pesanan.id_pemilik')
            ->select('IventoryId.Keterangan as Pemilik')
            ->first();

        $fama = DB::table('req_pesanans')->where('req_pesanans.id_cart', $id)
            ->join('IventoryId', 'IventoryId.Id', '=', 'req_pesanans.id_checker')
            ->select('IventoryId.Keterangan as Checker')
            ->first();

        $approve = DB::table('valid_ords')->where('valid_ords.id_cart', $id)
            ->join('IventoryId', 'IventoryId.Id', '=', 'valid_ords.id_validator')
            ->select('IventoryId.Keterangan as Validator')
            ->first();

        $hsl = [$pemilik, $fama,$approve];

        return response()->json(['hsl' => $hsl]);
    }

    public function getPoTabel($id)
    {
        $item = DB::table('orders')->where('orders.id_cart', $id)
            ->join('barangs', 'barangs.id', '=', 'orders.id_barang')
            ->join('vendors', 'orders.id_vendor', '=', 'vendors.id_vendor')
            ->join('assets', 'assets.id_assets', '=', 'orders.id_assets')
            ->select('orders.*', 'barangs.nama', 'vendors.nama_vendor', 'assets.nama_assets')
            ->get();
        return response()->json($item);
    }

    public function approve($id)
    {
        $triger = 0;
        $orders = new Order();
        $cart = new listPesan();
        $item = Request()->get('id');
        $ids = Request()->get('ids');
        // $namas = Request()->get('namas');
        // $divisi = Request()->get('divisi');

        $orders->where('id', $item)->update([
            'status' => "Approve",
            'note' => null
        ]);

        $set = DB::table('orders')->where('id_cart', $id)->get();
        foreach ($set as $cekList) {
            if ($cekList->status == "Request" || $cekList->status == "Revisi") {
                $triger = 1;
            }
        }
        if ($triger == 0) {
            $cart->where('id', $id)->update([
                'status' => "Validate",
            ]);
        }

        $valid = new ValidOrd();
        $valid->where('id_cart', $id)->update([
            'id_validator' => $ids,
        ]);

        return response()->json(['success' => 'Validation updated successfully']);
    }

    public function reject($id)
    {
        $triger = 2;
        $orders = new Order();
        $cart = new listPesan();
        $list = Request()->get('id');
        // $match = ['id_cart' => $id, 'status' => 'Request'];
        $note = Request()->get('alasan');
        $ids = Request()->get('ids');
        // $namas = Request()->get('namas');
        // $divisi = Request()->get('divisi');

        $orders->where('id_orders', $list)->update([
            'status' => "Reject",
            'note' => $note
        ]);

        $set = DB::table('orders')->where('id_cart', $id)->get();
        foreach ($set as $cekList) {
            if ($cekList->status == "Waiting" || $cekList->status == "Request" || $cekList->status == "Revisi") {
                $triger = 1;
            } else {
                $triger == 0;
            }
        }
        if ($triger == 0) {
            $cart->where('id', $id)->update([
                'status' => "Validate",
            ]);
        }
        $valid = new ValidOrd();
        $valid->where('id_cart', $id)->update([
            'id_validator' => $ids,
        ]);
        return response()->json(['success' => 'Data Berhasil Dirubah!']);
    }

    public function approveAll($id)
    {
        $triger = 0;
        $orders = new Order();
        $cart = new listPesan();
        $ids = Request()->get('ids');
        // $namas = Request()->get('namas');
        // $divisi = Request()->get('divisi');

        $orders->where('id_cart', $id)->update([
            'status' => "Approve",
            'note' => null
        ]);

        $cart->where('id', $id)->update([
            'status' => "Validate",
        ]);

        $valid = new ValidOrd();
        $valid->where('id_cart', $id)->update([
            'id_validator' => $ids,
        ]);

        return response()->json(['success' => 'Validation updated successfully']);
    }
}
