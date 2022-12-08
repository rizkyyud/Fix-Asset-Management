{{-- Desain Via --}}
<div class="modal fade" id="addVia" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="FRM_VIA_VILLA">
                    <div class="card-header card text-center">
                        <h4 id="headViaAgen">Input Via</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Keterangan Via</label>
                                <input type="text" class="form-control" name="via" id="viaKet" required>
                                <div class="invalid-feedback">
                                    Harus Diisi
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

{{-- Desain Via Payment--}}
<div class="modal fade" id="addViaP" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="FRM_VIA_PAY">
                    <div class="card-header card text-center">
                        <h4 id="headViaPay">Input Via Payment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Keterangan Payment</label>
                                <input type="text" class="form-control" name="viaKetP" id="viaKetP" required>
                                <div class="invalid-feedback">
                                    Harus Diisi
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