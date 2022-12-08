{{-- Tambah Barang --}}
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" id="barangIn" tabindex="-1"
    style="padding-left: 0px;" aria-hidden="true">
    <div class="modal-dialog model-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card-header card text-center">
                <h4 style="color: #023e8a" id="headNew"></h4>
                <br>
                <div class="card-header-action">
                    <a href="#" class="btn btn-primary" id="merkAddB" onclick="merkAdd()">
                        <i class="fas fa-calendar-plus"></i> Merk
                    </a>
                    <a href="#" class="btn btn-primary" id="modelAddB" onclick="modelAdd()">
                        <i class="fas fa-calendar-plus"></i> Model
                    </a>
                    <a href="#" class="btn btn-primary" id="warnaAddB" onclick="warnaAdd()">
                        <i class="fas fa-calendar-plus"></i> Warna
                    </a>
                </div>
            </div>
            <div class="card" id="addNew">
                <form class="needs-validation was-validated" id="frmBrgAdd">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" name="barangAdd" id="barangAdd" readonly
                                    required="" placeholder="Nama" value="{{ old('barangAdd') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kategori</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="drpKate" id="drpKate">
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
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="drpMerk" id="drpMerk">
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
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="drpModel" id="drpModel">
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
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="drpWarna" id="drpWarna">
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
                                <input type="text" class="form-control" name="ukuranAdd" id="ukuranAdd" required=""
                                    placeholder="Ukuran" value="{{ old('ukuranAdd') }}">
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
            <div class="card" id="addMerk">
                <form class="needs-validation was-validated" id="frmMerkAdd">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nama Merk</label>
                                <input type="text" class="form-control" name="merk" id="merkAdd" required=""
                                    value="{{ old('merk') }}" placeholder="Merk">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kode Merk</label>
                                <input type="text" class="form-control" name="kodeMerk" id="kodeMerk" maxlength="3"
                                    placeholder="Kode Merk" required="" value="{{ old('kodeMerk') }}"
                                    style="text-transform:uppercase">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-primary" onclick="barangNew()">Tambah Barang</button>
                        <button class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="card" id="addModel">
                <form class="needs-validation was-validated" id="frmModelAdd">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nama Model</label>
                                <input type="text" class="form-control" name="model" id="modelAdd" placeholder="Model"
                                    required="" value="{{ old('model') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kode Merk</label>
                                <input type="text" class="form-control" name="kodeModel" id="kodeModel" maxlength="3"
                                    placeholder="Kode Model" required="" value="{{ old('kodeModel') }}"
                                    style="text-transform:uppercase">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-right">
                        <button type="button" id="modelBack" class="btn btn-primary" onclick="barangNew()">Tambah
                            Barang</button>
                        <button class="btn btn-success" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="card" id="addWarna">
                <form class="needs-validation was-validated" id="frmWarnaAdd">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nama Warna</label>
                                <input type="text" placeholder="Warna" class="form-control" name="warna" id="warnaAdd"
                                    required="" value="{{ old('warna') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-primary" onclick="barangNew()">Tambah Barang</button>
                        <button class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
                        <h4>Tambah Kedalam Keranjang</h4>
                        {{-- <h4 id="itemHead"></h4> --}}
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
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
                                    <option value="" disabled selected hidden>Pilih Asset</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Jumlah Barang</label>
                                <input type="number" min="1" class="form-control" name="jlh" id="jlhIn"
                                    placeholder="0" required="" value="{{ old('jlh') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Alasan Pembelian</label>
                                <input type="text" class="form-control" name="alasan" id="alasanIn"
                                    placeholder="Alasan" required="" value="{{ old('alasan') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Harga Barang</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" min="1" placeholder="0" class="form-control" id="hargaIn">
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
                        <button class="btn btn-success" type="submit">Tambahkan</button>
                    </div>
                </form>
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
