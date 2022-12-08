@extends('layouts\master')
@section('header-form')
    <h1>Setup Harga Sewa</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="dashboard">Home</a></div>
        <div class="breadcrumb-item">Harga Sewa</div>
    </div>
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header card text-center">
            <h4> </h4>
            <div class="card-header-action">
                <div class="btn-group">
                    <a href="#" class="btn btn-primary" onclick="loadHarga()">Penambahan Harga</a>
                    {{-- <a href="#" class="btn btn-primary" onclick="loadSession()">Penambahan Season</a> --}}
                    <a href="#" class="btn btn-primary" onclick="loadTanggal()">Penambahan Seasson</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content tab-bordered" id="listHarga">
                <div class="tab-pane fade show active">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4 style="color: #023e8a">Penambahan Harga Sewa</h4>
                            <div class="card-header-action">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#sewaGdg1" onclick="add(1)">
                                    <i class="fas fa-plus-circle"></i>
                                    Tambah
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_harga" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nama Asset</th>
                                        <th>Jenis Season</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content tab-bordered" id="listTanggal" style="display: none">
                <div class="tab-pane fade show active">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4 style="color: #023e8a">Penambahan Seasson</h4>
                            <div class="card-header-action">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#seassonModal" id="BTN_ADD_SEASSON">
                                    <i class="fas fa-plus-circle"></i>
                                    Tambah
                                </button>
                                <button type="button" class="btn btn-success" onclick="savePdf()">
                                    <i class="fas fa-file-pdf"></i>
                                    Save PDF
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_seasson" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nama Season</th>
                                        <th>Tanggak Mulai</th>
                                        <th>Tanggak Selesai</th>
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
@include('Modal\sewaModal')
@push('page-scripts')
    {{-- Time Formating --}}
    <script>
        function formatingTime(data) {
            var html = '';
            var date = new Date(data);
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            html = [day, month, year].join('/');
            return html;
        }
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

    {{-- Unbind Click --}}
    <script>
        $(document).ready(function() {
            $('#sewaGdg1').on('hidden.bs.modal', function(e) {
                // label = [];
                $("#formGdg").unbind().click(function() {
                    //Stuff
                });
            });

            $('#subAsset').on('hidden.bs.modal', function(e) {
                // label = [];
                $("#frmSubAsset").unbind().click(function() {
                    //Stuff
                });
            });

            $('#assetsEdit').on('hidden.bs.modal', function(e) {
                // label = [];
                $("#frmEdit").unbind().click(function() {
                    //Stuff
                });
            });
        });
    </script>

    {{-- ------------------------- Javascript Load Data ------------------------- --}}
    {{-- Load Tambah Harga Sewa Gedung --}}
    <script>
        $(document).ready(function() {
            $('#dt_harga').DataTable().clear();
            $('#dt_harga').DataTable().destroy();
            $("#dt_harga").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": "_all",
                    "className": "dt-center",
                }],
                "ajax": {
                    "url": "{{ url('') }}/hargaG/load/" + 1,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "nama_assets"
                    },
                    {
                        "data": "season",
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
                            var html = `
                                        <button class="btn btn-danger" onclick="deleteHarga(${data})"><i class="fas fa-trash-alt"></i>
                                            Del</a>`;
                            //
                            // <button class="btn btn-primary" data-bs-toggle="modal"
                            // data-bs-target="#editSeasonM" onclick="editHarga(${data})"><i class="fas fa-edit"></i>
                            //                 Edit</button>
                            return html;
                        }
                    },
                ],

            })
        });

        function loadHarga() {
            $('#listSession').hide();
            $('#listHarga').show();
            $('#listTanggal').hide();
        }
    </script>

    {{-- Load Seasson --}}
    <script>
        function loadTanggal() {
            $('#listHarga').hide();
            $('#listTanggal').show();

            $('#dt_seasson').DataTable().clear();
            $('#dt_seasson').DataTable().destroy();
            $("#dt_seasson").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": [1],
                    "className": "dt-center",
                }],
                "pageLength": 50,                
                "ajax": {
                    "url": "{{ url('') }}/seasson/load/" + 1,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "session"
                    },
                    {
                        "data": "tanggal_awal",
                        "render": function(data, type, row, meta) {
                            var hsl = "";
                            data = formatingTime(data);
                            if (data == '31/12/1899' || data == null) {
                                hsl = "-";
                            } else {
                                hsl = data;
                            }

                            return hsl;
                        }
                    },
                    {
                        "data": "tanggal_akhir",
                        "render": function(data, type, row, meta) {
                            var hsl = "";
                            data = formatingTime(data);
                            if (data == '31/12/1899' || data == null) {
                                hsl = "-";
                            } else {
                                hsl = data;
                            }

                            return hsl;
                        }
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-primary" onclick="editSeason(${data})" data-bs-toggle="modal"
                                        data-bs-target="#seassonModal">
                                            <i class="fas fa-edit"></i>Edit</button>
                                        <button class="btn btn-danger" onclick="deleteSeason(${data})"><i class="fas fa-trash-alt"></i>
                                            Del</a>`;
                            //
                            return html;
                        }
                    },
                ],

            })
        }
    </script>

    {{-- ------------------------- Javascript Input Data ------------------------- --}}
    {{-- Tambah Sewa Villa Js --}}
    <script>
        function add(id) {

            $('#assetsB').select2({
                dropdownParent: $("#sewaGdg" + id)
            })
            $('#subAsset').select2({
                dropdownParent: $("#sewaGdg" + id)
            })
            $('#plhSession').select2({
                dropdownParent: $("#sewaGdg" + id)
            })
            $('#rangeSession').select2({
                dropdownParent: $("#sewaGdg" + id)
            })

            // Assets Dropdown
            $.ajax({
                url: "{{ url('') }}/getVilla/" + 1,
                success: function(res) {
                    $("#assetsB").children().remove();
                    $("#assetsB").append('<option selected value="">Pilih Villa</option>');
                    $.each(res, function(index, data) {
                        $('#assetsB').append(
                            '<option value="' + data.id_assets + '">' + data
                            .nama_assets + '</option>'
                        )
                    })

                }
            });

            // Sub Asset Drop Down
            $('#assetsB').on('change', function() {
                var id = $(this).val();
                $("#subAsset").children().remove();
                if (id != '' && id != null) {
                    $.ajax({
                        url: "{{ url('') }}/subAsset/load/" + id,
                        type: "GET",
                        success: function(res) {
                            $("#subAsset").children().remove();
                            $('#subAsset').append(`<option Selected value="0">Tanpa Sub</option>`)
                            $.each(res, function(index, data) {
                                $('#subAsset').append(
                                    '<option value="' + data.id + '">' + data
                                    .nama_subAsset + '</option>'
                                )
                            })
                        }
                    })
                }
            });

            $.ajax({
                url: "{{ url('') }}/seasson/load/" + 1,
                success: function(res) {
                    $("#plhSession").children().remove();
                    $("#plhSession").append(
                        '<option selected value="" disabled>Pilih Jenis Season</option>');
                    $.each(res, function(index, x) {
                        $('#plhSession').append(
                            '<option value="' + x.id + '" name="' + x.session + '">' + x
                            .session + '</option>'
                        )
                    })
                }
            });

            $('#plhSession').on('change', function() {
                var id = $(this).val();
                var cekS = $(this).find('option:selected').attr("name");
                console.log(cekS);
                if (id != '' && id != null) {
                    $.ajax({
                        url: "{{ url('') }}/session/range/" + id,
                        success: function(res) {
                            let cekSeason = cekS.toUpperCase();

                            if (cekSeason == 'WEEKDAY' || cekSeason == 'WEEKEND') {
                                $('#tanggalSewa').val('-');
                            } else {
                                var tanggal_awal = formatTime(res[0].tanggal_awal);
                                var tanggal_akhir = formatTime(res[0].tanggal_akhir);
                                $("#tanggalSewa").attr("name", res[0].id);
                                $('#tanggalSewa').val(`(${tanggal_awal}) Sampai (${tanggal_akhir})`);
                            }
                        }
                    })
                }
            });

            $('#subCek').on('click', function() {
                if ($(this).is(":checked")) {
                    $('#subList').show();
                } else {
                    $('#subList').hide();
                }
            });

            var rupiah = document.getElementById('hargaVila');
            rupiah.addEventListener('keyup', function(e) {
                rupiah.value = formatRupiah(this.value);
            });

            $('#formHargaVila').on('submit', function(e) {
                e.preventDefault();

                let vila = $('#assetsB').val();
                let session = $('#plhSession').val();
                let harga = $('#hargaVila').val();
                let tanggal = $('#tanggalSewa').attr("name");
                harga = convertToAngka(harga);

                $.ajax({
                    url: "{{ url('') }}/harga/gedung",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        session: session,
                        vila: vila,
                        harga: harga,
                        tanggal: tanggal
                    },
                    success: function(res) {
                        // console.log(res);
                        $('#sewaGdg1').modal('hide');
                        $("#formHargaVila")[0].reset();
                        $('#dt_harga').DataTable().ajax.reload();
                        $("#formHargaVila").unbind().click(function() {});
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });
            });

            function formatTime(tanggal) {
                var date = new Date(tanggal);
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                var hsl = [day, month, year].join('/');
                return hsl;
            }
        }
    </script>

    {{-- Tambah Session Js --}}
    <script>
        $("#BTN_ADD_SEASSON").click(function(e) {
            e.preventDefault();
            $("#FRM_ADD_SEASSON").unbind().click(function() {});

            $("#cekList").click(function() {

                if ($(this).is(':checked')) {
                    $('#range').show();
                } else {
                    $('#range').hide();
                }
            });

            $('#FRM_ADD_SEASSON').on('submit', function(e) {
                e.preventDefault();
                $("#FRM_ADD_SEASSON").unbind().click(function() {});

                let awal = $('#awal').val();
                let akhir = $('#akhir').val();
                let seasson = $('#keterangan').val();
                let cek = 1;

                if ($("#cekList").is(':checked')) {
                    cek = 0;
                }

                $.ajax({
                    url: "{{ url('') }}/seasson/Add",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        seasson: seasson,
                        awal: awal,
                        akhir: akhir,
                        cek: cek
                    },
                    success: function(res) {
                        // console.log(res);
                        $('#seassonModal').modal('hide');
                        $("#FRM_ADD_SEASSON")[0].reset();
                        $('#dt_seasson').DataTable().ajax.reload();
                        $("#FRM_ADD_SEASSON").unbind().click(function() {});
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });

            });
        });
    </script>

    {{-- Tambah Tanggal Sewa --}}
    <script>
        function tglSession() {
            $("#jenisSession").select2({
                dropdownParent: $("#tanggalSession")
            })

            // Drop Down Pemilihan Season
            $.ajax({
                url: "{{ url('') }}/session/load/" + 1,
                success: function(res) {
                    $("#jenisSession").children().remove();
                    $("#jenisSession").append(
                        '<option selected value="" disabled>Pilih Jenis Season</option>');
                    $.each(res, function(index, x) {
                        $('#jenisSession').append(
                            '<option value="' + x.id + '">' + x
                            .session + '</option>'
                        )
                    })
                }
            });

            // Input Tanggal Session Kedalam Database
            $('#frmAddTanggal').on('submit', function(e) {
                e.preventDefault();

            });
        }
    </script>

    {{-- ------------------------- Javascript Edit Data ------------------------- --}}
    {{-- Edit Session --}}
    <script>
        function editSeason(id) {

            $.ajax({
                url: "{{ url('') }}/session/get/" + id,
                success: function(res) {
                    $('#keterangan').val(res.session);
                    $('#awal').val(res.tanggal_awal);
                    $('#akhir').val(res.tanggal_akhir);
                }
            });

            $("#FRM_ADD_SEASSON").unbind().click(function() {});

            $("#cekList").click(function() {

                if ($(this).is(':checked')) {
                    $('#range').show();
                } else {
                    $('#range').hide();
                }
            });

            $('#FRM_ADD_SEASSON').on('submit', function(e) {
                e.preventDefault();
                $("#FRM_ADD_SEASSON").unbind().click(function() {});

                let awal = $('#awal').val();
                let akhir = $('#akhir').val();
                let seasson = $('#keterangan').val();
                let cek = 1;

                if ($("#cekList").is(':checked')) {
                    cek = 0;
                }

                $.ajax({
                    url: "{{ url('') }}/seasson/edit/" + id,
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        seasson: seasson,
                        awal: awal,
                        akhir: akhir,
                        cek: cek
                    },
                    success: function(res) {
                        // console.log(res);
                        $('#seassonModal').modal('hide');
                        $("#FRM_ADD_SEASSON")[0].reset();
                        $('#dt_seasson').DataTable().ajax.reload();
                        $("#FRM_ADD_SEASSON").unbind().click(function() {});
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });
            });
        }
    </script>

    {{-- Edit Tanggal --}}
    <script>
        function editTanggal(id) {

            $("#EDIT_JENIS_SESSON").select2({
                dropdownParent: $("#tanggalEdit")
            })

            $.ajax({
                url: "{{ url('') }}/tanggal/get/" + id,
                success: function(res) {
                    $('#awalEdit').val(res.tanggal_awal);
                    $('#akhirEdit').val(res.tanggal_akhir);
                    var season = res.id_session;
                    // Drop Down Pemilihan Season
                    $.ajax({
                        url: "{{ url('') }}/session/load/" + 1,
                        success: function(res1) {
                            $("#EDIT_JENIS_SESSON").children().remove();
                            $("#EDIT_JENIS_SESSON").append(
                                '<option selected value="" disabled>Pilih Jenis Season</option>'
                            );
                            $.each(res1, function(index, x) {
                                $('#EDIT_JENIS_SESSON').append(
                                    '<option value="' + x.id + '">' + x
                                    .session + '</option>'
                                )
                            })
                            $('#EDIT_JENIS_SESSON').val(season).change();
                        }
                    });

                }
            });

            $('#FRM_EDIT_SEASON').on('submit', function(e) {
                e.preventDefault();

                let awal = $('#awal').val();
                let akhir = $('#akhir').val();
                let session = $('#jenisSession').val();

                $.ajax({
                    url: "{{ url('') }}/tanggal/cek/" + id,
                    async: false,
                    success: function(res) {
                        $.each(res, function(index, data) {
                            var cekEqual = session.toUpperCase() === data.id_session
                                .toUpperCase();
                            if (cekEqual) {
                                same = 1;
                            }
                        })
                    }
                });

                if (same == 0) {
                    $.ajax({
                        url: "{{ url('') }}/tanggal/edit" + id,
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            season: session,
                            awal: awal,
                            akhir: akhir
                        },
                        success: function(res) {
                            // console.log(res);
                            $('#tanggalSession').modal('hide');
                            $("#frmAddTanggal")[0].reset();
                            $('#dt_tanggal').DataTable().ajax.reload();
                            $("#FRM_EDIT_SEASON").unbind().click(function() {});
                            swal({
                                icon: "success",
                                text: res['success']
                            });
                        }
                    });
                } else if (same == 1) {
                    swal({
                        icon: "warning",
                        text: "Data Sudah Terdaftar"
                    });
                }
            });

        }
    </script>

    {{-- ------------------------- Javascript Delete Data ------------------------- --}}
    {{-- Confirm Delete Harga --}}
    <script>
        function deleteHarga(id) {
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
                            url: "{{ url('') }}/sewa/del/" + id,
                            success: function() {
                                $('#dt_harga').DataTable().ajax.reload();
                                swal("Berhasil Dihapus!", {
                                    icon: "success",
                                });
                            }
                        });
                    } else {
                        swal("Your file is safe!");
                    }
                });
        }
    </script>

    {{-- Confirm Delete Season --}}
    <script>
        function deleteSeason(id) {
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
                            url: "{{ url('') }}/session/del/" + id,
                            success: function() {
                                $('#dt_seasson').DataTable().ajax.reload();
                                swal("Berhasil Dihapus!", {
                                    icon: "success",
                                });
                            }
                        });
                    } else {
                        swal("Your file is safe!");
                    }
                });
        }
    </script>

    {{-- Confirm Delete Tanggal --}}
    <script>
        function deleteTanggal(id) {
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
                            url: "{{ url('') }}/tanggal/del/" + id,
                            success: function() {
                                $('#dt_tanggal').DataTable().ajax.reload();
                                swal("Berhasil Dihapus!", {
                                    icon: "success",
                                });
                            }
                        });
                    } else {
                        swal("Your file is safe!");
                    }
                });
        }
    </script>

    {{-- Save PDF --}}
    <script>
        function savePdf() {

            // var elt = document.getElementById('dt_report');
            // var wb = XLSX.utils.table_to_book(elt, {
            //     sheet: "sheet1"
            // });
            // return XLSX.writeFile(wb, (`Report Reservasi ${tglAwal} - ${tglAkhir}.` + 'xlsx'));

            var date = new Date();
            var dateStr =
                ("00" + (date.getMonth() + 1)).slice(-2) + "/" +
                ("00" + date.getDate()).slice(-2) + "/" +
                date.getFullYear() + " " +
                ("00" + date.getHours()).slice(-2) + ":" +
                ("00" + date.getMinutes()).slice(-2) + ":" +
                ("00" + date.getSeconds()).slice(-2);

            var doc = new jsPDF('l', 'pt', 'letter');
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
            margins = {
                top: 150,
                bottom: 40,
                left: 20,
                right: 20,
                width: 600
            };
            var y = 20;
            doc.setLineWidth(2);
            doc.text(250, y = y + 20, `Laporan Daftar Season Villa`);
            doc.text(40, y = y + 45, `Last Update ${dateStr}`);
            // var columns = [res.columns[0], res.columns[1]];
            doc.autoTable({
                html: '#dt_seasson',
                startY: 120,
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
            doc.save(`Report Daftar Seasson Villa.pdf`);

        }
    </script>
@endpush

{{-- Form Gudang Js --}}
{{-- <script>
        $('#formGdg').on('submit', function(e) {
            e.preventDefault();

            let assetB = $('#assetsB').val();
            let harga = $('#hargaG').val();
            // console.log(assetB);

            $.ajax({
                url: "{{ url('') }}/harga/gedung",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    assetB: assetB,
                    harga: harga,
                },
                success: function(res) {
                    // console.log(res);
                    $('#sewaGdg1').modal('hide');
                    $("#formGdg")[0].reset();
                    $('#dt_gedung').DataTable().ajax.reload();
                    swal({
                        icon: "success",
                        text: res['success']
                    });
                }
            });
        });
    </script> --}}
