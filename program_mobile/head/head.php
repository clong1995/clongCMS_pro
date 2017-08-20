<?php
$web_link = $F->get_web_link();
$mod_link = $F->get_mobile_link();
$web_title = $F->get_web_title();
?>
<head>
    <title><?=$web_title;?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge,chrome=1" />
    <meta name="renderer" content="webkit">
    <meta name="author" content="m.xxx.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="wap-font-scale" content="no">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link href="http://<?= $web_link; ?>" rel="canonical"/>
    <script type="text/javascript">
        //设置基础大小,1rem = 可视区宽度的1/10; 保证符合视觉稿的美感
        baseSize();

        window.onresize = function(){
            baseSize();
        }

        //基础大小函数
        function baseSize(){
            var doc = document.documentElement;
            var ww = doc.offsetWidth;
            doc.style.fontSize = ww/10+'px';
        }

        //跳转到PC
        function go_pc(pc_url) {
            if (!/iphone|ipod|ipad|ipad|Android|nokia|blackberry|webos|webos|webmate|bada|lg|ucweb|skyfire|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|wap|mobile/i.test(navigator.userAgent.toLowerCase())) {
                window.location.href = 'http://'+pc_url+'/';
            }
        }
    </script>
    <!-- 判断是否是移动设备，否则跳转到pc -->
    <script type="text/javascript">go_pc('<?=$web_link;?>');</script>

    <link type="text/css" href="<?= $PUB_RES ?>/css/base_m.css" rel="stylesheet"/>
    <link type="text/css" href="<?= $PUB_RES ?>/iconfont/iconfont.css" rel="stylesheet"/>
</head>
<body>