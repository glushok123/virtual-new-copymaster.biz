<?php
$keyw = "центр цифровой печати, цифровая печать недорого, оперативная цифровая печать";
$titl = "Центр цифровой печати Копимастер – оперативно и недорого!";
$desc = "Центр цифровой печати Копимастер предлагает оперативную и недорогую цифровую печать и цветное копирование документов. Мы печатаем, копируем и сканируем круглосуточно! Любые форматы: от А5 до А3+";
include_once 'header.php';
?>

<section class="section">
    <div class="container text-center">
        <h1>Центр оперативной цифровой печати Копимастер. Недорого!</h1><hr>
        <div class="row row justify-content-center">
            <div class="col-12 col-lg-6 col-xl-6">
                <img src="img/centr_cifrovoy_pechati_1.jpg" alt="центр цифровой печати" title="центр цифровой печати">
            </div>
            <div class="col-12 col-lg-6 col-xl-6">
                <p>Думаете недорогая цифровая печать – это не реально? Мы Вас сейчас убедим в обратном. Помимо всех видов полиграфической и рекламной продукции, необходимой для функционирования бизнеса, наш центр цифровой печати реализует полный автономный цикл от идей наших дизайнеров и верстки макетов полиграфии до конечного отпечатка готовой продукции. Каковы же преимущества центра цифровой печати Копимастер:</p><br>
                <ul>
                    <li>сроки исполнения заказов минимальны. Можем напечатать в вашем присутствии, а можем ночью – у нас круглосуточный режим обслуживания;</li>
                    <li>у нас можно заказать цифровую печать а3 или а4 недорого;</li>
                    <li>любой тираж от 1 экземпляра на цифровой машине до 1 000 000 копий на офсете;</li>
                    <li>ну а качество отпечатков нашей Konica Minolta без комментариев - вам не найти лучше.</li>
                </ul>
            </div>
        </div>
        <h2>Цветная цифровая печать форматов А4 и А3</h2><hr>
        <div class="row row justify-content-center">
            <div class="col-12 col-lg-6 col-xl-6">
                <img src="img/centr_cifrovoy_pechati_2.jpg" alt="цифровая печать А4" title="цифровая печать А4">
            </div>
            <div class="col-12 col-lg-6 col-xl-6">
                <p>Наиболее распространённый вариант для отпечатков - это оперативная цифровая печать. Этот вид печатной продукции совмещает в себе обширные возможности для информирования клиентов в удобных размерах, которые реализуются как раздаточный материал, в виде буклетов, листовок или флаеров. А наша технология изготовления существенно снизит стоимость отпечатка, поэтому издание даже малых тиражей возможно дешево. Полноцветная цифровая печать, оперативно заказанная в нашем центре, позволит придать каждой копии высокую ценность не только в эстетическом, но и в информационном аспекте. Великолепно отпечатанный цветовой спектр, чёткие контуры изображений и недорогая цена на отпечаток - позволят создать универсально воспринимающийся материал, для всех категорий потребителей, способный гарантировать нужный эффект.</p><br>

            </div>
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

            </div>
        </div>
    </div>
</section>
<?php
include_once 'footer.php';
?>

