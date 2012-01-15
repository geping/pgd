<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
	
	<title>后台管理系统 -- 天天游戏乐园</title>

	<link type="text/css" href="/css/style.css" rel="stylesheet" /> <!-- the layout css file -->
	<link type="text/css" href="/css/jquery.cleditor.css" rel="stylesheet" />
	
	<script type='text/javascript' src='/js/jquery-1.4.2.min.js'></script>	<!-- jquery library -->
	<script type='text/javascript' src='/js/jquery-ui-1.8.5.custom.min.js'></script> <!-- jquery UI -->
	<script type='text/javascript' src='/js/cufon-yui.js'></script> <!-- Cufon font replacement -->
	<script type='text/javascript' src='/js/colaboratelight_400.font.js'></script> <!-- the Colaborate Light font -->
	<script type='text/javascript' src='/js/easytooltip.js'></script> <!-- element tooltips -->
	<script type='text/javascript' src='/js/jquery.tablesorter.min.js'></script> <!-- tablesorter -->
	<script type='text/javascript' src='/js/swfobject.js'></script> <!-- tablesorter -->
	
	<!--[if IE 8]>
		<script type='text/javascript' src='/js/excanvas.js'></script>
		<link rel="stylesheet" href="/css/IEfix.css" type="text/css" media="screen" />
	<![endif]--> 
 
	<!--[if IE 7]>
		<script type='text/javascript' src='/js/excanvas.js'></script>
		<link rel="stylesheet" href="/css/IEfix.css" type="text/css" media="screen" />
	<![endif]--> 
	
	<script type='text/javascript' src='/js/visualize.jquery.js'></script> <!-- visualize plugin for graphs / statistics -->
	<script type='text/javascript' src='/js/iphone-style-checkboxes.js'></script> <!-- iphone like checkboxes -->
	<script type='text/javascript' src='/js/jquery.cleditor.min.js'></script> <!-- wysiwyg editor -->

	<script type='text/javascript' src='/js/custom.js'></script> <!-- the "make them work" script -->
</head>

<body>
	<div id="container">
		<div id="bgwrap">
			<div id="primary_left">
        
				<div id="logo">
					<a href="/" title="Administrator"><img src="/images/logo.png" alt="" /></a>
					<div style="width: 100%; text-align:center; margin-top:10px; color:#ffffff">
						欢迎你回来，<strong class="dialog_link"><?php echo $Management['alias']; ?></strong>
					</div>
				</div> <!-- logo end -->

				<div id="menu"> <!-- navigation menu -->
					<ul>
						<?php
							foreach($menu as $key => $value) {
								$iscurrent = $ul_id = '';
								foreach($value['child'] as $ke => $va) {
									if (strtolower($va['tag']) == strtolower($current)) {
										$iscurrent = ' class="current"';
										$ul_id = ' id="child_ul_current"';
										break;
									}
								}
						?>
						<li title="<?php echo $value['name']; ?>"<?php echo $iscurrent; ?>><a href="javascript:;" class="dashboard"><img src="/images/icons/menu_icon/<?php echo $value['style']; ?>.png" alt="" /><span><?php echo $value['name']; ?></span></a>
							<?php
								if (!empty($value['child'])) {
									echo '<ul'.$ul_id.'>';
									foreach($value['child'] as $k => $v) {
										if ($v['show'] == 0) {
											continue;
										}
							?>
								<li class="tooltip" title="<?php echo $v['name']; ?>"><a href="/<?php echo $v['url']; ?>"><?php if ($current == $v['tag']) {echo '<font color="#ffff00"><b>'.$v['name'].'</b></font>';} else { echo $v['name'];} ?></a></li>
							<?php
									}
									echo '</ul>';
								}
							?>
						</li>
						<?php
							}
						?>
					</ul>
				</div> <!-- navigation menu end -->
			</div> <!-- sidebar end -->
