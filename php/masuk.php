<?php  
session_start();
require 'fungsikoneksi.php';

// cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// ambil username berdasarkan id
	$result = mysqli_query($conn,"SELECT Username FROM akunpetugas WHERE nim =$id ");
	$row = mysqli_fetch_assoc($result);

	// cek cookie dan username
	if ($key === hash('sha256',$row['Username'])){
		$_SESSION['login'] = true;
	}

}


if(isset($_SESSION["login"])){
	header("Location: ../index.php");
	exit;
}



if(isset($_POST["login"])){
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM akunpetugas WHERE Username = '$username' ");

	// cek username
	if(mysqli_num_rows($result) === 1){
		// cek password
		$row = mysqli_fetch_assoc($result);
		if(password_verify($password,$row["password"])){
			// set session
			$_SESSION["login"] = true;

			// cek remember me
			if (isset($_POST['remember'])){
				// buat cookie

				setcookie('id',$row['NIM'],time()+60);
				setcookie('key',hash('sha256',$row['Username']),time()+60);
			}

			header("Location: ../index.php");
			exit;
		}
	}

	$error = true;
}


?>


<!DOCTYPE html>
<html>
<head>
	<title>.:Login kuy:.</title>
	<link rel="stylesheet" type="text/css" href="../css/stylemasuk.css">
</head>
<body>
	<div class="container">
		<div class="main">
			<form action="" method="post">
				<div class="judul">
					<div class="masuk">Login Admin Tabungan Mahasiswa</div>
				</div>

				<?php if(isset($error)) : ?>
				<p style="color: red; font-style: italic;">username / password salah</p>
				<?php endif; ?>

				<div class="label1"><label>Username</label></div>
				<div class="kotak1"><input type="text" name="username" required></div>
				<div class="label2"><label>Password</label></div>
				<div class="kotak2"><input type="password" name="password" required></div>
				<div class="ceklis"><input type="checkbox" name="remember">Remember me</div>
				<div class="daftar">Anda Belum Mendaftar, Klik <a href="daftar.php">Disini</a></div>
				<div class="tombol1"><button type="submit" name="login">Login</button></div>
			</form>
		</div>
	</div>
</body>
</html>