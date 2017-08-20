<!-- 模块3 -->
<?php
$main3ArticleList = $F->get_article_pages(1, 8, 24, '');
?>
<div class="module3">
    <h2 class="module3-title">产品案例</h2>
    <div class="module3-intro">
        公司拥有优秀管理人才，高素质的营销队伍，凭借专业的业务操作，为客户提供上门揽货、为客户提供上门揽货、仓库自提、货物派送上门、安排货仓等点对点，门对门一站式快捷服务，可提供网上查询货物信息。
    </div>
    <?php foreach ($main3ArticleList['data'] as $key => $value) {
        $lastClass = '';
        if ($key % 3 == 0) {
            $lastClass = ' module3-item-last';
        }
        ?>
        <a href="item-<?= $value['id'] ?>.html" target="_blank">
            <img class="module3-item <?= $lastClass ?>" src="<?= explode(',', $value['feature_img'])[0]; ?>"
                 target="_blank" alt=""/>
        </a>
        <?php
    } ?>
</div>