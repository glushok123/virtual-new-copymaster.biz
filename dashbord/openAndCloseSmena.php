<?
	include('./header.php')
?>

<style>

</style>

<div class="page-wrapper">
    <div class="page-content-wrapper">
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
            <div class='row text-center'>
                <button type="button" class="btn btn-outline-success mx-auto" style="color:white;" data-toggle="modal"
                    data-target="#exampleModal">Открыть смену</button>
            </div>
            <hr>

            <table id="table" class="table table-striped table-bordered table-sm text-center table-dark" style="width:100%">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Тип смены</th>
                        <th>Дата открытия</th>
                        <th>Дата закрытия</th>
                        <th>Остатки в начале смены</th>
                        <th>Остатки в конце смены</th>
                        <th>Пользователь</th>
                    </tr>
                </thead>
                <tbody class="table-striped">

                </tbody>
            </table>
        </div>
    </div>
</div>

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

                    <select id="formOpenType" class="form-control" aria-label=".form-select-lg example">
                        <option selected> Выберите Тип смены</option>
                        <option value="День">День</option>
                        <option value="ночь">ночь</option>
                    </select>

                    <hr>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Отчёт по остаткам</label>
                        <textarea class="form-control" id="formOpenComment" rows="4"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id='buttonOpenSmena'>Открыть смену</button>
            </div>
        </div>
    </div>
</div>

<!--end switcher-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!--plugins-->
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<!-- Vector map JavaScript -->
<script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-in-mill.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-us-aea-en.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-uk-mill-en.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-au-mill.js"></script>

<script src="assets/js/index.js"></script>
<!-- App JS -->
<link rel="stylesheet" href="assets/plugins/datatable/css/buttons.bootstrap4.min.css" />
<link rel="stylesheet" href="assets/plugins/datatable/css/dataTables.bootstrap4.min.css" />
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/js/app.js"></script>

<script type="text/javascript">

</script>

</body>

</html>
<style media="screen">
.ogrsize {
    max-width: 80px;
    min-width: 80px;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    var table = $('#table').DataTable({
        "order": [ 0, 'desc' ]
    });

    // Информация о сменах
    function requestInfo($id) {
        $.ajax({
            url: '/dashbord/request/smena/getInfoByTable.php',
            method: 'post',
            dataType: "json",
            data: {},
            async: true,
            success: function(data) {
                table.clear().draw();
                table.rows.add(data).draw();
            },
        });
    }

    requestInfo();

    function requestOpenSmena() {
        $.ajax({
            url: '/dashbord/request/smena/createSmena.php',
            method: 'post',
            dataType: "json",
            data: {
                type: $('#formOpenType').val(),
                comment: $('#formOpenComment').val(),
            },
            async: true,
            success: function(data) {
                if (data.status == 'success') {
                    toastr.success('Смена открыта!')
                    location.reload()
                }
            },
        });
    }

    $(document).on('click', '#buttonOpenSmena', function () {
        requestOpenSmena($(this));
    });
})
</script>