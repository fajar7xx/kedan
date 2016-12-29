<?php 
//akses db 
require_once '../includes/koneksi.php';

include 'includes/head.php';
include 'includes/header.php';
include 'includes/nav.php';

$sql = "SELECT * FROM brand ORDER BY brand";
$result = $db->query($sql);
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