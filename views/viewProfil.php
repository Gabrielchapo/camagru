<?php $this->_t = 'Profil';?>
<div class="row">
	<div class="container">
		<h1>Preferences</h1>
		<button class="preference_button" onclick="checkPreferenceButton()">Desactivate notifications</button>
	</div><br><br>
	<div class="container">
		<h1>Modify Account</h1>
		<form method="POST" action="<?= URL ?>?url=Profil&submit=modify">
			<div class="container">
				<input type="text" placeholder="Enter New Login" name="login">
				<a style="color:red;"><?= $errorMsg['login'] ?></a><br>
				<a>OR</a>
				<input type="text" placeholder="Enter New Email" name="email">
				<a style="color:red;"><?= $errorMsg['email'] ?></a><br>
				<a>OR</a>
				<input type="password" placeholder="Enter New Password" name="password">
				<a style="color:red;"><?= $errorMsg['password'] ?></a><br>

				<input type="password" placeholder="Repeat New Password" name="password_repeat">
				<a style="color:red;"><?= $errorMsg['password_repeat'] ?></a><br>

				<button type="submit">Modify</button>
			</div>
		</form>
		<form method="POST" action="<?= URL ?>?url=Profil&submit=delete">
			<div class="container">
				<button type="submit" class="red" >Delete account</button>
			</div>
		</form>
	</div>
</div>
<script src="<?= URL ?>public/js/Profil.js"></script>