<?
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    $info = $_POST['post'];
    $arr = json_decode($info);

    $s = serialize($arr->check_id->info);

    foreach ($arr->check_id->data as $k => $v) {
        $result[$k] = $v;
    }

    try
    {
        require_once './connect.php';

        // подключаемся к серверу
        try
        {
            $stmt = $dbh->prepare("INSERT INTO check_id(cost,createtime,discount,discount_percent,pay_type,cher,prepayment) values (?,?,?,?,?,?,?)"); // запрос на добавление чека
            $stmt->bindParam(1, $cost);
            $stmt->bindParam(2, $createtime);
            $stmt->bindParam(3, $discount);
            $stmt->bindParam(4, $discount_percent);
            $stmt->bindParam(5, $pay_type);
            $stmt->bindParam(6, $cher);
            $stmt->bindParam(7, $prepayment);

            // запрос на добавление чека
            $cost = $result['sum'];
            $createtime = date("Y-m-d H:i:s");
            $discount = $result['dir'];
            $discount_percent = $result['dip'];
            $pay_type = $result['fx'];
            $cher = $result['cher'];
            $prepayment = $result['prepayment'];

            $stmt->execute();
            $lastCheckId = $dbh->lastInsertId();

            $info = array(
                'lastId' => $lastCheckId *= 1
            );
            header('Content-type: application/json ' . $info);
            echo json_encode($info);

        }
        catch(PDOExecption $e)
        {
            $dbh->rollback();
            print "Error!: " . $e->getMessage() . "</br>";
        }
    }
    catch(PDOExecption $e)
    {
        print "Error!: " . $e->getMessage() . "</br>";
    }

    foreach ($arr->offers as $num => $offer)
    {
        $stmt = $dbh->prepare("INSERT INTO offers(name,cost,item,price,count,offer_item,name_komp, tel, srok, cher, objtest) values (?,?,?,?,?,?,?,?,?,?,?)"); // запрос на добавление чека
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
        $cost = $offer->cost;
        $item = $lastCheckId;
        $price = $offer->price;
        $count = $offer->count;
        $offer_item = $num;
        $name_komp = $result['cn'];
        $tel = $result['telc'];
        $srok = $result['srokc'];
        $cher = $result['cher'];
        $stmt->execute();
    }

    if (empty(trim($result['telc'])) == false && $result['cher'] == 0) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

        $db = getDbInstance();
        $res = $db->query("SELECT * FROM `customers_calculator` where phone='" . $result['telc'] . "'");
    
        if (count($res) > 0) {
            $id = $res[0]['id'];
            $count_order = $res[0]['count_order'] + 1;
            $sum_order = $res[0]['sum_order'] + $result['sum'];
            $average_check = round($sum_order/$count_order);

            $db->query("UPDATE customers_calculator
                SET `count_order`= '" . $count_order . "',
                `sum_order`= '" . $sum_order . "',
                `average_check`= '" . $average_check . "'
                where id=" . $id
            );

        } else {
            $name = $result['cn'];
            $phone = $result['telc'];
            $count_order = 1;
            $sum_order = $result['sum'];
            $average_check = round($sum_order/$count_order);

            $db->query("INSERT INTO customers_calculator
                ( `name`, `phone`, `count_order`, `sum_order`, `average_check`)
                VALUES
                (
                    '" . $name . "',
                    '" . $phone . "',
                    '" . $count_order . "',
                    '" . $sum_order . "',
                    '" . $average_check . "'
                )"
            );
        }
    }
?>