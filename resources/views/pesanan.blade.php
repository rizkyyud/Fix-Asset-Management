@extends('layouts\master')
@section('header-form')
    <h1>Pemesanan Barang</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="\">Home</a></div>
        <div class="breadcrumb-item">Pesanan</div>
    </div>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header card text-center">
            {{-- <h4> </h4> --}}
            <br>
            <div class="card-header-action">
                <a href="#" class="btn btn-primary" id="pilih" onclick="listItem()">Pilih Barang</a>
                <a href="#" class="btn btn-primary" id="btnKeranjang" onclick="cart()">Keranjang</a>
                <a href="#" class="btn btn-primary" id="btnListKer" onclick="listPesan()">List Pesanan</a>
            </div>
        </div>

        <div class="card-body">
            <div class="tab-content tab-bordered" id="isiKeranjang">
                <div class="tab-pane fade show active">
                    <div class="card">
                        <div class="card-body" id="showItem">
                            <div class="card-header card text-center">
                                <h4 id="judul" style="color: #023e8a"></h4>
                            </div>
                            <div class="container" style="margin-top: -25px; margin-bottom:75px;">
                                <div class="row justify-content-center">
                                    <div class="btn-group btn-group" role="group" aria-label="Basic example">
                                        <div class="col-md-12 text-center">
                                            <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#barangIn" onclick="barangNew()" id="addNew">
                                                <i class="fas fa-calendar-plus"></i> Tambah Barang
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row filter-row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group form-focus">
                                        <label>Klasifikasi</label>
                                        <select class="form-control" id="filKate">
                                            <option value="">Pilih Klasifikasi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group form-focus">
                                        <label>Kategori</label>
                                        <select class="form-control" id="filTipe">
                                            <option value="">Pilih Kategori</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="dt_barang" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;"
                                aria-describedby="example_info">
                                <br>
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Model</th>
                                        <th>Merk</th>
                                        <th>Warna</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-body" id="showCart">
                            <div class="card-header card text-center">
                                <h4 id="judul" style="color: #023e8a"> Isi Keranjang</h4>
                            </div>
                            <table id="dt_wish" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;"
                                aria-describedby="example_info">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Alasan</th>
                                    </tr>
                                </thead>
                            </table>
                            <br><br>
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-primary" id="pesanB" onclick="pesan()">Pesan
                                    Barang</button>
                            </div>
                        </div>
                        <div class="card-body" id="showOrderL">
                            <div class="card-header card text-center">
                                <h4 id="judul" style="color: #023e8a"> List Pesanan</h4>
                            </div>
                            <table id="dt_orderL" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;"
                                aria-describedby="example_info">
                                <thead>
                                    <tr>
                                        <th>Detail</th>
                                        <th>Tanggal Pesan</th>
                                        <th>Status</th>
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
@include('Modal\pesananModal')

@push('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

    {{-- Dokumen Load --}}
    <script>
        $(document).ready(function() {
            $('#showCart').hide();
            $('#showOrderL').hide();
            document.getElementById('judul').innerHTML = 'List Barang';
            document.getElementById("pilih").style.backgroundColor = "#394eea";

            $("#subIn").hide();

            $.ajax({
                url: "{{ url('') }}/kateBarang/load/" + 1,
                success: function(res) {
                    $("#filTipe").children().remove();
                    $("#filTipe").append(
                        '<option selected value="0">Pilih Kategori Barang</option>');
                    $.each(res, function(index, data) {
                        $('#filTipe').append(
                            '<option value="' + data.id_barangIven + '">' + data
                            .nama_barang + '</option>'
                        )
                    })
                    $('#filTipe').select2({});
                }
            });

            $.ajax({
                url: "{{ url('') }}/jenis/load/" + 1,
                success: function(res) {
                    $("#filKate").children().remove();
                    $("#filKate").append(
                        '<option selected value="0">Pilih Klasifikasi Barang</option>');
                    $.each(res, function(index, data) {
                        $('#filKate').append(
                            '<option value="' + data.id_jenisIven + '">' + data
                            .jenis_iventaris + '</option>'
                        )
                    })
                    $('#filKate').select2({});
                }
            });

            var tipe = 0,
                kate = 0;
            $('#filTipe').on('change', function() {
                tipe = $("#filTipe").val();
                kate = $("#filKate").val();
                filterData(kate, tipe);
            });

            $('#filKate').on('change', function() {
                tipe = $("#filTipe").val();
                kate = $("#filKate").val();
                filterData(kate, tipe);
            });

            $('#dt_barang').DataTable().clear();
            $('#dt_barang').DataTable().destroy();
            $("#dt_barang").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "ajax": {
                    "url": "{{ url('') }}/barang/load/" + 1,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var nama = row['nama'];
                            var html = '';
                            var cekData = 0;
                            html +=
                                `<div class="container">
                                        <div class="col-12" style="margin-top: 5px;">
                                            <a> ${nama} </a>
                                        </div>
                                        <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                            <button onclick="itemAdd(${data},'${nama}')" data-bs-toggle="modal" data-bs-target="#itemIn" class="btn btn-icon btn-success" id="btnAddItem"><i class="fas fa-cart-arrow-down"></i></button>
                                        </div>
                                </div>`;
                            return html;
                        }
                    },
                    {
                        "data": "kategori"
                    },
                    {
                        "data": "merk"
                    },
                    {
                        "data": "model"
                    },
                    {
                        "data": "warna"
                    }
                ],
            })
        });

        function filterData(kate, tipe) {
            $('#dt_barang').DataTable().clear();
            $('#dt_barang').DataTable().destroy();
            $("#dt_barang").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "ajax": {
                    "url": "{{ url('') }}/filter/barang/" + 1,
                    "dataSrc": "",
                    "data": {
                        kate: kate,
                        tipe: tipe
                    }
                },
                "columns": [{
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var nama = row['nama'];
                            var html = '';
                            var cekData = 0;
                            html +=
                                `<div class="container">
                                        <div class="col-12" style="margin-top: 5px;">
                                            <a> ${nama} </a>
                                        </div>
                                        <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                            <button onclick="itemAdd(${data},'${nama}')" data-bs-toggle="modal" data-bs-target="#itemIn" class="btn btn-icon btn-success" id="btnAddItem"><i class="fas fa-cart-arrow-down"></i></button>
                                        </div>
                                </div>`;
                            return html;
                        }
                    },
                    {
                        "data": "kategori"
                    },
                    {
                        "data": "tipe"
                    },
                    {
                        "data": "merk"
                    },
                    {
                        "data": "model"
                    },
                    {
                        "data": "warna"
                    }
                ],
            })
        }
    </script>

    {{-- Keranjang --}}
    <script>
        function cart() {

            document.getElementById('judul').innerHTML = 'Isi Keranjang';
            document.getElementById("btnKeranjang").style.backgroundColor = "#394eea";
            document.getElementById("pilih").style.backgroundColor = "#6777f0";
            document.getElementById("btnListKer").style.backgroundColor = "#6777f0";
            var ids = `<?php echo Session::get('id'); ?>`;
            $('#showCart').show();
            $('#showItem').hide();
            $('#showOrderL').hide();

            $('#dt_wish').DataTable().clear();
            $('#dt_wish').DataTable().destroy();
            var table = $("#dt_wish").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "ajax": {
                    "url": "{{ url('') }}/pesanan/wishList/" + 1,
                    "dataSrc": "",
                    "data": {
                        "_token": "{{ csrf_token() }}",
                        ids: ids
                    },
                    "async": false
                },
                "columns": [{
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var nama = row['nama'];
                            var cekData = row['cekData'];
                            var html = '';
                            // var cekData = 0;
                            html +=
                                `<div class="container">
                                        <div class="col-12" style="margin-top: 5px;">
                                            <a> ${nama} </a>
                                        </div>
                                        <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                            <button onclick="deleteWish(${data},${cekData})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#dokumenOrd" onclick="dokOrder(${data})"><i class="fas fa-folder"></i>
                                        </button>
                                        </div>
                                </div>`;
                            return html;
                        }
                    },
                    {
                        "data": "jumlah"
                    },
                    {
                        "data": "harga",
                        render: $.fn.dataTable.render.number(',', '.', 2, 'Rp')
                    },
                    {
                        "data": "alasan"
                    }
                ],
            })
            // var isEmpty = dt_wish.rows().count() === 0;
            var cekRow = 0;
            $('#pesanB').show();
            var panjang = table.data().count();
            if (panjang == 0) {
                $('#pesanB').hide();
            }
        }
    </script>

    {{-- Dokumentasi Pesanan --}}
    <script>
        function dokOrder(id) {
            var status = '';
            $.ajax({
                url: "{{ url('') }}/cartLoad/detail/" + id,
                async: false,
                success: function(data) {
                    var html;
                    console.log(data);
                    // var x = data.status;
                    html = `<h4 style="color:#677fe8">Dokumentasi</h4>
                <h4>( Kode ${data[0].kode_order} Dan Nama Barang ${data[0].nama_barang} )</h4>
                <br>`;
                    $('#headerDok').html(html);
                    status = data[0].status;
                }
            })

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

            if (status == "List") {
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
                $('#dropZone').show();
            } else {
                $('#dropZone').hide();
            }

        }

        $(document).ready(function() {
            $('#dokumenOrd').on('hidden.bs.modal', function(e) {
                if (Dropzone.instances.length > 0) Dropzone.instances.forEach(dz => dz.destroy());
            })
        });
    </script>

    {{-- List Pesanan --}}
    <script>
        function listPesan() {
            document.getElementById('judul').innerHTML = 'List Pesanan';
            document.getElementById("btnListKer").style.backgroundColor = "#394eea";
            document.getElementById("btnKeranjang").style.backgroundColor = "#6777f0";
            document.getElementById("pilih").style.backgroundColor = "#6777f0";
            var ids = `<?php echo Session::get('id'); ?>`;

            $('#showCart').hide();
            $('#showItem').hide();
            $('#showOrderL').show();
            $("#btnListKer").unbind().click(function() {});

            $('#dt_orderL').DataTable().clear();
            $('#dt_orderL').DataTable().destroy();
            var table = $("#dt_orderL").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "order": [
                    [1, 'desc']
                ],
                "ajax": {
                    "url": "{{ url('') }}/pesanan/List/" + 1,
                    "dataSrc": "",
                    "data": {
                        ids: ids
                    }
                },
                "columns": [{
                        "className": 'dt-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
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
                        "data": "status"
                    }
                ],
            });

            // $('#dt_orderL tbody').off('click', 'td.details-control');
            $("#dt_orderL tbody").unbind().click(function() {});
            $('#dt_orderL tbody').on('click', 'td.dt-control', function(e) {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var parentRow = $(this).closest("tr").prev()[0];
                var rowData = table.row(parentRow).data();
                var idr = row.data().id;
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format(row.data(), idr)).show();
                    tr.addClass('shown');
                }
            });
        }

        function format(d, id) {
            // var id = d.id;
            // `d` is the original data object for the row
            let html = `<table class="table table-bordered table-md align-middle">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Dokumen</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Last Update</th>
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
                        var update = [day, month, year].join('/');
                        html += `<tr>
                                    <td>
                                        <a> ${data.nama} </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#dokumenOrd" onclick="dokOrder(${data})"><i class="fas fa-folder"></i>
                                        </button>
                                    </td>
                                    <td>${data.jumlah}</td>
                                    <td><div class="badge badge-success">Active</div></td>
                                    <th>${update}</th>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target="#detailOrd" onclick="detailOrd('${data.id}','${data.kode}')" class="btn btn-primary">Detail</a></td>
                                </tr>`;
                    })
                    html += `</tbody>`;
                }
            })
            html += `</table>`;
            return html;
        }
    </script>

    {{-- List Barang --}}
    <script>
        function listItem() {
            document.getElementById('judul').innerHTML = 'List Barang';
            document.getElementById("btnKeranjang").style.backgroundColor = "#6777f0";
            document.getElementById("pilih").style.backgroundColor = "#394eea";
            document.getElementById("btnListKer").style.backgroundColor = "#6777f0";
            $('#showCart').hide();
            $('#showItem').show();
            $('#showOrderL').hide();
            // $('#addNew').show();
        }
    </script>

    {{-- New Barang --}}
    <script>
        function barangNew() {
            $('#addMerk').hide();
            $('#addModel').hide();
            $('#addWarna').hide();
            $('#addNew').show();
            document.getElementById('headNew').innerHTML = 'Penambahan Barang Baru';
            
            // Select 2 Barang In
            $("#drpModel").select2({
                dropdownParent: $("#barangIn")
            })

            $("#drpMerk").select2({
                dropdownParent: $("#barangIn")
            })

            $("#drpWarna").select2({
                dropdownParent: $("#barangIn")
            })

            $("#drpKate").select2({
                dropdownParent: $("#barangIn")
            })
            $('#plhMerk').select2({
                dropdownParent: $('#barangIn')
            });
            
            // Load Dropdown
            $.ajax({
                url: "{{ url('') }}/kateBarang/load/" + 1,
                success: function(res) {
                    $("#drpKate").children().remove();
                    $("#drpKate").append(
                        '<option selected value="">Pilih Kategori Barang</option>');
                    $.each(res, function(index, data) {
                        $('#drpKate').append(
                            '<option value="' + data.id_barangIven + '">' + data
                            .nama_barang + '</option>'
                        )
                    })
                }
            });

            $.ajax({
                url: "{{ url('') }}/modelB/load/" + 1,
                success: function(res) {
                    $("#drpModel").children().remove();
                    $("#drpModel").append(
                        '<option selected value="">Pilih Model Barang</option>');
                    $.each(res, function(index, data) {
                        $('#drpModel').append(
                            '<option value="' + data.id + '">' + data
                            .model + '</option>'
                        )
                    })
                }
            });

            $.ajax({
                url: "{{ url('') }}/merk/load/" + 1,
                success: function(res) {
                    $("#drpMerk").children().remove();
                    $("#drpMerk").append(
                        '<option selected value="">Pilih Merk Barang</option>');
                    $.each(res, function(index, data) {
                        $('#drpMerk').append(
                            '<option value="' + data.id + '">' + data
                            .merk + '</option>'
                        )
                    })
                }
            });

            $.ajax({
                url: "{{ url('') }}/warna/load/" + 1,
                success: function(res) {
                    $("#drpWarna").children().remove();
                    $("#drpWarna").append(
                        '<option selected value="">Pilih Warna Barang</option>');
                    $.each(res, function(index, data) {
                        $('#drpWarna').append(
                            '<option value="' + data.id + '">' + data
                            .warna + '</option>'
                        )
                    })
                }
            });

            var nama_barang, nama_merk = "XXX",
                nama_kate = "XXX",
                nama_model = "XXX";

            $("#drpKate").change(function() {
                nama_kate = $("#drpKate :selected").text();
                nama_barang = `${nama_kate}-${nama_merk}-${nama_model}`
                $('#barangAdd').val(nama_barang).change();
            });

            $("#drpMerk").change(function() {
                nama_merk = $("#drpMerk :selected").text();
                nama_barang = `${nama_kate}-${nama_merk}-${nama_model}`
                $('#barangAdd').val(nama_barang).change();
            });

            $("#drpModel").change(function() {
                nama_model = $("#drpModel :selected").text();
                nama_barang = `${nama_kate}-${nama_merk}-${nama_model}`
                $('#barangAdd').val(nama_barang).change();
            });

            $('#frmBrgAdd').on('submit', function(e) {
                e.preventDefault();
                $("#frmBrgAdd").unbind().click(function() {});
                let barang = $('#barangAdd').val();
                let kategori = $('#drpKate').val();
                let model = $('#drpModel').val();
                let merk = $('#drpMerk').val();
                let warna = $('#drpWarna').val();
                let ukuran = $('#ukuranAdd').val();
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/barang/load/" + 1,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = barang.toUpperCase() === data.nama.toUpperCase();
                            if (cekEqual) {
                                same = 1;
                            }
                        })

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/barang/in",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    barang: barang,
                                    model: model,
                                    kategori: kategori,
                                    merk: merk,
                                    warna: warna,
                                    ukuran: ukuran
                                },
                                success: function(res) {
                                    // console.log(res);
                                    $('#barangIn').modal('hide');
                                    $("#frmBrgAdd")[0].reset();
                                    $('#dt_barang').DataTable().ajax.reload();
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                }
                            });
                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: barang + " Sudah Terdaftar"
                            });
                        }
                    }
                });
            });
        }
    </script>

    {{-- Add Item --}}
    <script>
        function itemAdd(barang, nama) {
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

            // Asset Drop Down
            $.ajax({
                url: "{{ url('') }}/assets/load/" + barang,
                type: "GET",
                success: function(res) {
                    $("#assetIn").children().remove();
                    $("#assetIn").append('<option selected value="">Pilih Asset</option>');
                    $.each(res, function(index, data) {
                        $('#assetIn').append(
                            `<option value="${data.id_assets}"> ${data.nama_assets} Lokasi (${data.nama_lokasi}) Sub Lokasi (${data.nama_subL}) </option>`
                        )
                    })
                }
            })

            // Sub Asset Drop Down
            $('#assetIn').on('change', function() {
                var id = $(this).val();
                $("#subIn").children().remove();
                $("#subIn").append('<option selected value="">Pilih Sub Asset</option>');

                if (id != '' && id != null) {
                    $.ajax({
                        url: "{{ url('') }}/subAsset/load/" + id,
                        type: "GET",
                        success: function(res) {
                            $("#subIn").children().remove();
                            $('#subIn').append(`<option value="0">Tanpa Sub</option>`)
                            $.each(res, function(index, data) {
                                $('#subIn').append(
                                    '<option value="' + data.id + '">' + data
                                    .nama_subAsset + '</option>'
                                )
                            })
                        }
                    })
                }
            });

            // Vendor Dropdown
            $.ajax({
                url: "{{ url('') }}/pesanan/getVendor/" + barang,
                type: "GET",
                success: function(res) {
                    var vendorDef = `Vendor Kosong`;
                    $('#vendorIn').append(
                        '<option value="' + 0 + '">' +
                        vendorDef + '</option>'
                    )
                    $.each(res, function(index, data) {
                        $('#vendorIn').append(
                            `<option value=${data.id_vendor}>${data.nama_vendor}</option>`
                        )
                    })
                }
            })

            // Reset Form
            $('#itemIn').on('hidden.bs.modal', function() {
                $("#frmItemAdd")[0].reset();
            });

            $('#frmItemAdd').on('submit', function(e) {
                e.preventDefault();
                $("#frmItemAdd").unbind().click(function() {});
                let nama = $('#namaB').val();
                let asset = $('#assetIn').val();
                let alasan = $('#alasanIn').val();
                let harga = $('#hargaIn').val();
                let jumlah = $('#jlhIn').val();
                let sub = $('#subIn').val();
                let vendor = $('#vendorIn').val();
                var ids = `<?php echo Session::get('id'); ?>`;

                $.ajax({
                    url: "{{ url('') }}/pesanan/in",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        barang: barang,
                        asset: asset,
                        alasan: alasan,
                        harga: harga,
                        jumlah: jumlah,
                        sub: sub,
                        ids: ids,
                        vendor: vendor
                    },
                    success: function(res) {
                        $('#itemIn').modal('hide');
                        $("#frmItemAdd")[0].reset();
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });
            });
        }
    </script>

    {{-- Pesan Barang --}}
    <script>
        function pesan() {
            var ids = `<?php echo Session::get('id'); ?>`;
            swal({
                    title: "Pesan Barang?",
                    text: "Sekali Masuk Antrian, Pesanan Tidak Dapat Dirubah!",
                    icon: "info",
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ url('') }}/pesanan/req",
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                ids: ids
                            },
                            success: function(res) {
                                $('#dt_wish').DataTable().ajax.reload();
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

    {{-- Tambah Model --}}
    <script>
        function modelAdd() {
            // this.preventDefault();
            $('#addMerk').hide();
            $('#addModel').show();
            $('#addWarna').hide();
            $('#addNew').hide();
            document.getElementById('headNew').innerHTML = 'Penambahan Model Baru';
            $('#frmModelAdd').on('submit', function(e) {
                e.preventDefault();

                let model = $('#modelAdd').val();
                let kode = $('#kodeModel').val();
                var ids = `<?php echo Session::get('id'); ?>`;
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/modelB/load/" + 1,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = model.toUpperCase() === data.model.toUpperCase();
                            if (cekEqual) {
                                same = 1;
                            }
                        })

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/modelB/in",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    model: model,
                                    kode: kode,
                                    ids: ids
                                },
                                success: function(res) {
                                    // console.log(res);
                                    $('#modelIn').modal('hide');
                                    $("#frmModelAdd")[0].reset();
                                    $('#dt_model').DataTable().ajax.reload();
                                    $("#frmModelAdd").unbind().click(function() {});
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                }
                            });
                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: model + " Sudah Terdaftar"
                            });
                        }
                    }
                });
            });
        }
    </script>

    {{-- Tambah Merk --}}
    <script>
        function merkAdd() {
            // this.preventDefault();
            $('#addMerk').show();
            $('#addModel').hide();
            $('#addWarna').hide();
            $('#addNew').hide();
            document.getElementById('headNew').innerHTML = 'Penambahan Merk Baru';

            $('#frmMerkAdd').on('submit', function(e) {
                e.preventDefault();
                let merk = $('#merkAdd').val();
                let kode = $('#kodeMerk').val();
                var ids = `<?php echo Session::get('id'); ?>`;
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/merk/load/" + 1,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = merk.toUpperCase() === data.merk.toUpperCase();
                            if (cekEqual) {
                                same = 1;
                            }
                        })

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/merk/in",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    merk: merk,
                                    kode: kode,
                                    ids: ids
                                },
                                success: function(res) {
                                    // console.log(res);
                                    $('#merkIn').modal('hide');
                                    $("#frmMerkAdd")[0].reset();
                                    $('#dt_merk').DataTable().ajax.reload();
                                    $("#frmMerkAdd").unbind().click(function() {});
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                }
                            });
                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: merk + " Sudah Terdaftar"
                            });
                        }
                    }
                });
            });
        }
    </script>

    {{-- Tambah Warna --}}
    <script>
        function warnaAdd() {
            // this.preventDefault();
            $('#addMerk').hide();
            $('#addModel').hide();
            $('#addWarna').show();
            $('#addNew').hide();
            document.getElementById('headNew').innerHTML = 'Penambahan Warna Baru';
            $('#frmWarnaAdd').on('submit', function(e) {
                e.preventDefault();
                let warna = $('#warnaAdd').val();
                var ids = `<?php echo Session::get('id'); ?>`;
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/warna/load/" + 1,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = warna.toUpperCase() === data.warna.toUpperCase();
                            if (cekEqual) {
                                same = 1;
                            }
                        })

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/warna/in",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    warna: warna,
                                    ids: ids
                                },
                                success: function(res) {
                                    // console.log(res);
                                    $('#warnaIn').modal('hide');
                                    $("#frmWarnaAdd")[0].reset();
                                    $("#frmWarnaAdd").unbind().click(function() {});
                                    $('#dt_warna').DataTable().ajax.reload();
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                }
                            });
                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: warna + " Sudah Terdaftar"
                            });
                        }
                    }
                });
            });
        }
    </script>

    {{-- Delete Barang --}}
    <script>
        function deleteWish(id, cekData) {
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
                                url: "{{ url('') }}/delete/wishList/" + id,
                                async: false,
                                success: function(res) {
                                    $('#dt_wish').DataTable().ajax.reload();
                                    var table = $('#dt_wish').DataTable();
                                    var ids = `<?php echo Session::get('id'); ?>`;
                                    var cekRow = 0;
                                    $('#pesanB').hide();
                                    var panjang = table.data().count();
                                    if (panjang > 0) {
                                        $('#pesanB').show();
                                    }
                                }
                            });
                        } else {
                            swal("Data Tidak Jadi Dihapus!");
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
                    console.log(res);
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
@endpush
