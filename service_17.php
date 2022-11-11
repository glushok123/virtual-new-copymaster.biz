<?php
$keyw="Копировальный центр «Копимастер»";
$titl="Копирование чертежей";
$desc="Копирование чертежей";
include_once 'header.php';
 ?>

 <section class="section">
     <div class="container text-center">
         <div class="w1 con">
             <h1>Копирование чертежей</h1>
             <img src="img/kopirovanie_chertezhey_1.jpg" title="Копирование чертежей" alt="Копирование чертежей">
             <p>Во многих научно-исследовательских и машиностроительных отраслях используются чертежи. Иногда требуется сделать их копии в нескольких экземплярах. Также копирование чертежей А0, А1, А2 может потребоваться в рамках работы с дизайн-проектом, студентам, которым предстоит защита курсовой или дипломной работы. Копировальный центр «Копимастер» выполняет копирование чертежей А0, А1, А2 используя профессиональную технику и бумагу высокой плотности.</p>
             <h3>Особенности процесса</h3>
             <p>Согласно ГОСТ, чертежи различных форматов имеют следующие размеры:</p>
             <ul>
                 <li>А0 – 841х1189 мм. </li>
                 <li>А1 – 594х841мм </li>
                 <li>А2 – 420х594 мм.</li>
                 <li>А3 – 297х420 мм.</li>
             </ul>
             <p>Как правило, копирование чертежей А0 и других форматов осуществляется с использованием бумаги плотностью 80 г, используя как цифровую печать, так и струйную. Стоимость зависит от количества копий и формата документов.</p>
             <h3>Почему стоит обратиться в копировальный центр «Копимастер»?</h3>
             <p>Если вам необходимо копирование чертежей А1, обращайтесь к нам. Наши достоинства:</p>
             <ul>
                 <li>У нас установлено оборудование, которое позволяет получить максимально яркое, четкое изображение. При создании копий чертежей сохранится цветовая гамма, каждый элемент будет точным и контрастным.</li>
                 <li>Мы используем хорошую бумагу высокой плотности, которая отличается повышенной износостойкостью и долговечностью. Полученные копии можно сворачивать в рулон, при необходимости вносить ручные пометки на бумагу.</li>
                 <li>При заказе на  копирование чертежей, цена может быть ниже, в зависимости от объема.</li>
             </ul>
             <p>Мы работаем круглосуточно, что очень удобно для тех, чей график распланирован до минуты, и нет возможности уйти раньше с работы или учебы, чтобы посетить копировальный центр. Вы можете оставить заявку на копирование чертежей - просто позвоните нам или напишите на электронную почту прямо сейчас!</p>
          </div>
     </div>
 </section>

 <br><br>

<section class="price">
     <div class="row text-center justify-content-center">
         <div class="col-12 col-lg-6 col-xl-6 text-center justify-content-center" >
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

             <div class="table-responsive"><!--Переплетные работы-->
                 <?php include_once "price/FL/fl_pereplet.php"; ?>
             </div>
         </div>
     </div>
</section>
<?php
 include_once 'footer.php';
 ?>
