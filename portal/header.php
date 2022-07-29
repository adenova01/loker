<nav class="navbar navbar-default navbar-fixed-top">
	<div class="brand">
		<a href="?page=beranda">E-LOKER</a>
	</div>
	<div class="container-fluid">
		<div class="navbar-btn">
			<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
		</div>
		<div id="navbar-menu">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?= $_SESSION['role'] == 2 ? $auth['image_url'] !== null ? 'file/gambar/'.$auth['image_url'] : 'assets/img/admin.png' : 'assets/img/admin.png' ?>" class="img-circle" alt="Avatar"> <span><?= isset($auth['nama_lengkap']) ? $auth['nama_lengkap'] : $auth['email']  ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
					<ul class="dropdown-menu">
						<li><a href="?page=profil"><i class="fa fa-user"></i> <span>Profilku</span></a></li>
						<li><a href="?page=logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>