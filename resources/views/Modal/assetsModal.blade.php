{{-- Tambah Assets Modal --}}
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="assetsIn" aria-labelledby="assetsModalLabel"
    aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form class="needs-validation was-validated" id="frmAssetIn">
                <div class="card">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Form Input Assets</h4>
                    </div>
                    <input type="hidden" id="assetsId">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nama Assets</label>
                                <input type="text" class="form-control" name="assets" placeholder="Nama assets"
                                    required="" value="{{ old('assets') }}" id="assets">
                                <input type="hidden" id="cekID">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Lokasi</label>
                                <div class="input-group">
                                    <select class="js-example-basic-single" id="lokasi" name="lokasi"
                                        required="">
                                        <option selected disabled value="">Pilih Lokasi</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Harus Dipilih
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Sub Lokasi</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="subLokasi" id="subLokasi">
                                    <option value="">Pilih Sub Lokasi</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kategori</label>
                                <div class="input-group">
                                    <select class="form-select" id="kategori" name="kategori"
                                        aria-label="Example select with button addon" required="">
                                        <option selected disabled value="">Pilih Kategori</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Harus Dipilih
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Pemilik</label>
                                <div class="input-group">
                                    <select class="form-select" id="pemilik" name="pemilik"
                                        aria-label="Example select with button addon" required="">
                                        <option selected disabled value="">Pilih Pemilik</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Harus Dipilih
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nilai Assets</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <input type="text" class="form-control" name="nilai" id="nilai"
                                        placeholder="Nilai Assets" required="" value="{{ old('nilai') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Ukuran</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="luas" id="luas"
                                        min="1" placeholder="luas Assets" value="{{ old('luas') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">M <sup>2</sup></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kode Assets (Minimal 2 Karakter Maximal 4 Karakter)</label>
                                <input type="text" class="form-control" name="kode" placeholder="Kode"
                                    style="text-transform:uppercase" minlength="2" maxlength="4" required=""
                                    value="{{ old('kode') }}" id="kodeIn">
                                <input type="hidden" id="cekKode">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="count" id="hitung" />
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Detail Assets Modal --}}
<div class="modal fade" id="detail" aria-labelledby="assetsModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form class="needs-validation was-validated" id="frmAssetIn">
                <div class="card">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Detail Assets</h4>
                    </div>
                    <input type="hidden" id="assetsId">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Assets</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="assetsD" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Lokasi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lokasiD" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sub Lokasi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="subLokasiD" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kategori</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kategoriD" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pemilik</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="pemilikD" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nilai Assets</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <input type="number" class="form-control" name="nilai" id="nilaiD"
                                        readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3">Luas</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" id="luasD" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text">M <sup>2</sup></span>
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

{{-- Add Sub Assets --}}
<div class="modal fade" id="addSub" aria-labelledby="listLokasiModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content" style="overflow-y: initial">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form class="needs-validation was-validated" id="frmSubAsset">
                <div class="card">
                    <div class="card-header card text-center" id="headerList">
                    </div>
                    <div class="card-body">
                        <div class="tab-content tab-bordered" id="myTab3Content">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>Nama Asset</label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single" id="plh_asset" name="plh_asset"
                                            required="">
                                            <option selected disabled value="">Pilih Asset</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Dipilih
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="home2" role="tabpanel"
                                aria-labelledby="home-tab2">
                                <div class="form-group row" id="subInput">
                                </div>
                                <div id=phoneInput>
                                </div>
                                <input type="hidden" name="count1" id="count" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Dokumentasi Assets --}}
<div class="modal fade" id="dokumenA" aria-labelledby="listLokasiModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content" style="overflow-y: initial">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center" id="headerDok">
                </div>
                <div class="modal-body ">
                    <form class="needs-validation was-validated" id="dokumenFrm">
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
                    </form>
                    <br>
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-header card text-center">
                                    <h4>Tabel Dokumentasi</h4>
                                </div>
                                <div class="card-body">
                                    <table id="dt_dokumen" class="display nowrap dataTable dtr-inline collapsed"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Nama File</th>
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

{{-- Dokumentasi Sub Assets --}}
<div class="modal fade" id="dokumenSubAsset" aria-labelledby="listLokasiModalLabel" aria-hidden="true"
    tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content" style="overflow-y: initial">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center" id="SubAssetDok">
                </div>
                <div class="card-body ">
                    <div class="tab-content tab-bordered" id="myTab3Content">
                        <div class="tab-pane fade show active" id="home2" role="tabpanel"
                            aria-labelledby="home-tab2">
                            <form class="needs-validation was-validated" id="dokumenFrm">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="dropzone dz-clickable" id="myDropSub">
                                                <div class="dz-default dz-message" data-dz-message="">
                                                    <span>Upload or Drag Photo/File Here</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-header card text-center">
                                    <h4>Tabel Dokumentasi</h4>
                                </div>
                                <table id="dt_dokSubA" class="display nowrap dataTable dtr-inline collapsed"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Nama File</th>
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

{{-- Label List --}}
<div class="modal fade" id="labelList" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content" style="overflow-y: initial">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body ">
                <div class="card">
                    <div class="card-header card text-center">
                        <h4>Label List</h4>
                    </div>
                    <div class="card-body">
                        <table id="dt_label" class="display nowrap dataTable dtr-inline collapsed"
                            style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Kode Label</th>
                                    <th>Dokumentasi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Edit Asset --}}
<div class="modal fade" id="assetsEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" novalidate="" id="frmEdit">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Form Edit assets</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama assets</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="assets" required=""
                                    id="namaE">
                                <input type="hidden" id="cek">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Lokasi Assets</label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="lokasi" id="lokasiE">
                                    <option selected disabled value="">Pilih Lokasi</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sub Lokasi Assets</label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" id="subLokasiE">
                                    <option selected disabled value="">Pilih Sub Lokasi</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kategori Assets</label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" id="kategoriE">
                                    <option selected disabled value="">Pilih Kategori</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pemilik Assets</label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" id="pemilikE">
                                    <option selected disabled value="">Pilih Pemilik</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nilai Assets</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <input type="number" class="form-control" name="nilai" min="1"
                                        id="nilaiE" placeholder="Nilai Assets" required="">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3">Luas</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="luas" id="luasE"
                                        min="1" placeholder="luas Assets">
                                    <div class="input-group-append">
                                        <span class="input-group-text">M <sup>2</sup></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kode Assets (Min 2 Karakter Max 4 Karakter)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="kode" placeholder="Kode"
                                    style="text-transform:uppercase" minlength="2" maxlength="4" required=""
                                    value="{{ old('kode') }}" id="kodeE">
                                <input type="hidden" id="cekKode">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success">Ubah assets</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Edit Sub Asset --}}
<div class="modal fade" id="subAssetEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" novalidate="" id="frmEditSubAsset">
                    @csrf
                    <div class="card-header card text-center" id="headSubEdit">
                        <h4>Edit Sub Assets</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Sub Asset</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Sub Asset" required=""
                                    id="editSubAsset">
                                <input type="hidden" id="cek">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kode Sub</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Kode Sub Asset"
                                    required="" id="Kode_SubAsset_E">
                                <input type="hidden" id="cek">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success" type="submit">Ubah Sub Asset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Detail Kode Label Modal --}}
<div class="modal fade" id="detailLabel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body ">
                <div class="tab-content tab-bordered">
                    <div class="tab-pane fade show active">
                        <div class="card text-center">
                            <h4>Kode Label</h4>
                            <h4 id="labelHead"></h4>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="tab-content tab-bordered">
                    <div class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-header card text-center">
                                <h4>Detail Barang</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <strong class="col-5">Nama Barang</strong>
                                    <strong class="col-2">:</strong>
                                    <strong class="col-5" id="namaBarang"></strong>
                                </div>
                                <div class="form-group row">
                                    <strong class="col-5">Model Barang</strong>
                                    <strong class="col-2">:</strong>
                                    <strong class="col-5" id="modelBarang"></strong>
                                </div>
                                <div class="form-group row">
                                    <strong class="col-5">Merk Barang</strong>
                                    <strong class="col-2">:</strong>
                                    <strong class="col-5" id="merkBarang"></strong>
                                </div>
                                <div class="form-group row">
                                    <strong class="col-5">Warna Barang</strong>
                                    <strong class="col-2">:</strong>
                                    <strong class="col-5" id="warnaBarang"></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="tab-content tab-bordered">
                    <div class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-header card text-center">
                                <h4>Detail Pembelian</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <strong class="col-5">Tanggal Pemesanan</strong>
                                    <strong class="col-2">:</strong>
                                    <strong class="col-5" id="tgl_pesan"></strong>
                                </div>
                                <div class="form-group row">
                                    <strong class="col-5">Tanggal Pengecekan</strong>
                                    <strong class="col-2">:</strong>
                                    <strong class="col-5" id="tgl_cek"></strong>
                                </div>
                                <div class="form-group row">
                                    <strong class="col-5">Tanggal Persetujuan</strong>
                                    <strong class="col-2">:</strong>
                                    <strong class="col-5" id="tgl_setuju"></strong>
                                </div>
                                <div class="form-group row">
                                    <strong class="col-5">Tanggal Pembelian</strong>
                                    <strong class="col-2">:</strong>
                                    <strong class="col-5" id="tgl_beli"></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="tab-content tab-bordered">
                    <div class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-header card text-center">
                                <h4>Histori Perpindahan</h4>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-tabs justify-content-center" id="myTab6" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link text-center active" id="in-tab6" data-toggle="tab"
                                            href="#in6" role="tab" aria-controls="in" aria-selected="true">
                                            <span><i class="fas fa-home"></i></span> Masuk</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-center" id="out-tab6" data-toggle="tab"
                                            href="#out6" role="tab" aria-controls="out" aria-selected="false">
                                            <span><i class="fas fa-id-card"></i></span> Keluar</a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-bordered" id="myTabContent6">
                                    <div class="tab-pane fade active show" id="in6" role="tabpanel"
                                        aria-labelledby="in-tab6">
                                        <div class="card-header card text-center">
                                            <h4>Histori Masuk Kedalam Asset</h4>
                                        </div>
                                        <div class="card-body">
                                            <table id="dt_inAsset1"
                                                class="display nowrap dataTable dtr-inline collapsed"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Asset</th>
                                                        <th>Sub Asset</th>
                                                        <th>Tanggal Masuk</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="out6" role="tabpanel"
                                        aria-labelledby="out-tab6">
                                        <div class="card-header card text-center">
                                            <h4>Histori Pengeluaran Dari Asset</h4>
                                        </div>
                                        <div class="card-body">
                                            <table id="dt_outAsset1"
                                                class="display nowrap dataTable dtr-inline collapsed"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Asset</th>
                                                        <th>Sub Asset</th>
                                                        <th>Tanggal Keluar</th>
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
                <br>
                <div class="tab-content tab-bordered">
                    <div class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-header card text-center">
                                <h4>Histori Perawatan</h4>
                            </div>
                            <div class="card-body">
                                <table id="dt_perawatan" class="display nowrap dataTable dtr-inline collapsed"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Kode Perawatan</th>
                                            <th>Dokumentasi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="tab-content tab-bordered">
                    <div class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-header card text-center">
                                <h4>Histori Perbaikan</h4>
                            </div>
                            <div class="card-body">
                                <table id="dt_perbaikan" class="display nowrap dataTable dtr-inline collapsed"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Kode Perawatan</th>
                                            <th>Dokumentasi</th>
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

{{-- Detail All Modal --}}
<div class="modal fade" id="detailAll" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body ">
                <div class="tab-content tab-bordered">
                    <div class="tab-pane fade show active">
                        <div class="card text-center">
                            <h4>Nama Asset</h4>
                            <h4 id="assetAll"></h4>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="tab-content tab-bordered">
                    <div class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-header card text-center">
                                <h4>Detail Assets</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <strong class="col-5">Lokasi</strong>
                                    <strong class="col-2">:</strong>
                                    <strong class="col-5" id="lokasiA">11</strong>
                                </div>
                                <div class="form-group row">
                                    <strong class="col-5">Sub Lokasi</strong>
                                    <strong class="col-2">:</strong>
                                    <strong class="col-5" id="subLokasiA"></strong>
                                </div>
                                <div class="form-group row">
                                    <strong class="col-5">Kategori</strong>
                                    <strong class="col-2">:</strong>
                                    <strong class="col-5" id="kategoriA"></strong>
                                </div>
                                <div class="form-group row">
                                    <strong class="col-5">Pemilik :</strong>
                                    <strong class="col-2">:</strong>
                                    <strong class="col-5" id="pemilikA"></strong>
                                </div>
                                <div class="form-group row">
                                    <strong class="col-5">Nilai Asset :</strong>
                                    <strong class="col-2">:</strong>
                                    <strong class="col-5" id="nilaiA"></strong>
                                </div>
                                <div class="form-group row">
                                    <strong class="col-5">Ukuran :</strong>
                                    <strong class="col-2">:</strong>
                                    <strong class="col-5" id="ukuranA"></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="tab-content tab-bordered">
                    <div class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header card text-center">
                                    <h4>List Sub Asset</h4>
                                </div>
                                <table id="dt_subALL" class="display nowrap dataTable dtr-inline collapsed"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Sub Asset</th>
                                            <th>Dokumentasi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                {{-- <div class="tab-content tab-bordered">
                    <div class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header card text-center">
                                    <h4>Rekap Iventaris</h4>
                                </div>
                                <table id="dt_ivenALL" class="display nowrap dataTable dtr-inline collapsed"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                           
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br> --}}
                {{-- <div class="tab-content tab-bordered">
                    <div class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-header card text-center">
                                <h4>Dokumentasi</h4>
                            </div>
                            <div class="modal-body ">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="dt_dokumen1" class="display nowrap dataTable dtr-inline collapsed"
                                            style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Nama File</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <br> --}}
                <div class="tab-content tab-bordered">
                    <div class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-header card text-center">
                                <h4>Histori Perpindahan</h4>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-tabs justify-content-center" id="myTab6" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link text-center active" id="masuk-tab6" data-toggle="tab"
                                            href="#masuk6" role="tab" aria-controls="masuk"
                                            aria-selected="true">
                                            <span><i class="fas fa-home"></i></span> Barang Masuk</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-center" id="keluar-tab6" data-toggle="tab"
                                            href="#keluar6" role="tab" aria-controls="keluar"
                                            aria-selected="false">
                                            <span><i class="fas fa-id-card"></i></span> Barang Keluar</a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-bordered" id="myTabContent6">
                                    <div class="tab-pane fade active show" id="masuk6" role="tabpanel"
                                        aria-labelledby="masuk-tab6">
                                        <div class="card-header card text-center">
                                            <h4>Barang Masuk</h4>
                                        </div>
                                        <div class="card-body">
                                            <table id="dt_inAsset"
                                                class="display nowrap dataTable dtr-inline collapsed"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Tanggal Masuk</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="keluar6" role="tabpanel"
                                        aria-labelledby="keluar-tab6">
                                        <div class="card-header card text-center">
                                            <h4>Barang Keluar</h4>
                                        </div>
                                        <div class="card-body">
                                            <table id="dt_outAsset"
                                                class="display nowrap dataTable dtr-inline collapsed"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Tanggal Keluar</th>
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
                <br>
            </div>
        </div>
    </div>
</div>

{{-- Cek Up Barang --}}
<div class="modal fade" id="cekBar" aria-labelledby="listLokasiModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content" style="overflow-y: initial">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center" id="headerCekUp">
                    <div class="card-header card text-center">
                        <h4>Cek Up Barang</h4>
                    </div>
                </div>
                <div class="modal-body ">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-body">
                                    <table id="dt_cekBarang" class="display nowrap dataTable dtr-inline collapsed"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Kode Label</th>
                                                <th>From Asset</th>
                                                <th>Tanggal Pengiriman</th>
                                                <th>Validasi</th>
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

{{-- Barang Pindah --}}
<div class="modal fade" id="pindah" tabindex="-1" aria-labelledby="barangIvenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content" style="overflow-y: block;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmPindahB">
                    @csrf
                    <div class="card-header card text-center" id="headerPindah">
                        <h4>Form Keluar Barang</h4>
                    </div>
                    <div class="card-body">
                        <div class="tab-content tab-bordered">
                            <div class="tab-pane fade show active">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputState">From Asset</label>
                                        <input type="text" class="form-control" id="fromAsset0" readonly>
                                        {{-- <div class="invalid-feedback">
                                            Harus Dipilih
                                        </div> --}}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputState">From Sub Asset</label>
                                        <input type="text" class="form-control" id="fromSub0" readonly>
                                        {{-- <div class="invalid-feedback">
                                            Harus Dipilih
                                        </div> --}}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputState">To Asset</label>
                                        <select class="form-select form-select-sm"
                                            aria-label=".form-select-sm example" required="" id="assets0">
                                            <option selected disabled value="">Pilih Lokasi</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Dipilih
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3" id="subAsset0">
                                        <label for="inputState">To Sub Asset</label>
                                        <select class="form-select form-select-sm"
                                            aria-label=".form-select-sm example" required="" id="subA0">
                                            <option selected disabled value="0">Tanpa Sub</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Dipilih
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id=labelAdd></div>
                        <input type="hidden" name="count1" id="count" value="0">
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Get All Label --}}
<div class="modal fade" id="labelDetail" tabindex="-1" aria-labelledby="barangIvenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content" style="overflow-y: block;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="tab-content tab-bordered">
                    <div class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header card text-center">
                                    <h4>Detail Iventaris</h4>
                                </div>
                                <table id="dt_labelALL" class="display nowrap dataTable dtr-inline collapsed"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Label </th>
                                            <th>Nama </th>
                                            {{-- <th>Sub Asset</th> --}}
                                            <th>Pindah</th>
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

{{-- Detail Sub Asset --}}
<div class="modal fade" id="detailSub" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body ">
                <div class="tab-content tab-bordered">
                    <div class="tab-pane fade show active">
                        <div class="card text-center">
                            {{-- <h4>Sub Asset</h4> --}}
                            <h4 id="subHead"></h4>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="tab-content tab-bordered">
                    <div class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header card text-center">
                                    <h4>Rekap Iventaris</h4>
                                </div>
                                <table id="dt_SubItem" class="display nowrap dataTable dtr-inline collapsed"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            {{-- <th>Cek Label</th> --}}
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

{{-- Cek Label Asset --}}
<div class="modal fade" id="cekLabel" tabindex="-1" aria-labelledby="barangIvenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content" style="overflow-y: block;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="tab-content tab-bordered">
                    <div class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header card text-center">
                                    <h4>Label List</h4>
                                </div>
                                <table id="dt_labelALL" class="display nowrap dataTable dtr-inline collapsed"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Label </th>
                                            <th>Nama </th>
                                            {{-- <th>Sub Asset</th> --}}
                                            <th>Pindah</th>
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

{{-- Input Asset Transportasi --}}
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="assetsTin"
    aria-labelledby="assetsModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form class="needs-validation was-validated" id="frmAssetsTin">
                <div class="card">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Form Input Assets Transportasi</h4>
                    </div>
                    <input type="hidden" id="assetsId">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nama Asset Transport</label>
                                <input type="text" class="form-control" name="assetsT" placeholder="Nama"
                                    required="" id="assetsT">
                                <input type="hidden" id="cekID">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kode Assets (Minimal 2 Karakter Maximal 4 Karakter)</label>
                                <input type="text" class="form-control" name="kode" placeholder="Kode"
                                    style="text-transform:uppercase" minlength="2" maxlength="4" required=""
                                    id="kodeT">
                                {{-- <input type="hidden" id="cekKode"> --}}
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Jenis Transport</label>
                                <div class="input-group">
                                    <select class="js-example-basic-single" id="jns_trnspt" name="jns_trnspt"
                                        required="">
                                        <option selected disabled value="">Pilih Jenis</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Harus Dipilih
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nomor Polisi</label>
                                <input type="text" class="form-control" name="nopol" placeholder="Nomor Polisi"
                                    required="" id="nopol">
                                {{-- <input type="hidden" id="cekID"> --}}
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Pemilik</label>
                                <div class="input-group">
                                    <select class="form-select" id="pemilikT" name="pemilik"
                                        aria-label="Example select with button addon" required="">
                                        <option selected disabled value="">Pilih Pemilik</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Harus Dipilih
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Supir</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="supir" id="supir">
                                    <option value="">Pilih Supir</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Merk</label>
                                <div class="input-group">
                                    <select class="form-select" id="merk" name="merk"
                                        aria-label="Example select with button addon" required="">
                                        <option selected disabled value="">Pilih Merk</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Harus Dipilih
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Model</label>
                                <div class="input-group">
                                    <select class="form-select" id="model" name="model"
                                        aria-label="Example select with button addon" required="">
                                        <option selected disabled value="">Pilih Model</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Harus Dipilih
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Warna</label>
                                <div class="input-group">
                                    <select class="form-select" id="warna" name="warna"
                                        aria-label="Example select with button addon" required="">
                                        <option selected disabled value="">Pilih Warna</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Harus Dipilih
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nilai Assets</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <input type="text" class="form-control" name="nilaiT" id="nilaiT"
                                        placeholder="Nilai Assets" required="">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                            </div>
                        </div>                       
                        <input type="hidden" name="count" id="hitung" />
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
