	<?php
session_start();
if (!empty($_SESSION['email']) && !empty($_SESSION['password']) && !empty($_SESSION['role'])) {
	date_default_timezone_set('Asia/Jakarta');
	include "lib/koneksi.php";
?>
	<!doctype html>
	<html lang="en">

	<head>
		<title>Dashboard | <?= $_SESSION['role'] == 1 ? 'Administrator' : 'Pendaftar' ?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<!-- VENDOR CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
		<link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
		<!-- MAIN CSS -->
		<link rel="stylesheet" href="assets/css/main.css">
		<link rel="stylesheet" href="assets/css/demo.css">
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
		<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
		<style>
			.field-icon {
				float: right;
				margin-right: 8px;
				margin-top: -25px;
				position: relative;
				z-index: 2;
				cursor: pointer;
			}

			.box-circle {
				background: #676a6d;
				color: white;
				padding: 5px;
				border-radius: 50%;
				width: 28px;
				text-align: center;
			}
		</style>
	</head>

	<body>
		<div id="wrapper">
			<?php
			include "service.php";
			include "header.php";
			include "sidebar.php";
			?>

			<div class="main">
				<div class="main-content">
					<div class="container-fluid">
						<?php include "content.php"; ?>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<footer>
				<div class="container-fluid">
					<p class="copyright">Repost by <a href="#" title="Abc" target="_blank">E-Loker</a> &copy; <?= date('F Y') ?> <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
				</div>
			</footer>
		</div>
		<script src="assets/vendor/jquery/jquery.min.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
		<script src="assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
		<script src="assets/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
		<script src="assets/vendor/chartist/js/chartist.min.js"></script>
		<script src="assets/scripts/klorofil-common.js"></script>
		<script>
			$(function() {
				$('.example').DataTable()
			});
		</script>
		<script>
			$(".toggle-password").click(function() {
				$(this).toggleClass("fa-eye");
				var input = $($(this).attr("toggle"));
				if (input.attr("type") == "password") {
					input.attr("type", "text");
				} else {
					input.attr("type", "password");
				}
			});
		</script>
	</body>

	</html>
<?php
} else { ?>
	<div class="col-md-12" align="center">
		<button type="button" name="button" class="btn btn-primary">Login Terlebih dahulu</button>
	</div>

<?php echo "<meta http-equiv='refresh' content='1;
url=login.php'>";
} ?>