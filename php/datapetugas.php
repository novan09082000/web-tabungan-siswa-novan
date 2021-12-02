<?php  

session_start();

if (!isset($_SESSION["login"])){
	header("Location: masuk.php");
	exit;
}

require("fungsidatapetugas.php");
$mahasiswa = query("SELECT * FROM datapetugas");


?>

<!DOCTYPE html>
<html>
<head>
	<title>.:Data Petugas:.</title>
	<link rel="stylesheet" type="text/css" href="../css/styledatapetugas.css">
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
						<li><a href="laporanperiode.php">Laporan Per Periode</a></li>
						<li><a href="laporannasabah.php">Laporan Nasabah</a></li>
					</ul>
				</li>
				<li><a href="tentangkami.php">Tentang Kami</a></li>
			</ul>
			<ul class="logout">
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
		<div class="main">
			<form action="" method="post">
				<div class="judul">
					Data Petugas STMIK Leuwi Panjang
				</div>
				<div class="tambah">
					<a href="tambahpetugas.php" class="tomboltambah">Tambah Mahasiswa</a>
				</div>
				<div class="tabelmahasiswa">
					<table>
						<thead>
						<?php 
						$th = ["No","Aksi","No. Petugas","NIM","Nama","Prodi","Kelas"];
						echo "<tr>";
						for($i=0;$i<=6;$i++) {
							echo "<th class = $th[$i]>";
							echo $th[$i];
							echo "</th>";
						}
						echo "</tr>";


						?>
						</thead>
						<tbody>
						<?php $j = 1; ?>
						<?php foreach ($mahasiswa as $row) : ?>
							<tr>
							<td> <?php echo $j; ?> </td>
							<td class="aksi"> 
							<a href="ubahpetugas.php?No_Petugas=<?= $row['No_Petugas'];?>" name="ubahpetugas">Ubah</a> | <a href="hapuspetugas.php?No_Petugas=<?= $row['No_Petugas'];?>" onclick="return confirm('yakin?')">Hapus</a>
							</td>
							<td> <?php echo $row["No_Petugas"]; ?> </td>
							<td> <?php echo $row["NIM"]; ?> </td>
							<td> <?php echo $row["Nama"]; ?> </td>
							<td> <?php echo $row["Prodi"]; ?> </td>
							<td> <?php echo $row["Kelas"]; ?> </td>
						    </tr>
						<?php $j++; ?>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</form>
		</div>
		<div class="footer"> &copy; Copyright 2019. Mas Opan Production</div>
	</div>
</body>
</html>