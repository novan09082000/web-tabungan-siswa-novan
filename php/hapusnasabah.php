<?php
// session_start();

// if (!isset($_SESSION["login"])){
// 	header("Location: login.php");
// 	exit;
// }

require 'fungsidatanasabah.php';  

$nonasabah = $_GET["No_Nasabah"];

if( hapus($nonasabah) > 0 ){
	echo "
			<script>
				alert('data berhasil dihapus!');
				document.location.href = 'datanasabah.php';
			</script>
		";

} else{
	echo "
			<script>
				alert('data gagal dihapus!');
				document.location.href = 'datanasabah.php';
			</script>
		";
}

?>