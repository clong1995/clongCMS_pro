<?php
switch (req('act')) {
    case 'setWebLink':
        $link = req('link');
        echo $F->set_web_link($link);
        break;

    case 'setMobileLink':
        $link = req('link');
        echo $F->set_mobile_link($link);
        break;

    case 'setWebName':
        $title = req('title');
        echo $F->set_web_title($title);
        break;

    case 'setWebIntro':
        $intro = req('intro');
        echo $F->set_web_intro($intro);
        break;

    case 'setAdmin':
        $name = req('name');
        $newPassword = req('newPassword');
        $oldPassword = req('oldPassword');
        echo $F->set_admin($name,$newPassword,$oldPassword);
        break;

    case 'setLogoSrc':
        $src = req('src');
        echo $F->set_logo_src($src);
        break;


    case 'setFaviconSrc':
        $src = req('src');
        echo $F->set_favicon_src($src);
        break;
}