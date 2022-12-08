@extends('layouts\master')

@section('header-form')
    <h1>Set Up Pemilik</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="\">Home</a></div>
        <div class="breadcrumb-item">Pemilik</div>
    </div>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-body">
            <div class="tab-content tab-bordered" id="listMerk">
                <div class="tab-pane fade show active">
                    <div class="card">
                        <div class="card">
                            <div class="card-header card text-center">
                                <h4 style="color: #023e8a">Pemilik</h4>
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
                                            <th>Nama Pemilik</th>
                                            <th>Jenis Kepemilikan</th>
                                            <th>Alamat</th>
                                            <th>Nomor</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('Modal\lokasiModal')

@push('page-scripts')
    {{-- //////////////////////////////////////////////////////////////////////////////////////////// --}}

    {{-- Dokumen Load --}}
    <script>
        $(document).ready(function() {
            $('#dt_pemilik').DataTable().clear();
            $('#dt_pemilik').DataTable().destroy();
            $("#dt_pemilik").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "className": "dt-center",
                }],
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
                            html += `<a>${pemilik}</a>`;

                            if (cekData == 1) {
                                html += `<div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editKategori" onclick="editLokasi(${data})"><i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteLokasi(${data})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>
                                </div>`;
                            } else if (cekData == 0) {
                                html += `
                                <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editPemilik" onclick="editPemilik(${data})"><i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deletePemilik(${data})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                                `;
                            }
                            return html;
                        }
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "alamat"
                    },
                    {
                        "data": "nohp"
                    }
                ],
            })
        });
    </script>

    {{-- Input Pemilik --}}
    <script>
        function pemilikIn() {
            $("#drpStatus").select2({
                dropdownParent: $("#inPemilik")
            })
            $('#frmPemilikIn').on('submit', function(e) {
                e.preventDefault();

                let pemilik = $('#pemilikIn').val();
                let status = $("#drpStatus").val();
                let nomor = $("#nomorIn").val();
                let alamat = $("#aPemilikIn").val();
                // const cekpemilik = [];
                var same = 0;
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
                            status: status,
                            nomor: nomor,
                            alamat: alamat
                        },
                        success: function(res) {
                            // console.log(res);
                            $('#inPemilik').modal('hide');
                            $("#frmPemilikIn")[0].reset();
                            $('#dt_pemilik').DataTable().ajax.reload();
                            $("#frmPemilikIn").unbind().click(function() {});
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
            $("#statusE").select2({
                dropdownParent: $("#editPemilik")
            })
            $.ajax({
                url: "{{ url('') }}/pemilikE/load/" + id,
                success: function(data) {
                    document.getElementById('pemilikE').value = data.nama_pemilik;
                    document.getElementById('cekPemilik').value = data.nama_pemilik;
                    if (data.status == "Pribadi") {
                        $('#statusE').val('Pribadi').change();
                    } else {
                        $('#statusE').val('Yayasan').change();
                    }
                    document.getElementById('nomorE').value = data.nohp;
                    document.getElementById('aPemilikE').value = data.alamat;
                }
            });

            $('#frmEditPemilik').on('submit', function(e) {
                e.preventDefault();

                let pemilik = $('#pemilikE').val();
                let cek = $('#cekPemilik').val();
                let status = $("#statusE").val();
                let nomor = $('#nomorE').val();
                let alamat = $('#aPemilikE').val();

                var areEqual = pemilik.toUpperCase() === cek.toUpperCase();
                var same = 0;
                // console.log(kelasB)
                $.ajax({
                    url: "{{ url('') }}/pemilik/cek/" + id,
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
                            status: status,
                            nomor: nomor,
                            alamat: alamat
                        },
                        success: function(res) {
                            // console.log(res);
                            $("#frmEditPemilik").unbind().click(function() {});
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

    {{-- Confirm Delete Pemilik --}}
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
