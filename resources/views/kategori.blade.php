@extends('layouts\master')
@section('header-form')
    <h1>Setup Kategori Asset</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="dashboard">Home</a></div>
        <div class="breadcrumb-item">Setup Asset</div>
    </div>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-body">
            <div class="tab-content tab-bordered" id="listMerk">
                <div class="tab-pane fade show active">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4 style="color: #023e8a">List Kategori</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#inKategori"
                                    onclick="kategoriIn()">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_kategori" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nama Kategori</th>
                                        <th>Unique Kode</th>
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
@include('Modal\lokasiModal')

@push('page-scripts')
    {{-- //////////////////////////////////////////////////////////////// --}}

    {{-- Format Kata --}}
    <script>
        function ucwords(str) {
            var splitStr = str.toLowerCase().split(' ');
            for (var i = 0; i < splitStr.length; i++) {

                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
            }

            return splitStr.join(' ');
        }
    </script>

    {{-- Load Kategori --}}
    <script>
        $(document).ready(function() {
            $('#dt_kategori').DataTable().clear();
            $('#dt_kategori').DataTable().destroy();
            $("#dt_kategori").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/kategori/load/" + 1,
                    "dataSrc": "",
                },
                "columnDefs": [{
                    "targets": '_all',
                    "className": "dt-center",
                }],
                "columns": [{
                        "data": "id_kategori",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var kategori = row['nama_kategori'];
                            var html = '';
                            var cekData = 0;
                            html += `<strong>${kategori}</strong>`;

                            if (cekData == 1) {
                                html += `<div class="table-links">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editKategori" onclick="editKategori(${data})">
                                        Edit</button>
                                    </div>`;
                            } else if (cekData == 0) {
                                html += `<div class="container">
                                        <div class="col-12" style="margin-bottom: 10px; margin-top: 10px;">
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editKategori" onclick="editKategori(${data})"><i class="fas fa-edit"></i>
                                            </button>
                                            <button onclick="deleteKategori(${data})" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                </div>`;
                            }
                            return html;
                        }
                    },
                    {
                        "data": "uniqe_kode"
                    }
                ]
            });
        })
    </script>

    {{-- Input Kategori --}}
    <script>
        function validateKate(e) {

        }

        function validateKategori(e) {
            const kate = document.querySelector('#kateIn');
            if (e == 'tes') {
                e.classList.add('is-invalid');
                e.classList.remove('is-valid');
                return true;
            } else {
                e.classList.remove('is-invalid');
                e.classList.add('is-valid');
                return false;
            }
        }

        function kategoriIn() {

            // $("#kateIn").on("input", function() {
            //     var kategori = $('#kateIn').val();
            //     // console.log(kategori.val());
            //     if (kategori == 'tes') {
            //         this.classList.add('is-invalid');
            //     } else {
            //         this.classList.remove('is-invalid');
            //     }
            // });

            $('#frmKateIn').on('submit', function(e) {
                e.preventDefault();
                let kategori = $('#kateIn').val();
                let kode = $('#kode').val();
                kategori = ucwords(kategori);
                kode = kode.toUpperCase();
                const cekkategori = [];
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/kategori/load/" + 1,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            cekkategori.push(data.nama_kategori);
                        })
                        for (let i = 0; i < cekkategori.length; i++) {
                            var cekEqual = kategori.toUpperCase() === cekkategori[i].toUpperCase();
                            if (cekEqual) {
                                same = 1;
                            }
                        }

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/kategori/in",
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    kategori: kategori,
                                    kode: kode
                                },
                                success: function(res) {
                                    // console.log(res);
                                    $('#inKategori').modal('hide');
                                    $("#frmKateIn")[0].reset();
                                    $('#dt_kategori').DataTable().ajax.reload();
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                }
                            });
                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: kategori + " Sudah Terdaftar"
                            });
                        }
                    }
                });
            });
        }
    </script>

    {{-- Edit Kategori --}}
    <script>
        function editKategori(id) {
            $("#editKategori").unbind().click(function() {});
            $.ajax({
                url: "{{ url('') }}/kategoriE/load/" + id,
                success: function(data) {
                    document.getElementById('kateE').value = data.nama_kategori;
                    document.getElementById('cekKate').value = data.nama_kategori;
                    document.getElementById('kodeE').value = data.uniqe_kode;
                }
            });

            $('#editKategori').on('submit', function(e) {
                e.preventDefault();
                let kategori = $('#kateE').val();
                let cek = $('#cekKate').val();
                let kode = $('#kodeE').val();
                kategori = ucwords(kategori);
                kode = kode.toUpperCase();

                var areEqual = kategori.toUpperCase() === cek.toUpperCase();
                var same = 0;

                $.ajax({
                    url: "{{ url('') }}/kategori/cek/" + id,
                    async: false,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = kategori.toUpperCase() === data.nama_kategori
                                .toUpperCase();
                            if (cekEqual) {
                                same = 1;
                            }
                        })
                    }
                });
                if (same == 0) {
                    $.ajax({
                        url: "{{ url('') }}/kategoriE/" + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            kategori: kategori,
                            kode: kode
                        },
                        success: function(res) {
                            // console.log(res);
                            $("#editKategori").unbind().click(function() {});
                            swal({
                                icon: "success",
                                text: res['success']
                            });
                            $('#editKategori').modal('hide');
                            $('#dt_kategori').DataTable().ajax.reload();

                        }
                    });
                } else if (same == 1) {
                    swal({
                        icon: "warning",
                        text: kategori + " Sudah Terdaftar"
                    });
                }
            });
        }
    </script>

    {{-- Confirm Delete Kategori --}}
    <script>
        function deleteKategori(id) {
            var cekData = 0;
            $.ajax({
                url: "{{ url('') }}/assets/load/" + 1,
                async: false,
                success: function(res) {
                    // console.log(res);
                    $.each(res, function(index, x) {
                        if (x.id_kategori == id) {
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
                                url: "{{ url('') }}/del/kategori/" + id,
                                success: function() {
                                    $('#dt_kategori').DataTable().ajax.reload();
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
