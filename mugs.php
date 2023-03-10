<?php
    $keyw="копимастер, копимастер на октябрьской, копировальные центры, копировальный центр, копировальный центр круглосуточно";
    $titl="Копировальный центр Копимастер на Октябрьской ";
    $desc="Круглосуточный копировальный центр Копимастер на Октябрьской предлагает печать, сканирование, ксерокопию, брошюрование, ламинирование документов. ";

    include_once 'header.php';
?>

<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,800" rel="stylesheet">

<style>
.card:hover {
    border: 1px dashed black;
}
.custom-row-plus {
    border: 1px solid black;
    border-radius: 7px;
    padding: 5px;
    margin:5px;
}
.custom-row-plus:hover {
    border: 1px solid red;
    background-color: #e0a6a6;
    color:black;
}
.custom-button-a{
    max-width:150px;
    margin:10px;
}
</style>
    <br>

    <div class='container'>
        <div class='row'>
            <video id="player" width="100%" height="auto" autoplay="autoplay" controls>
                <source src="/vidio/MVI_8404.MP4" type="video/mp4" codecs="avc1.42E01E, mp4a.40.2">
            </video>
        </div>
        <br>
        <div class='row'>
            <h2>Печать на кружках</h2>
            <div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 '>

                <p style="margin-top:0.5em;margin-bottom:0px;" align="justify">
                <b>Заказать печать на кружках от 1 шт в Москве с доставкой можно у нас:</b>
                </p><p></p><li>Более 50 различных кружек.</li>
                <li>Печать фото на кружке - лучший способ сделать подарок уникальным.</li>
                <li>Выбирайте кружку из нашего каталога.</li>
                <li>Создаем индивидуальный макет специально для Вас.</li>
                <li>Загружайте фото с компьютера или из соц. сетей.</li>
                <li>Выбирайте подарочную упаковку для вашего сувенира.</li>
                <li>Получайте заказ в срок у нас в офисе или дома.</li>
                <li>Доставка по Москве и по всей России.</li>
                <p></p>

                <!--div class="slider-buttons">
                    <a href="/printing/mugs/editor" class="begin btn btn-success btn-lg left-btn">Создать дизайн</a>
                    <a href="/printing/mugs-templates/for-white" class="begin btn btn-success btn-lg left-btn">Выбрать шаблон</a>
                </div-->

                <p style="margin-top:0.5em;margin-bottom:0px;" >
                    <b>Технические характеристики: </b>
                    <br><b>Способ нанесения: </b>сублимация
                    <br><b>Печать: </b>4 цвета. Белый цвет не печатается
                    <br><b>Параметры печати: </b>RGB, 300 dpi
                    <br><b>Минимальный тираж: </b>1 шт
                    <br><b>Выполнение заказа: </b>от 15 минут
                </p>
            </div>

            <?
                function getMugsFoSliderByTypes()
                {
                    $db = getDbInstance();
                    $mugs = $db->query("SELECT * FROM `mugs`");

                    $textHeadSlider = '';
                    $textBodySlider = '';
                    $count = 0;
                    $slider = 1;

                    shuffle($mugs);

                    foreach($mugs as $mug) {
                        if ($count == 0) {
                            $textHeadSlider = $textHeadSlider . '
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $count . '" class="active" aria-current="true" aria-label="Slide ' . $slider . '"></button>
                            ';

                            $textBodySlider = $textBodySlider . '
                                <div class="carousel-item active" data-bs-interval="2000">
                                    <img src="images/mugs/' . $mug['mugs_type'] . '/' . $mug['image'] . '" class="d-block w-100" alt="...">
                                </div>
                            ';

                            $count = $count + 1;
                            $slider = $slider + 1;

                            continue;
                        }

                        $textHeadSlider = $textHeadSlider . '
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $count . '"  aria-current="true" aria-label="Slide ' . $slider . '"></button>
                        ';

                        $textBodySlider = $textBodySlider . '
                            <div class="carousel-item" data-bs-interval="2000">
                                <img src="images/mugs/' . $mug['mugs_type'] . '/' . $mug['image'] . '" class="d-block w-100" alt="...">
                            </div>
                        ';

                        $count = $count + 1;
                        $slider = $slider + 1;
                    }

                    $text = '<div class="carousel-indicators">' . $textHeadSlider . '</div><div class="carousel-inner">' . $textBodySlider . '</div>';

                    return $text;
                }

            ?>
            <div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 '>
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

                    <?
                        echo(getMugsFoSliderByTypes());
                    ?>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                </div>
            </div>
        </div>
        <hr>
        <div class='row'>
            <div class='col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 d-flex'>
                <div class='row custom-row-plus'>
                    <div class='col-4'>
                        <img src="/images/pay.png" alt="shoppingicon">
                    </div>
                    <div class='col-8'>
                        <span>Наличная и безналичная оплата по карте</span>
                    </div>
                </div>
            </div>
            <div class='col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 d-flex'>
                <div class='row custom-row-plus'>
                    <div class='col-3'>
                        <img src="/images/prot.png" alt="shoppingicon">
                    </div>
                    <div class='col-9'>
                        <span>Гарантия отличного качества всей продукции</span>
                    </div>
                </div>
            </div>
            <div class='col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 d-flex'>
                <div class='row custom-row-plus'>
                    <div class='col-3'>
                        <img src="/images/online.png" alt="shoppingicon">
                    </div>
                    <div class='col-9'>
                        <span>Оформление заказов в любое удобное время</span>
                    </div>
                </div>
            </div>
            <div class='col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 d-flex'>
                <div class='row custom-row-plus'>
                    <div class='col-3'>
                        <img src="/images/post.png" alt="shoppingicon">
                    </div>
                    <div class='col-9'>
                        <span>Доставка курьером и до пункта выдачи по России</span>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class='row justify-content-center text-center'>
            <div class='col'>
                <a href="#Детские" class='btn btn-primary custom-button-a'>Детские</a>
            </div>
            <div class='col'>
                <a href="#Женские" class='btn btn-primary custom-button-a'>Женские</a>
            </div>
            <div class='col'>
                <a href="#Мужские" class='btn btn-primary custom-button-a'>Мужские</a>
            </div>
            <div class='col'>
                <a href="#Нейтральные" class='btn btn-primary custom-button-a'>Нейтральные</a>
            </div>
            <div class='col'>
                <a href="#Приколы" class='btn btn-primary custom-button-a'>Приколы</a>
            </div>
        </div>
        <hr>
            <?
                function getMugsByTypes($type)
                {


                    $db = getDbInstance();
                    $mugs = $db->query("SELECT * FROM `mugs` where mugs_type='" . $type . "'");
                    $text = "<br><div class='row g-0' products-block style=''>";
                    if ($type == 'Мужское'){$type = 'Мужские';}
                    if ($type == 'Детское'){$type = 'Детские';}
                    $text = $text . '<h3 id="' . $type . '">' . $type . '</h3><hr>';

                    foreach($mugs as $mug) {
                        $text = $text . '
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 d-flex align-items-stretch">
                                <div class="card text-center h-100" style="width:100%" href="/">
                                    <a data-fancybox="images" href="images/mugs/' . $mug['mugs_type'] . '/' . $mug['image'] . '">
                                        <img src="images/mugs/' . $mug['mugs_type'] . '/' . $mug['image'] . '" class="d-block w-95 castom-image rounded" alt="..." >
                                    </a>
                                    <div class="card-body">
                                        <!--h5 class="card-title name">' . $mug['id'] . '</h5-->
                                        
                                        <h5 class="card-text avtor">Артикул: ' . $mug['id'] . '</h5>
                                        <h5 class="card-text avtor">от 400 р.</h5>
                                        <hr>
                                        <button class="btn btn-primary add-in-cart"
                                            data-mug-id="' . $mug['id'] . '"
                                        >Купить</button>
                                    </div>
                                </div>
                            </div>
                    ';
                    }
                    $text = $text . '</div>';

                    return $text;
                }

                echo(getMugsByTypes('Детское'));
                echo(getMugsByTypes('Женские'));
                echo(getMugsByTypes('Мужское'));
                echo(getMugsByTypes('Нейтральные'));
                echo(getMugsByTypes('Приколы'));
            ?>
		</div>
	</div>
<br>

	<!-- Modal оформление заказа -->
	<div class="modal fade" id="add-in-cart" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered ">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Оформление заказа</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
						<p>
							<span>Артикул кружки: </span>
							<span id='cart-id' class='fs-5 fw-bold'></span>
						</p>
						<form action="">
							<hr>
							<div class="row text-center justify-content-center">
								<h5>Заполните данные для обратной связи</h5>
								<input id="user-name" type="text" class="form-control text-center "  style="max-width:500px;" placeholder="Фамилия Имя" required />
								<input id="phone" type="text" class="form-control text-center "  style="max-width:500px;" placeholder="(999) 999-99-99" required/>
								<input id="email" type="text" class="form-control text-center "  style="max-width:500px;" placeholder="example@user.com" required/>
								<label for="comment" class="form-label" style='margin-top:10px'>Комментарий к заказу:</label>
								<textarea class="form-control" id="comment" rows="3"></textarea>
							</div>
						</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
					<button type="button" class="btn btn-primary" id='send-order'>Отправить заявку</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal статус заявки -->
	<div class="modal fade" id="order-status-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-center" id="exampleModalLabel">СТАТУС ЗАЯВКИ № <span id='order-id'></span></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="post" name="myForm" onsubmit="return validateForm()">
						<div class="text-center">
							<h4>ВАША ЗАЯВКА ЗАРЕГИСТРИРОВАНА! </h4><br>
							<h4>С вами свяжутся в течени 10 минут!</h4>
						</div>
						<!-- end row -->
					</form>
					<!-- end form -->
				</div>
			</div>
		</div>
	</div>



    <?php
        include_once 'footer.php';
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/owl.theme.min.css">
    <script src="/js/owl.carousel.min.js"></script>

    <link rel="stylesheet" href="dashbord/assets/plugins/notifications/css/lobibox.min.css">
    <script src="dashbord/assets/plugins/notifications/js/lobibox.min.js"></script>
    <script src="dashbord/assets/plugins/notifications/js/notifications.js"></script>
    <script src="dashbord/assets/plugins/notifications/js/notification-custom-script.js"></script>
    <!--Password show & hide js -->
 <script>
     $(document).ready(function () {
        $("#phone").mask("(999) 999-99-99");
	    toastr.options.timeOut = 5000; // 5s

        //Показать модальное окно для оформления заказа
        function showModalAddInCart(mug) {
            $('#cart-id').text(mug.data('mug-id'))
            $('#add-in-cart').modal('show');
        }

        //валидация данных заказа
        function validation() {
            $("#user-name").removeClass('is-invalid');
            $("#phone").removeClass('is-invalid');
            $("#email").removeClass('is-invalid');

            if (! $("#user-name").val()) {
                $("#user-name").addClass('is-invalid');
                toastr.error('Необходимо заполнить ваше имя !');
                return false;
            }

            if (! $("#phone").val()) {
                $("#phone").addClass('is-invalid');
                toastr.error('Необходимо заполнить номер телефона !');
                return false;
            }

            if (! $("#email").val()) {
                $("#email").addClass('is-invalid');
                toastr.error('Необходимо заполнить email !');
                return false;
            }
        }

        //Отправить запрос сохранения заказа
        function sendOrderRequest() {
            if (validation() == false) {
                return;
            }
            
            data = {
                id          : 'mug',
                mug_id      : $('#cart-id').text(),
                user_name	: $("#user-name").val(),
                phone		: $("#phone").val(),
                email		: $("#email").val(),
                comment		: $("#comment").val(),
            };

            $.ajax({
                url: '/registerz.php',
                method: 'post',
                dataType: "json",
                data: data,
                success: function(data){
                    if (data.success == true) {
                        $('#add-in-cart').modal('hide');
                        $('#order-id').text(data.order_id)
                        $('#order-status-model').modal('show');
                    }
                },
                error: function (jqXHR, exception) {
                    if (jqXHR.status === 0) {
                        alert('Not connect. Verify Network.');
                    } else if (jqXHR.status == 404) {
                        alert('Requested page not found (404).');
                    } else if (jqXHR.status == 500) {
                        alert('Internal Server Error (500).');
                    } else if (exception === 'parsererror') {
                        alert('Requested JSON parse failed.');
                    } else if (exception === 'timeout') {
                        alert('Time out error.');
                    } else if (exception === 'abort') {
                        alert('Ajax request aborted.');
                    } else {
                        alert('Uncaught Error. ' + jqXHR.responseText);
                    }
                }
            });
        }

         $(document).on('click', '.add-in-cart', function() { showModalAddInCart($(this)) });
         $(document).on('click', '#send-order', function() { sendOrderRequest() } );
     });
</script>