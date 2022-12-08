<?php
	exit();
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
?>

<!DOCTYPE html>
<html lang="ru"> 
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv='expires' content='0'>
	<meta http-equiv='pragma' content='no-cache'>
	
	<title>КОПИМАСТЕР КАЛЬКУЛЯТОР ФИЗ. ЛИЦ</title>
	
	<!-- loader start-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- loader end-->

	<link rel="shortcut icon" href="../img/favicon.ico"/>
	<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/css/icons.css" />
	<link rel="stylesheet" href="assets/css/app.css" />
	<link rel="stylesheet" href="assets/plugins/datatable/css/buttons.bootstrap4.min.css" />
	<link rel="stylesheet" href="assets/plugins/datatable/css/dataTables.bootstrap4.min.css" />
	<link rel="stylesheet" href="node_modules/tableexport/dist/css/tableexport.css">
	<script src="node_modules/blobjs/Blob.min.js"></script>
	<script src="node_modules/xlsx/dist/xlsx.core.min.js"></script>
	<script src="node_modules/file-saverjs/FileSaver.js"></script>
	<script src="node_modules/tableexport/dist/js/tableexport.js"></script>
 	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="assets/js/jquery.min.js"></script>
</head>

<body class="bg-theme bg-theme9">

	<div class="wrapper ">
		<header class="top-header">
			<nav class="navbar navbar-expand">
				
				<div class="sidebar-header">

				</div>
				<!--div class="flex-grow-1 search-bar">

				</div-->

			</nav>
		</header>

		<!--end header-->
		<!--navigation-->
		<div class="nav-container">
			<nav class="topbar-nav">
				<ul class="metismenu" id="menu">

					

				</ul>
			</nav>
		</div>
	</header>
	</div>

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
			<div class='box'>Кол-во <span id='metricSpan'>шт.</span>
				<input id='inpNum' value='0'>
			</div>
			<div class='box'>Цена
				<input id='inpPrice' value='0'>
			</div>
			<div class='box'>Стоимость
				<input id='inpSum' value='0' readonly>
			</div>
			<div id='compName' class='box2'>Клиент
				<input id='inpName'>
			</div>
			<div id='comptel' class='box2'>Контакты
				<input id='tel'>
			</div>
			<div id='compsrok' class='box2'>Сроки/Коммент
				<input id='srok'>
			</div>
			<div id='butFiz' class='butn sel'>Физ. лицо</div>
			<div id='butUrl' class='butn'>Юр. лицо</div>
			<div id='butChekAdd' class='butn'>Добавить в чек</div>
			<!--div id='compName' class='box '><input id='inpName' placeholder='заказчик'></div-->
		</div>
		<div id='wrapDebily' class="hide">
			<div class="row">
				<!--div class="col-1">
										<button id="hidewrapDebily" type="button" class="btn btn-danger" style="">X</button>
									</div-->
				<div class="col-5">
					<button id='butFizn' type="button" class="butn" style="width:210px; height:80px;"> Наличный расчёт </button>
				</div>
			</div>
			<div class='row'>
				<div class="col-5">
					<button id='butFizk' type="button" class="butn" style="width:210px; height:80px;"> Безналичный расчёт </button>
				</div>
			</div>
		</div>
		<div id='wrapSchetHead'>
			<table class='tb t10'>
				<tr>
					<td rowspan='2' colspan='2'>ПАО "ПРОМСВЯЗЬБАНК" Г. МОСКВА
						<br><sub>Банк получателя</sub></td>
					<td>БИК</td>
					<td>044525555</td>
				</tr>
				<tr>
					<td>Сч. №</td>
					<td>30101810400000000555</td>
				</tr>
				<tr>
					<td>ИНН 7721282097</td>
					<td>КПП 772901001</td>
					<td rowspan='3'>Сч. №</td>
					<td rowspan='3'>40702810700000029669</td>
				</tr>
				<tr>
					<td colspan='2'>ООО "Копимастер"
						<br>
						</sub>Получатель</sub>
					</td>
				</tr>
			</table>
			<h1>Счет на оплату № <span class='chekId'>...</span> от 14.09.2020</h1>
			<hr>
			<table class='t10'>
				<tr>
					<td>Поставщик
						<br><sub>(Исполнитель)</sub></td>
					<th>ООО "Копимастер", ИНН 7721282097, КПП 772901001, 119285, Москва г, Пырьева ул, дом № 11-А,
						<br>помещение 4, ком.13, тел: 8-495-229-56-62</th>
				</tr>
				<tr>
					<td>Покупатель
						<br><sub>(Заказчик)</sub></td>
					<th class='komName'>...</th>
				</tr>
				<tr>
					<td>Основание</td>
					<th>Счёт <span class='chekId'>...</span> от 14.09.2020</th>
				</tr>
			</table>
		</div>
		<div id='wrapTovarchekNalHead'>
			<div class='right'> <img src="users/copyfast/logo.png">
				<br> Наименование организации: ИП Васюков И.Г.
				<br> ИНН: 500601498899
				<br> Юридический адрес: 143090, Мос. обл, г. Краснознаменск, ул. Строителей, д. 3, кв. 25
				<br> </div>
			<br>
			<div class='center large'>Товарный чек <span class='chekId'>..</span> от <span class="chekDate">14.09.2020</span></div>
			<div class='center small'>За наличный расчет</div>
			<br> </div>
		<div id='wrapTovarchekBeznalHead'>
			<div class='right'> <img src="users/copyfast/logo.png">
				<br> </div>
			<div class='center large'>Акт сдачи приемки работ <span class='chekId'>..</span> от <span class="chekDate">14.09.2020</span></div>
			<hr>
			<div> ООО "Копимастер", именуемый в дальнейшем 'Исполнитель', в лице Генерального Директора Васюковой В.И., действующий на основании устава, с одной стороны и <span class='komName'>Огранизация</span>, именуемый в дальнейшем 'Заказчик', составили настоящий Акт о том, что Исполнителем на основании задания Заказчика оказаны следующие печатные услуги: </div>
			<br> </div>
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
			<br>
			<br>
			<br>
			<br>
			<div>___________________ ИП Васюков</div>
		</div>
		<div id='wrapTovarchekBeznalFoot'>
			<div class='itogo'>Итого</div>
			<div class='itogoNds'>В том числе НДС:</div>
			<hr>
			<br>
			<br>
			<table class="center wide">
				<tr>
					<td>Работу сдал от Исполнителя</td>
					<td>Работу принял от Заказчика</td>
				</tr>
				<tr>
					<td>___________________________</td>
					<td>___________________________</td>
				</tr>
				<tr>
					<td><sup>(подпись)</sup></td>
					<td><sup>(подпись)</sup></td>
				</tr>
				<tr>
					<td>"____"____________20</td>
					<td>"____"____________20</td>
				</tr>
				<tr>
					<td>М.П.</td>
					<td>М.П.</td>
				</tr>
			</table>
		</div>
		<div id='wrapChekContrl'>
			<div id='someOtherDiv'> </div>
			<div id='butNew' class='butn'>Новый чек</div>
			<div class='butn span' id='butSkid'> <span class='skidName'>Cкидка</span>
				<input id='inpDiscProc' value='0' class='skidInputs'><span class='skidInputs'>% &nbsp;</span>
				<input id='inpDiscRub' value='0' class='skidInputs'><span class='skidInputs'>р.</span> </div>
			<div class='butn' id='butSave'>Оплатить</div>
			<div id='butHistory' class='butn'><span id="infoCheckSave"></span>История чеков</div>
			<div id='historyList' class="hide"></div>
			<div id='historyList2' class="hide"></div>
			<div class='butn' id='butPrint'>Печать чека</div>
			<div class='butn' id='butSaveCher' style="background-color:#1fcbff; color: black">В черновик</div>
			<div class='butn' id='butHistoryCher'>Черновики</div>
			<!--div class='butn' id='btnExport' style="background-color:red; color: white">Экспорт в PDF</div-->
		</div>
	</div>

	<!--end switcher-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<!--plugins-->
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>

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
		#aaaj, /* A4 калька 250 */
		#aaai  /* A4 самоклейка */
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
		#abah, /* A4 гл 250 */
		#abai /* A4 самоклейка */
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
		#abcd /* A2 мат 300 */
		{
			display: none !important;
		}

		/*#abdb /* A1 калк 90 */
		{
			display: none !important;
		}

		#abeb /* A0 калк 90 */
		{
			display: none !important;
		}

</style>
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
</style>

<style>
	.topbar-nav{
		background-color:black;
	}
</style>

<script type="text/javascript">

	$("body").on("click", "#hidewrapDebily", function() {
		$('#wrapDebily').addClass('hide');
	});

	jQuery(function($){
		$(document).mouseup(function (e) { // событие клика по веб-документу
			if (e.target.id !='butSave' && e.target.id != 'butHistory' ) {
				hideIsNotBlock('#wrapDebily')
				hideIsNotBlock('#historyList2')
			}
		});
	});

	function hideIsNotBlock(idBlock){
		var div = $(idBlock); // тут указываем ID элемента
		if (!div.is(e.target) // если клик был не по нашему блоку
			&& div.has(e.target).length === 0) { // и не по его дочерним элементам
				if(!div.hasClass('hide')) {
					div.addClass('hide');
				}
		}
	}

</script>

