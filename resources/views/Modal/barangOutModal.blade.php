{{-- Tambah Barang Out --}}
<div class="modal fade" id="barangOut" tabindex="-1" aria-labelledby="barangIvenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content" style="overflow-y: block;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmBarangOut">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Form Keluar Barang</h4>
                        <div class="card-header-action">
                            {{-- <a href="#" class="btn btn-success" onclick="myFunction()">
                                <i class="fas fa-plus-circle"></i> Tambah
                            </a> --}}
                            <a href="#" class="btn btn-danger" onclick="close1()" id="delAdd"><i
                                    class="fas fa-minus-circle"></i> Hapus
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content tab-bordered">
                            <div class="tab-pane fade show active" id="home2" role="tabpanel"
                                aria-labelledby="home-tab2">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputCity">Pilih Gudang</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" id="gudang">
                                            {{-- <option selected disabled value="">Pilih Gudang</option> --}}
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Dipilih
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputCity">Label Barang</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" id="label0" multiple>
                                            {{-- <option selected disabled value="">Pilih Label</option> --}}
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Dipilih
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputState">Asset</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" id="assets0">
                                            <option selected disabled value="">Pilih Lokasi</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Dipilih
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3" id="subAsset">
                                        <label for="inputState">Sub Asset</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" id="sub0">
                                            <option selected disabled value="0">Tanpa Sub</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Dipilih
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id=labelAdd></div>
                        <input type="hidden" name="count1" id="count" value="0">
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Histori Barang Iven --}}
<div class="modal fade" id="histori" tabindex="-1" aria-labelledby="barangIvenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="card-header card text-center">
                    <h4>Histori Barang Masuk</h4>
                </div>
                <div class="card-body">
                    <table id="dt_histori" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Kode Order</th>
                                <th>Detail</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
