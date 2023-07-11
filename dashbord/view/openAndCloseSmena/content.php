<div class="container">
    <br>
    <hr>

    <div class='row text-center'>
        <h2 class='mx-auto'>Отчёт по сменам</h2>
    </div>

    <div class='row text-center'>
        <span class='mx-auto'>При открытии новой смены, предыдущая закроется автоматически! </span>
    </div>

    <hr>
    <div class='row text-center mx-auto justify-content-center'>
        <button type="button" class="btn btn-outline-success mx-3" style="color:white;" data-toggle="modal"
            data-target="#exampleModal">Открыть смену
        </button>
        <button type="button" class="btn btn-outline-success mx-3" style="color:white;" data-toggle="modal"
            data-target="#addMaterialModal">Добавить приход
        </button>
    </div>
    <hr>
</div>

<div class='container-fluid'>
    <div class='row'>
        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
            <ul class="nav nav-tabs ">
                <li class="nav-item">
                    <a class="nav-link custom-tab-link active " data-toggle="tab" href="#a">Отчет по сменам</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-tab-link" data-toggle="tab" href="#b">Отчёт по приходам</a>
                </li>

            </ul>
        </div>
        <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
            <div class="tab-content text-center">
                <div class="tab-pane fade show active" id="a">
                    <div class="container">
                        <div class='text-center'>
                            <hr>
                            <h3>Отчет по сменам</h3>
                            <hr>
                        </div>
                        <table id="table" class="table table-striped table-bordered table-sm text-center table-dark"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Тип смены</th>
                                    <th>Дата открытия</th>
                                    <th>Дата закрытия</th>
                                    <th>Остатки в начале смены</th>
                                    <!--th>Остатки в конце смены</th-->
                                    <th>Пользователь</th>
                                </tr>
                            </thead>
                            <tbody class="table-striped">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="b">
                    <div class="container">
                        <div class='text-center'>
                            <hr>
                            <h3>Отчёт по приходам</h3>
                            <hr>
                        </div>
                        <table id="table-material"
                            class="table table-striped table-bordered table-sm text-center table-dark"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Дата</th>
                                    <th>Приход</th>
                                    <th>Пользователь</th>
                                </tr>
                            </thead>
                            <tbody class="table-striped">

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>