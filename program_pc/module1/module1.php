<!-- 模块1 -->
<?php
$main1ArticleList = $F->get_article_pages(1, 2, 20, '');
?>
<div class="module1">
    <div class="module1-title">
        <h2 class="module1-title-text">业务范围</h2>
        <div class="module1-hr">
            <div class="module1-hr-block"></div>
        </div>
    </div>

    <?php foreach ($main1ArticleList['data'] as $value) {
        ?>
        <div class="module1-article">
            <img class="module1-article-img" src="<?= explode(',', $value['feature_img'])[0]; ?>" alt=""/>
            <a href="item-<?= $value['id'] ?>.html" target="_blank">
                <h3 class="module1-article-title ellipsis"><?= $value['title'] ?></h3>
            </a>
            <div class="module1-article-intro"><?= $value['intro'] ?></div>
        </div>
        <?php
    } ?>
</div>