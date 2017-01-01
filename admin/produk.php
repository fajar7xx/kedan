<?php
// require database
require_once $_SERVER['DOCUMENT_ROOT'].'/kedan/includes/koneksi.php';

// require rupiah file
require_once $_SERVER['DOCUMENT_ROOT'].'/kedan/includes/rupiah.php';

// include template
include 'includes/head.php';
include 'includes/header.php';
include 'includes/nav.php';

if(isset($_GET['add'])){
	$brandQuery = $db->query("SELECT * FROM brand ORDER BY brand");
	$parentQuery = $db->query("SELECT * FROM kategori WHERE parent = 0 ORDER BY nm_kategori");
?>
	
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
  		<!-- Content Header (Page header) -->
  		<section class="content-header">
    		<h1>Dashboard Tambah Produk</h1>
    		<ol class="breadcrumb">
      			<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      			<li class="active">Here</li>
    		</ol>
  		</section>
  		<!-- Main content -->
  		<section class="content">
    		<!-- Your Page Content Here -->
    		<!-- Horizontal Form -->
          	<div class="box box-info">
            	<div class="box-header with-border">
             	 	<h3 class="box-title">Tambah Produk</h3>
            	</div>
            	<!-- /.box-header -->
            	<!-- form start -->
            	<form action="produk.php?add=1" method="post" enctype="multipart/form-data">
           		   	<div class="box-body">	
	            		<div class="form-group col-md-6">
	            			<label for="nama_produk">Nama Produk*:</label>
	            			<input type="text" class="form-control" name="nama_produk" id="nama_produk" value="<?=((isset($_POST['nama_produk']))?sanitize($_POST['nama_produk']):'');?>">
	            		</div>
	            		<div class="form-group col-md-6">
	            			<label for="brand">Brand*:</label>
							<select class="form-control select2" id="brand" name="brand">
								<option value="" <?=((isset($_POST['brand']) && $_POST['brand'] == '')?'selected':'');?>> &nbsp; </option>
								<?php while($brand = mysqli_fetch_assoc($brandQuery)): ?>
									<option value="<?=$brand['id_brand']; ?>" <?=((isset($_POST['brand']) && $_POST['brand'] == $brand['id_brand'] )?'selected':'');?> ><?=$brand['brand'];?></option>
								<?php endwhile; ?>
							</select>
	            		</div>
	            		<div class="form-group col-md-6">
	            			<label for="parent">Parent Kategori*:</label>
	            			<select class="form-control select2" id="parent" name="parent">
	            				<option value=""<?=((isset($_POST['parent']) && $_POST['parent'] == '')?'selected':'');?>> &nbsp; </option>
								<?php while($parent = mysqli_fetch_assoc($parentQuery)): ?>
									<option value="<?=$parent['id_kategori'];?>"<?=((isset($_POST['parent']) && $_POST['parent'] == $parent['id_kategori'])?'selected':'');?>><?=$parent['nm_kategori'];?></option>
								<?php endwhile; ?>
	            			</select> 
	            		</div>
	            		<div class="form-group col-md-6">
	            			<label for="child">Child Kategori*:</label>
	            			<select name="child" id="child" class="form-control">
	            				<!-- <option value=""></option>
	            				<option value=""></option> -->
	            			</select>
	            		</div>
              		</div>
              		<!-- /.box-body -->
              		<div class="box-footer">
              			<div class="pull-right">
	            			<button type="submit" class="btn btn-primary">Simpan</button> &nbsp;
               			 	<a href="produk.php" class="btn btn-danger">Batal</a>
               			</div>
             		 </div>
              		<!-- /.box-footer -->
            	</form>
          </div>
          <!-- /.box -->
  		</section>
 		 <!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	
<?php
}
else{
	// akses datbase lagi
	$sql = "SELECT * FROM produk WHERE deleted = 0";
	$presult = $db->query($sql);
	if(isset($_GET['featured'])){
		$id = (int)$_GET['id'];
		$featured = (int)$_GET['featured'];
		$featuredSql = "UPDATE produk SET featured = '$featured' WHERE id_produk ='$id'";
		$db->query($featuredSql);
		header('Location: produk.php');
	}
	?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
	  		<h1>Dashboard Produk</h1>
	  		<ol class="breadcrumb">
	    		<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
	    		<li class="active">Here</li>
	  		</ol>
		</section>

		<!-- Main content -->
		<section class="content">
	  	<!-- Your Page Content Here -->
		
			<!-- tabel list produk -->
		    <div class="row">
	        	<div class="col-xs-12">
	          		<div class="box box-primary">
	           		 	<div class="box-header">
	             		 	<h3 class="box-title">Daftar Produk</h3>
	              			<div class="box-tools">
	                			<a href="produk.php?add=1" class="btn btn-md btn-primary"><i class="fa fa-plus-circle"></i>&nbsp; Tambah Produk</a>
	                			<div class="clearfix"></div>
	        	      		</div>
	            		</div><br>
	            		<!-- /.box-header -->

		            	<div class="box-body table-responsive no-padding">
			            	<table class="table table-hover table-bordered table-auto">
				               	<tr>
				                  <th style="text-align: center; width: 3%;"><i class="fa fa-square-o"></i></th>
				                  <th style="width: 30%;">Nama Produk</th>
				                  <th style="width: 10%;">Harga</th>
				                  <th style="width: 15%;">Parent - Kategori</th>
				                  <th style="width: 12%;">Featured</th>
				                  <th style="width: 10%;">Sold</th>
				                  <th style="text-align: center; width: 5%;">Edit</th>
				                  <th style="text-align: center; width: 5%;">Delete</th>
				                </tr>
								<?php while($produk = mysqli_fetch_assoc($presult)):
									// to get child
									$childID = $produk['produk_kategori'];
									$catSql = "SELECT * FROM kategori WHERE id_kategori = '$childID'";
									$result = $db->query($catSql);
									$child = mysqli_fetch_assoc($result);
									// to get parent
									$parentID = $child['parent'];
									$pSql = "SELECT * FROM kategori WHERE id_kategori='$parentID'";
									$presults = $db->query($pSql);
									$parent = mysqli_fetch_assoc($presults);

									$kategori = $parent['nm_kategori']. ' - ' .$child['nm_kategori'];
								?>
					                <tr>
						            	<td style="text-align: center;"><i class="fa fa-square-o"></i></td>
						            	<td><?= $produk['nm_produk'];?></td>
						            	<td><?= rupiah($produk['harga']);?></td>
						            	<td><?=$kategori;?></td>
						            	<td>
						            		<a href="produk.php?featured=<?=(($produk['featured'] == 0)?'1':'0');?>&id=<?=$produk['id_produk'];?>" class="btn tbn-xs btn-warning">
						            			<span class="fa fa-<?=(($produk['featured'] == 1)?'minus':'plus');?>-square"></span>
						            		</a>
						            		&nbsp <?=(($produk['featured'] == 1)?'Featured':'');?>
						            	</td>
						            	<td>0</td> 
						            	<td class="text-center"><a href="produk.php?edit=<?=$produk['id_produk'];?>" class="btn tbn-xs btn-primary"><i class="fa fa-pencil"></i></a></td>
										<td class="text-center"><a href="produk.php?delete=<?=$produk['id_produk'];?>" class="btn tbn-xs btn-danger"><i class="fa fa-trash-o"></i></a></td>
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

<?php }
// include template
include 'includes/footer.php';
?>