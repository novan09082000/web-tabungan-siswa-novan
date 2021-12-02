<?php  

//koneksi ke database
$conn = mysqli_connect("localhost","root","","tabungansiswa");

function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data){
	global $conn;
	$nrp = htmlspecialchars($data["nrp"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspesialchars($data["email"]);
	$jurusan = htmlspesialchars($data["jurusan"]);
	$gambar = htmlspesialchars($data["gambar"]);

	$query = "INSERT INTO mahasiswa
			  VALUES 
			  ('','$nrp','$nama','$email','$jurusan','$gambar')
			  ";
	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
}

function hapus($id){
	global $conn;
	mysqli_query($conn,"DELETE FROM mahasiswa WHERE id = $id");

	return mysqli_affected_rows($conn);
}

function ubah($data){
	global $conn;
	$id = $data["id"];
	$nrp = htmlspecialchars($data["nrp"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	// cek apakah user memilih gambar baru atau tidak
	if($_FILES['gambar']['error'] === 4  ){
		$gambar = $gambarLama;
	} else{
		$gambar = upload();
	}



	$query = "UPDATE mahasiswa SET
			  nrp = '$nrp',
			  nama = '$nama', 
			  email = '$email',
			  jurusan = '$jurusan',
			  gambar = '$gambar'
			  WHERE id = $id
			  ";
	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
}

function rupiah($angka){

	$hasil_rupiah = "Rp " . number_format($angka) . ",-";
	return $hasil_rupiah;

}

function registrasi($data){
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn,$data["password"]);
	$password2 = mysqli_real_escape_string($conn,$data["password2"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($conn,"SELECT username FROM akunpetugas WHERE username = '$username'");
	if (mysqli_fetch_assoc($result)){
		echo "<script>
				alert('username sudah terdaftar!');
			  </script>";
		return false;
	}


	// cek apakah Akun Petugas sesuai dengan Data Petugas
	$nama = htmlspecialchars($data["nama"]);
	$nim = htmlspecialchars($data["nim"]);
	$prodi = htmlspecialchars($data["prodi"]);
	$kelas = $data["kelas"];
	$email = htmlspecialchars($data["email"]);

	
	$result2 = mysqli_query($conn,"SELECT NIM FROM datapetugas WHERE NIM = '$nim'");
	$row2 = mysqli_fetch_assoc($result2);
	if( $row2["NIM"] !== $nim ){
		echo "<script>
				alert('anda belum mendaftar data anda ke admin!');
			  </script>";
		return false;
	}
	// cek konfirmasi password
	if($password !== $password2){
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
			  </script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);


	//tambahkan userbaru ke database
	mysqli_query($conn,"INSERT INTO akunpetugas VALUES('$nim','$nama','$prodi','$kelas','$email','$username','$password')");
	echo "$nim, $nama, $prodi, $kelas, $email, $username, $password";
	return mysqli_affected_rows($conn);
}
?>