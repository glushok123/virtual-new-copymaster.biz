<?
include('./header.php')
?>
<div class="page-wrapper">
	<div class="page-content-wrapper">
		<div class="page-content">
			<?
			if (!isset($_SESSION['user_logged_in'])) {
				echo "Необходимо авторизоваться!";
			} else { ?>
				<div class="card table-responsive">
					<div class="card-body">
						<div class="card-title">
							<h4 class="mb-0">Все заявки</h4>
						</div>
						<hr>

						<div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
							<div class="row">
								<div class="col-sm-12">
									<table id="example2" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example2_info" style="max-width:650px;">
										<thead>
											<tr role="row">
												<th id="sorttest" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="id: activate to sort column descending" width: 35px;>id</th>
												<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="status: activate to sort column ascending" style="width: 31px;">ТИП</th>
												<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="status: activate to sort column ascending" style="width: 31px;">Цена</th>
												<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="name: activate to sort column ascending" style="width: 179px;">ФИО <br> (email +ТЕЛЕФОН)</th>

												<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="status: activate to sort column ascending" style="width: 31px;">СТАТУС</th>
												<th class="sorting ogrsize" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="comment: activate to sort column ascending" width: 80px style="max-width:90px !important;">Комментарий</th>
												<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="created_at: activate to sort column ascending" style="width: 59px;">Дата создания</th>

												<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="updated_at: activate to sort column ascending" style="width: 59px;">Действие</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>

					</div>
				</div>
				';
			<? } ?>
		</div>
	</div>
</div>

<div class="overlay toggle-btn-mobile"></div>

<? include_once 'modal_for_index.php'; ?>

<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!--plugins-->
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="assets/js/index.js"></script>
<!-- App JS -->
<link rel="stylesheet" href="assets/plugins/datatable/css/buttons.bootstrap4.min.css" />
<link rel="stylesheet" href="assets/plugins/datatable/css/dataTables.bootstrap4.min.css" />
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/js/app.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		var arrID = [];

		$.ajax({
			url: 'api/requests/',
			method: 'GET',
			dataType: 'json',
			success: function(response) {
				var obj = JSON.parse(response);
				obj.forEach(function(entry) {
					arrID.push(entry.id);
					if (entry.status == "Resolved") {
						$("tbody").append('	<tr role="row" class="odd"><td class="sorting_1">' +
							entry.id + '</td><td>' + entry.tip + '</td><td>' + entry.price +
							'</td><td>' + entry.name + '<hr> <span style="color:;">' + entry
							.email + '</span><hr><span style="color:;"> ' + entry.phon +
							'</span></td><td>' + entry.created_at +
							'</td><td><button type="button" class="btn btn-light radius-30" data-zaiv="' +
							entry.id + '" data-tip="' + entry.tip +
							'" id="obrabzaiavka" >Обработать </button><br><br><button type="button" data-zaiv="' +
							entry.id +
							'"  class="btn btn-light radius-30  delzaiavka" >Удалить </button></td></tr>'
						);
					} else {
						$("tbody").append('	<tr role="row" class="odd"><td class="sorting_1">' +
							entry.id + '</td><td>' + entry.tip + '</td><td>' + entry.price +
							'</td><td>' + entry.name + '<hr> <span style="color:;">' + entry
							.email + '</span><hr><span style="color:;"> ' + entry.phon +
							'</span></td><td>' + entry.status +
							'</td><td><div class="text-wrap" style="width: 150px;">' + entry
							.comment + '</div></td><td>' + entry.created_at +
							' </td><td><button type="button" class="btn btn-light radius-30" data-zaiv="' +
							entry.id + '" data-tip="' + entry.tip +
							'" id="obrabzaiavka">Обработать </button><br><br><button data-zaiv="' +
							entry.id +
							'" type="button" class="btn btn-light radius-30  delzaiavka" >Удалить </button></td></tr>'
						);
					}

				});
				$('#example').DataTable();
				var table = $('#example2').DataTable({
					lengthChange: true,
					order: [
						[0, 'desc']
					],
					buttons: ['excel', 'pdf', 'print', 'colvis']
				});
				table.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
			}
		})

		$('#sorttest').attr('class', 'sorting_desc');
		$('#sorttest').attr('aria-sort', 'descending');

		$(document).on('click', '.delzaiavka', function() {
			$.ajax({
				url: 'api/requests/' + $(this).attr('data-zaiv') + '',
				method: 'DELETE',
				dataType: 'json',
			})
			$(this).parent().parent().remove();
		});

		$(document).on('click', '#obrabzaiavka', function() {

			var idz = $(this).attr('data-zaiv');

			$.ajax({
				url: 'api/requests/' + $(this).attr('data-zaiv') + '',
				method: 'GET',
				dataType: 'json',
				success: function(response) {

					var obj = JSON.parse(response);

					obj.forEach(function(entry) {
						if (entry.tip == "vizitka") {
							$('#sizebum_vizit option[value=' + entry.size + ']').prop(
								'selected', true);
							$('#tibum_vizit option[value=' + entry.tipbum + ']').prop(
								'selected', true);
							$('#cvet_vizit option[value=' + entry.cvet + ']').prop(
								'selected', true);
							$('#kolit_vizit option[value=' + entry.kol + ']').prop(
								'selected', true);
							$('#srok_vizit option[value=' + entry.srok + ']').prop(
								'selected', true);
							$('#status_vizit option[value=' + entry.status + ']').prop(
								'selected', true);
							$('#price_vizit').val(entry.price);
							$('#comment_vizit').val(entry.comment);
							$('#updatezayiavka_vizit').attr('data-id', idz);
							$('#vizitkamodal').modal('show');
						}
						if (entry.tip == "listovki") {
							$('#sizebum_listov option[value=' + entry.size + ']').prop(
								'selected', true);
							$('#tibum_listov option[value=' + entry.tipbum + ']').prop(
								'selected', true);
							$('#cvet_listov option[value=' + entry.cvet + ']').prop(
								'selected', true);
							$('#kolit_listov option[value=' + entry.kol + ']').prop(
								'selected', true);
							$('#srok_listov option[value=' + entry.srok + ']').prop(
								'selected', true);
							$('#status_listov option[value=' + entry.status + ']').prop(
								'selected', true);
							$('#price_listov').val(entry.price);
							$('#comment_listov').val(entry.comment);
							$('#updatezayiavka_listov').attr('data-id', idz);
							$('#listovmodal').modal('show');
						}
						if (entry.tip == "petchat") {
							$('#petchat_tip_petchat option[value=' + entry.petchat_tip +
								']').prop('selected', true);
							$('#osnastka_petchat option[value=' + entry.osnastka + ']')
								.prop('selected', true);
							$('#avt_osnastka_petchat option[value=' + entry
								.avt_osnastka + ']').prop('selected', true);
							$('#srok_petchat option[value=' + entry.srok + ']').prop(
								'selected', true);
							$('#status_petchat option[value=' + entry.status + ']')
								.prop('selected', true);
							$('#price_petchat').val(entry.price);
							$('#comment_petchat').val(entry.comment);
							$('#updatezayiavka_petchat').attr('data-id', idz);
							$('#petchatmodal').modal('show');
						}
						if (entry.tip == "petfoto") {
							$('#sizebum_petchatfoto option[value=' + entry.size + ']')
								.prop('selected', true);
							$('#tibum_petchatfoto option[value=' + entry.tipbum + ']')
								.prop('selected', true);
							$('#kolit_petchatfoto').val(entry.kol);
							$('#srok_petchatfoto option[value=' + entry.srok + ']')
								.prop('selected', true);
							$('#status_petchatfoto option[value=' + entry.status + ']')
								.prop('selected', true);
							$('#price_petchatfoto').val(entry.price);
							$('#comment_petchatfoto').val(entry.comment);
							$('#updatezayiavka_petchatfoto').attr('data-id', idz);
							$('#petchatfotomodal').modal('show');
						}
						if (entry.tip == "ОБРАТНАЯ СВЯЗЬ") {
							$('#status_obrs option[value=' + entry.status + ']').prop(
								'selected', true);
							$('#price_obrs').val(entry.price);
							$('#comment_obrs').val(entry.comment);
							$('#updatezayiavka_obrs').attr('data-id', idz);
							$('#obrs').modal('show');
						}

						if (entry.tip == "штендер") {
							$('#shtend_name1').val(entry.name1);
							$('#shtend_zv1').val(entry.zv1);
							$('#shtend_ye1').val(entry.ye1);
							$('#url_photo1img').attr("href", "/dl_save.php?filename=" +
								entry.url_photo1img);
							$('#url_photo1img_show').attr("href", entry.url_photo1img);

							$('#shtend_name2').val(entry.name2);
							$('#shtend_zv2').val(entry.zv2);
							$('#shtend_ye2').val(entry.ye2);
							$('#url_photo2img').attr("href", "/dl_save.php?filename=" +
								entry.url_photo2img);
							$('#url_photo2img_show').attr("href", entry.url_photo2img);

							$('#url_screenimg').attr("href", "/dl_save.php?filename=" +
								entry.url_screenimg);
							$('#url_screenimg_show').attr("href", entry.url_screenimg);

							$('#shtend_flret').val(entry.flret);
							$('#shtend_format').val(entry.format);
							$('#shtend_template').val(entry.template);

							$('#status_shtend option[value=' + entry.status + ']').prop(
								'selected', true);
							$('#price_shtend').val(entry.price);
							$('#comment_shtend').val(entry.comment);
							$('#updatezayiavka_shtend').attr('data-id', idz);
							$('#shtender').modal('show');
						}
					});
				}
			})
		});

		$('#updatezayiavka_petchatfoto').on('click', function() {
			$.ajax({
				url: 'api/requests/' + $(this).attr("data-id") + '',
				method: 'PUT',
				data: {
					status: $("#status_petchatfoto").val(),
					price: $("#price_petchatfoto").val(),
					tipz: "petfoto",
					comment: $("#comment_petchatfoto").val(),
					size: $("#sizebum_petchatfoto").val(),
					tip: $("#tibum_petchatfoto").val(),
					kol: $("#kolit_petchatfoto").val(),
					srok: $("#srok_petchatfoto").val()
				},
				dataType: 'json',
				success: function(response) {
					//console.log('response:', response)
				}
			})
			location.reload();
		});

		$('#updatezayiavka_petchat').on('click', function() {
			$.ajax({
				url: 'api/requests/' + $(this).attr("data-id") + '',
				method: 'PUT',
				data: {
					status: $("#status_petchat").val(),
					price: $("#price_petchat").val(),
					tipz: "petchat",
					comment: $("#comment_petchat").val(),
					petchat_tip: $("#petchat_tip_petchat").val(),
					osnastka: $("#osnastka_petchat").val(),
					avt_osnastka: $("#avt_osnastka_petchat").val(),
					srok: $("#srok_petchat").val()
				},
				dataType: 'json',
				success: function(response) {
					//console.log('response:', response)
				}
			})
			location.reload();
		});

		$('#updatezayiavka_listov').on('click', function() {
			$.ajax({
				url: 'api/requests/' + $(this).attr("data-id") + '',
				method: 'PUT',
				data: {
					status: $("#status_listov").val(),
					price: $("#price_listov").val(),
					tipz: "listovki",
					comment: $("#comment_listov").val(),
					size: $("#sizebum_listov").val(),
					tip: $("#tibum_listov").val(),
					cvet: $("#cvet_listov").val(),
					kol: $("#kolit_listov").val(),
					srok: $("#srok_listov").val()
				},
				dataType: 'json',
				success: function(response) {
					//console.log('response:', response)
				}
			})
			location.reload();
		});

		$('#updatezayiavka_vizit').on('click', function() {
			$.ajax({
				url: 'api/requests/' + $(this).attr("data-id") + '',
				method: 'PUT',
				data: {
					status: $("#status_vizit").val(),
					price: $("#price_vizit").val(),
					tipz: "vizitka",
					comment: $("#comment_vizit").val(),
					size: $("#sizebum_vizit").val(),
					tip: $("#tibum_vizit").val(),
					cvet: $("#cvet_vizit").val(),
					kol: $("#kolit_vizit").val(),
					srok: $("#srok_vizit").val()
				},
				dataType: 'json',
				success: function(response) {
					//console.log('response:', response)
				}
			})
			location.reload();
		});

		$('#updatezayiavka_shtend').on('click', function() {
			$.ajax({
				url: 'api/requests/' + $(this).attr("data-id") + '',
				method: 'PUT',
				data: {
					status: $("#status_shtend").val(),
					price: $("#price_shtend").val(),
					tipz: "штендер",
					comment: $("#comment_shtend").val(),
					name1: $("#shtend_name1").val(),
					zv1: $("#shtend_zv1").val(),
					ye1: $("#shtend_ye1").val(),
					name2: $("#shtend_name2").val(),
					zv2: $("#shtend_zv2").val(),
					ye2: $("#shtend_ye2").val(),
					url_photo1img: $("#url_photo1img_show").attr("href"),
					url_photo2img: $("#url_photo2img_show").attr("href"),
					url_screenimg: $("#url_screenimg_show").attr("href"),
					flret: $("#shtend_flret").val(),
					format: $("#shtend_format").val(),
					template: $("#shtend_template").val()
				},
				dataType: 'json',
				success: function(response) {
					//console.log('response:', response)
				}
			})
			location.reload();
		});

		$('#updatezayiavka_obrs').on('click', function() {
			$.ajax({
				url: 'api/requests/' + $(this).attr("data-id") + '',
				method: 'PUT',
				data: {
					status: $("#status_obrs").val(),
					price: $("#price_obrs").val(),
					tipz: "ОБРАТНАЯ СВЯЗЬ",
					comment: $("#comment_obrs").val(),
				},
				dataType: 'json',
				success: function(response) {
					//console.log('response:', response)
				}
			})
			location.reload();
		});

		function sayHi() {
			$.ajax({
				url: 'api/requests/',
				method: 'GET',
				dataType: 'json',
				success: function(response) {
					var obj = JSON.parse(response);
					obj.forEach(function(entry) {
						//console.log(arrID);
						if (arrID.indexOf(entry.id) != -1) {} else {
							arrID.push(entry.id);
							//console.log(entry.id + " - нету");
							if (entry.status == "Resolved") {
								$("tbody").append(
									'	<tr role="row" class="odd"><td class="sorting_1">' +
									entry.id + '</td><td>' + entry.tip + '</td><td>' + entry
									.price + '</td><td>' + entry.name + '</td><td>' + entry
									.email + '</td><td>' + entry.phon + '</td><td>' + entry
									.status +
									'</td><td><div class="text-wrap" style="width: 150px;">' +
									entry.comment + '</div></td><td>' + entry.created_at +
									'</td><td>' + entry.updated_at +
									'</td><td><button type="button" class="btn btn-light radius-30" data-zaiv="' +
									entry.id + '" data-tip="' + entry.tip +
									'" id="obrabzaiavka" >Обработать заявку</button><button type="button" data-zaiv="' +
									entry.id +
									'"  class="btn btn-light radius-30  delzaiavka" >Удалить заявку</button></td></tr>'
								);
							} else {
								$("tbody").append(
									'	<tr role="row" class="odd"><td class="sorting_1">' +
									entry.id + '</td><td>' + entry.tip + '</td><td>' + entry
									.price + '</td><td>' + entry.name + '</td><td>' + entry
									.email + '</td><td>' + entry.phon + '</td><td>' + entry
									.status +
									'</td><td><div class="text-wrap" style="width: 150px;">' +
									entry.comment + '</div></td><td>' + entry.created_at +
									'</td><td>' + entry.updated_at +
									'</td><td><button type="button" class="btn btn-light radius-30" data-zaiv="' +
									entry.id + '" data-tip="' + entry.tip +
									'" id="obrabzaiavka">Обработать заявку</button><button data-zaiv="' +
									entry.id +
									'" type="button" class="btn btn-light radius-30  delzaiavka" >Удалить заявку</button></td></tr>'
								);
							}
						}
					});
				}
			})
		}
		//setInterval(sayHi, 20000);
	});
</script>
</body>

</html>

<style media="screen">
	.ogrsize {
		max-width: 80px;
		min-width: 80px;
	}
</style>