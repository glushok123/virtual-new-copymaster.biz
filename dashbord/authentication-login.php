<?php
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
	$token = bin2hex(openssl_random_pseudo_bytes(16));

	require_once 'php/authProv.php';

?>


<!DOCTYPE html>
<html lang="ru">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Вход</title>
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/css/icons.css" />
	<link rel="stylesheet" href="assets/css/app.css" />
	<link rel="stylesheet" href="assets/plugins/notifications/css/lobibox.min.css">
</head>

<body class="bg-theme bg-theme1">
	<!-- wrapper -->
	<div class="wrapper">
		<div class="section-authentication-login d-flex align-items-center justify-content-center">
			<div class="row">
				<div class="col-12 col-lg-10 mx-auto">
					<div class="card radius-15">
						<div class="row no-gutters">
							<div class="col-lg-6">
								<div class="card-body p-md-5">
									<div class="text-center">

										<h3 class="mt-4 font-weight-bold">Вход</h3>
									</div>

									<div class="login-separater text-center"> <span>логин или почта</span>
										<hr/>
									</div>
									<div class="form-group mt-4">
										<label>логин или почта</label>
										<input id="login_login" type="text" class="form-control" placeholder="Enter your email address" />
									</div>
									<div class="form-group">
										<label>Пароль</label>
										<input id="login_passwd" type="password" class="form-control" placeholder="Enter your password" />
									</div>

									<div class="btn-group mt-3 w-100">
										<button  type="button" class="auth btn btn-light btn-block">Вход</button>
										<button  type="button" class="auth btn btn-light"><i class="lni lni-arrow-right"></i>
										</button>
									</div>
									<hr>
									<div class="text-center">
										<p class="mb-0">Нет аккаунта? <a href="authentication-register.html">Регистрация</a>
										</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<img src="assets/images/login-images/login-frent-img.jpg" class="card-img login-img h-100" alt="...">
							</div>
						</div>
						<!--end row-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
</body>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/plugins/notifications/js/lobibox.min.js"></script>
<script src="assets/plugins/notifications/js/notifications.js"></script>
<script src="assets/plugins/notifications/js/notification-custom-script.js"></script>

<script type="text/javascript">

	$(document).ready(function () {
			$(".auth").on('click', function (event) {auth()});

	});

	function auth() {
		var prov = true;
		if ($("#login_login").val() == ""){
			warning_noti("Необходимо ввести логин!");
				prov = false;
		}
		if ($("#login_passwd").val() == ""){
			warning_noti("Необходимо ввести пароль!");
				prov = false;
		}
		if (prov == true){
			var datalog = {
				"login":$("#login_login").val(),
				"passwd":$("#login_passwd").val()
			};

			$.post("login.php", datalog, function(datar){

                console.log(datar)
				var obj = JSON.parse(datar);
				
				console.log(obj)
				if (obj.status == "error"){
					warning_noti(obj.mes);
				}
				if (obj.status == "success"){
					width=screen.width; // ширина  
					
					if (width < 600) {
						window.location.assign('grafikSmen.php');
					}
					else {
						window.location.assign('index.php');
					}
				}
			});
		}
	}
	
</script>
</html>
