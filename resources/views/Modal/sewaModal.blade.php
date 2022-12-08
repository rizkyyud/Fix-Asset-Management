{{-- ---------------------------------------- Input Form ---------------------------------------- --}}

{{-- Desain Input Harga Villa --}}
<div class="modal fade" id="sewaGdg1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="formHargaVila">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Input Harga Sewa</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Pilih Property</label>
                                <select class="form-control form-select" aria-label=".form-select-sm example"
                                    required="" name="assets" id="assetsB">
                                    <option selected value="">Pilih Property</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" id="subList" style="display:none">
                            <div class="col-sm-12">
                                <label>Pilih Sub</label>
                                <select class="form-control form-select" aria-label=".form-select-sm example"
                                    required="" name="subAsset" id="subAsset">
                                    <option selected value="">Pilih Assets</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Season</label>
                                <select class="form-control form-select" aria-label=".form-select-sm example"
                                    required="" name="plhSession" id="plhSession">
                                    <option selected value="">Pilih Seasson</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Harga</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" name="hargaVila" id="hargaVila"
                                        value="{{ old('hargaVila') }}" required>

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
                        <button class="btn btn-success" id="submit" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Desain Input Seasson --}}
<div class="modal fade" id="seassonModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" novalidate="" id="FRM_ADD_SEASSON">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Input Seasson</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nama Seasson</label>
                                <input type="text" class="form-control" name="keterangan" id="keterangan"
                                    value="" required>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="cekList">
                            <label class="form-check-label" for="gridCheck">
                                Check List Jika Ingin Menggunakan Tanggal
                            </label>
                        </div>
                        <br>
                        <div class="form-group row" id="range" style="display: none">
                            <div class="col-sm-6">
                                <label>Tanggal Awal</label>
                                <input type="date" class="form-control" name="awal" id="awal"
                                    value="<?= date('Y-m-d') ?>" required>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Tanggal Akhir</label>
                                <input type="date" class="form-control" name="akhir" id="akhir"
                                    value="<?= date('Y-m-d') ?>" required>
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

{{-- ---------------------------------------- Edit Form ---------------------------------------- --}}
{{-- Edit Harga --}}
<div class="modal fade" id="editHarga" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" novalidate="" id="FRM_EDIT_HARGA">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Edit Harga Sewa</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Pilih Assets</label>
                                <select class="form-control form-select" aria-label=".form-select-sm example"
                                    required="" name="editAsset" id="editAsset">
                                    <option selected value="">Pilih Assets</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="subCek">
                                    <label class="form-check-label">Cek List Untuk Memakai Sub</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" id="subList" style="display:none">
                            <div class="col-sm-12">
                                <label>Pilih Sub</label>
                                <select class="form-control form-select" aria-label=".form-select-sm example"
                                    required="" name="editSub" id="editSub">
                                    <option selected value="">Pilih Assets</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Season</label>
                                <select class="form-control form-select" aria-label=".form-select-sm example"
                                    required="" name="EDIT_PLH_SEASON" id="EDIT_PLH_SEASON">
                                    <option selected value="">Pilih Seasson</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Tanggal Season</label>
                                <input type="text" class="form-control" name="EDIT_TANGGAL_SEWA"
                                    id="EDIT_TANGGAL_SEWA" readonly>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Harga</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" name="EDIT_HARGA_VILA"
                                        id="EDIT_HARGA_VILA" required>

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
                        <button class="btn btn-success" id="submit" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

