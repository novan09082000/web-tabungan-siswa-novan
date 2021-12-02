<?php 

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

// function querya($query){
// 	global $conn;
// 	$result = mysqli_query($conn, $query);
// 	$rowas = mysqli_num_rows($result);
// 	return $rowas;
// }

function rupiah($angka){

	$hasil_rupiah = "Rp " . number_format($angka) . ",-";
	return $hasil_rupiah;

}

function cari($keyword){
	$query = "SELECT * FROM transaksi
			  WHERE 
			  Nama LIKE '$keyword'
			  ";
	return query($query);
}

function caria($keyworda,$keywordb){
	$query = "SELECT * FROM transaksi
			  WHERE 
			  Tanggal BETWEEN '$keyworda' AND '$keywordb' ORDER BY Tanggal ASC
			  ";
	return query($query);
}

// function carib($keyworda,$keywordb){
// 	$query = "SELECT * FROM transaksi
// 			  WHERE 
// 			  Tanggal BETWEEN '$keyworda' AND '$keywordb' ORDER BY Tanggal ASC
// 			  ";
// 	return querya($query);
// }

 ?>