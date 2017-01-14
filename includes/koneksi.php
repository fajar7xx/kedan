<?php  
// init.php kata youtube
// file konfigurasi php koneksi ke database
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "kedan";

// mealkukan koneksi ke database
$db = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

// cek jika ada kesalahan koneksi
if(mysqli_connect_errno()){
	echo 'Database connection failed with following errors: '.mysqli_connect_error();
	die();
}
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/kedan/config.php';
require_once BASEURL. 'helpers/helper.php';

if(isset($_SESSION['SBuser'])){
	$user_id = $_SESSION['SBuser'];
	$query = $db->query("SELECT * FROM user WHERE id_user='$user_id'");
	$user_data = mysqli_fetch_assoc($query);
	$nl = explode(' ', $user_data['nama_lengkap']);
	$user_data['pertama']= $nl[0];
	$user_data['terakhir']=$nl[1];
}

if(isset($_SESSION['sukses_flash'])){
	echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['sukses_flash'].'</p></div>';
	unset($_SESSION['sukses_flash']);
}

if(isset($_SESSION['error_flash'])){
	echo '<div class="bg-danger"><p class="text-danger text-center">'.$_SESSION['error_flash'].'</p></div>';
	unset($_SESSION['error_flash']);
}


?>