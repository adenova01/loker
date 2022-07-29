<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>SIGN IN | Loker</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/demo.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<p class="lead">DAFTAR</p>
							</div>
							<form action="signup.php" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Email</label>
									<input type="email" name="email" class="form-control" placeholder="email" required>
								</div>
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">No Hp</label>
									<input type="text" name="nohp" class="form-control" placeholder="no hp" maxlength="12" required>
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" name="password" class="form-control" placeholder="password" maxlength="10" required>
								</div>
								<p>sudah punya akun, <a href="login.php">Login</a></p>
								<input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="DAFTAR">
							</form>
							<br>
							<center>
								<p>Repost by <a href="https://stokcoding.com/" title="StokCoding.com" target="_blank">StokCoding.com</a></p>
							</center>
							<?php

							if (isset($_POST['submit'])) {
								include "lib/koneksi.php";

								$email = $_POST['email'];
								$nohp = $_POST['nohp'];
								$password = $_POST['password'];

								$cek = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
								$hit = mysqli_num_rows($cek);

								if ($hit > 0) {
									echo '<span class="label label-danger label-block">email sudah pernah terdaftar sebelumnya <i class="fa fa-remove"></i></span>';
								} else {
									$get_id = mysqli_query($conn, "SELECT id FROM user WHERE SUBSTRING(id,1,4)='USER'") or die(mysqli_error($conn));
									$trim_id = mysqli_query($conn, "SELECT SUBSTRING(id,-6,6) as hasil FROM user WHERE SUBSTRING(id,1,4)='USER' ORDER BY hasil DESC LIMIT 1") or die(mysqli_error($conn));
									$hit    = mysqli_num_rows($get_id);
									if ($hit == 0) {
										$id_k   = "USER000001";
									} else if ($hit > 0) {
										$row    = mysqli_fetch_array($trim_id);
										$kode   = $row['hasil'] + 1;
										$id_k   = "USER" . str_pad($kode, 6, "0", STR_PAD_LEFT);
									}

									$insert1 = mysqli_query($conn, "INSERT INTO user SET id='$id_k', email='$email', no_hp='$nohp', password='$password'") or die(mysqli_error($conn));
									$insert2 = mysqli_query($conn, "INSERT INTO pemberkasan SET user_id='$id_k', pemberkasan_nilai=0, pemberkasan_bobot=25") or die(mysqli_error($conn));

									if ($insert1 && $insert2) {
										echo '<span class="label label-primary label-block">Mendaftar akun berhasil <i class="fa fa-check"></i></span>';
										echo "<meta http-equiv='refresh' content='1;
										url=login.php'>";
									}
								}
							}
							?>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text text-center">
							<img src="assets/img/loker-icon.png" alt="logo-icon" width="200">
							<h1 class="heading">E-Loker</h1>
							<p>Sistem Lowongan Elektronik dengan metode SAW</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>