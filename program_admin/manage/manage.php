<head>
    <title>网站管理</title>
    <link type="text/css" rel="stylesheet" href="<?= $PUB_RES ?>/css/base.css"/>
    <link type="text/css" rel="stylesheet" href="<?= $PRI_RES ?>/css/manage.css"/>
</head>
<body>
<h1 class="title">☸ 网站管理</h1>
<div class="center">
    <table class="table">
        <thead>
        <tr>
            <th class="tdCenter event">项目</th>
            <th class="tdCenter setting">设置</th>
            <th class="tdCenter option">操作</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="tdCenter">网站名称</td>
            <td class="tdLeft">
                <input class="input-text" id="webNameInp" type="text" value="<?=$F->get_web_title();?>">
            </td>
            <td class="tdCenter">
                <span class="text-btn" id="webNameSubmit">确定</span>
            </td>
        </tr>
        <tr>
            <td class="tdCenter">电脑端网址</td>
            <td class="tdLeft">
                <input class="input-text" id="linkInp" type="text" value="<?=$F->get_web_link();?>">
            </td>
            <td class="tdCenter">
                <span class="text-btn" id="linkSubmit">确定</span>
            </td>
        </tr>
        <tr>
            <td class="tdCenter">移动端网址</td>
            <td class="tdLeft">
                <input class="input-text" id="mobileLinkInp" type="text" value="<?=$F->get_mobile_link();?>">
            </td>
            <td class="tdCenter">
                <span class="text-btn" id="mobileLinkSubmit">确定</span>
            </td>
        </tr>
        <tr>
            <td class="tdCenter">网站logo</td>
            <td class="tdLeft">
                <form id="logoImg" method="post" action="upload.act.php" enctype="multipart/form-data" target="ifr">
                <img class="logo" src="<?=$F->get_logo_src();?>"/>
                <div class="img-del" id="logoDel">✖</div>
                </form>
            </td>
            <td class="tdCenter">
                <span class="text-btn" id="logoSub">确定</span>
            </td>
        </tr>
        <tr>
            <td class="tdCenter">网站图标</td>
            <td class="tdLeft">
                <form id="faviconImg" method="post" action="upload.act.php" enctype="multipart/form-data" target="ifr">
                <img class="favicon" src="<?=$F->get_favicon_src();?>"/>
                <div class="img-del" id="faviconDel">✖</div>
                </form>
            </td>
            <td class="tdCenter">
                <span class="text-btn" id="faviconSub">确定</span>
            </td>
        </tr>
        <tr>
            <td class="tdCenter">网站简介</td>
            <td class="tdLeft">
                <textarea class="textarea" id="introInp"><?=$F->get_web_intro();?></textarea>
            </td>
            <td class="tdCenter">
                <span class="text-btn" id="introSubmit">确定</span>
            </td>
        </tr>
        <tr>
            <td class="tdCenter">网站主关键词</td>
            <td class="tdLeft">
                关键词，关键词，关键词，关键词，关键词，
            </td>
            <td class="tdCenter">
                <span class="" id="">确定</span>
            </td>
        </tr>
        <tr>
            <td class="tdCenter">管理员</td>
            <td class="tdLeft">
                用户名：<input class="input-text" id="nameInp" type="text" value="<?=$F->get_admin_name();?>"/>&nbsp;&nbsp;
                旧密码：<input class="input-text" id="oldPasswordInp" type="password" value=""/>&nbsp;&nbsp;
                新密码：<input class="input-text" id="newPasswordInp" type="password" value=""/>
            </td>
            <td class="tdCenter">
                <span class="text-btn" id="adminSubmit">确定</span>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<iframe style="display: none" id="ifr" name="ifr"></iframe>
<script type="text/javascript" src="<?= $PUB_RES ?>/js/Ajax.class.js"></script>
<script type="text/javascript" src="<?= $PUB_RES ?>/js/UploadPreview.class.js"></script>
<script type="text/javascript" src="<?= $PRI_RES ?>/js/manage.js"></script>
</body>