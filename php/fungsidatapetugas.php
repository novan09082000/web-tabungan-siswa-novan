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
	$nopetugas = htmlspecialchars($data["nopetugas"]);
	$nim = htmlspecialchars($data["nim"]);
	$nama = htmlspecialchars($data["nama"]);
	$prodi = htmlspecialchars($data["prodi"]);
	$kelas = htmlspecialchars($data["kelas"]);
	$alamat = htmlspecialchars($data["alamat"]);
	// $gambar = htmlspecialchars($data["gbr"]);

	// upload gambar
	$gambar = upload();
	if(!$gambar){
		return false;
	}

	$query = "INSERT INTO datapetugas
			  VALUES 
			  ('$nopetugas','$nim','$nama','$prodi','$kelas','$alamat','$gambar')
			  ";
	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
}

function ubah($data){
	global $conn;
	$nopetugas = htmlspecialchars($data["nopetugas"]);
	$nim = htmlspecialchars($data["nim"]);
	$nama = htmlspecialchars($data["nama"]);
	$prodi = htmlspecialchars($data["prodi"]);
	$kelas = htmlspecialchars($data["kelas"]);
	$alamat = htmlspecialchars($data["alamat"]);
	//$gambar = htmlspecialchars($data["gambar"]);
	// var_dump($data["gambar"]);

	if($data["gambar"] == NULL){
		$query = "UPDATE datapetugas SET
			  NIM = '$nim',
			  Nama = '$nama', 
			  Prodi = '$prodi',
			  Kelas = '$kelas',
			  Alamat = '$alamat'
			  WHERE No_Petugas = '$nopetugas'
			  ";

	}
	else {
		$gambar = upload();
		if(!$gambar){
			return false;
	    }
	    $query = "UPDATE datapetugas SET
			  NIM = '$nim',
			  Nama = '$nama', 
			  Prodi = '$prodi',
			  Kelas = '$kelas',
			  Alamat = '$alamat',
			  Gambar = '$gambar'
			  WHERE No_Petugas = '$nopetugas'
			  ";
	}
	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
}

function upload(){
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if ($error === 4){
		echo "<script>
				alert('pilih gambar terlebih dahulu')
		      </script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar 
	$ekstensiGambarValid = ['jpg','jpeg','png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)){
			echo "<script>
				alert('yang anda upload bukan gambar!')
		      </script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if($ukuranFile > 1000000){
			echo "<script>
				alert('ukuran gambar terlalu besar!')
		      </script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, '../img/' . $namaFileBaru);

	return $namaFileBaru;

}

function hapus($nopetugas){
	global $conn;
	mysqli_query($conn,"DELETE FROM datapetugas WHERE No_Petugas = '$nopetugas'");

	return mysqli_affected_rows($conn);
}

?>
