<?
	$mail='info@copymaster.biz';
	$name=$_GET["name"];
	$cont=$_GET["cont"];
	$komm=$_GET["komm"];
	$ip=$_SERVER["REMOTE_ADDR"];
	$mess="<b>$name</b>, $cont, <i>$komm</i>";
	mail($mail,'Запрос курьера с сайта',$mess,"From: Site <".$mail.">\r\nReply-To: ".$mail."\r\nContent-type:text/html; charset = UTF-8\r\n");
	echo 'ok';
?>