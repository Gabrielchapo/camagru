<div class="row">

	<?php $this->_t = 'Instagab';

	foreach($images as $image): ?>
	<div class="column">
		<img src="<?= "../public/pictures/".$image->getAdress() ?>">
	</div>
	<?php endforeach; ?>

</div>
<br><br><br>