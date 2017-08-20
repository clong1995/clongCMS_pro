<!-- base.css在这里影响到了编辑器故不使用 -->
<head>
    <title>发布文章</title>
    <link type="text/css" rel="stylesheet" href="<?= $PRI_RES ?>/css/article_add.css"/>
</head>
<body>
<div class="center">
    <h1 class="table-title">☸ 发布文章</h1>
    <table class="table" cellspacing="0">
        <tr>
            <td class="tdRight">标题：</td>
            <td class="tdLeft">
                <input class="title" type="text" value="" id="title" placeholder="填写文章标题"/>
            </td>
        </tr>
        <tr>
            <td class="tdRight">简介：</td>
            <td class="tdLeft">
                <textarea class="intro" id="intro" placeholder="填写文章简介"/></textarea>
            </td>
        </tr>
        <tr>
            <td class="tdRight">分类：</td>
            <td class="tdLeft">
                <!--<span class="category-item">✖ 分类一</span>-->
                <span class="add-category" id="addCategory">✚ 添加分类</span>
            </td>
        </tr>
        <tr>
            <td class="tdRight">关键词：</td>
            <td class="tdLeft">
                <!--<span class="keyword-item">✖ 关键词一</span>-->
                <span class="add-keyword" id="addKeyword">✚ 添加关键词</span>
            </td>
        </tr>
        <tr>
            <td class="tdRight">特色图片：</td>
            <td class="tdCenter">
                <form id="featureImg" method="post" action="upload.act.php" enctype="multipart/form-data" target="ifr">
                    <span id="uploadBtn"></span>
                </form>
            </td>
            <iframe style="display: none" id="ifr" name="ifr"></iframe>
        </tr>
        <tr>
            <td class="tdRight">文章：</td>
            <td class="tdLeft">
                <div id="toolbar" class="toolbar"></div>
                <div class="article" id="article"></div>
            </td>
        </tr>
        <tr>
            <td class="tdRight">操作：</td>
            <td class="tdCenter">
                <input class="btn-submit" id="btnSubmit" type="button" value="立即发布">
                <input class="btn-draft" id="btnDraft" type="button" value="存为草稿">
                <a style="text-decoration: none;" href="article_manager.xhtml">
                    <input class="btn-cancel" type="button" value="放弃">
                </a>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript" src="<?= $PUB_RES ?>/js/wangEditor.js"></script>
<script type="text/javascript" src="<?= $PUB_RES ?>/js/UploadPreview.class.js"></script>
<script type="text/javascript" src="<?= $PUB_RES ?>/js/Windows.class.js"></script>
<script type="text/javascript" src="<?= $PUB_RES ?>/js/Ajax.class.js"></script>
<script type="text/javascript" src="<?= $PRI_RES ?>/js/article_add.js"></script>
</body>