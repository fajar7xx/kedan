<?php
ob_start();
// require database
require_once $_SERVER['DOCUMENT_ROOT'].'/kedan/includes/koneksi.php';

// $password = 'password';
// $hashed = password_hash($password,PASSWORD_DEFAULT);
// echo $hashed;

$alamatEmail = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$alamatEmail = trim($alamatEmail);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
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
					// form validation
					if(empty($_POST['email']) || empty($_POST['password'])){
						$errors[] = 'masukkan alamat email dan password anda'; 
					}
					// validasi email
					if(!filter_var($alamatEmail, FILTER_VALIDATE_EMAIL)){
						$errors[] = "Anda harus memasukkan email yang valid";
					}

					// password harus lebih 6 karakter
					if(strlen($password) < 6){
						$errors[] = "panjang password mini 6 karakter.";
					}

					//check if email exist in the database
					$query = $db->query("SELECT * FROM user WHERE email = '$alamatEmail'");
					$user = mysqli_fetch_assoc($query);
					$userCount = mysqli_num_rows($query);
					// hanya cek id ke berapa echo $userCount;
					if($userCount < 1){
						$errors[] = 'Email Belum Terdaftar'; 
					}

					if(!password_verify($password, $user['password'])){
						$errors[] = 'Password tidak sesuai dengan data kami. silahkan coba lagi';
					}

					// check untuk errors
					if(!empty($errors)){
						echo display_errors($errors);
					}
					else{
						//log user ke dalan
						// echo "<center>selamat anda telah masuk ke sistem </center>";
						$user_id = $user['id_user'];
						login($user_id);
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
				<p class="login-box-msg"><i class="fa fa-lock"></i> Please enter your login details.</p>
				<form action="login.php" method="post">
					<div class="form-group has-feedback">
						<input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?=$alamatEmail;?>">
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" name="password" id="password" class="form-control" placeholder="Password" value="<?=$password;?>">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="row">
						<div class="col-xs-8">
							<div class="checkbox icheck">
								<label>
									<input type="checkbox"> Remember Me
								</label>
							</div>
						</div>
						<!-- /.col -->
						<div class="col-xs-4">
							<input type="submit" value="Login" class="btn btn-primary btn-block btn-flat">
						</div>
						<!-- /.col -->
					</div>
				</form>
				<a href="#">I forgot my password</a><br>
				<a href="../index.php" class="text-center">Back To site </a>
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