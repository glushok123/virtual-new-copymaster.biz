<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
if (!isset($_SESSION['user_logged_in']))
{

	header('Location:authentication-login.html');
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>КОПИМАСТЕР ОБРАБОТКА ЗАЯВОК</title>
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

	<link rel="stylesheet" href="node_modules/tableexport/dist/css/tableexport.css">
	<script src="node_modules/blobjs/Blob.min.js"></script>
	<script src="node_modules/xlsx/dist/xlsx.core.min.js"></script>
	<script src="node_modules/file-saverjs/FileSaver.js"></script>
	<script src="node_modules/tableexport/dist/js/tableexport.js"></script>

</head>

<body class="bg-theme bg-theme1">


					<div id='wrapper' class='basic'>
						<div id='wrapMenu'>
							<div id='m1' class='menu a'></div>
							<div id='m2' class='menu aa'></div>
							<div id='m3' class='menu aaa'></div>
							<div id='m4' class='menu aaaa'></div>
							<div id='m5' class='menu aaaaa'></div>
							<div id='m6' class='menu aaaaaa'></div>
						</div>
						<div id='wrapServ'>
							<div class='box'>Кол-во <span id='metricSpan'>шт.</span><input id='inpNum' value='0'></div>
							<div class='box'>Цена<input id='inpPrice' value='0'></div>
							<div class='box'>Стоимость<input id='inpSum' value='0' readonly></div>

							<div id='compName' class='box2'>Клиент<input id='inpName'></div>
							<div id='comptel' class='box2'>Номер телефона (почта)<input id='tel'></div>
							<div id='compsrok' class='box2'>Сроки<input id='srok'></div>

							<div id='butFiz' class='butn sel'>Физ. лицо</div>
							<div id='butUrl' class='butn'>Юр. лицо</div>
							<div id='butChekAdd' class='butn'>Добавить в чек</div>

							<!--div id='compName' class='box '><input id='inpName' placeholder='заказчик'></div-->
						</div>
						<div id='wrapDebily' class="hide">

							<div id='butFizn' class='butn'>
								<h1>Наличный расчёт</h1>
							</div>
							<div id='butFizk' class='butn'>
								<h1>Безналичный расчёт</h1>
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
								<tr>
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
								<span class='skidName'>Добавить скидку</span>
								<input id='inpDiscProc' value='0' class='skidInputs'><span class='skidInputs'>% &nbsp;</span>
								<input id='inpDiscRub' value='0' class='skidInputs'><span class='skidInputs'>р.</span>
							</div>
							<div class='butn' id='butSave'>Оплатить</div>
							<div id='butHistory' class='butn'><span id="infoCheckSave"></span>История чеков</div>
							<div id='historyList' class="hide"></div>

							<div id='historyList2' class="hide"></div>

							<div class='butn' id='butPrint'>Печать чека</div>
							<div class='butn' id='butSaveCher'>Добавить в черновик</div>
							<div class='butn' id='butHistoryCher'>Черновики</div>

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
	<link rel="stylesheet" href="stylo.css" />
	<script src="mainur.js"></script>

</body>
</html>
<style media="screen">
.ogrsize{
	max-width: 80px;
	min-width: 80px;
}
#c,#d,#e,#aaai,#aaaj,#aaah,#aaag,#aaaf,#aaae,#aaad,#aaac,#aaab,#aaaa,#aaba,#aabb,#aabc,#aabd,#aabe,#aabf,#aabg,#aabh,#abba,#abbb,#abbc,#abbd,#abbe,#abbf,#abbaс,#abbad,#abaa,#abab,#abac,#abad,#abae,#abaf,#abag,#abah,#abai,#abaaс,#abaad,
#bb, #bc{
    display: none !important;
   }
   #aaaac, #aaaad,#aabac,#aabad{
    display: none !important;
   }
</style>
