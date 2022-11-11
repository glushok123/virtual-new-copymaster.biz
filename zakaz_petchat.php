<?php
$keyw="Заказ печати";
$titl="Заказ печати";
$desc="Заказ печати";
include_once 'header.php';
 ?>

 <section class="section">
     <div class="container text-center">
         <h1>Печати</h1>
         <hr>

         <br>
         <h2>РАССЧИТАТЬ ЗАКАЗ</h2>
         <hr>
         <div class="row">
             <div class="col-12 col-lg-6 col-xl-6">
                 <h4>Печати</h4>
                 <select id="petchat_tip" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                  <option selected></option>
                  <option value="1">Первичная печать</option>
                  <option value="2">Печать по оттиску</option>
                </select>
                </select>
             </div>
             <div class="col-12 col-lg-6 col-xl-6">
                 <h4><span data-bs-toggle="modal" data-bs-target="#exampleModal2">Оснастка</span> </h4>
                 <select   id="osnastka"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <option selected></option>
                  <option value="3">Автоматическая оснастка</option>
                  <option value="4">Ручная (пешка)</option>
                </select>
             </div>
         </div>
         <div class="row">
             <div class="col-12 col-lg-6 col-xl-6">
                 <h4>Автоматическая оснастка</h4>
                 <select disabled id="avt_osnastka"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                  <option value="0"selected>Ещё не определился</option>
                  <option value="5">d40 мм</option>
                  <option value="6">карманная, d40 мм</option>
                  <option value="7">20х20 мм</option>
                  <option value="8">30х50 мм</option>
                  <option value="9">10х27 мм</option>
                  <option value="10">14х38 мм</option>
                  <option value="11">23х59 мм</option>
                  <option value="12">30х69 мм</option>
                  <option value="13">37х76 мм</option>
                  <option value="14">25х82 мм</option>
                </select>
             </div>

             <div class="col-12 col-lg-6 col-xl-6">
                 <h4>Срочность</h4>
                 <select id="srok"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                     <option selected></option>
                  <option value="15">Не срочно (один рабочий день)</option>
                  <option value="16">В течении 4 часов</option>
                  <option value="17">В течении часа</option>
                </select>
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
         <button type="button" id="sendz" class="btn btn-sm nav-btn btn-primary mb-4 mb-lg-0 ms-auto" name="button">Заказать</button>
     </div>
 </section>
<br>



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

         $('#osnastka').on('change', function (e) {
             if ($("#osnastka").val() == 4)
             {
                $("#avt_osnastka").attr("disabled", true);
                $('#avt_osnastka option[value="0"]').prop('selected', true);
             }
             else {

                 $("#avt_osnastka").attr("disabled", false);


             }

        });
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
             if ($("#petchat_tip").val() == ""){
                 warning_noti("Необходимо выбрать тип печати!");
                  prov = false;
             }
             if ($("#osnastka").val() == ""){
                 warning_noti("Необходимо выбрать оснастку!");
                  prov = false;
             }
             if ($("#srok").val() == ""){
                 warning_noti("Необходимо выбрать срок!");
                  prov = false;
             }


             if (prov == true){

                 var datareg = {
                     "id":"petchat",
                     "login":$("#famili").val(),
                     "email":$("#email").val(),
                     "phon":($("#phon").val()),

                     "petchat_tip":$("#petchat_tip").val(),
                     "osnastka":$("#osnastka").val(),
                     "avt_osnastka":$("#avt_osnastka").val(),
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
