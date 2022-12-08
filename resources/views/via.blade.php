@extends('layouts\master')
@section('header-form')
    <h1>Setup Via</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="dashboard">Home</a></div>
        <div class="breadcrumb-item">Via</div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2" role="tab"
                        aria-controls="home" aria-selected="true" onclick="loadAgen()">Via Agen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab"
                        aria-controls="profile" aria-selected="false" onclick="loadPaymen()">Via Payment</a>
                </li>
            </ul>
            <div class="tab-content tab-bordered" id="myTab3Content">
                <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab2">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4 style="color: #023e8a">Via Agen</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-primary" onclick="addVia()" data-bs-toggle="modal"
                                    data-bs-target="#addVia">
                                    <i class="fas fa-plus-circle"></i> Add
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_via" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile2-tab2">
                    <div class="card">
                        <div class="card-header card text-center">
                            <h4 style="color: #023e8a">Via Paymen</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-primary" onclick="addViaP()" data-bs-toggle="modal"
                                    data-bs-target="#addViaP">
                                    <i class="fas fa-plus-circle"></i> Add
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dt_viaP" class="display nowrap dataTable dtr-inline collapsed"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Keterangan</th>
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
@include('Modal\viaModal')
@push('page-scripts')
    {{-- ----------------------------------------------- Via Agen -------------------------------------- --}}

    {{-- Load List Via --}}
    <script>
        $(document).ready(function() {
            $('#dt_via').DataTable().clear();
            $('#dt_via').DataTable().destroy();
            $("#dt_via").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": [0],
                    "sortable": false
                }],
                "ajax": {
                    "url": "{{ url('') }}/via/getAll/" + 1,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "keterangan"
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addVia" onclick="editVia(${data})"><i class="fas fa-edit"></i>
                                            Edit</button>
                                        <button class="btn btn-danger" onclick="deleteVia(${data})"><i class="fas fa-trash-alt"></i>
                                            Del</a>`;
                            //
                            return html;
                        }
                    },
                ],

            })
        });
    </script>

    <script>
        function loadAgen() {
            $('#dt_via').DataTable().ajax.reload();
        }
    </script>

    {{-- Input Via --}}
    <script>
        function addVia() {
            $('headViaAgen').html("Input Via Agen");
            $('#FRM_VIA_VILLA').on('submit', function(e) {
                e.preventDefault();
                $("#FRM_VIA_VILLA").unbind().click(function() {});
                let Keterangan = $('#viaKet').val();

                $.ajax({
                    url: "{{ url('') }}/via/in",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        Keterangan: Keterangan,
                    },
                    success: function(res) {

                        $('#addVia').modal('hide');
                        $('#dt_via').DataTable().ajax.reload();
                        $("#FRM_VIA_VILLA")[0].reset();
                        $("#FRM_VIA_VILLA").unbind().click(function() {});
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });
            });
        }
    </script>

    {{-- Delete Via --}}
    <script>
        function deleteVia(id) {
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
                            url: "{{ url('') }}/via/del/" + id,
                            success: function() {
                                $('#dt_via').DataTable().ajax.reload();
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

    {{-- Edit Via --}}
    <script>
        function editVia(id) {
            $.ajax({
                url: "{{ url('') }}/via/getId/" + id,
                type: "GET",
                success: function(res) {
                    $('#viaKet').val(res[0].keterangan);
                    $('#headViaAgen').html('Edit Via Agen');
                }
            });

            $('#FRM_VIA_VILLA').on('submit', function(e) {
                e.preventDefault();
                $("#FRM_VIA_VILLA").unbind().click(function() {});
                let ket = $('#viaKet').val();
                // alert(ket);

                $.ajax({
                    url: "{{ url('') }}/via/edit",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        ket: ket,
                    },
                    success: function(res) {

                        $('#addPenyewa').modal('hide');
                        $('#dt_via').DataTable().ajax.reload();
                        $("#FRM_VIA_VILLA")[0].reset();
                        $("#FRM_VIA_VILLA").unbind().click(function() {});
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });
            });
        }
    </script>

    {{-- ----------------------------------------------- Via Payment -------------------------------------- --}}

    {{-- Load List Via Pay --}}
    <script>
        function loadPaymen() {
            $('#dt_viaP').DataTable().clear();
            $('#dt_viaP').DataTable().destroy();
            $("#dt_viaP").DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "targets": [0],
                    "sortable": false
                }],
                "ajax": {
                    "url": "{{ url('') }}/viaP/getAll/" + 1,
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "keterangan"
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) { // Tampilkan kolom aksi
                            var html = `<button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addViaP" onclick="editViaP(${data})"><i class="fas fa-edit"></i>
                                            Edit</button>
                                        <button class="btn btn-danger" onclick="deleteViaP(${data})"><i class="fas fa-trash-alt"></i>
                                            Del</a>`;
                            //
                            return html;
                        }
                    },
                ],

            })
        }
    </script>

    {{-- Input Via Pay --}}
    <script>
        function addViaP() {
            $('headViaPay').html("Input Via Payment");
            $('#FRM_VIA_PAY').on('submit', function(e) {
                e.preventDefault();
                $("#FRM_VIA_PAY").unbind().click(function() {});
                let Keterangan = $('#viaKetP').val();

                $.ajax({
                    url: "{{ url('') }}/viaP/in",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        Keterangan: Keterangan,
                    },
                    success: function(res) {

                        $('#addViaP').modal('hide');
                        $('#dt_viaP').DataTable().ajax.reload();
                        $("#FRM_VIA_PAY")[0].reset();
                        $("#FRM_VIA_PAY").unbind().click(function() {});
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });
            });
        }
    </script>

    {{-- Delete Via Pay --}}
    <script>
        function deleteViaP(id) {
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
                            url: "{{ url('') }}/viaP/del/" + id,
                            success: function() {
                                $('#dt_viaP').DataTable().ajax.reload();
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

    {{-- Edit Via Pay --}}
    <script>
        function editViaP(id) {
            $.ajax({
                url: "{{ url('') }}/viaP/getId/" + id,
                type: "GET",
                success: function(res) {
                    $('#viaKetP').val(res[0].keterangan);
                    $('#headViaPay').html('Edit Via Agen');
                }
            });

            $('#FRM_VIA_PAY').on('submit', function(e) {
                e.preventDefault();
                $("#FRM_VIA_PAY").unbind().click(function() {});
                let ket = $('#viaKetP').val();

                $.ajax({
                    url: "{{ url('') }}/viaP/edit",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        ket: ket,
                    },
                    success: function(res) {

                        $('#addViaP').modal('hide');
                        $('#dt_viaP').DataTable().ajax.reload();
                        $("#FRM_VIA_PAY")[0].reset();
                        $("#FRM_VIA_PAY").unbind().click(function() {});
                        swal({
                            icon: "success",
                            text: res['success']
                        });
                    }
                });
            });
        }
    </script>
@endpush
