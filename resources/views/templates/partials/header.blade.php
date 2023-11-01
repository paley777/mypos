<header class="app-header fixed-top">
    <div class="app-header-inner">
        <div class="container-fluid py-2">
            <div class="app-header-content">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                role="img">
                                <title>Menu</title>
                                <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                    stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                            </svg>
                        </a>
                        @if ($breadcrumb == 'beranda')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'regisbarang')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item">Registrasi Barang</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'create_regisbarang')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item"><a href="/dashboard/regis-barang">Registrasi Barang</a>
                                    </li>
                                    <li class="breadcrumb-item">Tambah Barang Baru</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'edit_regisbarang')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item"><a href="/dashboard/regis-barang">Registrasi Barang</a>
                                    </li>
                                    <li class="breadcrumb-item">Ubah Barang</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'stokbarang')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item">Stok Barang</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'regissupplier')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item">Registrasi Supplier</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'create_regissupplier')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item"><a href="/dashboard/regis-supplier">Registrasi
                                            Supplier</a></li>
                                    <li class="breadcrumb-item">Tambah Supplier Baru</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'edit_regissupplier')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item"><a href="/dashboard/regis-supplier">Registrasi
                                            Supplier</a></li>
                                    <li class="breadcrumb-item">Ubah Supplier</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'barangmasuk')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item">Barang Masuk</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'create_barangmasuk')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item"><a href="/dashboard/barang-masuk">Barang Masuk</a></li>
                                    <li class="breadcrumb-item">Barang Masuk Baru</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'edit_barangmasuk')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item"><a href="/dashboard/barang-masuk">Barang Masuk</a></li>
                                    <li class="breadcrumb-item">Ubah Barang Masuk</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'barangkeluar')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item">Barang Keluar</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'regispelanggan')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item">Registrasi Pelanggan</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'create_regispelanggan')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item"><a href="/dashboard/regis-pelanggan">Registrasi
                                            Pelanggan</a></li>
                                    <li class="breadcrumb-item">Tambah Pelanggan Baru</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'edit_regispelanggan')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item"><a href="/dashboard/regis-pelanggan">Registrasi
                                            Pelanggan</a></li>
                                    <li class="breadcrumb-item">Ubah Pelanggan</li>
                                </ol>
                        @elseif ($breadcrumb == 'edit_stokbarang')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item"><a href="/dashboard/stok-barang">Stok Barang</a></li>
                                    <li class="breadcrumb-item">Ubah Stok</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'kasir')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item">Kasir</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'invoice')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item">Invoice</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'laporan')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item">Report</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'about')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item">Tentang Sistem</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'profile')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item">Profil Saya</li>
                                </ol>
                            </nav>
                        @elseif ($breadcrumb == 'profile_edit')
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb responsive-small">
                                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                                    <li class="breadcrumb-item"><a href="/dashboard/my-profile">Profil Saya</a></li>
                                    <li class="breadcrumb-item">Edit Profil</li>
                                </ol>
                            </nav>
                        @endif
                    </div>
                    <div class="app-utilities col-auto">
                        <div class="app-utility-item  app-user-dropdown dropdown">
                            <a class="dropdown-toggle justify-content-center  p-2" id="user-dropdown-toggle"
                                data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                <svg width="24px" height="24px" viewBox="0 0 20 20" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <title>profile_round [#1342]</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs> </defs>
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd">
                                            <g id="Dribbble-Light-Preview"
                                                transform="translate(-140.000000, -2159.000000)" fill="#000000">
                                                <g id="icons" transform="translate(56.000000, 160.000000)">
                                                    <path
                                                        d="M100.562548,2016.99998 L87.4381713,2016.99998 C86.7317804,2016.99998 86.2101535,2016.30298 86.4765813,2015.66198 C87.7127655,2012.69798 90.6169306,2010.99998 93.9998492,2010.99998 C97.3837885,2010.99998 100.287954,2012.69798 101.524138,2015.66198 C101.790566,2016.30298 101.268939,2016.99998 100.562548,2016.99998 M89.9166645,2004.99998 C89.9166645,2002.79398 91.7489936,2000.99998 93.9998492,2000.99998 C96.2517256,2000.99998 98.0830339,2002.79398 98.0830339,2004.99998 C98.0830339,2007.20598 96.2517256,2008.99998 93.9998492,2008.99998 C91.7489936,2008.99998 89.9166645,2007.20598 89.9166645,2004.99998 M103.955674,2016.63598 C103.213556,2013.27698 100.892265,2010.79798 97.837022,2009.67298 C99.4560048,2008.39598 100.400241,2006.33098 100.053171,2004.06998 C99.6509769,2001.44698 97.4235996,1999.34798 94.7348224,1999.04198 C91.0232075,1998.61898 87.8750721,2001.44898 87.8750721,2004.99998 C87.8750721,2006.88998 88.7692896,2008.57398 90.1636971,2009.67298 C87.1074334,2010.79798 84.7871636,2013.27698 84.044024,2016.63598 C83.7745338,2017.85698 84.7789973,2018.99998 86.0539717,2018.99998 L101.945727,2018.99998 C103.221722,2018.99998 104.226185,2017.85698 103.955674,2016.63598"
                                                        id="profile_round-[#1342]"> </path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg></a>
                            <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                <li><a class="dropdown-item" href="/dashboard/my-profile">Akun Saya</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <li><button type="submit" class="dropdown-item">
                                            Keluar
                                        </button></li>
                                </form>
                            </ul>
                        </div><!--//app-user-dropdown-->
                    </div><!--//app-utilities-->
                </div><!--//row-->
            </div><!--//app-header-content-->
        </div><!--//container-fluid-->
    </div><!--//app-header-inner-->
    <div id="app-sidepanel" class="app-sidepanel">
        <div id="sidepanel-drop" class="sidepanel-drop"></div>
        <div class="sidepanel-inner d-flex flex-column">
            <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
            <div class="app-branding">
                <a class="app-logo" href="#"><img class="logo-icon me-2"
                        src="{{ asset('storage\container\logo_app.png') }}" alt="logo"><span
                        class="logo-text">MyPOS
                        V1</span></a>
            </div><!--//app-branding-->
            <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link {{ $active === 'beranda' ? 'active' : '' }}" href="/dashboard">
                            <span class="nav-icon">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
                                    <path fill-rule="evenodd"
                                        d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                </svg>
                            </span>
                            <span class="nav-link-text">Beranda</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <li class="nav-item has-submenu">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link {{ $active === 'registrasi' ? 'active' : '' }} submenu-toggle"
                            href="#" data-bs-toggle="collapse" data-bs-target="#submenu-3"
                            aria-expanded="false" aria-controls="submenu-3">
                            <span class="nav-icon">
                                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                    <path fill-rule="evenodd"
                                        d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z" />
                                    <circle cx="3.5" cy="5.5" r=".5" />
                                    <circle cx="3.5" cy="8" r=".5" />
                                    <circle cx="3.5" cy="10.5" r=".5" />
                                </svg>
                            </span>
                            <span class="nav-link-text">Registrasi</span>
                            <span class="submenu-arrow">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </span><!--//submenu-arrow-->
                        </a><!--//nav-link-->
                        <div id="submenu-3" class="collapse submenu submenu-1" data-bs-parent="#menu-accordion">
                            <ul class="submenu-list list-unstyled">
                                <li class="submenu-item"><a class="submenu-link"
                                        href="/dashboard/regis-barang">Registrasi Barang</a></li>
                                <li class="submenu-item"><a class="submenu-link"
                                        href="/dashboard/regis-supplier">Registrasi Supplier</a>
                                </li>
                                <li class="submenu-item"><a class="submenu-link"
                                        href="/dashboard/regis-pelanggan">Registrasi Pelanggan</a>
                                </li>
                            </ul>
                        </div>
                    </li><!--//nav-item-->
                    <li class="nav-item has-submenu">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link {{ $active === 'arusbarang' ? 'active' : '' }} submenu-toggle"
                            href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1"
                            aria-expanded="false" aria-controls="submenu-1">
                            <span class="nav-icon">
                                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                    <path fill-rule="evenodd"
                                        d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z" />
                                    <circle cx="3.5" cy="5.5" r=".5" />
                                    <circle cx="3.5" cy="8" r=".5" />
                                    <circle cx="3.5" cy="10.5" r=".5" />
                                </svg>
                            </span>
                            <span class="nav-link-text">Arus Barang</span>
                            <span class="submenu-arrow">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </span><!--//submenu-arrow-->
                        </a><!--//nav-link-->
                        <div id="submenu-1" class="collapse submenu submenu-1" data-bs-parent="#menu-accordion">
                            <ul class="submenu-list list-unstyled">
                                <li class="submenu-item"><a class="submenu-link"
                                        href="/dashboard/barang-masuk">Barang
                                        Masuk</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="/dashboard/stok-barang">Stok
                                        Barang</a>
                                </li>
                                <li class="submenu-item"><a class="submenu-link"
                                        href="/dashboard/barang-keluar">Barang
                                        Keluar</a>
                                </li>
                            </ul>
                        </div>
                    </li><!--//nav-item-->
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link {{ $active === 'kasir' ? 'active' : '' }}" href="/dashboard/cashier">
                            <span class="nav-icon">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-code-square"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                    <path fill-rule="evenodd"
                                        d="M6.854 4.646a.5.5 0 0 1 0 .708L4.207 8l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0zm2.292 0a.5.5 0 0 0 0 .708L11.793 8l-2.647 2.646a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708 0z" />
                                </svg>
                            </span>
                            <span class="nav-link-text">Kasir</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link {{ $active === 'invoice' ? 'active' : '' }}" href="/dashboard/invoice">
                            <span class="nav-icon">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                    <path fill-rule="evenodd"
                                        d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z" />
                                    <circle cx="3.5" cy="5.5" r=".5" />
                                    <circle cx="3.5" cy="8" r=".5" />
                                    <circle cx="3.5" cy="10.5" r=".5" />
                                </svg>
                            </span>
                            <span class="nav-link-text">Invoice</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <li class="nav-item has-submenu">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link {{ $active === 'laporan' ? 'active' : '' }} submenu-toggle" href="#" data-bs-toggle="collapse"
                            data-bs-target="#submenu-2" aria-expanded="false" aria-controls="submenu-1">
                            <span class="nav-icon">
                                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z" />
                                    <path fill-rule="evenodd"
                                        d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z" />
                                </svg>
                            </span>
                            <span class="nav-link-text">Laporan</span>
                            <span class="submenu-arrow">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </span><!--//submenu-arrow-->
                        </a><!--//nav-link-->
                        <div id="submenu-2" class="collapse submenu submenu-1" data-bs-parent="#menu-accordion">
                            <ul class="submenu-list list-unstyled">
                                <li class="submenu-item"><a class="submenu-link" href="/dashboard/report/barang-masuk">Barang
                                        Masuk</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="/dashboard/report/barang-keluar">Barang
                                        Keluar</a>
                                </li>
                                <li class="submenu-item"><a class="submenu-link" href="/dashboard/report/stok-barang">Stok Barang</a>
                                </li>
                                <li class="submenu-item"><a class="submenu-link" href="/dashboard/report/invoice">Invoice</a>
                                <li class="submenu-item"><a class="submenu-link" href="/dashboard/report/order">Order</a>
                                </li>
                            </ul>
                        </div>
                    </li><!--//nav-item-->
                </ul><!--//app-menu-->
            </nav><!--//app-nav-->
            <div class="app-sidepanel-footer">
                <nav class="app-nav app-nav-footer">
                    <ul class="app-menu footer-menu list-unstyled">
                        <li class="nav-item {{ $active === 'about' ? 'active' : '' }}">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link"
                                href="/dashboard/about">
                                <span class="nav-icon">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-person"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M12 1H4a1 1 0 0 0-1 1v10.755S4 11 8 11s5 1.755 5 1.755V2a1 1 0 0 0-1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z" />
                                        <path fill-rule="evenodd" d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">Tentang Sistem</span>
                            </a><!--//nav-link-->
                        </li><!--//nav-item-->
                    </ul><!--//footer-menu-->
                </nav>
            </div><!--//app-sidepanel-footer-->

        </div><!--//sidepanel-inner-->
    </div><!--//app-sidepanel-->
</header><!--//app-header-->
