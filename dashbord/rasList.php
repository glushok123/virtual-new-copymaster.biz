<?
	include('./header.php')
?>
		<div class="page-wrapper">
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="container">
						 <div class="row text-center">
							 <h1>Расчёт средств</h1>
						 </div>
					</div>
						<hr>
					<?php
					if (!isset($_SESSION['user_logged_in'])) {
						echo "Необходимо авторизоваться!";
						exit();
					}
					else
					{
						if (  $_SESSION['type'] == "admin"){
							echo '
							<div class="container">
								<div class="row">
									<div class="col-6 col-lg-6 col-xl-6">
										<h4>Месяц</h4>
										<select id="messec" class="form-control" aria-label=".form-select-lg example">
										 <option selected></option>
										 <option value="6">Июнь</option>
										 <option value="7">Июль</option>
										 <option value="8">Август</option>
										 <option value="9">Сентябрь</option>
										 <option value="10">Октябрь</option>
										 <option value="11">Ноябрь</option>
										 <option value="12">Декабрь</option>
										 </select>
										 </select>
									</div>
									<div class="col-6 col-lg-6 col-xl-6">
										<h4>Год</h4>
										<select id="tibum_vizit"  class="form-control" aria-label=".form-select-lg example">
										 <option selected value="2022">2022</option>
										 </select>
									</div>
								</div>
							</div>
							<br>
							<hr>
							<button class="btn btn-info  m-1 px-5" type="button" name="button" id="saveTable">Сохранить</button>
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
							<button type="button" name="button" class="cvet2  cvet del" data-chet="del">ОЧИСТИТЬ</button>
							<div id="mainblock">

							 </div>
							';

						}
						else{
							echo "Необходимо быть администратором :) ";
						}
					}
					 ?>





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
</style>
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
	<script src="assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
	<script src="assets/js/index.js"></script>
	<!-- App JS -->
	<link rel="stylesheet" href="assets/plugins/datatable/css/buttons.bootstrap4.min.css" />
	<link rel="stylesheet" href="assets/plugins/datatable/css/dataTables.bootstrap4.min.css" />
	<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/edittable/bstable.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<script type="text/javascript" src="lib/cdnjs/jspdf.debug.js"></script>
	<script src="assets/js/app.js"></script>

</body>
</html>
<style media="screen">
	#table2{
		max-width: 500px !important;
	}
</style>
<script type="text/javascript">

$(document).ready(function(){
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
	m = m +1

$.ajax({url: 'rsl.php', method: 'POST', data:{mes:m,s:"get"}, success: function(response){
			$('#mainblock').html(response);
			$('#messec option[value='+m+']').prop('selected', true);
			var table = $('#table2').DataTable({
			buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
		});
		table.buttons().container().appendTo('#mainblock .col-md-6:eq(0)');
	}});

$( "#messec" ).change(function() {
	$.ajax({url: 'rsl.php', method: 'POST', data:{mes:$(this).val(),s:"get"}, success: function(response){
			$('#mainblock').html(response);
		}});

});


$(document).on("click", ".cvet", function(){
	chett = $(this).attr('data-chet');
})

$(document).on("dblclick", "td", function(){
		if (chett == "del"){
			$(this).removeClass('kras jolt chern bel zel kor filo golub kor2 deny del');
		}else{
			$(this).removeClass('kras jolt chern bel zel kor filo golub kor2 deny del');
			$(this).addClass(chett);
		}

});

$(document).on("dblclick", ".fio", function(){
	if (chett == "del"){
		$(this).removeClass('kras jolt chern bel zel kor filo golub kor2 deny del');
	}else{
		$(this).removeClass('kras jolt chern bel zel kor filo golub kor2 deny del');
		$(this).addClass(chett);
	}
});

$(document).on("click", "#editTable", function(){
	$('#editTable').hide();

	var schet = 0;
	$('#table2 tr').each(function(row){
		$(this).find('td').each(function(cell){
			 schet =  schet + 1;
			 let cvel = $(this).text();

			if ($(this).hasClass('oklad')){
				$(this).html('<input type="text" name="" value="'+cvel+'">');
			}
			if ($(this).hasClass('avans')){
				$(this).html('<input type="text" name="" value="'+cvel+'">');
			}
			if ($(this).hasClass('htraf')){
				$(this).html('<input type="text" name="" value="'+cvel+'">');
			}
			if ($(this).hasClass('fio')){
				$(this).html('<input type="text" name="" value="'+cvel+'">');
			}
			if ($(this).hasClass('koment')){
				$(this).html('<input type="text" name="" value="'+cvel+'">');
			}
		});
	});
});

$(document).on("click", "#saveTable", function(){
		$('#editTable').show();
		$('#table2 tr').each(function(row){
			$(this).find('td').each(function(cell){
				if ($(this).hasClass('fio')){
					let zn = $(this).find('input').val();
					$(this).html(zn);
				}
				if ($(this).hasClass('htraf')){
					let zn = $(this).find('input').val();
					$(this).html(zn);
				}
				if ($(this).hasClass('avans')){
					let zn = $(this).find('input').val();
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
		var el = document.getElementById( 'table2' );
		$.ajax({url: 'rsl.php', method: 'POST', data:{mes:m,s:"save", text_new: el.outerHTML}, success: function(response){	}});

		console.log(el.outerHTML )
});

$(document).on("click", "#slogTable", function(){
		var sumitog = 0
		$('#table2 tr').each(function(row){
			let oklad = 0;
			let avans = 0;
			let shtraf = 0;
			let ost = 0;
			$(this).find('td').each(function(cell){

				if ($(this).hasClass('oklad')){
							if ($(this).text() != ""){
								oklad= Number($(this).text());
							}
				}
				if ($(this).hasClass('avans')){
							if ($(this).text() != ""){
								avans= Number($(this).text());
							}
				}
				if ($(this).hasClass('htraf')){
							if ($(this).text() != ""){
								shtraf= Number($(this).text());
							}
				}
				if ($(this).hasClass('itog')){

							$(this).text(	ost = oklad - avans - shtraf)
					}

			});
		});
});


})
</script>

<script>

</script>
