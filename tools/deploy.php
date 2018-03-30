<?php
/**
 * Author: shanhuhai
 * Date: 09/01/2018 16:42
 * Mail: 441358019@qq.com
 */

$mergedRequest = file_get_contents('http://git.meitiyun.org/api/v4/projects?private_token=6zDV6n2SznBPEatvJmfd&page=1&size=100');




$mergedRequest = json_decode($mergedRequest, true);
$count = count($mergedRequest);
echo "{$count} merge requests";