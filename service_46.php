<?php
$keyw = "Копировальный центр «Копимастер»";
$titl = "Копировальный центр «Копимастер»";
$desc = "Копировальный центр «Копимастер» - Печать чертежей круглосуточно!";
include_once 'header.php';
?>

<section class="section">
    <div class="container text-center">
        <div class="w1 con">
            <h1>Печать постеров</h1>
            <p>Печать постеров в «Копимастере» имеет 2 основных преимущества: доступная цена и быстрое выполнение заказа. Поэтому, если вы ищете место, где можно заказать качественную продукцию, обращайтесь к нам!</p>
            <h2>Что мы предлагаем</h2>
            <p>Наш копировальный центр заботится о своих клиентах. Мы знаем, как часто вам не хватает времени на важные дела, не говоря уже про такие мелочи, как например печать постеров А3. Именно поэтому мы сделали так, чтобы на всю процедуру вы тратили минимум сил и времени. Обращайтесь к нам в любое время, мы работаем крулосуточно. Мы всегда рады вам помочь, выполнить свою работу на «отлично».</p>
            <p>О себе можем сказать, что успешно работаем на протяжении нескольких лет. Мы всегда учитываем требования, которые предъявляет печать постеров. Это позволяет нам получить изображения высокого качества. Использовать их вы можете для любых целей, в том числе и в качестве рекламного материала.
            </p>
            <p>Печать постеров А3 в нашем копировальном центре осуществляется на различных материалах. Пленка или плотная бумага прослужат вам на протяжении длительного времени и не потеряют привлекательного вида. Даже спустя недели они все так же будут привлекать к себе внимание и  рекламировать ваш товар.</p>
            <h2>Наши преимущества</h2>
            <img src="img/pechat_posterov_2.jpg" alt="печать постеров недорого" title="печать постеров недорого">
            <p>Копировальный центр «Копимастер» предоставляет 100% гарантию на печать постеров А1 и любых других форматов. Наши специалисты всегда действуют слаженно и оперативно, что позволяет вам получать необходимый продукт точно в срок. Мы не экономим на расходных материалах и тщательно подходим к выполнению каждого заказа, чтобы вы всегда получали все самое лучшее и продолжали выбирать «Копимастер». Приходите к нам, чтобы заказать печать постеров А1 или любую другую услугу из тех, которые мы вам предлагаем.</p>
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

