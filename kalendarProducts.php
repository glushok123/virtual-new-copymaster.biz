<?php
$keyw="копимастер, копимастер на октябрьской, копировальные центры, копировальный центр, копировальный центр круглосуточно";
$titl="Копировальный центр Копимастер на Октябрьской ";
$desc="Круглосуточный копировальный центр Копимастер на Октябрьской предлагает печать, сканирование, ксерокопию, брошюрование, ламинирование документов. ";


include_once 'header.php';
 ?>

<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,800" rel="stylesheet">

<style>

    .card {
        background: #f7f7f7;
        margin: 10px 10px 10px 10px;
        max-width: 334px
    }
    .card:hover {
        box-shadow: 5px 6px 6px 2px #e9ecef;
        transform: scale(1.05);
    }


    .card-text {    
        font-family: 'Montserrat', sans-serif;
        -webkit-text-size-adjust: 100%;
        text-align: center;
        color: #505050;
        border: 0px;
        margin: 0px;
        outline: 0px;
        padding: 0px;
        font-size: 12px;
        line-height: 24px;
        margin-bottom: 20px;
        height: 216px;
    }

    .bottom-text{    
        font-family: 'Montserrat', sans-serif;
        -webkit-text-size-adjust: 100%;
        text-align: center;
        border: 0px;
        margin: 0px;
        outline: 0px;
        padding: 0px;
        font-size: 10px;
        line-height: 22px;
        color: #9a9a9a;
        font-weight: 500;
    }
    .green-img {
        font-family: 'Montserrat', sans-serif;
        -webkit-text-size-adjust: 100%;
        line-height: 24px;
        font-size: 1em;
        border: 0px;
        outline: 0px;
        padding: 0px;


        margin: 0 0 0 30px;
        list-style: none;
        color: #fff;
        font-weight: bold;
    }
    .green-img li {
        border-radius:15px;
        background: red;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 10px 20px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }
    .green-img li:hover{
        background: white;
        color:black;
    }
    .green-img li span {
        width: 70px;
        height: 70px;
        overflow: hidden;
        border-radius: 50%;
        display: block;
        margin-right: 30px;
    }
    .green-img li span img {
        min-width: 100%;
        height: auto !important;
        min-height: 100%;
        width: auto !important;
    }

    .multi-carousel{overflow:hidden}
    .multi-carousel .carousel-control-prev,.multi-carousel .carousel-control-next{background:rgba(255,255,255,0.5);width:5%}
    .multi-carousel .carousel-inner{width:310%;left:-80%}
    .carousel-inner .carousel-item-right.active,.carousel-inner .carousel-item-next{transform:translateX(75%)}
    .carousel-inner .carousel-item-left.active,.carousel-inner .carousel-item-prev{transform:translateX(-75%)}
    .carousel-inner .carousel-item-right,.carousel-inner .carousel-item-left{transform:translateX(0)}
    .item-third{float:left;width:25%;background-size:cover;height:auto}
</style>

    <br>
    <div class="container">
        <br>
        <div class='row text-center'>
            <h1>Календарная продукция</h1>
            <hr>
        </div>

         <!-- ПЕРВАЯ СТРОКА -->
        <div class='row justify-content-center text-center'>

            <div class='col'>
                <div class="card" style="">
                    <div class="photo" style="height: 150px;">
                            <img src="img/Перекидной.png" alt="Перекидной календарь" style="height: 150px;margin-top:10px;">
                    </div>
                    <div class="card-body">
                
                        <h5 class="card-title">Перекидной календарь</h5>
                        <br>
                        <p class="card-text">Прекрасный сюрприз как для представителей предпринимательской сферы, так и для близких, друзей. 
                            Поэтому печать перекидных календарей в Москве очень востребована: в мегаполисе активно развивается большой, малый бизнес.</p>
                        <br>
                        <a href="#zakaz" class="btn btn-primary">Заказать</a>
                        <div>
                            <span class='bottom-text'>Срок изготовления: зависит от тиража</span>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class='col'>
                <div class="card" style="">
                    <div class="photo" style="height: 150px;">
                            <img src="img/Календарь домик.png" alt="Перекидной календарь" style="height: 150px;margin-top:10px;">
                    </div>
                    <div class="card-body">
                
                        <h5 class="card-title">Календарь домик</h5>
                        <br>
                        <p class="card-text">Календарь домик практичен, его можно использовать на рабочем столе (так как он имеет форму пирамиды), 
                            а также подарить клиентам. Данная продукция будет напоминать о вашей компании в течение длительного времени.</p>
                        <br>
                        <a href="#zakaz" class="btn btn-primary">Заказать</a>
                        <div>
                            <span class='bottom-text'>Срок изготовления: зависит от тиража</span>
                        </div>
                        
                    </div>
                </div>
          </div>

            <div class='col'>
                <!--div class="card" style="">
                    <div class="photo" style="height: 150px;">
                            <img src="https://kb-print.ru/resize/icons/portrait/0/150/icon43.png" alt="Перекидной календарь">
                    </div>
                    <div class="card-body">
                
                        <h5 class="card-title">Карманный календарь</h5>
                        <br>
                        <p class="card-text">Прекрасный сюрприз как для представителей предпринимательской сферы, так и для близких, друзей. Поэтому печать перекидных календарей в Санкт-Петербурге очень востребована: в мегаполисе активно развивается большой, малый бизнес.</p>
                        <br>
                        <a href="#zakaz" class="btn btn-primary">Заказать</a>
                        <div>
                            <span class='bottom-text'>Срок изготовления: зависит от тиража</span>
                        </div>
                        
                    </div>
                </div-->
                <div class="card" style="">
                    <div class="photo" style="height: 150px;">
                            <img src="img/Постерный календарь.png" alt="Перекидной календарь" style="height: 150px;margin-top:10px;">
                    </div>
                    <div class="card-body">
                
                        <h5 class="card-title">Календари постеры</h5>
                        <br>
                        <p class="card-text">Самый экономичный вид настенных календарей.
Поможет сэкономить ваш рекламный бюджет с одной стороны и вместе с тем имеет большую рекламную площадь – с другой.
По вашему желанию, календарная сетка может быть любой: от двух лет до одного месяца.
Размеры календаря: А2 (594*420 мм) или А3 (420*297 мм) - по вашему выбору.
Материал: Мелованная бумага плотностью 150 г/м2.</p>
                        <br>
                        <a href="#zakaz" class="btn btn-primary">Заказать</a>
                        <div>
                            <span class='bottom-text'>Срок изготовления: зависит от тиража</span>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
        <br>

         <!-- ВТОРАЯ СТРОКА -->
        <div class='row justify-content-center text-center'>

            <div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 text-center  d-flex'>
                <div class="card  text-center  d-flex mx-auto" style="">
                    <div class="photo" style="height: 150px;">
                            <img src="img/Календарь трио.png" alt="Перекидной календарь" style="height: 150px;margin-top:10px;">
                    </div>
                    <div class="card-body">
                
                        <h5 class="card-title">Календари трио</h5>
                        <br>
                        <p class="card-text">Интересно заглянуть в мир современного офисного сотрудника – вы найдете на рабочем месте все, что угодно. 
                            Теперь современный мир IT-технологий быстрым темпом вытесняет некоторые печатные атрибуты или переводит работу в электронный вид. 
                            Обратим внимание, что в каждой фирме ведется какой-либо учет или планирование работы, соответственно не обойтись без записей.</p>
                        <br>
                        <a href="#zakaz" class="btn btn-primary">Заказать</a>
                        <div>
                            <span class='bottom-text'>Срок изготовления: зависит от тиража</span>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 text-center  d-flex'>
                <div class="card text-center  d-flex mx-auto" style="">
                    <div class="photo" style="height: 150px;">
                            <img src="img/Календарь моно.png" alt="Перекидной календарь" style="height: 150px;margin-top:10px;">
                    </div>
                    <div class="card-body">
                
                        <h5 class="card-title">Календари моно</h5>
                        <br>
                        <p class="card-text">Что, на ваш взгляд, подчеркивает изысканность и минимализм помещения? Ответ прост – календарь. 
                            Моно – настенный календарь с наличием трех месяцев на одном листке. 
                            Такой вид календарей удобен в применении и изготовлении: оптимальная ценовая политика.</p>
                        <br>
                        <a href="#zakaz" class="btn btn-primary">Заказать</a>
                        <div>
                            <span class='bottom-text'>Срок изготовления: зависит от тиража</span>
                        </div>
                        
                    </div>
                </div>
          </div>
        </div>
        <hr>

        <!-- Календарная продукция на 2022 год -->
        <div class='row justify-content-center text-center'>
            <div>
                <h2>Календарная продукция на 2022 год</h2>
                <br>
            </div>
            


            <div class = 'col'>
                <p>
                    В процессе изготовления материала специальным образом обрабатывается и ламинируется. Использование данной технологии позволяет приобрести изделию дополнительную стойкость к загрязнению и продлить срок его эксплуатации.
                </p>
                <br>
                <p>
                    Календарь несет не только смысловую информацию, но и выполняет другие функции.
                </p>
                <br>
                <p>
                    Календари очень удобны в использовании как часть маркетинга компании. На календарь можно нанести логотип компании и контактные данные, и таким образом, он будет напоминать владельцу о вас
                </p>

            </div>

            <div class = 'col'>
                <ul class="green-img">
                    <li>
                        <span><img alt="" src="/img/kal_1.jpg" style="width: 108px; height: 72px;"></span>Ваша рекламная площадь в офисе клиента</li>
                    <li>
                        <span><img alt="" src="/img/kal_2.jpg" style="width: 131px; height: 74px;"></span>Креативный подарок</li>
                    <li>
                        <span><img alt="" src="/img/kal_3.jpg" style="width: 114px; height: 64px;"></span>Практичность применения</li>
                </ul>
            </div>



         </div>
         <hr>
        </div>

        <!-- -->
        <div class='row justify-content-center text-center' style='background: #f7f7f7' id='zakaz'>

            <div><br><br></div>
            <div class='container'>

                
                <h2>ЗАКАЗАТЬ</h2>
                <hr>
                <div class="row">
                    <div class="col-12 col-lg-6 col-xl-6">

                        <h4>Вид продукции</h4>

                        <select id="vid" name="producttype" class="form-select form-select-lg mb-3"  aria-label=".form-select-lg example"required="required">
                            <option value="">Вид продукции*</option>
                            <option value="Календари моно">Календари моно</option>
                            <option value="Календари постеры">Календари постеры</option>
                            <option value="Календари трио">Календари трио</option>
                            <option value="Календарь домик">Календарь домик</option>
                            <option value="Карманный календарь">Карманный календарь</option>
                            <option value="Перекидной календарь">Перекидной календарь</option>
                        </select>

                    </div>
                    <div class="col-12 col-lg-6 col-xl-6">
                        <h4>Колличество</h4>
                        <input id="kolit" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="100">
                    </div>
                </div>

                <div class="row text-center justify-content-center">
                    <div class="col-12 col-lg-6 col-xl-6">
                        <h4>Срочность</h4>
                        <select id="srok"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option selected></option>
                        <option value="18">Не срочно (один рабочий день)</option>
                        <option value="19">В течении 4 часов</option>
                        </select>
                    </div>
                </div>
                <hr>
                <h4>Данные для обратной связи *</h4>
                <div class="row text-center justify-content-center">
                        <input id="famili" type="text" class="form-control text-center "  style="max-width:500px;" placeholder="фамилия имя" required />
                </div>
                <div class="row text-center justify-content-center">
                        <input id="phon" type="text" class="form-control text-center "  style="max-width:500px;" placeholder="999 999 99 99 или 8 999 999 99 99" required/>
                </div>
                <div class="row text-center justify-content-center">
                        <input id="email" type="text" class="form-control text-center "  style="max-width:500px;" placeholder="example@user.com" required/>
                </div>
                <br>
                <button type="button" id="sendz" class="btn btn-sm nav-btn btn-primary mb-4 mb-lg-0 ms-auto" name="button">Заказать</button>
                
            </div>
            <div><br><br></div>
            
        </div>

        <div class='container'>
            <div class='row justify-content-center text-center'>
                <div><br></div>
                <h2>Календари - это удобный и мощный помощник</h2>
                <hr>
                <div><br></div>

                <div class='col'>

                    <p>
                        Планирование своего времени, расписание мероприятий, встреч, праздников - все это удается зафиксировать при помощи календарей. Мы используем их машинально.
                    </p>
                    <br>
                    <p>
                        Наша компания предлагает вам высококачественную печать календарей в Москве всех видов. Печать осуществляется на офсетной или плотно мелованной бумаге с использованием новейших технологий.
                    </p>
                    <br>
                    <p>
                        Купить календарь возможно как и онлайн, оформив заявку на сайте, так и у нас в офисе. Если вы выбрали заявку онлайн, наши специалисты свяжутся с вами для справки всех нюансов
                    </p>
                    <br>
                    <p>
                        Наша цель - долголетнее сотрудничество и цель качественных услуг в сфере типографии.
                    </p>
                </div>

                <div class='col'>
                    <img src="https://kb-print.ru/upload/image/bezimeni_33.jpg" alt="">
                </div>

            </div>
        </div>

        <div class='container'>
            <hr>

            <div class='row justify-content-center text-center'>
                <h2>Примеры</h2>
            </div>

            
            <div class="owl-carousel owl-carousel1 owl-theme">
                <div>
                <div class="card text-center"><img class="card-img-top" src="/img/ex_kal_1.jpg" alt="" style='object-fit: cover;'>

                </div>
                </div>
                <div>
                <div class="card text-center"><img class="card-img-top" src="/img/ex_kal_2.jpg" alt="" style='object-fit: cover;'>

                </div>
                </div>
                <div>
                <div class="card text-center"><img class="card-img-top" src="/img/ex_kal_3.jpg" alt="" style='object-fit: cover;'>

                </div>
                </div>
                <div>
                <div class="card text-center"><img class="card-img-top" src="/img/ex_kal_4.jpg" alt="" style='object-fit: cover;'>
      
                </div>
                </div>
            </div>
            

            <hr>
        </div>

        <section id="karta">
            <div class="container">
                <br><br><br>
                <div class="row justify-content-center">
                <div class="col-12 col-xl-8">
                    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A2071f207a1d68f3b22bacc5a5ff0a2239b91b1869ddda0088d36d2ec493478f8&amp;width=100%25&amp;height=662&amp;lang=ru_RU&amp;scroll=true"></script></div>
                <div class="col-12 col-xl-4 justify-content-center text-center">
                    <div style="width:100%;height:800px;overflow:hidden;position:relative;">
                    <iframe style="width:100%;height:100%;border:1px solid #e6e6e6;border-radius:8px;box-sizing:border-box;text-align:center;margin: 0 auto;" src="https://yandex.ru/maps-reviews-widget/1032608171?comments"></iframe>
                    <a href="https://yandex.ru/maps/org/kopimaster/1032608171/" target="_blank" style="box-sizing:border-box;text-decoration:none;color:#b3b3b3;font-size:10px;font-family:YS Text,sans-serif;padding:0 20px;position:absolute;bottom:8px;width:100%;text-align:center;left:0;overflow:hidden;text-overflow:ellipsis;display:block;max-height:14px;white-space:nowrap;padding:0 16px;box-sizing:border-box">Копимастер на карте Москвы — Яндекс Карты</a></div>
                </div>
                </div>
            </div>
        </section>

 <?php
    include_once 'footer.php';
 ?>
<link rel="stylesheet" href="/css/owl.carousel.min.css">
<link rel="stylesheet" href="/css/owl.theme.min.css">
<script src="/js/owl.carousel.min.js"></script>

<script>




  var carousels = function () {

    $(".owl-carousel1").owlCarousel({
        responsive: true,
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        autoplayTimeout: 2500,
        items: 3,
        touchDrag: true,
        mouseDrag: true,
        smartSpeed: 250,
        dots: false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });
  };

    carousels();
</script>
<link rel="stylesheet" href="dashbord/assets/plugins/notifications/css/lobibox.min.css">
 <script src="dashbord/assets/plugins/notifications/js/lobibox.min.js"></script>
 <script src="dashbord/assets/plugins/notifications/js/notifications.js"></script>
 <script src="dashbord/assets/plugins/notifications/js/notification-custom-script.js"></script>
 <!--Password show & hide js -->
 <script>
     $(document).ready(function () {
         $('#famili').on('blur', function(){
             res = ((/^([А-ЯA-Z]|[А-ЯA-Z][\x27а-яa-z]{1,}|[А-ЯA-Z][\x27а-яa-z]{1,}\-([А-ЯA-Z][\x27а-яa-z]{1,}|(оглы)|(кызы)))\040[А-ЯA-Z][\x27а-яa-z]{1,}(\040[А-ЯA-Z][\x27а-яa-z]{1,})?$/).test($("#famili").val()));
              if (!res){
                  warning_noti("ПРИМЕР: <br> Петров Иван!");
              }
         });
         $('#email').on('blur', function(){
             res = ((/^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i).test($("#email").val()));
              if (!res){
                  warning_noti("Введите в соответствии с примером! <br> example@user.com");
              }
         });

         $('#phon').on('blur', function(){
             res = ((/^\d[\d\(\)\ -]{4,14}\d$/).test($("#phon").val()));
              if (!res){
                  warning_noti("ПРИМЕР: 8 999 999 99 99 ");
              }
         });

         $("#sendz").on('click', function (event) {
             let prov = true;
             if ($("#famili").val() == " "){
                 warning_noti("Необходимо ввести имя!");
                 prov = false;
             }
             else {
                 res = ((/^([А-ЯA-Z]|[А-ЯA-Z][\x27а-яa-z]{1,}|[А-ЯA-Z][\x27а-яa-z]{1,}\-([А-ЯA-Z][\x27а-яa-z]{1,}|(оглы)|(кызы)))\040[А-ЯA-Z][\x27а-яa-z]{1,}(\040[А-ЯA-Z][\x27а-яa-z]{1,})?$/).test($("#famili").val()));
                  if (!res){
                      warning_noti("ПРИМЕР: <br> Петров Иван!");
                      prov = false;
                  }
             }
             if ($("#email").val() == ""){
                 warning_noti("Необходимо ввести почту!");
                  prov = false;
             }
             else {
                 res = ((/^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i).test($("#email").val()));
                  if (!res){
                      warning_noti("Введите в соответствии с примером! <br> example@user.com");
                      prov = false;
                  }
             }
             if ($("#phon").val() == ""){
                 warning_noti("Необходимо ввести телефон!");
                  prov = false;
             }
            else {
                 res = ((/^\d[\d\(\)\ -]{4,14}\d$/).test($("#phon").val()));
                  if (!res){
                      warning_noti("Введите в соответствии с примером! <br> 8 999 999 99 99");
                      prov = false;
                  }
             }

            if ($("#vid").val() == ""){
                warning_noti("Необходимо выбрать вид продукции!");
                prov = false;
             }

             if ($("#kolit").val() == ""){
                warning_noti("Необходимо выбрать колличество!");
                prov = false;
             }

             if ($("#srok").val() == ""){
                warning_noti("Необходимо выбрать срок!");
                prov = false;
             }

             if (prov == true){

                 var datareg = {
                     "id":"kalendari",
                     "login":$("#famili").val(),
                     "email":$("#email").val(),
                     "phon":$("#phon").val(),
                     "vid":$("#vid").val(),
                     "kolit":$("#kolit").val(),
                     "srok":$("#srok").val()
                 };

                console.log(datareg);

                $.post("/registerz.php", datareg, function(data){

                    var myModal = new bootstrap.Modal(document.getElementById('exampleModal3'));
                    myModal.show();

                 });
                 
             }
         });


     });
 </script>