<?php
$keyw="Заказ визиток";
$titl="Заказ визиток";
$desc="Заказ визиток";
include_once 'header.php';
 ?>


<style media="screen">

.sale {
  position: relative;
  display: inline-block;
  background: red;
  color: white;
  height: 4rem;
  width: 4rem;
  text-align: center;
  vertical-align: middle;
  line-height: 4rem;
  margin: 2vh 2vw;
  transform: rotate(-20deg);
  -webkit-animation: beat 1s ease infinite alternate;
          animation: beat 1s ease infinite alternate;
}
.sale:before, .sale:after {
  content: "";
  position: absolute;
  background: inherit;
  height: inherit;
  width: inherit;
  top: 0;
  left: 0;
  z-index: -1;
  transform: rotate(30deg);
}
.sale:after {
  transform: rotate(60deg);
}

@-webkit-keyframes beat {
  from {
    transform: rotate(-20deg) scale(1);
  }
  to {
    transform: rotate(-20deg) scale(1.1);
  }
}

@keyframes beat {
  from {
    transform: rotate(-20deg) scale(1);
  }
  to {
    transform: rotate(-20deg) scale(1.1);
  }
}


</style>
 <section class="section">
     <div class="container text-center">
         <h1>Печать фото</h1>

         <hr>
         <h2  data-shadow='dang!'>Ответьте на 4 вопроса и получите скидку -10% </h2>




         <br><br>

         <div class="conatiner">
             <div class="row justify-content-center text-center">
                 <div class="wrap">
                     <button class="buttonpuls" data-bs-toggle="modal" data-bs-target="#exampleModal90">ЗАКАЗАТЬ СО СКИДКОЙ</button>
                 </div>
             </div>
         </div>
         <br><br><br>
     </div>
 </section>
<br>

<!-- Modal -->
<div class="modal fade" id="exampleModal90" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">РАССЧИТАТЬ ЗАКАЗ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container text-center">


                    <div class="row">

                        <div class="col-12 col-lg-6 col-xl-6">
                            <h4>РАЗМЕР</h4>
                            <select id="sizebum" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                             <option selected></option>
                             <option value="1">10x15 см (A6)</option>
                             <option value="2">15x20 см (A5)</option>
                             <option value="3">21x30 см (A4)</option>
                           </select>
                           </select>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-6">
                            <h4><span data-bs-toggle="modal" data-bs-target="#exampleModal2">ТИП БУМАГИ</span> </h4>
                            <select id="tibum"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                           <option selected></option>
                             <option value="4">Матовая</option>
                             <option value="5">Глянцевая</option>
                           </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6 col-xl-6">
                            <h4>Срочность</h4>
                            <select id="srok"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option selected></option>
                             <option value="6">Не срочно (один рабочий день)</option>
                             <option value="7">В течении 4 часов</option>
                           </select>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-6">
                            <h4>КОЛИЧЕСТВО</h4>
                            <input id="kol" type="text" class="form-control text-center  mb-3 "   placeholder="100" required />
                        </div>
                    </div>

                    <hr>
                    <h3>Заполните данные для обратной связи</h3>
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
                    <button type="button" id="sendz" class="btn btn-sm nav-btn btn-primary mb-4 mb-lg-0 ms-auto" name="button" style="font-size:35px">Заказать </button>
                </div><h3> <span class="sale">-10%</span> </h3>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Тип бумаги</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" name="myForm" onsubmit="return validateForm()">
                    <div class="text-center">
                        <h3>Мелованная бумага 300 гр.</h3>
                        <p>Стандартная бумага для визиток в небольших тиражах, гладкая, подходит чтобы ставить печати/писать ручкой</p>
                        <hr>
                        <h3>Лен белый</h3>
                        <p>Дизайнерская бумага, на ощупь и на вид напоминает ткань «Лен»</p>
                        <hr>
                        <h3>Лен слон. кость</h3>
                        <p>Дизайнерская бумага, на ощупь и на вид напоминает ткань «Лен». С желтоватым оттенком</p>
                        <hr>
                        <h3>Тачкавер белый</h3>
                        <p>Благодаря двустороннему напылению латекса бумага имеет матовую фактуру, выглядит одновременно и сдержанно элегантно, и роскошно, а шелковистая, нежная</p>
                        <hr>
                        <h3>Тачкавер слон. кость</h3>
                        <p>Благодаря двустороннему напылению латекса бумага имеет матовую фактуру, выглядит одновременно и сдержанно элегантно, и роскошно, а шелковистая, нежная. Желтоватого оттенка</p>
                        <hr>
                        <h3>Золотая бумага</h3>
                        <p>Дизайнерская бумага с металлическим оттенком</p>
                        <span class=" text-center"> </span>
                    </div>
                    <!-- end row -->
                </form>
                <!-- end form -->
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<?php
 include_once 'footer.php';
 ?>
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
             if ($("#famili").val() == ""){
                 warning_noti("Необходимо ввести логин!");
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
             if ($("#sizebum").val() == ""){
                 warning_noti("Необходимо выбрать размер!");
                  prov = false;
             }
             if ($("#tibum").val() == ""){
                 warning_noti("Необходимо выбрать тип бумаги!");
                  prov = false;
             }
             if ($("#kol").val() == ""){
                 warning_noti("Необходимо выбрать колличество!");
                  prov = false;
             }
             if ($("#srok").val() == ""){
                 warning_noti("Необходимо выбрать срок!");
                  prov = false;
             }




             if (prov == true){

                 var datareg = {
                     "id":"petfoto",
                     "login":$("#famili").val(),
                     "email":$("#email").val(),
                     "phon":($("#phon").val()),
                     "sizebum":$("#sizebum").val(),
                     "tibum":$("#tibum").val(),
                     "kolit":$("#kol").val(),
                     "srok":$("#srok").val()
                 };

                 //console.log(datareg);
                $.post("/registerz.php", datareg, function(data){
                    var myModal = new bootstrap.Modal(document.getElementById('exampleModal3'));
                    myModal.show();
                 });
             }
         });


     });
 </script>
