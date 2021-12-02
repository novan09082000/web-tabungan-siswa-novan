<?php
// session_start();

// if (!isset($_SESSION["login"])){
// 	header("Location: login.php");
// 	exit;
// }

require 'fungsidatapetugas.php';  

$nopetugas = $_GET["No_Petugas"];

if( hapus($nopetugas) > 0 ){
	echo "
			<script>
				alert('data berhasil dihapus!');
				document.location.href = 'datapetugas.php';
			</script>
		";

} else{
	echo "
			<script>
				alert('data gagal dihapus!');
				document.location.href = 'datapetugas.php';
			</script>
		";
}

?>