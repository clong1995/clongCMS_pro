<?php
$web_title = $F->get_web_title();
$web_link = $F->get_web_link();
$mod_link = $F->get_mobile_link();
$logo_src = $F->get_logo_src();
$favicon_src = $F->get_favicon_src();
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://<?= $mod_link ?>" rel="alternate" media="only screen and (max-width: 1190px)"/>
    <script type="text/javascript">
        (function (mob_url) {
            if (/iphone|ipod|ipad|ipad|Android|nokia|blackberry|webos|webos|webmate|bada|lg|ucweb|skyfire|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|wap|mobile/i.test(navigator.userAgent.toLowerCase())) {
                window.location.href = 'http://'+mob_url;
            }
        })('<?= $mod_link ?>')
    </script>
    <title><?= $web_title ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= $favicon_src ?>" media="screen"/>
    <link type="text/css" href="<?= $PUB_RES ?>/css/base.css" rel="stylesheet"/>
</head>
<body>

