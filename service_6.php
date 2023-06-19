<?php
$keyw = "сканирование документов, сканирование документов в Москве, услуги по сканированию документов, услуги сканированияа";
$titl = "Выполняем сканирование документов в Москве";
$desc = "Заказать в Москве сканирование документов в цветном или черно-белом варианте может каждый желающий. Подобные услуги предоставляет профессиональный копировальный центр ";
include_once 'header.php';
?>
<input type="text" style='display:none' id='vid-order' value="сканирование документов">

<section class="section">
    <div class="container text-center">
        <h1>Как заказать сканирование документов в Москве</h1><hr>
        <div class="row row justify-content-center">
            <div class="col-12 col-lg-6 col-xl-6">
                <img src="img/skanironanie_dokumentov_1.jpg" alt="Сканирование документов" title="Сканирование документов">
            </div>
            <div class="col-12 col-lg-6 col-xl-6">
                <p>Сканирование документов – это услуга оцифровки бумажных/пластиковых образцов документации, в ходе которой создается их электронная копия. Она может быть перенесена на съемный носитель клиента или отправлена ему по электронной почте. Полученный подобным образом скан можно использовать как для онлайн-подачи документов (например, на визу), так и для последующего тиражирования по необходимости.</p><br>
                <p>Профессиональный копировальный центр "Копимастер" предлагает жителям Москвы и гостям столицы услуги по сканированию документов. Мы принимаем в работу документацию любого формата, объема и размера. Чаще всего нам заказывают скан подтверждений личности (паспорта, удостоверения), дипломов, апостилей, справок, свидетельств, грамот, медицинских карт и т.п. Иногда в "Копимастер" приносят на сканирование старые фотографии, личную переписку, документальные архивы семьи, целые книги.</p><br>
            </div>
        </div>
        <h2>Преимущества заказа сканирования в "Копимастере"</h2><hr>
        <div class="row row justify-content-center">
            <div class="col-12 col-lg-6 col-xl-6">
                <img src="img/skanironanie_dokumentov_2.jpg" alt="сканирование документов в Москве" title="сканирование документов в Москве">
            </div>
            <div class="col-12 col-lg-6 col-xl-6">
                <ul>
                    <li>Выполняя сканирование документов в Москве, мы используем только лучшее оборудование: цифровые сканеры высокой точности, позволяющие создавать электронные копии бумаг любых размеров: от самых небольших (пластиковый паспорт, студенческий, ID-карта) до масштабных (проект архитектурного сооружения).</li>
                    <li>Отдать на оцифровку можно как новые, пластиковые или ламинированные версии документов, так и старые бумажные. Наши сотрудники в любом случае обеспечат бережное отношение к документам и вернут их владельцу в целости и сохранности.</li>
                    <li>Выполняемое нами сканирование может быть как цветным, так и черно-белым (по желанию клиента). На стоимость услуги цвет скана никак не влияет.</li>
                    <li>Помимо собственно оцифровки документации (сохранение документа в виде картинки на компьютере), мы также можем выполнить распознавание текста, чтобы была возможность копирования информации из электронной копии, ее редактирования.</li>
                </ul>
            </div>
        </div>
        <div class="w1 con">
            <h2>Расценки на услуги сканирования</h2><hr>
            <p>Прайс-лист сканирования документов представлен на нашем сайте. Все расценки фиксированные. Самая низкая цена – на скан листов А4, самая высокая – на скан листов А0. Клиентам, заказывающим большой объем работ (от 10 листов), предполагаются скидки. Минимальная стоимость за каждую страницу сканирования предлагается при заказе от 500 единиц.</p><br>
            <p>В случае, если на оцифровку передаются специфические документы форматов A3 и A4, требующие ручного сканирования, клиенту предстоит дополнительно заплатить 50% стоимости за каждый лист с такой обработкой.
            </p><br>
        </div>
    </div>
</section>
<br><br><br>

<div class="conatiner">
    <div class="row justify-content-center text-center">
        <div class="wrap">
            <button class="buttonpuls" data-bs-toggle="modal" data-bs-target="#sendOrderInfo">Сделать заказ</button>
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
                    <!--Сканирование*-->
                    <?php include_once "price/FL/fl_scan.php"; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include_once 'footer.php';
?>

