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
			<h1>InstaGab  </h1>
			<p> Share your best pics </p>
		</div>
		<div class="navbar">
			<a href="<?= URL ?>" class="active">Home</a>
			<?php
				session_start();
				if ($_SESSION['login']) {?>
				<a href="<?= URL ?>?url=Accueil&submit=logout" class="right">LOGOUT</a>
				<a href="<?= URL ?>?url=Profil" class="right">PROFIL</a>
			<?php } else { ?>
				<a href="<?= URL ?>?url=login" class="right">LOGIN</a>
			<?php } ?>
		</div>
		
		<?= $content ?>

		<div class="footer">
			<h2>Footer</h2>
		</div>
	</body>
</html>