{{-- Desain Input pemilik --}}

<div class="modal fade" id="pemilikModal" tabindex="-1" aria-labelledby="pemilikModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" novalidate="" action="pemilik" method="post">
                    @csrf
                    <div class="card-header">
                        <h4>Form Input Pemilik</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Pemilik</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Nama Pemilik" name="nama"
                                    required="" value="{{ old('nama') }}">
                                <div class="invalid-feedback">
                                    Nama Pemilik Tidak Boleh kosong
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="status">
                                    <option value="">Pilih Pemilik</option>
                                    <option value="Pribadi">Pribadi</option>
                                    <option value="Yayasan/Perusahaan">Yayasan / Perusahaan</option>
                                </select>
                                <div class="invalid-feedback">
                                    Pilih Pemilik
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kode Pemilik</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Kode Pemilik" name="kode"
                                    required="" value="{{ old('kode') }}">
                                <div class="invalid-feedback">
                                    Kode Tidak Boleh kosong
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

@include('sweetalert::alert')
{{-- Tutup Modal Edit pemilik --}}

{{-- Edit pemilik Modal --}}
@foreach ($pemilik as $data)
    <div class="modal fade" id="editPemilik{{ $data->id_pemilik }}" tabindex="-1"
        aria-labelledby="editPemilikLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        {{-- <i class="fas fa-times"></i> --}}
                    </button>
                </div>
                <div class="card">
                    <form class="needs-validation was-validated" novalidate=""
                        action="{{ url('/pemilik/up/' . $data->id_pemilik) }}" method="post">
                        @csrf
                        <div class="card-header">
                            <h4>Form Input pemilik</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama pemilik</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama" placeholder="Kota / Kabupaten"
                                        required="" value="{{ $data->nama_pemilik }}">
                                    <div class="invalid-feedback">
                                        Nama Tidak Boleh kosongan
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        required="" name="status">
                                        <option @if ($data->status == 'Pribadi') selected @endif value="Pribadi">Pribadi</option>
                                        <option @if ($data->status == 'Group') selected @endif value="Group">Yayasan / Perusahaan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-success">Ubah pemilik</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@include('sweetalert::alert')
