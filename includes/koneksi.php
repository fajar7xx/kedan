<?php  
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

?>