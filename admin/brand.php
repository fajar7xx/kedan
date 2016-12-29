<?php 
//akses db 
require_once '../includes/koneksi.php';

// include template
include 'includes/head.php';
include 'includes/header.php';
include 'includes/nav.php';

// get brand from DB
$sql = "SELECT * FROM brand ORDER BY brand";
$result = $db->query($sql);
$errors = array();

// if add form is submitted
if(isset($_POST['add_submit'])){
	$brand = sanitize($_POST['brand']);
	// check if brand is blank
	if($_POST['brand'] == ''){
		$errors[] .= 'Masukkan Nama Brand';
	}
	// check if brand exist in dbuser
	$sql = "SELECT * FROM brand WHERE brand = '$brand'";
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
			<form role="form" action="brand.php" method="post">
				<div class="box-body">
					<div class="form-group">
						<label for="brand">Add A Brand :</label>
						<input type="text" class="form-control" id="brand" name="brand"value="<?=((isset($_POST['brand']))?$_POST['brand']:''); ?>">
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<input type="submit" class="btn btn-primary" name="add_submit" value="Add Brand">
				</div>
			</form>
		</div>
		<!-- .brand form -->

		<table class="table table-striped table-bordered table-auto" cellspacing="0" width="100%">
			<thead>
				<th></th>
				<th>Brands</th>
				<th></th>
			</thead>
			<tbody>
				<?php while($brand = mysqli_fetch_assoc($result)) : ?>
					<tr> 
						<td><a href="brand.php?edit=<?php echo $brand['id_brand']; ?>" class="btn tbn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
						<td><?php echo $brand['brand']; ?></td>
						<td><a href="brand.php?delete=<?php echo $brand['id_brand']; ?>" class="btn tbn-xs btn-default"><i class="fa fa-remove"></i></a></td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
include 'includes/footer.php';
?>