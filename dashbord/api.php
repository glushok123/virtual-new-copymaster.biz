<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
///Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Тестовое задание</title>
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/css/icons.css" />
	<link rel="stylesheet" href="assets/css/app.css" />
	<link rel="stylesheet" href="assets/plugins/datatable/css/buttons.bootstrap4.min.css" />
	<link rel="stylesheet" href="assets/plugins/datatable/css/dataTables.bootstrap4.min.css" />


</head>

<body class="bg-theme bg-theme1">
	<div class="wrapper">
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<h4 class="logo-text">Тестовое задание</h4>
				</div>
				<a href="javascript:;" class="toggle-btn ml-auto"> <i class="bx bx-menu"></i>
				</a>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
                <li>
                    <a href="index.php">
                        <div class="menu-title">Главная</div>
                    </a>
                </li>
				<li>
					<a href="authentication-login.html">
						<div class="menu-title">Вход</div>
					</a>
				</li>
				<li>
					<a href="authentication-register.html">
						<div class="menu-title">Регистрация</div>
					</a>
				</li>
				<li>
					<a href="api.html">
						<div class="menu-title">API</div>
					</a>
				</li>

			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar-wrapper-->
		<!--header-->
		<header class="top-header">
			<nav class="navbar navbar-expand">
				<div class="left-topbar d-flex align-items-center">
					<a href="javascript:;" class="toggle-btn">	<i class="bx bx-menu"></i>
					</a>
				</div>

				<div class="right-topbar ml-auto">
					<ul class="navbar-nav">


						<li class="nav-item dropdown dropdown-lg">


						<style media="screen">
						@media screen and (max-width: 600px) {
							#register {
							visibility: hidden;
							display: none;
							}
						}
						</style>
						<li class="nav-item dropdown dropdown-user-profile">
							<?php
							if (!isset($_SESSION['user_logged_in'])) {
								echo '	<div class="align-items-center">
										<button id="login" type="button" class="btn btn-light m-1 px-5 radius-30">Войти</button>
										<button id="register" type="button" class="btn btn-light m-1 px-5 radius-30">Регистрация</button>
										</div>
									 ';
							}
							else{
								echo '<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-toggle="dropdown">
										<div class="media user-box align-items-center">
											<div class="media-body user-info">
												<p class="user-name mb-0">'.$_SESSION['login'].'</p>

											</div>
											<img src="https://via.placeholder.com/110x110" class="user-img" alt="user avatar">
										</div>
									 </a>
									 <div class="dropdown-menu dropdown-menu-right">		<a class="dropdown-item" href="logout.php"><i
												 class="bx bx-power-off"></i><span>Logout</span></a>
									 </div>';
							}

							 ?>



						</li>

					</ul>
				</div>
			</nav>
		</header>
		<div class="page-wrapper">
			<div class="page-content-wrapper">
				<div class="page-content">
                    <div class="col-12 col-lg-12 col-xl-12">
							<div class="card radius-15">
								<div class="card-body">
									<h5 class="card-title">Добавление заявок</h5>
									<h6 class="card-subtitle mb-2">POST /requests/ </h6>
									<p class="text-justify">ПРИМЕР</p>
                                    <p class="text-justify">$.ajax({url: '/api/requests/', method: 'POST', data: {name: "andrey", email: "qwe@gmail.com", message: "123" }, dataType: 'json', success: function(response){console.log('response:', response)}})</p>
								</div>
							</div>
						</div>
                        <div class="col-12 col-lg-12 col-xl-12">
                                <div class="card radius-15">
                                    <div class="card-body">
                                        <h5 class="card-title">Обработка заявок</h5>
                                        <h6 class="card-subtitle mb-2">PUT /requests/{id} </h6>
                                        <p class="text-justify">ПРИМЕР</p>
                                        <p class="text-justify">$.ajax({url: '/api/requests/ID заявки', method: 'PUT', data: {comment:"ответ"}, dataType: 'json', success: function(response){console.log('response:', response)}})</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12 col-xl-12">
                                    <div class="card radius-15">
                                        <div class="card-body">
                                            <h5 class="card-title">Получить ПОЛНЫЙ список заявок </h5>
                                            <h6 class="card-subtitle mb-2">GET /requests/ </h6>
                                            <p class="text-justify">ПРИМЕР</p>
                                            <p class="text-justify">$.ajax({url: '/api/requests/', method: 'GET', dataType: 'json', success: function(response){console.log('response:', response)}})</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12 col-xl-12">
                                        <div class="card radius-15">
                                            <div class="card-body">
                                                <h5 class="card-title">Получить  список заявок от конкретного пользователя  </h5>
                                                <h6 class="card-subtitle mb-2">GET /requests/{логин} </h6>
                                                <p class="text-justify">ПРИМЕР</p>
                                                <p class="text-justify">$.ajax({url: '/api/requests/{login}', method: 'GET', dataType: 'json', success: function(response){console.log('response:', response)}})</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12 col-xl-12">
                                            <div class="card radius-15">
                                                <div class="card-body">
                                                    <h5 class="card-title">Удалить заявку  </h5>
                                                    <h6 class="card-subtitle mb-2">DELETE /requests/{id} </h6>
                                                    <p class="text-justify">ПРИМЕР</p>
                                                    <p class="text-justify">$.ajax({url: '/api/goods/{id}', method: 'DELETE', dataType: 'json', success: function(response){console.log('response:', response)}})</p>
                                                </div>
                                            </div>
                                        </div>

				</div>
			</div>
		</div>


	<!--end switcher-->
	<!-- JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<!--plugins-->
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>



	<script src="assets/js/index.js"></script>
	<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<!-- App JS -->
	<script src="assets/js/app.js"></script>




</body>

</html>
