<?php
require "fungsidatanasabah.php";

// koneksi ke DBMS
$conn = mysqli_connect("localhost","root","","tabungansiswa"); 


//cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["tambah"])){
	

	//cek apakah data berhasil di tambahkan atau tidak
	if(tambah($_POST) > 0){
		echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'datanasabah.php';
			</script>

		";
	} else {
		echo "
		 	<script>
		 		alert('data gagal ditambahkan!');
		 		document.location.href = 'datanasabah.php';
		 	</script>

		 ";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>.:Daftar:.</title>
	<link rel="stylesheet" type="text/css" href="../css/styletambahnasabah.css">
</head>
<body>
	<div class="container">
		<!-- <div class="header">
			<nav>
			<ul>
				<li class="logo"><a href="">Mandiri</a></li>
				<li><a href="">Home</a></li>
				<li><a href="">Data</a></li>
				<li><a href="">Pelayanan</a></li>
				<li><a href="">Tentang Kami</a></li>
			</ul>
			</nav>
		</div> -->
		<div class="main">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="judul">
						<div class="daftar">Daftar Nasabah Baru</div>
				</div>
				<div class="mainbagian1">
					<div class="nonasabah">
						<div class="label1"><label>No. Nasabah</label></div>
						<div class="input1"><input type="text" name="nonasabah" value="" required></div>
					</div>
					<div class="norekening">
						<div class="label2"><label>No.Rekening</label></div>
						<div class="input2"><input type="text" name="norekening"  required></div>
					</div>
                	<div class="nama">
						<div class="label3"><label>Nama</label></div>
						<div class="input3"><input type="text" name="nama"  required></div>
					</div>
					<div class="nim">
						<div class="label4"><label>NIM</label></div>
						<div class="input4"><input type="text" name="nim" required></div>
					</div>
					<div class="prodi">
						<div class="label5"><label>Prodi</label></div>
							<select required name="prodi">
								<?php $namajurusan = ["Teknik Informatika - S1","Teknik Informatika - D3","Kompeterisasi Akuntansi - D3","Manajemen Informatika - D3"]; ?> 
								<option disabled selected value="">Pilih Prodi</option>
								<option><?php echo $namajurusan[0]; ?></option>
								<option><?php echo $namajurusan[1]; ?></option>
								<option><?php echo $namajurusan[2]; ?></option>
								<option><?php echo $namajurusan[3]; ?></option>
							</select>
					</div>
					<div class="kelas">
						<div class="label6"><label>Kelas</label></div>
						<div class="input6"><input type="radio" name="kelas" value="Reguler">Reguler
						<input type="radio" name="kelas" value="Karyawan">Karyawan</div>
					</div>
					<div class="alamat">
						<div class="label7"><label>Alamat</label></div>
						<div class="input7"><input type="text" name="alamat" required></div>
					</div>
					<div class="saldo">
						<div class="label8"><label>Setoran Awal</label></div>
						<div class="input8"><input type="text" name="saldo" value="0" required></div>
					</div>
				</div>
                <div class="mainbagian2">
						<div class="gambar">
							<img id="preimage" class="image">
							<div class="overlay overlayBottom">
								<!-- <div class="text">Pilih Gambar</div> -->
								<div class="cari"><input type="file" name="gambar" id="gambar" onchange="loadfile(event)" required><label for="gambar">Pilih Gambar</label></div>
							</div>
						</div>
						<div class="kirim">
			    			<div class="tombol1"><button type="submit" name="tambah">Daftar</button></div>
			        	</div>
			        	<div class="kembali">
			    			<div class="tombol2"><button type="submit" name="kembali"><a href="datanasabah.php">Kembali</a></button></div>
			        	</div>
					</div>
					<!-- <div class="password">
						<div class="label2"><label>Password</label></div>
						<div class="input2"><input type="password" name="" required></div>
					</div> -->
	                
			    </div>
			</form>
		</div>
		<!-- <div class="footer"> &copy; Copyright 2019. Mas Opan Production</div> -->
	</div>

	<script type="text/javascript">
		function loadfile(event){
			var output = document.getElementById('preimage');
			output.src = URL.createObjectURL(event.target.files[0]);
		};
	</script>
</body>
</html>