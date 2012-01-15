<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>后台管理系统</title>
	
	<link type="text/css" href="/css/style.css" rel="stylesheet" />
	<link type="text/css" href="/css/login.css" rel="stylesheet" />
	
	<script type='text/javascript' src='/js/jquery-1.4.2.min.js'></script>	<!-- jquery library -->
	
	<!--[if IE 8]>
		<script type='text/javascript' src='/js/excanvas.js'></script>
		<link rel="stylesheet" href="http://hello.amnesio.com/css/loginIEfix.css" type="text/css" media="screen" />
	<![endif]--> 
 
	<!--[if IE 7]>
		<script type='text/javascript' src='/js/excanvas.js'></script>
		<link rel="stylesheet" href="http://hello.amnesio.com/css/loginIEfix.css" type="text/css" media="screen" />
	<![endif]--> 
	
<meta charset="UTF-8"></head>
<body>
	<div id="line"><!-- --></div>
	<div id="background">
		<div id="container">
			<div id="logo">
				<img src="/images/logologin.png" alt="Logo" />
			</div>
			<div id="box"> 
				<form action="/login" method="POST"> 
					<div class="one_half">
						<p><input type="text" name="username" value="username" class="field" onblur="if (jQuery(this).val() == &quot;&quot;) { jQuery(this).val(&quot;username&quot;); }" onclick="jQuery(this).val(&quot;&quot;);" /></p>
						<p style="color:#ff0000;"><?php echo $error; ?></p>
					</div>
					<div class="one_half last">
						<p><input type="password" name="password" value="asdf1234" class="field" onblur="if (jQuery(this).val() == &quot;&quot;) { jQuery(this).val(&quot;asdf1234&quot;); }" onclick="jQuery(this).val(&quot;&quot;);">	</p>
						<p><input type="submit" name="submit" value="登录" class="login" /></p>
					</div>
			</form> 
		</div> 
		
		</div>
	</div>
</body>
</html>
