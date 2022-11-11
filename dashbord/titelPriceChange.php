<?
	include('./header.php')
?>

<style>
	.calcprice{
		width: 60px;
		height: 30px;
		background-color: transparent;
		border: none;
		color: white;
	}
	.calc-titel{
		width: 100%;
		background-color: transparent;
		border: none;
		color: white;
	}
</style>

		<div class="page-wrapper">
			<div class="page-content-wrapper">

				<div class="page-content">
				<?php 
					if (  $_SESSION['type'] != "admin")
					{
						echo 'ДОСТУП ЗАПРЕЩЕН !!! ';
						exit;
					}
				?>
				<hr>
					<button type="button" name="button" id="save" class="btn btn-light m-1 px-5 radius-30">Сохранить</button>
					<input type="text" value='' class='btn btn-light m-1 px-5 radius-30' id='poisk'>
				<hr>
					<div class='container'>
						<div class='row text-center justify-content-center'>
							<h3 class='btn-warning'>ПЕЧАТЬ</h3>
						</div>
					</div>
					<div class="table-responsive-sm">
						<table class="table align-middle table-striped table-bordered table-sm" id='print'>
							<tbody>
								<?php
									require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
									$db = getDbInstance();

									$res = $db->query("SELECT * FROM `titel_calc`");

									foreach ($res as $item) {
										if (substr($item["name"], 0, 1) == 'a') {
											if (strlen($item["name"]) == 2) {
												echo('
													<tr>
														<td id=' . $item["name"] . '></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
												');
											}
											if (strlen($item["name"]) == 3) {
												echo('
													<tr>
														<td ></td>
														<td id=' . $item["name"] . '></td>
														<td></td>
														<td></td>
													</tr>
												');
											}
											if (strlen($item["name"]) == 4) {
												echo('
													<tr>
														<td ></td>
														<td></td>
														<td id=' . $item["name"] . '></td>
														<td></td>
													</tr>
												');
											}
											if (strlen($item["name"]) == 5) {
												echo('
													<tr>
														<td ></td>
														<td></td>
														<td></td>
														<td id=' . $item["name"] . ' class="btn-info"></td>
													</tr>
												');
											}
										}

									}
								?>
							</tbody>
						</table>
					</div>

					<div class='container'>
						<div class='row text-center justify-content-center'>
							<h3 class='btn-warning'>Переплет</h3>
						</div>
					</div>
					<div class="table-responsive-sm">
						<table class="table align-middle table-striped table-bordered table-sm" id='pereplet'>
							<tbody>
								<?php
									
									foreach ($res as $item) {
										if (substr($item["name"], 0, 1) == 'b') {
											if (strlen($item["name"]) == 2) {
												echo('
													<tr>
														<td id=' . $item["name"] . '></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
												');
											}
											if (strlen($item["name"]) == 3) {
												echo('
													<tr>
														<td ></td>
														<td id=' . $item["name"] . '></td>
														<td></td>
														<td></td>
													</tr>
												');
											}
											if (strlen($item["name"]) == 4) {
												echo('
													<tr>
														<td ></td>
														<td></td>
														<td id=' . $item["name"] . '></td>
														<td></td>
													</tr>
												');
											}
											if (strlen($item["name"]) == 5) {
												echo('
													<tr>
														<td ></td>
														<td></td>
														<td></td>
														<td id=' . $item["name"] . '  class="btn-info"></td>
													</tr>
												');
											}
										}

									}
								?>
							</tbody>
						</table>
					</div>

					<div class='container'>
						<div class='row text-center justify-content-center'>
							<h3 class='btn-warning'>Прочее</h3>
						</div>
					</div>
					<div class="table-responsive-sm">
						<table class="table align-middle table-striped table-bordered table-sm" id='prochee'>
							<tbody>
								<?php
									
									foreach ($res as $item) {
										if (substr($item["name"], 0, 1) == 'c') {
											if (strlen($item["name"]) == 2) {
												echo('
													<tr>
														<td id=' . $item["name"] . '></td>
														<td></td>
														<td></td>
														
													</tr>
												');
											}
											if (strlen($item["name"]) == 3) {
												echo('
													<tr>
														<td ></td>
														<td id=' . $item["name"] . '></td>
														<td></td>
														
													</tr>
												');
											}
											if (strlen($item["name"]) == 4) {
												echo('
													<tr>
														<td ></td>
														<td></td>
														<td id=' . $item["name"] . '  class="btn-info"></td>
														
													</tr>
												');
											}

										}

									}
								?>
							</tbody>
						</table>
					</div>

					<div class='container'>
						<div class='row text-center justify-content-center'>
							<h3 class='btn-warning'>Дизаин</h3>
						</div>
					</div>
					<div class="table-responsive-sm">
						<table class="table align-middle table-striped table-bordered table-sm" id='dizain'>
							<tbody>
								<?php
									
									foreach ($res as $item) {
										if (substr($item["name"], 0, 1) == 'd') {
											if (strlen($item["name"]) == 2) {
												echo('
													<tr>
														<td id=' . $item["name"] . '>
															<input value="' . $item["titel"] . '" class="calc-titel" type="text">
														</td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														
													</tr>
												');
											}
											if (strlen($item["name"]) == 3) {
												echo('
													<tr>
														<td ></td>
														<td id=' . $item["name"] . '></td>
														<td></td>
														<td></td>
														<td></td>
														
													</tr>
												');
											}
											if (strlen($item["name"]) == 4) {
												echo('
													<tr>
														<td ></td>
														<td></td>
														<td id=' . $item["name"] . '></td>
														<td></td>
														<td></td>
														
													</tr>
												');
											}
											if (strlen($item["name"]) == 5) {
												echo('
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td id=' . $item["name"] . '></td>
														<td></td>
														
													</tr>
												');
											}
											if (strlen($item["name"]) == 6) {
												echo('
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td id=' . $item["name"] . '  class="btn-info"></td>
														
													</tr>
												');
											}
										}

									}
								?>
							</tbody>
						</table>
					</div>


					<div class='container'>
						<div class='row text-center justify-content-center'>
							<h3 class='btn-warning'>Багетка</h3>
						</div>
					</div>
					<div class="table-responsive-sm">
						<table class="table align-middle table-striped table-bordered table-sm" id='bagetka'>
							<tbody>
								<?php
									
									foreach ($res as $item) {
										if (substr($item["name"], 0, 1) == 'e') {
											if (strlen($item["name"]) == 2) {
												echo('
													<tr>
														<td id=' . $item["name"] . '></td>
														<td></td>
														<td></td>
														
													</tr>
												');
											}
											if (strlen($item["name"]) == 3) {
												echo('
													<tr>
														<td ></td>
														<td id=' . $item["name"] . '></td>
														<td></td>
														
													</tr>
												');
											}
											if (strlen($item["name"]) == 4) {
												echo('
													<tr>
														<td ></td>
														<td></td>
														<td id=' . $item["name"] . '  class="btn-info"></td>
														
													</tr>
												');
											}

										}

									}
								?>
							</tbody>
						</table>
					</div>
				</div>
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

	<script type="text/javascript">

	</script>

</body>
</html>
<style media="screen">
.ogrsize{
	max-width: 80px;
	min-width: 80px;
}
</style>
<script type="text/javascript">

$(document).ready(function(){


	$.ajax({url: 'getTitelPrice.php', method: 'GET', dataType: 'json', success: function(response){
		$.each(response, function(k, v) {
					$('#'+k+'').html('<input  value="'+v+'" class="calc-titel" type="text">')
			 });
	}})


	$('#save').click(function(){
		var json = '{';

		$('#print tr').each(function(row){
			$(this).find('td').each(function(cell){
				if ($(this).attr('id') != undefined){
					let textinfo= $(this).find("input").val();
					textinfo = textinfo.replace(",", ".");
					json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
				}
			});
		});
		$('#pereplet tr').each(function(row){
			$(this).find('td').each(function(cell){
				if ($(this).attr('id') != undefined){
					let textinfo= $(this).find("input").val();
					textinfo = textinfo.replace(",", ".");
					json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
				}
			});
		});

		$('#prochee tr').each(function(row){
			$(this).find('td').each(function(cell){
				if ($(this).attr('id') != undefined){
					let textinfo= $(this).find("input").val();
					textinfo = textinfo.replace(",", ".");
					json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
				}
			});
		});
		$('#dizain tr').each(function(row){
			$(this).find('td').each(function(cell){
				if ($(this).attr('id') != undefined){
					let textinfo= $(this).find("input").val();
					textinfo = textinfo.replace(",", ".");
					json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
				}
			});
		});
		$('#bagetka tr').each(function(row){
			$(this).find('td').each(function(cell){
				if ($(this).attr('id') != undefined){
					let textinfo= $(this).find("input").val();
					textinfo = textinfo.replace(",", ".");
					json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
				}
			});
		});

		json = json + "}";
		//console.log(json);
		$.ajax({url: 'updateTitelPrice.php', method: 'POST', data: {info: json}, dataType: 'json', success: function(){alert('Сохранено ! ')}})
			//console.log(json);
	})

	$('#poisk').on('input', function() {
		
		var strPoisk = $(this).val()

		$('td').each(function(cell){
			prov = 0
			if ($(this).attr('id') != undefined){

				if((($(this).find("input").val()).toLowerCase()).includes(strPoisk.toLowerCase())) {
					console.log($(this).find("input").val())
				}
				else{
					prov = 1
				}
			}

			if(prov == 0){
				$(this).parent().show()
			}
			else{
				$(this).parent().hide()
			}

		});
		
	});

})


</script>
