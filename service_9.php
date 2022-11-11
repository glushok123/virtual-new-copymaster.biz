<?php
$keyw="дешевая цветная печать, печать а3 цветная, печать на цветном принтере, цветная печать, цветная печать а3, цветная печать дешево";
$titl="Цветная печать плакатов документов формата А3 в Москве в копировальном центре Копимастер";
$desc="Копировальный центр «Копимастер» - Печать чертежей круглосуточно!";
include_once 'header.php';
 ?>

	<section class="section">
		<div class="container text-center">
            	<h1> Цветная печать документов формата А3</h1><hr>
            <div class="row row justify-content-center">
                <div class="col-12 col-lg-6 col-xl-6">
                    <img src="img/cvetnaya_pechat_1.jpg" alt="цветная печать" title="цветная печать">
                </div>
                <div class="col-12 col-lg-6 col-xl-6">
                    <p>Современное оборудование для цветной печати позволяет центру "Копимастер" справляться с заказами разного уровня сложности. Вы можете обратиться к нам, чтобы распечатать документ на листах А3. Площадь листа такого формата составляет 12.5 дм (ширина 297 мм). Его используют для подготовки бумажных документов делового, художественного и информационного характера:</p><br>
                    <ul>
                        <li>стенгазеты;</li>
                        <li>постеры и плакаты;</li>
                        <li>таблицы и схемы; </li>
                        <li>диаграммы и иллюстрации;</li>
                        <li>чертежи.</li>
                    </ul>
                </div>
            </div>
			<div class="w1 con">


				<p>Нами выполняется печать А3 цветная и черно-белая. Цена одной распечатки зависит от тиража. У нас нет надбавок за срочность! С расценками на услуги можно ознакомиться на страницах сайта и самостоятельно рассчитать стоимость своего заказа.</p><br>
				<h2>Применение формата А3</h2><hr>
				<p>Печать на цветном принтере на листах большого формата востребована в рекламной и других отраслях. Материалы используются для создания схем и чертежей, печати текстовых документов и рекламных материалов. Именно на такой бумаге размещают схемы зданий и сооружений, планы эвакуации при пожаре, схемы передвижения по территории и т. п.</p><br>
				<p>Что касается рекламы, маркетологи во многих случаях советуют отдавать предпочтение формату А3. Полиграфические материалы увеличенного размера гораздо быстрее привлекают внимание потенциальных клиентов, чем изделия небольшого формата, что делает рекламу более заметной и запоминающейся. Большой размер буклета позволяет разместить больше полезной информации. Чтобы изделие не выглядело громоздким, его складывают пополам, втрое или вчетверо. На плакате большого размера можно сделать специальный кармашек, куда можно поместить вкладыш, визитку или приглашение на презентацию.</p><br>
				<h2>Виды печатных материалов</h2><hr>
				<p>Бумага для печати отличается по техническим характеристикам. Она бывает мелованной и немелованной, глянцевой и матовой. Немелованные материалы выпускаются без покрытия. Они имеют слегка грубоватую фактуру и высокую впитываемость. Такую бумагу применяют для черно-белой печати газет, конструкторских планов. Это самый дешевый вид печатных материалов.</p><br>
				<p>Дешевая цветная печать выполняется на мелованной бумаге, которая имеет матовое или глянцевое покрытие. Для его создания поверхность покрывают специальным составом в один или несколько слоев. Это повышает прочностные и декоративные свойства материала. Для распечатки инженерной документации, рекламной продукции обычно используют матированные листы. Этот материал универсален. Изображение на нем выглядит четким, так как низкопористая структура препятствует расплыванию чернил.</p><br>
				<p>Яркие и контрастные изображения с высокой детализацией печатаются на глянце. В данную категории полиграфии входят плакаты, постеры, афиши, календари, журналы, таблицы с полноцветной графикой. Глянец обеспечивает естественное воспроизведение цветов, придает изделию выразительный блеск.</p><br>
				<p>Мы не экономим на качестве материала! Цветная печать дешево стоит в первую очередь благодаря ценовой политике центра "Копимастер". Мы стремимся предложить заказчикам оптимальные расценки на все виды полиграфических услуг.</p><br>
			</div>
		</div>
	</section>
    <br><br><br>

<div class="conatiner">
    <div class="row justify-content-center text-center">
        <div class="wrap">
            <button class="buttonpuls">Сделать заказ</button>
        </div>
    </div>
</div>
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

                    <div class="table-responsive"><!--Черно - белое копирование / печать больших форматов-->
                        <?php include_once "price/FL/print/BW/fl_b-w_a0-a2.php"; ?>
                    </div>

                    <div class="table-responsive"><!--Цветное копирование/печать форматов А4 и А3*-->
                        <?php include_once "price/FL/print/CV/fl_c-v_a4_a3.php"; ?>
                    </div>

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
