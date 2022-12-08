@extends('layouts\master')
@section('header-form')
    <h1>Sewa Fasilitas</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="\">Home</a></div>
        <div class="breadcrumb-item active">Sewa</div>
    </div>
@endsection
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <form class="needs-validation was-validated" novalidate="" method="post"
                    action="sewa/add/{{ Session::get('id') }}">
                    @csrf
                    <input type="hidden" name="namas" value="{{ Session::get('nama') }}">
                    <input type="hidden" name="divisi" value="{{ Session::get('divisi') }}">
                    <button type="submit" class="btn btn-success"
                        onclick="return confirm ('Apakah Anda Ingin Menambah Keranjang Pesanan');">
                        <i class="fas fa-plus"></i>
                        Buat Permintaan Penyewaan
                    </button>
                </form>
            </div>
        </div>
        <br>
    </div>
    <div class="section-body">
        <div class="card card-primary">
            <div class="card-header card text-center">
                <h4>List Penyewaan Anda</h4>
            </div>
            <div class="card-body">
                <table id="dt_sewa" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Kode Penyewaan</th>
                            <th>Tambah Item</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

{{-- List --}}
@foreach ($sewa as $item)
    <div class="modal fade" id="gedung{{ $item->id_sewa }}" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
            <div class="modal-content" style="overflow-y: initial">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="container"></div>
                <div class="card">
                    <div class="card-header card text-center">
                        <h4 style="color:#677fe8">List</h4>
                        <h4>({{ $item->kode_sewa }})</h4>
                        <br>
                        <span type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#add{{ $item->id_sewa }}" onclick="tambah({{ $item->id_sewa }})">
                            <i class="fas fa-plus"></i>
                            Tambah Items
                        </span>
                    </div>

                    <div class="modal-body ">
                        <table id="dt_gedung{{ $item->id_sewa }}"
                            class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nama Item</th>
                                    <th>Tanggal Sewa</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>Status</th>
                                    <th>Add On</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endforeach

{{-- Tambah Barang --}}
@foreach ($sewa as $item)
    <div class="modal fade" id="add{{ $item->id_sewa }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="overflow-y: auto;">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="needs-validation was-validated" novalidate="" action="sewa/item/{{ $item->id }}"
                    method="post" enctype="multipart/form-data" id="frmGdg">
                    <div class="card">
                        @csrf
                        <div class="card-header card text-center">
                            <h4>Form Pengisian Data Sewa Fasilitas</h4>
                            <br>
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#listB{{ $item->id }}" onclick="items({{ $item->id }})">
                                <i class="fas fa-clipboard-list"></i>
                                List
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="form-group row" id="datepairExample">
                                <div class="col-sm-4">
                                    <label>Pilih Fasilitas</label>
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        required="" name="barang" id="gdg{{ $item->id_sewa }}">
                                        <option selected value="">Pilih Item</option>
                                        @foreach ($assets as $gedung)
                                            <option value="{{ $gedung->id_assets }}">{{ $gedung->nama_assets }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label>Tanggal</label>
                                    <input type="date" min="<?php echo date('Y-m-d'); ?>" class="form-control" name="tanggal"
                                        id="tgl" value="{{ old('tanggal') }}" required>
                                    <input type="hidden" name="cekT" id="cekT">
                                    <div class="invalid-feedback">
                                        Harus Diisi
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label>Mulai</label>
                                    <input type="time" name="mulai" value="{{ old('mulai') }}" required id="mulai">
                                    <div class="invalid-feedback" id="errorMulai">
                                        Harus Diisi
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label>Selesai</label>
                                    <input type="text" class=" form-control time end" onchange="validateHhMm(this)"
                                        name="selesai" value="{{ old('selesai') }}" required id="selesai">
                                    <div class="invalid-feedback" id="errorSelesai">
                                        Harus Diisi
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Tambah Gedung</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endforeach

@include('sweetalert::alert')

@push('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

    <script>
        // initialize input widgets first
    </script>
    <script>

    </script>

    {{-- Load dt_sewa Ajax --}}
    <script>
        $(document).ready(function() {
            // $('#items').show();
            var ids = `<?php echo Session::get('id'); ?>`;
            $('#dt_sewa').DataTable().clear();
            $('#dt_sewa').DataTable().destroy();
            $("#dt_sewa").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/sewa/list/" + ids,
                    "dataSrc": "",
                },

                "columns": [{
                        "data": "kode_sewa"
                    },
                    {
                        "data": "id_sewa",
                        "render": function(data, type, row) { // Tampilkan kolom aksi
                            var html =
                                `<button class="btn btn-success" href="#gedung" data-bs-toggle="modal" data-bs-target="#gedung${data}" onclick="items(${data})">
                                    <i class="fas fa-plus-square"></i> Item</button>`
                            return html
                        }
                    },
                    {
                        "data": "id_sewa",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = "";
                            //
                            var status = row['status'];
                            var ket = row['keterangan'];
                            if (status == "List" || status == "Check") {
                                html +=
                                    `<button class="btn btn-primary" href="orders/${data}" data-bs-toggle="modal" data-bs-target="#editOrd${data}" onclick="edit(${data})">
                                        <i class="fas fa-paper-plane"></i> Request</button>`
                            }
                            return html;
                        }
                    },
                ],

            })
        });
    </script>

    {{-- Load List Gedung --}}
    <script>
        function items(id) {
            $(document).ready(function() {
                // var a = "1";
                // $('#items').show();
                $('#dt_gedung' + id).DataTable().clear();
                $('#dt_gedung' + id).DataTable().destroy();
                $("#dt_gedung" + id).DataTable({
                    "scrollX": true,
                    "ajax": {
                        "url": "{{ url('') }}/sewa/item/" + id,
                        "dataSrc": ""
                    },
                    "columns": [{
                            "data": "id_assets",
                        },
                        {
                            "data": "tanggal"
                        },
                        {
                            "data": "mulai"
                        },
                        {
                            "data": "selesai"
                        },
                        {
                            "data": "status"
                        },
                        {
                            "data": "id_sewa",
                            // "render": function(data, type, row) {
                            //     var html =
                            //         `<button class="btn btn-success" href="#detail"data-bs-toggle="modal" data-bs-target="#detail${data}" onclick="detail()">
                        //             <i class="fas fa-eye"></i></button>`
                            //     return html
                            // }
                        },
                        {
                            "data": "id_sewa",
                            // "render": function(data, type, row, meta) {
                            //     var html = "";
                            //     var status = row['status'];
                            //     var ket = row['keterangan'];
                            //     if (status == "Request" || status == "Revisi" || status ==
                            //         "Check") {
                            //         var html =
                            //             `<span class="badge badge-info">Menunggu Disetujui</span>`
                            //     } else if (status == "List") {
                            //         var html =
                            //             `<button class="btn btn-primary" href="orders/${data}"data-bs-toggle="modal" data-bs-target="#editOrd${data}" onclick="edit(${data})">
                        //             <i class="fas fa-edit"></i></button> | ` +
                            //             `<a class="btn btn-danger" href="orders/del/${data}" onclick="return confirm ('Yakin');"><i class="fas fa-trash-alt"></i></a>`
                            //     } else if (status == "Waiting") {
                            //         var html =
                            //             `<span class="badge badge-info">Menunggu Cek Ama</span>`
                            //     } else if (status == "Approve") {
                            //         var html =
                            //             `<span class="badge badge-success">Disetujui</span>`
                            //     } else if (status == "Reject") {
                            //         var html =
                            //             `<span class="badge badge-danger">Tidak Disetujui</span>  | ` +
                            //             `<button class="btn btn-danger" onclick="notePop()"><i class="fas fa-sticky-note"></i></button>` +
                            //             `<input type="hidden" value="${ket}" id="note"></input>`
                            //     }
                            //     return html
                            // }
                        },
                    ],
                })
            });
        }
    </script>

    {{-- CRUD Gedung --}}
    <script>
        // function validateHhMm(inputField) {
        //     var isValid = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(inputField.value);

        //     if (isValid) {
        //         inputField.style.backgroundColor = '#fff';
        //     } else {
        //         document.getElementById('errorSelesai').textContent = "LOGIN CANNOT BE EMPTY";
        //         return false;
        //     }

        //     return isValid;
        // }

        function tambah(id) {
            // $('#dt_sewa').DataTable().clear();
            $("#gdg" + id).select2({
                dropdownParent: $("#add" + id)
            })



            var tgl = `<?php echo date('Y-m-d'); ?>`;
            var cek;
            // console.log(cek);
            $("#tgl").on("input", function() {
                // $('#dt_sewa').DataTable().clear();
                cek = this.value;
                var min;
                if (tgl == cek) {
                    min = `<?php date_default_timezone_set('Asia/Jakarta');
echo date('H:i', time()); ?>`;
                }
            });

            // $('#awal').timepicker({
            //     'timeFormat': 'H:i',
            //     'step': 10,
            // });

            // $('#datepairExample .time').timepicker({
            //     'timeFormat': 'H:i',
            //     // 'minTime': min,

            // });
            // $('#datepairExample').datepair();

            // $('#frmGdg').validate({
            //     rules: {
            //         mulai: {
            //             timeFormat: true
            //         },
            //     },
            // });

            // $.validator.addMethod(
            //     "timeFormat",
            //     function(value, element) {
            //         return value.match(/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/);
            //     },
            //     "Format 24:00 "
            // );

        }
    </script>
@endpush
