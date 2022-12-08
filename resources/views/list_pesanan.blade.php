@extends('layouts\master')
@section('header-form')
    <h1>List Pesanan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
        <div class="breadcrumb-item">List Pesanan</div>
    </div>
@endsection

@section('content')
    <div class="card card-primary" id="isiCart">
        <div class="card-header card text-center">
            <h4>Verifikasi Pesanan</h4>

        </div>
        <div class="card-body ">
            <ul class="nav nav-tabs justify-content-center" id="myTab1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pemesanan-tab" data-toggle="tab" href="#pesan" role="tab"
                        aria-controls="home" aria-selected="true">List Pesanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="cart-tab" data-toggle="tab" href="#cartList" role="tab"
                        aria-controls="profile" aria-selected="false" onclick="history()">Konfirmasi Pembelian</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="report-tab2" data-toggle="tab" href="#report" role="tab"
                        aria-controls="report" aria-selected="false" onclick="historyByPas()">Histori Pembelian</a>
                </li>
            </ul>
            <div class="tab-content tab-bordered" id="myTab1Content">
                <div class="tab-pane fade show active" id="pesan" role="tabpanel" aria-labelledby="pemesanan-tab">
                    <table id="dt_pesanan" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Kode Pesanan</th>
                                <th>Nama Pemesan</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Status</th>
                                <th>Cek</th>
                                <th> </th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="tab-pane fade" id="cartList" role="tabpanel" aria-labelledby="cart-tab">
                    <table id="dt_history" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Kode Pesanan</th>
                                <th>Nama Pemesan</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Status</th>
                                <th>Cek</th>
                                <th> </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tab-pane fade" id="report" role="tabpanel" aria-labelledby="report-tab2">
                    <table id="dt_pembelian" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Kode Pesanan</th>
                                <th>Nama Pemesan</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Status</th>
                                <th>Cek</th>
                                <th> </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
@include('Modal\reqPesananModal')

@push('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    {{-- /////////////////////////////////////////////////////////////////////////////////////// --}}

    {{-- Formating --}}
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

    {{-- Load Page Script --}}
    <script>
        var cekHistory = 0;
        var cekHistoryB = 0;

        $(document).ready(function() {
            // $('#items').hide();
            // $('#isiCart').hide();

            $('#dt_listPesanan').DataTable({
                "scrollX": true
            });
            $('#dt_items').DataTable({
                "scrollX": true
            });
            $('#dt_items1').DataTable().clear();

            $('#dt_pesanan').DataTable().clear();
            $('#dt_pesanan').DataTable().destroy();
            var table = $("#dt_pesanan").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "order": [
                    [1, 'asc']
                ],
                "ajax": {
                    "url": "{{ url('') }}/listPesanan/get",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var nama = row['kode'];
                            var html = '';
                            html +=
                                `<div class="container">
                                    <div class="col-12" style="margin-top: 5px;">
                                        <a> ${nama} </a>
                                    </div>
                            </div>`;
                            return html;
                        }
                    },
                    {
                        "data": "nama"
                    },
                    {
                        "data": "created_at",
                        "render": function(data, type, row, meta) {
                            var html = '';
                            var date = new Date(data);
                            var day = date.getDate();
                            var month = date.getMonth() + 1;
                            var year = date.getFullYear();
                            html = [day, month, year].join('/');
                            return html;
                        }
                    },
                    {
                        "data": "status",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = '';
                            html +=
                                `<div class="container">
                                        <div class="col-12" style="margin-top: 5px; margin-bottom: 5px;">
                                            <a> ${data} </a>
                                        </div>
                                </div>`;
                            return html;
                        }
                    },
                    {
                        "className": 'dt-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = '';
                            var cek = row['status'];
                            if (cek == 'Verified') {
                                html +=
                                    `<div class="container">
                                <div class="col-12" style="margin-top: 5px; margin-bottom: 5px;">
                                    <a href="#" onclick="valid(${data})" class="btn btn-primary">
                                        Permohonan Validasi</a>
                                </div>
                        </div>`;
                            } else if (cek == 'Validate') {
                                html +=
                                    `<div class="container">
                                <div class="col-12" style="margin-top: 5px; margin-bottom: 5px;">
                                    <a href="#" onclick="buy(${data})" class="btn btn-success">
                                        Konfirmasi Pembelian</a>
                                </div>
                        </div>`;
                            }
                            return html;
                        }
                    },
                ],
            });

            $('#dt_pesanan tbody').off('click', 'td.details-control');
            $('#dt_pesanan tbody').on('click', 'td.dt-control', function(e) {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var parentRow = $(this).closest("tr").prev()[0];
                var rowData = table.row(parentRow).data();

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                }
            });
        });

        function format(d) {
            var id = d.id;
            var status = d.status;
            // `d` is the original data object for the row
            let html = `<table class="table table-bordered table-md align-middle">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Last Update</th>
                                    <th>Detail</th>
                                    <th>Cek</th>
                                </tr>
                            </thead>
                            <tbody>
                        `;
            $.ajax({
                url: "{{ url('') }}/pesanan/cartItem/" + id,
                type: "GET",
                async: false,
                success: function(res) {
                    $.each(res, function(index, data) {
                        var date = new Date(data.updated_at);
                        var day = date.getDate();
                        var month = date.getMonth() + 1;
                        var year = date.getFullYear();
                        var cek = 0;
                        var update = [day, month, year].join('/');
                        html +=
                            `<tr>
                                    <td>
                                        <a> ${data.nama} </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#dokumenOrd" onclick="dok(${data.id}, '${data.nama}','${data.status}')"><i class="fas fa-folder"></i>
                                        </button>
                                    </td>
                                    <td><div class="badge badge-success">${data.status}</div></td>
                                    <td>${update}</td>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target="#detailOrd" onclick="detailOrd('${data.id}','${data.kode}')" class="btn btn-primary">Detail</a></td>`;
                        if (status == "List") {
                            html += `<td><a href="#" data-bs-toggle="modal" data-bs-target="#itemIn" onclick="cekOrd('${data.id}','${data.nama}')" class="btn btn-primary"><i class="fas fa-clipboard-list"></i></a></td>
                                </tr>`;
                        } else if (status == "Menunggu Validasi") {
                            html += `<td><a class="badge bg-secondary"><i class="fas fa-lock"></i></a></td>
                                </tr>`;
                        } else if (status == "Revisi") {
                            html += `<td><a href="#" data-bs-toggle="modal" data-bs-target="#itemIn" onclick="revOrd('${data.id}','${data.nama}')" class="btn btn-warning"><i class="fas fa-clipboard-list"></i></a></td>
                                </tr>`;
                        }
                    })
                    html += `</tbody>`;
                }
            })
            html += `</table>`;
            return html;
        }

        // Load History Pesanan
        function history() {
            if (cekHistory == 0) {
                cekHistory = 1;
                var table = $("#dt_history").DataTable({
                    "scrollX": true,
                    "columnDefs": [{
                        "targets": '_all',
                        // "sortable": false,
                        "className": "dt-center",
                    }],
                    "order": [
                        [1, 'asc']
                    ],
                    "ajax": {
                        "url": "{{ url('') }}/listPesanan/history/" + 1,
                        "dataSrc": ""
                    },
                    "columns": [{
                            "data": "id",
                            "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                                var nama = row['kode'];
                                var html = '';
                                html +=
                                    `<div class="container">
                                    <div class="col-12" style="margin-top: 5px;">
                                        <a> ${nama} </a>
                                    </div>
                            </div>`;
                                return html;
                            }
                        },
                        {
                            "data": "nama"
                        },
                        {
                            "data": "created_at",
                            "render": function(data, type, row, meta) {
                                var html = '';
                                var date = new Date(data);
                                var day = date.getDate();
                                var month = date.getMonth() + 1;
                                var year = date.getFullYear();
                                html = [day, month, year].join('/');
                                return html;
                            }
                        },
                        {
                            "data": "status",
                            "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                                var html = '';
                                html +=
                                    `<div class="container">
                                        <div class="col-12" style="margin-top: 5px; margin-bottom: 5px;">
                                            <a> ${data} </a>
                                        </div>
                                </div>`;
                                return html;
                            }
                        },
                        {
                            "className": 'dt-control',
                            "orderable": false,
                            "data": null,
                            "defaultContent": ''
                        },
                        {
                            "data": "id",
                            "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                                var html = '';
                                var cek = row['status'];
                                if (cek == 'Verified') {
                                    html +=
                                        `<div class="container">
                                <div class="col-12" style="margin-top: 5px; margin-bottom: 5px;">
                                    <a href="#" onclick="valid(${data})" class="btn btn-primary">
                                        Permohonan Validasi</a>
                                </div>
                        </div>`;
                                } else if (cek == 'Validate') {
                                    html +=
                                        `<div class="container">
                                <div class="col-12" style="margin-top: 5px; margin-bottom: 5px;">
                                    <a href="#" onclick="buy(${data})" class="btn btn-success">
                                        Konfirmasi Pembelian</a>
                                </div>
                        </div>`;
                                }
                                return html;
                            }
                        },
                    ],
                });

                $('#dt_history tbody').off('click', 'td.details-control');
                $('#dt_history tbody').on('click', 'td.dt-control', function(e) {
                    var tr = $(this).closest('tr');
                    var row = table.row(tr);
                    var parentRow = $(this).closest("tr").prev()[0];
                    var rowData = table.row(parentRow).data();

                    if (row.child.isShown()) {
                        // This row is already open - close it
                        row.child.hide();
                        tr.removeClass('shown');
                    } else {
                        // Open this row
                        row.child(format(row.data())).show();
                        tr.addClass('shown');
                    }
                });
            }

        }

        function formatHistory(d) {
            var id = d.id;
            var status = d.status;
            // `d` is the original data object for the row
            let html = `<table class="table table-bordered table-md align-middle">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Last Update</th>
                                    <th>Detail</th>
                                    <th>Cek</th>
                                </tr>
                            </thead>
                            <tbody>
                        `;
            $.ajax({
                url: "{{ url('') }}/pesanan/cartItem/" + id,
                type: "GET",
                async: false,
                success: function(res) {
                    $.each(res, function(index, data) {
                        var date = new Date(data.updated_at);
                        var day = date.getDate();
                        var month = date.getMonth() + 1;
                        var year = date.getFullYear();
                        var cek = 0;
                        var update = [day, month, year].join('/');
                        html +=
                            `<tr>
                                    <td>
                                        <a> ${data.nama} </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#dokumenOrd" onclick="dok(${data.id}, '${data.nama}','${data.status}')"><i class="fas fa-folder"></i>
                                        </button>
                                    </td>
                                    <td><div class="badge badge-success">${data.status}</div></td>
                                    <td>${update}</td>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target="#detailOrd" onclick="detailOrd('${data.id}','${data.kode}')" class="btn btn-primary">Detail</a></td>`;
                        if (status == "List") {
                            html += `<td><a href="#" data-bs-toggle="modal" data-bs-target="#itemIn" onclick="cekOrd('${data.id}','${data.nama}')" class="btn btn-primary"><i class="fas fa-clipboard-list"></i></a></td>
                                </tr>`;
                        } else if (status == "Menunggu Validasi") {
                            html += `<td><a class="badge bg-secondary"><i class="fas fa-lock"></i></a></td>
                                </tr>`;
                        } else if (status == "Revisi") {
                            html += `<td><a href="#" data-bs-toggle="modal" data-bs-target="#itemIn" onclick="revOrd('${data.id}','${data.nama}')" class="btn btn-warning"><i class="fas fa-clipboard-list"></i></a></td>
                                </tr>`;
                        }
                    })
                    html += `</tbody>`;
                }
            })
            html += `</table>`;
            return html;
        }

        // Load History Pembelian
        function historyByPas() {
            if (cekHistoryB == 0) {
                cekHistoryB = 1;
                var table = $("#dt_pembelian").DataTable({
                    "scrollX": true,
                    "columnDefs": [{
                        "targets": '_all',
                        "sortable": false,
                        "className": "dt-center",
                    }],
                    "order": [
                        [1, 'asc']
                    ],
                    "ajax": {
                        "url": "{{ url('') }}/listPesanan/historyByPass/" + 1,
                        "dataSrc": ""
                    },
                    "columns": [{
                            "data": "id",
                            "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                                var nama = row['kode'];
                                var html = '';
                                html +=
                                    `<div class="container">
                                    <div class="col-12" style="margin-top: 5px;">
                                        <a> ${nama} </a>
                                    </div>
                            </div>`;
                                return html;
                            }
                        },
                        {
                            "data": "nama"
                        },
                        {
                            "data": "created_at",
                            "render": function(data, type, row, meta) {
                                var html = '';
                                var date = new Date(data);
                                var day = date.getDate();
                                var month = date.getMonth() + 1;
                                var year = date.getFullYear();
                                html = [day, month, year].join('/');
                                return html;
                            }
                        },
                        {
                            "data": "status",
                            "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                                var html = '';
                                html +=
                                    `<div class="container">
                                        <div class="col-12" style="margin-top: 5px; margin-bottom: 5px;">
                                            <a> ${data} </a>
                                        </div>
                                </div>`;
                                return html;
                            }
                        },
                        {
                            "className": 'dt-control',
                            "orderable": false,
                            "data": null,
                            "defaultContent": ''
                        },
                        {
                            "data": "id",
                            "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                                var html = '';
                                var cek = row['status'];
                                if (cek == 'Verified') {
                                    html +=
                                        `<div class="container">
                                <div class="col-12" style="margin-top: 5px; margin-bottom: 5px;">
                                    <a href="#" onclick="valid(${data})" class="btn btn-primary">
                                        Permohonan Validasi</a>
                                </div>
                        </div>`;
                                }
                                return html;
                            }
                        },
                    ],
                });

                $('#dt_pembelian tbody').off('click', 'td.details-control');
                $('#dt_pembelian tbody').on('click', 'td.dt-control', function(e) {
                    var tr = $(this).closest('tr');
                    var row = table.row(tr);
                    var parentRow = $(this).closest("tr").prev()[0];
                    var rowData = table.row(parentRow).data();

                    if (row.child.isShown()) {
                        // This row is already open - close it
                        row.child.hide();
                        tr.removeClass('shown');
                    } else {
                        // Open this row
                        row.child(format(row.data())).show();
                        tr.addClass('shown');
                    }
                });
            }

        }
    </script>

    {{-- Detail Pesanan --}}
    <script>
        function detailOrd(id, kode) {
            var head;
            // var x = data.status;
            head = `<h4 style="color:#677fe8">Informasi Pesanan</h4><br>
            <h4> (Kode : ${kode}) </h4>`;
            $('#detailHead').html(head);

            $.ajax({
                url: "{{ url('') }}/pesanan/detailOrd/" + id,
                success: function(res) {
                    $.each(res, function(index, data) {
                        // Detail Barang
                        document.getElementById('namaD').innerHTML = `${data.nama}`;
                        document.getElementById('kateD').innerHTML = `${data.kategori}`;
                        document.getElementById('tipeD').innerHTML = `${data.tipe}`;
                        document.getElementById('merkD').innerHTML = `${data.merk}`;
                        document.getElementById('modelD').innerHTML = `${data.model}`;
                        document.getElementById('warnaD').innerHTML = `${data.warna}`;
                        document.getElementById('ukuranD').innerHTML = `${data.ukuran}`;

                        // Detail Pesanan
                        document.getElementById('vendorD').innerHTML = `${data.nama_vendor}`;
                        document.getElementById('assetD').innerHTML = `${data.nama_assets}`;
                        document.getElementById('subD').innerHTML = `${data.nama_subAsset}`;
                        document.getElementById('jlhD').innerHTML = `${data.jumlah}`;
                        document.getElementById('alasanD').innerHTML = `${data.alasan}`;
                    })
                }
            })
        }
    </script>

    {{-- Verifikasi Pesanan --}}
    <script>
        function cekOrd(barang, nama) {
            // document.getElementById('itemHead').innerHTML = `Penambahan Item <br> (${nama})`;
            $('#namaB').val(nama);
            $("#vendorIn").select2({
                dropdownParent: $("#itemIn")
            })

            $("#assetIn").select2({
                dropdownParent: $("#itemIn")
            })

            $("#subIn").select2({
                dropdownParent: $("#itemIn")
            })

            var rupiah = document.getElementById('hargaIn');
            rupiah.addEventListener('keyup', function(e) {
                rupiah.value = formatRupiah(this.value);
            });

            $.ajax({
                url: "{{ url('') }}/listPesanan/item/" + barang,
                type: "GET",
                success: function(getRes) {
                    document.getElementById('hargaIn').value = formatRupiah(getRes.harga.toString());
                    document.getElementById('kodeB').value = getRes.kode;
                    var totalHarga = (getRes.jumlah * getRes.harga);
                    totalHarga = formatRupiah(totalHarga.toString());
                    $('#totalHargaBrg').val(totalHarga);
                    $('#jlhBrg').val(getRes.jumlah);

                    // Vendor Dropdown
                    $.ajax({
                        url: "{{ url('') }}/pesanan/getVendorDrp/" + getRes.id_barang,
                        type: "GET",
                        success: function(res) {
                            var vendorDef = `Vendor Kosong`;
                            $.each(res, function(index, data) {
                                $('#vendorIn').append(
                                    `<option value=${data.id_vendor}>${data.nama_vendor}</option>`
                                );
                            })
                            $("#vendorIn").val(getRes.id_vendor).change();
                        }
                    })
                }
            });

            // Reset Form
            $('#itemIn').on('hidden.bs.modal', function() {
                $("#frmItemAdd")[0].reset();
            });

            $('#frmItemAdd').on('submit', function(e) {
                e.preventDefault();
                let nama = $('#namaB').val();
                let harga = $('#hargaIn').val();
                let vendor = $('#vendorIn').val();
                var ids = `<?php echo Session::get('id'); ?>`;
                harga = convertToAngka(harga);
                $.ajax({
                    url: "{{ url('') }}/listPesanan/cekUp/" + barang,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        harga: harga,
                        ids: ids,
                        vendor: vendor
                    },
                    success: function(res) {
                        $('#itemIn').modal('hide');
                        $("#frmItemAdd")[0].reset();
                        $('#dt_pesanan').DataTable().ajax.reload();
                        $("#frmItemAdd").unbind().click(function() {});
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });
            });
        }
    </script>

    {{-- Request Validasi Pesanan --}}
    <script>
        function valid(id) {
            var ids = `<?php echo Session::get('id'); ?>`;
            swal({
                    title: "Request Validasi Barang?",
                    text: "Apakah Anda Ingin Masukan Kedalam Antrian Validasi?",
                    icon: "info",
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ url('') }}/listPesanan/reqVal/" + id,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                ids: ids
                            },
                            success: function(res) {
                                $('#dt_pesanan').DataTable().ajax.reload();
                                swal({
                                    icon: "success",
                                    text: res['success']
                                });
                                $('#pesanB').hide();
                            }
                        });
                    }
                });
        }
    </script>

    {{-- Revisi Js --}}
    <script>
        function revisi(id) {
            $("#barangR" + id).select2({
                dropdownParent: $("#revisi" + id)
            })
            $("#vendorR" + id).select2({
                dropdownParent: $("#revisi" + id)
            })
            $("#modelR" + id).select2({
                dropdownParent: $("#revisi" + id)
            })
            $("#merkR" + id).select2({
                dropdownParent: $("#revisi" + id)
            })
            $("#warnaR" + id).select2({
                dropdownParent: $("#revisi" + id)
            })

            var input = document.getElementById("barang");
            var vendor = document.getElementById("vendor" + id);
            var cek = "";
            var vend = "";

            if (vendor) {
                vend = vendor.value;
                if (vend == "" || vend == null) {
                    if (input) {
                        cek = input.value;
                        console.log(cek);
                        $("#vendor" + id).children().remove();
                        $("#vendor" + id).append('<option selected value="">Pilih Vendor</option>');
                        // $("#vendor").prop('disabled', true)
                        if (cek != '' && cek != null) {
                            // $("subLokasi").prop('disabled', false)
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url: "getVendor/" + cek,
                                type: "GET",
                                success: function(res) {
                                    $.each(res, function(index, data) {
                                        $('#vendor' + id).append(
                                            '<option value="' + data.id_vendor + '">' + data
                                            .nama_vendor + '</option>'
                                        )
                                    })
                                }
                            })
                        }
                    }
                }
            }
        }
    </script>

    {{-- Dokumen Pesanan --}}
    <script>
        function dok(id, nama, status) {
            var status;

            var html;
            // var x = data.status;
            html = `<h4 style="color:#677fe8">Dokumentasi</h4>
                    <h4>(${nama} )</h4>
                    <br>`;
            $('#headerDok').html(html);


            $('#dt_dokumen').DataTable().clear();
            $('#dt_dokumen').DataTable().destroy();
            $("#dt_dokumen").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/cartDok/get/" + id,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "nama_file"
                    },
                    {
                        "data": "path",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<a href="${data}" class="btn btn-success" target="_blank"><i class="fas fa-eyes"></i>
                                    Cek</a>`;
                            //
                            return html;
                        }
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-danger" onclick="deleteDok(${data})"><i class="fas fa-trash-alt"></i>
                                    Del</button>`;
                            //
                            return html;
                        }
                    }
                ],
            });

            if (status == "Pembelian" || status == "Validate") {
                $('#dropZone').hide();
            }
            var count = 0;
            Dropzone.autoDiscover = false;
            var uploadedDocumentMap = {}
            var myDropzone1 = new Dropzone("div#myDrop", {
                url: "{{ url('') }}/cart/storeMedia",
                // maxFilesize: 12,
                // autoProcessQueue: false,
                parallelUploads: 100,
                renameFile: function(file) {
                    var dt = new Date();
                    let time = dt.getTime();
                    var spar = "_";
                    return time + spar + file.name;
                },
                // acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.docx",
                addRemoveLinks: true,
                // timeout: 5000,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(file, response) {
                    console.log(response);
                    uploadedDocumentMap[file.name] = response.name;
                },
                error: function(file, response) {
                    return false;
                },
                init: function() {
                    this.on("sending", function(file, xhr, formData) {
                            formData.append('ids', id)
                        }),
                        this.on("complete", function(response) {
                            myDropzone1.removeAllFiles();
                            $('#dt_dokumen').DataTable().ajax.reload();
                        })
                }
            });
        }
        $(document).ready(function() {
            $('#dokumen').on('hidden.bs.modal', function(e) {
                if (Dropzone.instances.length > 0) Dropzone.instances.forEach(dz => dz.destroy());
            })
        });
    </script>

    {{-- Detail Modal Js --}}
    <script>
        function set(id) {
            $(document).ready(function() {
                $(`#D${id}`).hide();
            });
        }

        function hideSeek(id) {
            $(`#D${id}`).hide();;
            $(`#C${id}`).show();;
        }

        function hideSeek1(id) {
            $(`#C${id}`).hide();;
            $(`#D${id}`).show();;
        }
    </script>

    {{-- Script Note --}}
    <script>
        function notePop() {
            $(document).ready(function() {
                var ket = document.getElementById('note').value;
                swal({
                    title: "Alasan Penolakan",
                    icon: "warning",
                    text: ket
                });
            });
        }
    </script>

    {{-- Script Pembelian --}}
    <script>
        function buy(cart) {
            swal({
                    title: "Konfirmasi Pembelian Pesanan?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var namas = `<?php echo Session::get('nama'); ?>`;
                        var divisi = `<?php echo Session::get('divisi'); ?>`;
                        var ids = `<?php echo Session::get('id'); ?>`;

                        $.ajax({
                            url: "listPesanan/beli/" + cart,
                            data: {
                                namas: namas,
                                ids: ids,
                                divisi: divisi,
                            },
                            success: function(data) {
                                $('#dt_history').DataTable().ajax.reload();
                                swal({
                                    icon: "success",
                                    text: data['success']
                                });
                            }
                        })
                    } else {
                        swal("Data Tidak Jadi Dibeli!");
                    }
                });
        }
    </script>
@endpush
