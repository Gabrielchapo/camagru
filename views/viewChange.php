<?php $this->_t = 'Change password';?>

<form method="POST" action="<?= URL ?>?url=reset&submit=confirm&token=<?= $errorMsg['token'] ?>">
    <div class="container">
        <input type="password" placeholder="Enter Password" name="password" required>
        <a style="color:red;"><?= $errorMsg['password'] ?></a><br>

        <input type="password" placeholder="Repeat Password" name="password_repeat" required>
        <a style="color:red;"><?= $errorMsg['password_repeat'] ?></a><br>

        <button type="submit">Change password</button>
    </div>
</form>