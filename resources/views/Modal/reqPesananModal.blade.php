{{-- Tambah Item --}}
<div class="modal fade" id="itemIn" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmItemAdd">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Pengecekan Pesanan</h4>
                        {{-- <h4 id="itemHead"></h4> --}}
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
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
                            <div class="col-sm-12">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" name="nama" id="namaB" required="" readonly>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kode</label>
                                <input type="text" class="form-control" name="nama" id="kodeB" required="" readonly>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Jumlah</label>
                                <input type="text" class="form-control" name="jlhBrg" id="jlhBrg" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Total Harga</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="totalHargaBrg" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Harga Barang (/Satuan)</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="hargaIn" required>
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
                    <div class="card-footer text-center">
                        <button class="btn btn-success" type="submit">Verifikasi</button>
                    </div>
                </form>
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
                                        <strong class="col-5">Kategori</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="kateD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Tipe</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="tipeD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Merk</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="merkD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Model</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="modelD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Warna</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="warnaD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Ukuran</strong>
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
