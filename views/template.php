<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../public/css/style.css" type="text/css">
		<link rel="icon" href="../public/icons/icon.png" />
		<title><?= $t ?></title>
	</head>
	<body>
		<div class="navbar">
		<h1>InstaGab</h1>
			<a href="<?= URL ?>" class="active">Home</a>
			<?php
				session_start();
				if ($_SESSION['login']) {?>
				<a href="<?= URL ?>?url=Accueil&submit=logout">Logout</a>
				<a href="<?= URL ?>?url=Profil">Profil</a>
				<a href="<?= URL ?>?url=Montage">Montage</a>
			<?php } else { ?>
				<a href="<?= URL ?>?url=login">Login</a>
			<?php } ?>
		</div>
		
		<?= $content ?>
		<footer>
    		<h2>Instagab ©</h2>
		</footer>
	</body>
</html>