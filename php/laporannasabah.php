<?php  

session_start();

if (!isset($_SESSION["login"])){
	header("Location: masuk.php");
	exit;
}

require("fungsilaporan.php");
$mahasiswa = query("SELECT * FROM transaksi");

if(isset($_POST["cari"])){	
	$mahasiswa = cari($_POST["keyword"]);
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>.:Mutasi:.</title>
	<link rel="stylesheet" type="text/css" href="../css/stylelaporannasabah.css">
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
					Laporan Nasabah
				</div>
				<!-- <div class="tambah">
					<a href="tambahpetugas.php" class="tomboltambah">Tambah Mahasiswa</a>
				</div> -->
				<div class="cari">
					<input type="text" name="keyword" autofocus autocomplete="off" placeholder="Masukan Nama">
					<button type="submit" name="cari">Cari</button>
				</div>
				<?php if(isset($_POST["cari"])) { ?>
				<div class="tabelmahasiswa">
					<table>
						<thead>
						<?php 
						$th = ["No","No Transaksi","Tanggal","Nama","Transaksi","Debit","Kredit"];
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
							<td> <?php echo $row["No_Transaksi"]; ?> </td>
							<td> <?php echo $row["Tanggal"]; ?> </td>
							<td> <?php echo $row["Nama"]; ?> </td>
							<td> <?php echo $row["Jenis_Transaksi"]; ?> </td>
							<td> <?php echo rupiah($row["Debet"]); ?> </td>
							<td><?php echo rupiah($row["Kredit"]);  ?></td>
						    </tr>
						<?php $j++; ?>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			    <div class="print">
			    	<button><a href="cetaknasabah.php?nama=<?= $row['Nama'];?>">Cetak</a></button>
			    </div>
			    <?php } ?>
			</form>
		</div>
		<div class="footer"> &copy; Copyright 2019. Mas Opan Production</div>
	</div>
</body>
</html>