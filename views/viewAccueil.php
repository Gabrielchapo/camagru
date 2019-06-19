<?php $this->_t = 'Mon blog';
foreach($articles as $article): ?>
<h2><?= $article->title() ?></h2>
<time><?= $article->date() ?></time>
<?php endforeach; ?>
<a href="<?= URL ?>?url=login">LOGIN</a>