<div class="row">
	<div class="main">
		<?php
		session_start();
		$this->_t = 'Instagab';
		$i = 0;
		foreach($images as $image): 
			$i += 1;
			if (8 * $page < $i && $i <= 8 * $page + 8)
			{?>
				<div class="column">

					<!-- IMAGE SECTION -->
					<img src="<?= "../public/pictures/".$image->getAddress() ?>">
					
					<!-- LIKES SECTION -->
					<?php
						$nb_likes = 0;
						$liked = false;
						foreach($likes as $like): 
							if ($like->getId_image() == $image->getId_image())
							{
								$nb_likes += 1;
								if ($like->getId_author() === $_SESSION["id"])
								{$liked = true;}
							}
						endforeach;
						?>
						<div class="likes">
							<?php if ($liked == false) { ?> <img id="like_logo<?= $image->getId_image() ?>" onclick="like(<?= $image->getId_image() ?>, <?= $_SESSION['id'] ?>)" src="../public/icons/dislike.png"> <?php } 
							else { ?> <img id="like_logo<?= $image->getId_image() ?>" onclick="like(<?= $image->getId_image() ?>, <?= $_SESSION['id'] ?>)" src="../public/icons/like.png"> <?php } ?>
							<a id="nb_likes<?= $image->getId_image() ?>"> <?= $nb_likes ?> </a>
							<a>&nbsp;Like(s)</a>
						</div>


					<!-- COMMENTS SECTION -->
					<?php if ($_SESSION['login']) 
						{?>
						<form method="POST" action="<?= URL ?>?url=Accueil&submit=comment&id_picture=<?= $image->getId_image() ?>&nb=<?= $page ?>">
							<input placeholder="Type your comment here" type="text" name="comment">
						</form>
					<?php } ?>
					<div class="comment"> <?php

					foreach($comments as $comment):
						if ($image->getId_image() == $comment->getId_picture())
						{
							echo "<a><b>".$comment->getDate_comment()." - </b></a>";
							echo "<a>".$comment->getContent()."</a></br></br>";
						}
					endforeach;?>
					</div>

				</div>
			<?php
			}
		endforeach; ?>
	</div>
	</div>

	<!-- PAGINATION -->
	<div class="row center">
		<?php 
		if ($page > 0)
		{
			?><a href="<?= URL ?>?url=Accueil&submit=malus&nb=<?= $page ?>" class="myButton"><</a><?php
		}
		?><a class="myButton"><?= $page + 1 ?> / 
		<?php $tot = ceil($nb_images / 8);
		if ($tot == 0)
		{echo '1';}
		else {echo $tot;} ?>
		</a><?
		if ($page + 1 < ceil($nb_images / 8))
		{
			?><a href="<?= URL ?>?url=Accueil&submit=plus&nb=<?= $page ?>" class="myButton">></a><?php
		}?>
	</div>
<script src="<?= URL ?>public/js/like.js"></script>