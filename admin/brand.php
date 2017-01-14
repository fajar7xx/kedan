<?php
require_once '../includes/koneksi.php';

if(!is_logged_in()) {
	login_error_redirect();
}

// include template
include 'includes/head.php';
include 'includes/header.php';
include 'includes/nav.php';

// get brand from DB
$sql = "SELECT * FROM brand ORDER BY brand";
$result = $db->query($sql);
$errors = array();

// edit or update brand
if(isset($_GET['edit']) && !empty($_GET['edit'])){
	$edit_id = (int)$_GET['edit'];
	$edit_id = sanitize($edit_id);
	$sql2 = "SELECT * FROM brand WHERE id_brand = '$edit_id'";
	$edit_result = $db->query($sql2);
	$eBrand = mysqli_fetch_assoc($edit_result);
}

// delete Brand
if(isset($_GET['delete']) && !empty($_GET['delete'])){
	$delete_id = (int)$_GET['delete'];
	$delete_id = sanitize($delete_id);
	$sql = "DELETE FROM brand WHERE id_brand = '$delete_id'";
	$db->query($sql);
	header('Location: brand.php');
}

// if add form is submitted
if(isset($_POST['add_submit'])){
	$brand = sanitize($_POST['brand']);

	// check if brand is blank
	if($_POST['brand'] == ''){
		$errors[] .= 'Silahkan Masukkan Nama Brand!';
	}

	// check if brand exist in database
	$sql = "SELECT * FROM brand WHERE brand = '$brand'";
	if(isset($_GET['edit'])){
		$sql = "SELECT * FROM brand WHERE brand = '$brand' AND id_brand != '$edit_id'";
	}
	$result = $db->query($sql);
	$count = mysqli_num_rows($result);
	if($count > 0 ){
		$errors[] .= $brand. ' Sudah ada, silahkan input brand lain';
	}
	
	// display errors
	if(!empty($errors)){
		echo display_errors($errors);
	}
	else{
		// addd brand to db
		$sql = "INSERT INTO brand (brand) VALUES ('$brand')";
		if(isset($_GET['edit'])){
			$sql = "UPDATE brand SET brand = '$brand' WHERE id_brand = '$edit_id'";
		}
		$db->query($sql);
		header('Location: brand.php');
	}
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		Dashboard Brand
		<!-- <small>Optional description</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Your Page Content Here -->
		<!-- brand form -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Brands</h3>
			</div>
			<!-- /.box-header -->
			<!-- form start -->
			<form action="brand.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post">
				<div class="box-body">
					<?php
					$brand_value = '';
					if(isset($_GET['edit'])){
						$brand_value = $eBrand['brand'];
					}
					else{
						if(isset($_POST['brand'])){
							$brand_value = sanitize($_POST['brand']);
						}
					}
					?>
					<div class="form-group">
						<label for="brand"><?=((isset($_GET['edit']))?'Edit':'Add A'); ?>  Brand :</label>
						<input type="text"  name="brand" id="brand" class="form-control" value="<?=$brand_value; ?>">
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<input type="submit" name="add_submit" value="<?=((isset($_GET['edit']))?'Ubah':'Tambah') ;?> Brand" class="btn btn-primary">
					<?php if(isset($_GET['edit'])): ?>
					<a href="brand.php" class="btn btn-danger">Batal</a>
					<?php endif; ?>
				</div>
			</form>
		</div>
		<!-- .brand form -->
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h2 class="box-title"><i class="fa fa-list">  Brand List</i></h2>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover table-bordered table-auto">
							<tr>
								<th class="text-center"><i class="fa fa-square-o"></i></th>
								<th style="width: 80%;">Nama Brand </th>
								<th class="text-center">Edit</th>
								<th class="text-center">Delete</th>
							</tr>
							<?php $no=1; while($brand = mysqli_fetch_assoc($result)) : ?>
							<tr>
								<td class="text-center"><?= $no; $no++;?></td>
								<td><?php echo $brand['brand']; ?></td>
								<td class="text-center"><a href="brand.php?edit=<?=$brand['id_brand']; ?>" class="btn tbn-xs btn-primary"><i class="fa fa-pencil"></i></a></td>
								<td class="text-center"><a href="brand.php?delete=<?=$brand['id_brand']; ?>" class="btn tbn-xs btn-danger"><i class="fa fa-trash-o"></i></a></td>
							</tr>
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
<!-- /.content-wrapper -->
<?php
include 'includes/footer.php';
?>