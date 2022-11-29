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

					<button type="button" name="button" id="save" class="btn btn-light m-1 px-5 radius-30">Сохранить</button>
					<h1>Печать</h1>
					<hr>

					<h3>A4 (+ к цене обычной 80 г.)</h3>
					<table class="table table-striped table-bordered" id="petchat_dop_A4">
						<tbody>
							<tr>
								<!--td>мт120</td-->
								<td>мт170</td>
								<!--td>мт200</td>
								<td>мт250</td-->
								<td>мт300</td>
								<!--td>гл170</td>
								<td>гл250</td>
								<td>клк250</td>
								<td>самоклейка</td-->
							</tr>
							<tr>
								<!--td id="petchat_A4_mt120"></td-->
								<td id="petchat_A4_mt160"></td>
								<!--td id="petchat_A4_mt200"></td>
								<td id="petchat_A4_mt250"></td-->
								<td id="petchat_A4_mt300"></td>
								<!--td id="petchat_A4_gl170"></td>
								<td id="petchat_A4_gl250"></td>
								<td id="petchat_A4_klk250"></td>
								<td id="petchat_A4_sk"> <input type="text" name="" value=""  class="calcprice"> </td-->
							</tr>
						</tbody>
					</table>
					<br>
					<h3>A3 (+ к цене обычной 80 г.)</h3>
					<table class="table table-striped table-bordered" id="petchat_dop_A3">
						<tbody>
							<tr>
								<td>мт170</td>
								<!--td>мт200</td>
								<td>мт250</td-->
								<td>мт300</td>
								<!--td>гл170</td>
								<td>гл250</td>
								<td>клк250</td-->
							</tr>
							<tr>
								<td id="petchat_A3_mt160"></td>
								<!--td id="petchat_A3_mt200"></td>
								<td id="petchat_A3_mt250"></td-->
								<td id="petchat_A3_mt280"></td>
								<!--td id="petchat_A3_gl170"></td>
								<td id="petchat_A3_gl250"></td>
								<td id="petchat_A3_sm"></td-->
							</tr>
						</tbody>
					</table>
					<br>

					<h3>Цветная</h3>
					<br>
					<table class="table table-striped table-bordered" id="petchat_chet_A4_A3">
						<tbody>
							<tr>
								<td>0</td>
								<td>10</td>
								<td>50</td>
								<td>100</td>
								<td>250</td>
								<td>500</td>
								<td>1000</td>
								<td>10000</td>
							</tr>
							<tr>
								<td id="petchat_chet_A4_0_odn"></td>
								<td id="petchat_chet_A4_10_odn"></td>
								<td id="petchat_chet_A4_50_odn"></td>
								<td id="petchat_chet_A4_100_odn"></td>
								<td id="petchat_chet_A4_250_odn"></td>
								<td id="petchat_chet_A4_500_odn"></td>
								<td id="petchat_chet_A4_1000_odn"></td>
								<td id="petchat_chet_A4_10000_odn"></td>
								<td >A4 односторон</td>
							</tr>
							<tr>
								<td id="petchat_chet_A4_0_dvx"></td>
								<td id="petchat_chet_A4_10_dvx"></td>
								<td id="petchat_chet_A4_50_dvx"></td>
								<td id="petchat_chet_A4_100_dvx"></td>
								<td id="petchat_chet_A4_250_dvx"></td>
								<td id="petchat_chet_A4_500_dvx"></td>
								<td id="petchat_chet_A4_1000_dvx"></td>
								<td id="petchat_chet_A4_10000_dvx"></td>
								<td>A4 двусторонн</td>
							</tr>
							<tr>
								<td id="petchat_chet_A3_0_odn"></td>
								<td id="petchat_chet_A3_10_odn"></td>
								<td id="petchat_chet_A3_50_odn"></td>
								<td id="petchat_chet_A3_100_odn"></td>
								<td id="petchat_chet_A3_250_odn"></td>
								<td id="petchat_chet_A3_500_odn"></td>
								<td id="petchat_chet_A3_1000_odn"></td>
								<td id="petchat_chet_A3_10000_odn"></td>
								<td>A3 односторон</td>
							</tr>
							<tr>
								<td id="petchat_chet_A3_0_dvx"></td>
								<td id="petchat_chet_A3_10_dvx"></td>
								<td id="petchat_chet_A3_50_dvx"></td>
								<td id="petchat_chet_A3_100_dvx"></td>
								<td id="petchat_chet_A3_250_dvx"></td>
								<td id="petchat_chet_A3_500_dvx"></td>
								<td id="petchat_chet_A3_1000_dvx"></td>
								<td id="petchat_chet_A3_10000_dvx"></td>
								<td>A3 двусторонн</td>
							</tr>

						</tbody>
					</table>
					<br>
					<table class="table table-striped table-bordered" id="petchat_chet_A2_A0">
						<tbody>
							<tr>
								<td>0</td>
								<td>10</td>
								<td>100</td>
								<td>1000</td>
								<td></td>
							</tr>
							<tr>
								<td id="petchat_chet_A2_0_z0"></td>
								<td id="petchat_chet_A2_10_z0"></td>
								<td id="petchat_chet_A2_100_z0"></td>
								<td id="petchat_chet_A2_1000_z0"></td>
								<td>A2 обычная бумага заливка менее 20%</td>
							</tr>
							<tr>
								<td id="petchat_chet_A2_0_z20"></td>
								<td id="petchat_chet_A2_10_z20"></td>
								<td id="petchat_chet_A2_100_z20"></td>
								<td id="petchat_chet_A2_1000_z20"></td>
								<td>A2 обычная бумага заливка более 20%</td>
							</tr>
							<tr>
								<td id="petchat_chet_A1_0_z0"></td>
								<td id="petchat_chet_A1_10_z0"></td>
								<td id="petchat_chet_A1_100_z0"></td>
								<td id="petchat_chet_A1_1000_z0"></td>
								<td>A1 обычная бумага заливка менее 20%</td>
							</tr>
							<tr>
								<td id="petchat_chet_A1_0_z20"></td>
								<td id="petchat_chet_A1_10_z20"></td>
								<td id="petchat_chet_A1_100_z20"></td>
								<td id="petchat_chet_A1_1000_z20"></td>
								<td>A1 обычная бумага заливка более 20%</td>
							</tr>
							<tr>
								<td id="petchat_chet_A0_0_z0"></td>
								<td id="petchat_chet_A0_10_z0"></td>
								<td id="petchat_chet_A0_100_z0"></td>
								<td id="petchat_chet_A0_1000_z0"></td>
								<td>A0 обычная бумага заливка менее 20%</td>
							</tr>
							<tr>
								<td id="petchat_chet_A0_0_z20"></td>
								<td id="petchat_chet_A0_10_z20"></td>
								<td id="petchat_chet_A0_100_z20"></td>
								<td id="petchat_chet_A0_1000_z20"></td>
								<td>A0 обычная бумага заливка более 20%</td>
							</tr>
							<tr>
								<td id="petchat_chet_ns_0_z0"></td>
								<td id="petchat_chet_ns_10_z0"></td>
								<td id="petchat_chet_ns_100_z0"></td>
								<td id="petchat_chet_ns_1000_z0"></td>
								<td>Нестнд обычная бумага заливка менее 20%</td>
							</tr>
							<tr>
								<td id="petchat_chet_ns_0_z20"></td>
								<td id="petchat_chet_ns_10_z20"></td>
								<td id="petchat_chet_ns_100_z20"></td>
								<td id="petchat_chet_ns_1000_z20"></td>
								<td>Нестнд обычная бумага заливка более 20%</td>
							</tr>
						</tbody>
					</table>
					<br>
					<h5>Широкоформатная печать</h5>
					<table class="table table-striped table-bordered" id="petchat_chet_shirokoformat">
						<tbody>
							<tr>
								<td></td>
								<td>матовая 180г</td>
								<td>глянец HP</td>
								<td>калька 90г</td>
								<!--td>cамоклейка</td>
								<td>холcт 320г</td-->
							</tr>

							<tr>
								<td>А2</td></td>
								<td id="petchat_chet_A2_mat"></td>
								<td id="petchat_chet_A2_gl"></td>
								<td id="petchat_chet_A2_kalka"></td>
								<!--td id="petchat_chet_A2_samokl"></td>
								<td id="petchat_chet_A2_xolst"></td-->
							</tr>

							<tr>
								<td>А1</td></td>
								<td id="petchat_chet_A1_mat"></td>
								<td id="petchat_chet_A1_gl"></td>
								<td id="petchat_chet_A1_kalka"></td>
								<!--td id="petchat_chet_A1_samokl"></td>
								<td id="petchat_chet_A1_xolst"></td-->
							</tr>

							<tr>
								<td>А0</td></td>
								<td id="petchat_chet_A0_mat"></td>
								<td id="petchat_chet_A0_gl"></td>
								<td id="petchat_chet_A0_kalka_Koment"> - </td>
								<!--td id="petchat_chet_A0_samokl"></td>
								<td id="petchat_chet_A0_xolst"></td-->
							</tr>

							<tr>
								<td>Нестандартная</td></td>
								<td id="petchat_chet_ns_mat"></td>
								<td id="petchat_chet_ns_gl"></td>
								<td id="petchat_chet_ns_kalka"></td>
								<!--td id="petchat_chet_ns_samokl"></td>
								<td id="petchat_chet_ns_xolst"></td-->
							</tr>
						</tbody>
					</table>
					<h3>Черно-белая</h3>
					<br>
					<table class="table table-striped table-bordered" id="petchat_bw_A4_A3">
						<tbody>
							<tr>
								<td>0</td>
								<td>10</td>
								<td>50</td>
								<td>100</td>
								<td>250</td>
								<td>500</td>
								<td>1000</td>
								<td>10000</td>
							</tr>
							<tr>
								<td id="petchat_bw_A4_0_odn"></td>
								<td id="petchat_bw_A4_10_odn"></td>
								<td id="petchat_bw_A4_50_odn"></td>
								<td id="petchat_bw_A4_100_odn"></td>
								<td id="petchat_bw_A4_250_odn"></td>
								<td id="petchat_bw_A4_500_odn"></td>
								<td id="petchat_bw_A4_1000_odn"></td>
								<td id="petchat_bw_A4_10000_odn"></td>
								<td >A4 односторон</td>
							</tr>
							<tr>
								<td id="petchat_bw_A4_0_dvx"></td>
								<td id="petchat_bw_A4_10_dvx"></td>
								<td id="petchat_bw_A4_50_dvx"></td>
								<td id="petchat_bw_A4_100_dvx"></td>
								<td id="petchat_bw_A4_250_dvx"></td>
								<td id="petchat_bw_A4_500_dvx"></td>
								<td id="petchat_bw_A4_1000_dvx"></td>
								<td id="petchat_bw_A4_10000_dvx"></td>
								<td>A4 двусторонн</td>
							</tr>
							<tr>
								<td id="petchat_bw_A3_0_odn"></td>
								<td id="petchat_bw_A3_10_odn"></td>
								<td id="petchat_bw_A3_50_odn"></td>
								<td id="petchat_bw_A3_100_odn"></td>
								<td id="petchat_bw_A3_250_odn"></td>
								<td id="petchat_bw_A3_500_odn"></td>
								<td id="petchat_bw_A3_1000_odn"></td>
								<td id="petchat_bw_A3_10000_odn"></td>
								<td>A3 односторон</td>
							</tr>
							<tr>
								<td id="petchat_bw_A3_0_dvx"></td>
								<td id="petchat_bw_A3_10_dvx"></td>
								<td id="petchat_bw_A3_50_dvx"></td>
								<td id="petchat_bw_A3_100_dvx"></td>
								<td id="petchat_bw_A3_250_dvx"></td>
								<td id="petchat_bw_A3_500_dvx"></td>
								<td id="petchat_bw_A3_1000_dvx"></td>
								<td id="petchat_bw_A3_10000_dvx"></td>
								<td>A3 двусторонн</td>
							</tr>

						</tbody>
					</table>
					<br>
					<table class="table table-striped table-bordered" id="petchat_bw_A2_A0">
						<tbody>
							<tr>
								<td>0</td>
								<td>50</td>
								<td>200</td>
								<td>500</td>
								<td></td>
							</tr>
							<tr>
								<td id="petchat_bw_A2_0_80"></td>
								<td id="petchat_bw_A2_50_80"></td>
								<td id="petchat_bw_A2_200_80"></td>
								<td id="petchat_bw_A2_500_80"></td>
								<td>A2 обычная 80г</td>
							</tr>
							<tr>
								<td id="petchat_bw_A2_0_90"></td>
								<td id="petchat_bw_A2_50_90"></td>
								<td id="petchat_bw_A2_200_90"></td>
								<td id="petchat_bw_A2_500_90"></td>
								<td>A2 калька 90г</td>
							</tr>
							<tr>
								<td id="petchat_bw_A1_0_80"></td>
								<td id="petchat_bw_A1_50_80"></td>
								<td id="petchat_bw_A1_200_80"></td>
								<td id="petchat_bw_A1_500_80"></td>
								<td>A1 обычная 80г</td>
							</tr>
							<tr>
								<td id="petchat_bw_A1_0_90"></td>
								<td id="petchat_bw_A1_50_90"></td>
								<td id="petchat_bw_A1_200_90"></td>
								<td id="petchat_bw_A1_500_90"></td>
								<td>A1 калька 90г</td>
							</tr>
							<tr>
								<td id="petchat_bw_A0_0_80"></td>
								<td id="petchat_bw_A0_50_80"></td>
								<td id="petchat_bw_A0_200_80"></td>
								<td id="petchat_bw_A0_500_80"></td>
								<td>A0 обычная 80г</td>
							</tr>
							<tr>
								<td id="petchat_bw_A0_0_90"></td>
								<td id="petchat_bw_A0_50_90"></td>
								<td id="petchat_bw_A0_200_90"></td>
								<td id="petchat_bw_A0_500_90"></td>
								<td>A0 калька 90г</td>
							</tr>
							<tr>
								<td id="petchat_bw_ns_0_80"></td>
								<td id="petchat_bw_ns_50_80"></td>
								<td id="petchat_bw_ns_200_80"></td>
								<td id="petchat_bw_ns_500_80"></td>
								<td>нестд обычная 80г</td>
							</tr>
							<tr>
								<td id="petchat_bw_ns_0_90"></td>
								<td id="petchat_bw_ns_50_90"></td>
								<td id="petchat_bw_ns_200_90"></td>
								<td id="petchat_bw_ns_500_90"></td>
								<td>нестд калька 90г</td>
							</tr>
						</tbody>
					</table>

					<h1>Переплет</h1>
					<hr>
					<table class="table table-striped table-bordered" id="pereplet">
						<tbody>
							<tr>
								<td id="pereplet_pl_A4_m"></td>
								<td id="pereplet_pl_A4_s"></td>
								<td id="pereplet_pl_A4_b"></td>
								<td>пласт А4: малая, средняя, большая</td>
							</tr>
							<tr>
								<td id="pereplet_pl_A3_m"></td>
								<td id="pereplet_pl_A3_s"></td>
								<td id="pereplet_pl_A3_b"></td>
								<td>пласт А3: малая, средняя, большая</td>
							</tr>
							<tr>
								<td id="pereplet_mt_A4_m"></td>
								<td id="pereplet_mt_A4_s"></td>
								<td id="pereplet_mt_A4_b"></td>
								<td>металл А4: малая, средняя, большая</td>
							</tr>
							<tr>
								<td id="pereplet_mt_A3_m"></td>
								<td id="pereplet_mt_A3_s"></td>
								<td id="pereplet_mt_A3_b"></td>
								<td>металл А3: малая, средняя, большая</td>
							</tr>
							<tr>
								<td id="pereplet_tv_5"></td>
								<td id="pereplet_tv_10"></td>
								<td id="pereplet_tv_16"></td>
								<td>Твердый: 5-7, 10-13, 16-20</td>
							</tr>
							<tr>
								<td id="pereplet_vs_k"></td>
								<td id="pereplet_vs_f"></td>
								<td id="pereplet_pl_per"></td>
								<td>Вставка конверта, Вставка файла, Пластиковая переброшюровка</td>
							</tr>
						</tbody>
					</table>
					<br>

					<h1>Прочее</h1>
					<hr>
					<table class="table table-striped table-bordered" id="prochee">
						<tbody>
							<tr>
								<td>Резка</td>
								<td>Ручная резка</td>
								<td>Отправка-прием файлов</td>
								<td>Работа на компе</td>
								<td>Набор текста</td>
								<td>Доработка файлов</td>
								<td>диск клиента</td>
								<td>диск компании</td>
							</tr>
							<tr>
								<td id="prochee_r"></td>
								<td id="prochee_rr"></td>
								<td id="prochee_opf"></td>
								<td id="prochee_rk"></td>
								<td id="prochee_nt"></td>
								<td id="prochee_df"></td>
								<td id="prochee_dc"></td>
								<td id="prochee_dk"></td>
							</tr>
							<tr>
								<td>Сшивание/расшивание</td>
								<td>Перфорация листов</td>
								<td>Степлер</td>
								<td>Биговка</td>
								<td>Тиснение</td>
								<td>Доставка</td>
								<td>Папка скоросшиватель</td>
								<td> Файл A4</td>
							</tr>
							<tr>
								<td id="prochee_shiv"></td>
								<td id="prochee_perfor"></td>
								<td id="prochee_stepler"></td>
								<td id="prochee_bigovka"></td>
								<td id="prochee_tisn"></td>
								<td id="prochee_dost"></td>
								<td id="prochee_ps"></td>
								<td id="prochee_A4"></td>
							</tr>
							<tr>
								<td>Файл A3</td>
								<td colspan="7" rowspan="2"></td>
							</tr>
							<tr>
								<td id="prochee_A3"></td>
							</tr>
						</tbody>
					</table>
 					<br>

					<h3>Сканирование</h3>
					<table class="table table-striped table-bordered" id="prochee_scan">
						<tbody>
						<tr>
							<td>0</td>
							<td>10</td>
							<td>50</td>
							<td>100</td>
							<td>500</td>
							<td></td>
						</tr>
						<tr>
							<td id="prochee_scan_0_A4_av"></td>
							<td id="prochee_scan_10_A4_av"></td>
							<td id="prochee_scan_50_A4_av"></td>
							<td id="prochee_scan_100_A4_av"></td>
							<td id="prochee_scan_500_A4_av"></td>
							<td>А4 авто</td>
						</tr>
						<tr>
							<td id="prochee_scan_0_A4_r"></td>
							<td id="prochee_scan_10_A4_r"></td>
							<td id="prochee_scan_50_A4_r"></td>
							<td id="prochee_scan_100_A4_r"></td>
							<td id="prochee_scan_500_A4_r"></td>
							<td>А4 руч</td>
						</tr>
						<tr>
							<td id="prochee_scan_0_A3_av"></td>
							<td id="prochee_scan_10_A3_av"></td>
							<td id="prochee_scan_50_A3_av"></td>
							<td id="prochee_scan_100_A3_av"></td>
							<td id="prochee_scan_500_A3_av"></td>
							<td>А3 авто</td>
						</tr>
						<tr>
							<td id="prochee_scan_0_A3_r"></td>
							<td id="prochee_scan_10_A3_r"></td>
							<td id="prochee_scan_50_A3_r"></td>
							<td id="prochee_scan_100_A3_r"></td>
							<td id="prochee_scan_500_A3_r"></td>
							<td>А3 руч</td>
						</tr>
						<tr>
							<td id="prochee_scan_0_A2"></td>
							<td id="prochee_scan_10_A2"></td>
							<td id="prochee_scan_50_A2"></td>
							<td id="prochee_scan_100_A2"></td>
							<td id="prochee_scan_500_A2"></td>
							<td>А2</td>
						</tr>
						<tr>
							<td id="prochee_scan_0_A1"></td>
							<td id="prochee_scan_10_A1"></td>
							<td id="prochee_scan_50_A1"></td>
							<td id="prochee_scan_100_A1"></td>
							<td id="prochee_scan_500_A1"></td>
							<td>А1</td>
						</tr>
						<tr>
							<td id="prochee_scan_0_A0"></td>
							<td id="prochee_scan_10_A0"></td>
							<td id="prochee_scan_50_A0"></td>
							<td id="prochee_scan_100_A0"></td>
							<td id="prochee_scan_500_A0"></td>
							<td>A0</td>
						</tr>
					</tbody>
					</table>
					<br>

					<h3>Ламинирование</h3>
					<table class="table table-striped table-bordered" id="prochee_lam">
						<tbody>
							<tr>
								<td>0</td>
								<td>10</td>
								<td>50</td>
								<td></td>
							</tr>
							<tr>
								<td id="prochee_lam_0_A6_g"></td>
								<td id="prochee_lam_10_A6_g"></td>
								<td id="prochee_lam_50_A6_g"></td>
								<td>глянц А6</td>
							</tr>
							<tr>
								<td id="prochee_lam_0_A5_g"></td>
								<td id="prochee_lam_10_A5_g"></td>
								<td id="prochee_lam_50_A5_g"></td>
								<td>глянц А5</td>
							</tr>
							<tr>
								<td id="prochee_lam_0_A4_g"></td>
								<td id="prochee_lam_10_A4_g"></td>
								<td id="prochee_lam_50_A4_g"></td>
								<td>глянц А4</td>
							</tr>
							<tr>
								<td id="prochee_lam_0_A3_g"></td>
								<td id="prochee_lam_10_A3_g"></td>
								<td id="prochee_lam_50_A3_g"></td>
								<td>глянц А3</td>
							</tr>
							<tr>
								<td id="prochee_lam_0_A6_m"></td>
								<td id="prochee_lam_10_A6_m"></td>
								<td id="prochee_lam_50_A6_m"></td>
								<td>мат А6</td>
							</tr>
							<tr>
								<td id="prochee_lam_0_A5_m"></td>
								<td id="prochee_lam_10_A5_m"></td>
								<td id="prochee_lam_50_A5_m"></td>
								<td>мат А5</td>
							</tr>
							<tr>
								<td id="prochee_lam_0_A4_m"></td>
								<td id="prochee_lam_10_A4_m"></td>
								<td id="prochee_lam_50_A4_m"></td>
								<td>мат А4</td>
							</tr>
							<tr>
								<td id="prochee_lam_0_A3_m"></td>
								<td id="prochee_lam_10_A3_m"></td>
								<td id="prochee_lam_50_A3_m"></td>
								<td>мат А3</td>
							</tr>
						</tbody>
					</table>
					<br>


					<h1>Дизаин</h1>
					<hr>
					<table class="table table-striped table-bordered" id="dis_one">
						<tbody>
							<tr>
								<td>Услуги</td>
								<td>Верстка визитки</td>
								<td>Фоторетушь</td>
								<td>Верстка макета</td>
								<td>Разработка логотипа</td>
							</tr>
							<tr>
								<td id="dis_one_ysl"></td>
								<td id="dis_one_vv"></td>
								<td id="dis_one_fr"></td>
								<td id="dis_one_vm"></td>
								<td id="dis_one_rl"></td>
							</tr>
						</tbody>
					</table>
					<br>

					<h3>Дизаин Бумаги</h3>
					<table class="table table-striped table-bordered" id="dis_db">
						<tbody>
							<tr>
								<td>Диз. бумага</td>
								<td>Touche Cover</td>
								<td>Verona лён</td>
								<td>Majestic</td>
							</tr>
							<tr>
								<td id="dis_db_db"></td>
								<td id="dis_db_tc"></td>
								<td id="dis_db_vl"></td>
								<td id="dis_db_m"></td>
							</tr>
						</tbody>
					</table>
					<br>

					<h3>Фото на документы</h3>
					<table class="table table-striped table-bordered" id="dis_fd">
						<tbody>
							<tr>
								<td>Комплект фото/эл.файл</td>
								<td>Комплект фото + эл.файл</td>
								<td>Комплект фото + костюм</td>
								<td>Комплект фото + костюм + эл.файл</td>
								<td>Доп.комплект</td>
							</tr>
							<tr>
								<td id="dis_fd_1"></td>
								<td id="dis_fd_2"></td>
								<td id="dis_fd_3"></td>
								<td id="dis_fd_4"></td>
								<td id="dis_fd_5"></td>
							</tr>
						</tbody>
					</table>
					<br>

					<h3>Печати</h3>
					<table class="table table-striped table-bordered" id="dis_pet">
						<tbody>
							<tr>
								<td>Круглая печать</td>
								<td>Штамп Малый</td>
								<td>Штамп Средний</td>
								<td>Штамп Большой</td>
								<td>Факсимиле</td>
								<td>Экслибрис</td>
								<td>Отрисовка печати</td>

							</tr>
							<tr>
								<td id="dis_pet_kp"></td>
								<td id="dis_pet_hm"></td>
								<td id="dis_pet_hs"></td>
								<td id="dis_pet_hb"></td>
								<td id="dis_pet_fa"></td>
								<td id="dis_pet_iks"></td>
								<td id="dis_pet_otp"></td>
							</tr>
						</tbody>
					</table>
					<br>

					<h3>Оснастки</h3>
					<table class="table table-striped table-bordered" id="dis_osn">
						<tbody>
							<tr>
								<td>Авто оснастка Ø 30/40/42</td>
								<td>Простая оснастка</td>
								<td>Авто штамп малый</td>
								<td>"Авто штамп средний</td>
								<td>Авто штамп большой</td>
								<td>Простая оснастка штамп</td>
							</tr>
							<tr>
								<td id="dis_osn_1"></td>
								<td id="dis_osn_2"></td>
								<td id="dis_osn_3"></td>
								<td id="dis_osn_4"></td>
								<td id="dis_osn_5"></td>
								<td id="dis_osn_6"></td>
							</tr>
						</tbody>
					</table>
					<br>

					<h3>Краски</h3>
					<table class="table table-striped table-bordered" id="dis_krask">
						<tbody>
							<tr>
								<td>Подушка 2 pads 50x90</td>
								<td>Подушка 2 pads 70x110</td>
								<td>Подушка 50x90</td>
								<td>Подушка 70x110</td>
								<td>Краска</td>
							</tr>
							<tr>
								<td id="dis_krask_1"></td>
								<td id="dis_krask_2"></td>
								<td id="dis_krask_3"></td>
								<td id="dis_krask_4"></td>
								<td id="dis_krask_5"></td>
							</tr>
						</tbody>
					</table>
					<br>

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
	$.ajax({url: 'get_price.php', method: 'GET', dataType: 'json', success: function(response){
		$.each(response, function(k, v) {
					$('#'+k+'').html('<input  value="'+v+'" class="calcprice" type="number">')
			 });
	}})

/*	$(this).find('td').each(function(cell){
		if ($(this).attr('id') != undefined){
			$(this).html('<input type="text" class="calcprice">')
		}
	});*/

	$('#save').click(function(){
		var json = '{';


   		$('#petchat_dop_A4 tr').each(function(row){
			 	$(this).find('td').each(function(cell){
					if ($(this).attr('id') != undefined){
						let textinfo= $(this).find("input").val();
						textinfo = textinfo.replace(",", ".");

						json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
					}
				});
		});

		$('#petchat_chet_shirokoformat tr').each(function(row){
			 	$(this).find('td').each(function(cell){
					if ($(this).attr('id') != undefined){
						let textinfo= $(this).find("input").val();
						textinfo = textinfo.replace(",", ".");

						json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
					}
				});
		});

		$('#petchat_dop_A3 tr').each(function(row){
			$(this).find('td').each(function(cell){
				if ($(this).attr('id') != undefined){
					let textinfo= $(this).find("input").val();
					textinfo = textinfo.replace(",", ".");


					json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
				}
			});
		});

		$('#petchat_chet_A4_A3 tr').each(function(row){
			$(this).find('td').each(function(cell){
				if ($(this).attr('id') != undefined){
					let textinfo= $(this).find("input").val();
					textinfo = textinfo.replace(",", ".");


					json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
				}
			});
		});
		$('#petchat_chet_A2_A0 tr').each(function(row){
			$(this).find('td').each(function(cell){
				if ($(this).attr('id') != undefined){
					let textinfo= $(this).find("input").val();
					textinfo = textinfo.replace(",", ".");


					json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
				}
			});
		});

		$('#petchat_bw_A4_A3 tr').each(function(row){
			$(this).find('td').each(function(cell){
				if ($(this).attr('id') != undefined){
					let textinfo= $(this).find("input").val();
					textinfo = textinfo.replace(",", ".");


					json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
				}
			});
		});
		$('#petchat_bw_A2_A0 tr').each(function(row){
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
		$('#prochee_scan tr').each(function(row){
			$(this).find('td').each(function(cell){
				if ($(this).attr('id') != undefined){
					let textinfo= $(this).find("input").val();
					textinfo = textinfo.replace(",", ".");


					json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
				}
			});
		});
		$('#prochee_lam tr').each(function(row){
			$(this).find('td').each(function(cell){
				if ($(this).attr('id') != undefined){
					let textinfo= $(this).find("input").val();
					textinfo = textinfo.replace(",", ".");


					json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
				}
			});
		});

		$('#dis_one tr').each(function(row){
			$(this).find('td').each(function(cell){
				if ($(this).attr('id') != undefined){
					let textinfo= $(this).find("input").val();
					textinfo = textinfo.replace(",", ".");
					json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
				}
			});
		});
		$('#dis_db tr').each(function(row){
			$(this).find('td').each(function(cell){
				if ($(this).attr('id') != undefined){
					let textinfo= $(this).find("input").val();
					textinfo = textinfo.replace(",", ".");
					json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
				}
			});
		});
		$('#dis_fd tr').each(function(row){
			$(this).find('td').each(function(cell){
				if ($(this).attr('id') != undefined){
					let textinfo= $(this).find("input").val();
					textinfo = textinfo.replace(",", ".");
					json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
				}
			});
		});
		$('#dis_pet tr').each(function(row){
			$(this).find('td').each(function(cell){
				if ($(this).attr('id') != undefined){
					let textinfo= $(this).find("input").val();
					textinfo = textinfo.replace(",", ".");
					json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
				}
			});
		});
		$('#dis_osn tr').each(function(row){
			$(this).find('td').each(function(cell){
				if ($(this).attr('id') != undefined){
					let textinfo= $(this).find("input").val();
					textinfo = textinfo.replace(",", ".");
					json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
				}
			});
		});
		$('#dis_krask tr').each(function(row){
			$(this).find('td').each(function(cell){
				if ($(this).attr('id') != undefined){
					let textinfo= $(this).find("input").val();
					textinfo = textinfo.replace(",", ".");
					json = json + '"'+$(this).attr("id")+'":"'+textinfo+'",';
				}
			});
		});

		json = json + "}";
		$.ajax({url: 'save_price.php', method: 'POST', data: {info: json}, dataType: 'json', success: function(response){console.log('response:', response)}})
		//console.log(json);
	})
})
</script>
