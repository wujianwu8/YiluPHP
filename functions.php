<?php
/*
 * 函数库，用户可在此添加自己所需函数
 * YiluPHP vision 2.0
 * User: Jim.Wu
 * Date: 2021/01/21
 * Time: 09:43
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
    $content = preg_replace('/\\\\/', '\\\\\\', $content);
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
 * @name 获取阿里云OSS图片的缩略图，设定宽度
 * @desc 根据阿里云的OSS图片规则生成缩略图
 * @param string $avatar 头像地址
 * @param integer $size 缩略图的尺寸，单位像素
 * @return string
 */
function aliyun_avatar_thumb($avatar, $size){
    $avatar = explode('?',$avatar);
    return $avatar[0].'?x-oss-process=image/resize,w_'.$size;
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
};

/**
 * @name 向URL中增加参数
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
};

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

/**
 * @name 将10进制的数字转换成54进制
 * @desc
 * @return string
 */
function ten_to_54($int)
{
    $result = '';
    $step = 54;
    $str = '0123456789abcdefghijklmnopqrstuvwxyz_-^%@!()[];,.*$=|?';
    $str = str_split($str);
    do{
        //求余
        $yu = floor($int%$step);
        //求商
        $int = $int/$step;
        $result = $str[$yu].$result;
    }
    while($int>1);
    unset($int, $step, $str, $yu);
    return $result;
}

/**
 * @name 将10进制的数字转换成64进制
 * @desc
 * @return string
 */
function ten_to_64($int)
{
    $result = '';
    $step = 64;
    $str = '0123456789abcdefghijklmnopqrstuvwxyz_-ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = str_split($str);
    do{
        //求余
        $yu = floor($int%$step);
        //求商
        $int = $int/$step;
        $result = $str[$yu].$result;
    }
    while($int>1);
    unset($int, $step, $str, $yu);
    return $result;
}

/**
 * @name 通过HASH算法将一个字符串转换成0-9的数字之一
 * @desc 归类方法是；选将字符串MD5，获取字符串的首个字符的ASCII值，最后取其个位数
 * @param string $str
 * @return integer 返回0-9中的一个数
 */
function getOneIntegerByStringASCII($str){
	$num = ord(md5($str));
	unset($str);
	return substr($num, -1, 1);
}

/**
 * @name 创建一个唯一的字符串
 * @desc
 * @return string 返回MD5后的值，32位长度
 */
function create_unique_key()
{
	return md5(microtime().uniqid().client_ip().uniqid().rand(0,99999));
}

/**
 * @name 随机获取一个字符串
 * @desc 从数字和大小写字母中随机获取一个字符串
 * @param integerduplicate argument PHPDoc $length 手机号
 * @return string
 */
function rand_string($length){
	$str = '';
	$tmp = '';
	for ($i = 1; $i <= $length; $i++) {
//		97~122是小写的英文字母
//		65~90是大写的
		$tmp = rand(87, 122);
		if($tmp<97){
			$str .= $tmp-87;
		}
		else{
			$tmp = chr($tmp);
			$str .= (rand(0,1)==1 ? strtoupper($tmp) : $tmp);
		}
	}
	unset($tmp);
	return $str;
}

/**
 * @name 判断一个字符串是不是email
 * @desc
 * @param string $email 邮箱 待检查的email字符串
 * @return boolean true表示是email格式,false表示不是email格式
 */
function is_email($email){
	return preg_match('/^[a-zA-Z0-9]+([-_.][a-zA-Z0-9]+)*@([a-zA-Z0-9]+[-.])+([a-z]{2,10})$/ims',$email);
}

/**
 * @name 检查一个密码是否安全
 * @desc 密码长度需为6-20位,且同时包含大小写字母,数字和@#$!_-中的一个符号
 * @param string $password 密码 待检测的密码字符串
 * @return boolean true表示符合最低安全要求,false表示不符合最低安全要求
 */
function is_safe_password($password){
	return preg_match('/^(?=.*[0-9].*)(?=.*[A-Z].*)(?=.*[a-z].*)(?=.*[\.\$!#@_-].*).{6,20}$/', $password);
}

/**
 * @name 随机生成一个密码
 * @desc 密码长度需为6-20位，且同时包含大小写字母，数字和@#$!_-中的一个符号
 * @return string
 */
function rand_a_password(){
	$password = rand(100, 99999);
	for ($i = 1; $i <= 4; $i++) {
		//97~122是小写的英文字母
		//65~90是大写的
		if(rand(1,2)===1)
		{
			$password .= chr(rand(65, 90));
		}
		else{
			$password .= chr(rand(97, 122));
		}
	}
	$str = '@#$!_-';
	$password .= $str[rand(0,5)];
	return str_shuffle($password);
}

/**
 * 删除目录及目录下所有文件或删除指定文件
 * @param str $path 待删除目录路径
 * @param int $delDir 是否删除目录，1或true删除目录，0或false则只删除文件保留目录（包含子目录）
 * @return bool 返回删除状态
 */
function delete_dir_and_files($path, $delDir = false)
{
    if (is_array($path)) {
        foreach ($path as $subPath) {
            delete_dir_and_files($subPath, $delDir);
        }
    }
    if (is_dir($path)) {
        $handle = opendir($path);
        if ($handle) {
            while (false !== ($item = readdir($handle))) {
                if ($item != "." && $item != "..") {
                    is_dir("$path/$item") ? delete_dir_and_files("$path/$item", $delDir) : unlink("$path/$item");
                }
            }
            closedir($handle);
            if ($delDir) {
                return rmdir($path);
            }
        }
    } else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return false;
        }
    }
}

function is_webview(){
    if (empty($_SERVER['HTTP_CLIENTTYPE']) || !in_array($_SERVER['HTTP_CLIENTTYPE'], [3, 4])){
        return false;
    }
    return true;
}