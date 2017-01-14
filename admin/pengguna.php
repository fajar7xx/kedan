<?php 
//akses db 
require_once '../includes/koneksi.php';

if(!is_logged_in()) {
	login_error_redirect();
}
if(!punya_permisi('admin')){
	permisi_error_redirect('index.php');
}
include 'includes/head.php';
include 'includes/header.php';
include 'includes/nav.php';
include 'includes/contentw.php';


include 'includes/footer.php';

?>