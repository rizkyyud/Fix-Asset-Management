{{-- Tambah Vendor Modal --}}
<div class="modal fade" id="insert" tabindex="-1" aria-labelledby="vendorsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content" style="overflow-y: block;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form class="needs-validation was-validated" id="frmVendorIn" enctype="multipart/form-data">
                <div class="card">
                    @csrf
                    <div class="card-header">
                        <h4>Form Input Vendors</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Vendor</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="vendor" id="vendorIn"
                                    placeholder="Nama Vendor" required="" value="{{ old('vendor') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat Vendor</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    placeholder="Alamat Vendor" required="" value="{{ old('alamat') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Contact Person</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="kontak" id="kontak"
                                    placeholder="Nama Orang Yang di Kontak" required="" value="{{ old('kontak') }}">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select class="form-select" id="jenisIn" name="jenis[]" placeholder="Jenis"
                                        required="" multiple>
                                        {{-- <option selected disabled value="">Pilih Jenis</option> --}}
                                        @foreach ($jenis as $items)
                                            <option value="{{ $items->id_jenisIven }}">
                                                {{ $items->jenis_iventaris }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- <button type="button" class="btn btn-info" onclick="jenisAdd()">+</i></button> --}}
                                    <div class="invalid-feedback">
                                        Harus Dipilih
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="jenisAdd"></div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nomor HP/Telephone</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="nomorHp0" id="hp0" placeholder="Nomor"
                                    required="" value="{{ old('nomorHp0') }}" maxlength="12">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-info" onclick="myFunction()">+</button>
                            </div>
                        </div>
                        <div id=phoneInput>
                        </div>
                        <input type="hidden" name="count1" id="count" value="0">
                    </div>
                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-danger" id="closeInput" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Detail Vendor --}}
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

{{-- Edit Vendor --}}
<div class="modal" id="edit" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y" style="overflow-y: block;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form id="editForm" class="needs-validation was-validated">
                    <div class="card-header card text-center">
                        <h4>Edit Vendors</h4>
                    </div>
                    <div class="card-body">
                        <form id="editForm">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Vendor</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="vendorE" placeholder="Nama Vendor">
                                    <input type="hidden" id="cekVendor">
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Alamat Vendor</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="alamatE" placeholder="Alamat Vendor">
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Contact Person</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="kontakE"
                                        placeholder="Nama Orang Yang di Kontak">
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jenis</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <select class="form-select" id="jenisE" name="jenisE[]" required multiple>
                                            {{-- <option selected disabled value="">Pilih Jenis</option> --}}
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Dipilih
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nomor HP/Telephone</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="hpE0" placeholder="Nomor" required=""
                                        maxlength="12">
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-info" onclick="myFunction1()">+</button>
                                </div>
                            </div>
                            <div id=editP></div>
                            <input type="hidden" name="countE" id="countE">
                            <div class="card-footer text-right">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-success">Ubah Vendor</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
