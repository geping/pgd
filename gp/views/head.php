<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $head['title']; ?></title>
        <link href="/css/framework.css" rel="stylesheet" type="text/css" />
        <link href="/css/index.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/js/jquery-1.6.1.min.js"></script>
        <script type="text/javascript" SRC="/js/jqlib/jquery.ui.core.min.js"></script>
        <script type="text/javascript" SRC="/js/jqlib/jquery.ui.widget.min.js"></script>
        <script type="text/javascript" SRC="/js/jqlib/jquery.ui.tabs.min.js"></script>
        <!-- jQuery tooltips -->
        <script type="text/javascript" SRC="/js/jqlib/jquery.tipTip.min.js"></script>
        <!-- Superfish navigation -->
        <script type="text/javascript" SRC="/js/jqlib/jquery.superfish.min.js"></script>
        <script type="text/javascript" SRC="/js/jqlib/jquery.supersubs.min.js"></script>
        <!-- jQuery form validation -->
        <script type="text/javascript" SRC="/js/jqlib/jquery.validate_pack.js"></script>
        <!-- jQuery popup box -->
        <script type="text/javascript" SRC="/js/jqlib/jquery.nyroModal.pack.js"></script>
        <script type="text/javascript" SRC="/js/jqlib/administry.js"></script>
        <script src="/js/share.js"></script>
    </head>
    <body>
        <a onclick="gototop(this)" href="javascript:;"><img style="display:none" id="bak_top" src="/images/go_top.gif" /></a>
        <!--头部开始-->
        <div class="head_bar head">
            <div class="con">
                <p class="welcome">欢迎光临！</p>
                <p class="link"><a href="/">版图信息表</a>|<a href="/">周计划清单</a>|<a href="/">进料清单</a>|<?php if ($head['username'] !== '') { ?><a href="/index.php?c=home&m=import">导入数据</a>|<span class="operator">管理操作人员<ul id="operator"><li><a href="/index.php?c=home&m=operator">管理操作人员</a></li><li><a href="/index.php?c=home&m=operatoradd">添加操作人员</a></li><li><a href="/index.php?c=home&m=operatordel">删除操作人员</a></li></ul></span>|<span><?php echo $head['username']; ?><a href="/index.php?c=home&m=outthis">[退出]</a><?php } else { ?><a href="/index.php?c=home&m=login">[登录]</a><?php } ?></span>|<a href="">帮助</a></p>
            </div>
        </div>
        <!--头部结束-->