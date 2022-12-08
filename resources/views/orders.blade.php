@extends('layouts\master')
@section('header-form')
    <h1>List Orderan Anda</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
        <div class="breadcrumb-item">Orders</div>
    </div>

@endsection
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ordersModal"
                    onclick="tambah()">
                    <i class="fas fa-plus"></i>
                    Tambah Order Baru
                </button>
            </div>
        </div>
    </div>
    <hr />
    <div class="card card-primary">
        <table id="dt_vendors" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;"
            aria-describedby="example_info">
            <thead>
                <tr>
                    <th>Kode Order</th>
                    <th>Detail Order</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $id = 0; ?>
                @foreach ($orders as $items)
                    <tr>
                        <td>
                            {{ $items->kode_order }}
                        </td>
                        <td>
                            <button class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#detailOrders{{ $items->id_orders }}"
                                onclick="cek({{ $items->id_orders }})"><i class="far fa-eye"></i>
                                Details</button>
                        </td>
                        <td>
                            <?php $status = ['Request', 'Progress', 'Approved', 'Purchased', 'Rejected', 'Revision', 'Stored'];
                            $badge = ['badge badge-info', 'badge badge-info', 'badge badge-primary', 'badge badge-success', 'badge badge-danger', 'badge badge-warning', 'badge badge-dark']; ?>
                            @for ($i = 0; $i < count($status); $i++)
                                @if ($items->status == $status[$i])
                                    <span class="{{ $badge[$i] }}">{{ $status[$i] }}</span>
                                @endif
                            @endfor
                        </td>
                        <td>
                            @if ($items->status == 'Request' || $items->status == 'Rejected')
                                <button class="btn btn-primary" href="orders/{{ $items->id_orders }}"
                                    data-bs-toggle="modal" data-bs-target="#editorders{{ $items->id_orders }}"
                                    onclick="edit({{ $items->id_orders }})"><i class="fas fa-edit"></i></button>
                                <a href="/orders/del/{{ $items->id_orders }}" onclick="return confirm ('yakin');"
                                    class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            @elseif ($items->status == 'Purchased')
                                <span class="badge badge-success">Barang Telah Dibeli</span>
                            @elseif ($items->status == 'Stored')
                                <span class="badge badge-dark"><i class="fas fa-archive"></i> Barang Digudang</span>
                            @elseif($items->status == 'Progress')
                                <span class="badge badge-danger"><i class="fas fa-lock"></i> Menunggu Approvel</span>
                            @elseif($items->status == 'Revision')
                                <span class="badge badge-danger"><i class="fas fa-lock"></i> Menunggu Revisi</span>
                            @else
                                <span class="badge badge-danger"><i class="fas fa-lock"></i> Menunggu Pembelian</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

{{-- Tambah Order Modal --}}
<div class="modal fade" id="ordersModal" aria-labelledby="ordersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="overflow-y: auto;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form class="needs-validation was-validated" novalidate="" action="orders" method="post"
                enctype="multipart/form-data">
                <div class="card">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Form Input Orders</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Barang</label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="barang" id="barangIn">
                                    <option selected value="">Pilih Barang</option>
                                    @foreach ($barang as $items)
                                        <option value="{{ $items->id_barangIven }}">{{ $items->nama_barang }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Pilih Barang
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Vendor</label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="vendor" id="vendorIn">
                                    <option value="" disabled selected hidden>Pilih Vendor</option>
                                    <option value="0">Kosongkan Vendor</option>
                                    @foreach ($vendors as $items)
                                        <option value="{{ $items->id_vendor }}">{{ $items->nama_vendor }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Pilih Vendor
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Model</label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="model" id="modelIn">
                                    <option value="" disabled selected hidden>Pilih Model</option>
                                    <option value="0">Kosongkan Model</option>
                                    @foreach ($model as $items)
                                        <option value="{{ $items->model }}">{{ $items->model }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Pilih Model
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Merk</label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="model" id="merkIn">
                                    <option value="" disabled selected hidden>Pilih Merk</option>
                                    <option value="0">Kosongkan Merk</option>
                                    @foreach ($merk as $items)
                                        <option value="{{ $items->merk }}">{{ $items->merk }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Pilih Merk
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Warna</label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    required="" name="model" id="warnaIn">
                                    <option value="" disabled selected hidden>Pilih Warna</option>
                                    <option value="0">Kosongkan Warna</option>
                                    @foreach ($warna as $items)
                                        <option value="{{ $items->merk }}">{{ $items->warna }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Pilih Warna
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Ukuran</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="ukuran" placeholder="Ukuran Barang"
                                    value="{{ old('ukuran') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jumlah</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="jumlah" placeholder="Jumlah Barang"
                                    required="" value="{{ old('jumlah') }}">
                            </div>
                            <div class="invalid-feedback">
                                Jumlah Tidak Boleh Kosong
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alasan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="alasan" placeholder="Alasan Pembelian"
                                    required="" value="{{ old('alasan') }}">
                            </div>
                            <div class="invalid-feedback">
                                Alasan Tidak Boleh Kosong
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="harga" placeholder="Harga Barang"
                                    value="{{ old('harga') }}">
                            </div>
                            <div class="invalid-feedback">
                                Harga Tidak Boleh Kosong
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Foto Barang</label>
                            <div class="col-sm-9">
                                <div class="dropzone dz-clickable" id="myDrop">
                                    <div class="dz-default dz-message" data-dz-message="">
                                        <span>Upload or Drag Photo Here</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="count" id="tes" />
                    </div>
                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Order Modal --}}
@foreach ($orders as $data)
    <div class="modal fade" id="editorders{{ $data->id_orders }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        {{-- <i class="fas fa-times"></i> --}}
                    </button>
                </div>
                <div class="card">
                    <form class="needs-validation was-validated" novalidate=""
                        action="{{ url('/orders/up/' . $data->id_orders) }}" method="post">
                        @csrf
                        <div class="card-header card text-center">
                            <h4>Form Edit Orderan</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Barang</label>
                                <div class="col-sm-9">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        required="" name="barang" id="barangE{{ $data->id_orders }}">
                                        <option selected disabled value="">Pilih Barang</option>
                                        @foreach ($barang as $items)
                                            <option value="{{ $items->id_barangIven }}"
                                                {{ $data->id_barangIven == $items->id_barangIven ? 'selected' : '' }}>
                                                {{ $items->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Vendor</label>
                                <div class="col-sm-9">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        name="vendor" id="vendorE{{ $data->id_orders }}">
                                        <option selected value="">Pilih Vendor</option>
                                        @foreach ($vendors as $items)
                                            <option value="{{ $items->id_vendor }}"
                                                {{ $data->id_vendor == $items->id_vendor ? 'selected' : '' }}>
                                                {{ $items->nama_vendor }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Model</label>
                                <div class="col-sm-9">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        name="model" id="modelE{{ $data->id_orders }}">
                                        <option selected disabled value="">Pilih merk</option>
                                        @foreach ($model as $items)
                                            <option value="{{ $items->id }}"
                                                {{ $data->model == $items->id ? 'selected' : '' }}>
                                                {{ $items->model }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Merk</label>
                                <div class="col-sm-9">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        name="merk" id="merkE{{ $data->id_orders }}">
                                        <option selected disabled value="">Pilih Merk</option>
                                        @foreach ($merk as $items)
                                            <option value="{{ $items->id }}"
                                                {{ $data->id == $items->id ? 'selected' : '' }}>
                                                {{ $items->merk }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Warna</label>
                                <div class="col-sm-9">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        name="warna" id="warnaE{{ $data->id_orders }}">
                                        <option selected disabled value="">Pilih Warna</option>
                                        @foreach ($warna as $items)
                                            <option value="{{ $items->id }}"
                                                {{ $data->id_warna == $items->id ? 'selected' : '' }}>
                                                {{ $items->warna }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ukuran</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ukuran" placeholder="Ukuran Barang"
                                        value="{{ $data->ukuran }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jumlah</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="jumlah"
                                        placeholder="Jumlah Barang" required="" value="{{ $data->jlh_barang }}">
                                </div>
                                <div class="invalid-feedback">
                                    Jumlah Tidak Boleh Kosong
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Alasan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="alasan"
                                        placeholder="Alasan Pembelian" required="" value="{{ $data->alasan_beli }}">
                                </div>
                                <div class="invalid-feedback">
                                    Alasan Tidak Boleh Kosong
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Harga</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="harga" placeholder="Harga Barang"
                                        value="{{ $data->harga }}">
                                </div>
                                <div class="invalid-feedback">
                                    Harga Tidak Boleh Kosong
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Foto Barang</label>
                                <div class="col-sm-9">
                                    <div class="dropzone dz-clickable" id="myDrop1">
                                        <div class="dz-default dz-message" data-dz-message="">
                                            <span>Upload or Drag Photo Here</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="count" id="tes" />
                        </div>
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-success">Ubah Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- Detail Order Modal --}}
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
                        <h4>Orderan</h4>
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
                                    <input type="text" class="form-control" readonly
                                        placeholder="Nama Pembeli Barang" value="{{ $data->id_pemesan }}">
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
                                    <input type="text" class="form-control" readonly
                                        placeholder="Nama Pembeli Barang" value="{{ $data->id_validator }}">
                                </div>

                                {{-- Harga --}}
                                <div class="form-group">
                                    <label>Harga Barang</label>
                                    <input type="text" class="form-control" readonly
                                        placeholder="Nama Pembeli Barang" value="{{ $data->harga }}">
                                </div>
                            </div>

                            <div class="form-group row" id="listB{{ $data->id_orders }}">
                                {{-- Model --}}
                                <div class="form-group">
                                    <label>Model Barang</label>
                                    <input type="text" class="form-control" readonly
                                        placeholder="Nama Pembeli Barang" value="{{ $data->model }}">
                                </div>

                                {{-- Merk --}}
                                <div class="form-group">
                                    <label>Merk Barang</label>
                                    <input type="text" class="form-control" readonly
                                        placeholder="Nama Pembeli Barang" value="{{ $data->merk }}">
                                </div>

                                {{-- Warna --}}
                                <div class="form-group">
                                    <label>Warna Barang</label>
                                    <input type="text" class="form-control" readonly
                                        placeholder="Nama Pembeli Barang" value="{{ $data->warna }}">
                                </div>

                                {{-- Ukuran --}}
                                <div class="form-group">
                                    <label>Ukuran Barang</label>
                                    <input type="text" class="form-control" readonly
                                        placeholder="Nama Pembeli Barang" value="{{ $data->ukuran }}">
                                </div>

                                {{-- Jumlah --}}
                                <div class="form-group">
                                    <label>Jumlah Barang</label>
                                    <input type="text" class="form-control" readonly
                                        placeholder="Nama Pembeli Barang" value="{{ $data->jlh_barang }}">
                                </div>

                                {{-- Alasan --}}
                                <div class="form-group">
                                    <label>Alasan Pembelian</label>
                                    <input type="text" class="form-control" readonly
                                        placeholder="Nama Pembeli Barang" value="{{ $data->alasan_beli }}">
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


@push('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script>
        $(document).ready(function() {
            $('#dt_vendors').DataTable({
                "columnDefs": [{
                    "targets": [0, 2],
                    "sortable": false
                }],
                "scrollX": true
            });
        });
    </script>

    {{-- Dropzone Input --}}
    <script type="text/javascript">
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
    </script>

    {{-- Dropzone Edit --}}


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
        function tambah() {
            $("#barangIn").select2({
                dropdownParent: $("#ordersModal")
            })
            $("#vendorIn").select2({
                dropdownParent: $("#ordersModal")
            })
            $("#modelIn").select2({
                dropdownParent: $("#ordersModal")
            })
            $("#merkIn").select2({
                dropdownParent: $("#ordersModal")
            })
            $("#warnaIn").select2({
                dropdownParent: $("#ordersModal")
            })
        }

        function edit(id) {
            $("#barangE" + id).select2({
                dropdownParent: $("#editorders" + id)
            })
            $("#vendorE" + id).select2({
                dropdownParent: $("#editorders" + id)
            })
            $("#modelE" + id).select2({
                dropdownParent: $("#editorders" + id)
            })
            $("#merkE" + id).select2({
                dropdownParent: $("#editorders" + id)
            })
            $("#warnaE" + id).select2({
                dropdownParent: $("#editorders" + id)
            })
        }
    </script>

@endpush
