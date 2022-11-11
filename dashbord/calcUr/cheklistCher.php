<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once './connect.php';
$stmt = $dbh->prepare("SELECT ci.id, ci.cost, ci.createtime, ci.discount, ci.discount_percent, ci.pay_type from check_id as ci where (ci.createtime >= DATE_SUB(NOW(), INTERVAL 14 DAY)) AND (ci.cher = '1' ) order by ci.createtime DESC;");
$stmt->execute();
$data = $stmt->fetchAll();


    $splitted = [];
    $unique_dates = [];
	$newdata = [];
	$pay_type= [];
    foreach ($data as $dot) {

    	$dot[] = date("Y-m-d",strtotime($dot['createtime']));
    	// $data[$dot]['date'][] = date("Y-m-d",strtotime($dot['createtime']));
    	$unique_dates[] = $dot['date'];

    	// var_dump($dot);
    	$unique_dates = array_unique($unique_dates);
    	// var_dump($unique_dates);
    	// var_dump($dot);
		// if ($dot["date"] !== $newdata['date']) {
		// 	$newdata['date'][] = $dot["date"];
		// }
    	// $splitted[] = date("Y-m-d",strtotime($dot['createtime']));

        $period = strtotime(date("H:i:s",strtotime($dot['createtime'])));
        // var_dump(date("H:i:s",strtotime(date("H:i:s",strtotime($dot['createtime'])))));
        if ($period >= strtotime('09:29:59') && $period <= strtotime('21:29:59')){
		$splitted[date("Y-m-d",strtotime($dot['createtime'])-34200)]["day"][] = $dot;
		}else if($period >= strtotime('21:29:59') && $period <= strtotime('23:59:59')){
			$splitted[date("Y-m-d",strtotime($dot['createtime'])-34200)]["night"][] = $dot;
		}
		else if($period >= strtotime('00:00:01') && $period <= strtotime('09:29:59')){
			$splitted[date("Y-m-d",strtotime($dot['createtime'])-34200)]["night"][] = $dot;
		}

    }
    // var_dump($data);
//     foreach($unique_dates as $unique){
// // var_dump($unique);
//     	foreach ($data as $dot) {
//     		// var_dump($dot);
//     		if ($unique == $dot['date']) {

//     			$newdata[] = $date;
//     			$newdata[$date][] = $dot;
//     		}
//     	}
//     }
    // var_dump($splitted);

    $text = "";
    if (!function_exists('array_key_first')) {
    function array_key_first(array $arr) {
        foreach($arr as $key => $unused) {
            return $key;
        }
        return NULL;
    }
}
foreach ($splitted as $day => $item) {
	foreach ($item as $daytime => $value) {
				 // $day = date("d-m-y",strtotime($value["0"]["createtime"]));

		if ($daytime == "day") {
			$daypaycard =0;
			$daypaycash=0;
			$daypaybank=0;
			$summpaycardday = 0;
				$summpaycashday = 0;
				$summpaybankday = 0;
foreach ($value as $cost) {
					// var_dump($cost);
					$summday += $cost['cost'];
					if ($cost["pay_type"] == "card") {
						$daypaycard++;
						 $summpaycardday += $cost['cost'];


					}else if($cost["pay_type"] == "cash"){
					$daypaycash++;
					 $summpaycashday += $cost['cost'];
					}else{
					$daypaybank++;
					$summpaybankday += $cost['cost'];
					}

				}

				// var_dump($summpaybankday);
			$text .= "<tr class='smena'><td colspan='3'>День ".$day."</td><td colspan='2'>Итого ".$summday." <span class=\"rouble\">₽</span></td></tr>";
			$text .= "";
				$summday = 0;
				$summpaycardday = 0;
				$summpaycashday = 0;
				$summpaybankday = 0;


			foreach ($value as $onecheck) {
			    $stmt = $dbh->prepare("SELECT name_komp from offers where item = ".$onecheck["id"]."");
				$stmt->execute();
                $dataTest = $stmt->fetchAll();
                
				$text .= "<tr class=\"list ".$onecheck["pay_type"]."\" id=\"".$onecheck["id"]."\" >
                      <td colspan=\"2\" onclick=\"chek.loadCher('".$onecheck["id"]."');\">".$onecheck["createtime"]."</td>
                      <td onclick=\"chek.loadCher('".$onecheck["id"]."');\">".$dataTest[0]["name_komp"]."</td>
                      <td onclick=\"chek.loadCher('".$onecheck["id"]."');\">".$onecheck["cost"]." <span class=\"rouble\">₽</span></td>
                      <td onclick=\"chek.delCher('".$onecheck["id"]."');\" > Удалить</td>
                    </tr>";
			}

		}else if ($daytime == "night") {
				$nightpaycard =0;
			$nightpaycash=0;
			$nightpaybank=0;
			$summpaycardnight = 0;
				$summpaycashnight = 0;
				$summpaybanknight = 0;
					foreach ($value as $cost) {

					$summnight += $cost['cost'];
					if ($cost["pay_type"] == "card") {
						$nightpaycard++;
						 $summpaycardnight += $cost['cost'];
					}else if($cost["pay_type"] == "cash"){
					$nightpaycash++;
					 $summpaycashnight += $cost['cost'];
					}else{
					$nightpaybank++;
					 $summpaybanknight += $cost['cost'];
					}

				}

				// var_dump($summpaycardnight);
			$text .= "<tr class='smena'><td colspan='3'>Ночь ".$day."</td><td colspan='2'>Итого ".$summnight." <span class=\"rouble\">₽</span></td></tr>";
			$text .= "
					  ";
				$summnight = 0;
				$summpaycardnight = 0;
				$summpaycashnight = 0;
				$summpaybanknight = 0;
			foreach ($value as $onecheck) {
			    
			    $stmt = $dbh->prepare("SELECT name_komp from offers where item = ".$onecheck["id"]."");
				$stmt->execute();
                $dataTest = $stmt->fetchAll();
                
        $text .= "<tr class=\"list ".$onecheck["pay_type"]."\" id=\"".$onecheck["id"]."\" >
                      <td colspan=\"2\" onclick=\"chek.loadCher('".$onecheck["id"]."');\">".$onecheck["createtime"]."</td>
                      <td onclick=\"chek.loadCher('".$onecheck["id"]."');\">".$dataTest[0]["name_komp"]."</td>
                      <td onclick=\"chek.loadCher('".$onecheck["id"]."');\">".$onecheck["cost"]." <span class=\"rouble\">₽</span></td>
                      <td onclick=\"chek.delCher('".$onecheck["id"]."');\" > Удалить</td>
                    </tr>";
			
			}
		}
	}
}
// var_dump($text);
echo $text;


?>
