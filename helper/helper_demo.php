<?php

/**
 * 样例文件，可删除
 * YiluPHP vision 1.0
 * User: Jim.Wu
 * Date: 17/12/30
 * Time: 09:43
 */
class helper_demo
{
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
	    global $app;
	    return $app->model_demo->test_for_helper();
	}
}
