<?
	include('./header.php')
?>
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
	<script src="assets/plugins/edittable/bstable.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

	<script src="assets/js/app.js"></script>
		<div class="page-wrapper">
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="container">
						 <div class="row text-center">
							 <h1>Расчёт средств</h1>
						 </div>
					</div>
						<hr>
						<div class="container">
							<div class="row">
								<div class="col-6 col-lg-6 col-xl-6">
									<h4>Месяц</h4>
									<select id="messec" class="form-control" aria-label=".form-select-lg example">
										<option value="1">  Январь	 </option>
										<option value="2">  Февраль  </option>
										<option value="3">  Март     </option>
										<option value="4">  Апрель   </option>
										<option value="5">  Май      </option>
										<option value="6">  Июнь     </option>
										<option value="7">  Июль     </option>
										<option value="8">  Август   </option>
										<option value="9">  Сентябрь </option>
										<option value="10"> Октябрь  </option>
										<option value="11"> Ноябрь   </option>
										<option value="12"> Декабрь  </option>
									</select>
								</div>
								<div class="col-6 col-lg-6 col-xl-6">
									<h4>Год</h4>
									<select id="years"  class="form-control" aria-label=".form-select-lg example">
										<option value="2022">2022</option>
										<option value="2023">2023</option>
										<option value="2024" selected>2024</option>
									</select>
								</div>
							</div>
						</div>
							<br>
							<hr>
					<?php
					if (!isset($_SESSION['user_logged_in'])) {
						echo "Необходимо авторизоваться!";
						exit();
					}
					else
					{
						if ($_SESSION['type'] == 'admin'){
							echo '
								<!--button class="btn btn-info  m-1 px-5" type="button" name="button" id="saveTable">Сохранить</button>
								<button class="btn btn-info  m-1 px-5"type="button" name="button" id="editTable">Редактировать</button>
								<button class="btn btn-info  m-1 px-5"type="button" name="button" id="slogTable">Расчёт</button>
								<button type="button" name="button" class="cvet2  cvet kras" data-chet="kras"></button>
								<button type="button" name="button" class="cvet2  cvet jolt" data-chet="jolt"></button>
								<button type="button" name="button" class="cvet2  cvet chern" data-chet="chern"></button>
								<button type="button" name="button" class="cvet2  cvet bel" data-chet="bel"></button>
								<button type="button" name="button" class="cvet2  cvet kor" data-chet="kor"></button>
								<button type="button" name="button" class="cvet2  cvet kor2" data-chet="kor2"></button>
								<button type="button" name="button" class="cvet2  cvet golub" data-chet="golub"></button>
								<button type="button" name="button" class="cvet2  cvet filo" data-chet="filo"></button>
								<button type="button" name="button" class="cvet2  cvet zel" data-chet="zel"></button>
								<button type="button" name="button" class="cvet2  cvet deny" data-chet="deny"></button>
								<button-- type="button" name="button" class="cvet2  cvet del" data-chet="del">ОЧИСТИТЬ</button-->
							';
						}
					}
					 ?>

					<div id="mainblockGrafik" style="display:none">

					</div>

					<div id="mainblock" class="table-responsive">

					</div>

					 <hr>
				</div>
			</div>
		</div>


	</div>
	<style media="screen">
		select option {
			background: rgba(0, 0, 0, 0.3);
			color: #fff;
			text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
		}
		td.vx { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; font-style:italic; color:#000000 !important; font-family:'Arial'; font-size:12pt; background-color:#FF0000 }
		td.itogo { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; font-style:italic; color:#000000 !important; font-family:'Arial'; font-size:12pt; background-color:#FFFF00 }
		.kras { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; font-style:italic; color:#000000 !important; font-family:'Arial'; font-size:12pt; background-color:#FF0000 }
		.jolt { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; font-style:italic; color:black !important; font-family:'Arial'; font-size:12pt; background-color:#FFFF00; color:black }
		.chern { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; font-style:italic; color:#FFFFFF !important; font-family:'Arial'; font-size:12pt; background-color:#000000 }
		.bel { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; font-style:italic; color:black !important; font-family:'Arial'; font-size:12pt; background-color:#FFFFFF; color:black }
		.zel { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; font-style:italic; color:black !important; font-family:'Arial'; font-size:12pt; background-color:#00B050 }
		.kor { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; font-style:italic; color:#000000 !important; font-family:'Arial'; font-size:12pt; background-color:#777670 }
		.filo { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; color:black !important; font-family:'Arial'; font-size:12pt; background-color:#FF6699; color:black }
		.golub { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000 !important; font-family:'Arial'; font-size:12pt; background-color:#00B0F0 }
		.kor2 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; font-style:italic; color:#000000 !important; font-family:'Arial'; font-size:12pt; background-color:#B97034 }
		.deny { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; font-style:italic; color:black !important; font-family:'Arial'; font-size:12pt; background-color:#FFC000; color:black }
		.cvet{
			font-size: 18px;
			font-weight: bold;
		}
		.cvet2{
			weight:30px;
			height:30px;
		}
		table {
		table-layout: auto;; /* Фиксированная ширина ячеек */
		max-width: 80%; /* Ширина таблицы */
		}
		.castom-input{
			min-width:100px;
		}
		.castom-textarea{
			min-width:200px;
		}
		#table3{
			max-width: 500px !important;
		}
	</style>

</body>
</html>

<script type="text/javascript">

	$(document).ready(function(){
		var arrayFamily = [];
		var chett = 'kras';

		var days = [
			'Вс',
			'Пн',
			'Вт',
			'Ср',
			'Чт',
			'Пт',
			'Сб'
		];
		var d = new Date();
		var m = d.getMonth();
		var n = d.getDay();
		m = m + 1;

		$('#messec option[value=' + m + ']').prop('selected', true);

		getTableCalcRequest();
		getTableGrafikRequest();

		<? 
			if($_SESSION['type'] == "admin") {
				echo 'editTable();';
			}
		?>

		$( "#messec" ).change(function() {
			arrayFamily = [];

			getTableCalcRequest();
			getTableGrafikRequest();
			editTable();
		});

		$( "#years" ).change(function() {
			arrayFamily = [];

			getTableCalcRequest();
			getTableGrafikRequest();
			editTable();
		});

		$(document).on("click", "#editTable", function() {
			$('#editTable').hide();
			editTable();
		});

		$(document).on("change", "input, textarea", function() {
			saveData();
			calculateMoney();
			requestSaveData();

			arrayFamily = [];
			getTableCalcRequest();
			getTableGrafikRequest();
			editTable();
		});
	
		$(document).on("click", "#saveTable", function() {
			$('#editTable').show();

			saveData();
			calculateMoney();
			requestSaveData();

			arrayFamily = [];
			getTableCalcRequest();
			getTableGrafikRequest();
		});

		$(document).on("click", "#slogTable", function() {
			calculateMoney();
		});

		function getTableCalcRequest()
		{
			$.ajax({
				url: 'moneyOnGrafik.php', 
				method: 'POST',
				async: false, 
				data: {
					mes		: $("#messec").val(),
					s		: "get",
					year	: $('#years').val()
				}, 
				async: false, 
				success: function(response) {
					$('#mainblock').html(response);
					InsertArrayFamily()
				}
			});
		}

		function getTableGrafikRequest()
		{
			$.ajax({
				url: 'time.php', 
				method: 'POST',
				async: false,
				data:{
					mes		: $("#messec").val(),
					s		: "get",
					year	: $('#years').val()
				}, 
				async: false, 
				success: function(response){
					$('#mainblockGrafik').html(response);
					dataInsertTable();
				}
			});
		}

		function calculateMoney()
		{
			var sumitog = 0

			$('#table3 tr').each(function(row){
				let oklad = 0;
				let avans = 0;
				let shtraf = 0;
				let ost = 0;

				$(this).find('td').each(function(cell) {
					if ($(this).hasClass('oklad')) {
						if ($(this).text() != ""){
							oklad = Number($(this).text());
						}
					}

					if ($(this).hasClass('avans')) {
						if ($(this).text() != ""){
							avans = Number(eval($(this).text()));
						}
					}

					if ($(this).hasClass('htraf')) {
						if ($(this).text() != ""){
							shtraf= Number($(this).text());
						}
					}

					if ($(this).hasClass('itog')) {
						$(this).text(ost = oklad - avans - shtraf)
					}
				});
			});
		};
		
		function requestSaveData() {
			var el = document.getElementById('table3');
			$.ajax({
				url: 'moneyOnGrafik.php', 
				method: 'POST',
				async: false,
				data:{
					mes: $('#messec').val(),
					s: "save", 
					year: $('#years').val(),
					text_new: el.outerHTML
				}, 
				success: function(response){	
					toastr.success('Сохранено !');
				}
			});
		};

		function saveData() {
			$('#table3 tr').each(function(row){
				$(this).find('td').each(function(cell){
					if ($(this).hasClass('fio')){
						let zn = $(this).find('input').val();
						$(this).html(zn);
					}
					if ($(this).hasClass('htraf')){
						let zn = $(this).find('input').val();
						$(this).html(zn);
					}
					if ($(this).hasClass('payByHours')){
						let zn = $(this).find('input').val();
						$(this).html(zn);
					}
					if ($(this).hasClass('avans')){
						let zn = $(this).find('textarea').val();
						$(this).html(zn);
					}
					if ($(this).hasClass('oklad')){
						let zn = $(this).find('input').val();
						$(this).html(zn);
					}
					if ($(this).hasClass('koment')){
						let zn = $(this).find('input').val();
						$(this).html(zn);
					}
				});
			});
		};

		function editTable() {
			var schet = 0;
			$('#table3 tr').each(function(row){
				$(this).find('td').each(function(cell){
					schet =  schet + 1;
					let cvel = $(this).text();

					//if ($(this).hasClass('oklad')){
						//$(this).html('<input class="form-control castom-input" type="text" name="" value="' + cvel + '">');
					//}

					if ($(this).hasClass('payByHours')){
						$(this).html('<input class="form-control castom-input" type="number" name="" value="' + cvel + '">');
					}

					if ($(this).hasClass('avans')){
						//$(this).html('<input class="form-control castom-input" type="text" name="" value="' + cvel + '">');
						$(this).html('<textarea class="form-control castom-textarea" rows="2">' + cvel + '</textarea>');
					}

					if ($(this).hasClass('htraf')){
						$(this).html('<input class="form-control castom-input" type="number" name="" value="' + cvel + '">');
					}

					if ($(this).hasClass('koment')){
						$(this).html('<input class="form-control castom-input" type="text" name="" value="' + cvel + '">');
					}
				});
			});
		};

		function printTip(q) {

			if ($(q).hasClass('admin')) {
				return "admin";
			}

			if ($(q).hasClass('dizainer')) {
				return "dizainer";
			}

			if ($(q).hasClass('day')) {
				return "day";
			}

			if ($(q).hasClass('night')) {
				return "night";
			}

			if ($(q).hasClass('intern')) {
				return "intern";
			}
		};

		function dataInsertTable() {
			var schet = 0;

			$('#table2 tr').each(function(row) {
				var family = ''
				var kolTime = ''
				var tip = ''

				$(this).find('td').each(function(cell) {

					let cvel = $(this).text();

					if ($(this).hasClass('fio') && cvel != ''){

						tip = printTip(this);
						family = cvel;
						
					}
					if ($(this).hasClass('itogo')){
						kolTime = cvel;
					}
				});

				if (family != '') {
					var prov = 0

					arrayFamily.forEach(function(v) {
						if (v.family == family) {
							prov = 1
							v.kolTime = kolTime
							v.tip = tip
						}
					})
					
					if (prov == 0) {
						arrayFamily.push(
							{	
								"family" : family,	
								"kolTime" : kolTime,	
								"avans" : 0	,
								"tip" : tip,	
							}
						)
					}
		
				}
			});

			printData();
		};

		function InsertArrayFamily() {
			$('#table3 tr').each(function(row) {
				var family = ''
				var tip = ''
				var avance = 0
				var htraf = 0
				
				$(this).find('td').each(function(cell) {
					let cvel = $(this).text();

					cvel = cvel == undefined ? ' ' : cvel;
					cvel = cvel == 'undefined' ? ' ' : cvel;

					if ($(this).hasClass('fio') && cvel != '' ) {
						family = cvel;
					}
					
					if ($(this).hasClass('avans') && cvel != '' ) {
						avance = cvel;
					}
					
					if ($(this).hasClass('payByHours')) {
						payByHours = cvel;
					}

					if ($(this).hasClass('koment')) {
						koment = cvel;
					}

					if ($(this).hasClass('htraf')) {
						htraf = cvel;
					}
				});

				if (family != '') {
					arrayFamily.push(
						{	
							"family" : family,	
							"kolTime" : 0,	
							"avans" : avance,
							"tip" : tip,			
							"payByHours" : payByHours,			
							"koment" : koment,			
							"htraf" : htraf,			
						}	
					)
				}
			});
		};

		function printData() {
			$('#table3 tbody tr').remove()
			var kol = 0;

			arrayFamily.forEach(function(v) {
				kol = kol + 1;
				let moneyTime = 'Очень много';

				if (v.payByHours == '') {
					if (v.tip == 'day' || v.tip == 'night') {
						moneyTime = v.kolTime * 200;
						v.payByHours = 200;
					}

					if (v.tip == 'intern' ) {
						moneyTime = v.kolTime * 160;
						v.payByHours = 160;
					}
				}else{
					moneyTime = v.kolTime * v.payByHours;
				}

				row = '<tr>';
				row = row + '<td class="chern">' + kol + '</td>';
				row = row + '<td class="fio">' + v.family + '</td>';
				row = row + '<td class="sumByHours">' + v.kolTime + '</td>';
				row = row + '<td class="payByHours">' + v.payByHours + '</td>';
				row = row + '<td class="oklad">' + moneyTime + '</td>';
				row = row + '<td class="avans">' + v.avans + '</td>';
				row = row + '<td class="htraf">' + v.htraf + '</td>';
				row = row + '<td class="jolt itog" style="color:black">' + (moneyTime - eval(v.avans) - v.htraf) + '</td>';
				row = row + '<td class="koment">' + v.koment + '</td> ';
				row = row + '</tr>';

				$('#table3 tbody ').append(row);
			});
		};
	});

</script>