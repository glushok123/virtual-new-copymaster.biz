
$(document).ready(function () {
   /* var tableCollection = $('#collection-time').DataTable({
        order: [[1, 'desc']],
    });*/



    $('').css("background-color", "#9d0303");

    $('body').removeClass('bg-theme9')
    $('body').addClass('bg-theme6')
    requestGet();
    let startBtn = document.getElementById('start');
    let stopBtn = document.getElementById('stop');
    //let resetBtn = document.getElementById('reset');

    var hour = 0;
    var minute = 0;
    var second = 0;
    var count = 0;
    var timer = false;;

    startBtn.addEventListener('click', function () {
        timer = true;
        stopWatch();
        requestStart();
    });

    stopBtn.addEventListener('click', function () {
        timer = false;
        hour = 0;
        minute = 0;
        second = 0;
        count = 0;
        document.getElementById('hr').innerHTML = "00";
        document.getElementById('min').innerHTML = "00";
        document.getElementById('sec').innerHTML = "00";
        document.getElementById('count').innerHTML = "00";
        requestStop();
    });


    function stopWatch() {
        if (timer) {
            count++;

            if (Number(count) == 100) {
                second++;
                count = 0;
            }

            if (Number(second) == 60) {
                minute++;
                second = 0;
            }

            if (Number(minute) == 60) {
                hour++;
                minute = 0;
                second = 0;
            }

            let hrString = hour;
            let minString = minute;
            let secString = second;
            let countString = count;

            if (hour < 10) {
                hrString = "0" + hrString;
            }

            if (minute < 10) {
                minString = "0" + minString;
            }

            if (second < 10) {
                secString = "0" + secString;
            }

            if (count < 10) {
                countString = "0" + countString;
            }

            document.getElementById('hr').innerHTML = hrString;
            document.getElementById('min').innerHTML = minString;
            document.getElementById('sec').innerHTML = secString;
            document.getElementById('count').innerHTML = countString;
            setTimeout(stopWatch, 10);
        }
    }

    function requestStart() {
        $.ajax({
            url: 'request/calcTimeWork/startTime.php',
            method: 'POST',
            async: false,
            data:{
                start: true,
            },
            success: function(response){
                toastr.success('Старт времени зафиксирован!');
                location.reload()
            }
        });
    };

    function requestStop() {
        $.ajax({
            url: 'request/calcTimeWork/stopTime.php',
            method: 'POST',
            async: false,
            data:{
                start: true,
            },
            success: function(response){
                toastr.success('Время зафиксировано!');
                location.reload()
            }
        });
    };

    function requestGet() {
        $.ajax({
            url: 'request/calcTimeWork/getTime.php',
            method: 'POST',
            async: false,
            dataType: 'json',
            data:{
                start: true,
            },
            success: function(response){
                if (response.time === true){
                    h = Number(response.h);
                    m = Number(response.i);
                    s = Number(response.s);

                    document.getElementById('hr').innerHTML = h;
                    document.getElementById('min').innerHTML = m;
                    document.getElementById('sec').innerHTML = s;

                    startUpdate(h, m, s)
                    //toastr.success('Информация о текущем времени обновлена!');
                }

            }
        });
    };

    function requestGetCollectionForUser() {
        $('#collection-time').DataTable({
            "processing": true,
            //"serverSide": true,
            "pageLength":25,
            order: [[0, 'desc']],
            "ajax":{
                "dataType": "json",
                "type": "POST",
                "url": 'request/calcTimeWork/getCollectionTimeForUser.php',
            },
            "columns": [
                { "data": "id" },
                { "data": "time_start" },
                { "data": "time_end" },
                { "data": "dif" },
                { "data": "approved" },
            ],
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                switch(aData['approved']){
                    case 1:
                        $('td', nRow).css('background-color', '#0fa901')
                        $('td', nRow).css('color', '#d6e4ff')
                        break;
                }
            }
        });

       /* $.ajax({
            url: 'request/calcTimeWork/getCollectionTimeForUser.php',
            method: 'GET',
            async: false,
            dataType: 'json',
            data:{
                start: true,
            },
            success: function(response){
                if (response.time === true){
                   // tableCollection.rows.add(response.times).draw(false);

                    for (let key in response.times) {
                        console.log(time)
                        tableCollection.row
                            .add([
                                response.times[key].id,
                                response.times[key].time_start,
                                response.times[key].time_end,
                                response.times[key].dif
                            ])
                            .draw(false);
                    };


                  console.log(response)
                    //toastr.success('Информация о текущем времени обновлена!');
                }

            }
        });*/
    };

    function startUpdate(h, m, s){
        hour = h;
        minute = m;
        second = s;
        count = 0;


        if (timer == false){
            timer = true;
            stopWatch();
        }

        setTimeout(requestGet, 2000);
    }

    requestGetCollectionForUser();
});