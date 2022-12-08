@extends('layouts\master')
@section('header-form')
    <h1>Jenis Inventaris</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="\">Home</a></div>
        <div class="breadcrumb-item">Jenis Iventaris</div>
    </div>
@endsection
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#jenisIvenModal">
                    <i class="fas fa-plus"></i>
                    Tambah Jenis Barang
                </button>
            </div>
        </div>
    </div>
    <hr />
    <table id="dt_jenisIven" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;"
        aria-describedby="example_info">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Iventaris</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $id = 0; ?>
            @foreach ($jenisIven as $items)
                <tr>
                    <td>
                        <?php
                        $id += 1;
                        echo $id; ?>
                    </td>
                    <td>
                        {{ $items->jenis_iventaris }}
                    </td>
                    <td>
                        <a href="jenisIven/{{ $items->id_jenisIven }}" data-bs-toggle="modal"
                            data-bs-target="#editJenisIven{{ $items->id_jenisIven }}"><i class="fas fa-edit"
                                style="color :blue"></i></a>
                        <a href="/jenisIven/del/{{ $items->id_jenisIven }}" onclick="return confirm ('yakin');"><i
                                class="fas fa-trash-alt" style="color: crimson"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
@include('Modal\jenisIvenModal')

@push('page-scripts')
    <script>
        $(document).ready(function() {
            $('#dt_jenisIven').DataTable({
                "columnDefs": [{
                    "targets": [0, 2],
                    "sortable": false
                }],
                "scrollX": true
            });
        });
    </script>
@endpush
