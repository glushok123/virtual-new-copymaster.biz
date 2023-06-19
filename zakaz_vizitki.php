<?php
$keyw = "Заказ визиток";
$titl = "Заказ визиток";
$desc = "Заказ визиток";
include_once 'header.php';
?>

<section class="section">
    <div class="container text-center">
        <h1>ВИЗИТКИ</h1>
        <hr>

        <br>
        <h2>РАССЧИТАТЬ ЗАКАЗ</h2>
        <hr>
        <div class="row">
            <div class="col-12 col-lg-6 col-xl-6">
                <h4>РАЗМЕР</h4>
                <select id="sizebum" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                    <option selected></option>
                    <option value="1">85*55</option>
                    <option value="2">90*50</option>
                </select>
            </select>
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
            <h4>
                <span data-bs-toggle="modal" data-bs-target="#exampleModal2">ТИП БУМАГИ  *</span>
            </h4>
            <select id="tibum" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <option selected></option>
                <option value="3">Мелованная бумага 300 гр.</option>
                <option value="4">Лен белый</option>
                <option value="5">Лен слон. кость</option>
                <option value="6">Тачкавер белый</option>
                <option value="7">Тачкавер слон. кость</option>
                <option value="8">Золотая бумага</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6 col-xl-6">
            <h4>ЦВЕТНОСТЬ</h4>
            <select id="cvet" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <option selected></option>
                <option value="9">4+0 (односторонние)</option>
                <option value="10">4+4 (двусторонние)</option>
            </select>
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
            <h4>КОЛИЧЕСТВО</h4>
            <select id="kolit" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <option selected></option>
                <option value="11">100</option>
                <option value="12">200</option>
                <option value="13">300</option>
                <option value="14">500</option>
                <option value="15">1000</option>
                <option value="16">2000</option>
                <option value="17">5000</option>
            </select>
        </div>
    </div>
    <div class="row text-center justify-content-center">
        <div class="col-12 col-lg-6 col-xl-6">
            <h4>Срочность</h4>
            <select id="srok" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <option selected></option>
                <option value="18">Не срочно (один рабочий день)</option>
                <option value="19">В течении 4 часов</option>
            </select>
        </div>
    </div>
    <hr>
    <h3>Заполните данные для обратной связи</h3>
    <div class="row text-center justify-content-center">
        <input id="famili" type="text" class="form-control text-center " style="max-width:500px;" placeholder="фамилия имя" required/>
    </div>
    <div class="row text-center justify-content-center">
        <input id="phon" type="text" class="form-control text-center " style="max-width:500px;" placeholder="999 999 99 99 или 8 999 999 99 99" required/>
    </div>
    <div class="row text-center justify-content-center">
        <input id="email" type="text" class="form-control text-center " style="max-width:500px;" placeholder="example@user.com" required/>
    </div>
    <br>
    <button type="button" id="sendz" class="btn btn-sm nav-btn btn-primary mb-4 mb-lg-0 ms-auto" name="button">Заказать</button>
</div></section><br><div class="container">
<div id="carouselExampleIndicators" class="carousel slide carousel-dark" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5" aria-label="Slide 6"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="6" aria-label="Slide 7"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="7" aria-label="Slide 8"></button>


    </div>
    <div class="carousel-inner">
        <div class="carousel-item active " data-bs-interval="10000">
            <img src="images/z_1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="10000">
            <img src="images/z_2.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="10000">
            <img src="images/z_3.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="10000">
            <img src="images/z_4.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="10000">
            <img src="images/z_5.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="10000">
            <img src="images/z_6.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="10000">
            <img src="images/z_7.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="10000">
            <img src="images/z_8.jpg" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Предыдущий</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Следующий</span>
    </button>
</div></div><!-- Modal --><div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <span class=" text-center"></span>
                </div>
                <!-- end row -->
            </form>
            <!-- end form -->
        </div>
    </div>
</div></div><!-- end modal --><?php
include_once 'footer.php';
?><link rel="stylesheet" href="dashbord/assets/plugins/notifications/css/lobibox.min.css"><script src="dashbord/assets/plugins/notifications/js/lobibox.min.js"></script><script src="dashbord/assets/plugins/notifications/js/notifications.js"></script><script src="dashbord/assets/plugins/notifications/js/notification-custom-script.js"></script><!--Password show & hide js --><script>
$(document).ready(function () {
$('#famili').on('blur', function () {
res = ((/^([А-ЯA-Z]|[А-ЯA-Z][\x27а-яa-z]{1,}|[А-ЯA-Z][\x27а-яa-z]{1,}\-([А-ЯA-Z][\x27а-яa-z]{1,}|(оглы)|(кызы)))\040[А-ЯA-Z][\x27а-яa-z]{1,}(\040[А-ЯA-Z][\x27а-яa-z]{1,})?$/).test($("#famili").val()));
if (!res) {
warning_noti("ПРИМЕР: <br> Петров Иван!");
}
});
$('#email').on('blur', function () {
res = ((/^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i).test($("#email").val()));
if (!res) {
warning_noti("Введите в соответствии с примером! <br> example@user.com");
}
});

$('#phon').on('blur', function () {
res = ((/^\d[\d\(\)\ -]{4,14}\d$/).test($("#phon").val()));
if (!res) {
warning_noti("ПРИМЕР: 8 999 999 99 99 ");
}
});

$("#sendz").on('click', function (event) {
let prov = true;
if ($("#famili").val() == "") {
warning_noti("Необходимо ввести логин!");
prov = false;
} else {
res = ((/^([А-ЯA-Z]|[А-ЯA-Z][\x27а-яa-z]{1,}|[А-ЯA-Z][\x27а-яa-z]{1,}\-([А-ЯA-Z][\x27а-яa-z]{1,}|(оглы)|(кызы)))\040[А-ЯA-Z][\x27а-яa-z]{1,}(\040[А-ЯA-Z][\x27а-яa-z]{1,})?$/).test($("#famili").val()));
if (!res) {
warning_noti("ПРИМЕР: <br> Петров Иван!");
prov = false;
}
}
if ($("#email").val() == "") {
warning_noti("Необходимо ввести почту!");
prov = false;
} else {
res = ((/^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i).test($("#email").val()));
if (!res) {
warning_noti("Введите в соответствии с примером! <br> example@user.com");
prov = false;
}
}
if ($("#phon").val() == "") {
warning_noti("Необходимо ввести телефон!");
prov = false;
} else {
res = ((/^\d[\d\(\)\ -]{4,14}\d$/).test($("#phon").val()));
if (!res) {
warning_noti("Введите в соответствии с примером! <br> 8 999 999 99 99");
prov = false;
}
}
if ($("#sizebum").val() == "") {
warning_noti("Необходимо выбрать размер!");
prov = false;
}
if ($("#cvet").val() == "") {
warning_noti("Необходимо выбрать цветность!");
prov = false;
}
if ($("#tibum").val() == "") {
warning_noti("Необходимо выбрать тип бумаги!");
prov = false;
}
if ($("#kolit").val() == "") {
warning_noti("Необходимо выбрать колличество!");
prov = false;
}
if ($("#srok").val() == "") {
warning_noti("Необходимо выбрать срок!");
prov = false;
}


if (prov == true) {

var datareg = {
"id": "vizitki",
"login": $("#famili").val(),
"email": $("#email").val(),
"phon": ($("#phon").val()),
"sizebum": $("#sizebum").val(),
"cvet": $("#cvet").val(),
"tibum": $("#tibum").val(),
"kolit": $("#kolit").val(),
"srok": $("#srok").val()
};

// console.log(datareg);
$.post("/registerz.php", datareg, function (data) {

var myModal = new bootstrap.Modal(document.getElementById('exampleModal3'));
myModal.show();

});
}
});


});</script>

