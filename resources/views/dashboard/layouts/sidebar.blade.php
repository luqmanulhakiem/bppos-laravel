<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link text-center">
      <span class="brand-text font-weight-light"><b>BP</b>PoS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info col">
            <a href="#" class="d-block">{{ auth()->user()->username }}</a>
            <a href="#" class="d-block"><i class="fa fa-circle text-green"></i>  Online</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            {{-- List Menu Disini --}}
            <li class="nav-header">Navigasi Utama</li>
            <li class="nav-item">
                <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                    Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('penyuplai')}}" class="nav-link {{ Request::is(['penyuplai', 'penyuplai/tambah', 'penyuplai/edit/*' ,'penyuplai/search']) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-truck"></i>
                    <p>
                    Penyuplai
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/pelanggan" class="nav-link {{ Request::is(['pelanggan', 'pelanggan/tambah', 'pelanggan/edit/*', 'pelanggan/search']) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                    Pelanggan
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-archive"></i>
                <p>
                    Produk
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/produk/kategori" class="nav-link {{ Request::is('produk/kategori') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/produk/satuan" class="nav-link {{ Request::is('produk/satuan') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Satuan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/produk/barang" class="nav-link {{ Request::is('produk/barang') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/produk/harga" class="nav-link {{ Request::is('produk/harga') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Harga</p>
                    </a>
                </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                    Transaksi
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/transaksi/penjualan" class="nav-link {{ Request::is('transaksi/penjualan') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penjualan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/transaksi/barang-masuk" class="nav-link {{ Request::is('transaksi/barang-masuk') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Masuk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/transaksi/barang-keluar" class="nav-link {{ Request::is('transaksi/barang-keluar') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Keluar</p>
                    </a>
                </li>
                </ul>
            </li>

            <li class="nav-header">Pengaturan</li>
            <li class="nav-item">
                <a href="/pengguna" class="nav-link {{ Request::is(['pengguna', 'pengguna/tambah', 'pengguna/edit/*', 'pengguna/search']) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users text-orange"></i>
                    <p>
                    Pengguna
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/konfigurasi" class="nav-link {{ Request::is('konfigurasi') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cog text-warning"></i>
                    <p>
                    Konfigurasi
                    </p>
                </a>
            </li>
            
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>