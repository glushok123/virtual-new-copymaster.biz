<?
	include_once('./header.php');
	include_once('./view/openAndCloseSmena/modalOpenSmena.php');
	include_once('./view/openAndCloseSmena/modalAddMaterial.php');
?>

<div class="page-wrapper">
    <div class="page-content-wrapper">
        <?
            include_once('./view/openAndCloseSmena/content.php');
        ?>
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

<style media="screen">
    .ogrsize {
        max-width: 80px;
        min-width: 80px;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#table').DataTable({
            "order": [0, 'desc']
        });

        var tableMaterial = $('#table-material').DataTable({
            "order": [0, 'desc']
        });

        // Информация о сменах
        function requestInfoSmena($id) {
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

        // Информация о приходах
        function requestInfoMaterial($id) {
            $.ajax({
                url: '/dashbord/request/material/getInfoByTable.php',
                method: 'post',
                dataType: "json",
                data: {},
                async: true,
                success: function(data) {
                    tableMaterial.clear().draw();
                    tableMaterial.rows.add(data).draw();
                },
            });
        }

        requestInfoSmena();
        requestInfoMaterial();

        /**
         * Открытие смены
         *
         * @return void
         */
        function requestOpenSmena() {
            var $data = {};

            $('#form-open-smena').find('input, textearea, select').each(function() {
                $data[this.name] = $(this).val();
            });

            $.ajax({
                url: '/dashbord/request/smena/createSmena.php',
                method: 'post',
                dataType: "json",
                data: $data,
                async: true,
                success: function(data) {
                    if (data.status == 'success') {
                        toastr.success('Смена открыта!')
                        location.reload()
                    }
                },
            });
        }

        /**
         * Добавление прихода
         *
         * @return void
         */
        function requestAddMaterial() {
            var $data = {};

            $('#form-add-material').find('input, textearea, select').each(function() {
                $data[this.name] = $(this).val();
            });

            $.ajax({
                url: '/dashbord/request/material/addMaterial.php',
                method: 'post',
                dataType: "json",
                data: $data,
                async: true,
                success: function(data) {
                    if (data.status == 'success') {
                        toastr.success('Добавлен!')
                        location.reload()
                    }
                },
            });
        }

        $(document).on('click', '#buttonOpenSmena', function() {
            requestOpenSmena($(this));
        });

        $(document).on('click', '#buttonAddMaterial', function() {
            requestAddMaterial($(this));
        });
    })
</script>

</body>
</html>