@extends('layouts\master')
@section('header-form')
    <h1>Pemesanan Barang</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="\">Home</a></div>
        <div class="breadcrumb-item">Pesanan</div>
    </div>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Menu Pemesanan</h4>
            <div class="card-header-action">
                <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i
                        class="fas fa-minus"></i></a>
            </div>
        </div>
        <div class="collapse show" id="mycard-collapse" style="">
            <div class="card-body">
                <ul class="nav nav-tabs justify-content-center" id="myTab1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pemesanan-tab" data-toggle="tab" href="#pesan" role="tab"
                            aria-controls="home" aria-selected="true">Pemesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="cart-tab" data-toggle="tab" href="#cartList" role="tab"
                            aria-controls="profile" aria-selected="false" onclick="cart()">Keranjang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="report-tab2" data-toggle="tab" href="#report" role="tab"
                            aria-controls="report" aria-selected="false" onclick="listPesan()">Histori Pesanan</a>
                    </li>
                </ul>
                <div class="tab-content tab-bordered" id="myTab1Content">
                    <div class="tab-pane fade show active" id="pesan" role="tabpanel" aria-labelledby="pemesanan-tab">
                        <form class="needs-validation was-validated" id="frmItemAdd">
                            @csrf
                            <div class="card-header card text-center">
                                <h4 style="color: #023e8a">Tambah Pesanan Keranjang</h4>
                            </div>
                            <div class="card-body">
                                <input type="text" class="form-control" name="idBarang" id="idB" hidden>
                                <div class="form-group row">
                                    <div class="col-sm-11">
                                        <label>Nama Barang</label>
                                        <input type="text" class="form-control" name="nama" id="namaB"
                                            required="" readonly>
                                        <div class="invalid-feedback">
                                            Harus Diisi
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <label> Barang </label>
                                        <br>
                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#plhBarang" onclick="listB()">
                                            Pilih
                                        </a>
                                    </div>
                                </div>
                                <div style="display: none" id="listForm">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Vendor</label>
                                            <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                                required="" id="vendorIn">
                                                <option value="" disabled selected hidden>Pilih Vendor</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Harus Dipilih
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Lokasi Asset</label>
                                            <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                                required="" id="assetIn">
                                                <option value="" disabled selected hidden>Pilih Asset</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Harus Dipilih
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Lokasi Sub Asset</label>
                                            <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                                required="" id="subIn">
                                                <option value="" disabled selected hidden>Pilih Sub Asset</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Harus Dipilih
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Jumlah Barang</label>
                                            <input type="number" min="1" class="form-control" name="jlh"
                                                id="jlhIn" placeholder="0" required=""
                                                value="{{ old('jlh') }}">
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Alasan Pembelian</label>
                                            <input type="text" class="form-control" name="alasan" id="alasanIn"
                                                placeholder="Alasan" required="">
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Harga Barang(/Item)</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="number" min="0" placeholder="0"
                                                    class="form-control" id="hargaIn" required autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button class="btn btn-success" type="submit" id="tbhBrg" disabled>Tambahkan</button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="cartList" role="tabpanel" aria-labelledby="cart-tab">
                        <div class="card">
                            <div class="card-header card text-center">
                                <h4 style="color: #023e8a">Keranjang Pesanan</h4>
                                <div class="card-header-action">
                                    <a href="#" class="btn btn-primary" onclick="pesan()" style="display: blok">
                                        <i class="fas fa-cart-arrow-down"></i> Check Out
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="dt_wish" class="display nowrap dataTable dtr-inline collapsed"
                                    style="width: 100%; table-layout:auto" aria-describedby="example_info">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Harga (/Piece)</th>
                                            <th>Total Harga</th>
                                            <th>Alasan</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="report" role="tabpanel" aria-labelledby="report-tab2">
                        <div class="card">
                            <div class="card-header card text-center">
                                <h4 style="color: #023e8a">Histori Pesanan</h4>
                            </div>
                            <div class="card-body">
                                <table id="dt_orderL" class="display nowrap dataTable dtr-inline collapsed"
                                    style="width: 100%;" aria-describedby="example_info">
                                    <thead>
                                        <tr>
                                            <th>Detail</th>
                                            <th>Tanggal Pesan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                Menu Pemesanan Barang
            </div>
        </div>
    </div>

    <div class="card card-info">
        <div class="card-header">
            <h4>Menu Penambahan</h4>
            <div class="card-header-action">
                <a data-collapse="#menuPenambahan" class="btn btn-icon btn-info" href="#"><i
                        class="fas fa-minus"></i></a>
            </div>
        </div>
        <div class="collapse show" id="menuPenambahan" style="">
            <div class="card-body">
                <ul class="nav nav-tabs justify-content-center" id="myTab2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="newBarang-tab" data-toggle="tab" href="#newBarang"
                            role="tab" aria-controls="newBarang" aria-selected="true">New Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="model-tab" data-toggle="tab" href="#newModel" role="tab"
                            aria-controls="newModel" aria-selected="false" onclick="modelAdd()">New Model</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="merk-tab" data-toggle="tab" href="#newMerk" role="tab"
                            aria-controls="newMerk" aria-selected="false" onclick="merkAdd()">New Merk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="warna-tab" data-toggle="tab" href="#newWarna" role="tab"
                            aria-controls="newWarna" aria-selected="false" onclick="warnaAdd()">New Warna</a>
                    </li>
                </ul>
                <div class="tab-content tab-bordered" id="myTab2Content">
                    <div class="tab-pane fade show active" id="newBarang" role="tabpanel"
                        aria-labelledby="newBarang-tab">
                        <div class="card">
                            <form class="needs-validation was-validated" id="frmBrgAdd">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Nama Barang</label>
                                            <input type="text" class="form-control" name="barangAdd" id="barangAdd"
                                                readonly required="" placeholder="Nama"
                                                value="{{ old('barangAdd') }}">
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Kategori</label>
                                            <select class="form-select form-select-sm"
                                                aria-label=".form-select-sm example" required="" name="drpKate"
                                                id="drpKate">
                                                <option value="">Pilih Kategori Barang</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Merk</label>
                                            <select class="form-select form-select-sm"
                                                aria-label=".form-select-sm example" required="" name="drpMerk"
                                                id="drpMerk">
                                                <option value="">Pilih Merk Barang</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Model</label>
                                            <select class="form-select form-select-sm"
                                                aria-label=".form-select-sm example" required="" name="drpModel"
                                                id="drpModel">
                                                <option value="">Pilih Model Barang</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Warna</label>
                                            <select class="form-select form-select-sm"
                                                aria-label=".form-select-sm example" required="" name="drpWarna"
                                                id="drpWarna">
                                                <option value="">Pilih Warna Barang</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Ukuran Barang</label>
                                            <input type="text" class="form-control" name="ukuranAdd" id="ukuranAdd"
                                                required="" placeholder="Ukuran" value="{{ old('ukuranAdd') }}">
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="newModel" role="tabpanel" aria-labelledby="model-tab">
                        <div class="card">
                            <form class="needs-validation was-validated" id="frmModelAdd">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Nama Model</label>
                                            <input type="text" class="form-control" name="model" id="modelAdd"
                                                placeholder="Model" required="" value="{{ old('model') }}">
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Kode Merk</label>
                                            <input type="text" class="form-control" name="kodeModel" id="kodeModel"
                                                maxlength="3" placeholder="Kode Model" required=""
                                                value="{{ old('kodeModel') }}" style="text-transform:uppercase">
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer text-right">
                                    <button type="button" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="newMerk" role="tabpanel" aria-labelledby="merk-tab">
                        <div class="card">
                            <form class="needs-validation was-validated" id="frmMerkAdd">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Nama Merk</label>
                                            <input type="text" class="form-control" name="merk" id="merkAdd"
                                                required="" value="{{ old('merk') }}" placeholder="Merk">
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Kode Merk</label>
                                            <input type="text" class="form-control" name="kodeMerk" id="kodeMerk"
                                                maxlength="3" placeholder="Kode Merk" required=""
                                                value="{{ old('kodeMerk') }}" style="text-transform:uppercase">
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="button" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="newWarna" role="tabpanel" aria-labelledby="warna-tab">
                        <div class="card">
                            <form class="needs-validation was-validated" id="frmWarnaAdd">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Nama Warna</label>
                                            <input type="text" placeholder="Warna" class="form-control"
                                                name="warna" id="warnaAdd" required=""
                                                value="{{ old('warna') }}">
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="button" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                Menu Tambah Barang
            </div>
        </div>
    </div>
@endsection
{{-- @include('Modal\pesananModal') --}}

{{-- Pilih Baramg --}}
<div class="modal fade" id="plhBarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body ">
                <div class="card">
                    <div class="card-header card text-center">
                        <h4>Pilihan Barang</h4>
                    </div>
                    <div class="card-body">
                        <div class="row filter-row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group form-focus">
                                    <label>Klasifikasi</label>
                                    <select class="form-control" id="filKate">
                                        <option value="">Pilih Klasifikasi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group form-focus">
                                    <label>Kategori</label>
                                    <select class="form-control" id="filTipe">
                                        <option value="">Pilih Kategori</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table id="dt_barang" class="display nowrap dataTable dtr-inline collapsed"
                            style="width: 100%;" aria-describedby="example_info">
                            <br>
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Model</th>
                                    <th>Merk</th>
                                    <th>Warna</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Dokumen Pesanan --}}
<div class="modal fade" id="dokumenOrd" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollbar-y">
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
                    <div class="card">
                        <div class="tab-content tab-bordered" id="myTab3Content">
                            <div class="tab-pane fade show active" id="home2" role="tabpanel"
                                aria-labelledby="home-tab2">
                                <form class="needs-validation was-validated" id="dokumenLokFrm">
                                    <div class="card card">
                                        <div class="card-body" id="dropZone">
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
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="tab-content tab-bordered" id="myTab3Content">
                            <div class="tab-pane fade show active" id="home2" role="tabpanel"
                                aria-labelledby="home-tab2">
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
    </div>
</div>

{{-- Detail Pesanan --}}
<div class="modal fade" id="detailOrd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body ">
                <div class="container-fluid">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card text-center" id="detailHead">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container-fluid">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-header card text-center">
                                    <h4 style="color: #023e8a">Detail Barang</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <strong class="col-5">Nama</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="namaD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Klasifikasi</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="kateD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Kategori</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="tipeD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Merk</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="merkD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Model :</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="modelD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Warna :</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="warnaD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Ukuran :</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="ukuranD"></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container-fluid">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-header card text-center">
                                    <h4 style="color: #023e8a">Detail Pesanan</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <strong class="col-5">Vendor</strong>
                                        <strong class="col-1">:</strong>
                                        <strong class="col-5" id="vendorD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Lokasi Asset</strong>
                                        <strong class="col-1">:</strong>
                                        <strong class="col-5" id="assetD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Lokasi Sub Asset</strong>
                                        <strong class="col-1">:</strong>
                                        <strong class="col-5" id="subD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Jumlah</strong>
                                        <strong class="col-1">:</strong>
                                        <strong class="col-5" id="jlhD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Alasan</strong>
                                        <strong class="col-1">:</strong>
                                        <strong class="col-5" id="alasanD"></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

    {{-- Rupiah Formating --}}
    <script>
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        function convertToAngka(rupiah) {
            return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
        }
    </script>

    {{-- Menu Pemesanan --}}
    <script>
        var cekCart = 0;
        var cekHistory = 0;
        $(document).ready(function() {
            $('#menuPenambahan').collapse("hide");

            // Sub Asset Drop Down
            $('#assetIn').on('change', function() {
                var id = $(this).val();

                if (id != '' && id != null) {
                    $.ajax({
                        url: "{{ url('') }}/subAsset/load/" + id,
                        type: "GET",
                        success: function(res) {
                            $("#subIn").select2({});
                            $("#subIn").children().remove();
                            $('#subIn').append(`<option value="0">Tanpa Sub</option>`)
                            $.each(res, function(index, data) {
                                $('#subIn').append(
                                    '<option value="' + data.id + '">' + data
                                    .nama_subAsset + '</option>'
                                )
                            })
                        }
                    })
                }
            });


            // Reset Form
            $('#itemIn').on('hidden.bs.modal', function() {
                $("#frmItemAdd")[0].reset();
            });

            $('#frmItemAdd').on('submit', function(e) {
                e.preventDefault();
                $("#frmItemAdd").unbind().click(function() {});
                let nama = $('#namaB').val();
                let barang = $('#idB').val();
                let asset = $('#assetIn').val();
                let alasan = $('#alasanIn').val();
                let harga = $('#hargaIn').val();
                let jumlah = $('#jlhIn').val();
                let sub = $('#subIn').val();
                let vendor = $('#vendorIn').val();
                var ids = `<?php echo Session::get('id'); ?>`;

                $.ajax({
                    url: "{{ url('') }}/pesanan/in",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        barang: barang,
                        asset: asset,
                        alasan: alasan,
                        harga: harga,
                        jumlah: jumlah,
                        sub: sub,
                        ids: ids,
                        vendor: vendor
                    },
                    success: function(res) {
                        $('#assetIn').val('').change();
                        $("#frmItemAdd")[0].reset();
                        $('#subIn').children().remove();
                        $('#vendorIn').children().remove();
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });
            });

        });

        // List Keranjang
        function cart() {
            if (cekCart == 0) {
                cekCart == 1;
                var ids = `<?php echo Session::get('id'); ?>`;
                $('#showCart').show();
                $('#showItem').hide();
                $('#showOrderL').hide();

                $('#dt_wish').DataTable().clear();
                $('#dt_wish').DataTable().destroy();
                var table = $("#dt_wish").DataTable({
                    "scrollX": true,
                    "columnDefs": [{
                        "targets": '_all',
                        "sortable": false,
                        "className": "dt-center",
                    }],
                    "order": [
                        [1, 'asc']
                    ],
                    "ajax": {
                        "url": "{{ url('') }}/pesanan/wishList/" + 1,
                        "dataSrc": "",
                        "data": {
                            "_token": "{{ csrf_token() }}",
                            ids: ids
                        },
                        "async": false
                    },
                    "columns": [{
                            "data": "id",
                            "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                                var nama = row['nama'];
                                var cekData = row['cekData'];
                                var html = '';
                                html +=
                                    `<div class="container">
                                        <div class="col-12" style="margin-top: 5px;">
                                            <a> ${nama} </a>
                                        </div>
                                        <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                            <button onclick="deleteWish(${data},${cekData})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>                                            
                                        </div>
                                </div>`;
                                // <button class="btn btn-primary" data-bs-toggle="modal"
                                //         data-bs-target="#dokumenOrd" onclick="dokOrder(${data})"><i class="fas fa-folder"></i>
                                //         </button>
                                return html;
                            }
                        },
                        {
                            "data": "jumlah"
                        },
                        {
                            "data": "harga",
                            render: $.fn.dataTable.render.number(',', '.', 2, 'Rp')
                        },
                        {
                            "data": "jumlah",
                            "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                                var harga = row['harga'];
                                var html = harga * data;
                                html = formatRupiah(html.toString(), 'Rp.');
                                return html;
                            }
                        },
                        {
                            "data": "alasan"
                        }
                    ],
                })

                var cekRow = 0;
                $('#pesanB').show();
                var panjang = table.data().count();
                if (panjang == 0) {
                    $('#pesanB').hide();
                }
            }

        }
    </script>

    {{-- Menu Penambahan --}}
    <script>
        $(document).ready(function() {
            $('#plhMerk').select2({
                dropdownParent: $('#barangIn')
            });

            // Load Dropdown
            $.ajax({
                url: "{{ url('') }}/kateBarang/load/" + 1,
                success: function(res) {
                    $("#drpKate").select2({})
                    $("#drpKate").children().remove();
                    $("#drpKate").append(
                        '<option selected value="">Pilih Kategori Barang</option>');
                    $.each(res, function(index, data) {
                        $('#drpKate').append(
                            '<option value="' + data.id_barangIven + '">' + data
                            .nama_barang + '</option>'
                        )
                    })
                }
            });

            $('#drpKate').on('change', function() {
                var id = $(this).val();

                if (id != '' && id != null) {
                    $.ajax({
                        url: "{{ url('') }}/modelB/load/" + 1,
                        success: function(res) {
                            $("#drpModel").select2({});

                            $("#drpModel").children().remove();
                            $("#drpModel").append(
                                '<option selected value="">Pilih Model Barang</option>');
                            $.each(res, function(index, data) {
                                $('#drpModel').append(
                                    '<option value="' + data.id + '">' + data
                                    .model + '</option>'
                                )
                            })
                        }
                    });

                    $.ajax({
                        url: "{{ url('') }}/merk/load/" + 1,
                        success: function(res) {
                            $("#drpMerk").select2({})

                            $("#drpMerk").children().remove();
                            $("#drpMerk").append(
                                '<option selected value="">Pilih Merk Barang</option>');
                            $.each(res, function(index, data) {
                                $('#drpMerk').append(
                                    '<option value="' + data.id + '">' + data
                                    .merk + '</option>'
                                )
                            })
                        }
                    });

                    $.ajax({
                        url: "{{ url('') }}/warna/load/" + 1,
                        success: function(res) {
                            $("#drpWarna").select2({})
                            $("#drpWarna").children().remove();
                            $("#drpWarna").append(
                                '<option selected value="">Pilih Warna Barang</option>');
                            $.each(res, function(index, data) {
                                $('#drpWarna').append(
                                    '<option value="' + data.id + '">' + data
                                    .warna + '</option>'
                                )
                            })
                        }
                    });
                }
            });

            var nama_barang, nama_merk = "XXX",
                nama_kate = "XXX",
                nama_model = "XXX";

            $("#drpKate").change(function() {
                nama_kate = $("#drpKate :selected").text();
                nama_barang = `${nama_kate}-${nama_merk}-${nama_model}`
                $('#barangAdd').val(nama_barang).change();
            });

            $("#drpMerk").change(function() {
                nama_merk = $("#drpMerk :selected").text();
                nama_barang = `${nama_kate}-${nama_merk}-${nama_model}`
                $('#barangAdd').val(nama_barang).change();
            });

            $("#drpModel").change(function() {
                nama_model = $("#drpModel :selected").text();
                nama_barang = `${nama_kate}-${nama_merk}-${nama_model}`
                $('#barangAdd').val(nama_barang).change();
            });

            $('#frmBrgAdd').on('submit', function(e) {
                e.preventDefault();
                $("#frmBrgAdd").unbind().click(function() {});
                let barang = $('#barangAdd').val();
                let kategori = $('#drpKate').val();
                let model = $('#drpModel').val();
                let merk = $('#drpMerk').val();
                let warna = $('#drpWarna').val();
                let ukuran = $('#ukuranAdd').val();
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/barang/load/" + 1,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = barang.toUpperCase() === data.nama
                                .toUpperCase();
                            if (cekEqual) {
                                same = 1;
                            }
                        })

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/barang/in",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    barang: barang,
                                    model: model,
                                    kategori: kategori,
                                    merk: merk,
                                    warna: warna,
                                    ukuran: ukuran
                                },
                                success: function(res) {
                                    $('#barangIn').modal('hide');
                                    $("#frmBrgAdd")[0].reset();
                                    $('#dt_barang').DataTable().ajax.reload();
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                }
                            });
                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: barang + " Sudah Terdaftar"
                            });
                        }
                    }
                });
            });
        });
    </script>

    {{-- Load List Barang --}}
    <script>
        function listB() {

            $.ajax({
                url: "{{ url('') }}/kateBarang/load/" + 1,
                success: function(res) {
                    $("#filTipe").children().remove();
                    $("#filTipe").append(
                        '<option selected value="0">Pilih Kategori Barang</option>');
                    $.each(res, function(index, data) {
                        $('#filTipe').append(
                            '<option value="' + data.id_barangIven + '">' + data
                            .nama_barang + '</option>'
                        )
                    })
                    $('#filTipe').select2({
                        dropdownParent: $('#plhBarang')
                    });
                }
            });

            $.ajax({
                url: "{{ url('') }}/jenis/load/" + 1,
                success: function(res) {
                    $("#filKate").children().remove();
                    $("#filKate").append(
                        '<option selected value="0">Pilih Klasifikasi Barang</option>');
                    $.each(res, function(index, data) {
                        $('#filKate').append(
                            '<option value="' + data.id_jenisIven + '">' + data
                            .jenis_iventaris + '</option>'
                        )
                    })
                    $('#filKate').select2({
                        dropdownParent: $('#plhBarang')
                    });
                }
            });

            var tipe = 0,
                kate = 0;
            $('#filTipe').on('change', function() {
                tipe = $("#filTipe").val();
                kate = $("#filKate").val();
                filterData(kate, tipe);
            });

            $('#filKate').on('change', function() {
                tipe = $("#filTipe").val();
                kate = $("#filKate").val();
                filterData(kate, tipe);
            });

            $('#dt_barang').DataTable().clear();
            $('#dt_barang').DataTable().destroy();
            $("#dt_barang").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "ajax": {
                    "url": "{{ url('') }}/barang/load/" + 1,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var nama = row['nama'];
                            var html = '';
                            var cekData = 0;
                            html +=
                                `<div class="container">
                                        <div class="col-12" style="margin-top: 5px;">
                                            <a> ${nama} </a>
                                        </div>
                                        <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                            <button onclick="itemAdd(${data},'${nama}')" data-bs-dismiss="modal"  class="btn btn-icon btn-success"><i class="fas fa-cart-arrow-down"></i></button>
                                        </div>
                                </div>`;
                            return html;
                        }
                    },
                    {
                        "data": "kategori"
                    },
                    {
                        "data": "merk"
                    },
                    {
                        "data": "model"
                    },
                    {
                        "data": "warna"
                    }
                ],
            })
        };

        function filterData(kate, tipe) {
            $('#dt_barang').DataTable().clear();
            $('#dt_barang').DataTable().destroy();
            $("#dt_barang").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "ajax": {
                    "url": "{{ url('') }}/filter/barang/" + 1,
                    "dataSrc": "",
                    "data": {
                        kate: kate,
                        tipe: tipe
                    }
                },
                "columns": [{
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var nama = row['nama'];
                            var html = '';
                            var cekData = 0;
                            html +=
                                `<div class="container">
                                        <div class="col-12" style="margin-top: 5px;">
                                            <a> ${nama} </a>
                                        </div>
                                        <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                            <button onclick="itemAdd(${data},'${nama}')" data-bs-dismiss="modal"  class="btn btn-icon btn-success"><i class="fas fa-cart-arrow-down"></i></button>
                                        </div>
                                </div>`;
                            return html;
                        }
                    },
                    {
                        "data": "kategori"
                    },
                    {
                        "data": "merk"
                    },
                    {
                        "data": "model"
                    },
                    {
                        "data": "warna"
                    }
                ],
            })
        }
    </script>

    {{-- Load Histori Pesanan --}}
    <script>
        function listPesan() {
            // document.getElementById('judul').innerHTML = 'List Pesanan';
            // document.getElementById("btnListKer").style.backgroundColor = "#394eea";
            // document.getElementById("btnKeranjang").style.backgroundColor = "#6777f0";
            // document.getElementById("pilih").style.backgroundColor = "#6777f0";
            var ids = `<?php echo Session::get('id'); ?>`;

            $('#showCart').hide();
            $('#showItem').hide();
            $('#showOrderL').show();
            $("#btnListKer").unbind().click(function() {});

            $('#dt_orderL').DataTable().clear();
            $('#dt_orderL').DataTable().destroy();
            var table = $("#dt_orderL").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "order": [
                    [1, 'desc']
                ],
                "ajax": {
                    "url": "{{ url('') }}/pesanan/List/" + 1,
                    "dataSrc": "",
                    "data": {
                        ids: ids
                    }
                },
                "columns": [{
                        "className": 'dt-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
                    },
                    {
                        "data": "created_at",
                        "render": function(data, type, row, meta) {
                            var html = '';
                            var date = new Date(data);
                            var day = date.getDate();
                            var month = date.getMonth() + 1;
                            var year = date.getFullYear();
                            html = [day, month, year].join('/');
                            return html;
                        }
                    },
                    {
                        "data": "status"
                    }
                ],
            });

            // $('#dt_orderL tbody').off('click', 'td.details-control');
            $("#dt_orderL tbody").unbind().click(function() {});
            $('#dt_orderL tbody').on('click', 'td.dt-control', function(e) {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var parentRow = $(this).closest("tr").prev()[0];
                var rowData = table.row(parentRow).data();
                var idr = row.data().id;
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format(row.data(), idr)).show();
                    tr.addClass('shown');
                }
            });
        }

        function format(d, id) {
            // var id = d.id;
            // `d` is the original data object for the row
            let html = `<table class="table table-bordered table-md align-middle">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Dokumen</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Last Update</th>
                                </tr>
                            </thead>
                            <tbody>
                        `;
            $.ajax({
                url: "{{ url('') }}/pesanan/cartItem/" + id,
                type: "GET",
                async: false,
                success: function(res) {
                    $.each(res, function(index, data) {
                        var date = new Date(data.updated_at);
                        var day = date.getDate();
                        var month = date.getMonth() + 1;
                        var year = date.getFullYear();
                        var update = [day, month, year].join('/');
                        html += `<tr>
                                    <td>
                                        <a> ${data.nama} </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#dokumenOrd" onclick="dokOrder(${data.id})"><i class="fas fa-folder"></i>
                                        </button>
                                    </td>
                                    <td>${data.jumlah}</td>
                                    <td><div class="badge badge-success">Active</div></td>
                                    <th>${update}</th>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target="#detailOrd" onclick="detailOrd('${data.id}','${data.kode}')" class="btn btn-primary">Detail</a></td>
                                </tr>`;
                    })
                    html += `</tbody>`;
                }
            })
            html += `</table>`;
            return html;
        }
    </script>

    {{-- Pilih Barang --}}
    <script>
        function itemAdd(id, nama) {
            $('#namaB').val(nama);
            $('#idB').val(id);
            $('#listForm').show();
            $('#tbhBrg').prop('disabled', false);

            // Asset Drop Down
            $.ajax({
                url: "{{ url('') }}/assets/load/" + 1,
                type: "GET",
                success: function(res) {
                    $("#assetIn").select2({});
                    $("#assetIn").children().remove();
                    $("#assetIn").append('<option selected value="">Pilih Asset</option>');
                    $.each(res, function(index, data) {
                        $('#assetIn').append(
                            `<option value="${data.id_assets}"> ${data.nama_assets} Lokasi (${data.nama_lokasi}) Sub Lokasi (${data.nama_subL}) </option>`
                        )
                    })
                }
            })

            // Vendor Dropdown
            $.ajax({
                url: "{{ url('') }}/pesanan/getVendorDrp/" + id,
                type: "GET",
                success: function(res) {
                    $("#vendorIn").select2({});
                    var vendorDef = `Vendor Kosong`;
                    $("#vendorIn").children().remove();
                    $('#vendorIn').append(
                        '<option value="' + 0 + '">' +
                        vendorDef + '</option>'
                    )
                    $.each(res, function(index, data) {
                        $('#vendorIn').append(
                            `<option value=${data.id_vendor}>${data.nama_vendor}</option>`
                        )
                    })
                }
            })
        }
    </script>

    {{-- Delete Barang --}}
    <script>
        function deleteWish(id, cekData) {
            if (cekData == 1) {
                swal({
                    icon: "warning",
                    text: "Data Tidak Bisa Dihapus, Karena Telah Digunakan Proses Lain"
                });
            } else {
                swal({
                        title: "Kamu Yakin?",
                        text: "Sekali Delete Anda Tidak Bisa Mengembalikannya!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "{{ url('') }}/delete/wishList/" + id,
                                async: false,
                                success: function(res) {
                                    $('#dt_wish').DataTable().ajax.reload();
                                    var table = $('#dt_wish').DataTable();
                                    var ids = `<?php echo Session::get('id'); ?>`;
                                    var cekRow = 0;
                                    $('#pesanB').hide();
                                    var panjang = table.data().count();
                                    if (panjang > 0) {
                                        $('#pesanB').show();
                                    }
                                }
                            });
                        } else {
                            swal("Data Tidak Jadi Dihapus!");
                        }
                    });
            }
        }
    </script>


    {{-- Menu Add Barang --}}

    {{-- Tambah Model --}}
    <script>
        function modelAdd() {

            $('#frmModelAdd').on('submit', function(e) {
                e.preventDefault();

                let model = $('#modelAdd').val();
                let kode = $('#kodeModel').val();
                var ids = `<?php echo Session::get('id'); ?>`;
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/modelB/load/" + 1,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = model.toUpperCase() === data.model.toUpperCase();
                            if (cekEqual) {
                                same = 1;
                            }
                        })

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/modelB/in",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    model: model,
                                    kode: kode,
                                    ids: ids
                                },
                                success: function(res) {
                                    // console.log(res);
                                    $('#modelIn').modal('hide');
                                    $("#frmModelAdd")[0].reset();
                                    $('#dt_model').DataTable().ajax.reload();
                                    $("#frmModelAdd").unbind().click(function() {});
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                }
                            });
                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: model + " Sudah Terdaftar"
                            });
                        }
                    }
                });
            });
        }
    </script>

    {{-- Tambah Merk --}}
    <script>
        function merkAdd() {
            // this.preventDefault();

            $('#frmMerkAdd').on('submit', function(e) {
                e.preventDefault();
                let merk = $('#merkAdd').val();
                let kode = $('#kodeMerk').val();
                var ids = `<?php echo Session::get('id'); ?>`;
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/merk/load/" + 1,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = merk.toUpperCase() === data.merk.toUpperCase();
                            if (cekEqual) {
                                same = 1;
                            }
                        })

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/merk/in",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    merk: merk,
                                    kode: kode,
                                    ids: ids
                                },
                                success: function(res) {
                                    // console.log(res);
                                    $('#merkIn').modal('hide');
                                    $("#frmMerkAdd")[0].reset();
                                    $('#dt_merk').DataTable().ajax.reload();
                                    $("#frmMerkAdd").unbind().click(function() {});
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                }
                            });
                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: merk + " Sudah Terdaftar"
                            });
                        }
                    }
                });
            });
        }
    </script>

    {{-- Tambah Warna --}}
    <script>
        function warnaAdd() {

            $('#frmWarnaAdd').on('submit', function(e) {
                e.preventDefault();
                let warna = $('#warnaAdd').val();
                var ids = `<?php echo Session::get('id'); ?>`;
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/warna/load/" + 1,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = warna.toUpperCase() === data.warna.toUpperCase();
                            if (cekEqual) {
                                same = 1;
                            }
                        })

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/warna/in",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    warna: warna,
                                    ids: ids
                                },
                                success: function(res) {
                                    // console.log(res);
                                    $('#warnaIn').modal('hide');
                                    $("#frmWarnaAdd")[0].reset();
                                    $("#frmWarnaAdd").unbind().click(function() {});
                                    $('#dt_warna').DataTable().ajax.reload();
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                }
                            });
                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: warna + " Sudah Terdaftar"
                            });
                        }
                    }
                });
            });
        }
    </script>

    {{-- Pesan Barang --}}
    <script>
        function pesan() {
            var ids = `<?php echo Session::get('id'); ?>`;
            swal({
                    title: "Pesan Barang?",
                    text: "Sekali Masuk Antrian, Pesanan Tidak Dapat Dirubah!",
                    icon: "info",
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var cek = $('#dt_wish td').length;
                        var table = $('#dt_wish').DataTable();
                        if (!table.data().any()) {
                            alert('Keranjang Kosong, Tolong Isi Terlebih Dahulu');

                        } else {
                            $.ajax({
                                url: "{{ url('') }}/pesanan/req",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    ids: ids
                                },
                                success: function(res) {
                                    $('#dt_wish').DataTable().ajax.reload();
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                    $('#pesanB').hide();
                                }
                            });
                        }

                    }
                });
        }
    </script>

    {{-- Dokumentasi Pesanan --}}
    <script>
        function dokOrder(id) {
            var status = '';
            $.ajax({
                url: "{{ url('') }}/cartLoad/detail/" + id,
                async: false,
                success: function(data) {
                    var html;
                    console.log(data);
                    // var x = data.status;
                    html = `<h4 style="color:#677fe8">Dokumentasi</h4>
                <h4>( Kode ${data[0].kode} Dan Nama Barang ${data[0].nama_barang} )</h4>
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
                            var html = `<a href="{{ url('') }}/${data}" class="btn btn-success" target="_blank"><i class="fas fa-eyes"></i>
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

            if (status == "List") {
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
                $('#dropZone').show();
            } else {
                $('#dropZone').hide();
            }

        }

        $(document).ready(function() {
            $('#dokumenOrd').on('hidden.bs.modal', function(e) {
                if (Dropzone.instances.length > 0) Dropzone.instances.forEach(dz => dz.destroy());
            })
        });
    </script>

    {{-- Detail Pesanan --}}
    <script>
        function detailOrd(id, kode) {
            var head;
            // var x = data.status;
            head = `<h4 style="color:#677fe8">Informasi Pesanan</h4><br>
                <h4> (Kode : ${kode}) </h4>`;
            $('#detailHead').html(head);

            $.ajax({
                url: "{{ url('') }}/pesanan/detailOrd/" + id,
                success: function(res) {
                    console.log(res);
                    $.each(res, function(index, data) {
                        // Detail Barang
                        document.getElementById('namaD').innerHTML = `${data.nama}`;
                        document.getElementById('kateD').innerHTML = `${data.kategori}`;
                        document.getElementById('tipeD').innerHTML = `${data.tipe}`;
                        document.getElementById('merkD').innerHTML = `${data.merk}`;
                        document.getElementById('modelD').innerHTML = `${data.model}`;
                        document.getElementById('warnaD').innerHTML = `${data.warna}`;
                        document.getElementById('ukuranD').innerHTML = `${data.ukuran}`;

                        // Detail Pesanan
                        document.getElementById('vendorD').innerHTML = `${data.nama_vendor}`;
                        document.getElementById('assetD').innerHTML = `${data.nama_assets}`;
                        document.getElementById('subD').innerHTML = `${data.nama_subAsset}`;
                        document.getElementById('jlhD').innerHTML = `${data.jumlah}`;
                        document.getElementById('alasanD').innerHTML = `${data.alasan}`;
                    })
                }
            })
        }
    </script>

    {{-- Delete Dokumen --}}
    <script>
        function deleteDok(id) {
            var cekData = 0;
            // $.ajax({
            //     url: "{{ url('') }}/pesanan/load/" + 1,
            //     async: false,
            //     success: function(res) {
            //         // console.log(res);
            //         $.each(res, function(index, x) {
            //             if (x.id_lokasi == id) {
            //                 cekData = 1;
            //             }
            //         })

            //     }
            // });

            swal({
                    title: "Kamu Yakin?",
                    text: "Sekali Delete Anda Tidak Bisa Mengembalikannya!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ url('') }}/delDok/ord/" + id,
                            success: function() {
                                $('#dt_dokumen').DataTable().ajax.reload();
                                swal("Berhasil Dihapus!", {
                                    icon: "success",
                                });
                            }
                        });
                    } else {
                        swal("Data Tidak Jadi Dihapus!");
                    }
                });

        }
    </script>
@endpush
