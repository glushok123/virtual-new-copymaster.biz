<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="utf-8">
	<title>Онлаин конструктор Кружек</title>
	<meta name="viewport" content=" initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/fabric.js"></script>
	<link type="text/css" rel="stylesheet" href="css/jquery.miniColors.css" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="https://copymaster.biz/img/favicon.ico" /> 
	<link type="text/css" rel="stylesheet" href="css/app.css" />
</head>

<body class="preview" data-spy="scroll" data-target=".subnav" data-offset="80"></body>
    <div class="container">
        <div class="row"> 
			<a href="https://copymaster.biz">◄ Вернуться на сайт</a> 
		</div>
    </div>

	<? include_once 'helper.php'; ?>

	<div class="container-fluid">
		<? include_once 'constructor.php'; ?>
	</div>
	<script>
		
	
	<?
			if (isMobile()) {
				echo ('
					const widthDiv = 350;
					const heightDiv = 233;
				');
			} else {
				echo ('
					const widthDiv = 600;
					const heightDiv = 400;
				');
			}

	?>

	</script>

	<script src="js/constructor.js?v2" type="module"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.miniColors.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
	


</body>
</html>