<?php
/*
 * 函数库，用户可在此添加自己所需函数
 * YiluPHP vision 2.0
 * User: Jim.Wu
 * Date: 2021.01.01
 * Time: 11:19
 */

/**
 * @name 获取当前完整的URL，包含http头和域名
 * @desc 会判断是HTTP还是HTTPS
 * @return string
 */
function get_host_url()
{
    $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
    return $http_type . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

/**
 * @name 获取当前URL，不包含http头、域名、参数
 * @desc
 * @return string
 */
function get_url()
{
    $url = explode('?',$_SERVER['REQUEST_URI']);
    return $url[0];
}

/**
 * @name 把html代码转换成可以输出给JS变量内容的字符串
 * @desc
 * @param string $content
 * @return string
 */
function html_for_javascript_variable($content)
{
    $content = preg_replace('/"/', '\\"', $content);
    $content = preg_replace("/\'/", "\\'", $content);
    $content = preg_replace('/[\r\n]/', "\\r\\n\"+\r\n\"", $content);
    return $content;
}

/**
 * @name 把html代码转换成适合在（文章）列表中显示的简略内容的字符串
 * @desc
 * @param string $content
 * @param integer $length 需要截取的长度
 * @param string $suffix 如何还有更多内容，需要显示的后缀字符串
 * @return string
 */
function html_for_list($content, $length=250, $suffix='...')
{
    $content = preg_replace('/(<\/)/', ' $1', $content );
    $content = strip_tags($content);
    $content = preg_replace('/[\r\n]/', ' ', $content );
    $len = mb_strlen($content);
    $content = htmlspecialchars_decode( $content );
    $content = mb_substr( $content, 0, $length);
    $content = htmlspecialchars( $content );
    if (mb_strlen($content)<$len){
        $content .= $suffix;
    }
    unset($len, $length);
    return $content;
}

/**
 * @name 去除回车符
 * @desc 即\r\n
 * @param string $content
 * @return string
 */
function remove_enter_lrln($content)
{
    return preg_replace('/[\r\n]/', '', $content);
}

/**
 * @name 内容过滤
 * @desc 过滤掉PHP代码和javascript代码
 * @param string $content
 * @return string
 */
function content_filter($content){
    $content = preg_replace('/<\?(.+?)\?>/i', '&lt;?${1}?&gt;', $content);
    $content = preg_replace('/<script(.*?)>/i', '&lt;script${1}&gt;', $content);
    $content = preg_replace('/<\/script(.*?)>/i', '&lt;/script${1}&gt;', $content);
    return $content;
}

/**
 * @name 向URL中增加参数
 * @desc
 * @param string $url
 * @param array $params
 * @return string
 */
function add_url_params ($url, $params){
    $temp = parse_url($url);
    $url_well = explode('#', $url);
    $url = explode('?', $url_well[0]);
    $url_params = [];
    if (count($url)>1){
        $temp = explode('&', $url[1]);
        foreach ($temp as $value){
            $value = explode('=', $value);
            $url_params[$value[0]] = isset($value[1])?$value[1]:'';
        }
    }
    foreach ($params as $key=>$value){
        $url_params[$key] = $value;
    }
    $temp = [];
    foreach ($url_params as $key=>$value){
        $temp[] = $key.'='.$value;
    }
    $url = $url[0].'?'.implode('&', $temp);
    if (count($url_well)>1){
        $url .= '#'.$url_well[1];
    }
    unset($temp, $url_params, $key, $value, $url_well);
    return $url;
}

/**
 * @name 删除URL中的参数
 * @desc
 * @param string $url
 * @param array $param_names
 * @return string
 */
function delete_url_params ($url, $param_names){
    $url_well = explode('#', $url);
    $url = explode('?', $url_well[0]);
    $url_params = [];
    if (count($url)>1){
        $temp = explode('&', $url[1]);
        foreach ($temp as $value){
            $value = explode('=', $value);
            $url_params[$value[0]] = isset($value[1])?$value[1]:'';
        }
    }
    foreach ($param_names as $value){
        if (isset($url_params[$value])){
            unset($url_params[$value]);
        }
    }
    $temp = [];
    foreach ($url_params as $key=>$value){
        $temp[] = $key.'='.$value;
    }
    if ($temp) {
        $url = $url[0] . '?' . implode('&', $temp);
    }
    else{
        $url = $url[0];
    }
    if (count($url_well)>1){
        $url .= '#'.$url_well[1];
    }
    unset($temp, $url_params, $key, $value, $url_well);
    return $url;
}

/**
 * @name 获取客户端IP
 * @desc 获取客户端IP
 * @return string
 */
function client_ip(){
    if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $ip = getenv('REMOTE_ADDR');
    } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    else{
        $ip = '';
    }
    return preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
}
