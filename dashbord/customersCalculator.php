<?
include('./header.php')
?>
	<div class="page-wrapper">
		<div class="page-content-wrapper">
			<div class="page-content">
				<?php
                    if (! isset($_SESSION['user_logged_in'])) {
                        echo "Необходимо авторизоваться!";
                        exit();
                    }

                    if ($_SESSION['type'] != "admin")
					{
						echo 'ДОСТУП ЗАПРЕЩЕН !!! ';
						exit();
					}
				?>
					<div class="card table-responsive">
						<div class="card-body">

							<div class="card-title">
								<h4 class="mb-0">Клиенты (БД калькулятора физ. лиц) </h4> </div>
							<hr>

                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="customersCalculator" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example2_info" style="max-width:650px;">
                                        <thead>
                                            <tr role="row">
                                                <th>id</th>
                                                <th>Клиент</th>
                                                <th>Телефон</th>
                                                <th>Скидка</th>
                                                <th>Количество заказов</th>
                                                <th>Сумма заказов</th>
                                                <th>Средний чек</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
											<? 
												require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
												$db = getDbInstance();
												$res = $db->query("SELECT * FROM `customers_calculator`");

												foreach($res as $client) {

													$countOrder = '';
													$sumOrder = '';
													$averageСheck = '';
													$text = '<tr>';
													$text = $text . '<td>' .  $client['id'] . '</td>';
													$text = $text . '<td>' .  $client['name'] . '</td>';
													$text = $text . '<td>' .  $client['phone'] . '</td>';
													$text = $text . '
														<td>
															<input class="form-control custom-input discount-input" type="text" placeholder="отсутствует" value="' .  $client['discount'] . '" data-client-id="' .  $client['id'] . '">
														</td>';
													$text = $text . '<td>' .  $client['count_order'] . '</td>';
													$text = $text . '<td>' .  $client['sum_order'] . '</td>';
													$text = $text . '<td>' .  $client['average_check'] . '</td>';
													$text = $text . '</tr>';
													echo $text;
 												}
											?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
						</div>
					</div>
			</div>
		</div>
	</div>
	<div class="overlay toggle-btn-mobile"></div>
	</div>
	</div>
	<!--end switcher-->
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<!--plugins-->
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>

	<!-- Vector map JavaScript -->
	<!-- App JS -->
	<link rel="stylesheet" href="assets/plugins/datatable/css/buttons.bootstrap4.min.css" />
	<link rel="stylesheet" href="assets/plugins/datatable/css/dataTables.bootstrap4.min.css" />
	<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

	<script src="assets/js/app.js"></script>

	<script type="text/javascript">
		$('#customersCalculator').dataTable({})

		$(document).on('change', '.discount-input', function(){
			let data = {
				id 		 : $(this).data('client-id'),
				discount : $(this).val()
			};

			$.ajax({
				url: '/dashbord/request/clients/update.php',
				method: 'post',
				dataType: 'json',
				data: data,
				success: function(data){
					if (data.status == 'success') {
						toastr.success('Изменения сохранены !');
					}
				},
				error: function (jqXHR, exception) {
					if (jqXHR.status === 0) {
						alert('Not connect. Verify Network.');
					} else if (jqXHR.status == 404) {
						alert('Requested page not found (404).');
					} else if (jqXHR.status == 500) {
						alert('Internal Server Error (500).');
					} else if (exception === 'parsererror') {
						alert('Requested JSON parse failed.');
					} else if (exception === 'timeout') {
						alert('Time out error.');
					} else if (exception === 'abort') {
						alert('Ajax request aborted.');
					} else {
						alert('Uncaught Error. ' + jqXHR.responseText);
					}
				}
			});
		})
	</script>

</body>
</html>