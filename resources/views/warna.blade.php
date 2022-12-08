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
                        <li><a class="nav-link" href="vendors"><i class="fas fa-building"></i>Vendors</a></li>
                        <li><a class="nav-link" href="modelB"><i class="fab fa-accusoft"></i>Model</a></li>
                        <li><a class="nav-link" href="merk"><i class="fab fa-apple"></i>Merk</a></li>
                        <li class="active"><a class="nav-link" href="warna"><i
                                    class="fas fa-palette"></i>warna</a>
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
    <h1>Warna</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="\">Home</a></div>
        <div class="breadcrumb-item">Warna</div>
    </div>
@endsection
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#warnaModal">
                    <i class="fas fa-plus"></i>
                    Tambah Warna Baru
                </button>
            </div>
        </div>
    </div>
    <hr />
    <table id="dt_warna" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;"
        aria-describedby="example_info">
        <thead>
            <tr>
                <th>Warna</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $id = 0; ?>
            @foreach ($warna as $items)
                <tr>
                    <td>
                        {{ $items->warna }}
                    </td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#editWarna{{ $items->id }}"><i class="fas fa-edit"></i></button>
                        <a class="btn btn-danger" href="/warna/del/{{ $items->id }}"
                            onclick="return confirm ('yakin');"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

@endsection
{{-- Tambah Kategori --}}
<div class="modal fade" id="warnaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    {{-- <i class="fas fa-times"></i> --}}
                </button>
            </div>
            <div class="card">
                <form class="needs-validation was-validated" novalidate="" action="warna" method="post">
                    @csrf
                    <div class="card-header card text-center">
                        <h4>Form Input Warna</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Warna</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama" placeholder="Warna" required=""
                                    value="{{ old('nama') }}">
                                <div class="invalid-feedback">
                                    Warna Tidak Boleh kosong
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success">Simpan</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Tutup Modal Edit Lokasi --}}

{{-- Edit Lokasi Modal --}}
@foreach ($warna as $data)
    <div class="modal fade" id="editWarna{{ $data->id }}" tabindex="-1" aria-labelledby="editKategoriLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        {{-- <i class="fas fa-times"></i> --}}
                    </button>
                </div>
                <div class="card">
                    <form class="needs-validation was-validated" novalidate=""
                        action="{{ url('/warna/up/' . $data->id) }}" method="post">
                        @csrf
                        <div class="card-header card text-center">
                            <h4>Form Input Kategori</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Warna</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="warna" placeholder="Warna"
                                        required="" value="{{ $data->warna }}">
                                    <div class="invalid-feedback">
                                        Warna Tidak Boleh kosongan
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-success">Ubah</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@include('sweetalert::alert')


@push('page-scripts')

    <script>
        $(document).ready(function() {
            $('#dt_warna').DataTable({
                "scrollX": true
            });

        });
    </script>
@endpush
