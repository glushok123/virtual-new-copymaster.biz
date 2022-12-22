<?php
$keyw="Цены на печать, печать недорого, копирование недорого, сканирование цена";
$titl="Цены на услуги копировального центра в Москве";
$desc="Цены на услуги печали и копирования в компании «Копимастер» - Печать афиш круглосуточно!";
include_once 'header.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
$db = getDbInstance();

$res = $db->query("SELECT * FROM `pricecalc`");

$price = [];

foreach ($res as $z){
    $price[$z["name"]] = $z["price"];
}

echo($price['petchat_chet_A4_0_odn']);
?>
<section>
  <div class="container">
    <div class="row text-center">
      <br>
      <div class="col">
          <br>
        <a href="#fiz" class="btn btn-sm nav-btn btn-primary mb-4 mb-lg-0 ms-auto bug1">Цены для физических лиц</a>
      </div>
      <div class="col">
          <br>
        <a href="#ur-price" class="btn btn-sm nav-btn btn-primary mb-4 mb-lg-0 ms-auto bug1">Цены для юридических лиц</a>
      </div>

    </div>

  </div>

    <div id="fiz" class="container">
        <br><br>
        <div  class="text-center">
            <h2>Цены для физических лиц</h2>
            <hr>
        </div>

            <div class="table-responsive"><!--Черно - белое копирование / печать А4 и А3-->
                <?php include_once "price/FL/print/BW/fl_b-w_a4_a3.php"; ?>
            </div>

            <div class='pometka-div'>
                <span class='pometka'></span>
            </div>

            <div class="table-responsive"><!--Черно - белое копирование / печать больших форматов-->
                <?php include_once "price/FL/print/BW/fl_b-w_a0-a2.php"; ?>
            </div>

            <div class='pometka-div'>
                <span class='pometka'></span>
            </div>
            <div class="table-responsive"><!--Цветное копирование/печать форматов А4 и А3*-->
                <?php include_once "price/FL/print/CV/fl_c-v_a4_a3.php"; ?>
            </div>

            <div class='pometka-div'>
                <span class='pometka'></span>
            </div>

            <div class="table-responsive"><!--Широкоформатная цветная печать и копирование-->
                <?php include_once "price/FL/print/CV/fl_v-v_a0-a2.php"; ?><!-- !!! Доделать синхронизацию !!! -->
            </div>

            <div class='pometka-div'>
                <span class='pometka'></span>
            </div>

            <div class="table-responsive"><!--Переплетные работы-->
                <?php include_once "price/FL/fl_pereplet.php"; ?>
            </div>

            <div class='pometka-div'>
                <span class='pometka'></span>
            </div>

        	<ul>
        		<li>Вставка одного конверта для CD диска: +<? echo $price['pereplet_vs_k'] ?> рублей к стоимости переплета</li>
        		<li>Вставка одного файла в переплет: +<? echo $price['pereplet_vs_f'] ?> рублей к стоимости переплета</li>
        		<li>Услуга переброшюровки твердого переплета и переплета на металлическую пружину: 50% от стоимости</li>
        		<li>Услуга переброшюровки переплета на пластиковую пружину: <? echo $price['pereplet_pl_per'] ?> рублей</li>
        	</ul>

            <div class="table-responsive"><!--Сканирование*-->
                <?php include_once "price/FL/fl_scan.php"; ?>
            </div>

            <div class='pometka-div'>
                <span class='pometka'></span>
            </div>

            <div class="table-responsive"><!--Услуги дизайнера-->
                <?php include_once "price/FL/fl_dizain.php"; ?>
            </div>

            <div class='pometka-div'>
                <span class='pometka'></span>
            </div>

            <div class="table-responsive"><!--Изготовление печатей и штампов-->
                <?php include_once "price/FL/fl_pet_and_htamp.php"; ?>
            </div>

            <div class='pometka-div'>
                <span class='pometka'></span>
            </div>

            <div class="table-responsive"><!--Печать визиток 90*50 мм-->  
                <?php include_once "price/FL/fl_pet_vizitok.php"; ?> <!-- !!! Добавить синхронизацию !!! -->
            </div>

            <div class='pometka-div'>
                <span class='pometka'></span>
            </div>

            <div class="table-responsive"><!--Ламинирование-->
                <?php include_once "price/FL/fl_laminirov.php"; ?>
            </div>

            <div class='pometka-div'>
                <span class='pometka'></span>
            </div>

            <div class="table-responsive"><!--Накатка на пенокартон-->
                <?php include_once "price/FL/fl_penokarton.php"; ?> <!-- !!! Добавить синхронизацию !!! -->
            </div>

            <div class='pometka-div'>
                <span class='pometka'></span>
            </div>

            <div class="table-responsive"><!--Дополнительные операции-->
                <?php include_once "price/FL/fl_dop_oper.php"; ?>
            </div>

            <div class='pometka-div'>
                <span class='pometka'></span>
            </div>

            <div class="table-responsive"><!--Дополнительные материалы-->
                <?php include_once "price/FL/fl_dop_mater.php"; ?>
            </div>

            <div class='pometka-div'>
                <span class='pometka'></span>
            </div>

        <div id="ur-price" class="text-center">
            <br>  <br>
            	<h2 >Цены для юридических лиц</h2><hr>
        </div>

            <div class="table-responsive"><!--Черно - белое копирование* / печать-->
                <?php include_once "price/YL/yl_bw.php"; ?>
            </div>

            
            <div class='pometka-div'>
                <span class='pometka'></span>
            </div>

            <div class="table-responsive"><!--Цветное копирование/печать форматов А4 и А3*-->
                <?php include_once "price/YL/yl_cv.php"; ?>
            </div>

            <div class='pometka-div'>
                <span class='pometka'></span>
            </div>

            <div class="table-responsive"><!--Широкоформатная цветная печать и копирование*-->
                <?php include_once "price/YL/yl_pet_a0-a2.php"; ?>
            </div>

            <div class='pometka-div'>
                <span class='pometka'></span>
            </div>

            <div class="table-responsive"><!--Переплетные работы-->
                <?php include_once "price/YL/yl_pereplet.php"; ?>
            </div>

            <div class='pometka-div'>
                <span class='pometka'></span>
            </div>

            <div class="table-responsive"><!--Цветное/Черно-белое cканирование*-->
                <?php include_once "price/YL/yl_scan.php"; ?>
            </div>

            <div class='pometka-div'>
                <span class='pometka'></span>
            </div>

        	<p>Указанные цены действительны при заключении договора на обслуживание и единовременном заказе от 30000 рублей. Подробную консультацию о скидках можно получить у нашего менеджера.</p>


    </div>
</section>

            <hr>
            <div class='container'>
                <div class='row text-center'>
                    <h2>Калькулятор цен для физических лиц</h2>
                    <div class='pometka-div'>
                        <span class='pometka'></span>
                    </div>
                </div>
            </div>

            <hr>
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
						<div id='wrapChek' class='table-responsive'>
							<table class="table">
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
		
				<div class='row' id='blockControl'
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
								<div id='butNew' class='btn btn-warning btn-settings' style='display:none'>Удалить данные чека</div>
								
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

            <div class='container' style='max-width:400px'>
				<div class='row text-center' >
                    <div class="form-group"
                        style='
                            margin-top:15px;
                        '>
                        <label>ФИО:</label>
                        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="ФИО" id='fio'>
                    </div>
				</div>
                <div class='row text-center'>
	                <div class="form-group"
						style='
							margin-top:15px;
						'>
							<label for="exampleInputEmail1">Телефон:</label>
							<input type="email" class="form-control" id="phone" aria-describedby="emailHelp" placeholder="Введите номер телефона">
					</div>
				</div>
                <div class='row text-center'>
	                <div class="form-group"
						style='
							margin-top:15px;
						'>
							<label for="exampleInputEmail1">Почта:</label>
							<input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Введите email">
					</div>
				</div>

                <div class='row text-center'>
                    <div class='btn btn-primary btn-settings ' send-order>Отправить заявку</div>
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
<style>
    .pometka-div{
        margin-bottom:10px;
        
    }
</style>

<?php
    include_once 'footer.php';
?>

<script src="dashbord/assets/plugins/edittable/bstable.js"></script>
<link rel="stylesheet" href="/dashbord/assets/plugins/notifications/css/lobibox.min.css">
<script src="/dashbord/assets/plugins/notifications/js/lobibox.min.js"></script>
<script src="/dashbord/assets/plugins/notifications/js/notifications.js"></script>
<script src="/dashbord/assets/plugins/notifications/js/notification-custom-script.js"></script>
<script src="/kalculator/assets/js/jquery.min.js"></script>
<script src="/kalculator/assets/js/bootstrap.min.js"></script>
<script src="/kalculator/assets/js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
<link rel="stylesheet" href="/kalculator/stylo.css?m1" />
<link rel="stylesheet" href="/kalculator/postStyle.css?m1" />
<script src="/kalculator/main.js"></script>
<script type="text/javascript">

    $('.pometka').each(function(i, obj) {
        $(this).text('*данная стоимость является базовой. Точная стоимость услуг определяется в зависимости от сложности менеджером по работе с клиентами.')
    });

</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#phone').mask("+7 (999) 999-99-99");

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
				"email": $('#email').val(),
			}

            console.log(data); 

			$.post("registerz.php", data, function(data){
                var myModal = new bootstrap.Modal(document.getElementById('exampleModal3'));
                myModal.show();
			});

		}
		$(document).on('save-order-end', function () {
			saveOrderRequest();
		});
	});
</script>