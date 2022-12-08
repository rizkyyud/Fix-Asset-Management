{{-- Tambah Klasifikasi --}}
<div class="modal fade" id="jenisInM" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="inJenis">
                    <div class="card-header card text-center">
                        <h4>Penambahan Klasifikasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Klasifikasi Barang</label>
                                <input type="text" class="form-control" name="jenis" placeholder="Klasifikasi Invantaris"
                                    id="jenisIn" required="" value="{{ old('jenis') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right" id="submitAddKlass">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

{{-- Edit Klasifikasi --}}
<div class="modal fade" id="editJenis" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmEditJ">
                    <div class="card-header card text-center">
                        <h4>Edit Klasifikasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Klasifikasi Barang</label>
                                <input type="text" class="form-control" name="jenis" placeholder="Klasifikasi Inventaris"
                                    id="editJ" required="">
                                <input type="hidden" id="cekJ">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right" id="submitEditKlass">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Tambah Kategori Barang --}}
<div class="modal fade" id="inTipe" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmAddIn">
                    <div class="card-header card text-center">
                        <h4>Penambahan Kategori Barang</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Klasifikasi Barang</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="jenis" id="jenisB">
                                    <option value="">Pilih Klasifikasi</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kategori Barang</label>
                                <input type="text" class="form-control" name="tipe" placeholder="Nama Kategori"
                                    required="" value="{{ old('tipe') }}" id="tipe">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kode</label>
                                <input type="text" class="form-control" name="kode" id="kode" maxlength="3"
                                    style="text-transform:uppercase" minlength="3" placeholder="Kode Barang" required=""
                                    value="{{ old('kode') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Satuan</label>
                                <input type="text" class="form-control" name="satuan" id="satuan"
                                    placeholder="Satuan Barang" required="" value="{{ old('satuan') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right" id="submitAddKate">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Edit Kategori Barang --}}
<div class="modal fade" id="editTipe" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmEditTipe">
                    <div class="card-header card text-center">
                        <h4>Edit Kategori Barang</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Klasifikasi Barang</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="jenis" id="editJenisB">
                                    <option value="">Pilih Klasifikasi Barang</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kategori Barang</label>
                                <input type="text" class="form-control" name="tipe" placeholder="Kategori Barang"
                                    id="tipeE" required="">
                                <input type="hidden" id="temBarang">
                                <div class="invalid-feedback" id="feedTipe">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kode Barang</label>
                                <input type="text" class="form-control" name="kode" id="kodeE" maxlength="3"
                                    required="" style="text-transform:uppercase" minlength="3"
                                    placeholder="Kode Barang">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Satuan Barang</label>
                                <input type="text" class="form-control" name="satuan" id="satuanE"
                                    placeholder="Satuan Barang" required="" value="{{ old('satuan') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right" id="submitEditKate">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
