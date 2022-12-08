@extends('layouts\master')
@section('header-form')
    <h1>Laporan Reservasi</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="dashboard">Home</a></div>
        <div class="breadcrumb-item">Laporan Reservasi</div>
    </div>
@endsection
@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-header card text-center">
                <h4>Laporan Reservasi</h4>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs justify-content-center" id="myTab6" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-center active" id="asset-tab6" data-toggle="tab" href="#asset6"
                            role="tab" aria-controls="asset" aria-selected="true">
                            <span></span> Check In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" id="subAsset-tab6" data-toggle="tab" href="#subAsset6"
                            role="tab" aria-controls="subAsset" aria-selected="false">
                            <span></span>Tanggal Reservasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" id="tglBayar-tab" data-toggle="tab" href="#tglB" role="tab"
                            aria-controls="subAsset" aria-selected="false">
                            <span></span>Tanggal Bayar</a>
                    </li>
                    <input type="hidden" id="cekFilter">
                </ul>
                <div class="tab-content tab-bordered" id="myTabContent6">
                    <div class="tab-pane fade active show" id="asset6" role="tabpanel" aria-labelledby="asset-tab6">
                        <br>
                        <center>
                            <h5>Filter Tanggal Check In</h5>
                        </center>
                        <div class="card-body">
                            <form class="needs-validation was-validated">
                                <div class="row filter-row">
                                    <div class="col-sm-5 col-md-5">
                                        <div class="form-group form-focus">
                                            <label>Dari</label>
                                            <input type="date" class="form-control" name="filFrom" id="filFrom"
                                                required>
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 col-md-5">
                                        <div class="form-group form-focus">
                                            <label>Sampai</label>
                                            <input type="date" class="form-control" name="filTo" id="filTo"
                                                required>
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-md-2">
                                        <div class="form-group form-focus">
                                            <label>Cari</label>
                                            <br>
                                            <button class="btn btn-primary" type="button"
                                                onclick="filter()">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="subAsset6" role="tabpanel" aria-labelledby="subAsset-tab6">
                        <br>
                        <center>
                            <h5>Filter Tanggal Reservasi</h5>
                        </center>
                        <div class="card-body">
                            <form class="needs-validation was-validated">
                                <div class="row filter-row">
                                    <div class="col-sm-5 col-md-5">
                                        <div class="form-group form-focus">
                                            <label>Dari</label>
                                            <input type="date" class="form-control" name="fromRes" id="fromRes"
                                                required>
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 col-md-5">
                                        <div class="form-group form-focus">
                                            <label>Sampai</label>
                                            <input type="date" class="form-control" name="toRes" id="toRes"
                                                required>
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-md-2">
                                        <div class="form-group form-focus">
                                            <label>Cari</label>
                                            <br>
                                            <button class="btn btn-primary" type="button"
                                                onclick="filterRes()">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tglB" role="tabpanel" aria-labelledby="tglBayar-tab">
                        <br>
                        <center>
                            <h5>Filter Tanggal Bayar</h5>
                        </center>
                        <div class="card-body">
                            <form class="needs-validation was-validated">
                                <div class="row filter-row">
                                    <div class="col-sm-5 col-md-5">
                                        <div class="form-group form-focus">
                                            <label>Dari</label>
                                            <input type="date" class="form-control" name="fromBayar" id="fromBayar"
                                                required>
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 col-md-5">
                                        <div class="form-group form-focus">
                                            <label>Sampai</label>
                                            <input type="date" class="form-control" name="toBayar" id="toBayar"
                                                required>
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-md-2">
                                        <div class="form-group form-focus">
                                            <label>Cari</label>
                                            <br>
                                            <button class="btn btn-primary" type="button"
                                                onclick="filterBayar()">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <br>
                <div class="tab-content tab-bordered">
                    <div class="tab-pane fade show active">
                        <center><button id="btnSaveReport" style="display: none" class="btn btn-primary btn-lg"
                                onclick="savePdf()">Simpan</button></center>
                        <table id="dt_penyewaan" class="display nowrap dataTable dtr-inline collapsed"
                            style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Kode Reservasi</th>
                                    <th>Tanggal Reservasi</th>
                                    <th>Nama Pemesan</th>
                                    <th>Nama Villa</th>
                                    <th>Tagihan</th>
                                    <th>Total Bayar</th>
                                    <th>Last Pay Date</th>
                                    <th>Status</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

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
    </script>


    {{-- Load Reservasi --}}
    <script>
        function formatTime(tanggal) {
            var date = new Date(tanggal);
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            var hsl = [day, month, year].join('/');
            return hsl;
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

        $(document).ready(function() {
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
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "{{ url('') }}/reservasi/get/" + 1,
                    "dataSrc": "",
                    // "success": function(data) {
                    //     $("#reservAdd").show();
                    // }
                },
                "columns": [{
                        "data": "kode_reservasi"
                    },
                    {
                        "data": "created_at",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatDate1(data);
                            return html;
                        }
                    },
                    {
                        "data": "nama",
                    },
                    {
                        "data": "asset",
                    },
                    {
                        "data": "tagihan",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatRupiah(data, "Rp.");
                            return html;
                        }
                    },
                    {
                        "data": "kode_reservasi",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = row['first_pay'];
                            var currentCell = $("#dt_penyewaan").DataTable().cells({
                                "row": meta.row,
                                "column": meta.col
                            }).nodes(0);
                            $.ajax({
                                url: "{{ url('') }}/reportReserv/get/" + data,
                                async: true,
                            }).done(function(res) {

                                // html = 1

                                html = parseInt(html) + parseInt(res);

                                // console.log(html);                                
                                $(currentCell).html(formatRupiah(html.toString(), "Rp"));

                            });
                            return null;
                        }
                    },
                    {
                        "data": "updated_at",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatDate1(data);
                            return html;
                        }
                    },
                    {
                        "data": "lunas",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
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
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatDate1(data);
                            return html;
                        }
                    },
                    {
                        "data": "check_out",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatDate1(data);
                            return html;
                        }
                    },
                ]
                // dom: 'Bfrtip',
                // buttons: [{
                //     extend: 'pdf',
                //     text: 'Save PDF',
                //     messageTop: `Last Update ${lastUpdate}`,
                //     title: 'Laporan Keuangan Reservasi',
                // }]

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


    {{-- Save PDF --}}
    <script>
        function savePdf() {

            var fromBayar = $('#fromBayar').val();
            var toBayar = $('#toBayar').val();
            var fromRes = $('#fromRes').val();
            var toRes = $('#toRes').val();
            var fromCek = $('#filFrom').val();
            var toCek = $('#filTo').val();

            var cekFil = $('#cekFilter').val();
            var dateFrom = 0;
            var dateTo = 0;
            var judul = '';
            if (cekFil == 'Res') {
                dateFrom = fromRes;
                dateTo = toRes;
                judul = 'Filter Tanggal Reservasi';
            } else if (cekFil == 'Buy') {
                dateFrom = fromBayar;
                dateTo = toBayar;
                judul = 'Filter Last Pay';
            } else {
                dateFrom = fromCek;
                dateTo = toCek;
                judul = 'Filter Check In';
            }

            // var elt = document.getElementById('dt_report');
            // var wb = XLSX.utils.table_to_book(elt, {
            //     sheet: "sheet1"
            // });
            // return XLSX.writeFile(wb, (`Report Reservasi ${tglAwal} - ${tglAkhir}.` + 'xlsx'));

            var date = new Date();
            var dateStr =
                ("00" + (date.getMonth() + 1)).slice(-2) + "/" +
                ("00" + date.getDate()).slice(-2) + "/" +
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
                '#bypassme': function(element, renderer) {
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
            doc.text(250, y = y + 20, `Laporan Keuangan Reservasi ${judul}`);
            doc.text(300, y = y + 30, `(${formatDate1(dateFrom)} s/d ${formatDate1(dateTo)})`);
            doc.text(40, y = y + 45, `Last Update ${dateStr}`);
            doc.autoTable({
                html: '#dt_penyewaan',
                startY: 120,
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
            doc.save(`Report Keuangan Reservasi.pdf`);

        }
    </script>

    {{-- Filter Check In --}}
    <script>
        function filter() {
            $('#btnSaveReport').show();
            $('#cekFilter').val('Cek');
            var filFrom = $('#filFrom').val();
            var filTo = $('#filTo').val();

            var dateNow = new Date();
            var lastUpdate =
                ("00" + (dateNow.getMonth() + 1)).slice(-2) + "/" +
                ("00" + dateNow.getDate()).slice(-2) + "/" +
                dateNow.getFullYear() + " " +
                ("00" + dateNow.getHours()).slice(-2) + ":" +
                ("00" + dateNow.getMinutes()).slice(-2) + ":" +
                ("00" + dateNow.getSeconds()).slice(-2);

            $('#dt_penyewaan').DataTable().clear();
            $('#dt_penyewaan').DataTable().destroy();
            // $('#reservAdd').prop('disabled', true);

            $("#dt_penyewaan").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": [0],
                    "sortable": false
                }],
                "order": [
                    [8, 'asc']
                ],
                "ajax": {
                    "url": "{{ url('') }}/reportReserv/filter/" + 1,
                    "dataSrc": "",
                    "data": {
                        from: filFrom,
                        to: filTo
                    }
                },
                "columns": [{
                        "data": "kode_reservasi"
                    },
                    {
                        "data": "created_at",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatDate1(data);
                            return html;
                        }
                    },
                    {
                        "data": "nama",
                    },
                    {
                        "data": "asset",
                    },
                    {
                        "data": "tagihan",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatRupiah(data, "Rp.");
                            return html;
                        }
                    },
                    {
                        "data": "kode_reservasi",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = row['first_pay'];
                            var currentCell = $("#dt_penyewaan").DataTable().cells({
                                "row": meta.row,
                                "column": meta.col
                            }).nodes(0);
                            $.ajax({
                                url: "{{ url('') }}/reportReserv/get/" + data,
                                async: true,
                            }).done(function(res) {

                                // html = 1

                                html = parseInt(html) + parseInt(res);

                                // console.log(html);                                
                                $(currentCell).html(formatRupiah(html.toString(), "Rp"));

                            });
                            return null;
                        }
                    },
                    {
                        "data": "updated_at",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatDate1(data);
                            return html;
                        }
                    },
                    {
                        "data": "lunas",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
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
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatDate1(data);
                            return html;
                        }
                    },
                    {
                        "data": "check_out",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatDate1(data);
                            return html;
                        }
                    },
                ],
                "pageLength": 50,

                // dom: 'Bfrtip',
                // buttons: [{
                //     extend: 'pdf',
                //     text: 'Save PDF',
                //     messageTop: `Last Update ${lastUpdate}`,
                //     title: 'Laporan Keuangan Reservasi',
                // }]
            })
        }
    </script>

    {{-- Filter Tanggal Reservasi --}}
    <script>
        function filterRes() {
            $('#btnSaveReport').show();
            var filFrom = $('#fromRes').val();
            var filTo = $('#toRes').val();
            $('#cekFilter').val('Res');

            var dateNow = new Date();
            var lastUpdate =
                ("00" + (dateNow.getMonth() + 1)).slice(-2) + "/" +
                ("00" + dateNow.getDate()).slice(-2) + "/" +
                dateNow.getFullYear() + " " +
                ("00" + dateNow.getHours()).slice(-2) + ":" +
                ("00" + dateNow.getMinutes()).slice(-2) + ":" +
                ("00" + dateNow.getSeconds()).slice(-2);

            $('#dt_penyewaan').DataTable().clear();
            $('#dt_penyewaan').DataTable().destroy();
            // $('#reservAdd').prop('disabled', true);

            $("#dt_penyewaan").DataTable({
                "scrollX": true,
                "order": [
                    [1, 'asc']
                ],
                "columnDefs": [{
                    "targets": [0],
                    "sortable": false
                }],
                "ajax": {
                    "url": "{{ url('') }}/reportReserv/filRes/" + 1,
                    "dataSrc": "",
                    "data": {
                        from: filFrom,
                        to: filTo
                    }
                },
                "columns": [{
                        "data": "kode_reservasi"
                    },
                    {
                        "data": "created_at",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatDate1(data);
                            return html;
                        }
                    },
                    {
                        "data": "nama",
                    },
                    {
                        "data": "asset",
                    },
                    {
                        "data": "tagihan",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatRupiah(data, "Rp.");
                            return html;
                        }
                    },
                    {
                        "data": "kode_reservasi",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = row['first_pay'];
                            var currentCell = $("#dt_penyewaan").DataTable().cells({
                                "row": meta.row,
                                "column": meta.col
                            }).nodes(0);
                            $.ajax({
                                url: "{{ url('') }}/reportReserv/get/" + data,
                                async: true,
                            }).done(function(res) {

                                // html = 1

                                html = parseInt(html) + parseInt(res);

                                // console.log(html);                                
                                $(currentCell).html(formatRupiah(html.toString(), "Rp"));

                            });
                            return null;
                        }
                    },
                    {
                        "data": "updated_at",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatDate1(data);
                            return html;
                        }
                    },
                    {
                        "data": "lunas",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
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
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatDate1(data);
                            return html;
                        }
                    },
                    {
                        "data": "check_out",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatDate1(data);
                            return html;
                        }
                    },
                ],
                "pageLength": 50

            })
        }
    </script>

    {{-- Filter Tanggal Bayar --}}
    <script>
        function filterBayar() {
            $('#btnSaveReport').show();
            var filFrom = $('#fromBayar').val();
            var filTo = $('#toBayar').val();
            $('#cekFilter').val('Buy');
            var dateNow = new Date();
            var lastUpdate =
                ("00" + (dateNow.getMonth() + 1)).slice(-2) + "/" +
                ("00" + dateNow.getDate()).slice(-2) + "/" +
                dateNow.getFullYear() + " " +
                ("00" + dateNow.getHours()).slice(-2) + ":" +
                ("00" + dateNow.getMinutes()).slice(-2) + ":" +
                ("00" + dateNow.getSeconds()).slice(-2);

            $('#dt_penyewaan').DataTable().clear();
            $('#dt_penyewaan').DataTable().destroy();
            // $('#reservAdd').prop('disabled', true);

            $("#dt_penyewaan").DataTable({
                "scrollX": true,
                "order": [
                    [6, 'asc']
                ],
                "pageLength": 50,
                "columnDefs": [{
                    "targets": [0],
                    "sortable": false
                }],
                "ajax": {
                    "url": "{{ url('') }}/reportReserv/filBayar/" + 1,
                    "dataSrc": "",
                    "data": {
                        from: filFrom,
                        to: filTo
                    }
                },
                "columns": [{
                        "data": "kode_reservasi"
                    },
                    {
                        "data": "created_at",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatDate1(data);
                            return html;
                        }
                    },
                    {
                        "data": "nama",
                    },
                    {
                        "data": "asset",
                    },
                    {
                        "data": "tagihan",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatRupiah(data, "Rp.");
                            return html;
                        }
                    },
                    {
                        "data": "kode_reservasi",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = row['first_pay'];
                            var currentCell = $("#dt_penyewaan").DataTable().cells({
                                "row": meta.row,
                                "column": meta.col
                            }).nodes(0);
                            $.ajax({
                                url: "{{ url('') }}/reportReserv/get/" + data,
                                async: true,
                            }).done(function(res) {

                                // html = 1

                                html = parseInt(html) + parseInt(res);

                                // console.log(html);                                
                                $(currentCell).html(formatRupiah(html.toString(), "Rp"));

                            });
                            return null;
                        }
                    },
                    {
                        "data": "updated_at",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatDate1(data);
                            return html;
                        }
                    },
                    {
                        "data": "lunas",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
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
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatDate1(data);
                            return html;
                        }
                    },
                    {
                        "data": "check_out",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatDate1(data);
                            return html;
                        }
                    },
                ],
                // dom: 'Bfrtip',
                // buttons: [{
                //     extend: 'pdf',
                //     text: 'Save PDF',
                //     messageTop: `Last Update ${lastUpdate}`,
                //     title: 'Laporan Keuangan Reservasi',
                // }]
            })
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
                success: function(res) {
                    harga = res.toString();
                    harga = formatRupiah(harga);
                    $('#sisaCicilan').html(`(Sisa Cicilan : Rp. ${harga})`);
                }
            });

            // Via Payment Dropdown
            $.ajax({
                url: "{{ url('') }}/viaP/getAll/" + 1,
                success: function(res) {
                    $("#cicilPay").children().remove();
                    $("#cicilPay").append('<option selected value="">Pilih Payment</option>');
                    $.each(res, function(index, data) {
                        $('#cicilPay').append(
                            '<option value="' + data.id + '">' + data
                            .keterangan + '</option>'
                        )
                    })
                }
            });

            $.ajax({
                url: "{{ url('') }}/reservasi/getById/" + id,
                success: function(res) {
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
            rupiahDp.addEventListener('keyup', function(e) {
                rupiahDp.value = formatRupiah(this.value, 'Rp.');
            });

            $('#cicilStatus').on('change', function() {
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
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatDate1(data);
                            return html;
                        }
                    },
                    {
                        "data": "pay",

                    },
                    {
                        "data": "status_bayar",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = 'Dp';
                            if (data == 1) {
                                html = 'Lunas'
                            }

                            return html;
                        }
                    },
                    {
                        "data": "nominal",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = formatRupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var kode = row['kode_reservasi'];
                            var html = `<button class="btn btn-danger" onclick="delCicil(${data},'${kode}')"><i class="fas fa-trash-alt"></i>
                                            Del</a>`;
                            //
                            return html;
                        }
                    },
                ],

            });

            $('#FRM_LUNAS_VILLA').on('submit', function(e) {
                e.preventDefault();
                $("#FRM_LUNAS_VILLA").unbind().click(function() {});
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
                    success: function(res) {
                        $('#dt_cicilan').DataTable().ajax.reload();
                        $("#FRM_LUNAS_VILLA")[0].reset();
                        // $('#cicil').val('');
                        $("#FRM_LUNAS_VILLA").unbind().click(function() {});

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
@endpush
