<?
	include('./header.php');

	if (!isset($_SESSION['user_logged_in'])) {
		echo "Необходимо авторизоваться!";
		exit();
	}

	$db = getDbInstance();
	$orders = $db->query("SELECT * FROM orders ORDER BY id DESC");
?>

<div class="page-wrapper">
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="card table-responsive" >
				<div class="card-body">
					<div class="card-title">
						<h4 class="mb-0">Заказ материалов</h4>
					</div>

					<!-- Button trigger modal добавления заказа -->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#applicationsAdd">
						Добавить
					</button>

					<hr>

					<div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
						<div class="row">
							<div class="col-sm-12 table-responsive">
								<table id="applicationsAll" class="table table-striped table-bordered dataTable table-sm"  role="grid" aria-describedby="example2_info" style="max-width:650px;">
									<thead>
										<tr role="row">
											<th>Дата создания</th>
											<th>Пользователь</th>
											<th style="min-width:200px">Заявка</th>
											<th>Комментарий</th>
											<th>Статус</th>
											<th>Действие</th></tr>
									</thead>
									<tbody>

										<?php 
											function printButtonDone($order)
											{
												if ($_SESSION['type'] != 'admin') {
													return ' ';
												}

												if ($order['status'] == 'Выполнена') {
													return ' ';

												}else {
													return '<button data-order-id=' . $order['id'] . ' type="button" class="btn btn-warning change-status-order" data-toggle="modal" data-target="#">Заказано</button>';
												}
											}

											function printButtonDelete($order)
											{
												if ($_SESSION['type'] != 'admin') {
													return ' ';
												}

												
												return '<button data-order-id=' . $order['id'] . ' type="button" class="btn btn-danger delete-order">Удалить</button>';
											}

											foreach($orders as $order) {
												echo(
													'
														<tr id=' . $order['id'] . '>
															<td>' . $order['created_at'] . '</td>
															<td>' . $order['name_user'] . '</td>
															<td><textarea class="form-control resize" disabled>' . $order['text_order'] . '</textarea></td>
															<td><textarea class="form-control resize"  disabled>' . $order['comment'] . '</textarea></td>
															<td>' . $order['status'] . '</td>
															<td>
																<!--button data-order-id=' . $order['id'] . ' type="button" class="btn btn-warning change-order" data-toggle="modal" data-target="#">Изменить</button-->
																' . printButtonDone($order) . '
																' . printButtonDelete($order) . '
															</td>
														</tr>
													'
												);
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
</div>

<!-- Модальное окно на добавление-->
<div class="modal fade" id="applicationsAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Добавление заявки на заказ материалов</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

		<form id='addOrder'>

			<div class="row text-center justify-content-center">
				<label for="exampleFormControlTextarea1" class="form-label"><h3>Текст заявки</h3></label>
				<textarea class="form-control" id="textOrder" name="textOrder" rows="4" style='margin:10px 10px 10px 10px'></textarea>
			</div>

			<hr>

			<div class="row text-center justify-content-center">
				<label for="exampleFormControlTextarea1" class="form-label"><h3>Комментарий</h3></label>
				<textarea class="form-control" id="comment"  name="comment" rows="4" style='margin:10px 10px 10px 10px'></textarea>
			</div>

		</form>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary" id='saveOrderButton'>Добавить</button>
      </div>
    </div>
  </div>
</div>

<!-- Модальное окно на редактирование-->
<div class="modal fade" id="applications-change" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Редактирование заявки на заказ материалов</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

		<form id='change-order'>

			<div class="row text-center justify-content-center">
				<label for="exampleFormControlTextarea1" class="form-label"><h3>Текст заявки</h3></label>
				<textarea class="form-control" id='change-textOrder' name="textOrder" rows="4" style='margin:10px 10px 10px 10px'></textarea>
			</div>

			<hr>

			<div class="row text-center justify-content-center">
				<label for="exampleFormControlTextarea1" class="form-label"><h3>Комментарий</h3></label>
				<textarea class="form-control" id='change-comment' name="comment" rows="4" style='margin:10px 10px 10px 10px'></textarea>
			</div>

			<hr>
			<div class="row text-center justify-content-center">
				<div class="col-6 col-lg-6 col-xl-6">
					<h4>Статус</h4>
					<select id="status" name="status" class="form-control" aria-label=".form-select-lg example">
						<option selected></option>
						<option value="Активна">Активна</option>
						<option value="Отмена">Отмена</option>
						<option value="Ожидание">Ожидание</option>
						<option value="Выполнена">Выполнена</option>
					</select>
				</div>
			</div>

		</form>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary" id='changeOrderButton' data-order-id=''>Сохранить</button>
      </div>
    </div>
  </div>
</div>

	<!--end switcher-->
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<!--plugins-->
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<!-- Vector map JavaScript -->
	<script src="assets/js/index.js"></script>
	<!-- App JS -->
	<link rel="stylesheet" href="assets/plugins/datatable/css/buttons.bootstrap4.min.css" />
	<link rel="stylesheet" href="assets/plugins/datatable/css/dataTables.bootstrap4.min.css" />
	<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/app.js"></script>
	
</body>
</html>

<script type="text/javascript">

	$(document).ready(function() {
		$(".resize").each(function () {
			this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
		})

		buildTablePlugin();

		/**
		 * Активация плагина
		 *
		 * @return void
		 */
		function buildTablePlugin()
		{
			var table = $('#applicationsAll').DataTable({
				lengthChange: true,
				order: [[0, 'desc']],
				buttons: ['excel', 'pdf', 'print', 'colvis']
			});

			table.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
		}

		/**
		 * Сохроанение нового заказа
		 *
		 * @return void
		 */
		function saveOrderRequest()
		{	
			$.ajax({
				url: '/dashbord/request/order/save.php',         
				method: 'post',             
				dataType: 'json',          
				data: $('#addOrder').serialize(),     
				success: function(data){
					if(data.status == 'success') {
						location.reload()
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
		}

		/**
		 * Удаление заказа
		 */
		function deleteOrderRequest(order)
		{
			$.ajax({
				url: '/dashbord/request/order/delete.php',
				method: 'post',             
				dataType: 'json',          
				data: { id : $(order).data('order-id') },
				success: function(data){
					if(data.status == 'success') {
						location.reload()
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
		}

		function updateOrderRequest(order)
		{
			data = $('#change-order').serializeArray();
			data.push({name: "id", value: $(order).data('order-id')});

			$.ajax({
				url: '/dashbord/request/order/update.php',
				method: 'post',
				dataType: 'json',
				data: data,
				success: function(data){
					if(data.status == 'success') {
						location.reload()
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
			
		}

		/**
		 * Показ модального окна на редактирование
		 */
		function showModalChangeOrder(order)
		{
			$('#change-textOrder').val(order[0].text_order)
			$('#change-comment').val(order[0].comment)
			$('#status option[value='+order[0].status+']').prop('selected', true);
			$('#changeOrderButton').attr('data-order-id', order[0].id)

			$('#applications-change').modal('show');
		}

		/**
		 * Получение ордера
		 */
		function getOrder(orderId)
		{
			$.ajax({
				url: '/dashbord/request/order/get.php',
				method: 'post',
				dataType: 'json',
				data: { id : orderId },
				success: function(data){
					showModalChangeOrder(data)
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
			
		}

		/**
		 * Обновление статуса ордера
		 *
		 */
		function updateStatusOrder($orderId) 
		{
			$.ajax({
				url: '/dashbord/request/order/updateStatus.php',
				method: 'post',
				dataType: 'json',
				data: {'id': $orderId},
				success: function(data){
					if(data.status == 'success') {
						location.reload()
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
		}

		$('#saveOrderButton').on('click', function() { saveOrderRequest() });
		$('#changeOrderButton').on('click', function() { updateOrderRequest($(this)) });
		$('.change-order').on('click', function() { getOrder($(this).data('order-id')) });

		$(document).on("click", ".change-status-order", function() { updateStatusOrder($(this).data('order-id')) });
		$(document).on("click", ".delete-order", function() { deleteOrderRequest($(this)) });

		//$('.change-status-order').on('click', function() { updateStatusOrder($(this).data('order-id')) });
		//$('.delete-order').on('click', function() { deleteOrderRequest($(this)) });
	});

</script>

<style media="screen">

</style>