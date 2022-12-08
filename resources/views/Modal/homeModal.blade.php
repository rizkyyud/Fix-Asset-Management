{{-- ---------------------------------------------- Showing List ---------------------------------------------- --}}

{{-- Detail Lokasi Modal --}}
<div class="modal fade" id="lokasiModal" aria-labelledby="listLokasiModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content" style="overflow-y: initial">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center">
                    <h3 style="color: #023e8a">List Lokasi</h3>
                </div>
                <div class="modal-body ">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-body">
                                    <table id="dt_lokasi" class="display nowrap dataTable dtr-inline collapsed"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Nama Lokasi</th>
                                                <th>Alamat</th>
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
</div>

{{-- Detail Sub Lokasi Modal --}}
<div class="modal fade" id="subLokModal" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center">
                    <h3 style="color: #023e8a">List Sub Lokasi</h3>
                </div>
                <div class="modal-body ">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-body">
                                    <table id="dt_subL" class="display nowrap dataTable dtr-inline collapsed"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Sub Lokasi</th>
                                                <th>Lokasi</th>
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
</div>

{{-- Detail Kategori Modal --}}
<div class="modal fade" id="kateAModal" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center">
                    <h3 style="color: #023e8a">List Kategori</h3>
                </div>
                <div class="modal-body ">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-body">
                                    <table id="dt_kategori" class="display nowrap dataTable dtr-inline collapsed"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Nama Kategori</th>
                                                <th>Unique Kode</th>
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

{{-- Detail Pemilik Modal --}}
<div class="modal fade" id="pemilikModal" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center">
                    <h3 style="color: #023e8a">List Pemilik</h3>
                </div>
                <div class="modal-body ">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-body">
                                    <table id="dt_pemilik" class="display nowrap dataTable dtr-inline collapsed"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Nama Pemilik</th>
                                                <th>Jenis Kepemilikan</th>
                                                <th>Alamat</th>
                                                <th>Nomor</th>
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

{{-- Detail Asset Modal --}}
<div class="modal fade" id="assetModal" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center">
                    <h3 style="color: #023e8a">List Asset</h3>
                </div>
                <div class="modal-body ">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-body">
                                    <table id="dt_assets" class="display nowrap dataTable dtr-inline collapsed"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Nama assets</th>
                                                <th>Lokasi</th>
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
</div>

{{-- Detail Sub Asset Modal --}}
<div class="modal fade" id="subAssetModal" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center">
                    <h3 style="color: #023e8a">List Sub Asset</h3>
                </div>
                <div class="modal-body ">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-body">
                                    <table id="dt_subAssetAll" class="display nowrap dataTable dtr-inline collapsed"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Nama Sub Asset</th>
                                                <th>Nama Asset</th>
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
</div>

{{-- Detail Barang Iven Modal --}}
<div class="modal fade" id="barangModal" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center">
                    <h3 style="color: #023e8a">List Barang Inventaris</h3>
                </div>
                <div class="modal-body ">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-body">
                                    <table id="dt_barang" class="display nowrap dataTable dtr-inline collapsed"
                                        style="width: 100%;" aria-describedby="example_info">
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
        </div>
    </div>
</div>

{{-- Vendor Modal --}}
<div class="modal fade" id="vendorModal" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center">
                    <h3 style="color: #023e8a">List Vendor</h3>
                </div>
                <div class="modal-body ">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-body">
                                    <table id="dt_vendor" class="display nowrap dataTable dtr-inline collapsed"
                                        style="width: 100%;" aria-describedby="example_info">
                                        <thead>
                                            <tr>
                                                <th>Vendor</th>
                                                <th>Detail</th>
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

{{-- Detail Klasifikasi Barang Modal --}}
<div class="modal fade" id="klasifikasiModal" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center">
                    <h3 style="color: #023e8a">List Klasifikasi Barang</h3>
                </div>
                <div class="modal-body ">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-body">
                                    <table id="dt_kate" class="display nowrap dataTable dtr-inline collapsed"
                                        style="width: 100%;" aria-describedby="example_info">
                                        <thead>
                                            <tr>
                                                <th>Klasifikasi</th>
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

{{-- Detail Kategori Barang Modal --}}
<div class="modal fade" id="KateB_Modal" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center">
                    <h3 style="color: #023e8a">List Kategori Barang</h3>
                </div>
                <div class="modal-body ">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-body">
                                    <table id="dt_tipe" class="display nowrap dataTable dtr-inline collapsed"
                                        style="width: 100%;" aria-describedby="example_info">
                                        <thead>
                                            <tr>
                                                <th>Kategori</th>
                                                <th>Klasifikasi</th>
                                                <th>Kode</th>
                                                <th>Satuan</th>
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

{{-- Detail Merk Barang Modal --}}
<div class="modal fade" id="merkModal" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center">
                    <h3 style="color: #023e8a">List Merk Barang</h3>
                </div>
                <div class="modal-body ">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-body">
                                    <table id="dt_merk" class="display nowrap dataTable dtr-inline collapsed"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Nama Merk</th>
                                                <th>Kode Merk</th>
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

{{-- Detail Model Barang Modal --}}
<div class="modal fade" id="modelModal" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center">
                    <h3 style="color: #023e8a">List Model Barang</h3>
                </div>
                <div class="modal-body ">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-body">
                                    <table id="dt_model" class="display nowrap dataTable dtr-inline collapsed"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Nama Model</th>
                                                <th>Kode Model</th>
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

{{-- Detail Warna Barang Modal --}}
<div class="modal fade" id="warnaModal" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center">
                    <h3 style="color: #023e8a">List Warna Barang</h3>
                </div>
                <div class="modal-body ">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card-body">
                                <table id="dt_warna" class="display nowrap dataTable dtr-inline collapsed"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Nama Warna</th>
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

{{-- ---------------------------------------------- Dokumentasi ---------------------------------------------- --}}

{{-- Dokumentasi Lokasi --}}
<div class="modal fade" id="dokumenLok" aria-labelledby="listLokasiModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
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
                        <div class="card-body">
                            <table id="dt_dokLok" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nama File</th>
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

{{-- Dokumentasi Sub Lokasi --}}
<div class="modal fade" id="dokSubLok" aria-labelledby="listLokasiModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content" style="overflow-y: initial">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="container"></div>
            <div class="card">
                <div class="card-header card text-center" id="headDokSubL">
                </div>
                <div class="modal-body ">
                    <div class="card">
                        <div class="card-body">
                            <table id="dt_dokSubL" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nama File</th>
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

{{-- Dokumentasi Asset --}}
<div class="modal fade" id="dokAsset" aria-labelledby="listLokasiModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
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
                        <div class="card-body">
                            <table id="dt_AssetDok" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nama File</th>
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

{{-- Dokumentasi Sub Asset --}}
<div class="modal fade" id="dokumenSubAsset" aria-labelledby="listLokasiModalLabel" aria-hidden="true"
    tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
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
                        <div class="card-body">
                            <table id="dt_dokSubA" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nama File</th>
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

{{-- Dokumentasi Vendor --}}
<div class="modal" id="detail" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y" style="overflow-y: block;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center">
                    <h4>Detail Vendors</h4>
                </div>
                <div class="card-body">
                    <form id="detailForm">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Vendor</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="vendorD" id="vendorD"
                                    placeholder="Nama Vendor" readonly>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat Vendor</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="alamatD" name="alamatD"
                                    placeholder="Alamat Vendor" readonly>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Contact Person</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="kontakD" id="kontakD"
                                    placeholder="Nama Orang Yang di Kontak" readonly>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select class="form-select" id="jenisD" name="jenisD[]" disabled multiple>
                                        {{-- <option selected disabled value="">Pilih Jenis</option> --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nomor HP/Telephone</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="hpD0" disabled>
                            </div>
                        </div>
                        <div id=detailP></div>
                        <input type="hidden" name="count1" id="count" value="0">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
