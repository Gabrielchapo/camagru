<?php $this->_t = 'LOGIN';?>

<form method="POST" action="<?= URL ?>?url=login&submit=ok">
    <div class="container">
        <h1>Login</h1>
        <input type="text" placeholder="Enter Login" name="login" required><br>
        <input type="password" placeholder="Enter Password" name="password" required><br>
        <a style="color:red;"><?= $errorMsg ?></a><br>
        <a> Forgot Password ?</a>
        <a href="<?= URL ?>?url=reset">SEND EMAIL HERE</a>
        <button type="submit">log-in</button>
        <a> Not yet a member ?</a>
        <a href="<?= URL ?>?url=register">REGISTER HERE</a>
    </div>
</form>
