<?

include_once 'Smena.php';

$smena = new Smena();
echo $smena->createSmena($_POST['type'], $_POST['comment']);