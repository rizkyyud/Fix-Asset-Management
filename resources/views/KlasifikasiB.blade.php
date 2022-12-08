@extends('layouts\master')
@section('header-form')
    <h1>Setup Barang</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="dashboard">Home</a></div>
        <div class="breadcrumb-item">Harga Sewa</div>
    </div>
@endsection

@section('content')
    <br>
    <div class="card card-primary">
        <div class="card-body" id="listBarang">
            <div class="tab-content tab-bordered">
                <div class="tab-pane fade show active">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4 style="color: #023e8a">List Barang</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" onclick="barangAdd()">
                                    <i class="fas fa-plus-circle"></i> Barang
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_barang" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;"
                                aria-describedby="example_info">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Merk</th>
                                        <th>Model</th>
                                        <th>Warna</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body" id="barangIn">
            <div class="tab-content tab-bordered">
                <div class="tab-pane fade show active">
                    <div class="card">
                        <form class="needs-validation was-validated" id="frmBrgAdd">
                            @csrf
                            <div class="card-header card text-center">
                                <h4>Penambahan Barang</h4>
                                <div class="card-header-action">
                                    <a href="#" class="btn btn-primary" onclick="backList()">
                                        <i class="fas fa-arrow-alt-circle-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label>Nama Barang</label>
                                        <input type="text" class="form-control" name="barangAdd" id="barangAdd" readonly
                                            required="" placeholder="Nama" value="{{ old('barangAdd') }}">
                                        <div class="invalid-feedback">
                                            Harus Diisi
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label>Kategori</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" name="drpKate" id="drpKate">
                                            <option value="">Pilih Kategori Barang</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Diisi
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label>Merk</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" name="drpMerk" id="drpMerk">
                                            <option value="">Pilih Merk Barang</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Diisi
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label>Model</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" name="drpModel" id="drpModel">
                                            <option value="">Pilih Model Barang</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Diisi
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label>Warna</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" name="drpWarna" id="drpWarna">
                                            <option value="">Pilih Warna Barang</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Diisi
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label>Ukuran Barang</label>
                                        <input type="text" class="form-control" name="ukuranAdd" id="ukuranAdd"
                                            required="" placeholder="Ukuran" value="{{ old('ukuranAdd') }}">
                                        <div class="invalid-feedback">
                                            Harus Diisi
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="button" class="btn btn-primary" onclick="backList()">Kembali</button>
                                <button class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body" id="barangEdit">
            <div class="tab-content tab-bordered">
                <div class="tab-pane fade show active">
                    <div class="card">
                        <form class="needs-validation was-validated" id="frmBrgEdit">
                            @csrf
                            <div class="card-header card text-center">
                                <h4>Edit Barang</h4>
                                <div class="card-header-action">
                                    <a href="#" class="btn btn-primary" onclick="backList()">
                                        <i class="fas fa-arrow-alt-circle-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label>Nama Barang</label>
                                        <input type="text" class="form-control" name="barangE" id="barangE" readonly
                                            required="" placeholder="Nama" value="{{ old('barangAdd') }}">
                                        <div class="invalid-feedback">
                                            Harus Diisi
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label>Kategori</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" name="editKate" id="editKate">
                                            <option value="">Pilih Kategori Barang</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Diisi
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label>Merk</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" name="editMerk" id="editMerk">
                                            <option value="">Pilih Merk Barang</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Diisi
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label>Model</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" name="editModel" id="editModel">
                                            <option value="">Pilih Model Barang</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Diisi
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label>Warna</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            required="" name="editWarna" id="editWarna">
                                            <option value="">Pilih Warna Barang</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus Diisi
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label>Ukuran Barang</label>
                                        <input type="text" class="form-control" name="ukuranE" id="ukuranE" required=""
                                            placeholder="Ukuran" value="{{ old('ukuranE') }}">
                                        <div class="invalid-feedback">
                                            Harus Diisi
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="button" class="btn btn-primary" onclick="backList()">Close</button>
                                <button class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@include('Modal\barangModal')
@push('page-scripts')
    {{-- Auto Validasi --}}
    <script>
        $(document).ready(function() {
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
                            var nama = ucwords(row['nama']);
                            var html = '';
                            var cekData = 0;
                            html +=
                                `<div class="container">
                                    <div class="col-12" style="margin-top: 5px;">
                                            <a> ${nama} </a>
                                    </div>
                                    <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                        <button class="btn btn-primary" onclick="barangEdit(${data})"><i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="deleteBarang(${data})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>
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
            $('#barangIn').hide();
            $('#barangEdit').hide();
        });

        function ucwords(str) {
            var splitStr = str.toLowerCase().split(' ');
            for (var i = 0; i < splitStr.length; i++) {

                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
            }

            return splitStr.join(' ');
        }
    </script>

    {{-- ------------------------------ Barang CRUD ------------------------------------ --}}

    {{-- Tambah Barang --}}
    <script>
        function barangAdd() {

            $('#barangIn').show();
            $('#barangEdit').hide();
            $('#listBarang').hide();

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
                nama_barang = `${nama_kate}/${nama_merk}/${nama_model}`
                $('#barangAdd').val(nama_barang).change();
            });

            $("#drpMerk").change(function() {
                nama_merk = $("#drpMerk :selected").text();
                nama_barang = `${nama_kate}/${nama_merk}/${nama_model}`
                $('#barangAdd').val(nama_barang).change();
            });

            $("#drpModel").change(function() {
                nama_model = $("#drpModel :selected").text();
                nama_barang = `${nama_kate}/${nama_merk}/${nama_model}`
                $('#barangAdd').val(nama_barang).change();
            });

            $('#frmBrgAdd').on('submit', function(e) {
                e.preventDefault();
                let barang = $('#barangAdd').val();
                let kategori = $('#drpKate').val();
                let model = $('#drpModel').val();
                let merk = $('#drpMerk').val();
                let warna = $('#drpWarna').val();
                let ukuran = $('#ukuranAdd').val();
                var same = 0;

                console.log('tes');
                $.ajax({
                    url: "{{ url('') }}/barang/load/" + 1,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = barang.toUpperCase() === data.nama.toUpperCase();
                            var cekWarna = warna.toUpperCase() === data.id_warna.toUpperCase();
                            if (cekEqual && cekWarna) {
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
                                    $('#barangIn').hide();
                                    $('#listBarang').show();
                                    $("#frmBrgAdd")[0].reset();
                                    $("#frmBrgAdd").unbind().click(function() {});
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

        function backList() {
            $('#barangIn').hide();
            $('#listBarang').show();
        }
    </script>

    {{-- Edit Barang --}}
    <script>
        function barangEdit(id) {

            $('#barangIn').hide();
            $('#barangEdit').show();
            $('#listBarang').hide();
            // Select 2 Barang In
            $("#editModel").select2({
                dropdownParent: $("#barangEdit")
            })

            $("#editMerk").select2({
                dropdownParent: $("#barangEdit")
            })

            $("#editWarna").select2({
                dropdownParent: $("#barangEdit")
            })

            $("#editKate").select2({
                dropdownParent: $("#barangEdit")
            })

            var barang;
            var kategori;
            var model;
            var merk;
            var warna;
            var ukuran;

            $.ajax({
                url: "{{ url('') }}/barang/get/" + id,
                success: function(res) {
                    barang = res.nama;
                    kategori = res.id_barangIven;
                    model = res.id_model;
                    merk = res.id_merk;
                    warna = res.id_warna;
                    ukuran = res.ukuran;

                    document.getElementById('barangE').value = barang;
                    document.getElementById('ukuranE').value = ukuran;

                    // Load Dropdown
                    $.ajax({
                        url: "{{ url('') }}/kateBarang/load/" + 1,
                        success: function(res) {
                            $("#editKate").children().remove();
                            $("#editKate").append(
                                '<option selected value="">Pilih Kategori Barang</option>');
                            $.each(res, function(index, data) {
                                $('#editKate').append(
                                    '<option value="' + data.id_barangIven + '">' + data
                                    .nama_barang + '</option>'
                                )
                            })
                            $("#editKate").val(kategori).change();
                        }
                    });

                    $.ajax({
                        url: "{{ url('') }}/modelB/load/" + 1,
                        success: function(res) {
                            $("#editModel").children().remove();
                            $("#editModel").append(
                                '<option selected value="">Pilih Model Barang</option>');
                            $.each(res, function(index, data) {
                                $('#editModel').append(
                                    '<option value="' + data.id + '">' + data
                                    .model + '</option>'
                                )
                            })
                            $("#editModel").val(model).change();
                        }
                    });

                    $.ajax({
                        url: "{{ url('') }}/merk/load/" + 1,
                        success: function(res) {
                            $("#editMerk").children().remove();
                            $("#editMerk").append(
                                '<option selected value="">Pilih Merk Barang</option>');
                            $.each(res, function(index, data) {
                                $('#editMerk').append(
                                    '<option value="' + data.id + '">' + data
                                    .merk + '</option>'
                                )
                            })
                            $("#editMerk").val(merk).change();
                        }
                    });

                    $.ajax({
                        url: "{{ url('') }}/warna/load/" + 1,
                        success: function(res) {
                            $("#editWarna").children().remove();
                            $("#editWarna").append(
                                '<option selected value="">Pilih Warna Barang</option>');
                            $.each(res, function(index, data) {
                                $('#editWarna').append(
                                    '<option value="' + data.id + '">' + data
                                    .warna + '</option>'
                                )
                            })
                            $("#editWarna").val(warna).change();
                        }
                    });

                }
            });

            var nama_barang, nama_merk = "XXX",
                nama_kate = "XXX",
                nama_model = "XXX";

            $("#editKate").change(function() {
                nama_kate = $("#editKate :selected").text();
                nama_barang = `${nama_kate}/${nama_merk}/${nama_model}`
                $('#barangE').val(nama_barang).change();
            });

            $("#editMerk").change(function() {
                nama_merk = $("#editMerk :selected").text();
                nama_barang = `${nama_kate}/${nama_merk}/${nama_model}`
                $('#barangE').val(nama_barang).change();
            });

            $("#editModel").change(function() {
                nama_model = $("#editModel :selected").text();
                nama_barang = `${nama_kate}/${nama_merk}/${nama_model}`
                $('#barangE').val(nama_barang).change();
            });

            $('#frmBrgEdit').on('submit', function(e) {
                e.preventDefault();
                let barang = $('#barangE').val();
                let kategori = $('#editKate').val();
                let model = $('#editModel').val();
                let merk = $('#editMerk').val();
                let warna = $('#editWarna').val();
                let ukuran = $('#ukuranE').val();
                var same = 0;
                console.log(ukuran);
                $.ajax({
                    url: "{{ url('') }}/barang/load/" + 1,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = barang.toUpperCase() === data.nama.toUpperCase();
                            var cekWarna = warna.toUpperCase() === data.id_warna.toUpperCase();
                            if (cekEqual && cekWarna) {
                                same = 1;
                            }
                        })

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/barang/edit/" + id,
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
                                    $('#barangIn').hide();
                                    $('#barangEdit').hide();
                                    $('#listBarang').show();
                                    $("#frmBrgEdit")[0].reset();
                                    $("#frmBrgEdit").unbind().click(function() {});
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

    {{-- Delete Barang --}}
    <script>
        function deleteBarang(id) {
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
                                url: "{{ url('') }}/barang/del/" + id,
                                success: function() {
                                    $('#dt_barang').DataTable().ajax.reload();
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
@endpush
