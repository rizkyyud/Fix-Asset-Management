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
                <h4>Asset Management Transportasi</h4>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs justify-content-center" id="myTab6" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-center active" id="asset-tab6" data-toggle="tab" href="#asset6"
                            role="tab" aria-controls="asset" aria-selected="true" onclick="tabAsset()">
                            <span><i class="fas fa-bus"></i></span> Asset Transport</a>
                    </li>
                </ul>
                <div class="tab-content tab-bordered" id="myTabContent6">
                    <div class="tab-pane fade active show" id="asset6" role="tabpanel" aria-labelledby="asset-tab6">
                        <div class="card-header card text-center">
                            <h4>List</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#assetsTin"
                                    onclick="assetInT()">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_assets" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nama Transport</th>
                                        <th>Jenis Transport</th>
                                        <th>Pemilik</th>
                                        <th>Nomor Plat</th>
                                        <th>Supir</th>
                                        <th>Dokumen</th>
                                        <th>Model</th>
                                        <th>Merk</th>
                                        <th>Warna</th>
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
            // $('#inputItem').hide();
            // $('#subAssetS').hide();
            // $('#iventoriAsset').hide();
            $('#dt_assets').DataTable().clear();
            $('#dt_assets').DataTable().destroy();
            var table = $("#dt_assets").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/getAssetsT",
                    "dataSrc": "",
                },
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "columns": [{
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var assets = row['kode_transport'];
                            var subAsset = row['id'];
                            var html = '';
                            var cekData = 0;
                            html += ` <a href="#" data-bs-toggle="modal" class="text-dark"
                            data-bs-target="#detailAll" onclick="detail(${data})">
                                    ${assets}</a>`;

                            if (cekData == 0) {
                                html += `<div class="table-links">
                            <a href="#" data-bs-toggle="modal" id="btnEdit"
                            data-bs-target="#assetsTin" onclick="editAsset(${data})">
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
                        "data": "jns_transports",
                    },
                    {
                        "data": "pemilik",
                    },
                    {
                        "data": "nomor_plat",
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-dark" data-bs-toggle="modal"
                                        data-bs-target="#dokumenA" onclick="dokumentasi(${data})"><i class="fas fa-folder"></i>
                                        </button>`;
                            //
                            return html;
                        }
                    },
                    {
                        "data": "nama_supir",
                    },
                    {
                        "data": "model",
                    },
                    {
                        "data": "merk",
                    },
                    {
                        "data": "warna",
                    }
                ],
            });
        });

        function tabAsset() {
            $('#dt_assets').DataTable().ajax.reload();
        }
    </script>

    {{-- Input Assets --}}
    <script>
        function assetInT() {
            $('#jns_trnspt').select2({
                dropdownParent: $("#assetsTin .modal-content")
            });
            $('#model').select2({
                dropdownParent: $("#assetsTin .modal-content")
            });
            $('#pemilikT').select2({
                dropdownParent: $("#assetsTin .modal-content")
            });
            $('#merk').select2({
                dropdownParent: $("#assetsTin .modal-content")
            });
            $('#warna').select2({
                dropdownParent: $("#assetsTin .modal-content")
            });
            $('#supir').select2({
                dropdownParent: $("#assetsTin .modal-content")
            });

            // getDrpzone(1);

            $.ajax({
                url: "{{ url('') }}/pemilik/load/" + 1,
                success: function(res) {
                    $("#pemilikT").children().remove();
                    $("#pemilikT").append(
                        '<option selected value="">Pilih Pemilik</option>');
                    $.each(res, function(index, x) {
                        $('#pemilikT').append(
                            '<option value="' + x.id_pemilik + '">' + x
                            .nama_pemilik + ` (${x.status})` + '</option>'
                        )
                    })
                }
            });

            $.ajax({
                url: "{{ url('') }}/jnsTrnsprt",
                success: function(res) {
                    $("#jns_trnspt").children().remove();
                    $("#jns_trnspt").append(
                        '<option selected value="">Pilih Jenis Kendaraan</option>');
                    $.each(res, function(index, x) {
                        $('#jns_trnspt').append(
                            '<option value="' + x.id + '">' + x.jns_kendaraan + '</option>'
                        )
                    })
                }
            });

            $.ajax({
                url: "{{ url('') }}/supir",
                success: function(res) {
                    $("#supir").children().remove();
                    $("#supir").append(
                        '<option selected value="">Pilih Supir</option>');
                    $.each(res, function(index, x) {
                        $('#supir').append(
                            '<option value="' + x.id + '">' + x.nama_supir + '</option>'
                        )
                    })
                }
            });

            $.ajax({
                url: "{{ url('') }}/modelB/load/" + 1,
                success: function(res) {
                    $("#model").children().remove();
                    $("#model").append(
                        '<option selected value="">Pilih Model</option>');
                    $.each(res, function(index, x) {
                        $('#model').append(
                            '<option value="' + x.id + '">' + x.model + '</option>'
                        )
                    })
                }
            });

            $.ajax({
                url: "{{ url('') }}/merk/load/" + 1,
                success: function(res) {
                    $("#merk").children().remove();
                    $("#merk").append(
                        '<option selected value="">Pilih Merk</option>');
                    $.each(res, function(index, x) {
                        $('#merk').append(
                            '<option value="' + x.id + '">' + x.merk + '</option>'
                        )
                    })
                }
            });

            $.ajax({
                url: "{{ url('') }}/warna/load/" + 1,
                success: function(res) {
                    $("#warna").children().remove();
                    $("#warna").append(
                        '<option selected value="">Pilih Warna</option>');
                    $.each(res, function(index, x) {
                        $('#warna').append(
                            '<option value="' + x.id + '">' + x.warna + '</option>'
                        )
                    })
                }
            });


            var rupiah = document.getElementById('nilaiT');
            rupiah.addEventListener('keyup', function(e) {
                rupiah.value = formatRupiah(this.value);
            });

            $('#frmAssetTin').on('submit', function(e) {
                e.preventDefault();
                let assets = $('#assetsT').val();
                let jenis = $('#jns_trnspt')
                assets = ucwords(assets);
                let pemilik = $('#pemilikT').val();
                let nopol = $('#nopol').val();
                let supir = $('#supir').val();
                let merk = $('#merk').val();
                let model = $('#model').val();
                let warna = $('#warna').val();
                let nilai = $('#nilaiT').val();
                let kode = $('#kodeT').val();
                kode = kode.toUpperCase();
                nilai = convertToAngka(nilai);
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/getAssetsT",
                    async: false,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = assets.toUpperCase() === data.kode
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
                        url: "{{ url('') }}/assetsT/in",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            assets: assets,
                            pemilik: pemilik,
                            nilai: nilai,
                            kode: kode,
                            jenis: jenis,
                            model: model,
                            merk: merk,
                            warna: warna,
                            supir: supir,
                            nopol: nopol
                        },
                        success: function(res) {
                            // console.log(res);
                            $('#assetsTin').modal('hide');
                            $("#frmAssetsTin")[0].reset();
                            $("#frmAssetsTin").unbind().click(function() {});
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

    {{-- Edit Asset --}}
    <script>
        function editAsset(id) {
            $('#jns_trnspt').select2({
                dropdownParent: $("#assetsTin .modal-content")
            });
            $('#model').select2({
                dropdownParent: $("#assetsTin .modal-content")
            });
            $('#pemilikT').select2({
                dropdownParent: $("#assetsTin .modal-content")
            });
            $('#merk').select2({
                dropdownParent: $("#assetsTin .modal-content")
            });
            $('#warna').select2({
                dropdownParent: $("#assetsTin .modal-content")
            });
            $('#supir').select2({
                dropdownParent: $("#assetsTin .modal-content")
            });

            // getDrpzone(1);            

            $.ajax({
                url: "{{ url('') }}/getAssetsT/ById/" + id,
                success: function(res) {
                    $('#assets').val(res.nama_transport);
                    $('#kodeT').val(res.kode);
                    $('#nilaiT').val(res.nilai).change();
                    $('#nopol').val(res.nomor_plat);

                    $.ajax({
                        url: "{{ url('') }}/pemilik/load/" + 1,
                        success: function(res) {
                            $("#pemilikT").children().remove();
                            $("#pemilikT").append(
                                '<option selected value="">Pilih Pemilik</option>');
                            $.each(res, function(index, x) {
                                $('#pemilikT').append(
                                    '<option value="' + x.id_pemilik + '">' + x
                                    .nama_pemilik + ` (${x.status})` + '</option>'
                                )
                            })
                            $('#pemilik').val(res.pemilik).change();
                        }
                    });

                    $.ajax({
                        url: "{{ url('') }}/jnsTrnsprt",
                        success: function(res) {
                            $("#jns_trnspt").children().remove();
                            $("#jns_trnspt").append(
                                '<option selected value="">Pilih Jenis Kendaraan</option>');
                            $.each(res, function(index, x) {
                                $('#jns_trnspt').append(
                                    '<option value="' + x.id + '">' + x.jns_kendaraan +
                                    '</option>'
                                )
                            })
                            $('#jns_trnspt').val(res.jns_transports).change();
                        }
                    });

                    $.ajax({
                        url: "{{ url('') }}/supir",
                        success: function(res) {
                            $("#supir").children().remove();
                            $("#supir").append(
                                '<option selected value="">Pilih Supir</option>');
                            $.each(res, function(index, x) {
                                $('#supir').append(
                                    '<option value="' + x.id + '">' + x.nama_supir +
                                    '</option>'
                                )
                            })
                            $('#supir').val(res.nama_supir).change();
                        }
                    });

                    $.ajax({
                        url: "{{ url('') }}/modelB/load/" + 1,
                        success: function(res) {
                            $("#model").children().remove();
                            $("#model").append(
                                '<option selected value="">Pilih Model</option>');
                            $.each(res, function(index, x) {
                                $('#model').append(
                                    '<option value="' + x.id + '">' + x.model +
                                    '</option>'
                                )
                            })
                            $('#supir').val(res.model).change();
                        }
                    });

                    $.ajax({
                        url: "{{ url('') }}/merk/load/" + 1,
                        success: function(res) {
                            $("#merk").children().remove();
                            $("#merk").append(
                                '<option selected value="">Pilih Merk</option>');
                            $.each(res, function(index, x) {
                                $('#merk').append(
                                    '<option value="' + x.id + '">' + x.merk +
                                    '</option>'
                                )
                            })
                            $('#supir').val(res.merk).change();
                        }
                    });

                    $.ajax({
                        url: "{{ url('') }}/warna/load/" + 1,
                        success: function(res) {
                            $("#warna").children().remove();
                            $("#warna").append(
                                '<option selected value="">Pilih Warna</option>');
                            $.each(res, function(index, x) {
                                $('#warna').append(
                                    '<option value="' + x.id + '">' + x.warna +
                                    '</option>'
                                )
                            })
                            $('#supir').val(res.warna).change();
                        }
                    });
                }
            });



            var rupiah = document.getElementById('nilaiT');
            rupiah.addEventListener('keyup', function(e) {
                rupiah.value = formatRupiah(this.value);
            });

            $('#frmAssetTin').on('submit', function(e) {
                e.preventDefault();
                let assets = $('#assetsT').val();
                let jenis = $('#jns_trnspt')
                assets = ucwords(assets);
                let pemilik = $('#pemilikT').val();
                let nopol = $('#nopol').val();
                let supir = $('#supir').val();
                let merk = $('#merk').val();
                let model = $('#model').val();
                let warna = $('#warna').val();
                let nilai = $('#nilaiT').val();
                let kode = $('#kodeT').val();
                kode = kode.toUpperCase();
                nilai = convertToAngka(nilai);
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/getAssetsT",
                    async: false,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = assets.toUpperCase() === data.kode
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
                        url: "{{ url('') }}/assetsT/in",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            assets: assets,
                            pemilik: pemilik,
                            nilai: nilai,
                            kode: kode,
                            jenis: jenis,
                            model: model,
                            merk: merk,
                            warna: warna,
                            supir: supir,
                            nopol: nopol
                        },
                        success: function(res) {
                            // console.log(res);
                            $('#assetsTin').modal('hide');
                            $("#frmAssetsTin")[0].reset();
                            $("#frmAssetsTin").unbind().click(function() {});
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
@endpush
