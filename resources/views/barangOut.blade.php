@extends('layouts\master')
@section('header-form')
    <h1>Barang Out </h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="\">Home</a></div>
        <div class="breadcrumb-item active">Barang Out</div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs justify-content-center" id="myTab6" role="tablist">
                <li class="nav-item">
                    <a class="nav-link text-center active" id="home-tab6" data-toggle="tab" href="#home6" role="tab"
                        aria-controls="home" aria-selected="true">
                        <span><i class="fas fa-warehouse"></i><i class="fas fa-truck"></i></span> Barang Keluar</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link text-center" id="profile-tab6" data-toggle="tab" href="#profile6" role="tab"
                        aria-controls="profile" aria-selected="false">
                        <span><i class="fas fa-warehouse"></i><i class="fas fa-undo"></i></span> Pengembalian</a>
                </li> --}}
            </ul>
            <div class="tab-content tab-bordered" id="myTabContent6">
                <div class="tab-pane fade active show" id="home6" role="tabpanel" aria-labelledby="home-tab6">
                    <div class="card card-primary">
                        <div class="card-header card text-center">
                            <h4>Request Barang Keluar</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#barangOut"
                                    onclick="tambahBrg()" id="addOut">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                </a>
                                {{-- <a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#histori"
                                    onclick="loadHistori()"><i class="fas fa-book-open"></i>
                                    History
                                </a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_barangOut" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        {{-- <th><input type="checkbox" id="check-all"></th> --}}
                                        <th>Kode Order</th>
                                        <th>To Asset</th>
                                        <th>To Sub Assets</th>
                                        <th>Tanggal Keluar</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- <div class="tab-pane fade" id="profile6" role="tabpanel" aria-labelledby="profile-tab6">
                    <div class="card card-primary">
                        <div class="card-header card text-center">
                            <h4>Request Barang Keluar</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-primary"><i class="fas fa-boxes"></i>
                                    Store All
                                </a>
                                <a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#histori"
                                    onclick="loadHis()"><i class="fas fa-book-open"></i>
                                    History
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_Return" class="display nowrap dataTable dtr-inline collapsed"
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
                </div> --}}
            </div>
        </div>
    </div>
@endsection
@include('Modal\barangOutModal')
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

    {{-- Load Barang Out --}}
    <script>
        $(document).ready(function() {
            // $('#items').show();
            $('#delAdd').hide();
            var ids = `<?php echo Session::get('id'); ?>`;
            $('#dt_barangOut').DataTable().clear();
            $('#dt_barangOut').DataTable().destroy();
            $("#dt_barangOut").DataTable({
                "scrollX": 200,
                "processing": true,
                "ajax": {
                    "url": "{{ url('') }}/barangOut/load/" + 1,
                    "dataSrc": "",
                },

                "columns": [{
                        "data": "kode_label"
                    },
                    {
                        "data": "id_toAsset",
                        "render": function(data, type, row, meta) {
                            var html = '';

                            if (data != 0) {
                                var currentCell = $("#dt_barangOut").DataTable().cells({
                                    "row": meta.row,
                                    "column": meta.col
                                }).nodes(0);
                                $.ajax({
                                    url: "{{ url('') }}/assetsD/load/" + data,
                                }).done(function(res) {
                                    $(currentCell).text(res.nama_assets);
                                });
                                return null;

                            } else {
                                html = 'Tanpa Sub';
                                return html;
                            }
                        }
                    },
                    {
                        "data": "id_toSub",
                        "render": function(data, type, row, meta) {
                            var html = '';

                            if (data != 0) {
                                var currentCell = $("#dt_barangOut").DataTable().cells({
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
        });
    </script>

    {{-- Tambah Histori Barang Keluar --}}
    <script>
        var set = [];

        function tambahBrg() {
            // $("#subAsset").hide();
            // var label = '';
            $("#label0").select2({
                dropdownParent: $("#barangOut")
            })
            $("#assets0").select2({
                dropdownParent: $("#barangOut")
            })
            $("#sub0").select2({
                dropdownParent: $("#barangOut")
            })
            $("#gudang").select2({
                dropdownParent: $("#barangOut")
            })

            $.ajax({
                url: "{{ url('') }}/barangIn/assets/" + 1,
                success: function(res) {
                    $("#gudang").children().remove();
                    $("#gudang").append(
                        '<option selected value="">Pilih Gudang</option>');
                    $.each(res, function(index, x) {
                        $('#gudang').append(
                            '<option value="' + x.id_assets + '">' + x
                            .nama_assets + '</option>'
                        )
                    })
                }
            });

            $('#label0').prop('disabled', true);
            $('#gudang').on('change', function() {
                var idGd = $(this).val();
                $('#label0').prop('disabled', true);
                if (idGd != '' && idGd != null) {
                    $('#label0').prop('disabled', false);
                    $.ajax({
                        url: "{{ url('') }}/barangOut/getLebel/" + idGd,
                        success: function(res) {
                            $("#label0").children().remove();
                            // $("#label0").append(
                            //     '<option selected value="">Pilih Lokasi</option>');
                            $.each(res, function(index, x) {
                                $('#label0').append(
                                    '<option value="' + x.id + '">' + x
                                    .kode_label + '</option>'
                                )
                            })
                        }
                    });
                }
            });

            $.ajax({
                url: "{{ url('') }}/barangOut/getAsset/" + 1,
                success: function(res) {
                    $("#assets0").children().remove();
                    $("#assets0").append(
                        '<option selected value="">Pilih Lokasi</option>');
                    $.each(res, function(index, x) {
                        $('#assets0').append(
                            '<option value="' + x.id_assets + '">' + x
                            .nama_assets + '</option>'
                        )
                    })
                }
            });

            $('#assets0').on('change', function() {
                var id = $(this).val();
                if (id != '' && id != null) {
                    $.ajax({
                        url: "{{ url('') }}/subAsset/load/" + id,
                        success: function(res) {

                            $("#sub0").children().remove();
                            $("#sub0").append(
                                '<option selected value="">Pilih Sub Assets</option>');
                            $("#sub0").append(
                                '<option value="0"> Tanpa Sub</option>');
                            $.each(res, function(index, data) {
                                $('#sub0').append(
                                    '<option value="' + data.id + '">' + data
                                    .nama_subAsset + '</option>'
                                )
                            })
                            $("#subAsset").show();
                        }
                    })
                }
            });

            $('#frmBarangOut').on('submit', function(e) {
                const label = [];
                var gudang = $('#gudang').val();
                var assets = $('#assets0').val();
                var sub = $('#sub0').val();
                var ids = `<?php echo Session::get('id'); ?>`;
                e.preventDefault();


                let panjang = $('#count').val();
                for (let index = 0; index <= panjang; index++) {
                    label.push($('#label' + index).val());
                }
                // var areEqual = vendor.toUpperCase() === cek.toUpperCase();
                var same = 0;
                // console.log(label);
                $.ajax({
                    url: "{{ url('') }}/barangOut/store",
                    type: "POST",
                    dataType: "json",
                    // traditional: true,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        label: label,
                        gudang: gudang,
                        assets: assets,
                        sub: sub,
                        ids: ids
                    },
                    success: function(res) {
                        $('#barangOut').modal('hide');
                        $("#frmBarangOut")[0].reset();
                        $('#dt_barangOut').DataTable().ajax.reload();
                        // console.log(res);
                        swal({
                            icon: "success",
                            text: "Barang Sudah Dikeluarkan"
                        });
                        document.getElementById("labelAdd").innerHTML = "";
                    }
                });
            });

        }
        $(document).ready(function() {
            $('#barangOut').on('hidden.bs.modal', function(e) {
                // label = [];
                $("#frmBarangOut").unbind().click(function() {
                    //Stuff
                });

            })
        });
    </script>

    {{-- Auto Add Form Out --}}
    <script>
        function myFunction() {
            $('#delAdd').show();

            var count = document.getElementById("count").value;
            var tes = $('#label' + count).val();
            tes.forEach(element => {
                set.push(element);
            });
            $('#label' + count).prop("disabled", true);
            count++;

            var phoneNumber = document.getElementById("labelAdd");
            var div = document.createElement("div");
            div.innerHTML = `<div class="tab-content tab-bordered" id="add${count}">
                            <div class="tab-pane fade show active" id="home2" role="tabpanel"
                                aria-labelledby="home-tab2">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputCity">Label Barang</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" id="label${count}" multiple>
                                            <option selected disabled value="">Pilih Label</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Dipilih
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Lokasi</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" id="assets${count}">
                                            <option selected disabled value="">Pilih Lokasi</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Dipilih
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4" id="subAsset${count}">
                                        <label for="inputState">Sub Asset</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" id="sub${count}">
                                            <option selected value="0">Tanpa Sub</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Dipilih
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
            phoneNumber.appendChild(div);
            $("#label" + count).select2({
                dropdownParent: $("#barangOut")
            });
            $("#assets" + count).select2({
                dropdownParent: $("#barangOut")
            });
            $("#sub" + count).select2({
                dropdownParent: $("#barangOut")
            });

            $("#subAsset" + count).hide();
            $.ajax({
                url: "{{ url('') }}/barangOut/getLebel/" + 1,
                success: function(res) {
                    $("#label" + count).children().remove();
                    // $("#label0").append(
                    //     '<option selected value="">Pilih Lokasi</option>');
                    $.each(res, function(index, x) {
                        $('#label' + count).append(
                            '<option value="' + x.kode_label + '">' + x
                            .kode_label + '</option>'
                        )
                    })
                    var gab = `#label${count}`;
                    set.forEach(element => {
                        $(`${gab} option[value=${element}]`).remove();
                    });

                }
            });

            $.ajax({
                url: "{{ url('') }}/barangOut/getAsset/" + 1,
                success: function(res) {
                    $("#assets" + count).children().remove();
                    $("#assets" + count).append(
                        '<option selected value="">Pilih Lokasi</option>');
                    $.each(res, function(index, x) {
                        $('#assets' + count).append(
                            '<option value="' + x.id_assets + '">' + x
                            .nama_assets + '</option>'
                        )
                    })
                }
            });

            $('#assets' + count).on('change', function() {
                var id = $(this).val();
                if (id != '' && id != null) {
                    $.ajax({
                        url: "{{ url('') }}/subAsset/load/" + id,
                        success: function(res) {
                            if (res == null || res == '') {
                                $("#subAsset" + count).hide();
                            } else {
                                $("#sub" + count).children().remove();
                                $("#sub" + count).append(
                                    '<option selected value="">Pilih Sub Assets</option>');
                                $("#sub" + count).append(
                                    '<option value="0">Tanpa Sub</option>');
                                $.each(res, function(index, data) {
                                    $('#sub' + count).append(
                                        '<option value="' + data.id + '">' + data
                                        .nama_subAsset + '</option>'
                                    )
                                })
                                $("#subAsset" + count).show();
                            }
                        }
                    })
                }
            });

            document.getElementById("count").value = count;
        }

        function close1() {
            var countE = document.getElementById("count").value;
            var tes = $('#label' + countE).val();

            if (tes != 0) {
                tes.forEach(element => {
                    var index = set.indexOf(element);
                    if (index > -1) {
                        set.splice(index, 1);
                    }
                });
                // alert('tes');
            }
            var elem = document.getElementById(`add${countE}`);
            elem.remove();
            countE--;
            document.getElementById("count").value = countE;
            $('#label' + countE).prop("disabled", false);
            if (document.getElementById("count").value == 0) {
                $('#delAdd').hide();
            }
        }
    </script>

    {{-- Detail Load --}}
    <script>
        function loadD(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "detail/ord/" + id,
                success: function(data) {
                    var html;
                    html = `<div class="card-header card text-center">
                        <h4>Detail Barang</h4>
                        <h4>(${data.kode_order})</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="form-group row" id="A">
                                {{-- Barang --}}
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" class="form-control" readonly
                                     value="${data.nama_barang}">
                                </div>

                                {{-- Vendor --}}
                                <div class="form-group">
                                    <label>Nama Vendor</label>
                                    <input type="text" class="form-control" readonly
                                     value="${data.nama_vendor}">
                                </div>

                                {{-- Pemesan --}}
                                <div class="form-group">
                                    <label>Nama Pemesan</label>
                                    <input type="text" class="form-control" readonly
                                        placeholder="Nama Pemesan Barang" value="${data.nama_pemesan}">
                                </div>

                                {{-- Pembeli --}}
                                <div class="form-group">
                                    <label>Nama Pembeli</label>
                                    <input type="text" class="form-control" readonly
                                        placeholder="Nama Pembeli Barang" value="${data.nama_cek}">
                                </div>

                                {{-- Validator --}}
                                <div class="form-group">
                                    <label>Nama Validator</label>
                                    <input type="text" class="form-control" readonly placeholder="Nama Validator"
                                        value="${data.nama_valid}">
                                </div>

                                {{-- Harga --}}
                                <div class="form-group">
                                    <label>Harga Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Harga Barang"
                                        value="${data.harga}">
                                </div>
                            </div>

                            <div class="form-group row" id="B">
                                {{-- Model --}}
                                <div class="form-group">
                                    <label>Model Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Model Barang"
                                        value="${data.model}">
                                </div>

                                {{-- Merk --}}
                                <div class="form-group">
                                    <label>Merk Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Merk Barang"
                                        value="${data.merk}">
                                </div>

                                {{-- Warna --}}
                                <div class="form-group">
                                    <label>Warna Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Warna Barang"
                                        value="${data.warna}">
                                </div>

                                {{-- Ukuran --}}
                                <div class="form-group">
                                    <label>Ukuran Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Ukuran Barang"
                                        value="${data.ukuran}">
                                </div>

                                {{-- Jumlah --}}
                                <div class="form-group">
                                    <label>Jumlah Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Jumlah Barang"
                                        value="${data.jlh_barang}">
                                </div>

                                {{-- Alasan --}}
                                <div class="form-group">
                                    <label>Alasan Pembelian</label>
                                    <input type="text" class="form-control" readonly placeholder="Alasan Pembelian"
                                        value="${data.alasan_beli}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
                    $('#tes').html(html);
                }
            })
        }
    </script>

    {{-- Store Individu Js --}}
    <script>
        function store(id) {
            $('#assetLokasi').select2({
                dropdownParent: $("#storeB")
            });
            $.ajax({
                url: "{{ url('') }}/barangIn/assets/" + 1,
                success: function(res) {
                    // console.log(res);
                    $("#assetLokasi").children().remove();
                    $("#assetLokasi").append(
                        '<option selected value="">Pilih Assets</option>');
                    $.each(res, function(index, x) {
                        $('#assetLokasi').append(
                            '<option value="' + x.id_assets + '">' + x
                            .nama_assets +
                            ` (Lokasi ${x.nama_lokasi}, Sub Lokasi ${x.nama_subL}, Kategori ${x.nama_kategori})` +
                            '</option>'
                        )
                    })
                }
            });

            $('#frmBarangIN').on('submit', function(e) {
                e.preventDefault();

                let lokasi = $('#assetLokasi').val();
                console.log(lokasi);
                console.log(id);
                $.ajax({
                    url: "{{ url('') }}/barangIn/up",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        lokasi: lokasi,
                        orders: id
                    },
                    success: function(res) {
                        // console.log(res);
                        $('#storeB').modal('hide');
                        $("#frmBarangIN")[0].reset();
                        $('#dt_barangIn').DataTable().ajax.reload();
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });
            });
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
