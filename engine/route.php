<?php
date_default_timezone_set('PRC'); //设置时区
//_分割模块，-分割参数
//路由指令:
$rule = req('R');

//exit($rule);            //PC ://nginx的路由值:/cache/index-1.tmp.html     //apache的路由值：/cache/index-1.tmp.html
//exit($rule);            //mobile ://nginx的路由值:m_/cache_m/index-1.tmp.html     //apache的路由值：m_/cache_m/index-1.tmp.html
//exit($rule);            //act ://nginx的路由值:a_login.act.php     //apache的路由值：a_login.act.php
//exit($rule);            //html ://nginx的路由值:a_admin.tmp.html     //apache的路由值：a_admin.tmp.html

//exit($rule);                //pc list : nginc:/cache/list-24-1.tmp.html              apache:/cache/list-24-1.tmp.html

//手机端
$mobileFlag = false;
//admin管理端
$adminFlag = false;

//判断session
$sessionFlag = true;



//exit($rule); //a_login.act.php

if (substr($rule, 0, 2) == 'm_') {//手机
    $mobileFlag = true;
    $rule = substr($rule, 2);
} else if (substr($rule, 0, 2) == 'a_') {//管理检查session
    $adminFlag = true;
    $rule = substr($rule, 2);
    session_start();
    if ((empty($_SESSION['login']) || !isset($_SESSION['login'])) && $rule != 'login.tmp.html' && $rule != 'login.act.php') { //没有session
        $sessionFlag = false;
        page404('session不存在!');
    }
}

//exit($rule);

//获取模块名
$routeArr = array();

//页面类型
$xhtmlFlag = false;
$actFlag = false;


if (strpos($rule, '.tmp.html') !== false) {//页面型
    $order = basename($rule, ".tmp.html"); //index-1
    $routeArr = explode('-', $order);//index,1
    $xhtmlFlag = true;
} else if (strpos($rule, '.act.php') !== false) {//逻辑型
    $routeArr = explode('.', $rule); //TODO 可能不需要吧
    $actFlag = true;
} else {
    page404('路由未知类型的页面!');
}


//本项目位置
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);


//读取手机或者pc注册表
//判断程序类型
$program = '/program';
if ($mobileFlag) {
    $program .= '_mobile';
} else if ($adminFlag) {
    $program .= '_admin';
    //$adminFlag = false;
} else {
    $program .= '_pc';
}

//定义资源地址
$pathArr = explode('_', $routeArr[0]);
$PRI_RES = $program . '/' . $pathArr[0] . '/res';//普通私有资源地址
$PUB_RES = '/public';//普通公共资源地址
//定义公共部分
$docType = '<?xml version="1.0" encoding="UTF-8"?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-cn" lang="zh-cn">';
$endHtml = '</html>';


//html静态化的逻辑
if ($xhtmlFlag && !$adminFlag) {
    //读取注册表
    include ROOT_PATH . '/engine/registry.php';
    if ($mobileFlag) {
        $REG = $REG['mobile'];
    } else {
        $REG = $REG['pc'];
    }


    //判断注册并启用
    if (!empty($REG[$routeArr[0]][0])) {
        //判断参数个数匹配
        if (count($routeArr) - 1 == $REG[$routeArr[0]][1]) {

            $path = '/' . $pathArr[0] . '/' . $routeArr[0];


            //判断文件存在
            $programPath = ROOT_PATH . $program . $path . '.php';

            if (file_exists($programPath)) {

                //碎片组合函数
                $moduleArr = array();
                $moduleArr[] = ROOT_PATH . $program . '/' . $pathArr[0];
                $RArr = $routeArr;

                //调用remote
                include ROOT_PATH . '/engine/FactoryImpl.class.php';
                $F = new FactoryImpl();

                // 获取缓冲区数据,生成缓存文件
                //将缓存开始输出到缓冲区

                ob_start('ob_gzhandler');

                include $programPath;

                // 获取缓冲区数据,生成缓存文件
                if (!isset($noData) || empty($noData)) {

                    if ($mobileFlag) {
                        $docType = '<!DOCTYPE html><html lang="zh-cn">';
                    }

                    $cacheFile = ROOT_PATH . $rule;
                    $cacheFolder = dirname($cacheFile);
                    if (!file_exists($cacheFolder)) {
                        mkdir($cacheFolder, 0777, true);
                    }

                    $htmlStr = ob_get_contents();
                    $htmlStr = $docType . $htmlStr;


                    $htmlStr = str_replace('</head>', '<link type="text/css" href="' . dirname($rule) . '/' . $pathArr[0] . '.css" rel="stylesheet"/></head>', $htmlStr);
                    $htmlStr = str_replace('</body>', '<script type="text/javascript" src="' . dirname($rule) . '/' . $pathArr[0] . '.js"></script></body>', $htmlStr);


                    $htmlStr .= $endHtml;

                    file_put_contents($cacheFile, $htmlStr);
                    //ob_clean();
                    ob_end_clean();


                    // 获取缓冲区数据,生成缓存文件,组合php碎片、html碎片、js碎片、css碎片
                    $cacheRs = $cacheFolder . '/' . $pathArr[0];
                    $cacheRsJs = $cacheRs . '.js';
                    $cacheRsCss = $cacheRs . '.css';

                    //exit($cacheRsCss);


                    if (!file_exists($cacheRsCss) || !file_exists($cacheRsJs)) {//js,css不存在，则拼装

                        $scriptFile = fopen($cacheRsJs, "a");
                        $styleFile = fopen($cacheRsCss, "a");

                        //var_dump($moduleArr);//J:/www/company/program_pc/header

                        foreach ($moduleArr as $value) {
                            //拼装css
                            $styleFilePath = $value . '/style.css';
                            if (file_exists($styleFilePath)) {
                                $styleStr = css_compress(file_get_contents($styleFilePath));//将整个文件内容读入到一个字符串中
                                fwrite($styleFile, $styleStr);
                            }
                            //拼装js
                            $scriptFilePath = $value . '/script.js';
                            if (file_exists($scriptFilePath)) {
                                $scriptStr = js_compress(file_get_contents($scriptFilePath));
                                fwrite($scriptFile, $scriptStr);
                            }
                        }
                        fclose($scriptFile);
                        fclose($styleFile);

                    }


                    echo $htmlStr;
                }
                //include $cacheFile;
                // 清空缓冲区并输出
                //ob_end_flush();
            } else {
                page404('文件不存在!');
            }
        } else {
            page404('参数不匹配注册表!');
        }
    } else {
        page404('文件未启用!');
    }
} else if ($adminFlag && $xhtmlFlag) {//后台页面
    $path = '/' . $pathArr[0] . '/' . $routeArr[0];
    //判断文件存在
    $programPath = ROOT_PATH . $program . $path . '.php';

    if (file_exists($programPath)) {

        include ROOT_PATH . '/engine/FactoryImpl.class.php';
        $F = new FactoryImpl();

        //设置header
        header('Content-Type:text/html;charset=utf-8'); //设置编码
        header('X-UA-Compatible:IE=edge,Chrome=1'); //设置浏览器内核
        header('renderer:webkit'); //设置浏览器内核
        echo $docType;
        include $programPath;
        echo $endHtml;
    } else {
        page404('后台页面不存在!');
    }
} else if ($actFlag) { //php调用操作页面
    $programPath = ROOT_PATH . $program . '/' . $routeArr[0] . '/res/php/' . $rule;

    if (file_exists($programPath)) {
        include ROOT_PATH . '/engine/FactoryImpl.class.php';
        $F = new FactoryImpl();
        include $programPath;
    } else {
        page404('逻辑页面不存在!');
    }

}

//404
function page404($info)
{
    Header("HTTP/1.1 404 Not Found");
    echo $info;
    include ROOT_PATH . '/public/page/404.html';
    exit();
}


//接受get或者post
function req($r)
{
    if (isset($_GET[$r])) {
        $value = $_GET[$r];
    } else if (isset($_POST[$r])) {
        $value = $_POST[$r];
    }
    return $value;
}

function slice($sliceFile)//header.php
{
    //$sliceArr = explode('.', $sliceFile);
    $pathArr = explode('_', $sliceFile);
    $path = '/' . $pathArr[0]; //header/

    //判断程序类型
    global $program;
    //保存到数组
    global $moduleArr;

    $slice = ROOT_PATH . $program . $path;
    $moduleArr[] = $slice;
    $sliceFileParh = $slice . '/' . $sliceFile . '.php';
    if (file_exists($sliceFileParh)) {
        return $sliceFileParh;
    } else {
        exit('片段文件不存在！' . $slice);
    }

}

//暂无数据
function noData()
{
    echo '暂无数据';
    //TODO 记录下该异常ip，如果该ip存在大规模异常，采取措施
    return false;
}

//随机数
function getRandomChar($len)
{
    $rc = '';
    for ($i = 0; $i < $len; ++$i) {
        $rc .= chr(rand(65, 90));
    }
    return $rc;
}

//压缩css
function css_compress($string)
{
    $string = str_replace("\r\n", "", $string); //首先去掉换行
    $string = preg_replace("/(\s*\:\s*)/", ":", $string); //:左右空格
    $string = preg_replace("/(\s*\{\s*)/", "{", $string);
    $string = preg_replace("/(\s*\;\s*\}\s*)/", "}", $string); //去掉反括号首位的空格和换行，和最后一个;
    $string = preg_replace("/(\s*\;\s*)/", ";", $string);
    return $string;
}

//压缩css
function js_compress($string)
{
    $string = str_replace("\r\n", "", $string); //首先去掉换行
    $string = preg_replace("/(\s*\:\s*)/", ":", $string); //:左右空格
    $string = preg_replace("/(\s*\{\s*)/", "{", $string);
    $string = preg_replace("/(\s*\}\s*)/", "}", $string);
    $string = preg_replace("/(\s*\,\s*)/", ",", $string);
    return $string;
}

//压缩html
function compress_html($string)
{
    $string = str_replace("\r\n", '', $string); //清除换行符
    $string = str_replace("\n", '', $string); //清除换行符
    $string = str_replace("\t", '', $string); //清除制表符
    $pattern = ["/> *([^ ]*) *</", "/[\s]+/", "/<!--[\\w\\W\r\\n]*?-->/", "/\" /", "/ \"/", "'/\*[^*]*\*/'"];
    $replace = [">\\1<", " ", "", "\"", "\"", ""];
    return preg_replace($pattern, $replace, $string);
}