<?php 
function rupiah($nilai){
	// return echo "Rp " .number_format($nilai,0,",",".");
	$desimal =  number_format($nilai,0,",",".");
	$rupiah = "Rp " .$desimal;
	return $rupiah;
}

?>