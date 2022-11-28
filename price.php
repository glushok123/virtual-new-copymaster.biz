<?php
$keyw="Цены на печать, печать недорого, копирование недорого, сканирование цена";
$titl="Цены на услуги копировального центра в Москве";
$desc="Цены на услуги печали и копирования в компании «Копимастер» - Печать афиш круглосуточно!";
include_once 'header.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
$db = getDbInstance();

$res = $db->query("SELECT * FROM `pricecalc`");

$price = [];

foreach ($res as $z){
    $price[$z["name"]] = $z["price"];
}

echo($price['petchat_chet_A4_0_odn']);
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
                <?php include_once "price/FL/print/CV/fl_v-v_a0-a2.php"; ?><!-- !!! Доделать синхронизацию !!! -->
            </div>

            <div class="table-responsive"><!--Переплетные работы-->
                <?php include_once "price/FL/fl_pereplet.php"; ?>
            </div>

        	<ul>
        		<li>Вставка одного конверта для CD диска: +<? echo $price['pereplet_vs_k'] ?> рублей к стоимости переплета</li>
        		<li>Вставка одного файла в переплет: +<? echo $price['pereplet_vs_f'] ?> рублей к стоимости переплета</li>
        		<li>Услуга переброшюровки твердого переплета и переплета на металлическую пружину: 50% от стоимости</li>
        		<li>Услуга переброшюровки переплета на пластиковую пружину: <? echo $price['pereplet_pl_per'] ?> рублей</li>
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
                <?php include_once "price/FL/fl_pet_vizitok.php"; ?> <!-- !!! Добавить синхронизацию !!! -->
            </div>

            <div class="table-responsive"><!--Ламинирование-->
                <?php include_once "price/FL/fl_laminirov.php"; ?>
            </div>

            <div class="table-responsive"><!--Накатка на пенокартон-->
                <?php include_once "price/FL/fl_penokarton.php"; ?> <!-- !!! Добавить синхронизацию !!! -->
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

</script>
