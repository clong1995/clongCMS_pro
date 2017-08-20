<!-- 模块2 -->
<?php
$main2Article = $F->get_article_by_id('1501945265NXHE');
?>
<div class="module2">
    <div class="module2-title">
        <h2 class="module2-title-text"><?= $main2Article[0]['title'] ?></h2>
        <div class="hr module2-hr">
            <div class="module2-hr-block"></div>
        </div>
    </div>
    <img class="module2-img" src="<?= explode(',', $main2Article[0]['feature_img'])[0]; ?>" alt=""/>
    <div class="module2-intro"><?= $main2Article[0]['intro'] ?><a href="item-<?= $main2Article[0]['id'] ?>.html" target="_blank">[详情]</a></div>
</div>