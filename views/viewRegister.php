<?php $this->_t = 'REGISTER';?>

<form method="POST" action="<?= URL ?>?url=register&submit=ok">
    <div class="container">
        <input type="text" placeholder="Enter Login" name="login" required><br>
        <a style="color:red;"><?= $errorMsg['login'] ?></a><br>

        <input type="text" placeholder="Enter Email" name="email" required><br>
        <a style="color:red;"><?= $errorMsg['email'] ?></a><br>

        <input type="password" placeholder="Enter Password" name="password" required><br>
        <a style="color:red;"><?= $errorMsg['password'] ?></a><br>

        <input type="password" placeholder="Repeat Password" name="password_repeat" required><br>
        <a style="color:red;"><?= $errorMsg['password_repeat'] ?></a><br>

        <button type="submit">Register</button>
    </div>
</form>
