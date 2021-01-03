<?php

/**
 * 样例文件，可删除
 * YiluPHP vision 2.0
 * User: Jim.Wu
 * Date: 2021.01.01
 * Time: 11:19
 */
class helper_demo
{
    //存储单例
    private static $_instance = null;

    /**
     * 获取单例
     * @return helper_demo|null
     */
    public static function I(){
        if (!static::$_instance){
            return static::$_instance = new self();
        }
        return static::$_instance;
    }

	public function __construct()
	{
	}

	public function __destruct()
	{
	}

    /**
     * @name 测试调用helper类
     * @desc
     * @return string
     * @throws
     */
	public function test_helper()
	{
	    return model_demo::I()->test_for_helper();
	}
}
