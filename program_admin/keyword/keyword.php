<head>
    <title>设置分类</title>
    <link type="text/css" rel="stylesheet" href="<?= $PUB_RES ?>/css/base.css"/>
    <link type="text/css" rel="stylesheet" href="<?= $PRI_RES ?>/css/keyword.css"/>
</head>
<body>
<h1 class="title">☸ 添加关键词</h1>
<div class="center keyword">
    <div class="keyword-title">
        <span class="keyword-id">序号</span>
        <span class="keyword-name">名称</span>
        <span class="keyword-option">操作</span>
    </div>
    <div class="keyword-add">
        <span class="keyword-id">✚</span>
        <span class="keyword-name"><input class="input-text keyword-add-name" id="keywordName" type="text" placeholder="分类名称"/></span>
        <span class="keyword-option">
            <input class="btn-keyword-add input-btn" id="addKeyword" type="button" value="添加"/>
        </span>
    </div>

    <div class="keyword-title">
        <div class="keyword-id">序号</div>
        <div class="keyword-name">名称</div>
        <div class="keyword-article-sum">文章数量</div>
        <div class="keyword-option">操作</div>
    </div>
    <div id="keywordItem">
        <?php
        $keyword_list = $F->get_keyword_list();
        $i = 0;
        foreach ($keyword_list as $value) {
            ?>
            <div class="keyword-item">
                <div class="keyword-id"><?= ++$i ?></div>
                <div class="keyword-name"><?= $value['name'] ?></div>
                <div class="keyword-article-sum"><?= $value['article_count'] ?>&nbsp;篇</div>
                <div class="keyword-option">
                    <span class="text-btn text-btn-yellow keyword-modify" cid="<?= $value['id'] ?>">修改</span>
                    <span class="text-btn text-btn-red keyword-delete" cid="<?= $value['id'] ?>">删除</span>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<script type="text/javascript" src="<?= $PUB_RES ?>/js/Ajax.class.js"></script>
<script type="text/javascript" src="<?= $PUB_RES ?>/js/Windows.class.js"></script>
<script type="text/javascript" src="<?= $PRI_RES ?>/js/keyword.js"></script>
</body>