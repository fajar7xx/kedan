<?php 
// requirece databas 
require_once $_SERVER['DOCUMENT_ROOT'].'/kedan/includes/koneksi.php';

if(!is_logged_in()) {
	login_error_redirect();
}

// include template
include 'includes/head.php';
include 'includes/header.php';
include 'includes/nav.php';

// kategori.php algoritma
$sql = "SELECT * FROM kategori WHERE parent = 0";
$result = $db->query($sql);
$errors = array();
$kategori = '';
$post_parent = '';

// edit kategori
if(isset($_GET['edit']) && !empty($_GET['edit'])){
	$edit_id = (int)$_GET['edit'];
	$edit_id = sanitize($edit_id);
	$edit_sql = "SELECT * FROM kategori WHERE id_kategori = '$edit_id'";
	$edit_result = $db->query($edit_sql);
	$edit_kategori = mysqli_fetch_assoc($edit_result);
}

// delete categories
if(isset($_GET['delete']) && !empty($_GET['delete'])){
	$delete_id = (int)$_GET['delete'];
	sanitize($delete_id);
	$sql = "SELECT * FROM kategori WHERE id_kategori = '$delete_id'";
	$result = $db->query($sql);
	$kategori = mysqli_fetch_assoc($result);
	if($kategori['parent'] == 0){
		$sql = "DELETE FROM kategori WHERE parent = '$delete_id'";
		$db->query($sql);
	}
	$dsql = "DELETE FROM kategori WHERE id_kategori = '$delete_id'";
	$db->query($dsql);
	header('Location: kategori.php');
}

// process form
if(isset($_POST) && !empty($_POST)){
	$post_parent =  sanitize($_POST['parent']);
	$kategori = sanitize($_POST['kategori']);
	$sqlForm = "SELECT * FROM kategori WHERE nm_kategori = '$kategori' AND parent = '$post_parent'";
	if(isset($_GET['edit'])){
		$id = $edit_kategori['id_kategori'];
		$sqlForm = "SELECT * FROM kategori WHERE nm_kategori = '$kategori' AND parent='$post_parent' AND id_kategori != '$id'";
	}
	$fresult = $db->query($sqlForm);
	$count = mysqli_num_rows($fresult);

	// if kategori is blank
	if($kategori == ''){
		$errors[] .= 'Kategori tidak boleh kosong. silahkan isikan';
	}

	//if exist in database
	if($count > 0){
		$errors[] .= $kategori. 'Sudah ada. Silahkan Pilih Kategori Baru';
	}

	// display error or update database
	if(!empty($errors)){
		// display errors
		$display = display_errors($errors); ?>
			
		<script>
			JQuery('document').ready(function(){
				JQuery('#errorz').html('<?=$display; ?>');
			});
		</script>

	<?php
	}
	else{
		// update database
		$updateSql = "INSERT INTO kategori (nm_kategori, parent) VALUES ('$kategori','$post_parent')";
		if(isset($_GET['edit'])){
			$updateSql = "UPDATE kategori SET nm_kategori = '$kategori', parent='$post_parent' WHERE id_kategori='$edit_id'";
		}
		$db->query($updateSql);
		Header('Location: kategori.php');
		
	}
}

$kategori_value = '';
$parent_value = 0;
if(isset($_GET['edit'])){
	$kategori_value = $edit_kategori['nm_kategori'];
	$parent_value = $edit_kategori['parent'];
}
else{
	if(isset($_POST)){
		$kategori_value =  $kategori;
		$parent_value = $post_parent;
	}
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	 	<h1>Dashboard Kategori</h1>
	  	<ol class="breadcrumb">
	 		<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
	    	<li class="active">Here</li>
	  	</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Your Page Content Here -->
		<!-- brand form -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><?= ((isset($_GET['edit']))?'Ubah':'Tambahkan');  ?> Kategori</h3>
			</div>
			<!-- /.box-header -->

			<!-- form start -->
			<form role="form" action="kategori.php<?=((isset($_GET['edit']))?'?edit='.$edit_id :''); ?>" method="post">
				<div id="errorz"></div>
				<div class="box-body">
					<div class="form-group">
						<label for="parent">Parent</label>
						<select class="form-control" name="parent" id="parent">
							<option value="0"<?=(($parent_value == 0)?'selected="selected"':'');?>>Parent</option>
							<?php while($parent = mysqli_fetch_assoc($result)): ?>
								<option value="<?=$parent['id_kategori'];?>"<?=(($parent_value == $parent['id_kategori'])?' selected="selected"':'');?>><?=$parent['nm_kategori'];?></option>
							<?php endwhile; ?>
						</select><br>
						<label for="kategori">Kategori</label>
						<input type="text"  name="kategori" id="kategori" class="form-control" value="<?=$kategori_value; ?>">
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<input type="submit" value="<?=((isset($_GET['edit']))?'Ubah':'Tambah');?> Kategori" class="btn btn-primary">
					<?php if(isset($_GET['edit'])): ?>
						<a href="kategori.php" class="btn btn-danger">Batal</a>
					<?php endif; ?>
				</div>
			</form>
		</div>
		<!-- .brand form -->

		<!-- list kategori -->
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
						<h2 class="box-title"><i class="fa fa-list">Category List</i></h2>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover table-bordered table-auto">
							<tr>
								<th>Kategori</th>
								<th>Parent</th>
								<th class="text-center" style="width: 10%;">Edit</th>
								<th class="text-center" style="width: 10%;">Delete</th>
							</tr>
							<?php
							$sql = "SELECT * FROM kategori WHERE parent = 0";
							$result = $db->query($sql);
							while($parent = mysqli_fetch_assoc($result)):
								$parent_id = (int)$parent['id_kategori']; 
								$sql2 = "SELECT * FROM kategori WHERE parent = '$parent_id'";
								$cresult = $db->query($sql2);
							?>
								<tr class="bg-info">
									<td><?=$parent['nm_kategori']; ?></td>
									<td>Parent</td>
									<td class="text-center"><a href="kategori.php?edit=<?=$parent['id_kategori']; ?>" class="btn tbn-xs btn-primary"><i class="fa fa-pencil"></i></a></td>
									<td class="text-center"><a href="kategori.php?delete=<?=$parent['id_kategori']; ?>" class="btn tbn-xs btn-danger"><i class="fa fa-trash-o"></i></a></td>	
								</tr> 
								<?php while($child = mysqli_fetch_assoc($cresult)): ?>
									<tr>
										<td><?=$child['nm_kategori']; ?></td>
										<td><?=$parent['nm_kategori'];  ?></td>
										<td class="text-center"><a href="kategori.php?edit=<?=$child['id_kategori']; ?>" class="btn tbn-xs btn-primary"><i class="fa fa-pencil"></i></a></td>
										<td class="text-center"><a href="kategori.php?delete=<?=$child['id_kategori']; ?>" class="btn tbn-xs btn-danger"><i class="fa fa-trash-o"></i></a></td>	
									</tr>
								<?php endwhile; ?>
							<?php endwhile; ?>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>


<?php
// include template
include 'includes/footer.php';
?>