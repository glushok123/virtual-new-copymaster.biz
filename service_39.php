<?php
$keyw = "Копировальный центр «Копимастер»";
$titl = "Отсканировать А1";
$desc = "Отсканировать А1";
include_once 'header.php';
?>

<section class="section">
    <div class="container text-center">
        <div class="w1 con">
            <h1>Отсканировать А1</h1>
            <img src="img/otskanirovat_a1_2.jpg" alt="Отсканировать а1" title="Отсканировать а1">
            <p>Возможно, еще несколько минут назад вы вводили в поиск: отсканировать A1 в Москве адреса. И вот вы попали на сайт нашего копировального центра. Сразу скажем, что вы сделали правильный выбор, и причин для этого несколько:</p>
            <ul>
                <li>Мы работаем каждый день, 24 часа в сутки.</li>
                <li>У нас доступные цены и «прозрачные» расчеты.</li>
                <li>В центре работают только опытные менеджеры.</li>
                <li>Мы всегда внимательно относимся к клиентам.</li>
                <li>Выполняем сканирование любой сложности за минимальное время.</li>
            </ul>
            <p>В копировальном центре «Копимастер» вы можете заказать сканирование схем и чертежей, плакатов и фотографий, различных документов. Работа будет выполнена на современном оборудовании, которое позволит получить итоговый скан в максимальном качестве.
            </p>
            <h2>Выгодные условия обращения</h2>
            <p>Мы предлагаем вам цветное и черно-белое сканирование A1. В работу принимаются различные носители, практически в любом состоянии. Вы можете прийти к нам с редкими чертежами, изображением на плоской поверхности и другими необычными оригиналами. В каждом из случаев наши сотрудники подберут для вас подходящее решение, предложат отсканировать A1 на выгодных условиях. Они же расскажут вам про действующие акции и скидки.
            </p>
            <h2>Профессиональный подход</h2>
            <p>Все работы, в том числе сканирование A1, мы выполняем в максимально короткие сроки. Знаем все тонкости и готовы прийти вам на помощь, если это необходимо. После того как мы выполнили сканирование A1 и других документов, готовые файлы мы записываем на диск, флешку или отправляем на вашу электронную почту. Просто скажите нам, что вы хотите получить в итоге, и мы посоветуем подходящие вам услуги.
            </p>
            <p>В нашем копировальном центре «Копимастер» вы можете как отсканировать A1, так и сделать копии данного документа. Ознакомьтесь с нашими ценами в подробных таблицах. В них наглядно указана стоимость одного экземпляра при тех или иных параметрах. Минимальное количество заказа — 1 штука. Максимального не существует. Мы готовы взять в работу более 1000 экземпляров. Стоимость заказа в этом случае будет рассчитана в индивидуальном порядке.
            </p>
            <p>Приходите к нам, чтобы получить качественную работу и доброжелательное отношение. Наши менеджеры не просто выполнят работу, а подберут для вас наиболее подходящее решение. Уверены, вы останетесь довольны и придете к нам снова.</p>
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

