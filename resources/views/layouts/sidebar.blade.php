<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="dashboard">Fix Asset Management</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <i class="fas fa-project-diagram"></i>
            <a href="dashboard">FAMA</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a>------</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item">
                <a href="dashboard" class="nav-link"><i class="fas fa-home"></i><span>Home</span></a>
            </li>
            {{-- <li class="sidebar-menu"><a class="nav-link" href="cart"><i class="fas fa-store"></i>
                    <span>Pesan Barang</span></a></li> --}}
            {{-- <li class="sidebar-menu"><a class="nav-link" href="sewa"><i class="fas fa-landmark"></i>
                    <span>Sewa Fasilitas</span></a></li> --}}
            <div class="sidebar-brand sidebar-brand-sm">
                <a>------</a>
            </div>
            <div id="sideAsset" style="display: none;">
                <li class="menu-header">Assets</li>
                <li class="nav-item dropdown" id="setIven">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-hand-holding-usd"></i>
                        <span>Setup Asset</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="lokasi"><i class="fas fa-map-marked-alt"></i>Tempat</a></li>
                        <li><a class="nav-link" href="kategori"><i class="fas fa-landmark"></i>
                                Kategori</a></li>
                        <li><a class="nav-link" href="pemilik"><i class="fas fa-user-tie"></i>Pemilik</a></li>
                        <li><a class="nav-link" href="transport"><i class="fas fa-bus"></i>Transport</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown" id="setInputAsset">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-database"></i>
                        <span>Input Asset</span></a>
                    <ul class="dropdown-menu">
                        <li class="sidebar-menu"><a class="nav-link" href="assetsB"><i class="fas fa-building"></i>
                                <span>Bangunan</span></a></li>
                        <li class="sidebar-menu"><a class="nav-link" href="assetsT"><i class="fas fa-car"></i>
                                <span>Transportasi</span></a></li>
                    </ul>
                </li>

                <div class="sidebar-brand sidebar-brand-sm">
                    <a>------</a>
                </div>
            </div>

            <div id="sideIven" style="display: none;">
                <li class="menu-header">Inventaris</li>
                <li class="nav-item dropdown" id="setIven">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-swatchbook"></i>
                        <span>Setup Inventaris</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="klassBarang"><i class="fas fa-boxes"></i>
                                Klasifikasi</a></li>
                        <li><a class="nav-link" href="modelB"><i class="fab fa-accusoft"></i>Spesifikasi</a></li>
                    </ul>
                </li>
                <li class="sidebar-menu"><a class="nav-link" href="klasB"><i class="fas fa-laptop-code"></i>
                        <span>Barang Inventaris</span></a></li>




                <div class="sidebar-brand sidebar-brand-sm">
                    <a>------</a>
                </div>
            </div>

            <div id="sidePembelian" style="display: none">
                <li class="menu-header">Pembelian Dan Pemesanan</li>
                <li class="sidebar-menu"><a class="nav-link" href="tesWeb" id="sidePesan" style="display: none;"><i
                            class="fas fa-store-alt"></i>
                        <span>Pemesanan Barang</span></a></li>
                <li class="sidebar-menu"><a class="nav-link" href="listPesanan" id="sideVerif" style="display: none;"><i
                            class="fas fa-clipboard-list"></i>
                        <span>Verifikasi Pesanan</span></a></li>
                <div id="sideValid" style="display: none;">
                    <li class="sidebar-menu"><a class="nav-link" href="validOrder"><i class="fas fa-thumbs-up"></i>
                            <span>Validasi Pesanan</span></a></li>
                    <li class="sidebar-menu"><a class="nav-link" href="allOrd"><i class="fas fa-box-open"></i>
                            <span>All Orders</span></a></li>
                </div>

                <li class="sidebar-menu"><a class="nav-link" href="vendors" id="sideVendor" style="display: none"><i
                            class="fas fa-building"></i><span>Vendors</span></a></li>
                <li class="sidebar-menu" id="sideBeli" style="display: none"><a class="nav-link"
                        href="pembelian"><i class="fas fa-shopping-bag"></i><span>Pembelian Barang</span></a>
                </li>
            </div>

            <div id="sideGudang" style="display: none">
                <li class="menu-header">Warehouse</li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-swatchbook"></i>
                        <span>In / Out</span></a>
                    <ul class="dropdown-menu">
                        <li class="sidebar-menu"><a class="nav-link" href="barangIn"><i
                                    class="fas fa-sign-in-alt"></i>
                                <span>In</span></a></li>
                        {{-- <li class="sidebar-menu"><a class="nav-link" href="barangOut"><i
                                    class="fas fa-sign-out-alt"></i>
                                <span>Out</span></a></li>
                        <li class="sidebar-menu"><a class="nav-link" href="validOrder"><i
                                    class="fas fa-receipt"></i></i>
                                <span>Out</span></a></li> --}}
                    </ul>
                </li>
                <li class="sidebar-menu"><a class="nav-link" href="label"><i class="fas fa-warehouse"></i>
                        <span>Gudang</span></a></li>
            </div>

            <div id="sideSewa" style="display: none">
                <li class="menu-header">Penyewaan Villa</li>
                <li class="sidebar-menu"><a class="nav-link" href="reservasi"><i class="fas fa-receipt"></i>
                        <span>Reservasi</span></a></li>
                <li class="sidebar-menu"><a class="nav-link" href="reportReserv"><i class="fas fa-receipt"></i>
                        <span>Laporan Reservasi</span></a></li>
                <li class="nav-item dropdown" id="setIven">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-hand-holding-usd"></i>
                        <span>Setup Penyewaan</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="harga_sewa"><i class="fas fa-money-bill-wave"></i>Harga
                                Sewa</a>
                        </li>
                        <li><a class="nav-link" href="via"><i class="fas fa-receipt"></i>Via</a>
                        </li>
                    </ul>
                </li>
            </div>

            <div>
                <li class="menu-header">Penyewaan Transport</li>
                <li class="sidebar-menu"><a class="nav-link"><i class="fas fa-receipt"></i>
                        <span>Setup Tarif</span></a></li>
            </div>

            {{-- <li class="sidebar-menu"><a class="nav-link" href="label"><i class="fas fa-tags"></i>
                    <span>Label Barang</span></a></li> --}}
        </ul>
    </aside>
</div>

{{-- <script>
    function setKls() {
        document.getElementById("sideWarna").className = "nav-link active";
        document.getElementById("setIven").className = "nav-item dropdown active";
    }
</script> --}}
