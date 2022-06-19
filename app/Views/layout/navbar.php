<?php $session = session(); ?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/logout" class="nav-link">Logout</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li> -->

        <!-- Messages Dropdown Menu -->
        <!-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li> -->

        <!-- Notifications Dropdown Menu -->
        <!-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="/dist/img/AdminLTELogo.png" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">TokoMas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <!-- <div class="image">
                <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div> -->
            <div class="info">
                <a href="#" class="d-block"><?= $session->get('nama_user'); ?></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Menu Utama
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/index.php" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/transaksiharian" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Transaksi Harian</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Kartu Stock
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/kartustock/1" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Emas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/kartustock/5" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Loose Diamond</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/kartustock/6" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Barang Dagang</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Master Stock
                            <i class=" right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/databarang/1" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Perhiasan Emas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/databarang/2" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Perhiasan Berlian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/databarang/3" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Logam Mulia </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/databarang/4" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Bahan Emas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/databarang/5" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Loose Diamond</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/databarang/6" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Barang Dagang</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Barang Masuk
                            <i class=" right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/barangmasuk" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pembelian Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/buybackcust" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buyback Customer</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-share-square"></i>
                        <p>
                            Barang Keluar
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/barangkeluar" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jual Barang</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Proses Barang
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dataretur" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Barang Retur</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/datacuci" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Barang Cuci</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/datalebur" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Barang Lebur</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Custom Barang
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/barangkeluar" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pemesanan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Input Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/masterinput" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Master data</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/stockopname" class="nav-link">
                        <i class="nav-icon far fa fa-list-alt"></i>
                        <p>
                            Stock Opname
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Master Update
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/updatepembelian" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pembelian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/datacuci" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penjualan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/datalebur" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buyback</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                        <i class="nav-icon far fa fa-power-off"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>