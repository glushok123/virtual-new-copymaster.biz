<?php
$keyw = "Копировальный центр «Копимастер»";
$titl = "У нас можно сделать срочный переплет листов формата А4";
$desc = "У нас можно сделать срочный переплет листов формата А4";
include_once 'header.php';
?>

<section class="section">
    <div class="container text-center">
        <div class="w1 con">
            <h1>У нас можно сделать срочный переплет листов формата А4</h1>
            <img src="img/gde_sdelat_srochnyi_pereplet.jpg" alt="сделать срочный переплет" title="сделать срочный переплет">
            <p>Вы задались вопросом где сделать переплет листов а4? Переплетная мастерская компании Копимастер готова помочь реализовать разнообразные варианты брошюровки и переплетных работ. Более того, если вам потребовался срочный переплет, то вам тем более нужно приехать именно к нам. Сделать переплет материалов в нашем центре можно буквально за 10-15 минут, а учитывая наш круглосуточный режим работы, можно смело утверждать, что переплет а4 будет выполнен действительно срочно. Кстати у нас нет никакой доплаты за скорость.</p>
            <p>Мы предлагаем прошивку документации с помощью пластиковой или металлической пружины. Обложка включена в стоимость и выполняется из прозрачного пластикового материала. Задняя подложка делается из твердого текстурного картона, подбираемого под цвет пружины. В результате вы получаете прочную защиту для страниц и приятный внешний вид вашего документа. Пластиковый переплет листов выполняется достаточно быстро, приемлем для прошивки студенческих работ, деловой документации, брошюр, каталогов и т.п. Возможно и выполнение срочного переплета для первичной сдачи документа на проверку.</p>
            <p>Для страниц, которые должны полностью открываться, более применима металлическая пружина. При этом обложка и подложка будут выглядеть так же, как и в пластиковом варианте. Технологию переплета материалов выбирают в зависимости от его назначения и количества бумаги, так как не все способы позволяют прошить большую толщину. Например, на скобу можно «посадить» не более 50-ти страниц. Пластиковая пружина позволяет прошить до 5-ти сантиметров толщины. Еще сброшюровать листы можно с помощью твердой обложки. Приезжайте, Вы ведь теперь знаете где и как сделать переплет даже ночью.</p>
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

