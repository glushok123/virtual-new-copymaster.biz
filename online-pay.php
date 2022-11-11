<?php
$keyw="Онлайн оплата";
$titl="Онлайн оплата";
$desc="Онлайн оплата";
include_once 'header.php';
 ?>

 <section class="section">
     <div class="container text-center">
         <h1>Для Вашего удобства мы предусмотрели все самые удобные виды платежей:</h1>

            <div class="w1 con" id="online-pay">
            <br>
            <hr>
          <h2><b>Онлайн оплата</b></h2>
          <br>


          <!--form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml" style="text-align:center;">

              <div class="row row justify-content-center">
                  <div class="col-12 col-lg-6 col-xl-6">
                     <img src="/img/u.png" style="max-width:350px;">
                  </div>
                  <div class="col-12 col-lg-6 col-xl-6">

                      <input name="sum" placeholder="Введите сумму" data-type="number" style="width: 250px; padding: 10px; font-size: 1.2em;margin-top: 10px;"><br><br>
                      <input type="submit" name="submit-button" value="Перевести" class="btn btn-sm nav-btn btn-primary mb-4 mb-lg-0 ms-auto">
                    </p>
                    <p style="display:none;">
                      <input type="hidden" name="receiver" value="41001450854725">
                      <input type="hidden" name="label" value="$order_id">
                      <input type="hidden" name="quickpay-form" value="donate">
                      <input type="hidden" name="targets" value="Предоплата за услуги копицентра Копимастер">
                      <input type="hidden" name="need-fio" value="true">
                      <input type="hidden" name="need-email" value="false">
                      <input type="hidden" name="need-phone" value="false">
                      <input type="hidden" name="need-address" value="false">
                      <input type="radio" name="paymentType" value="AC" checked>
                      <input type="radio" name="paymentType" value="PC">
                    </p><br>
                  </form-->
                  <div class="row text-center">
                      <div class="col-md-12 mx-auto" style="width: 300px;">
                       <iframe src="https://yoomoney.ru/quickpay/shop-widget?writer=seller&targets=%D0%9E%D0%BF%D0%BB%D0%B0%D1%82%D0%B0%20%D1%83%D1%81%D0%BB%D1%83%D0%B3&default-sum=&button-text=11&payment-type-choice=on&successURL=&quickpay=shop&account=41001450854725&" width="100%" height="225" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
                    </div>
                  </div>
                  
                 
                  </div>
              

            <p>

             <hr>

               <br>
         <h2>Наличный расчёт</h2>
         <p>С кассовым чеком и отчетной документацией</p>
         <hr>
         <h2>Безналич. расчёт для юр.лиц</h2>
         <p>С закрывающими  накладными и отчетной документацией</p>
         <br>

        </div>

     </div>
 </section>

 <br><br>

<section class="price">
     <div class="row text-center justify-content-center">
         <div class="col-12 col-lg-6 col-xl-6 text-center justify-content-center" >

         </div>
     </div>
</section>
<?php
 include_once 'footer.php';
 ?>
