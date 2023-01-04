<?php
	session_start();
    require_once '../../calc/connect.php';

    $dataResponse = [];

    $dateStart = '2022-01-01';
    $dateEnd = '2022-12-31';

    if (isset($_POST["dateStart"])){
        $dateStart = $_POST["dateStart"];
    }

    if (isset($_POST["dateEnd"])){
        $dateEnd = $_POST["dateEnd"];
    }

    $stmt = $dbh->prepare("
			SELECT 
				ci.id, 
				ci.cost, 
				ci.createtime, 
				ci.discount, 
				ci.discount_percent, 
				ci.pay_type 
				from check_id as ci 
				where 
                '" . $dateStart ." 08:29:59' <= ci.createtime 
                and 
                ci.createtime < '" . $dateEnd ." 08:29:59'
				AND (ci.cher = '0' ) 
				order by ci.createtime DESC;
		");

    $stmt->execute();
    $data = $stmt->fetchAll();
    $periodOld = null;
    foreach ($data as $check) {
        $period = strtotime(date("H:i:s",strtotime($check['createtime'])));

        if($period >= strtotime('08:29:59') && $period <= strtotime('20:29:59')) {//дневная смена
            $dataResponse[date("Y-m-d",strtotime($check['createtime'])-30600)][$check['id']] = [
                'pay_type' => $check['pay_type'],
                'cost' => $check['cost'],
                'discount' => $check['discount'],
                'discount_percent' => $check['discount_percent'],
                'createtime' => $check['createtime'],
                'tip' => 'day'
            ];
        }else if($period >= strtotime('20:29:59') && $period <= strtotime('23:59:59')) { //часть ночной смены
            $dataResponse[date("Y-m-d",strtotime($check['createtime'])-30600)][$check['id']] = [
                'pay_type' => $check['pay_type'],
                'cost' => $check['cost'],
                'discount' => $check['discount'],
                'discount_percent' => $check['discount_percent'],
                'createtime' => $check['createtime'],
                'tip' => 'night'
            ];
        }
        else if($period >= strtotime('00:00:01') && $period <= strtotime('08:29:59')) { //часть ночной смены
            $dataResponse[date("Y-m-d",strtotime($check['createtime'])-30600)][$check['id']] = [
                'pay_type' => $check['pay_type'],
                'cost' => $check['cost'],
                'discount' => $check['discount'],
                'discount_percent' => $check['discount_percent'],
                'createtime' => $check['createtime'],
                'tip' => 'night'
            ];
        }

        /*$stmt2 = $dbh->prepare("SELECT * from offers where item = " . $check['id']);
        $stmt2->execute();
        $datacheck2 = $stmt2->fetchAll();

        foreach ($datacheck2 as $offer) {
          $dataResponse[substr($check['createtime'], 0, 10)][$check['id']]['info'][] = [
                'name' => $offer['name'],
                'cost' => $offer['cost'],
                'item' => $offer['item'],
                'price' => $offer['price'],
                'count' => $offer['count'],
                'offer_item' => $offer['offer_item'],
                'name_komp' => $offer['name_komp'],
                'tel' => $offer['tel'],
                'srok' => $offer['srok']
          ];
        }*/
    }

    $text = '<table class="table table-striped table-bordered table-dark table-hover">';
    $text = $text . '
        <tr>
            <td>Смена</td>
            <td>Заработано за смену</td>
            <td>Средний чек за смену</td>
            <td>Количество чеков</td>
            <td>Оплачено картой</td>
            <td>Оплачено наличкой</td>
            <td>Действия</td>
        </tr>
    ';
    foreach($dataResponse as $day => $checks) {
        $averageMoneys = 0; // Средний чек
        $inTotalMoneys = 0; // Всего заработано
        $quantity = count($checks); // общее количество чеков
        $payTypeByСash = 0; // наличкой
        $payTypeByСard = 0; // картой
        
        $averageMoneysDay = 0; // Средний чек дневной смены
        $inTotalMoneysDay = 0; // Всего заработано дневной смены +
        $quantityDay = 0; // общее количество чеков дневной смены +
        $payTypeByСashDay = 0; // наличкой дневной смены +
        $payTypeByСardDay = 0; // картой дневной смены +

        $averageMoneysNight = 0; // Средний чек ночной смены
        $inTotalMoneysNight = 0; // Всего заработано ночной смены +
        $quantityNight = 0; // общее количество чеков ночной смены +
        $payTypeByСashNight = 0; // наличкой ночной смены +
        $payTypeByСardNight = 0; // картой ночной смены +

        foreach ($checks as $check) {
            $inTotalMoneys = $inTotalMoneys + $check['cost'];

            if ($check['tip'] == 'day') {
                $inTotalMoneysDay = $inTotalMoneysDay + $check['cost'];
                $quantityDay = $quantityDay + 1;

                if($check['pay_type'] == 'cash') {
                    $payTypeByСashDay = $payTypeByСashDay + 1;
                }
    
                if($check['pay_type'] == 'card') {
                    $payTypeByСardDay = $payTypeByСardDay + 1;
                }
            }

            if ($check['tip'] == 'night') {
                $inTotalMoneysNight = $inTotalMoneysNight + $check['cost'];
                $quantityNight = $quantityNight + 1;
                
                if($check['pay_type'] == 'cash') {
                    $payTypeByСashNight = $payTypeByСashNight + 1;
                }
    
                if($check['pay_type'] == 'card') {
                    $payTypeByСardNight = $payTypeByСardNight + 1;
                }
            }

            if($check['pay_type'] == 'cash') {
                $payTypeByСash = $payTypeByСash + 1;
            }

            if($check['pay_type'] == 'card') {
                $payTypeByСard = $payTypeByСard + 1;
            }
        };

        $averageMoneys = $inTotalMoneys == 0 ? 0 : $inTotalMoneys/$quantity;
        $averageMoneysDay = $inTotalMoneysDay == 0 ? 0 : $inTotalMoneysDay/$quantityDay;
        $averageMoneysNight = $inTotalMoneysNight == 0 ? 0 : $inTotalMoneysNight/$quantityNight;

        $text = $text . '
            <tr>
                <td>' . $day . '</td>
                <td>' . $inTotalMoneysDay . ' р.</td>
                <td>' . ceil($averageMoneys) . ' р.</td>
                <td>' . $quantity . ' шт.</td>
                <td>' . $payTypeByСard . ' шт.</td>
                <td>' . $payTypeByСash . ' шт.</td>
                <td><button type="button" class="btn-info more-detailed-day" data-day="' . $day .'" init-more>Подробнее</button></td>
            </tr>
        ';

        $text = $text . '
            <tr class="table-light" style="color:black !important;">
                <td style="color:black !important;">Дневная смена</td>
                <td style="color:black !important;">' . $inTotalMoneys . ' р.</td>
                <td style="color:black !important;">' . ceil($averageMoneysDay) . ' р.</td>
                <td style="color:black !important;">' . $quantityDay . ' шт.</td>
                <td style="color:black !important;">' . $payTypeByСardDay . ' шт.</td>
                <td style="color:black !important;">' . $payTypeByСashDay . ' шт.</td>
                <td style="color:black !important;"><button type="button" class="btn-info more-detailed-day" data-day="' . $day .'" init-more>Подробнее</button></td>
            </tr>
        ';

        $text = $text . '
            <tr class="table-dark" style="color:black !important;">
                <td style="color:black !important;">Ночная смена</td>
                <td style="color:black !important;">' . $inTotalMoneysNight . ' р.</td>
                <td style="color:black !important;">' . ceil($averageMoneysNight) . ' р.</td>
                <td style="color:black !important;">' . $quantityNight . ' шт.</td>
                <td style="color:black !important;">' . $payTypeByСardNight . ' шт.</td>
                <td style="color:black !important;">' . $payTypeByСashNight . ' шт.</td>
                <td style="color:black !important;"><button type="button" class="btn-info more-detailed-day" data-day="' . $day .'" init-more>Подробнее</button></td>
            </tr>
        ';
   }

//echo json_encode($dataResponse);
echo $text;