@extends('layouts\master')
@section('sideBar')
    <div class="main-sidebar">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="/">Asset Management</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <i class="fas fa-project-diagram"></i>
                <a href="/">AM</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                <li class="nav-item">
                    <a href="/" class="nav-link"><i class="fas fa-home"></i><span>Home</span></a>
                </li>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a>------</a>
                </div>
                <li class="menu-header">Assets</li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-hand-holding-usd"></i>
                        <span>Setup Assets</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="lokasi"><i class="fas fa-map-marked-alt"></i></i>
                                Lokasi</a></li>
                        <li><a class="nav-link" href="subLokasi"><i class="fas fa-map-signs"></i></i>
                                Sub Lokasi</a></li>
                        <li><a class="nav-link" href="kategori"><i class="fas fa-clipboard-list"></i>
                                Kategori</a></li>
                        <li><a class="nav-link" href="pemilik"><i class="fas fa-user-tie"></i>
                                Pemilik</a></li>
                    </ul>
                </li>
                <li class="sidebar-menu"><a class="nav-link" href="assetsB"><i class="fas fa-coins"></i>
                        <span>Input Asset</span></a></li>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a>------</a>
                </div>
                <li class="menu-header">Inventaris</li>
                <li class="nav-item dropdown active">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-swatchbook"></i>
                        <span>Setup Inventaris</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="jenisIven"><i class="far fa-list-alt"></i>
                                Jenis</a></li>
                        <li><a class="nav-link" href="barangIven"><i class="fas fa-couch"></i>Barang</a></li>
                        <li class="active"><a class="nav-link" href="vendors"><i
                                    class="fas fa-building"></i>Vendors</a></li>
                        <li><a class="nav-link" href="modelB"><i class="fab fa-accusoft"></i>Model</a></li>
                        <li><a class="nav-link" href="merk"><i class="fab fa-apple"></i>Merk</a></li>
                        <li><a class="nav-link" href="warna"><i class="fas fa-palette"></i>warna</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-menu"><a class="nav-link" href="cart"><i class="fas fa-store"></i>
                        <span>Pesan Barang</span></a></li>
                <li class="sidebar-menu"><a class="nav-link" href="orderAma"><i class="fas fa-clipboard-list"></i>
                        <span>List Pesanan</span></a></li>
                <li class="sidebar-menu"><a class="nav-link" href="validOrder"><i class="fas fa-thumbs-up"></i>
                        <span>Validasi Order</span></a></li>

                <div class="sidebar-brand sidebar-brand-sm">
                    <a>------</a>
                </div>
                <li class="menu-header">Warehouse</li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-swatchbook"></i>
                        <span>In / Out</span></a>
                    <ul class="dropdown-menu">
                        <li class="sidebar-menu"><a class="nav-link" href="barangIn"><i
                                    class="fas fa-receipt"></i></i>
                                <span>In</span></a></li>
                        <li class="sidebar-menu"><a class="nav-link" href="validOrder"><i
                                    class="fas fa-receipt"></i></i>
                                <span>Out</span></a></li>
                    </ul>
                </li>
                <li class="sidebar-menu"><a class="nav-link" href="gudang"><i class="fas fa-warehouse"></i>
                        <span>Gudang</span></a></li>
                <li class="sidebar-menu"><a class="nav-link" href="label"><i class="fas fa-tags"></i>
                        <span>Label Barang</span></a></li>
            </ul>
        </aside>
    </div>
@endsection
@section('header-form')
    <h1>Vendors</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="\">Home</a></div>
        <div class="breadcrumb-item">Vendors</div>
    </div>
@endsection
@section('content')
    <div class="section-body">
        <div class="tab-pane fade show active" id="lokasi" role="tabpanel" aria-labelledby="lokasi-tab">
            <div class="card card-primary">
                <div class="card-header card text-center">
                    <h4>Nama Vendors</h4>
                    <div class="card-header-action">
                        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#insert" onclick="inp()">
                            <i class="fas fa-plus-circle"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="dt_vendor" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;"
                        aria-describedby="example_info">
                        <thead>
                            <tr>
                                <th>Vendor</th>
                                <th>Detail</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('Modal\vendorsModal')

@push('page-scripts')
    {{-- Unbind Click --}}
    <script>
        $(document).ready(function() {
            $('#insert').on('hidden.bs.modal', function(e) {
                // label = [];
                $("#frmVendorIn").unbind().click(function() {
                    //Stuff
                });
            });

            $('#edit').on('hidden.bs.modal', function(e) {
                // label = [];
                $("#editForm").unbind().click(function() {
                    //Stuff
                });
            });

        });
    </script>

    {{-- Load Vendors --}}
    <script>
        $(document).ready(function() {
            $('#dt_vendor').DataTable().clear();
            $('#dt_vendor').DataTable().destroy();
            $("#dt_vendor").DataTable({
                "scrollX": true,
                "ordering": false,
                "columnDefs": [{
                    "targets": "_all",
                    "sortable": false,
                    "className": "dt-center",
                }],
                "ajax": {
                    "url": "{{ url('') }}/vendor/load/" + 1,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "nama_vendor"
                    },
                    {
                        "data": "id_vendor",
                        "render": function(data, type, row,
                            meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-success" data-bs-toggle="modal" onclick="detail(${data})" data-bs-target="#detail"
                            href="#"><i class="fas fa-eye"></i>`;
                            //
                            return html;
                        }
                    },
                    {
                        "data": "id_vendor",
                        "render": function(data, type, row,
                            meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-primary" data-bs-toggle="modal" onclick="edit(${data})" data-bs-target="#edit"
                            href="#"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger"
                            onclick="deleteVendor(${data})"><i class="fas fa-trash-alt"></i></button>`;
                            //
                            return html;
                        }
                    },
                ],
            })
        });
    </script>

    {{-- Tambah Vendor --}}
    <script>
        function inp() {
            $("#jenisIn").select2({
                dropdownParent: $("#insert")
            })

            $('#frmVendorIn').on('submit', function(e) {
                e.preventDefault();
                const nomor = [];
                let vendor = $('#vendorIn').val();
                let jenis = $('#jenisIn').val();
                let kontak = $('#kontak').val();
                let panjang = $('#count').val();
                let alamat = $('#alamat').val();
                for (let index = 0; index <= panjang; index++) {
                    nomor.push($('#hp' + index).val());
                }
                console.log(nomor);
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/vendor/load/" + 1,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = vendor.toUpperCase() === data.nama_vendor
                                .toUpperCase();
                            if (cekEqual) {
                                same = 1;
                            }
                        })

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/vendors/in",
                                type: "POST",
                                dataType: "json",
                                // traditional: true,
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    jenis: jenis,
                                    vendor: vendor,
                                    alamat: alamat,
                                    kontak: kontak,
                                    nomor: nomor
                                },
                                success: function(res) {
                                    $('#insert').modal('hide');
                                    $("#frmVendorIn")[0].reset();
                                    $('#dt_vendor').DataTable().ajax.reload();
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                }
                            });
                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: vendor + " Sudah Terdaftar"
                            });
                        }
                    }
                });
            });
        }
    </script>

    {{-- Delete Vendor --}}
    <script>
        function deleteVendor(id) {
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
                                url: "{{ url('') }}/del/vendor/" + id,
                                success: function() {
                                    $('#dt_vendor').DataTable().ajax.reload();
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

    {{-- Detail Vendor --}}
    <script>
        function detail(id) {
            $("#jenisD").select2({
                dropdownParent: $("#detail")
            })

            $.ajax({
                url: "{{ url('') }}/vendor/get/" + id,
                success: function(res) {
                    // console.log(data);
                    document.getElementById('vendorD').value = res.nama_vendor;
                    document.getElementById('alamatD').value = res.alamat_vendor;
                    document.getElementById('kontakD').value = res.contact_person;
                    var jenis = JSON.parse(res.jenis);
                    var hp = JSON.parse(res.no_hp);
                    $.ajax({
                        url: "{{ url('') }}/jenis/load/" + 1,
                        success: function(data) {
                            // console.log(data);
                            $("#jenisD").children().remove();
                            $("#jenisD").append(
                                '<option value="">Pilih Klasifikasi</option>');
                            $.each(data, function(index, x) {
                                // console.log(x.id_jenisIven);
                                $('#jenisD').append(
                                    '<option value="' + x.id_jenisIven + '">' + x
                                    .jenis_iventaris + '</option>'
                                )
                            })
                            for (let i = 0; i < jenis.length; i++) {
                                $("#jenisD").val(jenis).change();
                            }
                        }
                    });
                    // console.log(hp);
                    for (let i = 0; i < hp.length; i++) {
                        var nomor = "hpD" + i;
                        if (i == 0) {
                            document.getElementById(nomor).value = hp[i];
                        } else {
                            var phoneNumber = document.getElementById("detailP");
                            var div = document.createElement("div");

                            div.innerHTML = `<div class="form-group row">
                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="${nomor}" value="${hp[i]}" disabled>
                                </div>
                            </div>
                        </div>`;
                            phoneNumber.appendChild(div);
                        }
                    }
                }
            });
        }
        $(document).ready(function() {
            $('#detail').on('hidden.bs.modal', function(e) {
                document.getElementById("detailP").innerHTML = "";
            })
        });
    </script>

    {{-- Edit Vendor --}}
    <script>
        function edit(id) {
            $("#jenisE").select2({
                dropdownParent: $("#edit")
            })
            $.ajax({
                url: "{{ url('') }}/vendor/get/" + id,
                success: function(res) {
                    // console.log(data);
                    document.getElementById('vendorE').value = res.nama_vendor;
                    document.getElementById('cekVendor').value = res.nama_vendor;
                    document.getElementById('alamatE').value = res.alamat_vendor;
                    document.getElementById('kontakE').value = res.contact_person;
                    var jenis = JSON.parse(res.jenis);
                    var hp = JSON.parse(res.no_hp);
                    document.getElementById('countE').value = 0;
                    $.ajax({
                        url: "{{ url('') }}/jenis/load/" + 1,
                        success: function(data) {
                            // console.log(data);
                            $("#jenisE").children().remove();
                            $.each(data, function(index, x) {
                                // console.log(x.id_jenisIven);
                                $('#jenisE').append(
                                    '<option value="' + x.id_jenisIven + '">' + x
                                    .jenis_iventaris + '</option>'
                                )
                            })
                            // for (let i = 0; i < jenis.length; i++) {
                            //     $("#jenisE").val(jenis).change();
                            // }
                            $("#jenisE").val(jenis).change();
                        }
                    });
                    // console.log(hp);
                    for (let i = 0; i < hp.length; i++) {
                        var nomor = "hpE" + i;
                        if (i == 0) {
                            document.getElementById(nomor).value = hp[i];
                        } else {
                            var countEdit = document.getElementById("countE").value;
                            countEdit++;
                            var phoneNumber = document.getElementById("editP");
                            var div = document.createElement("div");

                            div.innerHTML = `<div class="form-group row" id="editTes${countEdit}">
                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="hpE${countEdit}" value="${hp[i]}" placeholder="Nomor" required="" maxlength="12">
                                    <div class="invalid-feedback">
                                        Nomor Tidak Boleh kosong
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-danger" onclick="closeEdit()">-
                                    </button>
                                </div>
                            </div>
                        </div>`;
                            phoneNumber.appendChild(div);
                            document.getElementById("countE").value = countEdit;
                        }
                    }
                }
            });

            $('#editForm').on('submit', function(e) {
                e.preventDefault();

                const nomor = [];
                let vendor = $('#vendorE').val();
                let jenis = $('#jenisE').val();
                let kontak = $('#kontakE').val();
                let panjang = $('#countE').val();
                let alamat = $('#alamatE').val();
                let cek = $('#cekVendor').val();
                for (let index = 0; index <= panjang; index++) {
                    nomor.push($('#hpE' + index).val());
                }
                var areEqual = vendor.toUpperCase() === cek.toUpperCase();
                var same = 0;
                $.ajax({
                    url: "{{ url('') }}/vendor/cek/" + id,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = vendor.toUpperCase() === data.nama_vendor
                                .toUpperCase();
                            if (cekEqual) {
                                if (!areEqual) {
                                    same = 1;
                                }
                            }
                        })

                        if (same == 0) {
                            $.ajax({
                                url: "{{ url('') }}/vendors/up/" + id,
                                type: "POST",
                                dataType: "json",
                                // traditional: true,
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    jenis: jenis,
                                    vendor: vendor,
                                    alamat: alamat,
                                    kontak: kontak,
                                    nomor: nomor
                                },
                                success: function(res) {
                                    $('#edit').modal('hide');
                                    $("#editForm")[0].reset();
                                    $('#dt_vendor').DataTable().ajax.reload();
                                    swal({
                                        icon: "success",
                                        text: res['success']
                                    });
                                }
                            });

                        } else if (same == 1) {
                            swal({
                                icon: "warning",
                                text: vendor + " Sudah Terdaftar"
                            });
                        }
                    }
                });
            });
        }
        $(document).ready(function() {
            $('#edit').on('hidden.bs.modal', function(e) {
                document.getElementById("editP").innerHTML = "";
            })
        });
    </script>


    {{-- Auto Add Nomor HP Form Input --}}
    <script>
        function myFunction() {
            var count = document.getElementById("count").value;
            count++;
            var phoneNumber = document.getElementById("phoneInput");
            var div = document.createElement("div");

            div.innerHTML = `<div class="form-group row" class="tes" id="tes${count}">
                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nomorHp${count}" id="hp${count}" placeholder="Nomor" required="" maxlength="12">
                                    <div class="invalid-feedback">
                                        Nomor Tidak Boleh kosong
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-danger" onclick="close1()">-
                                    </button>
                                </div>
                            </div>
                        </div>`;
            phoneNumber.appendChild(div);
            document.getElementById("count").value = count;
        }

        function close1() {

            var countE = document.getElementById("count").value;
            var elem = document.getElementById(`tes${countE}`);
            elem.remove();
            countE--;
            document.getElementById("count").value = countE;

            // var count = document.getElementById("count").value;
            // count--;
            // document.getElementById("count").value = count;
            // var tes = document.getElementById("tes");
            // var div = document.createElement("div");
            // tes.parentNode.removeChild(tes);
        }
    </script>

    {{-- Auto Add Nomor HP Form Edit --}}
    <script>
        var countEdit = document.getElementById("countE").value;

        function myFunction1() {
            var countEdit = document.getElementById("countE").value;
            countEdit++;
            var phoneNumber = document.getElementById("editP");
            var div = document.createElement("div");

            div.innerHTML = `<div class="form-group row" id="editTes${countEdit}">
                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="hpE${countEdit}"placeholder="Nomor" required="" maxlength="12">
                                    <div class="invalid-feedback">
                                        Nomor Tidak Boleh kosong
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-danger" onclick="closeEdit()">-
                                    </button>
                                </div>
                            </div>
                        </div>`;
            phoneNumber.appendChild(div);
            document.getElementById("countE").value = countEdit;
        }

        function closeEdit() {
            var countE = document.getElementById("countE").value;
            var elem = document.getElementById(`editTes${countE}`);
            elem.remove();
            countE--;
            document.getElementById("countE").value = countE;
        }
    </script>
@endpush
