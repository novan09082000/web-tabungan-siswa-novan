<?php  

session_start();

if (!isset($_SESSION["login"])){
	header("Location: masuk.php");
	exit;
}

require ("fungsitransaksi.php");
// var_dump($_POST);
if(isset($_POST["cari"])){
	// $conn = mysqli_connect("localhost","root","","tabungansiswa");
	// $result = mysqli_query($conn,"SELECT * FROM datanasabah
	// 		  WHERE 
	// 		  No_Rekening LIKE '%$keyword%'
	// 		  ");
	// $rows = [];
	// while($row = mysqli_fetch_assoc($result)){
	// 	$rows[] = $row;
	// }
	// return $rows;	
	$mahasiswa = cari($_POST["keyword"]);
	// var_dump($mahasiswa);
}
if(isset($_POST["tambah"])){
	if(ubahsetoran($_POST) > 0){
	echo "
			<script>
				alert('transaksi berhasil!');
				document.location.href = 'transaksisetoran.php';
			</script>

		";
	} else {
			echo "
			<script>
				alert('transaksi gagal!');
				document.location.href = 'transaksisetoran.php';
			</script>

		";
	}
}
// $mahasiswa = query("SELECT * FROM datanasabah");


?>

<!DOCTYPE html>
<html>
<head>
	<title>.:Transaksi Setoran:.</title>
	<link rel="stylesheet" type="text/css" href="../css/styletransaksisetoran.css">
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
			<form action="" method="post" enctype="multipart/form-data" >
				<div class="judul">
					Transaksi Setoran Tunai
				</div>
				<div class="cari">
					<input type="text" name="keyword" autofocus autocomplete="off" placeholder="Masukan Nomor Rekening Anda">
					<button type="submit" name="cari">Cari</button>
				</div>
				<div class="akun">
					<?php if(isset($_POST["cari"])){ ?>
					<div class="kartu">
						<div class="kepala">
							<div class="kepala1"><h1>KARTU NASABAH</h1></div>
							<div class="kepala2"><h1>TABUNGAN MAHASISWA STMIK LEUWI PANJANG</h1></div>
							<div class="kepala3"><h2>Jl.Soekarno-Hatta No. 211 Leuwi Panjang Bandung 40235</h2></div>
							<div class="garis"><hr></div>
						</div>

						<div class="isi">
							<div class="data">
								<div class="nonasabah">No. Nasabah 	: <input type="text" name="nonasabah" value="<?php echo $mahasiswa[0]["No_Nasabah"]; ?>"><?php echo $mahasiswa[0]["No_Nasabah"]; ?> <br></div>
								<div class="nama"><input type="text" name="nama" value="<?php echo $mahasiswa[0]['Nama']; ?>" hidden>Nama 			: <?php echo $mahasiswa[0]["Nama"]; ?> <br></div>
								<div class="prodi">Prodi           : <?php  echo $mahasiswa[0]["Prodi"] ?> <br></div>
								<div class="kelas">Kelas            : <?php echo $mahasiswa[0]["Kelas"] ?></div>
								<div class="alamat">Alamat			: <?php echo $mahasiswa[0]["Alamat"]; ?> <br></div>
								<div class="saldo">Saldo            : <input type="text" name="saldoawal" value="<?php echo $mahasiswa[0]["Saldo"]; ?>"><?php echo rupiah($mahasiswa[0]["Saldo"]); ?></div>
								<div class="masukan">masukan setoran anda <input type="text" name="masuksaldo"></div>
							</div>
							<div class="foto">
								<div class="gambar"><img src="../img/<?php echo $mahasiswa[0]["Gambar"]; ?>"></div>	
							</div>
							<div class="tombol">
								<div class="tombol1"><button type="submit" name="tambah">Setor</button></div>
							</div>
						</div>
					    <?php } ?>
					</div>
				</div>
			</form>
		</div>
		<div class="footer"> &copy; Copyright 2019. Mas Opan Production</div>
	</div>
</body>
</html>