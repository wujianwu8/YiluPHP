<?php

/**
 * 设置头信息，样例文件，可删除
 * YiluPHP vision 2.0
 * User: Jim.Wu
 * Date: 2021.01.01
 * Time: 11:19
 */
class hook_header_setter extends hook
{
    //存储单例
    private static $_instance = null;

    /**
     * 获取单例
     * @return input|null
     */
    public static function I(){
        if (!static::$_instance){
            return static::$_instance = new self();
        }
        return static::$_instance;
    }

    public function run()
    {
    }

    public function __construct()
    {
    }

    public function __destruct()
    {
    }

}