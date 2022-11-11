<?php
	date_default_timezone_set('GMT');
	header('Expires: '.date("D, d M o H:i:s e",time()+900000));
	header('Last-Modified: '.date("D, d M o H:i:s e",time()-100000));
	if (!isset($bnum)) {$bnum=rand(1,6);}
?>
	<!DOCTYPE HTML>
	<HTML lang="ru-RU">

	<HEAD>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-143221226-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];

			function gtag() {
				dataLayer.push(arguments);
			}
			gtag('js', new Date());
			gtag('config', 'UA-143221226-1');
		</script>
		<link rel="SHORTCUT ICON" href="favicon.ico">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
		<META name="Keywords" content="<? echo $keyw;?>">
		<TITLE>
			<? echo $titl;?>
		</TITLE>
		<META name="Description" content="<? echo $desc;?>">
		<link rel="apple-touch-icon" sizes="57x57" href="apple-touch-icon-114-precomposed.png" />
		<link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114-precomposed.png" />
		<link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-144-precomposed.png " />
		<link rel="apple-touch-icon" sizes="144x144" href="apple-touch-icon-144-precomposed.png" />
		<meta name="yandex-verification" content="d8687e2e78912895" />
		<meta name="geo.placename" content="Москва, Россия" />
		<meta name="geo.position" content="55.7558260;37.6173000" />
		<meta name="geo.region" content="RU-" />
		<meta name="ICBM" content="55.7558260, 37.6173000" />
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<link href="stylemod.css" rel="stylesheet" />

		</script>
		<script src="//code-ya.jivosite.com/widget/XUKhE1GvKV" async></script>
	</HEAD>
	<BODY class="bosc">
	


			<nav class="navbar navbar-expand-lg fixed-top sticky" id="navbar">
				<div class="container">
					<a href="index.php" class="navbar-brand me-5">
							<img src="/img/24.png" class="logo-dark" alt="" height="70" />
						</a>
					<a href="javascript:void(0)" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggle-icon"><i data-feather="menu"></i></span>
						</a>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav navbar-center me-auto mt-lg-0 mt-2">
							<li class="nav-item">
								<a class="nav-link" href="/#services">Услуги</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/price.html">Цены</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/delivery.html">Доставка</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/delivery.html">Инфо</a>
							</li>
							<ul>
								<li class="nav-item">
									<a class="nav-link" href="Контакты">Контакты</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="/tt.html">Технические требования к макетам</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="/our-team.html">Наша команда</a>
								</li>
							</ul>
							<li class="nav-item">
								<a class="nav-link" href="/online-pay.html">Оплата</a>
							</li>
						</ul>
						<div class="mb-4 mb-lg-0">
							<a href="#" class="btn btn-sm nav-btn btn-primary mb-4 mb-lg-0 ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">Контакты</a>
							<a href="#" class="btn btn-sm nav-btn btn-primary mb-4 mb-lg-0 ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal2">Заказать</a>
						</div>
					</div>
				</div>
			</nav>

			<style type="text/css">

			</style> <a href='/' id='logo'>ПРОФЕССИОНАЛЬНЫЙ КОПИРОВАЛЬНЫЙ ЦЕНТР</a>

			<img src="/img/24.png" class="clock24" style="width: 70px;    float: left;    margin: 5px 10px 5px 20px;    color: #db2327;">

			<div id="conta">
				<div>
					<span id='phone' class="call_phone_1"><b>Физ. лица:</b> <a href="tel:+74952295662" class="a1 ">+7 (495) 229-56-62</a></span>
					<br>
					<a href="mailto:info@copymaster.biz" class="a1 maila1">info@copymaster.biz</a>
				</div>
				<div>
					<span id='phone' class="call_phone_1"><b>Юр. лица:</b> <a href="tel:+89361054779" class="a1">+7 (936) 105-47-79</a> </span>
					<br>
					<a href="mailto:manager@copymaster.biz" class="a1 maila1">manager@copymaster.biz</a>
				</div>
				<br style="clear:both;"> <a style="text-decoration: none;" href="/contacts.html"><span id='addr'>м. Октябрьская, Калужская площадь, дом 1 к 1</span></a>
			</div>

			<div id="banner"> <img src="img/ban1.jpg"> <img src="img/ban2.jpg"> <img src="img/ban3.jpg"> <img src="img/ban4.jpg"> </div>

			<div id="promo">
				<a href="/nizkie-ceni.html">
					<div>Низкие цены</div>
				</a>
				<a href="/szhatie-sroki.html">
					<div>Сжатые сроки</div>
				</a>
				<a href='/online-pay.html'>
					<div>Оплата по картам</div>
				</a>
				<a href="/udobnoe-raspolozhenie.html">
					<div>Удобное расположение</div>
				</a>
				<a href="/distancionnoe-oformlenie-zakaza.html">
					<div>Дистанционное оформление заказа</div>
				</a>
				<a href="/grafik-raboti.html">
					<div>Мы работаем 24 часа в сутки</div>
				</a>
			</div>
