<?php
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

	$token = bin2hex(openssl_random_pseudo_bytes(16));
	require_once 'php/authOneProv.php';

	if (isset($_SESSION['user_logged_in']) == false) {
		header('Location:authentication-login.php');
	}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="utf-8" />
	<meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv='expires' content='0'>
	<meta http-equiv='pragma' content='no-cache'>
	<!--meta name="viewport" content="width=1000"-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>КОПИМАСТЕР АДМИНКА</title>
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!--link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script-->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/css/icons.css" />
	<link rel="stylesheet" href="assets/css/app.css" />
	<link rel="stylesheet" href="assets/plugins/datatable/css/buttons.bootstrap4.min.css" />
	<link rel="stylesheet" href="assets/plugins/datatable/css/dataTables.bootstrap4.min.css" />
	<link rel="stylesheet" href="assets/plugins/notifications/css/lobibox.min.css" />
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/notifications/js/lobibox.min.js"></script>
	<script src="assets/plugins/notifications/js/notifications.min.js"></script>
	<script src="assets/plugins/notifications/js/notification-custom-script.js"></script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

</head>

<style>
	@media (max-width: 600px)  { 
		/*#mainblock { zoom: 70%; }
		#example2_wrapper{ zoom: 70%; }*/
	}
</style>

<body class="bg-theme bg-theme9">
	<div class="wrapper ">

	<header class="top-header">
			<nav class="navbar navbar-expand">
				
				<div class="sidebar-header">
					<div class="d-none d-lg-flex">
						
					</div>
					<div>
						<h4 class="d-none d-lg-flex logo-text">КОПИМАСТЕР</h4>
					</div>
					<a href="javascript:;" class="toggle-btn ml-lg-auto" id="dashbord_icon"> <i class="bx bx-menu"></i>
					</a>
				</div>

				<div class="right-topbar ml-auto">
					<ul class="navbar-nav">
						<li class="nav-item search-btn-mobile">
							<a class="nav-link position-relative" href="javascript:;">	<i class="bx bx-search vertical-align-middle"></i>
							</a>
						</li>
						

						<li class="nav-item dropdown dropdown-user-profile">


							<style media="screen">
								@media screen and (max-width: 600px) {
									#register {
									visibility: hidden;
									display: none;
									}
								}
							</style>

							<?php
							if (!isset($_SESSION['user_logged_in'])) {
								echo '	<div class="align-items-center">
										<a href="authentication-login.html"><button id="login" type="button" class="btn btn-light m-1 px-5 radius-30">Войти</button></a>
										<a href="authentication-register.html"><button id="register" type="button" class="btn btn-light m-1 px-5 radius-30">Регистрация</button></a>
										</div>';
							}
							else{
								echo '<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-toggle="dropdown">
										<div class="media user-box align-items-center">
											<div class="media-body user-info">
												<p class="user-name mb-0">'.$_SESSION['login'].'</p>

											</div>
											<img src="./assets/images/user.png" class="user-img" alt="user avatar">
										</div>
									</a>
									<div class="dropdown-menu dropdown-menu-right">

											<a class="dropdown-item" href="logout.php"><i
												class="bx bx-power-off"></i><span>Logout</span></a>
									</div>';
							}
							?>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<!--end header-->
		<!--navigation-->
		<div class="nav-container">
			<div class="mobile-topbar-header">
				<div class="">
					<img src="assets/images/logo-icon.png" class="logo-icon-2" alt="" />
				</div>
				<div>
					<h4 class="logo-text">Админка </h4>
				</div>
				<a href="javascript:;" class="toggle-btn ml-auto"> <i class="bx bx-menu"></i>
				</a>
			</div>
			<nav class="topbar-nav">
				<ul class="metismenu" id="menu">

					<li>
						<a href="javascript:;" class="has-arrow">
							<div class="parent-icon"><i class='bx bx-home-alt'></i>
							</div>
							<div class="menu-title">Заявки</div>
						</a>
						<ul>
							<li> <a href="./index.php"><i class="bx bx-right-arrow-alt"></i>Обработка</a>
							</li>
						</ul>
					</li>


					<li>
						<a href="javascript:;" class="has-arrow">
							<div class="parent-icon"><i class='bx bx-briefcase-alt'></i>
							</div>
							<div class="menu-title">Калькулятор</div>
						</a>
						<ul>
							<li> <a href="./calc/"><i class="bx bx-right-arrow-alt"></i>Калькулятор ФИЗ</a>
							</li>
							<li> <a href="./calcUr/"><i class="bx bx-right-arrow-alt"></i>Калькулятор ЮР</a>
							</li>
						</ul>
					</li>

					<?php 
						if (  $_SESSION['type'] == "admin")
						{
							echo '
								<li>
									<a class="has-arrow" href="javascript:;">
										<div class="parent-icon"><i class="bx bx-line-chart"></i>
										</div>
										<div class="menu-title">Цены</div>
									</a>
									<ul>
										<li> <a href="./priceChange.php"><i class="bx bx-right-arrow-alt"></i>Изменение калк. ФИЗ </a>
										</li>
										<li> 
											<a href="./titelPriceChange.php"><i class="bx bx-right-arrow-alt"></i>Изменение номенклатуры цен калк. ФИЗ </a>
										</li>
									</ul>
								</li>
							';
						}
					?>

					<li>
						<a class="has-arrow" href="javascript:;">
							<div class="parent-icon"><i class="bx bx-comment-edit"></i>
							</div>
							<div class="menu-title">Рабочая</div>
						</a>
						<ul>
							<li>
								 <a href="./rasListOnGrafik.php"><i class="bx bx-right-arrow-alt"></i>Расчёт по графику</a>
							</li>
							<li> 
								<a href="./grafikSmen.php"><i class="bx bx-right-arrow-alt"></i>График смен</a>
							</li>
							<li> 
								<a href="./applications.php"><i class="bx bx-right-arrow-alt"></i>Заказ материалов</a>
							</li>							
							<li> 
								<a href="./reportCheck.php"><i class="bx bx-right-arrow-alt"></i>статистика калькулятора по дням</a>
							</li>							
							<li> 
								<a href="./reportCheckBySmena.php"><i class="bx bx-right-arrow-alt"></i>статистика калькулятора по сменам</a>
							</li>
							<li> 
								<a href="./customersCalculator.php"><i class="bx bx-right-arrow-alt"></i>Клиенты и скидки</a>
							</li>
							<li> 
								<a href="./openAndCloseSmena.php"><i class="bx bx-right-arrow-alt"></i>Открытие и закрытие смены</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</header>


		<div class="switcher-wrapper">
		<div class="switcher-btn"> <i class="bx bx-cog bx-spin"></i>
		</div>
		<div class="switcher-body">
			<h5 class="mb-0 text-uppercase">Темы</h5>
			<hr>
			<p class="mb-0">Gaussian Texture</p>
			  <hr>
			  
			  <ul class="switcher">
				<li id="theme1"></li>
				<li id="theme2"></li>
				<li id="theme3"></li>
				<li id="theme4"></li>
				<li id="theme5"></li>
				<li id="theme6"></li>
			  </ul>
               <hr>
			  <p class="mb-0">Градиент</p>
			  <hr>
			  
			  <ul class="switcher">
				<li id="theme7"></li>
				<li id="theme8"></li>
				<li id="theme9"></li>
				<li id="theme10"></li>
				<li id="theme11"></li>
				<li id="theme12"></li>
			  </ul>
		</div>
	</div>
	
	<script>
	$(document).ready(function () {
		$(window).on("scroll", function () {
			if ($(this).scrollTop() > 60) {
				$('.top-header').addClass('bg-dark');
				$('.nav-container').addClass('bg-dark sticky-top-header');
			} else {
				$('.top-header').removeClass('bg-dark');
				$('.nav-container').removeClass('bg-dark sticky-top-header');
			}
		});

		$('.back-to-top').on("click", function () {
			$("html, body").animate({
				scrollTop: 0
			}, 600);
			return false;
		});
	});
	</script>

<script type="text/javascript">
	$(document).ready(function() {
		width=screen.width; // ширина
		
		if (width > 600) {
			$("#dashbord_icon").click();
		}
	});
</script>

<style>
	.article-img{
		object-fit: cover !important;
  		width: 230px !important;
  		height: 230px !important;
	}
</style>