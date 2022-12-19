<?
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        $idloadcheck = $_POST['idloadcheck'];

        require_once './connect.php';

        $sth = $dbh->prepare("SELECT objtest from offers  WHERE `item` = :id");
        $sth->execute(array('id' => $idloadcheck));
        $array = $sth->fetch(PDO::FETCH_ASSOC);

        $obj = unserialize($array["objtest"]);
        echo(json_encode($obj));