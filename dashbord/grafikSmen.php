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
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js"></script>
	
	<script src="assets/js/app.js"></script>
		<div class="page-wrapper">
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="container">
						 <div class="row text-center">
							 <h1>График смен</h1>
						 </div>
					</div>
					<hr>
					
					<div class="container">
						<div class="row">
							<div class="col-6 col-lg-6 col-xl-6">
								<h4>Месяц</h4>
								<select id="messec" class="form-control" aria-label=".form-select-lg example">
								 <option value="1">  Январь	  </option>
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
									<option value="2023" >2023</option>
									<option value="2024" selected>2024</option>
								</select>
							</div>
						</div>
					</div>
					
					<?php
    					if (!isset($_SESSION['user_logged_in'])) {
    						echo "Необходимо авторизоваться!";
    						exit();
    					}
    					else
    					{
    
    						 if($_SESSION['type'] == "admin"){
    							echo '
									<br><hr>
		
									<!--button class="btn btn-info  m-1 px-5" type="button" name="button" id="saveTable">Сохранить</button>
									<button class="btn btn-info  m-1 px-5"type="button" name="button" id="editTable">Редактировать</button>
									<button class="btn btn-info  m-1 px-5"type="button" name="button" id="slogTable">Расчёт времени</button-->
		
									<button type="button" name="button" class="cvet2 bel" data-chet="bel">		Админ		</button>
									<button type="button" name="button" class="cvet kor" data-chet="kor">		Менеджер	</button>
									<button type="button" name="button" class="cvet filo" data-chet="filo">		Дизайнер	</button>
									<button type="button" name="button" class="cvet jolt" data-chet="jolt">		Стажер		</button>
									<button type="button" name="button" class="cvet golub" data-chet="golub">	Кузня		</button>
		
									<button type="button" name="button" class="cvet kras" data-chet="kras">		Отпуск		</button>
									<button type="button" name="button" class="cvet2 chern" data-chet="chern">	Занят		</button>
									<button type="button" name="button" class="cvet kor2" data-chet="kor2">		Замена		</button>
								
									<button type="button" name="button" class="cvet zel" data-chet="zel">		Ночь		</button>
									<button type="button" name="button" class="cvet deny" data-chet="deny">		День		</button>
		
									<button type="button" name="button" class="cvet del" data-chet="del">		ОЧИСТИТЬ	</button>
									<button type="button" name="button" class="cvet kras"  id="exportpdf">Экспорт в	PDF</button>
    							';
    						}
    					}
					 ?>
					 <hr>

					<div id="mainblock" class="table-responsive">

					</div>

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
	select, input  {
		background-color: transparent;
		-webkit-appearance: none;
		-moz-appearance: none;
		color: white;
		border: none;
	}


	.deny select {
		color:black !important;
		font-weight: bold !important;
	}
	.zel select {
		color:black !important;
		font-weight: bold !important;
	}
	.jolt select {
		color:black !important;
		font-weight: bold !important;
	}
	.kras select {
		color:black !important;
		font-weight: bold !important;
	}
	.golub select {
		color:black !important;
		font-weight: bold !important;
	}
	.deny select {
		color:black !important;
		font-weight: bold !important;
	}

	select::-ms-expand {
	display: none;
	}

	td.vx { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; font-style:italic; color:#000000 !important; font-family:'Arial';  background-color:#FF0000 }
	td.itogo { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; font-style:italic; color:#000000 !important; font-family:'Arial';  background-color:#FFFF00 }
	.kras { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; font-style:italic; color:#000000 !important; font-family:'Arial';  background-color:#FF0000 }
	.jolt { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; font-style:italic; color:black !important; font-family:'Arial';  background-color:#FFFF00; color:black }
	.chern { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; font-style:italic; color:#FFFFFF !important; font-family:'Arial';  background-color:#000000 }
	.bel { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; font-style:italic; color:black !important; font-family:'Arial';  background-color:#FFFFFF; color:black }
	.zel { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; font-style:italic; color:black !important; font-family:'Arial';  background-color:#00B050 }
	.kor { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; font-style:italic; color:#000000 !important; font-family:'Arial';  background-color:#777670 }
	.filo { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; color:black !important; font-family:'Arial';  background-color:#FF6699; color:black }
	.golub { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000 !important; font-family:'Arial';  background-color:#00B0F0 }
	.kor2 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; font-style:italic; color:#000000 !important; font-family:'Arial';  background-color:#B97034 }
	.deny { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; font-style:italic; color:black !important; font-family:'Arial';  background-color:#FFC000; color:black }
	.deny { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; font-style:italic; color:black !important; font-family:'Arial';  background-color:#FFC000; color:black }

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


</body>
</html>
<style media="screen">
	#table2{
		max-width: 500px !important;
	}

	input{

	}

</style>
<script type="text/javascript">

	$(document).ready(function(){
	    var login = "<?php echo $_SESSION['login']; ?>";
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
		m = m + 1

	$.ajax({
		url: 'time.php', 
		method: 'POST', 
		data:{
			mes		: m,
			s		: "get",
			year	: $('#years').val()
		}, 
		success: function(response){
		$('#mainblock').html(response);
		$('#messec option[value=' + m + ']').prop('selected', true);

		buildEditTable()
	}});

	$( "#messec" ).change(function() {
		$.ajax({
			url: 'time.php', 
			method: 'POST', 
			data:{
				mes		: $(this).val(),
				s		: "get",
				year	: $('#years').val()
			}, 
			success: function(response){
				$('#mainblock').html(response);
				buildEditTable()
			}});
	});
	
	$( "#years" ).change(function() {
		$.ajax({
			url: 'time.php', 
			method: 'POST', 
			data:{
				mes		: $('#messec').val(),
				s		: "get",
				year	: $('#years').val()
			}, 
			success: function(response){
				$('#mainblock').html(response);
				buildEditTable()
			}});
	});
	
	function buildEditTable() {
		$('#editTable').hide();

		var schet = 0;
		$('#table2 tr').each(function(row){
			$(this).find('td').each(function(cell){
				schet =  schet + 1;
				let cvel = $(this).text();
				if ($(this).hasClass('valday')){
					if ($(this).text() != ""){

						let id = "select"+schet+"";
						$(this).html('<select class="timeWork" style = "font-weight: bold;  " id="'+id+'"><option  value="0"></option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option>					<option  value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option>	<option  value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option  value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option></select>');
						$('#'+id+' option[value='+cvel+']').prop('selected', true);

					}else{
						$(this).html('<select style = "font-weight: bold;" class="timeWork"><option  value="0"></option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option>					<option  value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option>	<option  value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option  value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option></select>');
					}
				}
				if ($(this).hasClass('fio')){
					$(this).html('<input type="text" name="" value="'+cvel+'" style = "font-weight: bold;color:black">');
				}
			});
		});
	}
	
	$(document).on("click", ".cvet", function(){
		chett = $(this).attr('data-chet');
	})
	$(document).on("click", ".cvet2", function(){
		chett = $(this).attr('data-chet');
	})
	$(document).on("dblclick", "td", function(){
		if (chett == "del"){
			$(this).removeClass('kras jolt chern bel zel kor filo golub kor2 deny del');
			saveData();
			buildEditTable();
		}else{
			$(this).removeClass('kras jolt chern bel zel kor filo golub kor2 deny del');
			$(this).addClass(chett);
			saveData();
			buildEditTable();
		}
	});
	$(document).on("dblclick", ".fio", function(){
		if (chett == "del"){
			$(this).removeClass('kras jolt chern bel zel kor filo golub kor2 deny del');
			saveData();
			buildEditTable();
		}else{
			$(this).removeClass('kras jolt chern bel zel kor filo golub kor2 deny del');
			$(this).addClass(chett);
			saveData();
			buildEditTable();
		}
	});
	$(document).on("click", "#editTable", function(){
		buildEditTable()
	});

	function requestSaveData() {
		var el = document.getElementById( 'table2');

		$.ajax(
			{
				url: 'time.php', 
				method: 'POST', 
				data:{
					mes		 : $('#messec').val(), 
					s		 : "save", 
					text_new : el.outerHTML,
					year	 : $('#years').val()
				}, 
				success: function(response){ }});
	}

	$(document).on("change", "input", function(){
		saveData();
		buildEditTable();

		success_noti('Сохранено')
	})
	$(document).on("change", ".timeWork", function(){
		saveData();
		buildEditTable();

		success_noti('Сохранено');
	})
	$(document).on("click", "#saveTable", function(){
		//$('#editTable').show();
		saveData();
	});

	function calculateTime() {
		var sumitog = 0
		$('#table2 tr').each(function(row){
			let sum = 0;
			$(this).find('td').each(function(cell){
				if ($(this).hasClass('valday')){
							if ($(this).text() != ""){
								sum=sum + Number($(this).text());
							}
				}
				if ($(this).hasClass('itogo')){
							$(this).text(sum);
							sumitog = sumitog + sum
					}
				if ($(this).hasClass('itogo2')){
							$(this).text(sumitog);
					}
			});
		});
	}

	$(document).on("click", "#slogTable", function(){
			calculateTime();
			requestSaveData();
	});
	$(document).on("click", "#exportpdf", function(){

		$('.dennedel').css('color', 'black')
		$('.timeWork').css('color', 'black')

		var element = document.getElementById('mainblock');
		var opt = {
		margin:       10,
		filename:     'График смен.pdf',
		image:        { type: 'jpeg', quality: 1 },
		html2canvas:  { scale: 2, logging: true, dpi: 300, letterRendering: true, width: 1400},
		jsPDF:        { unit: 'mm', format: 'a4', orientation: 'l' }
		};
	
		html2pdf().set(opt).from(element).save();

	});
	
	<?php 
        $arraAccess = ['glushok'];
        if (in_array($_SESSION['login'], $arraAccess)) {
        
        }
    ?>
    
	function saveData(q) {
	    if (! provAccesss()) {
	        location.reload();
	        
	        return;
	    }
		$('#table2 tr').each(function(row) {
			$(this).find('td').each(function(cell) {

				if ($(this).hasClass('valday')){
					let zn = $(this).find('select').val();
					if (zn !="0"){$(this).html(zn)}else($(this).html(''))
				}

				if ($(this).hasClass('fio')){
					let zn = $(this).find('input').val();
					$(this).html(zn);
				}

			});
		});

		calculateTime();
		requestSaveData();
	}
	
	function provAccesss() {
	    arr = ['glushok', 'Boss', 'Manager', 'paulm'];
	    
        if (! arr.includes(login)) {
            alert('!!! ЗАПРЕЩЕНО РЕДАКТИРОВАНИЕ!!!');
            return false;
        }
        
        return true;
	}
})
</script>




