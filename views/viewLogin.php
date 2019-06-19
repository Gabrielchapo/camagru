<?php $this->_t = 'Les membres';
foreach($members as $member): ?>
<h2><?= $member->getLogin() ?></h2>
<time><?= $member->getEmail() ?></time>
<?php endforeach; ?><br><br>
<a href="<?= URL ?>?url=register">REGISTER</a>
