<?php $this->_t = 'Instagab';
foreach($images as $image): ?>
<h2><?= $image->getId_image() ?></h2>
<img src="<?= "../public/pictures/".$image->getAdress() ?>">
<?php endforeach; ?><br><br><br>
<a href="<?= URL ?>?url=login">LOGIN</a>