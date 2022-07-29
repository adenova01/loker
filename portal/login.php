<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>LOGIN | Loker</title>
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
								<p class="lead">LOGIN</p>
							</div>
							<form action="login.php" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Email</label>
									<input type="text" name="email" class="form-control" placeholder="email" required>
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" name="password" class="form-control" placeholder="password" required>
								</div>
								<p>belum punya akun, <a href="signup.php">Daftar</a></p>
								<input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="LOGIN">
							</form>
							<br>
							<?php

							if (isset($_POST['submit'])) {
								session_start();
								include "lib/koneksi.php";

								$e = $_POST['email'];
								$p = $_POST['password'];

								$ceklogin1 = mysqli_query($conn, "SELECT * FROM user WHERE email='$e' AND password='$p'");
								$data1 = mysqli_fetch_array($ceklogin1);
								$hit1 = mysqli_num_rows($ceklogin1);

								$ceklogin2 = mysqli_query($conn, "SELECT * FROM admin WHERE email='$e' AND password='$p'");
								$data2 = mysqli_fetch_array($ceklogin2);
								$hit2 = mysqli_num_rows($ceklogin2);

								if ($hit1 > 0) {
									$now = date('Y-m-d h:i:s');
									mysqli_query($conn, "UPDATE user SET login_terakhir = '$now' WHERE id='$data1[id]'");
									echo '<span class="label label-primary label-block">Login Gagal <i class="fa fa-check"></i></span>';
									echo "<meta http-equiv='refresh' content='1;
									url=index.php?page=beranda'>";
									// header('index.php?page=beranda');
									$_SESSION['email'] = $data1['email'];
									$_SESSION['password'] = $data1['password'];
									$_SESSION['role'] = 2;
								}

								if ($hit2 > 0) {
									$now = date('Y-m-d h:i:s');
									mysqli_query($conn, "UPDATE admin SET login_terakhir = '$now' WHERE id='$data2[id]'");
									echo '<span class="label label-primary label-block">Login Sukses <i class="fa fa-check"></i></span>';
									echo "<meta http-equiv='refresh' content='1;
									url=index.php?page=beranda'>";
									// header('index.php?page=beranda');
									$_SESSION['email'] = $data2['email'];
									$_SESSION['password'] = $data2['password'];
									$_SESSION['role'] = 1;
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
							<!-- <p>Sistem Lowongan Elektronik dengan metode SAW</p> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>