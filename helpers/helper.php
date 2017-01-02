<?php  

// cek aja jalan aktif gak
// echo 'helper';

// function display_errors($errors){
// 	$display = '<ul class="bg-danger">';
// 	foreach($errors as $error){
// 		$display .= '<li style="text-align: center;">' .$error. '</li>';
// 	}
// 	$display .= '</ul>';
// 	return $display;
// }

// tess duplikat
function display_errors($errors){
	$display = '<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
						<h4><i class="icon fa fa-ban"></i> Alert!</h4>';
	foreach($errors as $error){
		$display .= '<p>' .$error. '</p>';
	}
	$display .= '</div>';
	return $display;
}

function sanitize($dirty){
	return htmlentities($dirty, ENT_QUOTES, "UTF-8");
}
?>