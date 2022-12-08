@extends('layouts\master')
@section('header-form')
    <h1>List Semua Pesanan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
        <div class="breadcrumb-item">List Semua Pesanan</div>
    </div>
@endsection

@section('content')
    <div class="card card-primary" id="isiCart">
        <div class="card-header card text-center">
            <h4>List Semua Pesanan</h4>           
        </div>
        <div class="card-body ">
            <table id="dt_orderL" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;"
                aria-describedby="example_info">
                <thead>
                    <tr>
                        <th>Detail</th>
                        <th>Tanggal Pesan</th>
                        <th>Status</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection


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
            $('#dt_orderL').DataTable().clear();
            $('#dt_orderL').DataTable().destroy();
            var table = $("#dt_orderL").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": '_all',
                    "sortable": false,
                    "className": "dt-center",
                }],
                "order": [
                    [1, 'desc']
                ],
                "ajax": {
                    "url": "{{ url('') }}/pesanan/allList/1",
                    "dataSrc": "",
                },
                "columns": [{
                        "className": 'dt-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
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
                        "data": "status"
                    }
                ],
            });

            // $('#dt_orderL tbody').off('click', 'td.details-control');
            $("#dt_orderL tbody").unbind().click(function() {});
            $('#dt_orderL tbody').on('click', 'td.dt-control', function(e) {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var parentRow = $(this).closest("tr").prev()[0];
                var rowData = table.row(parentRow).data();
                var idr = row.data().id;
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

        function format(d, id) {
            // var id = d.id;
            // `d` is the original data object for the row
            let html = `<table class="table table-bordered table-md align-middle">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Dokumen</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Last Update</th>
                                </tr>
                            </thead>
                            <tbody>
                        `;
            $.ajax({
                url: "{{ url('') }}/pesanan/cartItem/" + id,
                type: "GET",
                async: false,
                success: function(res) {
                    $.each(res, function(index, data) {
                        var date = new Date(data.updated_at);
                        var day = date.getDate();
                        var month = date.getMonth() + 1;
                        var year = date.getFullYear();
                        var update = [day, month, year].join('/');
                        html += `<tr>
                                    <td>
                                        <a> ${data.nama} </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#dokumenOrd" onclick="dokOrder(${data})"><i class="fas fa-folder"></i>
                                        </button>
                                    </td>
                                    <td>${data.jumlah}</td>
                                    <td><div class="badge badge-success">Active</div></td>
                                    <th>${update}</th>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target="#detailOrd" onclick="detailOrd('${data.id}','${data.kode}')" class="btn btn-primary">Detail</a></td>
                                </tr>`;
                    })
                    html += `</tbody>`;
                }
            })
            html += `</table>`;
            return html;
        }
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
