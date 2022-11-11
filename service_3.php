<?php
$keyw="где сделать ксерокопию, ксерокопия, ксерокопия круглосуточно";
$titl="Круглосуточная ксерокопия в Москве в копировальном центре Копимастер";
$desc="Копировальный центр «Копимастер» - Печать чертежей круглосуточно!";
include_once 'header.php';
 ?>

	<section class="section">
		<div class="container text-center">
            <h1>Услуги  ксерокопии</h1><hr>
            <div class="row row justify-content-center">
                <div class="col-12 col-lg-6 col-xl-6">
                    <img src="img/xerocopy1.jpg" alt="Ксерокопия" title="Ксерокопия">
                </div>
                <div class="col-12 col-lg-6 col-xl-6">
                       <p>Основным видом деятельности копировального центра "Копимастер" является печать полиграфической продукции, однако наши возможности позволяют нам оказывать и другие услуги. К примеру, у нас вы можете сделать ксерокопию документов на профессиональной копировальной технике. Эта услуга востребована всеми категориями клиентов. Высокая скорость работы аппаратуры позволяет за одну минуту распечатать до 105 экземпляров документа популярного формата А4.</p><br>

                </div>
            </div>
			<div class="w1 con">
                <p>Без ксерокопий сложно представить работу современного офиса. К слову, прототип копировального аппарата был изобретен именно у нас, в России, в 1869 году. Он носил название "гектограф" и по принципу своей работы сильно отличался от современного ксерокса. И только в 1947 году американская компания XEROX представила устройство, которое произвело настоящую революцию и облегчило жизнь офисных работников со всего мира. С того времени слово "xerox" из имени собственного превратилось в нарицательное. Именно так до сих пор называют все виды копировально-множительной техники.</p><br>
				<p>Процесс ксерографии непрерывно совершенствуется, ведь любой документ оценивается не только по содержанию, но и по внешнему виду. Грязная или недостаточно четкая печать, пятна, черные линии или дорожки вдоль листа - все это испортит впечатление даже от идеально составленного материала. При ксерокопировании важной документации не обойтись без хорошей копировальной техники. Если вас интересует, где сделать ксерокопию на оборудовании нового поколения, чтобы качество распечатки было сопоставимо с оригинальным документом, обращайтесь в "Копимастер".</p>
				<h2>Технологии копирования</h2><hr>
				<p>Мы выполняем копирование из автоподатчика и со стола сканера. Первая технология подходит для несшитых листов, вторая - для копирования разворотов книг, брошюр, паспорта, конспектов, изображений на плотной бумаге и картоне.</p><br>
				<p>"Копимастер" предлагает черно-белое и цветное копирование документов разного формата. Качественная бумага и современная аппаратура гарантируют высокое качество печати. Наше оборудование позволяет получить полноцветные копии паспорта, визы, иллюстраций, фотографий. </p><br>
				<p>В центре "Копимастер" можно сделать ксерокопию круглосуточно. Приезжайте к нам тогда, когда вам удобно.</p><br>
			</div>
		</div>
	</section>
    <br><br><br>


<br><br><br>
<div class="conatiner">
    <div class="row justify-content-center text-center " >
            <button class="btn btn-sm nav-btn btn-primary mb-4 mb-lg-0 bug1" id="priceshow" style="max-width:300px">Показать цены</button>
    </div>
</div>

    <br><br>
	<section class="price">
		<div class="row text-center justify-content-center">
			<div class="col-12 col-lg-6 col-xl-6 text-center justify-content-center">
				<div id="price" class="w1 con">
					<h2>Цены для физических лиц</h2><hr>
                    <div class="table-responsive"><!--Черно - белое копирование / печать А4 и А3-->
                        <?php include_once "price/FL/print/BW/fl_b-w_a4_a3.php"; ?>
                    </div>

                    <br>
                    <div class="table-responsive"><!--Черно - белое копирование / печать больших форматов-->
                        <?php include_once "price/FL/print/BW/fl_b-w_a0-a2.php"; ?>
                    </div>
                    <br>
                    <div class="table-responsive"><!--Цветное копирование/печать форматов А4 и А3*-->
                        <?php include_once "price/FL/print/CV/fl_c-v_a4_a3.php"; ?>
                    </div>
                    <br>
                    <div class="table-responsive"><!--Широкоформатная цветная печать и копирование-->
                        <?php include_once "price/FL/print/CV/fl_v-v_a0-a2.php"; ?>
                    </div>
				</div>
			</div>
		</div>
	</section>
	<?php
include_once 'footer.php';
 ?>
