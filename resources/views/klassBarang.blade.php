@extends('layouts\master')
@section('header-form')
    <h1>Setup Klasifikasi</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="dashboard">Home</a></div>
        <div class="breadcrumb-item">Setup Klasifikasi</div>
    </div>
@endsection

@section('content')
    <br>
    <div class="card card-primary">
        <div class="card-header card text-center">
            <h4> </h4>
            <div class="card-header-action">
                <div class="btn-group">
                    <a href="#" class="btn btn-primary" id="btnKeranjang" onclick="loadKate()">Klasifikasi</a>
                    <a href="#" class="btn btn-primary" id="btnListKer" onclick="loadTipe()">Kategori</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content tab-bordered" id="listKate">
                <div class="tab-pane fade show active">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4 style="color: #023e8a">Klasifikasi Barang</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#jenisInM"
                                    onclick="addJenis()">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_kate" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;"
                                aria-describedby="example_info">
                                <thead>
                                    <tr>
                                        <th>Klasifikasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content tab-bordered" id="listTipe">
                <div class="tab-pane fade show active">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4 style="color: #023e8a">Kategori Barang</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#inTipe"
                                    onclick="tipeAdd()">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_tipe" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;"
                                aria-describedby="example_info">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Klasifikasi</th>
                                        <th>Kode</th>
                                        <th>Satuan</th>
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

@include('Modal\barangModal')
@push('page-scripts')
    {{-- Auto Validasi --}}
    <script>
        $(document).ready(function() {
            $('#dt_kate').DataTable().clear();
            $('#dt_kate').DataTable().destroy();
            var kat = $("#dt_kate").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "responsive": true,
                "ajax": {
                    "url": "{{ url('') }}/jenis/load/" + 1,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "jenis_iventaris",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var nama = ucwords(data);
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
                        "data": "id_jenisIven",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var cekData = 0;
                            var html =
                                `<div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editJenis" onclick="editJ(${data})"><i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteJenis(${data})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>        
                            </div>`;
                            return html;
                        }
                    },
                ],
            })
        });
    </script>

    {{-- ------------------------------ Klasifikasi CRUD ------------------------------------ --}}

    {{-- load Klasifikasi --}}
    <script>
        $(document).ready(function() {
            $('#listKate').show();
            $('#listTipe').hide();
        });
        function ucwords(str) {
            var splitStr = str.toLowerCase().split(' ');
            for (var i = 0; i < splitStr.length; i++) {

                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
            }

            return splitStr.join(' ');
        }
    </script>

    {{-- Klasifikasi Show --}}
    <script>
        function loadKate() {
            $('#listKate').show();
            $('#listTipe').hide();
        }
    </script>

    {{-- Tambah Klasifikasi Js --}}
    <script>
        function addJenis() {
            $("#klasIn").select2({
                dropdownParent: $("#jenisInM")
            })

            // $("#inJenis").validate({
            //     rules: {
            //         jenisIn: {
            //             required: true,
            //             minlength: 3
            //         },
            //     },
            //     messages: {
            //         jenisIn: {
            //             minlength: "Nama Harus Diisi",
            //         }
            //     }
            // });

            $('#inJenis').on('submit', function(e) {
                e.preventDefault();
                let jenis = $('#jenisIn').val();
                const cekJenis = [];
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/jenis/load/" + 1,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            cekJenis.push(data.jenis_iventaris);
                        })
                        for (let i = 0; i < cekJenis.length; i++) {
                            var cekEqual = jenis.toUpperCase() === cekJenis[i].toUpperCase();
                            if (cekEqual) {
                                same = 1;
                            }
                        }

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/jenis/in",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    jenis: jenis
                                },
                                beforeSend: function() {
                                    $('#submitAddKlass').html(
                                        `<a href="#" class="btn disabled btn-success btn-progress">Progress</a>`
                                    );
                                },
                                success: function(res) {
                                    // console.log(res);
                                    $('#jenisInM').modal('hide');
                                    $("#inJenis")[0].reset();
                                    $("#inJenis").unbind().click(function() {});
                                    $('#dt_kate').DataTable().ajax.reload();
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                    $('#submitAddKlass').html(
                                        `<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-success">Simpan</button>`
                                    );
                                }
                            });
                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: jenis + " Sudah Terdaftar"
                            });
                        }
                    }
                });
            });
        }
    </script>

    {{-- Edit Klasifikasi --}}
    <script>
        function editJ(id) {
            $("#klasS").select2({
                dropdownParent: $("#editJenis")
            })
            $.ajax({
                url: "{{ url('') }}/editJ/" + id,
                success: function(data) {
                    document.getElementById('editJ').value = data.jenis_iventaris;
                    document.getElementById('cekJ').value = data.jenis_iventaris;
                }
            });

            $('#frmEditJ').on('submit', function(e) {
                e.preventDefault();
                
                let jenis = $('#editJ').val();
                let cek = $('#cekJ').val();

                var areEqual = jenis.toUpperCase() === cek.toUpperCase();
                const cekJenis = [];
                var same = 0;
                // console.log(kelasB)
                $.ajax({
                    url: "{{ url('') }}/jenis/load/" + 1,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            cekJenis.push(data.jenis_iventaris);
                        })

                        for (let i = 0; i < cekJenis.length; i++) {
                            var cekEqual = jenis.toUpperCase() === cekJenis[i].toUpperCase();
                            if (cekEqual) {
                                same = 1;
                            }
                        }

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/jenisE/" + id,
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    jenis: jenis
                                },
                                beforeSend: function() {
                                    $('#submitEditKlass').html(
                                        `<a href="#" class="btn disabled btn-success btn-progress">Progress</a>`
                                    );
                                },
                                success: function(res) {
                                    // console.log(res);
                                    $('#editJenis').modal('hide');
                                    $("#frmEditJ").unbind().click(function() {});
                                    $('#dt_kate').DataTable().ajax.reload();
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                    $('#submitEditKlass').html(
                                        `<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-success">Simpan</button>`
                                    );
                                }
                            });
                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: jenis + " Sudah Terdaftar"
                            });
                        }
                    }
                });
            });
        }
    </script>

    {{-- Confirm Delete Klasifikasi --}}
    <script>
        function deleteJenis(id) {
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
                            url: "{{ url('') }}/del/jenis/" + id,
                            success: function() {
                                $('#dt_kate').DataTable().ajax.reload();
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

    {{-- ------------------------------ Kategori CRUD ------------------------------------ --}}

    {{-- Load Kategori --}}
    <script>
        function loadTipe() {
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
                            nama = ucwords(nama);
                            var html = '';
                            var cekData = 0;
                            
                            html +=
                            `<div class="container">
                                    <div class="col-12" style="margin-top: 5px;">
                                            <a> ${nama} </a>
                                    </div>
                                    <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editTipe" onclick="editTipe(${data})"><i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="deleteTipe(${data})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>`;
                            return html;
                        }
                    },
                    {
                        "data": "jenis_iventaris",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var nama = ucwords(data);
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
                        "data": "kode_barang",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var nama = data.toUpperCase();
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
                        "data": "satuan",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var nama = ucwords(data);
                            var html = '';
                            html +=
                                `<div class="container">
                                    <div class="col-12" style="margin-top: 5px;">
                                            <a> ${nama} </a>
                                    </div>
                                </div>`;
                            return html;
                        }
                    }
                ],
            })

            $('#listKate').hide();
            $('#listTipe').show();
        }
    </script>

    {{-- Tambah Kategori --}}
    <script>
        function tipeAdd() {
            $("#jenisB").select2({
                dropdownParent: $("#inTipe")
            })
            $.ajax({
                url: "{{ url('') }}/jenis/drop/" + 1,
                success: function(res) {
                    $("#jenisB").children().remove();
                    $("#jenisB").append(
                        '<option selected value="">Pilih Klasifikasi</option>');
                    $.each(res, function(index, x) {
                        $('#jenisB').append(
                            '<option value="' + x.id_jenisIven + '">' + x
                            .jenis_iventaris + '</option>'
                        )
                    })
                }
            });

            $('#frmAddIn').on('submit', function(e) {
                e.preventDefault();
                let tipe = $('#tipe').val();
                tipe = ucwords(tipe);
                let jenis = $('#jenisB').val();
                jenis = ucwords(jenis);
                let kode = $('#kode').val();
                kode = kode.toUpperCase();
                let satuan = $('#satuan').val();
                // console.log(jenis);

                const cekTipe = [];
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/kateBarang/load/" + 1,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            cekTipe.push(data.nama_barang);
                        })

                        for (let i = 0; i < cekTipe.length; i++) {
                            console.log(cekTipe[i])
                            var cekEqual = tipe.toUpperCase() === cekTipe[i].toUpperCase();
                            if (cekEqual) {
                                same = 1;
                            }
                        }

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/barangKate/in",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    tipe: tipe,
                                    jenis: jenis,
                                    kode: kode,
                                    satuan: satuan
                                },
                                beforeSend: function() {
                                    $('#submitAddKate').html(
                                        `<a href="#" class="btn disabled btn-success btn-progress">Progress</a>`
                                    );
                                },
                                success: function(res) {
                                    // console.log(res);
                                    $('#inTipe').modal('hide');
                                    $("#frmAddIn")[0].reset();
                                    $("#frmAddIn").unbind().click(function() {});
                                    $('#dt_tipe').DataTable().ajax.reload();
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                    $('#submitAddKate').html(
                                        `<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-success">Simpan</button>`
                                    );
                                }
                            });
                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: "Nama Sudah Ada"
                            });
                        }
                    }
                });
            });
        }
    </script>

    {{-- Edit Kategori --}}
    <script>
        function editTipe(id) {
            $("#editJenisB").select2({
                dropdownParent: $("#editTipe")
            })

            $.ajax({
                url: "{{ url('') }}/barang/editL/" + id,
                success: function(res) {
                    document.getElementById('tipeE').value = res.nama_barang;
                    document.getElementById('temBarang').value = res.nama_barang;
                    document.getElementById('kodeE').value = res.kode_barang;
                    document.getElementById('satuanE').value = res.satuan;
                    $.ajax({
                        url: "{{ url('') }}/jenis/load/" + 1,
                        success: function(data) {
                            // console.log(data);
                            $("#editJenisB").children().remove();
                            $("#editJenisB").append(
                                '<option selected value="">Pilih Klasifikasi</option>');
                            $.each(data, function(index, x) {
                                if (x.id_jenisIven == res.id_jenisIven) {
                                    $('#editJenisB').append(`<option value="${x.id_jenisIven}" selected>
                                ${x.jenis_iventaris}
                                    </option>`)
                                } else {
                                    $('#editJenisB').append(
                                        '<option value="' + x.id_jenisIven + '">' + x
                                        .jenis_iventaris + '</option>'
                                    )
                                }
                            })
                        }
                    });
                }
            });

            $('#frmEditTipe').on('submit', function(e) {
                e.preventDefault();
                let barang = $('#tipeE').val();
                let temBarang = $('#temBarang').val();
                let jenis = $('#editJenisB').val();
                jenis = ucwords(jenis);
                let kode = $('#kodeE').val();
                kode = kode.toUpperCase();
                let satuan = $('#satuanE').val();
                satuan = ucwords(satuan);
                
                var areEqual = barang.toUpperCase() === temBarang.toUpperCase();
                const cekBarang = [];
                var same = 0;

                $.ajax({
                    url: "{{ url('') }}/kateBarang/cek/" + id,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            cekBarang.push(data.nama_barang);
                        })

                        for (let i = 0; i < cekBarang.length; i++) {
                            console.log(cekBarang[i]);
                            var cekEqual = barang.toUpperCase() === cekBarang[i].toUpperCase();
                            if (cekEqual) {
                                if (areEqual) {
                                    same = 1;
                                } else {
                                    same = 2;
                                }

                            }
                        }

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/barang/editIn/" + id,
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    barang: barang,
                                    jenis: jenis,
                                    kode: kode,
                                    satuan: satuan
                                },
                                beforeSend: function() {
                                    $('#submitEditKate').html(
                                        `<a href="#" class="btn disabled btn-success btn-progress">Progress</a>`
                                    );
                                },
                                success: function(res) {
                                    $('#editTipe').modal('hide');
                                    $("#frmEditTipe")[0].reset();
                                    $("#frmEditTipe").unbind().click(function() {});
                                    $('#dt_tipe').DataTable().ajax.reload();
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                    $('#submitEditKate').html(
                                        `<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-success">Simpan</button>`
                                    );
                                }
                            });
                        } else if (same == 2) {
                            swal({
                                icon: "warning",
                                text: barang + " Nama Sudah Ada"
                            });
                        } else if (same == 1) {
                            $.ajax({
                                url: "{{ url('') }}/barang/editIn/" + id,
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    barang: temBarang,
                                    jenis: jenis,
                                    kode: kode,
                                    satuan: satuan
                                },
                                beforeSend: function() {
                                    $('#submitEditKate').html(
                                        `<a href="#" class="btn disabled btn-success btn-progress">Progress</a>`
                                    );
                                },
                                success: function(res) {
                                    // console.log(res);
                                    $('#editTipe').modal('hide');
                                    $("#frmEditTipe")[0].reset();
                                    $("#frmEditTipe").unbind().click(function() {});
                                    $('#dt_tipe').DataTable().ajax.reload();
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                }
                            });
                        }
                    }
                });
            });
        }
    </script>

    {{-- Confirm Delete Kategori --}}
    <script>
        function deleteTipe(id) {
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
                            url: "{{ url('') }}/del/barang/" + id,
                            success: function() {
                                $('#dt_tipe').DataTable().ajax.reload();
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
