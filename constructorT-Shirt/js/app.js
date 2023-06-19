var arrayImagesDownload = [] // Все загруженные картинки пользователей
var arrayScreenShotsDownload = [] //Скриншоты спереди и с зади

//кнопка создания скриншота
$('#take_screenshoot').click(function () {
    sendScreenShots()
});

// Отправка скриншотов
function sendScreenShots() {
    createScreenShots(); // 1 часть скриншота
    rotateShit();

    setTimeout(function () {
        createScreenShots(); // 2 часть скриншота
    }, 1000);
}

//Создание скриншота передней и задней части футболки
function createScreenShots() {
    html2canvas(document.querySelector("#shirtDiv")).then(canvas => {
        document.querySelector("#screen").appendChild(canvas);
        dataURL = canvas.toDataURL();
        post_data(dataURL);
    });
}

//перевертывание футболки
function rotateShit() {
    if (valueSelect === "img/crew_front.png") {
        if ($('#flipback').attr("data-original-title") == "Show Back View") {
            $('#flipback').attr('data-original-title', 'Show Front View');
            $("#tshirtFacing").attr("src", "img/crew_back.png");
            a = JSON.stringify(canvas);
            canvas.clear();
            try {
                var json = JSON.parse(b);
                canvas.loadFromJSON(b);
            } catch (e) {}
        } else {
            $('#flipback').attr('data-original-title', 'Show Back View');
            $("#tshirtFacing").attr("src", "img/crew_front.png");
            b = JSON.stringify(canvas);
            canvas.clear();
            try {
                var json = JSON.parse(a);
                canvas.loadFromJSON(a);
            } catch (e) {}
        }
    }
    canvas.renderAll();
    canvas.calcOffset();
}

//Отправка скриншота на сервер
function post_data(imageURL) {
    $.ajax({
        url: "/constructorT-Shirt/phpModules/uploadScreen.php",
        type: "post",
        dataType: "json",
        async: false,
        data: {
            image: imageURL
        },
        success: function (data) {
            arrayScreenShotsDownload.push(data.name)
        }
    });
}

$(document).ready(function () {
    $("#tshirttype").change(function () {
        $("img[name=tshirtview]").attr("src", $(this).val());
    });
});

var files; // переменная. будет содержать данные файлов

// заполняем переменную данными, при изменении значения поля file 
$('input[type=file]').on('change', function () {
    files = this.files;
});

// обработка и отправка AJAX запроса при клике на кнопку upload_files
$('.upload_files').on('click', function (event) {
    event.stopPropagation(); // остановка всех текущих JS событий
    event.preventDefault(); // остановка дефолтного события для текущего элемента - клик для <a> тега
    // ничего не делаем если files пустой
    if (typeof files == 'undefined') return;
    // создадим объект данных формы
    var data = new FormData();
    // заполняем объект данных файлами в подходящем для отправки формате
    $.each(files, function (key, value) {
        data.append(key, value);
    });
    // добавим переменную для идентификации запроса
    data.append('my_file_upload', 1);
    // AJAX запрос
    $.ajax({
        url: '/constructorT-Shirt/phpModules/uploadImage.php',
        type: 'POST', // важно!
        data: data,
        cache: false,
        dataType: 'json',
        // отключаем обработку передаваемых данных, пусть передаются как есть
        processData: false,
        // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
        contentType: false,
        // функция успешного ответа сервера
        success: function (respond, status, jqXHR) {
            // ОК - файлы загружены
            if (typeof respond.error === 'undefined') {
                var html = respond.name + '<br>';
                $('#blah').attr('src', '/constructorT-Shirt/phpModules/uploads/' + respond.name);
                $('#blah').trigger('click')
                $('.ajax-reply').html(html);
                arrayImagesDownload.push('/constructorT-Shirt/phpModules/uploads/' + respond.name)
            }
            // ошибка
            else {
                console.log('ОШИБКА: ' + respond.data);
            }
        },
        // функция ошибки ответа сервера
        error: function (jqXHR, status, errorThrown) {
            console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
        }
    });
});

function clearCanvas() {
    let obj = canvas.getObjects()
    obj.forEach(function (object) {
        canvas.remove(object);
    });
}
//событие клика по загруженной картинке, для применения к футболке
$(".img-polaroid2").click(function (e) {
    var el = e.target;
    var offset = 50;
    var left = fabric.util.getRandomInt(0 + offset, 200 - offset);
    var top = fabric.util.getRandomInt(0 + offset, 400 - offset);
    var angle = fabric.util.getRandomInt(-20, 40);
    var width = fabric.util.getRandomInt(30, 50);
    var opacity = (function (min, max) {
        return Math.random() * (max - min) + min;
    })(0.5, 1);

    clearCanvas()

    fabric.Image.fromURL(el.src, function (image) {
        var elWidth = image.naturalWidth || image.width;
        var elHeight = image.naturalHeight || image.height;
        image.set({
            left: left,
            top: top,
            angle: 0,
            padding: 10,
            cornersize: 10,
            hasRotatingPoint: true,
            scaleX: 1 / elWidth,
            scaleY: 1 / elHeight
        });

        canvas.add(image).renderAll();
    });
});

var valueSelect = $("#tshirttype").val();
$("#tshirttype").change(function () {
    valueSelect = $(this).val();
});


//валидация данных заказа
function validation() {
    $("#status-form").removeClass('error');

    if (!$("#user-name").val()) {
        $("#status-form").addClass('error');
        toastr.error('Необходимо заполнить ваше имя !');
        return false;
    }

    if (!$("#phone").val()) {
        $("#status-form").addClass('error');
        toastr.error('Необходимо заполнить номер телефона !');
        return false;
    }

    if (!$("#email").val()) {
        $("#status-form").addClass('error');
        toastr.error('Необходимо заполнить email !');
        return false;
    }
}

//Отправить запрос сохранения заказа
function sendOrderRequest() {
    if (validation() == false) {
        return;
    }

    sendScreenShots();

    data = {
        id: 'shirt',
        user_name: $("#user-name").val(),
        phone: $("#phone").val(),
        email: $("#email").val(),
        comment: $("#comment").val(),
        images: arrayImagesDownload,
        screenShots: arrayScreenShotsDownload,
        sizeShit: $('input[name="sizeShit"]:checked').val(),
    };

    console.log(data)

    $.ajax({
        url: '/registerz.php',
        type: "post",
        dataType: "json",
        async: false,
        data: data,
        success: function (data) {
            console.log(data)
            if (data.success == true) {
                toastr.success(data.message);
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

$(document).on('click', '.add-in-cart', function () {
    sendOrderRequest($(this))
});
$('#flipback').click(function () {
    rotateShit();
}); //БЫЛО перевертывание картинки