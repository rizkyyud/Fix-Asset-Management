@extends('layouts\master')
@section('header-form')
    <h1>Setup Spesifikasi</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="\">Home</a></div>
        <div class="breadcrumb-item">Spesifikasi</div>
    </div>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header card text-center">
            <h4> </h4>
            <div class="card-header-action">
                <div class="btn-group">
                    <a href="#" class="btn btn-primary" onclick="loadMerk()">Merk</a>
                    <a href="#" class="btn btn-primary" onclick="loadModel()">Model</a>
                    <a href="#" class="btn btn-primary" onclick="loadWarna()">Warna</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content tab-bordered" id="listMerk">
                <div class="tab-pane fade show active">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4 style="color: #023e8a">Merk</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#merkIn"
                                    onclick="merkAdd()">
                                    <i class="fas fa-plus-circle"></i> Merk
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_merk" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nama Merk</th>
                                        <th>Kode Merk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content tab-bordered" id="listModel">
                <div class="tab-pane fade show active">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4 style="color: #023e8a">Model</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modelIn"
                                    onclick="modelAdd()">
                                    <i class="fas fa-plus-circle"></i> Model
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_model" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;"
                                aria-describedby="example_info">
                                <thead>
                                    <tr>
                                        <th>Nama Model</th>
                                        <th>Kode Model</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content tab-bordered" id="listWarna">
                <div class="tab-pane fade show active">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4 style="color: #023e8a">Warna</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#warnaIn"
                                    onclick="warnaAdd()">
                                    <i class="fas fa-plus-circle"></i> Warna
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_warna" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nama Warna</th>
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
@include('Modal\spesifikasiModal')


@push('page-scripts')
    <script>
        $(document).ready(function() {
            $('#listMerk').hide();
            $('#listModel').hide();
            $('#listWarna').hide();
        });
        function ucwords(str) {
            var splitStr = str.toLowerCase().split(' ');
            for (var i = 0; i < splitStr.length; i++) {

                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
            }

            return splitStr.join(' ');
        }
    </script>

    {{-- Unbind Click --}}
    <script>
        $(document).ready(function() {

            // Unbind Tambah
            $("#frmModelAdd").unbind().click(function() {});
            $("#frmMerkAdd").unbind().click(function() {});
            $("#frmWarnaAdd").unbind().click(function() {});

            // // Unbind Edit
            $("#frmModelE").unbind().click(function() {});
            $("#frmMerkE").unbind().click(function() {});
            $("#frmWarnaE").unbind().click(function() {});
        });
    </script>

    {{-- ======================== Load Data Function ======================== --}}

    {{-- Load Merk --}}
    <script>
        $(document).ready(function() {
            $('#listMerk').show();
            $('#listBarang').hide();
            $('#listModel').hide();
            $('#listWarna').hide();

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
                        "data": "merk",
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
                        "data": "kode_merk",
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
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var cekData = 0;
                            var html =
                                `<div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                <button class="btn btn-primary" onclick="editMerk(${data})" data-bs-toggle="modal" data-bs-target="#editMerk"><i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteMerk(${data})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>        
                            </div>`;
                            return html;
                        }
                    },
                ],
            })
        });
    </script>

    {{-- Load Model --}}
    <script>
        function loadModel() {
            $('#listBarang').hide();
            $('#listMerk').hide();
            $('#listModel').show();
            $('#listWarna').hide();

            $('#dt_model').DataTable().clear();
            $('#dt_model').DataTable().destroy();
            $("#dt_model").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "ajax": {
                    "url": "{{ url('') }}/modelB/load/" + 1,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "model",
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
                        "data": "kode_model",
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
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var cekData = 0;
                            var html =
                                `<div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                <button class="btn btn-primary" onclick="editModel(${data})" data-bs-toggle="modal" data-bs-target="#editModel"><i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteModel(${data})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>        
                            </div>`;
                            return html;
                        }
                    },
                ],
            })
        }
    </script>

    {{-- Load Merk --}}
    <script>
        function loadMerk() {
            $('#listMerk').show();
            $('#listBarang').hide();
            $('#listModel').hide();
            $('#listWarna').hide();

        }
    </script>

    {{-- Load Warna --}}
    <script>
        function loadWarna() {
            $('#listMerk').hide();
            $('#listBarang').hide();
            $('#listModel').hide();
            $('#listWarna').show();

            $('#dt_warna').DataTable().clear();
            $('#dt_warna').DataTable().destroy();
            $("#dt_warna").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "ajax": {
                    "url": "{{ url('') }}/warna/load/" + 1,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "warna",
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
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var cekData = 0;
                            var html =
                                `<div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                <button class="btn btn-primary" onclick="editWarna(${data})" data-bs-toggle="modal" data-bs-target="#editWarna"><i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteWarna(${data})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>        
                            </div>`;
                            return html;
                        }
                    },
                ],
            })
        }
    </script>


    {{-- ======================== Tambah Function ======================== --}}

    {{-- Tambah Model --}}
    <script>
        function modelAdd() {
            $('#plhMerk').select2({
                dropdownParent: $('#modelIn')
            });

            $('#frmModelAdd').on('submit', function(e) {
                e.preventDefault();
                let model = $('#modelAdd').val();
                model = ucwords(model);
                let kode = $('#kodeModel').val();
                kode = kode.toUpperCase();
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
                                    $("#frmModelAdd").unbind().click(function() {});
                                    $('#dt_model').DataTable().ajax.reload();
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
            $('#frmMerkAdd').on('submit', function(e) {
                e.preventDefault();

                let merk = $('#merkAdd').val();
                merk = ucwords(merk);
                let kode = $('#kodeMerk').val();
                kode = kode.toUpperCase();
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
                                    $("#frmMerkAdd").unbind().click(function() {});
                                    $('#dt_merk').DataTable().ajax.reload();
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
            $('#frmWarnaAdd').on('submit', function(e) {
                e.preventDefault();

                let warna = $('#warnaAdd').val();
                warna = ucwords(warna);
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
                                    $("#frmWarnaAdd").unbind().click(function() {});
                                    $("#frmWarnaAdd")[0].reset();
                                    
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
                model = ucwords(model);
                let kode = $('#kodeModelE').val();
                kode = kode.toUpperCase();
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
                            $("#frmModelE").unbind().click(function() {});
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

    {{-- Edit Merk --}}
    <script>
        function editMerk(id) {
            $.ajax({
                url: "{{ url('') }}/merkE/load/" + id,
                success: function(data) {
                    document.getElementById('merkEdit').value = data.merk;
                    document.getElementById('cekMerk').value = data.merk;
                    document.getElementById('kodeMerkE').value = data.kode_merk;
                }
            });

            $('#frmMerkE').on('submit', function(e) {
                e.preventDefault();

                let merk = $('#merkEdit').val();
                merk = ucwords(merk);
                let cek = $('#cekMerk').val();
                cek = cek.toUpperCase();
                let kode = $('#kodeMerkE').val();
                var ids = `<?php echo Session::get('id'); ?>`;

                var areEqual = merk.toUpperCase() === cek.toUpperCase();
                var same = 0;
                // console.log(kelasB)
                $.ajax({
                    url: "{{ url('') }}/merk/load/" + 1,
                    async: false,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = merk.toUpperCase() === data.merk
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
                        url: "{{ url('') }}/merkEdit/" + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            merk: merk,
                            kode: kode,
                            ids: ids
                        },
                        success: function(res) {
                            // console.log(res);
                            swal({
                                icon: "success",
                                text: res['success']
                            });
                            $('#editMerk').modal('hide');
                            $("#frmMerkE").unbind().click(function() {});
                            $('#dt_merk').DataTable().ajax.reload();
                        }
                    });
                } else if (same == 1) {
                    swal({
                        icon: "warning",
                        text: merk + " Sudah Terdaftar"
                    });
                }
            });
        }
    </script>

    {{-- Edit Warna --}}
    <script>
        function editWarna(id) {
            $.ajax({
                url: "{{ url('') }}/warnaE/load/" + id,
                success: function(data) {
                    document.getElementById('warnaEdit').value = data.warna;
                    document.getElementById('cekWarna').value = data.warna;
                }
            });

            $('#frmWarnaE').on('submit', function(e) {
                e.preventDefault();

                let warna = $('#warnaEdit').val();
                warna = ucwords(warna);
                let cek = $('#cekWarna').val();
                var ids = `<?php echo Session::get('id'); ?>`;

                var areEqual = warna.toUpperCase() === cek.toUpperCase();
                var same = 0;
                // console.log(kelasB)
                $.ajax({
                    url: "{{ url('') }}/warna/load/" + 1,
                    async: false,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = warna.toUpperCase() === data.warna
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
                        url: "{{ url('') }}/warnaEdit/" + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            warna: warna,
                            ids: ids
                        },
                        success: function(res) {
                            // console.log(res);
                            swal({
                                icon: "success",
                                text: res['success']
                            });
                            $('#editWarna').modal('hide');
                            $("#frmWarnaE").unbind().click(function() {});
                            $('#dt_warna').DataTable().ajax.reload();
                        }
                    });
                } else if (same == 1) {
                    swal({
                        icon: "warning",
                        text: warna + " Sudah Terdaftar"
                    });
                }
            });
        }
    </script>

    {{-- ======================== Delete Function ======================== --}}

    {{-- Delete Model --}}
    <script>
        function deleteModel(id) {
            var cekData = 0;
            $.ajax({
                url: "{{ url('') }}/barang/load/" + 1,
                async: false,
                success: function(res) {
                    // console.log(res);
                    $.each(res, function(index, x) {
                        if (x.model == id) {
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
                                url: "{{ url('') }}/del/model/" + id,
                                success: function() {
                                    $('#dt_model').DataTable().ajax.reload();
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

    {{-- Delete Merk --}}
    <script>
        function deleteMerk(id) {
            var cekData = 0;
            $.ajax({
                url: "{{ url('') }}/merk/load/" + 1,
                async: false,
                success: function(res) {
                    // console.log(res);
                    $.each(res, function(index, x) {
                        if (x.id_merk == id) {
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
                                url: "{{ url('') }}/del/merk/" + id,
                                success: function() {
                                    $('#dt_merk').DataTable().ajax.reload();
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

    {{-- Delete Warna --}}
    <script>
        function deleteWarna(id) {
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
                                url: "{{ url('') }}/del/warna/" + id,
                                success: function() {
                                    $('#dt_warna').DataTable().ajax.reload();
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
