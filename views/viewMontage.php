<div class="row">
	<div class="main">
		<div class="sidebar">
			<?php $this->_t = 'Montage';

			foreach($images as $image): ?>
				<img src="<?= "../public/pictures/".$image->getAdress() ?>">
			<?php endforeach; ?>
		</div>
		<div class="montage">
		</div>
	</div>
</div>