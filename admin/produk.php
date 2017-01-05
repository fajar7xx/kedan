<?php
// require database
require_once $_SERVER['DOCUMENT_ROOT'].'/kedan/includes/koneksi.php';

// require rupiah file
require_once $_SERVER['DOCUMENT_ROOT'].'/kedan/includes/rupiah.php';

// include template
include 'includes/head.php';
include 'includes/header.php';
include 'includes/nav.php';

$pathDb = '';
if(isset($_GET['add']) || isset($_GET['edit'])){
	$brandQuery = $db->query("SELECT * FROM brand ORDER BY brand");
	$parentQuery = $db->query("SELECT * FROM kategori WHERE parent = 0 ORDER BY nm_kategori");
	$nama_produk = ((isset($_POST['nama_produk']) && $_POST['nama_produk'] != '')?sanitize($_POST['nama_produk']):'');
	$brand = ((isset($_POST['brand']) && !empty($_POST['brand']))?sanitize($_POST['brand']):'');
	$parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):'');
	$kategoriCat = ((isset($_POST['child']) && !empty($_POST['child']))?sanitize($_POST['child']):'');
	$harga = ((isset($_POST['harga']) && $_POST['harga'] != '')?sanitize($_POST['harga']):'');
	$list_harga = ((isset($_POST['list_harga']) && $_POST['list_harga'] != '')?sanitize($_POST['list_harga']):'');
	$deskripsi = ((isset($_POST['deskripsi']) && $_POST['deskripsi'] != '')?sanitize($_POST['deskripsi']):'');
	$ukuran = ((isset($_POST['ukuran']) && $_POST['ukuran'] != '')?sanitize($_POST['ukuran']):'');
	$ukuran = rtrim($ukuran,',');
	$simpan_gambar = '';
	// $ukuranArray = array();

	if(isset($_GET['edit'])){
		$edit_id=(int)$_GET['edit'];
		$produkResult = $db->query("SELECT * FROM produk WHERE id_produk = '$edit_id'");
		$produk = mysqli_fetch_assoc($produkResult);
		if(isset($_GET['hapus_gambar'])){
			$gambar_url = $_SERVER['DOCUMENT_ROOT'].$produk['image'];
			echo $gambar_url;
			unlink($gambar_url);
			$db->query("UPDATE produk SET image ='' WHERE id_produk='$edit_id'");
			header('Location: produk.php?edit='.$edit_id);
		}
		$kategoriCat = ((isset($_POST['child']) && $_POST['child'] != '')?sanitize($_POST['child']):$produk['produk_kategori']);
		$nama_produk = ((isset($_POST['nama_produk']) && $_POST['nama_produk'] != '')?sanitize($_POST['nama_produk']):$produk['nm_produk']);
		$brand = ((isset($_POST['brand']) && $_POST['brand'] != '')?sanitize($_POST['brand']):$produk['brand']);
		$parentQuery1=$db->query("SELECT * FROM kategori WHERE id_kategori ='$kategoriCat'");
		$parentResult = mysqli_fetch_assoc($parentQuery1);
		$parent = ((isset($_POST['parent']) && $_POST['parent'] != '')?sanitize($_POST['parent']):$parentResult['parent']);
		$harga = ((isset($_POST['harga']) && $_POST['harga'] != '')?sanitize($_POST['harga']):$produk['harga']);
		$list_harga = ((isset($_POST['list_harga']) && $_POST['list_harga'] != '')?sanitize($_POST['list_harga']):$produk['list_harga']);
		$deskripsi = ((isset($_POST['deskripsi']) && $_POST['deskripsi'] != '')?sanitize($_POST['deskripsi']):$produk['deskripsi']);
		$ukuran = ((isset($_POST['ukuran']) && $_POST['ukuran'] != '')?sanitize($_POST['ukuran']):$produk['ukuran']);
		$ukuran = rtrim($ukuran,',');
		$simpan_gambar = (($produk['image'] != '')?$produk['image']:'');
		$pathDb = $simpan_gambar;
	}
	if(!empty($ukuran)){
			$ukuranString = sanitize($ukuran);
			$ukuranString = rtrim($ukuranString,',');
			// echo  $ukuranString;
			$ukuranArray = explode(',',$ukuranString);
			$uArray = array();
			$qArray = array();
			foreach($ukuranArray as $ss){
				$s = explode(':', $ss);
				$uArray[]= $s[0];
				$qArray[]=$s[1];
			}
		}
		else{
			$ukuranArray = array();
		}
	if($_POST){
		// sterilkan dari atribut gila html 
		// $kategori = sanitize($_POST['child']);
		// $harga = sanitize($_POST['harga']);
		// $list_harga = sanitize($_POST['list_harga']);
		// $ukuran = sanitize($_POST['ukuran']);
		// $deskripsi = sanitize($_POST['deskripsi']);
		$pathDb = '';
		$errors = array();
		$wajib = array('nama_produk','brand','parent','child','harga','ukuran');
		foreach($wajib as $field){
			if($_POST[$field] == ''){
				$errors[]='field Wajib Di isi. silahkan isi filed yang kosong';
				break;
			}
		}
		if(!empty($_FILES)){
			// hanya unutk menampilkan bahwa $_FILES berjalan
			// var_dump($_FILES);
			// cek ekstensi untuk yang bisa di input hanya gambar
			$photo = $_FILES['photo'];
			$nama = $photo['name'];
			$namaArray = explode('.',$nama);
			$namaFile = $namaArray[0];
			$ekstensiFile = $namaArray[1];
			$mime = explode('/',$photo['type']);
			$mimeType = $mime[0];
			$mimeExt = $mime[1];
			$tmpLok = $photo['tmp_name'];
			$ukuranFile = $photo['size'];
			$allowed = array('png','jpg','jpeg','gif');
			$namaUpload = md5(microtime()).'.'.$ekstensiFile;
			$lokasiUploadPath = BASEURL.'img/product/'.$namaUpload;
			$pathDb = '/kedan/img/product/'.$namaUpload;  
			if($mimeType != 'image'){
				$errors[] = 'File Harus berbentuk Image';
			}
			if(!in_array($ekstensiFile, $allowed)){
				$errors[] = 'Photo Harus berformat png, jpg/jpeg atau gif.';
			}
			if($ukuranFile > 2000000){
				$errors[]= 'Ukuran file harus dibawah 2MB.';
			}
			if($ekstensiFile != $mimeExt && ($mimeExt == 'jpeg' && $ekstensiFile != 'jpg')){
				$errors[]='Ekstensi file tidak sesuai dengan ketentuan. ';
			}
		}
		if(!empty($errors)){
			echo display_errors($errors);
		}
		else{
			//upload file and insert into database
			move_uploaded_file($tmpLok,$lokasiUploadPath);
			$masukkanSql = "INSERT INTO produk (`nm_produk`,`harga`,`list_harga`,`brand`,`produk_kategori`,`ukuran`,`image`,`deskripsi`) VALUES ('$nama_produk','$harga','$list_harga','$brand','$kategoriCat','$ukuran','$pathDb','$deskripsi')";
			if(isset($_GET['edit'])){
				$masukkanSql = "UPDATE produk SET nm_produk = '$nama_produk', harga='$harga', list_harga='$list_harga', brand='$brand', produk_kategori='$kategoriCat', ukuran='$ukuran', image='$pathDb' deskripsi='$deskripsi' WHERE id_produk='$edit_id'";
			}
			$db->query($masukkanSql);
			header('Location: produk.php');
		}
	}
?>
	
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper container-fluid">
  		<!-- Content Header (Page header) -->
  		<section class="content-header">
    		<h1>Dashboard <?=((isset($_GET['edit'])))?'Edit':'Tambah'?> Produk</h1>
    		<ol class="breadcrumb">
      			<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      			<li class="active">Here</li>
    		</ol>
  		</section>
  		<!-- Main content -->
  		<section class="content">
    		<!-- Your Page Content Here -->
    		<!--  Form -->
          	<div class="box box-info">
            	<div class="box-header with-border">
             	 	<h3 class="box-title"><?=((isset($_GET['edit'])))?'Edit':'Tambah'?> Produk</h3>
            	</div>
            	<!-- /.box-header -->
            	<form action="produk.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="post" enctype="multipart/form-data">
           		   	<div class="box-body">	
	            		<div class="form-group col-md-6">
	            			<label for="nama_produk">Nama Produk*:</label>
	            			<input type="text" class="form-control" name="nama_produk" id="nama_produk" value="<?=$nama_produk;?>">
	            		</div>
	            		<div class="form-group col-md-6">
	            			<label for="brand">Brand*:</label>
							<select class="form-control select2" id="brand" name="brand">
								<option value="" <?=(($brand == '')?'selected':'');?>></option>
								<?php while($brandB = mysqli_fetch_assoc($brandQuery)): ?>
									<option value="<?=$brandB['id_brand']; ?>" <?=(($brand == $brandB['id_brand'])?' selected':'');?>><?=$brandB['brand'];?></option>
								<?php endwhile; ?>
							</select>
	            		</div>
	            		<div class="form-group col-md-6">
	            			<label for="parent">Parent Kategori*:</label>
	            			<select class="form-control select2" id="parent" name="parent">
	            				<option value=""<?=(($parent == '')?'selected':'');?>></option>
								<?php while($parentP = mysqli_fetch_assoc($parentQuery)): ?>
									<option value="<?=$parentP['id_kategori'];?>"<?=(($parent == $parentP['id_kategori'])?'selected':'');?>><?=$parentP['nm_kategori'];?></option>
								<?php endwhile; ?>
	            			</select> 
	            		</div>
	            		<div class="form-group col-md-6">
	            			<label for="child">Child Kategori*:</label>
	            			<select name="child" id="child" class="form-control">
	            			</select>
	            		</div>
	            		<div class="form-group col-md-6">
	            			<label for="harga">Harga*:</label>
	            			<input type="text" id="harga" name="harga" class="form-control" value="<?=$harga;?>">
	            		</div>
	            		<div class="form-group col-md-6">
	            			<label for="list_harga">List Harga:</label>
	            			<input type="text" id="list_harga" name="list_harga" class="form-control" value="<?=$list_harga;?>">
	            		</div>
	            		<div class="form-group col-md-6">
	            			<label>Ukuran & Jumlah *:</label>
	            			<button class="btn btn-default form-control" onclick="jQuery('#sizeModal').modal('toggle');return false;">Kuantitas & Ukuran</button>
	            		</div>
	            		<div class="form-group col-md-6">
	            			<label for="ukuran">Ukuran & Jumlah</label>
	            			<input type="text" name="ukuran"  id="ukuran" class="form-control" value="<?=$ukuran;?>" readonly>
	            		</div>
	            		<div class="form-group col-md-6">
	            			<?php if($simpan_gambar != ''): ?>
								<div class="save-image attachment-block clearfix">
									<img src="<?=$simpan_gambar;?>" alt="simpan gambar" class="img-responsive pad"><br>
									<a href="produk.php?hapus_gambar=1&edit=<?=$edit_id;?>" class=" btn btn-danger pull-right">Hapus Gambar</a>
								</div>
	            			<?php else: ?>
		            			<label for="photo">Photo Produk</label>
		            			<input type="file" name="photo" id="photo" class="form-control">
	            			<?php endif; ?>
	            		</div>
	            		<div class="form-group col-md-6">
	            			<label for="deskripsi">Produk Deskripsi</label>
	            			<textarea id="deskripsi" name="deskripsi" class="form-control" rows="6"><?=$deskripsi;?></textarea>
	            		</div>
              		</div>
              		<!-- /.box-body -->
              		<div class="box-footer">
              			<div class="pull-right">
              				<a href="produk.php" class="btn btn-danger">Batal</a>&nbsp;
              				<input type="submit" class="btn btn-primary" value="Simpan">
               			</div>
             		 </div>
              		<!-- /.box-footer -->
            	</form>

            	<!-- modal for ukuran dan jumlah -->
				<div class="example-modal">
					<div class="modal" id="sizeModal" tabindex="-1" role="dialog" aria-labeledby="sizeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="sizeModalLabel">Ukuran & Jumlah</h4>
								</div>
								<div class="modal-body">
									<div class="container-fluid">
										<?php for($i=1; $i<=12; $i++): ?>
										<div class="form-group col-md-4">
											<label for="ukuran<?=$i;?>">Ukuran :</label>
											<input type="text" class="form-control" name="ukuran<?=$i;?>" id="ukuran<?=$i;?>" value="<?=((!empty($uArray[$i-1]))?$uArray[$i-1]:'');?>">
										</div>
										<div class="form-group col-md-2">
											<label for="jumlah<?=$i;?>">Jumlah :</label>
											<input type="number" class="form-control" name="jumlah<?=$i;?>" id="jumlah<?=$i;?>" value="<?=((!empty($qArray[$i-1]))?$qArray[$i-1]:'');?>" min="0">
										</div>
										<?php endfor; ?>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
									<button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizeModal').modal('toggle'); return false;">Simpan</button>
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
				</div>
				<!-- /.example-modal -->
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
								<?php 
									// hanya unutk penomoran aja
									$no=1; 

									while($produk = mysqli_fetch_assoc($presult)):
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
						            	<td style="text-align: center;"><?=$no; $no++;?></td>
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

<script>
	jQuery(document).ready(function() {
		get_child_options('<?=$kategoriCat;?>');
	});
</script>