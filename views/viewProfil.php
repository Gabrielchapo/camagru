<?php $this->_t = 'Profil';?>
<div class="row">
	<div class="settings">
		<a>Preferences</a>
		
	</div>
	<div class="settings">
		<a>Modify Account</a>
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