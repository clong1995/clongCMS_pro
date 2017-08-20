<head>
    <title>文章管理</title>
    <link type="text/css" href="<?= $PUB_RES ?>/css/base.css" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="<?= $PRI_RES ?>/css/article_manager.css"/>
</head>
<body>
<h1 class="title">☸ 文章管理</h1>
<div class="center">
    <div class="article-title">
        <span class="article-time">时间</span>
        <span class="article-name">标题</span>
        <span class="article-category">类别</span>
        <span class="article-keyword">关键词</span>
        <span class="article-browse">点击量</span>
        <span class="article-comment">评论量</span>
        <span class="article-author">作者</span>
        <span class="article-option">操作</span>
    </div>
    <div class="article-items" id="articleItems">
        <!--
        <div class="article-item">
            <span class="article-time">2017/8/1 13:21:09</span>
            <span class="article-name ellipsis">家纺用品生产发展家纺用展家纺</span>
            <span class="article-category ellipsis">业务范围,产品案例,产品案例</span>
            <span class="article-keyword ellipsis">关键词,关键词,关键词</span>
            <span class="article-browse">12</span>
            <span class="article-comment">5</span>
            <span class="article-author">administrator</span>
            <span class="article-option">修改 删除 存为草稿</span>
        </div>
        -->
    </div>
    <div class="article-items-pages" id="articleItemsPages"></div>
</div>
<script type="text/javascript" src="<?= $PUB_RES ?>/js/Ajax.class.js"></script>
<script type="text/javascript" src="<?= $PRI_RES ?>/js/article_manager.js"></script>
</body>