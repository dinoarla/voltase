<?php
session_start();
include "../library/config.php";
include "../library/function_antiinjection.php";
?>

<!DOCTYPE HTML>
<html>

<head>
	<title>VOLTASE - K3L dan KAM UP3 Indramayu</title>
	<link rel="shortcut icon" href="images/pln_logo.png" />
	<script src="js/jquery.min.js"></script>
	<!-- Custom Theme files -->
	<link href="css/login.css" rel="stylesheet" type="text/css" media="all" />
	<!-- for-mobile-apps -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="#" />
	<!-- //for-mobile-apps -->
	<!--Google Fonts-->
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
</head>

<body>
	<!--header start here-->
	<div class="body"></div>
	<div class="header">


		<?php
		if (isset($_POST['login'])) {
			$username = antiinjeksi($_POST['username']);
			$password = antiinjeksi(md5($_POST['password']));

			$cekuser = $mysqli->query("SELECT * FROM tbl_user WHERE username='$username' AND password='$password'");
			$jmluser = $cekuser->num_rows;
			$data = $cekuser->fetch_array();

			if ($jmluser > 0) {

				$_SESSION['username']     = $data['username'];
				$_SESSION['nama']  		= $data['nama_lengkap'];
				$_SESSION['password']     = $data['password'];
				$_SESSION['iduser']     	= $data['id_user'];
				$_SESSION['leveluser']    = $data['level'];

				$_SESSION['timeout'] = time() + 1000;
				$_SESSION['login'] = 1;

				header('location: index.php');
			} else {
				echo '<div class="alert" role="alert"><b>Punteun!</b> Username atau password salah.</div>';
			}
		}
		?>

		<div class="header-main">
			<img class="logo" src="images/pln_logo.png"></img>
			<h1>VOLTASE</h1>
			<h4>K3L DAN KAM UP3 INDRAMAYU</h4>
			<div class="header-bottom">
				<div class="header-right w3agile">

					<div class="header-left-bottom agileinfo">

						<form action="login.php" method="post">
							<input type="text" value="Username" name="username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}" />
							<input type="password" value="Password" name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}" />

							<input type="submit" value="Login" name="login">
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!--header end here-->
	<div class="copyright">
		<p>VOLTASE - K3L DAN KAM UP3 INDRAMAYU &copy; 2022. Hak Cipta Terpelihara dan Dilindungi Undang-Undang</p>
	</div>
	<!--footer end here-->
</body>

</html>