@extends('layouts\master')
@section('header-form')
<h1>Reservasi</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="dashboard">Home</a></div>
    <div class="breadcrumb-item">Reservasi</div>
</div>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab2" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2" role="tab"
                    aria-controls="home" aria-selected="true" onclick="reserv()">Reservasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab"
                    aria-controls="profile" aria-selected="false" onclick="listPenyewa()">Penyewa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="report-tab2" data-toggle="tab" href="#report" role="tab" aria-controls="report"
                    aria-selected="false">Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="report-sales" data-toggle="tab" href="#reportSales" role="tab" aria-controls="report"
                    aria-selected="false">Report Sales</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" id="via-tab" data-toggle="tab" href="#via" role="tab" onclick="listVia()"
                    aria-controls="via" aria-selected="false">Via</a>
            </li> --}}
        </ul>
        <div class="tab-content tab-bordered" id="myTab3Content">
            <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab2">
                <br>
                <div class="card card-primary" style="display: none" id="reservasiForm">
                    <form class="needs-validation was-validated" id="FRM_RESERVASI_ASSET">
                        <div class="card-header card text-center">
                            <h4 id="headReservasi">Input Reservasi</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-danger" onclick="closeReservasi()">
                                    X
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label>Tanggal Check In</label>
                                    <input type="date" class="form-control" min="2022-01-01" name="checkIn" id="checkIn"
                                        required>
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <label>Tanggal Check Out</label>
                                    <input type="date" class="form-control" name="checkOut" id="checkOut" required>
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label>Durasi (Malam)</label>
                                    <input type="text" class="form-control" id="durasi" disabled required>
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
                                    <label>Pilih Jenis Diskon</label>
                                    <br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="form-check-input" type="radio" name="cekDiskon" id="default"
                                            value=0 checked>
                                        <label class="form-check-label" for="inlineRadio2">Diskon Keseluruhan</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="form-check-input" type="radio" name="cekDiskon" id="custom"
                                            value=1>
                                        <label class="form-check-label" for="inlineRadio1">Diskon Harian</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        Harus Dipilih
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Nominal Diskon</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control" value=0 name="diskon" id="diskon"
                                            required>

                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                        <div class="invalid-feedback">
                                            Harus Diisi
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label>Via Pemesanan</label>
                                    <select class="form-control form-select" aria-label=".form-select-sm example"
                                        required="" name="viaAdd" id="viaAdd">
                                        <option selected value="">Pilih Via</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Harus Dipilih
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Total Tagihan</label>
                                    <input type="text" class="form-control" id="totalHarga" disabled>
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" id="detailAll">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#detailRes"><i class="far fa-list-alt"></i> Detail Reservasi
                                </button>
                                {{-- <div class="col-sm-12">

                                    <br>
                                    <div class="tab-content tab-bordered">
                                        <div class="tab-pane fade show active">
                                            <center>
                                                <h5 style="color: #023e8a">Detail Reservasi</h5>
                                            </center>
                                            <div class="card-body">
                                                <div id="hargaDetail"></div>
                                                <div id="diskonDetail"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <br>
                                    <div class="tab-content tab-bordered">
                                        <div class="tab-pane fade show active">
                                            <center>
                                                <h5 style="color: #023e8a">Total Harga</h5>
                                            </center>
                                            <div class="card-body">
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
                                    <br>
                                </div> --}}
                            </div>
                            <div class="form-group row" id="cekStatus" style="display: none">
                                <div class="col-sm-3">
                                    <label>Status Pembayaran</label>
                                    <select class="form-control form-select" aria-label=".form-select-sm example"
                                        required="" name="statusBayar" id="statusBayar">
                                        <option selected value="">Pilih Status Pembayaran</option>
                                        <option value="Lunas">Lunas</option>
                                        <option value="Dp">Down Paymant(DP)</option>
                                        <option value="Belum">Belum Bayar</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label>Via Payment</label>
                                    <select class="form-control form-select" aria-label=".form-select-sm example"
                                        required="" name="viaPay" id="viaPay">
                                        <option selected value="">Pilih Payment</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Harus Dipilih
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label>Nominal Yang Dibayar</label>
                                    <input type="text" class="form-control" id="bayar" disabled>
                                    <div class="invalid-feedback">
                                        Harus Dipilih
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label>Tanggal Bayar</label>
                                    <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                                        name="tglBayar" id="tglBayar" required>
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right" id="AVAILABLE_VILLA_BUTTON">
                            <button type="button" class="btn btn-danger" onclick="closeReservasi()">Close</button>
                            <button class="btn btn-success" id="submitReservasi" type="submit">Simpan</button>
                        </div>
                        <div class="card-footer text-right" id="NOT_AVAILABLE_BUTTON">
                            <button type="button" class="btn btn-danger" onclick="closeReservasi()">Close</button>
                            <button class="btn btn-secondary" disabled>Data Sudah Ada</button>
                            {{-- <button class="btn btn-primary">Ubah Data</button> --}}
                        </div>
                    </form>
                </div>
                <div class="card card-info" id="reservasiMenu">
                    <div class="card-header card text-center">
                        <h4 style="color: #023e8a">List Reservasi</h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-success" id="reservAdd" onclick="penyewaanAdd()"
                                style="display: none">
                                <i class="fas fa-plus-circle"></i> Add Reservasi
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="dt_penyewaan" class="display nowrap dataTable dtr-inline collapsed"
                            style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Kode Reservasi</th>
                                    <th>Nama Pemesan</th>
                                    <th>Nama Villa</th>
                                    <th>Pembayaran Awal</th>
                                    <th>Status</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
                <div class="card">
                    <div class="card-header card text-center">
                        <h4 style="color: #023e8a">Penyewa</h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-primary" onclick="userAdd()" data-bs-toggle="modal"
                                data-bs-target="#addPenyewa">
                                <i class="fas fa-plus-circle"></i> Add Penyewa
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="dt_penyewa" class="display nowrap dataTable dtr-inline collapsed"
                            style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nama Pemesan</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>No. Hp</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="report" role="tabpanel" aria-labelledby="report-tab2">
                <div class="card">
                    <div class="card-header card text-center">
                        <h4 style="color: #023e8a">Laporan</h4>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation was-validated" id="FRM_REPORT_RESERVASI">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label>Dari</label>
                                    <input type="date" class="form-control" min="2022-01-01" name="reportAwal"
                                        id="reportAwal" required>
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Sampai</label>
                                    <input type="date" class="form-control" name="reportAkhir" id="reportAkhir"
                                        required>
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Cari</label>
                                    <br>
                                    <button class="btn btn-primary btn-lg" type="submit" onclick="getReport()"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <div id="tableShow" style="display: none">
                            <hr>
                            <center><button id="btnSaveReport" style="display: none" class="btn btn-primary btn-lg"
                                    onclick="savePdf()">Simpan</button></center>
                            <hr>
                            <table style="display: none" id="dt_report" name="dt_report"
                                class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                            </table>
                        </div>

                        <div id="previewImage">
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="reportSales" role="tabpanel" aria-labelledby="report-sales">
                <div class="card">
                    <div class="card-header card text-center">
                        <h4 style="color: #023e8a">Laporan</h4>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation was-validated" id="FRM_REPORT_SALES">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label>Dari</label>
                                    <input type="date" class="form-control" min="2022-01-01" name="reportAwal1"
                                        id="reportAwal1" required>
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Sampai</label>
                                    <input type="date" class="form-control" name="reportAkhir1" id="reportAkhir1"
                                        required>
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Cari</label>
                                    <br>
                                    <button class="btn btn-primary btn-lg" type="submit" onclick="getReportBayar()"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <div id="tableShow1" style="display: none">
                            <hr>
                            <center><button id="btnSaveReport1" style="display: none" class="btn btn-primary btn-lg"
                                    onclick="savePdfSales()">Simpan</button></center>
                            <hr>
                            <table style="display: none" id="dt_report1" name="dt_report1"
                                class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                            </table>
                        </div>

                        <div id="previewImage">
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="tab-pane fade" id="via" role="tabpanel" aria-labelledby="via-tab">
                <div class="card">
                    <div class="card-header card text-center">
                        <h4 style="color: #023e8a">Via</h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-primary" onclick="addVia()" data-bs-toggle="modal"
                                data-bs-target="#addVia">
                                <i class="fas fa-plus-circle"></i> Add Via
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="dt_via" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection
@include('Modal\penyewaanModal')


@push('page-scripts')
{{-- Rupiah Formating --}}
<script>
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function convertToAngka(rupiah) {
        return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
    }
</script>


{{-- Load Reservasi --}}
<script>
    function formatTime(tanggal) {
        var date = new Date(tanggal);
        var day = date.getDate() + 1;
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        var hsl = [day, month, year].join('/');
        return hsl;
    }

    $('#cicilan').on('hide.bs.modal', function (e) {
        $("#FRM_LUNAS_VILLA").unbind().click(function () { });
    });

    $(document).ready(function () {
        var dateNow = new Date();
        var lastUpdate =
            ("00" + (dateNow.getMonth() + 1)).slice(-2) + "/" +
            ("00" + dateNow.getDate()).slice(-2) + "/" +
            dateNow.getFullYear() + " " +
            ("00" + dateNow.getHours()).slice(-2) + ":" +
            ("00" + dateNow.getMinutes()).slice(-2) + ":" +
            ("00" + dateNow.getSeconds()).slice(-2);

        // $('#reportAkhir').prop('disabled', true);
        $('#dt_penyewaan').DataTable().clear();
        $('#dt_penyewaan').DataTable().destroy();
        // $('#reservAdd').prop('disabled', true);



        $("#dt_penyewaan").DataTable({
            "scrollX": true,
            "columnDefs": [{
                "targets": [0],
                "sortable": false
            }],
            "ajax": {
                "url": "{{ url('') }}/reservasi/get/" + 1,
                "dataSrc": "",
                // "success": function(data) {
                //     $("#reservAdd").show();
                // }
            },
            "columns": [{
                "data": "kode_reservasi"
            }, {
                "data": "nama",
            },
            {
                "data": "asset",
            },
            {
                "data": "status",
            },
            {
                "data": "lunas",
                "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                    var html = "";
                    var id = row['kode_reservasi'];

                    if (data == 1) {
                        html = `<a href="#" class="btn btn-success" onclick="pelunasan('${id}',${data})" data-bs-toggle="modal"
                                    data-bs-target="#cicilan">Lunas</a>`;
                    } else {
                        html = `<a href="#" class="btn btn-secondary" onclick="pelunasan('${id}',${data})" data-bs-toggle="modal"
                                    data-bs-target="#cicilan">Belum Lunas</a>`;
                    }
                    return html;
                }
            },
            {
                "data": "check_in",
                "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                    var html = formatDate1(data);
                    return html;
                }
            },
            {
                "data": "check_out",
                "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                    var html = formatDate1(data);
                    return html;
                }
            },
            {
                "data": "kode_reservasi",
                "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                    var html = `<button class="btn btn-primary" onclick="editReservasi('${data}')"><i class="fas fa-edit"></i>
                                            Edit</button>
                                        <button class="btn btn-danger" onclick="deleteReservasi('${data}')"><i class="fas fa-trash-alt"></i>
                                            Del</a>`;
                    //
                    $("#reservAdd").show();
                    return html;
                }
            },
            ],
            dom: 'Bfrtip',
            buttons: [{
                extend: 'pdf',
                text: 'Save PDF',
                messageTop: `Last Update ${lastUpdate}`,
                title: 'List Reservasi',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            }]

        })

        $("#reservAdd").show();

        const today = new Date()
        const tomorrow = new Date(today)
        tomorrow.setDate(tomorrow.getDate() + 1)
    });

    function reserv() {
        $('#dt_penyewaan').DataTable().ajax.reload();
    }
</script>

{{-- Load List Penyewa --}}
<script>
    function listPenyewa() {
        $('#dt_penyewa').DataTable().clear();
        $('#dt_penyewa').DataTable().destroy();
        $("#dt_penyewa").DataTable({
            "scrollX": true,
            "columnDefs": [{
                "targets": [0],
                "sortable": false
            }],
            "ajax": {
                "url": "{{ url('') }}/penyewa/get/" + 1,
                "dataSrc": "",
            },
            "columns": [{
                "data": "nama"
            },
            {
                "data": "alamat",
            },
            {
                "data": "email",
            },
            {
                "data": "kontak",
            },
            {
                "data": "id",
                "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                    var html = `<button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addPenyewa" onclick="editPenyewa(${data})"><i class="fas fa-edit"></i>
                                            Edit</button>
                                        <button class="btn btn-danger" onclick="deletePenyewa(${data})"><i class="fas fa-trash-alt"></i>
                                            Del</a>`;
                    //
                    return html;
                }
            },
            ],

        });
    }
</script>

{{-- Load List Via --}}
<script>
    function listVia() {
        $('#dt_via').DataTable().clear();
        $('#dt_via').DataTable().destroy();
        $("#dt_via").DataTable({
            "scrollX": true,
            "columnDefs": [{
                "targets": [0],
                "sortable": false
            }],
            "ajax": {
                "url": "{{ url('') }}/via/getAll/" + 1,
                "dataSrc": "",
            },
            "columns": [{
                "data": "keterangan"
            },
            {
                "data": "id",
                "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                    var html = `<button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addVia" onclick="editVia(${data})"><i class="fas fa-edit"></i>
                                            Edit</button>
                                        <button class="btn btn-danger" onclick="deleteVia(${data})"><i class="fas fa-trash-alt"></i>
                                            Del</a>`;
                    //
                    return html;
                }
            },
            ],

        })
    }
</script>

{{-- Input Reservasi --}}
<script>
    function penyewaanAdd() {
        var kodeR = 0;
        $('#headReservasi').html('Input Reservasi');
        var today = new Date();
        today = today.toISOString().substring(0, 10);

        $('#checkIn').val(today);
        var tomorrow = new Date();

        tomorrow.setDate(new Date().getDate() + 1);
        // console.log(tomorrow);
        var nextDay = tomorrow.toISOString().substring(0, 10);
        var maxDay = new Date(nextDay);
        maxDay.setDate(new Date().getDate() + 30);
        var maxBook = maxDay.toISOString().substring(0, 10);
        $('#checkOut').val(nextDay);
        // var min = $('#checkOut').val();
        $('#checkOut').prop('min', nextDay);
        $('#checkOut').prop('max', maxBook);
        var checkOut = $('#checkOut').val();
        var checkIn = $('#checkIn').val();

        formReserv(checkIn, checkOut, 0, 0, 0, 'input', kodeR);

        $('#FRM_RESERVASI_ASSET').on('submit', function (e) {
            e.preventDefault();
            $("#FRM_RESERVASI_ASSET").unbind().click(function () { });
            let villa = $('#assetsB').val();
            let checkIn = $('#checkIn').val();
            let viaP = $('#viaPay').val();
            let viaU = $('#viaAdd').val();
            var checkOut = $('#checkOut').val();
            let harga = $('#totalHarga').val();
            let penyewa = $('#penyewa').val();
            var formattedDate = moment(checkIn).format('YYMMDD');
            let kode = `R-${villa}${formattedDate}`;
            let status = $('#statusBayar').val();
            let first_pay = $('#bayar').val();
            let diskon = $('#diskon').val();
            let tgl = $('#tglBayar').val();
            let lunas = 0;
            if (status == "Lunas") {
                lunas = 1;
            } else if (status == "Belum") {
                lunas = 2;
            }

            harga = convertToAngka(harga);
            first_pay = convertToAngka(first_pay);
            diskon = convertToAngka(diskon);
            // console.log(kode);

            $.ajax({
                url: "{{ url('') }}/reservasi/in",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    villa: villa,
                    checkIn: checkIn,
                    checkOut: checkOut,
                    harga: harga,
                    penyewa: penyewa,
                    kode: kode,
                    status: status,
                    first_pay: first_pay,
                    lunas: lunas,
                    diskon: diskon,
                    tgl: tgl,
                    viaPay: viaP,
                    via: viaU
                },
                success: function (res) {

                    $("#FRM_RESERVASI_ASSET").unbind().click(function () { });

                    if (res == 1) {
                        $('#penyewaan').hide();
                        $('#dt_penyewaan').DataTable().ajax.reload();
                        $('#reservasiForm').hide();
                        $('#reservasiMenu').show();
                        $("#FRM_RESERVASI_ASSET")[0].reset();
                        swal({
                            icon: "success",
                            text: "Data Reservasi Berhasil Disimpan"
                        });
                    }

                }
            });
        });
    }

    function countDay(checkIn, checkOut) {
        const oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
        const firstDate = new Date(checkIn);
        const secondDate = new Date(checkOut);

        const malam = Math.round(Math.abs((firstDate - secondDate) / oneDay));
        $('#durasi').val(malam);
    }

    function getHarga() {
        var Villa = $('#assetsB').val();
        var checkOut = $('#checkOut').val();
        var checkIn = $('#checkIn').val();
        if (Villa) {
            $('#cekStatus').show();
            $.ajax({
                url: "{{ url('') }}/harga/get/" + Villa,
                type: "GET",
                data: {
                    checkIn: checkIn,
                    checkOut: checkOut,
                },
                success: function (res) {

                    $('#detailAll').show();
                    var listHarga = countHarga(res);

                    var hargaDetail = document.getElementById("hargaDetail");
                    var detail = '';
                    var div = document.createElement("div");
                    var totalVilla = 0;
                    for (var i = 0; i < listHarga.length; i++) {
                        let harga = parseInt(listHarga[i][2]);
                        // harga = formatRupiah(harga, 'Rp.');
                        var season = listHarga[i][0];
                        var malam = listHarga[i][1];
                        var total = harga * malam;
                        totalVilla += total;
                        harga = formatRupiah(harga.toString(), 'Rp.');
                        detail += `<div class="form-group row">
                                        <strong class="col-4">${season} (${malam} Malam)</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-6">${harga} X ${malam}</strong>
                                    </div>`;
                    }
                    hargaDetail.innerHTML = detail;
                    // hargaDetail.appendChild(div);
                    var diskon = $('#diskon').val();
                    var malam = $('#durasi').val();
                    var cekDiskon;
                    var diskonD = '';

                    if (diskon) {
                        diskon = convertToAngka(diskon);
                        var x = $("input[name='cekDiskon']:checked").val();
                        if (x == 0) {
                            diskon = diskon * 1;
                            cekMalam = '';
                            cekDiskon = "/Pesanan";
                        } else {
                            cekMalam = ' X ' + malam;
                            diskon = diskon * malam;
                            cekDiskon = "/Malam";
                        }
                    } else {
                        diskon = 0;
                    }

                    var diskonDetail = document.getElementById("diskonDetail");
                    var divDiskon = document.createElement("div");
                    var diskonD = $('#diskon').val();
                    diskonD = formatRupiah(diskonD.toString(), 'Rp.');

                    diskonDetail.innerHTML = `<div class="form-group row">
                                                    <strong class="col-4">Diskon (${cekDiskon})</strong>
                                                    <strong class="col-2">:</strong>
                                                    <strong class="col-6">${diskonD}${cekMalam}</strong>
                                                </div>`;

                    var total = (totalVilla - diskon);
                    totalVilla = formatRupiah(totalVilla.toString(), 'Rp.');
                    diskon = formatRupiah(diskon.toString(), 'Rp.');
                    total = formatRupiah(total.toString(), 'Rp.');
                    // total = formatRupiah(harga);
                    $('#totalHarga').val(total);

                    document.getElementById('totalVilla').innerText = totalVilla;
                    document.getElementById('totalDiskon').innerText = diskon;
                    document.getElementById('total').innerText = total;
                }
            });
        }

    }

    function countHarga(list) {
        var listHarga = [];

        while (list.length > 0) {
            var seasson = list[0].Seasson;
            var harga = list[0].Harga;
            var countDay = 0;
            var day = 0;
            var cutPoin = [];
            var detail = [];

            for (let i = 0; i < list.length; i++) {
                if (seasson == list[i].Seasson) {
                    day += 1;
                }
            }

            list = removeItemAll(list, seasson);
            listHarga.push(detail);
            detail.push(seasson, day, harga);
        }
        return listHarga;
    }

    function removeItemAll(arr, value) {
        var i = 0;
        while (i < arr.length) {
            if (arr[i].Seasson === value) {
                arr.splice(i, 1);
            } else {
                ++i;
            }
        }
        return arr;
    }

    function cekVilla(villa, checkIn, checkOut) {
        var id = villa;

        if (id != '' && id != null) {
            $.ajax({
                url: "{{ url('') }}/cekVilla/" + id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    checkIn: checkIn,
                    checkOut: checkOut,
                },

                success: function (res) {
                    console.log(res);

                    if (res == 1) {
                        $('#NOT_AVAILABLE_BUTTON').show();
                        $('#AVAILABLE_VILLA_BUTTON').hide();
                    } else if (res == 0) {
                        $('#NOT_AVAILABLE_BUTTON').hide();
                        $('#AVAILABLE_VILLA_BUTTON').show();
                    }
                }
            })
        }
    }

    function cekVilla1(villa, checkIn, checkOut, kodeR) {
        var id = villa;
        if (id != '' && id != null) {
            $.ajax({
                url: "{{ url('') }}/cekVillaEdit/" + id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    checkIn: checkIn,
                    checkOut: checkOut,
                    kodeR: kodeR
                },

                success: function (res) {
                    if (res == 1) {
                        $('#NOT_AVAILABLE_BUTTON').show();
                        $('#AVAILABLE_VILLA_BUTTON').hide();
                    } else if (res == 0) {
                        $('#NOT_AVAILABLE_BUTTON').hide();
                        $('#AVAILABLE_VILLA_BUTTON').show();
                    }
                }
            })
        }
    }
</script>

{{-- Form Reservasi --}}
<script>
    function formReserv(cekIn, cekOut, villa, penyewa, via, flag, kodeR, viaP) {

        $('#reservasiForm').show();
        $('#detailAll').hide();
        $('#reservasiMenu').hide();
        $('#NOT_AVAILABLE_BUTTON').hide();
        $('#cekStatus').hide();

        $('#statusBayar').select2({});
        $('#assetsB').select2({});
        $('#subAsset').select2({});
        $('#season').select2({});
        $('#penyewa').select2({});
        $('#viaAdd').select2({});
        $('#viaPay').select2({});

        // Count Day
        countDay(cekIn, cekOut);

        // Check In Change Js With Function
        var date_input = document.getElementById('checkIn');
        date_input.onchange = function () {
            var tomorrow = new Date(this.value);
            tomorrow.setDate(new Date(this.value).getDate() + 1);

            var nextDay = tomorrow.toISOString().substring(0, 10);
            var maxDay = new Date(nextDay);
            maxDay.setDate(maxDay.getDate() + 30);
            var maxBook = maxDay.toISOString().substring(0, 10);

            $('#checkOut').val(nextDay);
            $('#checkOut').prop('min', nextDay);
            $('#checkOut').prop('max', maxBook);
            var checkOut = $('#checkOut').val();
            var checkIn = $('#checkIn').val();
            var villa = $('#assetsB').val();

            if (flag == 'input') {
                cekVilla(villa, checkIn, checkOut);
            } else if (flag == 'edit') {
                cekVilla1(villa, checkIn, checkOut, kodeR);
            }

            countDay(this.value, nextDay);
            getHarga();

        };

        // Check Out Change Js
        $('#checkOut').on('change', function () {
            var checkOut = $('#checkOut').val();
            var checkIn = $('#checkIn').val();
            var villa = $('#assetsB').val();


            countDay(checkIn, checkOut);

            if (flag == 'input') {
                cekVilla(villa, checkIn, checkOut);
            } else if (flag == 'edit') {
                cekVilla1(villa, checkIn, checkOut, kodeR);
            }

            getHarga();

        });

        // Diskon Change
        $('input[type=radio][name=cekDiskon]').change(function () {
            getHarga();
        });

        // Formating Rupiah Diskon
        var rupiahDiskon = document.getElementById('diskon');
        rupiahDiskon.addEventListener('keyup', function (e) {
            rupiahDiskon.value = formatRupiah(this.value);
            getHarga();
        });

        // Formating Rupiah DP
        var rupiahDp = document.getElementById('bayar');
        rupiahDp.addEventListener('keyup', function (e) {
            rupiahDp.value = formatRupiah(this.value, 'Rp.');
            getHarga();
        });

        // Penyewa Dropdown
        $.ajax({
            url: "{{ url('') }}/penyewa/get/" + 1,
            success: function (res) {
                $("#penyewa").children().remove();
                $("#penyewa").append('<option selected value="">Pilih Nama Penyewa</option>');
                $.each(res, function (index, data) {
                    $('#penyewa').append(
                        '<option value="' + data.id + '">' + data
                            .nama + '</option>'
                    )
                })
                if (penyewa != 0) {
                    $('#penyewa').val(penyewa).change();
                }

            }
        });

        // Assets Dropdown
        $.ajax({
            url: "{{ url('') }}/getAssets/" + 1,
            success: function (res) {
                $("#assetsB").children().remove();
                $("#assetsB").append('<option selected value="">Pilih Villa</option>');
                $.each(res, function (index, data) {
                    $('#assetsB').append(
                        '<option value="' + data.id_assets + '">' + data
                            .nama_assets + '</option>'
                    )
                })
                if (villa != 0) {
                    $("#assetsB").val(villa).change();
                }

            }
        });

        // Asset Change JS
        $('#assetsB').on('change', function () {
            var id = $(this).val();
            var checkOut = $('#checkOut').val();
            var checkIn = $('#checkIn').val();

            if (flag == 'input') {
                cekVilla(villa, checkIn, checkOut);
            } else if (flag == 'edit') {
                cekVilla1(villa, checkIn, checkOut, kodeR);
            }

            getHarga();
        });

        // Via Dropdown
        $.ajax({
            url: "{{ url('') }}/via/getAll/" + 1,
            success: function (res) {
                $("#viaAdd").children().remove();
                $("#viaAdd").append('<option selected value="">Pilih Via</option>');
                $.each(res, function (index, data) {
                    $('#viaAdd').append(
                        '<option value="' + data.id + '">' + data
                            .keterangan + '</option>'
                    )
                })
                if (via != 0) {
                    $("#viaAdd").val(via).change();
                }
            }
        });

        // Via Payment Dropdown
        $.ajax({
            url: "{{ url('') }}/viaP/getAll/" + 1,
            success: function (res) {
                $("#viaPay").children().remove();
                $("#viaPay").append('<option selected value="">Pilih Payment</option>');
                $.each(res, function (index, data) {
                    $('#viaPay').append(
                        '<option value="' + data.id + '">' + data
                            .keterangan + '</option>'
                    )
                })
                if (viaP != 0) {
                    $("#viaPay").val(viaP).change();
                }
            }
        });

        // Status Bayar Change JS
        $('#statusBayar').on('change', function () {
            var id = $(this).val();
            var total = $('#total').html();

            if (id != '' && id != null) {
                if (id == "Lunas") {
                    $('#bayar').prop("disabled", true);
                    $("input").prop('required', false);
                    $('#bayar').val(total);
                } else {
                    $('#bayar').prop("disabled", false);
                    $("input").prop('required', true);
                    $('#bayar').val(0);
                }
            } else {
                $('#bayar').prop("disabled", true);
                $('#bayar').val(0);
            }
            getHarga();
        });
    }
</script>

{{-- Input Penyewa --}}
<script>
    function userAdd() {
        $('#headPenyewa').html('Input Penyewa');
        $('#FRM_PENYEWA_ASSET').on('submit', function (e) {
            e.preventDefault();
            $("#FRM_PENYEWA_ASSET").unbind().click(function () { });
            let nama = $('#namaPemesan').val();
            let alamat = $('#alamatPemesan').val();
            let email = $('#emailPemesan').val();
            let kontak = $('#nomorPemesan').val();
            let username = $('#username').val();
            let password = $('#password').val();

            $.ajax({
                url: "{{ url('') }}/penyewa/in",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    nama: nama,
                    alamat: alamat,
                    email: email,
                    kontak: kontak,
                    username: username,
                    password: password,
                },
                success: function (res) {

                    $('#addPenyewa').modal('hide');
                    $('#dt_penyewa').DataTable().ajax.reload();
                    $("#FRM_PENYEWA_ASSET")[0].reset();
                    $("#FRM_PENYEWA_ASSET").unbind().click(function () { });
                    swal({
                        icon: "success",
                        text: res['success']
                    });
                }
            });
        });
    }
</script>

{{-- Input Via --}}
<script>
    function addVia() {
        $('#FRM_VIA_VILLA').on('submit', function (e) {
            e.preventDefault();
            $("#FRM_VIA_VILLA").unbind().click(function () { });
            let Keterangan = $('#viaKet').val();

            $.ajax({
                url: "{{ url('') }}/via/in",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    Keterangan: Keterangan,
                },
                success: function (res) {

                    $('#addVia').modal('hide');
                    $('#dt_via').DataTable().ajax.reload();
                    $("#FRM_VIA_VILLA")[0].reset();
                    $("#FRM_VIA_VILLA").unbind().click(function () { });
                    swal({
                        icon: "success",
                        text: res['success']
                    });
                }
            });
        });
    }
</script>

{{-- Close Input Reservasi --}}
<script>
    function closeReservasi() {
        $('#reservasiForm').hide();
        $('#reservasiMenu').show();
        $("#FRM_RESERVASI_ASSET")[0].reset();
        $('NOT_AVAILABLE_BUTTON').hide();
        $('AVAILABLE_VILLA_BUTTON').show();
        $('#cekStatus').hide();
        $("#FRM_RESERVASI_ASSET").unbind().click(function () { });
        $("#FRM_LUNAS_VILLA").unbind().click(function () { });
    }
</script>

{{-- ----------------------------------------------- Edit -------------------------------------- --}}
{{-- Edit Reservasi --}}
<script>
    function editReservasi(kode) {
        var kodeR = kode;
        $('#headReservasi').html('Edit Reservasi');
        $.ajax({
            url: "{{ url('') }}/reservasi/getById/" + kodeR,
            type: "Get",
            success: function (res) {
                console.log(res);
                villa = res[0].id_villa;
                cekIn = res[0].check_in;
                cekOut = res[0].check_out;
                let penyewa = res[0].id_penyewa;
                let via = res[0].via;
                let viaP = res[0].via_pay;
                let tgl = res[0].tgl_bayar;

                $('#checkIn').val(cekIn);
                $('#checkOut').val(cekOut);
                $('#totalHarga').val(res[0].tagihan);
                $('#viaAdd').val(via);

                $('#tglBayar').val(tgl);
                let status = res[0].status;
                $('#statusBayar').val(status);
                let first_pay = res[0].first_pay;
                $('#bayar').val(first_pay);
                let diskon = res[0].diskon;
                $('#diskon').val(diskon);
                $('#viaPay').val(viaP);

                formReserv(cekIn, cekOut, villa, penyewa, via, 'edit', kodeR, viaP);

            }
        });

        $('#FRM_RESERVASI_ASSET').on('submit', function (e) {
            e.preventDefault();
            $("#FRM_RESERVASI_ASSET").unbind().click(function () { });
            let villa = $('#assetsB').val();
            let checkIn = $('#checkIn').val();
            var checkOut = $('#checkOut').val();
            let harga = $('#totalHarga').val();
            let penyewa = $('#penyewa').val();
            let viaP = $('#viaPay').val();
            let viaU = $('#viaAdd').val();
            // var formattedDate = moment(checkIn).format('YYMMDD');
            // let kode = `R-${villa}${formattedDate}`;
            let status = $('#statusBayar').val();
            let first_pay = $('#bayar').val();
            let diskon = $('#diskon').val();

            let lunas = 0;
            if (status == "Lunas") {
                lunas = 1;
            }

            harga = convertToAngka(harga);
            first_pay = convertToAngka(first_pay);
            diskon = convertToAngka(diskon);
            let tgl = $('#tglBayar').val();

            // console.log(kode);

            $.ajax({
                url: "{{ url('') }}/reservasi/edit",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    villa: villa,
                    checkIn: checkIn,
                    checkOut: checkOut,
                    harga: harga,
                    penyewa: penyewa,
                    kode: kodeR,
                    status: status,
                    first_pay: first_pay,
                    lunas: lunas,
                    diskon: diskon,
                    tgl: tgl,
                    viaPay: viaP,
                    via: viaU
                },
                success: function (res) {

                    $("#FRM_RESERVASI_ASSET").unbind().click(function () { });

                    if (res == 1) {
                        $('#penyewaan').hide();
                        $('#dt_penyewaan').DataTable().ajax.reload();
                        $('#reservasiForm').hide();
                        $('#reservasiMenu').show();
                        $("#FRM_RESERVASI_ASSET")[0].reset();
                        swal({
                            icon: "success",
                            text: "Data Reservasi Berhasil Diubah"
                        });
                    }

                }
            });
        });
    }
</script>

{{-- Edit Via --}}
<script>
    function editVia(id) {
        $.ajax({
            url: "{{ url('') }}/via/getId/" + id,
            type: "GET",
            success: function (res) {
                $('#viaKet').val(res[0].keterangan);
                $('#headViaAgen').html('Edit Via Agen');
            }
        });

        $('#FRM_VIA_VILLA').on('submit', function (e) {
            e.preventDefault();
            $("#FRM_VIA_VILLA").unbind().click(function () { });
            let ket = $('#viaKet').val();

            $.ajax({
                url: "{{ url('') }}/penyewa/edit",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    ket: ket,
                },
                success: function (res) {

                    $('#addPenyewa').modal('hide');
                    $('#dt_via').DataTable().ajax.reload();
                    $("#FRM_VIA_VILLA")[0].reset();
                    $("#FRM_VIA_VILLA").unbind().click(function () { });
                    swal({
                        icon: "success",
                        text: res['success']
                    });
                }
            });
        });
    }
</script>

{{-- Edit Penyewa --}}
<script>
    function editPenyewa(id) {
        $('#headPenyewa').html('Edit Penyewa');
        $.ajax({
            url: "{{ url('') }}/penyewa/getId/" + id,
            type: "GET",
            success: function (res) {

                $('#namaPemesan').val(res[0].nama);
                $('#alamatPemesan').val(res[0].alamat);
                $('#emailPemesan').val(res[0].email);
                $('#nomorPemesan').val(res[0].kontak);
                $('#username').val(res[0].username);
                $('#password').val(res[0].password);
            }
        });

        $('#FRM_PENYEWA_ASSET').on('submit', function (e) {
            e.preventDefault();
            $("#FRM_PENYEWA_ASSET").unbind().click(function () { });
            let nama = $('#namaPemesan').val();
            let alamat = $('#alamatPemesan').val();
            let email = $('#emailPemesan').val();
            let kontak = $('#nomorPemesan').val();
            let username = $('#username').val();
            let password = $('#password').val();

            $.ajax({
                url: "{{ url('') }}/penyewa/edit",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    nama: nama,
                    alamat: alamat,
                    email: email,
                    kontak: kontak,
                    username: username,
                    password: password,
                },
                success: function (res) {

                    $('#addPenyewa').modal('hide');
                    $('#dt_penyewa').DataTable().ajax.reload();
                    $("#FRM_PENYEWA_ASSET")[0].reset();
                    $("#FRM_PENYEWA_ASSET").unbind().click(function () { });
                    swal({
                        icon: "success",
                        text: res['success']
                    });
                }
            });
        });

    }
</script>

{{-- ---------------------------------------------- Delete ------------------------------------- --}}

{{-- Delete Penyewa --}}
<script>
    function deletePenyewa(id) {
        swal({
            title: "Kamu Yakin?",
            text: "Sekali Delete Anda Tidak Bisa Mengembalikannya!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ url('') }}/penyewa/del/" + id,
                        success: function () {
                            $('#dt_penyewa').DataTable().ajax.reload();
                            swal("Berhasil Dihapus!", {
                                icon: "success",
                            });
                        }
                    });
                } else {
                    swal("Your file is safe!");
                }
            });
    }
</script>

{{-- Delete Reservasi --}}
<script>
    function deleteReservasi(id) {
        swal({
            title: "Kamu Yakin?",
            text: "Sekali Delete Anda Tidak Bisa Mengembalikannya!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ url('') }}/reservasi/del/" + id,
                        success: function () {
                            $('#dt_penyewaan').DataTable().ajax.reload();
                            swal("Berhasil Dihapus!", {
                                icon: "success",
                            });
                        }
                    });
                } else {
                    swal("Your file is safe!");
                }
            });
    }
</script>

{{-- Delete Via --}}
<script>
    function deleteVia(id) {
        swal({
            title: "Kamu Yakin?",
            text: "Sekali Delete Anda Tidak Bisa Mengembalikannya!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ url('') }}/via/del/" + id,
                        success: function () {
                            $('#dt_via').DataTable().ajax.reload();
                            swal("Berhasil Dihapus!", {
                                icon: "success",
                            });
                        }
                    });
                } else {
                    swal("Your file is safe!");
                }
            });
    }
</script>

{{-- ---------------------------------------------- Report ------------------------------------- --}}
{{-- Report Pemesanan --}}
<script>
    function getReport() {
        $('#tableShow').show();
        $('#reportAwal').on('change', function () {
            var day = $(this).val();
            var nextDay = new Date(day);
            var x = nextDay.toISOString().substring(0, 10);
            $('#reportAkhir').prop('disabled', false);
            $('#reportAkhir').prop('min', x);
        });

        $('#FRM_REPORT_RESERVASI').on('submit', function (e) {
            e.preventDefault();
            // $('#dt_report').DataTable().clear();
            // $('#dt_report').DataTable().destroy();

            $("#FRM_REPORT_RESERVASI").unbind().click(function () { });
            var tglAwal = $('#reportAwal').val();
            var tglAkhir = $('#reportAkhir').val();
            // var days = getDates(tglAwal, tglAkhir);
            $.ajax({
                url: "{{ url('') }}/getAssets/" + 1,
                // asyn: false,
                success: function (res) {
                    $("#dt_report").children().remove();

                    var thead = `<thead>`;
                    thead += `<tr>`;
                    thead += `<th>Hari</th>`;
                    thead += `<th>Tanggal</th>`;
                    $.each(res, function (index, res) {
                        thead += `<th>${res.nama_assets}</th>`;
                    })
                    thead += `</tr>`;
                    thead += `</thead>`;
                    $('#dt_report').append(thead);

                    $('#dt_report').show();
                    $.ajax({
                        url: "{{ url('') }}/reservasi/getData",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            Awal: tglAwal,
                            Akhir: tglAkhir,
                        },
                        success: function (data) {
                            console.log(data);
                            var tbody = `<tbody>`;
                            const d1 = new Date(tglAwal);
                            const d2 = new Date(tglAkhir);
                            var days = getDatesInRange(d1, d2);
                            for (i = 0; i < days.length; i++) {
                                tbody += `<tr>`;
                                let tanggal = new Date(days[i]);
                                let hari = tanggal.toLocaleString('in-ID', {
                                    weekday: 'long'
                                });
                                tbody += `<td>${hari}</td>`;
                                tbody += `<td>${formatDate2(days[i])}</td>`;
                                $.each(res, function (index, res) {
                                    var nama = 0;
                                    var status = 0;
                                    var cek = 0;
                                    var badge = "";
                                    $.each(data, function (index, data) {
                                        // console.log(data);
                                        if (data.asset == res
                                            .nama_assets) {

                                            var dateCheck =
                                                days[i];
                                            var dateFrom =
                                                data.check_in;
                                            var dateTo =
                                                data.check_out;

                                            var d1 = dateFrom
                                                .split("-");
                                            var d2 = dateTo
                                                .split("-");
                                            var c = dateCheck
                                                .split("-");

                                            var from = new Date(
                                                d1[0],
                                                parseInt(d1[
                                                    1]) - 1,
                                                d1[2]
                                            ); // -1 because months are from 0 to 11
                                            var to = new Date(
                                                d2[0],
                                                parseInt(d2[
                                                    1]) - 1,
                                                d2[2]);
                                            var check =
                                                new Date(c[0],
                                                    parseInt(c[
                                                        1]) - 1,
                                                    c[2]);

                                            if (check >= from &&
                                                check < to) {
                                                nama = data
                                                    .nama;
                                                cek = 1;

                                                status = "Lns";
                                                badge = "success";

                                                if (data
                                                    .status ==
                                                    "Lunas") {
                                                    status =
                                                        "Lns";
                                                    badge =
                                                        "success";
                                                } else if (data
                                                    .status == "Dp") {
                                                    if (data.lunas ==
                                                        0) {
                                                        status =
                                                            "Dp";
                                                        badge =
                                                            "warning";
                                                    }
                                                } else if (data
                                                    .status == "Belum"
                                                ) {
                                                    status =
                                                        "BB";
                                                    badge =
                                                        "danger";
                                                    if (data.lunas ==
                                                        0) {
                                                        status =
                                                            "Dp";
                                                        badge =
                                                            "warning";
                                                    } else if (data
                                                        .lunas ==
                                                        1) {
                                                        status =
                                                            "Lns";
                                                        badge =
                                                            "success";
                                                    }

                                                }

                                            }
                                        }
                                    })
                                    if (cek == 1) {
                                        tbody += `<td>`;
                                        tbody += `<div>
                                                        <div class="col-12"">
                                                                <a> ${nama} </a>
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="badge badge-${badge}">${status}</span>  
                                                        </div>
                                                    </div>`;
                                        tbody += `</td>`;
                                    } else {
                                        tbody += `<td>-</td>`;
                                    }
                                })
                                tbody += `</tr>`;
                            }
                            tbody += `</tbody>`;
                            $('#dt_report').append(tbody);

                            if ($.fn.DataTable.isDataTable('#dt_report')) {

                                $('#dt_report').DataTable().clear();
                                $('#dt_report').DataTable().destroy();
                            }
                            $('#dt_report').DataTable({
                                "scrollX": true,
                                "ordering": false,
                                "pageLength": 50
                            });
                            $('#btnSaveReport').show();
                        }
                    });
                }
            });
        });


    }

    function getDatesInRange(startDate, endDate) {
        const date = new Date(startDate.getTime());
        const dates = [];
        while (date <= endDate) {
            var tes = new Date(date);
            dates.push(formatDate(tes));
            date.setDate(date.getDate() + 1);
        }
        return dates;
    }

    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [year, month, day].join('-');
    }

    function formatDate1(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();
        var x = year.toString().substring(2);

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [month, day, x].join('/');
    }

    function formatDate2(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();
        var x = year.toString().substring(2);

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [day, month, x].join('/');
    }
</script>

{{-- Report Pembayaran --}}
<script>
    function getReportBayar() {
        $('#tableShow1').show();
        $('#reportAwal1').on('change', function () {
            var day = $(this).val();
            var nextDay = new Date(day);
            var x = nextDay.toISOString().substring(0, 10);
            $('#reportAkhir1').prop('disabled', false);
            $('#reportAkhir1').prop('min', x);
        });

        $('#FRM_REPORT_SALES').on('submit', function (e) {
            e.preventDefault();
            // $('#dt_report').DataTable().clear();
            // $('#dt_report').DataTable().destroy();

            $("#FRM_REPORT_SALES").unbind().click(function () { });
            var tglAwal = $('#reportAwal1').val();
            var tglAkhir = $('#reportAkhir1').val();
            // var days = getDates(tglAwal, tglAkhir);
            $.ajax({
                url: "{{ url('') }}/getAssets/" + 1,
                // asyn: false,
                success: function (res) {
                    $("#dt_report1").children().remove();

                    var thead = `<thead>`;
                    thead += `<tr>`;
                    thead += `<th>Hari</th>`;
                    thead += `<th>Tanggal</th>`;
                    $.each(res, function (index, res) {
                        thead += `<th>${res.nama_assets}</th>`;
                    })
                    thead += `</tr>`;
                    thead += `</thead>`;
                    $('#dt_report1').append(thead);

                    $('#dt_report1').show();
                    $.ajax({
                        url: "{{ url('') }}/reservasi/getData",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            Awal: tglAwal,
                            Akhir: tglAkhir,
                        },
                        success: function (data) {
                            // console.log(data);
                            var tbody = `<tbody>`;
                            const d1 = new Date(tglAwal);
                            const d2 = new Date(tglAkhir);
                            var days = getDatesInRange(d1, d2);

                            for (i = 0; i < days.length; i++) {
                                tbody += `<tr>`;
                                let tanggal = new Date(days[i]);
                                let hari = tanggal.toLocaleString('in-ID', {
                                    weekday: 'long'
                                });
                                tbody += `<td>${hari}</td>`;
                                tbody += `<td>${formatDate2(days[i])}</td>`;
                                $.each(res, function (index, res) {
                                    var nama = 0;
                                    var status = 0;
                                    var cek = 0;
                                    var badge = "";
                                    var tagihan = 0;
                                    var sisa = 0;
                                    var bayar = 0;
                                    $.each(data, function (index, data) {
                                        // console.log(data);
                                        if (data.asset == res
                                            .nama_assets) {


                                            var dateCheck =
                                                days[i];
                                            var dateFrom =
                                                data.check_in;
                                            var dateTo =
                                                data.check_out;

                                            var d1 = dateFrom
                                                .split("-");
                                            var d2 = dateTo
                                                .split("-");
                                            var c = dateCheck
                                                .split("-");

                                            var from = new Date(
                                                d1[0],
                                                parseInt(d1[
                                                    1]) - 1,
                                                d1[2]
                                            ); // -1 because months are from 0 to 11
                                            var to = new Date(
                                                d2[0],
                                                parseInt(d2[
                                                    1]) - 1,
                                                d2[2]);
                                            var check =
                                                new Date(c[0],
                                                    parseInt(c[
                                                        1]) - 1,
                                                    c[2]);

                                            if (check >= from &&
                                                check < to) {

                                                $.ajax({
                                                    url: "{{ url('') }}/reservasi/getCicil",
                                                    async: false,
                                                    type: "POST",
                                                    data: {
                                                        "_token": "{{ csrf_token() }}",
                                                        kodes: data
                                                            .kode_reservasi,
                                                    },
                                                    success: function (
                                                        hasil
                                                    ) {                                                        
                                                        var cicil = 0;
                                                        if (hasil) {
                                                            cicil = parseInt(hasil);
                                                        }
                                                        bayar
                                                            = cicil +
                                                            parseInt(
                                                                data
                                                                    .first_pay
                                                            );
                                                        sisa =
                                                            parseInt(
                                                                data
                                                                    .tagihan
                                                            ) -
                                                            (bayar);
                                                        // console
                                                        //     .log(
                                                        //         sisa
                                                        //     );

                                                    }
                                                });
                                                nama = data
                                                    .nama;
                                                cek = 1;
                                                tagihan = data.tagihan;

                                                status = "Lns";
                                                badge = "success";

                                                if (data
                                                    .status ==
                                                    "Lunas") {
                                                    status =
                                                        "Lns";
                                                    badge =
                                                        "success";
                                                } else if (data
                                                    .status == "Dp") {
                                                    if (data.lunas ==
                                                        0) {
                                                        status =
                                                            "Dp";
                                                        badge =
                                                            "warning";
                                                    }
                                                } else if (data
                                                    .status == "Belum"
                                                ) {
                                                    status =
                                                        "BB";
                                                    badge =
                                                        "danger";
                                                    if (data.lunas ==
                                                        0) {
                                                        status =
                                                            "Dp";
                                                        badge =
                                                            "warning";
                                                    } else if (data
                                                        .lunas ==
                                                        1) {
                                                        status =
                                                            "Lns";
                                                        badge =
                                                            "success";
                                                    }

                                                }

                                            }
                                        }
                                    })
                                    if (cek == 1) {
                                        tagihan = tagihan.toString();
                                        bayar = bayar.toString();
                                        sisa = sisa.toString();
                                        tbody += `<td>`;
                                        tbody += `<div>
                                                    <div class="col-12"">
                                                            <a> ${nama} </a>
                                                    </div>
                                                    <div class="col-12">
                                                        <a> Tagihan : ${formatRupiah(tagihan)} </a>
                                                        <br>
                                                        <a> Jumlah Bayar : ${formatRupiah(bayar)} </a> 
                                                        <br>
                                                        <a> Sisa : ${formatRupiah(sisa)} </a>
                                                    </div>
                                                </div>`;
                                        tbody += `</td>`;
                                    } else {
                                        tbody += `<td>-</td>`;
                                    }
                                })
                                tbody += `</tr>`;
                            }
                            tbody += `</tbody>`;
                            $('#dt_report1').append(tbody);

                            if ($.fn.DataTable.isDataTable('#dt_report1')) {

                                $('#dt_report1').DataTable().clear();
                                $('#dt_report1').DataTable().destroy();
                            }
                            $('#dt_report1').DataTable({
                                "scrollX": true,
                                "ordering": false,
                                "pageLength": 50
                            });
                            $('#btnSaveReport1').show();
                        }
                    });
                }
            });
        });
    }
</script>

{{-- Save PDF --}}
<script>
    function savePdf() {
        var tglAwal = $('#reportAwal').val();
        tglAwal = formatDate2(tglAwal);
        var tglAkhir = $('#reportAkhir').val();
        tglAkhir = formatDate2(tglAkhir);

        // var elt = document.getElementById('dt_report');
        // var wb = XLSX.utils.table_to_book(elt, {
        //     sheet: "sheet1"
        // });
        // return XLSX.writeFile(wb, (`Report Reservasi ${tglAwal} - ${tglAkhir}.` + 'xlsx'));

        var date = new Date();
        var dateStr =
            ("00" + (date.getDate())).slice(-2) + "/" +
            ("00" + (date.getMonth() + 1)).slice(-2) + "/" +
            date.getFullYear() + " " +
            ("00" + date.getHours()).slice(-2) + ":" +
            ("00" + date.getMinutes()).slice(-2) + ":" +
            ("00" + date.getSeconds()).slice(-2);

        var doc = new jsPDF('l', 'pt', 'letter');
        var htmlstring = '';
        var tempVarToCheckPageHeight = 0;
        var pageHeight = 0;
        pageHeight = doc.internal.pageSize.height;
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector  
            '#bypassme': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"  
                return true
            }
        };
        margins = {
            top: 150,
            bottom: 40,
            left: 20,
            right: 20,
            width: 600
        };
        var y = 20;
        doc.setLineWidth(2);
        doc.text(220, y = y + 20, `Laporan Reservasi Villa Tanggal (${tglAwal}) s/d (${tglAkhir})`);
        doc.text(40, y = y + 35, `Last Update ${dateStr}`);
        doc.autoTable({
            html: '#dt_report',
            startY: 80,
            tableWidth: 'auto',
            theme: 'grid',
            showHead: 'everyPage',
            headStyles: {
                valign: 'middle',
                halign: 'center'
            },
            columnStyles: {
                0: {
                    cellWidth: 'auto',
                },
                1: {
                    cellWidth: 'auto',
                },
                2: {
                    cellWidth: 'auto',
                }
            },
            fontSize: number = 8,
            styles: {
                CellHeight: 'auto',
                // valign: 'center',
                halign: 'center',
            }
        })
        doc.save(`Report Reservasi (${tglAwal}) - (${tglAkhir}).pdf`);

    }
</script>

<script>
    function savePdfSales() {
        var tglAwal = $('#reportAwal1').val();
        tglAwal = formatDate2(tglAwal);
        var tglAkhir = $('#reportAkhir1').val();
        tglAkhir = formatDate2(tglAkhir);

        // var elt = document.getElementById('dt_report');
        // var wb = XLSX.utils.table_to_book(elt, {
        //     sheet: "sheet1"
        // });
        // return XLSX.writeFile(wb, (`Report Reservasi ${tglAwal} - ${tglAkhir}.` + 'xlsx'));

        var date = new Date();
        var dateStr =
            ("00" + (date.getDate())).slice(-2) + "/" +
            ("00" + (date.getMonth() + 1)).slice(-2) + "/" +
            date.getFullYear() + " " +
            ("00" + date.getHours()).slice(-2) + ":" +
            ("00" + date.getMinutes()).slice(-2) + ":" +
            ("00" + date.getSeconds()).slice(-2);

        var doc = new jsPDF('l', 'pt', 'letter');
        var htmlstring = '';
        var tempVarToCheckPageHeight = 0;
        var pageHeight = 0;
        pageHeight = doc.internal.pageSize.height;
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector  
            '#bypassme': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"  
                return true
            }
        };
        margins = {
            top: 150,
            bottom: 40,
            left: 20,
            right: 20,
            width: 600
        };
        var y = 20;
        doc.setLineWidth(2);
        doc.text(220, y = y + 20, `Laporan Sales Villa Tanggal (${tglAwal}) s/d (${tglAkhir})`);
        doc.text(40, y = y + 35, `Last Update ${dateStr}`);
        doc.autoTable({
            html: '#dt_report1',
            startY: 80,
            tableWidth: 'auto',
            theme: 'grid',
            showHead: 'everyPage',
            headStyles: {
                valign: 'middle',
                halign: 'center'
            },
            columnStyles: {
                0: {
                    cellWidth: 'auto',
                },
                1: {
                    cellWidth: 'auto',
                },
                2: {
                    cellWidth: 'auto',
                }
            },
            fontSize: number = 8,
            styles: {
                CellHeight: 'auto',
                // valign: 'center',
                halign: 'center',
            }
        })
        doc.save(`Report Sales Villa (${tglAwal}) - (${tglAkhir}).pdf`);

    }
</script>

{{-- ---------------------------------------------- Cicilan ------------------------------------- --}}
<script>
    var harga = 0;

    function pelunasan(id, status) {
        $('#kodeRes').val(id);
        $('#inputCicilan').show();
        $('#cicilStatus').select2();
        $("#FRM_LUNAS_VILLA")[0].reset();
        if (status == 1) {
            $('#inputCicilan').hide();
        } else if (status == 0) {
            $('#inputCicilan').show();
        }

        $.ajax({
            url: "{{ url('') }}/cicil/getSisa",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                kode: id,
            },
            success: function (res) {
                harga = res.toString();
                harga = formatRupiah(harga);
                $('#sisaCicilan').html(`(Sisa Cicilan : Rp. ${harga})`);
            }
        });

        // Via Payment Dropdown
        $.ajax({
            url: "{{ url('') }}/viaP/getAll/" + 1,
            success: function (res) {
                $("#cicilPay").children().remove();
                $("#cicilPay").append('<option selected value="">Pilih Payment</option>');
                $.each(res, function (index, data) {
                    $('#cicilPay').append(
                        '<option value="' + data.id + '">' + data
                            .keterangan + '</option>'
                    )
                })
            }
        });

        $.ajax({
            url: "{{ url('') }}/reservasi/getById/" + id,
            success: function (res) {
                console.log(res);
                var uang = res[0].first_pay;
                var tglUangMuka = res[0].tgl_bayar;
                var tagihanCicil = res[0].tagihan;
                $('#uangMuka').html(formatRupiah(uang.toString(), "Rp."));
                $('#tagihanCicil').html(formatRupiah(tagihanCicil.toString(), "Rp."));
                if (tglUangMuka) {
                    $('#tglUangMuka').html(formatDate1(tglUangMuka))
                } else {
                    $('#tglUangMuka').html(" -")
                }
            }
        });

        // Formating Rupiah DP
        var rupiahDp = document.getElementById('cicil');
        rupiahDp.addEventListener('keyup', function (e) {
            rupiahDp.value = formatRupiah(this.value, 'Rp.');
        });

        $('#cicilStatus').on('change', function () {
            $('#cicil').val(0);
            if (this.value == 2) {
                $('#cicil').prop("disabled", false);
            } else if (this.value == 1) {
                $('#cicil').prop("disabled", true);
                $('#cicil').val(harga);
            }
        });

        $('#dt_cicilan').DataTable().clear();
        $('#dt_cicilan').DataTable().destroy();
        $("#dt_cicilan").DataTable({
            "scrollX": true,
            "ordering": false,
            "targets": '_all',
            "className": "dt-center",

            "ajax": {
                "url": "{{ url('') }}/cicil/getInfo/" + id,
                "dataSrc": "",
            },
            "columns": [{
                "data": "tanggal_bayar",
                "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                    var html = formatDate1(data);
                    return html;
                }
            },
            {
                "data": "pay",

            },
            {
                "data": "status_bayar",
                "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                    var html = 'Dp';
                    if (data == 1) {
                        html = 'Lunas'
                    }

                    return html;
                }
            },
            {
                "data": "nominal",
                "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                    var html = formatRupiah(data);
                    return html;
                }
            },
            {
                "data": "id",
                "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                    var kode = row['kode_reservasi'];
                    var html = `<button class="btn btn-danger" onclick="delCicil(${data},'${kode}')"><i class="fas fa-trash-alt"></i>
                                            Del</a>`;
                    //
                    return html;
                }
            },
            ],

        });

        $('#FRM_LUNAS_VILLA').on('submit', function (e) {
            e.preventDefault();
            $("#FRM_LUNAS_VILLA").unbind().click(function () { });
            let nominal = $('#cicil').val();
            let status = $('#cicilStatus').val();
            let kode = $('#kodeRes').val();
            nominal = convertToAngka(nominal);
            let cicilan = convertToAngka(harga.toString());
            let sisa = 0;
            let tglBayar = $('#tglCicil').val();
            let viaPay = $('#cicilPay').val();

            $.ajax({
                url: "{{ url('') }}/cicil/in",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    kode: kode,
                    nominal: nominal,
                    status: status,
                    tgl: tglBayar,
                    viaPay: viaPay
                },
                success: function (res) {
                    $('#dt_cicilan').DataTable().ajax.reload();
                    $("#FRM_LUNAS_VILLA")[0].reset();
                    // $('#cicil').val('');
                    $("#FRM_LUNAS_VILLA").unbind().click(function () { });

                    swal({
                        icon: "success",
                        text: res['success']
                    });

                    sisa = cicilan - nominal;
                    harga = formatRupiah(sisa.toString());
                    // console.log(cicilan);
                    $('#sisaCicilan').html(`(Sisa Cicilan : Rp. ${harga})`);

                }
            });
        });
    }
</script>

{{-- Delete Cicilan --}}
<script>
    function delCicil(id, kode) {
        swal({
            title: "Kamu Yakin?",
            text: "Sekali Delete Anda Tidak Bisa Mengembalikannya!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ url('') }}/cicil/del/" + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            kode: kode,
                        },
                        success: function () {
                            $('#dt_cicilan').DataTable().ajax.reload();
                            swal("Berhasil Dihapus!", {
                                icon: "success",
                            });
                        }
                    });
                } else {
                    swal("Your file is safe!");
                }
            });
    }
</script>
@endpush