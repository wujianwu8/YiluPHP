<?php
/*
 * 主表与分表的管理
 * YiluPHP vision 2.0
 * User: Jim.Wu
 * * Date: 2021/01/01
 * Time: 23:36
 */

class model_sub_table_manage extends model
{
    protected static $instance = null;
    protected $_table = 'sub_table_manage';

    /**
     * 获取单例
     */
    public static function I(){
        if (empty(self::$instance)){
            return self::$instance = new static();
        }
        return self::$instance;
    }

}
