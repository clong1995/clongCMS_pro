<!-- 模块4 -->
<div class="module4">
    <div class="module4-title">
        <h2 class="module4-title-text">新闻详情</h2>
        <div class="module4-hr">
            <div class="module4-hr-block"></div>
        </div>
    </div>

    <?php
    $main4Article = $F->get_article_by_id('1501979061YPCS');
    ?>
    <div class="module4-left">
        <img class="module4-img" src="<?= explode(',', $main4Article[0]['feature_img'])[0]; ?>" alt=""/>
        <div class="module4-intro">
            <a href="item-<?= $main4Article[0]['id'] ?>.html" target="_blank">
                <h3 class="module4-article-title"><?= $main4Article[0]['title'] ?></h3>
            </a>
            <div class="module4-intro-text"><?= $main4Article[0]['intro'] ?></div>
        </div>
    </div>

    <div class="module4-right">
        <?php
        $main4ArticleList = $F->get_article_pages(1, 4, 25, '');
        foreach ($main4ArticleList['data'] as $key => $value) {
            ?>
            <div class="module4-right-item">
                <div class="module4-time">
                    <?= substr($value['time'], 0, 10) ?>
                    <div class="round"></div>
                </div>
                <div class="module4-right-intro">
                    <a href="item-<?= $value['id'] ?>.html" target="_blank">
                        <h3 class="module4-right-intro-title">
                            <?= $value['title'] ?>
                        </h3>
                    </a>
                    <div class="module4-right-intro-text">
                        <?= $value['intro'] ?>
                    </div>
                </div>
            </div>
            <?php
        } ?>
    </div>
</div>