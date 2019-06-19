<?php $this->_t = 'REGISTER';?>
<form method="POST" action="<?= URL ?>?url=register&submit=ok">
	<input type="text" placeholder="Enter Login" name="login" required>
    <input type="text" placeholder="Enter Email" name="email" required>
    <input type="password" placeholder="Enter Password" name="password" required>
    <input type="password" placeholder="Repeat Password" name="password_repeat" required>
    <button type="submit">Register</button>
</form>