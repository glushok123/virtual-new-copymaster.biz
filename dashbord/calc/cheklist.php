<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once './connect.php';
$stmt = $dbh->prepare("SELECT ci.id, ci.cost, ci.createtime, ci.discount, ci.discount_percent, ci.pay_type from check_id as ci where (ci.createtime >= DATE_SUB(NOW(), INTERVAL 14 DAY)) AND (ci.cher <> '1' ) order by ci.createtime DESC;");
$stmt->execute();
$data = $stmt->fetchAll();


    $splitted = [];
    $unique_dates = [];
	$newdata = [];
	$pay_type= [];
    foreach ($data as $dot) {

    	$dot[] = date("Y-m-d",strtotime($dot['createtime']));
    	$unique_dates[] = $dot['date'];

    	$unique_dates = array_unique($unique_dates);

        $period = strtotime(date("H:i:s",strtotime($dot['createtime'])));

        if ($period >= strtotime('08:29:59') && $period <= strtotime('20:29:59')){
		$splitted[date("Y-m-d",strtotime($dot['createtime'])-30600)]["day"][] = $dot;
		}else if($period >= strtotime('20:29:59') && $period <= strtotime('23:59:59')){
			$splitted[date("Y-m-d",strtotime($dot['createtime'])-30600)]["night"][] = $dot;
		}
		else if($period >= strtotime('00:00:01') && $period <= strtotime('08:29:59')){
			$splitted[date("Y-m-d",strtotime($dot['createtime'])-30600)]["night"][] = $dot;
		}

    }


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
		if ($daytime == "day") {
			$daypaycard =0;
			$daypaycash=0;
			$daypaybank=0;
			$summpaycardday = 0;
				$summpaycashday = 0;
				$summpaybankday = 0;
foreach ($value as $cost) {

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

			$text .= "<tr class='smena'><td colspan='3'>День ".$day."</td><td>Итого ".$summday." <span class=\"rouble\">₽</span></td></tr>";
			$text .= "<tr class='smena'><td colspan='2'>Наличные</td><td>".$daypaycash."</td><td>".$summpaycashday." <span class=\"rouble\">₽</span></td></tr>
					  <tr class='smena'><td colspan='2'>Картой</td><td>".$daypaycard."</td><td>".$summpaycardday." <span class=\"rouble\">₽</span></td></tr>
					  <tr class='smena'><td colspan='2'>Юр. лица</td><td>".$daypaybank."</td><td>".$summpaybankday." <span class=\"rouble\">₽</span></td></tr>";
				$summday = 0;
				$summpaycardday = 0;
				$summpaycashday = 0;
				$summpaybankday = 0;


			foreach ($value as $onecheck) {
				$text .= "<tr class=\"list ".$onecheck["pay_type"]."\" onclick=\"chek.load('".$onecheck["id"]."');\">
                      <td colspan=\"2\">".$onecheck["createtime"]."</td>
                      <td>".$onecheck["id"]."</td>
                      <td>".$onecheck["cost"]." <span class=\"rouble\">₽</span></td>

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

			$text .= "<tr class='smena'><td colspan='3'>Ночь ".$day."</td><td>Итого ".$summnight." <span class=\"rouble\">₽</span></td></tr>";
			$text .= "<tr class='smena'><td colspan='2'>Наличные</td><td>".$nightpaycash."</td><td>".$summpaycashnight." <span class=\"rouble\">₽</span></td></tr>
					  <tr class='smena'><td colspan='2'>Картой</td><td>".$nightpaycard."</td><td>".$summpaycardnight." <span class=\"rouble\">₽</span></td></tr>
					  <tr class='smena'><td colspan='2'>Юр. лица</td><td>".$nightpaybank."</td><td>".$summpaybanknight." <span class=\"rouble\">₽</span></td></tr>";
				$summnight = 0;
				$summpaycardnight = 0;
				$summpaycashnight = 0;
				$summpaybanknight = 0;
			foreach ($value as $onecheck) {
					$text .= "<tr class=\"list ".$onecheck["pay_type"]."\" onclick=\"chek.load('".$onecheck["id"]."');\">
	                      <td colspan=\"2\">".$onecheck["createtime"]."</td>
	                      <td>".$onecheck["id"]."</td>
	                      <td>".$onecheck["cost"]." <span class=\"rouble\">₽</span></td>
	                    </tr>";
			}
		}
	}
}
echo $text;


?>
