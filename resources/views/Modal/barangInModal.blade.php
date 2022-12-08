{{-- Store --}}
<div class="modal fade" id="storeB" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="barangIvenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center">
                    <h4>Form Masuk Barang</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" id="frmBarangIN">
                        @csrf

                        <div class="form-group">
                            <div class="control-label">Penempatan</div>
                            <div class="custom-switches-stacked mt-2" style="display:inline-block;">
                                <label class="custom-switch">
                                    <input type="radio" name="penempatan" value="1" class="custom-switch-input"
                                        checked="">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Langsung Ditempatkan</span>
                                </label>
                                <label class="custom-switch">
                                    <input type="radio" name="penempatan" value="0" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Masuk Gudang</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row" id="klsDrp" style="display: none">
                            <div class="col-sm-12">
                                <label>Lokasi Gudang</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="assetLokasi" id="assetLokasi">
                                    <option selected disabled value="">Pilih Lokasi</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>

                        <div id="tempat">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label>Pilih Asset</label>
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        required="" name="tempatAsset" id="assetTempat">
                                        <option selected disabled value="">Pilih Asset</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Harus Dipilih
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Pilih Sub Asset</label>
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        required="" name="tempatSub" id="subTempat">
                                        <option selected disabled value="">Pilih Sub Asset</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Harus Dipilih
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kode Label Privew</label>
                                <input type="text" class="form-control" name="lable" id="kode" readonly
                                    style="text-transform: uppercase;">
                            </div>
                        </div>
                        <div class="section-title">Labeling</div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="form-check-input" type="radio" name="label" id="default"
                                        value="0" checked>
                                    <label class="form-check-label" for="inlineRadio2">Default Label</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="form-check-input" type="radio" name="label" id="custom"
                                        value="1">
                                    <label class="form-check-label" for="inlineRadio1">Custom Label</label>
                                </div>
                            </div>
                        </div>
                        <div id="tambahLabel">
                            <div class="section-title">Tambahan Label</div>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="merk" value="1">
                                    <label class="form-check-label" for="inlineCheckbox1">Merk</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="model" value="2">
                                    <label class="form-check-label" for="inlineCheckbox2">Model</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ukuran" value="3">
                                    <label class="form-check-label" for="inlineCheckbox3">Ukuran</label>
                                </div>
                            </div>
                        </div>                

                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-success" type="submit">Simpan</button>
                        </div>
                    </form>
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

{{-- Histori Barang Iven --}}
<div class="modal fade" id="histori" tabindex="-1" aria-labelledby="barangIvenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center">
                    <h4>Histori Barang Masuk</h4>
                </div>
                <div class="card-body">
                    <table id="dt_histori" class="display nowrap dataTable dtr-inline collapsed"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Kode Order</th>
                                <th>Detail</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
