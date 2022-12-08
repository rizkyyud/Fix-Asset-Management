@extends('layouts\master')

@section('header-form')
    <h1>List Pesanan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
        <div class="breadcrumb-item">List Pesanan</div>
    </div>
@endsection
@section('content')
    <div class="card card-primary" id="isiCart">
        <div class="card-header card text-center" id="headerList">
        </div>
        <div class="card-body ">
            <table id="dt_items1" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Model</th>
                        <th>Merk</th>
                        <th>Warna</th>
                        <th>Status</th>
                        <th>Dokumen</th>
                        <th>Detail</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="section-body">
        <div class="card card-primary">
            <div class="card-header card text-center">
                <h4>List Keranjang Pesanan</h4>
            </div>
            <div class="card-body">
                <table id="dt_listPesanan" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Kode Keranjang</th>
                            <th>Nama Pemesan</th>
                            <th>Divisi</th>
                            <th>Cek Keranjang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($oList as $item)
                            <tr>
                                <td>
                                    {{ $item->kode_cart }}
                                </td>
                                <td>
                                    {{ $item->nama_pemesan }}
                                </td>
                                <td>
                                    {{ $item->divisi_pemesan }}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info" onclick="items({{ $item->id_cart }})">
                                        <i class="fas fa-clipboard-list"></i>
                                        Cek Pesanan
                                    </button>
                                </td>
                                <td>
                                    @if ($item->status == 'Validate')
                                        <a class="btn btn-success" href="orders/beli/{{ $item->id_cart }}"
                                            onclick="return confirm ('Konfirmasi Pembelian?');"><i
                                                class="fas fa-cart-plus"></i>
                                            Beli</a>
                                    @elseif($item->status == 'Waiting')
                                        <a class="btn btn-primary" href="orders/valid/{{ $item->id_cart }}"
                                            onclick="return confirm ('Request Validasi?');"><i
                                                class="fas fa-paper-plane"></i>
                                            Validasi</a>
                                    @elseif($item->status == 'Revisi' || $item->status == 'Request')
                                        <span class="badge badge-success">Menunggu Persetujuan</span>
                                    @elseif($item->status == 'Purchased')
                                        <span class="badge badge-success">Barang Telah Dibeli</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

{{-- List Barang --}}
@foreach ($cart as $item)
    <div class="modal fade" id="listB{{ $item->id_cart }}" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
            <div class="modal-content" style="overflow-y: initial">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="container"></div>
                <div class="card-header card text-center">
                    <h4 style="color:#677fe8">Isi Keranjang</h4>
                </div>
                <div class="modal-body ">
                    <table id="dt_items" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Model</th>
                                <th>Merk</th>
                                <th>Warna</th>
                                <th>Status</th>
                                <th>Detail</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- Detail Order Modal --}}
@foreach ($orders as $data)
    <div class="modal fade" id="detail{{ $data->id_orders }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        {{-- <i class="fas fa-times"></i> --}}
                    </button>
                </div>
                <div class="card">
                    <div class="card-header card text-center">
                        <h4>Detail Barang</h4>
                        <h4>({{ $data->kode_order }})</h4>
                        <br>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#listB{{ $data->id_cart }}" onclick="items({{ $data->id_cart }})">
                            <i class="fas fa-shopping-basket"></i>
                            Keranjang
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div id="demo" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="images/logo1.png" alt="Los Angeles">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="images/logo.png" alt="Chicago">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group row" id="C{{ $data->id_orders }}">

                                {{-- Barang --}}
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        id="vendor" disabled>
                                        <option selected disabled value="">Pilih Barang</option>
                                        @foreach ($barang as $items)
                                            <option value="{{ $items->id_barangIven }}"
                                                {{ $data->id_barangIven == $items->id_barangIven ? 'selected' : '' }}>
                                                {{ $items->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Vendor --}}
                                <div class="form-group">
                                    <label>Nama Vendor</label>
                                    <select class="form-select" aria-label=".form-select-sm example" name="vendor"
                                        id="vendor" disabled>
                                        <option selected disabled value="">Vendor Kosong</option>
                                        @foreach ($vendors as $items)
                                            <option value="{{ $items->id_vendor }}"
                                                {{ $data->id_vendor == $items->id_vendor ? 'selected' : '' }}>
                                                {{ $items->nama_vendor }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Pemesan --}}
                                <div class="form-group">
                                    <label>Nama Pemesan</label>
                                    <input type="text" class="form-control" readonly
                                        placeholder="Nama Pembeli Barang" value="{{ $data->nama_pemesan }}">
                                </div>

                                {{-- Pembeli --}}
                                <div class="form-group">
                                    <label>Nama Pembeli</label>
                                    <input type="text" class="form-control" readonly
                                        placeholder="Nama Pembeli Barang" value="{{ $data->nama_cek }}">

                                </div>

                                {{-- Validator --}}
                                <div class="form-group">
                                    <label>Nama Validator</label>
                                    <input type="text" class="form-control" readonly placeholder="Nama Validator"
                                        value="">
                                </div>

                                {{-- Harga --}}
                                <div class="form-group">
                                    <label>Harga Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Harga Barang"
                                        value="{{ $data->harga }}">
                                </div>
                            </div>

                            <div class="form-group row" id="D{{ $data->id_orders }}" hidden>
                                {{-- Model --}}
                                <div class="form-group">
                                    <label>Model Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Model Barang"
                                        value="{{ $data->model }}">
                                </div>

                                {{-- Merk --}}
                                <div class="form-group">
                                    <label>Merk Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Merk Barang"
                                        value="{{ $data->merk }}">
                                </div>

                                {{-- Warna --}}
                                <div class="form-group">
                                    <label>Warna Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Warna Barang"
                                        value="{{ $data->warna }}">
                                </div>

                                {{-- Ukuran --}}
                                <div class="form-group">
                                    <label>Ukuran Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Ukuran Barang"
                                        value="{{ $data->ukuran }}">
                                </div>

                                {{-- Jumlah --}}
                                <div class="form-group">
                                    <label>Jumlah Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Jumlah Barang"
                                        value="{{ $data->jlh_barang }}">
                                </div>

                                {{-- Alasan --}}
                                <div class="form-group">
                                    <label>Alasan Pembelian</label>
                                    <input type="text" class="form-control" readonly placeholder="Alasan Pembelian"
                                        value="{{ $data->alasan_beli }}">
                                </div>
                            </div>
                        </div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item"><a class="page-link" href="#"
                                        onclick="hideSeek({{ $data->id_orders }})">1</a></li>
                                <li class="page-item"><a class="page-link" href="#"
                                        onclick="hideSeek1({{ $data->id_orders }})">2</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- Edit Order Modal --}}
@foreach ($orders as $data)
    <div class="modal fade" id="editOrd{{ $data->id_orders }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        {{-- <i class="fas fa-times"></i> --}}
                    </button>
                </div>
                <div class="card">
                    <form class="needs-validation was-validated" novalidate=""
                        action="{{ url('/orders/Ama/' . $data->id_orders) }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ Session::get('id') }}">
                        <input type="hidden" name="namas" value="{{ Session::get('nama') }}">
                        <input type="hidden" name="divisi" value="{{ Session::get('divisi') }}">
                        <div class="card-header card text-center">
                            <h4>Form Edit Barang</h4>
                            <h4>({{ $data->kode_order }})</h4>
                            <br>
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#listB{{ $data->id_cart }}" onclick="items({{ $data->id_cart }})">
                                <i class="fas fa-shopping-basket"></i>
                                Keranjang
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Barang</label>
                                <div class="col-sm-9">
                                    @foreach ($barang as $items)
                                        @if ($data->id_barangIven == $items->id_barangIven)
                                            <input type="text" class="form-control" name="barang"
                                                value="{{ $items->nama_barang }}" disabled>
                                            <input type="hidden" name="barang" value="{{ $items->id_barangIven }}"
                                                id="barang" />
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Vendor</label>
                                <div class="col-sm-9">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        name="vendor" id="vendor{{ $data->id_orders }}" required="">
                                        <option selected value="">Pilih Vendor</option>
                                        @foreach ($vendors as $items)
                                            <option value="{{ $items->id_vendor }}"
                                                {{ $data->id_vendor == $items->id_vendor ? 'selected' : '' }}>
                                                {{ $items->nama_vendor }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Vendor Tidak Boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Model</label>
                                <div class="col-sm-9">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        name="model" id="model{{ $data->id_orders }}" required="">
                                        <option selected disabled value="">Pilih merk</option>
                                        @foreach ($model as $items)
                                            <option value="{{ $items->model }}"
                                                {{ $data->model == $items->model ? 'selected' : '' }}>
                                                {{ $items->model }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="invalid-feedback">
                                    Model Tidak Boleh kosong
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Merk</label>
                                <div class="col-sm-9">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        name="merk" id="merk{{ $data->id_orders }}" required="">
                                        <option selected disabled value="">Pilih Merk</option>
                                        @foreach ($merk as $items)
                                            <option value="{{ $items->merk }}"
                                                {{ $data->merk == $items->merk ? 'selected' : '' }}>
                                                {{ $items->merk }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Merk Tidak Boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Warna</label>
                                <div class="col-sm-9">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        name="warna" id="warna{{ $data->id_orders }}" required="">
                                        <option selected disabled value="">Pilih Warna</option>
                                        @foreach ($warna as $items)
                                            <option value="{{ $items->warna }}"
                                                {{ $data->warna == $items->warna ? 'selected' : '' }}>
                                                {{ $items->warna }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Warna Tidak Boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ukuran</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ukuran" placeholder="Ukuran Barang"
                                        value="{{ $data->ukuran }}" required="">
                                </div>
                                <div class="invalid-feedback">
                                    Ukuran Tidak Boleh kosong
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jumlah</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="jumlah" id="jumlah"
                                        placeholder="Jumlah Barang" required="" value="{{ $data->jlh_barang }}">
                                </div>
                                <div class="invalid-feedback">
                                    Jumlah Tidak Boleh Kosong
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Alasan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="alasan"
                                        placeholder="Alasan Pembelian" required="" value="{{ $data->alasan_beli }}">
                                </div>
                                <div class="invalid-feedback">
                                    Alasan Tidak Boleh Kosong
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Harga</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="harga" placeholder="Harga Barang"
                                        value="{{ $data->harga }}" required="">
                                </div>
                                <div class="invalid-feedback">
                                    Harga Tidak Boleh Kosong
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Foto Barang</label>
                                <div class="col-sm-9">
                                    <div class="dropzone dz-clickable" id="myDrop1">
                                        <div class="dz-default dz-message" data-dz-message="">
                                            <span>Upload or Drag Photo Here</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="count" id="tes" />
                        </div>
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-success">Check</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- Revisi Modal --}}
@foreach ($orders as $data)
    <div class="modal fade" id="revisi{{ $data->id_orders }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        {{-- <i class="fas fa-times"></i> --}}
                    </button>
                </div>
                <div class="card">
                    <form class="needs-validation was-validated" novalidate=""
                        action="{{ url('/orders/rev/' . $data->id_orders) }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ Session::get('id') }}">
                        <input type="hidden" name="namas" value="{{ Session::get('nama') }}">
                        <input type="hidden" name="divisi" value="{{ Session::get('divisi') }}">
                        <div class="card-header card text-center">
                            <h4>Form Edit Barang</h4>
                            <h4>({{ $data->kode_order }})</h4>
                            <br>
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#listB{{ $data->id_cart }}" onclick="items({{ $data->id_cart }})">
                                <i class="fas fa-shopping-basket"></i>
                                Keranjang
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Barang</label>
                                <div class="col-sm-9">
                                    @foreach ($barang as $items)
                                        @if ($data->id_barangIven == $items->id_barangIven)
                                            <input type="text" class="form-control" name="barang"
                                                value="{{ $items->nama_barang }}" disabled>
                                            <input type="hidden" name="barang" value="{{ $items->id_barangIven }}"
                                                id="barang" />
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Vendor</label>
                                <div class="col-sm-9">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        name="vendor" id="vendorR{{ $data->id_orders }}" required="">
                                        <option selected value="">Pilih Vendor</option>
                                        @foreach ($vendors as $items)
                                            <option value="{{ $items->id_vendor }}"
                                                {{ $data->id_vendor == $items->id_vendor ? 'selected' : '' }}>
                                                {{ $items->nama_vendor }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Vendor Tidak Boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Model</label>
                                <div class="col-sm-9">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        name="model" id="modelR{{ $data->id_orders }}" required="">
                                        <option selected disabled value="">Pilih merk</option>
                                        @foreach ($model as $items)
                                            <option value="{{ $items->model }}"
                                                {{ $data->model == $items->model ? 'selected' : '' }}>
                                                {{ $items->model }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="invalid-feedback">
                                    Model Tidak Boleh kosong
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Merk</label>
                                <div class="col-sm-9">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        name="merk" id="merkR{{ $data->id_orders }}" required="">
                                        <option selected disabled value="">Pilih Merk</option>
                                        @foreach ($merk as $items)
                                            <option value="{{ $items->merk }}"
                                                {{ $data->merk == $items->merk ? 'selected' : '' }}>
                                                {{ $items->merk }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Merk Tidak Boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Warna</label>
                                <div class="col-sm-9">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        name="warna" id="warnaR{{ $data->id_orders }}" required="">
                                        <option selected disabled value="">Pilih Warna</option>
                                        @foreach ($warna as $items)
                                            <option value="{{ $items->warna }}"
                                                {{ $data->warna == $items->warna ? 'selected' : '' }}>
                                                {{ $items->warna }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Warna Tidak Boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ukuran</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ukuran" placeholder="Ukuran Barang"
                                        value="{{ $data->ukuran }}" required="">
                                </div>
                                <div class="invalid-feedback">
                                    Ukuran Tidak Boleh kosong
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jumlah</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="jumlah" id="jumlah"
                                        placeholder="Jumlah Barang" required="" value="{{ $data->jlh_barang }}">
                                </div>
                                <div class="invalid-feedback">
                                    Jumlah Tidak Boleh Kosong
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Alasan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="alasan"
                                        placeholder="Alasan Pembelian" required="" value="{{ $data->alasan_beli }}">
                                </div>
                                <div class="invalid-feedback">
                                    Alasan Tidak Boleh Kosong
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Harga</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="harga" placeholder="Harga Barang"
                                        value="{{ $data->harga }}" required="">
                                </div>
                                <div class="invalid-feedback">
                                    Harga Tidak Boleh Kosong
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Foto Barang</label>
                                <div class="col-sm-9">
                                    <div class="dropzone dz-clickable" id="myDrop1">
                                        <div class="dz-default dz-message" data-dz-message="">
                                            <span>Upload or Drag Photo Here</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="count" id="tes" />
                        </div>
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-success">Check</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- Dokumen Pesanan --}}
<div class="modal fade" id="dokumen" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content" style="overflow-y: initial">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="container"></div>
            <div class="card">
                <div class="card-header card text-center" id="headerDok">
                </div>
                <div class="modal-body ">
                    <form class="needs-validation was-validated" id="dokumenLokFrm">
                        <div class="card card">
                            {{-- <div class="card-header card text-center">
                                <h4></h4>
                            </div> --}}
                            <div class="card-body" id="dropZone">
                                <div class="tab-content tab-bordered" id="myTab3Content">
                                    <div class="tab-pane fade show active" id="home2" role="tabpanel"
                                        aria-labelledby="home-tab2">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <div class="dropzone dz-clickable" id="myDrop">
                                                    <div class="dz-default dz-message" data-dz-message="">
                                                        <span>Upload or Drag Photo/File Here</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="card card-info">
                        <div class="card-header card text-center">
                            <h4>Tabel Dokumentasi</h4>
                        </div>
                        <div class="card-body">
                            <table id="dt_dokumen" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nama File</th>
                                        <th>Cek</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Note Modal --}}
@foreach ($orders as $data)
    <div class="modal fade" id="note{{ $data->id_orders }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="container"></div>
                <div class="modal-body">
                    <div class="card-header card text-center">
                        <h4 style="color:#677fe8">Alasan Penolakan</h4>
                        <h4 style="color:#677fe8">({{ $data->kode_order }})</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div>
                                <input type="text" class="form-control" name="keterangan" placeholder="keterangan"
                                    value="{{ $data->keterangan }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@include('sweetalert::alert')

@push('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    {{-- /////////////////////////////////////////////////////////////////////////////////////// --}}
    <script>
        $(document).ready(function() {
            $('#items').hide();
            $('#isiCart').hide();
            $('#dt_listPesanan').DataTable({
                "scrollX": true
            });
            $('#dt_items').DataTable({
                "scrollX": true
            });
            $('#dt_items1').DataTable().clear();
        });
    </script>

    {{-- Dropzone Input --}}
    {{-- <script type="text/javascript">
        var count = 0;
        Dropzone.autoDiscover = false;
        var uploadedDocumentMap = {}
        var myDropzone = new Dropzone("div#myDrop", {
            url: '{{ route('projects.storeMedia') }}',
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 5000,
            // autoProcessQueue: false,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                console.log(response);
                count++;
                var tes = "document" + count;
                $('form').append('<input type="hidden" name="' + tes + '" value="' + response.name + '">')
                document.getElementById("tes").value = count;
                uploadedDocumentMap[file.name] = response.name;

            },
            error: function(file, response) {
                return false;
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var tes = "document" + count;

                var name = file.name;
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="' + tes + '"][value="' + name + '"]').remove()
                $.ajax({
                    header: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    url: "assetsB/delfoto/" + name,
                    type: "get",
                    data: {
                        'file': name
                    },
                    dataTypes: 'json'
                });
                count--;
                document.getElementById("tes").value = count;
            },
            // 

        });
    </script> --}}

    {{-- Edit Js --}}
    <script>
        function edit(id) {
            $("#barang" + id).select2({
                dropdownParent: $("#editOrd" + id)
            })
            $("#vendor" + id).select2({
                dropdownParent: $("#editOrd" + id)
            })
            $("#model" + id).select2({
                dropdownParent: $("#editOrd" + id)
            })
            $("#merk" + id).select2({
                dropdownParent: $("#editOrd" + id)
            })
            $("#warna" + id).select2({
                dropdownParent: $("#editOrd" + id)
            })

            var input = document.getElementById("barang");
            var vendor = document.getElementById("vendor" + id);
            var cek = "";
            var vend = "";

            if (vendor) {
                vend = vendor.value;
                if (vend == "" || vend == null) {
                    if (input) {
                        cek = input.value;
                        console.log(cek);
                        $("#vendor" + id).children().remove();
                        $("#vendor" + id).append('<option selected value="">Pilih Vendor</option>');
                        // $("#vendor").prop('disabled', true)
                        if (cek != '' && cek != null) {
                            // $("subLokasi").prop('disabled', false)
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url: "getVendor/" + cek,
                                type: "GET",
                                success: function(res) {
                                    $.each(res, function(index, data) {
                                        $('#vendor' + id).append(
                                            '<option value="' + data.id_vendor + '">' + data
                                            .nama_vendor + '</option>'
                                        )
                                    })
                                }
                            })
                        }
                    }
                }
            }
        }
    </script>

    {{-- Revisi Js --}}
    <script>
        function revisi(id) {
            $("#barangR" + id).select2({
                dropdownParent: $("#revisi" + id)
            })
            $("#vendorR" + id).select2({
                dropdownParent: $("#revisi" + id)
            })
            $("#modelR" + id).select2({
                dropdownParent: $("#revisi" + id)
            })
            $("#merkR" + id).select2({
                dropdownParent: $("#revisi" + id)
            })
            $("#warnaR" + id).select2({
                dropdownParent: $("#revisi" + id)
            })

            var input = document.getElementById("barang");
            var vendor = document.getElementById("vendor" + id);
            var cek = "";
            var vend = "";

            if (vendor) {
                vend = vendor.value;
                if (vend == "" || vend == null) {
                    if (input) {
                        cek = input.value;
                        console.log(cek);
                        $("#vendor" + id).children().remove();
                        $("#vendor" + id).append('<option selected value="">Pilih Vendor</option>');
                        // $("#vendor").prop('disabled', true)
                        if (cek != '' && cek != null) {
                            // $("subLokasi").prop('disabled', false)
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url: "getVendor/" + cek,
                                type: "GET",
                                success: function(res) {
                                    $.each(res, function(index, data) {
                                        $('#vendor' + id).append(
                                            '<option value="' + data.id_vendor + '">' + data
                                            .nama_vendor + '</option>'
                                        )
                                    })
                                }
                            })
                        }
                    }
                }
            }
        }
    </script>

    {{-- List Barang JS --}}
    <script>
        function items(id) {
            $('#isiCart').show();
            $(document).ready(function() {
                $.ajax({
                    url: "cart/listB/" + id,
                    success: function(data) {
                        var html;

                        // var x = data.status;
                        html = `<h4 style="color:#677fe8">Isi Keranjang</h4>
                    <h4>(${data.kode_cart})</h4>
                    <br>`;
                        if (data.status == 'List') {
                            html += `<span type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#order${data.id_cart}"
                            onclick="tambah(${data.id_cart})">
                            <i class="fas fa-plus"></i>
                            Tambah Items
                        </span>`;
                        } else {
                            html +=
                                `<span class="badge badge-dark"> <i class="fas fa-lock"></i></span>`;
                        }
                        $('#headerList').html(html);
                    }
                });
                // $('#items').show();
                $('#dt_items1').DataTable().clear();
                $('#dt_items1').DataTable().destroy();

                $("#dt_items1").DataTable({
                    "scrollX": true,
                    "ajax": {
                        "url": "{{ url('') }}/cart/item/" + id,
                        "dataSrc": ""
                    },
                    "columnDefs": [{
                        "targets": [5, 6, 7],
                        "sortable": false,
                        "className": "dt-center",
                    }],
                    "columns": [{
                            "data": "id_barangIven",
                            "render": function(data, type, full, meta) {
                                var currentCell = $("#dt_items1").DataTable().cells({
                                    "row": meta.row,
                                    "column": meta.col
                                }).nodes(0);
                                $.ajax({
                                    url: "{{ url('') }}/cart/brg/" + data,
                                }).done(function(res) {
                                    $(currentCell).text(res);
                                });
                                return null;
                            }
                        },

                        {
                            "data": "model"
                        },

                        {
                            "data": "merk"
                        },
                        {
                            "data": "warna"
                        },
                        {
                            "data": "status"
                        },
                        {
                            "data": "id_orders",
                            "render": function(data, type, row) { // Tampilkan kolom aksi
                                var html =
                                    `<button class="btn btn-dark" href="#dokumen" data-bs-toggle="modal" data-bs-target="#dokumen" onclick="dok(${data})">
                                        <i class="fas fa-folder"></i></button>`
                                return html
                            }
                        },
                        {
                            "data": "id_orders",
                            "render": function(data, type, row) { // Tampilkan kolom aksi
                                var html =
                                    `<button class="btn btn-success" href="#detail" data-bs-toggle="modal" data-bs-target="#detail${data}" onclick="set(${data})">
                                        <i class="fas fa-eye"></i></button>`
                                return html
                            }
                        },
                        {
                            "data": "id_orders",
                            "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                                var html = "";
                                //
                                var status = row['status'];
                                var ket = row['keterangan'];
                                if (status == "Waiting" || status == "Check") {
                                    html +=
                                        `<button class="btn btn-primary" href="orders/${data}" data-bs-toggle="modal" data-bs-target="#editOrd${data}" onclick="edit(${data})">
                                        <i class="fas fa-clipboard-check"></i></button>`
                                } else if (status == "Request") {
                                    var html =
                                        `<span class="badge badge-primary">Menunggu Persetujuan</span>`
                                } else if (status == "Reject") {
                                    var html =
                                        `<span class="badge badge-danger">Tidak Disetujui</span>  | ` +
                                        `<button class="btn btn-danger" onclick="notePop()"><i class="fas fa-sticky-note"></i></button>` +
                                        `<input type="hidden" value="${ket}" id="note"></input>`

                                } else if (status == "Approve") {
                                    var html =
                                        `<span class="badge badge-success" disabled><i class="fas fa-check"></i></span> | ` +
                                        `<span class="badge badge-success">Menunggu Pembelian</span>`
                                } else if (status == "Revisi") {
                                    var html =
                                        `<button class="btn btn-warning" href="orders/${data}" data-bs-toggle="modal" data-bs-target="#revisi${data}" onclick="revisi(${data})">
                                        <i class="fas fa-clipboard-check"></i></button>`
                                } else if (status == "Purchased") {
                                    var html =
                                        `<span class="badge badge-success">Sudah Dibeli</span>`
                                }
                                return html;
                            }
                        },
                    ],

                })
            });
        }
    </script>

    {{-- Dokumen Pesanan --}}
    <script>
        function dok(id) {
            var status;
            $.ajax({
                url: "{{ url('') }}/cartLoad/detail/" + id,
                async: false,
                success: function(data) {
                    var html;
                    // var x = data.status;
                    html = `<h4 style="color:#677fe8">Dokumentasi</h4>
                    <h4>( Kode ${data[0].kode_order} Dan Nama Barang ${data[0].nama_barang} )</h4>
                    <br>`;
                    $('#headerDok').html(html);
                    status = data[0].status;
                }
            })

            $('#dt_dokumen').DataTable().clear();
            $('#dt_dokumen').DataTable().destroy();
            $("#dt_dokumen").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/cartDok/get/" + id,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "nama_file"
                    },
                    {
                        "data": "path",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<a href="${data}" class="btn btn-success" target="_blank"><i class="fas fa-eyes"></i>
                                    Cek</a>`;
                            //
                            return html;
                        }
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-danger" onclick="deleteDok(${data})"><i class="fas fa-trash-alt"></i>
                                    Del</button>`;
                            //
                            return html;
                        }
                    }
                ],
            });

            if (status == "Purchased" || status == "Validate") {
                $('#dropZone').hide();
            }
            var count = 0;
            Dropzone.autoDiscover = false;
            var uploadedDocumentMap = {}
            var myDropzone1 = new Dropzone("div#myDrop", {
                url: "{{ url('') }}/cart/storeMedia",
                // maxFilesize: 12,
                // autoProcessQueue: false,
                parallelUploads: 100,
                renameFile: function(file) {
                    var dt = new Date();
                    let time = dt.getTime();
                    var spar = "_";
                    return time + spar + file.name;
                },
                // acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.docx",
                addRemoveLinks: true,
                // timeout: 5000,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(file, response) {
                    console.log(response);
                    uploadedDocumentMap[file.name] = response.name;
                },
                error: function(file, response) {
                    return false;
                },
                init: function() {
                    this.on("sending", function(file, xhr, formData) {
                            formData.append('ids', id)
                        }),
                        this.on("complete", function(response) {
                            myDropzone1.removeAllFiles();
                            $('#dt_dokumen').DataTable().ajax.reload();
                        })
                }
            });
        }
        $(document).ready(function() {
            $('#dokumen').on('hidden.bs.modal', function(e) {
                if (Dropzone.instances.length > 0) Dropzone.instances.forEach(dz => dz.destroy());
            })
        });
    </script>

    {{-- Detail Modal Js --}}
    <script>
        function set(id) {
            $(document).ready(function() {
                $(`#D${id}`).hide();
            });
        }

        function hideSeek(id) {
            $(`#D${id}`).hide();;
            $(`#C${id}`).show();;
        }

        function hideSeek1(id) {
            $(`#C${id}`).hide();;
            $(`#D${id}`).show();;
        }
    </script>

    {{-- Script Note --}}
    <script>
        function notePop() {
            $(document).ready(function() {
                var ket = document.getElementById('note').value;
                swal({
                    title: "Alasan Penolakan",
                    icon: "warning",
                    text: ket
                });
            });
        }
    </script>

    {{-- Load List Js --}}
    <script>
        $(document).ready(function() {
            // $('#items').show();
        });
    </script>
@endpush
