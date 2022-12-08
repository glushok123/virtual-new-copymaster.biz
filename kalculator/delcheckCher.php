<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$idloadcheck = $_POST['idloadcheck'];

require_once './connect.php';
$stmt = $dbh->prepare("DELETE FROM `offers` WHERE item = ?;");
$stmt->bindParam(1, $idloadcheck);
$stmt->execute();



$data = $stmt->fetchAll();
$stmt = $dbh->prepare("DELETE FROM `check_id` WHERE id = ?;");
$stmt->bindParam(1, $idloadcheck);
$stmt->execute();

echo('ok')


?>
