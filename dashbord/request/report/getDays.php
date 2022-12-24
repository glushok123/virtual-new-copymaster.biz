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
				where '" . $dateStart ."' <= ci.createtime and ci.createtime < '" . $dateEnd ."'
				AND (ci.cher = '0' ) 
				order by ci.createtime DESC;
		");

    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $check) {
        $dataResponse[substr($check['createtime'], 0, 10)][$check['id']] = [
            'pay_type' => $check['pay_type'],
            'cost' => $check['cost'],
            'discount' => $check['discount'],
            'discount_percent' => $check['discount_percent'],
            'createtime' => $check['createtime']
        ];

        $stmt2 = $dbh->prepare("SELECT * from offers where item = " . $check['id']);
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
        }
    }

    $text = '<table class="table table-striped table-bordered table-dark table-hover">';
    $text = $text . '
        <tr>
            <td>День</td>
            <td>Заработано за день</td>
            <td>Средний чек за день</td>
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
        
        foreach ($checks as $check) {
            $inTotalMoneys = $inTotalMoneys + $check['cost'];

            if($check['pay_type'] == 'cash') {
                $payTypeByСash = $payTypeByСash + 1;
            }

            if($check['pay_type'] == 'card') {
                $payTypeByСard = $payTypeByСard + 1;
            }
        };

        $averageMoneys = $inTotalMoneys == 0 ? 0 : $inTotalMoneys/$quantity;

        $text = $text . '
            <tr>
                <td>' . $day . '</td>
                <td>' . $inTotalMoneys . ' р.</td>
                <td>' . ceil($averageMoneys) . ' р.</td>
                <td>' . $quantity . ' шт.</td>
                <td>' . $payTypeByСard . ' шт.</td>
                <td>' . $payTypeByСash . ' шт.</td>
                <td><button type="button" class="btn-info more-detailed-day" data-day="' . $day .'" init-more>Подробнее</button></td>
            </tr>
        ';
   }

//echo json_encode($dataResponse);
echo $text;