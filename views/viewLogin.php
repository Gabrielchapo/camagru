<?php $this->_t = 'LOGIN';?>

<form method="POST" action="<?= URL ?>?url=login&submit=ok">
    <div class="container">
        <input type="text" placeholder="Enter Login" name="login" required><br>
        <input type="password" placeholder="Enter Password" name="password" required><br>
        <a style="color:red;"><?= $errorMsg ?></a><br>
        <button type="submit">login</button><br><br>
        <a> Not yet a member ?</a>
        <a href="<?= URL ?>?url=register">REGISTER HERE</a><br><br>
        <a> Forgot Password ?</a>
        <a href="<?= URL ?>?url=reset">SEND RESET EMAIL HERE</a>
    </div>
</form>
