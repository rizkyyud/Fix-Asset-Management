@extends('layouts\master')
@section('header-form')
    <h1>Setup Tempat Assets</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="dashboard">Home</a></div>
        <div class="breadcrumb-item">Setup Tempat</div>
    </div>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header card text-center">

        </div>
        <div class="card-body">
            <ul class="nav nav-tabs justify-content-center" id="myTab6" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-center" id="lokasi-tab" data-toggle="tab" href="#lokasi" role="tab"
                        aria-controls="home" aria-selected="true" onclick="loadLokasi()">
                        <span><i class="fas fa-map-marked-alt"></i></span> Lokasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" id="subL-tab" data-toggle="tab" href="#subLokasi" role="tab"
                        aria-controls="profile" aria-selected="false" onclick="loadSublokasi()">
                        <span><i class="fas fa-map-signs"></i></span> Sub Lokasi</a>
                </li>
            </ul>
            <div class="tab-content tab-bordered" id="myTabContent6">
                <div class="tab-pane fade show active" id="lokasi" role="tabpanel" aria-labelledby="lokasi-tab">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4 style="color: #023e8a">Lokasi</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#inLokasi"
                                    onclick="lokasiIn()">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_lokasi" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nama Lokasi</th>
                                        <th>Sub Lokasi</th>
                                        <th>Alamat</th>
                                        <th>Dokumentasi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="subLokasi" role="tabpanel" aria-labelledby="subL-tab">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4 style="color: #023e8a">Sub Lokasi</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#subLokasiIn" onclick="subLokasiIn()">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_subL" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nama Sub Lokasi</th>
                                        <th>Lokasi</th>
                                        <th>Dokumentasi</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- <div class="tab-pane fade" id="pemilik" role="tabpanel" aria-labelledby="pemilik-tab">
                    <div class="card card-success">
                        <div class="card-header card text-center">
                            <h4>Pemilik</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#inPemilik"
                                    onclick="pemilikIn()">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_pemilik" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Pemilik Assets</th>
                                        <th>Status Kepemilikan</th>
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
@include('Modal\lokasiModal')

@push('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    {{-- //////////////////////////////////////////////////////////////// --}}

    {{-- Unbind Click --}}
    <script>
        $(document).ready(function() {
            $('#subLokasiIn').on('hidden.bs.modal', function(e) {
                // label = [];
                $("#frmsubLIn").unbind().click(function() {
                    //Stuff
                });
            });

            $('#inLokasi').on('hidden.bs.modal', function(e) {
                // label = [];
                $("#frmLokasiIn").unbind().click(function() {
                    //Stuff
                });
            });

            $('#inKategori').on('hidden.bs.modal', function(e) {
                // label = [];
                $("#frmKateIn").unbind().click(function() {
                    //Stuff
                });
            });

            $('#inPemilik').on('hidden.bs.modal', function(e) {
                // label = [];
                $("#frmPemilikIn").unbind().click(function() {
                    //Stuff
                });
            });
        });
    </script>

    {{-- Format Kalimat --}}
    <script>
        function ucwords(str) {
            var splitStr = str.toLowerCase().split(' ');
            for (var i = 0; i < splitStr.length; i++) {

                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
            }

            return splitStr.join(' ');
        }
    </script>

    {{-- Load Lokasi --}}
    <script>
        $(document).ready(function() {
            $('#dt_lokasi').DataTable().clear();
            $('#dt_lokasi').DataTable().destroy();
            var table = $("#dt_lokasi").DataTable({
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
                        "data": "id_lokasi",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var lokasi = row['nama_lokasi'];
                            var html = '';
                            var cekData = 0;
                            html += `<a>${lokasi}</a>`;

                            if (cekData == 1) {
                                html += `<div class="table-links">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editLokasi" onclick="editLokasi(${data})"><i class="fas fa-edit"></i>
                                        Edit</button>
                                    </div>`;
                            } else if (cekData == 0) {
                                html += `
                                <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editLokasi" onclick="editLokasi(${data})"><i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteLokasi(${data})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>
                                </div>`;
                            }
                            return html;
                        }
                    },
                    {
                        "className": 'dt-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
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

            $("#dt_lokasi tbody").unbind().click(function() {});
            $('#dt_lokasi tbody').on('click', 'td.dt-control', function(e) {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var parentRow = $(this).closest("tr").prev()[0];
                var rowData = table.row(parentRow).data();
                var idr = row.data().id_lokasi;
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
        });


        function loadLokasi() {
            $('#dt_lokasi').DataTable().ajax.reload();
        }

        function format(d, id) {
            // `d` is the original data object for the row
            let html = `<table class="table table-bordered table-md align-middle">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="container">
                                            <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                                <a> Nama Sub </a>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="container">
                                            <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                                <a> Dokumen </a>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="container">
                                            <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                                <a> Last Update </a>
                                            </div>
                                        </div>
                                    </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                        `;
            $.ajax({
                url: "{{ url('') }}/lokasi/getSub/" + id,
                type: "GET",
                async: false,
                success: function(res) {

                    // console.log(res);
                    if (res.length == 0) {
                        html = `<div class="container">
                                    <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                        <center><a> Tidak Ada Sub</a></center>
                                    </div>
                                </div>`;

                    }

                    $.each(res, function(index, data) {
                        var date = new Date(data.updated_at);
                        var day = date.getDate();
                        var month = date.getMonth() + 1;
                        var year = date.getFullYear();
                        var cek = 0;
                        var update = [day, month, year].join('/');
                        html +=
                            `<tr>
                                    <td>
                                        <div class="container">
                                            <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                                <a> ${data.nama_subL} </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="container">
                                            <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                                <button class="btn btn-dark" data-bs-toggle="modal"
                                                    data-bs-target="#dokumenOrd" onclick="dokOrder(${data.id_subL})"><i class="fas fa-folder"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="container">
                                            <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                                <a> ${update} </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="container">
                                            <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                                <button class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editsubL" onclick="editL(${data.id_subL})"><i class="fas fa-edit"></i>
                                                </button>
                                                <button onclick="deleteSubL(${data.id_subL})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                    `;
                    })
                    html += `</tbody>`;
                }
            })
            html += `</table>`;
            return html;
        }
    </script>

    {{-- Input Lokasi --}}
    <script>
        function lokasiIn() {
            $('#frmLokasiIn').on('submit', function(e) {
                e.preventDefault();

                let lokasi = $('#lokasiIn').val();
                let alamat = $('#alamatIn').val();
                lokasi = ucwords(lokasi);
                alamat = ucwords(alamat);
                const ceklokasi = [];
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/lokasi/load/" + 1,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            ceklokasi.push(data.nama_lokasi);
                        })
                        for (let i = 0; i < ceklokasi.length; i++) {
                            var cekEqual = lokasi.toUpperCase() === ceklokasi[i].toUpperCase();
                            if (cekEqual) {
                                same = 1;
                            }
                        }

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/lokasi/in",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    lokasi: lokasi,
                                    alamat: alamat
                                },
                                success: function(res) {
                                    // console.log(res);
                                    $('#inLokasi').modal('hide');
                                    $("#frmLokasiIn")[0].reset();
                                    $('#dt_lokasi').DataTable().ajax.reload();
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                }
                            });
                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: lokasi + " Sudah Terdaftar"
                            });
                        }
                    }
                });
            });
        }
    </script>

    {{-- Edit Lokasi --}}
    <script>
        function editLokasi(id) {
            $.ajax({
                url: "{{ url('') }}/lokasiE/load/" + id,
                success: function(data) {
                    document.getElementById('lokasiE').value = data.nama_lokasi;
                    document.getElementById('cekLokasi').value = data.nama_lokasi;
                    document.getElementById('alamatE').value = data.alamat_lokasi;
                }
            });

            $('#frmLokasiE').on('submit', function(e) {
                e.preventDefault();

                let lokasi = $('#lokasiE').val();
                let alamat = $('#alamatE').val();
                let cek = $('#cekLokasi').val();
                lokasi = ucwords(lokasi);
                alamat = ucwords(alamat);
                var areEqual = lokasi.toUpperCase() === cek.toUpperCase();
                const ceklokasi = [];
                var same = 0;
                // console.log(kelasB)
                $.ajax({
                    url: "{{ url('') }}/lokasi/cek/" + id,
                    async: false,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            ceklokasi.push(data.nama_lokasi);
                            var cekEqual = lokasi.toUpperCase() === data.nama_lokasi
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
                        url: "{{ url('') }}/lokasiE/" + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            alamat: alamat,
                            lokasi: lokasi
                        },
                        success: function(res) {
                            // console.log(res);
                            swal({
                                icon: "success",
                                text: res['success']
                            });
                            $('#editLokasi').modal('hide');
                            $('#dt_lokasi').DataTable().ajax.reload();

                        }
                    });
                } else if (same == 1) {
                    swal({
                        icon: "warning",
                        text: lokasi + " Sudah Terdaftar"
                    });
                }
            });
        }
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

            $('#dt_dokumen').DataTable().clear();
            $('#dt_dokumen').DataTable().destroy();
            $("#dt_dokumen").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/dokLok/load/" + id,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "nama_file"
                    },
                    {
                        "data": "path",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<a href="{{ url('') }}/${data}" class="btn btn-success" target="_blank"><i class="fas fa-eyes"></i>
                                        Cek</a>`;
                            //
                            return html;
                        }
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-danger" onclick="deleteDokLok(${data})"><i class="fas fa-trash-alt"></i>
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
                url: "{{ url('') }}/lokasi/storeMedia",
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
            $('#dokumenLok').on('hidden.bs.modal', function(e) {
                if (Dropzone.instances.length > 0) Dropzone.instances.forEach(dz => dz.destroy());
            })
        });
    </script>

    {{-- Delete Dokumen Lokasi --}}
    <script>
        function deleteDokLok(id) {

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
                            url: "{{ url('') }}/del/dokLokasi/" + id,
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

    {{-- Confirm Delete Lokasi --}}
    <script>
        function deleteLokasi(id) {
            var cekData = 0;
            $.ajax({
                url: "{{ url('') }}/subL/load/" + 1,
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
                                url: "{{ url('') }}/del/lokasi/" + id,
                                success: function() {
                                    $('#dt_lokasi').DataTable().ajax.reload();
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

    {{-- //////////////////////////////////////////////////////////////// --}}

    {{-- Load Sub Lokasi --}}
    <script>
        function loadSublokasi() {
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
                                        data-bs-target="#dokumenSubL" onclick="dokSubLokasi(${data})"><i class="fas fa-folder"></i>
                                        </button>`;
                            //
                            return html;
                        }
                    },
                    {
                        "data": "id_subL",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<div class="container">
                                            <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                                <button class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editsubL" onclick="editL(${data})"><i class="fas fa-edit"></i>
                                                </button>
                                                <button onclick="deleteSubL(${data})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>`;
                            //
                            return html;
                        }
                    }
                ],

            })
        }
    </script>

    {{-- Input Sub Lokasi --}}
    <script>
        function subLokasiIn() {
            $("#drpLokasiIn").select2({
                dropdownParent: $("#subLokasiIn")
            })
            $.ajax({
                url: "{{ url('') }}/lokasi/load/" + 1,
                success: function(res) {
                    $("#drpLokasiIn").children().remove();
                    $("#drpLokasiIn").append(
                        '<option selected value="">Pilih Lokasi</option>');
                    $.each(res, function(index, x) {
                        $('#drpLokasiIn').append(
                            '<option value="' + x.id_lokasi + '">' + x
                            .nama_lokasi + '</option>'
                        )
                    })
                }
            });

            $('#frmsubLIn').on('submit', function(e) {
                e.preventDefault();

                let subL = $('#subLin').val();
                let lokasi = $('#drpLokasiIn').val();
                const ceksubL = [];
                var same = 0;

                subL = ucwords(subL);

                $.ajax({
                    url: "{{ url('') }}/subL/load/" + 1,
                    async: false,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            ceksubL.push(data.nama_subL);
                            var cekEqual = subL.toUpperCase() === data.nama_subL.toUpperCase();
                            if (cekEqual) {
                                if (data.id_lokasi == lokasi) {
                                    same = 1;
                                }
                            }
                        })

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/subL/in",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    lokasi: lokasi,
                                    subL: subL
                                },
                                success: function(res) {
                                    // console.log(res);
                                    $('#subLokasiIn').modal('hide');
                                    $("#frmsubLIn")[0].reset();
                                    $('#dt_subL').DataTable().ajax.reload();
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                }
                            });
                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: `${subL} dengan lokasi ${lokasi}` + " Sudah Terdaftar"
                            });
                        }
                    }
                });
            });
        }
    </script>

    {{-- Edit Sub Lokasi --}}
    <script>
        function editL(id) {
            $("#editDrpLokasi").select2({
                dropdownParent: $("#editsubL")
            })
            $.ajax({
                url: "{{ url('') }}/subLokasiE/load/" + id,
                success: function(data) {
                    document.getElementById('editSubL').value = data.nama_subL;
                    document.getElementById('cekSubL').value = data.nama_subL;
                    document.getElementById('cekDrpLokasi').value = data.id_lokasi;
                    $.ajax({
                        url: "{{ url('') }}/lokasi/load/" + id,
                        success: function(res) {
                            $("#editDrpLokasi").children().remove();
                            $("#editDrpLokasi").append(
                                '<option selected value="">Pilih Klasifikasi</option>');
                            $.each(res, function(index, x) {
                                if (x.id_lokasi == data.id_lokasi) {
                                    $('#editDrpLokasi').append(`<option value="${x.id_lokasi}" selected>
                                        ${x.nama_lokasi}
                                            </option>`)
                                } else {
                                    $('#editDrpLokasi').append(
                                        '<option value="' + x.id_lokasi + '">' + x
                                        .nama_lokasi + '</option>'
                                    )
                                }
                            })
                        }
                    });
                }
            });

            $('#frmsubEdit').on('submit', function(e) {
                e.preventDefault();

                let lokasi = $('#editDrpLokasi').val();
                let subL = $('#editSubL').val();
                let cek = $('#cekSubL').val();
                let cekLokasi;
                subL = ucwords(subL);
                var areEqual = subL.toUpperCase() === cek.toUpperCase();
                var same = 0;
                // console.log(kelasB)
                $.ajax({
                    url: "{{ url('') }}/subL/cek/" + id,
                    async: false,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            // cekSubL.push(data.nama_subL);
                            var cekEqual = subL.toUpperCase() === data.nama_subL.toUpperCase();
                            if (cekEqual) {
                                if (data.id_lokasi == lokasi) {
                                    same = 1;
                                }
                            }
                        })
                    }
                });
                if (same == 0) {
                    $.ajax({
                        url: "{{ url('') }}/subLokasiE/" + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            subL: subL,
                            lokasi: lokasi
                        },
                        success: function(res) {
                            // console.log(res);
                            $('#editsubL').modal('hide');
                            $('#dt_subL').DataTable().ajax.reload();
                            swal({
                                icon: "success",
                                text: res['success']
                            });
                        }
                    });
                } else if (same == 1) {
                    swal({
                        icon: "warning",
                        text: `Sub Lokasi ${subL} dengan Lokasi ${lokasi}` + " Sudah Terdaftar"
                    });
                }
            });
        }
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
                    $('#headerDokSub').html(html);
                }
            })

            $('#dt_dokumenSub').DataTable().clear();
            $('#dt_dokumenSub').DataTable().destroy();
            $("#dt_dokumenSub").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/dokSubLok/load/" + id,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "nama_file"
                    },
                    {
                        "data": "path",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<a href="{{ url('') }}/${data}" class="btn btn-success" target="_blank"><i class="fas fa-eyes"></i>
                                    Cek</a>`;
                            //
                            return html;
                        }
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-danger" onclick="deleteDokLok(${data})"><i class="fas fa-trash-alt"></i>
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
            var myDropzone1 = new Dropzone("div#myDropSub", {
                url: "{{ url('') }}/subLokasi/storeMedia",
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
                            $('#dt_dokumenSub').DataTable().ajax.reload();
                        })
                }
            });
        }
        $(document).ready(function() {
            $('#dokumenSubL').on('hidden.bs.modal', function(e) {
                if (Dropzone.instances.length > 0) Dropzone.instances.forEach(dz => dz.destroy());
            })
        });
    </script>

    {{-- Confirm Delete Sub Lokasi --}}
    <script>
        function deleteSubL(id) {
            var cekData = 0;
            $.ajax({
                url: "{{ url('') }}/assets/load/" + 1,
                async: false,
                success: function(res) {
                    // console.log(res);
                    $.each(res, function(index, x) {
                        if (x.id_subLokasi == id) {
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
                                url: "{{ url('') }}/del/subL/" + id,
                                success: function() {
                                    $('#dt_subL').DataTable().ajax.reload();
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

    {{-- Delete Dokumen Lokasi --}}
    <script>
        function deleteDokSubL(id) {

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
                            url: "{{ url('') }}/del/dokSubLok/" + id,
                            success: function() {
                                $('#dt_dokumenSub').DataTable().ajax.reload();
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


    {{-- ///////////////////////////////////////////////////////// --}}

    {{-- Load Pemilik --}}
    <script>
        function loadPemilik() {
            $('#dt_pemilik').DataTable().clear();
            $('#dt_pemilik').DataTable().destroy();
            $("#dt_pemilik").DataTable({
                "scrollX": true,
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

                            if (cekData == 1) {
                                html += `<div class="table-links">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editPemilik" onclick="editPemilik(${data})">
                                        Edit</button>
                                    </div>`;
                            } else if (cekData == 0) {
                                html += `<div class="table-links">
                            <a href="#" data-bs-toggle="modal"
                            data-bs-target="#editPemilik" onclick="editPemilik(${data})">
                                    Edit</a>
                                    <div class="bullet"></div>
                                <a href="#" class="text-danger" onclick="deletePemilik(${data})">
                                    Hapus</a>
                                </div>`;
                            }
                            return html;
                        }
                    },
                    {
                        "data": "status"
                    }
                ],
            })
        }
    </script>

    {{-- Input Pemilik --}}
    <script>
        function pemilikIn() {
            $('#frmPemilikIn').on('submit', function(e) {
                e.preventDefault();

                let pemilik = $('#pemilikIn').val();
                let status = $("input[name=status]:checked").val();
                // const cekpemilik = [];
                var same = 0;
                // console.log(status);
                $.ajax({
                    url: "{{ url('') }}/pemilik/load/" + 1,
                    async: false,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = pemilik.toUpperCase() === data.nama_pemilik
                                .toUpperCase();
                            if (cekEqual) {
                                if (status == data.status) {
                                    same = 1;
                                }
                            }
                        })
                    }
                });
                if (same == 0) {
                    $.ajax({
                        url: "{{ url('') }}/pemilik/in",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            pemilik: pemilik,
                            status: status
                        },
                        success: function(res) {
                            // console.log(res);
                            $('#inPemilik').modal('hide');
                            $("#frmPemilikIn")[0].reset();
                            $('#dt_pemilik').DataTable().ajax.reload();
                            swal({
                                icon: "success",
                                text: res['success']
                            });
                        }
                    });
                } else if (same == 1) {
                    swal({
                        icon: "warning",
                        text: `(${pemilik} dengan status ${status})` +
                            " Sudah Terdaftar"
                    });
                }
            });
        }
    </script>

    {{-- Edit Pemilik --}}
    <script>
        function editPemilik(id) {
            $.ajax({
                url: "{{ url('') }}/pemilikE/load/" + id,
                success: function(data) {
                    document.getElementById('pemilikE').value = data.nama_pemilik;
                    document.getElementById('cekPemilik').value = data.nama_pemilik;
                    if (data.status == "Pribadi") {
                        $('#a').prop('checked', true);
                    } else {
                        $('#b').prop('checked', true);
                    }
                }
            });

            $('#frmEditPemilik').on('submit', function(e) {
                e.preventDefault();

                let pemilik = $('#pemilikE').val();
                let cek = $('#cekPemilik').val();
                let status = $("input[name=statusE]:checked").val();

                var areEqual = pemilik.toUpperCase() === cek.toUpperCase();
                var same = 0;
                // console.log(kelasB)
                $.ajax({
                    url: "{{ url('') }}/pemilik/load/" + 1,
                    async: false,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = pemilik.toUpperCase() === data.nama_pemilik
                                .toUpperCase();
                            if (cekEqual) {
                                if (status == data.status) {
                                    same = 1;
                                }
                            }
                        })
                    }
                });
                if (same == 0) {
                    $.ajax({
                        url: "{{ url('') }}/pemilikE/" + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            pemilik: pemilik,
                            status: status
                        },
                        success: function(res) {
                            // console.log(res);
                            swal({
                                icon: "success",
                                text: res['success']
                            });
                            $('#editPemilik').modal('hide');
                            $('#dt_pemilik').DataTable().ajax.reload();
                        }
                    });
                } else if (same == 1) {
                    swal({
                        icon: "warning",
                        text: `(${pemilik} dengan status ${status})` +
                            " Sudah Terdaftar"
                    });
                }
            });
        }
    </script>

    {{-- Confirm Delete Sub Lokasi --}}
    <script>
        function deletePemilik(id) {
            var cekData = 0;
            $.ajax({
                url: "{{ url('') }}/assets/load/" + 1,
                async: false,
                success: function(res) {
                    // console.log(res);
                    $.each(res, function(index, x) {
                        if (x.id_pemilik == id) {
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
                                url: "{{ url('') }}/del/pemilik/" + id,
                                success: function() {
                                    $('#dt_pemilik').DataTable().ajax.reload();
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
