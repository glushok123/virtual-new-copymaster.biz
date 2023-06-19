<?php
$keyw = "Копировальный центр «Копимастер»";
$titl = "Распечатать А1 в Москве.";
$desc = "Распечатать А1 в Москве.";
include_once 'header.php';
?>

<section class="section">
    <div class="container text-center">
        <div class="w1 con">
            <h1>Распечатать А1 в Москве.</h1>
            <img src="img/raspechatat_a1_1.jpg" title="Распечатать а1" alt="Распечатать а1">
            <p>На сегодняшний день, без широкоформатной печати просто не обойтись. Ведь на компьютере намного легче и быстрее начертить то, что вручную можно выполнять несколько дней. Но для того, что бы распечатать формат а1 необходимо специальное оборудование, которое имеется в копицентрах. Но и это еще не является залогом успеха, ведь для того, чтобы распечатать чертеж а1 в хорошем качестве нужно найти место, где печатное оборудование является профессиональным.</p>
            <h2>Распечатка чертежей формата А1</h2>
            <p>Копировальный центр Копимастер знает, где распечатать а1 в Москве недорого, оперативно и профессионально. Если вы хотите обзавестись по-настоящему качественными чертежами, тогда приглашаем посетить один из самых лучших печатных центров города Москвы. Благодаря круглосуточному графику работы, мы выполним печать в любое удобное для вас время и по доступной цене. Распечатать а1 можно в различных интерпретациях:</p>
            <ul>
                <li>плакаты и постеры;</li>
                <li>чертежи, лекала, схемы и диаграммы;</li>
                <li>огромные фотки и изображения.</li>
            </ul>
            <p>Печатная продукция отдается заказчику, как в цветном, так и в черно-белом варианте, все зависит от желания и потребности клиента.</p>
            <img src="img/raspechatat_a1_2.jpg" title="распечатать формат а1" alt="распечатать формат а1">
            <p>Копировальный центр Копимастер наиболее подходящее место для проектировщиков и архитекторов, которым постоянно приходится распечатывать большое количество изображений и чертежей. Удобное месторасположение, около станции метро Октябрьская кольцевая, позволяет без проблем добраться к нам. К тому же, для постоянных клиентов и студентов существует программа лояльности и скидок, которые помогают значительно сэкономить растраты на печать. Приходите в копицентр Копимастер - мы рады каждому клиенту!</p>
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

