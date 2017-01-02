<?php  
// require database
require_once $_SERVER['DOCUMENT_ROOT'].'/kedan/includes/koneksi.php';

// require rupiah file
require_once $_SERVER['DOCUMENT_ROOT'].'/kedan/includes/rupiah.php';

//include theme for produk-view
include 'theme/head.php';
include 'theme/produk-view-nav.php';
include 'theme/product-view-body.php';

include 'theme/footer.php';
?>