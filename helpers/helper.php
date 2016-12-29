<?php  

// cek aja jalan aktif gak
// echo 'helper';

function display_errors($errors){
	$display = '<ul class="bg-danger">';
	foreach ($errors as $error) {
		$display = '<li class="text-danger"><center>'.$error.'</center></li>';
	}
	$display .= '</ul>';
	return $display;
}

function sanitize($dirty){
	return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}
?>