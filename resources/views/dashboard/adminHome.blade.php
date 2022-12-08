@extends('layouts\master')
@section('header-form')
    <h1>Home</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Home</a></div>
    </div>
@endsection
@section('content')
    <div class="section-body">
        <div class="card card-primary">
            <div class="card-header card text-center">
                <h4>Assets Information</h4>
                <div class="card-header-action">
                    <a data-collapse="#assetInformation" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                </div>
            </div>
            <div class="collapse show" id="assetInformation">
                <div class="card-body">
                    <div class="card">
                        <div class="row" style="margin-left:10px; margin-top:10px;">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1"
                                    style="box-shadow: 10px 10px 5px #e5e5e5; border:1px solid #e5e5e5">
                                    <div class="card-icon bg-primary btn btn-primary" id="lokasi">
                                        <i class="fas fa-map-marked-alt" style="margin-top: 40%;"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Lokasi</h4>
                                        </div>
                                        <div class="card-body" id="countLok">
                                            0
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1"
                                    style="box-shadow: 10px 10px 5px #e5e5e5; border:1px solid #e5e5e5">
                                    <div class="card-icon bg-danger btn btn-danger" id="subLok">
                                        <i class="fas fa-map-signs" style="margin-top: 40%;"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Sub Lokasi</h4>
                                        </div>
                                        <div class="card-body" id="countSubL">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1"
                                    style="box-shadow: 10px 10px 5px #e5e5e5; border:1px solid #e5e5e5">
                                    <div class="card-icon bg-warning btn btn-warning" id="kateA">
                                        <i class="fas fa-university" style="margin-top: 40%;"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Kategori Asset</h4>
                                        </div>
                                        <div class="card-body" id="countKatA">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1"
                                    style="box-shadow: 10px 10px 5px #e5e5e5; border:1px solid #e5e5e5">
                                    <div class="card-icon bg-success btn btn-success" id="pemilikA">
                                        <i class="fas fa-user-tie" style="margin-top: 40%;"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Pemilik</h4>
                                        </div>
                                        <div class="card-body" id="countPemilik">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1"
                                    style="box-shadow: 10px 10px 5px #e5e5e5; border:1px solid #e5e5e5">
                                    <div class="card-icon bg-info btn btn-info" id="assetA">
                                        <i class="fas fa-building" style="margin-top: 40%;"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Asset</h4>
                                        </div>
                                        <div class="card-body" id="countAsset">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1"
                                    style="box-shadow: 10px 10px 5px #e5e5e5; border:1px solid #e5e5e5">
                                    <div class="card-icon bg-dark btn btn-dark" id="subA">
                                        <i class="fas fa-bed" style="margin-top: 40%;"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Sub Asset</h4>
                                        </div>
                                        <div class="card-body" id="countSubAsset">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header card text-center">
                <h4>Inventaris Information</h4>
                <div class="card-header-action">
                    <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                </div>
            </div>
            <div class="collapse show" id="mycard-collapse" style="">
                <div class="card-body">
                    <div class="card">
                        <div class="row" style="margin-left:5px; margin-right:5px; margin-top:30px;">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1"
                                    style="box-shadow: 10px 10px 5px #e5e5e5; border:1px solid #e5e5e5">
                                    <div class="card-icon bg-primary btn btn-primary" id="barang">
                                        <i class="fas fa-laptop" style="margin-top: 40%;"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Barang Inventaris</h4>
                                        </div>
                                        <div class="card-body" id="countBarang">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1"
                                    style="box-shadow: 10px 10px 5px #e5e5e5; border:1px solid #e5e5e5">
                                    <div class="card-icon bg-info btn btn-info" id="vendor">
                                        <i class="fas fa-store-alt" style="margin-top: 40%;"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Total Vendor</h4>
                                        </div>
                                        <div class="card-body" id="countVendor">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1"
                                    style="box-shadow: 10px 10px 5px #e5e5e5; border:1px solid #e5e5e5">
                                    <div class="card-icon bg-warning btn btn-warning" id="klasifikasi">
                                        <i class="fas fa-atom" style="margin-top: 40%;"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Total Klasifikasi</h4>
                                        </div>
                                        <div class="card-body" id="countKlas">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1"
                                    style="box-shadow: 10px 10px 5px #e5e5e5; border:1px solid #e5e5e5">
                                    <div class="card-icon bg-dark btn btn-dark" id="kategoriB">
                                        <i class="fas fa-laptop-code" style="margin-top: 40%;"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Total Kategori</h4>
                                        </div>
                                        <div class="card-body" id="countKatB">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1"
                                    style="box-shadow: 10px 10px 5px #e5e5e5; border:1px solid #e5e5e5">
                                    <div class="card-icon bg-secondary btn btn-secondary" id="merk">
                                        <i class="fab fa-apple" style="margin-top: 40%;"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Total Merk</h4>
                                        </div>
                                        <div class="card-body" id="countMerk">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1"
                                    style="box-shadow: 10px 10px 5px #e5e5e5; border:1px solid #e5e5e5">
                                    <div class="card-icon bg-danger btn btn-danger" id="modelB">
                                        <i class="fab fa-accusoft" style="margin-top: 40%;"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Total Model</h4>
                                        </div>
                                        <div class="card-body" id="countModel">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1"
                                    style="box-shadow: 10px 10px 5px #e5e5e5; border:1px solid #e5e5e5">
                                    <div class="card-icon bg-success btn btn-success" id="warna">
                                        <i class="fas fa-palette" style="margin-top: 40%;"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Total Warna</h4>
                                        </div>
                                        <div class="card-body" id="countWarna">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('Modal\homeModal')

{{-- @section('sidebar')

@endsection --}}

@push('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    {{-- ///////////////////////////// Lokasi //////////////////////// --}}

    {{-- Get Lokasi --}}
    <script>
        $(document).ready(function() {
            $("#lokasi").click(function(e) {
                e.preventDefault();
                $('#lokasiModal').modal('show');
                $('#dt_lokasi').DataTable().clear();
                $('#dt_lokasi').DataTable().destroy();
                var lokasi = $("#dt_lokasi").DataTable({
                    "scrollX": 200,
                    "processing": true,
                    // "serverSide": true,
                    // "deferRender": true,
                    "columnDefs": [{
                        "targets": '_all',
                        "className": "dt-center",
                    }],
                    "ajax": {
                        "url": "{{ url('') }}/lokasi/load/" + 1,
                        "dataSrc": "",
                    },
                    "columns": [{
                            "data": "nama_lokasi",
                        },
                        {
                            "data": "alamat_lokasi",
                        },
                        {
                            "data": "id_lokasi",
                            "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                                var html = `<button class="btn btn-dark" data-bs-toggle="modal"
                                    data-bs-target="#dokumenLok" onclick="dokLokasi(${data})"><i class="fas fa-folder"></i>
                                    </button>`;
                                //
                                return html;
                            }
                        },
                    ],
                })
            });

            $.ajax({
                url: "{{ url('') }}/lokasi/load/" + 1,
                type: "GET",
                success: function(res) {
                    if (res.length > 0) {
                        let counts = setInterval(updated);
                        let upto = 0;

                        function updated() {
                            var count = document.getElementById("countLok");
                            count.innerHTML = ++upto;
                            if (upto === res.length) {
                                clearInterval(counts);
                            }
                        }
                    }
                }
            })
        });
    </script>

    {{-- Dokumentasi Lokasi --}}
    <script>
        function dokLokasi(id) {
            $.ajax({
                url: "{{ url('') }}/lokasiE/load/" + id,
                success: function(data) {
                    var html;
                    // var x = data.status;
                    html = `<h4 style="color:#677fe8">Dokumentasi</h4>
                    <h4>( Lokasi ${data.nama_lokasi} )</h4>
                    <br>`;
                    $('#headerDok').html(html);
                }
            })

            $('#dt_dokLok').DataTable().clear();
            $('#dt_dokLok').DataTable().destroy();
            $("#dt_dokLok").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/dokLok/load/" + id,
                    "dataSrc": "",
                },
                "columns": [{
                    "data": "path",
                    "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                        var namaFile = row['nama_file'];
                        var html = `<a href="${data}" class="text-dark" target="_blank">
                                        ${namaFile}</a>`;
                        //
                        return html;
                    }
                }],
            });
        }
    </script>

    {{-- ///////////////////////////// Sub Lokasi //////////////////////// --}}

    {{-- Get Sub Lokasi --}}
    <script>
        $(document).ready(function() {
            $("#subLok").click(function(e) {
                e.preventDefault();
                $('#subLokModal').modal('show');

                $('#dt_subL').DataTable().clear();
                $('#dt_subL').DataTable().destroy();
                $("#dt_subL").DataTable({
                    "scrollX": true,
                    "columnDefs": [{
                        "targets": [2],
                        "className": "dt-center",
                    }],
                    "ajax": {
                        "url": "{{ url('') }}/subL/load/" + 1,
                        "dataSrc": "",
                    },
                    "columns": [{
                            "data": "id_subL",
                            "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                                var subL = row['nama_subL'];
                                var html = '';
                                var cekData = 0;
                                html += `<a>${subL}</a>`;
                                return html;
                            }
                        },
                        {
                            "data": "nama_lokasi",
                        },
                        {
                            "data": "id_subL",
                            "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                                var html = `<button class="btn btn-dark" data-bs-toggle="modal"
                                        data-bs-target="#dokSubLok" onclick="dokSubLokasi(${data})"><i class="fas fa-folder"></i>
                                        </button>`;
                                //
                                return html;
                            }
                        }
                    ],

                })
            });

            $.ajax({
                url: "{{ url('') }}/subL/load/" + 1,
                type: "GET",
                success: function(res) {
                    if (res.length > 0) {
                        let counts = setInterval(updated);
                        let upto = 0;

                        function updated() {
                            var count = document.getElementById("countSubL");
                            count.innerHTML = ++upto;
                            if (upto === 1) {
                                clearInterval(counts);
                            }
                        }
                    }
                }
            })
        });
    </script>

    {{-- Dokumentasi Sub Lokasi --}}
    <script>
        function dokSubLokasi(id) {
            $.ajax({
                url: "{{ url('') }}/subLokasiE/load/" + id,
                success: function(data) {
                    var html;
                    // var x = data.status;
                    html = `<h4 style="color:#677fe8">Dokumentasi</h4>
                    <h4>( Sub Lokasi "${data.nama_subL}" )</h4>
                    <br>`;
                    $('#headDokSubL').html(html);
                }
            })

            $('#dt_dokSubL').DataTable().clear();
            $('#dt_dokSubL').DataTable().destroy();
            $("#dt_dokSubL").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/dokSubLok/load/" + id,
                    "dataSrc": "",
                },
                "columns": [{
                    "data": "path",
                    "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                        var namaFile = row['nama_file'];
                        var html = `<a href="${data}" class="text-dark" target="_blank">
                                        ${namaFile}</a>`;
                        //
                        return html;
                    }
                }],
            });
        }
    </script>


    {{-- ////////////////////////// Kategori Asset //////////////////////// --}}
    <script>
        $(document).ready(function() {
            $("#kateA").click(function(e) {
                e.preventDefault();
                $('#kateAModal').modal('show');

                $('#dt_kategori').DataTable().clear();
                $('#dt_kategori').DataTable().destroy();
                $("#dt_kategori").DataTable({
                    "scrollX": true,
                    "ajax": {
                        "url": "{{ url('') }}/kategori/load/" + 1,
                        "dataSrc": "",
                    },
                    "columnDefs": [{
                        "targets": '_all',
                        "className": "dt-center",
                    }],
                    "columns": [{
                            "data": "id_kategori",
                            "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                                var kategori = row['nama_kategori'];
                                var html = '';
                                var cekData = 0;
                                html += `<strong>${kategori}</strong>`;
                                return html;
                            }
                        },
                        {
                            "data": "uniqe_kode"
                        }
                    ]
                });
            });

            $.ajax({
                url: "{{ url('') }}/kategori/load/" + 1,
                type: "GET",
                success: function(res) {
                    if (res.length > 0) {
                        let counts = setInterval(updated);
                        let upto = 0;

                        function updated() {
                            var count = document.getElementById("countKatA");
                            count.innerHTML = ++upto;
                            if (upto === res.length) {
                                clearInterval(counts);
                            }
                        }
                    }
                }
            })
        })
    </script>

    {{-- /////////////////////////// Pemilik ////////////////////////// --}}
    <script>
        $(document).ready(function() {
            $("#pemilikA").click(function(e) {
                e.preventDefault();
                $('#pemilikModal').modal('show');

                $('#dt_pemilik').DataTable().clear();
                $('#dt_pemilik').DataTable().destroy();
                $("#dt_pemilik").DataTable({
                    "scrollX": true,
                    "columnDefs": [{
                        "targets": '_all',
                        "className": "dt-center",
                    }],
                    "ajax": {
                        "url": "{{ url('') }}/pemilik/load/" + 1,
                        "dataSrc": "",
                    },
                    "columns": [{
                            "data": "id_pemilik",
                            "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                                var pemilik = row['nama_pemilik'];
                                var html = '';
                                var cekData = 0;
                                html += `<strong>${pemilik}</strong>`;

                                return html;
                            }
                        },
                        {
                            "data": "status"
                        },
                        {
                            "data": "alamat"
                        },
                        {
                            "data": "nohp"
                        }
                    ],
                })
            });

            $.ajax({
                url: "{{ url('') }}/pemilik/load/" + 1,
                type: "GET",
                success: function(res) {
                    if (res.length > 0) {
                        let counts = setInterval(updated);
                        let upto = 0;

                        function updated() {
                            var count = document.getElementById("countPemilik");
                            count.innerHTML = ++upto;
                            if (upto === res.length) {
                                clearInterval(counts);
                            }
                        }
                    }
                }
            })
        })
    </script>

    {{-- ///////////////////////////// Asset //////////////////////////// --}}

    {{-- Load Asset --}}
    <script>
        $(document).ready(function() {
            $("#assetA").click(function(e) {
                e.preventDefault();
                $('#assetModal').modal('show');

                $('#dt_assets').DataTable().clear();
                $('#dt_assets').DataTable().destroy();
                $("#dt_assets").DataTable({
                    "scrollX": true,
                    "ajax": {
                        "url": "{{ url('') }}/assets/load/" + 1,
                        "dataSrc": "",
                    },
                    "columnDefs": [{
                        "targets": '_all',
                        "className": "dt-center",
                    }],
                    "columns": [{
                            "data": "id_assets",
                            "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                                var assets = row['nama_assets'];
                                var subAsset = row['id'];
                                var html = '';
                                var cekData = 0;
                                html += ` <a>
                                    ${assets}</a>`;

                                return html;
                            }
                        },
                        {
                            "data": "nama_lokasi"
                        },
                        {
                            "data": "id_assets",
                            "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                                var html = `<button class="btn btn-dark" data-bs-toggle="modal"
                                        data-bs-target="#dokAsset" onclick="dokumentasi(${data})"><i class="fas fa-folder"></i>
                                        </button>`;
                                //
                                return html;
                            }
                        }
                    ],
                });
            });

            $.ajax({
                url: "{{ url('') }}/assets/load/" + 1,
                type: "GET",
                success: function(res) {
                    if (res.length > 0) {
                        let counts = setInterval(updated);
                        let upto = 0;

                        function updated() {
                            var count = document.getElementById("countAsset");
                            count.innerHTML = ++upto;
                            if (upto === res.length) {
                                clearInterval(counts);
                            }
                        }
                    }
                }
            })
        })
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

            $('#dt_AssetDok').DataTable().clear();
            $('#dt_AssetDok').DataTable().destroy();
            $("#dt_AssetDok").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/dokumen/load/" + id,
                    "dataSrc": "",
                },
                "columns": [{
                    "data": "path",
                    "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                        var namaFile = row['nama_file'];
                        var html = `<a href="${data}" class="text-dark" target="_blank">
                                        ${namaFile}</a>`;
                        //
                        return html;
                    }
                }],
            });
        }
    </script>

    {{-- ///////////////////////////// Sub Asset //////////////////////////// --}}

    {{-- Load Sub Asset --}}
    <script>
        $(document).ready(function() {
            $("#subA").click(function(e) {
                e.preventDefault();
                $('#subAssetModal').modal('show');

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
                                var html = `<a>
                                    ${namaSub}</a>`;
                                //
                                return html;
                            }
                        },
                        {
                            "data": "nama_assets"
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
            });

            $.ajax({
                url: "{{ url('') }}/subAsset/load/" + 1,
                type: "GET",
                success: function(res) {
                    if (res.length > 0) {
                        let counts = setInterval(updated);
                        let upto = 0;

                        function updated() {
                            var count = document.getElementById("countSubAsset");
                            count.innerHTML = ++upto;
                            if (upto === res.length) {
                                clearInterval(counts);
                            }
                        }
                    }
                }
            })
        })
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
                        var html = `<a href="${data}" class="text-dark" target="_blank">
                                        ${namaFile}</a>`;
                        //
                        return html;
                    }
                }],
            });
        }
    </script>

    {{-- ////////////////////////// Barang Inventaris ///////////////////////// --}}
    <script>
        $(document).ready(function() {
            $("#barang").click(function(e) {

                $('#barangModal').modal('show');

                $('#dt_barang').DataTable().clear();
                $('#dt_barang').DataTable().destroy();
                var brg = $("#dt_barang").DataTable({
                    "scrollX": true,
                    "columnDefs": [{
                        "targets": '_all',
                        "className": "dt-center",
                    }],
                    "ajax": {
                        "url": "{{ url('') }}/barang/load/" + 1,
                        "dataSrc": "",
                    },
                    "responsive": true,
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
                        },
                    ],
                })
            });
            $.ajax({
                url: "{{ url('') }}/barang/load/" + 1,
                type: "GET",
                success: function(res) {
                    if (res.length > 0) {
                        let counts = setInterval(updated);
                        let upto = 0;

                        function updated() {
                            var count = document.getElementById("countBarang");
                            count.innerHTML = ++upto;
                            if (upto === res.length) {
                                clearInterval(counts);
                            }
                        }
                    }
                }
            })
        });
    </script>

    {{-- ///////////////////////////// Vendor //////////////////////////// --}}

    {{-- Load Vendor --}}
    <script>
        $(document).ready(function() {
            $("#vendor").click(function(e) {
                e.preventDefault();
                $('#vendorModal').modal('show');

                $('#dt_vendor').DataTable().clear();
                $('#dt_vendor').DataTable().destroy();
                $("#dt_vendor").DataTable({
                    "scrollX": true,
                    "columnDefs": [{
                        "targets": "_all",
                        "className": "dt-center",
                    }],
                    "ajax": {
                        "url": "{{ url('') }}/vendor/load/" + 1,
                        "dataSrc": "",
                    },
                    "columns": [{
                            "data": "nama_vendor"
                        },
                        {
                            "data": "id_vendor",
                            "render": function(data, type, row,
                                meta) { // Tampilkan kolom aksi
                                var html = `<button class="btn btn-success" data-bs-toggle="modal" onclick="detail(${data})" data-bs-target="#detail"
                            href="#"><i class="fas fa-eye"></i>`;
                                //
                                return html;
                            }
                        }
                    ],
                })
            });

            $.ajax({
                url: "{{ url('') }}/vendor/load/" + 1,
                type: "GET",
                success: function(res) {
                    if (res.length > 0) {
                        let counts = setInterval(updated);
                        let upto = 0;

                        function updated() {
                            var count = document.getElementById("countVendor");
                            count.innerHTML = ++upto;
                            if (upto === res.length) {
                                clearInterval(counts);
                            }
                        }
                    }
                }
            })
        });
    </script>

    {{-- Detail Vendor --}}
    <script>
        function detail(id) {
            $("#jenisD").select2({
                dropdownParent: $("#detail")
            })

            $.ajax({
                url: "{{ url('') }}/vendor/get/" + id,
                success: function(res) {
                    // console.log(data);
                    document.getElementById('vendorD').value = res.nama_vendor;
                    document.getElementById('alamatD').value = res.alamat_vendor;
                    document.getElementById('kontakD').value = res.contact_person;
                    var jenis = JSON.parse(res.jenis);
                    var hp = JSON.parse(res.no_hp);
                    $.ajax({
                        url: "{{ url('') }}/jenis/load/" + 1,
                        success: function(data) {
                            // console.log(data);
                            $("#jenisD").children().remove();
                            $("#jenisD").append(
                                '<option value="">Pilih Klasifikasi</option>');
                            $.each(data, function(index, x) {
                                // console.log(x.id_jenisIven);
                                $('#jenisD').append(
                                    '<option value="' + x.id_jenisIven + '">' + x
                                    .jenis_iventaris + '</option>'
                                )
                            })
                            for (let i = 0; i < jenis.length; i++) {
                                $("#jenisD").val(jenis).change();
                            }
                        }
                    });
                    // console.log(hp);
                    for (let i = 0; i < hp.length; i++) {
                        var nomor = "hpD" + i;
                        if (i == 0) {
                            document.getElementById(nomor).value = hp[i];
                        } else {
                            var phoneNumber = document.getElementById("detailP");
                            var div = document.createElement("div");

                            div.innerHTML = `<div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="${nomor}" value="${hp[i]}" disabled>
                                    </div>
                                </div>
                            </div>`;
                            phoneNumber.appendChild(div);
                        }
                    }
                }
            });
        }
        $(document).ready(function() {
            $('#detail').on('hidden.bs.modal', function(e) {
                document.getElementById("detailP").innerHTML = "";
            })
        });
    </script>

    {{-- /////////////////////////// Klasifikasi Barang ////////////////////////// --}}
    <script>
        $(document).ready(function() {
            $("#klasifikasi").click(function(e) {
                e.preventDefault();
                $('#klasifikasiModal').modal('show');

                $('#dt_kate').DataTable().clear();
                $('#dt_kate').DataTable().destroy();
                var kat = $("#dt_kate").DataTable({
                    "scrollX": true,
                    "columnDefs": [{
                        "targets": '_all',
                        "className": "dt-center",
                    }],
                    "responsive": true,
                    "ajax": {
                        "url": "{{ url('') }}/jenis/load/" + 1,
                        "dataSrc": "",
                    },
                    "columns": [{
                        "data": "jenis_iventaris",
                    }],
                })
            });

            $.ajax({
                url: "{{ url('') }}/jenis/load/" + 1,
                type: "GET",
                success: function(res) {
                    if (res.length > 0) {
                        let counts = setInterval(updated);
                        let upto = 0;

                        function updated() {
                            var count = document.getElementById("countKlas");
                            count.innerHTML = ++upto;
                            if (upto === res.length) {
                                clearInterval(counts);
                            }
                        }
                    }
                }
            })
        })
    </script>

    {{-- /////////////////////////// Kategori Barang ////////////////////////// --}}
    <script>
        $(document).ready(function() {
            $("#kategoriB").click(function(e) {
                e.preventDefault();
                $('#KateB_Modal').modal('show');

                $('#dt_tipe').DataTable().clear();
                $('#dt_tipe').DataTable().destroy();
                var tip = $("#dt_tipe").DataTable({
                    "scrollX": true,
                    "columnDefs": [{
                        "targets": '_all',
                        "className": "dt-center",
                    }],
                    "responsive": true,
                    "ajax": {
                        "url": "{{ url('') }}/kateBarang/load/" + 1,
                        "dataSrc": "",
                    },
                    "columns": [{
                            "data": "id_barangIven",
                            "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                                var nama = row['nama_barang'];
                                var html = '';
                                var cekData = 0;
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
                            "data": "jenis_iventaris"
                        },
                        {
                            "data": "kode_barang"
                        },
                        {
                            "data": "satuan"
                        }
                    ],
                })
            });

            $.ajax({
                url: "{{ url('') }}/kateBarang/load/" + 1,
                type: "GET",
                success: function(res) {
                    if (res.length > 0) {
                        let counts = setInterval(updated);
                        let upto = 0;

                        function updated() {
                            var count = document.getElementById("countKatB");
                            count.innerHTML = ++upto;
                            if (upto === res.length) {
                                clearInterval(counts);
                            }
                        }
                    }
                }
            })
        })
    </script>

    {{-- /////////////////////////// Merk Barang ////////////////////////// --}}
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ url('') }}/merk/load/" + 1,
                type: "GET",
                success: function(res) {
                    if (res.length > 0) {
                        let counts = setInterval(updated);
                        let upto = 0;

                        function updated() {
                            var count = document.getElementById("countMerk");
                            count.innerHTML = ++upto;
                            if (upto === res.length) {
                                clearInterval(counts);
                            }
                        }
                    }
                }
            })
        })

        $("#merk").click(function(e) {
            e.preventDefault();
            $('#merkModal').modal('show');

            $('#dt_merk').DataTable().clear();
            $('#dt_merk').DataTable().destroy();
            $("#dt_merk").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "className": "dt-center",
                }],
                "ajax": {
                    "url": "{{ url('') }}/merk/load/" + 1,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "merk"
                    },
                    {
                        "data": "kode_merk"
                    }
                ],
            })
        });
    </script>

    {{-- /////////////////////////// Model Barang ////////////////////////// --}}
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ url('') }}/modelB/load/" + 1,
                type: "GET",
                success: function(res) {
                    if (res.length > 0) {
                        let counts = setInterval(updated);
                        let upto = 0;

                        function updated() {
                            var count = document.getElementById("countModel");
                            count.innerHTML = ++upto;
                            if (upto === res.length) {
                                clearInterval(counts);
                            }
                        }
                    }
                }
            })
        })

        $("#modelB").click(function(e) {
            e.preventDefault();
            $('#modelModal').modal('show');

            $('#dt_model').DataTable().clear();
            $('#dt_model').DataTable().destroy();
            $("#dt_model").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "className": "dt-center",
                }],
                "ajax": {
                    "url": "{{ url('') }}/modelB/load/" + 1,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "model"
                    },
                    {
                        "data": "kode_model"
                    }
                ],
            })
        });
    </script>

    {{-- /////////////////////////// Warna Barang ////////////////////////// --}}
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ url('') }}/warna/load/" + 1,
                type: "GET",
                success: function(res) {
                    if (res.length > 0) {
                        let counts = setInterval(updated);
                        let upto = 0;

                        function updated() {
                            var count = document.getElementById("countWarna");
                            count.innerHTML = ++upto;
                            if (upto === res.length) {
                                clearInterval(counts);
                            }
                        }
                    }
                }
            })
        })

        $("#warna").click(function(e) {
            e.preventDefault();
            $('#warnaModal').modal('show');

            $('#dt_warna').DataTable().clear();
            $('#dt_warna').DataTable().destroy();
            $("#dt_warna").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "className": "dt-center",
                }],
                "ajax": {
                    "url": "{{ url('') }}/warna/load/" + 1,
                    "dataSrc": "",
                },
                "columns": [{
                    "data": "warna"
                }],
            })
        });
    </script>
@endpush
