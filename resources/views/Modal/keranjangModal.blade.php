{{-- Detail Keranjang --}}
<div class="modal fade" id="detailOrd" tabindex="-1" aria-hidden="true">
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
                    <div id="detailKode"></div>
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
                        <div class="form-group row" id="A">
                            {{-- Barang --}}
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" readonly id="namaD">
                            </div>

                            {{-- Vendor --}}
                            <div class="form-group">
                                <label>Nama Vendor</label>
                                <input type="text" class="form-control" readonly id="vendorD">
                            </div>

                            {{-- Pemesan --}}
                            <div class="form-group">
                                <label>Nama Pemesan</label>
                                <input type="text" class="form-control" readonly id="pemesanD">
                            </div>

                            {{-- Pembeli --}}
                            <div class="form-group">
                                <label>Nama Pembeli</label>
                                <input type="text" class="form-control" readonly id="pembeliD">
                            </div>

                            {{-- Validator --}}
                            <div class="form-group">
                                <label>Nama Validator</label>
                                <input type="text" class="form-control" readonly id="validD">
                            </div>

                            {{-- Harga --}}
                            <div class="form-group">
                                <label>Harga Barang</label>
                                <input type="text" class="form-control" readonly id="hargaD">
                            </div>
                        </div>

                        <div class="form-group row" id="B">
                            {{-- Model --}}
                            <div class="form-group">
                                <label>Model Barang</label>
                                <input type="text" class="form-control" readonly id="modelD">
                            </div>

                            {{-- Merk --}}
                            <div class="form-group">
                                <label>Merk Barang</label>
                                <input type="text" class="form-control" readonly id="merkD">
                            </div>

                            {{-- Warna --}}
                            <div class="form-group">
                                <label>Warna Barang</label>
                                <input type="text" class="form-control" readonly id="warnaD">
                            </div>

                            {{-- Ukuran --}}
                            <div class="form-group">
                                <label>Ukuran Barang</label>
                                <input type="text" class="form-control" readonly id="ukuranD">
                            </div>

                            {{-- Jumlah --}}
                            <div class="form-group">
                                <label>Jumlah Barang</label>
                                <input type="text" class="form-control" readonly id="jlhD">
                            </div>

                            {{-- Alasan --}}
                            <div class="form-group">
                                <label>Alasan Pembelian</label>
                                <input type="text" class="form-control" readonly id="alasanD">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Edit Item --}}
<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" novalidate="" id="editForm">
                    @csrf
                    <div class="card-header card text-center">
                        <h4 id="editHead"></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Barang</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="barang" id="edBarang">
                                    <option selected value="">Pilih Barang</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kategori</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="kate" id="edKate" disabled>
                                    <option selected disabled value="">Pilih Kategori</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Vendor</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="vendor" id="edVendor">
                                    <option value="" disabled selected hidden>Pilih Vendor</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Model</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="model" id="edinModel" disabled>
                                    <option value="" disabled selected hidden>Pilih Model</option>
                                    <option value="-"> Model Kosong</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Merk</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="merk" id="edMerk" disabled>
                                    <option value="" disabled selected hidden>Pilih Merk</option>
                                    <option value="-"> Merk Kosong</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Warna</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" id="edWarna" disabled>
                                    <option value="" disabled selected hidden>Pilih Warna</option>
                                    <option value="-"> Warna Kosong</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Penempatan Asset</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" id="edAsset">
                                    <option value="" disabled selected hidden>Pilih Asset</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Penempatan Sub</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" id="edSub">
                                    <option value="" disabled selected hidden>Pilih Sub</option>
                                    <option value="0">Tanpa Sub</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Ukuran</label>
                                <input type="text" class="form-control" id="edUkuran" placeholder="Ukuran Barang"
                                    value="{{ old('ukuran') }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Jumlah</label>
                                <input min="1" type="number" class="form-control" id="edJumlah"
                                    placeholder="Jumlah Barang" required="" value="{{ old('jumlah') }}">
                            </div>
                            <div class="invalid-feedback">
                                Harus Diisi
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Alasan</label>
                                <input type="text" class="form-control" id="edAlasan" placeholder="Alasan Pembelian"
                                    required="" value="{{ old('alasan') }}">
                            </div>
                            <div class="invalid-feedback">
                                Harus Diisi
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Harga</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <input min="0" type="number" class="form-control" id="edHarga"
                                        placeholder="Harga Barang" value="{{ old('harga') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success">Ubah Barang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Dokumen Pesanan --}}
<div class="modal fade" id="dokumenOrd" aria-hidden="true" tabindex="-1">
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
                    <div class="card">
                        <div class="tab-content tab-bordered" id="myTab3Content">
                            <div class="tab-pane fade show active" id="home2" role="tabpanel"
                                aria-labelledby="home-tab2">
                                <form class="needs-validation was-validated" id="dokumenLokFrm">
                                    <div class="card card">
                                        {{-- <div class="card-header card text-center">
                                            <h4></h4>
                                        </div> --}}
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

{{-- Tambah Barang --}}
<div class="modal fade" id="order" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="ordersModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="overflow-y: auto;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form class="needs-validation was-validated" novalidate="" method="post" enctype="multipart/form-data"
                id="inputPesanan">
                <div class="card">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Tambah Barang</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Barang</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="barang" id="inBarang">
                                    <option selected value="">Pilih Barang</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kategori</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="kate" id="inKate" disabled>
                                    <option selected disabled value="">Pilih Kategori</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Vendor</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="vendor" id="inVendor">
                                    <option value="" disabled selected hidden>Pilih Vendor</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Model</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="model" id="inModel" disabled>
                                    <option value="" disabled selected hidden>Pilih Model</option>
                                    <option value="-"> Model Kosong</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Merk</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="merk" id="inMerk" disabled>
                                    <option value="" disabled selected hidden>Pilih Merk</option>
                                    <option value="-"> Merk Kosong</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Warna</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" id="inWarna" disabled>
                                    <option value="" disabled selected hidden>Pilih Warna</option>
                                    <option value="-"> Warna Kosong</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Penempatan Asset</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" id="inAsset">
                                    <option value="" disabled selected hidden>Pilih Asset</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Penempatan Sub</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" id="inSub">
                                    <option value="" disabled selected hidden>Pilih Sub</option>
                                    <option value="0">Tanpa Sub</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Ukuran</label>
                                <input type="text" class="form-control" id="inUkuran" placeholder="Ukuran Barang"
                                    value="{{ old('ukuran') }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Jumlah</label>
                                <input min="1" type="number" class="form-control" id="inJumlah"
                                    placeholder="Jumlah Barang" required="" value="{{ old('jumlah') }}">
                            </div>
                            <div class="invalid-feedback">
                                Harus Diisi
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Alasan</label>
                                <input type="text" class="form-control" id="inAlasan" placeholder="Alasan Pembelian"
                                    required="" value="{{ old('alasan') }}">
                            </div>
                            <div class="invalid-feedback">
                                Harus Diisi
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Harga</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <input min="0" type="number" class="form-control" id="inHarga"
                                        placeholder="Harga Barang" value="{{ old('harga') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Tambah Barang</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
