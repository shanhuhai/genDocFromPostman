<?php
/**
 * Author: shanhuhai
 * Date: 24/01/2018 11:12
 * Mail: 441358019@qq.com
 */
require 'vendor/autoload.php';

$string = <<<EOF
参数 | 必填 | 简介
---- | ---- | -----
name | 否 |
slug | 否 |
conditions | 否 |

EOF;
$parseDown = new Parsedown();
$text = $parseDown->text($string);

echo  $text;

