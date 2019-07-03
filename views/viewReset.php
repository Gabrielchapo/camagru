<?php $this->_t = 'RESET';?>

<form method="POST" action="<?= URL ?>?url=reset&submit=reset">
    <div class="container">
        <h1>Enter login here</h1>
        <input type="text" placeholder="Enter Login" name="login" required><br>
        <a style="color:red;"><?= $info ?></a><br>
        <button type="submit">send Email</button>
    </div>
</form>
