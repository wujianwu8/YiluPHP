<?php
/*
 * 这是一个CLI命令操作的例子，你可以删除这个demo
 * 运行方式如：/usr/local/php7/bin/php /data/web/www.yiluphp.com/cli/cli_demo.php "user_id=88"
 * 这个命令中/usr/local/php7/bin/php是你的PHP安装位置
 * 这是你的文件存放位置：/data/web/www.yiluphp.com/
 * 这是传两个参数user_id和page过去，如果没有参数可以不写 "user_id=88&page=1"
 * OneWayPHP vision 2.0
 * User: Jim.Wu
 * Date: 2021.01.01
 * Time: 11:19
 */

if(!isset($_SERVER['REQUEST_URI'])){
    $the_argv = $argv;
    unset($the_argv[0]);
    //获取命令行内容
    $_SERVER['REQUEST_URI'] = 'php '.$argv[0].' "'.implode('" "', $the_argv).'"';
}
if (!defined('APP_PATH')){
    $project_root = explode(DIRECTORY_SEPARATOR.'cli'.DIRECTORY_SEPARATOR, __FILE__);
    //项目的根目录，最后包含一个斜杠
    define('APP_PATH', $project_root[0].DIRECTORY_SEPARATOR);
    unset($project_root);
}
include_once(APP_PATH.'public'.DIRECTORY_SEPARATOR.'index.php');

//接下来你可以像在controller里一样编程
$user_id = input::I()->get_trim('user_id');
$page = input::I()->get_int('page');
var_dump($user_id, $page);
exit("\r\n完成\r\n\r\n");