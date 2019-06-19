<?php $this->_t = 'LOGIN';?>

<form method="POST" action="<?= URL ?>?url=login&submit=ok">
	<input type="text" placeholder="Enter Login" name="login" required><br>
    <input type="password" placeholder="Enter Password" name="password" required><br>
    <button type="submit">log-in</button>
</form>

<a href="<?= URL ?>?url=register">REGISTER</a>
