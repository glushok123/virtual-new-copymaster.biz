<?php
$keyw="Копировальный центр «Копимастер»";
$titl="Переплетные работы: профессиональные услуги в короткий срок";
$desc="Переплетные работы: профессиональные услуги в короткий срок";
include_once 'header.php';
 ?>

 <section class="section">
     <div class="container text-center">
         <div class="w1 con">
<h1>Переплетные работы: профессиональные услуги в короткий срок</h1>
    <img src="img/perepletnye_raboty3.jpg" alt="Переплетные работы" title="Переплетные работы">
    <p>Любое бумажное многостраничное издание, будь то монография, каталог, рукописная или печатная книга, нуждается в красивом оформлении, которое придаст ему аккуратный вид. Переплетные работы – это услуга, которая представляет собой обложку и ее соединение с блоком издания. Другое название этого процесса – брошюровка. В нашем центре можно заказать профессиональные переплетные работы в Москве по выгодным ценам.</p>
    <h2>Особенности переплетных работ</h2>
    <p>Процедура может выполняться различными способами, выбор которых зависит от желания клиента, размера и толщины блока. Существуют следующие виды переплета:</p>
    <ul>
        <li>Брошюровка на скрепку – метод, оптимальный для оформления изданий, содержащих до 48 полос;</li>
        <li>Термопереплет – способ, при котором обложка приклеивается к печатному блоку;</li>
        <li>Брошюровка на металлическую пружину – оптимальный вариант для блокнотов, календарей и ежедневников;</li>
        <li>Твердый переплет – вариант, подходящий для оформления печатных и рукописных книг и объемных каталогов. Покрытие обложки может быть глянцевым, матовым, тканевым, бумажным;</li>
        <li>Переплет металлическими кольцами – подходящий вариант для тетрадей, альбомов и изданий со сменными и пополняемыми блоками;</li>
        <li>Брошюровка на пластиковую пружину. Этот способ отличается сравнительной простотой и невысокой ценой, он доступен для оформления толстых и объемных монографий, брошюр и прочих видов печатной продукции. В отличие от брошюровки на металлическую пружину, этот способ используется в основном для подборки документации и подготовки материалов для общественных выступлений;</li>
        <li>Переплет с помощью болтов, которые могут быть сделаны из пластика или металла. Этот способ обходится дороже, чем оформление с помощью скобы или брошюровки на пластиковую пружину, но позволяет придать изданию неповторимый вид.</li>
    </ul>
    <h2>Как заказать услугу в переплетной мастерской?</h2>
    <p>Прежде чем оформить заказ на такую работу, стоит изучить рынок предложений, посмотреть адреса переплетных мастерских в Москве. Наш центр располагает современным оборудованием для брошюровки, и у нас работают специалисты, которые имеют солидный опыт. В переплетной мастерской вы сможете подобрать подходящий для себя способ оформления, ознакомиться с прайс-листом, посмотреть примеры уже готовых работ. Мы устанавливаем приемлемые цены и даем гарантию на результат, а также выполняем процедуру очень быстро. Поэтому если вы заинтересованы в качестве, обращайтесь в нашу переплетную мастерскую! Мы будем рады вам помочь.</p>
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
