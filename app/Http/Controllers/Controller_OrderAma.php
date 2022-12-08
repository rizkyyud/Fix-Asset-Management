<?php

namespace App\Http\Controllers;

use App\Models\BarangIn;
use App\Models\Merk;
use App\Models\barangIven;
use App\Models\jenisIventaris;
use App\Models\Keranjang;
use App\Models\Vendors;
use App\Models\Orders;
use App\Models\ModelB;
use App\Models\OrderAma;
use App\Models\Pembelian;
use App\Models\ValidOrder;
use App\Models\Warna;
use Illuminate\Support\Facades\DB;

class Controller_OrderAma extends Controller
{
    public function index()
    {
        $barang = barangIven::get();
        $vendors = Vendors::get();
        $jenis = jenisIventaris::get();
        $model = ModelB::get();
        $merk = Merk::get();
        $warna = Warna::get();
        $cart  = Keranjang::get();
        $orderList = OrderAma::get();
        $orders = Orders::orderBy('id_orders', 'DESC')->get();

        $tes = DB::table('keranjang')
            // ->join('vorder', 'keranjang.id_cart', '=', 'vorder.id_cart')
            // ->join('pesanan', 'keranjang.id_cart', '=', 'pesanan.id_cart')
            ->join('order_list', 'order_list.id_cart', '=', 'keranjang.id_cart')
            ->select('keranjang.*', 'order_list.id_pembeli')
            ->get();
        $all = DB::table('keranjang')
            ->join('order_list', 'order_list.id_cart', '=', 'keranjang.id_cart')
            ->join('pesanan', 'keranjang.id_cart', '=', 'pesanan.id_cart')
            ->select('keranjang.*', 'pesanan.*', 'order_list.*')
            ->get();
        // dd($all);
        return view('orderAma', [
            'barang' => $barang,
            'jenis' => $jenis,
            'orders' => $all,
            'vendors' => $vendors,
            'model' => $model,
            'merk' => $merk,
            'warna' => $warna,
            'cart' => $cart,
            'oList' => $tes,
        ]);
    }

    public function editAma($id)
    {
        //
        $orders = new Orders;
        $cart = $orders->where('id_orders', $id)->pluck('id_cart')->first();
        $ama = new OrderAma;
        $ids = Request()->input('id');
        $namas = Request()->input('namas');
        $divisi = Request()->input('divisi');
        $orders->where('id_orders', $id)->update([
            'id_barangIven' => Request()->input('barang'),
            'id_vendor' => Request()->input('vendor'),
            'model' => Request()->input('model'),
            'merk' => Request()->input('merk'),
            'warna' => Request()->input('warna'),
            'ukuran' => Request()->input('ukuran'),
            'jlh_barang' => Request()->input('jumlah'),
            'alasan_beli' => Request()->input('alasan'),
            'harga' => Request()->input('harga'),
            'status' => "Check",
        ]);
        $ama->where('id_cart', $cart)->update([
            'id_pembeli' => $ids,
            'nama_cek' => $namas,
            'divisi_cek' => $divisi,
        ]);
        return back()->with('success', 'Data Berhasil Dirubah!');
    }

    public function revisi($id)
    {
        //
        $orders = new Orders;
        $ama = new OrderAma;
        $cart = $orders->where('id_orders', $id)->pluck('id_cart')->first();
        $ids = Request()->input('id');
        $namas = Request()->input('namas');
        $divisi = Request()->input('divisi');
        $orders->where('id_orders', $id)->update([
            'id_barangIven' => Request()->input('barang'),
            'id_vendor' => Request()->input('vendor'),
            'model' => Request()->input('model'),
            'merk' => Request()->input('merk'),
            'warna' => Request()->input('warna'),
            'ukuran' => Request()->input('ukuran'),
            'jlh_barang' => Request()->input('jumlah'),
            'alasan_beli' => Request()->input('alasan'),
            'harga' => Request()->input('harga'),
            'status' => "Request",
        ]);
        $ama->where('id_cart', $cart)->update([
            'id_pembeli' => $ids,
            'nama_cek' => $namas,
            'divisi_cek' => $divisi,
        ]);
        return back()->with('success', 'Data Berhasil Dirubah!');
    }

    public function valid($id)
    {
        //
        $triger = 0;
        $orders = new Orders;
        $cart = new Keranjang();
        $cek = DB::table('pesanan')->where('id_cart', $id)->get();
        foreach ($cek as $cekList) {
            if ($cekList->status == "Waiting" || $cekList->status == "Request" || $cekList->status == "Revisi") {
                $triger = 1;
            }
        }

        if ($triger == 1) {
            // dd($triger);
            return back()->with('warning', 'Data Belum Di Cek Semua');
        } else {
            // dd($triger);
            $orders->where('id_cart', $id)->update([
                'status' => "Request",
            ]);
            $cart->where('id_cart', $id)->update([
                'status' => "Request",
            ]);
            dd($orders);
            // $valid = new ValidOrder();
            // $valid->id_cart = $id;
            // $valid->save();
            // return back()->with('success', 'Menunggu Validasai!');
        }
    }

    public function stat($id)
    {
        $stat = DB::table('pesanan')->where('id_orders', $id)->pluck('status')->first();
        return response()->json($stat);
    }

    public function getVendors($id_barangIven)
    {

        $jenis = DB::table('barang_iven')->where('id_barangIven', $id_barangIven)->pluck('id_jenisIven')->first();
        $data = DB::table('vendors')->where('jenis', 'like', "%" . $jenis . "%")->get();
        return response()->json($data);
    }

    public function beli($id)
    {
        $orders = new Orders;
        $barangIn = new BarangIn();
        $cart = new Keranjang();
        $beli = new Pembelian();

        $match = ['id_cart' => $id, 'status' => 'Approve'];
        $fix = DB::table('pesanan')->where($match)->get();
        foreach ($fix as $cek) {
            $beli->id_orders = $cek->id_orders;
            $beli->save();

            $barangIn->id_orders = $cek->id_orders;
            $barangIn->status = 'Waiting';
            $barangIn->save();

            $orders->where('id_orders', $cek->id_orders)->update([
                'status' => "Purchased",
            ]);
            $cart->where('id_cart', $id)->update([
                'status' => "Purchased",
            ]);
        }
        return back()->with('success', 'Order Sudah Dibeli!');
    }
}
