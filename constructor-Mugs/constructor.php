<section id="typography">
    <div class="page-header">
        <div class="row text-center">
            <h1 class="text-center" style="text-align: center;">Конструктор Кружек</h1>
        </div>
    </div>

    <br>

    <div class="row justify-content-center">
        <div class="span7">
            <div id="3D-model">

            </div>
        </div>
        <div class="span6">
            <div align="center" style="min-height: 32px;">
                <div class="clearfix">
                    <div class="btn-group inline pull-left" id="texteditor" style="display:none">
                        <button id="font-family" class="btn dropdown-toggle" data-toggle="dropdown" title="Шрифт"><i
                                class="icon-font" style="width:19px;height:19px;"></i></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="font-family-X">
                            <li><a tabindex="-1" href="#" onclick="setFont('Arial');" class="Arial">Arial</a></li>
                            <li><a tabindex="-1" href="#" onclick="setFont('Helvetica');"
                                    class="Helvetica">Helvetica</a></li>
                            <li><a tabindex="-1" href="#" onclick="setFont('Myriad Pro');" class="MyriadPro">Myriad
                                    Pro</a></li>
                            <li><a tabindex="-1" href="#" onclick="setFont('Delicious');"
                                    class="Delicious">Delicious</a></li>
                            <li><a tabindex="-1" href="#" onclick="setFont('Verdana');" class="Verdana">Verdana</a></li>
                            <li><a tabindex="-1" href="#" onclick="setFont('Georgia');" class="Georgia">Georgia</a></li>
                            <li><a tabindex="-1" href="#" onclick="setFont('Courier');" class="Courier">Courier</a></li>
                            <li><a tabindex="-1" href="#" onclick="setFont('Comic Sans MS');" class="ComicSansMS">Comic
                                    Sans MS</a></li>
                            <li><a tabindex="-1" href="#" onclick="setFont('Impact');" class="Impact">Impact</a></li>
                            <li><a tabindex="-1" href="#" onclick="setFont('Monaco');" class="Monaco">Monaco</a></li>
                            <li><a tabindex="-1" href="#" onclick="setFont('Optima');" class="Optima">Optima</a></li>
                            <li><a tabindex="-1" href="#" onclick="setFont('Hoefler Text');"
                                    class="Hoefler Text">Hoefler Text</a></li>
                            <li><a tabindex="-1" href="#" onclick="setFont('Plaster');" class="Plaster">Plaster</a></li>
                            <li><a tabindex="-1" href="#" onclick="setFont('Engagement');"
                                    class="Engagement">Engagement</a></li>
                        </ul>
                        <button id="text-bold" class="btn" data-original-title="Bold"><img src="img/font_bold.png"
                                height="" width=""></button>
                        <button id="text-italic" class="btn" data-original-title="Italic"><img src="img/font_italic.png"
                                height="" width=""></button>
                        <button id="text-strike" class="btn" title="Strike" style=""><img
                                src="img/font_strikethrough.png" height="" width=""></button>
                        <button id="text-underline" class="btn" title="Underline" style=""><img
                                src="img/font_underline.png"></button>
                        <a class="btn" href="#" rel="tooltip" data-placement="top" data-original-title="Цвет текста">
                            <input type="hidden" id="text-fontcolor" class="color-picker" size="7" value="#000000">
                        </a>
                        <a class="btn" href="#" rel="tooltip" data-placement="top" data-original-title="Цвет рамки">
                            <input type="hidden" id="text-strokecolor" class="color-picker" size="7" value="#000000">
                        </a>
                    </div>
                    <div class="pull-right" align="" id="imageeditor" style="display:none">
                        <div class="btn-group">
                            <button class="btn" id="bring-to-front" title="Спереди"><i class="icon-fast-backward rotate"
                                    style="height:19px;"></i></button>
                            <button class="btn" id="send-to-back" title="Send to Back"><i
                                    class="icon-fast-forward rotate" style="height:19px;"></i></button>
                            <button id="flip" type="button" class="btn" title="Show Back View"><i class="icon-retweet"
                                    style="height:19px;"></i></button>
                            <button id="remove-selected" class="btn" title="Delete selected item"><i class="icon-trash"
                                    style="height:19px;"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-danger" id="update-3d-model-2">Применить к 3D модели</button>
            <?
			if (isMobile()) {
				echo ('
					<!--	EDITOR      -->
						<div id="shirtDiv" class="page" style="width: 350px;  position: relative; background-color: rgb(255, 255, 255);"> 
							<img name="tshirtview" id="tshirtFacing" src="img/crew_front.png">
							<div id="drawingArea" style="position: absolute;top: 125px;left: 60px;z-index: 10;width: 225px;height: 96px;">
								<canvas id="tcanvas" width="225" height="96" class="hover" style="-webkit-user-select: none;"></canvas>
							</div>
						</div>
					<!--	/EDITOR		-->
				');
			} else {
				echo ('
					<!--	EDITOR      -->
						<div id="shirtDiv" class="page" style="width: 530px; position: relative; background-color: rgb(255, 255, 255);"> 
							<img name="tshirtview" id="tshirtFacing" src="img/crew_front.png">
							<div id="drawingArea" style="position: absolute;top: 192px;left: 95px;z-index: 10;width: 336px;height: 144px;">
								<canvas id="tcanvas" width="336" height="144" style="-webkit-user-select: none;"></canvas>
							</div>
						</div>
					<!--	/EDITOR		-->
				');
			}

			?>

        </div>
        <div class="span5">
            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab2" data-toggle="tab">Настройки</a></li>
                    <li class=""><a href="#tab1" data-toggle="tab">Готовые картинки</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane " id="tab1">
                        <div class="well">
                            <h5>Готовые решения (нажмите на картинку, что бы применить к кружке)</h5>
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

								foreach ($images as $item) {
									echo '
												<img style="cursor:pointer;" class="img-polaroid" src="' . $item . '" style="max-width:50px;"> 
											';
								}
							?>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane active" id="tab2">
                        <div class="well">
                            <div class="input-append">
                                <input class="span2" id="text-string" type="text" placeholder="Введите текст">
                                <button id="add-text" class="btn" title="Add text"><i class="icon-share-alt"></i>
                                    Добавить</button>
                            </div>
                            <hr>
                            <div>
                                <input type="file" accept="image/*" multiple> <a href="#"
                                    class="upload_files btn btn-primary">Применить выбранную картинку к макету</a> <img
                                    id="blah" src="#" alt="your image" class="img-polaroid2" style="display:none" />
                                <div class="ajax-reply"></div>
                                <br>
                            </div>

                            <!--button class="btn btn-success" id="download">Скачать макет</button-->
                            <button class="btn btn-danger" id="update-3d-model-1">Применить к 3D модели</button>

                            <div class="row ">
                                <div class=" ">
                                    <h5>Заполните данные для обратной связи</h5>
                                    <div class="control-group" id='status-form'>
                                        <input id="user-name" type="text" class="form-control text-center "
                                            style="max-width:500px;" placeholder="Фамилия Имя" required />
                                        <input id="phone" type="text" class="form-control text-center "
                                            style="max-width:500px;" placeholder="(999) 999-99-99" required /><br>
                                        <input id="email" type="text" class="form-control text-center "
                                            style="max-width:500px;" placeholder="example@user.com" required />

                                    </div>

                                    <label for="comment" class="form-label" style='margin-top:10px'>Комментарий к
                                        заказу:</label>
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
    </div>

    <div class="row justify-content-center">


    </div>
    </div>
</section>