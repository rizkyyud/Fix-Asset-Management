@extends('layouts\master')
@section('header-form')
    <h1>Pembelian Barang</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="\">Home</a></div>
        <div class="breadcrumb-item">Pembelian Barang
        </div>
    </div>
@endsection
@section('content')
    <div class="card card-primary" id="itemIn" style="display: none">
        <div class="card-body">
            <div class="tab-content tab-bordered">
                <div class="tab-pane fade show active">
                    <div class="card">
                        <form class="needs-validation was-validated" id="frmItemAdd">
                            @csrf
                            <div class="card-header card text-center">
                                <h4 style="color: #023e8a">Form Penambahan Pembelian</h4>
                                <div class="card-header-action">
                                    <a href="#" class="btn btn-primary" onclick="backList()">
                                        <i class="fas fa-arrow-alt-circle-left"></i> Hide
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label>Nama Barang</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" id="barangIn">
                                            <option value="" disabled selected hidden>Pilih Barang</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Dipilih
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Vendor</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" id="vendorIn">
                                            <option value="" disabled selected hidden>Pilih Vendor</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Dipilih
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label>Lokasi Asset</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" id="assetIn">
                                            <option value="" disabled selected hidden>Pilih Asset</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Dipilih
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Lokasi Sub Asset</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" id="subIn">
                                            <option value="" disabled selected hidden>Pilih Sub Asset</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Dipilih
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label>Harga Barang</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" placeholder="0" class="form-control" id="hargaIn"
                                                required="">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            Harus Diisi
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Jumlah Barang</label>
                                        <input type="number" min="1" class="form-control" name="jlh"
                                            id="jlhIn" placeholder="0" required="">
                                        <div class="invalid-feedback">
                                            Harus Diisi
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label>Alasan Pembelian</label>
                                        <input type="text" class="form-control" name="alasan" id="alasanIn"
                                            placeholder="Alasan" required="">
                                        <div class="invalid-feedback">
                                            Harus Diisi
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label>Tanggal Pembelian</label>
                                        <input type="date" class="form-control" name="tglBeli" id="tglBeli"
                                            required="">
                                        <div class="invalid-feedback">
                                            Harus Diisi
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button class="btn btn-success" type="submit">Tambah Barang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-body">
            <ul class="nav nav-tabs justify-content-center" id="myTab6" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-center" id="lokasi-tab" data-toggle="tab" href="#lokasi"
                        role="tab" aria-controls="home" aria-selected="true" onclick="loadList()">
                        <span><i class="fas fa-shopping-bag"></i></span> List Pembelian</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" id="subL-tab" data-toggle="tab" href="#subLokasi" role="tab"
                        aria-controls="profile" aria-selected="false" onclick="loadAdd()">
                        <span><i class="fas fa-cart-plus"></i></span> Pembelian</a>
                </li>
            </ul>
            <div class="tab-content tab-bordered" id="myTabContent6">
                <div class="tab-pane fade show active" id="lokasi" role="tabpanel" aria-labelledby="lokasi-tab">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4 style="color: #023e8a">List Pembelian</h4>
                        </div>
                        <div class="card-body">
                            <table id="dt_pembelian" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Nama Pemesan</th>
                                        <th>Harga(/ Item)</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Pembelian</th>
                                        <th>Dokumen</th>
                                        <th>Detail Pesanan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="subLokasi" role="tabpanel" aria-labelledby="subL-tab">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4 style="color: #023e8a">Penambahan Pembelian</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" onclick="itemAdd()">
                                    <i class="fas fa-plus-circle"></i> Isi Keranjang
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_list" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;" aria-describedby="example_info">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Barang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-success" id="pesanB" onclick="setBeli()"
                                    style="display: none"><i class="fas fa-check-circle"></i> Beli </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('Modal\pembelianModal')

@push('page-scripts')
    {{-- Unbind Click --}}
    <script>
        $(document).ready(function() {

        });
    </script>

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

    {{-- ======================== Load Data Function ======================== --}}

    {{-- Load Document --}}
    <script>
        $(document).ready(function() {
            $('#listPembelian').show();
            $('#listTambah').hide();
            $('#itemIn').hide();

            $('#dt_pembelian').DataTable().clear();
            $('#dt_pembelian').DataTable().destroy();
            $("#dt_pembelian").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "className": "dt-center",
                }],
                "ajax": {
                    "url": "{{ url('') }}/pembelian/load/" + 1,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "nama_barang"
                    },
                    {
                        "data": "nama"
                    },
                    {
                        "data": "harga",
                        "render": function(data, type, row, meta) {
                            var html = formatRupiah(data.toString(), 'Rp.');

                            return html;
                        }
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
                        "data": "orderId",
                        "render": function(data, type, row, meta) {
                            var html = '';
                            var nama = row["nama_barang"];
                            var status = row["status"];
                            html = `<button class="btn btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#dokumenOrd" onclick="dok(${data}, '${nama}','${status}')"><i class="fas fa-folder"></i>
                                        </button>`;

                            return html;
                        }
                    },
                    {
                        "data": "id_orders",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var cekData = 0;
                            var kode = row['kode'];
                            var html =
                                `<div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                <button class="btn btn-success" onclick="detailOrd(${data},'${kode}')" data-bs-toggle="modal" data-bs-target="#detailOrd"><i class="fas fa-eye"></i>
                            </button>`;
                            return html;
                        }
                    },
                ],
            })
        });

        function backList() {
            $('#listPembelian').hide();
            $('#listTambah').show();
            $('#itemIn').hide();
        }
    </script>

    {{-- Load Tambah Pembelian --}}
    <script>
        function loadAdd() {
            $('#listPembelian').hide();
            $('#itemIn').hide();
            $('#listTambah').show();
            var ids = `<?php echo Session::get('id'); ?>`;

            $('#dt_list').DataTable().clear();
            $('#dt_list').DataTable().destroy();
            var list1 = $("#dt_list").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "className": "dt-center",
                }],
                "ajax": {
                    "url": "{{ url('') }}/pembelian/list/" + ids,
                    "dataSrc": "",
                    "data": {
                        "id": ids
                    }
                },
                "columns": [{
                        "data": "nama_barang"
                    },
                    {
                        "data": "jumlah"
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var cekData = 0;

                            var kode = row['kode'];
                            var html =
                                `<div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                    <button onclick="detailOrd(${data},'${kode}')" data-bs-toggle="modal" data-bs-target="#detailOrd" class="btn btn-icon btn-success"><i class="fas fa-eye"></i></button>
                                    
                                    <button onclick="deleteList(${data})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>        
                                </div>`;
                            return html;
                        }
                    },
                ],
            })

            $.ajax({
                url: "{{ url('') }}/pembelian/list/" + ids,
                success: function(res) {
                    if (res.length > 0) {
                        $('#pesanB').show();
                    } else {
                        $('#pesanB').hide();
                    }
                }
            })
        }
    </script>

    {{-- Load List --}}
    <script>
        function loadList() {
            $('#listPembelian').show();
            $('#listTambah').hide();
            $('#itemIn').hide();
            $('#dt_pembelian').DataTable().ajax.reload();
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
            console.log(id);
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
                        document.getElementById('assetD').innerHTML =
                            `${data.nama_assets} Lokasi (${data.nama_lokasi}) Sub Lokasi (${data.nama_subL})`;
                        document.getElementById('subD').innerHTML = `${data.nama_subAsset}`;
                        document.getElementById('jlhD').innerHTML = `${data.jumlah}`;
                        document.getElementById('alasanD').innerHTML = `${data.alasan}`;
                    })
                }
            })
        }
    </script>

    {{-- ======================== Tambah Function ======================== --}}

    {{-- Penambahan Pembelian --}}
    <script>
        function itemAdd() {
            // document.getElementById('itemHead').innerHTML = `Penambahan Item <br> (${nama})`;
            $('#listPembelian').hide();
            $('#listTambah').hide();
            $('#itemIn').show();

            $("#frmItemAdd").unbind().click(function() {});

            $("#vendorIn").select2({
                dropdownParent: $("#itemIn")
            })

            $("#assetIn").select2({
                dropdownParent: $("#itemIn")
            })

            $("#subIn").select2({
                dropdownParent: $("#itemIn")
            })

            $("#barangIn").select2({
                dropdownParent: $("#itemIn")
            })

            var rupiah = document.getElementById('hargaIn');
            rupiah.addEventListener('keyup', function(e) {
                rupiah.value = formatRupiah(this.value);
            });

            // Barang Drop Down
            $.ajax({
                url: "{{ url('') }}/barang/load/" + 1,
                type: "GET",
                success: function(res) {
                    $("#barangIn").children().remove();
                    $("#barangIn").append('<option selected value="">Pilih Barang</option>');
                    $.each(res, function(index, data) {
                        $('#barangIn').append(
                            `<option value="${data.id}"> ${data.nama} </option>`
                        )
                    })
                }
            })

            // Asset Drop Down
            $.ajax({
                url: "{{ url('') }}/assets/load/" + 1,
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
            $('#barangIn').on('change', function() {
                var ids = $(this).val();

                if (ids != '' && ids != null) {
                    $.ajax({
                        url: "{{ url('') }}/pesanan/getVendor/" + ids,
                        type: "GET",
                        success: function(res) {
                            $("#vendorIn").children().remove();
                            $("#vendorIn").append('<option selected value="">Pilih Vendor</option>');
                            $.each(res, function(index, data) {
                                $('#vendorIn').append(
                                    `<option value=${data.id_vendor}>${data.nama_vendor}</option>`
                                )
                            })
                        }
                    })
                }
            });

            $('#frmItemAdd').on('submit', function(e) {
                e.preventDefault();
                $("#frmItemAdd").unbind().click(function() {});
                let id = $('#barangIn').val();
                let asset = $('#assetIn').val();
                let alasan = $('#alasanIn').val();
                let harga = $('#hargaIn').val();
                let jumlah = $('#jlhIn').val();
                let sub = $('#subIn').val();
                let vendor = $('#vendorIn').val();
                var ids = `<?php echo Session::get('id'); ?>`;
                var tglBeli = $('#tglBeli').val();
                harga = convertToAngka(harga);

                $.ajax({
                    url: "{{ url('') }}/pembelian/in",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        barang: id,
                        asset: asset,
                        alasan: alasan,
                        harga: harga,
                        jumlah: jumlah,
                        sub: sub,
                        ids: ids,
                        vendor: vendor,
                        tglBeli: tglBeli
                    },
                    success: function(res) {
                        // $('#itemIn').hide();
                        $('#listTambah').show();
                        $('#pesanB').show();
                        $("#frmItemAdd")[0].reset();
                        $("#barangIn").val('').change();
                        $("#assetIn").val('').change();
                        $("#vendorIn").val('').change();
                        $('#dt_list').DataTable().ajax.reload();
                        $("#frmItemAdd").unbind().click(function() {});
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                        $('select').prop('selectedIndex', 0);
                    }
                });
            });
        }

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

    {{-- ======================== Edit Function ======================== --}}

    {{-- Edit Model --}}
    <script>
        function editModel(id) {
            $("#plhMerkE").select2({
                dropdownParent: $("#editModel")
            })
            $.ajax({
                url: "{{ url('') }}/modelE/load/" + id,
                success: function(data) {
                    document.getElementById('modelEdit').value = data.model;
                    document.getElementById('cekModel').value = data.model;
                    document.getElementById('kodeModelE').value = data.kode_model;
                }
            });


            $('#frmModelE').on('submit', function(e) {
                e.preventDefault();
                $('html, body').css("cursor", "wait");
                let model = $('#modelEdit').val();
                let kode = $('#kodeModelE').val();
                var ids = `<?php echo Session::get('id'); ?>`;
                let cek = $('#cekModel').val();

                var areEqual = model.toUpperCase() === cek.toUpperCase();
                var same = 0;
                // console.log(kelasB)
                $.ajax({
                    url: "{{ url('') }}/modelB/load/" + 1,
                    async: false,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = model.toUpperCase() === data.model
                                .toUpperCase();
                            if (cekEqual) {
                                if (!areEqual) {
                                    same = 1;
                                }
                            }
                        })
                    }
                });

                if (same == 0) {
                    $.ajax({
                        url: "{{ url('') }}/modelEdit/" + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            model: model,
                            kode: kode,
                            ids: ids
                        },
                        success: function(res) {
                            // console.log(res);
                            $('html, body').css("cursor", "auto");
                            swal({
                                icon: "success",
                                text: res['success']
                            });
                            $('#editModel').modal('hide');
                            $('#dt_model').DataTable().ajax.reload();

                        }
                    });
                } else if (same == 1) {
                    swal({
                        icon: "warning",
                        text: model + " Sudah Terdaftar"
                    });
                }
            });
        }
    </script>

    {{-- ======================== Delete Function ======================== --}}

    {{-- Delete List Ord --}}
    <script>
        function deleteList(id, cekData) {
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
                                    $('#dt_list').DataTable().ajax.reload();
                                    var table = $('#dt_list').DataTable();
                                    var ids = `<?php echo Session::get('id'); ?>`;
                                    $.ajax({
                                        url: "{{ url('') }}/pembelian/list/" + ids,
                                        success: function(res) {
                                            if (res.length == 0) {
                                                $('#pesanB').hide();
                                            }
                                        }
                                    })
                                    swal("Data Berhasil Dihapus!");
                                }
                            });
                        } else {
                            swal("Data Tidak Jadi Dihapus!");
                        }
                    });
            }
        }
    </script>

    {{-- ======================== Pembelian Barang Function ======================== --}}

    {{-- Pesan Barang --}}
    <script>
        function setBeli() {
            var ids = `<?php echo Session::get('id'); ?>`;
            swal({
                    title: "Tambah Pembelian?",
                    text: "Sekali Masuk Pembelian, Pesanan Tidak Dapat Dirubah!",
                    icon: "info",
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ url('') }}/pembelian/req",
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                ids: ids
                            },
                            success: function(res) {
                                $('#dt_list').DataTable().ajax.reload();
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

            // if (status == "Pembelian" || status == "Validate") {
            //     $('#dropZone').hide();
            // }
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
                            url: "{{ url('') }}/delDok/ord/" + id,
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
