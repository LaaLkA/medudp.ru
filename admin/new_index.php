<?php
//header('Content-Type: text/html; charset=utf-8');
session_start();
require_once "PHPscript/documentsForm.php";
require_once "PHPscript/dwnFileForm.php";
require_once "../content/allFunction.php";
require_once "function.php";
require_once "../../porter.php";

?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Панель управления сайтом www.medudp.ru</title>
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="new_style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.4.2/jquery.fancybox.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
		integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	<script type="text/javascript"
		src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
	<script type="text/javascript"
		src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.4.2/jquery.fancybox.min.js"></script>


</head>

<body>

	<div class="wrapper">
		<header class="header">
			<div class="header__container">
				<span class="header__icon material-icons">menu</span>
				<a href="#" class="header__logo">Medudp_Admin</a>
				<div class="header__user user">
					<span class="user__icon material-icons">account_circle</span>
					<div class="user__name">User Name</div>
				</div>
			</div>
		</header>
		<div class="content">
			<div class="dasboard">
				<div class="dashboard__row">
					<a href="#" class="dashboard__link">
						<div class="dashboard__item">
								<span class="dashboard__icon material-icons md-18">fingerprint</span>
								<span class="dashboard__title">Пользователи</span>
								<span class="dashboard__badge">5</span>
						</div>
					</a>
					<a href="" class="dashboard__link">
						<div class="dashboard__item">
							<span class="dashboard__icon material-icons md-18">group</span>
							<span class="dashboard__title">Сотрудники</span>
							<span class="dashboard__badge">5</span>
						</div>
					</a>
					<a href="" class="dashboard__link">
						<div class="dashboard__item">
							<span class="dashboard__icon material-icons md-18">account_tree</span>
							<span class="dashboard__title">Отделения</span>
							<span class="dashboard__badge">5</span>
						</div>
					</a>
					<a href="" class="dashboard__link">
						<div class="dashboard__item">
							<span class="dashboard__icon material-icons md-18">article</span>
							<span class="dashboard__title">Новости</span>
							<span class="dashboard__badge">5</span>
						</div>
					</a>
					<a href="" class="dashboard__link">
						<div class="dashboard__item">
							<span class="dashboard__icon material-icons md-18">receipt_long</span>
							<span class="dashboard__title">Документы</span>
							<span class="dashboard__badge">5</span>
						</div>
					</a>
					<a href="" class="dashboard__link">
						<div class="dashboard__item">
							<span class="dashboard__icon material-icons md-18">card_membership</span>
							<span class="dashboard__title">Сертификаты</span>
							<span class="dashboard__badge">5</span>
						</div>
					</a>
					<a href="" class="dashboard__link">
						<div class="dashboard__item">
							<span class="dashboard__icon material-icons md-18">price_change</span>
							<span class="dashboard__title">Прейскурант</span>
							<span class="dashboard__badge">5</span>
						</div>
					</a>
				</div>
			</div>
			<div class="main-content">
				<div class="main-content__row">
					<div class="main-content__block">
						<div class="main-content__content"></div>
					</div>
					<div class="main-content__block">
						<div class="main-content__content"></div>
					</div>
					<div class="main-content__block">
						<div class="main-content__content"></div>
					</div>
				</div>
			</div>
		</div>


	</div>


	<script type="text/javascript" src="/admin/js/new_script.js"></script>
</body>

</html>