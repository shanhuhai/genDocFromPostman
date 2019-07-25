使用方式：


1. 下载代码后，拷贝 `config.example.php`为 `config.php`,  修改 `config.php` 配置 postman 导出文件的json路径

```$xslt
<?php

return [
    'postman_json' => '/xxxx/ums.postman_collection.json',
];

```

2. 通过 `php -S 127.0.0.1:8001` 启动 php 服务器

请求  http://127.0.0.1:8001/?output=markdown ，则会输出 Markdown 版本的接口文档， 另外为Markdown文件
请求  http://127.0.0.1:8001/?output=json， 输出postman的json 源内容

3. postman 填写规则


 接口要分组， 生成文档时按组生成

![xx](https://qqadapt.qpic.cn/txdocpic/0/18dd5dc00970b6bd47e579dabb0554f7/0)


![xx](https://qqadapt.qpic.cn/txdocpic/0/f48525ddb026fde5c1e93fbc34211a7b/0)