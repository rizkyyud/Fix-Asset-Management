{{-- Desain Input Lokasi --}}
<div class="modal fade" id="inLokasi" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmLokasiIn">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Form Input Lokasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Lokasi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="lokasiIn" placeholder="Nama Lokasi"
                                    id="lokasiIn" required="" value="{{ old('lokasiIn') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat Lokasi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="alamat" placeholder="Alamat" required=""
                                    id="alamatIn" value="{{ old('alamat') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
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

{{-- Edit Lokasi Modal --}}
<div class="modal fade" id="editLokasi" tabindex="-1" aria-labelledby="editLokasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmLokasiE">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Form Input Lokasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Lokasi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Nama Lokasi" id="lokasiE"
                                    required="">
                                <input type="hidden" id="cekLokasi">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat Lokasi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Alamat" required="" id="alamatE">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
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
                    <form class="needs-validation was-validated" id="dokumenLokFrm">
                        <div class="card card">
                            {{-- <div class="card-header card text-center">
                                <h4></h4>
                            </div> --}}
                            <div class="card-body">
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

{{-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

{{-- Input Sub Lokasi --}}
<div class="modal fade" id="subLokasiIn" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmsubLIn">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Form Input Lokasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Sub Lokasi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="subLin" placeholder="Nama Lokasi"
                                    id="subLin" required="" value="{{ old('subLin') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" id="klsDrp">
                            <label class="col-sm-3 col-form-label">Lokasi</label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="klas" id="drpLokasiIn">
                                    <option selected disabled value="">Pilih Lokasi</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
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

{{-- Edit Sub Lokasi --}}
<div class="modal fade" id="editsubL" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmsubEdit">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Form Edit Sub Lokasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Sub Lokasi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Nama Lokasi" id="editSubL"
                                    required="">
                                <input type="hidden" id="cekSubL">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" id="klsDrp">
                            <label class="col-sm-3 col-form-label">Lokasi</label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="klas" id="editDrpLokasi">
                                    <option selected disabled value="">Pilih Lokasi</option>
                                </select>
                                <input type="hidden" id="cekDrpLokasi">
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
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

{{-- Dokumentasi Sub Lokasi --}}
<div class="modal fade" id="dokumenSubL" aria-labelledby="listLokasiModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content" style="overflow-y: initial">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="container"></div>
            <div class="card">
                <div class="card-header card text-center" id="headerDokSub">
                </div>
                <div class="modal-body ">
                    <form class="needs-validation was-validated" id="dokumenLokFrm">
                        <div class="card card">
                            {{-- <div class="card-header card text-center">
                                <h4></h4>
                            </div> --}}
                            <div class="card-body">
                                <div class="tab-content tab-bordered" id="myTab3Content">
                                    <div class="tab-pane fade show active" id="home2" role="tabpanel"
                                        aria-labelledby="home-tab2">
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
                            <table id="dt_dokumenSub" class="display nowrap dataTable dtr-inline collapsed"
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

{{-- Input Kategori --}}
<div class="modal fade" id="inKategori" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmKateIn" novalidate>
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Form Input Kategori</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kategori Assets</label>
                                <input type="text" class="form-control" name="kateIn" placeholder="Kategori Assets"
                                    id="kateIn" required="" value="{{ old('kateIn') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Unique Kode</label>
                                <input type="text" class="form-control" name="kode" maxlength="2"
                                    style="text-transform:uppercase" placeholder="Kategori Assets" id="kode"
                                    required="">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
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

{{-- Edit Kategori --}}
<div class="modal fade" id="editKategori" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmKateIn">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Form Edit Kategori</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kategori Assets</label>
                                <input type="text" class="form-control" name="kateE" placeholder="Kategori Assets"
                                    id="kateE" required="">
                                <input type="hidden" id="cekKate">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Unique Kode</label>
                                <input type="text" class="form-control" name="kodeE" maxlength="2"
                                    style="text-transform:uppercase" placeholder="Kategori Assets" id="kodeE"
                                    required="">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
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

{{-- Input Pemilik --}}
<div class="modal fade" id="inPemilik" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmPemilikIn">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Input Data Pemilik</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nama Pemilik</label>
                                <input type="text" class="form-control" placeholder="Nama Pemilik" id="pemilikIn"
                                    required="" value="{{ old('pemilikIn') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Jenis Kepemilikan</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="klas" id="drpStatus">
                                    <option selected disabled value="">Pilih Kepemilikan</option>
                                    <option value="Pribadi">Pribadi</option>
                                    <option value="Yayasan">Yayasan</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Alamat Pemilik</label>
                                <input type="text" class="form-control" placeholder="Alamat Pemilik" id="aPemilikIn"
                                    required="" value="{{ old('alamatIn') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nomor</label>
                                <input type="number" class="form-control" placeholder="Nomor Pemilik" id="nomorIn"
                                    required="" value="{{ old('nomorIn') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
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

{{-- Edit Pemilik --}}
<div class="modal fade" id="editPemilik" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmEditPemilik">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Form Edit Pemilik</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nama Pemilik</label>
                                <input type="text" class="form-control" placeholder="Nama Pemilik Assets"
                                    id="pemilikE" required="">
                                <input type="hidden" id="cekPemilik">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Jenis Kepemilikan</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="klas" id="statusE">
                                    <option selected disabled value="">Pilih Kepemilikan</option>
                                    <option value="Pribadi">Pribadi</option>
                                    <option value="Yayasan">Yayasan</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Alamat Pemilik</label>
                                <input type="text" class="form-control" placeholder="Alamat Pemilik" id="aPemilikE"
                                    required="" value="{{ old('alamatE') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nomor</label>
                                <input type="number" class="form-control" placeholder="Nomor Pemilik" id="nomorE"
                                    maxlength="12" required="" value="{{ old('nomorE') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
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

