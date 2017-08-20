<?php
$id = $RArr[1];
$article = $F->get_article_by_id($id);
?>
<div class="center article">
    <h1 class="item-article-title"><?= $article[0]['title'] ?></h1>
    <?= $article[0]['article'] ?>
</div>