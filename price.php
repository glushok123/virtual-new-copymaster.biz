<?php
$keyw="Цены на печать, печать недорого, копирование недорого, сканирование цена";
$titl="Цены на услуги копировального центра в Москве";
$desc="Цены на услуги печали и копирования в компании «Копимастер» - Печать афиш круглосуточно!";
include_once 'header.php';
 ?>
<section>
  <div class="container">
    <div class="row text-center">
      <br>
      <div class="col">
          <br>
        <a href="#fiz" class="btn btn-sm nav-btn btn-primary mb-4 mb-lg-0 ms-auto bug1">Цены для физических лиц</a>
      </div>
      <div class="col">
          <br>
        <a href="#ur-price" class="btn btn-sm nav-btn btn-primary mb-4 mb-lg-0 ms-auto bug1">Цены для юридических лиц</a>
      </div>

    </div>

  </div>
    <div id="fiz" class="container">
        <br><br>
        <div  class="text-center">
            <h2>Цены для физических лиц</h2>
            <hr>
        </div>


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

        	<ul>
        		<li>Вставка одного конверта для CD диска: +79.2 рублей к стоимости переплета</li>
        		<li>Вставка одного файла в переплет: +122 рублей к стоимости переплета</li>
        		<li>Услуга переброшюровки твердого переплета и переплета на металлическую пружину: 50% от стоимости</li>
        		<li>Услуга переброшюровки переплета на пластиковую пружину: 122 рублей</li>
        	</ul>

            <div class="table-responsive"><!--Сканирование*-->
                <?php include_once "price/FL/fl_scan.php"; ?>
            </div>

            <div class="table-responsive"><!--Услуги дизайнера-->
                <?php include_once "price/FL/fl_dizain.php"; ?>
            </div>

            <div class="table-responsive"><!--Изготовление печатей и штампов-->
                <?php include_once "price/FL/fl_pet_and_htamp.php"; ?>
            </div>

            <div class="table-responsive"><!--Печать визиток 90*50 мм-->
                <?php include_once "price/FL/fl_pet_vizitok.php"; ?>
            </div>

            <div class="table-responsive"><!--Ламинирование-->
                <?php include_once "price/FL/fl_laminirov.php"; ?>
            </div>

            <div class="table-responsive"><!--Накатка на пенокартон-->
                <?php include_once "price/FL/fl_penokarton.php"; ?>
            </div>

            <div class="table-responsive"><!--Дополнительные операции-->
                <?php include_once "price/FL/fl_dop_oper.php"; ?>
            </div>

            <div class="table-responsive"><!--Дополнительные материалы-->
                <?php include_once "price/FL/fl_dop_mater.php"; ?>
            </div>

        <div id="ur-price" class="text-center">
            <br>  <br>
            	<h2 >Цены для юридических лиц</h2><hr>
        </div>

            <div class="table-responsive"><!--Черно - белое копирование* / печать-->
                <?php include_once "price/YL/yl_bw.php"; ?>
            </div>

            <div class="table-responsive"><!--Цветное копирование/печать форматов А4 и А3*-->
                <?php include_once "price/YL/yl_cv.php"; ?>
            </div>

            <div class="table-responsive"><!--Широкоформатная цветная печать и копирование*-->
                <?php include_once "price/YL/yl_pet_a0-a2.php"; ?>
            </div>

            <div class="table-responsive"><!--Переплетные работы-->
                <?php include_once "price/YL/yl_pereplet.php"; ?>
            </div>

            <div class="table-responsive"><!--Цветное/Черно-белое cканирование*-->
                <?php include_once "price/YL/yl_scan.php"; ?>
            </div>

        	<p>Указанные цены действительны при заключении договора на обслуживание и единовременном заказе от 30000 рублей. Подробную консультацию о скидках можно получить у нашего менеджера.</p>

    </div>
</section>

 <?php
 include_once 'footer.php';
  ?>
<script src="dashbord/assets/plugins/edittable/bstable.js"></script>
<script type="text/javascript">
/*
     var example1 = new BSTable("table_1");
     example1.init();
     var example2 = new BSTable("table_2");
     example2.init();
     var example3 = new BSTable("table_3");
     example3.init();
     var example4 = new BSTable("table_4");
     example4.init();
     var example5 = new BSTable("table_5");
     example5.init();
     var example6 = new BSTable("table_6");
     example6.init();
     var example7 = new BSTable("table_7");
     example7.init();
     var example8 = new BSTable("table_8");
     example8.init();
     var example9 = new BSTable("table_9");
     example9.init();
     var example10 = new BSTable("table_10");
     example10.init();
     var example11 = new BSTable("table_11");
     example11.init();
     var example12 = new BSTable("table_12");
     example12.init();
     var example13 = new BSTable("table_13");
     example13.init();
     var example14 = new BSTable("table_14");
     example14.init();
     var example15 = new BSTable("table_15");
     example15.init();
     var example16 = new BSTable("table_16");
     example16.init();
     var example17 = new BSTable("table_17");
     example17.init();
     var example18 = new BSTable("table_18");
     example18.init();
*/
</script>
