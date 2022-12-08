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
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-swatchbook"></i>
                        <span>Setup Inventaris</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="jenisIven"><i class="far fa-list-alt"></i>
                                Jenis</a></li>
                        <li><a class="nav-link" href="barangIven"><i class="fas fa-couch"></i>Barang</a></li>
                        <li><a class="nav-link" href="vendors"><i class="fas fa-building"></i>Vendors</a></li>
                        <li><a class="nav-link" href="modelB"><i class="fab fa-accusoft"></i>Model</a></li>
                        <li><a class="nav-link" href="merk"><i class="fab fa-apple"></i>Merk</a></li>
                        <li><a class="nav-link" href="warna"><i class="fas fa-palette"></i>warna</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-menu active"><a class="nav-link" href="cart"><i class="fas fa-store"></i>
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
    <h1>Permintaan Barang</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
        <div class="breadcrumb-item">Pesanan</div>
    </div>
@endsection
@section('content')
    {{-- <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <form class="needs-validation was-validated" novalidate="" method="post"
                    action="cart/add/{{ Session::get('id') }}">
                    @csrf
                    <input type="hidden" name="namas" value="{{ Session::get('nama') }}">
                    <input type="hidden" name="divisi" value="{{ Session::get('divisi') }}">
                    <button type="submit" class="btn btn-success"
                        onclick="return confirm ('Apakah Anda Ingin Menambah Keranjang Pesanan');">
                        <i class="fas fa-plus"></i>
                        Buat Permintaan Pemesanan
                    </button>
                </form>
            </div>
        </div>
        <br>
    </div> --}}

    <div class="card card-primary" id="inputItem">
        <div class="card-header card text-center" id="headerList">
        </div>

        <div class="modal-body ">
            <table id="dt_items" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Model</th>
                        <th>Merk</th>
                        <th>Warna</th>
                        <th>Status</th>
                        <th>Dokumen</th>
                        <th>Detail</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header card text-center">
            <h4>List Keranjang Anda</h4>
            <div class="card-header-action">
                <a href="#" class="btn btn-success" onclick="addCart()">
                    <i class="fas fa-plus-circle"></i> Buat Keranjang
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="dt_cart" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Kode Pesanan</th>
                        <th>Isi Pesanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

{{-- List Barang --}}
{{-- <div class="modal fade" id="listB" aria-labelledby="listLokasiModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content" style="overflow-y: initial">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="container"></div>
            <div class="card">
                <div class="card-header card text-center" id="headerList">
                </div>

                <div class="modal-body ">
                    <table id="dt_items" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Model</th>
                                <th>Merk</th>
                                <th>Warna</th>
                                <th>Status</th>
                                <th>Detail</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div> --}}

{{-- Detail Order Modal --}}
<div class="modal fade" id="loadDetail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card" id="setDetail">
            </div>
        </div>
    </div>
</div>

@include('sweetalert::alert')
@include('Modal\keranjangModal')

@push('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    {{-- //////////////////////////////////////////////////////////////////////////////////// --}}

    <script>
        $(document).ready(function() {
            $('#items').hide();
            $('#dt_cart').DataTable({
                "scrollX": true
            });
            $('#dt_items').DataTable({
                "scrollX": true
            });
            $('#inputItem').hide();

        });
    </script>

    {{-- Tambah Keranjang --}}
    <script>
        function addCart() {
            var namas = `<?php echo Session::get('nama'); ?>`;
            var divisi = `<?php echo Session::get('divisi'); ?>`;
            var ids = `<?php echo Session::get('id'); ?>`;
            $.ajax({
                url: "{{ url('') }}/cart/add",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    nama: namas,
                    divisi: divisi,
                    id: ids
                },
                success: function(res) {
                    // console.log(res);
                    $('#dt_cart').DataTable().ajax.reload();
                    swal({
                        icon: "success",
                        text: res['success']
                    });
                }
            });
        }
    </script>

    {{-- Dropzone Input --}}
    {{-- <script type="text/javascript">
        var count = 0;
        Dropzone.autoDiscover = false;
        var uploadedDocumentMap = {}
        var myDropzone = new Dropzone("div#myDrop", {
            url: '{{ route('projects.storeMedia') }}',
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 5000,
            // autoProcessQueue: false,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                console.log(response);
                count++;
                var tes = "document" + count;
                $('form').append('<input type="hidden" name="' + tes + '" value="' + response.name + '">')
                document.getElementById("tes").value = count;
                uploadedDocumentMap[file.name] = response.name;

            },
            error: function(file, response) {
                return false;
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var tes = "document" + count;

                var name = file.name;
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="' + tes + '"][value="' + name + '"]').remove()
                $.ajax({
                    header: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    url: "assetsB/delfoto/" + name,
                    type: "get",
                    data: {
                        'file': name
                    },
                    dataTypes: 'json'
                });
                count--;
                document.getElementById("tes").value = count;
            },
            // 

        });
    </script> --}}

    {{-- CRUD Item JS --}}
    <script>
        function tambah(id) {
            var kate, model, merk, warna;

            $.ajax({
                url: "{{ url('') }}/barang/load/" + 1,
                success: function(res) {
                    $("#inBarang").children().remove();
                    $("#inBarang").append(
                        '<option selected value="">Pilih Barang</option>'
                    );
                    $.each(res, function(index, data) {
                        $('#inBarang').append(
                            '<option value="' + data.id + '">' +
                            data
                            .nama + '</option>'
                        )
                    })
                }
            });

            $('#inBarang').on('change', function() {
                var ids = $(this).val();
                if (ids != '' && ids != null) {
                    $.ajax({
                        url: "{{ url('') }}/barang/get/" + ids,
                        type: "GET",
                        async: true,
                        success: function(res) {
                            console.log(res);
                            model = res.id_model;
                            merk = res.id_merk;
                            warna = res.id_warna;
                            kate = res.id_barangIven;
                            $('#inUkuran').val(res.ukuran);

                            var vendorDef = "Vendor Kosong";
                            $("#inVendor").children().remove();
                            $("#inVendor").append(
                                '<option selected value="">Pilih Vendor</option>');
                            // $("#vendor").prop('disabled', true)
                            if (kate != '' && kate != null) {
                                // $("subLokasi").prop('disabled', false)
                                $.ajax({
                                    url: "{{ url('') }}/getVendor/" + kate,
                                    type: "GET",
                                    success: function(res) {
                                        $('#inVendor').append(
                                            '<option value="' + 0 + '">' +
                                            vendorDef + '</option>'
                                        )
                                        $.each(res, function(index, data) {
                                            $('#inVendor').append(
                                                '<option value="' +
                                                data.id_vendor +
                                                '">' + data
                                                .nama_vendor +
                                                '</option>'
                                            )
                                        })
                                    }
                                })
                            }

                            $.ajax({
                                url: "{{ url('') }}/kateBarang/load/" + 1,
                                success: function(res) {
                                    $("#inKate").children().remove();
                                    $("#inKate").append(
                                        '<option selected value="">Pilih Kategori Barang</option>'
                                    );
                                    $.each(res, function(index, data) {
                                        $('#inKate').append(
                                            '<option value="' + data
                                            .id_barangIven + '">' + data
                                            .nama_barang + '</option>'
                                        )
                                    })
                                    $('#inKate').val(kate);
                                }
                            });

                            $.ajax({
                                url: "{{ url('') }}/modelB/load/" + 1,
                                success: function(res) {
                                    $("#inModel").children().remove();
                                    $("#inModel").append(
                                        '<option selected value="">Pilih Model Barang</option>'
                                    );
                                    $.each(res, function(index, data) {
                                        $('#inModel').append(
                                            '<option value="' + data.id + '">' +
                                            data
                                            .model + '</option>'
                                        )
                                    })
                                    $('#inModel').val(model);
                                }
                            });

                            $.ajax({
                                url: "{{ url('') }}/merk/load/" + 1,
                                success: function(res) {
                                    $("#inMerk").children().remove();
                                    $("#inMerk").append(
                                        '<option selected value="">Pilih Merk Barang</option>'
                                    );
                                    $.each(res, function(index, data) {
                                        $('#inMerk').append(
                                            '<option value="' + data.id + '">' +
                                            data
                                            .merk + '</option>'
                                        )
                                    })
                                    $('#inMerk').val(merk);
                                }
                            });

                            $.ajax({
                                url: "{{ url('') }}/warna/load/" + 1,
                                success: function(res) {
                                    $("#inWarna").children().remove();
                                    $("#inWarna").append(
                                        '<option selected value="">Pilih Warna Barang</option>'
                                    );
                                    $.each(res, function(index, data) {
                                        $('#inWarna').append(
                                            '<option value="' + data.id + '">' +
                                            data
                                            .warna + '</option>'
                                        )
                                    })
                                    $('#inWarna').val(warna);
                                }
                            });
                        }
                    })
                }
            });

            $.ajax({
                url: "{{ url('') }}/assets/load/" + 1,
                type: "GET",
                success: function(res) {
                    $("#inAsset").children().remove();
                    $("#inAsset").append('<option selected value="">Pilih Lokasi Asset</option>');
                    $.each(res, function(index, data) {
                        $('#inAsset').append(
                            `<option value="${data.id_assets}"> ${data.nama_assets} Lokasi (${data.nama_lokasi}) Sub Lokasi (${data.nama_subL}) </option>`
                        )
                    })
                }
            })

            $('#inAsset').on('change', function() {
                var id = $(this).val();
                $("#inSub").children().remove();
                $("#inSub").append('<option selected value="">Pilih Lokasi Sub</option>');

                if (id != '' && id != null) {
                    $.ajax({
                        url: "{{ url('') }}/subAsset/load/" + id,
                        type: "GET",
                        success: function(res) {
                            $('#inSub').append(`<option value="0">Tanpa Sub</option>`)
                            $.each(res, function(index, data) {
                                $('#inSub').append(
                                    '<option value="' + data.id + '">' + data
                                    .nama_subAsset + '</option>'
                                )
                            })
                        }
                    })
                }
            });

            $("#inBarang").select2({
                dropdownParent: $("#order")
            })

            $("#inKate").select2({
                dropdownParent: $("#order")
            })

            $("#inVendor").select2({
                dropdownParent: $("#order")
            })

            $("#inModel").select2({
                dropdownParent: $("#order")
            })

            $("#inMerk").select2({
                dropdownParent: $("#order")
            })

            $("#inWarna").select2({
                dropdownParent: $("#order")
            })

            $("#inAsset").select2({
                dropdownParent: $("#order")
            })

            $("#inSub").select2({
                dropdownParent: $("#order")
            })

            $('#inputPesanan').on('submit', function(e) {
                e.preventDefault();
                let barang = $('#inBarang').val();
                let kate = $('#inKate').val();
                let vendor = $('#inVendor').val();
                let model = $('#inModel').val();
                let merk = $('#inMerk').val();
                let warna = $('#inWarna').val();
                let asset = $('#inAsset').val();
                let alasan = $('#inAlasan').val();
                let ukuran = $('#inUkuran').val();
                let harga = $('#inHarga').val();
                let jumlah = $('#inJumlah').val();
                let sub = $('#inSub').val();

                $.ajax({
                    url: "{{ url('') }}/cart/list/" + id,
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        barang: barang,
                        kategori: kate,
                        vendor: vendor,
                        model: model,
                        merk: merk,
                        warna: warna,
                        asset: asset,
                        alasan: alasan,
                        ukuran: ukuran,
                        harga: harga,
                        jumlah: jumlah,
                        sub: sub
                    },
                    success: function(res) {
                        $('#order').modal('hide');
                        $("#inputPesanan")[0].reset();
                        $('#dt_items').DataTable().ajax.reload();
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });
            });
        }

        function edit(id) {
            var barang, kate, vendor, harga, model, merk, warna, asset, sub;

            $.ajax({
                url: "cartLoad/detail/" + id,
                async: false,
                success: function(data) {
                    // console.log(data);
                    barang = data[0].id_barang;
                    kate = data[0].id_barangIven;
                    vendor = data[0].id_vendor;
                    model = data[0].model;
                    merk = data[0].merk;
                    warna = data[0].warna;
                    asset = data[0].id_tempat;
                    sub = data[0].id_subTem;

                    var html;
                    html = ` <h4>Form Edit Barang</h4>
                            <h4>(${data[0].kode_order })</h4>`;
                    $('#editHead').html(html);

                    document.getElementById('edHarga').value = data[0].harga;
                    document.getElementById('edUkuran').value = data[0].ukuran;
                    document.getElementById('edJumlah').value = data[0].jlh_barang;
                    document.getElementById('edAlasan').value = data[0].alasan_beli;
                }
            })

            $.ajax({
                url: "{{ url('') }}/barang/load/" + 1,
                success: function(res) {
                    $("#edBarang").children().remove();
                    $("#edBarang").append(
                        '<option selected value="">Pilih Barang</option>'
                    );
                    $.each(res, function(index, data) {
                        $('#edBarang').append(
                            '<option value="' + data.id + '">' +
                            data
                            .nama + '</option>'
                        )
                    })
                    $("#edBarang").val(barang).change();
                }
            });

            $('#edBarang').on('change', function() {
                var ids = $(this).val();
                if (ids != '' && ids != null) {
                    $.ajax({
                        url: "{{ url('') }}/barang/get/" + ids,
                        type: "GET",
                        async: true,
                        success: function(res) {
                            model = res.id_model;
                            merk = res.id_merk;
                            warna = res.id_warna;
                            kate = res.id_barangIven;
                            $('#inUkuran').val(res.ukuran);

                            var vendorDef = "Vendor Kosong";
                            $("#edVendor").children().remove();
                            $("#edVendor").append(
                                '<option selected value="">Pilih Vendor</option>');
                            // $("#vendor").prop('disabled', true)
                            if (kate != '' && kate != null) {
                                // $("subLokasi").prop('disabled', false)
                                $.ajax({
                                    url: "{{ url('') }}/getVendor/" + kate,
                                    type: "GET",
                                    success: function(res) {
                                        $('#inVendor').append(
                                            '<option value="' + 0 + '">' +
                                            vendorDef + '</option>'
                                        )
                                        $.each(res, function(index, data) {
                                            $('#inVendor').append(
                                                '<option value="' +
                                                data.id_vendor +
                                                '">' + data
                                                .nama_vendor +
                                                '</option>'
                                            )
                                        })
                                        $("#edVendor").val(vendor).change();
                                    }
                                })
                            }

                            $.ajax({
                                url: "{{ url('') }}/kateBarang/load/" + 1,
                                success: function(res) {
                                    $("#edKate").children().remove();
                                    $("#edKate").append(
                                        '<option selected value="">Pilih Kategori Barang</option>'
                                    );
                                    $.each(res, function(index, data) {
                                        $('#edKate').append(
                                            '<option value="' + data
                                            .id_barangIven + '">' + data
                                            .nama_barang + '</option>'
                                        )
                                    })
                                    $('#edKate').val(kate).change();
                                }
                            });

                            $.ajax({
                                url: "{{ url('') }}/modelB/load/" + 1,
                                success: function(res) {
                                    $("#edModel").children().remove();
                                    $("#edModel").append(
                                        '<option selected value="">Pilih Model Barang</option>'
                                    );
                                    $.each(res, function(index, data) {
                                        $('#edModel').append(
                                            '<option value="' + data.id + '">' +
                                            data
                                            .model + '</option>'
                                        )
                                    })
                                    $('#edModel').val(model).change();
                                }
                            });

                            $.ajax({
                                url: "{{ url('') }}/merk/load/" + 1,
                                success: function(res) {
                                    $("#edMerk").children().remove();
                                    $("#edMerk").append(
                                        '<option selected value="">Pilih Merk Barang</option>'
                                    );
                                    $.each(res, function(index, data) {
                                        $('#edMerk').append(
                                            '<option value="' + data.id + '">' +
                                            data
                                            .merk + '</option>'
                                        )
                                    })
                                    $('#edMerk').val(merk).change();
                                }
                            });

                            $.ajax({
                                url: "{{ url('') }}/warna/load/" + 1,
                                success: function(res) {
                                    $("#edWarna").children().remove();
                                    $("#edWarna").append(
                                        '<option selected value="">Pilih Warna Barang</option>'
                                    );
                                    $.each(res, function(index, data) {
                                        $('#edWarna').append(
                                            '<option value="' + data.id + '">' +
                                            data
                                            .warna + '</option>'
                                        )
                                    })
                                    $('#edWarna').val(warna).change();
                                }
                            });
                        }
                    })
                }
            });

            $.ajax({
                url: "{{ url('') }}/assets/load/" + id,
                type: "GET",
                success: function(res) {
                    $("#edAsset").children().remove();
                    $("#edAsset").append(
                        '<option selected value="">Pilih Lokasi Asset</option>'
                    );
                    $.each(res, function(index, data) {
                        $('#edAsset').append(
                            `<option value="${data.id_assets}"> ${data.nama_assets} Lokasi (${data.nama_lokasi}) Sub Lokasi (${data.nama_subL}) </option>`
                        )
                    })
                    $("#edAsset").val(asset).change();
                }
            })

            $('#edAsset').on('change', function() {
                var ids = $(this).val();
                $("#edSub").children().remove();
                $("#edSub").append('<option selected value="">Pilih Sub</option>');

                if (ids != '' && ids != null) {
                    $.ajax({
                        url: "{{ url('') }}/subAsset/load/" + ids,
                        type: "GET",
                        success: function(res) {
                            $('#edSub').append(`<option value="0">Tanpa Sub</option>`)
                            $.each(res, function(index, data) {
                                $('#edSub').append(
                                    '<option value="' + data.id + '">' + data
                                    .nama_subAsset + '</option>'
                                )
                            })
                            $("#edSub").val(sub).change();
                        }
                    })
                }
            });

            $.ajax({
                url: "{{ url('') }}/modelB/load/" + 1,
                type: "GET",
                success: function(res) {
                    $('#modelEs').append(
                        `<option value="-"> Model Kosong</option>`
                    )
                    $.each(res, function(index, data) {
                        $('#modelEs').append(
                            '<option value="' + data.model + '">' + data
                            .model + '</option>'
                        )
                    })
                    $("#modelEs").val(model).change();
                }
            })

            $.ajax({
                url: "{{ url('') }}/merk/load/" + 1,
                type: "GET",
                success: function(res) {
                    $('#merkEs').append(
                        `<option value="-"> Merk Kosong</option>`
                    )
                    $.each(res, function(index, data) {
                        $('#merkEs').append(
                            '<option value="' + data.merk + '">' + data
                            .merk + '</option>'
                        )
                    })
                    $("#merkEs").val(merk).change();
                }
            })

            $.ajax({
                url: "{{ url('') }}/warna/load/" + 1,
                type: "GET",
                success: function(res) {
                    $('#warnaEs').append(
                        `<option value="-"> Warna Kosong</option>`
                    )
                    $.each(res, function(index, data) {
                        $('#warnaEs').append(
                            '<option value="' + data.warna + '">' + data
                            .warna + '</option>'
                        )
                    })
                    $("#warnaEs").val(warna).change();
                }
            })

            $('#barangEs').on('change', function() {
                var ids = $(this).val();
                $("vendorEs").prop('disabled', true)
                if (ids != '' && ids != null) {
                    $("subLokasi").prop('disabled', false)
                    $.ajax({
                        url: "{{ url('') }}/getVendor/" + ids,
                        success: function(res) {
                            $("#vendorEs").children().remove();
                            $("#vendorEs").append(
                                '<option selected value="">Pilih Sub Lokasi</option>');
                            $.each(res, function(index, data) {
                                $('#vendorEs').append(
                                    '<option value="' + data.id_vendor + '">' + data
                                    .nama_vendor + '</option>'
                                )
                            })
                            $("#vendorEs").val(vendor).change();
                        }
                    })
                }
            });

            $("#edBarang").select2({
                dropdownParent: $("#editModal")
            })
            $("#edVendor").select2({
                dropdownParent: $("#editModal")
            })
            $("#edModel").select2({
                dropdownParent: $("#editModal")
            })
            $("#edMerk").select2({
                dropdownParent: $("#editModal")
            })
            $("#edWarna").select2({
                dropdownParent: $("#editModal")
            })
            $("#edAsset").select2({
                dropdownParent: $("#editModal")
            })
            $("#edSub").select2({
                dropdownParent: $("#editModal")
            })

            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                let barang = $('#edBarang').val();
                let kategori = $('#edKate').val();
                let vendor = $('#edVendor').val();
                let model = $('#edModel').val();
                let merk = $('#edMerk').val();
                let warna = $('#edWarna').val();
                let asset = $('#edAsset').val();
                let alasan = $('#edAlasan').val();
                let ukuran = $('#edUkuran').val();
                let harga = $('#edHarga').val();
                let jumlah = $('#edJumlah').val();
                let sub = $('#edSub').val();

                $.ajax({
                    url: "{{ url('') }}/orders/up/" + id,
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        barang: barang,
                        vendor: vendor,
                        model: model,
                        merk: merk,
                        warna: warna,
                        asset: asset,
                        alasan: alasan,
                        ukuran: ukuran,
                        harga: harga,
                        jumlah: jumlah,
                        sub: sub
                    },
                    success: function(res) {
                        $('#editModal').modal('hide');
                        $("#editForm")[0].reset();
                        $('#dt_items').DataTable().ajax.reload();
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });
            });
        }
    </script>

    {{--  --}}

    {{-- List Barang --}}
    <script>
        function items(id) {
            // var a = "1";
            $('#inputItem').show();
            $('html, body').animate({
                scrollTop: $("#inputItem").offset().top
            }, 500);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "cart/listB/" + id,
                success: function(data) {
                    var html;
                    // var x = data.status;
                    html = `<h4 style="color:#677fe8">Isi Keranjang</h4>
                        <h4>(${data.kode_cart})</h4>
                        <br>`;
                    if (data.status == 'List') {
                        html += `<span type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#order"
                                onclick="tambah(${data.id_cart})">
                                <i class="fas fa-plus"></i>
                                Tambah Items
                            </span>`;
                    } else {
                        html += `<span class="badge badge-dark"> <i class="fas fa-lock"></i></span>`;
                    }
                    $('#headerList').html(html);
                }
            })

            $('#dt_items').DataTable().clear();
            $('#dt_items').DataTable().destroy();
            $("#dt_items").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/cart/item/" + id,
                    "dataSrc": ""
                },
                "columnDefs": [{
                    "targets": [5, 6, 7],
                    "sortable": false,
                    "className": "dt-center",
                }],
                "columns": [{
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
                        "data": "warna"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "id_orders",
                        "render": function(data, type, row) {
                            var html = `<button class="btn btn-dark" data-bs-toggle="modal"
                                        data-bs-target="#dokumenOrd" onclick="dokOrder(${data})"><i class="fas fa-folder"></i>
                                        </button>`;
                            return html
                        }
                    },
                    {
                        "data": "id_orders",
                        "render": function(data, type, row) {
                            var html =
                                `<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detailOrd" onclick="loadD(${data})">
                                        <i class="fas fa-eye"></i></button>`;
                            return html
                        }
                    },
                    {
                        "data": "id_orders",
                        "render": function(data, type, row, meta) {
                            var html = "";
                            var status = row['status'];
                            var ket = row['keterangan'];
                            if (status == "Request" || status == "Revisi" || status ==
                                "Check") {
                                var html =
                                    `<span class="badge badge-info">Menunggu Disetujui</span>`
                            } else if (status == "List") {
                                var html =
                                    `<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" onclick="edit(${data})">
                                        <i class="fas fa-edit"></i></button> | ` +
                                    `<a class="btn btn-danger" href="orders/del/${data}" onclick="return confirm ('Yakin');"><i class="fas fa-trash-alt"></i></a>`
                            } else if (status == "Waiting") {
                                var html =
                                    `<span class="badge badge-info">Menunggu Cek Ama</span>`
                            } else if (status == "Approve") {
                                var html =
                                    `<span class="badge badge-success">Disetujui</span>`
                            } else if (status == "Reject") {
                                var html =
                                    `<span class="badge badge-danger">Tidak Disetujui</span>  | ` +
                                    `<button class="btn btn-danger" onclick="notePop()"><i class="fas fa-sticky-note"></i></button>` +
                                    `<input type="hidden" value="${ket}" id="note"></input>`
                            } else if (status == "Purchased") {
                                var html =
                                    `<span class="badge badge-success">Sudah Dibeli</span>`
                            }
                            return html
                        }
                    },
                ],
            })
        }
    </script>

    {{-- Dokumentasi Pesanan --}}
    <script>
        function dokOrder(id) {
            var status = '';
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

            if (status == "List") {
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
                $('#dropZone').show();
            } else {
                $('#dropZone').hide();
            }

        }

        $(document).ready(function() {
            $('#dokumenOrd').on('hidden.bs.modal', function(e) {
                if (Dropzone.instances.length > 0) Dropzone.instances.forEach(dz => dz.destroy());
            })
        });
    </script>

    {{-- Script Note --}}
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
    </script>

    {{-- Load Cart Js --}}
    <script>
        $(document).ready(function() {
            // $('#items').show();
            var ids = `<?php echo Session::get('id'); ?>`;
            $('#dt_cart').DataTable().clear();
            $('#dt_cart').DataTable().destroy();
            $("#dt_cart").DataTable({
                "scrollX": true,
                "ajax": {
                    "url": "{{ url('') }}/cart/load/" + 1,
                    "dataSrc": "",
                    "data": {
                        "_token": "{{ csrf_token() }}",
                        "ids": ids
                    }
                },
                "columns": [{
                        "data": "kode_cart"
                    },
                    {
                        "data": "id_cart",
                        "render": function(data, type, row) { // Tampilkan kolom aksi
                            var html =
                                `<a type="button" class="btn btn-success" href="#inputItem" onclick="items(${data})">
                                    <i class="fas fa-shopping-basket"></i> Tambah
                                    </a>`;
                            return html;
                        }
                    },
                    {
                        "data": "id_cart",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = "";
                            //
                            var status = row['status'];
                            if (status == 'List') {
                                html +=
                                    `<a class="btn btn-primary" href="cart/reqAma/${data}"
                                            onclick="return confirm ('Request Barang?');"><i class="fas fa-paper-plane"></i>
                                            Pesan</a>
                                        <a class="btn btn-danger" href="/cart/del/${data}"
                                            onclick="return confirm ('Hapus Keranjang?');"><i class="fas fa-trash-alt"></i>
                                            Del</a>`;
                            } else if (status == 'Waiting') {
                                html +=
                                    `<span class="badge badge-info">Menunggu Pengecekan Ama</span>`;
                            } else if (status == 'Request' || status == 'Revisi') {
                                html +=
                                    `<span class="badge badge-warning">Menunggu Revisi</span>`;
                            } else if (status == 'Validate') {
                                html +=
                                    `<span class="badge badge-success">Sudah Divalidasi</span> |
                                    <span class="badge badge-success">Menunggu Pembelian</span>`;
                            } else if (status == 'Purchased') {
                                html +=
                                    `<span class="badge badge-success">Sudah Dibeli</span>`;
                            }
                            return html;
                        }
                    },
                ],

            })
        });
    </script>

    {{-- Detail Pesanan --}}
    <script>
        function loadD(id) {
            document.getElementById('pemesanD').value = `<?php echo Session::get('nama'); ?>`;
            var ceking, pengecek;
            $.ajax({
                url: "cartLoad/detail/" + id,
                async: false,
                success: function(data) {
                    // console.log(data);
                    var html;
                    document.getElementById('namaD').value = data[0].nama_barang;
                    // document.getElementById('vendorD').value = data[0].nama_vendor;
                    html = `<h4>(${data[0].kode_order})</h4>`;
                    $('#detailKode').html(html);

                    document.getElementById('hargaD').value = data[0].harga;
                    document.getElementById('ukuranD').value = data[0].ukuran;
                    document.getElementById('jlhD').value = data[0].jlh_barang;
                    document.getElementById('alasanD').value = data[0].alasan_beli;
                    document.getElementById('modelD').value = data[0].model;
                    document.getElementById('merkD').value = data[0].merk;
                    document.getElementById('warnaD').value = data[0].warna;
                    document.getElementById('modelD').value = data[0].model;
                    var vendor = data[0].id_vendor;
                    if (vendor == 0) {
                        document.getElementById('vendorD').value = "Vendor Kosong";
                    } else {
                        $.ajax({
                            url: "{{ url('') }}/vendor/get/" + vendor,
                            success: function(res) {
                                document.getElementById('vendorD').value = res
                                    .nama_vendor;
                            }
                        })
                    }

                }
            })

        }
    </script>

    {{-- Confirm Delete Dok Pesanan --}}
    <script>
        function deleteDok(id) {
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
                                url: "{{ url('') }}/delDok/ord/" + id,
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
        }
    </script>
@endpush
