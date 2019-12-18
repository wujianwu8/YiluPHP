<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo empty($head_info['description'])?'':$head_info['description']; ?>">
    <meta name="author" content="<?php echo empty($head_info['author'])?'':$head_info['author']; ?>">
    <link rel="icon" href="/favicon.ico">
    <title><?php echo empty($head_info['title'])?'':$head_info['title']; ?></title>
    <style>
        body{
            padding: 0 0 6rem 0;
            margin: 0;
        }
        nav{
            background: #343a40;
            padding: 0.6rem 1rem;
        }
        nav .container{
            position: relative;
        }
        nav .lang{
            position: absolute;
            right: 0;
            top: 0;
        }
        footer{
            position: fixed;
            bottom: 0;
            width: 100%;
            background: #e9e9e9;
            padding: 1rem;
            color: slategrey;
            font-size: 0.8rem;
        }
        main{
            padding: 0 1rem;
        }
        .container{
            margin: 0 auto;
            max-width: 960px;
        }
        .error{
            text-align: center;
            color: #d00000;
        }
        a,
        a:visited{
            color: dodgerblue;
            text-decoration: none;
            border-bottom: 1px dodgerblue dashed;
        }
        a:hover,
        a:active{
            color: orange;
            border-bottom: 1px orange dashed;
        }
        nav a,
        nav a:visited,
        nav a:hover,
        nav a:active{
            border: none;
        }
        nav a.active{
            color: orange;
        }
    </style>
    <script src="/js_config"></script>
    <script src="/js/language/<?php echo $app->current_lang(); ?>.js"></script>
    <script src="https://www.yiluphp.com/js/vendor/jquery-3.4.1.min.js"></script>
    <script src="https://www.yiluphp.com/js/vendor/jsencrypt.min.js"></script>
    <script src="/js/base.js"></script>
</head>

<body>

<nav>
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="<?php echo $app->lang('website_logo_img'); ?>" height="35">
        </a>
        <div class="lang">
            <a href="<?php echo add_url_params(get_host_url(), ['lang'=>'cn']); ?>"
               class="<?php echo $app->current_lang()=='cn'?'active':''; ?>" style="margin-right: 1rem;">中文</a>
            <a href="<?php echo add_url_params(get_host_url(), ['lang'=>'en']); ?>"
               class="<?php echo $app->current_lang()=='en'?'active':''; ?>">English</a>
        </div>
    </div>
</nav>

<main>
    <div class="container">
        <!--{$contents}-->
    </div>
</main>

<footer>
    <div class="container">
        <div>
            <?php echo $app->lang('free_and_open'); ?>
            <a target="_blank" href="https://www.yiluphp.com/"><?php echo $app->lang('yiluphp_name'); ?></a>
        </div>
        <div><?php echo $app->lang('yiluphp_slogan'); ?></div>
    </div>
</footer>
</body>
</html>