@extends('layouts\master')
@section('assetB')
    <li class="sidebar-menu active"><a class="nav-link" href="assetsB"><i class="fas fa-coins"></i>
            <span>Input Asset</span></a></li>
@endsection
@section('header-form')
    <h1>Input Assets</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="\">Home</a></div>
        <div class="breadcrumb-item">Input Asset</div>
    </div>
@endsection
@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-header card text-center">
                <h4>Asset Management</h4>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs justify-content-center" id="myTab6" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-center active" id="asset-tab6" data-toggle="tab" href="#asset6"
                            role="tab" aria-controls="asset" aria-selected="true" onclick="tabAsset()">
                            <span><i class="fas fa-home"></i></span> Asset</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" id="subAsset-tab6" data-toggle="tab" href="#subAsset6"
                            role="tab" aria-controls="subAsset" aria-selected="false" onclick="getSubAll()">
                            <span><i class="fas fa-bed"></i></span> Sub Asset</a>
                    </li>
                </ul>
                <div class="tab-content tab-bordered" id="myTabContent6">
                    <div class="tab-pane fade active show" id="asset6" role="tabpanel" aria-labelledby="asset-tab6">
                        <div class="card-header card text-center">
                            <h4>Assets</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#assetsIn"
                                    onclick="assetsIn()">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_assets" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nama assets</th>
                                        <th>Sub Asset</th>
                                        <th>Lokasi</th>
                                        <th>Dokumentasi</th>
                                        <th>Detail Inventaris</th>
                                        <th>Cek Barang</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="subAsset6" role="tabpanel" aria-labelledby="subAsset-tab6">
                        <div class="card-header card text-center">
                            <h4>Sub Asset</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSub"
                                    id="BTN_ADD_SUB"><i class="fas fa-plus-circle"></i> Tambah Sub
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_subAssetAll" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nama Sub Asset</th>
                                        <th>Nama Asset</th>
                                        <th>Detail Label</th>
                                        <th>Dokumentasi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('Modal\assetsModal')

@push('page-scripts')

    {{-- Format Rupiah --}}
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

    {{-- Unbind Click --}}
    <script>
        $(document).ready(function() {
            $('#assetsIn').on('hidden.bs.modal', function(e) {
                // label = [];
                $("#frmAssetIn").unbind().click(function() {});
            });

            // $(function(){$('.btn').click(function(e){e.preventDefault();}).click();});

            $('#subAsset').on('hidden.bs.modal', function(e) {
                // label = [];
                $("#frmSubAsset").unbind().click(function() {
                    //Stuff
                });
            });

            $('#assetsEdit').on('hidden.bs.modal', function(e) {
                // label = [];
                $("#frmEdit").unbind().click(function() {});
            });
        });

        function ucwords(str) {
            var splitStr = str.toLowerCase().split(' ');
            for (var i = 0; i < splitStr.length; i++) {

                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
            }

            return splitStr.join(' ');
        }
    </script>

    {{-- Load Assets --}}
    <script>
        $(document).ready(function() {
            $('#inputItem').hide();
            $('#subAssetS').hide();
            $('#iventoriAsset').hide();
            $('#dt_assets').DataTable().clear();
            $('#dt_assets').DataTable().destroy();
            var table = $("#dt_assets").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/assets/load/" + 1,
                    "dataSrc": "",
                },
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "columns": [{
                        "data": "id_assets",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var assets = row['nama_assets'];
                            var subAsset = row['id'];
                            var html = '';
                            var cekData = 0;
                            html += ` <a href="#" data-bs-toggle="modal" class="text-dark"
                            data-bs-target="#detailAll" onclick="detail(${data})">
                                    ${assets}</a>`;

                            if (cekData == 0) {
                                html += `<div class="table-links">
                            <a href="#" data-bs-toggle="modal" id="btnEdit"
                            data-bs-target="#assetsEdit" onclick="editAssets1(${data})">
                                    Edit</a>
                                    <div class="bullet"></div>
                                <a href="#" class="text-danger" onclick="deleteAssets(${data})">
                                    Hapus</a>
                                </div>`;
                            }
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
                        "data": "nama_lokasi"
                    },
                    {
                        "data": "id_assets",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-dark" data-bs-toggle="modal"
                                        data-bs-target="#dokumenA" onclick="dokumentasi(${data})"><i class="fas fa-folder"></i>
                                        </button>`;
                            //
                            return html;
                        }
                    },
                    {
                        "data": "id_assets",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#labelDetail" onclick="getAllLabel(${data})"><i class="fas fa-tags"></i>
                                        </button>`;
                            //
                            return html;
                        }
                    },
                    {
                        "data": "id_assets",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#cekBar" onclick="cekBarang(${data})"><i class="fas fa-truck-loading"></i>
                                        </button>`;
                            //
                            return html;
                        }
                    }
                ],
            });

            $("#dt_assets tbody").unbind().click(function() {});
            $('#dt_assets tbody').on('click', 'td.dt-control', function(e) {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var parentRow = $(this).closest("tr").prev()[0];
                var rowData = table.row(parentRow).data();
                var idr = row.data().id_assets;
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
            // `d` is the original data object for the row
            let html = `<table class="table table-bordered table-md align-middle">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="container">
                                            <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                                <a> Nama Sub </a>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="container">
                                            <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                                <a> Dokumen </a>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="container">
                                            <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                                <a> Last Update </a>
                                            </div>
                                        </div>
                                    </th>
                                    <th>  </th>
                                </tr>
                            </thead>
                            <tbody>
                        `;
            $.ajax({
                url: "{{ url('') }}/subAsset/inAsset/" + d.id_assets,
                type: "GET",
                async: false,
                success: function(res) {
                    // console.log(d.id_assets);
                    if (res.length == 0) {
                        html = `<div class="container">
                                    <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                        <center><a> Tidak Ada Sub</a></center>
                                    </div>
                                </div>`;

                    }

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
                                        <div class="container">
                                            <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                                <a> ${data.nama_subAsset} </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="container">
                                            <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                                <button class="btn btn-dark" data-bs-toggle="modal"
                                                    data-bs-target="#dokumenSubAsset" onclick="dokSubA(${data.id})"><i class="fas fa-folder"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="container">
                                            <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                                <a> ${update} </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="container">
                                            <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                                <button class="btn btn-primary" data-bs-toggle="modal" id="btnEdit" data-bs-target="#subAssetEdit" onclick="editSub(${data.id})"><i class="fas fa-edit"></i>
                                                </button>
                                                <button onclick="deleteSubAsset(${data.id})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>`;
                    })
                    html += `</tbody>`;
                }
            })
            html += `</table>`;
            return html;
        }

        function tabAsset() {
            $('#dt_assets').DataTable().ajax.reload();
        }
    </script>

    {{-- Cek Up Barang --}}
    <script>
        function cekBarang(id) {
            $.ajax({
                url: "{{ url('') }}/assetsD/load/" + id,

                success: function(data) {
                    var html;
                    var input;
                    // var x = data.status;
                    headSub =
                        `<h4> Cek Up Barang Masuk</h4>
                        <h4>(${data.nama_assets} Lokasi ${data.nama_lokasi} Sub Lokasi ${data.nama_subL})</h4><br>`;
                    $('#headerCekUp').html(headSub);
                }
            })

            $('#dt_cekBarang').DataTable().clear();
            $('#dt_cekBarang').DataTable().destroy();
            $("#dt_cekBarang").DataTable({
                "scrollX": true,
                "processing": true,
                "ajax": {
                    "url": "{{ url('') }}/assets/cekUp/" + id,
                    "dataSrc": "",
                },
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "columns": [{
                        "data": "kode_label",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<a href="#" data-bs-toggle="modal" class="text-dark"
                            data-bs-target="#detailLabel" onclick="labelD('${data}')">
                                    ${data}</a>`;
                            //
                            return html;
                        }
                    },
                    {
                        "data": "id_formAsset",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var assets = row['nama_assets'];
                            // var subAsset = row['id'];
                            var html = '';
                            var cekData = 0;
                            html += ` <a href="#" data-bs-toggle="modal" class="text-dark"
                            data-bs-target="#detailAll" onclick="detail(${data})">
                                    ${assets}</a>`;
                            return html;
                        }
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
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-info" onclick="valid(${data})"><i class="fas fa-check-circle"></i>
                                        </button>`;
                            //
                            return html;
                        }
                    },
                ],
            });
        }
    </script>

    {{-- Input Assets --}}
    <script>
        function assetsIn() {
            $('#lokasi').select2({
                dropdownParent: $("#assetsIn")
            });
            $('#kategori').select2({
                dropdownParent: $("#assetsIn")
            });
            $('#pemilik').select2({
                dropdownParent: $("#assetsIn")
            });
            $('#subLokasi').select2({
                dropdownParent: $("#assetsIn")
            });

            // getDrpzone(1);

            $.ajax({
                url: "{{ url('') }}/lokasi/load/" + 1,
                success: function(res) {
                    $("#lokasi").children().remove();
                    $("#lokasi").append(
                        '<option selected value="">Pilih Lokasi</option>');
                    $.each(res, function(index, x) {
                        $('#lokasi').append(
                            '<option value="' + x.id_lokasi + '">' + x
                            .nama_lokasi + '</option>'
                        )
                    })
                }
            });

            $.ajax({
                url: "{{ url('') }}/kategori/load/" + 1,
                success: function(res) {
                    $("#kategori").children().remove();
                    $("#kategori").append(
                        '<option selected value="">Pilih Kategori</option>');
                    $.each(res, function(index, x) {
                        $('#kategori').append(
                            '<option value="' + x.id_kategori + '">' + x
                            .nama_kategori + '</option>'
                        )
                    })
                }
            });

            $.ajax({
                url: "{{ url('') }}/pemilik/load/" + 1,
                success: function(res) {
                    $("#pemilik").children().remove();
                    $("#pemilik").append(
                        '<option selected value="">Pilih Pemilik</option>');
                    $.each(res, function(index, x) {
                        $('#pemilik').append(
                            '<option value="' + x.id_pemilik + '">' + x
                            .nama_pemilik + ` (${x.status})` + '</option>'
                        )
                    })
                }
            });

            $('#lokasi').on('change', function() {
                var id = $(this).val();
                $("#subLokasi").children().remove();
                $("#subLokasi").append('<option selected value="">Pilih Sub Lokasi</option>');
                $("subLokasi").prop('disabled', true)
                if (id != '' && id != null) {
                    // $("subLokasi").prop('disabled', false)
                    $.ajax({
                        url: "{{ url('') }}/getSubL/" + id,
                        success: function(res) {
                            $.each(res, function(index, data) {
                                $('#subLokasi').append(
                                    '<option value="' + data.id_subL + '">' + data
                                    .nama_subL + '</option>'
                                )
                            })
                        }
                    })
                }
            });

            var rupiah = document.getElementById('nilai');
            rupiah.addEventListener('keyup', function(e) {
                rupiah.value = formatRupiah(this.value);
            });

            $('#frmAssetIn').on('submit', function(e) {
                e.preventDefault();
                let assets = $('#assets').val();
                assets = ucwords(assets);
                let lokasi = $('#lokasi').val();
                let subL = $('#subLokasi').val();
                let kategori = $('#kategori').val();
                let pemilik = $('#pemilik').val();
                let nilai = $('#nilai').val();
                let luas = $('#luas').val();
                let kode = $('#kodeIn').val();
                kode = kode.toUpperCase();
                nilai = convertToAngka(nilai);
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/assets/load/" + 1,
                    async: false,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = assets.toUpperCase() === data.nama_assets
                                .toUpperCase();
                            if (cekEqual) {
                                if (data.id_lokasi == lokasi && data.id_subLokasi == subL) {
                                    same = 1;
                                }
                            }
                        })
                    }
                });

                if (same == 0) {
                    $.ajax({
                        url: "{{ url('') }}/assets/in",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            assets: assets,
                            lokasi: lokasi,
                            subL: subL,
                            kategori: kategori,
                            pemilik: pemilik,
                            luas: luas,
                            nilai: nilai,
                            kode: kode
                        },
                        success: function(res) {
                            // console.log(res);
                            $('#assetsIn').modal('hide');
                            $("#frmAssetIn")[0].reset();
                            $("#frmAssetIn").unbind().click(function() {});
                            $('#dt_assets').DataTable().ajax.reload();
                            swal({
                                icon: "success",
                                text: res['success']
                            });
                        }
                    });
                    // var stdrp = getDrpzone();


                    $("#frmAssetIn")[0].reset();

                } else if (same == 1) {
                    swal({
                        icon: "warning",
                        text: `(${assets}) dengan Lokasi (${lokasi}) dan Sub Lokasi (${subL})` +
                            " Sudah Terdaftar"
                    });
                    $("#frmAssetIn").unbind().click(function() {});
                }
            });
        }
        // $(document).ready(function() {
        //     $('#assetsIn').on('hidden.bs.modal', function(e) {
        //         if (Dropzone.instances.length > 0) Dropzone.instances.forEach(dz => dz.destroy());
        //     })
        // });
    </script>

    {{-- Input Sub Asset --}}
    <script>
        $(document).ready(function() {
            // Trigger Click Button Tambah Sub Asset
            $("#BTN_ADD_SUB").click(function(event) {
                event.preventDefault();

                // Insial Select 2
                $('#plh_asset').select2({
                    dropdownParent: $('#addSub')
                });

                // Pengisian Select Option Pilih Asset
                $.ajax({
                    url: "{{ url('') }}/assets/load/" + 1,
                    success: function(res) {
                        $("#plh_asset").children().remove();
                        $("#plh_asset").append(
                            '<option selected value="">Pilih Assets</option>');
                        $.each(res, function(index, data) {
                            $('#plh_asset').append(
                                '<option value="' + data.id_assets + '">' + data
                                .nama_assets + '</option>'
                            )
                        })
                    }
                });

                // Javascript Tampilan Input Sub Asset
                var input;
                var html;
                html = `<h4 style="color:#677fe8">Form Penambahan Sub Asset</h4>`;
                input = `<div class="row justify-content-center">
                                        <div class="col-7">
                                            <input type="text" class="form-control" id="sub0"
                                                placeholder="Nama Sub Asset" required="">
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <input type="text" class="form-control" id="kodeS0" maxlength="5"
                                                placeholder="Kode Sub" required="">
                                            <div class="invalid-feedback">
                                                Harus Diisi
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-info"
                                                onclick="myFunction()">+</button>
                                        </div>
                                    </div>`;
                $('#subInput').html(input);
                $('#headerList').html(html);
                // Input Sub Asset Trigger
                $('#frmSubAsset').on('submit', function(e) {
                    e.preventDefault();

                    // Unbind Click Form Input Sub Asset
                    $("#frmSubAsset").unbind().click(function() {});

                    // Insialisasi Array Untuk Asset dan Sub Asset
                    const subAsset = [];
                    const subKode = [];
                    let id = $('#plh_asset').val();
                    let panjang = $('#count').val();

                    // Perulangan Untuk Pengisian Sub Asset
                    for (let index = 0; index <= panjang; index++) {
                        var subFix1 = $('#sub' + index).val();
                        var subKode1 = $('#kodeS' + index).val();
                        subFix1 = ucwords(subFix1);
                        subKode1 = subKode1.toUpperCase();
                        subAsset.push(subFix1);
                        subKode.push(subKode1);
                    }

                    // var areEqual = vendor.toUpperCase() === cek.toUpperCase();
                    // var same = 0;

                    // Ajax Input Sub Asset
                    $.ajax({
                        url: "{{ url('') }}/subAsset/in",
                        type: "POST",
                        dataType: "json",
                        // traditional: true,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            ids: id,
                            subAsset: subAsset,
                            panjang: panjang,
                            subKode: subKode
                        },
                        success: function(res) {
                            document.getElementById("phoneInput").innerHTML = "";
                            $('#addSub').modal('hide');
                            $("#frmSubAsset").unbind().click(function() {});
                            // $(".btn").unbind().click(function() {});
                            $("#frmSubAsset")[0].reset();
                            $('#dt_subAsset').DataTable().ajax.reload();
                            document.getElementById('count').value = 0;
                            swal({
                                icon: "success",
                                text: res['success']
                            });
                            // console.log(panjang)
                        }
                    });
                });
            });
        });
    </script>

    {{-- Detail All Assets --}}
    <script>
        function detail(id) {
            $('html, body').css("cursor", "wait");

            $('#frmSubAsset').on('submit', function(e) {
                e.preventDefault();

                const subAsset = [];
                const subKode = [];
                let panjang = $('#count').val();
                $("#frmSubAsset").unbind().click(function() {});

                for (let index = 0; index <= panjang; index++) {
                    var subFix1 = $('#sub' + index).val();
                    var subKode1 = $('#kodeS' + index).val();
                    subFix1 = ucwords(subFix1);
                    subKode1 = subKode1.toUpperCase();
                    subAsset.push(subFix1);
                    subKode.push(subKode1);
                }
                // var areEqual = vendor.toUpperCase() === cek.toUpperCase();
                var same = 0;

                $.ajax({
                    url: "{{ url('') }}/subAsset/in",
                    type: "POST",
                    dataType: "json",
                    // traditional: true,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        ids: id,
                        subAsset: subAsset,
                        panjang: panjang,
                        subKode: subKode
                    },
                    success: function(res) {
                        document.getElementById("phoneInput").innerHTML = "";
                        $('#addSub').modal('hide');
                        $("#frmSubAsset").unbind().click(function() {});
                        // $(".btn").unbind().click(function() {});
                        $("#frmSubAsset")[0].reset();
                        location.reload();

                        $('#dt_subAsset').DataTable().ajax.reload();
                        document.getElementById('count').value = 0;
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                        // console.log(panjang)
                    }
                });

            });

            $.ajax({
                url: "{{ url('') }}/assetsD/load/" + id,
                success: function(data) {
                    document.getElementById('assetAll').innerHTML = `(${data.nama_assets})`;
                    document.getElementById('lokasiA').innerText = data.nama_lokasi;
                    document.getElementById('subLokasiA').innerText = data.nama_subL;
                    document.getElementById('kategoriA').innerText = data.nama_kategori;
                    document.getElementById('pemilikA').innerText = data.nama_pemilik;
                    var nilaiAsst = formatRupiah(data.nilai_assets, 'Rp.');
                    document.getElementById('nilaiA').innerText = nilaiAsst;
                    document.getElementById('ukuranA').innerHTML = `${data.luas} M<sup>2<sup>`;
                }
            });

            $('#dt_subALL').DataTable().clear();
            $('#dt_subALL').DataTable().destroy();
            $("#dt_subALL").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/subAsset/load/" + id,
                    "dataSrc": "",
                },
                "columnDefs": [{
                    "targets": '_all',
                    "className": "dt-center",
                }],
                "columns": [{
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var namaSub = row['nama_subAsset'];
                            var html = `<a href="#" class="text-dark" data-bs-toggle="modal"
                            data-bs-target="#detailSub" onclick="subDetil('${data}')">
                                    ${namaSub}</a>`;

                            html += `<div class="table-links">
                            <a href="#" data-bs-toggle="modal" id="btnEdit"
                            data-bs-target="#subAssetEdit" onclick="editSub(${data})">
                                    Edit</a>
                                    <div class="bullet"></div>
                                <a href="#" class="text-danger" onclick="deleteSubAsset(${data})">
                                    Hapus</a>
                                </div>`;
                            //
                            return html;
                        }
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-dark" data-bs-toggle="modal"
                                        data-bs-target="#dokumenSubAsset" onclick="dokSubA(${data})"><i class="fas fa-folder"></i>
                                        </button>`;
                            //
                            return html;
                        }
                    }
                ],
            });

            $('#dt_ivenALL').DataTable().clear();
            $('#dt_ivenALL').DataTable().destroy();
            $("#dt_ivenALL").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/assets/getItem/" + id,
                    "dataSrc": "",
                },
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "columns": [{
                        "data": "nama_barang"
                    },
                    {
                        "data": "total"
                    },
                    // {
                    //     "data": "id_barangIven",
                    //     "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                    //         var html = `<button class="btn btn-warning" data-bs-toggle="modal"
                //                     data-bs-target="#labelDetail" onclick="subLabel(${data})"><i class="fas fa-tags"></i>
                //                     </button>`;
                    //         //
                    //         return html;
                    //     }
                    // },
                ],
            });

            $('#dt_inAsset').DataTable().clear();
            $('#dt_inAsset').DataTable().destroy();
            $("#dt_inAsset").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/asset/masuk/" + id,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "kode_label"
                    },
                    {
                        "data": "nama_barang"
                    },
                    {
                        "data": "updated_at",
                        "render": function(data, type, row, meta) {
                            var html = '';
                            var date = new Date(data);
                            var day = date.getDate();
                            var month = date.getMonth() + 1;
                            var year = date.getFullYear();
                            html = [day, month, year].join('/');
                            return html;
                        }
                    }
                ],
            });

            $('#dt_outAsset').DataTable().clear();
            $('#dt_outAsset').DataTable().destroy();
            $("#dt_outAsset").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/asset/keluar/" + id,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "kode_label"
                    },
                    {
                        "data": "nama_barang"
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
                    }
                ],
            });
        }

        $('#detailAll').on('shown.bs.modal', function(e) {
            $('html, body').css("cursor", "auto");
        });
    </script>

    {{-- Get All Label Asset --}}
    <script>
        function getAllLabel(id) {
            $('#dt_labelALL').DataTable().clear();
            $('#dt_labelALL').DataTable().destroy();
            $("#dt_labelALL").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/assets/getLabel/" + id,
                    "dataSrc": "",
                },
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "columns": [{
                        "data": "kode_label",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<a href="#" data-bs-toggle="modal"
                            data-bs-target="#detailLabel" onclick="labelD('${data}')">
                                    ${data}</a>`;
                            //
                            return html;
                        }
                    },
                    {
                        "data": "nama"
                    },
                    {
                        "data": "kode_label",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var assets = row['id_lokasi'];
                            var sub = row['id_subAsset'];
                            var html = `<button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#pindah" onclick="deliv('${data}',${assets},${sub})"><i class="fas fa-truck"></i>
                                        Pindah</button>`;
                            //
                            return html;
                        }
                    },
                ],
            });
        }
    </script>

    {{-- Pindah Barang --}}
    <script>
        function deliv(label, assets, sub) {
            $('#assets0').select2({
                dropdownParent: $("#pindah")
            });
            $('#subA0').select2({
                dropdownParent: $("#pindah")
            });

            var headSub =
                `<h4> Form Keluar Barang</h4>
                        <h4>(${label})</h4><br>`;
            $('#headerPindah').html(headSub);
            // console.log(sub);
            if (sub > 0) {
                $.ajax({
                    url: "{{ url('') }}/subAsset/getLoad/" + sub,
                    success: function(data) {
                        document.getElementById('fromSub0').value = data[0].nama_subAsset;
                        // console.log(data);
                    }
                });
            } else {
                document.getElementById('fromSub0').value = "Tanpa Sub";
            }

            $.ajax({
                url: "{{ url('') }}/assetsD/load/" + assets,
                success: function(data) {
                    document.getElementById('fromAsset0').value = data.nama_assets;
                }
            });

            $.ajax({
                url: "{{ url('') }}/assets/load/" + 1,
                success: function(res) {
                    $("#assets0").children().remove();
                    $("#assets0").append(
                        '<option selected value="">Pilih Lokasi</option>');
                    $.each(res, function(index, x) {
                        if (assets != x.id_assets) {
                            $('#assets0').append(
                                '<option value="' + x.id_assets + '">' + x
                                .nama_assets + '</option>'
                            )
                        }
                    })
                }
            });

            $('#assets0').on('change', function() {
                var id = $(this).val();
                if (id != '' && id != null) {
                    $.ajax({
                        url: "{{ url('') }}/subAsset/load/" + id,
                        success: function(res) {

                            $("#subA0").children().remove();
                            $("#subA0").append(
                                '<option selected value="">Pilih Sub Assets</option>');
                            $("#subA0").append(
                                '<option value="0"> Tanpa Sub</option>');
                            $.each(res, function(index, data) {
                                $('#subA0').append(
                                    '<option value="' + data.id + '">' + data
                                    .nama_subAsset + '</option>'
                                )
                            })
                            $("#subAsset").show();
                        }
                    })
                }
            });

            $('#frmPindahB').on('submit', function(e) {
                var kode = label;
                // var gudang = $('#gudang').val();
                var toAssets = $('#assets0').val();
                var toSub = $('#subA0').val();
                var ids = `<?php echo Session::get('id'); ?>`;
                e.preventDefault();


                let panjang = $('#count').val();
                // for (let index = 0; index <= panjang; index++) {
                //     label.push($('#label' + index).val());
                // }
                // var areEqual = vendor.toUpperCase() === cek.toUpperCase();
                var same = 0;
                // console.log(label);
                $.ajax({
                    url: "{{ url('') }}/assets/pindah",
                    type: "POST",
                    dataType: "json",
                    // traditional: true,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        kode: kode,
                        fromAsset: assets,
                        fromSub: sub,
                        toAssets: toAssets,
                        toSub: toSub,
                        ids: ids
                    },
                    success: function(res) {
                        $('#pindah').modal('hide');
                        $("#frmPindahB")[0].reset();
                        // $('#dt_barangOut').DataTable().ajax.reload();
                        // console.log(res);
                        swal({
                            icon: "success",
                            text: "Barang Sudah Dikeluarkan"
                        });
                        // console.log(res);
                        document.getElementById("labelAdd").innerHTML = "";
                    }
                });
            });
        }
    </script>

    {{-- Edit Asset --}}
    <script>
        function editAssets1(id) {
            $('html, body').css("cursor", "wait");
            $('#assetsEdit').on('shown.bs.modal', function(e) {
                $('html, body').css("cursor", "auto");
            });
            $('#lokasiE').select2({
                dropdownParent: $("#assetsEdit")
            });
            $('#kategoriE').select2({
                dropdownParent: $("#assetsEdit")
            });
            $('#pemilikE').select2({
                dropdownParent: $("#assetsEdit")
            });
            $('#subLokasiE').select2({
                dropdownParent: $("#assetsEdit")
            });

            $("#subLokasiE").children().remove();

            var lokasi;
            var pemilik;
            var kategori;
            var subL;

            $.ajax({
                url: "assetsD/load/" + id,
                async: false,
                success: function(data) {
                    document.getElementById('namaE').value = data.nama_assets;
                    document.getElementById('cek').value = data.nama_assets;
                    document.getElementById('nilaiE').value = data.nilai_assets;
                    document.getElementById('luasE').value = data.luas;
                    document.getElementById('kodeE').value = data.kode_asset;
                    lokasi = data.id_lokasi;
                    pemilik = data.id_pemilik;
                    kategori = data.id_kategori;
                    subL = data.id_subLokasi;
                }
            })

            // tes(lokasi);
            $.ajax({
                url: "{{ url('') }}/lokasi/load/" + 1,
                success: function(res) {
                    $("#lokasiE").children().remove();
                    $("#lokasiE").append(
                        '<option selected value="">Pilih Lokasi</option>');
                    $.each(res, function(index, x) {
                        $('#lokasiE').append(
                            '<option value="' + x.id_lokasi + '">' + x
                            .nama_lokasi + '</option>'
                        )
                    })
                    $("#lokasiE").val(lokasi).change();
                }
            });

            $.ajax({
                url: "{{ url('') }}/kategori/load/" + 1,
                success: function(res) {
                    $("#kategoriE").children().remove();
                    $("#kategoriE").append(
                        '<option selected value="">Pilih Kategori</option>');
                    $.each(res, function(index, x) {
                        $('#kategoriE').append(
                            '<option value="' + x.id_kategori + '">' + x
                            .nama_kategori + '</option>'
                        )
                    })
                    $("#kategoriE").val(kategori).change();
                }
            });

            $.ajax({
                url: "{{ url('') }}/pemilik/load/" + 1,
                success: function(res) {
                    $("#pemilikE").children().remove();
                    $("#pemilikE").append(
                        '<option selected value="">Pilih Pemilik</option>');
                    $.each(res, function(index, x) {
                        $('#pemilikE').append(
                            '<option value="' + x.id_pemilik + '">' + x
                            .nama_pemilik + ` (${x.status})` + '</option>'
                        )
                    })
                    $("#pemilikE").val(pemilik).change();
                }
            });

            $('#lokasiE').on('change', function() {
                var id = $(this).val();
                $("subLokasiE").prop('disabled', true)
                if (id != '' && id != null) {
                    $("subLokasi").prop('disabled', false)
                    $.ajax({
                        url: "{{ url('') }}/getSubL/" + id,
                        success: function(res) {
                            $("#subLokasiE").children().remove();
                            $("#subLokasiE").append(
                                '<option selected value="">Pilih Sub Lokasi</option>');
                            $.each(res, function(index, data) {
                                $('#subLokasiE').append(
                                    '<option value="' + data.id_subL + '">' + data
                                    .nama_subL + '</option>'
                                )
                            })
                            $("#subLokasiE").val(subL).change();
                        }
                    })
                }
            });

            $('#frmEdit').on('submit', function(e) {
                e.preventDefault();
                let assets = $('#namaE').val();
                assets = ucwords(assets);
                let lokasi = $('#lokasiE').val();
                let subL = $('#subLokasiE').val();
                let kategori = $('#kategoriE').val();
                let pemilik = $('#pemilikE').val();
                let nilai = $('#nilaiE').val();
                let luas = $('#luasE').val();
                let kode = $('#kodeE').val();
                kode = kode.toUpperCase();
                let cek = $('#cek').val();
                var areEqual = assets.toUpperCase() === cek.toUpperCase();
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/assets/cek/" + id,
                    async: false,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = assets.toUpperCase() === data.nama_assets
                                .toUpperCase();
                            if (cekEqual) {
                                if (data.id_lokasi == lokasi && data.id_subLokasi == subL) {
                                    if (!areEqual) {
                                        same = 1;
                                    }
                                }
                            }
                        })
                    }
                });

                if (same == 0) {
                    $.ajax({
                        url: "{{ url('') }}/assets/Edit",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            assets: assets,
                            lokasi: lokasi,
                            subL: subL,
                            kategori: kategori,
                            pemilik: pemilik,
                            luas: luas,
                            nilai: nilai,
                            id: id,
                            kode: kode
                        },
                        success: function(res) {
                            // console.log(res);
                            $('#assetsEdit').modal('hide');
                            $("#frmEdit")[0].reset();
                            $("#frmEdit").unbind().click(function() {});
                            $('#dt_assets').DataTable().ajax.reload();
                            swal({
                                icon: "success",
                                text: res['success']
                            });
                        }
                    });

                } else if (same == 1) {
                    swal({
                        icon: "warning",
                        text: `(${assets}) dengan Lokasi (${lokasi}) dan Sub Lokasi (${subL})` +
                            " Sudah Terdaftar"
                    });
                }
            });
        }
    </script>

    {{-- DataTable Js --}}
    <script>
        $(document).ready(function() {
            $('#dt_lokasi').DataTable({
                "scrollX": true,
            });
            $('#dt_kategori').DataTable({
                "scrollX": true,
            });
            $('#dt_pemilik').DataTable({
                "scrollX": true,
            });
            $("#tes").click(function() {
                $("#listLokasi").modal('hide');
            });

        });
    </script>

    {{-- Sub Asset Get All --}}
    <script>
        function getSubAll() {
            $('#dt_subAssetAll').DataTable().clear();
            $('#dt_subAssetAll').DataTable().destroy();
            $("#dt_subAssetAll").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/subAsset/getAll/" + 1,
                    "dataSrc": "",
                },
                "columnDefs": [{
                    "targets": '_all',
                    "className": "dt-center",
                }],
                "columns": [{
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var namaSub = row['nama_subAsset'];
                            var html = `<a href="#" class="text-dark" data-bs-toggle="modal"
                            data-bs-target="#detailSub" onclick="subDetil('${data}')">
                                    ${namaSub}</a>`;

                            html += `<div class="table-links">
                            <a href="#" data-bs-toggle="modal" id="btnEdit"
                            data-bs-target="#subAssetEdit" onclick="editSub(${data})">
                                    Edit</a>
                                    <div class="bullet"></div>
                                <a href="#" class="text-danger" onclick="deleteSubAsset(${data})">
                                    Hapus</a>
                                </div>`;
                            //
                            return html;
                        }
                    },
                    {
                        "data": "id_assets",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var namaAsset = row['nama_assets'];
                            var html = `<a href="#" data-bs-toggle="modal" class="text-dark"
                            data-bs-target="#detailAll" onclick="detail(${data})">
                                    ${namaAsset}</a>`;
                            //
                            return html;
                        }
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#labelDetail" onclick="subLabel(${data})"><i class="fas fa-tags"></i>
                                        </button>`;
                            //
                            return html;
                        }
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-dark" data-bs-toggle="modal"
                                        data-bs-target="#dokumenSubAsset" onclick="dokSubA(${data})"><i class="fas fa-folder"></i>
                                        </button>`;
                            //
                            return html;
                        }
                    },
                ],
            });
        }
    </script>

    {{-- Sub Detail --}}
    <script>
        function subDetil(id) {
            $.ajax({
                url: "{{ url('') }}/subAsset/getLoad/" + id,
                success: function(data) {
                    var add = `<h4>Sub Asset (${data[0].nama_subAsset})</h4>
                    <h4>(${data[0].nama_assets})</h4>
                                `;
                    $('#subHead').html(add);
                }
            });
            $('#dt_SubItem').DataTable().clear();
            $('#dt_SubItem').DataTable().destroy();
            $("#dt_SubItem").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/subAsset/getItem/" + id,
                    "dataSrc": "",
                },
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "columns": [{
                        "data": "nama_barang"
                    },
                    {
                        "data": "total"
                    },
                    // {
                    //     "data": "id_barangIven",
                    //     "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                    //         var html = `<button class="btn btn-primary" data-bs-toggle="modal"
                //                 data-bs-target="#labelList" onclick="subLabel(${id})"><i class="fas fa-tags"></i>
                //                 </button>`;
                    //         //
                    //         return html;
                    //     }
                    // },
                ],
            });
        }
    </script>

    {{-- Sub Asset Get Label --}}
    <script>
        function subLabel(id) {
            $('#dt_labelALL').DataTable().clear();
            $('#dt_labelALL').DataTable().destroy();
            $("#dt_labelALL").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/subAsset/getLabel/" + id,
                    "dataSrc": "",
                },
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "columns": [{
                        "data": "kode_label",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<a href="#" data-bs-toggle="modal"
                            data-bs-target="#detailLabel" onclick="labelD('${data}')">
                                    ${data}</a>`;
                            //
                            return html;
                        }
                    },
                    {
                        "data": "nama_barang"
                    },
                    {
                        "data": "kode_label",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var assets = row['id_lokasi'];
                            var sub = row['id_subAsset'];
                            var html = `<button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#pindah" onclick="deliv('${data}',${assets},${sub})"><i class="fas fa-truck"></i>
                                        Pindah</button>`;
                            //
                            return html;
                        }
                    },
                ],
            });
        }
    </script>

    {{-- Edit Sub Asset --}}
    <script>
        function editSub(id) {
            $.ajax({
                url: "{{ url('') }}/subAsset/getLoad/" + id,
                success: function(data) {
                    var html;
                    var input;
                    headSub =
                        `<h4> Lokasi Asset</h4>
                        <h4>(${data[0].nama_assets})</h4><br>`;
                    $('#headSubEdit').html(headSub);
                    document.getElementById('editSubAsset').value = data[0].nama_subAsset;
                    document.getElementById('Kode_SubAsset_E').value = data[0].kode_sub;
                }
            })
            $("#frmEditSubAsset").unbind().click(function() {});

            $('#frmEditSubAsset').on('submit', function(e) {
                e.preventDefault();

                var subAsset = $('#editSubAsset').val();
                var subKode = $('#Kode_SubAsset_E').val();

                // var areEqual = vendor.toUpperCase() === cek.toUpperCase();
                var same = 0;

                $.ajax({
                    url: "{{ url('') }}/subAsset/edit/" + id,
                    type: "POST",
                    dataType: "json",
                    // traditional: true,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        ids: id,
                        subAsset: subAsset,
                        subKode: subKode
                    },
                    success: function(res) {
                        document.getElementById("phoneInput").innerHTML = "";
                        $('#subAssetEdit').modal('hide');
                        $("#frmEditSubAsset").unbind().click(function() {});
                        // $(".btn").unbind().click(function() {});
                        $("#frmSubAsset")[0].reset();
                        location.reload();

                        $('#dt_subAsset').DataTable().ajax.reload();
                        document.getElementById('count').value = 0;
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                        // console.log(panjang)
                    }
                });

            });
        }
    </script>

    {{-- Dokumentasi Sub Asset --}}
    <script>
        function dokSubA(id) {
            $.ajax({
                url: "{{ url('') }}/getAssetSub/load/" + id,
                success: function(data) {
                    var html;
                    // var x = data.status;
                    html = `<h4 style="color:#677fe8">Dokumentasi Sub Asset ${data.nama_subAsset}</h4>
                        <h4>(${data.nama_assets} Lokasi ${data.nama_lokasi} Sub Lokasi ${data.nama_subL})</h4>
                        <br>`;
                    $('#SubAssetDok').html(html);
                }
            })

            $('#dt_dokSubA').DataTable().clear();
            $('#dt_dokSubA').DataTable().destroy();
            $("#dt_dokSubA").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/dokSubA/load/" + id,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "path",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var namaFile = row['nama_file'];
                            var html = `<a href="{{ url('') }}/${data}" class="text-dark" target="_blank">
                                        ${namaFile}</a>`;
                            //
                            return html;
                        }
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-danger" onclick="deleteSubDok(${data})"><i class="fas fa-trash-alt"></i>
                                        Del</button>`;
                            //
                            return html;
                        }
                    }
                ],
            });

            var count = 0;
            Dropzone.autoDiscover = false;
            var uploadedDocumentMap = {}
            var myDropzone1 = new Dropzone("div#myDropSub", {
                url: "{{ url('') }}/subAsset/storeMedia",
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
                            $('#dt_dokSubA').DataTable().ajax.reload();
                        })
                }
            });
        }
        $(document).ready(function() {
            $('#dokumenSubAsset').on('hidden.bs.modal', function(e) {
                if (Dropzone.instances.length > 0) Dropzone.instances.forEach(dz => dz.destroy());
            })
        });
    </script>

    {{-- Dokumentasi Asset --}}
    <script>
        function dokumentasi(id) {
            $.ajax({
                url: "{{ url('') }}/assetsD/load/" + id,
                success: function(data) {
                    var html;
                    // var x = data.status;
                    html = `<h4 style="color:#677fe8">Dokumentasi</h4>
                        <h4>(${data.nama_assets} Lokasi ${data.nama_lokasi} Sub Lokasi ${data.nama_subL})</h4>
                        <br>`;
                    $('#headerDok').html(html);
                }
            })

            $('#dt_dokumen').DataTable().clear();
            $('#dt_dokumen').DataTable().destroy();
            $("#dt_dokumen").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/dokumen/load/" + id,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "path",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var namaFile = row['nama_file'];
                            var html = `<a href="{{ url('') }}/${data}" class="text-dark" target="_blank">
                                        ${namaFile}</a>`;
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

            var count = 0;
            Dropzone.autoDiscover = false;
            var uploadedDocumentMap = {}
            var myDropzone1 = new Dropzone("div#myDrop", {
                url: "{{ url('') }}/assetsB/storeMedia",
                maxFilesize: 12,
                // autoProcessQueue: false,
                parallelUploads: 5,
                renameFile: function(file) {
                    var dt = new Date();
                    let time = dt.getTime();
                    var spar = "_";
                    return time + spar + file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.docx",
                addRemoveLinks: true,
                timeout: 5000,
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

            $('#dokumenA').on('hidden.bs.modal', function(e) {
                if (Dropzone.instances.length > 0) Dropzone.instances.forEach(dz => dz.destroy());
            })
        });
    </script>

    {{-- Delete Assets --}}
    <script>
        function deleteAssets(id) {
            var cekData = 0;
            $.ajax({
                url: "{{ url('') }}/label/load/" + 1,
                async: false,
                success: function(res) {
                    // console.log(res);
                    $.each(res, function(index, x) {
                        if (x.id_lokasi == id) {
                            cekData = 1;
                        }
                    })

                }
            });

            if (cekData == 1) {
                swal({
                    icon: "warning",
                    text: "Data Tidak Bisa Dihapus, Karena Telah Digunakan Proses Lain"
                });
            } else {
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
                                url: "{{ url('') }}/del/assets/" + id,
                                success: function() {
                                    $('#dt_assets').DataTable().ajax.reload();
                                    swal("Berhasil Dihapus!", {
                                        icon: "success",
                                    });
                                }
                            });
                        } else {
                            swal("Data Tidak Jadi Dihapus!");
                        }
                    });
            }
        }
    </script>

    {{-- Delete Sub Asset --}}
    <script>
        function deleteSubAsset(id) {
            var cekData = 0;
            // $.ajax({
            //     url: "{{ url('') }}/pesanan/load/" + 1,
            //     async: false,
            //     success: function(res) {
            //         // console.log(res);
            //         $.each(res, function(index, x) {
            //             if (x.id_lokasi == id) {
            //                 cekData = 1;
            //             }
            //         })

            //     }
            // });

            if (cekData == 1) {
                swal({
                    icon: "warning",
                    text: "Data Tidak Bisa Dihapus, Karena Telah Digunakan Proses Lain"
                });
            } else {
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
                                url: "{{ url('') }}/del/subAsset/" + id,
                                success: function() {
                                    $('#dt_subAsset').DataTable().ajax.reload();
                                    $('#dt_subAssetAll').DataTable().ajax.reload();
                                    swal("Berhasil Dihapus!", {
                                        icon: "success",
                                    });
                                }
                            });
                        } else {
                            swal("Data Tidak Jadi Dihapus!");
                        }
                    });
            }
        }
    </script>

    {{-- Delete Dokumen --}}
    <script>
        function deleteDok(id) {
            var cekData = 0;
            // $.ajax({
            //     url: "{{ url('') }}/pesanan/load/" + 1,
            //     async: false,
            //     success: function(res) {
            //         // console.log(res);
            //         $.each(res, function(index, x) {
            //             if (x.id_lokasi == id) {
            //                 cekData = 1;
            //             }
            //         })

            //     }
            // });

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
                            url: "{{ url('') }}/del/dok/" + id,
                            success: function() {
                                $('#dt_dokumen').DataTable().ajax.reload();
                                swal("Berhasil Dihapus!", {
                                    icon: "success",
                                });
                            }
                        });
                    } else {
                        swal("Data Tidak Jadi Dihapus!");
                    }
                });

        }
    </script>

    {{-- Delete Sub Asset Dokumen --}}
    <script>
        function deleteSubDok(id) {
            var cekData = 0;

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
                            url: "{{ url('') }}/del/subAssetdok/" + id,
                            success: function() {
                                $('#dt_dokSubA').DataTable().ajax.reload();
                                swal("Berhasil Dihapus!", {
                                    icon: "success",
                                });
                            }
                        });
                    } else {
                        swal("Data Tidak Jadi Dihapus!");
                    }
                });

        }
    </script>

    {{-- Auto Add Sub Asset --}}
    <script>
        function myFunction() {
            var count = document.getElementById("count").value;
            count++;
            var phoneNumber = document.getElementById("phoneInput");
            var div = document.createElement("div");

            div.innerHTML = `<div class="form-group row" class="tes" id="tes${count}">
                <div class="row justify-content-center">
                            <div class="col-7">
                                <input type="text" class="form-control" name="nomorHp${count}" id="sub${count}" placeholder="Sub Asset" required="" >
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control" name="kodeS${count}" id="kodeS${count}" placeholder="Kode Sub" required="" maxlength="5" >
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-danger" onclick="close1()">-
                                </button>
                            </div>
                        </div>
                        </div>
                    </div>`;
            phoneNumber.appendChild(div);
            document.getElementById("count").value = count;
        }

        function close1() {

            var countE = document.getElementById("count").value;
            var elem = document.getElementById(`tes${countE}`);
            elem.remove();
            countE--;
            document.getElementById("count").value = countE;
        }
    </script>

    {{-- Sub Lokasi Edit --}}
    <script>
        $(document).ready(function() {
            $('#lokasi1').on('change', function() {
                var id = $(this).val();
                $("#subLokasi1").children().remove();
                $("#subLokasi1").append('<option selected value="">Pilih Sub Lokasi</option>');
                // $("#subLokasi1").prop('disabled', true)
                if (id != '' && id != null) {
                    // $("subLokasi").prop('disabled', false)
                    $.ajax({
                        url: "{{ url('') }}/getSubL/" + id,
                        success: function(res) {
                            $.each(res, function(index, data) {
                                $('#subLokasi1').append(
                                    '<option value="' + data.id_subL + '">' + data
                                    .nama_subL + '</option>'
                                )
                            })

                        }
                    })
                }

            });
        });
    </script>

    {{-- Label Barang Detail --}}
    <script>
        function labelD(kode) {
            $('html, body').css("cursor", "wait");
            // var kode = document.getElementById('kode_label').value;
            var id_order = "";
            var id_cek = "";
            document.getElementById('labelHead').innerText = `(${kode})`;
            $.ajax({
                url: "{{ url('') }}/label/load/" + 1,
                async: false,
                success: function(res) {
                    $.each(res, function(index, x) {
                        if (x.kode_label == kode) {
                            id_order = x.id_orders;
                        }
                    })
                }
            });

            $.ajax({
                url: "{{ url('') }}/assets/getTime/" + id_order,
                async: false,
                success: function(res) {

                    document.getElementById('tgl_pesan').innerText = formatTime(res.tgl_pesan);
                    document.getElementById('tgl_cek').innerText = formatTime(res.tgl_cek);
                    document.getElementById('tgl_setuju').innerText = formatTime(res.tgl_valid);
                    document.getElementById('tgl_beli').innerText = formatTime(res.tgl_beli);
                }
            });

            function formatTime(tgl) {
                var day, month, year;
                var date = new Date(tgl);
                day = date.getDate();
                month = date.getMonth() + 1;
                year = date.getFullYear();
                fix = [day, month, year].join('/');
                return fix;
            }

            $.ajax({
                url: "{{ url('') }}/cartLoad/detail/" + id_order,
                async: false,
                success: function(res) {
                    console.log(res);
                    document.getElementById('namaBarang').innerText = res[0].nama_barang;
                    document.getElementById('modelBarang').innerText = res[0].model;
                    document.getElementById('merkBarang').innerText = res[0].merk;
                    document.getElementById('warnaBarang').innerText = res[0].warna;
                }
            });

            $('#detailLabel').on('shown.bs.modal', function(e) {
                $('html, body').css("cursor", "auto");
            });

            $('#dt_perawatan').DataTable().clear();
            $('#dt_perawatan').DataTable().destroy();
            $("#dt_perawatan").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
            });

            $('#dt_perbaikan').DataTable().clear();
            $('#dt_perbaikan').DataTable().destroy();
            $("#dt_perbaikan").DataTable({
                "scrollX": true,
            });

            $('#dt_histori').DataTable().clear();
            $('#dt_histori').DataTable().destroy();
            $("#dt_histori").DataTable({
                "scrollX": true,
            });

            $('#dt_inAsset1').DataTable().clear();
            $('#dt_inAsset1').DataTable().destroy();
            $("#dt_inAsset1").DataTable({
                "scrollX": 200,
                "processing": true,
                "ajax": {
                    "url": "{{ url('') }}/label/masuk/" + 1,
                    "dataSrc": "",
                    "data": {
                        "_token": "{{ csrf_token() }}",
                        kode: kode,
                    },
                },

                "columns": [{
                        "data": "nama_assets"
                    },
                    {
                        "data": "id_toSub",
                        "render": function(data, type, row, meta) {
                            var html = '';

                            if (data != 0) {
                                var currentCell = $("#dt_inAsset1").DataTable().cells({
                                    "row": meta.row,
                                    "column": meta.col
                                }).nodes(0);
                                $.ajax({
                                    url: "{{ url('') }}/getAssetSub/load/" + data,
                                }).done(function(res) {
                                    $(currentCell).text(res.nama_subAsset);
                                });
                                return null;

                            } else {
                                html = 'Tanpa Sub';
                                return html;
                            }
                        }
                    },
                    {
                        "data": "updated_at",
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
                ],
            })

            $('#dt_outAsset1').DataTable().clear();
            $('#dt_outAsset1').DataTable().destroy();
            $("#dt_outAsset1").DataTable({
                "scrollX": 200,
                "processing": true,
                "ajax": {
                    "url": "{{ url('') }}/label/masuk/" + 1,
                    "dataSrc": "",
                    "data": {
                        "_token": "{{ csrf_token() }}",
                        kode: kode,
                    },
                },

                "columns": [{
                        "data": "nama_assets"
                    },
                    {
                        "data": "id_fromSub",
                        "render": function(data, type, row, meta) {
                            var html = '';

                            if (data != 0) {
                                var currentCell = $("#dt_outAsset1").DataTable().cells({
                                    "row": meta.row,
                                    "column": meta.col
                                }).nodes(0);
                                $.ajax({
                                    url: "{{ url('') }}/getAssetSub/load/" + data,
                                }).done(function(res) {
                                    $(currentCell).text(res.nama_subAsset);
                                });
                                return null;

                            } else {
                                html = 'Tanpa Sub';
                                return html;
                            }
                        }
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
                ],
            })
        }
    </script>

    {{-- Validasi Cek Up --}}
    <script>
        function valid(id) {
            var cekData = 0;
            var ids = `<?php echo Session::get('id'); ?>`;
            $.ajax({
                url: "{{ url('') }}/label/load/" + 1,
                async: false,
                success: function(res) {
                    // console.log(res);
                    $.each(res, function(index, x) {
                        if (x.id_lokasi == id) {
                            cekData = 1;
                        }
                    })

                }
            });

            if (cekData == 1) {
                swal({
                    icon: "warning",
                    text: "Data Tidak Bisa Dihapus, Karena Telah Digunakan Proses Lain"
                });
            } else {
                swal({
                        title: "Kamu Yakin?",
                        text: "Sekali Setuji Anda Tidak Bisa Mengembalikannya!",
                        icon: "warning",
                        buttons: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "{{ url('') }}/assets/valid/" + id,
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    ids: ids
                                },
                                success: function() {
                                    $('#dt_cekBarang').DataTable().ajax.reload();
                                    swal("Berhasil DiSetujui!", {
                                        icon: "success",
                                    });
                                }
                            });
                        } else {
                            swal("Data Tidak Jadi Di Setujui!");
                        }
                    });
            }
        }
    </script>
@endpush
