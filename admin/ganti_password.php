<?php
ob_start();
// require database
require_once $_SERVER['DOCUMENT_ROOT'].'/kedan/includes/koneksi.php';
if(!is_logged_in()){
	login_error_redirect();
}

// $password = 'password';
// $hashed = password_hash($password,PASSWORD_DEFAULT);
// echo $hashed;

$hashed = $user_data['password'];
$password_lama = ((isset($_POST['password_lama']))?sanitize($_POST['password_lama']):'');
$password_lama = trim($password_lama);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$konfirmasi = ((isset($_POST['konfirmasi']))?sanitize($_POST['konfirmasi']):'');
$konfirmasi = trim($konfirmasi);
$hashed_baru = password_hash($password, PASSWORD_DEFAULT);
$user_id = $user_data['id_user'];
$errors = array();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Administration Kedan</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!--  Bootstrap 3.3.6 --> 
	    <link rel="stylesheet" href="src/bootstrap/css/bootstrap.min.css">
	    <!-- Font Awesome -->
	    <link rel="stylesheet" href="src/css/font-awesome.min.css">
	    <!-- Ionicons -->
	    <link rel="stylesheet" href="src/css/ionicons.min.css">
	    <!-- Theme style -->
	    <link rel="stylesheet" href="src/dist/css/AdminLTE.css">
		<!-- iCheck -->
		<link rel="stylesheet" href="src/plugins/iCheck/square/blue.css">
	</head>
	<body class="hold-transition">
		<div>
			<?php  
				if($_POST){
					// form validation untuk konfirmasi password
					if(empty($_POST['password_lama']) || empty($_POST['password']) || empty($_POST['konfirmasi'])){
						$errors[] = 'anda wajib mengisikan semua kolom yang ada'; 
					}

					// password harus lebih 6 karakter
					if(strlen($password) < 6){
						$errors[] = "panjang password mini 6 karakter.";
					}

					// check jika password wabru cocok 
					if($password != $konfirmasi){
						$errors[]="password tidak cocok";
					}

					if(!password_verify($password_lama, $hashed)){
						$errors[] = 'password lama anda tidak ada di sistem kami.';
					}

					// check untuk errors
					if(!empty($errors)){
						echo display_errors($errors);
					}
					else{
						//change password
						$db->query("UPDATE user SET password ='$hashed_baru' WHERE id_user='$user_id'");
						$_SESSION['sukses_flash'] = 'password anda telah di perbaharui';
						header('Location: index.php');
						
					}
				}					
			?>
		</div>	
		<div class="login-box">
			<div class="login-logo">
				<a href="#"><img src="../img/logo/logo.png" alt="Kedan Logo" class="img-thumbnail"></a>
			</div>
			<!-- /.login-logo -->
			<div class="login-box-body">
				<p class="login-box-msg"><i class="fa fa-lock"></i> Ganti Password</p>
				<form action="ganti_password.php" method="post">
					<div class="form-group has-feedback">
						<input type="password" name="password_lama" id="password_lama" class="form-control" placeholder="password lama" value="<?=$password_lama;?>">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" name="password" id="password" class="form-control" placeholder="Password Baru" value="<?=$password;?>">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" name="konfirmasi" id="konfirmasi" class="form-control" placeholder="Konfirmasi Password Baru" value="<?=$konfirmasi;?>">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<!-- <div class="checkbox icheck">
								<label>
									<input type="checkbox"> Remember Me
								</label>
							</div> -->
							<a href="index.php" class="btn btn-danger btn-block btn-flat">Batal</a>
						</div>
						<div class="col-xs-4">&nbsp;</div>
						<!-- /.col -->
						<div class="col-xs-4">
							<input type="submit" value="Update" class="btn btn-primary btn-block btn-flat">
						</div>
						<!-- /.col -->
					</div>
				</form>
			</div>
			<!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->

		<!-- jQuery 2.2.3 -->
		<script src="src/plugins/jQuery/jquery-2.2.3.min.js"></script>
		<!-- Bootstrap 3.3.6 -->
		<script src="src/bootstrap/js/bootstrap.min.js"></script>
		<!-- AdminLTE App -->
		<script src="src/dist/js/app.min.js"></script>
		<!-- iCheck -->
		<script src="src/plugins/iCheck/icheck.min.js"></script>
		
		<!-- custom script -->
		<script>
		$(function () {
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
			});
		});
		</script>
	</body>
</html>