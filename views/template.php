<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" :>
		<link rel="stylesheet" href="../public/css/style.css" type="text/css">
		<title><?= $t ?></title>
	</head>
	<header>
		<h1><a href="<?= URL ?>">INSTAGAB</a></h1>
		<p>Bienvenue sur mon camagru</p>
		<?php if ($_SESSION['login'])
		{
			?>
			<a>YOU ARE CONNECTED <?= $_SESSION['login']?>!</a>
			<a href="<?= URL ?>?url=Accueil&submit=logout">LOGOUT</a>
			<?php
		}?>
	</header>
		<?= $content ?>
	<footer>
		<p>Créé par Gabriel Drai</p>
	</footer>
</html>