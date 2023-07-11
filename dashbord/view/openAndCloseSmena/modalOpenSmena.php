<!-- Модальное окно -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Открытие смены</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id='form-open-smena'>

                    <select name="formOpenType" class="form-control" aria-label=".form-select-lg example">
                        <option> Выберите Тип смены</option>
                        <option value="День">День</option>
                        <option value="ночь">ночь</option>
                    </select>

                    <hr>
                    <table class="table">
                        <tr>
                            <td>Тип</td>
                            <td>Количество</td>
                        </tr>
                        <tr>
                            <td>594</td>
                            <td><input class="form-control" type="number" name='type_594'></td>
                        </tr>
                        <tr>
                            <td>914</td>
                            <td><input class="form-control" type="number" name='type_914'></td>
                        </tr>
                        <tr>
                            <td>610(м)</td>
                            <td><input class="form-control" type="number" name='type_610_m'></td>
                        </tr>
                        <tr>
                            <td>841</td>
                            <td><input class="form-control" type="number" name='type_841'></td>
                        </tr>
                        <tr>
                            <td>1060 (м)</td>
                            <td><input class="form-control" type="number" name='type_1060_м'></td>
                        </tr>
                        <tr>
                            <td>420</td>
                            <td><input class="form-control" type="number" name='type_420'></td>
                        </tr>
                        <tr>
                            <td>297</td>
                            <td><input class="form-control" type="number" name='type_297'></td>
                        </tr>
                        <tr>
                            <td>A4</td>
                            <td><input class="form-control" type="number" name='type_A4'></td>
                        </tr>
                        <tr></tr>
                        <td>A3</td>
                        <td><input class="form-control" type="number" name='type_A3'></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id='buttonOpenSmena'>Открыть смену</button>
            </div>
        </div>
    </div>
</div>