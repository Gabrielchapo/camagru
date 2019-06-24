<div class="row">

	<?php $this->_t = 'Instagab';
	$i = 0;
	foreach($images as $image): 
	$i += 1;
	if (8 * $page < $i && $i <= 8 * $page + 8)
	{?>
	<div class="column">
		<img src="<?= "../public/pictures/".$image->getAdress() ?>">
	</div>
	<?php }endforeach; ?>
</div>
<div class="row center">
	<?php 
	if ($page > 0)
	{
		?><a href="<?= URL ?>?url=Accueil&submit=malus&nb=<?= $page ?>" class="myButton"><</a><?php
	}
	?><a class="myButton"><?= $page + 1 ?> / <?= ceil($nb_images / 8) ?></a><?
	if ($page + 1 < ceil($nb_images / 8))
	{
		?><a href="<?= URL ?>?url=Accueil&submit=plus&nb=<?= $page ?>" class="myButton">></a><?php
	}?>
</div>