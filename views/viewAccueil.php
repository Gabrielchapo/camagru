<div class="row">

	<?php $this->_t = 'Instagab';
	$i = 0;
	foreach($images as $image): 
	$i += 1;
	if (8 * $page < $i && $i <= 8 * $page + 8)
	{?>
	<div class="column">
		<img src="<?= "../public/pictures/".$image->getAdress() ?>">
		<div class="comment">
		On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L'avantage du Lorem Ipsum sur un texte générique comme 'Du texte. Du texte. Du texte.' est qu'il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour 'Lorem Ipsum' vous conduira vers de nombreux sites qui n'en sont encore qu'à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d'y rajouter de petits clins d'oeil, voire des phrases embarassantes).
		</div>
		<div class="likes">
		Aucun likes sa mere
		</div>
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