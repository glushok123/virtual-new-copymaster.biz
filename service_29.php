<?php
$keyw="Копировальный центр «Копимастер»";
$titl="Нужна печать формата а1? Посмотрите наши цены!";
$desc="Нужна печать формата а1? Посмотрите наши цены!";
include_once 'header.php';
 ?>

 <section class="section">
     <div class="container text-center">
         <div class="w1 con">
    <h1>Нужна печать формата а1? Посмотрите наши цены!</h1>
    <img src="img/pechat_a1-1.jpg" alt="Печать а1" title="Печать а1">
    <p>Один из основных видов услуг предоставляемых нашей компанией  - это цветная и черно-белая печать а1, цена на которую в нашем копировальном салоне намного ниже, чем в других копировальных центрах.  Черно-белая печать формата а1 стоит от 30 рублей за экземпляр – и мы, в отличие от конкурентов, уже включили в эту цену стоимость вывода файла на печать и прочие сопутствующие услуги. А если Вам потребовалось выполнить распечатку в очень больших объемах (от 1000 листов) - мы готовы отдельно оговорить, во сколько это обойдется Вам или вашей компании. Не нужно больше искать, где делают печать формата а1 в Москве – обращайтесь сразу к нам, в профессиональный копировальный центр Копимастер. Более подробно ознакомиться с ценами на цветную и черно-белую печать можно на главной странице в разделе с ценами.</p>
    <img src="img/pechat_a1-2.jpg" alt="печать а1 в Москве" title="печать а1 в Москве">
    <p>Кстати, в разное время и в разных странах были приняты в качестве стандартов различные форматы. Сейчас доминируют две системы: североамериканская система форматов и более привычный нам, международный стандарт (A4, А3, А2 и так далее).</p>
    <p>Международная система бумажных форматов, основана на метрической системе мер и берет свое начало от бумажного листа, площадью в 1 квадратный метр. Данный стандарт используется сейчас всеми странами, кроме США и Канады. Соответственно А1 – это половина квадратного метра и самый распространенный формат из стандартов ISO.</p>
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
