<?
	include('./header.php');
	require_once './calc/connect.php';

	$date = [
		'Январь' => [
			'2022-01-01',
			'2022-01-31',
		],
		'Февраль' => [
			'2022-02-01',
			'2022-02-28',
		],
		'Март' => [
			'2022-03-01',
			'2022-03-31',
		],
		'Апрель' => [
			'2022-04-01',
			'2022-04-30',
		],
		'Май' => [
			'2022-05-01',
			'2022-05-31',
		],
		'Июнь' => [
			'2022-06-01',
			'2022-06-30',
		],
		'Июль' => [
			'2022-07-01',
			'2022-07-31',
		],
		'Август' => [
			'2022-08-01',
			'2022-08-31',
		],
		'Сентябрь' => [
			'2022-09-01',
			'2022-09-30',
		],
		'Октябрь' => [
			'2022-10-01',
			'2022-10-31',
		],
		'Ноябрь' => [
			'2022-11-01',
			'2022-11-30',
		],
		'Декабрь'=> [
			'2022-12-01',
			'2022-12-31',
		],
	];
	
	foreach ($date as $key => $month) {
		$stmt = $dbh->prepare("
			SELECT 
				ci.id, 
				ci.cost, 
				ci.createtime, 
				ci.discount, 
				ci.discount_percent, 
				ci.pay_type 
				from check_id as ci 
				where '" . $month[0] ."' <= ci.createtime and ci.createtime < '" . $month[1] ."'
				AND (ci.cher = '0' ) 
				order by ci.createtime DESC;
		");

		$stmt->execute();
		$data = $stmt->fetchAll();
		$date[$key]['info'] = $data;
	}



	
?>

<style>
	.calcprice{
		width: 60px;
		height: 30px;
		background-color: transparent;
		border: none;
		color: white;
	}
</style>

		<div class="page-wrapper">
			<div class="page-content-wrapper">

				<div class="page-content">
					<?php 
						if ($_SESSION['type'] != "admin")
						{
							echo 'ДОСТУП ЗАПРЕЩЕН !!! ';

							exit;
						}
					?>

						<div class='container'>
							<?php 
								$date = array_reverse($date);

								foreach ($date as $key => $month) {
									$averageMoneys = 0; // Средний чек
									$inTotalMoneys = 0; // Всего заработано
									$quantity = count($month['info']); // общее количество чеков
									$payTypeByСash = 0; // наличкой
									$payTypeByСard = 0; // картой

									echo '<div class="">';
										echo '
											<div class="name-month">
												<hr>
												<h2>' . $key . '  (c ' . $month[0] .' до ' . $month[1] .')</h2>
												<hr>
											</div>
										';
										

										foreach ($month['info'] as $check) {
											$inTotalMoneys = $inTotalMoneys + $check['cost'];

											if($check['pay_type'] == 'cash') {
												$payTypeByСash = $payTypeByСash + 1;
											}

											if($check['pay_type'] == 'card') {
												$payTypeByСard = $payTypeByСard + 1;
											}
										};

										$averageMoneys = $inTotalMoneys == 0 ? 0 : $inTotalMoneys/$quantity;

										echo '
											<div class="info-month">
												<h4 class="btn-info">Заработано за месяц: ' . $inTotalMoneys . ' р.</h4>
												<h4 class="btn-info">Средний чек за месяц: ' . $averageMoneys . ' р.</h4>
												<h4 class="btn-info">Количество чеков: ' . $quantity . ' шт.</h4>
												<h4 class="btn-info">Оплачено картой: ' . $payTypeByСard . ' шт.</h4>
												<h4 class="btn-info">Оплачено наличкой: ' . $payTypeByСash . ' шт.</h4>
											</div>
										';
									echo '</div>';
								}
							?>


						</div>
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

</style>
<script type="text/javascript">

$(document).ready(function(){


})
</script>