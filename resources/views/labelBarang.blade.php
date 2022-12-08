@extends('layouts\master')
@section('header-form')
    <h1>Gudang</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="\">Home</a></div>
        <div class="breadcrumb-item active">Gudang</div>
    </div>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-body">
            <ul class="nav nav-tabs justify-content-center" id="myTab6" role="tablist">
                <li class="nav-item">
                    <a class="nav-link text-center active" id="label-tab" data-toggle="tab" href="#listLabel" role="tab"
                        aria-controls="label" aria-selected="true" onclick="labelL()">
                        <span><i class="fas fa-tags"></i></span> Label</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" id="reLabel-tab" data-toggle="tab" href="#reLabel" role="tab"
                        aria-controls="reLabel" aria-selected="false" onclick="reLabel()">
                        <span><i class="fas fa-tag"></i></span> Re-Label</a>
                </li>
            </ul>
            <div class="tab-content tab-bordered" id="myTabContent6">
                <div class="tab-pane fade active show" id="listLabel" role="tabpanel" aria-labelledby="label-tab">
                    <div class="card-header card text-center">
                        <h4 style="color: #023e8a">List Label</h4>
                    </div>
                    <div class="card-body">
                        <table id="dt_label" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;"
                            aria-describedby="example_info">
                            <thead>
                                <tr>
                                    <th>Label Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Penempatan</th>
                                    <th>Detail</th>                                
                                    <th>Cetak Label</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="reLabel" role="tabpanel" aria-labelledby="reLabel-tab">
                    <div class="card">
                        <form class="needs-validation" id="frmReLabel">
                            @csrf
                            <div class="card-header card text-center">
                                <h4 style="color: #023e8a">Re-Label Barang</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label>Label Lama</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            name="oldLabel" id="oldLabel" required="">
                                            <option selected disabled value="">Pilih Label</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row" id="newLabel">
                                    <div class="col-sm-12">
                                        <label>Label Baru Privew</label>
                                        <input type="text" class="form-control" name="lable" id="reKode" readonly>
                                    </div>
                                </div>

                                <div id="menuLabeling">
                                    <div class="section-title">Labeling</div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="form-check-input" type="radio" name="label" id="reLabelB"
                                                    value="0" checked>
                                                <label class="form-check-label" for="inlineRadio2">Re Label</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="form-check-input" type="radio" name="label"
                                                    id="parentLabel" value="1">
                                                <label class="form-check-label" for="inlineRadio1">Child Label</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="menuTempat">
                                    <div class="section-title">Label Tempat</div>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="assetRe">
                                            <label class="form-check-label" for="inlineCheckbox1">Asset</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="subRe" disabled>
                                            <label class="form-check-label" for="inlineCheckbox2">Sub Asset</label>
                                        </div>
                                    </div>
                                    <div class="form-group" id="drpAsset">
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            name="klas" id="asset">
                                            <option selected disabled value="">Pilih Asset</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="drpSub">
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            name="klas" id="subAsset">
                                            <option selected disabled value="">Pilih Sub Asset</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="addReLabel">
                                    <div class="section-title">Label Spesifikasi</div>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="merkRe"
                                                value="1">
                                            <label class="form-check-label" for="inlineCheckbox1">Merk</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="modelRe"
                                                value="2">
                                            <label class="form-check-label" for="inlineCheckbox2">Model</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="ukuranRe"
                                                value="3">
                                            <label class="form-check-label" for="inlineCheckbox3">Ukuran</label>
                                        </div>
                                    </div>
                                </div>

                                <div id="childLabel">
                                    <div class="section-title">Label Induk</div>
                                    <div class="form-group" id="drpInduk">
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            name="klas" id="induk">
                                            <option selected disabled value="">Pilih Asset</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    {{-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-success">Simpan</button> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Perbaikan Modal --}}
<div class="modal fade" id="perbaikan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-header card text-center">
                <h4 style="color:darksalmon">Histori Perbaikan</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Perawatan Modal --}}
<div class="modal fade" id="perawatan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-header card text-center">
                <h4 style="color:darksalmon">Histori Perawatan</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cetak" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="printCetak">
                    <div id="qrcodes"></div>
                    <p id="kodeLabelB"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="printQr()">Print</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Detail Pesanan --}}
<div class="modal fade" id="detailOrd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body ">
                <div class="container-fluid">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card text-center" id="detailHead">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container-fluid">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-header card text-center">
                                    <h4 style="color: #023e8a">Detail Barang</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <strong class="col-5">Nama</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="namaD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Kategori</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="kateD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Tipe</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="tipeD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Merk</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="merkD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Model :</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="modelD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Warna :</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="warnaD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Ukuran :</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="ukuranD"></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container-fluid">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-header card text-center">
                                    <h4 style="color: #023e8a">Detail Pesanan</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <strong class="col-5">Vendor</strong>
                                        <strong class="col-1">:</strong>
                                        <strong class="col-5" id="vendorD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Lokasi Asset</strong>
                                        <strong class="col-1">:</strong>
                                        <strong class="col-5" id="assetD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Lokasi Sub Asset</strong>
                                        <strong class="col-1">:</strong>
                                        <strong class="col-5" id="subD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Jumlah</strong>
                                        <strong class="col-1">:</strong>
                                        <strong class="col-5" id="jlhD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Alasan</strong>
                                        <strong class="col-1">:</strong>
                                        <strong class="col-5" id="alasanD"></strong>
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

@push('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

    {{-- Modal Label --}}
    <script></script>

    {{-- Load Label --}}
    <script>
        $(document).ready(function() {

            $('#dt_label').DataTable().clear();
            $('#dt_label').DataTable().destroy();
            $("#dt_label").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/label/load/" + 1,
                    "dataSrc": "",
                },
                "columnDefs": [{
                    "targets": '_all',
                    "className": "dt-center",
                }],
                "columns": [{
                        "data": "kode_label"
                    },
                    {
                        "data": "nama",                        
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
                        "data": "nama_assets"
                    },                    
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-success" style="margin-bottom: 10px; margin-top: 10px;"><i
                                class="fas fa-eye"></i></button>`;
                            //
                            return html;
                        }
                    },                                        
                    {
                        "data": "kode_label",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#cetak" onclick="qrcode('${data}')" id="btnQR"><i
                                class="fas fa-print"></i></button>`;
                            //
                            return html;
                        }
                    },
                ],
            });
        });

        function labelL() {
            $('#dt_label').DataTable().ajax.reload();
        }
    </script>

    {{-- Re Label Js --}}
    <script>
        function reLabel() {
            var Lkate, Lmerk = 'MRK',
                Lmodel = 'MDL',
                LAsset, Lsub, ukuran;
            var Ldef, LdefSub;

            // Hidding Manu
            $('#childLabel').hide();
            $('#drpAsset').hide();
            $('#drpSub').hide();
            $('#newLabel').hide();
            $('#menuLabeling').hide();
            $("#menuTempat").hide();
            $('#addReLabel').hide();
            $("#induk").hide();

            // Select 2
            $("#asset").select2({});
            $('#oldLabel').select2();
            $("#subAsset").select2({});
            $("#induk").select2({});

            // Dropdown Label
            $.ajax({
                url: "{{ url('') }}/label/load/" + 1,
                type: "GET",
                success: function(res) {
                    $("#oldLabel").children().remove();
                    $("#oldLabel").append('<option selected disabled value="">Pilih Label</option>');
                    $.each(res, function(index, data) {
                        $('#oldLabel').append(
                            `<option value="${data.id_order}"> ${data.kode_label} </option>`
                        )
                    })
                }
            })

            // Label Change
            $('#oldLabel').on('change', function(e) {
                e.preventDefault();

                $("#menuTempat").show();
                $('#addReLabel').show();
                $("#induk").show();

                var id = $(this).val();

                if (id != null || id != '') {

                    $('#newLabel').show();

                    // Set Up Label
                    $.ajax({
                        url: "{{ url('') }}/barangIn/kode/" + id,
                        async: false,
                        beforeSend: function() {
                            $('html, body').css("cursor", "wait");
                        },
                        success: function(res) {
                            $('html, body').css("cursor", "auto");
                            var kate = res[0].id_barangIven;
                            var model = res[0].id_model;
                            var merk = res[0].id_merk;
                            var asset = res[0].id_assets;
                            var sub = res[0].id_sub;
                            ukuran = res[0].ukuran;

                            $.ajax({
                                url: "{{ url('') }}/barang/editL/" + kate,
                                async: false,
                                success: function(res) {
                                    Lkate = res.kode_barang;
                                }
                            });

                            $.ajax({
                                url: "{{ url('') }}/assetsD/load/" + asset,
                                async: false,
                                success: function(res) {
                                    LAsset = res.kode_asset;
                                    console.log(res.kode_asset);
                                }
                            });

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
                            $.ajax({
                                url: "{{ url('') }}/modelE/load/" + model,
                                async: true,
                                success: function(res) {
                                    Lmodel = res.kode_model;
                                }
                            });

                            $.ajax({
                                url: "{{ url('') }}/merkE/load/" + merk,
                                success: function(res) {
                                    Lmerk = res.kode_merk;
                                }
                            });
                        }
                    });

                    var allVals = [];
                    var custom = '';

                    var kode_label;

                    // Format Label
                    if (Lsub == '') {
                        kode_label = `${LAsset}/${Lkate}01`;
                    } else {
                        kode_label = `${LAsset}/${Lsub}/${Lkate}01`;
                    }

                    $('#reKode').val(kode_label).change();

                    //Dropdown Asset
                    $.ajax({
                        url: "{{ url('') }}/assets/load/" + 1,
                        type: "GET",
                        success: function(res) {
                            $("#asset").children().remove();
                            $("#asset").append(
                                '<option selected disabled value="">Pilih Asset</option>');
                            $.each(res, function(index, data) {
                                $('#asset').append(
                                    `<option value="${data.id_assets}"> ${data.nama_assets} Lokasi (${data.nama_lokasi}) Sub Lokasi (${data.nama_subL}) </option>`
                                )
                            })
                        }
                    })

                    // Sub Asset Drop Down && Asset Label Change
                    $('#asset').on('change', function(e) {
                        e.preventDefault();
                        var id = $(this).val();

                        $.ajax({
                            url: "{{ url('') }}/assetsD/load/" + id,
                            success: function(res) {
                                LAsset = res.kode_asset;
                                kode_label = getCustomLabel(allVals, Lmerk, Lmodel, ukuran,
                                    LAsset, Lsub,
                                    Lkate);
                                $('#reKode').val(kode_label).change();
                            }
                        });

                        $("#subAsset").children().remove();
                        $("#subAsset").append(
                            '<option selected disabled value="">Pilih Sub Asset</option>');

                        if (id != '' || id != null) {
                            $.ajax({
                                url: "{{ url('') }}/subAsset/load/" + id,
                                type: "GET",
                                success: function(res) {
                                    $('#subAsset').append(
                                        '<option value="0">' +
                                        "Tanpa Sub" + '</option>'
                                    )
                                    $.each(res, function(index, data) {
                                        $('#subAsset').append(
                                            '<option value="' + data.id + '">' +
                                            data
                                            .nama_subAsset + '</option>'
                                        )
                                    })
                                }
                            })
                        }
                    });

                    // Sub Asset Label Change
                    $('#subAsset').on('change', function(e) {
                        e.preventDefault();
                        var id = $(this).val();

                        if (id > 0) {
                            $.ajax({
                                url: "{{ url('') }}/subAsset/getLoad/" + id,
                                success: function(res) {
                                    console.log(res);
                                    Lsub = res[0].kode_sub;
                                    kode_label = getCustomLabel(allVals, Lmerk, Lmodel, ukuran,
                                        LAsset, Lsub,
                                        Lkate);
                                    $('#reKode').val(kode_label).change();
                                }
                            });
                        }
                    });

                    // Label Asset
                    $('#assetRe').click(function() {
                        var val = $(this).attr('value');
                        if ($('#assetRe').is(':checked')) {
                            $('#drpAsset').show();
                            $('#drpSub').hide();
                            $('#subRe').prop('disabled', false);
                        } else {
                            $('#subRe').prop('checked', false);
                            $('#subRe').prop('disabled', true);
                            $('#drpAsset').hide();
                            $('#drpSub').hide();
                            $("#ukuranRe").prop("checked", false);
                            $("#merkRe").prop("checked", false);
                            $("#modelRe").prop("checked", false);
                            LAsset = Ldef;
                            Lsub = LdefSub;
                            allVals = [];
                        }
                        kode_label = getCustomLabel(allVals, Lmerk, Lmodel, ukuran, LAsset, Lsub, Lkate);
                        $('#reKode').val(kode_label).change();
                    })

                    // Label Sub
                    $('#subRe').click(function() {
                        var val = $(this).attr('value');
                        if ($('#subRe').is(':checked')) {
                            $('#drpSub').show();
                        } else {
                            $('#drpSub').hide();
                            Lsub = '';
                        }
                        kode_label = getCustomLabel(allVals, Lmerk, Lmodel, ukuran, LAsset, Lsub, Lkate);
                        $('#reKode').val(kode_label).change();
                    })

                    // Label Merk
                    $('#merkRe').click(function() {
                        var val = $(this).attr('value');
                        if ($('#merkRe').is(':checked')) {
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
                        $('#reKode').val(kode_label).change();
                    })

                    // Label Model
                    $('#modelRe').click(function() {
                        var val = $(this).attr('value');
                        if ($('#modelRe').is(':checked')) {
                            allVals.push(val);
                            console.log(allVals);
                        } else {
                            for (var i = 0; i < allVals.length; i++) {
                                if (allVals[i] === val) {
                                    allVals.splice(i, 1);
                                    i--;
                                }
                            }
                            console.log(allVals);
                        }
                        kode_label = getCustomLabel(allVals, Lmerk, Lmodel, ukuran, LAsset, Lsub, Lkate);
                        $('#reKode').val(kode_label).change();
                    })

                    // Label Ukuran
                    $('#ukuranRe').click(function() {
                        var val = $(this).attr('value');
                        if ($('#ukuranRe').is(':checked')) {
                            allVals.push(val);
                        } else {
                            for (var i = 0; i < allVals.length; i++) {
                                if (allVals[i] === val) {
                                    allVals.splice(i, 1);
                                    i--;
                                }
                            }
                        }
                        console.log(allVals);
                        kode_label = getCustomLabel(allVals, Lmerk, Lmodel, ukuran, LAsset, Lsub, Lkate);
                        $('#reKode').val(kode_label).change();
                    })

                    // Label Induk
                    $.ajax({
                        url: "{{ url('') }}/label/load/" + 1,
                        type: "GET",
                        success: function(res) {
                            $("#induk").children().remove();
                            $("#induk").append(
                                '<option selected disabled value="">Pilih Induk</option>');
                            $.each(res, function(index, data) {
                                if (data.id != id) {
                                    $('#induk').append(
                                        `<option value="${data.id}"> ${data.kode_label} </option>`
                                    )
                                }
                            })
                        }
                    })
                }
            });


            $("#reLabelB").click(function() {
                $('#childLabel').hide();
                $('#addTempat').show();
                $('#addReLabel').show();
                LAsset = Ldef;
                Lsub = LdefSub;
                allVals = [];
                if (Lsub == '') {
                    kode_label = `${LAsset}/${Lkate}01`;
                } else {
                    kode_label = `${LAsset}/${Lsub}/${Lkate}01`;
                }

                $('#kode').val(kode_label).change();
            });

            $("#parentLabel").click(function() {
                $('#childLabel').show();
                custom = '';
                $('#addTempat').hide();
                $('#addReLabel').hide();
                $("#ukuranRe").prop("checked", false);
                $("#merkRe").prop("checked", false);
                $("#modelRe").prop("checked", false);
                $('#assetRe').prop('checked', false);
                LAsset = Ldef;
                Lsub = LdefSub;
                allVals = [];
                if (Lsub == '') {
                    kode_label = `${LAsset}/${Lkate}01`;
                } else {
                    kode_label = `${LAsset}/${Lsub}/${Lkate}01`;
                }

                $('#kode').val(kode_label).change();
            });

            $('#frmReLabel').on('submit', function(e) {
                // e.preventDefault();
                let kode = $('#reKode').val();
                kode = kode.substring(0, kode.length - 2);
                // $(".form-check-input:checked").each(function() {
                //     allVals.push($(this).attr('value'));
                // });
                // console.log(allVals);
                // console.log(id);
                // $.ajax({
                //     url: "{{ url('') }}/barangIn/up",
                //     type: "POST",
                //     data: {
                //         "_token": "{{ csrf_token() }}",
                //         lokasi: lokasi,
                //         orders: id
                //     },
                //     success: function(res) {
                //         // console.log(res);
                //         $('#storeB').modal('hide');
                //         $("#frmBarangIN")[0].reset();
                //         $('#dt_barangIn').DataTable().ajax.reload();
                //         swal({
                //             icon: "success",
                //             text: res['success']
                //         });
                //     }
                // });
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

    {{-- QR --}}
    <script>
        function qrcode(id) {
            // $("#btnQR").unbind().click(function() {});
            $("#qrcodes").empty();
            var url = "http://portaluniversitasquality.ac.id:6923/appAsst1/public/labelD/" + id;
            new QRCode(document.getElementById("qrcodes"), url);
            document.getElementById('kodeLabelB').innerText = id;
        }

        function printQr() {
            let popupWin = window.open('Tes', '_blank', 'width=1000,height=595');
            let printContents = document.getElementById("printCetak").innerHTML;
            let printHead = document.head.innerHTML;
            popupWin.document
                .write(`<html><body onload="window.print();">${printContents}</body></html>`);
            popupWin.document.close();
        }
    </script>
@endpush
