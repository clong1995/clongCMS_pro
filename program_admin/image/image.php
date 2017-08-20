<head>
    <title>发布大图</title>
    <link type="text/css" rel="stylesheet" href="<?= $PUB_RES ?>/css/base.css"/>
    <link type="text/css" rel="stylesheet" href="<?= $PRI_RES ?>/css/image.css"/>
</head>
<body>
<h1 class="title">☸ 发布大图</h1>
<div class="center">
    <div class="image-add-title">
        <span>添加图片</span>
    </div>


    <div class="image-add">
        <form id="imgForm" method="post" action="upload.act.php" enctype="multipart/form-data" target="ifr">
            <span id="uploadBtn"></span>
        </form>
        <iframe style="display: none" id="ifr" name="ifr"></iframe>
    </div>


    <div class="image-add-btn">
        <input class="image-add-btn-submit" id="imageAddBtnSubmit" type="button" value="添加"/>
    </div>
</div>
<div class="center image-items">
    <div class="image-item-title">
        <span class="image-item-title-img">图片</span>
        <span class="image-item-title-opt">操作</span>
    </div>
    <div id="imageItems">
        <!--
        <div class="image-item">
            <img class="image-item-img" src="storage/show_1.gif" alt=""/>
            <div class="image-item-opt"> 修改 删除</div>
        </div>
        -->
    </div>
</div>

<script type="text/javascript" src="<?= $PUB_RES ?>/js/Ajax.class.js"></script>
<script type="text/javascript" src="<?= $PUB_RES ?>/js/UploadPreview.class.js"></script>
<script type="text/javascript" src="<?= $PRI_RES ?>/js/image.js"></script>
<script type="text/javascript">
    //上传图片的预览控件
    new UploadPreview({
        uploadID: 'uploadBtn',//按钮的id
        prevWidth: 120,//预览的宽度
        prevHeight: 100,//预览的高度
        max: 5//最大上传数
    });
</script>
</body>