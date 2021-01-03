<!--{use_layout layout/main}-->
<?php
    $head_info = [
        'title' => $msg.'('.$err_code.')',
    ];
?>

<div class="error">
    <p><?php echo $msg; ?></p>
    <p>ERROR CODE [ <?php echo $err_code; ?> ]</p>
    <p>
        <a href="javascript:history.back(-1);">
            <?php echo YiluPHP::I()->lang('back'); ?>
        </a>
    </p>
</div>

<?php if (!empty($backtrace)): ?>
<div style="background: peachpuff; color: #d00000;">
    <h3 style="background: brown; color: gold; padding: 0.3rem 1rem;"><?php echo YiluPHP::I()->lang('debug_mode_title'); ?></h3>
    <pre style=" padding: 0.5rem 1.5rem 0.5rem 1.5rem;">
<?php print_r($backtrace); ?>
    </pre>
</div>
<?php endif; ?>