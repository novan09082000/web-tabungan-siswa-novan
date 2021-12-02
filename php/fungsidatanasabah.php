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
	$nonasabah = htmlspecialchars($data["nonasabah"]);
	$norekening = htmlspecialchars($data["norekening"]);
	$nim = htmlspecialchars($data["nim"]);
	$nama = htmlspecialchars($data["nama"]);
	$prodi = htmlspecialchars($data["prodi"]);
	$kelas = htmlspecialchars($data["kelas"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$saldo = htmlspecialchars($data["saldo"]); 
	// $gambar = htmlspecialchars($data["gbr"]);

	// upload gambar
	$gambar = upload();
	if(!$gambar){
		return false;
	}

	$query = "INSERT INTO datanasabah
			  VALUES 
			  ('$nonasabah','$norekening','$nim','$nama','$prodi','$kelas','$alamat','$saldo','$gambar')
			  ";
	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
}

function ubah($data){
	global $conn;
	$nonasabah = htmlspecialchars($data["nonasabah"]);
	$norekening = htmlspecialchars($data["norekening"]);
	$nim = htmlspecialchars($data["nim"]);
	$nama = htmlspecialchars($data["nama"]);
	$prodi = htmlspecialchars($data["prodi"]);
	$kelas = htmlspecialchars($data["kelas"]);
	$alamat = htmlspecialchars($data["alamat"]);
	// $saldo = htmlspecialchars($data["saldo"]); 
	//$gambar = htmlspecialchars($data["gbr"]);

	if($data["gambar"] == NULL){
		$query = "UPDATE datanasabah SET
			  NIM = '$nim',
			  Nama = '$nama', 
			  Prodi = '$prodi',
			  Kelas = '$kelas',
			  Alamat = '$alamat'
			  WHERE No_Nasabah = '$nonasabah'
			  ";	
	} 
	else {

		$gambar = upload();
		if(!$gambar){
			return false;
		}

		$query = "UPDATE datanasabah SET
			  NIM = '$nim',
			  Nama = '$nama', 
			  Prodi = '$prodi',
			  Kelas = '$kelas',
			  Alamat = '$alamat',
			  Gambar = '$gambar'
			  WHERE No_Nasabah = '$nonasabah'
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

function hapus($nonasabah){
	global $conn;
	mysqli_query($conn,"DELETE FROM datanasabah WHERE No_Nasabah = '$nonasabah'");

	return mysqli_affected_rows($conn);
}

function rupiah($angka){

	$hasil_rupiah = "Rp " . number_format($angka) . ",-";
	return $hasil_rupiah;

}

// function kode($datakode){
// 	// global $conn;
// 	// jika $datakode
// 	if($datakode){
// 		$nilaikode = substring($datakode,5);
// 		$kode = (int) $nilaikode;
// 		// setiap $kode di tambah 1
// 		$kode = $kode + 1;
// 		$kode_otomatis = "NT-".date('y').str_pad($kode,5,"0",STR_PAD_LEFT);
// 	} else{
// 		$kode_otomatis = "NT-".date('y')."00001";
// 	}
// 	return $kode_otomatis;
// }

?>