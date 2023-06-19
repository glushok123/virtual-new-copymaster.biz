<?php
$keyw = "срочное изготовление печатей, срочное изготовление печатей и штампов";
$titl = "Срочное изготовление печатей и штампов. Копимастер.";
$desc = "Срочное изготовление печатей и штампов в копировальном центре Копимастер";
include_once 'header.php';
?>

<section class="section">
	<div class="container text-center">
		<div class="row row justify-content-center">
			<div class="col-12 col-lg-6 col-xl-6"></div>
			<div class="col-12 col-lg-6 col-xl-6"></div>
		</div>
		<div class="w1 con">
			<h1>Срочное изготовление печатей</h1><hr>
			<p>Наш копировальный центр предлагает вам срочное изготовление печатей на выгодных условиях. Мы принимаем в работу: новые печати, треугольные и прямоугольные штампы, личные печати, рекламные штампы, точные копии по оттиску. Обратившись к нам, вы можете заказать печати разного размера и диаметра. Мы внимательно выслушаем вас и предложим лучшие решения для заказа.</p><br>

			<p>По вашему желанию, мы не только создаем печать, но и размещаем на ней элементы защиты: дефект клише, оригинальные шрифты и другие.</p><br>
			<p>Узнать подробнее о том, какие материалы мы используем для изготовления клише, вы можете у наших менеджеров. При обращении к ним обязательно укажите, что вас интересует срочное изготовление печатей, так как не все способы изготовления штампов подходят для быстрых заказов.</p><br>
			<h2>О наших преимуществах</h2><hr>
			<p>Мы предлагаем срочное изготовление печатей различного уровня сложности. Обращайтесь к нам, чтобы заказать продукцию с долгим сроком службы. Для крупных организаций и юридических фирм мы с удовольствием предложим специальные условия сотрудничества. Выбрав нас, они гарантировано получат следующие преимущества:</p><br>
			<ul>
				<li>скидки и выгодные предложения;</li>
				<li>удобное расположение копировального центра;</li>
				<li>наличие всех необходимых сертификатов;</li>
				<li>минимальные сроки изготовления печатей и штампов;</li>
				<li>высокое качество продукции;</li>
				<li>изготовление печатей любой сложности;</li>
				<li>возможность оформить заказ дистанционно;</li>
				<li>разные способы оплаты;</li>
				<li>розничные и оптовые заказы;</li>
				<li>невысокие цены.</li>
			</ul>
			<p>Ознакомиться с прайсом на срочное изготовление печатей вы можете в специальной таблице. Однако учтите, что указанные значения не включают стоимость оснастки и услуги дизайнера. Информация о них указана на сайте, под таблицей.
			</p><br>
			<p>Выбирайте наш копировальный центр за удобный график работы, доступные цены и современное оборудование. Готовую продукцию вы можете забрать сами или воспользоваться услугами курьерской службы. В любом случае, мы уверены, что вы останетесь довольны качеством проделанной нами работы. Обращение к нам сэкономит ваше время и деньги.
			</p><br>
		</div>
	</div>
</section>
<br><br><br>

<div class="conatiner">
	<div class="row justify-content-center text-center">
		<div class="wrap">
			<button class="buttonpuls" data-bs-toggle="modal" data-bs-target="#exampleModal4">Сделать заказ</button>
		</div>
	</div>
</div>
<br><br><br>
<div class="conatiner">
	<div class="row justify-content-center text-center ">
		<button class="btn btn-sm nav-btn btn-primary mb-4 mb-lg-0 bug1" id="priceshow" style="max-width:300px">Показать цены</button>
	</div>
</div>

<br><br>
<section class="price">
	<div class="row text-center justify-content-center">
		<div class="col-12 col-lg-6 col-xl-6 text-center justify-content-center">
			<div id="price" class="w1 con">
				<h2>Цены для физических лиц</h2><hr>
				<div
					class="table-responsive">
					<!--Услуги дизайнера-->
					<?php include_once "price/FL/fl_dizain.php"; ?>
				</div>

				<div
					class="table-responsive">
					<!--Изготовление печатей и штампов-->
					<?php include_once "price/FL/fl_pet_and_htamp.php"; ?>
				</div>

				<div
					class="table-responsive">
					<!--Печать визиток 90*50 мм-->
					<?php include_once "price/FL/fl_pet_vizitok.php"; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
include_once 'footer.php';
?>

