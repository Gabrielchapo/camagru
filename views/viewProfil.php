<div class="main">
	<div class="sidebar">
		<?php $this->_t = 'Profil';

		foreach($images as $image): ?>
			<img src="<?= "../public/pictures/".$image->getAdress() ?>">
		<?php endforeach; ?>
	</div>
	<div class="montage">
	</div>
</div>