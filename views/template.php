<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../public/css/style.css" type="text/css">
		<title><?= $t ?></title>
	</head>
	<body>
		<div class="header">
			<h1>InstaGab</h1>
			<p> Share your best pics. </p>
		</div>
		<div class="navbar">
			<a href="<?= URL ?>" class="active">Home</a>
			<?php
				session_start();
				if ($_SESSION['login']) {?>
				<a href="<?= URL ?>?url=Accueil&submit=logout" class="right">Logout</a>
				<a href="<?= URL ?>?url=Profil" class="right">Profil</a>
				<a href="<?= URL ?>?url=Montage" class="right">Montage</a>
			<?php } else { ?>
				<a href="<?= URL ?>?url=login" class="right">Login</a>
			<?php } ?>
		</div>
		
		<?= $content ?>
		<footer>
    		<h2>footer</h2>
		</footer>
	</body>
</html>