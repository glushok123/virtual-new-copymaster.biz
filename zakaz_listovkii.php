<?php
$keyw = "Заказ листовок";
$titl = "Заказ листовок";
$desc = "Заказ листовок";
include_once 'header.php';
?>

<section class="section">
    <div class="container text-center">
        <h1>Листовки</h1>
        <hr>

        <br>
        <h2>РАССЧИТАТЬ ЗАКАЗ</h2>
        <hr>
        <div class="row">
            <div class="col-12 col-lg-6 col-xl-6">
                <h4>РАЗМЕР</h4>
                <select id="sizebum" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                    <option selected></option>
                    <option value="1">10,5x15 см (A6)</option>
                    <option value="2">10x20 см (1/3 A4)</option>
                    <option value="3">15x20 см (A5)</option>
                    <option value="4">21x30 см (A4)</option>
                    <option value="5">90*50</option>
                </select>
            </select>
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
            <h4>
                <span data-bs-toggle="modal" data-bs-target="#exampleModal2">ТИП БУМАГИ  *</span>
            </h4>
            <select id="tibum" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <option selected></option>
                <option value="6">Мелованная бумага 130 гр.</option>
                <option value="7">Мелованная бумага 170 гр.</option>
                <option value="8">Мелованная бумага 250 гр.</option>
                <option value="9">Мелованная бумага 300 гр.</option>

            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6 col-xl-6">
            <h4>ЦВЕТНОСТЬ</h4>
            <select id="cvet" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <option selected></option>
                <option value="10">4+0 (односторонние)</option>
                <option value="11">4+4 (двусторонние)</option>
            </select>
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
            <h4>КОЛИЧЕСТВО</h4>
            <select id="kolit" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <option selected></option>
                <option value="12">100</option>
                <option value="13">200</option>
                <option value="14">300</option>
                <option value="15">500</option>
                <option value="16">1000</option>
                <option value="17">2000</option>
                <option value="18">5000</option>
            </select>
        </div>
    </div>
    <div class="row text-center justify-content-center">
        <div class="col-12 col-lg-6 col-xl-6">
            <h4>Срочность</h4>
            <select id="srok" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <option selected></option>
                <option value="19">Не срочно (один рабочий день)</option>
                <option value="20">В течении 4 часов</option>
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
</div></section><br><!-- Modal --><div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
if ($("#famili").val() == " ") {
warning_noti("Необходимо ввести имя!");
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
"id": "listovki",
"login": $("#famili").val(),
"email": $("#email").val(),
"phon": $("#phon").val(),
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

