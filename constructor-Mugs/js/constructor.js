import * as THREE from 'https://cdn.jsdelivr.net/npm/three@0.125/build/three.module.js';
import {
    OrbitControls
} from 'https://cdn.jsdelivr.net/npm/three@0.125/examples/jsm/controls/OrbitControls.js';
import {
    GLTFLoader
} from 'https://cdn.jsdelivr.net/npm/three@0.125/examples/jsm/loaders/GLTFLoader.js';
import {
    RGBELoader
} from 'https://cdn.jsdelivr.net/npm/three@0.125/examples/jsm/loaders/RGBELoader.js';

import { RoomEnvironment } from 'https://cdn.jsdelivr.net/npm/three@0.125/examples/jsm/environments/RoomEnvironment.js';
import { KTX2Loader } from 'https://cdn.jsdelivr.net/npm/three@0.125/examples/jsm/loaders/KTX2Loader.js';
import { MeshoptDecoder } from 'https://cdn.jsdelivr.net/npm/three@0.125/examples/jsm/libs/meshopt_decoder.module.js';

var container, controls;
var camera, scene, renderer, mixer, clock;

init();
animate();

function init(img = null) {
    $('#3D-model').html(' ')
    container = document.getElementById('3D-model');

    camera = new THREE.PerspectiveCamera(75, widthDiv/heightDiv, 0.1, 1000);
    camera.position.set(3, 2.6, 2);
    scene = new THREE.Scene();
    clock = new THREE.Clock();

    const grid = new THREE.GridHelper( 5, 5, 0xffffff, 0xffffff );
    grid.material.opacity = 0.5;
    grid.material.depthWrite = false;
    grid.material.transparent = true;
    scene.add( grid );

    const color = 0xFFFFFF;
    const intensity = 0.1;
    const light = new THREE.AmbientLight(color, intensity);
    scene.add(light);

    renderer = new THREE.WebGLRenderer({
        antialias: true
    });
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setSize(widthDiv, heightDiv);
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 0.8;
    renderer.outputEncoding = THREE.sRGBEncoding;
    container.appendChild(renderer.domElement);

    new RGBELoader()
        .setDataType(THREE.FloatType)
        .setPath('https://threejs.org/examples/textures/equirectangular/')
        .load('royal_esplanade_1k.hdr', function (texture) {

            var envMap = pmremGenerator.fromEquirectangular(texture).texture;
            scene.environment = envMap;
            scene.background = new THREE.Color( 0x323232 );
            texture.flipY = false;
            texture.dispose();

            pmremGenerator.dispose();

            // model
            var loader = new GLTFLoader();
            loader.load('model.gltf', function (gltf) {
                console.log(gltf)

                mixer = new THREE.AnimationMixer(gltf.scene);
                gltf.animations.forEach((clip) => {
                    mixer.clipAction(clip).play();
                });

                gltf.scene.traverse(function (child) {
                    if (child.isMesh) {
                        child.material.envMap = envMap;
                    }
                });

                if (img != null) {
                    var tex = new THREE.TextureLoader().load(img);
                    tex.anisotropy = 100; // for glTF models.
                    tex.flipY = false; // for glTF models.

                    let k = 0
                    gltf.scene.traverse(function (child) {
                        if (k == 3) { //3
                            child.material.map = tex;
                        }
                        k = k + 1
                    })
                }
                gltf.scene.position.y = 1.2;

                scene.add(gltf.scene);
            });
        });



    var pmremGenerator = new THREE.PMREMGenerator(renderer);
    pmremGenerator.compileEquirectangularShader();

    controls = new OrbitControls(camera, renderer.domElement);
    controls.minDistance = 2;
    controls.maxDistance = 10
    controls.target.set(0, 0, -0.2);
    controls.update();

    window.addEventListener('resize', onWindowResize, false);

}

function onWindowResize() {
    camera.aspect = widthDiv/heightDiv;
    camera.updateProjectionMatrix();
    renderer.setSize(widthDiv, heightDiv);
}

function animate() {
    requestAnimationFrame(animate);
    var delta = clock.getDelta();
    if (mixer) mixer.update(delta);
    renderer.render(scene, camera);
}

function GetCanvasAtResoution(scaleMultiplier) {
    var objects = canvas.getObjects();

    for (var i in objects) {
        objects[i].scaleX = objects[i].scaleX * scaleMultiplier;
        objects[i].scaleY = objects[i].scaleY * scaleMultiplier;
        objects[i].left = objects[i].left * scaleMultiplier;
        objects[i].top = (objects[i].top) * scaleMultiplier;
        objects[i].setCoords();
    }

    canvas.discardActiveObject();
    canvas.setWidth(canvas.getWidth() * scaleMultiplier);
    canvas.setHeight(canvas.getHeight() * scaleMultiplier);
    canvas.renderAll();
    canvas.calcOffset();
}

document.getElementById('download').addEventListener('click', function (e) {
    GetCanvasAtResoution(3)
    let canvasUrl = canvas.toDataURL("image/jpeg");
    const createEl = document.createElement('a');
    createEl.href = canvasUrl;
    createEl.download = "download-this-canvas";
    createEl.click();
    createEl.remove();
    GetCanvasAtResoution(0.3333)
});

function update3DModel() {
    GetCanvasAtResoution(3)
    let canvasUrl = canvas.toDataURL("image/jpg");
    GetCanvasAtResoution(0.3333)

    $.ajax({
        url: "/constructor-Mugs/phpModules/uploadScreen.php",
        type: "post",
        dataType: "json",
        async: false,
        data: {
            image: canvasUrl
        },
        success: function (data) {
            init('phpModules/' + data.name);
            animate();
        }
    });
}

document.getElementById('update-3d-model-1').addEventListener('click', function (e) {
    update3DModel()
});
document.getElementById('update-3d-model-2').addEventListener('click', function (e) {
    update3DModel()
});

$("#phone").mask("+7 (999) 999-99-99");

//#######################################################
var canvas;
var tshirts = new Array(); //prototype: [{style:'x',color:'white',front:'a',back:'b',price:{tshirt:'12.95',frontPrint:'4.99',backPrint:'4.99',total:'22.47'}}]
var a;
var b;
var line1;
var line2;
var line3;
var line4;

$(document).ready(function () {
	//setup front side canvas 
	canvas = new fabric.Canvas('tcanvas', {
		hoverCursor: 'pointer',
		selection: true,
		selectionBorderColor: 'blue'
	});
	let ctx = canvas.getContext('2d');

	canvas.on({
		'object:moving': function (e) {
			e.target.opacity = 0.5;
		},
		'object:modified': function (e) {
			e.target.opacity = 1;
		},
		'object:selected': onObjectSelected,
		'selection:cleared': onSelectedCleared
	});
	// piggyback on `canvas.findTarget`, to fire "object:over" and "object:out" events
	canvas.findTarget = (function (originalFn) {
		return function () {
			var target = originalFn.apply(this, arguments);
			if (target) {
				if (this._hoveredTarget !== target) {
					canvas.fire('object:over', {
						target: target
					});
					if (this._hoveredTarget) {
						canvas.fire('object:out', {
							target: this._hoveredTarget
						});
					}
					this._hoveredTarget = target;
				}
			} else if (this._hoveredTarget) {
				canvas.fire('object:out', {
					target: this._hoveredTarget
				});
				this._hoveredTarget = null;
			}
			return target;
		};
	})(canvas.findTarget);

	canvas.on('object:over', function (e) {
		//e.target.setFill('red');
		//canvas.renderAll();
	});

	canvas.on('object:out', function (e) {
		e.target.setFill('green');
		canvas.renderAll();
	});

	document.getElementById('add-text').onclick = function () {
		var text = $("#text-string").val();
		var textSample = new fabric.Text(text, {
			left: fabric.util.getRandomInt(0, 100),
			top: fabric.util.getRandomInt(0, 200),
			fontFamily: 'helvetica',
			angle: 0,
			fill: '#000000',
			scaleX: 1,
			scaleY: 1,
			fontWeight: '',
			hasRotatingPoint: true
		});
		canvas.add(textSample);
		canvas.item(canvas.item.length - 1).hasRotatingPoint = true;
		$("#texteditor").css('display', 'block');
		$("#imageeditor").css('display', 'block');
		update3DModel();
	};
	$("#text-string").keyup(function () {
		var activeObject = canvas.getActiveObject();
		if (activeObject && activeObject.type === 'text') {
			activeObject.text = this.value;
			canvas.renderAll();
		}
	});

	function clearCanvas() {
		/*
			let obj = canvas.getObjects()
			obj.forEach(function(object) {
		        canvas.remove(object);
		    });
			*/
	}

	$(".img-polaroid").click(function (e) {
		var el = e.target;
		/*temp code*/
		var offset = 25;
		var left = fabric.util.getRandomInt(0 + offset, 120 - offset);
		var top = 70 //fabric.util.getRandomInt(0 + offset, 150 - offset);
		var angle = fabric.util.getRandomInt(-20, 40);
		var width = fabric.util.getRandomInt(30, 50);
		var opacity = (function (min, max) {
			return Math.random() * (max - min) + min;
		})(0.5, 1);

		clearCanvas();

		fabric.Image.fromURL(el.src, function (image) {
			var elWidth = image.naturalWidth || image.width;
			var elHeight = image.naturalHeight || image.height;
			let k = canvas.height / image.height;
			image.set({
				left: left,
				top: top,
				angle: 0,
				//padding: 10,
				//cornersize: 10,
				hasRotatingPoint: true,
				scaleX: 1 / elWidth,
				scaleY: 1 / elHeight
				//scaleY: k,
				//scaleX: k ,
			});
			//image.scale(getRandomNum(0.1, 0.25)).setCoords();
			//image.scale(1)
			//canvas.add(image);
			canvas.add(image).renderAll();
		});

		update3DModel()
	});
	document.getElementById('remove-selected').onclick = function () {
		var activeObject = canvas.getActiveObject(),
			activeGroup = canvas.getActiveGroup();
		if (activeObject) {
			canvas.remove(activeObject);
			$("#text-string").val("");
		} else if (activeGroup) {
			var objectsInGroup = activeGroup.getObjects();
			canvas.discardActiveGroup();
			objectsInGroup.forEach(function (object) {
				canvas.remove(object);
			});
		}
	};
	document.getElementById('bring-to-front').onclick = function () {
		var activeObject = canvas.getActiveObject(),
			activeGroup = canvas.getActiveGroup();
		if (activeObject) {
			activeObject.bringToFront();
		} else if (activeGroup) {
			var objectsInGroup = activeGroup.getObjects();
			canvas.discardActiveGroup();
			objectsInGroup.forEach(function (object) {
				object.bringToFront();
			});
		}
	};
	document.getElementById('send-to-back').onclick = function () {
		var activeObject = canvas.getActiveObject(),
			activeGroup = canvas.getActiveGroup();
		if (activeObject) {
			activeObject.sendToBack();
		} else if (activeGroup) {
			var objectsInGroup = activeGroup.getObjects();
			canvas.discardActiveGroup();
			objectsInGroup.forEach(function (object) {
				object.sendToBack();
			});
		}
	};
	$("#text-bold").click(function () {
		var activeObject = canvas.getActiveObject();
		if (activeObject && activeObject.type === 'text') {
			activeObject.fontWeight = (activeObject.fontWeight == 'bold' ? '' : 'bold');
			canvas.renderAll();
		}
	});
	$("#text-italic").click(function () {
		var activeObject = canvas.getActiveObject();
		if (activeObject && activeObject.type === 'text') {
			activeObject.fontStyle = (activeObject.fontStyle == 'italic' ? '' : 'italic');
			canvas.renderAll();
		}
	});
	$("#text-strike").click(function () {
		var activeObject = canvas.getActiveObject();
		if (activeObject && activeObject.type === 'text') {
			activeObject.textDecoration = (activeObject.textDecoration == 'line-through' ? '' : 'line-through');
			canvas.renderAll();
		}
	});
	$("#text-underline").click(function () {
		var activeObject = canvas.getActiveObject();
		if (activeObject && activeObject.type === 'text') {
			activeObject.textDecoration = (activeObject.textDecoration == 'underline' ? '' : 'underline');
			canvas.renderAll();
		}
	});
	$("#text-left").click(function () {
		var activeObject = canvas.getActiveObject();
		if (activeObject && activeObject.type === 'text') {
			activeObject.textAlign = 'left';
			canvas.renderAll();
		}
	});
	$("#text-center").click(function () {
		var activeObject = canvas.getActiveObject();
		if (activeObject && activeObject.type === 'text') {
			activeObject.textAlign = 'center';
			canvas.renderAll();
		}
	});
	$("#text-right").click(function () {
		var activeObject = canvas.getActiveObject();
		if (activeObject && activeObject.type === 'text') {
			activeObject.textAlign = 'right';
			canvas.renderAll();
		}
	});
	$("#font-family").change(function () {
		var activeObject = canvas.getActiveObject();
		if (activeObject && activeObject.type === 'text') {
			activeObject.fontFamily = this.value;
			canvas.renderAll();
		}
	});
	$('#text-bgcolor').miniColors({
		change: function (hex, rgb) {
			var activeObject = canvas.getActiveObject();
			if (activeObject && activeObject.type === 'text') {
				activeObject.backgroundColor = this.value;
				canvas.renderAll();
			}
		},
		open: function (hex, rgb) {
			//
		},
		close: function (hex, rgb) {
			//
		}
	});
	$('#text-fontcolor').miniColors({
		change: function (hex, rgb) {
			var activeObject = canvas.getActiveObject();
			if (activeObject && activeObject.type === 'text') {
				activeObject.fill = this.value;
				canvas.renderAll();
			}
		},
		open: function (hex, rgb) {
			//
		},
		close: function (hex, rgb) {
			//
		}
	});

	$('#text-strokecolor').miniColors({
		change: function (hex, rgb) {
			var activeObject = canvas.getActiveObject();
			if (activeObject && activeObject.type === 'text') {
				activeObject.strokeStyle = this.value;
				canvas.renderAll();
			}
		},
		open: function (hex, rgb) {
			//
		},
		close: function (hex, rgb) {
			//
		}
	});

	//canvas.add(new fabric.fabric.Object({hasBorders:true,hasControls:false,hasRotatingPoint:false,selectable:false,type:'rect'}));
	/*$("#drawingArea").hover(
	        function() { 	        	
	        	 canvas.add(line1);
		         canvas.add(line2);
		         canvas.add(line3);
		         canvas.add(line4); 
		         canvas.renderAll();
	        },
	        function() {	        	
	        	 canvas.remove(line1);
		         canvas.remove(line2);
		         canvas.remove(line3);
		         canvas.remove(line4);
		         canvas.renderAll();
	        }
	    );*/

	$('.color-preview').click(function () {
		var color = $(this).css("background-color");
		document.getElementById("shirtDiv").style.backgroundColor = color;
	});

	$('#flip').click(
		function () {
			if ($(this).attr("data-original-title") == "Show Back View") {
				$(this).attr('data-original-title', 'Show Front View');
				$("#tshirtFacing").attr("src", "img/crew_back.png");
				a = JSON.stringify(canvas);
				canvas.clear();
				try {
					var json = JSON.parse(b);
					canvas.loadFromJSON(b);
				} catch (e) {}

			} else {
				$(this).attr('data-original-title', 'Show Back View');
				$("#tshirtFacing").attr("src", "img/crew_front.png");
				b = JSON.stringify(canvas);
				canvas.clear();
				try {
					var json = JSON.parse(a);
					canvas.loadFromJSON(a);
				} catch (e) {}
			}
			canvas.renderAll();
			setTimeout(function () {
				canvas.calcOffset();
			}, 200);
		});
	$(".clearfix button,a").tooltip();
	line1 = new fabric.Line([0, 0, 200, 0], {
		"stroke": "#000000",
		hasBorders: true,
		hasControls: false,
		hasRotatingPoint: false,
		selectable: false
	});
	line2 = new fabric.Line([199, 0, 200, 399], {
		"stroke": "#000000",
		hasBorders: true,
		hasControls: false,
		hasRotatingPoint: false,
		selectable: false
	});
	line3 = new fabric.Line([0, 0, 0, 400], {
		"stroke": "#000000",
		hasBorders: true,
		hasControls: false,
		hasRotatingPoint: false,
		selectable: false
	});
	line4 = new fabric.Line([0, 400, 200, 399], {
		"stroke": "#000000",
		hasBorders: true,
		hasControls: false,
		hasRotatingPoint: false,
		selectable: false
	});
}); //doc ready


function getRandomNum(min, max) {
	return Math.random() * (max - min) + min;
}

function onObjectSelected(e) {
	var selectedObject = e.target;
	$("#text-string").val("");
	selectedObject.hasRotatingPoint = true
	if (selectedObject && selectedObject.type === 'text') {
		//display text editor	    	
		$("#texteditor").css('display', 'block');
		$("#text-string").val(selectedObject.getText());
		$('#text-fontcolor').miniColors('value', selectedObject.fill);
		$('#text-strokecolor').miniColors('value', selectedObject.strokeStyle);
		$("#imageeditor").css('display', 'block');
	} else if (selectedObject && selectedObject.type === 'image') {
		//display image editor
		$("#texteditor").css('display', 'none');
		$("#imageeditor").css('display', 'block');
	}
}

function onSelectedCleared(e) {
	$("#texteditor").css('display', 'none');
	$("#text-string").val("");
	$("#imageeditor").css('display', 'none');
	update3DModel()
}

function setFont(font) {
	var activeObject = canvas.getActiveObject();
	if (activeObject && activeObject.type === 'text') {
		activeObject.fontFamily = font;
		canvas.renderAll();
	}
}

function removeWhite() {
	var activeObject = canvas.getActiveObject();
	if (activeObject && activeObject.type === 'image') {
		activeObject.filters[2] = new fabric.Image.filters.RemoveWhite({
			hreshold: 100,
			distance: 10
		}); //0-255, 0-255
		activeObject.applyFilters(canvas.renderAll.bind(canvas));
	}
}


//######################################

var arrayImagesDownload = [] // Все загруженные картинки пользователей
var arrayScreenShotsDownload = [] //Скриншоты спереди и с зади

//кнопка создания скриншота
$('#take_screenshoot').click(function () {
    sendScreenShots()
});

// Отправка скриншотов
function sendScreenShots() {
    createScreenShots();
}

//Создание скриншота 
function createScreenShots() {
    window.open(canvas.toDataURL('image/png'));
    html2canvas(document.querySelector("#drawingArea")).then(canvas => {
        document.querySelector("#screen").appendChild(canvas);
        dataURL = canvas.toDataURL('image/png', 2.0);
        post_data(dataURL);
    });
}

//Отправка скриншота на сервер
function post_data(imageURL) {
    $.ajax({
        url: "/constructor-Mugs/phpModules/uploadScreen.php",
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
        url: '/constructor-Mugs/phpModules/uploadImage.php',
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
                $('#blah').attr('src', '/constructor-Mugs/phpModules/uploads/' + respond.name);
                $('#blah').trigger('click')
                $('.ajax-reply').html(html);
                arrayImagesDownload.push('/constructor-Mugs/phpModules/uploads/' + respond.name)
                
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
    /*
    let obj = canvas.getObjects()
    obj.forEach(function(object) {
        canvas.remove(object);
    });
    */
}
//событие клика по загруженной картинке, для применения к футболке
$(".img-polaroid2").click(function (e) {
    var el = e.target;
    var offset = 25;
    var left = fabric.util.getRandomInt(0 + offset, 200 - offset);
    var top = fabric.util.getRandomInt(0 + offset, 150 - offset);
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
            //padding: 10,
            //cornersize: 10,
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
