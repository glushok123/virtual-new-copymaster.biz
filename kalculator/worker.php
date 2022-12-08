<?

// ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$info = $_POST['post'];
 //var_dump($info);
// $get = $_GET;
$arr = json_decode($info);;
var_dump($arr->check_id->info);
$s = serialize($arr->check_id->info);
// die;
// $reult = array();
    foreach($arr->check_id->data as $k => $v) {
    	// var_dump($k);
    	// var_dump($v);
        // $sum = $obj->sum;
        // var_dump($sum);
        $result[$k] = $v;
    }
try {
// var_dump(time());
require_once './connect.php';

// подключаемся к серверу


 try {
$stmt = $dbh->prepare("INSERT INTO check_id(cost,createtime,discount,discount_percent,pay_type,cher) values (?,?,?,?,?,?)");// запрос на добавление чека
$stmt->bindParam(1, $cost);
$stmt->bindParam(2, $createtime);
$stmt->bindParam(3, $discount);
$stmt->bindParam(4, $discount_percent);
$stmt->bindParam(5, $pay_type);
$stmt->bindParam(6, $cher);


// запрос на добавление чека
$cost = $result['sum'];
$createtime =  date("Y-m-d H:i:s");
$discount =  $result['dir'];
$discount_percent =  $result['dip'];
$pay_type = $result['fx'];
$cher = $result['cher'];

$stmt->execute();
$lastCheckId = $dbh->lastInsertId();

// var_dump($lastCheckId);

$info = array('lastId' => $lastCheckId*= 1);
header('Content-type: application/json '. $info);
echo json_encode($info);

} catch(PDOExecption $e) {
        $dbh->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
    }
    } catch( PDOExecption $e ) {
    print "Error!: " . $e->getMessage() . "</br>";
}



//var_dump($result['cn']);

    foreach($arr->offers as $num => $offer) {
// echo json_encode($offer);
    	// foreach ($offer as $prop => $val) {
    	$stmt = $dbh->prepare("INSERT INTO offers(name,cost,item,price,count,offer_item,name_komp, tel, srok, cher, objtest) values (?,?,?,?,?,?,?,?,?,?,?)");// запрос на добавление чека
			$stmt->bindParam(1, $name);
			$stmt->bindParam(2, $cost);
			$stmt->bindParam(3, $item);
			$stmt->bindParam(4, $price);
			$stmt->bindParam(5, $count);
			$stmt->bindParam(6, $offer_item);
      $stmt->bindParam(7, $name_komp);
      $stmt->bindParam(8, $tel);
      $stmt->bindParam(9, $srok);
      $stmt->bindParam(10, $cher);
      $stmt->bindParam(11, $s);

			// запрос на добавление чека
			$name = $offer->name;
			$cost =  $offer->cost;
			$item = $lastCheckId;
			$price =  $offer->price;
			$count = $offer->count;
			$offer_item = $num;
      $name_komp = $result['cn'];
      $tel = $result['telc'];
      $srok = $result['srokc'];
      $cher = $result['cher'];
		  $stmt->execute();

    	// }
    }




?>
