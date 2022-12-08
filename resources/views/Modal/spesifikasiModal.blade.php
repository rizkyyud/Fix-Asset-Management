{{-- Tambah Model --}}
<div class="modal fade" id="modelIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmModelAdd">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Penambahan Model</h4>
                    </div>
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
                                <label>Kode Model</label>
                                <input type="text" class="form-control" name="kodeModel" id="kodeModel" maxlength="3"
                                    style="text-transform:uppercase" placeholder="Kode" required=""
                                    value="{{ old('kodeModel') }}">
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
        </div>
    </div>
</div>

{{-- Tambah Merk --}}
<div class="modal fade" id="merkIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmMerkAdd">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Penambahan Merk</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nama Merk</label>
                                <input type="text" class="form-control" name="merk" id="merkAdd" required=""
                                    value="{{ old('merk') }}" placeholder="Nama">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kode Merk</label>
                                <input type="text" class="form-control" name="kodeMerk" maxlength="3" id="kodeMerk"
                                    required="" value="{{ old('kodeMerk') }}" placeholder="Kode"
                                    style="text-transform:uppercase">
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
        </div>
    </div>
</div>

{{-- Tambah Warna --}}
<div class="modal fade" id="warnaIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmWarnaAdd">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Penambahan Warna</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label>Nama Warna</label>
                                <input type="text" class="form-control" name="warna" id="warnaAdd" required=""
                                    value="{{ old('warna') }}">
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
        </div>
    </div>
</div>

{{-- Edit Model --}}
<div class="modal fade" id="editModel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmModelE">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Edit Model</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nama Model</label>
                                <input type="text" class="form-control" name="model" id="modelEdit"
                                    placeholder="Model" required="">
                                <input type="hidden" id="cekModel">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kode Model</label>
                                <input type="text" class="form-control" name="kodeModelE" id="kodeModelE"
                                    maxlength="3" style="text-transform:uppercase" placeholder="Kode" required=""
                                    value="{{ old('kodeModelE') }}">
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
        </div>
    </div>
</div>

{{-- Edit Merk --}}
<div class="modal fade" id="editMerk" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmMerkE">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Edit Merk</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nama Merk</label>
                                <input type="text" class="form-control" name="merk" id="merkEdit" placeholder="Merk"
                                    required="">
                                <input type="hidden" id="cekMerk">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kode Merk</label>
                                <input type="text" class="form-control" name="kodeMerkE" minlength="3" maxlength="3"
                                    id="kodeMerkE" required="" value="{{ old('kodeMerkE') }}" placeholder="Kode"
                                    style="text-transform:uppercase">
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
        </div>
    </div>
</div>

{{-- Edit Warna --}}
<div class="modal fade" id="editWarna" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmWarnaE">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Edit Warna</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nama Warna</label>
                                <input type="text" class="form-control" name="Warna" id="warnaEdit"
                                    placeholder="Warna" required="">
                                <input type="hidden" id="cekWarna">
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
        </div>
    </div>
</div>
