<?
include('./header.php')
?>

<!--plugins-->
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<!-- App JS -->
<link rel="stylesheet" href="assets/plugins/datatable/css/buttons.bootstrap4.min.css"/>
<link rel="stylesheet" href="assets/plugins/datatable/css/dataTables.bootstrap4.min.css"/>
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/edittable/bstable.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<script src="assets/js/app.js"></script>

<div class="page-wrapper">
    <div class="page-content-wrapper">
        <div class="page-content">
            <div id='calendar'></div>
            <div class="container text-center justify-content-center">
                <div class="row text-center mx-auto">
                    <h1 class="text-info text-center mx-auto">Учет времени работы</h1>
                </div>
                <hr style="border: 2px solid red;">

                <div id="time">
            <span class="digit" id="hr">
                00</span>
                    <span class="txt">Ч</span>
                    <span class="digit" id="min">
                00</span>
                    <span class="txt">Мин</span>
                    <span class="digit" id="sec">
                00</span>
                    <span class="txt">Сек</span>
                    <span class="digit" id="count">
                00</span>
                </div>

                <div id="buttons">
                    <button class="btn" id="start">
                        Старт
                    </button>
                    <!--button class="btn" id="stop">
                        Пауза
                    </button-->
                    <button class="btn" id="stop">
                        Сохранить
                    </button>
                </div>

                <hr style="border: 2px solid red;">

                <table id="collection-time" class="table table-striped hover" style="width:100%; color: black !important;">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Старт</th>
                        <th>Конец</th>
                        <th>Итого</th>
                        <th>Подтверждено</th>
                    </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>


<link href='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.css' rel='stylesheet' />
<link href='https://unpkg.com/@fullcalendar/timeline@4.3.0/main.min.css' rel='stylesheet' />
<link href='https://unpkg.com/@fullcalendar/resource-timeline@4.3.0/main.min.css' rel='stylesheet' />
<script src='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/interaction@4.3.0/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/timeline@4.3.0/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/resource-common@4.3.1/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/resource-timeline@4.3.0/main.min.js'></script>

<script src="assets/js/calcTimeWork.js" type="text/javascript"></script>
<link href="assets/css/calcTimeWork.css" rel="stylesheet"/>


<script>

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            //If the product key is not set, a link will appear in the lower left corner
            schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
            //'interaction': drag event
            plugins: [ 'interaction','resourceTimeline' ],
            //Set utc time format
            timeZone: 'UTC',
            //Set the default display year resourceTimelineDay, month resourceTimelineWeek, day resourceTimelineMonth
            defaultView: 'resourceTimelineMonth',
            //Set Chinese
            locale:'Ru-ru',
            //Set the calendar height
            height:500,
            //Set the initial year and month
            //defaultDate: '2019-06-12',
            editable: true,
            //Switch the year and month button
            header: {
                //Left button
                left: 'prev,next',
                center: 'title',
                //Control year, month, and day
                right: 'resourceTimelineDay,resourceTimelineWeek,resourceTimelineMonth'
            },
            eventClick(calEvent, jsEvent, view){
                alert("Click schedule trigger");
                console.log(calEvent);
            },
            resourceLabelText: 'plan',

            resources: [
                {
                    id: "a",
                    title: "Plan A"
                },
                {
                    id: "b",
                    title: "Plan B",
                    eventColor: "green"
                },
                {
                    id: "c",
                    title: "Plan C",
                    eventColor: "orange"
                },
                {
                    id: "d",
                    title: "Plan D",
                    children: [
                        {
                            id: "d1",
                            title: "Plan D1"
                        },
                        {
                            id: "d2",
                            title: "Plan D2"
                        }
                    ]
                },
            ],
            events: [{
                //Set the id corresponding to resources
                resourceId: "a",
                title:'No. 15-20',
                //Set the start time
                start:"2024-02-15",
                //End Time
                end:"2024-02-15",
                //colour
                color:"#409EFF",
            },{
                resourceId: "b",
                title:'No. 15-20',
                start:"2019-12-15",
                end:"2019-12-20",
                color:"#A9A9A9",
            }],
        });
        calendar.render();
    });
</script>

<style>
    .fc-resource-area.fc-widget-header{
        width: 90px !important;
    }
    .fc-view-container{
        color: black;
    }
    .fc-time-area.fc-widget-header .fc-widget-header.fc-fri.fc-past{
        width: 15px !important;
    }
</style>
</body>
</html>