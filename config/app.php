<?php
/*
 * 用户的配置文件
 * YiluPHP vision 2.0
 * User: Jim.Wu
 * Date: 2021.01.01
 * Time: 11:19
 */

date_default_timezone_set('Asia/Shanghai');

define('REDIS_LOGIN_USER_INFO', 'REDIS_LOGIN_USER_INFO_');   //登录用户的信息，后面接cookie vk 的值
define('REDIS_SUB_TABLE', 'REDIS_SUB_TABLE_');   //当前使用的分表的名称

define('TIME_10_YEAR', 315360000); //10年的秒数
define('TIME_5_YEAR', 157680000); //5年的秒数
define('TIME_2_YEAR', 63072000); //2年的秒数
define('TIME_1_YEAR', 31536000); //1年的秒数
define('TIME_60_DAY', 5184000); //60天的秒数
define('TIME_30_DAY', 2592000); //30天的秒数
define('TIME_DAY', 86400); //24小时的秒数
define('TIME_HOUR', 3600); //1小时的秒数，model中有使用
define('TIME_30_MIN', 1800); //30分钟的秒数
define('TIME_15_MIN', 900); //15分钟的秒数，model中有使用
define('TIME_10_MIN', 600); //10分钟的秒数
define('TIME_MIN', 60); //1分钟的秒数
define('TIME_5_SEC', 5); //5秒
define('TIME_10_SEC', 10); //10秒
define('TIME_30_SEC', 30); //30秒

define('CODE_USER_NOT_LOGIN', -1);	//用户未登录的错误码

class config{
    const root = 'aa';
    const get = ['a'=>'aaa'];
}

/*
 * 全局配置信息
 */
$config = [
    /*
     * 在这里设置需要重写的路由
     */
    'rewrite_route' => [
        '/article/detail/{article_id}' => '/welcome/article_id/{article_id}',
    ],

    /**
     * 是否对数据表进行分表分库,true为分表分库,false为不分表分库,默认为false
     * 如果需要分表分库,需要先配置所有分库的Mysql连接,然后确保停止了增加和修改数据,再手工导数据到各分表
     * 分表方式按表中某整数类型的字段的后两位数进行拆分,拆分成100个分表
     * 分表的库连接名称也是在默认的库连接名称(default)后面加下划线加分表的数字后缀,如default_1, default_23
     **/
//    'split_table' => false,

    'mysql' => [
        //default为默认的数据库连接名，你可以自定义其它名称
        'default' => [
            'dsn'   =>  'mysql:host=127.0.0.1;port=3306;dbname=yiluuc',
            'username'  =>  'root', //你的数据库登录名
            'password'  =>  'yiluPHP@2017', //你的数据库登录密码
            'charset'   =>  'utf8mb4',
            'option'    =>  [],
        ]
    ],
    'redis' => [
        //default为默认的Redis连接名，你可以自定义其它名称
        'default' => [
            'host'      =>  '127.0.0.1',
            'port'      =>  '6379',
        ]
    ],

    /**
     * 是否为调试模式，此参数为空时调试模式，会显示调试信息，默认为非调试模式
     **/
    'debug_mode' => false,

    /**
     * 针对指定的客户端IP才使用调试模式，在这里填写了的客户端IP才会显示调试信息，其他人看不到高度信息
     * 此参数不受 debug_mode 限制
     **/
    'debug_client_ip' => [],

    /**
     * 队列的运行模式，sync为同步运行，asyn为异步运行
     * 如果不设置,默认为异步运行
     * 异步运行时,需要在后台一直运行着相应的队列才能继续,否则队列数据会一直记录在redis中
     * 执行方式: 例如有队列/cli/queue/like_post.php，则执行命令：php [目录路径]queue queue_name=like_post &
     * 后面加&它就会一直在后台运行着
     **/
    'queue_mode' => 'sync',

    /**
     * 系统的根域名，这里涉及到用户的cookie作用域，如：yiluphp.com
     **/
    'root_domain' => '',

    /**
     * 主语言，当前为主语言时url可以不带语言标识，如果这里不设置，则主语言为lang字段的值
     **/
    'main_lang' => 'cn',

    /**
     * 默认语言设置，如果你的系统使用多语言，在这里可以设置默认的语言
     **/
    'lang' => 'cn',

    /**
     * 在这里设置前置类，这些类会在执行controller之前执行
     * before_controller的数组中里面可以配置多个helper的类名
     * 用于before_controller类从构造函数__construct()开始执行
     **/
//    'before_controller' => ['hook_csrf'],

    /**
     * 在这里设置后置类，这些类会在执行完controller之后执行
     * after_controller的数组中里面可以配置多个helper的类名
     * 用于after_controller类从构造函数__construct()开始执行
     **/
//    'after_controller' => ['hook_header_setter'],

    /**
     * 设置默认的controller名
     **/
    'default_controller' => 'welcome',

    /*
     * 自定义需要显示的错误级别
        1     E_ERROR           致命的运行错误。错误无法恢复，暂停执行脚本。
        2     E_WARNING         运行时警告(非致命性错误)。非致命的运行错误，脚本执行不会停止。
        4     E_PARSE           编译时解析错误。解析错误只由分析器产生。
        8     E_NOTICE          运行时提醒(这些经常是你代码中的bug引起的，也可能是有意的行为造成的。)
        16    E_CORE_ERROR PHP  启动时初始化过程中的致命错误。
        32    E_CORE_WARNING    PHP启动时初始化过程中的警告(非致命性错)。
        64    E_COMPILE_ERROR   编译时致命性错。这就像由Zend脚本引擎生成了一个E_ERROR。
        128   E_COMPILE_WARNING 编译时警告(非致性错)。这就像由Zend脚本引擎生成了E_WARNING警告。
        256   E_USER_ERROR      自定义错误消息。像用PHP函数trigger_error（程序员设置E_ERROR）
        512   E_USER_WARNING    自定义警告消息。像用PHP函数trigger_error（程序员设的E_WARNING警告）
        1024  E_USER_NOTICE     自定义的提醒消息。像由使用PHP函数trigger_error（程序员E_NOTICE集）
        2048  E_STRICT          编码标准化警告。允许PHP建议修改代码以确保最佳的互操作性向前兼容性。
        4096  E_RECOVERABLE_ERROR   开捕致命错误。像E_ERROR，但可以通过用户定义的处理捕获（又见set_error_handler（））
        8191  E_ALL             所有的错误和警告(不包括 E_STRICT) (E_STRICT will be part of E_ALL as of PHP 6.0)
        16384 E_USER_DEPRECATED
        30719 E_ALL
        可用直接使用数字，也可以使用常量的计算公式，例如：
         error_reporting(0);                //禁用错误报告
         error_reporting(E_ERROR | E_WARNING | E_PARSE);//报告运行时错误
         error_reporting(E_ALL);            //报告所有错误
         error_reporting(E_ALL ^ E_NOTICE); //除E_NOTICE报告所有错误，是在php.ini的默认设置
         error_reporting(-1);               //报告所有 PHP 错误
         error_reporting(3);                //不报E_NOTICE
         error_reporting(11);               //报告所有错误
         ini_set('error_reporting', E_ALL); // 和 error_reporting(E_ALL); 一样
         error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);//表示php错误，警告，语法错误，提醒都返错。
     * */
    'error_level' => E_ALL,

    /*
     * 定义会写入文件日志的类型，只有在log_level数组中的类型才会写入日志，默认为不输出任何类型的日志
     * 可选值：ERROR错误、WARNING警告、DEBUG调试、NOTICE通知、VISIT访问、RESPONSE正常响应、TRACE代码追溯
     * 另外可以任意自定义自己想用的类型，直接写入该数组就行
     * */
    'log_level' => ['ERROR', 'WARNING', 'DEBUG', 'NOTICE', 'VISIT', 'RESPONSE', 'ERROR', 'TRACE'],

    /*
     * 服务器内部错误的错误码范围
     * 在此范围的错误码会对外界展示，并且全部显示“服务器内部错误”，详细的错误信息只会写入错误日志中
     * 如果是DEBUG模式，则都会对外界显示详细的错误信息
     * 数组，第一个是最小的错误码，第二个是最大的错误码，必须两个都设置才能生效，在此范围内的错误码都算是服务器内部的错误类型
     * */
    'inner_error_code' => [2000, 3000],

    /*
     * 是否使用session，true为使用，false为不使用，默认为false
     * YiluPHP的session是使用redis存储的，可以实现集群服务器之间共享session
     * */
    'use_session' => false,

    /*
     * 当前环境标识，这在区分环境执行不一样的代码时非常有用
     * 比如：local代表开发者自己的电脑，dev代表开发环境，alpha代表测试环境，beta代表预发环境，idc或不设置代表线上（生产）环境
     * 如果在这里没设置，就会去/data/config/env文件中读，如果/data/config/env中也没有则默认为idc
     * */
    'env' => 'local',

    /*
     * 用于RSA解密用的私钥
     * 可以百度一下生成方法,将生成的private_key.pem和public_key.pem文件拷贝到你希望的、可以长期存放的位置
     * 将private_key.pem的内容赋值给rsa_private_key参数
     * 将public_key.pem的内容赋值给rsa_public_key参数
     * 你可以使用file_get_contents动态获取文件内容，为了减少读磁盘文件的操作，
     * 你也可以把文件的内容拷贝出来，原样粘贴在这两个参数的值
     * 框架自带的公钥和密钥对为256位的，安全性很差，请自行生成更长的公钥和密钥对
     * document目录中有文件指导：生成RSA公钥和私钥的方法.txt
     * */
    'rsa_private_key' => file_get_contents(APP_PATH.'document/rsa_private_key.pem'),
    'rsa_public_key' => file_get_contents(APP_PATH.'document/rsa_public_key.pem'),

    /*
     * 访问接口文档的密码
     * 如果没有设置密码，则只能在dev和local环境查看文档
     * 如果设置了密码，不管在哪个环境中都需要密码才能访问
     * YiluPHP具有根据controller中的注释自动生成文档的功能
     * 只要在controller中根据规定的格式编写注释就能自动生成接口文档，访问地址：/api_docs
     * 注释的格式请参照框架自带的welcome示例和在官网查阅使用文档
     * */
    'visit_api_docs_password' => '',
];

/*
 * 针对不同环境设置不一样的配置配置信息,建议单独一个文件存放在项目目录以外的位置
 */
//return array_merge($config, require('/data/config/www.yiluphp.com/config.php'));
return $config;