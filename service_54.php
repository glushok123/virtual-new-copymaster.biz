<?php
$keyw = "Копировальный центр «Копимастер»";
$titl = "Копировальный центр «Копимастер»";
$desc = "Копировальный центр «Копимастер» - Печать чертежей круглосуточно!";
include_once 'header.php';
?>

<section class="section">
    <div class="container text-center">
        <div class="w1 con">
            <h1>Сканирование формата А2 в Москве. Цена в компании Копимастер</h1>
            <img src="img/skanirovanie_a2.jpg" alt="Отсканировать а2" title="Отсканировать а2">
            <p>Копировальный центр Копимастер предлагает воспользоваться услугой сканирования А2 в Москве. Цена более чем приемлемая – от 15 рублей за экземпляр в черно-белом исполнении. На большие объемы, от тысячи штук, мы готовы предложить дополнительную скидку. Сканирование а2 выполняется в нашем копицентре круглосуточно и без выходных. Небольшие объемы работы выполняем сразу, в вашем присутствии. Запись информации на любой удобный вам носитель информации. Заказать сканирование формата а2 можно либо в цвете, либо в черно-белом варианте. Естественно, мы готовы отсканировать не только такой формат ваших материалов – у нас достаточно возможностей по оцифровке и более размерных исходников. Мы справимся и с конструкторской, и с архитектурной, и с проектной документацией. Если нужно, готовы сразу же распечатать копии ваших материалов, выполнить фальцовку и переплет. Обращайтесь!
            </p>
        </div>
    </div>
</div></section><br><br><section class="price">
<div class="row text-center justify-content-center">
    <div class="col-12 col-lg-6 col-xl-6 text-center justify-content-center">
        <div
            class="table-responsive">
            <!--Черно - белое копирование / печать А4 и А3-->
            <?php include_once "price/FL/print/BW/fl_b-w_a4_a3.php"; ?>
        </div>

        <div
            class="table-responsive">
            <!--Черно - белое копирование / печать больших форматов-->
            <?php include_once "price/FL/print/BW/fl_b-w_a0-a2.php"; ?>
        </div>

        <div
            class="table-responsive">
            <!--Цветное копирование/печать форматов А4 и А3*-->
            <?php include_once "price/FL/print/CV/fl_c-v_a4_a3.php"; ?>
        </div>

        <div
            class="table-responsive">
            <!--Широкоформатная цветная печать и копирование-->
            <?php include_once "price/FL/print/CV/fl_v-v_a0-a2.php"; ?>
        </div>

        <div
            class="table-responsive">
            <!--Переплетные работы-->
            <?php include_once "price/FL/fl_pereplet.php"; ?>
        </div>
    </div>
</div></section><?php
include_once 'footer.php';
?>

