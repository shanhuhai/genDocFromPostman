<?php
/**
 * Author: shanhuhai
 * Date: 08/01/2018 11:47
 * Mail: 441358019@qq.com
 */

require './vendor/autoload.php';

$output  = isset($_GET['output']) ? $_GET['output'] : 'html' ;

// 载入 postman 导出文件
$dump = file_get_contents('/Users/shanhuhai/Documents/ums.postman_collection');

if($output == 'json') {
    echo  $dump;
    exit();
}

$dump = json_decode($dump, true);

$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader, [
  //  'debug'=> true,
]);

//-- 返回响应json 处理
$twig->addExtension(new Twig_Extension_Debug());
$filter = new Twig_SimpleFilter('jsonFormat', function ($string) {
    return json_encode(json_decode($string, true), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
});
$twig->addFilter($filter);

//-- 请求url 处理
$filter = new Twig_SimpleFilter('urlFormat', function ($string) {
        $string  = str_replace('{{apiUrl}}', '', $string);
        $string  = str_replace('http://user.loc', '', $string);
        $string =  preg_replace('#\{\{(.+)\}\}#iU', ":$1", $string );
        return $string;
});

$twig->addFilter($filter);


//-- 参数处理
$filter = new Twig_SimpleFilter('paramDescriptionFormat', function($string){
    $required = false ;
    $description = '';
    if(strpos($string, '|') !== false ) {
        list($required, $description) = explode('|', $string);
    }
    return ($required ==1 ? "是" : "否"). ' |' . $description;

});

$twig->addFilter($filter);

//-- 表格美化
$filter = new Twig_SimpleFilter('tableFormat', function($string){
    $string = str_replace('<table', '<table class="table"', $string);

    // 标红空白响应处
    $string = str_replace('<pre><code>null</code></pre>', '<pre style="background-color: red"><code>null</code></pre>', $string);
    return $string;

});

$twig->addFilter($filter);



$text =  $twig->render('cmstop.twig',array('dump'=>$dump));

if($output == 'markdown') {
    exit($text);
}


//-- markdwon 渲染
$parseDown = new Parsedown();

$parsedText = $parseDown->text($text);



echo   $twig->render('layouts/1.twig',  [
   'markdown'=>$parsedText
]);


