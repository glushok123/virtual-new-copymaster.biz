<div class="modal fade" id="obrs" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content radius-30">
            <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body ">

                <br>
                <div class="row text-center justify-content-center">
                    <div class="col-6 col-lg-6 col-xl-6">
                        <h4>Статус</h4>
                        <select id="status_obrs" class="form-control" aria-label=".form-select-lg example">
                            <option selected></option>
                            <option value="Активна">Активна</option>
                            <option value="Отмена">Отмена</option>
                            <option value="Ожидание">Ожидание</option>
                            <option value="Оплачена">Оплачена</option>
                            <option value="Закрыта">Закрыта</option>
                        </select>
                    </div>
                </div>
                <hr>
                <br>
                <h3 class="text-center">Обработка заявки</h3>
                <div class="form-group">
                    <label>ЦЕНА</label>
                    <input id="price_obrs" type="text" class="form-control form-control-lg radius-30">
                </div>
                <div class="form-group">
                    <label>Комментарий</label>
                    <input id="comment_obrs" type="text" class="form-control form-control-lg radius-30">
                </div>
                <div class="form-group">
                    <button id="updatezayiavka_obrs" data-id="0" type="button"
                        class="btn btn-light radius-30 btn-lg btn-block">Отправить</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="vizitkamodal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content radius-30">
            <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="container  text-center justify-content-center">
                    <div class="row">
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4>РАЗМЕР</h4>
                            <select id="sizebum_vizit" class="form-control" aria-label=".form-select-lg example">
                                <option selected></option>
                                <option value="1">85*55</option>
                                <option value="2">90*50</option>
                            </select>
                            </select>
                        </div>
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4><span data-bs-toggle="modal" data-bs-target="#exampleModal2">ТИП БУМАГИ *</span> </h4>
                            <select id="tibum_vizit" class="form-control" aria-label=".form-select-lg example">
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
                    <br>
                    <div class="row">
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4>ЦВЕТНОСТЬ</h4>
                            <select id="cvet_vizit" class="form-control" aria-label=".form-select-lg example">
                                <option selected></option>
                                <option value="9">4+0 (односторонние)</option>
                                <option value="10">4+4 (двусторонние)</option>
                            </select>
                        </div>
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4>КОЛИЧЕСТВО</h4>
                            <select id="kolit_vizit" class="form-control" aria-label=".form-select-lg example">
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
                    <br>
                    <div class="row text-center justify-content-center">
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4>Срочность</h4>
                            <select id="srok_vizit" class="form-control" aria-label=".form-select-lg example">
                                <option selected></option>
                                <option value="18">Не срочно (один рабочий день)</option>
                                <option value="19">В течении 4 часов</option>
                            </select>
                        </div>

                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4>Статус</h4>
                            <select id="status_vizit" class="form-control" aria-label=".form-select-lg example">
                                <option selected></option>
                                <option value="Активна">Активна</option>
                                <option value="Отмена">Отмена</option>
                                <option value="Ожидание">Ожидание</option>
                                <option value="Оплачена">Оплачена</option>
                                <option value="Закрыта">Закрыта</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <br>
                <h3 class="text-center">Обработка заявки</h3>
                <div class="form-group">
                    <label>ЦЕНА</label>
                    <input id="price_vizit" type="text" class="form-control form-control-lg radius-30">
                </div>
                <div class="form-group">
                    <label>Комментарий</label>
                    <input id="comment_vizit" type="text" class="form-control form-control-lg radius-30">
                </div>

                <div class="form-group">
                    <button id="updatezayiavka_vizit" data-id="0" type="button"
                        class="btn btn-light radius-30 btn-lg btn-block">Отправить</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="listovmodal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content radius-30">
            <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="container  text-center justify-content-center">
                    <div class="row">
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4>РАЗМЕР</h4>
                            <select id="sizebum_listov" class="form-control" aria-label=".form-select-lg example">
                                <option selected></option>
                                <option value="1">10,5x15 см (A6)</option>
                                <option value="2">10x20 см (1/3 A4)</option>
                                <option value="3">15x20 см (A5)</option>
                                <option value="4">21x30 см (A4)</option>
                                <option value="5">90*50</option>
                            </select>
                            </select>
                        </div>
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4><span data-bs-toggle="modal" data-bs-target="#exampleModal2">ТИП БУМАГИ *</span> </h4>
                            <select id="tibum_listov" class="form-control" aria-label=".form-select-lg example">
                                <option selected></option>
                                <option value="6">Мелованная бумага 130 гр.</option>
                                <option value="7">Мелованная бумага 170 гр.</option>
                                <option value="8">Мелованная бумага 250 гр.</option>
                                <option value="9">Мелованная бумага 300 гр.</option>

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4>ЦВЕТНОСТЬ</h4>
                            <select id="cvet_listov" class="form-control" aria-label=".form-select-lg example">
                                <option selected></option>
                                <option value="10">4+0 (односторонние)</option>
                                <option value="11">4+4 (двусторонние)</option>
                            </select>
                        </div>
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4>КОЛИЧЕСТВО</h4>
                            <select id="kolit_listov" class="form-control" aria-label=".form-select-lg example">
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
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4>Срочность</h4>
                            <select id="srok_listov" class="form-control" aria-label=".form-select-lg example">
                                <option selected></option>
                                <option value="19">Не срочно (один рабочий день)</option>
                                <option value="20">В течении 4 часов</option>
                            </select>
                        </div>
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4>Статус</h4>
                            <select id="status_listov" class="form-control" aria-label=".form-select-lg example">
                                <option selected></option>
                                <option value="Активна">Активна</option>
                                <option value="Отмена">Отмена</option>
                                <option value="Ожидание">Ожидание</option>
                                <option value="Оплачена">Оплачена</option>
                                <option value="Закрыта">Закрыта</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <br>
                <h3 class="text-center">Обработка заявки</h3>
                <div class="form-group">
                    <label>ЦЕНА</label>
                    <input id="price_listov" type="text" class="form-control form-control-lg radius-30">
                </div>
                <div class="form-group">
                    <label>Комментарий</label>
                    <input id="comment_listov" type="text" class="form-control form-control-lg radius-30">
                </div>
                <div class="form-group">
                    <button id="updatezayiavka_listov" data-id="0" type="button"
                        class="btn btn-light radius-30 btn-lg btn-block">Отправить</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="petchatmodal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content radius-30">
            <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="container  text-center justify-content-center">
                    <div class="row">
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4>Печати</h4>
                            <select id="petchat_tip_petchat" class="form-control" aria-label=".form-select-lg example">
                                <option selected></option>
                                <option value="1">Первичная печать</option>
                                <option value="2">Печать по оттиску</option>
                            </select>
                            </select>
                        </div>
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4><span data-bs-toggle="modal" data-bs-target="#exampleModal2">Оснастка</span> </h4>
                            <select id="osnastka_petchat" class="form-control" aria-label=".form-select-lg example">
                                <option selected></option>
                                <option value="3">Автоматическая оснастка</option>
                                <option value="4">Ручная (пешка)</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4>Автоматическая оснастка</h4>
                            <select id="avt_osnastka_petchat" class="form-control" aria-label=".form-select-lg example">
                                <option value="0" selected>-</option>
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

                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4>Срочность</h4>
                            <select id="srok_petchat" class="form-control" aria-label=".form-select-lg example">
                                <option selected></option>
                                <option value="15">Не срочно (один рабочий день)</option>
                                <option value="16">В течении 4 часов</option>
                                <option value="17">В течении часа</option>
                            </select>
                        </div>

                    </div>
                    <br>
                    <div class="row text-center justify-content-center">
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4>Статус</h4>
                            <select id="status_petchat" class="form-control" aria-label=".form-select-lg example">
                                <option selected></option>
                                <option value="Активна">Активна</option>
                                <option value="Отмена">Отмена</option>
                                <option value="Ожидание">Ожидание</option>
                                <option value="Оплачена">Оплачена</option>
                                <option value="Закрыта">Закрыта</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <h3 class="text-center">Обработка заявки</h3>
                    <div class="form-group">
                        <label>ЦЕНА</label>
                        <input id="price_petchat" type="text" class="form-control form-control-lg radius-30">
                    </div>
                    <div class="form-group">
                        <label>Комментарий</label>
                        <input id="comment_petchat" type="text" class="form-control form-control-lg radius-30">
                    </div>
                    <div class="form-group">
                        <button id="updatezayiavka_petchat" data-id="0" type="button"
                            class="btn btn-light radius-30 btn-lg btn-block">Отправить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="petchatfotomodal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content radius-30">
            <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="container  text-center justify-content-center">
                    <div class="row">
                        <div class="col-12 col-lg-6 col-xl-6">
                            <h4>РАЗМЕР</h4>
                            <select id="sizebum_petchatfoto" class="form-control" aria-label=".form-select-lg example">
                                <option selected></option>
                                <option value="1">10x15 см (A6)</option>
                                <option value="2">15x20 см (A5)</option>
                                <option value="3">21x30 см (A4)</option>
                            </select>
                            </select>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-6">
                            <h4><span data-bs-toggle="modal" data-bs-target="#exampleModal2">ТИП БУМАГИ</span> </h4>
                            <select id="tibum_petchatfoto" class="form-control" aria-label=".form-select-lg example">
                                <option selected></option>
                                <option value="4">Матовая</option>
                                <option value="5">Глянцевая</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12 col-lg-6 col-xl-6">
                            <h4>Срочность</h4>
                            <select id="srok_petchatfoto" class="form-control" aria-label=".form-select-lg example">
                                <option selected></option>
                                <option value="6">Не срочно (один рабочий день)</option>
                                <option value="7">В течении 4 часов</option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-6">
                            <h4>КОЛИЧЕСТВО</h4>
                            <input id="kolit_petchatfoto" type="text" class="form-control form-control-lg radius-30 "
                                placeholder="100" />
                        </div>
                    </div>

                    <br>
                    <div class="row text-center justify-content-center">
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4>Статус</h4>
                            <select id="status_petchatfoto" class="form-control" aria-label=".form-select-lg example">
                                <option selected></option>
                                <option value="Активна">Активна</option>
                                <option value="Отмена">Отмена</option>
                                <option value="Ожидание">Ожидание</option>
                                <option value="Оплачена">Оплачена</option>
                                <option value="Закрыта">Закрыта</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <br>
                <h3 class="text-center">Обработка заявки</h3>
                <div class="form-group">
                    <label>ЦЕНА</label>
                    <input id="price_petchatfoto" type="text" class="form-control form-control-lg radius-30">
                </div>
                <div class="form-group">
                    <label>Комментарий</label>
                    <input id="comment_petchatfoto" type="text" class="form-control form-control-lg radius-30">
                </div>
                <div class="form-group">
                    <button id="updatezayiavka_petchatfoto" data-id="0" type="button"
                        class="btn btn-light radius-30 btn-lg btn-block">Отправить</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="shtender" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content radius-30">
            <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="container  text-center justify-content-center">
                    <div class="row">
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4>ФИО_1</h4>
                            <input id="shtend_name1" type="text" class="form-control form-control-lg radius-30"><br>
                            <h4>Звание_1</h4>
                            <input id="shtend_zv1" type="text" class="form-control form-control-lg radius-30"><br>
                            <h4>Год_1</h4>
                            <input id="shtend_ye1" type="text" class="form-control form-control-lg radius-30"><br>
                            <div class="row">
                                <div class="col-6 col-lg-6 col-xl-6">
                                    <a class="form-control form-control-lg radius-30" target="_blank"
                                        id="url_photo1img_show">Посмотреть ФОТО_1</a>
                                </div>
                                <div class="col-6 col-lg-6 col-xl-6">
                                    <a class="form-control form-control-lg radius-30" href="#"
                                        id="url_photo1img">Загрузить ФОТО_1</a>
                                </div>
                            </div>

                        </div>
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h4>ФИО_2</h4>
                            <input id="shtend_name2" type="text" class="form-control form-control-lg radius-30"><br>
                            <h4>Звание_2</h4>
                            <input id="shtend_zv2" type="text" class="form-control form-control-lg radius-30"><br>
                            <h4>Год_2</h4>
                            <input id="shtend_ye2" type="text" class="form-control form-control-lg radius-30"><br>
                            <div class="row">
                                <div class="col-6 col-lg-6 col-xl-6">
                                    <a class="form-control form-control-lg radius-30" target="_blank"
                                        id="url_photo2img_show">Посмотреть ФОТО_2</a>
                                </div>
                                <div class="col-6 col-lg-6 col-xl-6">
                                    <a class="form-control form-control-lg radius-30" id="url_photo2img">Загрузить
                                        ФОТО_2</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-6 col-lg-6 col-xl-6">
                            <a class="form-control form-control-lg radius-30" target="_blank"
                                id="url_screenimg_show">Посмотреть Скрин</a>
                        </div>
                        <div class="col-6 col-lg-6 col-xl-6">
                            <a class="form-control form-control-lg radius-30" href="#" id="url_screenimg">Загрузить
                                Скрин</a>
                        </div>
                    </div>
                    <hr>

                    <div class="row">

                        <div class="col-4 col-lg-4 col-xl-4">
                            <h4>Формат</h4>
                            <input id="shtend_format" type="text" class="form-control form-control-lg radius-30"><br>
                        </div>
                        <div class="col-4 col-lg-4 col-xl-4">
                            <h4>Шаблон</h4>
                            <input id="shtend_template" type="text" class="form-control form-control-lg radius-30"><br>
                        </div>


                        <div class="col-4col-lg-4col-xl-4">
                            <h4>Ретуш, рестав.</h4>
                            <input id="shtend_flret" type="text" class="form-control form-control-lg radius-30"><br>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row text-center justify-content-center">
                    <div class="col-6 col-lg-6 col-xl-6">
                        <h4>Статус</h4>
                        <select id="status_shtend" class="form-control" aria-label=".form-select-lg example">
                            <option selected></option>
                            <option value="Активна">Активна</option>
                            <option value="Отмена">Отмена</option>
                            <option value="Ожидание">Ожидание</option>
                            <option value="Оплачена">Оплачена</option>
                            <option value="Закрыта">Закрыта</option>
                        </select>
                    </div>
                </div>
                <hr>
                <br>
                <h3 class="text-center">Обработка заявки</h3>
                <div class="form-group">
                    <label>ЦЕНА</label>
                    <input id="price_shtend" type="text" class="form-control form-control-lg radius-30">
                </div>
                <div class="form-group">
                    <label>Комментарий</label>
                    <input id="comment_shtend" type="text" class="form-control form-control-lg radius-30">
                </div>
                <div class="form-group">
                    <button id="updatezayiavka_shtend" data-id="0" type="button"
                        class="btn btn-light radius-30 btn-lg btn-block">Отправить</button>
                </div>
            </div>
        </div>
    </div>
</div>