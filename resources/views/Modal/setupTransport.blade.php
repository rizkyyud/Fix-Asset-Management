{{-- Desain Input Jenis Kendaraan --}}
<div class="modal fade" id="inJnsKdr" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmjnsKdrIn">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Form Input Jenis Kendaraan</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Jenis Kendaraan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="jnsKdrIn" placeholder="Jensi Kendaraan"
                                    id="jnsKdrIn" required="">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Max Penumpang</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="penumpang" placeholder="Maksimal Penumpang (Tidak Termasuk Supir)"
                                    id="penumpang" required="">
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

{{-- Desain Input Supir--}}
<div class="modal fade" id="inSupir" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmSupirIn">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Form Input Nama Supir</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Supir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="supirIn" placeholder="Nama Supir"
                                    id="supirIn" required="">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Statup</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="statusD" name="status"
                                    aria-label="Example select with button addon" required="">
                                    <option selected disabled value="">Pilih Status Driver</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tarif Supir (/Hari)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="tarif" placeholder="Tarif Supir"
                                    id="tarif" required="">
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

{{-- Desain Modal Status Supir--}}
<div class="modal fade" id="inStatus" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmStatusIn">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Form Input Status Supir</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status Supir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="status" placeholder="Status"
                                    id="status" required="">
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

{{-- Desain Modal Jenis BBM--}}
<div class="modal fade" id="inBBM" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmJenisBBM">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Form Input Jenis Bahan Bakar</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Bahan Bakar</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="jns_bbm" placeholder="Nama Bahan Bakar"
                                    id="jns_bbm" required="">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Harga BBM (/Liter)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="tarif" placeholder="Harga"
                                    id="hargaBBM" required="">
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