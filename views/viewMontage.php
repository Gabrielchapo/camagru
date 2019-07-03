<div class="row">
	<div class="main">
		<div class="sidebar">
			<?php $this->_t = 'Montage';

			foreach($images as $image): ?>
				<a href="#" id="red_cross" onclick="deleteImg(<?= $image->getId_image()?>)">X </a>
				<img src="<?= "../public/pictures/".$image->getaddress() ?>">
			<?php endforeach; ?>
		</div>

		<div class="filter">
			<img src="../public/filters/42.png" onclick="selectFilter('42.png')"?>
			<img src="../public/filters/apple.png"onclick="selectFilter('apple.png')"?>
		</div>

		<div class="montage">
            <div class="inside">
                <video class="camera_view" id="video" autoplay></video>
                <canvas class="imported" id="imported"></canvas>
                <div class="filter_view">
                    <img class="filter_img" id="filter_image" src="">
                </div>
                <canvas class="snap_view" id="snap_canvas"></canvas>
			</div>
			<div class="buttons_list">
                <button  type="button" disabled class="snap_button" id="snap_button" onclick="checkButton()">Snap it!</button>
                <button class="import_button" id="import_button">Import a picture</button>
                <input type="file" id="imgLoader"/>
            </div>
		</div>
	</div>
</div>
<script src="<?= URL ?>public/js/montage.js"></script>