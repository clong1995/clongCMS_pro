<head>
    <title>设置导航</title>
    <link type="text/css" href="<?= $PUB_RES ?>/css/base.css" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="<?= $PRI_RES ?>/css/navigation.css"/>
</head>
<body>
<h1 class="title">☸ 设置导航</h1>
<div class="center navigation">
    <div class="navigation-title">
        <span class="navigation-num">序号</span>
        <span class="navigation-name">名称</span>
        <span class="navigation-model">链接到</span>
        <span class="navigation-position">位置</span>
        <span class="navigation-option">操作</span>
    </div>
    <div class="navigation-add">
        <span class="navigation-num">✚</span>
        <span class="navigation-name"><input class="navigation-add-name input-text" id="navigationAddName" type="text"
                                             placeholder="导航名称"/></span>
        <span class="navigation-model">
            <span class="model-selected" id="modelSelected"></span>
            <span class="text-btn" id="navigationAdd">选择</span>
        </span>
        <span class="navigation-position">
            <input class="navigation-add-position input-text" id="navigationSort" type="text"/>
        </span>
        <span class="navigation-option text-btn">
            <input class="navigation-add-btn input-btn" id="navigationAddBtn" value="添加" type="button">
        </span>
    </div>


    <div class="navigation-title">
        <span class="navigation-num">序号</span>
        <span class="navigation-name">名称</span>
        <span class="navigation-model">链接到</span>
        <span class="navigation-position">位置</span>
        <span class="navigation-option">操作</span>
    </div>

    <div id="navigationItems">
        <!--
        <div class="navigation-item">
            <span class="navigation-num">1</span>
            <span class="navigation-name">首页</span>
            <span class="navigation-model">首页</span>
            <span class="navigation-position">1</span>
            <span class="navigation-option">修改 删除</span>
        </div>
        -->
    </div>
</div>
<script type="text/javascript" src="<?= $PUB_RES ?>/js/Ajax.class.js"></script>
<script type="text/javascript" src="<?= $PUB_RES ?>/js/Windows.class.js"></script>
<script type="text/javascript" src="<?= $PRI_RES ?>/js/navigation.js"></script>
</body>