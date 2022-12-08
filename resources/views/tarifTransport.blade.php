@extends('layouts\master')
@section('header-form')
    <h1>Setup Tarif Transport </h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="dashboard">Home</a></div>
        <div class="breadcrumb-item">Setup Tarif Transport</div>
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
                        aria-controls="home" aria-selected="true" onclick="loadJnsTrnsprt()">
                        Tarif Transport</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" id="subL-tab" data-toggle="tab" href="#subLokasi" role="tab"
                        aria-controls="profile" aria-selected="false" onclick="loadSupir()">
                        Rute</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" id="status-tab" data-toggle="tab" href="#statusSupir" role="tab"
                        aria-controls="statusSupir" aria-selected="false" onclick="loadStatus()">
                        Status Supir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" id="bbm-tab" data-toggle="tab" href="#jenis_BBM" role="tab"
                        aria-controls="jenis_BBM" aria-selected="false" onclick="loadBBM()">
                        Jenis BBM</a>
                </li>
            </ul>
            <div class="tab-content tab-bordered" id="myTabContent6">
                <div class="tab-pane fade show active" id="lokasi" role="tabpanel" aria-labelledby="lokasi-tab">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4 style="color: #023e8a">Jenis Kendaraan</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#inJnsKdr"
                                    onclick="jnsKdrIn()">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_jnsTrnsprt" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Jenis Kendaraan</th>
                                        <th>Maksimum Penumpang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="subLokasi" role="tabpanel" aria-labelledby="status-tab">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4 style="color: #023e8a">Supir</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#inSupir"
                                    onclick="supir()">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_supir" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nama Supir</th>
                                        <th>Status</th>
                                        <th>Tarif (/Hari)</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="statusSupir" role="tabpanel" aria-labelledby="pemilik-tab">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4>Status Supir</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#inStatus"
                                    onclick="statusD_in()">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_status" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Status Supir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="jenis_BBM" role="tabpanel" aria-labelledby="bbm-tab">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4>Jenis Bahan Bakar</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#inBBM"
                                    onclick="bbmIn()">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_bbm" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Bahan Bakar</th>
                                        <th>Harga</th>
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
@include('Modal\setupTransport')

@push('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    {{-- //////////////////////////////////////////////////////////////// --}}

    {{-- Unbind Click --}}
    <script>
        $(document).ready(function() {
            $('#inSupir').on('hidden.bs.modal', function(e) {
                // label = [];
                $("#frmSupirIn").unbind().click(function() {
                    //Stuff
                });
            });

            var rupiah = document.getElementById('tarif');
            rupiah.addEventListener('keyup', function(e) {
                rupiah.value = formatRupiah(this.value);
            });

            var harga = document.getElementById('hargaBBM');
            harga.addEventListener('keyup', function(e) {
                harga.value = formatRupiah(this.value);
            });

        });
    </script>

    {{-- Rupiah Formating --}}
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

    {{-- Format Kalimat --}}
    <script>
        function ucwords(str) {
            var splitStr = str.toLowerCase().split(' ');
            for (var i = 0; i < splitStr.length; i++) {

                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
            }

            return splitStr.join(' ');
        }

        function loadJnsTrnsprt() {
            $('#dt_jnsTrnsprt').DataTable().ajax.reload();
        }
    </script>

    {{-- Load jenis Kendaraan --}}
    <script>
        $(document).ready(function() {
            $('#dt_jnsTrnsprt').DataTable().clear();
            $('#dt_jnsTrnsprt').DataTable().destroy();
            var table = $("#dt_jnsTrnsprt").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/jnsTrnsprt",
                    "dataSrc": "",
                },
                "columnDefs": [{
                    "targets": '_all',
                    "className": "dt-center",
                }],
                "columns": [{
                        "data": "jns_kendaraan"
                    },
                    {
                        "data": "max_penumpang"
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = '';
                            html += `<div class="container">
                                        <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#inJnsKdr" onclick="editJnsTrnspt(${data})"><i class="fas fa-edit"></i>
                                            </button>
                                            <button onclick="deleteJnsTrnspt(${data})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                </div>`;

                            return html;
                        }
                    }

                ]
            })
        });
    </script>

    {{-- Input Jenis --}}
    <script>
        function jnsKdrIn() {
            $('#frmjnsKdrIn').on('submit', function(e) {
                e.preventDefault();

                let jns = $('#jnsKdrIn').val();
                let penumpang = $('#penumpang').val();
                jns = ucwords(jns);
                const cekjns = [];
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/jnsTrnsprt",
                    success: function(res) {
                        $.each(res, function(index, data) {
                            cekjns.push(data.jns_kendaraan);
                        })
                        for (let i = 0; i < cekjns.length; i++) {
                            var cekEqual = jns.toUpperCase() === cekjns[i].toUpperCase();
                            if (cekEqual) {
                                same = 1;
                            }
                        }

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/jnsKdr/in",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    jns: jns,
                                    penumpang: penumpang
                                },
                                success: function(res) {
                                    // console.log(res);
                                    $('#inJnsKdr').modal('hide');
                                    $("#frmjnsKdrIn")[0].reset();
                                    $("#frmjnsKdrIn").unbind().click(function() {});
                                    $('#dt_jnsTrnsprt').DataTable().ajax.reload();
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

    {{-- Edit jnsKdr --}}
    <script>
        function editJnsTrnspt(id) {
            $.ajax({
                url: "{{ url('') }}/jnsTrnsprt/getById/" + id,
                success: function(data) {
                    document.getElementById('jnsKdrIn').value = data[0].jns_kendaraan;
                    $('#penumpang').val(data[0].max_penumpang);
                }
            });

            $('#frmjnsKdrIn').on('submit', function(e) {
                e.preventDefault();

                let jns = $('#jnsKdrIn').val();
                let penumpang = $('#penumpang').val();
                jns = ucwords(jns);
                const cekjns = [];
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/jnsTrnsprt",
                    success: function(res) {
                        // $.each(res, function(index, data) {
                        //     cekjns.push(data.jns_kendaraan);
                        // })
                        // for (let i = 0; i < cekjns.length; i++) {
                        //     var cekEqual = jns.toUpperCase() === cekjns[i].toUpperCase();
                        //     if (cekEqual) {
                        //         same = 1;
                        //     }
                        // }

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/jnsKdr/edit",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    jns: jns,
                                    penumpang: penumpang,
                                    id: id
                                },
                                success: function(res) {
                                    // console.log(res);
                                    $('#inJnsKdr').modal('hide');
                                    $("#frmjnsKdrIn")[0].reset();
                                    $("#frmjnsKdrIn").unbind().click(function() {});
                                    $('#dt_jnsTrnsprt').DataTable().ajax.reload();
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                }
                            });
                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: jns + " Sudah Terdaftar"
                            });
                        }
                    }
                });
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

    {{-- Confirm Delete Jensi Kendaraan --}}
    <script>
        function deleteJnsTrnspt(id) {
            var cekData = 0;
            // $.ajax({
            //     url: "{{ url('') }}/jnsKdr/del",
            //     async: false,
            //     success: function(res) {
            //         // console.log(res);
            //         $.each(res, function(index, x) {
            //             if (x.id == id) {
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
                                url: "{{ url('') }}/jnsKdr/del",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    id: id,
                                },
                                success: function() {
                                    $('#dt_jnsTrnsprt').DataTable().ajax.reload();
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

    {{-- Load Supir --}}
    <script>
        function loadSupir() {
            $('#dt_supir').DataTable().clear();
            $('#dt_supir').DataTable().destroy();
            $("#dt_supir").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "className": "dt-center",
                }],
                "ajax": {
                    "url": "{{ url('') }}/supir",
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "nama_supir"
                    },
                    {
                        "data": "nama_status"
                    },
                    {
                        "data": "tarif",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            return formatRupiah(data, 'Rp.');
                        }
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = '';
                            html += `<div class="container">
                                        <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#inSupir" onclick="editSupir(${data})"><i class="fas fa-edit"></i>
                                            </button>
                                            <button onclick="deleteSupir(${data})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                </div>`;

                            return html;
                        }
                    }
                ],

            })
        }
    </script>

    {{-- Input Supir --}}
    <script>
        function supir() {
            $('#statusD').select2({
                dropdownParent: $("#inSupir .modal-content")
            });
            $.ajax({
                url: "{{ url('') }}/supir/getStatus",
                success: function(res) {
                    // console.log(res);
                    $("#statusD").children().remove();
                    $("#statusD").append(
                        '<option selected value="">Pilih Status Supir</option>');
                    $.each(res, function(index, x) {
                        $('#statusD').append(
                            '<option value="' + x.id + '">' + x
                            .status + '</option>'
                        )
                    })
                }
            });

            $('#frmSupirIn').on('submit', function(e) {
                e.preventDefault();
                let supir = $('#supirIn').val();
                let tarif = convertToAngka($('#tarif').val());
                let status = $('#statusD').val();
                const ceksupir = [];
                var same = 0;
                console.log(status);

                supir = ucwords(supir);

                $.ajax({
                    url: "{{ url('') }}/supir",
                    async: false,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            // ceksupir.push(data.nama_supir);
                            var cekEqual = supir.toUpperCase() === data.nama_supir
                                .toUpperCase();
                            if (cekEqual) {
                                same = 1;
                            }
                        })

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/supir/in",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    supir: supir,
                                    status: status,
                                    tarif: tarif
                                },
                                success: function(res) {
                                    // console.log(res);
                                    $('#inSupir').modal('hide');
                                    $("#frmSupirIn")[0].reset();
                                    $('#dt_supir').DataTable().ajax.reload();
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                }
                            });
                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: `${supir}` + " Sudah Terdaftar"
                            });
                        }
                    }
                });
            });
        }
    </script>

    {{-- Edit Supir --}}
    <script>
        function editSupir(id) {
            $('#statusD').select2({
                dropdownParent: $("#inSupir .modal-content")
            });
            $.ajax({
                url: "{{ url('') }}/supir/getById/" + id,
                success: function(data) {
                    var tarif = data[0].tarif;
                    tarif = formatRupiah(tarif.toString());
                    document.getElementById('supirIn').value = data[0].nama_supir;
                    document.getElementById('tarif').value = tarif;
                    $('#tarif').change();
                    $.ajax({
                        url: "{{ url('') }}/supir/getStatus",
                        success: function(res) {
                            // console.log(res);
                            $("#statusD").children().remove();
                            $("#statusD").append(
                                '<option selected value="">Pilih Status Supir</option>');
                            $.each(res, function(index, x) {
                                $('#statusD').append(
                                    '<option value="' + x.id + '">' + x
                                    .status + '</option>'
                                )
                                $('#statusD').val(data[0].status);
                            })
                        }
                    });
                }
            });

            $('#frmSupirIn').on('submit', function(e) {
                e.preventDefault();

                let supir = $('#supirIn').val();
                let tarif = convertToAngka($('#tarif').val());
                let status = $('#statusD').val();
                const ceksupir = [];
                var same = 0;
                supir = ucwords(supir);

                $.ajax({
                    url: "{{ url('') }}/supir",
                    success: function(res) {

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/supir/edit",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    supir: supir,
                                    tarif: tarif,
                                    status: status,
                                    id: id
                                },
                                success: function(res) {
                                    // console.log(res);
                                    $('#inSupir').modal('hide');
                                    $("#frmSupirIn")[0].reset();
                                    $('#dt_supir').DataTable().ajax.reload();
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                }
                            });
                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: supir + " Sudah Terdaftar"
                            });
                        }
                    }
                });
            });
        }
    </script>

    {{-- Dokumentasi Supir --}}
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

    {{-- Confirm Delete Supir --}}
    <script>
        function deleteSupir(id) {
            var cekData = 0;
            // $.ajax({
            //     url: "{{ url('') }}/assets/load/" + 1,
            //     async: false,
            //     success: function(res) {
            //         // console.log(res);
            //         $.each(res, function(index, x) {
            //             if (x.id_subLokasi == id) {
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
                                url: "{{ url('') }}/supir/del",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    id: id,
                                },
                                success: function() {
                                    $('#dt_supir').DataTable().ajax.reload();
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

    {{-- Delete Dokumen Supir --}}
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
    {{-- Load Status Supir --}}
    <script>
        function loadStatus() {
            $('#dt_status').DataTable().clear();
            $('#dt_status').DataTable().destroy();
            $("#dt_status").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "className": "dt-center",
                }],
                "ajax": {
                    "url": "{{ url('') }}/supir/getStatus",
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "status"
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = '';
                            html += `<div class="container">
                                    <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#inStatus" onclick="editStatus(${data})"><i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="deleteStatus(${data})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>
                                    </div>
                            </div>`;

                            return html;
                        }
                    }
                ],

            })
        }
    </script>

    {{-- input Status Supir --}}
    <script>
        function statusD_in() {
            $('#frmStatusIn').on('submit', function(e) {
                e.preventDefault();
                let status = $('#status').val();

                status = ucwords(status);

                $.ajax({
                    url: "{{ url('') }}/supir/statusIn",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        status: status
                    },
                    success: function(res) {
                        // console.log(res);
                        $('#inStatus').modal('hide');
                        $("#frmStatusIn")[0].reset();
                        $('#dt_status').DataTable().ajax.reload();
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });
            });
        }
    </script>

    {{-- Edit Status Supir --}}
    <script>
        function editStatus(id) {
            $.ajax({
                url: "{{ url('') }}/supir/getStatusById/" + id,
                success: function(data) {
                    document.getElementById('status').value = data[0].status;
                }
            });

            $('#frmStatusIn').on('submit', function(e) {
                e.preventDefault();
                let status = $('#status').val();

                status = ucwords(status);

                $.ajax({
                    url: "{{ url('') }}/supir/statusEdit",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        status: status
                    },
                    success: function(res) {
                        // console.log(res);
                        $('#inStatus').modal('hide');
                        $("#frmStatusIn")[0].reset();
                        $('#dt_status').DataTable().ajax.reload();
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });
            });
        }
    </script>

    {{-- Confirm Delete Status --}}
    <script>
        function deleteStatus(id) {
            var cekData = 0;
            // $.ajax({
            //     url: "{{ url('') }}/assets/load/" + 1,
            //     async: false,
            //     success: function(res) {
            //         // console.log(res);
            //         $.each(res, function(index, x) {
            //             if (x.id_subLokasi == id) {
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
                                url: "{{ url('') }}/supir/statusDel",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    id: id,
                                },
                                success: function() {
                                    $('#dt_status').DataTable().ajax.reload();
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

    {{-- ///////////////////////////////////////////////////////// --}}
    {{-- Load Jenis BBM --}}
    <script>
        function loadBBM() {
            $('#dt_bbm').DataTable().clear();
            $('#dt_bbm').DataTable().destroy();
            $("#dt_bbm").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "className": "dt-center",
                }],
                "ajax": {
                    "url": "{{ url('') }}/supir/getBBM",
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "jenis_bbm"
                    },
                    {
                        "data": "harga",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            return formatRupiah(data, 'Rp.');
                        }
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = '';
                            html += `<div class="container">
                                    <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#inBBM" onclick="editBBM(${data})"><i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="deleteBBM(${data})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>
                                    </div>
                            </div>`;

                            return html;
                        }
                    }
                ],

            })
        }
    </script>

    {{-- input Harga BBM --}}
    <script>
        function bbmIn() {
            $('#frmJenisBBM').on('submit', function(e) {
                e.preventDefault();
                let jenis = $('#jns_bbm').val();
                let harga = convertToAngka($('#hargaBBM').val());

                jenis = ucwords(jenis);

                $.ajax({
                    url: "{{ url('') }}/supir/BBmIn",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        jenis: jenis,
                        harga: harga
                    },
                    success: function(res) {
                        // console.log(res);
                        $('#inBBM').modal('hide');
                        $("#frmJenisBBM")[0].reset();
                        $('#dt_bbm').DataTable().ajax.reload();
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });
            });
        }
    </script>

    {{-- Edit Harga BBM --}}
    <script>
        function editBBM(id) {
            $.ajax({
                url: "{{ url('') }}/supir/getBBmById/" + id,
                success: function(data) {
                    document.getElementById('jns_bbm').value = data[0].jenis_bbm;
                    document.getElementById('hargaBBM').value = data[0].harga;
                }
            });

            $('#frmStatusIn').on('submit', function(e) {
                e.preventDefault();
                let jenis = $('#jns_bbm').val();
                let harga = convertToAngka($('#hargaBBM').val());

                jenis = ucwords(jenis);

                $.ajax({
                    url: "{{ url('') }}/supir/BBmEdit",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        jenis: jenis,
                        harga: harga
                    },
                    success: function(res) {
                        // console.log(res);
                        $('#inBBM').modal('hide');
                        $("#frmJenisBBM")[0].reset();
                        $('#dt_bbm').DataTable().ajax.reload();
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });
            });
        }
    </script>

    {{-- Confirm Delete BBM --}}
    <script>
        function deleteBBM(id) {
            var cekData = 0;
            // $.ajax({
            //     url: "{{ url('') }}/assets/load/" + 1,
            //     async: false,
            //     success: function(res) {
            //         // console.log(res);
            //         $.each(res, function(index, x) {
            //             if (x.id_subLokasi == id) {
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
                                url: "{{ url('') }}/supir/BBmDel",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    id: id,
                                },
                                success: function() {
                                    $('#dt_bbm').DataTable().ajax.reload();
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
