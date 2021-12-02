<?php
// session_start();

// if (!isset($_SESSION["login"])){
// 	header("Location: login.php");
// 	exit;
// }

require "fungsidatapetugas.php";

// ambil data di url
$nopetugas = $_GET["No_Petugas"];
// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM datapetugas WHERE No_Petugas = '$nopetugas' ")[0];

// koneksi ke DBMS
$conn = mysqli_connect("localhost","root","","tabungansiswa");  

//cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["ubah"])){
	

	//cek apakah data berhasil di tambahkan atau tidak
	if(ubah($_POST) > 0){
		echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'datapetugas.php';
			</script>

		";
	} else {
			echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'datapetugas.php';
			</script>

		";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>.:Edit Petugas:.</title>
	<link rel="stylesheet" type="text/css" href="../css/styleubahpetugas.css">
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
						<div class="daftar">Edit Data Admin</div>
				</div>
				<div class="mainbagian1">
					<div class="nopetugas">
						<div class="label1"><label>No. Petugas</label></div>
						<div class="input1"><input type="text" name="nopetugas" value="<?= $mhs['No_Petugas'];?>"  required></div>
					</div>
                	<div class="nama">
						<div class="label2"><label>Nama</label></div>
						<div class="input2"><input type="text" name="nama" value="<?= $mhs['Nama'];?>" required></div>
					</div>
					<div class="nim">
						<div class="label3"><label>NIM</label></div>
						<div class="input3"><input type="text" name="nim" value="<?= $mhs['NIM'];?>" required></div>
					</div>
					<div class="prodi">
						<div class="label4"><label>Prodi</label></div>
							<?php if($mhs['Prodi'] == 'Teknik Informatika - S1'){ ?>
							<select required name="prodi" >
								<?php $namajurusan = ["Teknik Informatika - S1","Teknik Informatika - D3","Kompeterisasi Akuntansi - D3","Manajemen Informatika - D3"]; ?> 
								<option disabled >Pilih Prodi</option>
								<option selected><?php echo $namajurusan[0]; ?></option>
								<option><?php echo $namajurusan[1]; ?></option>
								<option><?php echo $namajurusan[2]; ?></option>
								<option><?php echo $namajurusan[3]; ?></option>
							</select>
						    <?php } elseif ($mhs['Prodi'] == 'Teknik Informatika - D3'){ ?>
						    <select required name="prodi" >
								<?php $namajurusan = ["Teknik Informatika - S1","Teknik Informatika - D3","Kompeterisasi Akuntansi - D3","Manajemen Informatika - D3"]; ?> 
								<option disabled >Pilih Prodi</option>
								<option><?php echo $namajurusan[0]; ?></option>
								<option selected><?php echo $namajurusan[1]; ?></option>
								<option><?php echo $namajurusan[2]; ?></option>
								<option><?php echo $namajurusan[3]; ?></option>
							</select>
							<?php } elseif ($mhs['Prodi'] == 'Kompeterisasi Akuntansi - D3'){ ?>
						    <select required name="prodi" >
								<?php $namajurusan = ["Teknik Informatika - S1","Teknik Informatika - D3","Kompeterisasi Akuntansi - D3","Manajemen Informatika - D3"]; ?> 
								<option disabled >Pilih Prodi</option>
								<option><?php echo $namajurusan[0]; ?></option>
								<option><?php echo $namajurusan[1]; ?></option>
								<option selected><?php echo $namajurusan[2]; ?></option>
								<option><?php echo $namajurusan[3]; ?></option>
							</select>
							<?php } elseif ($mhs['Prodi'] == 'Manajemen Informatika - D3'){ ?>
						    <select required name="prodi" >
								<?php $namajurusan = ["Teknik Informatika - S1","Teknik Informatika - D3","Kompeterisasi Akuntansi - D3","Manajemen Informatika - D3"]; ?> 
								<option disabled >Pilih Prodi</option>
								<option><?php echo $namajurusan[0]; ?></option>
								<option><?php echo $namajurusan[1]; ?></option>
								<option><?php echo $namajurusan[2]; ?></option>
								<option selected><?php echo $namajurusan[3]; ?></option>
							</select>	
						<?php } ?>
					</div>
					<div class="kelas">
						<div class="label5"><label>Kelas</label></div>
						<?php if($mhs['Kelas'] == 'Reguler'){ ?>
						<div class='input5'><input type='radio' name='kelas' value='Reguler'  checked>Reguler
						<input type='radio' name='kelas' value='Karyawan'>Karyawan</div>
						<?php } elseif ($mhs['Kelas'] == 'Karyawan'){ ?>
						<div class='input5'><input type='radio' name='kelas' value='Reguler'>Reguler
						<input type='radio' name='kelas' value='Karyawan' checked>Karyawan</div>
						<?php } ?>
					</div>
					<div class="alamat">
						<div class="label6"><label>Alamat</label></div>
						<div class="input6"><input type="text" name="alamat" value="<?= $mhs['Alamat']?>" required></div>
					</div>
				</div>
                <div class="mainbagian2">
						<div class="gambar">
							<img id="preimage" class="image" src="../img/<?= $mhs['Gambar']?>">
							<div class="overlay overlayBottom">
								<!-- <div class="text">Pilih Gambar</div> -->
								<div class="cari"><input type="file" name="gambar" id="gambar" onchange="loadfile(event)"><label for="gambar">Pilih Gambar</label></div>
							</div>
						</div>
						<div class="kirim">
			    			<div class="tombol1"><button type="submit" name="ubah">Daftar</button></div>
			        	</div>
			        	<div class="kembali">
			    			<div class="tombol2"><button type="submit" name="kembali"><a href="datapetugas.php">Kembali</a></button></div>
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