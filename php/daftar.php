<?php 

require "fungsikoneksi.php";

if(isset($_POST["register"])){
	if(registrasi($_POST) > 0){
		echo "<script>
				alert('akun anda telah didaftarkan');
				document.location.href = 'masuk.php';
		 	 </script>";
	} else{
		mysqli_error($conn);
	}
}


?>




<!DOCTYPE html>
<html>
<head>
	<title>.:Daftar:.</title>
	<link rel="stylesheet" type="text/css" href="../css/styledaftar.css">
</head>
<body>
	<div class="container">
<!-- 		<div class="header">
			<nav>
			<ul>
				<li class="logo"><a href="">Mandiri</a></li>
				<li><a href="">Home</a></li>
				<li><a href="">Data</a></li>
				<li><a href="">Transaksi</a></li>
				<li><a href="">Laporan</a></li>
				<li><a href="">Tentang Kami</a></li>
			</ul>
			</nav>
		</div> -->
		<div class="main">
			<form class="cf" action="" method="post">
				<div class="judul">
						<div class="daftar">Buat Akun Admin Tabungan Mahasiswa</div>
				</div>
				<div class="mainbagian1">
					<div class="nama">
						<div class="label1"><label>Nama</label></div>
						<div class="input1"><input type="text" name="nama"  required></div>
					</div>
					<div class="nim">
						<div class="label2"><label>NIM</label></div>
						<div class="input2"><input type="text" name="nim" required></div>
					</div>
					<div class="prodi">
						<div class="label3"><label>Prodi</label></div>
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
						<div class="label4"><label>Kelas</label></div>
						<div class="input3"><input type="radio" name="kelas" value="reguler">Reguler
						<input type="radio" name="kelas" value="karyawan">Karyawan</div>
					</div>
				</div>
                <div class="mainbagian2">
					<div class="email">
						<div class="label1"><label>Email</label></div>
						<div class="input1"><input type="email" name="email" required></div>
					</div>
					<div class="username">
						<div class="label2"><label>Username</label></div>
						<div class="input2"><input type="text" name="username"required></div>
					</div>
					<div class="password">
						<div class="label3"><label>Password</label></div>
						<div class="input3"><input type="password" name="password" required></div>
					</div>
						<div class="password2">
						<div class="label4"><label>Confirm Password</label></div>
						<div class="input4"><input type="password" name="password2" required></div>
					</div>
			    </div>
			    <div class="kirim">
			    	<div class="tombol">
			    		<div class="ok"><button type="submit" name="register">Daftar</button></div>
			    	</div>
			    	<div class="kembali">
			    		<div class="back"><button type="submit" name="kembali"><a href="masuk.php">Kembali</a></button></div>
			    	</div>
			    </div>
			</form>
		</div>
<!-- 		<div class="footer"> &copy; Copyright 2019. Mas Opan Production</div>
	</div> -->
</body>
</html>