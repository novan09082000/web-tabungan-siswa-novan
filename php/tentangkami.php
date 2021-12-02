<?php  

session_start();

if (!isset($_SESSION["login"])){
	exit;
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>.:Tentang Kami:.</title>
	<link rel="stylesheet" type="text/css" href="../css/styletentangkami.css">
</head>
<body>
	<div class="container">
	<div class="header">
			<ul>
				<li class=""><a href="">Mandiri</a></li>
				<li><a href="../index.php">Home</a></li>
				<li><a href="">Data</a>
					<ul>
						<li><a href="datapetugas.php">Data Petugas</a></li>
						<li><a href="datanasabah.php">Data Nasabah</a></li>
					</ul>
				</li>
				<li><a href="">Transaksi</a>
					<ul>
						<li><a href="transaksisetoran.php">Transaksi Setoran Tunai</a></li>
						<li><a href="transaksipenarikan.php">Transaksi Penarikan Tunai</a></li>
						<li><a href="mutasi.php">Mutasi</a></li>
					</ul>
				</li>
				<li><a href="">Laporan</a>
					<ul>
						<li><a href="">Laporan Per Periode</a></li>
						<li><a href="">Laporan Nasabah</a></li>
					</ul>
				</li>
				<li><a href="tentangkami.php">Tentang Kami</a></li>
			</ul>
			<ul class="logout">
				<li><a href="logout.php">Logout</a></li>
			</ul>
	</div>
	<div class="judulsatu"><h1>About Web Tabungan Mahasiswa</h1></div>
	<div class="juduldua"><h2>hasil pembuatan ini tanpa disponsori oleh apapun :'(</h2></div>
	<div class="main">
		<div class="profilweb">
			<img class="image" src="../img/laporan.jpg">
				<div class="overlay overlayBottom">
					<div class="text">
						<h1>Web Laporan Mahasiswa</h1><br>
						<p>Web buatan Mas Opan Production Feat Selvi. Web ini digunakan untuk memudahkan proses tabungan lembaga anda. Web ini memiliki fitur seperti : Data, Transaksi dan Laporan. Web ini bisa digunakan secara gratis karena Web ini memiliki lisensi dari Dosen kami Yaitu Pak Asep Ririh. Tunggu apa lagi? Pakai lah :D</p>
					</div>
				</div>
		</div>
		<div class="novan">
			<img class="image" src="../img/5d1b38979b3c1.jpg">
				<div class="overlay overlayLeft">
					<div class="text">
						<h1>Novan Tiano</h1><br>
						<p>Mahasiswa Sistem Informasi STMIK Mardira. Owner Web Tabungan Mahasiswa.
						   Mencoba menjadi Programmer professional.</p>
					</div>
				</div>
		</div>
		<div class="selvi">
			<img class="image" src="../img/5d21c28f9a549.jpg">
				<div class="overlay overlayRight">
					<div class="text">
						<h1>Selvi Yani</h1><br>
						<p>Mahasiswa Sistem Informasi STMIK Mardira Indonesia</p>
					</div>
				</div>
		</div>	
	</div>
	<div class="footer">&copy; Copyright 2019. Mas Opan Production</div>
</div>
</body>
</html>