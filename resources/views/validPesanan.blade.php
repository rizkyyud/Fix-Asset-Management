@extends('layouts\master')
@section('header-form')
    <h1>List Validasi Pesanan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
        <div class="breadcrumb-item">Validasi Pesanan</div>
    </div>
@endsection

@section('content')
    <div class="card card-primary" id="isiCart">
        <div class="card-header card text-center">
            <h4>List Validasi</h4>
            <div class="card-header-action">
                <a href="#" class="btn btn-info" onclick="history()">History</a>
            </div>
        </div>
        <div class="card-body ">
            <table id="dt_pesanan" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Kode Pesanan</th>
                        <th>Nama Pemesan</th>
                        <th>Tanggal Masuk</th>
                        <th>Status</th>
                        <th>Cek</th>
                        <th></th>
                        {{-- <th>Simpan PO</th> --}}
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
{{-- @include('Modal\reqPesananModal') --}}

{{-- Validasi Form Item --}}
<div class="modal fade" id="itemIn" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmItemAdd">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Pengecekan Pesanan</h4>
                        {{-- <h4 id="itemHead"></h4> --}}
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" name="nama" id="namaB" required=""
                                    readonly>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Kode</label>
                                <input type="text" class="form-control" name="nama" id="kodeB" required=""
                                    readonly>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Vendor</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" id="vendorIn" disabled>
                                    <option value="" disabled selected hidden>Pilih Vendor</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harus Dipilih
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Jumlah</label>
                                <input type="text" class="form-control" name="jlhBrg" id="jlhBrg" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Total Harga</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="totalHargaBrg" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Harga Barang (/Satuan)</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" min="1" placeholder="0" class="form-control"
                                        id="hargaIn">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-success" type="submit">Validasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Alasan Penolakan Form Item --}}
<div class="modal fade" id="rejectItem" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" id="frmReject">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Alasan Penolakan</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Alasan</label>
                                <input type="text" class="form-control" name="nama" id="note"
                                    required="">
                                <div class="invalid-feedback">
                                    Harus Diisi
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-danger" type="submit">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="po" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="dt_po" class="display nowrap dataTable dtr-inline collapsed"
                        style="width: 100%; display:none">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Lokasi</th>
                                <th>Vendor</th>
                                <th>Alasan Beli</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Total</th>
                                {{-- <th>Simpan PO</th> --}}
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-danger" type="submit">Reject</button>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Detail Pesanan --}}
<div class="modal fade" id="detailOrd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body ">
                <div class="container-fluid">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card text-center" id="detailHead">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container-fluid">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-header card text-center">
                                    <h4 style="color: #023e8a">Detail Barang</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <strong class="col-5">Nama</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="namaD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Kategori</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="kateD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Tipe</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="tipeD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Merk</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="merkD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Model</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="modelD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Warna</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="warnaD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Ukuran</strong>
                                        <strong class="col-2">:</strong>
                                        <strong class="col-5" id="ukuranD"></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container-fluid">
                    <div class="tab-content tab-bordered">
                        <div class="tab-pane fade show active">
                            <div class="card">
                                <div class="card-header card text-center">
                                    <h4 style="color: #023e8a">Detail Pesanan</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <strong class="col-5">Vendor</strong>
                                        <strong class="col-1">:</strong>
                                        <strong class="col-5" id="vendorD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Lokasi Asset</strong>
                                        <strong class="col-1">:</strong>
                                        <strong class="col-5" id="assetD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Lokasi Sub Asset</strong>
                                        <strong class="col-1">:</strong>
                                        <strong class="col-5" id="subD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Jumlah</strong>
                                        <strong class="col-1">:</strong>
                                        <strong class="col-5" id="jlhD"></strong>
                                    </div>
                                    <div class="form-group row">
                                        <strong class="col-5">Alasan</strong>
                                        <strong class="col-1">:</strong>
                                        <strong class="col-5" id="alasanD"></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    {{-- /////////////////////////////////////////////////////////////////////////////////////// --}}

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

    {{-- Load Page Script --}}
    <script>
        $(document).ready(function() {
            $('#dt_pesanan').DataTable().clear();
            $('#dt_pesanan').DataTable().destroy();
            var table = $("#dt_pesanan").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "order": [
                    [1, 'asc']
                ],
                "ajax": {
                    "url": "{{ url('') }}/validOrder/get",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var nama = row['kode'];
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
                        "data": "nama"
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
                        "data": "status",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = '';
                            html +=
                                `<div class="container">
                                        <div class="col-12" style="margin-top: 5px; margin-bottom: 5px;">
                                            <a> ${data} </a>
                                        </div>
                                </div>`;
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
                        "data": "id_validator",
                        "render": function(data, type, row, meta) {
                            var id = row['id_cart'];
                            var nomor = row['kode']
                            var html = '';
                            html =
                                `<button style="margin-bottom: 15px; margin-top: 5px" onclick="savePO(${id},'${nomor}')" class="btn btn-primary">Simpan PO</button>`;
                            return html;
                        }
                    },
                ],
            });

            $('#dt_pesanan tbody').off('click', 'td.details-control');
            $('#dt_pesanan tbody').on('click', 'td.dt-control', function(e) {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var parentRow = $(this).closest("tr").prev()[0];
                var rowData = table.row(parentRow).data();

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                }
            });
        });

        function format(d) {
            var id = d.id_cart;
            let html = ``;
            // `d` is the original data object for the row
            html = `<center>
                <button style="margin-bottom: 15px; margin-top: 5px" onclick="approveAll(${id})" class="btn btn-success">Approve All</button>                
                </center>
            
            <table class="table table-bordered table-md align-middle" id="tabelList">
                            <thead>
                                <tr style="text-align: center">
                                    <th>Nama Barang</th>                                    
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Last Update</th>
                                    <th>Jumlah Barang</th>
                                    <th>Harga(/item)</th>
                                    <th>Total Harga</th>
                                    <th>Detail</th>
                                    <th>Approve</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center">
                        `;
            $.ajax({
                url: "{{ url('') }}/pesanan/cartItem/" + id,
                type: "GET",
                async: false,
                success: function(res) {
                    console.log(res);
                    $.each(res, function(index, data) {

                        var date = new Date(data.updated_at);
                        var day = date.getDate();
                        var month = date.getMonth() + 1;
                        var year = date.getFullYear();
                        var cek = 0;
                        var update = [day, month, year].join('/');
                        var harga = formatRupiah(data.harga, 'Rp.');
                        var total = data.harga * data.jumlah;
                        total = formatRupiah(total.toString(), 'Rp.');
                        html +=
                            `<tr>
                                    <td>
                                        <a> ${data.nama} </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#dokumenOrd" onclick="dokOrder(${data})"><i class="fas fa-folder"></i>
                                        </button>
                                    </td>
                                    <td><div class="badge badge-success">${data.status}</div></td>
                                    <td>${update}</td>
                                    <td>${data.jumlah}</td>
                                    <td>${harga}</td>
                                    <td>${total}</td>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target="#detailOrd" onclick="detailOrd('${data.id}','${data.kode}')" class="btn btn-primary"><i class="fas fa-list-alt"></i></a></td>
                                    <td>
                                        <button onclick="approve(${data.id_cart},${data.id})" class="btn btn-success"><i class="fas fa-check-circle"></i></button> |
                                        <button onclick="reject(${data.id_cart},${data.id})" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectItem"><i class="fas fa-times-circle"></i></button>
                                    </td>
                                    `;
                        // html += `<td><a href="#" data-bs-toggle="modal" data-bs-target="#itemIn" onclick="validOrd('${data.id}','${data.nama}')" class="btn btn-primary"><i class="fas fa-thumbs-up"></i></a></td>
                    //         </tr>`;
                    })
                    html += `</tbody>`;

                }
            })
            html += `</table>`;
            return html;
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

            $.ajax({
                url: "{{ url('') }}/pesanan/detailOrd/" + id,
                success: function(res) {
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
                        document.getElementById('assetD').innerHTML = `${data.nama_assets}`;
                        document.getElementById('subD').innerHTML = `${data.nama_subAsset}`;
                        document.getElementById('jlhD').innerHTML = `${data.jumlah}`;
                        document.getElementById('alasanD').innerHTML = `${data.alasan}`;
                    })
                }
            })
        }
    </script>

    {{-- Validasi Item Pesanan --}}
    <script>
        function validOrd(barang, nama) {
            // document.getElementById('itemHead').innerHTML = `Penambahan Item <br> (${nama})`;
            $('#namaB').val(nama);
            $("#vendorIn").select2({
                dropdownParent: $("#itemIn")
            })

            $("#assetIn").select2({
                dropdownParent: $("#itemIn")
            })

            $("#subIn").select2({
                dropdownParent: $("#itemIn")
            })

            $.ajax({
                url: "{{ url('') }}/listPesanan/item/" + barang,
                type: "GET",
                success: function(getRes) {
                    document.getElementById('hargaIn').value = formatRupiah(getRes.harga.toString());
                    document.getElementById('kodeB').value = getRes.kode;
                    $('#jlhBrg').val(getRes.jumlah);
                    var total = getRes.jumlah * getRes.harga;
                    $('#totalHargaBrg').val(formatRupiah(total.toString()));

                    // Vendor Dropdown
                    $.ajax({
                        url: "{{ url('') }}/pesanan/getVendorDrp/" + getRes.id_barang,
                        type: "GET",
                        success: function(res) {
                            var vendorDef = `Vendor Kosong`;
                            $.each(res, function(index, data) {
                                $('#vendorIn').append(
                                    `<option value=${data.id_vendor}>${data.nama_vendor}</option>`
                                );
                            })

                            $("#vendorIn").val(getRes.id_vendor).change();
                        }
                    })
                }
            });

            // Reset Form
            $('#itemIn').on('hidden.bs.modal', function() {
                $("#frmItemAdd")[0].reset();
            });

            $('#frmItemAdd').on('submit', function(e) {
                e.preventDefault();
                let nama = $('#namaB').val();
                let harga = $('#hargaIn').val();
                let vendor = $('#vendorIn').val();
                harga = convertToAngka(vendor);
                var ids = `<?php echo Session::get('id'); ?>`;
                $.ajax({
                    url: "{{ url('') }}/listPesanan/cekUp/" + barang,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        harga: harga,
                        ids: ids,
                        vendor: vendor
                    },
                    success: function(res) {
                        $('#itemIn').modal('hide');
                        $("#frmItemAdd")[0].reset();
                        $('#dt_pesanan').DataTable().ajax.reload();
                        $("#frmItemAdd").unbind().click(function() {});
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });
            });
        }
    </script>

    {{-- Request Validasi Pesanan --}}
    <script>
        function valid(id) {
            var ids = `<?php echo Session::get('id'); ?>`;
            swal({
                    title: "Request Validasi Barang?",
                    text: "Apakah Anda Ingin Masukan Kedalam Antrian Validasi?",
                    icon: "info",
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ url('') }}/listPesanan/reqVal/" + id,
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                ids: ids
                            },
                            success: function(res) {
                                $('#dt_wish').DataTable().ajax.reload();
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

    {{-- Revisi Js --}}
    <script>
        function revisi(id) {
            $("#barangR" + id).select2({
                dropdownParent: $("#revisi" + id)
            })
            $("#vendorR" + id).select2({
                dropdownParent: $("#revisi" + id)
            })
            $("#modelR" + id).select2({
                dropdownParent: $("#revisi" + id)
            })
            $("#merkR" + id).select2({
                dropdownParent: $("#revisi" + id)
            })
            $("#warnaR" + id).select2({
                dropdownParent: $("#revisi" + id)
            })

            var input = document.getElementById("barang");
            var vendor = document.getElementById("vendor" + id);
            var cek = "";
            var vend = "";

            if (vendor) {
                vend = vendor.value;
                if (vend == "" || vend == null) {
                    if (input) {
                        cek = input.value;
                        console.log(cek);
                        $("#vendor" + id).children().remove();
                        $("#vendor" + id).append('<option selected value="">Pilih Vendor</option>');
                        // $("#vendor").prop('disabled', true)
                        if (cek != '' && cek != null) {
                            // $("subLokasi").prop('disabled', false)
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url: "getVendor/" + cek,
                                type: "GET",
                                success: function(res) {
                                    $.each(res, function(index, data) {
                                        $('#vendor' + id).append(
                                            '<option value="' + data.id_vendor + '">' + data
                                            .nama_vendor + '</option>'
                                        )
                                    })
                                }
                            })
                        }
                    }
                }
            }
        }
    </script>

    {{-- Dokumen Pesanan --}}
    <script>
        function dok(id) {
            var status;
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

            if (status == "Purchased" || status == "Validate") {
                $('#dropZone').hide();
            }
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

    {{-- Detail Modal Js --}}
    <script>
        function set(id) {
            $(document).ready(function() {
                $(`#D${id}`).hide();
            });
        }

        function hideSeek(id) {
            $(`#D${id}`).hide();;
            $(`#C${id}`).show();;
        }

        function hideSeek1(id) {
            $(`#C${id}`).hide();;
            $(`#D${id}`).show();;
        }
    </script>

    {{-- Aksi --}}
    <script>
        function notePop() {
            $(document).ready(function() {
                var ket = document.getElementById('note').value;
                swal({
                    title: "Alasan Penolakan",
                    icon: "warning",
                    text: ket
                });
            });
        }

        function approve(cart, id) {

            swal({
                    title: "Approve Item Pesanan Ini?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var namas = `<?php echo Session::get('nama'); ?>`;
                        var divisi = `<?php echo Session::get('divisi'); ?>`;
                        var ids = `<?php echo Session::get('id'); ?>`;

                        $.ajax({
                            url: "validO/ok/" + cart,
                            data: {
                                namas: namas,
                                ids: ids,
                                id: id,
                                divisi: divisi,
                            },
                            success: function(data) {
                                $('#dt_pesanan').DataTable().ajax.reload();
                                swal({
                                    icon: "success",
                                    text: data['success']
                                });
                            }
                        })
                    } else {
                        swal("Item Tidak Jadi Diapprove!");
                    }
                });

        }

        function approveAll(cart) {
            swal({
                    title: "Approve Semua Item Pesanan?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var namas = `<?php echo Session::get('nama'); ?>`;
                        var divisi = `<?php echo Session::get('divisi'); ?>`;
                        var ids = `<?php echo Session::get('id'); ?>`;

                        $.ajax({
                            url: "validO/okAll/" + cart,
                            data: {
                                namas: namas,
                                ids: ids,
                                divisi: divisi,
                            },
                            success: function(data) {
                                $('#dt_pesanan').DataTable().ajax.reload();
                                swal({
                                    icon: "success",
                                    text: data['success']
                                });
                            }
                        })
                    } else {
                        swal("Data Tidak Jadi Diapprove!");
                    }
                });
        }

        function reject(cart, id) {

            $('#frmReject').on('submit', function(e) {
                e.preventDefault();

                var namas = `<?php echo Session::get('nama'); ?>`;
                var divisi = `<?php echo Session::get('divisi'); ?>`;
                var ids = `<?php echo Session::get('id'); ?>`;
                var alasan = $('#note').val();

                $.ajax({
                    url: "validO/rej/" + cart,
                    data: {
                        namas: namas,
                        ids: ids,
                        id: id,
                        divisi: divisi,
                        alasan: alasan
                    },
                    success: function(data) {
                        $('#dt_pesanan').DataTable().ajax.reload();
                        $('#rejectItem').hide();

                        swal({
                            icon: "success",
                            text: data['success']
                        });
                    }
                })
            });



        }
    </script>



    {{-- Load List Js --}}
    <script>
        $(document).ready(function() {
            // $('#items').show();
        });
    </script>

    {{-- Save PDF --}}
    <script>
        function savePO(id, nomor) {
            var namas = `<?php echo Session::get('nama'); ?>`;
            let text = nomor;
            let nomorPo = text.substring(4, text.length);
            nomorPo = `P${nomorPo}`;
            var pemilik = "";
            var checker = "";
            var validator = "";
            var date = new Date();
            var dateStr =
                ("00" + (date.getMonth() + 1)).slice(-2) + "/" +
                ("00" + date.getDate()).slice(-2) + "/" +
                date.getFullYear();

            $('#dt_po').DataTable().clear();
            $('#dt_po').DataTable().destroy();
            var table = $("#dt_po").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "order": [
                    [1, 'asc']
                ],
                "ajax": {
                    "url": "validO/getPoTabel/" + id,
                    "asyn": false,
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "nama",

                    },
                    {
                        "data": "nama_assets",

                    },
                    {
                        "data": "nama_vendor",

                    },
                    {
                        "data": "alasan",
                    },
                    {
                        "data": "jumlah"
                    },
                    {
                        "data": "harga",
                        "render": function(data, type, row, meta) {
                            var harga = data.toString();
                            harga = formatRupiah(harga, 'Rp.');
                            return harga;
                        }

                    },
                    {
                        "data": "jumlah",
                        "render": function(data, type, row, meta) {
                            var harga = row['harga'];
                            var jumlah = data;
                            var total = harga * jumlah;
                            total = formatRupiah(total.toString(), 'Rp.');
                            return total;
                        }

                    }
                ],
            });

            $.ajax({
                url: "validO/getTtd/" + id,
                async: false,
                success: function(data) {
                    pemilik = data.hsl[0].Pemilik;
                    checker = data.hsl[1].Checker;
                    validator = data.hsl[2].Validator;
                }
            });

            $.ajax({
                url: "pesanan/getTotalCost/" + id,
                // async: false,
                success: function(data) {
                    var doc = new jsPDF('p', 'pt', 'letter');
                    var htmlstring = '';
                    var tempVarToCheckPageHeight = 0;
                    var pageHeight = 0;
                    pageHeight = doc.internal.pageSize.height;
                    specialElementHandlers = {
                        // element with id of "bypass" - jQuery style selector  
                        '#bypassme': function(element, renderer) {
                            // true = "handled elsewhere, bypass text extraction"  
                            return true
                        }
                    };
                    // doc.setLineDash([10, 10], 0);

                    doc.setFontSize(8);
                    var y = 20;
                    doc.setLineWidth(2);
                    doc.text(50, 50, `Purchase Order`);
                    doc.text(370, 50, `Nomor`);
                    doc.text(470, 50, `${nomorPo}`);
                    doc.text(370, 70, `Tanggal`);
                    doc.text(470, 70, `${dateStr}`);
                    doc.autoTable({
                        html: '#dt_po',
                        startY: 110,
                        tableWidth: 'auto',
                        theme: 'grid',
                        showHead: 'everyPage',
                        headStyles: {
                            valign: 'middle',
                            halign: 'center'
                        },
                        columnStyles: {
                            0: {
                                cellWidth: 'auto',
                            },
                            1: {
                                cellWidth: 'auto',
                            },
                            2: {
                                cellWidth: 'auto',
                            }
                        },
                        fontSize: number = 8,
                        styles: {
                            CellHeight: 'auto',
                            // valign: 'center',
                            halign: 'center',
                        }
                    })
                    let finalY = doc.previousAutoTable.finalY;
                    doc.text(455, finalY += 20, `Total:`);
                    doc.text(510, finalY, `${formatRupiah(data.toString(),'Rp.')}`);
                    doc.text(50, finalY += 120, `Diketahui oleh`);
                    doc.text(230, finalY, `Disetujui oleh`);
                    doc.text(420, finalY, `Pemohon`);
                    doc.text(50, finalY += 100, ``);
                    doc.text(230, finalY, ``);
                    doc.text(420, finalY, `${pemilik}`);
                    doc.line(50, finalY += 10, 180, finalY);
                    doc.line(230, finalY, 350, finalY);
                    doc.line(420, finalY, 500, finalY);


                    doc.save(`Report PO.pdf`);
                }
            })

        }
    </script>
@endpush
