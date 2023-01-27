<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

if (!isset($_SESSION['user_logged_in']))
{
	header('Location:https://copymaster.biz/dashbord/authentication-login.html');
}

?>

<!DOCTYPE html>
<html lang="ru"> 

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<style>

		@media (min-width: 1095px)  and (max-width: 1247px)  { 
			#wrapServ { zoom: 92%; }
		}

		@media (min-width: 905px)  and (max-width: 1095px)  { 
			#wrapServ { zoom: 90%; }
			#butNew, #butSkid, 
			#btnExport, #butSave, 
			#butPrint, #butSaveCher,
			#butHistory, #butHistoryCher
			#butHistory, #butHistoryCher
			 { font-size: 14px; }
		}

		@media (min-width: 813px)  and (max-width: 904px)  { 
			#wrapServ { zoom: 90%; }
			#wrapChek { zoom: 88%; }
			#butNew, #butSkid, 
			#btnExport, #butSave, 
			#butPrint, #butSaveCher,
			#butHistory, #butHistoryCher
			#butHistory, #butHistoryCher
			 { font-size: 14px; }
		}
		@media (min-width: 746px)  and (max-width: 812px)  { 
			#wrapServ { zoom: 90%; }
			#wrapChek { zoom: 82%; }
			#wrapMenu { zoom: 85%; } 
			#butNew, #butSkid, 
			#btnExport, #butSave, 
			#butPrint, #butSaveCher,
			#butHistory, #butHistoryCher
			#butHistory, #butHistoryCher
			 { font-size: 14px; }
		}
		@media (min-width: 550px)  and (max-width: 746px)  { 
			#wrapServ { zoom: 85%; }
			#wrapChek { zoom: 80%; }
			#wrapMenu { zoom: 85%; } 
			#butNew, #butSkid, 
			#btnExport, #butSave, 
			#butPrint, #butSaveCher,
			#butHistory, #butHistoryCher
			#butHistory, #butHistoryCher
			 { font-size: 13px; }
			#wrapServ { font-size: 13px; }
		}
		@media (min-width: 0px)  and (max-width: 550px)  { 
			* { zoom: 88%; }

		}

		/*@media (min-width: 690px)  and (max-width: 825px)  { 
			#wrapMenu { zoom: 85%; } 
			#wrapServ { zoom: 85%; }
			#wrapChek { zoom: 85%; }

			#butNew, #butSkid, 
			#btnExport, #butSave, 
			#butPrint, #butSaveCher,
			#butHistory, #butHistoryCher
			#butHistory, #butHistoryCher
			 { font-size: 11px; }
		}*/
	</style>
    <!--style>
		@media (min-width: 500px)  and (max-width: 800px)  { * { zoom: 90%; } }
		@media (min-width: 800px)  and (max-width: 970px)  { * { zoom: 93%; } }
		@media (min-width: 970px)  and (max-width: 1200px) { * { zoom: 96%; } }
		@media (min-width: 1200px) and (max-width: 1400px) { * { zoom: 97%; } }
		@media (min-width: 1400px) and (max-width: 1600px) { * { zoom: 98%; } }
    </style-->
	
	<meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv='expires' content='0'>
	<meta http-equiv='pragma' content='no-cache'>
	
	<title>КОПИМАСТЕР КАЛЬКУЛЯТОР ФИЗ. ЛИЦ</title>
		<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/css/icons.css" />
	<link rel="stylesheet" href="../assets/css/app.css" />
	<link rel="stylesheet" href="assets/plugins/datatable/css/buttons.bootstrap4.min.css" />
	<link rel="stylesheet" href="assets/plugins/datatable/css/dataTables.bootstrap4.min.css" />
	<link rel="stylesheet" href="node_modules/tableexport/dist/css/tableexport.css">
	<script src="node_modules/blobjs/Blob.min.js"></script>
	<script src="node_modules/xlsx/dist/xlsx.core.min.js"></script>
	<script src="node_modules/file-saverjs/FileSaver.js"></script>
	<script src="node_modules/tableexport/dist/js/tableexport.js"></script>

 	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

	<script src="assets/js/jquery.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>

<body class="bg-theme bg-theme9">
	<div class="wrapper ">
		<header class="top-header">
			<nav class="navbar navbar-expand">
				
				<div class="sidebar-header">
					<div class="d-none d-lg-flex">
						
					</div>
					<div>
						<h4 class="d-none d-lg-flex logo-text">Dashbord</h4>
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
										<a href="../authentication-login.html"><button id="login" type="button" class="btn btn-light m-1 px-5 radius-30">Войти</button></a>
										<a href="../authentication-register.html"><button id="register" type="button" class="btn btn-light m-1 px-5 radius-30">Регистрация</button></a>
										</div>';
							}
							else{
								echo '<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-toggle="dropdown">
										<div class="media user-box align-items-center">
											<div class="media-body user-info">
												<p class="user-name mb-0">'.$_SESSION['login'].'</p>

											</div>
											<img src="../assets/images/user.png" class="user-img" alt="user avatar">
										</div>
									</a>
									<div class="dropdown-menu dropdown-menu-right">

											<a class="dropdown-item" href="../logout.php"><i
												class="bx bx-power-off"></i><span>Logout</span></a>
									</div>';
							}
							?>
						</li>
					</ul>
				</div>
			</nav>
		</header>

		<div class="nav-container">
			<div class="mobile-topbar-header">
				<div class="">
					<img src="assets/images/logo-icon.png" class="logo-icon-2" alt="" />
				</div>
				<div>
					<h4 class="logo-text">Dashbord</h4>
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
							<li> <a href="../index.php"><i class="bx bx-right-arrow-alt"></i>Обработка</a>
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
							<li> <a href="../calc/"><i class="bx bx-right-arrow-alt"></i>Калькулятор ФИЗ</a>
							</li>
							<li> <a href="../calcUr/"><i class="bx bx-right-arrow-alt"></i>Калькулятор ЮР</a>
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
										<li> <a href="../priceChange.php"><i class="bx bx-right-arrow-alt"></i>Изменение калк. ФИЗ </a>
										</li>
										<li> 
											<a href="../titelPriceChange.php"><i class="bx bx-right-arrow-alt"></i>Изменение номенклатуры цен калк. ФИЗ </a>
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
								 <a href="../rasListOnGrafik.php"><i class="bx bx-right-arrow-alt"></i>Расчёт по графику</a>
							</li>
							<li> 
								<a href="../grafikSmen.php"><i class="bx bx-right-arrow-alt"></i>График смен</a>
							</li>
							<li> 
								<a href="../applications.php"><i class="bx bx-right-arrow-alt"></i>Заказ материалов</a>
							</li>
							<li> 
								<a href="../reportCheck.php"><i class="bx bx-right-arrow-alt"></i>статистика калькулятора по дням</a>
							</li>							
							<li> 
								<a href="../reportCheckBySmena.php"><i class="bx bx-right-arrow-alt"></i>статистика калькулятора по сменам</a>
							</li>
						</ul>
					</li>

				</ul>
			</nav>
		</div>
	</header>
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

	<div id='wrapper' class='basic' style="top: 70px;">
						
						<div id='wrapMenu'>
							<div id='m1' class='menu a'></div>
							<div id='m2' class='menu aa'></div>
							<div id='m3' class='menu aaa'></div>
							<div id='m4' class='menu aaaa'></div>
							<div id='m5' class='menu aaaaa'></div>
							<div id='m6' class='menu aaaaaa'></div>
							<div id='m7' class='menu aaaaaaa'></div>

						</div>
						<div id='wrapServ'>
							<div class='box'>Кол-во <span id='metricSpan'>шт.</span><input id='inpNum' value='0'></div>
							<div class='box'>Цена<input id='inpPrice' value='0'></div>
							<div class='box'>Стоимость<input id='inpSum' value='0' readonly></div>

							<div id='compName' class='box2'>Клиент<input id='inpName'></div>
							<div id='comptel' class='box2'>Контакты<input id='tel'></div>
							<div id='compsrok' class='box2'>Сроки/Коммент<input id='srok'></div>

							<div id='butFiz' class='butn sel'>Физ. лицо</div>
							<div id='butUrl' class='butn'>Юр. лицо</div>
							<div id='butChekAdd' class='butn'>Добавить в чек</div>
						</div>
						<div id='wrapDebily' class="hide">

                			<div class="row">
                				<div class="col-5">
                					<button id='butFizn' type="button" class="butn" style="width:210px; height:80px;">
                						Наличный расчёт
                					</button>
                				</div>
                			</div>
							<div class='row'>
								<div class="col-5">
                					<button id='butFizk' type="button" class="butn" style="width:210px; height:80px;">
                						Безналичный расчёт
                					</button>
                				</div>
							</div>
                			
						</div>

						<div id='wrapSchetHead'>
							<table class='tb t10'>
								<tr><td rowspan='2' colspan='2'>ПАО "ПРОМСВЯЗЬБАНК" Г. МОСКВА<br><sub>Банк получателя</sub></td><td>БИК</td><td>044525555</td></tr>
								<tr><td>Сч. №</td><td>30101810400000000555</td></tr>
								<tr><td>ИНН 7721282097</td><td>КПП 772901001</td><td rowspan='3'>Сч. №</td><td rowspan='3'>40702810700000029669</td></tr>
								<tr><td colspan='2'>ООО "Копимастер"<br></sub>Получатель</sub></td></tr>
							</table>
							<h1>Счет на оплату № <span class='chekId'>...</span> от 14.09.2020</h1>
							<hr>
							<table class='t10'>
								<tr><td>Поставщик<br><sub>(Исполнитель)</sub></td><th>ООО "Копимастер", ИНН 7721282097, КПП 772901001, 119285, Москва г, Пырьева ул, дом № 11-А,<br>помещение 4, ком.13, тел: 8-495-229-56-62</th></tr>
								<tr><td>Покупатель<br><sub>(Заказчик)</sub></td><th class='komName'>...</th></tr>
								<tr><td>Основание</td><th>Счёт <span class='chekId'>...</span> от 14.09.2020</th></tr>
							</table>
						</div>

						<div id='wrapTovarchekNalHead'>
							<div class='right'>
								<img src="users/copyfast/logo.png"><br>
								Наименование организации: ИП Васюков И.Г.<br>
								ИНН: 500601498899<br>
								Юридический адрес: 143090, Мос. обл, г. Краснознаменск, ул. Строителей, д. 3, кв. 25<br>
							</div>
							<br>
							<div class='center large'>Товарный чек <span class='chekId'>..</span> от <span class="chekDate">14.09.2020</span></div>
							<div class='center small'>За наличный расчет</div>
							<br>
						</div>

						<div id='wrapTovarchekBeznalHead'>
							<div class='right'>
								<img src="users/copyfast/logo.png"><br>
							</div>
							<div class='center large'>Акт сдачи приемки работ <span class='chekId'>..</span> от <span class="chekDate">14.09.2020</span></div>
							<hr>
							<div>
								ООО "Копимастер", именуемый в дальнейшем 'Исполнитель', в лице Генерального Директора Васюковой В.И., действующий на основании устава, с одной стороны и <span class='komName'>Огранизация</span>, именуемый в дальнейшем 'Заказчик', составили настоящий Акт о том, что Исполнителем на основании задания Заказчика оказаны следующие печатные услуги:
							</div>
							<br>
						</div>


						<div id='wrapChek'>

							<table>
								<tr class='tht'>
									<td>№</td>
									<td>Услуга</td>
									<td>Кол-во</td>
									<td>Ед.</td>
									<td>Цена</td>
									<td>Стоимость</td>
									<td>Заказчик</td>
								</tr>
								<tr>
									<td colspan="5">Итого</td>
									<td></td>
									<td></td>
								</tr>
							</table>
						</div>


						<div id='wrapTovarchekNalFoot'>
							<div class='itogo'>Итого</div>
							<br><br><br><br>
							<div>___________________ ИП Васюков</div>
						</div>

						<div id='wrapTovarchekBeznalFoot'>
							<div class='itogo'>Итого</div>
							<div class='itogoNds'>В том числе НДС:</div>
							<hr>
							<br><br>
							<table class="center wide">
								<tr><td>Работу сдал от Исполнителя</td><td>Работу принял от Заказчика</td></tr>

								<tr><td>___________________________</td><td>___________________________</td></tr>
								<tr><td><sup>(подпись)</sup></td><td><sup>(подпись)</sup></td></tr>
								<tr><td>"____"____________20</td><td>"____"____________20</td></tr>
								<tr><td>М.П.</td><td>М.П.</td></tr>
							</table>
						</div>



						<div id='wrapChekContrl'>
							<div id='someOtherDiv'>

							</div>
							<div id='butNew' class='butn'>Новый чек</div>
							<div class='butn span' id='butSkid'>
								<span class='skidName'>Cкидка</span>
								<input id='inpDiscProc' value='0' class='skidInputs'><span class='skidInputs'>% &nbsp;</span>
								<input id='inpDiscRub' value='0' class='skidInputs'><span class='skidInputs'>р.</span>
							</div>
							<div class='butn' id='butSave'>Оплатить</div>
							<div id='butHistory' class='butn'><span id="infoCheckSave"></span>История чеков</div>
							<div id='historyList' class="hide"></div>

							<div id='historyList2' class="hide"></div>
							<div id='listOrders' class="hide"></div>

							<div class='butn' id='butPrint'>Печать чека</div>
							<div class='butn' id='butSaveCher' style="background-color:#1fcbff; color: black">В черновик</div>
							<div class='butn' id='butHistoryCher'>Черновики</div>
							<div class='butn' id='butOrders'>Заявки</div>
							
							<!--div class='butn' id='btnExport' style="background-color:red; color: white">Экспорт в PDF</div-->



							

						</div>
	</div>

	<div class="switcher-wrapper">
		<div class="switcher-btn"> <i class="bx bx-cog bx-spin"></i>
		</div>
		<div class="switcher-body">
			<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
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
			  <p class="mb-0">Gradient Background</p>
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

	<!--end switcher-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<!--plugins-->
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!-- Vector map JavaScript -->
	<script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
	<script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="assets/plugins/vectormap/jquery-jvectormap-in-mill.js"></script>
	<script src="assets/plugins/vectormap/jquery-jvectormap-us-aea-en.js"></script>
	<script src="assets/plugins/vectormap/jquery-jvectormap-uk-mill-en.js"></script>
	<script src="assets/plugins/vectormap/jquery-jvectormap-au-mill.js"></script>

	<script src="assets/js/index.js"></script>
	<!-- App JS -->
	<link rel="stylesheet" href="assets/plugins/datatable/css/buttons.bootstrap4.min.css" />
	<link rel="stylesheet" href="assets/plugins/datatable/css/dataTables.bootstrap4.min.css" />
	<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/app.js"></script>
	<link rel="stylesheet" href="stylo.css?m1" />
	<script src="main.js"></script>

</body>
</html>

<style media="print">
	
		*{
	    color:black;
	    font-size: 18pt;
	}

    #historyList table{
        width: 180mm;
        font-size: 10pt !important;
    }
	
	#tablecheck table{
	    width: 210mm;
	}
	
    .tht{
        font-weight: bold;
        font-size: 18pt !important;
    }

	.tht2{
        font-size: 18pt !important;
    }

	img {
	     width: 140mm;
	}
	
    .print #wrapChek {
      width: 100%;
      position: relative;
      float: left;
      font: normal 2em Calibri;
    }
    
    #wrapChek table td {
      border: solid 1px #666;
      padding: 5px;
      color: black;
    }

	.list td{
		font-size: 20pt !important;
	}
	.switcher-wrapper{
		display: none;
	}
    .navbar, .nav-container, .navbar-nav{
		display: none !important;
	}
</style>


<style media="screen">

    .ogrsize{
    	max-width: 80px;
    	min-width: 80px;
    }
    ::selection {
      color: #800;
      background-color: orange;
    }
    .tht{
        font-weight: bold;
    }

</style>


<style>
	/* !!! ЦВЕТНАЯ !!! */
		#aaab, /* A4 мат 120 */
		#aaad, /* A4 мат 200 */
		#aaae, /* A4 мат 250 */
		#aaag, /* A4 глян 170 */
		#aaah, /* A4 глян 250 */
		#aaaj /* A4 калька 250 */
		/*#aaai   A4 самоклейка */
		{
			display: none !important;
		}

		#aabc, /* A3 мат 200 */
		#aabd, /* A3 мат 250 */
		#aabf, /* A3 глян 170 */
		#aabg, /* A3 глян 250 */
		#aabh /* A3 калька 250 */
		{
			display: none !important;
		}

		/*#aacc, /* A2 глянец HP */
		/*#aacd, /* A2 калька 90 */
		#aacf, /* A2 холст */
		#aacg, /* A2 мат 300 */
		#aace /* A2 самоклейка */
		{
			display: none !important;
		}
		
		/*#aadc,  A1 глянец HP */
		/*#aadd,  A1 калька */
		#aade, /*A1 самоклейка */
		#aadf /* A1 холст */
		{
			display: none !important;
		}

		/*#aaec, /* A0 мат 180 */
		/*#aaec, /* A0 глянец HP */
		#aaed, /* A0 калька 90 */
		#aaee, /* A0 самоклейка */
		#aaef /* A0 холст */
		{
			display: none !important;
		}

		#aafe, /* нест самоклейка */
		#aaff /* нест холст */
		{
			display: none !important;
		}

	/* !!! ЧЕРНО-БЕЛАЯ !!! */
		#abab, /* A4 мат 120 */
		#abad, /* A4 мат 200 */
		#abae, /* A4 мат 250 */
		#abag, /* A4 гл 170 */
		#abah /* A4 гл 250 */
		/*#abai  A4 самоклейка */
		{
			display: none !important;
		}

		#abbc, /* A3 мат 200 */
		#abbd, /* A3 мат 250 */
		#abbf /* A3 глянцевая 170г */
		{
			display: none !important;
		}

		/*#abcb /* A2 калк 90 */
		#abcd,/* A2 мат 300 */
		#abcc,/* A2 мат 180 */
		#abce/* A2 глянцевая */
		{
			display: none !important;
		}

		/*#abdb /* A1 калк 90 */
		#abdc,/* A1 мат 180 */
		#abdd/* A1 глянцевая */
		{
			display: none !important;
		}

		#abeb, /* A0 калк 90 */
		#abec,/* A0 мат 180 */
		#abed/* A0 глянцевая */
		{
			display: none !important;
		}

</style>
<script type="text/javascript">
	$(document).ready(function() {
	//	width=screen.width; // ширина  
		
		//if (width > 600) {
		//	$("#dashbord_icon").click();
		//}
	});
</script>

	<!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script-->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/"crossorigin="anonymous"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
 
<script type="text/javascript">

	$("body").on("click", "#btnExport", function () {

		if (($("#qazwsx").length > 0 && document.getElementById("qazwsx").innerText == "Способ оплаты: на р/с") || $("#butUrl").hasClass("sel")) {
			wrapper.className = "print prn2";
		} else {
			wrapper.className = "print prn1";
		}
		let ti = new Date();
		let mou = ti.getMonth();
		let year = ti.getFullYear();
		mou++;
		if (mou < 10) {
			mou = '0' + mou;
		}
		let day = ti.getDate();
		if (day < 10) {
			day = '0' + day;
		}
		let chekDates = document.getElementsByClassName('chekDate');
		for (k in chekDates) {
			chekDates[k].innerHTML = `${day}.${mou}.${year}`;
		}

		let pdf = new jsPDF('p', 'pt', 'letter');
		pdf.html(document.getElementById('wrapper'), {
			callback: function () {
				pdf.save('test.pdf');
				window.open(pdf.output('bloburl')); // To debug.
			}
		});


	});

	$("body").on("click", "#hidewrapDebily", function() {
		$('#wrapDebily').addClass('hide');
	});

	/*jQuery(function($){
		$(document).mouseup(function (e){ // событие клика по веб-документу
			console.log(e)
			console.log(e.target.id)
			if (e.target.id !='butSave' && e.target.id !='butHistory' ) {
				hideIsNotBlock('#wrapDebily')
				hideIsNotBlock('#historyList2')
			}



		});
	});*/

	function hideIsNotBlock(idBlock){

		var div = $(idBlock); // тут указываем ID элемента
			if (! div.is(e.target) // если клик был не по нашему блоку
				&& div.has(e.target).length === 0) { // и не по его дочерним элементам
					if(! div.hasClass('hide')) {
						div.addClass('hide');
					}
			}

	}
	
</script>



 <style>
	.topbar-nav{
		background-color:black;
	}
 </style>