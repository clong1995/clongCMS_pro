<?php
switch (req('act')){
    case 'login':
        $uid = req('uid');
        $pwd = req('pwd');
        $rs = $F->login($uid,$pwd);
        if(empty($rs)){
            echo 'failure';
        }else{
            session_start();
            $_SESSION['login'] = $uid;
            echo 'success';
        }
        break;
}