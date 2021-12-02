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

function ubahsetoran($data){
	global $conn;
	// ambil data dari kartu nasabah dan tambahkan saldonya
	$nonasabah = $data["nonasabah"];
	$saldototal = $data["saldoawal"] + $data["masuksaldo"];
	//update saldo terbaru
	$query = "UPDATE datanasabah SET
			  Saldo = '$saldototal'
			  WHERE No_Nasabah = '$nonasabah'
			  ";

	// ambil datadari kartu nasabah untuk field nomor transaksi di tabel transaksi
	$carikode = mysqli_query($conn, "SELECT max(No_Transaksi) from transaksi");
  	// menjadikannya array
  	$datakode = mysqli_fetch_assoc($carikode);
  	// jika $datakode
  	if ($datakode) {
   		$nilaikode = substr($datakode["max(No_Transaksi)"], 5);
   		// menjadikan $nilaikode ( int )
   		$kode = (int) $nilaikode;
   		// setiap $kode di tambah 1
   		$kode = $kode + 1;
   		$kode_otomatis = "TN-".date('y').str_pad($kode, 5, "0", STR_PAD_LEFT);
  	} else {
   		$kode_otomatis = "TN-".date('y')."00001";
  	}

  	// tambah data di field tanggal untuk tabel transaksi
  	$tanggal = date("Y-m-d");

  	// tambah data di field nama untuk tabel transaksi
  	$nama = $data["nama"]; 

  	// tambah data di field transaksi untuk tabel transaksi
  	$transaksi = "Debit";

  	// tambah data di field debit untuk tabel transaksi
  	$debit = $data["masuksaldo"];

  	// tambah data di field kredit untuk tabel transaksi
  	$kredit = 0;

	$query1 = "INSERT INTO transaksi 
			  VALUES
			  ('$kode_otomatis','$tanggal','$nama','$transaksi','$debit','$kredit') 
			  ";
	mysqli_query($conn,$query);
	mysqli_query($conn,$query1);
	return mysqli_affected_rows($conn);
}

function ubahpenarikan($data){
	global $conn;
	$nonasabah = $data["nonasabah"];
	// $nrp = htmlspecialchars($data["nrp"]);
	// $nama = htmlspecialchars($data["nama"]);
	// $email = htmlspecialchars($data["email"]);
	// $jurusan = htmlspecialchars($data["jurusan"]);
	// $gambarLama = htmlspecialchars($data["gambarLama"]);
	$saldototal = $data["saldoawal"] - $data["masuksaldo"];
	var_dump($saldototal);
	// 19-06-08001
	// cek apakah user memilih gambar baru atau tidak
	// if($_FILES['gambar']['error'] === 4  ){
	// 	$gambar = $gambarLama;
	// } else{
	// 	$gambar = upload();
	// }
	$query = "UPDATE datanasabah SET
			  Saldo = '$saldototal'
			  WHERE No_Nasabah = '$nonasabah'
			  ";

	// ambil datadari kartu nasabah untuk field nomor transaksi di tabel transaksi
	$carikode = mysqli_query($conn, "SELECT max(No_Transaksi) from transaksi");
  	// menjadikannya array
  	$datakode = mysqli_fetch_assoc($carikode);
  	// jika $datakode
  	if ($datakode) {
   		$nilaikode = substr($datakode["max(No_Transaksi)"], 5);
   		// menjadikan $nilaikode ( int )
   		$kode = (int) $nilaikode;
   		// setiap $kode di tambah 1
   		$kode = $kode + 1;
   		$kode_otomatis = "TN-".date('y').str_pad($kode, 5, "0", STR_PAD_LEFT);
  	} else {
   		$kode_otomatis = "TN-".date('y')."00001";
  	}

  	// tambah data di field tanggal untuk tabel transaksi
  	$tanggal = date("Y-m-d");

  	// tambah data di field nama untuk tabel transaksi
  	$nama = $data["nama"]; 

  	// tambah data di field transaksi untuk tabel transaksi
  	$transaksi = "Kredit";

  	// tambah data di field debit untuk tabel transaksi
  	$debit = 0;

  	// tambah data di field kredit untuk tabel transaksi
  	$kredit = $data["masuksaldo"];

	$query1 = "INSERT INTO transaksi 
			  VALUES
			  ('$kode_otomatis','$tanggal','$nama','$transaksi','$debit','$kredit') 
			  ";

	mysqli_query($conn,$query);
	mysqli_query($conn,$query1);
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

function cari($keyword){
	$query = "SELECT * FROM datanasabah
			  WHERE 
			  No_Rekening LIKE '%$keyword%'
			  ";
	return query($query);
}


?>
