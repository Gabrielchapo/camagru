<div class="row">
	<div class="main">
		<div class="sidebar">
			<?php $this->_t = 'Montage';

			foreach($images as $image): ?>
				<img src="<?= "../public/pictures/".$image->getAdress() ?>">
			<?php endforeach; ?>
		</div>
		<div class="montage">
			<video id="video" autoplay="true"></video>
			<button id="takepicturebttn" onclick="takepicture()">Take picture</button>
			<div class="canvas__container">
				<canvas id="canvas" class="canvas__canvas"></canvas>
				<img src="" id="mirror" class="canvas__mirror" />
			</div>
			<button class="button" onclick="downloadPicture()">Download</button>
		</div>
	</div>
</div>
<script src="<?= URL ?>public/js/montage.js"></script>