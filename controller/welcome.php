<?php
/**
 * @group 这是分组名称
 * @version
 * @name 欢迎页，Controller的示例
 * @desc 请在Controller中保持此格式的注释，后期会提供根据此注释自动生成接口文档的功能
 * @method GET/POST
 * @uri /welcome
 * @param integer article_id 文章ID 可选 示例用
 * @param string title 标题 可选 示例用
 * @param string mobile 手机号 可选 示例用，需要使用RSA加密
 * @return html
 * @exception
 *  1 参数错误[article_id]
 *  2 标题太长了
 *  100 参数错误[mobile]
 */

$params = $app->input->validate(
    [
        'article_id' => 'integer|min:1|max:10|return',
        'mobile' => 'string|rsa_encrypt|return',
    ],
    [
        'article_id.*' => $app->lang('parameter_error_xxx', ['field'=>'article_id']),
    ],
    [
        'article_id.*' => 1,
    ]);
$title = $app->input->get_trim('title');
if (mb_strlen($title)>3){
    return_code(2, $app->lang('title_too_long'));
}

//模板文件存放在 /template/welcome.php
return_result('welcome', [
    //非必须的参数如果没有则不会返回此字段
    'article_id' => isset($params['article_id']) ? $params['article_id']:'',
    'mobile' => isset($params['mobile']) ? $params['mobile']:'',
    'title' => $title,
    'test_helper' => $app->helper_demo->test_helper(),
    'test_model' => $app->model_demo->find_test(),
]);