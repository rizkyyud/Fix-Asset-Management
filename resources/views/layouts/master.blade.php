<!DOCTYPE html>
<html>

<head>
    <title>Fix Asset Management</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ asset('/login/images/icons/favicon.ico') }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.1/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css"
        integrity="sha512-yVvxUQV0QESBt1SyZbNJMAwyKvFTLMyXSyBHDO4BG5t7k/Lw34tyqlSDlKIrIENIzCl+RVUNjmCPG+V/GMesRw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css"> --}}

    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet" href="{{ asset('/assets/css/select2.min.css') }}"> --}}
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/jquery.timepicker.min.css') }}">


    {{-- Data Tables --}}
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">

    <style>
        /* Make the image fully responsive */
        .carousel-inner img {
            width: 100%;
            height: 100%;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .select2-container {
            z-index: 100000;
        }

        .select2-dropdown {
            z-index: 3051;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('layouts\header')
            @include('layouts\sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        @yield('header-form')
                    </div>
                    @yield('content')
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright || Stisla &copy; <?= date('Y') ?>
                </div>
                <div class="footer-right">
                    <div class="bullet"></div> Desain By Rizky Ramadhan
                </div>
            </footer>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    @stack('page-scripts')

    <script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="">
    <script src="{{ asset('/assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/assets/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jszip.min.js') }}"></script>

    <script src="{{ asset('/assets/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/assets/js/buttons.html5.min.js') }}"></script>
    {{-- <script src="{{ asset('/assets/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/assets/js/tableexport.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('/assets/js/tableToExcel.js') }}"></script> --}}
    {{-- <script src="{{ asset('/assets/js/jspdf.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jspdf.autotable.js') }}"></script> --}}
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sideAsset').hide();
            $('#sideIven').hide();
            var hakS = `<?php echo Session::get('hak'); ?>`;
            var hak = JSON.parse(hakS);
            for (let i = 0; i < hak.length; i++) {

                if (hak[i] == 'Asset') {
                    $('#sideAsset').show();
                } else if (hak[i] == 'Inventaris') {
                    $('#sideIven').show();
                } else if (hak[i] == 'Admin') {
                    $('#sideAsset').show();
                    $('#sideIven').show();
                    $('#sideBeli').show();
                    $('#sideGudang').show();
                    $('#sideSewa').show();
                    $('#sideVendor').show();
                    $('#sideValid').show();
                    $('#sideVerif').show();
                    $('#sidePembelian').show();
                    $('#sidePesan').show();
                } else if (hak[i] == 'Pembelian' || hak[i] == 'Verifikasi' || hak[i] == 'Validasi' || hak[i] ==
                    'Pemesanan') {
                    $('#sidePembelian').show();
                    $('#sideVendor').show();
                    // $('#sidePembelian').show();
                    $('#sidePesan').show();
                    $('#sideVendor').show();
                    if (hak[i] == 'Verifikasi') {
                        $('#sideVerif').show();
                    } else if (hak[i] == 'Validasi') {
                        $('#sideValid').show();
                    } else if (hak[i] == 'Pemesanan') {
                        $('#sideBeli').hide();
                    }
                } else if (hak[i] == 'Reservasi') {
                    $('#sideSewa').show();
                } else if (hak[i] == 'Gudang') {
                    $('#sideGudang').show();
                }
            }
        });
    </script>

    {{-- <script src="{{ asset('/assets/js/pdfmake.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('/assets/js/stisla.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    {{-- <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.1/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"
        integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- Template JS File -->
    <script src="{{ asset('/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('/assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('/assets/js/qrcodejs/qrcode.min.js') }}"></script>
    <script src="{{ asset('/assets/js/custom.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('/dist/datepair.min.js') }}"></script>
    <script src="{{ asset('/dist/jquery.datepair.min.js') }}"></script>


</body>

</html>
