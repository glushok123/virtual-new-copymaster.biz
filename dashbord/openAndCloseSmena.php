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
                <hr>
                <div class='row text-center'>
                    <button type="button" class="btn btn-outline-success mx-auto" style="color:white;">Открыть смену</button>
                </div>
                <hr>
                <table id="table" class="table table-striped table-bordered table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Тип смены</th>
                            <th>Дата открытия</th>
                            <th>Дата закрытия</th>
                            <th>Остатки в начале смены</th>
                            <th>Остатки в конце смены</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011-04-25</td>
                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011-07-25</td>
                            <td>$170,750</td>
                        </tr>
                    </tbody>
                </table>
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
.ogrsize{
	max-width: 80px;
	min-width: 80px;
}
</style>
<script type="text/javascript">

    $(document).ready(function(){
        var table = $('#table').DataTable();

        // Информация о сменах
        function requestInfo($id) {
            $.ajax({
                url: '/dashbord/request/smena/getInfoByTable.php',
                method: 'post',
                dataType: "json",
                data: {},
                async: true,
                success: function (data) {
                    table.clear().draw();
                    table.rows.add(data).draw();
                },
            });
        }

        requestInfo();
    })

</script>
