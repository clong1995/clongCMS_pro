<?php
$id = $RArr[1];
$page = $RArr[2];
$rs = $F->get_article_pages($page, 4, $id, '');

$data = $rs['data'];
$info = $rs['info'];
?>
<div class="center sum">
    <?php
    foreach ($data as $value) {
        ?>
        <div class="sum-item">
            <img class="sum-item-img" src="/<?= explode(',', $value['feature_img'])[0]; ?>" alt=""/>
            <a href="item-<?= $value['id'] ?>.html" target="_blank">
                <h3 class="sum-item-title ellipsis"><?= $value['title'] ?></h3>
            </a>
            <div class="sum-item-intro"><?= $value['intro'] ?></div>
        </div>
        <?php
    }
    ?>
</div>


<div class="center sum-page-bar">
    <?php
    for ($p = 1; $p <= $info['allPage']; ++$p) {
        $pageClass = '';
        if ($p == $info['page']) {
            $pageClass = ' page-item-selected';
        }
        ?>
        <a href="list-<?= $id ?>-<?= $p ?>.html" class="sum-page-item<?= $pageClass ?>"><?= $p ?></a>
        <?php
    }
    ?>
</div>

