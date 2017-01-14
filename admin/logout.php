<?php  
// require database
require_once $_SERVER['DOCUMENT_ROOT'].'/kedan/includes/koneksi.php';
unset($_SESSION['SBuser']);
header('Location: login.php');
?>