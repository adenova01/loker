<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="?page=beranda" class=""><i class="fa fa-home"></i> <span>Beranda</span></a></li>
                <?php if ($_SESSION['role'] == 1) { ?>
                <li>
                    <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="fa fa-cogs"></i> <span>Manajemen</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages" class="collapse ">
                        <ul class="nav">
                            <li><a href="?page=loker" class="">Lowongan Pekerjaan</a></li>
                            <li><a href="?page=user" class="">Data User Pendaftar</a></li>
                            <li><a href="?page=pendaftaran" class="">Pendaftaran</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="fa fa-cog"></i> <span>Proses Tahap</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages2" class="collapse ">
                        <ul class="nav">
                            <li><a href="?page=pemberkasan" class="">Pemberkasan</a></li>
                            <li><a href="?page=psikotest" class="">Psikotest</a></li>
                            <li><a href="?page=wawancara" class="">Wawancara</a></li>
                            <li><a href="?page=kesehatan" class="">Kesehatan</a></li>
                            <li><a href="?page=metode" class="">Metode</a></li>
                        </ul>
                    </div>
                </li>
                <?php } ?>
                <?php if ($_SESSION['role'] == 2) { ?>
                <li><a href="?page=loker" class=""><i class="fa fa-briefcase"></i> <span>Lowongan Pekerjaan</span></a></li>
                <li><a href="?page=lokeractive" class=""><i class="fa fa-check-square"></i> <span>Lowongan Pekerjaan Aktif</span></a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>