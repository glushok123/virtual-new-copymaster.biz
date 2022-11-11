<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$idloadcheck = $_POST['idloadcheck'];

require_once './connect.php';
$stmt = $dbh->prepare("SELECT of.name, of.cost, of.item, of.price, of.count, of.offer_item, of.name_komp, of.tel, of.srok, of.objtest from offers as of where of.item = ?;");
$stmt->bindParam(1, $idloadcheck);
$stmt->execute();



$data = $stmt->fetchAll();
$stmt = $dbh->prepare("SELECT ci.cost, ci.discount, ci.discount_percent, ci.pay_type from check_id as ci where ci.id = ?;");
$stmt->bindParam(1, $idloadcheck);
$stmt->execute();
$datacheck = $stmt->fetchAll();

$text .= "<table id=\"tablecheck\"><tr class=\"chekItog\"><td colspan=\"7\" >Чек номер: ".$idloadcheck."</td></tr><tr><td>№</td><td>Услуга</td><td>Кол-во</td><td>Ед.</td><td>Цена</td><td>Стоимость</td><td>Заказчик</td></tr>";
	foreach ($data as $offer) {
		// var_dump($offer);
		$text .= "<tr class=\"list\">
          <td>".$offer["offer_item"]."</td>
          <td>".$offer["name"]."</td>
          <td>".$offer["count"]."</td>
          <td>шт.</td>
          <td>".$offer["cost"]."</td>
          <td>".$offer["price"]."</td>
		   <td>".$offer["name_komp"]."<br>".$offer["tel"]."<br>".$offer["srok"]."</td>

        </tr>";
	}
if ($datacheck["0"]["pay_type"] == "cash") {
	$pay_type="Наличными";
}elseif ($datacheck["0"]["pay_type"] == "card") {
	$pay_type="Картой";
}else{
	$pay_type="на р/с";
}

if ($datacheck["0"]["discount"] !== "0") {
	$text .= "<tr> <td colspan=\"3\"><b>Скидка</b></td>
          <td colspan=\"2\">-".$datacheck["0"]["discount_percent"]."%</td>

          <td>-".$datacheck["0"]["discount"]." руб.</td>
          </tr>";
}
$text .= "


        <tr class=\"chekItog\"><td colspan=\"5\">Итого</td><td id=\"priceConteiner\" colspan=\"1\">".$datacheck["0"]["cost"]."</td><td></td></tr>
        <tr class=\"chekItog\">
		  <td colspan=\"6\" id='qazwsx'>Способ оплаты: ".$pay_type."</td><td></td>

        </tr></table>";
	// var_dump($text) ;

	$a = unserialize($offer["objtest"]);
	echo( json_encode($a));



//echo $text;
?>
