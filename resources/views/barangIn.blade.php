@extends('layouts\master')
@section('header-form')
    <h1>Validasi Barang Masuk</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="\">Home</a></div>
        <div class="breadcrumb-item active">Validasi In</div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs justify-content-center" id="myTab6" role="tablist">
                <li class="nav-item">
                    <a class="nav-link text-center active" id="home-tab6" data-toggle="tab" href="#home6" role="tab"
                        aria-controls="home" aria-selected="true">
                        <span><i class="fas fa-warehouse"></i><i class="fas fa-exchange-alt"></i></span> Penyimpanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" id="profile-tab6" data-toggle="tab" href="#profile6" role="tab"
                        aria-controls="profile" aria-selected="false">
                        <span><i class="fas fa-warehouse"></i><i class="fas fa-undo"></i></span> Pengembalian</a>
                </li>
            </ul>
            <div class="tab-content tab-bordered" id="myTabContent6">
                <div class="tab-pane fade active show" id="home6" role="tabpanel" aria-labelledby="home-tab6">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4>Request Barang Masuk</h4>
                            <div class="card-header-action">
                                {{-- <a href="#" class="btn btn-primary"><i class="fas fa-boxes"></i>
                                    Store All
                                </a> --}}
                                <a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#histori"
                                    onclick="loadHistori()"><i class="fas fa-book-open"></i>
                                    History
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_barangIn" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        {{-- <th><input type="checkbox" id="check-all"></th> --}}
                                        <th>Kode Pesanan</th>
                                        <th>Nama Pemesan</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Detail</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile6" role="tabpanel" aria-labelledby="profile-tab6">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4>Request Pengembalian</h4>
                            <div class="card-header-action">
                                {{-- <a href="#" class="btn btn-primary"><i class="fas fa-boxes"></i>
                                    Store All
                                </a> --}}
                                <a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#histori"
                                    onclick="loadHis()"><i class="fas fa-book-open"></i>
                                    History
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_return" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
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
    </div>
@endsection
@include('Modal\barangInModal')
{{-- Detail Order Modal --}}
<div class="modal fade" id="detail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card" id="tes">
            </div>
        </div>
    </div>
</div>

@push('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

    {{-- Load Barang In --}}
    <script>
        $(document).ready(function() {
            // $('#items').show();
            $('#dt_return').DataTable();
            $("#check-all").click(function() {
                if ($(this).is(":checked"))
                    $(".check-item").prop("checked",
                        true);
                else
                    $(".check-item").prop("checked",
                        false);
            });

            var ids = `<?php echo Session::get('id'); ?>`;
            $('#dt_barangIn').DataTable().clear();
            $('#dt_barangIn').DataTable().destroy();
            $("#dt_barangIn").DataTable({
                "scrollX": 200,
                "processing": true,
                "order": [
                    [0, 'desc']
                ],
                "columnDefs": [{
                        "targets": '_all',
                        "className": "dt-center",
                    },
                    {
                        "targets": 0,
                        "visible": false,
                        "searchable": false,
                    },
                ],
                "ajax": {
                    "url": "{{ url('') }}/barangIn/load/" + 1,
                    "dataSrc": "",
                },

                "columns": [{
                        "data": "kode_order"
                    },
                    {
                        "data": "nama"
                    },
                    {
                        "data": "nama_barang"
                    },
                    {
                        "data": "jumlah"
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
                        "data": "id_orders",
                        "render": function(data, type, row) { // Tampilkan kolom aksi
                            var kode = row['kode_order']
                            var html =
                                `<button style="margin-bottom: 10px; margin-top: 10px;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detailOrd" onclick="detailOrd(${data},'${kode}')">
                                <i class="fas fa-eye"></i></button>`
                            return html;
                        }
                    },
                    {
                        "data": "id_orders",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = "";
                            //
                            html +=
                                `<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#storeB" onclick="store(${data})">
                                        <i class="fas fa-boxes"></i> Store</button>`;

                            // html += `<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#relabel" onclick="reLabel(${data})">
                        //             <i class="fas fa-boxes"></i> Relabel</button>`;
                            return html;
                        }
                    },
                ],

            })
        });
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

    {{-- Store Individu Js --}}
    <script>
        function store(idOrd) {
            $("#frmBarangIN").unbind().click(function() {});
            $('html, body').css("cursor", "wait");
            $('#tambahLabel').hide();
            $('#assetLokasi').select2({
                dropdownParent: $("#storeB")
            });
            $('#assetTempat').select2({
                dropdownParent: $("#storeB")
            });
            $('#subTempat').select2({
                dropdownParent: $("#storeB")
            });

            $("#default").prop("checked", true);
            // $("#default").prop("checked", true);

            $(`input[name="penempatan"]`).click(function() {
                if ($(this).is(':checked')) {
                    var val = $(this).attr('value');
                    if (val == 1) {
                        $('#tempat').show();
                        $('#klsDrp').hide();
                    } else {
                        $('#tempat').hide();
                        $('#klsDrp').show();
                    }
                }
            });

            // Set Label
            var Lkate, Lmerk = 'MRK',
                Lmodel = 'MDL',
                Lukuran, LAsset, Lsub, ukuran;


            // Label Barang, Dropdown Asset dan Sub Asset
            $.ajax({
                url: "{{ url('') }}/barangIn/kode/" + idOrd,
                async: false,
                success: function(res) {
                    var kate = res[0].id_barangIven;
                    var model = res[0].id_model;
                    var merk = res[0].id_merk;
                    var asset = res[0].id_assets;
                    var sub = res[0].id_sub;
                    ukuran = res[0].ukuran;

                    // Asset Drop Down
                    $.ajax({
                        url: "{{ url('') }}/assets/load/" + 1,
                        type: "GET",
                        success: function(res) {
                            $("#assetTempat").children().remove();
                            $("#assetTempat").append(
                                '<option selected disabled value="">Pilih Asset</option>'
                            );
                            $.each(res, function(index, data) {
                                $('#assetTempat').append(
                                    `<option value="${data.id_assets}"> ${data.nama_assets} Lokasi (${data.nama_lokasi}) Sub Lokasi (${data.nama_subL}) </option>`
                                )
                            })
                            $("#assetTempat").val(asset).change();
                        }
                    })

                    // Sub Asset Drop Down
                    $('#assetTempat').on('change', function() {
                        var id = $(this).val();
                        if (id != '' && id != null) {
                            $.ajax({
                                url: "{{ url('') }}/subAsset/load/" + id,
                                type: "GET",
                                success: function(res) {
                                    $("#subTempat").children().remove();
                                    $("#subTempat").append(
                                        '<option selected disabled value="">Pilih Sub Asset</option>'
                                    );
                                    $('#subTempat').append(
                                        `<option value="0">Tanpa Sub</option>`)
                                    $.each(res, function(index, data) {
                                        $('#subTempat').append(
                                            '<option value="' + data.id + '">' +
                                            data
                                            .nama_subAsset + '</option>'
                                        )
                                    })
                                    $("#subTempat").val(sub).change();
                                }
                            })
                        }
                    });

                    // Label Kategori
                    $.ajax({
                        url: "{{ url('') }}/barang/editL/" + kate,
                        async: false,
                        success: function(res) {
                            Lkate = res.kode_barang;
                        }
                    });

                    // Label Asset
                    $.ajax({
                        url: "{{ url('') }}/assetsD/load/" + asset,
                        async: false,
                        success: function(data) {
                            LAsset = data.kode_asset;
                        }
                    });

                    // Label Sub
                    if (sub == 0) {
                        Lsub = "";
                    } else {
                        $.ajax({
                            url: "{{ url('') }}/subAsset/getLoad/" + sub,
                            async: false,
                            success: function(res) {
                                Lsub = res.kode_sub;
                            }
                        });
                    }

                    // Label Model
                    $.ajax({
                        url: "{{ url('') }}/modelE/load/" + model,
                        async: true,
                        success: function(res) {
                            Lmodel = res.kode_model;
                        }
                    });

                    // Label Merk
                    $.ajax({
                        url: "{{ url('') }}/merkE/load/" + merk,
                        success: function(res) {
                            Lmerk = res.kode_merk;
                        }
                    });
                }
            });

            // Formating Label Default
            var allVals = [];
            var custom = '';
            var kode_label;
            if (Lsub == '') {
                kode_label = `${LAsset}/${Lkate}01`;
            } else {
                kode_label = `${LAsset}/${Lsub}/${Lkate}01`;
            }

            // Label Merk
            $('#merk').click(function() {
                var val = $(this).attr('value');
                if ($('#merk').is(':checked')) {
                    allVals.push(val);
                } else {
                    for (var i = 0; i < allVals.length; i++) {
                        if (allVals[i] === val) {
                            allVals.splice(i, 1);
                            i--;
                        }
                    }
                }
                kode_label = getCustomLabel(allVals, Lmerk, Lmodel, ukuran, LAsset, Lsub, Lkate);
                $('#kode').val(kode_label).change();
            })

            // Label Model
            $('#model').click(function() {
                var val = $(this).attr('value');
                if ($('#model').is(':checked')) {
                    allVals.push(val);
                } else {
                    for (var i = 0; i < allVals.length; i++) {
                        if (allVals[i] === val) {
                            allVals.splice(i, 1);
                            i--;
                        }
                    }
                }
                kode_label = getCustomLabel(allVals, Lmerk, Lmodel, ukuran, LAsset, Lsub, Lkate);
                $('#kode').val(kode_label).change();
            })

            // Label Ukuran
            $('#ukuran').click(function() {
                var val = $(this).attr('value');
                if ($('#ukuran').is(':checked')) {
                    allVals.push(val);
                } else {
                    for (var i = 0; i < allVals.length; i++) {
                        if (allVals[i] === val) {
                            allVals.splice(i, 1);
                            i--;
                        }
                    }
                }
                kode_label = getCustomLabel(allVals, Lmerk, Lmodel, ukuran, LAsset, Lsub, Lkate);
                $('#kode').val(kode_label).change();
            })

            // Perubahan Kode
            $('#kode').val(kode_label).change();

            // Default Label
            $("#default").click(function() {
                $('#tambahLabel').hide();
                if (Lsub == '') {
                    kode_label = `${LAsset}/${Lkate}01`;
                } else {
                    kode_label = `${LAsset}/${Lsub}/${Lkate}01`;
                }

                $('#kode').val(kode_label).change();
            });

            // Menu Custom
            $("#custom").click(function() {
                $('#tambahLabel').show();
                allVals = [];
                custom = '';
                $("#ukuran").prop("checked", false);
                $("#merk").prop("checked", false);
                $("#model").prop("checked", false);
            });

            // Lokasi Gudang
            $.ajax({
                url: "{{ url('') }}/barangIn/assets/" + idOrd,
                success: function(res) {
                    $('html, body').css("cursor", "auto");
                    $("#assetLokasi").children().remove();
                    $("#assetLokasi").append(
                        '<option selected disabled value="">Pilih Gudang</option>');
                    $.each(res, function(index, x) {
                        $('#assetLokasi').append(
                            `<option value=${x.id_assets}>${x.nama_assets} Lokasi(${x.nama_lokasi}) Sub Lokasi(${x.nama_subL})</option>`
                        )
                    })
                    // var gudang = 2;
                    $("#assetLokasi").val(1047).change();
                }
            });

            $('#frmBarangIN').on('submit', function(e) {
                e.preventDefault();

                // console.log(kode);
                // $(".form-check-input:checked").each(function() {
                //     allVals.push($(this).attr('value'));
                // });
                // console.log(allVals);
                // console.log(id);
                $("#frmBarangIN").unbind().click(function() {});
                var gudang = $('#assetLokasi').val();
                var asset = $('#assetTempat').val();
                var sub = $('#subTempat').val();
                var kondisi = $(`input[name="penempatan"]:checked`).val();
                var kode = $('#kode').val();
                var ids = `<?php echo Session::get('id'); ?>`;
                kode = kode.substring(0, kode.length - 2);
                kode = kode.toUpperCase();
                // console.log(kondisi);
                $.ajax({
                    url: "{{ url('') }}/barangIn/up",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        gudang: gudang,
                        orders: idOrd,
                        kode: kode,
                        asset: asset,
                        sub: sub,
                        kondisi: kondisi,
                        ids: ids
                    },
                    success: function(res) {
                        // console.log(res);
                        $('#storeB').modal('hide');
                        $("#frmBarangIN")[0].reset();
                        $("#frmBarangIN").unbind().click(function() {});
                        $('#dt_barangIn').DataTable().ajax.reload();
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });

            });
        }

        function getCustomLabel(allVals, Lmerk, Lmodel, ukuran, LAsset, Lsub, Lkate) {
            var custom = '';
            for (let index = 0; index < allVals.length; index++) {
                if (allVals[index] == 1) {
                    if (index == 0) {
                        custom = custom + `${Lmerk}`;
                    } else if (index == 1) {
                        if (allVals.length == 2) {
                            custom = custom + `-${Lmerk}`;
                        } else {
                            custom = custom + `-${Lmerk}-`;
                        }
                    } else if (index == 2) {
                        custom = custom + `${Lmerk}`;
                    }
                } else if (allVals[index] == 2) {
                    if (index == 0) {
                        custom = custom + `${Lmodel}`;
                    } else if (index == 1) {
                        if (allVals.length == 2) {
                            custom = custom + `-${Lmodel}`;
                        } else {
                            custom = custom + `-${Lmodel}-`;
                        }

                    } else if (index == 2) {
                        custom = custom + `${Lmodel}`;
                    }
                } else {
                    if (index == 0) {
                        custom = custom + `${ukuran}`;
                    } else if (index == 1) {
                        if (allVals.length == 2) {
                            custom = custom + `-${ukuran}`;
                        } else {
                            custom = custom + `-${ukuran}-`;
                        }
                    } else if (index == 2) {
                        custom = custom + `${ukuran}`;
                    }
                }
            }
            var kode_label;

            if (Lsub == '') {
                if (custom == '') {
                    kode_label = `${LAsset}/${Lkate}01`;
                } else {
                    kode_label = `${LAsset}/${custom}/${Lkate}01`;
                }
            } else {
                if (custom == '') {
                    kode_label = `${LAsset}/${Lsub}/${Lkate}01`;
                } else {
                    kode_label = `${LAsset}/${Lsub}/${custom}/${Lkate}01`;
                }
            }
            return kode_label;
        }
    </script>

    {{-- Load Histori --}}
    <script>
        function loadHistori() {
            $('#dt_histori').DataTable().clear();
            $('#dt_histori').DataTable().destroy();
            $("#dt_histori").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/histori/load/" + 1,
                    "dataSrc": "",
                },

                "columns": [{
                        "data": "kode_order"
                    },
                    {
                        "data": "id_orders",
                        "render": function(data, type, row) { // Tampilkan kolom aksi
                            var html =
                                `<button class="btn btn-success" href="#gedung" data-bs-toggle="modal" data-bs-target="#detail" onclick="loadD(${data})">
                                <i class="fas fa-eye"></i> Item</button>`
                            return html;
                        }
                    },
                    {
                        "data": "updated_at"
                    },
                ],

            })
        }
    </script>
@endpush
