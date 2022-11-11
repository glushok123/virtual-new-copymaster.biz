<?
if ($_SERVER['REQUEST_URI'] !== "/contacts.html" && $_SERVER['REQUEST_URI'] !== "/" && $_SERVER['REQUEST_URI'] !== "/") {?>

<div id="price" class="w1 con">
        <?//var_dump($_SERVER['REQUEST_URI']);?>
        <?if ($fg != 999){?>
        <h2>Цены для физических лиц</h2>
        <?}?>
        <?
            if ($fg==1 || !($fg%5) || !($fg%7) || !($fg%11)) {include"i-price-print-bw.html";}
            if ($fg==1 || !($fg%5) || !($fg%7) || !($fg%11)) {include"i-price-print-color.html";}
            if ($fg==1 || !($fg%2)) {include"i-price-pereplet.html";}
            if ($fg==1 || !($fg%13)) {include"i-price-scan.html";}
            if ($fg==1 || !($fg%17)) {include"i-price-dizain.html";}
            if ($fg==1 || !($fg%3) && $fg != 999) {include"i-price-laminat.html";}
            if ($fg==1 || !($fg%17)) {include"i-price-nakatka.html";}
            if ($fg==1) {include"i-price-dopserv.html";}
            if ($fg==1) {include"i-price-dopmat.html";}
            if ($fg==1) {include"i-price-ur.html";}
        ?>
</div>
<?}?>

<div class="w1 foot">
<?

    if (!($fg%7) || !($fg%17) || !($fg%3) || !($fg%5) || !($fg%2)) {echo ' <a href="" class="a1" title="Копицентр Копимастер - главная страница">Копицентр</a> ';}
	if (!($fg%7) || !($fg%17)) {echo ' <a href="pechat_na_holste.html" class="a1" title="Печать на холсте, сроки стоимость">Печать на холсте</a> ';}
	if (!($fg%3)) {echo ' <a href="laminirovanie_a4_a3.html" class="a1" title="Ламинирование А3">Ламинирование А3</a> ';}
    if (!($fg%5)) {echo ' <a href="kopirovanie_chertezhey.html" class="a1" title="Копирование чертежей, цены сроки">Копирование чертежей</a> ';}
    if (!($fg%5)) {echo ' <a href="cvetnoe_skanirovanie_chertezhey.html" class="a1" title="Цветное сканирование чертежей">Цветное сканирование чертежей</a> ';}
	if (!($fg%5)) {echo ' <a href="cvetnaya_kserokopiya_a4_a3.html" class="a1" title="Цветная ксерокопия А4 и А3">Цветная ксерокопия форматов А4 и А3</a> ';}
	if (!($fg%11)) {echo ' <a href="raspechatat_poster_na_holste.html" class="a1" title="Распечатать постер на холсте в Москве">Распечатать постер на холсте</a> ';}
	if (!($fg%11)) {echo ' <a href="pechat_afish.html" class="a1" title="Печать афиш, цены сроки">Печать афиш</a> ';}
    if (!($fg%2)) {echo ' <a href="broshurovka-diploma.html" class="a1" title="Брошюровка диплома, цены">Брошюровка диплома</a> ';}
    if (!($fg%7)) {echo ' <a href="raspechatat_dokumenty_s_fleshki.html" class="a1" title="Распечатать документы с флешки в Москве">Распечатать документы с флешки</a> ';}
	if (!($fg%7)) {echo ' <a href="pechat_dokumentov.html" class="a1" title="Печать документов, цена">Печать документов</a> ';}
	if (!($fg%11)) {echo ' <a href="raspechatat_a1.html" class="a1" title="Распечатать А1 в Москве">Распечатать А1</a> ';}
    if (!($fg%11)) {echo ' <a href="interyernaja-pechat.html" class="a1" title="Интерьерная печать, цены">Интерьерная печать</a> ';}
	if (!($fg%11)) {echo ' <a href="pechat_portreta_na_holste.html" class="a1" title="Печать портрета на холсте">Печать портрета на холсте</a> ';}
	if (!($fg%3)) {echo ' <a href="zalaminirovat_dokument.html" class="a1" title="Заламинировать документ">Заламинировать документ</a> ';}
	if (!($fg%11)) {echo ' <a href="pechat_a1.html" class="a1" title="Печать А1 в Москве">Печать А1</a> ';}
	if (!($fg%17) || !($fg%11)) {echo ' <a href="faltsovka.html" class="a1" title="Фальцовка, цены">Фальцовка</a> ';}
    if (!($fg%2)) {echo ' <a href="perepletnye_raboty.html" class="a1" title="Переплетные работы и цены на них">Переплетные работы</a> ';}
    if (!($fg%2)) {echo ' <a href="broshurovka.html" class="a1" title="Брошюровка стоимость">Брошюровка</a> ';}
	if (!($fg%2)) {echo ' <a href="gde_sdelat_srochnyi_pereplet.html" class="a1" title="Сделать срочный переплет в Москве">Где сделать срочный переплет</a> ';}
	if (!($fg%7) || !($fg%11) ) {echo ' <a href="inzhenernaya_pechat_chertezhey.html" class="a1" title="Инженерная печать чертежей">Инженерная печать чертежей</a> ';}
	if (!($fg%3)) {echo ' <a href="laminaciya_dokumentov.html" class="a1" title="Ламинация документов">Ламинация документов</a> ';}
	if (!($fg%17)) {echo ' <a href="operativnaya_poligrafiya.html" class="a1" title="Оперативная полиграфия">Оперативная полиграфия</a> ';}
	if (!($fg%17)) {echo ' <a href="centr_cifrovoy_pechati.html" class="a1" title="Центр цифровой печати в Москве">Центр цифровой печати</a> ';}
	if (!($fg%11) || !($fg%13)) {echo ' <a href="otskanirovat_a1.html" class="a1" title="Отсканировать А1 недорого">Отсканировать А1</a> ';}
	if (!($fg%11)) {echo ' <a href="pechat_na_kalke.html" class="a1" title="Печать на кальке, цены">Печать на кальке</a> ';}
    if (!($fg%11)) {echo ' <a href="pechat_proektov.html" class="a1" title="Печать проектов цены в Москве">Печать проектов</a> ';}
	if (!($fg%11)) {echo ' <a href="pechat_chertezhey_a0.html" class="a1" title="Печать чертежей А0">Печать чертежей А0</a> ';}
	if (!($fg%11)) {echo ' <a href="pechat_chertezhey_a2.html" class="a1" title="Печать чертежей А2">Печать чертежей А2</a> ';}
    if (!($fg%17)) {echo ' <a href="nakatka_na_penokarton.html" class="a1" title="Накатка на пенокартон в Москве">Накатка на пенокартон</a> ';}
	if (!($fg%17)) {echo ' <a href="pechat_na_penokartone.html" class="a1" title="Печать на пенокартоне">Печать на пенокартоне</a> ';}
	if (!($fg%11)) {echo ' <a href="pechat_avtoreferatov.html" class="a1" title="Печать авторефератов в Москве">Печать авторефератов</a> ';}
	if (!($fg%11)) {echo ' <a href="pechat_posterov.html" class="a1" title="Печать постеров на холсте и глянце">Печать постеров</a> ';}
	if (!($fg%11)) {echo ' <a href="pechat_kartin_na_holste.html" class="a1" title="Печать картин на холсте">Печать картин на холсте</a> ';}
    if (!($fg%2)) {echo ' <a href="pereplet_dokumentov_cena.html" class="a1" title="Переплет документов, цены">Переплет документов</a> ';}
    if (!($fg%2)) {echo ' <a href="proshit-diplom.html" class="a1" title="Прошить диплом, цены">Прошить диплом</a> ';}
    if (!($fg%2)) {echo ' <a href="proshit-diplomnuyu-rabotu.html" class="a1" title="Прошить дипломную работу">Прошить дипломную работу</a> ';}
    if (!($fg%2)) {echo ' <a href="sshit-diplom.html" class="a1" title="Сшить диплом">Сшить диплом</a> ';}
	if (!($fg%2)) {echo ' <a href="sshit-diplomnuyu-rabotu.html" class="a1" title="Сшить дипломную работу">Сшить дипломную работу</a> ';}
	if (!($fg%11) || !($fg%13)) {echo ' <a href="skanirovanie_a0.html" class="a1" title="Сканирование А0">Сканирование А0</a> ';}
	if (!($fg%11) || !($fg%13)) {echo ' <a href="skanirovanie_a2.html" class="a1" title="Сканирование А2">Сканирование А2</a> ';}
	if (!($fg%11) || !($fg%13)) {echo ' <a href="skanirovanie_a1.html" class="a1" title="Сканирование А1">Сканирование А1</a> ';}
	if (!($fg%13)) {echo ' <a href="skanirovanie_dokumentov_cena.html" class="a1" title="Сканирование документов, цен">Сканирование документов, цена</a> ';}
	if (!($fg%13)) {echo ' <a href="skanirovanie_fotografiy.html" class="a1" title="Сканирование фотографий">Сканирование фотографий</a> ';}
	if (!($fg%13)) {echo ' <a href="skanirovanie_a3.html" class="a1" title="Сканирование А3">Сканирование А3</a> ';}
	if (!($fg%17)) {echo ' <a href="pechati.html" class="a1" title="Печати изготовление">Печати</a> ';}
	if (!($fg%17)) {echo ' <a href="pechatnyy_centr.html" class="a1" title="Печатный центр">Печатный центр</a> ';}
	if (!($fg%11)) {echo ' <a href="raspechatat_plakat.html" class="a1" title="Распечатать плакат">Распечатать плакат</a> ';}
    if (!($fg%13) || !($fg%17)) {echo ' <a href="ocifrovka_knig_i_teksta.html" class="a1" title="Оцифровка книг и текста">Оцифровка книг и текста</a> ';}
	if (!($fg%13) || !($fg%17)) {echo ' <a href="ocifrovka_foto.html" class="a1" title="Оцифровка фото">Оцифровка фото</a> ';}
	if (!($fg%13) || !($fg%17)) {echo ' <a href="ocifrovka_dokumentov.html" class="a1" title="Оцифровка документов">Оцифровка документов</a> ';}
	if (!($fg%13) || !($fg%17)) {echo ' <a href="ocifrovka_chertezhey_i_proektov.html" class="a1" title="Оцифровка чертежей и проектов">Оцифровка чертежей и проектов</a> ';}
	if (!($fg%7) || !($fg%17)) {echo ' <a href="srochnaya_pechat.html" class="a1" title="Срочная печать">Срочная печать</a> ';}
	if (!($fg%3)) {echo ' <a href="laminirovanie_dokumentov.html" class="a1" title="Ламинирование документов">Ламинирование документов</a> ';}
	if (!($fg%11)) {echo ' <a href="pechat_fotografiy_bolshogo_formata.html" class="a1" title="Печать фотографий большого формата">Печать фотографий большого формата</a> ';}
	if (!($fg%17)) {echo ' <a href="fotoposter.html" class="a1" title="Фотопостер на заказ">Фотопостер</a> ';}
	if (!($fg%13) || !($fg%17)) {echo ' <a href="elektronnyy_arhiv.html" class="a1" title="Электронный архив, оцифровка цены">Электронный архив</a> ';}
	if (!($fg%5) || !($fg%11)) {echo ' <a href="kserokopiya_bolshih_formatov.html" class="a1" title="Ксерокопия больших форматов">Ксерокопия больших форматов</a> ';}
	if (!($fg%5)) {echo ' <a href="sdelat_kserokopiu.html" class="a1" title="Сделать ксерокопию">Сделать ксерокопию</a> ';}
	if (!($fg%17)) {echo ' <a href="pechat_vizitok.html" class="a1" title="Печать визиток">Печать визиток</a> ';}
	if (!($fg%17)) {echo ' <a href="zakazat_vizitki.html" class="a1" title="Заказать визитки">Заказать визитки</a> ';}
	if (!($fg%7)) {echo ' <a href="napechatat.html" class="a1" title="Напечатать">Напечатать</a> ';}
	if (!($fg%7)) {echo ' <a href="gde_raspechatat.html" class="a1" title="Где распечатать">Где распечатать</a> ';}
	if (!($fg%5)) {echo ' <a href="kserokopirovanie_dokumentov.html" class="a1" title="Ксерокопирование документов">Ксерокопирование документов</a> ';}
	if (!($fg%2)) {echo ' <a href="tverdyy_pereplet_diplomov.html" class="a1" title="Твердый переплет дипломов">Твердый переплет дипломов</a> ';}
	if (!($fg%11)) {echo ' <a href="pechat_a0.html" class="a1" title="Печать А0">Печать А0</a> ';}
	if (!($fg%13)) {echo ' <a href="otskanirovat_dokumenty.html" class="a1" title="Отсканировать документы">Отсканировать документы</a> ';}
	if (!($fg%17)) {echo ' <a href="penokarton_kupit.html" class="a1" title="Купить пенокартон">Купить пенокартон</a> ';}
	if (!($fg%11)) {echo ' <a href="shirokoformatnaya_pechat.html" class="a1" title="Широкоформатная печать">Широкоформатная печать</a> ';}
	if (!($fg%5)) {echo ' <a href="cvetnye_kopii.html" class="a1" title="Цветные копии">Цветные копии</a> ';}
	if (!($fg%17)) {echo ' <a href="foto_na_dokumenty.html" class="a1" title="Фото на документы">Фото на документы</a> ';}
    if (!($fg%7)) {echo ' <a href="pechat_prezentaciy.html" class="a1" title="Печать презентаций">Печать презентаций</a> ';}
	if (!($fg%7)) {echo ' <a href="cifrovaya_pechat.html" class="a1" title="Цифровая печать">Цифровая печать</a> ';}
?>
    <div><hr>&copy; «КОПИМАСТЕР», 2005-2019 &nbsp;
        <a href="goszakupki.html" class="a1" title="Портал поставщиков ЕАИСТ">Портал поставщиков ЕАИСТ</a>
        <a href="rekvizity.html" class="a1" title="Реквизиты копицентра Копимастер">Реквизиты</a>
        <a href="sitemap.html" class="a1" title="Карта сайта копицентра Копимастер">Карта сайта</a><br>
        <a href="privacy.pdf" class="a1" title="Политика конфиденциальности копицентра Копимастер">Политика конфиденциальности</a>
        <a href="terms.pdf" class="a1" title="Пользовательское соглашение копицентра Копимастер">Пользовательское соглашение</a>
    </div>
</div>

    <div id="map" style="display:none;">
    <div id="mapshade" onclick="mapsw()"></div>
    <div id="mapimg">
        <div id="mapclose" onclick="mapsw()">X</div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('.open-slide-menu').click(function(){
    if ( $('.open-slide-menu').hasClass('close-menu')) {
        $('html').removeClass('open-menu-overflow');
        $('.menu-block').css('left','-110%');
    }else{
        $('html').addClass('open-menu-overflow');
        $('.menu-block').css('left','0');

    }
    $(".open-slide-menu").toggleClass("close-menu");
});
})

    function mapsw() {map.style.display=='none'?map.style.display='block':map.style.display='none';}

<?
  echo "var bnum=$bnum;";
?>

  function loadJS(whatFile,whereToPut){
    var link = document.createElement("script");
    link.setAttribute("type","text/javascript");
    link.setAttribute("src", whatFile);
    if (whereToPut) {
      whereToPut.appendChild(link);
      whereToPut.onclick= function() {return;}
    } else {
      document.getElementsByTagName("head")[0].appendChild(link);
    }
  }

  function vakanSw() {
    loadJS('vakan.js');
  }
  if (location.hash=='#vacancy') { vakanSw(); }
</script>

  <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
 <script>
    $(document).ready(function(){
      $('#banner').bxSlider({
        auto: true,
        pager: false,
        pause: 10000,

      });
    });
  </script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(66823306, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true,
        ecommerce:"dataLayer"
   });
</script>

<noscript><div><img src="https://mc.yandex.ru/watch/66823306" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<div class="menu-block">
    <a href='/#services'>Услуги</a>
    <a href='/price.html'>Цены</a>
    <a href='/online-pay.html'>Онлайн оплата</a>
    <a href='/delivery.html'>Доставка</a>
    <a href='/delivery.html'>Инфо</a>
    <a href='/contacts.html'>Контакты</a>
    <a href='/tt.html'>Технические требования к макетам</a>
    <a href='/our-team.html'>Наша команда</a>
</div>

</body>
</HTML>
