{{-- Desain Input Reservasi --}}
{{-- <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="penyewaan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="FRM_RESERVASI_ASSET">
                    <div class="card-header card text-center">
                        <h4>Reservasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Tanggal Check In</label>
                                <input type="date" class="form-control" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" name="checkIn"
                                    id="checkIn" value="{{ old('checkIn') }}" required>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Tanggal Check Out</label>
                                <input type="date" class="form-control" min="<?= date('Y-m-d') ?>" name="checkOut"
                                    id="checkOut" value="{{ old('checkOut') }}" required>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Nama Penyewa</label>
                                <select class="form-control form-select" aria-label=".form-select-sm example"
                                    required="" name="penyewa" id="penyewa">
                                    <option selected value="">Pilih Nama Penyewa</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Pilih Villa</label>
                                <select class="form-control form-select" aria-label=".form-select-sm example"
                                    required="" name="assets" id="assetsB">
                                    <option selected value="">Pilih Assets</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Total Harga</label>
                                <input type="text" class="form-control" id="totalHarga" disabled>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label> </label>
                                <br>
                                <br>
                                <button class="btn btn-primary">Cek Detail Harga</button>
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
</div> --}}

{{-- Desain Edit Reservasi --}}
{{-- <div class="modal fade" id="Edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="EDIT_RESERVASI_ASSET">
                    <div class="card-header card text-center">
                        <h4>Edit Reservasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Tanggal Check In</label>
                                <input type="date" class="form-control" min="<?= date('Y-m-d') ?>"
                                    name="EDIT_CHECK_IN" id="checkIn" value="{{ old('checkIn') }}" required>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Tanggal Check Out</label>
                                <input type="date" class="form-control" min="<?= date('Y-m-d') ?>"
                                    name="EDIT_CHECK_OUT" id="checkOut" value="{{ old('checkOut') }}" required>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
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
                        <div class="form-group row">
                            <div class="col-sm-12" id="subList" style="display:none">
                                <label>Pilih Sub</label>
                                <select class="form-control form-select" aria-label=".form-select-sm example"
                                    required="" name="editSub" id="editSub">
                                    <option selected value="">Pilih Sub</option>
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
                                    required="" name="editSeason" id="editSeason">
                                    <option selected value="">Pilih Jenis Season</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Harga</label>
                                <input type="text" class="form-control" name="harga" id="harga" disabled>
                            </div>
                        </div>
                        <div class="form-group row"></div>
                        <hr>
                        <center>
                            <h5 style="color:#163d64">Biodata Pemesan</h5>
                        </center>
                        <hr><br>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Nama Pemesan</label>
                                <input type="text" class="form-control" name="editNama" id="editNama"
                                    value="{{ old('namaPemesan') }}" required>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Alamat Pemesan</label>
                                <input type="text" class="form-control" name="editAlamat" id="editAlamat"
                                    value="{{ old('alamatPemesan') }}" required>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Email Pemesan</label>
                                <input type="email" class="form-control" name="editEmail" id="editEmail"
                                    value="{{ old('emailPemesan') }}" required>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Kontak Pemesan (Nomor Hp)</label>
                                <input type="text" class="form-control" name="editNomor" id="editNomor"
                                    value="{{ old('nomorPemesan') }}" required>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>User Name</label>
                                <input type="text" class="form-control" name="editUsername" id="editUsername"
                                    value="{{ old('username') }}" required>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Password</label>
                                <input type="text" class="form-control" name="editPassword" id="editPassword"
                                    value="{{ old('password') }}" required>
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
</div> --}}

{{-- Desain Input Penyewa --}}
<div class="modal fade" id="addPenyewa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="FRM_PENYEWA_ASSET">
                    <div class="card-header card text-center">
                        <h4 id="headPenyewa">Input Penyewa</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Nama Pemesan</label>
                                <input type="text" class="form-control" name="namaPemesan" id="namaPemesan" required>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Alamat Pemesan</label>
                                <input type="text" class="form-control" name="alamatPemesan" id="alamatPemesan"
                                    required>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Email Pemesan</label>
                                <input type="email" class="form-control" name="emailPemesan" id="emailPemesan"
                                    required>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Kontak Pemesan (Nomor Hp)</label>
                                <input type="text" class="form-control" name="nomorPemesan" id="nomorPemesan"
                                    required>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>User Name</label>
                                <input type="text" class="form-control" name="username" id="username" required>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Password</label>
                                <input type="text" class="form-control" name="password" id="password" required>
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

{{-- Desain Input Via --}}
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

{{-- Desain Input Pelunasan --}}
<div class="modal fade" id="cicilan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            {{-- <div class="select" id="wait"><div> --}}

            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center">
                    <h4 id="headBayar">Pembayaran</h4>
                    <h4 id="tagihanCicil"></h4>
                    <h4 id="sisaCicilan"></h4>
                </div>

                <div class="card-body">

                    <div class="form-group row" style="border: solid; border-style:">
                        <div class="col-sm-12">
                            <br>
                            <div class="tab-content tab-bordered">
                                <div class="tab-pane fade show active">
                                    <center>
                                        <h5 style="color: #023e8a">Histori Pembayaran</h5>
                                    </center>
                                    <div class="card-body">
                                        <div class="col-sm-12">
                                            <table id="dt_cicilan"
                                                class="display nowrap dataTable dtr-inline collapsed"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Tanggal Pembayaran</th>
                                                        <th>Via Payment</th>
                                                        <th>Status</th>
                                                        <th>Nominal</th>
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
                    <div class="form-group row" style="border: solid; border-style:" id="inputCicilan">
                        <div class="col-sm-12">
                            <br>
                            <div class="tab-content tab-bordered">
                                <div class="tab-pane fade show active">
                                    <form class="needs-validation was-validated" id="FRM_LUNAS_VILLA">
                                        <center>
                                            <h5 style="color: #023e8a">Tambah Pembayaran</h5>
                                        </center>
                                        <div class="card-body">
                                            <hr>
                                            <input type="hidden" name="kodeRes" id="kodeRes">
                                            <div class="form-group row" id="statusCicil">
                                                <div class="col-sm-3">
                                                    <label>Status Pembayaran</label>
                                                    <select class="form-control form-select"
                                                        aria-label=".form-select-sm example" required=""
                                                        name="cicilStatus" id="cicilStatus">
                                                        <option selected value="">Pilih Status
                                                        </option>
                                                        <option value="1">Lunas</option>
                                                        <option value="2">Down Paymant(DP)</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Harus Diisi
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>Via Payment</label>
                                                    <select class="form-control form-select"
                                                        aria-label=".form-select-sm example" required=""
                                                        name="cicilPay" id="cicilPay">
                                                        <option selected value="">Pilih Payment</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Harus Dipilih
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>Nominal Yang Dibayar</label>
                                                    <input type="text" class="form-control" id="cicil"
                                                        disabled>
                                                    <div class="invalid-feedback">
                                                        Harus Dipilih
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>Tanggal Bayar</label>
                                                    <input type="date" class="form-control"
                                                        value="<?php echo date('Y-m-d'); ?>" name="tglCicil" id="tglCicil"
                                                        required>
                                                    <div class="invalid-feedback">
                                                        Harus Diisi
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button class="btn btn-success" id="submit"
                                                type="submit">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Detail All Modal --}}
<div class="modal fade" id="detailRes" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body ">

                <div class="card">
                    <div class="card-header card text-center">
                        <h4>Detail Reservasi</h4>
                    </div>
                    <div class="card-body">
                        <div id="hargaDetail"></div>
                        <div id="diskonDetail"></div>
                        <hr>
                        <div class="form-group row">
                            <strong class="col-4">Harga Villa</strong>
                            <strong class="col-2">:</strong>
                            <strong class="col-6" id="totalVilla">Rp.
                                0</strong>
                        </div>
                        <div class="form-group row">
                            <strong class="col-4">Diskon</strong>
                            <strong class="col-2">:</strong>
                            <strong class="col-6" id="totalDiskon">0</strong>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <strong class="col-4">Total</strong>
                            <strong class="col-2">:</strong>
                            <strong class="col-6" id="total">0</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
