@extends('layouts\master')

@section('header-form')
    <h1>List Validasi Pesanan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
        <div class="breadcrumb-item">List Validasi</div>
    </div>
@endsection
@section('content')
    <div class="section-body">
        {{-- /////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}
        <div class="card card-info" id="isiCart">
            <div class="card-header" id="headerCart">
                {{-- <h4>Isi Keranjang</h4>
                <div class="card-header-action">
                </div> --}}
            </div>
            <div class="card-body">
                <div class="card-header card text-center">
                    <h4>List Item</h4>
                </div>
                <div class="card-body">
                    <table id="dt_items" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="check-all"></th>
                                <th>Nama Barang</th>
                                <th>Model</th>
                                <th>Merk</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Dokumen</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="card card-info">
            <div class="card-header card text-center">
                <h4>List Validasi Pesanan</h4>
            </div>
            <div class="card-body">
                <table id="dt_cart" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Kode Keranjang</th>
                            <th>Nama Pemesan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($validO as $item)
                            <tr>

                                <td>
                                    {{ $item->kode_cart }}
                                </td>
                                <td>
                                    {{ $item->nama_pemesan }}
                                </td>
                                <td>
                                    <?php $cek = $item->status; ?>
                                    @if ($cek == 'Request' || $cek == 'Revisi' || $cek == 'Validate')
                                        <button type="button" class="btn btn-primary"
                                            onclick="items({{ $item->id_cart }})">
                                            <i class="fas fa-thumbs-up"></i>
                                            Validasi
                                        </button>
                                    @elseif($cek == 'Purchased')
                                        <span class="badge badge-success">Sudah Dibeli</span> |
                                        <button type="button" class="btn btn-info" onclick="items({{ $item->id_cart }})">
                                            <i class="fas fa-clipboard-list"></i>
                                        </button>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
{{-- Set Note Modal --}}


{{-- Detail Order Modal --}}
@foreach ($orders as $data)
    <div class="modal fade" id="detail{{ $data->id_orders }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        {{-- <i class="fas fa-times"></i> --}}
                    </button>
                </div>
                <div class="card">
                    <div class="card-header card text-center">
                        <h4>Detail Barang</h4>
                        <h4>({{ $data->kode_order }})</h4>
                        <br>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#listB"
                            onclick="items({{ $data->id_cart }})">
                            <i class="fas fa-shopping-basket"></i>
                            Keranjang
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div id="demo" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="images/logo1.png" alt="Los Angeles">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="images/logo.png" alt="Chicago">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            {{-- <div class="card-header card text-center">
                                <h4>List Detail Barang</h4>
                            </div> --}}
                            <div class="form-group row" id="A">

                                {{-- Barang --}}
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        id="vendor" disabled>
                                        <option selected disabled value="">Pilih Barang</option>
                                        @foreach ($barang as $items)
                                            <option value="{{ $items->id_barangIven }}"
                                                {{ $data->id_barangIven == $items->id_barangIven ? 'selected' : '' }}>
                                                {{ $items->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Vendor --}}
                                <div class="form-group">
                                    <label>Nama Vendor</label>
                                    <select class="form-select" aria-label=".form-select-sm example" name="vendor"
                                        id="vendor" disabled>
                                        <option selected disabled value="">Vendor Kosong</option>
                                        @foreach ($vendors as $items)
                                            <option value="{{ $items->id_vendor }}"
                                                {{ $data->id_vendor == $items->id_vendor ? 'selected' : '' }}>
                                                {{ $items->nama_vendor }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Pemesan --}}
                                <div class="form-group">
                                    <label>Nama Pemesan</label>
                                    <input type="text" class="form-control" readonly
                                        placeholder="Nama Pemesan Barang" value="{{ $data->id_pemesan }}">
                                </div>

                                {{-- Pembeli --}}
                                <div class="form-group">
                                    <label>Nama Pembeli</label>
                                    <input type="text" class="form-control" readonly
                                        placeholder="Nama Pembeli Barang" value="{{ $data->id_pembeli }}">
                                </div>

                                {{-- Validator --}}
                                <div class="form-group">
                                    <label>Nama Validator</label>
                                    <input type="text" class="form-control" readonly placeholder="Nama Validator"
                                        value="{{ $data->id_validator }}">
                                </div>

                                {{-- Harga --}}
                                <div class="form-group">
                                    <label>Harga Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Harga Barang"
                                        value="{{ $data->harga }}">
                                </div>
                            </div>

                            <div class="form-group row" id="B">
                                {{-- Model --}}
                                <div class="form-group">
                                    <label>Model Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Model Barang"
                                        value="{{ $data->model }}">
                                </div>

                                {{-- Merk --}}
                                <div class="form-group">
                                    <label>Merk Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Merk Barang"
                                        value="{{ $data->merk }}">
                                </div>

                                {{-- Warna --}}
                                <div class="form-group">
                                    <label>Warna Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Warna Barang"
                                        value="{{ $data->warna }}">
                                </div>

                                {{-- Ukuran --}}
                                <div class="form-group">
                                    <label>Ukuran Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Ukuran Barang"
                                        value="{{ $data->ukuran }}">
                                </div>

                                {{-- Jumlah --}}
                                <div class="form-group">
                                    <label>Jumlah Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Jumlah Barang"
                                        value="{{ $data->jlh_barang }}">
                                </div>

                                {{-- Alasan --}}
                                <div class="form-group">
                                    <label>Alasan Pembelian</label>
                                    <input type="text" class="form-control" readonly
                                        placeholder="Alasan Pembelian" value="{{ $data->alasan_beli }}">
                                </div>
                            </div>
                        </div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item"><a class="page-link" href="#" onclick="hideSeek()">1</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#"
                                        onclick="hideSeek1()">2</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- Dokumen Pesanan Modal --}}
<div class="modal fade" id="dokumen" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content" style="overflow-y: initial">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="container"></div>
            <div class="card">
                <div class="card-header card text-center" id="headerDok">
                </div>
                <div class="modal-body ">
                    <div class="card card-info">
                        <div class="card-header card text-center">
                            <h4>Tabel Dokumentasi</h4>
                        </div>
                        <div class="card-body">
                            <table id="dt_dokumen" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nama File</th>
                                        <th>Cek</th>
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
</div>

@include('sweetalert::alert')

@push('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script>
        $(document).ready(function() {
            $('#items').hide();
            $('#dt_cart').DataTable({
                "scrollX": true
            });
            $('#dt_items').DataTable({
                "scrollX": true
            });
            $('#isiCart').hide();

            $.ajax({
                url: "validOrder/get",
                success: function(res) {
                    console.log(res);
                }
            })
        });
    </script>

    {{-- Select Vendor Js --}}
    <script>
        $(document).ready(function() {
            $('#barang').on('change', function() {
                var vendorDef = "Vendor Kosong";
                var id = $(this).val();
                console.log(id);
                $("#vendor").children().remove();
                $("#vendor").append('<option selected value="">Pilih Vendor</option>');
                // $("#vendor").prop('disabled', true)
                if (id != '' && id != null) {
                    // $("subLokasi").prop('disabled', false)
                    $.ajax({
                        url: "orders/getVendor/" + id,
                        success: function(res) {
                            $('#vendor').append(
                                '<option value="' + 0 + '">' + vendorDef + '</option>'
                            )
                            $.each(res, function(index, data) {
                                $('#vendor').append(
                                    '<option value="' + data.id_vendor + '">' + data
                                    .nama_vendor + '</option>'
                                )
                            })
                        }
                    })
                }

            });
        });
    </script>

    {{-- Select 2 --}}
    <script>
        function tambah() {
            $("#barangIn").select2({
                dropdownParent: $("#order")
            })
            $("#vendorIn").select2({
                dropdownParent: $("#order")
            })
            $("#modelIn").select2({
                dropdownParent: $("#order")
            })
            $("#merkIn").select2({
                dropdownParent: $("#order")
            })
            $("#warnaIn").select2({
                dropdownParent: $("#order")
            })
        }

        function edit(id) {

            $("#barang" + id).select2({
                dropdownParent: $("#editOrd" + id)
            })
            $("#vendor" + id).select2({
                dropdownParent: $("#editOrd" + id)
            })
            $("#model" + id).select2({
                dropdownParent: $("#editOrd" + id)
            })
            $("#merk" + id).select2({
                dropdownParent: $("#editOrd" + id)
            })
            $("#warna" + id).select2({
                dropdownParent: $("#editOrd" + id)
            })
        }
    </script>

    {{-- List Barang JS --}}
    <script>
        function items(id) {
            $('#isiCart').show();
            // console.log(status);
            $.ajax({
                url: "cart/listB/" + id,
                success: function(data) {
                    var html;
                    var aksi;
                    // var x = data.status;
                    html = `<h4> Isi Keranjang (${data.kode_cart})</h4>
                        <br>`;
                    if (data.status == 'Purchased') {
                        html += `<span class="badge badge-dark"> <i class="fas fa-lock"></i></span>`;
                    } else {
                        html += `<div class="card-header-action">
                            <button onclick="approve(${data.id_cart})" class="btn btn-primary"><i class="far fa-thumbs-up"></i>
                                Setujui</button> |
                            <button onclick="alasan(${data.id_cart})" class="btn btn-danger"><i class="far fa-thumbs-down"></i>
                                Tolak</button> |
                            <button onclick="cancel(${data.id_cart})" class="btn btn-warning"><i class="fas fa-marker"></i>
                                Revisi</button>
                    </div>`;
                    }
                    $('#headerCart').html(html);
                }
            })

            $(document).ready(function() {
                // $('#items').show();
                $('#dt_items').DataTable().clear();
                $('#dt_items').DataTable().destroy();

                $("#dt_items").DataTable({
                    "scrollX": true,
                    "ajax": {
                        "url": "{{ url('') }}/cart/item/" + id,
                        "dataSrc": "",
                    },
                    "columns": [{
                            "data": "id_orders",
                            "render": function(data, type, row) { // Tampilkan kolom aksi
                                var html =
                                    `<td><input type='checkbox' id="p${data}" class='check-item' name="pilih[]" data-id="${data}"></td>`
                                return html
                            }
                        },
                        {
                            "data": "id_barangIven",
                            "render": function(data, type, full, meta) {
                                var currentCell = $("#dt_items").DataTable().cells({
                                    "row": meta.row,
                                    "column": meta.col
                                }).nodes(0);
                                $.ajax({
                                    url: "{{ url('') }}/cart/brg/" + data,
                                }).done(function(res) {
                                    $(currentCell).text(res);
                                });
                                return null;
                            }
                        },
                        {
                            "data": "model"
                        },
                        {
                            "data": "merk"
                        },
                        {
                            "data": "harga"
                        },
                        {
                            "data": "status"
                        },
                        {
                            "data": "id_orders",
                            "render": function(data, type, row) { // Tampilkan kolom aksi
                                var html =
                                    `<button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#dokumen" onclick="dok(${data})">
                                        <i class="fas fa-folder"></i></button>`
                                return html
                            }
                        },
                        {
                            "data": "id_orders",
                            "render": function(data, type, row) { // Tampilkan kolom aksi
                                var html =
                                    `<button class="btn btn-success" href="#detail${data}" data-bs-toggle="modal" data-bs-target="#detail">
                                        <i class="fas fa-eye"></i></button>`
                                return html
                            }
                        },
                    ],

                })
            });
        }
    </script>

    {{-- Detail Modal Js --}}
    <script>
        $(document).ready(function() {
            $("#B").hide();
        });

        function hideSeek() {
            $("#B").hide();
            $("#A").show();
        }

        function hideSeek1() {
            $("#A").hide();
            $("#B").show();
        }
    </script>

    {{-- Select All --}}
    <script>
        $(document).ready(function() {
            $('#note').hide();
            $("#check-all").click(function() {
                if ($(this).is(":checked"))
                    $(".check-item").prop("checked",
                        true);
                else
                    $(".check-item").prop("checked",
                        false);
            });
        });

        function approve(id) {
            var namas = `<?php echo Session::get('nama'); ?>`;
            var divisi = `<?php echo Session::get('divisi'); ?>`;
            var ids = `<?php echo Session::get('id'); ?>`;
            var allVals = [];

            $(".check-item:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });
            if (allVals.length <= 0) {
                swal({
                    icon: "error",
                    text: "Tolong Ceklis Terlebih Dahulu"
                });
            } else {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "validO/ok/" + id,
                    data: {
                        items: allVals,
                        namas: namas,
                        ids: ids,
                        divisi: divisi,
                    },
                    success: function(data) {
                        $('#dt_items').DataTable().ajax.reload();
                        swal({
                            icon: "success",
                            text: data['success']
                        });
                    }
                })
            }
        }

        function cancel(id) {
            var namas = `<?php echo Session::get('nama'); ?>`;
            var divisi = `<?php echo Session::get('divisi'); ?>`;
            var ids = `<?php echo Session::get('id'); ?>`;
            var allVals = [];
            $(".check-item:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });
            if (allVals.length <= 0) {
                swal({
                    icon: "error",
                    text: "Tolong Ceklis Terlebih Dahulu"
                });
            } else {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "validO/cancel/" + id,
                    data: {
                        items: allVals,
                        namas: namas,
                        ids: ids,
                        divisi: divisi,
                    },
                    success: function(data) {
                        $('#dt_items').DataTable().ajax.reload();
                        swal({
                            icon: "success",
                            text: data['success']
                        });
                    }
                })
            }
        }

        function reject(id, ket) {
            var namas = `<?php echo Session::get('nama'); ?>`;
            var divisi = `<?php echo Session::get('divisi'); ?>`;
            var ids = `<?php echo Session::get('id'); ?>`;
            var allVals = [];
            $(".check-item:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });

            // var ket = document.getElementById('ket').value;
            if (ket == null || ket == "") {
                swal({
                    icon: "error",
                    text: "Tolong Isi Alasan"
                });
            } else {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "validO/rej/" + id,
                    data: {
                        items: allVals,
                        alasan: ket,
                        namas: namas,
                        ids: ids,
                        divisi: divisi,
                    },
                    success: function(data) {
                        // $('#note').hide();
                        $('#dt_items').DataTable().ajax.reload();
                        $("#check-all").prop("checked",
                            false);
                        swal({
                            icon: "success",
                            text: data['success']
                        });

                    }
                })
            }
        }

        function alasan(id) {
            var allVals = [];
            $(".check-item:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });

            if (allVals.length <= 0) {
                swal({
                    icon: "error",
                    text: "Tolong Ceklis Terlebih Dahulu"
                });
            } else {
                swal({
                    title: 'Alasan Penolakan',
                    icon: 'warning',
                    content: 'input',
                }).then((value) => {
                    reject(id, value);
                })
                // if (name) {
                //     swal('Entered name: ' + name)
                // }
            }
        }
    </script>

    {{-- Dokumen Pesanan Js --}}
    <script>
        function dok(id) {
            var status
            $.ajax({
                url: "{{ url('') }}/cartLoad/detail/" + id,
                async: false,
                success: function(data) {
                    var html;
                    // var x = data.status;
                    html = `<h4 style="color:#677fe8">Dokumentasi</h4>
                    <h4>( Kode ${data[0].kode_order} Dan Nama Barang ${data[0].nama_barang} )</h4>
                    <br>`;
                    $('#headerDok').html(html);
                    status = data[0].status;
                }
            })

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
        }
    </script>
@endpush
