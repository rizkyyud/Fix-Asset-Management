<?php

namespace App\Http\Controllers;

use App\Models\BarangIn;
use Illuminate\Support\Facades\DB;
use App\Models\barangIven;
use App\Models\jenisIventaris;
use App\Models\Merk;
use App\Models\ModelB;
use App\Models\Vendors;
use App\Models\Orders;
use App\Models\Warna;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class Controller_Orders extends Controller
{
    protected $kode_order;

    public function index()
    {
        //
        $barang = barangIven::get();
        $vendors = Vendors::get();
        $jenis = jenisIventaris::get();
        $model = ModelB::get();
        $merk = Merk::get();
        $warna = Warna::get();
        $orders = Orders::orderBy('id_orders', 'DESC')->get();

        return view('orders', [
            'barang' => $barang,
            'jenis' => $jenis,
            'orders' => $orders,
            'vendors' => $vendors,
            'model' => $model,
            'merk' => $merk,
            'warna' => $warna
        ]);
    }

    public function getCode($id)
    {
        $data = DB::table('barang_iven')->where('id_barangIven', $id)->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        // Pembuatan Kode Order Otomatis
        $kode_order = $this->kode_order();
        //Tutup Kode Order


        // dd($request->all());
        $request->validate([
            'imageFile.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
        ]);

        $tes = array();
        $count = $request->input('count');
        for ($i = 1; $i <= $count; $i++) {

            $storage = storage_path('app/temp/') . $request->input("document$i");
            $public = public_path('images/Orders/');
            $name = 'Assets_' . $request->input("document$i");
            $path = $public . $name;
            array_push($tes, $name);
            File::move($storage, $path);
        }
        $orders = new Orders;

        $orders->id_barangIven = $request->input('barang');
        $orders->id_vendor = $request->input('vendor');
        $orders->kode_order = $kode_order;
        $orders->jlh_barang = $request->input('jumlah');
        $orders->alasan_beli = $request->input('alasan');
        $orders->foto = json_encode($tes);
        // $foto = json_encode($tes);
        // dd(json_encode($tes));
        $orders->save();
        Alert::success('Success', 'Data Berhasil Disimpan!');
        return redirect('orders')->with('success', 'Data Berhasil Disimpan!');
        // dd($kode_order);
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('app/temp/');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        // $ext = strtolower($file->getClientOriginalExtension());

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function editAma($id)
    {
        //
        $orders = new Orders;
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
            'status' => "Progress",
            'keterangan' => Request()->input('keterangan'),


        ]);
        // Alert::success('Success', 'Data Berhasil Dirubah!');
        return back()->with('success', 'Data Berhasil Dirubah!');
    }


    public function edit($id)
    {
        //
    }

    public static function kode_order()
    {
        $now = Carbon::now();
        $bln = $now->month;
        $year = $now->year;
        $count = Orders::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $bln)
            ->count();
        $thnBulan = $now->year . $bln;
        $nomor = ($count + 1);
        $format = null;

        if ($count < 9 && $count >= 0) {
            $format = '000' . $nomor;
        } else if ($count < 99 && $count >= 10) {
            $format = '00' . $nomor;
        } else if ($count < 999 && $count >= 100) {
            $format = '0' . $nomor;
        } else {
            $format = $nomor;
        }
        $kode_order = 'ORD/' . $thnBulan . '/' . $format;
        return $kode_order;
    }

    public function getVendors($id_barangIven)
    {

        $jenis = DB::table('barang_iven')->where('id_barangIven', $id_barangIven)->pluck('jenis')->first();
        $data = DB::table('vendors')->where('jenis', 'like', "%" . $jenis . "%")->get();
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        //
        $orders = new Orders;
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
            'id_tempat' => Request()->input('asset'),
            'id_subTem' => Request()->input('sub'),
            // 'status' => "Request",
        ]);
        // Alert::success('Success', 'Data Berhasil Dirubah!');
        return back()->with('success', 'Data Berhasil Dirubah!');
    }

    public function revisi($id)
    {
        $orders = new Orders;
        $orders->where('id_orders', $id)->update([
            'status' => "Revision",
        ]);
        return back()->with('success', 'Order Sudah Dibeli!');
    }

    public function reject($id)
    {
        $orders = new Orders;
        $orders->where('id_orders', $id)->update([
            'status' => "Rejected",
        ]);
        return back()->with('success', 'Data Berhasil Dirubah!');
    }

    public function cancel($id)
    {
        $orders = new Orders;
        $orders->where('id_orders', $id)->update([
            'status' => "Progress",
        ]);
        return back()->with('success', 'Data Berhasil Dirubah!');
    }

    public function destroy($id)
    {
        //
        $fotos = DB::table('pesanan')->where('id_orders', $id)->first();
        $orders = new Orders();
        $foto = json_decode($fotos->foto);
        if ($foto != null) {
            $path = public_path('images/Orders/');
            // dd($foto);
            foreach ($foto as $item) {
                $filename = $item;
                unlink($path . $filename);
            }
        }
        $orders->where('id_orders', $id)->delete();
        return back()->with('success', 'Barang Telah Dihapus Dari Keranjang');;
    }

    public function delfoto($name)
    {
        $path = storage_path('app/temp/');
        $filename = $path . $name;
        unlink($filename);
    }
}
