@extends('layouts\master')
@section('header-form')
    <h1>List Warehouse</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="\">Home</a></div>
        <div class="breadcrumb-item active">Warehouse</div>
    </div>
@endsection
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                {{-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ordersModal">
                    <i class="fas fa-plus"></i>
                    Tambah Order Baru
                </button> --}}
            </div>
        </div>
    </div>
    <hr />
    <table id="dt_barangIn" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;"
        aria-describedby="example_info">
        <thead>
            <tr>
                <th>Kode Iventori</th>
                <th>Tanggal Masuk Gudang</th>
                <th>Label Barang</th>
                <th>Detail Pembelian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($storage as $items)
                <tr>
                    <td>
                        {{ $items->kode_iventori }}
                    </td>
                    <td>
                        {{ $items->created_at }}
                    </td>
                    <td>
                        @if ($items->label == 1)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#BarangLabel"
                                onclick="set({{ $items->id }})"><i class="fas fa-tags"></i> Cek Label</button>
                        @else
                            <span class="badge badge-info"><i class="fas fa-tag"></i> Tanpa Label</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#detailOrders{{ $items->id_orders }}"
                            onclick="cek({{ $items->id_orders }})"><i class="far fa-eye"></i>
                            Details</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection

{{-- Modal Detail --}}
@foreach ($orders as $data)
    <div class="modal fade" id="detailOrders{{ $data->id_orders }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        {{-- <i class="fas fa-times"></i> --}}
                    </button>
                </div>
                <div class="card">

                    <div class="card-header card text-center">
                        <h4>Deatil Barang</h4>
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
                                    <div class="carousel-item">
                                        <img src="images/logo1.png" alt="New York">
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
                            <div class="card-header card text-center">
                                <h4>List Detail Orderan</h4>
                            </div>
                            <div class="form-group row" id="listA{{ $data->id_orders }}">

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
                                    <input type="text" class="form-control" readonly placeholder="Nama Pembeli Barang"
                                        value="{{ $data->id_pemesan }}">
                                </div>

                                {{-- Pembeli --}}
                                <div class="form-group">
                                    <label>Nama Pembeli</label>
                                    <input type="text" class="form-control" readonly placeholder="Nama Pembeli Barang"
                                        value="{{ $data->id_pembeli }}">
                                </div>

                                {{-- Validator --}}
                                <div class="form-group">
                                    <label>Nama Validator</label>
                                    <input type="text" class="form-control" readonly placeholder="Nama Pembeli Barang"
                                        value="{{ $data->id_validator }}">
                                </div>

                                {{-- Harga --}}
                                <div class="form-group">
                                    <label>Harga Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Nama Pembeli Barang"
                                        value="{{ $data->harga }}">
                                </div>
                            </div>

                            <div class="form-group row" id="listB{{ $data->id_orders }}">
                                {{-- Model --}}
                                <div class="form-group">
                                    <label>Model Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Nama Pembeli Barang"
                                        value="{{ $data->model }}">
                                </div>

                                {{-- Merk --}}
                                <div class="form-group">
                                    <label>Merk Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Nama Pembeli Barang"
                                        value="{{ $data->merk }}">
                                </div>

                                {{-- Warna --}}
                                <div class="form-group">
                                    <label>Warna Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Nama Pembeli Barang"
                                        value="{{ $data->warna }}">
                                </div>

                                {{-- Ukuran --}}
                                <div class="form-group">
                                    <label>Ukuran Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Nama Pembeli Barang"
                                        value="{{ $data->ukuran }}">
                                </div>

                                {{-- Jumlah --}}
                                <div class="form-group">
                                    <label>Jumlah Barang</label>
                                    <input type="text" class="form-control" readonly placeholder="Nama Pembeli Barang"
                                        value="{{ $data->jlh_barang }}">
                                </div>

                                {{-- Alasan --}}
                                <div class="form-group">
                                    <label>Alasan Pembelian</label>
                                    <input type="text" class="form-control" readonly placeholder="Nama Pembeli Barang"
                                        value="{{ $data->alasan_beli }}">
                                </div>
                            </div>
                        </div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item"><a class="page-link" href="#"
                                        id="pageA{{ $data->id_ordres }}"
                                        onclick="hideSeek({{ $data->id_orders }})">1</a></li>
                                <li class="page-item"><a class="page-link" href="#"
                                        id="pageB{{ $data->id_ordres }}"
                                        onclick="hideSeek1({{ $data->id_orders }})">2</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endforeach

{{-- Label Barang --}}
<div class="modal fade" id="BarangLabel" aria-labelledby="listLokasiModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollbar-y">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="container"></div>
            <div class="card-header card text-center">
                <h4 style="color:darksalmon">Label Barang</h4>
            </div>
            <div class="modal-body ">
                <div class="table-responsive">
                    <table id="dt_label" class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <td>Kode Barang</td>
                                <td>Perawatan</td>
                                <td>Perbaikan</td>
                                <td>Cetak Label</td>
                            </tr>
                        </thead>
                        <tbody id="isi">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Perbaikan Modal --}}
<div class="modal fade" id="perbaikan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-header card text-center">
                <h4 style="color:darksalmon">Histori Perbaikan</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Perawatan Modal --}}
<div class="modal fade" id="perawatan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-header card text-center">
                <h4 style="color:darksalmon">Histori Perawatan</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

    {{-- Modal Label --}}
    <script>
        $(document).ready(function() {
            $('#dt_barangIn').DataTable({
                "scrollX": true
            });
        });

        function set(id) {
            $(document).ready(function() {
                $.ajax({
                    url: "{{ url('') }}/label/" + id,
                    success: function(data) {
                        var html = '';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html += '<tr>' +
                                '<td>' + data[i].kode_label + '</td>' +
                                '<td>' +
                                `<button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#perawatan"><i class="fas fa-toolbox"></i> Detail </button>` +
                                '</td>' +
                                '<td>' +
                                `<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#perbaikan"><i class="fas fa-tools"></i> Detail </button>` +
                                '</td>' +
                                '<td>' +
                                `<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tes"><i class="fas fa-print"></i> Cetak </button>` +
                                '</td>' +
                                '</tr>';
                        }
                        $('#isi').html(html);
                    }
                })
            });
        }
    </script>

    {{-- Detail Modal Js --}}
    <script>
        function cek(id) {
            $('#detailOrders' + id).on('shown.bs.modal', function(e) {
                $("#listB" + id).hide();
            })
        }

        function hideSeek(id) {
            $("#listB" + id).hide();
            $("#listA" + id).show();
        }

        function hideSeek1(id) {
            $("#listA" + id).hide();
            $("#listB" + id).show();
        }
    </script>

    {{-- Select 2 --}}
    <script>
        function tes(id) {
            $("#lokasi" + id).select2({
                dropdownParent: $("#insertBarang" + id)
            })
            $("#kode" + id).select2({
                dropdownParent: $("#insertBarang" + id)
            })
        }
    </script>

@endpush
