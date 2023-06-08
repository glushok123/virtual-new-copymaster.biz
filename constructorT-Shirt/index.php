<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="utf-8">
	<title>Онлаин конструктор Футболок</title>
	<meta name="viewport" content=" initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/fabric.js"></script>
	<link type="text/css" rel="stylesheet" href="css/jquery.miniColors.css" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="https://copymaster.biz/img/favicon.ico" /> </head>
	<link type="text/css" rel="stylesheet" href="css/app.css" />

	<? 
	function isMobile() {
		return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
	}
	?>
<body class="preview" data-spy="scroll" data-target=".subnav" data-offset="80">
	<div class="container">
		<div class="row"> 
			
		
		<a href="https://copymaster.biz">◄ Вернуться на сайт</a> </div>
	</div>
	<div class="container-fluid">
		<section id="typography">
			<div class="page-header">
				<div class="row text-center">
					<h1 class="text-center" style="text-align: center;">Конструктор Футболок</h1> </div>
			</div>

			<br>
			<div class="row justify-content-center">
				<div class="span6">
				<h5>Готовые решения (нажмите на картинку, что бы применить к футболке)</h5>
					<div id="avatarlist"> 
					<?
						$path = './prepare_img/'; // путь к директории с изображениями
						$extensions = array('png', 'jpg', 'JPG', 'jpeg', 'gif'); // показывать расширения
					
						$directoryIterator = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
						$iteratorIterator  = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::LEAVES_ONLY);
					
						$images = [];
						foreach ($iteratorIterator as $file) {
							if (in_array($file->getExtension(), $extensions)) {
								$images[] = $file->getPathname();
							}
						}
																
					?>
					<?
						foreach ($images as $item) {
							echo '
								<img style="cursor:pointer;" class="img-polaroid" src="' . $item . '" style="max-width:50px;"> 
							';
						}
					?>

					</div>
				</div>
				<div class="span6">
					<div> </div>
					<div class="tabbable">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab2" data-toggle="tab">Настройки</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane " id="tab1">
								<div class="well">
									<select id="tshirttype">
										<option value="img/crew_front.png" selected="selected">Short Sleeve Shirts</option>
										<option value="img/mens_longsleeve_front.png">Long Sleeve Shirts</option>
										<option value="img/mens_hoodie_front.png">Hoodies</option>
										<option value="img/mens_tank_front.png">Tank tops</option>
									</select>
								</div>
								<div class="well">
									<ul class="nav">
										<li class="color-preview" title="White" style="background-color:#ffffff;"></li>
										<li class="color-preview" title="Dark Heather" style="background-color:#616161;"></li>
										<li class="color-preview" title="Gray" style="background-color:#f0f0f0;"></li>
										<li class="color-preview" title="Charcoal" style="background-color:#5b5b5b;"></li>
										<li class="color-preview" title="Black" style="background-color:#222222;"></li>
										<li class="color-preview" title="Heather Orange" style="background-color:#fc8d74;"></li>
										<li class="color-preview" title="Heather Dark Chocolate" style="background-color:#432d26;"></li>
										<li class="color-preview" title="Salmon" style="background-color:#eead91;"></li>
										<li class="color-preview" title="Chesnut" style="background-color:#806355;"></li>
										<li class="color-preview" title="Dark Chocolate" style="background-color:#382d21;"></li>
										<li class="color-preview" title="Citrus Yellow" style="background-color:#faef93;"></li>
										<li class="color-preview" title="Avocado" style="background-color:#aeba5e;"></li>
										<li class="color-preview" title="Kiwi" style="background-color:#8aa140;"></li>
										<li class="color-preview" title="Irish Green" style="background-color:#1f6522;"></li>
										<li class="color-preview" title="Scrub Green" style="background-color:#13afa2;"></li>
										<li class="color-preview" title="Teal Ice" style="background-color:#b8d5d7;"></li>
										<li class="color-preview" title="Heather Sapphire" style="background-color:#15aeda;"></li>
										<li class="color-preview" title="Sky" style="background-color:#a5def8;"></li>
										<li class="color-preview" title="Antique Sapphire" style="background-color:#0f77c0;"></li>
										<li class="color-preview" title="Heather Navy" style="background-color:#3469b7;"></li>
										<li class="color-preview" title="Cherry Red" style="background-color:#c50404;"></li>
									</ul>
								</div>
							</div>
							<style>


							</style>
							<div class="tab-pane active" id="tab2">
								<div class="well">
									<div class="input-append">
										<input class="span2" id="text-string" type="text" placeholder="Введите текст">
										<button id="add-text" class="btn" title="Add text"><i class="icon-share-alt"></i> Добавить</button>
									</div>
									<hr>
									<div>
										<input type="file" accept="image/*" multiple> <a href="#" class="upload_files btn btn-primary">Добавить свою картинку</a> <img id="blah" src="#" alt="your image" class="img-polaroid2" style="display:none" />
										<div class="ajax-reply"></div>
										<br>
									</div>

									<div class="row ">
										<h5>Выберите размер</h5>
										<table class="table">
											<tr>
												<td>
													<div class="form-check">
														<input class="form-check-input" type="radio" name="sizeShit" value='S'>
														<label class="form-check-label" for="flexRadioDefault1">
															S
														</label>
													</div>
												</td>
					
												<td>
													<div class="form-check">
														<input class="form-check-input" type="radio" name="sizeShit" value='M'>
														<label class="form-check-label" for="flexRadioDefault1">
															M
														</label>
													</div>
												</td>

												<td>
													<div class="form-check">
														<input class="form-check-input" type="radio" name="sizeShit" value='L'>
														<label class="form-check-label" for="flexRadioDefault1">
															L
														</label>
													</div>
												</td>

												<td>
													<div class="form-check">
														<input class="form-check-input" type="radio" name="sizeShit" value='XL'>
														<label class="form-check-label" for="flexRadioDefault1">
															&emsp;XL
														</label>
													</div>
												</td>

												<td>
												<div class="form-check">
														<input class="form-check-input" type="radio" name="sizeShit" value='XXL'>
														<label class="form-check-label" for="flexRadioDefault1">
															&emsp;XXL
														</label>
													</div>
												</td>
											</tr>
										</table>
										<div class=" ">
											<h5>Заполните данные для обратной связи</h5>
											<div class="control-group" id='status-form'>
												<input id="user-name" type="text" class="form-control text-center "  style="max-width:500px;" placeholder="Фамилия Имя" required />
												<input id="phone" type="text" class="form-control text-center "  style="max-width:500px;" placeholder="(999) 999-99-99" required/><br>
												<input id="email" type="text" class="form-control text-center "  style="max-width:500px;" placeholder="example@user.com" required/>
												
											</div>

											<label for="comment" class="form-label" style='margin-top:10px'>Комментарий к заказу:</label>
											<textarea class="form-control" id="comment" rows="3"></textarea>
										</div>
									</div>

									<div class="row">
										<button class="btn btn-primary add-in-cart">Заказать</button>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="span6" style=''>
					<div align="center" style="min-height: 32px;">
						<div class="clearfix">
							<div class="btn-group inline pull-left" id="texteditor" style="display:none">
								<button id="font-family" class="btn dropdown-toggle" data-toggle="dropdown" title="Шрифт"><i class="icon-font" style="width:19px;height:19px;"></i></button>
								<ul class="dropdown-menu" role="menu" aria-labelledby="font-family-X">
									<li><a tabindex="-1" href="#" onclick="setFont('Arial');" class="Arial">Arial</a></li>
									<li><a tabindex="-1" href="#" onclick="setFont('Helvetica');" class="Helvetica">Helvetica</a></li>
									<li><a tabindex="-1" href="#" onclick="setFont('Myriad Pro');" class="MyriadPro">Myriad Pro</a></li>
									<li><a tabindex="-1" href="#" onclick="setFont('Delicious');" class="Delicious">Delicious</a></li>
									<li><a tabindex="-1" href="#" onclick="setFont('Verdana');" class="Verdana">Verdana</a></li>
									<li><a tabindex="-1" href="#" onclick="setFont('Georgia');" class="Georgia">Georgia</a></li>
									<li><a tabindex="-1" href="#" onclick="setFont('Courier');" class="Courier">Courier</a></li>
									<li><a tabindex="-1" href="#" onclick="setFont('Comic Sans MS');" class="ComicSansMS">Comic Sans MS</a></li>
									<li><a tabindex="-1" href="#" onclick="setFont('Impact');" class="Impact">Impact</a></li>
									<li><a tabindex="-1" href="#" onclick="setFont('Monaco');" class="Monaco">Monaco</a></li>
									<li><a tabindex="-1" href="#" onclick="setFont('Optima');" class="Optima">Optima</a></li>
									<li><a tabindex="-1" href="#" onclick="setFont('Hoefler Text');" class="Hoefler Text">Hoefler Text</a></li>
									<li><a tabindex="-1" href="#" onclick="setFont('Plaster');" class="Plaster">Plaster</a></li>
									<li><a tabindex="-1" href="#" onclick="setFont('Engagement');" class="Engagement">Engagement</a></li>
								</ul>
								<button id="text-bold" class="btn" data-original-title="Bold"><img src="img/font_bold.png" height="" width=""></button>
								<button id="text-italic" class="btn" data-original-title="Italic"><img src="img/font_italic.png" height="" width=""></button>
								<button id="text-strike" class="btn" title="Strike" style=""><img src="img/font_strikethrough.png" height="" width=""></button>
								<button id="text-underline" class="btn" title="Underline" style=""><img src="img/font_underline.png"></button>
								<a class="btn" href="#" rel="tooltip" data-placement="top" data-original-title="Цвет текста">
									<input type="hidden" id="text-fontcolor" class="color-picker" size="7" value="#000000">
								</a>
								<a class="btn" href="#" rel="tooltip" data-placement="top" data-original-title="Цвет рамки">
									<input type="hidden" id="text-strokecolor" class="color-picker" size="7" value="#000000">
								</a>
								<!--- Background <input type="hidden" id="text-bgcolor" class="color-picker" size="7" value="#ffffff"> --->
							</div>
							<div class="pull-right" align="" id="imageeditor" style="display:none">
								<div class="btn-group">
									<button class="btn" id="bring-to-front" title="Спереди"><i class="icon-fast-backward rotate" style="height:19px;"></i></button>
									<button class="btn" id="send-to-back" title="Send to Back"><i class="icon-fast-forward rotate" style="height:19px;"></i></button>
									<button id="flip" type="button" class="btn" title="Show Back View"><i class="icon-retweet" style="height:19px;"></i></button>
									<button id="remove-selected" class="btn" title="Delete selected item"><i class="icon-trash" style="height:19px;"></i></button>
								</div>
							</div>
						</div>
					</div>
					<?
						if (isMobile()) {
							echo('
								<!--	EDITOR      -->
								<button id="flipback" type="button" class="btn" title="Rotate View" data-original-title="Show Back View"><i class="icon-retweet" style="height:19px;"></i></button>
								<div id="shirtDiv" class="page" style="width: 350px; height: 415px; position: relative; background-color: rgb(255, 255, 255);"> <img name="tshirtview" id="tshirtFacing" src="img/crew_front.png">
									<div id="drawingArea" style="position: absolute;top: 70px;left: 106px;z-index: 10;width: 120px;height: 200px;">
										<canvas id="tcanvas" width="120" height="200" class="hover" style="-webkit-user-select: none;"></canvas>
									</div>
								</div>
								<!--					<div id="shirtBack" class="page" style="width: 350px; height: 415px; position: relative; background-color: rgb(255, 255, 255); display:none;">-->
								<!--						<img src="img/crew_back.png"></img>-->
								<!--						<div id="drawingArea" style="position: absolute;top: 70px;left: 106px;z-index: 10;width: 120px;height: 200px;">					-->
								<!--							<canvas id="backCanvas" width="120" height="200" class="hover" style="-webkit-user-select: none;"></canvas>-->
								<!--						</div>-->
								<!--					</div>						-->
								<!--	/EDITOR		-->
							');
						}else{
							echo('
								<!--	EDITOR      -->
								<button id="flipback" type="button" class="btn" title="Rotate View" data-original-title="Show Back View"><i class="icon-retweet" style="height:19px;"></i></button>
								<div id="shirtDiv" class="page" style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255);"> <img name="tshirtview" id="tshirtFacing" src="img/crew_front.png">
									<div id="drawingArea" style="position: absolute;top: 100px;left: 180px;z-index: 10;width: 170px;height: 300px;">
										<canvas id="tcanvas" width="170" height="300" class="hover" style="-webkit-user-select: none;"></canvas>
									</div>
								</div>
								<!--					<div id="shirtBack" class="page" style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255); display:none;">-->
								<!--						<img src="img/crew_back.png"></img>-->
								<!--						<div id="drawingArea" style="position: absolute;top: 100px;left: 180px;z-index: 10;width: 170px;height: 300px;">					-->
								<!--							<canvas id="backCanvas" width="170" height="300" class="hover" style="-webkit-user-select: none;"></canvas>-->
								<!--						</div>-->
								<!--					</div>						-->
								<!--	/EDITOR		-->
							');
						}
					
					?>

				</div>
			</div>
		</div>
		</section>

		<section style="display: none;" id="screen"> </section>
	</div>
	
	<script src="js/app.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/tshirtEditor.js"></script>
	<script type="text/javascript" src="js/jquery.miniColors.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

	<style>
		@media screen and (max-width: 1700px) {
			.span6 {
				width:470px !important;
			}
		}
		@media screen and (max-width: 1600px) {
			.span6 {
				width:420px !important;
			}
		}
		@media screen and (max-width: 1500px) {
			.span6 {
				width:390px !important;
			}
		}
		@media screen and (max-width: 1400px) {
			.span6 {
				width:360px !important;
			}
		}
		@media screen and (max-width: 1300px) {
			.span6 {
				width:310px !important;
			}
		}
		@media screen and (max-width: 900px) {
			.span6 {
				width:100% !important;
			}
			/*#shirtDiv{
				width: 350px !important;
			}
			#drawingArea{
				top: 70px !important;
				left: 106px !important;
				width: 120px !important;
				height: 200px !important;
			}
			#tcanvas, .upper-canvas, .canvas-container{
				width: 120px !important;
				height: 200px !important;
			}*/
		}
		
	</style>
	<script>
		$("#phone").mask("(999) 999-99-99");


		function adaptiveSizePageScaleInit(definedStartWidth) {
			let startWidth = definedStartWidth;
			if (!(startWidth / 1)) {
				let bodyMinWidthStr = getComputedStyle(document.body).minWidth;
				let bodyMinWidthNumber = Number(bodyMinWidthStr.replace(/[^0-9]/g, ""));
				startWidth = bodyMinWidthNumber;
			}
			let firstViewport;
			function setNewMeta(startWidth) {
				let screenWidth = screen.width;
				if (screenWidth <= startWidth) {
				if (!firstViewport) {
					firstViewport = document.querySelector('meta[name="viewport"]');
				}
				let oldViewport = document.querySelector('meta[name="viewport"]');
				let newViewport = document.createElement("meta");
				newViewport.setAttribute("name", "viewport");
				newViewport.setAttribute("content", "width=" + `${startWidth}`);
				document.head.replaceChild(newViewport, oldViewport);
				} else if (firstViewport && document.querySelector('meta[name="viewport"]') != firstViewport) {
				let oldViewport = document.querySelector('meta[name="viewport"]');
				document.head.replaceChild(firstViewport, oldViewport);
				}
			}
			window.addEventListener("resize", function () {
				setNewMeta(startWidth);
			});
			setNewMeta(startWidth);
		}

function startOnSpecificBrowserInit() {
  let userAgent = window.navigator.userAgent.toLowerCase();
  let browser;
  switch (true) {
    case userAgent.indexOf("edge") > -1:
      browser = "msEdge";
      break;
    case userAgent.indexOf("edg/") > -1:
      browser = "chrEdge";
      break;
    case userAgent.indexOf("opr") > -1 && !!window.opr:
      browser = "opera";
      break;
    case userAgent.indexOf("chrome") > -1 && !!window.chrome:
      browser = "сhrome";
      break;
    case userAgent.indexOf("trident") > -1:
      browser = "ie";
      break;
    case userAgent.indexOf("firefox") > -1:
      browser = "firefox";
      break;
    case userAgent.indexOf("safari") > -1:
      browser = "safari";
      break;
    default:
      browser = "other";
  }
  if (browser == "safari" || browser == "firefox") {
    adaptiveSizePageScaleInit();
  }
}

//adaptiveSizePageScaleInit();
//startOnSpecificBrowserInit()

//a = document.getElementsByTagName('body');
//a[0].style.transform = "scale(0.8)";
	</script>
</body>
</html>