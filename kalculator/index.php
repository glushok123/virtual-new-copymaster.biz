<?php
	//exit();
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
		
		<title>КОПИМАСТЕР КАЛЬКУЛЯТОР ДЛЯ ФИЗ. ЛИЦ</title>
		
		<!-- loader start-->
		<link href="assets/css/pace.min.css" rel="stylesheet" />
		<script src="assets/js/pace.min.js"></script>
		<!-- loader end-->

		<link rel="shortcut icon" href="../img/favicon.ico"/>
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/icons.css" />
		<link rel="stylesheet" href="assets/css/app.css" />
		<script src="assets/js/jquery.min.js"></script>
	</head>

	<body class="bg-theme bg-theme9">
		<div class="wrapper ">
			<div class='container-fluid'>
				<div class='row'>
					<div class='col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4'>
						<a 
							class = "btn-arrow" 
							id = 'goHome'
							style = '
								margin-top:15px;
								margin-left:25px;
								margin-bottom:15px;
							'>
							<span>
								На главную
							</span> 
						</a>
					</div>

					<div class='col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4'>
						<div class="form-group"
							style='
								margin-top:15px;
							'>
							<label>ФИО:</label>
							<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="ФИО" id='fio'>
						</div>
					</div>

					<div class='col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4'>
						<div class="form-group"
						style='
							margin-top:15px;
						'>
							<label for="exampleInputEmail1">Телефон:</label>
							<input type="email" class="form-control" id="phone" aria-describedby="emailHelp" placeholder="Введите номер телефона">
						</div>
					</div>
				</div>
				
			</div>

			<div class='container-fluid'>
				<div class='row'>
					<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>
						<div id='wrapMenu2'>
							<div id='m1' class='menu a'></div>
							<div id='m2' class='menu aa'></div>
							<div id='m3' class='menu aaa'></div>
							<div id='m4' class='menu aaaa'></div>
							<div id='m5' class='menu aaaaa'></div>
							<div id='m6' class='menu aaaaaa'></div>
							<div id='m7' class='menu aaaaaaa'></div>
						</div>
					</div>
					<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>
						<div id='wrapChek'>
							<table>
								<tr class='tht'>
									<td>№</td>
									<td>Услуга</td>
									<td>Кол.</td>
									<td>Ед.</td>
									<td>Цена</td>
									<td>Стоимость</td>
									<td style="display:none">Заказчик</td>
								</tr>
								<tr>
									<td colspan="5">Итого</td>
									<td></td>
									<td style="display:none"></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
		
				<div class='row fixed-bottom' id='blockControl'
					style='
						margin-bottom: 30px;
					'>
					<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 '>
						<div class='row' 
							style='
								margin-bottom:20px;
							'>
							<div class='col text-center'>
								<div class='titel-settings'>Кол-во <span id='metricSpan'>шт.</span>
									<input id='inpNum' value='0' >
								</div>
							</div>
							<div class='col text-center'>
								<div class='titel-settings'>Цена:
									<input id='inpPrice' value='0' disabled="disabled">
								</div>
							</div>
							<div class='col text-center'>
								<div class='titel-settings'>Стоимость:
									<input id='inpSum' value='0' readonly disabled="disabled">
								</div>
							</div>
						</div>
						<div id='wrapChekContrl2'>
							<div class='row '
								style='
									width: 50%;
									margin: 0 auto;
								'>
								<div id='butChekAdd' class='btn btn-success btn-settings'>Добавить в чек</div>
								<div id='butNew' class='btn btn-warning btn-settings'>Новый чек</div>
								<div class='btn btn-primary btn-settings' send-order>Отправить заявку</div>
							</div>

							<div id='someOtherDiv'> </div>

							<div class='butn span' id='butSkid' style='display:none'> 
							<div id='butSave'  class='btn btn-primary btn-settings'>Отправить заявку</div>
							<span class='skidName'>Cкидка</span>
								<input id='inpDiscProc' value='0' class='skidInputs'><span class='skidInputs'>% &nbsp;</span>
								<input id='inpDiscRub' value='0' class='skidInputs'><span class='skidInputs'>р.</span> 
							</div>
							
							<div class='butn' id='butPrint' style='display:none'>Печать чека</div>
						</div>
						<div id='wrapServ2' style='display:none'>
							<div id='compName' class='box2' style='display:none'>Клиент
								<input id='inpName'>
							</div>
							<div id='comptel' class='box2' style='display:none'>Контакты
								<input id='tel'>
							</div>
							<div id='compsrok' class='box2' style='display:none'>Сроки/Коммент
								<input id='srok'>
							</div>
							
							<div id='butFiz' class='butn sel' style='display:none'>Физ. лицо</div>
							<div id='butUrl' class='butn' style='display:none'>Юр. лицо</div>
						</div>

					</div>
					<div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>

					</div>
				</div>
			</div>
		</div>

		<div id='wrapDebily' class="hide">
			<div class="row">
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

		<link rel="stylesheet" href="../dashbord/assets/plugins/notifications/css/lobibox.min.css">
		<script src="../dashbord/assets/plugins/notifications/js/lobibox.min.js"></script>
		<script src="../dashbord/assets/plugins/notifications/js/notifications.js"></script>
		<script src="../dashbord/assets/plugins/notifications/js/notification-custom-script.js"></script>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/app.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
		<link rel="stylesheet" href="stylo.css?m1" />
		<link rel="stylesheet" href="postStyle.css?m1" />
		<script src="main.js"></script>
	</body>
</html>

<script type="text/javascript">
	$(document).ready(function() {
		width = screen.width; // ширина

		if (width < 770) {
			$('#blockControl').removeClass('fixed-bottom');
		}

		$('#phone').mask("+7 (999) 999-99-99");

		$('#goHome').click(function() {
			location.href = window.location.origin;
		});

		$(document).on('click', '[send-order]', function() {
			if (! conditionalPhone()){
				return;
            }

			if (! conditionalFio()) {
				return;
			}

			$(document).trigger('save-order')
		});

        $('#fio').on('blur', function(){
           conditionalFio();
        });

		function conditionalFio(){
			 res = ((/^([А-ЯA-Z]|[А-ЯA-Z][\x27а-яa-z]{1,}|[А-ЯA-Z][\x27а-яa-z]{1,}\-([А-ЯA-Z][\x27а-яa-z]{1,}|(оглы)|(кызы)))\040[А-ЯA-Z][\x27а-яa-z]{1,}(\040[А-ЯA-Z][\x27а-яa-z]{1,})?$/).test($("#fio").val()));
             if (! res){
                 warning_noti("ПРИМЕР: <br> Петров Иван!");
             }

			return res;
		}

		function conditionalPhone(){
			if ($('#phone').val().length != 18){
                warning_noti("Необходимо заполнить телефон!");
				return false;
            }

			return true;
		}

		/**
		 * Сохранение нового заказа
		 *
		 * @return void
		 */
		function saveOrderRequest()
		{	
			let data = {
				'id': 'order-kalkulator',
				'phone': $('#phone').val(),
				'fio': $('#fio').val(),
				'id-order': $('body').attr('id'),
				"email": 'отсутствует',
			}

			$.post("/registerz.php", data, function(data){
				//var myModal = new bootstrap.Modal(document.getElementById('exampleModal3'));
				//myModal.show();
				alert('отправлено')
			});

		}
		$(document).on('save-order-end', function () {
			saveOrderRequest();
		});
	});
</script>