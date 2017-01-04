<?php  
require_once $_SERVER['DOCUMENT_ROOT'].'/kedan/includes/koneksi.php';
$parentID = (int)$_POST['parentID'];
$selected = sanitize($_POST['selected']);
$childQuery = $db->query("SELECT * FROM kategori WHERE parent = '$parentID' ORDER BY nm_kategori");
ob_start();
?>

<option value=""></option>
<?php while($child = mysqli_fetch_assoc($childQuery)): ?>
	<option value="<?=$child['id_kategori'];?>"<?=(($selected == $child['id_kategori'])?'selected':'');?>><?=$child['nm_kategori'];?></option>
<?php endwhile; ?>

<?php  
echo ob_get_clean();
?>