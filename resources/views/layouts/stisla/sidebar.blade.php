<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"><p>Inventaris Barang<br>Restu Ibu</p></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">SDMB</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Halaman Utama</li>
            <li class="nav-item dropdown {{ Request::segment(2) === 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Halaman Utama</span></a>
            </li>
            <!-- <li class="menu-header">Manajemen</li>
            <li class="nav-item dropdown {{ Request::segment(2) === 'barang' ? 'active' : '' }}">
                <a href="{{ route('barang.index') }}" class="nav-link"><i class="fas fa-columns"></i> <span>Data Barang Masuk</span></a>
            </li> -->
            <!-- <li class="nav-item dropdown {{ Request::segment(2) === 'bantuan-dana-operasional' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('bantuan-dana-operasional.index') }}"><i class="far fa-square"></i> <span>Data BOS</span></a>
            </li> -->
            <li class="nav-item dropdown active' : '' }}">
                <a href="{{ route('det_trx_barang.index') }}" class="nav-link"><i class="fas fa-th"></i> <span>Transaksi</span></a>
            </li>
              <!-- <li class="nav-item dropdown 'active' : '' }}">
                <a href="{{ route('trx_barang.index') }}" class="nav-link"><i class="far fa-square"></i> <span>Status Barang</span></a>
            </li> -->
            <li class="nav-item dropdown 'active' : '' }}">
                <a href="{{ route('BarangMaster.index') }}" class="nav-link"><i class="fas fa-columns"></i> <span>Master Barang</span></a>
            </li>
            <li class="nav-item dropdown 'active' : '' }}">
                <a href="{{ route('laporan.index') }}" class="nav-link"><i class="far fa-square"></i> <span>Laporan</span></a>
            </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a class="btn btn-danger btn-lg btn-block btn-icon-split" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </aside>
</div>