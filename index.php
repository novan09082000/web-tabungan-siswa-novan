<?php  

session_start();

if (!isset($_SESSION["login"])){
	header("Location: php/masuk.php");
	exit;
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>.:Selamat Datang:.</title>
	<link rel="stylesheet" type="text/css" href="css/styleindex.css">
</head>
<body>

<div class="container">
	<div class="header">
			<ul>
				<li class=""><a href="">Mandiri</a></li>
				<li><a href="">Home</a></li>
				<li><a href="">Data</a>
					<ul>
						<li><a href="php/datapetugas.php">Data Petugas</a></li>
						<li><a href="php/datanasabah.php">Data Nasabah</a></li>
					</ul>
				</li>
				<li><a href="">Transaksi</a>
					<ul>
						<li><a href="php/transaksisetoran.php">Transaksi Setoran Tunai</a></li>
						<li><a href="php/transaksipenarikan.php">Transaksi Penarikan Tunai</a></li>
						<li><a href="php/mutasi.php">Mutasi</a></li>
					</ul>
				</li>
				<li><a href="">Laporan</a>
					<ul>
						<li><a href="php/laporanperiode.php">Laporan Per Periode</a></li>
						<li><a href="php/laporannasabah.php">Laporan Nasabah</a></li>
					</ul>
				</li>
				<li><a href="php/tentangkami.php">Tentang Kami</a></li>
			</ul>
			<ul class="logout">
				<li><a href="php/logout.php">Logout</a></li>
			</ul>
	</div>
	<div class="judulsatu"><h1>Selamat Datang di Web Tabungan Mahasiswa</h1></div>
	<div class="juduldua"><h2>Silahkan untuk memilih fitur yang anda inginkan</h2></div>
	<div class="main">
		<div class="wrapper">
			<div class="image one"></div>
			<div class="caption">
				<span>Data</span><br>
				cari data mengenai petugas dan nasabah dengan fitur data
			</div>
		</div>
		<div class="wrapper">
			<div class="image two"></div>
			<div class="caption">
				<span>Transaksi</span><br>
				Anda ingin menabung uang atau mengambil tabungan anda. fitur Transaksi solusinya
			</div>
		</div>
		<div class="wrapper">
			<div class="image three"></div>
			<div class="caption">
				<span>Laporan</span><br>
				cetak data tabungan dengan fitur laporan.
			</div>
		</div>
		<div class="wrapper">
			<div class="image four"></div>
			<div class="caption">
				<span>Tentang Kami</span><br>
				Lebih mengenal kami dengan fitur tentang kami.
			</div>
		</div>
	</div>
	<div class="footer">&copy; Copyright 2019. Mas Opan Production</div>
</div>
</body>
</html>