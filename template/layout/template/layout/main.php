<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo empty($head_info['description'])?'':$head_info['description']; ?>">
    <meta name="author" content="<?php echo empty($head_info['author'])?'':$head_info['author']; ?>">
    <link rel="icon" href="/favicon.ico">
    <title><?php echo empty($head_info['title'])?'':$head_info['title']; ?></title>

    <!--#include virtual="/include/css_bootstrap.shtml"-->

    <!--#include virtual="/include/js_config.shtml"-->
    <!--#include virtual="/include/js_jquery.shtml"-->
    <!--#include virtual="/include/js_popper.shtml"-->
    <!--#include virtual="/include/js_bootstrap.shtml"-->
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?c368a69c85d76aa513e33b9e89daf464";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo $config['website_index']; ?>"><img src="<?php echo YiluPHP::I()->lang('website_logo_img'); ?>" height="35"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/"><?php echo YiluPHP::I()->lang('index_page'); ?> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo YiluPHP::I()->lang('download'); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdown03">
                    <a class="dropdown-item" href="/docs/YiluPHP_1_0/1">
                        YiluPHP V1.0.2
                    </a>
                    <a class="dropdown-item" href="/docs/YiluphpUC_1_0/30">
                        YiluphpUC V1.0.1
                    </a>
                    <a class="dropdown-item" href="/docs/YiluphpSM/33">
                        YiluphpSM V1.0
                    </a>
                    <a class="dropdown-item" href="/docs/YiluphpManageBase/37">
                        管理后台基础代码
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo YiluPHP::I()->lang('document'); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdown03">
                    <a class="dropdown-item" href="/docs/YiluPHP_1_0">
                        YiluPHP V1.0.2
                    </a>
                    <a class="dropdown-item" href="/docs/YiluphpUC_1_0">
                        YiluphpUC V1.0.1
                    </a>
                    <a class="dropdown-item" href="/docs/YiluphpSM">
                        YiluphpSM V1.0
                    </a>
                    <a class="dropdown-item" href="/docs/YiluphpManageBase/36">
                        管理后台基础代码文档
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/q-a/category"><?php echo YiluPHP::I()->lang('question_and_answer_area'); ?></a>
            </li>
            <?php if(empty($self_info)): ?>
            <li class="nav-item">
                <a class="nav-link" id="header_login_btn" href="<?php echo $config['user_center']['host']; ?>/"><?php echo YiluPHP::I()->lang('login'); ?></a>
            </li>
            <?php else: ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $self_info['nickname'] ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdown03">
                    <a class="dropdown-item" href="<?php echo $config['user_center']['host']; ?>/setting/user_info">
                        <?php echo YiluPHP::I()->lang('menu_account_setting'); ?>
                    </a>
                    <a class="dropdown-item" id="header_logout_btn" href="/sign/out?redirect_uri=<?php echo get_host_url(); ?>">
                        <?php echo YiluPHP::I()->lang('menu_sign_out'); ?>
                    </a>
                </div>
            </li>
            <?php endif; ?>
            <li class="nav-item dropdown">
                <?php if(YiluPHP::I()->current_lang()=='cn'): ?>
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">中文</a>
                <?php endif; ?>
                <?php if(YiluPHP::I()->current_lang()=='en'): ?>
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">English</a>
                <?php endif; ?>
                <div class="dropdown-menu" aria-labelledby="dropdown03">
                    <?php if(YiluPHP::I()->current_lang()!='cn'): ?>
                        <a class="dropdown-item" href="javascript:changeLanguage('cn')">中文</a>
                    <?php endif; ?>
                    <?php if(YiluPHP::I()->current_lang()!='en'): ?>
                        <a class="dropdown-item" href="javascript:changeLanguage('en')">English</a>
                    <?php endif; ?>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="<?php echo in_array(get_url(), ['/search/document','/search/experience','/search/user'])?get_url():'/search/code'; ?>">
            <input class="form-control" style="margin-right: -7px;" type="text" name="keywords"
                   placeholder="<?php echo YiluPHP::I()->lang('search_keyword'); ?>"
                   aria-label="<?php echo YiluPHP::I()->lang('search'); ?>"
                   value="<?php echo isset($_GET['keywords'])?$_GET['keywords']:''; ?>" onmouseover="this.select();" required>
            <div class="d-inline-block mr-1">
                <select class="custom-select text_08rem d-block pl-1" onchange="$(this).parents('form').attr('action','/search/'+this.value)">
                    <option value="code"><?php echo YiluPHP::I()->lang('code_library'); ?></option>
                    <option value="experience" <?php echo get_url()=='/search/experience'?'selected':''; ?>><?php echo YiluPHP::I()->lang('experience'); ?></option>
                    <option value="document" <?php echo get_url()=='/search/document'?'selected':''; ?>><?php echo YiluPHP::I()->lang('document'); ?></option>
                    <option value="answer" <?php echo get_url()=='/search/answer'?'selected':''; ?>><?php echo YiluPHP::I()->lang('question_and_answer_area'); ?></option>
                </select>
            </div>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><?php echo YiluPHP::I()->lang('search'); ?></button>
        </form>
    </div>
</nav>

<!--#include virtual="/include/css_dialog.shtml"-->
<!--#include virtual="/include/js_dialog_diy.shtml"-->
<!--#include virtual="/include/js_base.shtml"-->
<script src="/js/language/<?php echo YiluPHP::I()->current_lang(); ?>.js"></script>

<!--{$contents}-->

<!--#include virtual="/include/css_base.shtml"-->

<!--#include virtual="/include/js_jquery_easing.shtml"-->

<footer class="footer mt-3">
    <div class="container">
        <span class="text-muted">
            &copy; 2019-2030 YiluPHP.com 版权所有
            <a class="icp" target="_blank" href="https://beian.miit.gov.cn/">粤ICP备19143214号</a>
        </span>
    </div>
</footer>
<?php if (!empty($dialog_error)): ?>
<script>
    $(document).dialog({
        titleShow: false,
        content: "<?php echo $dialog_error; ?>"
    });
</script>
<?php endif; ?>

<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? "https://" : "http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1278278388'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1278278388' type='text/javascript'%3E%3C/script%3E"));</script>
<script type="text/javascript" src="https://tajs.qq.com/stats?sId=66496935" charset="UTF-8"></script>
</body>
</html>