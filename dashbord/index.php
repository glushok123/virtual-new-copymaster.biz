<?
include('./header.php')
?>
		<div class="page-wrapper">
			<div class="page-content-wrapper">
				<div class="page-content">
					<?php

					if (!isset($_SESSION['user_logged_in'])) {
						echo "Необходимо авторизоваться!";
					}
					else
					{
						echo '
							<div class="card table-responsive" >
									<div class="card-body">
										<div class="card-title">
											<h4 class="mb-0">Все заявки</h4>
										</div>
										<hr>

											<div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
													<div class="row">
														<div class="col-sm-12">
															<table id="example2" class="table table-striped table-bordered dataTable"  role="grid" aria-describedby="example2_info" style="max-width:650px;">
												<thead>
													<tr role="row">
														<th id="sorttest"class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="id: activate to sort column descending" width: 35px;>id</th>
														<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="status: activate to sort column ascending" style="width: 31px;">ТИП</th>
														<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="status: activate to sort column ascending" style="width: 31px;">Цена</th>
														<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="name: activate to sort column ascending" style="width: 179px;">ФИО <br> (email +ТЕЛЕФОН)</th>

														<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="status: activate to sort column ascending" style="width: 31px;">СТАТУС</th>
														<th class="sorting ogrsize" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="comment: activate to sort column ascending"  width: 80px  style="max-width:90px !important;">Комментарий</th>
														<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="created_at: activate to sort column ascending" style="width: 59px;">Дата создания</th>

														<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="updated_at: activate to sort column ascending" style="width: 59px;">Действие</th></tr>
												</thead>
												<tbody>
												</tbody>
											</table></div></div>
											</div>

									</div>
								</div>
						';
						
					}
					 ?>
				</div>
			</div>
		</div>
		<div class="overlay toggle-btn-mobile"></div>
		<div class="modal fade" id="exampleModal7" tabindex="-1" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content radius-30">
					<div class="modal-header border-bottom-0">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body p-5">
						<h3 class="text-center">Ваша заявка</h3>
						<div class="form-group">
							<label>Сообщение</label>
							<input id="message" type="text" class="form-control form-control-lg radius-30">
						</div>
						<div class="form-group">
							<button id="addzayiavka" type="button" class="btn btn-light radius-30 btn-lg btn-block">Отправить</button>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="vizitkamodal" tabindex="-1" aria-hidden="true" style="display: none;" >
			<div class="modal-dialog modal-xl modal-dialog-centered">
				<div class="modal-content radius-30">
					<div class="modal-header border-bottom-0">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body ">
						<div class="container  text-center justify-content-center">
							<div class="row">
								<div class="col-6 col-lg-6 col-xl-6">
									<h4>РАЗМЕР</h4>
									<select id="sizebum_vizit" class="form-control" aria-label=".form-select-lg example">
									 <option selected></option>
									 <option value="1">85*55</option>
									 <option value="2">90*50</option>
								   </select>
								   </select>
								</div>
								<div class="col-6 col-lg-6 col-xl-6">
									<h4><span data-bs-toggle="modal" data-bs-target="#exampleModal2">ТИП БУМАГИ  *</span> </h4>
									<select id="tibum_vizit"  class="form-control" aria-label=".form-select-lg example">
								   <option selected></option>
									 <option value="3">Мелованная бумага 300 гр.</option>
									 <option value="4">Лен белый</option>
									 <option value="5">Лен слон. кость</option>
									 <option value="6">Тачкавер белый</option>
									 <option value="7">Тачкавер слон. кость</option>
									 <option value="8">Золотая бумага</option>
								   </select>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-6 col-lg-6 col-xl-6">
									<h4>ЦВЕТНОСТЬ</h4>
									<select id="cvet_vizit"  class="form-control" aria-label=".form-select-lg example">
										<option selected></option>
									 <option value="9">4+0 (односторонние)</option>
									 <option value="10">4+4 (двусторонние)</option>
								   </select>
								</div>
								<div class="col-6 col-lg-6 col-xl-6">
									<h4>КОЛИЧЕСТВО</h4>
									<select id="kolit_vizit"  class="form-control" aria-label=".form-select-lg example">
										<option selected></option>
									<option value="11">100</option>
									<option value="12">200</option>
									<option value="13">300</option>
									<option value="14">500</option>
									<option value="15">1000</option>
									<option value="16">2000</option>
									<option value="17">5000</option>
								   </select>
								</div>
							</div>
							<br>
							<div class="row text-center justify-content-center">
								<div class="col-6 col-lg-6 col-xl-6">
									<h4>Срочность</h4>
									<select id="srok_vizit"  class="form-control" aria-label=".form-select-lg example">
										<option selected></option>
									 <option value="18">Не срочно (один рабочий день)</option>
									 <option value="19">В течении 4 часов</option>
								   </select>
								</div>

								<div class="col-6 col-lg-6 col-xl-6">
									<h4>Статус</h4>
									<select id="status_vizit"  class="form-control" aria-label=".form-select-lg example">
										<option selected></option>
									 <option value="Активна">Активна</option>
									 <option value="Отмена">Отмена</option>
									 <option value="Ожидание">Ожидание</option>
									 <option value="Оплачена">Оплачена</option>
									 <option value="Закрыта">Закрыта</option>
								   </select>
								</div>
							</div>
						</div>
						<hr>
						<br>
						<h3 class="text-center">Обработка заявки</h3>
						<div class="form-group">
							<label>ЦЕНА</label>
							<input id="price_vizit" type="text" class="form-control form-control-lg radius-30">
						</div>
						<div class="form-group">
							<label>Комментарий</label>
							<input id="comment_vizit" type="text" class="form-control form-control-lg radius-30">
						</div>

						<div class="form-group">
							<button id="updatezayiavka_vizit"  data-id="0" type="button" class="btn btn-light radius-30 btn-lg btn-block">Отправить</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="listovmodal" tabindex="-1" aria-hidden="true" style="display: none;" >
			<div class="modal-dialog modal-xl modal-dialog-centered">
				<div class="modal-content radius-30">
					<div class="modal-header border-bottom-0">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body ">
						<div class="container  text-center justify-content-center">
							<div class="row">
   				             <div class="col-6 col-lg-6 col-xl-6">
   				                 <h4>РАЗМЕР</h4>
   				                 <select id="sizebum_listov" class="form-control" aria-label=".form-select-lg example">
   				                  <option selected></option>
   				                  <option value="1">10,5x15 см (A6)</option>
   				                  <option value="2">10x20 см (1/3 A4)</option>
   				                  <option value="3">15x20 см (A5)</option>
   				                  <option value="4">21x30 см (A4)</option>
   				                  <option value="5">90*50</option>
   				                </select>
   				                </select>
   				             </div>
   				             <div class="col-6 col-lg-6 col-xl-6">
   				                 <h4><span data-bs-toggle="modal" data-bs-target="#exampleModal2">ТИП БУМАГИ  *</span> </h4>
   				                 <select id="tibum_listov"  class="form-control" aria-label=".form-select-lg example">
   				                <option selected></option>
   				                  <option value="6">Мелованная бумага 130 гр.</option>
   				                  <option value="7">Мелованная бумага 170 гр.</option>
   				                  <option value="8">Мелованная бумага 250 гр.</option>
   				                  <option value="9">Мелованная бумага 300 гр.</option>

   				                </select>
   				             </div>
   				         </div>
   				         <div class="row">
   				             <div class="col-6 col-lg-6 col-xl-6">
   				                 <h4>ЦВЕТНОСТЬ</h4>
   				                 <select id="cvet_listov"  class="form-control" aria-label=".form-select-lg example">
   				                     <option selected></option>
   				                  <option value="10">4+0 (односторонние)</option>
   				                  <option value="11">4+4 (двусторонние)</option>
   				                </select>
   				             </div>
   				             <div class="col-6 col-lg-6 col-xl-6">
   				                 <h4>КОЛИЧЕСТВО</h4>
   				                 <select id="kolit_listov"  class="form-control" aria-label=".form-select-lg example">
   				                     <option selected></option>
   				                 <option value="12">100</option>
   				                 <option value="13">200</option>
   				                 <option value="14">300</option>
   				                 <option value="15">500</option>
   				                 <option value="16">1000</option>
   				                 <option value="17">2000</option>
   				                 <option value="18">5000</option>
   				                </select>
   				             </div>
   				         </div>
   				         <div class="row text-center justify-content-center">
   				             <div class="col-6 col-lg-6 col-xl-6">
   				                 <h4>Срочность</h4>
   				                 <select id="srok_listov"  class="form-control" aria-label=".form-select-lg example">
   				                     <option selected></option>
   				                  <option value="19">Не срочно (один рабочий день)</option>
   				                  <option value="20">В течении 4 часов</option>
   				                </select>
   				             </div>
								<div class="col-6 col-lg-6 col-xl-6">
									<h4>Статус</h4>
									<select id="status_listov"  class="form-control" aria-label=".form-select-lg example">
										<option selected></option>
									 <option value="Активна">Активна</option>
									 <option value="Отмена">Отмена</option>
									 <option value="Ожидание">Ожидание</option>
									 <option value="Оплачена">Оплачена</option>
									 <option value="Закрыта">Закрыта</option>
								   </select>
								</div>
							</div>
						</div>
						<hr>
						<br>
						<h3 class="text-center">Обработка заявки</h3>
						<div class="form-group">
							<label>ЦЕНА</label>
							<input id="price_listov" type="text" class="form-control form-control-lg radius-30">
						</div>
						<div class="form-group">
							<label>Комментарий</label>
							<input id="comment_listov" type="text" class="form-control form-control-lg radius-30">
						</div>
						<div class="form-group">
							<button id="updatezayiavka_listov"  data-id="0" type="button" class="btn btn-light radius-30 btn-lg btn-block">Отправить</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="petchatmodal" tabindex="-1" aria-hidden="true" style="display: none;" >
			<div class="modal-dialog modal-xl modal-dialog-centered">
				<div class="modal-content radius-30">
					<div class="modal-header border-bottom-0">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body ">
						<div class="container  text-center justify-content-center">
							<div class="row">
		   		             <div class="col-6 col-lg-6 col-xl-6">
		   		                 <h4>Печати</h4>
		   		                 <select id="petchat_tip_petchat" class="form-control" aria-label=".form-select-lg example">
		   		                  <option selected></option>
		   		                  <option value="1">Первичная печать</option>
		   		                  <option value="2">Печать по оттиску</option>
		   		                </select>
		   		                </select>
		   		             </div>
		   		             <div class="col-6 col-lg-6 col-xl-6">
		   		                 <h4><span data-bs-toggle="modal" data-bs-target="#exampleModal2">Оснастка</span> </h4>
		   		                 <select id="osnastka_petchat"  class="form-control" aria-label=".form-select-lg example">
		   		                <option selected></option>
		   		                  <option value="3">Автоматическая оснастка</option>
		   		                  <option value="4">Ручная (пешка)</option>
		   		                </select>
		   		             </div>
		   		         </div>
						 <br>
		   		         <div class="row">
		   		             <div class="col-6 col-lg-6 col-xl-6">
		   		                 <h4>Автоматическая оснастка</h4>
		   		                 <select id="avt_osnastka_petchat"  class="form-control" aria-label=".form-select-lg example">
		   		                  <option value="0"selected>-</option>
		   		                  <option value="5">d40 мм</option>
		   		                  <option value="6">карманная, d40 мм</option>
		   		                  <option value="7">20х20 мм</option>
		   		                  <option value="8">30х50 мм</option>
		   		                  <option value="9">10х27 мм</option>
		   		                  <option value="10">14х38 мм</option>
		   		                  <option value="11">23х59 мм</option>
		   		                  <option value="12">30х69 мм</option>
		   		                  <option value="13">37х76 мм</option>
		   		                  <option value="14">25х82 мм</option>
		   		                </select>
		   		             </div>

		   		             <div class="col-6 col-lg-6 col-xl-6">
		   		                 <h4>Срочность</h4>
		   		                 <select id="srok_petchat"  class="form-control" aria-label=".form-select-lg example">
		   		                     <option selected></option>
		   		                  <option value="15">Не срочно (один рабочий день)</option>
		   		                  <option value="16">В течении 4 часов</option>
		   		                  <option value="17">В течении часа</option>
		   		                </select>
		   		             </div>

						</div>
						<br>
						<div class="row text-center justify-content-center">
							<div class="col-6 col-lg-6 col-xl-6">
								   <h4>Статус</h4>
								   <select id="status_petchat"  class="form-control" aria-label=".form-select-lg example">
									   <option selected></option>
									<option value="Активна">Активна</option>
									<option value="Отмена">Отмена</option>
									<option value="Ожидание">Ожидание</option>
									<option value="Оплачена">Оплачена</option>
									<option value="Закрыта">Закрыта</option>
								  </select>
 						  	</div>
						   </div>
						<hr>
						<br>
						<h3 class="text-center">Обработка заявки</h3>
						<div class="form-group">
							<label>ЦЕНА</label>
							<input id="price_petchat" type="text" class="form-control form-control-lg radius-30">
						</div>
						<div class="form-group">
							<label>Комментарий</label>
							<input id="comment_petchat" type="text" class="form-control form-control-lg radius-30">
						</div>
						<div class="form-group">
							<button id="updatezayiavka_petchat"  data-id="0" type="button" class="btn btn-light radius-30 btn-lg btn-block">Отправить</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>

		<div class="modal fade" id="petchatfotomodal" tabindex="-1" aria-hidden="true" style="display: none;" >
			<div class="modal-dialog modal-xl modal-dialog-centered">
				<div class="modal-content radius-30">
					<div class="modal-header border-bottom-0">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body ">
						<div class="container  text-center justify-content-center">
							<div class="row">
								<div class="col-12 col-lg-6 col-xl-6">
									<h4>РАЗМЕР</h4>
									<select id="sizebum_petchatfoto" class="form-control" aria-label=".form-select-lg example">
									 <option selected></option>
									 <option value="1">10x15 см (A6)</option>
									 <option value="2">15x20 см (A5)</option>
									 <option value="3">21x30 см (A4)</option>
								   </select>
								   </select>
								</div>
								<div class="col-12 col-lg-6 col-xl-6">
									<h4><span data-bs-toggle="modal" data-bs-target="#exampleModal2">ТИП БУМАГИ</span> </h4>
									<select id="tibum_petchatfoto"  class="form-control" aria-label=".form-select-lg example">
								   <option selected></option>
									 <option value="4">Матовая</option>
									 <option value="5">Глянцевая</option>
								   </select>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-12 col-lg-6 col-xl-6">
									<h4>Срочность</h4>
									<select id="srok_petchatfoto"  class="form-control" aria-label=".form-select-lg example">
										<option selected></option>
									 <option value="6">Не срочно (один рабочий день)</option>
									 <option value="7">В течении 4 часов</option>
								   </select>
								</div>
								<div class="col-12 col-lg-6 col-xl-6">
									<h4>КОЛИЧЕСТВО</h4>
									<input id="kolit_petchatfoto" type="text" class="form-control form-control-lg radius-30 "   placeholder="100"  />
								</div>
							</div>

						<br>
						<div class="row text-center justify-content-center">
							<div class="col-6 col-lg-6 col-xl-6">
								   <h4>Статус</h4>
								   <select id="status_petchatfoto"  class="form-control" aria-label=".form-select-lg example">
									   <option selected></option>
									<option value="Активна">Активна</option>
									<option value="Отмена">Отмена</option>
									<option value="Ожидание">Ожидание</option>
									<option value="Оплачена">Оплачена</option>
									<option value="Закрыта">Закрыта</option>
								  </select>
 						  	</div>
						   </div>
						   </div>
						<hr>
						<br>
						<h3 class="text-center">Обработка заявки</h3>
						<div class="form-group">
							<label>ЦЕНА</label>
							<input id="price_petchatfoto" type="text" class="form-control form-control-lg radius-30">
						</div>
						<div class="form-group">
							<label>Комментарий</label>
							<input id="comment_petchatfoto" type="text" class="form-control form-control-lg radius-30">
						</div>
						<div class="form-group">
							<button id="updatezayiavka_petchatfoto"  data-id="0" type="button" class="btn btn-light radius-30 btn-lg btn-block">Отправить</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="shtender" tabindex="-1" aria-hidden="true" style="display: none;" >
			<div class="modal-dialog modal-xl modal-dialog-centered">
				<div class="modal-content radius-30">
					<div class="modal-header border-bottom-0">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body ">
						<div class="container  text-center justify-content-center">
							<div class="row">
		   		             <div class="col-6 col-lg-6 col-xl-6">
		   		                 <h4>ФИО_1</h4>
								 <input id="shtend_name1" type="text" class="form-control form-control-lg radius-30"><br>
								 <h4>Звание_1</h4>
								 <input id="shtend_zv1" type="text" class="form-control form-control-lg radius-30"><br>
								 <h4>Год_1</h4>
								 <input id="shtend_ye1" type="text" class="form-control form-control-lg radius-30"><br>
								 <div class="row">
									 <div class="col-6 col-lg-6 col-xl-6">
											<a class="form-control form-control-lg radius-30" target="_blank" id="url_photo1img_show">Посмотреть ФОТО_1</a>
									 </div>
									 <div class="col-6 col-lg-6 col-xl-6">
										 <a class="form-control form-control-lg radius-30" href="#" id="url_photo1img">Загрузить ФОТО_1</a>
									 </div>
								 </div>

							 </div>
		   		             <div class="col-6 col-lg-6 col-xl-6">
								 <h4>ФИО_2</h4>
								 <input id="shtend_name2" type="text" class="form-control form-control-lg radius-30"><br>
								 <h4>Звание_2</h4>
								 <input id="shtend_zv2" type="text" class="form-control form-control-lg radius-30"><br>
								 <h4>Год_2</h4>
								 <input id="shtend_ye2" type="text" class="form-control form-control-lg radius-30"><br>
								 <div class="row">
									 <div class="col-6 col-lg-6 col-xl-6">
 									 		<a class="form-control form-control-lg radius-30" target="_blank" id="url_photo2img_show">Посмотреть ФОТО_2</a>
									 </div>
									 <div class="col-6 col-lg-6 col-xl-6">
										 <a class="form-control form-control-lg radius-30" id="url_photo2img">Загрузить ФОТО_2</a>
									 </div>
								 </div>

		   		             </div>
		   		         </div>
						 <br><hr>
								 <div class="row">
									 <div class="col-6 col-lg-6 col-xl-6">
											<a class="form-control form-control-lg radius-30" target="_blank" id="url_screenimg_show">Посмотреть Скрин</a>
									 </div>
									 <div class="col-6 col-lg-6 col-xl-6">
										 <a class="form-control form-control-lg radius-30" href="#" id="url_screenimg">Загрузить Скрин</a>
									 </div>
								 </div>
								 <hr>

								 <div class="row">

										<div class="col-4 col-lg-4 col-xl-4">
											<h4>Формат</h4>
										   <input id="shtend_format" type="text" class="form-control form-control-lg radius-30"><br>
										</div>
										<div class="col-4 col-lg-4 col-xl-4">
											<h4>Шаблон</h4>
   										 <input id="shtend_template" type="text" class="form-control form-control-lg radius-30"><br>
										</div>


									 <div class="col-4col-lg-4col-xl-4">
										 <h4>Ретуш, рестав.</h4>
										 <input id="shtend_flret" type="text" class="form-control form-control-lg radius-30"><br>
									 </div>
								 </div>
						</div>
						<br>
						<div class="row text-center justify-content-center">
							<div class="col-6 col-lg-6 col-xl-6">
								   <h4>Статус</h4>
								   <select id="status_shtend"  class="form-control" aria-label=".form-select-lg example">
									   <option selected></option>
									<option value="Активна">Активна</option>
									<option value="Отмена">Отмена</option>
									<option value="Ожидание">Ожидание</option>
									<option value="Оплачена">Оплачена</option>
									<option value="Закрыта">Закрыта</option>
								  </select>
 						  	</div>
						   </div>
						<hr>
						<br>
						<h3 class="text-center">Обработка заявки</h3>
						<div class="form-group">
							<label>ЦЕНА</label>
							<input id="price_shtend" type="text" class="form-control form-control-lg radius-30">
						</div>
						<div class="form-group">
							<label>Комментарий</label>
							<input id="comment_shtend" type="text" class="form-control form-control-lg radius-30">
						</div>
						<div class="form-group">
							<button id="updatezayiavka_shtend"  data-id="0" type="button" class="btn btn-light radius-30 btn-lg btn-block">Отправить</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>

		<div class="modal fade" id="obrs" tabindex="-1" aria-hidden="true" style="display: none;" >
			<div class="modal-dialog modal-xl modal-dialog-centered">
				<div class="modal-content radius-30">
					<div class="modal-header border-bottom-0">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body ">

						<br>
						<div class="row text-center justify-content-center">
							<div class="col-6 col-lg-6 col-xl-6">
									 <h4>Статус</h4>
									 <select id="status_obrs"  class="form-control" aria-label=".form-select-lg example">
										 <option selected></option>
									<option value="Активна">Активна</option>
									<option value="Отмена">Отмена</option>
									<option value="Ожидание">Ожидание</option>
									<option value="Оплачена">Оплачена</option>
									<option value="Закрыта">Закрыта</option>
									</select>
								</div>
							 </div>
						<hr>
						<br>
						<h3 class="text-center">Обработка заявки</h3>
						<div class="form-group">
							<label>ЦЕНА</label>
							<input id="price_obrs" type="text" class="form-control form-control-lg radius-30">
						</div>
						<div class="form-group">
							<label>Комментарий</label>
							<input id="comment_obrs" type="text" class="form-control form-control-lg radius-30">
						</div>
						<div class="form-group">
							<button id="updatezayiavka_obrs"  data-id="0" type="button" class="btn btn-light radius-30 btn-lg btn-block">Отправить</button>
						</div>
					</div>
				</div>
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
	<script src="assets/js/app.js"></script>
	<script type="text/javascript">



$(document).ready(function() {
	var arrID = [];

	$.ajax({url: 'api/requests/', method: 'GET', dataType: 'json', success: function(response){
		var obj = JSON.parse(response);
		obj.forEach(function(entry){
			arrID.push(entry.id);
			if (entry.status == "Resolved")
			{
					$("tbody").append('	<tr role="row" class="odd"><td class="sorting_1">'+entry.id+'</td><td>'+entry.tip+'</td><td>'+entry.price+'</td><td>'+entry.name+'<hr> <span style="color:;">'+entry.email+'</span><hr><span style="color:;"> '+entry.phon+'</span></td><td>'+entry.created_at+'</td><td><button type="button" class="btn btn-light radius-30" data-zaiv="'+entry.id+'" data-tip="'+entry.tip+'" id="obrabzaiavka" >Обработать </button><br><br><button type="button" data-zaiv="'+entry.id+'"  class="btn btn-light radius-30  delzaiavka" >Удалить </button></td></tr>');
			}
			else{
					$("tbody").append('	<tr role="row" class="odd"><td class="sorting_1">'+entry.id+'</td><td>'+entry.tip+'</td><td>'+entry.price+'</td><td>'+entry.name+'<hr> <span style="color:;">'+entry.email+'</span><hr><span style="color:;"> '+entry.phon+'</span></td><td>'+entry.status+'</td><td><div class="text-wrap" style="width: 150px;">'+entry.comment+'</div></td><td>'+entry.created_at+' </td><td><button type="button" class="btn btn-light radius-30" data-zaiv="'+entry.id+'" data-tip="'+entry.tip+'" id="obrabzaiavka">Обработать </button><br><br><button data-zaiv="'+entry.id+'" type="button" class="btn btn-light radius-30  delzaiavka" >Удалить </button></td></tr>');
			}

		});
		$('#example').DataTable();
		var table = $('#example2').DataTable({
			lengthChange: true,
			order: [[0, 'desc']],
			buttons: ['excel', 'pdf', 'print', 'colvis']
		});
		table.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
		}})

		$('#sorttest').attr('class','sorting_desc');
		$('#sorttest').attr('aria-sort','descending');







	$(document).on('click','.delzaiavka', function(){

		$.ajax({url: 'api/requests/'+$(this).attr('data-zaiv')+'', method: 'DELETE', dataType: 'json', success: function(response){console.log('response:', response)}})
		$(this).parent().parent().remove();
		//location.reload();
	  });

	$(document).on('click','#obrabzaiavka', function(){

		var idz = $(this).attr('data-zaiv');

		$.ajax({url: 'api/requests/'+$(this).attr('data-zaiv')+'', method: 'GET', dataType: 'json', success: function(response){

			var obj = JSON.parse(response);

			obj.forEach(function(entry){
				if (entry.tip == "vizitka")
				{
					$('#sizebum_vizit option[value='+entry.size+']').prop('selected', true);
					$('#tibum_vizit option[value='+entry.tipbum+']').prop('selected', true);
					$('#cvet_vizit option[value='+entry.cvet+']').prop('selected', true);
					$('#kolit_vizit option[value='+entry.kol+']').prop('selected', true);
					$('#srok_vizit option[value='+entry.srok+']').prop('selected', true);
					$('#status_vizit option[value='+entry.status+']').prop('selected', true);
					$('#price_vizit').val(entry.price);
					$('#comment_vizit').val(entry.comment);
					$('#updatezayiavka_vizit').attr('data-id', idz);
					$('#vizitkamodal').modal('show');
				}
				if (entry.tip == "listovki")
				{
					$('#sizebum_listov option[value='+entry.size+']').prop('selected', true);
					$('#tibum_listov option[value='+entry.tipbum+']').prop('selected', true);
					$('#cvet_listov option[value='+entry.cvet+']').prop('selected', true);
					$('#kolit_listov option[value='+entry.kol+']').prop('selected', true);
					$('#srok_listov option[value='+entry.srok+']').prop('selected', true);
					$('#status_listov option[value='+entry.status+']').prop('selected', true);
					$('#price_listov').val(entry.price);
					$('#comment_listov').val(entry.comment);
					$('#updatezayiavka_listov').attr('data-id', idz);
					$('#listovmodal').modal('show');
				}
				if (entry.tip == "petchat")
				{
					$('#petchat_tip_petchat option[value='+entry.petchat_tip+']').prop('selected', true);
					$('#osnastka_petchat option[value='+entry.osnastka+']').prop('selected', true);
					$('#avt_osnastka_petchat option[value='+entry.avt_osnastka+']').prop('selected', true);
					$('#srok_petchat option[value='+entry.srok+']').prop('selected', true);
					$('#status_petchat option[value='+entry.status+']').prop('selected', true);
					$('#price_petchat').val(entry.price);
					$('#comment_petchat').val(entry.comment);
					$('#updatezayiavka_petchat').attr('data-id', idz);
					$('#petchatmodal').modal('show');
				}
				if (entry.tip == "petfoto")
				{
					$('#sizebum_petchatfoto option[value='+entry.size+']').prop('selected', true);
					$('#tibum_petchatfoto option[value='+entry.tipbum+']').prop('selected', true);
					$('#kolit_petchatfoto').val(entry.kol);
					$('#srok_petchatfoto option[value='+entry.srok+']').prop('selected', true);
					$('#status_petchatfoto option[value='+entry.status+']').prop('selected', true);
					$('#price_petchatfoto').val(entry.price);
					$('#comment_petchatfoto').val(entry.comment);
					$('#updatezayiavka_petchatfoto').attr('data-id', idz);
					$('#petchatfotomodal').modal('show');
				}
				if (entry.tip == "ОБРАТНАЯ СВЯЗЬ")
				{
					$('#status_obrs option[value='+entry.status+']').prop('selected', true);
					$('#price_obrs').val(entry.price);
					$('#comment_obrs').val(entry.comment);
					$('#updatezayiavka_obrs').attr('data-id', idz);
					$('#obrs').modal('show');
				}

				if (entry.tip == "штендер")
				{
					$('#shtend_name1').val(entry.name1);
					$('#shtend_zv1').val(entry.zv1);
					$('#shtend_ye1').val(entry.ye1);
					$('#url_photo1img').attr("href", "/dl_save.php?filename="+entry.url_photo1img);
					$('#url_photo1img_show').attr("href", entry.url_photo1img);

					$('#shtend_name2').val(entry.name2);
					$('#shtend_zv2').val(entry.zv2);
					$('#shtend_ye2').val(entry.ye2);
					$('#url_photo2img').attr("href", "/dl_save.php?filename="+entry.url_photo2img);
					$('#url_photo2img_show').attr("href", entry.url_photo2img);

					$('#url_screenimg').attr("href", "/dl_save.php?filename="+entry.url_screenimg);
					$('#url_screenimg_show').attr("href", entry.url_screenimg);

					$('#shtend_flret').val(entry.flret);
					$('#shtend_format').val(entry.format);
					$('#shtend_template').val(entry.template);

					$('#status_shtend option[value='+entry.status+']').prop('selected', true);
					$('#price_shtend').val(entry.price);
					$('#comment_shtend').val(entry.comment);
					$('#updatezayiavka_shtend').attr('data-id', idz);
					$('#shtender').modal('show');
				}
			});
		}})
	  });

	  $('#updatezayiavka_petchatfoto').on('click', function(){
  			$.ajax({url: 'api/requests/'+ $(this).attr("data-id")+'', method: 'PUT', data: {status:$("#status_petchatfoto").val(), price:$("#price_petchatfoto").val(),tipz: "petfoto",comment: $("#comment_petchatfoto").val(),
			size:$("#sizebum_petchatfoto").val(), tip:$("#tibum_petchatfoto").val(),  kol:$("#kolit_petchatfoto").val(), srok:$("#srok_petchatfoto").val() }, dataType: 'json', success: function(response){console.log('response:', response)}})
  			location.reload();
  	  });

	  $('#updatezayiavka_petchat').on('click', function(){
  			$.ajax({url: 'api/requests/'+ $(this).attr("data-id")+'', method: 'PUT', data: {status:$("#status_petchat").val(), price:$("#price_petchat").val(),tipz: "petchat",comment: $("#comment_petchat").val(), petchat_tip:$("#petchat_tip_petchat").val(), osnastka:$("#osnastka_petchat").val(), avt_osnastka:$("#avt_osnastka_petchat").val(), srok:$("#srok_petchat").val() }, dataType: 'json', success: function(response){console.log('response:', response)}})
  			location.reload();
  	  });

	$('#updatezayiavka_listov').on('click', function(){
			$.ajax({url: 'api/requests/'+ $(this).attr("data-id")+'', method: 'PUT', data: {status:$("#status_listov").val(), price:$("#price_listov").val(),tipz: "listovki",comment: $("#comment_listov").val(), size:$("#sizebum_listov").val(), tip:$("#tibum_listov").val(), cvet:$("#cvet_listov").val(), kol:$("#kolit_listov").val(), srok:$("#srok_listov").val() }, dataType: 'json', success: function(response){console.log('response:', response)}})
			location.reload();
	  });

  	$('#updatezayiavka_vizit').on('click', function(){
			$.ajax({url: 'api/requests/'+ $(this).attr("data-id")+'', method: 'PUT', data: {status:$("#status_vizit").val(), price:$("#price_vizit").val(),tipz: "vizitka",comment: $("#comment_vizit").val(), size:$("#sizebum_vizit").val(), tip:$("#tibum_vizit").val(), cvet:$("#cvet_vizit").val(), kol:$("#kolit_vizit").val(), srok:$("#srok_vizit").val() }, dataType: 'json', success: function(response){console.log('response:', response)}})
			location.reload();
	});
	$('#updatezayiavka_shtend').on('click', function(){
		$.ajax({url: 'api/requests/'+ $(this).attr("data-id")+'', method: 'PUT', data: {status:$("#status_shtend").val(), price:$("#price_shtend").val(),tipz: "штендер",comment: $("#comment_shtend").val(), name1:$("#shtend_name1").val(), zv1:$("#shtend_zv1").val(), ye1:$("#shtend_ye1").val(),	name2:$("#shtend_name2").val(), zv2:$("#shtend_zv2").val(), ye2:$("#shtend_ye2").val(), url_photo1img:$("#url_photo1img_show").attr("href"), url_photo2img:$("#url_photo2img_show").attr("href"), url_screenimg:$("#url_screenimg_show").attr("href"), flret:$("#shtend_flret").val(), format:$("#shtend_format").val(), template:$("#shtend_template").val()}, dataType: 'json', success: function(response){console.log('response:', response)}})
		location.reload();
	});

	$('#updatezayiavka_obrs').on('click', function(){
		$.ajax({url: 'api/requests/'+ $(this).attr("data-id")+'', method: 'PUT', data: {status:$("#status_obrs").val(), price:$("#price_obrs").val(),tipz: "ОБРАТНАЯ СВЯЗЬ",comment: $("#comment_obrs").val(), }, dataType: 'json', success: function(response){console.log('response:', response)}})
		location.reload();
	});

	$('#addzayiavka').on('click', function(){
		if ($("#message").val() != ""){
			$.ajax({url: 'api/requests/', method: 'POST', data: {name: "<?php if (empty($_SESSION['user_logged_in'])){echo 0;}else {echo $_SESSION['login'];}?>", email: "<?php if (empty($_SESSION['user_logged_in'])){echo 0;}else {echo $_SESSION['email'];}?>", message: $("#message").val() }, dataType: 'json', success: function(response){console.log('response:', response)}})
			location.reload();
		}
		else{
			alert("Заполните поле сообщение!")
		}
	});


	function sayHi() {

		$.ajax({url: 'api/requests/', method: 'GET', dataType: 'json', success: function(response){
			var obj = JSON.parse(response);
			obj.forEach(function(entry){
				console.log(arrID);
				if (arrID.indexOf(entry.id) != -1){
				}
				else{
					arrID.push(entry.id);
					console.log(entry.id+" - нету");
					if (entry.status == "Resolved")
					{
							$("tbody").append('	<tr role="row" class="odd"><td class="sorting_1">'+entry.id+'</td><td>'+entry.tip+'</td><td>'+entry.price+'</td><td>'+entry.name+'</td><td>'+entry.email+'</td><td>'+entry.phon+'</td><td>'+entry.status+'</td><td><div class="text-wrap" style="width: 150px;">'+entry.comment+'</div></td><td>'+entry.created_at+'</td><td>'+entry.updated_at+'</td><td><button type="button" class="btn btn-light radius-30" data-zaiv="'+entry.id+'" data-tip="'+entry.tip+'" id="obrabzaiavka" >Обработать заявку</button><button type="button" data-zaiv="'+entry.id+'"  class="btn btn-light radius-30  delzaiavka" >Удалить заявку</button></td></tr>');
					}
					else{
							$("tbody").append('	<tr role="row" class="odd"><td class="sorting_1">'+entry.id+'</td><td>'+entry.tip+'</td><td>'+entry.price+'</td><td>'+entry.name+'</td><td>'+entry.email+'</td><td>'+entry.phon+'</td><td>'+entry.status+'</td><td><div class="text-wrap" style="width: 150px;">'+entry.comment+'</div></td><td>'+entry.created_at+'</td><td>'+entry.updated_at+'</td><td><button type="button" class="btn btn-light radius-30" data-zaiv="'+entry.id+'" data-tip="'+entry.tip+'" id="obrabzaiavka">Обработать заявку</button><button data-zaiv="'+entry.id+'" type="button" class="btn btn-light radius-30  delzaiavka" >Удалить заявку</button></td></tr>');
					}
				}
			});
		}})
	}
	  setInterval(sayHi, 20000);
});
</script>
</body>
</html>
<style media="screen">
.ogrsize{
	max-width: 80px;
	min-width: 80px;
}
</style>

