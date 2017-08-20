<head>
    <title>控制台</title>
    <link type="text/css" href="<?= $PUB_RES ?>/css/base.css" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="<?= $PRI_RES ?>/css/console.css"/>
</head>
<body>
<div class="header">
    <span class="header-item">您好：administrator</span>
    <span class="header-item">操作：<span class="text-btn text-btn-red">退出</span></span>
</div>
<div class="center main">
    <div class="block block-1">
        <h3 class="block-title">常用操作</h3>
        <span class="block-1-item text-btn">发布文章</span>
        <span class="block-1-item text-btn">打开手机端</span>
        <span class="block-1-item text-btn">清理缓存</span>
        <span class="block-1-item">分享到:</span>
    </div>

    <div class="block block-2">
        <h3 class="block-title">网站概况</h3>
        <table border="0" class="block-2-table">
            <tr>
                <td class="table-b2-left">网站名称</td>
                <td class="table-b2-right"><?=$F->get_web_title();?></td>
            </tr>
            <tr>
                <td class="table-b2-left">电脑端网址</td>
                <td class="table-b2-right"><?=$F->get_web_link();?></td>
            </tr>
            <tr>
                <td class="table-b2-left">移动端网址</td>
                <td class="table-b2-right">m.company.com</td>
            </tr>
            <tr>
                <td class="table-b2-left">关键词</td>
                <td class="table-b2-right">关键词，关键词，关键词，关键词，关键词，关键词</td>
            </tr>
            <tr>
                <td class="table-b2-left">网站描述</td>
                <td class="table-b2-right"><?=$F->get_web_intro();?></td>
            </tr>
        </table>
    </div>


    <div class="block block-3">
        <h3 class="block-title">网站统计</h3>
        <table border="0" class="block-3-table">
            <tr>
                <td class="table-b3-left">网站点击量</td>
                <td class="table-b3-right">100次</td>
            </tr>
            <tr>
                <td class="table-b3-left">文章数量</td>
                <td class="table-b3-right">50篇</td>
            </tr>
            <tr>
                <td class="table-b3-left">草稿</td>
                <td class="table-b3-right">10篇</td>
            </tr>
            <tr>
                <td class="table-b3-left">站内图片</td>
                <td class="table-b3-right">100张</td>
            </tr>
            <tr>
                <td class="table-b3-left">分类</td>
                <td class="table-b3-right">5个</td>
            </tr>
            <tr>
                <td class="table-b3-left">评论</td>
                <td class="table-b3-right">10条<a href="">3条未审核</a></td>
            </tr>
            <tr>
                <td class="table-b3-left">主题</td>
                <td class="table-b3-right">3个</td>
            </tr>
        </table>
    </div>
</div>
</body>