<head>
    <title>设置分类</title>
    <link type="text/css" rel="stylesheet" href="<?= $PUB_RES ?>/css/base.css"/>
    <link type="text/css" rel="stylesheet" href="<?= $PRI_RES ?>/css/category.css"/>
</head>
<body>
<h1 class="title">☸ 设置分类</h1>
<div class="center category">
    <div class="category-title">
        <span class="category-id">序号</span>
        <span class="category-name">名称</span>
        <span class="category-option">操作</span>
    </div>
    <div class="category-add">
        <span class="category-id">✚</span>
        <span class="category-name"><input class="input-text category-add-name" id="categoryNmae" type="text" placeholder="分类名称"/></span>
        <span class="category-option">
            <input class="btn-category-add input-btn" id="addCategory" type="button" value="添加"/>
        </span>
    </div>

    <div class="category-title">
        <div class="category-id">序号</div>
        <div class="category-name">名称</div>
        <div class="category-article-sum">文章数量</div>
        <div class="category-option">操作</div>
    </div>
    <div id="categoryItem">
        <?php
        $category_list = $F->get_category_list();
        $i = 0;
        foreach ($category_list as $value) {
            ?>
            <div class="category-item">
                <div class="category-id"><?= ++$i ?></div>
                <div class="category-name"><?= $value['name'] ?></div>
                <div class="category-article-sum"><?= $value['article_count'] ?>&nbsp;篇</div>
                <div class="category-option">
                    <span class="text-btn text-btn-yellow category-modify" cid="<?= $value['id'] ?>">修改</span>
                    <span class="text-btn text-btn-red category-delete" cid="<?= $value['id'] ?>">删除</span>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<script type="text/javascript" src="<?= $PUB_RES ?>/js/Ajax.class.js"></script>
<script type="text/javascript" src="<?= $PUB_RES ?>/js/Windows.class.js"></script>
<script type="text/javascript" src="<?= $PRI_RES ?>/js/category.js"></script>
</body>