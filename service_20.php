<?php
$keyw = "Копировальный центр «Копимастер»";
$titl = "Как заказать печать постеров на холсте?";
$desc = "Как заказать печать постеров на холсте?";
include_once 'header.php';
?>

<section class="section">
    <div class="container text-center">
        <div class="w1 con">
            <h1>Как заказать печать постеров на холсте?</h1>
            <img src="img/raspechatat_poster_1.jpg" alt="печать постеров на холсте" title="печать постеров на холсте">
            <p>Сегодня стало модным украшение помещений постерами. И многие задаются вопросом: «Как заказать печать на холсте?». Наш центр струйной широкоформатной печати Копимастер, как раз и специализируется на оказании таких услуг. У нас, кстати, печать постеров на холсте всегда выполняют оперативно и недорого. Мы делаем распечатку с почты, с флешки или диска клиента. Но также, Вы всегда можете воспользоваться готовой базой наших изображений и распечатать постер из тематики, представленной у нас на сайте.</p>
            <p>Что же такое постеры и какова их актуальность? Постер – это изображение, которое оформляется в художественном стиле и используется в целях декорирования. Уже весь мир применяет их, чтобы подчеркнуть назначение помещения и преобразить его. Пожалуй, такой элемент является самым универсальным.</p>
            <img src="img/raspechatat_poster_2.jpg" alt="распечатать постер" title="распечатать постер">
            <p>Естественно, нельзя сравнивать печать постера на холсте с оригиналом какой-то известной картины. Однако среди арт-товаров современного рынка постер прочно утвердился, благодаря непритязательности и демократичности. Сегодня оформление интерьеров подлинными работами художников с мировым именем уже не модно. Кроме того, любая картина потребует должного освещения, влажности воздуха в помещении, определенного ухода, что сложно обеспечить в современном жилье. Поэтому проще заказать печать на холсте и оформить современный интерьер высококачественными копиями, которые станут показателем мастерства самого оформителя.</p>
        </div>
    </div>
</section>

<br><br>

<section class="price">
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
    </div>
</section>
<?php
include_once 'footer.php';
?>

